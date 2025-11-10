<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            
            // Location Information
            'pickup_location_id' => (int) $this->pickup_location_id,
            'pickup_location' => $this->whenLoaded('pickupLocation', function () {
                return [
                    'id' => $this->pickupLocation->id,
                    'name' => $this->pickupLocation->name,
                    'address' => $this->pickupLocation->address,
                    'type' => $this->pickupLocation->type,
                    'lat' => $this->pickupLocation->lat,
                    'lng' => $this->pickupLocation->lng,
                ];
            }),
            'pickup_address' => $this->pickup_address,
            'return_location_id' => (int) $this->return_location_id,
            'return_location' => $this->whenLoaded('returnLocation', function () {
                return [
                    'id' => $this->returnLocation->id,
                    'name' => $this->returnLocation->name,
                    'address' => $this->returnLocation->address,
                    'type' => $this->returnLocation->type,
                    'lat' => $this->returnLocation->lat,
                    'lng' => $this->returnLocation->lng,
                ];
            }),
            'return_address' => $this->return_address,
            'same_return_location' => $this->same_return_location,
            'is_airport_pickup' => $this->is_airport_pickup,
            'is_airport_return' => $this->is_airport_return,
            
            // Date and Time Information
            'pickup_date' => $this->pickup_date?->format('Y-m-d'),
            'pickup_time' => $this->pickup_time,
            'return_date' => $this->return_date?->format('Y-m-d'),
            'return_time' => $this->return_time,
            'rental_days' => $this->rental_days,
            'formatted_pickup_datetime' => $this->formatted_pickup_datetime,
            'formatted_return_datetime' => $this->formatted_return_datetime,
            
            // Flight Information
            'flight_arrival_date' => $this->flight_arrival_date?->format('Y-m-d'),
            'flight_arrival_time' => $this->flight_arrival_time,
            'flight_number_arrival' => $this->flight_number_arrival,
            'flight_airline_arrival' => $this->flight_airline_arrival,
            'flight_departure_date' => $this->flight_departure_date?->format('Y-m-d'),
            'flight_departure_time' => $this->flight_departure_time,
            'flight_number_departure' => $this->flight_number_departure,
            'flight_airline_departure' => $this->flight_airline_departure,
            'formatted_flight_arrival_datetime' => $this->formatted_flight_arrival_datetime,
            'formatted_flight_departure_datetime' => $this->formatted_flight_departure_datetime,
            'has_flight_info' => $this->has_flight_info,
            
            // Customer Demographics
            'customer_age' => $this->customer_age,
            'customer_country_id' => (int) $this->customer_country_id,
            'customer_country' => $this->whenLoaded('customerCountry', function () {
                return [
                    'id' => $this->customerCountry->id,
                    'name' => $this->customerCountry->name,
                    'currency' => $this->customerCountry->currency,
                    'currency_code' => $this->customerCountry->currency_code,
                    'iso2' => $this->customerCountry->iso2,
                    'iso3' => $this->customerCountry->iso3,
                    'flag' => $this->customerCountry->flag,
                ];
            }),
            
            // Car Information
            'car_id' => (int) $this->car_id,
            'car' => $this->whenLoaded('car', function () {
                return [
                    'id' => $this->car->id,
                    'name' => $this->car->name,
                    'image' => $this->car->image,
                    'seats' => $this->car->seats,
                    'bags' => $this->car->bags,
                    'transmission' => $this->car->transmission,
                    'brand' => $this->car->brand,
                    'model' => $this->car->model,
                    'year' => $this->car->year,
                    'fuel_type' => $this->car->fuel_type,
                    'engine_size' => $this->car->engine_size,
                ];
            }),
            
            // Price Package Information
            'price_package_id' => (int) $this->price_package_id,
            'price_package' => $this->whenLoaded('pricePackage', function () {
                return [
                    'id' => $this->pricePackage->id,
                    'name' => $this->pricePackage->name,
                    'price' => $this->pricePackage->price,
                    'price_type' => $this->pricePackage->price_type,
                    'kilometer_limit' => $this->pricePackage->kilometer_limit,
                ];
            }),
            
            // Options
            'options' => $this->whenLoaded('options', function () {
                return $this->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'description' => $option->description,
                        'icon' => $option->icon,
                        'price' => $option->price,
                        'price_type' => $option->price_type,
                        'quantity' => $option->pivot->quantity,
                        'total_price' => $option->pivot->total_price,
                    ];
                });
            }),
            'options_total' => $this->options_total,
            'formatted_options_total' => $this->formatted_options_total,
            
            // Coupon Information
            'coupon_code' => $this->coupon_code,
            'coupon_discount_amount' => $this->coupon_discount_amount,
            'coupon_discount_percentage' => $this->coupon_discount_percentage,
            'formatted_coupon_discount' => $this->formatted_coupon_discount,
            'coupon' => $this->whenLoaded('coupon', function () {
                return [
                    'id' => $this->coupon->id,
                    'coupon_num' => $this->coupon->coupon_num,
                    'type' => $this->coupon->type,
                    'discount' => $this->coupon->discount,
                    'max_discount' => $this->coupon->max_discount,
                ];
            }),
            
            // Customer Information
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city_id' => (int) $this->city_id,
            'city' => $this->whenLoaded('city', function () {
                return [
                    'id' => $this->city->id,
                    'name' => $this->city->name,
                    'region_id' => (int) $this->city->region_id,
                    'country_id' => (int) $this->city->country_id,
                ];
            }),
            'country_id' => (int) $this->country_id,
            'country' => $this->whenLoaded('country', function () {
                return [
                    'id' => $this->country->id,
                    'name' => $this->country->name,
                    'currency' => $this->country->currency,
                    'currency_code' => $this->country->currency_code,
                    'iso2' => $this->country->iso2,
                    'iso3' => $this->country->iso3,
                    'flag' => $this->country->flag,
                ];
            }),
            'zip' => $this->zip,
            'birthdate' => $this->birthdate?->format('Y-m-d'),
            
            // Driver License Information
            'driver_license_number' => $this->driver_license_number,
            'driver_license_expiration_date' => $this->driver_license_expiration_date?->format('Y-m-d'),
            'front_driver_license_image' => $this->front_driver_license_image,
            'back_driver_license_image' => $this->back_driver_license_image,
            
            // International Customer Information
            'current_country_address' => $this->current_country_address,
            'passport_expiration_date' => $this->passport_expiration_date?->format('Y-m-d'),
            'passport_image' => $this->passport_image,
            
            // Client Signature
            'client_signature' => $this->client_signature,
            
            // Order Status and Management
            'order_status' => $this->order_status,
            'order_status_text' => $this->order_status_text,
            'payment_status' => $this->payment_status,
            'payment_status_text' => $this->payment_status_text,
            'payment_method' => $this->payment_method,
            'payment_reference' => $this->payment_reference,
            
            // Amounts
            'subtotal_amount' => $this->subtotal_amount,
            'fees' => $this->fees,
            'formatted_fees' => $this->formatted_fees,
            'total_amount' => $this->total_amount,
            'formatted_subtotal_amount' => $this->formatted_subtotal_amount,
            'formatted_total_amount' => $this->formatted_total_amount,
            
            // Location Text
            'pickup_location_text' => $this->pickup_location_text,
            'return_location_text' => $this->return_location_text,
            
            // Notes
            'notes' => $this->notes,
            'admin_notes' => $this->admin_notes,
            
            // User Information
            'user_id' => (int) $this->user_id,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                ];
            }),
            
            // Timestamps
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
