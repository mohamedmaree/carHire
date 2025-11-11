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
            $table->dropColumn('passport_image');
            $table->string('front_passport_image')->nullable()->after('passport_expiration_date');
            $table->string('back_passport_image')->nullable()->after('front_passport_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->dropColumn(['front_passport_image', 'back_passport_image']);
            $table->string('passport_image')->nullable()->after('passport_expiration_date');
        });
    }
};
