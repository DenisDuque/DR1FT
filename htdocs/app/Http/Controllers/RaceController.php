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
                'active' => request('raceActive')
            ]);

            return redirect()->route('/admin/races');
        } else {
            echo("NO");
        }
    }

    

    
}
