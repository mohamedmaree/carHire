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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status');
            $table->string('eway_transaction_id')->nullable()->after('payment_status');
            $table->string('eway_access_code')->nullable()->after('eway_transaction_id');
            $table->text('eway_response')->nullable()->after('eway_access_code');
            $table->timestamp('paid_at')->nullable()->after('eway_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'eway_transaction_id',
                'eway_access_code',
                'eway_response',
                'paid_at'
            ]);
        });
    }
};
