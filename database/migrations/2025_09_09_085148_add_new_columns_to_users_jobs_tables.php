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
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_account_id')->nullable();
        });
        
        Schema::table('hf_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id')->after('id_customer')->nullable();
            $table->integer('job_amount'); // amount in cents
            $table->string('currency')->default('pkr');
            $table->enum('payment_status',['unpaid','paid','released'])->default('unpaid');
            $table->string('checkout_session_id')->nullable();
            $table->string('payment_intent_id')->nullable();
        });

        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('worker_id');
            $table->integer('amount'); // amount transferred
            $table->string('currency')->default('usd');
            $table->string('stripe_transfer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_jobs_tables', function (Blueprint $table) {
            //
        });
    }
};
