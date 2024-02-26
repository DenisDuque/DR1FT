<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(fake()->password(8, 20)),
            'address' => fake()->address(),
            'birthDate' => fake()->date('d-m-Y'),
            'gender' => fake()->boolean(),
            'pro' => fake()->boolean(),
            'member' => fake()->boolean(),
            'federationNumber' => fake()->unique()->randomNumber(7),
            'points' => fake()->numberBetween(0, 10000)
        ];
    }
}
