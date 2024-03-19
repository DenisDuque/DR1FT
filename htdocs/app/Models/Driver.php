<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

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

    use HasFactory;
}
