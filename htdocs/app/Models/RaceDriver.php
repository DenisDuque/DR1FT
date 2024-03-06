<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceDriver extends Model
{
    use HasFactory;

    protected $table = 'race_driver';

    protected $fillable = [
        'driver_id', 
        'race_id', 
        'dorsal', 
        'time'
    ];
}
