<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;

class RaceController extends Controller {

    public function index() {
        $races = Race::get();
        
    }

    public function showAdministratorPanel() {
        $titulo = "NIGGER";
        $races = Race::get();

        return view('administrator.races.show', [
            'titulo' => $titulo,
            'races' => $races
        ]);
    }

    public function showCreatePanel() {

        return view('administrator.races.new');
    }

    public function create(Request $request) {

    }

    
}
