<?php

namespace Illuminate\Auth\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Tenta autenticar o usuário utilizando autenticação básica
        if (Auth::guard($guard)->guest()) {
            throw new AuthenticationException('Unauthenticated.', [$guard]);
        }

        return $next($request);
    }
}
