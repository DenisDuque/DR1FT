<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Http\Controllers\ImageController;

class SponsorController extends Controller
{
    public function index() {
        $sponsors = Sponsor::get();

        return view('administrator.sponsors.index', [
            'sponsors' => $sponsors
        ]);
    }

    public function new() {
        return view('administrator.sponsors.new');
    }

    public function create() {

        //TODO: Validar el CIF correctamente

        request()->validate([
            'sponsorName' => 'required|string',
            'sponsorCIF' => 'required|string',
            'sponsorAddress' => 'required|string'
        ]);

        $logo = ImageController::storeImage(request(), 'sponsor_logos', 'sponsorLogo');

        if ($logo) {
            Sponsor::create([
                'cif' => request('sponsorCIF'),
                'logo' => $logo,
                'name' => request('sponsorName'),
                'address' => request('sponsorAddress'),
                'pricePerRace' => request('sponsorCost'),
                'active' => request('sponsorActive') ?? 0
            ]);

            return redirect()->route('admin.sponsors');
        } else {
            // TODO: Devolver popup de error
            echo("NO");
        }
    }
}
