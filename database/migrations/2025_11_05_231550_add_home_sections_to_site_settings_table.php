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
        // Section 1: Transparency Section (No Hidden Fees)
        DB::table('site_settings')->insert([
            ['key' => 'section_transparency_title_ar', 'value' => ''],
            ['key' => 'section_transparency_title_en', 'value' => 'No hidden fees, no unpleasant surprises'],
            ['key' => 'section_transparency_subtitle_ar', 'value' => ''],
            ['key' => 'section_transparency_subtitle_en', 'value' => ''],
            ['key' => 'section_transparency_description_ar', 'value' => ''],
            ['key' => 'section_transparency_description_en', 'value' => 'Renting a car should be simple and straightforward. At DistinQt CarHire, we tell you about all our rates and charges upfront, so you arrive at our counter knowing what to expect.'],
            ['key' => 'section_transparency_file', 'value' => ''],
        ]);

        // Section 2: Damage Liability Section
        DB::table('site_settings')->insert([
            ['key' => 'section_damage_liability_title_ar', 'value' => ''],
            ['key' => 'section_damage_liability_title_en', 'value' => 'When hiring a car, it\'s crucial to find out how much you\'ll pay if the car is damaged'],
            ['key' => 'section_damage_liability_subtitle_ar', 'value' => ''],
            ['key' => 'section_damage_liability_subtitle_en', 'value' => 'Drive with peace of mind'],
            ['key' => 'section_damage_liability_description_ar', 'value' => ''],
            ['key' => 'section_damage_liability_description_en', 'value' => 'Your responsibility for damage to the rental car is $5,000. Our optional $14 a day Damage Fee (for Drivers aged 21-84) reduces your Damage Excess to $0. That\'s right, with Damage Fee you pay nothing in the event of an accident (when you comply with Rental Conditions).'],
            ['key' => 'section_damage_liability_file', 'value' => ''],
        ]);

        // Section 3: Our Story Section
        DB::table('site_settings')->insert([
            ['key' => 'section_our_story_title_ar', 'value' => ''],
            ['key' => 'section_our_story_title_en', 'value' => 'We expect that you\'ll find renting a car from No Birds inexpensive, efficient & trouble-free.'],
            ['key' => 'section_our_story_subtitle_ar', 'value' => ''],
            ['key' => 'section_our_story_subtitle_en', 'value' => 'Your Distinqt Experience'],
            ['key' => 'section_our_story_description_ar', 'value' => ''],
            ['key' => 'section_our_story_description_en', 'value' => 'We provide free delivery to our specified locations. For areas outside these, there\'s a $50 charge. Delivery is limited to within a 25km radius of our headquarters in St Marys.'],
            ['key' => 'section_our_story_file', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'section_transparency_title_ar',
            'section_transparency_title_en',
            'section_transparency_subtitle_ar',
            'section_transparency_subtitle_en',
            'section_transparency_description_ar',
            'section_transparency_description_en',
            'section_transparency_file',
            'section_damage_liability_title_ar',
            'section_damage_liability_title_en',
            'section_damage_liability_subtitle_ar',
            'section_damage_liability_subtitle_en',
            'section_damage_liability_description_ar',
            'section_damage_liability_description_en',
            'section_damage_liability_file',
            'section_our_story_title_ar',
            'section_our_story_title_en',
            'section_our_story_subtitle_ar',
            'section_our_story_subtitle_en',
            'section_our_story_description_ar',
            'section_our_story_description_en',
            'section_our_story_file',
        ])->delete();
    }
};
