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
        // In migration file
        Schema::table('worker_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('worker_profiles', function (Blueprint $table) {
            //
        });
    }
};
