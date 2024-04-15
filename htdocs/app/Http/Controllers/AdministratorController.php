<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\RaceDriverInsurance;

class AdministratorController extends Controller
{
    public function showAdministratorPanel() {
        $topDrivers = DriverController::getTopDrivers();
        $topSponsors = SponsorController::getTopSponsors();
        $topInsurances = RaceDriverInsurance::getTopInsurances(3);
        $topRaces = RaceController::getTopRaces();
        $nextRace = RaceController::nextRace();
        $nextRaces = RaceController::nextRaces();
        return view('administrator.dashboard')->with(compact('topDrivers', 'topSponsors', 'topInsurances', 'topRaces', 'nextRace', 'nextRaces'));
    }

    public function showLogin() {
        if (session('adminAuth')) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('administrator.login');
        }
    }

    public function auth() {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = request()->input('email');
        $password = request()->input('password');

        $user = Administrator::where('email', $email)->first();

        if ($user && Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            session(['adminAuth' => true]);
            session(['userName' => $user->name]);
            return redirect()->route('admin.dashboard');
        } else {
            // Las credenciales son incorrectas o el usuario no existe
            return redirect()->route('admin.login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout()
    {
        // Cerrar la sesión del guard 'admin'
        Auth::guard('admin')->logout();

        // Limpiar cualquier dato almacenado en la sesión
        session()->flush();

        // Redirigir a la página de inicio de sesión
        return redirect()->route('admin.login');
    }
}
