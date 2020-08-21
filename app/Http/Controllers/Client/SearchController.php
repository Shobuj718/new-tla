<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Model\Category;

class SearchController extends Controller {
    
    public function getFindLawyersPage(){
        $user = Auth::user();
        $categories = Category::all();
        return view('client.find_lawyers', compact('user', 'categories'));  
            
    }
    public function getSearchCases(){
        $user = Auth::user();
        $categories = Category::all();
        return view('client.search_cases', compact('user', 'categories'));  
            
    }
    
   
}