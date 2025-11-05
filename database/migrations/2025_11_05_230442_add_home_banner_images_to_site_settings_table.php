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
        // Add home banner image fields to site_settings
        // We'll create 3 banner slots for flexibility
        DB::table('site_settings')->insert([
            ['key' => 'home_banner_1', 'value' => ''],
            ['key' => 'home_banner_2', 'value' => ''],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', ['home_banner_1', 'home_banner_2', 'home_banner_3'])->delete();
    }
};
