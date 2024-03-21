<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceDriverInsurance extends Model
{
    use HasFactory;

    protected $table = 'race_driver_insurance';

    protected $fillable = [
        'driver_id',
        'race_id',
        'insurance_id',
    ];

    // Relación inversa con el modelo RaceDriver
    public function driver()
    {
        return $this->belongsTo(RaceDriver::class);
    }

    // Relación con el modelo Insurance
    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
