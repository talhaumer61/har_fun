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
        Schema::create('worker_portfolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK to users table
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Portfolio image (stored path)
            $table->string('external_link')->nullable(); // Optional: a project link
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_portfolios');
    }
};
