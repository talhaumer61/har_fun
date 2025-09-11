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
        Schema::create('hf_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // who paid
            $table->unsignedBigInteger('worker_id'); // who will receive payout
            $table->unsignedBigInteger('job_id'); // related job
            $table->decimal('amount', 10, 2); // total payment amount
            $table->decimal('commission', 10, 2)->default(0.00); // your platform fee
            $table->decimal('worker_amount', 10, 2)->default(0.00); // payout to worker
            $table->string('payment_intent_id')->nullable(); // from Stripe
            $table->string('currency')->nullable(); // Stripe charge
            $table->string('charge_id')->nullable(); // Stripe charge
            $table->string('transfer_id')->nullable(); // Stripe transfer for worker
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hf_payments');
    }
};
