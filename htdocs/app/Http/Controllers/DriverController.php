<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
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

        return redirect()->route('/admin/drivers');
    }
}
