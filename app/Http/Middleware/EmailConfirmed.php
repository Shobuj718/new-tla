<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailConfirmed
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
        if(Auth::user()->email_confirmed){
            return $next($request);
        } else {
            Auth::logout();
            return redirect('/login')->with('success', 'Thank you for your registration. Please check your email for a confirmation to activate your account. Check your Junk folder shouyld you not receive the email promptly.');
        }

    }
}
