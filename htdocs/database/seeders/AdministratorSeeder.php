<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        \App\Models\Administrator::factory()->create([
            'name' => 'Default Admin',
            'email' => 'admin@example.com',
            'password' => 'admin'
        ]);
        */
        \App\Models\Administrator::factory()->count(10)->create();
    }
}
