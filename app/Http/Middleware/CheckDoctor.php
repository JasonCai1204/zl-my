<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDoctor
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
        if (Auth::guard()->user()->role_type != 'App\Doctor') {

            Auth::guard()->logout();

            $request->session()->flush();

            $request->session()->regenerate();

            return redirect('doctors.notice');
        }

        return $next($request);
    }
}