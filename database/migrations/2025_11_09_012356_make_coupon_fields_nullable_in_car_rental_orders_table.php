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
            $table->decimal('coupon_discount_amount', 10, 2)->nullable()->change();
            $table->decimal('coupon_discount_percentage', 5, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->decimal('coupon_discount_amount', 10, 2)->default(0)->change();
            $table->decimal('coupon_discount_percentage', 5, 2)->default(0)->change();
        });
    }
};
