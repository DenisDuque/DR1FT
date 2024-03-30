<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function race() {
        return $this->belongsToMany(Race::class);
    }

    use HasFactory;
}
