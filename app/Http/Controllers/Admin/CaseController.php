<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\Project;

class CaseController extends Controller
{
    public function list()
    {
        $casse = Project::all();
        return view('admin.case.caseList', compact('casse'));
    }
    public function add()
    {
        return view('admin.case.caseAdd');
    }
    
}
