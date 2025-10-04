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
            $table->string('client_signature')->nullable()->after('passport_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->dropColumn('client_signature');
        });
    }
};
