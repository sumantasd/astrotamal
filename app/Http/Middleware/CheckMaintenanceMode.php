<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceEnabled = SiteSetting::get('maintenance_mode', '0') === '1';

        if ($maintenanceEnabled) {
            // Allow admin routes, login routes, health check, or logged in admin users
            if (
                $request->is('admin-tamal*') ||
                $request->is('admin*') ||
                $request->is('login') ||
                $request->is('up') ||
                (auth()->check() && (auth()->user()->is_admin ?? false))
            ) {
                return $next($request);
            }

            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}
