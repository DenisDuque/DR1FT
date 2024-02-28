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

    public function edit($id) {
        $driver = Driver::find($id);

        if ($driver) {
            return view('administrator.drivers.edit')->with('driver', $driver);
        } else {
            return redirect()->route('administrator.drivers.index')->with('error', 'Driver not found');
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
                'birthDate' => request('driverBirthDate'),
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
                return redirect()->route('/admin/drivers')->with('success', 'Driver updated correctly.');
            } else {
                return redirect()->route('/admin/drivers')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('/admin/drivers')->with('error', 'Driver not found.');
        }
    }
}
