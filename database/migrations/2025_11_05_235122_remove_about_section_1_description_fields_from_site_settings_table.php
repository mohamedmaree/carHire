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
        // Remove about_section_1_description fields if they exist
        // (These were created but we're using existing about_ar/about_en instead)
        DB::table('site_settings')->whereIn('key', [
            'about_section_1_description_ar',
            'about_section_1_description_en',
        ])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-create the fields if needed (optional)
        DB::table('site_settings')->insert([
            ['key' => 'about_section_1_description_ar', 'value' => ''],
            ['key' => 'about_section_1_description_en', 'value' => ''],
        ]);
    }
};
