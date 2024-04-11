<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Race extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'map', 
        'maxParticipants', 
        'length', 
        'banner', 
        'date', 
        'startingPlace', 
        'sponsorCost', 
        'registrationPrice',
        'pro',
        'active'
    ];
    
    public function drivers() {
        return $this->belongsToMany(Driver::class, 'race_driver')->withPivot('dorsal', 'time');
    }

    public function insurances() {
        return $this->belongsToMany(Insurance::class, 'race_insurance');
    }

    public function photos() {
        return $this->hasMany(Image::class);
    }

    public function sponsors() {
        return $this->belongsToMany(Sponsor::class)->withPivot('mainSponsor');
    }

    public static function getRaceClassification($raceId) {
        $raceDrivers = RaceDriver::where('race_id', $raceId)
            ->whereNotNull('time')
            ->orderBy('time', 'asc')
            ->get();
        
        foreach ($raceDrivers as $raceDriver) {
            $raceDriver->driver->birthDate = Carbon::createFromFormat('d-m-Y', $raceDriver->driver->birthDate);
        }

        return $raceDrivers;
    }
    

    use HasFactory;
}
