<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\PricePackage;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample cars based on the UI design
        $cars = [
            [
                'name' => '5 Seat SUV',
                'description' => 'Comfortable 5-seater SUV perfect for family trips',
                'seats' => 5,
                'bags' => 3,
                'transmission' => 'auto',
                'brand' => 'Suzuki',
                'model' => 'Baleno',
                'year' => 2023,
                'fuel_type' => 'Petrol',
                'engine_size' => 1.4,
                'is_active' => true,
                'sort_order' => 1,
                'price_packages' => [
                    [
                        'name' => 'Limited Kilometers',
                        'description' => 'Best for City Use',
                        'price' => 168.00,
                        'kilometer_limit' => 100,
                        'is_unlimited' => false,
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Unlimited Kilometers',
                        'description' => 'Best for Long Distance',
                        'price' => 239.00,
                        'kilometer_limit' => null,
                        'is_unlimited' => true,
                        'is_active' => true,
                        'sort_order' => 2,
                    ]
                ]
            ],
            [
                'name' => '7 Seat SUV',
                'description' => 'Spacious 7-seater SUV ideal for large families',
                'seats' => 7,
                'bags' => 5,
                'transmission' => 'auto',
                'brand' => 'Toyota',
                'model' => 'Highlander',
                'year' => 2023,
                'fuel_type' => 'Petrol',
                'engine_size' => 2.5,
                'is_active' => true,
                'sort_order' => 2,
                'price_packages' => [
                    [
                        'name' => 'Limited Kilometers',
                        'description' => 'Best for City Use',
                        'price' => 220.00,
                        'kilometer_limit' => 100,
                        'is_unlimited' => false,
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Unlimited Kilometers',
                        'description' => 'Best for Long Distance',
                        'price' => 320.00,
                        'kilometer_limit' => null,
                        'is_unlimited' => true,
                        'is_active' => true,
                        'sort_order' => 2,
                    ]
                ]
            ],
            [
                'name' => '4 Seat Sedan',
                'description' => 'Elegant sedan perfect for business trips',
                'seats' => 4,
                'bags' => 2,
                'transmission' => 'manual',
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => 2023,
                'fuel_type' => 'Petrol',
                'engine_size' => 1.6,
                'is_active' => true,
                'sort_order' => 3,
                'price_packages' => [
                    [
                        'name' => 'Limited Kilometers',
                        'description' => 'Best for City Use',
                        'price' => 120.00,
                        'kilometer_limit' => 100,
                        'is_unlimited' => false,
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Unlimited Kilometers',
                        'description' => 'Best for Long Distance',
                        'price' => 180.00,
                        'kilometer_limit' => null,
                        'is_unlimited' => true,
                        'is_active' => true,
                        'sort_order' => 2,
                    ]
                ]
            ]
        ];

        foreach ($cars as $carData) {
            $pricePackages = $carData['price_packages'];
            unset($carData['price_packages']);
            
            $car = Car::create($carData);
            
            foreach ($pricePackages as $packageData) {
                $car->pricePackages()->create($packageData);
            }
        }
    }
}