<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OctaneRequestMiddleware
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
        $_REQUEST = $request->all();
        return $next($request);
    }
}
