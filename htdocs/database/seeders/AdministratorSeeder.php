<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Administrator;

class AdministratorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Administrator::create([
            'name' => 'Denis Duque',
            'email' => 'denis@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);

        Administrator::create([
            'name' => 'Marina Llambrich',
            'email' => 'marina@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);

        Administrator::factory()->count(10)->create();
    }
}
