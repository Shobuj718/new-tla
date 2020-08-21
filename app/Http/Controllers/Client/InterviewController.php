<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;

class InterviewController extends Controller
{
    public function conversations(){
        $user = Auth::user();
        return view('client.conversations', compact('user'));
    }
}
