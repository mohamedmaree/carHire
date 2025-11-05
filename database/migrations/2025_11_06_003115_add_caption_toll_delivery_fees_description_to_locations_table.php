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
        Schema::table('locations', function (Blueprint $table) {
            $table->json('caption')->nullable()->after('address');
            $table->decimal('toll_delivery_fees', 10, 2)->nullable()->after('caption');
            $table->json('description')->nullable()->after('toll_delivery_fees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['caption', 'toll_delivery_fees', 'description']);
        });
    }
};
