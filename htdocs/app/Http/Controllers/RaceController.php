<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Controllers\ImageController;

class RaceController extends Controller {

    public function index() {
        $races = Race::get();

        return view('administrator.races.index', [
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


    public function edit($id) {
        $race = Race::find($id);

        if ($race) {
            
            return view('administrator.races.edit')->with('race', $race);
        } else {
            return redirect()->route('admin.races.index')->with('error', 'Race not found');
        }
    }

    public function update($id) {
        $race = Race::find($id);

        if ($race) {
            request()->validate([
                'raceName' => 'string',
                'raceDescription' => 'string',
                'raceMaxParticipants' => 'integer',
                'raceLength' => 'numeric',
                'raceDate' => 'date|after:tomorrow',
                'raceCoords' => 'string',
                'raceSponsorCost' => 'numeric',
                'raceRegistrationPrice' => 'numeric',
            ]);

            $originalValues = $race->getOriginal();

            $map = ImageController::storeImage(request(), 'race_maps', 'raceMap');
            $banner = ImageController::storeImage(request(), 'race_banners', 'raceBanner');

            $pro = request()->has('racePro') ? 1 : 0;
            $active = request()->has('raceActive') ? 1 : 0;

            $updatedValues = [
                'name' => request('raceName'),
                'description' => request('raceDescription'),
                'maxParticipants' => request('raceMaxParticipants'),
                'length' => request('raceLength'),
                'date' => request('raceDate'),
                'startingPlace' => request('raceCoords'),
                'sponsorCost' => request('raceSponsorCost'),
                'registrationPrice' => request('raceRegistrationPrice'),
                'pro' => $pro,
                'active' => $active,
            ];

            // Actualizar solo los campos que han cambiado
            $updatedValues = array_filter($updatedValues, function ($value, $key) use ($originalValues) {
                return $value !== $originalValues[$key];
            }, ARRAY_FILTER_USE_BOTH);

            // Si hay nuevos mapas o banners, agregarlos a los valores actualizados
            if ($map) {
                $updatedValues['map'] = $map;
            }

            if ($banner) {
                $updatedValues['banner'] = $banner;
            }

            // Actualizar la carrera solo si hay cambios
            if (!empty($updatedValues)) {
                $race->update($updatedValues);
                return redirect()->route('/admin/races')->with('success', 'Race updated correctly.');
            } else {
                return redirect()->route('/admin/races')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('/admin/races')->with('error', 'Race not found.');
        }
    }
}
