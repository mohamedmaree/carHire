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
        
        // Calculate rental days
        $pickupDate = \Carbon\Carbon::parse($data['pickup_date']);
        $returnDate = \Carbon\Carbon::parse($data['return_date']);
        $data['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;
        
        // Calculate amounts
        $car = Car::find($data['car_id']);
        $pricePackage = PricePackage::find($data['price_package_id']);
        
        if ($pricePackage) {
            $data['subtotal_amount'] = $pricePackage->price * $data['rental_days'];
        } else {
            $data['subtotal_amount'] = 0;
        }
        
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
        if ($data['pickup_location_id']) {
            $pickupLocation = Location::find($data['pickup_location_id']);
            $data['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
        }
        
        if ($data['return_location_id']) {
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
        
        $order = Order::create($data);
        
        // Attach options
        if (!empty($data['options'])) {
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
        
        // Calculate rental days
        $pickupDate = \Carbon\Carbon::parse($data['pickup_date']);
        $returnDate = \Carbon\Carbon::parse($data['return_date']);
        $data['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;
        
        // Calculate amounts
        $car = Car::find($data['car_id']);
        $pricePackage = PricePackage::find($data['price_package_id']);
        
        if ($pricePackage) {
            $data['subtotal_amount'] = $pricePackage->price * $data['rental_days'];
        } else {
            $data['subtotal_amount'] = 0;
        }
        
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
        if ($data['pickup_location_id']) {
            $pickupLocation = Location::find($data['pickup_location_id']);
            $data['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
        }
        
        if ($data['return_location_id']) {
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
        
        $order->update($data);
        
        // Update options
        $order->options()->detach();
        if (!empty($data['options'])) {
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
        
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function show($id)
    {
        $order = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options', 'coupon', 'user', 'customerCountry', 'city', 'country'])
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders.index')->with('success', __('admin.deleted_successfully'));
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();
        
        return response()->json(['success' => true]);
    }
}
