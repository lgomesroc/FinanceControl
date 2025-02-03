<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableCsrfMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Desabilitar CSRF
        app()->instance('Illuminate\Session\TokenMismatchException', null);

        return $next($request);
    }
}

