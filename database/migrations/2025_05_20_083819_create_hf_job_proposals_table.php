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
        Schema::create('hf_job_proposals', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key

            $table->unsignedBigInteger('job_id'); // FK to hf_jobs
            $table->unsignedBigInteger('worker_id'); // FK to users table (login_type = 3)

            $table->unsignedBigInteger('bid_amount'); // User's proposed bid
            $table->text('cover_letter'); // User's message/proposal
            $table->string('attachment')->nullable(); // File path if uploaded

            $table->tinyInteger('status')->default(0)->comment('1: Accepted, 2: Pending, 3: Rejected');

            // Tracking info
            $table->unsignedBigInteger('id_added')->nullable();
            $table->unsignedBigInteger('id_modify')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamp('date_modify')->nullable();

            $table->boolean('is_deleted')->default(false)->comment('1 = deleted');
            $table->unsignedBigInteger('id_deleted')->nullable();
            $table->timestamp('date_deleted')->nullable();
            $table->string('ip_deleted')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hf_job_proposals');
    }
};
