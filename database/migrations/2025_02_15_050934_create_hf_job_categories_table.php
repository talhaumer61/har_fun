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
        Schema::create('hf_job_categories', function (Blueprint $table) {
            $table->bigIncrements('cat_id'); // Primary Key
            $table->integer('cat_status')->comment('1: Active, 2: Inactive');
            $table->string('cat_name')->nullable();
            $table->string('cat_href'); // Required (not nullable)
            $table->string('cat_icon')->nullable();
            $table->text('cat_desc')->nullable();
            $table->text('cat_detail')->nullable();
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
        Schema::dropIfExists('hf_job_categories');
    }
};
