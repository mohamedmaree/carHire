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
        // About Section 1: Welcome to Distinqt Car Hire
        // Note: Section 1 description uses existing 'about_ar' and 'about_en' fields
        DB::table('site_settings')->insert([
            ['key' => 'about_section_1_title_ar', 'value' => ''],
            ['key' => 'about_section_1_title_en', 'value' => 'Welcome to Distinqt Car Hire'],
            ['key' => 'about_section_1_image', 'value' => ''],
        ]);

        // About Section 2: Meet Distinqt Car Hire, Your Road Trip Partner
        // Note: Section 2 description uses 'about_2_ar' and 'about_2_en' fields
        DB::table('site_settings')->insert([
            ['key' => 'about_section_2_title_ar', 'value' => ''],
            ['key' => 'about_section_2_title_en', 'value' => 'Meet Distinqt Car Hire, Your Road Trip Partner'],
            ['key' => 'about_section_2_image', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'about_section_1_title_ar',
            'about_section_1_title_en',
            'about_section_1_image',
            'about_section_2_title_ar',
            'about_section_2_title_en',
            'about_section_2_image',
        ])->delete();
    }
};
