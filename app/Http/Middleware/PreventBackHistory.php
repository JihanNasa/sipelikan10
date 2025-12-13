<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        // Header cache control yang lebih kuat
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate, private')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT')
                        ->header('X-Accel-Expires', '0') // Untuk Nginx
                        ->header('X-Content-Type-Options', 'nosniff')
                        ->header('X-Frame-Options', 'DENY')
                        ->header('X-XSS-Protection', '1; mode=block')
                        ->header('Referrer-Policy', 'strict-origin-when-cross-origin');
    }
}
