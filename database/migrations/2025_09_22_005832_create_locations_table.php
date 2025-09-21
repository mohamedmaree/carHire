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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // Location name like "Sydney Domestic Airport", "Moorenank"
            $table->text('address'); // Full address
            $table->decimal('lat', 10, 8)->nullable(); // Latitude coordinate
            $table->decimal('lng', 11, 8)->nullable(); // Longitude coordinate
            $table->enum('type', ['airport', 'location']); // Type: airport or regular location
            $table->json('working_days')->nullable(); // Array of working days ['monday', 'tuesday', etc.]
            $table->string('working_hours')->nullable(); // Working hours like "10:00 AM - 10:00PM"
            $table->json('holiday_days')->nullable(); // Array of holiday days
            $table->string('holiday_hours')->nullable(); // Holiday hours like "10:00 AM - 10:00PM"
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
        Schema::dropIfExists('locations');
    }
};