<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'insuranceId', 
        'raceId'
    ];
}
