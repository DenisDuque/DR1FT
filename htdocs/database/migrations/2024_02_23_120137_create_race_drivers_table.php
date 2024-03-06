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
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('raceId');
            $table->integer('dorsal')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();

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
