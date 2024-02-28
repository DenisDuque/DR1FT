<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use App\Http\Controllers\ImageController;

class RaceController extends Controller {

    public function index() {
        $races = Race::get();
        
    }

    public function showAdministratorPanel() {
        $titulo = "NIGGER";
        $races = Race::get();

        return view('administrator.races.show', [
            'titulo' => $titulo,
            'races' => $races
        ]);
    }

    public function new() {

        return view('administrator.races.new');
    }

    public function create() {

        request()->validate([
            'raceName' => 'required|string',
            'raceDescription' => 'required|string',
            'raceMaxParticipants' => 'required|integer',
            'raceLength' => 'required|numeric',
            'raceDate' => 'required|date|after:tomorrow',
            'raceCoords' => 'required|string',
            'raceSponsorCost' => 'required|numeric',
            'raceRegistrationPrice' => 'required|numeric'
        ]);

        $map = ImageController::storeImage(request(), 'race_maps', 'raceMap');
        $banner = ImageController::storeImage(request(), 'race_banners', 'raceBanner');

        if ($map && $banner) {
            Race::create([
                'name' => request('raceName'),
                'description' => request('raceDescription'),
                'map' => $map,
                'maxParticipants' => request('raceMaxParticipants'),
                'length' => request('raceLength'),
                'banner' => $banner,
                'date' => request('raceDate'),
                'startingPlace' => request('raceCoords'),
                'sponsorCost' => request('raceSponsorCost'),
                'registrationPrice' => request('raceRegistrationPrice'),
                'pro' => request('racePro') ?? 0,
                'active' => request('raceActive') ?? 0
            ]);

            return redirect()->route('/admin/races');
        } else {
            // TODO: Devolver popup de error
            echo("NO");
        }
    }

    

    
}
