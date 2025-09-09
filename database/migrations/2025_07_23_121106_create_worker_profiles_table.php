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
        Schema::create('worker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('headline')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->nullable()->constrained('cities');
            $table->string('phone')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('tagline')->nullable();
            $table->integer('experience_years')->nullable();
            $table->enum('availability', ['available', 'not_available'])->default('available');
            $table->string('working_hours')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_profiles');
    }
};
