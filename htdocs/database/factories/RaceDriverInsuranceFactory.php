<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RaceDriverInsurance>
 */
class RaceDriverInsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $driverIds = \App\Models\Driver::pluck('id')->toArray();
        
        $raceIds = \App\Models\Race::pluck('id')->toArray();

        $insuranceIds = \App\Models\Insurance::pluck('id')->toArray();

        return [
            'driver_id' => $this->faker->randomElement($driverIds),
            'race_id' => $this->faker->randomElement($raceIds),
            'insurance_id' => $this->faker->randomElement($insuranceIds)
        ];
    }
}
