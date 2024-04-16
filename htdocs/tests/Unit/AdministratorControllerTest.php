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
        // Creamos un administrador de prueba
        $administrator = Administrator::create([
            'name' => 'Marina',
            'email' => 'marina@gmail.com',
            'password'=> Hash::make('admin'),
        ]);

        // Hacemos una solicitud de autenticación con las credenciales válidas
        $response = $this->post(route('admin.login'), [
            'email' => 'marina@gmail.com',
            'password' => 'admin',
        ]);

        // Verificamos que el usuario haya sido autenticado y redirigido correctamente
        $this->assertTrue(Auth::guard('admin')->check());
        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    
    public function it_does_not_authenticate_administrator_with_invalid_credentials()
    {
        // Creamos un administrador de prueba
        $administrator = Administrator::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // Hacemos una solicitud de autenticación con credenciales inválidas
        $response = $this->post(route('admin.login'), [
            'email' => 'admin@gmail.com',
            'password' => 'wrongpassword',
        ]);

        // Verificamos que la autenticación haya fallado y que se redirija a la página de inicio de sesión
        $this->assertFalse(Auth::guard('admin')->check());
    }
    
}
