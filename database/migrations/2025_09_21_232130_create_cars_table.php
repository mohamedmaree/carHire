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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // Car type like "5 Seat SUV"
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('seats'); // Number of seats
            $table->integer('bags'); // Number of bags/luggage capacity
            $table->enum('transmission', ['auto', 'manual']); // Transmission type
            $table->string('brand')->nullable(); // Car brand
            $table->string('model')->nullable(); // Car model
            $table->year('year')->nullable(); // Manufacturing year
            $table->string('fuel_type')->nullable(); // Fuel type
            $table->string('engine_size')->nullable(); // Engine size in liters
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
