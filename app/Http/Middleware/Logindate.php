<?php

namespace App\Http\Middleware;

use Closure;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class Logindate
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
        if (Auth::check()) {
            auth()->user()->old_login = auth()->user()->new_login;
            auth()->user()->new_login = Verta::now();
            auth()->user()->save();
        }
        return $next($request);
    }
}
