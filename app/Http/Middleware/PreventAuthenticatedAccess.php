<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAuthenticatedAccess
{
    public function handle($request, Closure $next)
    {
        // Jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        $response = $next($request);
        
        // Pastikan halaman auth tidak di-cache
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate, private')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
