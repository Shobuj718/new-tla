<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        
        if (Auth::guard($guard)->check()) {
            if($user->type == 'admin'){
                return redirect(RouteServiceProvider::HOME);
            }
            /*elseif($user->type == 'client'){
                return redirect()->to('/'.$user->uid.'/profile');
            }*/
            else{
                return redirect()->to('/'.$user->uid.'/'.$user->type.'/profile');
            }
        }

        return $next($request);
    }
}
