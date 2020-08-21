<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
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
        
        /*if(Auth::user()->type != 'admin'){
            abort('404');
        }*/
        
        $user = Auth::user();
        
        if(Auth::user()->type == 'client'){
            return redirect()->to('/'.$user->uid.'/client/profile');
        }
        
        if(Auth::user()->type == 'lawyer'){
            return redirect()->to('/'.$user->uid.'/lawyer/profile');
        }

        if(Auth::user()->type == 'admin'){
            return $next($request);
        }

        return redirect('/login');
        
        //return $next($request);
    }
}
