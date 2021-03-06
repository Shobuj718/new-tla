<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;

class DashboardController extends Controller
{
    public function getProfile(){
        $user = Auth::user();
        return view($user->type.'.profile');
    }
}
