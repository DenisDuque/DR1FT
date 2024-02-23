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
        Schema::create('race_drivers', function (Blueprint $table) {
            $table->id();
            $table->integer('driverId');
            $table->integer('raceId');
            $table->integer('dorsal')->nullable();
            $table->timestamp('time')->nullable();

            $table->foreign('driverId')->references('id')->on('drivers');
            $table->foreign('raceId')->references('id')->on('races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_drivers');
    }
};
