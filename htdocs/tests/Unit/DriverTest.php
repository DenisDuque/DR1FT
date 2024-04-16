<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_driver_with_hashed_password()
    {
        $driverData = [
            'driverName' => 'John Doe',
            'driverEmail' => 'john@example.com',
            'driverPassword' => 'password123',
            'driverAddress' => '123 Main St',
            'driverBirthDate' => '1990-01-01',
            'driverGender' => 1,
            'driverMember' => 1,
            'driverPro' => 0,
            'driverFederation' => 123456,
        ];

        Driver::create($driverData);

        $this->assertDatabaseHas('drivers', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'birthDate' => '1990-01-01',
            'gender' => 1,
            'member' => 1,
            'pro' => 0,
            'federationNumber' => 123456,
        ]);

        $driver = Driver::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('password123', $driver->password));
    }   
}
