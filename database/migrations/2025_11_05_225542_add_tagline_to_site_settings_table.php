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
        // Add tagline multilingual fields to site_settings
        DB::table('site_settings')->insert([
            ['key' => 'tagline_ar', 'value' => 'شعارك الإعلاني هنا'],
            ['key' => 'tagline_en', 'value' => 'Your tagline here'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', ['tagline_ar', 'tagline_en'])->delete();
    }
};
