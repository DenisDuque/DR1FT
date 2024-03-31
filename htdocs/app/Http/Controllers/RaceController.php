<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Controllers\ImageController;
use App\Models\Sponsor;
use App\Models\Insurance;
use App\Models\Driver;
use App\Models\RaceInsurance;
use App\Models\RaceSponsor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\RaceDriver;
use App\Models\RaceDriverInsurance;
use App\Models\RacePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RaceController extends Controller {

    public function mainPage() {
        // Obtener la fecha actual formateada como día - mes - año
        $today = Carbon::now()->format('Y-m-d');
    
        // Obtener las próximas 4 carreras
        $races = Race::where('date', '>=', $today)
                    ->orderBy('date')
                    ->limit(4)
                    ->get();
    
        return view('index', [
            'races' => $races
        ]);
    }

    public function allRaces() {
        
        $races = Race::where('active', 1)->get();
        
        return view('page.races', ['races' => $races]);
    }
    
    

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
                    'date' => Carbon::createFromFormat('d-m-Y', $race['date'])->format('Y-m-d'),
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
        $sponsors = Sponsor::all();
        $insurances = Insurance::all();
        
        if ($race) {
            return view('administrator.races.edit')->with(compact('race', 'sponsors', 'insurances'));
        } else {
            return redirect()->route('admin.races')->with('error', 'Race not found');
        }
    }

    public function update($id) {
        $race = Race::find($id);

        if ($race) {
            RaceController::updateDetails($race, request());
            RaceController::updateInsurances($race, request());
            RaceController::updatePhotos($race, request());
            echo("FUNCIONA");
        } else {
            return redirect()->route('admin.races')->with('error', 'Race not found.');
        }
    }

    public function updateDetails($race, $request) {
        $request->validate([
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
        if ($request->has('raceMap')) {
            $map = ImageController::storeImage($request, 'race_maps', 'raceMap');
        }
        if ($request->has('raceBanner')) {
            $banner = ImageController::storeImage($request, 'race_banners', 'raceBanner');
        }
        $pro = $request->has('racePro') ? 1 : 0;
        $active = $request->has('raceActive') ? 1 : 0;

        $updatedValues = [
            'name' => $request['raceName'],
            'description' => $request['raceDescription'],
            'maxParticipants' => $request['raceMaxParticipants'],
            'length' => $request['raceLength'],
            'date' => $request['raceDate'],
            'startingPlace' => $request['raceCoords'],
            'sponsorCost' => $request['raceSponsorCost'],
            'registrationPrice' => $request['raceRegistrationPrice'],
            'pro' => $pro,
            'active' => $active,
        ];

        // Actualizar solo los campos que han cambiado
        $updatedValues = array_filter($updatedValues, function ($value, $key) use ($originalValues) {
            return $value !== $originalValues[$key];
        }, ARRAY_FILTER_USE_BOTH);

        // Si hay nuevos mapas o banners, agregarlos a los valores actualizados
        if (isset($map)) {
            $updatedValues['map'] = $map;
        }

        if (isset($banner)) {
            $updatedValues['banner'] = $banner;
        }

        // Actualizar la carrera solo si hay cambios
        if (!empty($updatedValues)) {
            $race->update($updatedValues);
        }
    }

    public function updateInsurances($race, $request) {
        if ($request->has('raceInsurances') && is_array($request->input('raceInsurances')) && count($request->input('raceInsurances')) > 0) {
            // Hay checkboxes marcados
            $selectedInsuranceIds = $request->input('raceInsurances');
    
            // Verifica que todos los insuranceIds seleccionados existan en la base de datos
            $validInsuranceIds = Insurance::whereIn('id', $selectedInsuranceIds)->pluck('id')->toArray();
            if (count($validInsuranceIds) === count($selectedInsuranceIds)) {
                // Todos los IDs son válidos, procede con las acciones necesarias, por ejemplo, almacenarlos en la sesión
                RaceInsurance::where('race_id', $race->id)->delete();

                $data = [];

                foreach ($validInsuranceIds as $insuranceId) {
                    $data[] = [
                        'race_id' => $race->id,
                        'insurance_id' => $insuranceId
                    ];
                }
            
                // Insertar los datos en la tabla race_insurances
                RaceInsurance::insert($data);
    
            } else {
                // Al menos uno de los IDs seleccionados no existe, puedes redirigir o realizar otras acciones
                return redirect()->back()->with('error', 'Invalid insurance selection.');
            }
        } else {
            // No hay checkboxes marcados, puedes redirigir o realizar otras acciones
            return redirect()->back()->with('error', 'You need to select at least 1 insurance.');
        }
    }

    public function updateSponsors($race, $request) {
        if ($request->has('raceSponsors') && is_array($request->input('raceSponsors')) && count($request->input('raceSponsors')) > 0) {
            // Hay checkboxes marcados
            $selectedSponsorsIds = $request->input('raceSponsors');
    
            // Verifica que todos los sponsorIds seleccionados existan en la base de datos
            $validSponsorsIds = Sponsor::whereIn('id', $selectedSponsorsIds)->pluck('id')->toArray();
            if (count($validSponsorsIds) === count($selectedSponsorsIds)) {
                // Todos los IDs son válidos, procede con las acciones necesarias, por ejemplo, almacenarlos en la sesión
                RaceSponsor::where('race_id', $race->id)->delete();

                $data = [];

                foreach ($validSponsorsIds as $sponsorId) {
                    $data[] = [
                        'race_id' => $race->id,
                        'sponsor_id' => $sponsorId
                    ];
                }
            
                // Insertar los datos en la tabla race_sponsors
                RaceSponsor::insert($data);
    
            } else {
                // Al menos uno de los IDs seleccionados no existe, puedes redirigir o realizar otras acciones
                return redirect()->back()->with('error', 'Invalid sponsor selection.');
            }
        } else {
            // No hay checkboxes marcados, puedes redirigir o realizar otras acciones
            return redirect()->back()->with('error', 'You need to select at least 1 sponsor.');
        }
    }

    public function updatePhotos($race, $request) {
        if ($request->has('raceSponsors') && is_array($request->input('raceSponsors')) && count($request->input('raceSponsors')) > 0) {
            // Hay checkboxes marcados
            $photosNames = ImageController::storeImages($request, 'race_photos', 'racePhoto');
            if ($photosNames) {
                $data = [];
                foreach ($photosNames as $photo) {
                    $data[] = [
                        'path' => $photo,
                        'race_id' => $race->id
                    ];
                }
                // Insertar los datos en la tabla race_sponsors
                RacePhoto::insert($data);
            }
        
        } 
    }

    public function show($id) {
        $race = Race::find($id);
        $insurances = $race->insurances;
        $sponsors = $race->sponsors;

        return view('page.raceDetails', [
            'race' => $race, 
            'insurances' => $insurances,
            'sponsors' => $sponsors
        ]);
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

    public function generateDorsals() {
        $raceId = request()->input('searchTerm');
        $race = Race::findOrFail($raceId);
        
        $driversWithNullDorsal = $race->drivers()->whereNull('dorsal')->get();
        $maxParticipants = $race->maxParticipants;
        
        $assignedNumbers = DB::table('race_driver')
                            ->where('race_id', $raceId)
                            ->pluck('dorsal')
                            ->toArray();
                            
        foreach ($driversWithNullDorsal as $driver) {
            for ($i = 0; $i < $maxParticipants; $i++) { 
                if (!in_array($i, $assignedNumbers) && $driver->dorsal === NULL) {
                    $driver->dorsal = $i;
                    array_push($assignedNumbers, $i);
                    RaceDriver::where('race_id', $raceId)
                        ->where('driver_id', $driver->id)
                        ->update(['dorsal' => $i]);
                }
            }
        }

        $drivers = $race->drivers()->get();
        return response()->json($drivers);
    }

    public function registerDriver(Request $request)
    {
        // Si el usuario está autenticado, registrarlo automáticamente como miembro
        if (auth('user')->check()) {
            // Obtener la carrera
            $race = Race::find($request->race_id);

            // Verificar si la carrera es "pro" y el usuario no es profesional
            if ($race->pro && !auth('user')->user()->pro) {
                return redirect()->back()->with('error', 'You cannot register for this race as you are not a pro user.');
            }

            // Comprobar si el usuario ya está inscrito en la carrera
            $existingRaceDriver = RaceDriver::where('race_id', $request->race_id)
                ->where('driver_id', auth('user')->id())
                ->exists();

            // Si el usuario ya está inscrito, redirigir con un mensaje de error
            if ($existingRaceDriver) {
                return redirect()->back()->with('error', 'You are already registered for this race.');
            }

            // Crear un nuevo registro en la tabla RaceDriver
            $raceDriver = new RaceDriver();
            $raceDriver->race_id = $request->race_id;
            $raceDriver->driver_id = auth('user')->id();
            $raceDriver->save();

            return redirect()->back()->with('success', 'You have been successfully registered for the race!');
        }


    
        // Si el usuario no está autenticado, validar los datos del formulario
        $validatedData = $request->validate([
            'driverName' => 'required|string',
            'driveBirthDate' => 'required|date',
            'driverGender' => 'required|in:0,1',
            'driverPro' => 'nullable|boolean',
            'driverFederation' => 'nullable|numeric',
            'driverAddress' => 'required|string',
            'driverEmail' => 'required|email|unique:drivers,email',
            'driverPassword' => 'required|string',
        ]);
    
        // Crear un nuevo conductor si no existe
        $driver = Driver::where('email', $validatedData['driverEmail'])->first();
    
        if (!$driver) {
            $driver = new Driver();
            $driver->name = $validatedData['driverName'];
            $driver->birthDate = $validatedData['driveBirthDate'];
            $driver->gender = $validatedData['driverGender'];
            $driver->federationNumber = $validatedData['driverFederation'] ?? 0;
            $driver->address = $validatedData['driverAddress'];
            $driver->email = $validatedData['driverEmail'];
            $driver->password = bcrypt($validatedData['driverPassword']);
            $driver->pro = $request->has('driverPro') ? 1 : 0;
            $driver->member = $request->input('member');
            $driver->points = 0;
            $driver->save();
    
            // Crear el registro en RaceDriver
            $raceDriver = new RaceDriver();
            $raceDriver->race_id = $request->race_id;
            $raceDriver->driver_id = $driver->id;
            $raceDriver->save();
    
            return redirect()->back()->with('success', 'Driver registered successfully!');
        }
    
        // Si el conductor ya existe, mostrar un mensaje de error
        return redirect()->back()->with('error', 'User with provided email already exists. Please log in or use a different email.');
    }

    // public function verificarCredenciales() {
    //     $email = request()->input('email');
    //     $password = request()->input('password');
        
    //     // Verificar si las credenciales son válidas
    //     $driver = Driver::where('email', $email)->first();

    //     if ($driver && Hash::check($password, $driver->password)) {
    //         return response()->json(['success' => true, 'driver' => $driver]);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Credenciales inválidas', 'attempted_email' => $email,
    //         'attempted_password' => $password]);
    //     }
    // }


    
}
