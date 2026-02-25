<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('button_text')->default('Make an Impact');
            $table->string('redirect_url')->nullable();

            // Status & Settings
            $table->boolean('is_active')->default(false);
            $table->integer('cooldown_hours')->default(6);
            $table->integer('display_order')->default(0);

            // Scheduling
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            // Tracking
            $table->integer('views_count')->default(0);
            $table->integer('clicks_count')->default(0);
            $table->timestamp('last_displayed_at')->nullable();

            // Resource/Program linking (optional - if you want to keep the linking feature)
            $table->string('resource_type')->nullable(); // 'program' or 'resource'
            $table->unsignedBigInteger('resource_id')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['is_active', 'starts_at', 'ends_at']);
            $table->index('display_order');
            $table->index(['resource_type', 'resource_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('popups');
    }
};
