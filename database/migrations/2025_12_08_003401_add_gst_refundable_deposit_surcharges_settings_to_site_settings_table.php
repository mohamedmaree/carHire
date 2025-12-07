<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add default settings for GST, Refundable Deposit, and Surcharges Fee
        $settings = [
            ['key' => 'gst_percentage', 'value' => '10'], // 10% GST
            ['key' => 'refundable_deposit', 'value' => '500'], // $500 Refundable Deposit
            ['key' => 'surcharges_fee_percentage', 'value' => '1.5'], // 1.5% Surcharges Fee
        ];
        
        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
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
        SiteSetting::whereIn('key', ['gst_percentage', 'refundable_deposit', 'surcharges_fee_percentage'])->delete();
    }
};
