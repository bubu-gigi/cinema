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
        Schema::create('film_report_weekly', function (Blueprint $table) {
            $table->id();
            $table->integer('film_id');
            $table->double('weekly_gain');
            $table->integer('tickets_sold');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_report_weekly');
    }
};
