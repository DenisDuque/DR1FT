<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RaceInsurance>
 */
class RaceInsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener IDs válidos de drivers
        $insuranceIds = \App\Models\Insurance::pluck('id')->toArray();
        
        // Obtener IDs válidos de carreras
        $raceIds = \App\Models\Race::pluck('id')->toArray();

        return [
            'insuranceId' => $this->faker->randomElement($insuranceIds),
            'raceId' => $this->faker->randomElement($raceIds)
        ];
    }
}
