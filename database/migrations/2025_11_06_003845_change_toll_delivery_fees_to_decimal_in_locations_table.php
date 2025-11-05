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
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('toll_delivery_fees');
        });
        
        Schema::table('locations', function (Blueprint $table) {
            $table->decimal('toll_delivery_fees', 10, 2)->nullable()->after('caption');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('toll_delivery_fees');
        });
        
        Schema::table('locations', function (Blueprint $table) {
            $table->json('toll_delivery_fees')->nullable()->after('caption');
        });
    }
};
