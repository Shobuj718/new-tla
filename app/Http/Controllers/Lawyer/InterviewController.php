<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;

class InterviewController extends Controller
{
    public function conversations(){
        $user = Auth::user();
        return view('lawyer.dashboard.conversations', compact('user'));
    }
}
