<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Administrator;
use App\Http\Controllers\AdministratorController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministratorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_authenticates_administrator_with_valid_credentials()
    {
        $administrator = Administrator::create([
            'name' => 'Marina',
            'email' => 'marina@gmail.com',
            'password'=> Hash::make('admin'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'marina@gmail.com',
            'password' => 'admin',
        ]);

        $this->assertTrue(Auth::guard('admin')->check());
        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    
    public function it_does_not_authenticate_administrator_with_invalid_credentials()
    {
        $administrator = Administrator::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'admin@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertFalse(Auth::guard('admin')->check());
    }
    
}
