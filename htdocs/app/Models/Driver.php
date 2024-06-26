<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Driver extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'address', 
        'birthDate', 
        'gender', 
        'pro', 
        'member', 
        'federationNumber', 
        'points'
    ];

    public function races() {
        return $this->belongsToMany(Race::class, 'race_driver')->withPivot('dorsal', 'time');
    }

    public static function createWithParameters($data) {
        $driver = new self;
        $driver->name = $data['driverName'];
        $driver->email = $data['driverEmail'];
        $driver->password = Hash::make($data['driverPassword']);
        $driver->address = $data['driverAddress'];
        $driver->birthDate = $data['driverBirthDate'];
        $driver->member = $data['driverMember'] ?? 0;
        $driver->pro = $data['driverPro'] ?? 0;
        $driver->gender = $data['driverGender'];
        $driver->federationNumber = $data['driverFederation'];
        $driver->points = 0;
        $driver->save();
    }

    public static function calculateDriversTimes($raceDrivers, $race) {
        
        foreach ($raceDrivers as $driver) {
            $driverTime = Carbon::parse($driver->time);
            $difference = $driverTime->diffInSeconds($race->date, false);
            $formattedTime = $driverTime->diff($race->date)->format('%h:%i:%s');
            $driver->time = $formattedTime;
        }
        
        $drivers = $raceDrivers;
        return $drivers;
    }

    use HasFactory;
}
