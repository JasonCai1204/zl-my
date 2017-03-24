<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiCheckDoctor
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
        if (Auth::user()->role_type != 'App\Doctor') {

            Auth::user()->token()->revoke();

            return redirect()->back()->withInput(['msg'=>'您的帐号没有 "肿瘤名医医生版" 的使用权限，请使用 "肿瘤名医" 。']);

        }

        return $next($request);
    }
}
