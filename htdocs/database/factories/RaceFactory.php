<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
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
            'name' => fake()->randomElement(static::$fakeNames),
            'description' => fake()->name(),
            'map' => 'defaultRaceMap.png',
            'maxParticipants' => fake()->numberBetween(8, 20),
            'length' => fake()->randomFloat(2, 0, 300),
            'banner' => 'defaultRaceBanner.png',
            'date' => fake()->date('d-m-Y'),
            'startingPlace' => fake()->address(),
            'sponsorCost' => fake()->randomFloat(2, 50, 10000),
            'registrationPrice' => fake()->randomFloat(2, 15, 200),
            'active' => fake()->boolean(90)
        ];
    }
}
