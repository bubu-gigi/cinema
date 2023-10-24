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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('release_date')->nullable();
            $table->integer('remote_id');
            $table->string('time')->nullable();
            $table->integer('pellicole')->nullable();
            $table->float('daily_gain')->default(0)->nullable();
            $table->float('tot_gain')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
