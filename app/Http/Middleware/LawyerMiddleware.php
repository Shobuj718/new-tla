<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class LawyerMiddleware
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
        if(Auth::user()->type != 'lawyer'){
            abort('404');
        }
        return $next($request);
    }
}
