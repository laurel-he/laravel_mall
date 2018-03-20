<?php

namespace App\Http\Middleware;

use Closure;

class CrossHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);

        $response = $next($request);
//         $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Origin', 'http://localhost:8080');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS, DELETE');
        $response->header('Access-Control-Allow-Headers', 'x-requested-with,Content-Type,Origin, Cookie, Accept');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;

    }
}
