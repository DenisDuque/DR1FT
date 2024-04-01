<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RacePhoto extends Model
{
    use HasFactory;

    protected $table = 'race_photo';

    protected $fillable = [
        'path', 
        'race_id'
    ];
}
