<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (@Auth::user()->is_active == false) {
            return redirect('account/deactivated');
        }

        return $next($request);
    }
}
