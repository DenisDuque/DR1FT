<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceInsurance extends Model
{
    use HasFactory;

    protected $table = 'race_insurance';

    protected $fillable = [
        'insurance_id', 
        'race_id'
    ];
}
