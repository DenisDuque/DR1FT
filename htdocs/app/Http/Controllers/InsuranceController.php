<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\ImageController;

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

            return redirect()->route('/admin/insurances');
        } else {
            // TODO: Devolver popup de error
            return redirect()->route('/admin/insurances')->with('error', 'There was an error while uploading the image, insurance creation aborted.');
        }
    }

    public function edit($id) {
        
        $insurance = Insurance::find($id);

        if ($insurance) {
            return view('administrator.insurances.edit')->with('insurance', $insurance);
        } else {
            return redirect()->route('administrator.insurances.index')->with('error', 'Insurance not found');
        }
    }

    public function update($id) {
        $insurance = Insurance::find($id);
    
        if ($insurance) {
            request()->validate([
                'insuranceName' => 'string',
                'insuranceCIF' => 'string',
                'insuranceCost' => 'numeric',
                'insuranceAddress' => 'string'
            ]);
    
            $originalValues = $insurance->getOriginal();
    
            $logo = ImageController::storeImage(request(), 'insurance_logos', 'insuranceLogo');
    
            $updatedValues = [
                'cif' => request('insuranceCIF'),
                'name' => request('insuranceName'),
                'address' => request('insuranceAddress'),
                'pricePerRace' => request('insuranceCost'),
                'active' => request('insuranceActive') ?? 0
            ];
    
            // Actualizar solo los campos que han cambiado
            $updatedValues = array_filter($updatedValues, function ($value, $key) use ($originalValues) {
                return $value !== $originalValues[$key];
            }, ARRAY_FILTER_USE_BOTH);
    
            // Si hay un nuevo logo, agregarlo a los valores actualizados
            if ($logo) {
                $updatedValues['logo'] = $logo;
            }
    
            // Actualizar el seguro solo si hay cambios
            if (!empty($updatedValues)) {
                $insurance->update($updatedValues);
                return redirect()->route('/admin/insurances')->with('success', 'Insurance updated correctly.');
            } else {
                return redirect()->route('/admin/insurances')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('/admin/insurances')->with('error', 'Insurance not found.');
        }
    }
    
    
}
