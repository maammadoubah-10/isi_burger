<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check() && !$request->is('login') && !$request->is('register')) {
            return redirect(RouteServiceProvider::getHomeRoute());
        }
    
        return $next($request);
    }
    
}
