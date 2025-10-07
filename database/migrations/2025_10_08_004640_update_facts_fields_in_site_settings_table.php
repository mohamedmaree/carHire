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
        // Add new simplified facts fields
        DB::table('site_settings')->insert([
            ['key' => 'happy_customers', 'value' => '3K+'],
            ['key' => 'vip_members', 'value' => '2K+'],
            ['key' => 'reviews', 'value' => '400+'],
            ['key' => 'years_experience', 'value' => '5+'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove new facts fields
        DB::table('site_settings')->whereIn('key', [
            'happy_customers', 'vip_members', 'reviews', 'years_experience'
        ])->delete();
    }
};
