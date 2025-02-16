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
        Schema::create('hf_jobs', function (Blueprint $table) {
            $table->bigIncrements('job_id'); // Primary Key
            $table->integer('job_status')->default(1); // 1: Active, 2: Inactive
            $table->unsignedBigInteger('id_customer'); // Foreign Key ref Customers
            $table->string('job_title');
            $table->text('job_desc');
            $table->string('job_location');
            $table->unsignedBigInteger('job_budget');
            $table->unsignedBigInteger('id_currency')->nullable(); // Foreign Key ref Currency
            $table->string('job_photo')->nullable();
            $table->unsignedBigInteger('id_cat'); // Foreign Key ref Category
            $table->bigInteger('id_added')->nullable();
            $table->bigInteger('id_modify')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamp('date_modify')->nullable();
            $table->boolean('is_deleted')->default(false)->comment('1 = deleted');
            $table->bigInteger('id_deleted')->nullable();
            $table->timestamp('date_deleted')->nullable();
            $table->string('ip_deleted')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hf_jobs');
    }
};
