<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Airports
            [
                'name' => [
                    'en' => 'Sydney Domestic Airport',
                    'ar' => 'مطار سيدني المحلي'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'airport',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => [
                    'en' => 'Sydney International Airport',
                    'ar' => 'مطار سيدني الدولي'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'airport',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 2,
            ],
            // Regular Locations
            [
                'name' => [
                    'en' => 'Moorenank',
                    'ar' => 'موربانك'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'location',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => [
                    'en' => 'Mc Donalds at Liverpool',
                    'ar' => 'ماكدونالدز في ليفربول'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'location',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => [
                    'en' => 'Marsden Park',
                    'ar' => 'مارسدن بارك'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'location',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => [
                    'en' => 'Merrylands',
                    'ar' => 'ميريلاندز'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'location',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => [
                    'en' => 'North Parramatta',
                    'ar' => 'شمال باراماتا'
                ],
                'address' => [
                    'en' => '90 Heathcote Rd, Moorebank NSW 2170, Australia',
                    'ar' => '90 طريق هيثكوت، موربانك NSW 2170، أستراليا'
                ],
                'lat' => -33.9399,
                'lng' => 151.1753,
                'type' => 'location',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'working_hours' => '10:00 AM - 10:00PM',
                'holiday_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
                'holiday_hours' => '10:00 AM - 10:00PM',
                'is_active' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($locations as $locationData) {
            Location::create($locationData);
        }
    }
}