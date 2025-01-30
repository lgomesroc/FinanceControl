<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Os URIs que devem ser acessíveis mesmo quando o aplicativo estiver em manutenção.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
