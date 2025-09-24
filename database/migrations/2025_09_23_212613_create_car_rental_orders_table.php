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
        Schema::create('car_rental_orders', function (Blueprint $table) {
            $table->id();
            
            // Location Information
            $table->foreignId('pickup_location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->text('pickup_address')->nullable();
            $table->foreignId('return_location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->text('return_address')->nullable();
            $table->boolean('same_return_location')->default(true);
            $table->boolean('is_airport_pickup')->default(false);
            $table->boolean('is_airport_return')->default(false);
            
            // Date and Time Information
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->date('return_date');
            $table->time('return_time');
            
            // Flight Information (for airport locations)
            $table->date('flight_arrival_date')->nullable();
            $table->time('flight_arrival_time')->nullable();
            $table->string('flight_number_arrival')->nullable();
            $table->string('flight_airline_arrival')->nullable();
            $table->date('flight_departure_date')->nullable();
            $table->time('flight_departure_time')->nullable();
            $table->string('flight_number_departure')->nullable();
            $table->string('flight_airline_departure')->nullable();
            
            // Customer Demographics
            $table->integer('customer_age')->nullable();
            $table->foreignId('customer_country_id')->nullable()->constrained('countries')->onDelete('set null');
            
            // Car and Options
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->foreignId('price_package_id')->nullable()->constrained('price_packages')->onDelete('set null');
            $table->integer('rental_days')->default(1);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('subtotal_amount', 10, 2)->default(0);
            
            // Coupon Information
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount_amount', 10, 2)->default(0);
            $table->decimal('coupon_discount_percentage', 5, 2)->default(0);
            
            // Customer Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->string('zip')->nullable();
            $table->date('birthdate')->nullable();
            
            // Driver License Information
            $table->string('driver_license_number')->nullable();
            $table->date('driver_license_expiration_date')->nullable();
            $table->string('driver_license_image')->nullable();
            
            // International Customer Information
            $table->text('current_country_address')->nullable();
            $table->date('passport_expiration_date')->nullable();
            $table->string('passport_image')->nullable();
            
            // Order Status and Management
            $table->enum('order_status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // User relationship (if customer has account)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['order_status', 'payment_status']);
            $table->index(['pickup_date', 'return_date']);
            $table->index(['car_id', 'order_status']);
            $table->index('email');
            $table->index('phone');
        });
        
        // Create pivot table for order options
        Schema::create('car_rental_order_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('car_rental_orders')->onDelete('cascade');
            $table->foreignId('option_id')->constrained('options')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
            
            $table->unique(['order_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rental_order_options');
        Schema::dropIfExists('car_rental_orders');
    }
};