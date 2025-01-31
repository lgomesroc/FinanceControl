<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Manipula a solicitação.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();

        // Verifica se o usuário está autenticado e tem a função necessária
        if (!$user || !$user->hasRole($role)) {
            return response()->json(['message' => 'Acesso não autorizado'], 403);
        }

        return $next($request);
    }
}
