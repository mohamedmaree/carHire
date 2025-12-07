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
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->decimal('gst', 10, 2)->nullable()->after('subtotal_amount')->comment('GST amount (percentage of subtotal)');
            $table->decimal('refundable_deposit', 10, 2)->nullable()->after('gst')->comment('Refundable deposit amount');
            $table->decimal('surcharges_fee', 10, 2)->nullable()->after('refundable_deposit')->comment('Surcharges fee amount (percentage of subtotal)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->dropColumn(['gst', 'refundable_deposit', 'surcharges_fee']);
        });
    }
};
