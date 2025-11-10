<?php

namespace App\Http\Requests\Api\orders;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

class StoreOrderRequest extends FormRequest
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
            'pickup_address' => 'nullable|string|max:500',
            'return_location_id' => 'nullable|exists:locations,id',
            'return_address' => 'nullable|string|max:500',
            'same_return_location' => 'boolean',
            
            // Date and Time Information
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|date_format:H:i',
            'return_date' => 'required|date|after:pickup_date',
            'return_time' => 'required|date_format:H:i',
            
            // Flight Information (for airport locations)
            'flight_arrival_date' => 'nullable|date',
            'flight_arrival_time' => 'nullable|date_format:H:i',
            'flight_number_arrival' => 'nullable|string|max:50',
            'flight_airline_arrival' => 'nullable|string|max:100',
            'flight_departure_date' => 'nullable|date',
            'flight_departure_time' => 'nullable|date_format:H:i',
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
            'driver_license_expiration_date' => 'nullable|date|after:today',
            'front_driver_license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_driver_license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // International Customer Information
            'current_country_address' => 'nullable|string|max:500',
            'passport_expiration_date' => 'nullable|date|after:today',
            'passport_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Client Signature
            'client_signature' => 'nullable',
            
            // Options
            'options' => 'nullable|array',
            'options.*.quantity' => 'integer|min:0',
            
            // Notes
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'pickup_location_id.exists' => 'The selected pickup location is invalid.',
            'return_location_id.exists' => 'The selected return location is invalid.',
            'pickup_date.after_or_equal' => 'Pickup date must be today or later.',
            'return_date.after' => 'Return date must be after pickup date.',
            'pickup_time.date_format' => 'Pickup time must be in HH:MM format.',
            'return_time.date_format' => 'Return time must be in HH:MM format.',
            'flight_arrival_time.date_format' => 'Flight arrival time must be in HH:MM format.',
            'flight_departure_time.date_format' => 'Flight departure time must be in HH:MM format.',
            'customer_age.min' => 'Customer must be at least 18 years old.',
            'customer_age.max' => 'Customer age cannot exceed 100 years.',
            'car_id.exists' => 'The selected car is invalid.',
            'price_package_id.exists' => 'The selected price package is invalid.',
            'email.email' => 'Please provide a valid email address.',
            'driver_license_expiration_date.after' => 'Driver license expiration date must be in the future.',
            'passport_expiration_date.after' => 'Passport expiration date must be in the future.',
            'front_driver_license_image.image' => 'Front driver license must be an image.',
            'front_driver_license_image.mimes' => 'Front driver license image must be a file of type: jpeg, png, jpg, gif.',
            'front_driver_license_image.max' => 'Front driver license image may not be greater than 2MB.',
            'back_driver_license_image.image' => 'Back driver license must be an image.',
            'back_driver_license_image.mimes' => 'Back driver license image must be a file of type: jpeg, png, jpg, gif.',
            'back_driver_license_image.max' => 'Back driver license image may not be greater than 2MB.',
            'passport_image.image' => 'Passport must be an image.',
            'passport_image.mimes' => 'Passport image must be a file of type: jpeg, png, jpg, gif.',
            'passport_image.max' => 'Passport image may not be greater than 2MB.',
            'client_signature.string' => 'Client signature must be a valid signature data.',
        ];
    }
}
