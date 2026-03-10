<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next)
    {
        // If maintenance is ON and user is NOT a logged-in admin
        if (Setting::get('maintenance_mode') === '1' && !Auth::check()) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
