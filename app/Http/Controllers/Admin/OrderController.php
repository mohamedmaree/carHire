<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\orders\Store;
use App\Http\Requests\Admin\orders\Update;
use App\Models\Order;
use App\Models\Car;
use App\Models\Location;
use App\Models\Option;
use App\Models\PricePackage;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\PublicHoliday;
use App\Models\SiteSetting;
use App\Jobs\SendBookingConfirmationEmailJob;
use App\Traits\Report;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-all-order', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-order', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-order', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-order', ['only' => ['destroy', 'destroyAll']]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $orders = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options'])
                ->search(request()->searchArray)
                ->paginate(30);
            $html = view('admin.orders.table', compact('orders'))->render();
            return response()->json(['html' => $html]);
        }
        
        $cars = Car::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $pricePackages = PricePackage::active()->ordered()->get();
        $options = Option::active()->ordered()->get();
        $coupons = Coupon::where('status', 'available')->get();
        
        return view('admin.orders.index', compact('cars', 'locations', 'pricePackages', 'options', 'coupons'));
    }

    public function create()
    {
        $cars = Car::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $pricePackages = PricePackage::active()->ordered()->get();
        $options = Option::active()->ordered()->get();
        $coupons = Coupon::where('status', 'available')->get();
        $countries = Country::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        
        return view('admin.orders.create', compact('cars', 'locations', 'pricePackages', 'options', 'coupons', 'countries', 'cities'));
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        
        // Check for public holidays
        $pickupDate = \Carbon\Carbon::parse($data['pickup_date']);
        $returnDate = \Carbon\Carbon::parse($data['return_date']);
        
        // Check if pickup date is a public holiday
        $pickupHoliday = PublicHoliday::isHoliday($pickupDate->format('Y-m-d'));
        if ($pickupHoliday) {
            return response()->json([
                'icon' => 'error',
                'title' => __('admin.pickup_date_is_public_holiday', ['name' => $pickupHoliday->name])
            ], 422);
        }
        
        // Check if return date is a public holiday
        $returnHoliday = PublicHoliday::isHoliday($returnDate->format('Y-m-d'));
        if ($returnHoliday) {
            return response()->json([
                'icon' => 'error',
                'title' => __('admin.return_date_is_public_holiday', ['name' => $returnHoliday->name])
            ], 422);
        }
        
        // Calculate rental days
        $data['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;
        
        // Calculate base subtotal (car price * days)
        $car = Car::find($data['car_id']);
        $pricePackage = PricePackage::find($data['price_package_id']);
        
        if ($pricePackage) {
            $carSubtotal = $pricePackage->price * $data['rental_days'];
        } else {
            $carSubtotal = 0;
        }
        
        // Calculate options total (daily options * days + flat fee options)
        $optionsTotal = 0;
        if (!empty($data['options'])) {
            foreach ($data['options'] as $optionId => $optionData) {
                if ($optionData['quantity'] > 0) {
                    $option = Option::find($optionId);
                    
                    // Skip if this is a parent option and any of its children are selected
                    if ($option && $option->is_parent) {
                        $hasChildSelected = false;
                        foreach ($data['options'] as $otherOptionId => $otherOptionData) {
                            if ($otherOptionData['quantity'] > 0) {
                                $otherOption = Option::find($otherOptionId);
                                if ($otherOption && $otherOption->parent_id == $option->id) {
                                    $hasChildSelected = true;
                                    break;
                                }
                            }
                        }
                        if ($hasChildSelected) {
                            continue;
                        }
                    }
                    
                    // Skip if this is a child option and its parent is also selected
                    if ($option && $option->is_child && isset($data['options'][$option->parent_id])) {
                        $parentData = $data['options'][$option->parent_id];
                        if ($parentData['quantity'] > 0) {
                            continue;
                        }
                    }
                    
                    if ($option) {
                        $price = $option->price;
                        $totalPrice = $price * $optionData['quantity'];
                        
                        if ($option->price_type == 'per_day') {
                            $totalPrice *= $data['rental_days'];
                        }
                        
                        $optionsTotal += $totalPrice;
                    }
                }
            }
        }
        
        // Calculate subtotal (car + options)
        $data['subtotal_amount'] = $carSubtotal + $optionsTotal;
        
        // Get settings for GST and Surcharges Fee
        $settings = SiteSetting::pluck('value', 'key');
        $gstPercentage = floatval($settings['gst_percentage'] ?? 10); // Default 10%
        $surchargesFeePercentage = floatval($settings['surcharges_fee_percentage'] ?? 1.5); // Default 1.5%
        
        // Get Refundable Deposit from car (default to 500 if not set)
        $refundableDeposit = $car && $car->refundable_deposit ? floatval($car->refundable_deposit) : 500;
        
        // Calculate GST (percentage of subtotal)
        $data['gst'] = ($data['subtotal_amount'] * $gstPercentage) / 100;
        
        // Set Refundable Deposit from car
        $data['refundable_deposit'] = $refundableDeposit;
        
        // Calculate Surcharges Fee (percentage of subtotal)
        $data['surcharges_fee'] = ($data['subtotal_amount'] * $surchargesFeePercentage) / 100;
        
        // Reset coupon discount fields first
        $data['coupon_discount_amount'] = null;
        $data['coupon_discount_percentage'] = null;
        
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
        
        // Handle airport locations and add toll delivery fees
        $tollDeliveryFees = 0;
        if ($data['pickup_location_id']) {
            $pickupLocation = Location::find($data['pickup_location_id']);
            $data['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
            if ($pickupLocation && $pickupLocation->toll_delivery_fees) {
                $tollDeliveryFees += $pickupLocation->toll_delivery_fees;
            }
        }
        if ($data['return_location_id']) {
            $returnLocation = Location::find($data['return_location_id']);
            $data['is_airport_return'] = $returnLocation && $returnLocation->type == 'airport';
            // if ($returnLocation && $returnLocation->toll_delivery_fees) {
            //     $tollDeliveryFees += $returnLocation->toll_delivery_fees;
            // }
        }
        
        // Set fees to calculated toll delivery fees (or use provided fees if manually set)
        if (!isset($data['fees']) || $data['fees'] === null) {
            $data['fees'] = $tollDeliveryFees > 0 ? $tollDeliveryFees : null;
        } else {
            // If fees were manually set, keep them but ensure null if 0
            if (empty($data['fees']) || $data['fees'] == 0) {
                $data['fees'] = null;
            }
        }
        
        // Calculate total amount: subtotal + GST + Refundable Deposit + Surcharges Fee - coupon discount + fees
        $data['total_amount'] = $data['subtotal_amount'] 
            + $data['gst'] 
            + $data['refundable_deposit'] 
            + $data['surcharges_fee'] 
            - ($data['coupon_discount_amount'] ?? 0) 
            + ($data['fees'] ?? 0);
        
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
        
        $order = Order::create($data);
        
        // Attach options
        if (!empty($data['options'])) {
            foreach ($data['options'] as $optionId => $optionData) {
                if ($optionData['quantity'] > 0) {
                    $option = Option::find($optionId);
                    
                    // Skip if this is a parent option and any of its children are selected
                    if ($option && $option->is_parent) {
                        $hasChildSelected = false;
                        foreach ($data['options'] as $otherOptionId => $otherOptionData) {
                            if ($otherOptionData['quantity'] > 0) {
                                $otherOption = Option::find($otherOptionId);
                                if ($otherOption && $otherOption->parent_id == $option->id) {
                                    $hasChildSelected = true;
                                    break;
                                }
                            }
                        }
                        if ($hasChildSelected) {
                            continue;
                        }
                    }
                    
                    // Skip if this is a child option and its parent is also selected
                    if ($option && $option->is_child && isset($data['options'][$option->parent_id])) {
                        $parentData = $data['options'][$option->parent_id];
                        if ($parentData['quantity'] > 0) {
                            continue;
                        }
                    }
                    
                    if ($option) {
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
                    }
                }
            }
        }
        
        // Dispatch booking confirmation email job to queue
        SendBookingConfirmationEmailJob::dispatch($order->id);
        
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function edit($id)
    {
        $order = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options'])->findOrFail($id);
        $cars = Car::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $pricePackages = PricePackage::active()->ordered()->get();
        $options = Option::active()->ordered()->get();
        $coupons = Coupon::where('status', 'available')->get();
        $countries = Country::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        
        return view('admin.orders.edit', compact('order', 'cars', 'locations', 'pricePackages', 'options', 'coupons', 'countries', 'cities'));
    }

    public function update(Update $request, $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validated();
        
        // Check for public holidays
        $pickupDate = \Carbon\Carbon::parse($data['pickup_date']);
        $returnDate = \Carbon\Carbon::parse($data['return_date']);
        
        // Check if pickup date is a public holiday
        $pickupHoliday = PublicHoliday::isHoliday($pickupDate->format('Y-m-d'));
        if ($pickupHoliday) {
            return response()->json([
                'icon' => 'error',
                'title' => __('admin.pickup_date_is_public_holiday', ['name' => $pickupHoliday->name])
            ], 422);
        }
        
        // Check if return date is a public holiday
        $returnHoliday = PublicHoliday::isHoliday($returnDate->format('Y-m-d'));
        if ($returnHoliday) {
            return response()->json([
                'icon' => 'error',
                'title' => __('admin.return_date_is_public_holiday', ['name' => $returnHoliday->name])
            ], 422);
        }
        
        // Calculate rental days
        $data['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;
        
        // Calculate base subtotal (car price * days)
        $car = Car::find($data['car_id']);
        $pricePackage = PricePackage::find($data['price_package_id']);
        
        if ($pricePackage) {
            $carSubtotal = $pricePackage->price * $data['rental_days'];
        } else {
            $carSubtotal = 0;
        }
        
        // Calculate options total (daily options * days + flat fee options)
        $optionsTotal = 0;
        if (!empty($data['options'])) {
            foreach ($data['options'] as $optionId => $optionData) {
                if ($optionData['quantity'] > 0) {
                    $option = Option::find($optionId);
                    
                    // Skip if this is a parent option and any of its children are selected
                    if ($option && $option->is_parent) {
                        $hasChildSelected = false;
                        foreach ($data['options'] as $otherOptionId => $otherOptionData) {
                            if ($otherOptionData['quantity'] > 0) {
                                $otherOption = Option::find($otherOptionId);
                                if ($otherOption && $otherOption->parent_id == $option->id) {
                                    $hasChildSelected = true;
                                    break;
                                }
                            }
                        }
                        if ($hasChildSelected) {
                            continue;
                        }
                    }
                    
                    // Skip if this is a child option and its parent is also selected
                    if ($option && $option->is_child && isset($data['options'][$option->parent_id])) {
                        $parentData = $data['options'][$option->parent_id];
                        if ($parentData['quantity'] > 0) {
                            continue;
                        }
                    }
                    
                    if ($option) {
                        $price = $option->price;
                        $totalPrice = $price * $optionData['quantity'];
                        
                        if ($option->price_type == 'per_day') {
                            $totalPrice *= $data['rental_days'];
                        }
                        
                        $optionsTotal += $totalPrice;
                    }
                }
            }
        }
        
        // Calculate subtotal (car + options)
        $data['subtotal_amount'] = $carSubtotal + $optionsTotal;
        
        // Get settings for GST and Surcharges Fee
        $settings = SiteSetting::pluck('value', 'key');
        $gstPercentage = floatval($settings['gst_percentage'] ?? 10); // Default 10%
        $surchargesFeePercentage = floatval($settings['surcharges_fee_percentage'] ?? 1.5); // Default 1.5%
        
        // Get Refundable Deposit from car (default to 500 if not set)
        $refundableDeposit = $car && $car->refundable_deposit ? floatval($car->refundable_deposit) : 500;
        
        // Calculate GST (percentage of subtotal)
        $data['gst'] = ($data['subtotal_amount'] * $gstPercentage) / 100;
        
        // Set Refundable Deposit from car
        $data['refundable_deposit'] = $refundableDeposit;
        
        // Calculate Surcharges Fee (percentage of subtotal)
        $data['surcharges_fee'] = ($data['subtotal_amount'] * $surchargesFeePercentage) / 100;
        
        // Reset coupon discount fields first
        $data['coupon_discount_amount'] = null;
        $data['coupon_discount_percentage'] = null;
        
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
        
        // Handle airport locations and add toll delivery fees
        $tollDeliveryFees = 0;
        if ($data['pickup_location_id']) {
            $pickupLocation = Location::find($data['pickup_location_id']);
            $data['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
            if ($pickupLocation && $pickupLocation->toll_delivery_fees) {
                $tollDeliveryFees += $pickupLocation->toll_delivery_fees;
            }
        }
        if ($data['return_location_id']) {
            $returnLocation = Location::find($data['return_location_id']);
            $data['is_airport_return'] = $returnLocation && $returnLocation->type == 'airport';
            // if ($returnLocation && $returnLocation->toll_delivery_fees) {
            //     $tollDeliveryFees += $returnLocation->toll_delivery_fees;
            // }
        }
        
        // Set fees to calculated toll delivery fees (or use provided fees if manually set)
        if (!isset($data['fees']) || $data['fees'] === null) {
            $data['fees'] = $tollDeliveryFees > 0 ? $tollDeliveryFees : null;
        } else {
            // If fees were manually set, keep them but ensure null if 0
            if (empty($data['fees']) || $data['fees'] == 0) {
                $data['fees'] = null;
            }
        }
        
        // Calculate total amount: subtotal + GST + Refundable Deposit + Surcharges Fee - coupon discount + fees
        $data['total_amount'] = $data['subtotal_amount'] 
            + $data['gst'] 
            + $data['refundable_deposit'] 
            + $data['surcharges_fee'] 
            - ($data['coupon_discount_amount'] ?? 0) 
            + ($data['fees'] ?? 0);
        
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
        
        // Update order with all data including calculated total_amount
        $order->update($data);
        
        // Update options separately
        $order->options()->detach();
        if (!empty($data['options'])) {
            foreach ($data['options'] as $optionId => $optionData) {
                if ($optionData['quantity'] > 0) {
                    $option = Option::find($optionId);
                    
                    // Skip if this is a parent option and any of its children are selected
                    if ($option && $option->is_parent) {
                        $hasChildSelected = false;
                        foreach ($data['options'] as $otherOptionId => $otherOptionData) {
                            if ($otherOptionData['quantity'] > 0) {
                                $otherOption = Option::find($otherOptionId);
                                if ($otherOption && $otherOption->parent_id == $option->id) {
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
                    if ($option && $option->is_child && isset($data['options'][$option->parent_id])) {
                        $parentData = $data['options'][$option->parent_id];
                        if ($parentData['quantity'] > 0) {
                            continue; // Skip child if parent is selected
                        }
                    }
                    
                    if ($option) {
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
                    }
                }
            }
        }
        
        // Dispatch booking confirmation email job to queue (only if order status changed to confirmed)
        if ($order->order_status->value === 'confirmed') {
            SendBookingConfirmationEmailJob::dispatch($order->id);
        }
        
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function show($id)
    {
        $order = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options', 'coupon', 'user', 'customerCountry', 'city', 'country'])
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($order)
    {
        $orderModel = Order::findOrFail($order);
        $orderModel->delete();
        
        Report::addToLog('حذف طلب');
        
        return response()->json(['id' => $order]);
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();
        
        return response()->json(['success' => true]);
    }
}
