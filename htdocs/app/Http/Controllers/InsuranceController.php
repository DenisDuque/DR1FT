<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Validator;


class InsuranceController extends Controller
{
    public function index() {
        $insurances = Insurance::get();

        return view('administrator.insurances.index', [
            'insurances' => $insurances
        ]);
    }

    public function new() {

        return view('administrator.insurances.new');
    }

    public function create() {

        //TODO: Validar el CIF correctamente

        request()->validate([
            'insuranceName' => 'required|string',
            'insuranceCIF' => 'required|string',
            'insuranceCost' => 'required|numeric',
            'insuranceAddress' => 'required|string'
        ]);

        $logo = ImageController::storeImage(request(), 'insurance_logos', 'insuranceLogo');

        if ($logo) {
            Insurance::create([
                'cif' => request('insuranceCIF'),
                'logo' => $logo,
                'name' => request('insuranceName'),
                'address' => request('insuranceAddress'),
                'pricePerRace' => request('insuranceCost'),
                'active' => request('insuranceActive') ?? 0
            ]);

            return redirect()->route('admin.insurances');
        } else {
            // TODO: Devolver popup de error
            return redirect()->route('admin.insurances')->with('error', 'There was an error while uploading the image, insurance creation aborted.');
        }
    }

    public function edit($id) {
        
        $insurance = Insurance::find($id);

        if ($insurance) {
            return view('administrator.insurances.edit')->with('insurance', $insurance);
        } else {
            return redirect()->route('admin.insurances')->with('error', 'Insurance not found');
        }
    }

    public function update($id) {
        $insurance = Insurance::find($id);
    
        if ($insurance) {
            $validator = Validator::make(request()->all(), [
                'insuranceName' => 'required|string',
                'insuranceCIF' => 'required|string',
                'insuranceCost' => 'required|numeric',
                'insuranceAddress' => 'required|string'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $originalValues = $insurance->getOriginal();
    
            $logo = ImageController::storeImage(request(), 'insurance_logos', 'insuranceLogo');
    
            $updatedValues = [
                'cif' => request('insuranceCIF'),
                'name' => request('insuranceName'),
                'address' => request('insuranceAddress'),
                'pricePerRace' => request('insuranceCost'),
                'active' => request('insuranceActive') ?? 0
            ];
    
            // Verificar si hay cambios detectados comparando los valores originales con los nuevos
            $changesDetected = array_diff_assoc($updatedValues, $originalValues);
    
            if (empty($changesDetected) && !$logo) {
                return redirect()->route('admin.insurances')->with('info', 'No changes detected.');
            }
    
            // Si hay un nuevo logo, agregarlo a los valores actualizados
            if ($logo) {
                $updatedValues['logo'] = $logo;
            }
    
            // Actualizar la insurance solo si hay cambios
            if (!empty($changesDetected) || $logo) {
                $insurance->update($updatedValues);
                return redirect()->route('admin.insurances')->with('success', 'Insurance updated correctly.');
            }
        }
    
        return redirect()->route('admin.insurances')->with('error', 'Insurance not found.');
    }
    
    
    
}
