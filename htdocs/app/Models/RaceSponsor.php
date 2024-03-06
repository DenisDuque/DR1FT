<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceSponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsorId', 
        'raceId', 
        'mainSponsor'
    ];
}
