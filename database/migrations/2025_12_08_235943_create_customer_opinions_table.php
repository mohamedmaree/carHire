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
        Schema::create('customer_opinions', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // Profile picture
            $table->text('name'); // Reviewer name (translatable)
            $table->text('opinion_text'); // Review text (translatable)
            $table->integer('num_stars')->default(5); // Rating (1-5 stars)
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
        Schema::dropIfExists('customer_opinions');
    }
};
