<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RaceCreating
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('raceDetails')) {
            if ($request->route()->getName() == 'admin.races.new.sponsors') {
                if (session()->has('raceInsurances')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
        }

        // Si no existe, redirigir o devolver una respuesta denegada
        return redirect()->route('admin.races.new')->with('error', 'An error has occurred while creating the race');
    }
}
