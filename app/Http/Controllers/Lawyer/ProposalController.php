<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class ProposalController extends Controller
{
    public function create(){
        $user = Auth::user();
        return view('lawyer.pages.proposal.create', compact('user'));
    }
}
