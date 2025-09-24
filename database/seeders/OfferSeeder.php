<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Coupon;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some sample coupons
        $coupons = Coupon::where('status', 'active')->take(3)->get();

        $sampleOffers = [
            [
                'title' => [
                    'ar' => 'وفر مع عروض الشتاء',
                    'en' => 'Hit the Road with Winter Savings'
                ],
                'description' => [
                    'ar' => 'استمتع بالشتاء واجعل رحلتك مثالية. احجز حتى 28 يوليو وسافر حتى 15 ديسمبر 2025. استفد من مغامراتك في أستراليا مع Distinqt واستمتع بخصم يصل إلى 20% عند حجز مركبة لمدة 5 أيام أو أكثر.',
                    'en' => 'Enjoy winter and hit the road with the perfect car. Book until Jul 28 and travel until December 15, 2025. Make the most of your Australia adventures with Distinqt and enjoy up to 20% off when you book a vehicle for 5 days or more.'
                ],
                'discount_amount' => 20.00,
                'coupon_id' => $coupons->isNotEmpty() ? $coupons->first()->id : null,
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(30),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'عروض المطار الخاصة',
                    'en' => 'Special Airport Offers'
                ],
                'description' => [
                    'ar' => 'احجز الآن واحصل على خصم 15% على جميع رحلات المطار لمدة 24 ساعة. مثالي للمسافرين الدوليين والمحليين.',
                    'en' => 'Book now and get a 15% discount on all airport trips for 24 hours. Perfect for international and domestic travelers.'
                ],
                'discount_amount' => 15.00,
                'coupon_id' => $coupons->count() > 1 ? $coupons->skip(1)->first()->id : null,
                'start_date' => now()->addDays(2),
                'end_date' => now()->addDays(15),
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'عرض نهاية الأسبوع',
                    'en' => 'Weekend Special'
                ],
                'description' => [
                    'ar' => 'استمتع بعطلة نهاية أسبوع رائعة مع خصم 10% على جميع الحجوزات لعطلة نهاية الأسبوع. صالح للاستخدام يومي الجمعة والسبت والأحد.',
                    'en' => 'Enjoy a fantastic weekend getaway with 10% off all weekend bookings. Valid for Friday, Saturday, and Sunday rentals.'
                ],
                'discount_amount' => 10.00,
                'coupon_id' => $coupons->count() > 2 ? $coupons->last()->id : null,
                'start_date' => now()->addDays(3),
                'end_date' => now()->addDays(7),
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($sampleOffers as $offerData) {
            Offer::create($offerData);
        }

        $this->command->info('Offers seeded successfully!');
    }
}