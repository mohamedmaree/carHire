<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample options based on the UI design
        $options = [
            [
                'name' => 'Delivery Fee',
                'description' => 'If the site is more than 5 km away from the specified locations',
                'price' => 5.00,
                'price_type' => 'per_day',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Extend Area of Use',
                'description' => 'To include Victoria & Queensland-South-of-Bundaberg.',
                'price' => 120.00,
                'price_type' => 'flat_fee',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sat Nav (GPS)',
                'description' => 'Don\'t get lost. Max charge $60.',
                'price' => 5.00,
                'price_type' => 'per_day',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Damage Waiver',
                'description' => 'Reduces Damage Fee from $5,500 to $2500 by adding damage waiver.',
                'price' => 5.00,
                'price_type' => 'per_day',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Snow Cover',
                'description' => 'To include Cooma, Jindabyne, Perisher, Selwyn & Thredbo.',
                'price' => 28.00,
                'price_type' => 'flat_fee',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Child Seat',
                'description' => 'Child Seats, Capsules and Boosters. Choose on arrival. Max $96 each.',
                'price' => 5.00,
                'price_type' => 'per_day',
                'is_active' => true,
                'sort_order' => 6,
            ]
        ];

        foreach ($options as $optionData) {
            Option::create($optionData);
        }
    }
}