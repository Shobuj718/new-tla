<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use App\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {

        request()->validate([
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        if($user->type != $request->type){
            return \Redirect::to("/")->withErrors('You have entered invalid user type.');
        }
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //return redirect()->intended('admin');
            
            if($user->type == 'admin'){
                return redirect()->intended('admin');
            }else{
                return redirect()->to('/'.$user->uid.'/'.$request->type.'/profile');
            }
        }
        return \Redirect::to("/")->withErrors('You have entered invalid credentials');
    }
    
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
}
