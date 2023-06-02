<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiKeyFoodCartMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse | JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if ( !isset($apiKey) )
        {
            return abort(401, 'Unauthorized contact the manager to get the API Key');
        }

        if ( $apiKey != env('API_KEY_FOODFACTS') )
            return abort(401, 'Unauthorized, Invalid API Key');


        return $next($request);
    }
}
