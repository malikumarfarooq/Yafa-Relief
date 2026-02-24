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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donation_number')->unique();
            $table->integer('year_sequence');

            // Donor info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');

            // Payment
            $table->string('payment_method'); // card, paypal, bank
            $table->string('payment_status')->default('draft');
            // draft, pending, paid, failed, cancelled

            $table->string('transaction_id')->nullable();
            $table->string('payment_provider')->nullable();
            // stripe, paypal

            // Amount
            $table->decimal('total_amount', 12, 2);

            // Frequency
            $table->string('frequency')->nullable();
            // one-time, monthly, yearly

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
