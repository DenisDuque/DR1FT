<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceSponsor extends Model
{
    use HasFactory;

    protected $table = 'race_sponsor';

    protected $fillable = [
        'sponsor_id', 
        'race_id', 
        'mainSponsor'
    ];
}
