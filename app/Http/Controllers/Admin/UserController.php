<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view()
    {
    	$allUsers['allUsers'] = User::all();
    	return view('admin.user.userList', $allUsers);
    }
    public function add()
    {
    	return view('admin.user.addUser');
    }
     public function getUser(Request $request){

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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('username', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('username', 'like', '%' .$searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['name']                = $record->first_name." ".$record->last_name;
                 $nestedData['username']                = $record->username;
                 $nestedData['phone']                = $record->phone_number;
                $nestedData['email']              = $record->email;
                $nestedData['location']              = $record->location_name;
                 $nestedData['options']      = '<a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New User" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; "> Delete </a>  <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';

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
    
    public function store(Request $req)
    {
        return response()->json($req->all());
    	$user = new User();
    	$user->userType = $req->userType;
    	$user->name = $req->name;
    	$user->email = $req->email;
    // 	$user->password =bcrypt($req->password);
    	$user->save();

    	return redirect()->route('users.view');

    }
    
    
    public function UserApproveList()
    {
        return view('admin.user.userApproveList');
    }
    public function getUserApproveList(Request $request){

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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('username', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('username', 'like', '%' .$searchValue . '%')
            ->where('approved', 1)
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['name']                = $record->first_name." ".$record->last_name;
                 $nestedData['username']                = $record->username;
                 $nestedData['phone']                = $record->phone_number;
                $nestedData['email']              = $record->email;
                $nestedData['location']              = $record->location_name;
                 $nestedData['options']      = '<a href="https://thelawapp.com.au/admin/user/103/disprove" class="btn btn-warning" style="margin-right: 4px;">Disapprove</a><a href="https://thelawapp.com.au/admin/user/102/suspend" class="btn btn-danger">Suspend</a> <a href="https://thelawapp.com.au/admin/user/102/edit" class="btn btn-info">Edit</a>';

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
    
    public function UserPendingList()
    {
        return view('admin.user.userPendingList');
    }
    public function getUserPendingList(Request $request){

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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('username', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('username', 'like', '%' .$searchValue . '%')
            ->where('approved',0)
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['name']                = $record->first_name." ".$record->last_name;
                 $nestedData['username']                = $record->username;
                 $nestedData['phone']                = $record->phone_number;
                $nestedData['email']              = $record->email;
                $nestedData['location']              = $record->location_name;
                 $nestedData['options']      = '<a href="{{route("approve",$id)}}" class="btn btn-success" style="margin-right: 4px;">Approve</a><a href="https://thelawapp.com.au/admin/user/102/suspend" class="btn btn-danger">Suspend</a> <a href="https://thelawapp.com.au/admin/user/102/edit" class="btn btn-info">Edit</a>';

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
    
    public function userApprove($id) {
        // dd($uid);
    $user = User::where('id',$id)->first();
    if($user)
    {
        $user->approved= 1;
        $user->save();
        return view('admin.user.userPendingList');
}
}
    
    public function UserSuspendList()
    {
        return view('admin.user.userSuspendList');
    }
    public function getUserSuspendList(Request $request){

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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('username', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('approved', 'like', '%' .$searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['name']                = $record->first_name." ".$record->last_name;
                 $nestedData['username']                = $record->username;
                 $nestedData['phone']                = $record->phone_number;
                $nestedData['email']              = $record->email;
                $nestedData['location']              = $record->location_name;
                 $nestedData['options']      = '<a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New User" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; "> Delete </a>  <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';

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
    
}
