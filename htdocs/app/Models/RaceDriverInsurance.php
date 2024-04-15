<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getTopInsurances($number) {
        $topInsurancesIds = RaceDriverInsurance::select('insurance_id', DB::raw('COUNT(*) as appearance_count'))
        ->groupBy('insurance_id')
        ->orderByDesc('appearance_count')
        ->take($number)
        ->pluck('insurance_id');

        $insurancesInfo = Insurance::whereIn('id', $topInsurancesIds)->get();

        return $insurancesInfo;

    }
}
