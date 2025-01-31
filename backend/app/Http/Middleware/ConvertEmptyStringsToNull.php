<?php

namespace Illuminate\Foundation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertEmptyStringsToNull
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Converter todos os parâmetros da requisição para null, caso estejam vazios
        $this->convertEmptyStringsToNull($request);

        return $next($request);
    }

    /**
     * Converter todos os parâmetros vazios para null.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function convertEmptyStringsToNull(Request $request)
    {
        $request->merge(array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $request->all()));
    }
}
