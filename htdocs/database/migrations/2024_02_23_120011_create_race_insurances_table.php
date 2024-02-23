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
        Schema::create('race_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insuranceId');
            $table->unsignedBigInteger('raceId');

            $table->foreign('insuranceId')->references('id')->on('insurances');
            $table->foreign('raceId')->references('id')->on('races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_insurances');
    }
};
