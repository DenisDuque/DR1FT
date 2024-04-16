<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Race;
use App\Models\RaceDriver;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_race_classification_ordered_by_time()
    {
        $race = Race::factory()->create();

        $driversData = [
            ['name' => 'Driver 1', 'time' => '10:00:00'],
            ['name' => 'Driver 2', 'time' => '09:30:00'],
            ['name' => 'Driver 3', 'time' => '11:00:00'],
        ];

        foreach ($driversData as $driverData) {
            $driver = Driver::factory()->create(['name' => $driverData['name']]);
            RaceDriver::factory()->create([
                'race_id' => $race->id,
                'driver_id' => $driver->id,
                'time' => $driverData['time'],
            ]);
        }

        $classification = Race::getRaceClassification($race->id);

        $this->assertEquals('Driver 2', $classification[0]->driver->name); // Debería ser Driver 2
        $this->assertEquals('Driver 1', $classification[1]->driver->name); // Debería ser Driver 1
        $this->assertEquals('Driver 3', $classification[2]->driver->name); // Debería ser Driver 3
    }
}
