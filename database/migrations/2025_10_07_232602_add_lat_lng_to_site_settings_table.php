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
        // Add latitude and longitude settings as key-value pairs
        DB::table('site_settings')->insertOrIgnore([
            ['key' => 'contact_address_lat', 'value' => '24.7135517', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_address_lng', 'value' => '46.6752957', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove latitude and longitude settings
        DB::table('site_settings')->whereIn('key', ['contact_address_lat', 'contact_address_lng'])->delete();
    }
};
