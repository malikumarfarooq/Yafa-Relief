<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->string('cover_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('button_text')->default('Make an Impact');
            $table->string('redirect_url')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('cooldown_hours')->default(6);
            $table->integer('display_order')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('resource_type')->nullable();
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
