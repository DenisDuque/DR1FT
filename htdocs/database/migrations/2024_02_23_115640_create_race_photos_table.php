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
        Schema::create('race_photos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->integer('raceId');

            $table->foreign('raceId')->references('id')->on('races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_photos');
    }
};
