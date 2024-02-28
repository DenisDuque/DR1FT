<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'active'
    ];
    
    

    use HasFactory;
}
