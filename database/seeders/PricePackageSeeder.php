<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricePackage;
use App\Models\Car;

class PricePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = Car::active()->get();
        
        if ($cars->isEmpty()) {
            $this->command->warn('Please seed cars first!');
            return;
        }

        foreach ($cars as $car) {
            // Create different price packages for each car
            $packages = [
                [
                    'name' => [
                        'ar' => 'حزمة المدينة - 100 كم/يوم',
                        'en' => 'City Package - 100 Km/Day'
                    ],
                    'description' => [
                        'ar' => 'مثالية للاستخدام داخل المدينة مع حد أقصى 100 كم في اليوم',
                        'en' => 'Perfect for city use with maximum 100 km per day'
                    ],
                    'price' => rand(50, 100),
                    'kilometer_limit' => 100,
                    'is_unlimited' => false,
                    'is_active' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => [
                        'ar' => 'حزمة غير محدودة',
                        'en' => 'Unlimited Package'
                    ],
                    'description' => [
                        'ar' => 'قيادة غير محدودة بدون قيود على المسافة',
                        'en' => 'Unlimited driving with no distance restrictions'
                    ],
                    'price' => rand(80, 150),
                    'kilometer_limit' => null,
                    'is_unlimited' => true,
                    'is_active' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => [
                        'ar' => 'حزمة المسافات الطويلة - 300 كم/يوم',
                        'en' => 'Long Distance Package - 300 Km/Day'
                    ],
                    'description' => [
                        'ar' => 'مناسبة للرحلات الطويلة مع حد أقصى 300 كم في اليوم',
                        'en' => 'Suitable for long trips with maximum 300 km per day'
                    ],
                    'price' => rand(70, 120),
                    'kilometer_limit' => 300,
                    'is_unlimited' => false,
                    'is_active' => true,
                    'sort_order' => 3,
                ],
            ];

            foreach ($packages as $packageData) {
                $packageData['car_id'] = $car->id;
                PricePackage::create($packageData);
            }
        }

        $this->command->info('Price packages seeded successfully!');
    }
}