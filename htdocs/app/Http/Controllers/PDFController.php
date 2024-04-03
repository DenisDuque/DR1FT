<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Race;
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
    
}
