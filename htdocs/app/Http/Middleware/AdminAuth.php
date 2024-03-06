<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            
            $currentPage = $request->route()->getName();

            if (!Str::startsWith($currentPage, 'admin.races.new')) {
                // Continuar con la solicitud y no destruir las variables de sesión
                session()->forget(['raceDetails', 'raceInsurances', 'raceSponsors']);
            }
        
            // Si la ruta no comienza con 'admin.races', destruir las variables de sesión
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
