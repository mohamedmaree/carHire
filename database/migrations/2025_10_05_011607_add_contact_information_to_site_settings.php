<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add contact information settings
        $contactSettings = [
            ['key' => 'contact_address_ar', 'value' => ''],
            ['key' => 'contact_address_en', 'value' => ''],
            ['key' => 'brochure_file', 'value' => ''],
        ];

        foreach ($contactSettings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keysToRemove = [
            'contact_address_ar',
            'contact_address_en', 
            'brochure_file'
        ];

        \App\Models\SiteSetting::whereIn('key', $keysToRemove)->delete();
    }
};
