<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Administrator extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $fillable = [
        'name', 
        'email', 
        'password'
    ];
    use HasFactory;
}
