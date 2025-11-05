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
        // Add about_2 fields for Section 2 description
        DB::table('site_settings')->insert([
            ['key' => 'about_2_ar', 'value' => ''],
            ['key' => 'about_2_en', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'about_2_ar',
            'about_2_en',
        ])->delete();
    }
};
