<?php

namespace Database\Factories;

use App\Models\RaceDriver;
use App\Models\Race;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceDriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener IDs válidos de drivers
        $driverIds = \App\Models\Driver::pluck('id')->toArray();
        
        // Obtener IDs válidos de carreras
        $raceIds = \App\Models\Race::pluck('id')->toArray();

        return [
            'driver_id' => $this->faker->randomElement($driverIds),
            'race_id' => $this->faker->randomElement($raceIds),
            'dorsal' => null,
            'time' => null
        ];
    }
}
