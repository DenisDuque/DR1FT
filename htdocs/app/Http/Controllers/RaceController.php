<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Controllers\ImageController;
use App\Models\Sponsor;
use App\Models\Insurance;
use App\Models\RaceInsurance;
use App\Models\RaceSponsor;
use Carbon\Carbon;

class RaceController extends Controller {

    public function index() {
        $races = Race::get();

        return view('administrator.races.index', [
            'races' => $races
        ]);
    }

    public function new() {
        $sponsors = Sponsor::all();
        $insurances = Insurance::all();

        return view('administrator.races.new', compact('sponsors', 'insurances'));
    }

    public function verify_details() {
        request()->validate([
            'raceName' => 'required|string',
            'raceDescription' => 'required|string',
            'raceMaxParticipants' => 'required|integer',
            'raceLength' => 'required|numeric',
            'raceDate' => 'required|date|after:tomorrow',
            'raceCoords' => 'required|string',
            'raceSponsorCost' => 'required|numeric',
            'raceRegistrationPrice' => 'required|numeric',
            'raceBanner'=> 'required|image|mimes:png,jpg,jpeg',
            'raceMap'=> 'required|image|mimes:png,jpg,jpeg'
        ]);

        $map = ImageController::storeImage(request(), 'race_maps', 'raceMap');
        $banner = ImageController::storeImage(request(), 'race_banners', 'raceBanner');

        if ($map && $banner) {
            $data = [
                'name' => request('raceName'),
                'description' => request('raceDescription'),
                'map' => $map,
                'maxParticipants' => request('raceMaxParticipants'),
                'length' => request('raceLength'),
                'banner' => $banner,
                'date' => Carbon::createFromFormat('Y-m-d', request('raceDate'))->format('d-m-Y'),
                'startingPlace' => request('raceCoords'),
                'sponsorCost' => request('raceSponsorCost'),
                'registrationPrice' => request('raceRegistrationPrice'),
                'pro' =>  request()->has('racePro') ? 1 : 0,
                'active' =>  request()->has('raceActive') ? 1 : 0,
            ];

            session(['raceDetails' => $data]);
    
            return redirect()->route('admin.races.new.insurances');
        } else {
            return redirect()->back()->with('error', 'There was an error with the images selected');
        }
    }

    public function new_insurances() {
        $insurances = Insurance::all();
        return view('administrator.races.insurances', [
            'insurances' => $insurances
        ]);
    }

    public function verify_insurances() {
        // Verifica si hay al menos un checkbox marcado
        if (request()->has('raceInsurances') && is_array(request()->input('raceInsurances')) && count(request()->input('raceInsurances')) > 0) {
            // Hay checkboxes marcados, procede a la siguiente página
    
            // Puedes obtener los IDs de las insurances marcadas así
            $selectedInsuranceIds = request()->input('raceInsurances');
    
            // Verifica que todos los insuranceIds seleccionados existan en la base de datos
            $validInsuranceIds = Insurance::whereIn('id', $selectedInsuranceIds)->pluck('id')->toArray();
    
            // Verifica si todos los IDs seleccionados existen en la base de datos
            if (count($validInsuranceIds) === count($selectedInsuranceIds)) {
                // Todos los IDs son válidos, procede con las acciones necesarias, por ejemplo, almacenarlos en la sesión
                session(['raceInsurances' => $validInsuranceIds]);
    
                return redirect()->route('admin.races.new.sponsors');
            } else {
                // Al menos uno de los IDs seleccionados no existe, puedes redirigir o realizar otras acciones
                return redirect()->back()->with('error', 'Invalid insurance selection.');
            }
        } else {
            // No hay checkboxes marcados, puedes redirigir o realizar otras acciones
            return redirect()->back()->with('error', 'You need to select at least 1 insurance.');
        }
    }

    public function new_sponsors() {
        $sponsors = Sponsor::all();
        return view('administrator.races.sponsors', [
            'sponsors' => $sponsors
        ]);
    }

    public function verify_sponsors() {
        // Verificar si hay al menos un checkbox marcado
        if (request()->has('raceSponsors') && is_array(request()->input('raceSponsors')) && count(request()->input('raceSponsors')) > 0) {
            $selectedSponsorIds = request()->input('raceSponsors');
            $mainSponsorIds = request()->input('mainSponsors');
    
            $validSponsorIds = Sponsor::whereIn('id', $selectedSponsorIds)->pluck('id')->toArray();
    
            // Verificar si todos los IDs seleccionados existen en la base de datos
            if (count($validSponsorIds) === count($selectedSponsorIds)) {
                // Crear carrera
                $race = session('raceDetails');
    
                $newRace = Race::create([
                    'name' => $race['name'],
                    'description' => $race['description'],
                    'map' => $race['map'],
                    'maxParticipants' => $race['maxParticipants'],
                    'length' => $race['length'],
                    'banner' => $race['banner'],
                    'date' => $race['date'],
                    'startingPlace' => $race['startingPlace'],
                    'sponsorCost' => $race['sponsorCost'],
                    'registrationPrice' => $race['registrationPrice'],
                    'pro' => $race['pro'],
                    'active' => $race['active'],
                ]);
    
                // Asignar Insurances
                $insurances = session('raceInsurances');
                
                foreach ($insurances as $insurance) {
                    RaceInsurance::create([
                        'insurance_id' => $insurance,
                        'race_id' => $newRace->id, // Corregir para obtener el ID de la carrera recién creada
                    ]);
                }
    
                // Asignar Sponsors
                foreach ($selectedSponsorIds as $sponsor) {
                    RaceSponsor::create([
                        'sponsor_id' => $sponsor,
                        'race_id' => $newRace->id,
                        'mainSponsor' => in_array($sponsor, $mainSponsorIds) ? 1 : 0,
                    ]);
                }

                return redirect()->route('admin.races')->with('success', 'Race created successfuly');
            } else {
                // Al menos uno de los IDs seleccionados no existe, puedes redirigir o realizar otras acciones
                return redirect()->back()->with('error', 'Invalid sponsor selection.');
            }
        } else {
            // No hay checkboxes marcados, puedes redirigir o realizar otras acciones
            return redirect()->back()->with('error', 'You need to select at least 1 sponsor.');
        }
    }

    public function edit($id) {
        $race = Race::find($id);
        
        if ($race) {
            $race->date = Carbon::createFromFormat('d-m-Y', $race->date)->format('Y-m-d');
            return view('administrator.races.edit')->with('race', $race);
        } else {
            return redirect()->route('admin.races')->with('error', 'Race not found');
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
                'raceDate' => 'date',
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
                'date' => Carbon::createFromFormat('Y-m-d', request('raceDate'))->format('d-m-Y'),
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
                return redirect()->route('admin.races')->with('success', 'Race updated correctly.');
            } else {
                return redirect()->route('admin.races')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('admin.races')->with('error', 'Race not found.');
        }
    }

    public function show($id) {
        $race = Race::find($id);

        if ($race) {
            $race->date = Carbon::createFromFormat('d-m-Y', $race->date)->format('Y-m-d');
            return view('administrator.races.show')->with('race', $race);
        } else {
            return redirect()->route('admin.races')->with('error', 'Race not found');
        }
    }

    public function search() {
        $searchTerm = request()->input('searchTerm');

        $races = Race::where('name', 'like', "%$searchTerm%")->get();

        return response()->json($races);
    }

    public function find() {
        $id = request()->input('id');

        $race = Race::find($id);

        return response()->json($race);
    }
}
