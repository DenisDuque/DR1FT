<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'race_photo';

    public function race() {
        return $this->belongsToMany(Race::class);
    }

    use HasFactory;
}
