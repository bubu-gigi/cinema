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
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('base_seats')->nullable;
            $table->integer('sold_base_seats')->default(0);
            $table->integer('vip_seats')->nullable;
            $table->integer('sold_vip_seats')->default(0);
            $table->integer('film_id')->nullable;
            $table->integer('remote_id')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
