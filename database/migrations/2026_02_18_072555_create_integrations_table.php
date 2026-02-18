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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();

            // 1. Identification
            $table->string('slug')->unique(); // 'google-pixel', 'stripe-main'
            $table->string('name');
            $table->string('provider'); // google, meta, mailchimp

            // 2. Classification
            // In a new migration or your fresh schema:
            $table->enum('type', ['tracking', 'payment', 'marketing', 'crm', 'email'])->index();

            // 3. Sensitive Data
            // Use 'text' or 'json'. In the Model, use: protected $casts = ['settings' => 'encrypted:json'];
            $table->text('settings')->nullable();

            // 4. Frontend Injection (Optional: separate these if you have many)
            $table->text('head_script')->nullable();
            $table->text('body_script')->nullable();

            // 5. State & Tracking
            $table->boolean('is_active')->default(false)->index();
            $table->timestamp('last_synced_at')->nullable(); // Useful for API-based integrations

            $table->timestamps();
            $table->softDeletes(); // Allow users to "delete" without losing historical log data
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
