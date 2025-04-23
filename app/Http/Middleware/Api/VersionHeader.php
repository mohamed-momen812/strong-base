<?php

namespace App\Http\Middleware\Api;

use Closure;

class VersionHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        $response->headers->set(
            'X-Api-Version',
            config('app.api_version')
        );
        
        return $response;
    }
}