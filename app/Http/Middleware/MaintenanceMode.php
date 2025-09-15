<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        if(settings()->get('app_maintenance_mode') == true && Auth::user()->user_type == 2) {
            return redirect('maintenance ');
        }

        return $next($request);
    }
}
