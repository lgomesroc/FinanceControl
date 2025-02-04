<?php

namespace Illuminate\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetCacheHeaders
{
    /**
     * Manipula uma requisição e define os cabeçalhos de cache apropriados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Definindo os cabeçalhos de cache
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
    }
}
