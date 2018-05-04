<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isSupermanAdmin
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
        if(Auth::user() && Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'manager' || Auth::user()->role == 'user') {
            return $next($request);
        }

        return redirect('/');
    }
}
