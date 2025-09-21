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
        Schema::create('price_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Package name like "Limited Kilometers" or "Unlimited Kilometers"
            $table->text('description')->nullable(); // Description like "Best for City Use"
            $table->decimal('price', 10, 2); // Price per day
            $table->integer('kilometer_limit')->nullable(); // NULL for unlimited, number for limited
            $table->boolean('is_unlimited')->default(false); // Flag for unlimited kilometers
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
        Schema::dropIfExists('price_packages');
    }
};
