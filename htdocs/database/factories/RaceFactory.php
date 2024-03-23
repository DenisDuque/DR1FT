<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    public static $fakeNames = [
        "OPEN Sydney 2024",
        "PRO Philadelphia 2024",
        "OPEN Worlds 2024"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(static::$fakeNames),
            'description' => $this->faker->name(),
            'map' => 'defaultRaceMap.png',
            'maxParticipants' => $this->faker->numberBetween(8, 20),
            'length' => $this->faker->randomFloat(2, 0, 300),
            'banner' => 'defaultRaceBanner.png',
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'startingPlace' => $this->faker->address(),
            'sponsorCost' => $this->faker->randomFloat(2, 50, 10000),
            'registrationPrice' => $this->faker->randomFloat(2, 15, 200),
            'pro' => $this->faker->boolean(),
            'active' => $this->faker->boolean(90)
        ];
    }
}
