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
            $table->string('eway_transaction_id')->nullable()->after('payment_reference');
            $table->string('eway_access_code')->nullable()->after('eway_transaction_id');
            $table->text('eway_response')->nullable()->after('eway_access_code');
            $table->timestamp('paid_at')->nullable()->after('eway_response');
            
            // Update payment_status enum to include cancelled
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_orders', function (Blueprint $table) {
            $table->dropColumn([
                'eway_transaction_id',
                'eway_access_code',
                'eway_response',
                'paid_at'
            ]);
            
            // Revert payment_status enum
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])
                  ->default('pending')
                  ->change();
        });
    }
};
