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
            $table->dropColumn('driver_license_image');
            $table->string('front_driver_license_image')->nullable()->after('driver_license_expiration_date');
            $table->string('back_driver_license_image')->nullable()->after('front_driver_license_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->dropColumn(['front_driver_license_image', 'back_driver_license_image']);
            $table->string('driver_license_image')->nullable()->after('driver_license_expiration_date');
        });
    }
};
