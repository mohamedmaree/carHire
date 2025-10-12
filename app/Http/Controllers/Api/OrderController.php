<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Models\Car;
use App\Models\Location;
use App\Models\Option;
use App\Models\PricePackage;
use App\Models\Coupon;
use App\Models\User;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Traits\ResponseTrait;
use App\Http\Requests\Api\orders\StoreOrderRequest;
use App\Services\EwayPaymentService;
use Illuminate\Http\Request;
use App\Jobs\SendBookingConfirmationEmailJob;

class OrderController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $query = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options', 'customerCountry', 'city', 'country']);

        // Filter by user if authenticated
        if ($request->user()) {
            $query->where('user_id', $request->user()->id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('order_status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->has('pickup_date_from')) {
            $query->where('pickup_date', '>=', $request->pickup_date_from);
        }
        if ($request->has('pickup_date_to')) {
            $query->where('pickup_date', '<=', $request->pickup_date_to);
        }

        $orders = $query->ordered()->paginate($this->paginateNum());
        return $this->successData(new OrderCollection($orders));
    }

    public function show($id)
    {
        $order = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options', 'coupon', 'user', 'customerCountry', 'city', 'country'])
            ->findOrFail($id);
        
        return $this->successData(new OrderResource($order));
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        
        // Calculate rental days
        $pickupDate = \Carbon\Carbon::parse($data['pickup_date']);
        $returnDate = \Carbon\Carbon::parse($data['return_date']);
        $data['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;
        
        // Calculate amounts
        $pricePackage = PricePackage::find($data['price_package_id']);
        $data['subtotal_amount'] = $pricePackage->price * $data['rental_days'];
        
        // Handle coupon discount
        if (!empty($data['coupon_code'])) {
            $coupon = Coupon::where('coupon_num', $data['coupon_code'])
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('expire_date', '>=', now())
                ->first();
                
            if ($coupon) {
                if ($coupon->type == 'percentage') {
                    $data['coupon_discount_percentage'] = $coupon->discount;
                    $data['coupon_discount_amount'] = ($data['subtotal_amount'] * $coupon->discount) / 100;
                    if ($coupon->max_discount && $data['coupon_discount_amount'] > $coupon->max_discount) {
                        $data['coupon_discount_amount'] = $coupon->max_discount;
                    }
                } else {
                    $data['coupon_discount_amount'] = $coupon->discount;
                }
            }
        }
        
        // Calculate total amount
        $data['total_amount'] = $data['subtotal_amount'] - ($data['coupon_discount_amount'] ?? 0);
        
        // Handle airport locations
        if (isset($data['pickup_location_id'])) {
            $pickupLocation = Location::find($data['pickup_location_id']);
            $data['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
        }
        
        if (isset($data['return_location_id'])) {
            $returnLocation = Location::find($data['return_location_id']);
            $data['is_airport_return'] = $returnLocation && $returnLocation->type == 'airport';
        }
        
        // Handle user creation/update
        $user = User::where('email', $data['email'])
            ->orWhere('phone', $data['phone'])
            ->first();
            
        if ($user) {
            // Update existing user
            $user->update([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        } else {
            // Create new user
            $user = User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt('password123'), // Default password
                'active' => true,
            ]);
        }
        
        $data['user_id'] = $user->id;
        
        // Set default statuses
        $data['order_status'] = OrderStatus::PENDING->value;
        $data['payment_status'] = PaymentStatus::PENDING->value;
        
        $order = Order::create($data);
        
        // Attach options
        if (!empty($data['options'])) {
            $processedOptions = [];
            
            foreach ($data['options'] as $optionId => $optionData) {
                if ($optionData['quantity'] > 0) {
                    $option = Option::find($optionId);
                    
                    // Skip if this is a parent option and any of its children are selected
                    if ($option->is_parent) {
                        $hasChildSelected = false;
                        foreach ($data['options'] as $otherOptionId => $otherOptionData) {
                            if ($otherOptionData['quantity'] > 0) {
                                $otherOption = Option::find($otherOptionId);
                                if ($otherOption->parent_id == $option->id) {
                                    $hasChildSelected = true;
                                    break;
                                }
                            }
                        }
                        
                        if ($hasChildSelected) {
                            continue; // Skip parent if child is selected
                        }
                    }
                    
                    // Skip if this is a child option and its parent is also selected
                    if ($option->is_child && isset($data['options'][$option->parent_id])) {
                        $parentData = $data['options'][$option->parent_id];
                        if ($parentData['quantity'] > 0) {
                            continue; // Skip child if parent is selected
                        }
                    }
                    
                    $price = $option->price;
                    $totalPrice = $price * $optionData['quantity'];
                    
                    if ($option->price_type == 'per_day') {
                        $totalPrice *= $data['rental_days'];
                    }
                    
                    $order->options()->attach($optionId, [
                        'quantity' => $optionData['quantity'],
                        'price' => $price,
                        'total_price' => $totalPrice
                    ]);
                    
                    $data['total_amount'] += $totalPrice;
                }
            }
        }
        
        // Update total amount with options
        $order->update(['total_amount' => $data['total_amount']]);
        
        // Dispatch booking confirmation email job to queue
        SendBookingConfirmationEmailJob::dispatch($order->id);
        
        // Create payment URL using eWAY
        $paymentService = new EwayPaymentService();
        $paymentResult = $paymentService->createPaymentUrl($order);
        
        if ($paymentResult['success']) {
            return $this->successData([
                'order' => new OrderResource($order->load(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options'])),
                'payment_url' => $paymentResult['payment_url'],
                'access_code' => $paymentResult['access_code']
            ], 'Order created successfully. Please complete payment to confirm your booking.');
        } else {
            return $this->response('fail','Order created but payment initialization failed. Please contact support.',$paymentResult['errors']);
        }
    }
}