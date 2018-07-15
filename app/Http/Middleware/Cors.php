<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Implementação para solucionar problema de 'Cross-Origin Resource Sharing'.
 */
class Cors
{

    /**
     * Intercepta a 'Request' e aplica a solução 'Cors'.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
      

        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Accept, Content-Type, Access-Control-Allow-Headers, Access-Control-Request-Method, Authorization, X-Token, X-Requested-With');
        $response->header('Access-Control-Max-Age', '3600');

        if ($request->isMethod('OPTIONS')) {
            $response->setStatusCode(200);
            $response->setContent('OK');
        }

        return $response;
    }
}
