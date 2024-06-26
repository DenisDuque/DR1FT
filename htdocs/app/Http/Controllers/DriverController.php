<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Driver;
use Carbon\Carbon;

class DriverController extends Controller
{

    public function showRegister() {
        return view('register');
    }

    public function showLogin() {
        return view('login');
    }

    public function auth() {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = request()->input('email');
        $password = request()->input('password');

        $user = Driver::where('email', $email)->first();

        if ($user && Auth::guard('user')->attempt(['email' => $email, 'password' => $password])) {
            session(['user_id' => $user->id]);
            //dd('user id:'.session('user_id'));
            return redirect()->route('main.page');
        } else {
            // Las credenciales son incorrectas o el usuario no existe
            return redirect()->route('user.login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function register() {

        $data = request()->validate([
            'driverName' => 'string',
            'driverEmail' => 'email',
            'driverPassword' => 'nullable|string',
            'driverAddress' => 'string',
            'driverBirthDate' => 'date',
            'driverGender' => 'integer',
            'driverFederation' => 'string',
        ]);

        Driver::createWithParameters($data);

        $user = Driver::where('email', $data['driverEmail'])->first();

        if ($user && Auth::guard('user')->attempt(['email' => $data['driverEmail'], 'password' => $data['driverPassword']])) {
            session(['user_id' => $user->id]);
            //dd('user id:'.session('user_id'));
            return redirect()->route('main.page');
        } else {
            // Las credenciales son incorrectas o el usuario no existe
            return redirect()->route('user.register')->with('error', 'Error al registrar el usuario.');
        }
    }

    public function logout() {
        // Cerrar la sesión del guard 'admin'
        Auth::guard('user')->logout();

        // Limpiar cualquier dato almacenado en la sesión
        session()->flush();

        // Redirigir a la página de inicio de sesión
        return redirect()->back();
    }

    public function profile() {
        $driver = Driver::findOrFail(session('user_id'));
        $races = $driver->races;

        $lastRaces = [];
        $today = date('Y-m-d H:i'); // Fecha de hoy
        $todayTimestamp = strtotime($today);
        date_default_timezone_set('Europe/Madrid');
        foreach ($races as $race) {
            $race->driverPosition = RaceController::getDriverPosition($race->id, $driver->id);
            $raceDate = strtotime($race->date);
            if ($raceDate <= $today) {
                $lastRaces[] = $race;
            }
        }

        // Calcular la edad a partir de la fecha de nacimiento
        $birthDate = Carbon::parse($driver->birthDate);
        $age = $birthDate->age;
        $firstLastRace = !empty($lastRaces) ? $lastRaces[0] : null;

        return view("page.profile", [
            'driver' => $driver,
            'races' => $lastRaces,
            'lastRace' => $firstLastRace,
            'age' => $age // Pasar la edad a la vista
        ]);
    }

    public function membership() {
        return view("page.membership", [
        ]);
    }

    public function index() {
        $drivers = Driver::get();

        return view("administrator.drivers.index", [
            'drivers' => $drivers
        ]);
    }
    
    public function new() {
        return view("administrator.drivers.new");
    }

    public function create() {
        Driver::create([
            'name' => request('driverName'),
            'email' => request('driverEmail'),
            'password' => request('driverPassword'),
            'address' => request('driverAddress'),
            'birthDate' => request('driveBirthDate'),
            'gender' => request('driverGender'),
            'pro' => request('driverPro'),
            'member' => request('driverMember'),
            'federationNumber' => request('driverFederation'),
            'points' => request('driverPoints')
        ]);

        return redirect()->route('admin.drivers');
    }

    public function edit($id) {
        $driver = Driver::find($id);

        if ($driver) {
            $driver->birthDate = Carbon::createFromFormat('d-m-Y', $driver->birthDate)->format('Y-m-d');
            return view('administrator.drivers.edit')->with('driver', $driver);
        } else {
            return redirect()->route('admin.drivers')->with('error', 'Driver not found');
        }
    }

    public function update($id) {
        $driver = Driver::find($id);

        if ($driver) {
            request()->validate([
                'driverName' => 'string',
                'driverEmail' => 'email',
                'driverPassword' => 'nullable|string',
                'driverAddress' => 'string',
                'driverBirthDate' => 'date',
                'driverGender' => 'integer',
                'driverFederation' => 'string',
                'driverPoints' => 'integer',
            ]);

            $originalValues = $driver->getOriginal();

            $updatedValues = [
                'name' => request('driverName'),
                'email' => request('driverEmail'),
                'password' => request('driverPassword'),
                'address' => request('driverAddress'),
                'birthDate' => Carbon::createFromFormat('Y-m-d', request('driverBirthDate'))->format('d-m-Y'),
                'gender' => request('driverGender'),
                'pro' => request('driverPro') ? 1 : 0,
                'member' => request('driverMember') ? 1 : 0,
                'federationNumber' => request('driverFederation'),
                'points' => request('driverPoints'),
            ];

            // Actualizar solo los campos que han cambiado
            $updatedValues = array_filter($updatedValues, function ($value, $key) use ($originalValues) {
                return $value !== $originalValues[$key] && !($value === null || $value === '');;
            }, ARRAY_FILTER_USE_BOTH);

            // Actualizar el conductor solo si hay cambios
            if (!empty($updatedValues)) {
                $driver->update($updatedValues);
                return redirect()->route('admin.drivers')->with('success', 'Driver updated correctly.');
            } else {
                return redirect()->route('admin.drivers')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('admin.drivers')->with('error', 'Driver not found.');
        }
    }

    public function search() {
        $searchTerm = request()->input('searchTerm');

        $drivers = Driver::where('name', 'like', "%$searchTerm%")->get();

        return response()->json($drivers);
    }

    public static function getTopDrivers() {
        $topDrivers = Driver::orderByDesc('points')
                        ->limit(10)
                        ->get();
        return $topDrivers;
    }

    public static function payMembership(Request $request) {
        
        $driver = Driver::findOrFail(session('user_id'));
        $driver->member = 1;
        $driver->save();

        $paypal = new PaypalController();
        $response = $paypal->postPaymentWithpaypal($request);
        
        return $response;
        
    }
}
