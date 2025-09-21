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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // Option name like "Snow Cover", "Child Seat", "Damage Waiver"
            $table->text('description'); // Detailed description
            $table->string('icon')->nullable(); // Icon for the option
            $table->decimal('price', 10, 2); // Price for the option
            $table->enum('price_type', ['per_day', 'flat_fee']); // Price calculation type
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
        Schema::dropIfExists('options');
    }
};
