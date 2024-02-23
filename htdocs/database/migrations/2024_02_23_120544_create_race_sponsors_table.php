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
        Schema::create('race_sponsors', function (Blueprint $table) {
            $table->id();
            $table->integer('sponsorId');
            $table->integer('raceId');
            $table->boolean('mainSponsor');

            $table->foreign('sponsorId')->references('id')->on('sponsors');
            $table->foreign('raceId')->references('id')->on('races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_sponsors');
    }
};
