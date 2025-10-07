<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add app download links and multilingual text to site_settings
        DB::table('site_settings')->insert([
            // App download links
            ['key' => 'app_google_play_link', 'value' => 'https://play.google.com/store/apps/details?id=com.distinqt.carhire'],
            ['key' => 'app_apple_store_link', 'value' => 'https://apps.apple.com/app/distinqt-car-hire/id123456789'],
            
            // App download section title (multilingual)
            ['key' => 'app_download_title_ar', 'value' => 'حمل تطبيقنا'],
            ['key' => 'app_download_title_en', 'value' => 'DOWNLOAD OUR APP'],
            
            // App download description (multilingual)
            ['key' => 'app_download_description_ar', 'value' => 'تبحث عن تأجير سيارة أثناء التنقل؟ تطبيق DistinQt Car Hire يجعل الحجز سريع وسهل، احجز وأدر تأجير السيارة المثالية من هاتفك الذكي. حجز سلس بضغطة قليلة، ابق مسيطراً من خلال تتبع حجوزاتك وتفاصيل الاستلام.'],
            ['key' => 'app_download_description_en', 'value' => 'Looking for a car rental on the go? The DistinQt Car Hire App makes it quick, easy, book, and manage your perfect vehicle rental all from your smart phone seamless booking with just a few taps, stay in control by tracking your reservations and pick-up details.'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove app download links and multilingual text from site_settings
        DB::table('site_settings')->whereIn('key', [
            'app_google_play_link',
            'app_apple_store_link',
            'app_download_title_ar',
            'app_download_title_en',
            'app_download_description_ar',
            'app_download_description_en'
        ])->delete();
    }
};
