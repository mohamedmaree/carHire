<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Car;
use App\Models\Location;
use App\Models\Option;
use App\Models\PricePackage;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\City;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Carbon\Carbon;

class CarRentalOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some sample data
        $cars = Car::active()->take(3)->get();
        $locations = Location::active()->take(4)->get();
        $pricePackages = PricePackage::active()->take(3)->get();
        $options = Option::active()->take(3)->get();
        $coupons = Coupon::where('status', 'active')->take(2)->get();
        $countries = Country::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        if ($cars->isEmpty() || $locations->isEmpty() || $pricePackages->isEmpty() || $countries->isEmpty() || $cities->isEmpty()) {
            $this->command->warn('Please seed cars, locations, price packages, countries, and cities first!');
            return;
        }

        $sampleOrders = [
            [
                'pickup_location_id' => $locations->first()->id,
                'pickup_address' => '123 Main Street, Sydney',
                'return_location_id' => $locations->skip(1)->first()->id,
                'return_address' => '456 Queen Street, Melbourne',
                'same_return_location' => false,
                'pickup_date' => Carbon::now()->addDays(1),
                'pickup_time' => '10:00:00',
                'return_date' => Carbon::now()->addDays(4),
                'return_time' => '14:00:00',
                'customer_age' => 28,
                'customer_country_id' => $countries->where('name', 'Australia')->first()?->id ?? $countries->first()->id,
                'car_id' => $cars->first()->id,
                'price_package_id' => $pricePackages->first()->id,
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+61412345678',
                'address' => '789 Collins Street, Melbourne',
                'city_id' => $cities->where('name', 'Melbourne')->first()?->id ?? $cities->first()->id,
                'country_id' => $countries->where('name', 'Australia')->first()?->id ?? $countries->first()->id,
                'zip' => '3000',
                'birthdate' => Carbon::now()->subYears(28),
                'driver_license_number' => 'DL123456789',
                'driver_license_expiration_date' => Carbon::now()->addYears(5),
                'order_status' => OrderStatus::CONFIRMED->value,
                'payment_status' => PaymentStatus::PAID->value,
                'payment_method' => 'credit_card',
                'payment_reference' => 'PAY123456789',
                'notes' => 'Customer requested early pickup',
                'admin_notes' => 'VIP customer - priority handling',
            ],
            [
                'pickup_location_id' => $locations->skip(2)->first()->id,
                'pickup_address' => null, // Using location
                'return_location_id' => $locations->skip(2)->first()->id,
                'return_address' => null, // Using location
                'same_return_location' => true,
                'pickup_date' => Carbon::now()->addDays(2),
                'pickup_time' => '09:30:00',
                'return_date' => Carbon::now()->addDays(5),
                'return_time' => '16:30:00',
                'flight_arrival_date' => Carbon::now()->addDays(2),
                'flight_arrival_time' => '08:00:00',
                'flight_number_arrival' => 'QF123',
                'flight_airline_arrival' => 'Qantas',
                'flight_departure_date' => Carbon::now()->addDays(5),
                'flight_departure_time' => '18:00:00',
                'flight_number_departure' => 'QF456',
                'flight_airline_departure' => 'Qantas',
                'customer_age' => 35,
                'customer_country_id' => $countries->where('name', 'United States')->first()?->id ?? $countries->first()->id,
                'car_id' => $cars->skip(1)->first()->id,
                'price_package_id' => $pricePackages->skip(1)->first()->id,
                'coupon_code' => $coupons->isNotEmpty() ? $coupons->first()->coupon_num : null,
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1234567890',
                'address' => '123 Broadway, New York',
                'city_id' => $cities->where('name', 'New York')->first()?->id ?? $cities->first()->id,
                'country_id' => $countries->where('name', 'United States')->first()?->id ?? $countries->first()->id,
                'zip' => '10001',
                'birthdate' => Carbon::now()->subYears(35),
                'driver_license_number' => 'US987654321',
                'driver_license_expiration_date' => Carbon::now()->addYears(3),
                'current_country_address' => '456 Collins Street, Melbourne',
                'passport_expiration_date' => Carbon::now()->addYears(8),
                'order_status' => OrderStatus::PENDING->value,
                'payment_status' => PaymentStatus::PENDING->value,
                'notes' => 'International customer with flight details',
                'admin_notes' => 'Requires passport verification',
            ],
            [
                'pickup_location_id' => $locations->last()->id,
                'pickup_address' => '321 George Street, Brisbane',
                'return_location_id' => $locations->last()->id,
                'return_address' => '321 George Street, Brisbane',
                'same_return_location' => true,
                'pickup_date' => Carbon::now()->addDays(3),
                'pickup_time' => '11:00:00',
                'return_date' => Carbon::now()->addDays(6),
                'return_time' => '15:00:00',
                'customer_age' => 42,
                'customer_country_id' => $countries->where('name', 'United Kingdom')->first()?->id ?? $countries->first()->id,
                'car_id' => $cars->last()->id,
                'price_package_id' => $pricePackages->last()->id,
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '+447123456789',
                'address' => '789 Oxford Street, London',
                'city_id' => $cities->where('name', 'London')->first()?->id ?? $cities->first()->id,
                'country_id' => $countries->where('name', 'United Kingdom')->first()?->id ?? $countries->first()->id,
                'zip' => 'W1D 2HG',
                'birthdate' => Carbon::now()->subYears(42),
                'driver_license_number' => 'GB456789123',
                'driver_license_expiration_date' => Carbon::now()->addYears(4),
                'order_status' => OrderStatus::IN_PROGRESS->value,
                'payment_status' => PaymentStatus::PAID->value,
                'payment_method' => 'bank_transfer',
                'payment_reference' => 'BT987654321',
                'notes' => 'Business trip - corporate account',
                'admin_notes' => 'Corporate client - special rates applied',
            ],
        ];

        foreach ($sampleOrders as $orderData) {
            // Calculate rental days
            $pickupDate = Carbon::parse($orderData['pickup_date']);
            $returnDate = Carbon::parse($orderData['return_date']);
            $orderData['rental_days'] = $pickupDate->diffInDays($returnDate) + 1;

            // Calculate amounts
            $pricePackage = PricePackage::find($orderData['price_package_id']);
            $orderData['subtotal_amount'] = $pricePackage->price * $orderData['rental_days'];

            // Handle coupon discount
            if (!empty($orderData['coupon_code'])) {
                $coupon = Coupon::where('coupon_num', $orderData['coupon_code'])->first();
                if ($coupon) {
                    if ($coupon->type == 'percentage') {
                        $orderData['coupon_discount_percentage'] = $coupon->discount;
                        $orderData['coupon_discount_amount'] = ($orderData['subtotal_amount'] * $coupon->discount) / 100;
                        if ($coupon->max_discount && $orderData['coupon_discount_amount'] > $coupon->max_discount) {
                            $orderData['coupon_discount_amount'] = $coupon->max_discount;
                        }
                    } else {
                        $orderData['coupon_discount_amount'] = $coupon->discount;
                    }
                }
            }

            // Calculate total amount
            $orderData['total_amount'] = $orderData['subtotal_amount'] - ($orderData['coupon_discount_amount'] ?? 0);

            // Handle airport locations
            if ($orderData['pickup_location_id']) {
                $pickupLocation = Location::find($orderData['pickup_location_id']);
                $orderData['is_airport_pickup'] = $pickupLocation && $pickupLocation->type == 'airport';
            }

            if ($orderData['return_location_id']) {
                $returnLocation = Location::find($orderData['return_location_id']);
                $orderData['is_airport_return'] = $returnLocation && $returnLocation->type == 'airport';
            }

            $order = Order::create($orderData);

            // Attach some options
            if ($options->isNotEmpty()) {
                $selectedOptions = $options->take(rand(1, 2));
                foreach ($selectedOptions as $option) {
                    $quantity = rand(1, 2);
                    $price = $option->price;
                    $totalPrice = $price * $quantity;

                    if ($option->price_type == 'per_day') {
                        $totalPrice *= $orderData['rental_days'];
                    }

                    $order->options()->attach($option->id, [
                        'quantity' => $quantity,
                        'price' => $price,
                        'total_price' => $totalPrice
                    ]);

                    $orderData['total_amount'] += $totalPrice;
                }
            }

            // Update total amount with options
            $order->update(['total_amount' => $orderData['total_amount']]);
        }

        $this->command->info('Car rental orders seeded successfully!');
    }
}