<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cif' => chr(rand(65, 90)).fake()->randomNumber(8),
            'name' => fake()->name(),
            'logo' => 'defaultInsuranceLogo.png',
            'pricePerRace' => fake()->randomFloat(2, 15, 200),
            'address' => fake()->address(),
            'active' => fake()->boolean(90)
        ];
    }
}
