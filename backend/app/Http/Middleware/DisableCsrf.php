<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DisableCsrf
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Desabilitar a verificação CSRF para essa requisição
        app()->instance('Illuminate\Session\TokenMismatchException', null);

        return $next($request);
    }
}
