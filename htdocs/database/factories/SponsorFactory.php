<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
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
            'logo' => 'defaultSponsorLogo.png',
            'address' => fake()->address(),
            'active' => fake()->boolean(90)
        ];
    }
}
