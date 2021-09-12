<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserApproved
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
        if (!auth()->user()){
            return redirect()->route('login')->withErrors(['msg', 'Access Denied! Login here']);
        }
        elseif (!auth()->user()->approved_at) {
            auth()->guard()->logout();
            return redirect()->route('approval');
        }
        return $next($request);
    }
}
