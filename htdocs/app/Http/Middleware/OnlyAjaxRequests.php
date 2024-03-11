<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAjaxRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax() || !$request->header('X-Requested-With') == 'XMLHttpRequest') {
            abort(403, 'Access denied. This route is only accessible through AJAX requests.');
        }

        return $next($request);
    }
}
