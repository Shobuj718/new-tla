<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\Project;

class ProjectController extends Controller
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
    public function getCase(Request $request){

        ## Read value
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowperpage         = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Project::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Project::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Project::orderBy($columnName,$columnSortOrder)
            ->where('title', 'like', '%' .$searchValue . '%')
            ->select('projects.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $data = array();
        $sl = $start;
        $edit =  route('casse.active',$records->id);
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['title']                    = $record->title;
                $nestedData['budget']                   = $record->budget;
                $nestedData['description']              = substr(strip_tags($record->description), 0, 20);
                $nestedData['category_id']              = substr(strip_tags($record->category_id), 0, 5);
                $nestedData['location_name']            = substr(strip_tags($record->location_name), 0, 15);
                $nestedData['post_code']                = substr(strip_tags($record->post_code), 0, 8);
                $nestedData['options']                  = '<a href=""  class="waves-effect md-trigger" style="float: right;">|| DELETE</a>  
                                                           <a href="$edit"  class="waves-effect md-trigger" style="float: right; margin-right: 5px;"> APPROVED </a>';

                $data[] = $nestedData;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
        
      

        echo json_encode($response);
        exit;
    }
    public function caseApproveList()
    {
        return view('admin.case.caseApproveList');
    }
    
    public function getCaseApproveList(Request $request){

        ## Read value
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowperpage         = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Project::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Project::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Project::orderBy($columnName,$columnSortOrder)
            ->where('title', 'like', '%' .$searchValue . '%')
            ->where('valid_till',NULL)
            ->select('projects.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['title']                    = $record->title;
                $nestedData['budget']                   = $record->budget;
                $nestedData['description']              = substr(strip_tags($record->description), 0, 20);
                $nestedData['category_id']              = substr(strip_tags($record->category_id), 0, 5);
                $nestedData['location_name']            = substr(strip_tags($record->location_name), 0, 15);
                $nestedData['post_code']                = substr(strip_tags($record->post_code), 0, 8);
                $nestedData['options']                  = '<a href="client.case.edit" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; "> Delete </a>  
                                                           <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';

                $data[] = $nestedData;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
        
      

        echo json_encode($response);
        exit;
    }
    
    public function casePendingList()
    {
        return view('admin.case.casePendingList');
    }
    
    public function getCasePendingList(Request $request){

        ## Read value
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowperpage         = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Project::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Project::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Project::orderBy($columnName,$columnSortOrder)
            ->where('title', 'like', '%' .$searchValue . '%')
            ->whereNotNull('valid_till')
            ->select('projects.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['title']                    = $record->title;
                $nestedData['budget']                   = $record->budget;
                $nestedData['description']              = substr(strip_tags($record->description), 0, 20);
                $nestedData['category_id']              = substr(strip_tags($record->category_id), 0, 5);
                $nestedData['location_name']            = substr(strip_tags($record->location_name), 0, 15);
                $nestedData['post_code']                = substr(strip_tags($record->post_code), 0, 8);
                $nestedData['options']                  = '<a href="client.case.edit" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; "> Delete </a>  
                                                           <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>
                                                           <a href="http://demo.thelawapp.com.au/admin/case/inactive" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';
        
                $data[] = $nestedData;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
        
      

        echo json_encode($response);
        exit;
    }
    
    public function getActiveCase($id)
    {
        return $id;
    }
    
    
}
