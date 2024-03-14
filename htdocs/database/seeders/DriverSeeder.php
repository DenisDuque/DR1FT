<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'name' => 'Denis Duque',
            'email' => 'denis@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('user'),
            'address' => fake()->address(),
            'birthDate' => fake()->date('d-m-Y'),
            'gender' => fake()->boolean(),
            'pro' => fake()->boolean(),
            'member' => fake()->boolean(),
            'federationNumber' => fake()->unique()->randomNumber(7),
            'points' => fake()->numberBetween(0, 10000)
        ]);

        Driver::factory()->count(50)->create();
    }
}
