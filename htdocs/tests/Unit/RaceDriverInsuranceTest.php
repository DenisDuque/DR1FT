<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\RaceDriverInsurance;
use App\Models\Driver;
use App\Models\Race;
use App\Models\Insurance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class RaceDriverInsuranceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_top_insurances()
    {
        $driver1 = Driver::factory()->create();
        $driver2 = Driver::factory()->create();
        $driver3 = Driver::factory()->create();

        $race1 = Race::factory()->create();
        $race2 = Race::factory()->create();
        $race3 = Race::factory()->create();

        $insurance1 = Insurance::factory()->create(['name' => 'Insurance 1']);
        $insurance2 = Insurance::factory()->create(['name' => 'Insurance 2']);
        $insurance3 = Insurance::factory()->create(['name' => 'Insurance 3']);

        RaceDriverInsurance::factory()->create(['driver_id' => $driver1->id, 'race_id' => $race1->id, 'insurance_id' => $insurance1->id]);
        RaceDriverInsurance::factory()->create(['driver_id' => $driver2->id, 'race_id' => $race2->id, 'insurance_id' => $insurance1->id]);
        RaceDriverInsurance::factory()->create(['driver_id' => $driver3->id, 'race_id' => $race3->id, 'insurance_id' => $insurance2->id]);

        $topInsurances = RaceDriverInsurance::getTopInsurances(2);

        $this->assertCount(2, $topInsurances);

        $this->assertEquals('Insurance 1', $topInsurances[0]->name); // Debería ser Insurance 1
        $this->assertEquals('Insurance 2', $topInsurances[1]->name); // Debería ser Insurance 2
    }
}
