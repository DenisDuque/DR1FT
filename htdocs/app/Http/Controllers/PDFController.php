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
}
