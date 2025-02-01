<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Fideloper\Proxy\TrustProxies as BaseTrustProxies;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Os endereços IPs proxies de confiança.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * Os cabeçalhos que devem ser usados para detectar proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
