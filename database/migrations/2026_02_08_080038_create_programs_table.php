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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Media
            $table->string('thumbnail')->nullable();
            $table->string('cover_image')->nullable();

            // Financials
            $table->decimal('goal_amount', 15, 2);
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->decimal('min_amount', 15, 2)->nullable();
            $table->json('amount_options')->nullable(); // Changed to JSON

            // Stats & Data
            $table->unsignedInteger('donors_count')->default(0); // Unsigned as it's never negative
            $table->json('promises')->nullable();
            $table->text('legacy_message')->nullable();

            // Flags
            $table->boolean('is_featured')->default(false)->index(); // Added index for faster filtering
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_recurring_allowed')->default(false);
            $table->boolean('is_urgent')->default(false); // New flag for urgent programs

            // Timeline & Relations
            $table->dateTime('start_date'); // Changed to dateTime
            $table->dateTime('end_date');
            $table->json('associated_category_ids')->nullable(); // Changed to array for multiple categories
            $table->json('associated_attribute_ids')->nullable(); // Changed to array for multiple attributes

            $table->timestamps();
            $table->softDeletes(); // Optional: Usually good for financial/donation records
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
