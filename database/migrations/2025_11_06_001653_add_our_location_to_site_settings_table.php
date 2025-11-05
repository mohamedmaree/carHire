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
        // Add Our Location fields
        DB::table('site_settings')->insert([
            ['key' => 'our_location_title_ar', 'value' => ''],
            ['key' => 'our_location_title_en', 'value' => 'Our Location'],
            ['key' => 'our_location_description_ar', 'value' => ''],
            ['key' => 'our_location_description_en', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'our_location_title_ar',
            'our_location_title_en',
            'our_location_description_ar',
            'our_location_description_en',
        ])->delete();
    }
};
