<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class TransformResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->headers->get('Content-Type') === 'application/json') {
            $original = $response->original;

            if (is_array($original) && !array_key_exists('success', $original)) {
                $response->setData([
                    'success' => $response->isSuccessful(),
                    'data' => $original,
                ]);
            }
        }

        return $response;
    }
}