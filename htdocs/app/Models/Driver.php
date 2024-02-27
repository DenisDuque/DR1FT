<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
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

    use HasFactory;
}
