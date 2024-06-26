<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'cif',
        'logo',
        'name',
        'address',
        'pricePerRace',
        'active'
    ];

    public function races() {
        return $this->belongsToMany(Race::class);
    }
    
    use HasFactory;
}
