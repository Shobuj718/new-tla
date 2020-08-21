<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    
    public function clientDashboard(){
        dd('asdf');
        $user = $request->user(); //getting the current logged in user
    }
}
