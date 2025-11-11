<?php

namespace App\Http\Requests\Admin\orders;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    protected function prepareForValidation() {
        $this->merge([
            'phone' => fixPhone($this->phone),
        ]);
    }
    public function rules()
    {
        return [
            // Location Information
            'pickup_location_id' => 'nullable|exists:locations,id',
            'pickup_address' => 'required_without:pickup_location_id|string|max:500',
            'return_location_id' => 'nullable|exists:locations,id',
            'return_address' => 'required_without:return_location_id|string|max:500',
            'same_return_location' => 'nullable|boolean',
            
            // Date and Time Information
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'return_date' => 'required|date|after:pickup_date',
            'return_time' => 'required',
            
            // Flight Information (for airport locations)
            'flight_arrival_date' => 'nullable|date',
            'flight_arrival_time' => 'nullable',
            'flight_number_arrival' => 'nullable|string|max:50',
            'flight_airline_arrival' => 'nullable|string|max:100',
            'flight_departure_date' => 'nullable|date',
            'flight_departure_time' => 'nullable',
            'flight_number_departure' => 'nullable|string|max:50',
            'flight_airline_departure' => 'nullable|string|max:100',
            
            // Customer Demographics
            'customer_age' => 'required|integer|min:18|max:100',
            'customer_country_id' => 'required|exists:countries,id',
            
            // Car and Options
            'car_id' => 'required|exists:cars,id',
            'price_package_id' => 'required|exists:price_packages,id',
            
            // Coupon Information
            'coupon_code' => 'nullable|string|max:50',
            
            // Fees
            'fees' => 'nullable|numeric|min:0|max:99999999.99',
            
            // Customer Information
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'city_id' => 'nullable|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'zip' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            
            // Driver License Information
            'driver_license_number' => 'nullable|string|max:100',
            'driver_license_expiration_date' => 'nullable|date',
            'front_driver_license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_driver_license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // International Customer Information
            'current_country_address' => 'nullable|string|max:500',
            'passport_expiration_date' => 'nullable|date',
            'front_passport_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_passport_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Client Signature
            'client_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Options
            'options' => 'nullable|array',
            'options.*.quantity' => 'integer|min:0',
            
            // Order Status and Management
            'order_status' => 'nullable|in:' . implode(',', array_column(OrderStatus::cases(), 'value')),
            'payment_status' => 'nullable|in:' . implode(',', array_column(PaymentStatus::cases(), 'value')),
            'payment_method' => 'nullable|string|max:100',
            'payment_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }
}
