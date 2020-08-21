<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Model\User;
use App\Model\Project;

class DashboardController extends Controller
{
    
    public function getCases(){
        $user = Auth::user();
        $cases = Project::where('project_type', 'maincase')->where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        //dd($cases);
        return view('client.cases', compact('user', 'cases'));
    }
    
    public function getSubCases(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getApprovedCases(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getPendingCasess(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getBidedCases(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getActiveCases(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getCompleteCases(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    public function getPayments(){
        $user = Auth::user();
        return view('client.cases', compact('user'));
    }
    
    
    public function getNotifications(){
        $user = Auth::user();
        return view('client.notifications', compact('user'));
    }
    
}
