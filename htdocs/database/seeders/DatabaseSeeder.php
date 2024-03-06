<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            AdministratorSeeder::class,
            DriverSeeder::class,
            InsuranceSeeder::class,
            SponsorSeeder::class,
            RaceSeeder::class,
            RaceDriverSeeder::class,
            RaceSponsorSeeder::class,
            RaceInsuranceSeeder::class
        ]);
    }
}
