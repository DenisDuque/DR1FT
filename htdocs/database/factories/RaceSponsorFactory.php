<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RaceSponsor>
 */
class RaceSponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    
    
    public function definition(): array
    {
        // Obtener IDs válidos de drivers
        $sponsorIds = \App\Models\Sponsor::pluck('id')->toArray();
        
        // Obtener IDs válidos de carreras
        $raceIds = \App\Models\Race::pluck('id')->toArray();

        return [
            'sponsor_id' => $this->faker->randomElement($sponsorIds),
            'race_id' => $this->faker->randomElement($raceIds),
            'mainSponsor' => fake()->boolean(),
        ];
    }
}
