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
        Schema::table('hf_jobs', function (Blueprint $table) {
            $table->tinyInteger('worker_completed')->default(0)->after('job_status');
            $table->tinyInteger('client_completed')->default(0)->after('worker_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hf_jobs', function (Blueprint $table) {
            //
        });
    }
};
