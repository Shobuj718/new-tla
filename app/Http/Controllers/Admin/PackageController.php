<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use DB;
use Spatie\Permission\Traits\HasRoles;


class PackageController extends Controller
{
    
    public function allPosts(Request $request)
    {
        
        $columns = array( 
                            0 =>'id', 
                            1 =>'package_name'
                        );
  
        $totalData = Package::count();
     
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = Package::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  Package::where('id','LIKE',"%{$search}%")
                            ->orWhere('package_name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Package::where('id','LIKE',"%{$search}%")
                             ->orWhere('package_name', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        $sl = $start;
        
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                
                $show =  route('package.show',$post->id);
                $edit =  route('package.edit',$post->id);

                $nestedData['id'] = $sl;
                $nestedData['package_name'] = $post->package_name;
                $nestedData['package_description'] = substr(strip_tags($post->package_description),0,50)."...";
                $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                $nestedData['options'] = "<a href='{$edit}' class='btn btn-sm' style='background-color:#3c968a;color:#fff;' pagename='Single package edit' data-remote='false' data-toggle='modal' data-target='.modal'>edit</a>";
                $data[] = $nestedData;
                $sl++;
                /*<a href='{$show}' class='btn btn-sm btn-info ' pagename='Single package details' data-remote='false' data-toggle='modal' data-target='.modal' >show</a>*/

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
        
    }
    
    public function list()
    {
    // 	$allPackages['allPackages'] = Package::all();
    
    	return view('admin.package.packageList');
    }
    
    
     public function getPackage(Request $request){

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
        $totalRecords = Package::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Package::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Package::orderBy($columnName,$columnSortOrder)
            ->where('name', 'like', '%' .$searchValue . '%')
            ->select('packages.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $sl = $start;
        foreach($records as $record){
                $sl++;
                $nestedData = array();
                $nestedData['id']                       = $sl;
                $nestedData['name']                     = $record->name;
                $nestedData['description']              = $record->description;
                $nestedData['first_month_subscription'] = $record->first_month_subscription;
                $nestedData['subscription_fee']         = $record->subscription_fee;
                $nestedData['max_bids']                 = $record->max_bids;
                $nestedData['max_skills']               = $record->max_skills;
                 $nestedData['options']      = '<a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; "> Delete </a>  <a href="http://demo.thelawapp.com.au/admin/case/add" pagename="Add New Case" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';

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
        return view('admin.package.packageAdd');
    }
    public function edit($id)
    {
        $allPackage = Package::find($id);
        return view('admin.package.packageEdit', compact('allPackage'));
    }
    public function store(Request $req)
    {
         //return response($req->all());
         $package =new Package();
         $package->name = $req->name;
         $package->first_month_subscription = $req->first_month_subscription_fee;
         $package->subscription_fee = $req->subscription_fee;
         $package->max_bids = $req->max_bids;
         $package->max_skills = $req->max_skills;
         $package->description = $req->summaryckeditor;
         $package->save();
         
         return response($package);
         
         
         $messageType = "";
         
         if($package) {
             $messageType = "Success";
         } else {
             $messageType = "Error";
         }
         
        return response()->json([
	            'messageSuccess'    => 'Package Added successfully.',
	            'messageError'      => 'Error while add new Pckage.',
	            'data'              => $package,
	            'messageType'       => $messageType,
	    ]);
        
    }
    public function update(Request $req)
    {
        //return response($req->all());
         
         $package = Package::where('id', intval($req->packageId))->first();
         //return response($package);
         
         $package->name = $req->name;
         $package->first_month_subscription = $req->first_month_subscription_fee;
         $package->subscription_fee = $req->subscription_fee;
         $package->max_bids = $req->max_bids;
         $package->max_skills = $req->max_skills;
         $package->description = $req->summaryckeditor;
         $package->save();
         
          return response()->json([
	            'messageSuccess'    => 'Package Added successfully.',
	            'messageError'      => 'Error while add new Pckage.',
	            'data'              => $package,
	            'messageType'       => '',
	    ]);
         
    }
}
