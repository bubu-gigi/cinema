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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->integer('base_amount')->nullable();
            $table->integer('initial_base_amount')->nullable();
            $table->integer('vip_amount')->nullable();
            $table->integer('initial_vip_amount')->nullable();
            $table->integer('percentage_increase')->nullable();
            $table->integer('film_id');
            $table->integer('remote_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
