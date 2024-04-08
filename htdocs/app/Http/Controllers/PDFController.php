<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Race;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    // Generar PDF con datos de Sponsors
    public function generateSponsorPDF($sponsorId){
        // Obtener el sponsor específico por su ID
        $sponsor = Sponsor::with('races')->find($sponsorId);

        $totalSponsorCost = $sponsor->races->sum('sponsorCost');

        $data = [
            'sponsor' => $sponsor,
            'races' => $sponsor->races,
            'totalSponsorCost' => $totalSponsorCost,
        ];

        // Generar el PDF usando la vista 'myPDF' y los datos proporcionados
        $pdf = PDF::loadView('administrator.pdfs.sponsor_details', $data);

        // Descargar el PDF
        return $pdf->download('sponsor_details.pdf');
    }

    public function generateRacePDF($raceId){
        // Obtener la carrera específica por su ID junto con los datos de los pilotos que participan en ella
        $race = Race::with('drivers')->find($raceId);
        $driversWithDorsal = $race->drivers()->whereNotNull('dorsal')->get();

        // Datos de la carrera
        $raceData = [
            'race' => $race,
            'drivers' => $driversWithDorsal,
        ];
    
        // Generar el PDF usando la vista 'race_details' y los datos proporcionados
        $pdf = PDF::loadView('administrator.pdfs.race_details', $raceData);
    
        // Descargar el PDF
        return $pdf->download('race_details.pdf');
    }

    public function generateDorsalPDF($raceId, $driverId) {
        
        $driver = DB::table('race_driver')
            ->join('drivers', 'drivers.id', '=', 'race_driver.driver_id') // Unir la tabla 'race_driver' con la tabla 'driver'
            ->where('race_driver.race_id', $raceId)
            ->where('race_driver.driver_id', $driverId)
            ->select('race_driver.*', 'drivers.name as driver_name') // Seleccionamos todos los campos de race_driver y también el campo 'name' de la tabla 'driver' con el alias 'driver_name'
            ->first(); // Obtener el primer resultado
        if ($driver && $driver->dorsal != null) {

            $qrLink= 'localhost/generateQR?race='.$raceId.'&driver='.$driverId;
            $data = [
                'name' => $driver->driver_name,
                'dorsal' => $driver->dorsal,
                'link' => $qrLink
            ];
    
            $pdf = PDF::loadView('page.pdfs.driver_dorsal', ['data' => $data]);
            return $pdf->download('driver_dorsal.pdf');
        } else {
            dd("NO FUNCA");
        }
        
    }
    
}
