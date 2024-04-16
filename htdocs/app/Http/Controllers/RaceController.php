<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaypalController;
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

use function PHPUnit\Framework\isNull;

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

        if (session()->has('user_id')) {
            $driver = Driver::find(session('user_id'));
            if($driver->member === 1) {
                foreach ($races as $race) {
                    $discount = $race->registrationPrice * 0.15;
                    $race->registrationPrice -= $discount;
                    $race->registrationPrice = round($race->registrationPrice, 2);
                }
            }
        }
        
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
            RaceController::updateSponsors($race, request());
            RaceController::updatePhotos($race, request());
            return redirect()->route('admin.races')->with('success', 'Race saved successfully');
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
            $selectedSponsorIds = $request->input('raceSponsors');
            $selectedMainSponsorIds = $request->input('mainSponsors');
            // Verifica que todos los sponsors seleccionados existan en la base de datos
            $validSponsorIds = Sponsor::whereIn('id', $selectedSponsorIds)->pluck('id')->toArray();
            if (count($validSponsorIds) === count($selectedSponsorIds)) {
                RaceSponsor::where('race_id', $race->id)->delete();

                $data = [];

                foreach ($validSponsorIds as $sponsorId) {

                    $data[] = [
                        'race_id' => $race->id,
                        'sponsor_id' => $sponsorId,
                        'mainSponsor' => in_array($sponsorId, $selectedMainSponsorIds) ? 1 : 0
                    ];
                }
            
                // Insertar los datos en la tabla race_insurances
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
        if ($request->hasFile('racePhotos')) {
            // Hay imágenes
            $photosNames = ImageController::storeImages($request, 'race_photos', 'racePhotos');
            if ($photosNames) {
                $data = [];
                foreach ($photosNames as $photo) {
                    $data[] = [
                        'path' => $photo,
                        'race_id' => $race->id
                    ];
                }
                // Insertar los datos en la tabla race_photos
                RacePhoto::insert($data);
            }
        
        }
    }

    public function show($id) {
        $race = Race::find($id);
        $insurances = $race->insurances;
        $sponsors = $race->sponsors;
        $photos = $race->photos;
        $classification = Race::getRaceClassification($race->id);
        //dd($photos);
        if (session()->has('user_id')) {
            $driver = Driver::find(session('user_id'));
            if($driver->member === 1) {
                $discount = $race->registrationPrice * 0.15;
                $race->registrationPrice -= $discount;
                $race->registrationPrice = round($race->registrationPrice, 2);
            }
        }

        return view('page.raceDetails', [
            'race' => $race, 
            'insurances' => $insurances,
            'sponsors' => $sponsors,
            'photos' => $photos,
            'classification' => $classification
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
            for ($i = 0; $i <= $maxParticipants; $i++) { 
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
        session(['race_id' => $request->race_id]);
        $race = Race::find($request->race_id);
        $participantCount = RaceDriver::where('race_id', $request->race_id)->count();

        if ($participantCount >= $race->maxParticipants) {
            return redirect()->back()->with('error', 'Sorry, this race has reached its maximum number of participants.');
        }

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

            $paypal = new PaypalController();
            $response = $paypal->postPaymentWithpaypal($request);
            
            return $response;

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

            // RaceDriverInsurance
            $raceDriverInsurance = new RaceDriverInsurance();
            $raceDriverInsurance->race_id = $request->race_id;
            $raceDriverInsurance->driver_id = $driver->id;
            $raceDriverInsurance->insurance_id = $request->input('driverInsurance');
            $raceDriverInsurance->save();

            $insurance = Insurance::find($raceDriverInsurance->insurance_id);

            
            $request->merge(['amount' => $request->input('amount') + $insurance->pricePerRace]);

            $paypal = new PaypalController();
            $response = $paypal->postPaymentWithpaypal($request);
            
            return $response;
    
            return redirect()->back()->with('success', 'You have been successfully registered for the race!');
        }
    
        // Si el conductor ya existe, mostrar un mensaje de error
        return redirect()->back()->with('error', 'User with provided email already exists. Please log in or use a different email.');
    
    }

    public static function getTopRaces() {

        $topRaces = Race::withCount('drivers')
        ->orderByRaw('drivers_count * registrationPrice DESC')
        ->take(3)
        ->get();
        //dd($topRaces);
        return $topRaces;
    }
    
    public static function nextRace() {
        $race = Race::where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->first();

        if ($race) {
            $formattedDate = str_replace('/', '-', $race->date);
            $race->date = $formattedDate;
        }

        return $race;
    }

    public static function lastRace() {
        $race = Race::where('date', '<=', Carbon::today())
            ->orderBy('date', 'asc')
            ->first();

        if ($race) {
            $formattedDate = str_replace('/', '-', $race->date);
            $race->date = $formattedDate;
        }

        return $race;
    }


    public static function nextRaces() {
        $races = Race::where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        return $races;
    }

    public static function setTimeToDriver($raceId, $driverId) {

        $raceDrivers = RaceDriver::where('race_id', $raceId)->get();

        $finishedRace = 0;

        foreach ($raceDrivers as $raceDriver) {
            if (!is_null($raceDriver->time)) {
                $finishedRace++;
            }
        }

        $driver = RaceDriver::where('race_id', $raceId)
            ->where('driver_id', $driverId)
            ->first();

        if ($driver) {
            // Actualizar el campo 'time' al timestamp actual

            if (is_null($driver->time)) {
                $time = Carbon::now();
                $driver->time = $time->copy()->setTimezone('Europe/Madrid')->toDateTimeString();
                if ($finishedRace == 0) {
                    $driver->driver->points += 1000;
                } else if ($finishedRace == 1) {
                    $driver->driver->points += 500;
                } else if ($finishedRace == 2) {
                    $driver->driver->points += 300;
                }
                $driver->driver->save();
                $driver->save();
                return view('administrator.races.timeSaved')->with([
                    'driver' => $driver
                ]);
            } else {
                dd('El tiempo ya se ha asignado!');
            }
            
                
        } else {
            dd('El registro no existe');
        }
    }

    public static function getClassification($raceId) {

        $race = Race::find($raceId);

        $raceDrivers = Race::getRaceClassification($raceId);

        $pdf = PDFController::downloadRaceClassification($raceDrivers, $race);

        return $pdf;
    }

    public static function getDriverPosition($raceId, $driverId) {
        // Obtener la lista de conductores de la carrera ordenados por tiempo
        $raceDrivers = RaceDriver::where('race_id', $raceId)
            ->whereNotNull('time')
            ->orderBy('time', 'asc')
            ->get();
    
        $position = 0;
    
        foreach ($raceDrivers as $index => $raceDriver) {
            if ($raceDriver->driver_id == $driverId) {
                $position = $index + 1;
            }
        }
    
        return $position;
    }
}
