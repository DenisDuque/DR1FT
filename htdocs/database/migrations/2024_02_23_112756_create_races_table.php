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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('map');
            $table->integer('maxParticipants');
            $table->float('length');
            $table->string('banner');
            $table->dateTime('date');
            $table->string('startingPlace');
            $table->float('sponsorCost');
            $table->float('registrationPrice');
            $table->boolean('pro');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
