<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $user)
    {
        if((Auth::user()->role === 'admin' && $user === 'admin')){
            return $next($request);
        }
        if((Auth::user()->role === 'support' && $user === 'support')){
            return $next($request);
        }else{
            abort(403, 'Unauthorized');
        }
    }
}
