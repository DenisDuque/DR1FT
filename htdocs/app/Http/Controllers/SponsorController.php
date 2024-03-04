<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Http\Controllers\ImageController;

class SponsorController extends Controller
{
    public function index() {
        $sponsors = Sponsor::get();

        return view('administrator.sponsors.index', [
            'sponsors' => $sponsors
        ]);
    }

    public function new() {
        return view('administrator.sponsors.new');
    }

    public function create() {
        // Validar los datos de entrada
        // TODO: Validar CIF
        request()->validate([
            'sponsorName' => 'required|string',
            'sponsorCIF' => 'required|string',
            'sponsorAddress' => 'required|string',
        ]);
    
        // Almacenar el logo
        $logo = ImageController::storeImage(request(), 'sponsor_logos', 'sponsorLogo');
    
        if ($logo) {
            // Crear el patrocinador
            Sponsor::create([
                'cif' => request('sponsorCIF'),
                'logo' => $logo,
                'name' => request('sponsorName'),
                'address' => request('sponsorAddress'),
                'pricePerRace' => request('sponsorCost'),
                'active' => request()->has('sponsorActive') ? 1 : 0,
            ]);
    
            // Redirigir con mensaje de éxito
            return redirect()->route('admin.sponsors')->with('success', 'Sponsor created successfully.');
        } else {
            // Redirigir con mensaje de error
            return redirect()->route('admin.sponsors')->with('error', 'There was an error while uploading the image, sponsor creation aborted.');
        }
    }
    

    public function edit($id) {
        
        $sponsor = Sponsor::find($id);

        if ($sponsor) {
            return view('administrator.sponsors.edit')->with('sponsor', $sponsor);
        } else {
            return redirect()->route('admin.sponsors')->with('error', 'Sponsor not found');
        }
    }

    public function update($id) {
        $sponsor = Sponsor::find($id);
    
        if ($sponsor) {
            request()->validate([
                'sponsorName' => 'required|string',
                'sponsorCIF' => 'required|string',
                'sponsorAddress' => 'required|string',
            ]);
    
            $originalValues = $sponsor->getOriginal();
    
            $logo = ImageController::storeImage(request(), 'sponsor_logos', 'sponsorLogo');
    
            $updatedValues = [
                'cif' => request('sponsorCIF'),
                'name' => request('sponsorName'),
                'address' => request('sponsorAddress'),
                'active' => request()->has('sponsorActive') ? 1 : 0,
            ];
    
            // Actualizar solo los campos que han cambiado
            $updatedValues = array_filter($updatedValues, function ($value, $key) use ($originalValues) {
                return $value !== $originalValues[$key];
            }, ARRAY_FILTER_USE_BOTH);
    
            // Si hay un nuevo logo, agregarlo a los valores actualizados
            if ($logo) {
                $updatedValues['logo'] = $logo;
            }
    
            // Actualizar el sponsor solo si hay cambios
            if (!empty($updatedValues)) {
                $sponsor->update($updatedValues);
                return redirect()->route('admin.sponsors')->with('success', 'sponsor updated correctly.');
            } else {
                return redirect()->route('admin.sponsors')->with('info', 'No changes detected.');
            }
        } else {
            return redirect()->route('admin.sponsors')->with('error', 'Sponsor not found.');
        }
    }
}
