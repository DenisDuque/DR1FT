<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'cif',
        'logo',
        'address',
        'active'
    ];

    public function races(){
        return $this->belongsToMany(Race::class)->withPivot('mainSponsor');
    }

    use HasFactory;
}
