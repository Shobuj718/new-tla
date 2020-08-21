<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\Category;

class CategoryController extends Controller
{
    public function list()
    {
        $allCategories = Category::all();
        return view('admin.category.categoryList', compact('allCategories',$allCategories));
    }
    
    
    public function getCategory(Request $request){
        
        ## Read value
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Category::orderBy($columnName,$columnSortOrder)
            ->where('name', 'like', '%' .$searchValue . '%')
            ->select('categories.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl=$start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                // $edit =  route('category.edit',$post->id);
                // $edit =  route('category.delete',$post->id);
                $nestedData['id']                       = $sl;
                $nestedData['name']           = $record->name;
                $nestedData['description']         = $record->description;
                $nestedData['options']      = '<a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right;"> Delete </a>  <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>
';
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
    
    public function add()
    {
        return view('admin.category.categoryAdd');
    }
}
