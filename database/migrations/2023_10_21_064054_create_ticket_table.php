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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->float('vip_price')->nullable();
            $table->integer('percentage_increase')->nullable();
            $table->integer('film_id');
            $table->string('film_title')->nullable();
            $table->integer('hall_id')->nullable();
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
