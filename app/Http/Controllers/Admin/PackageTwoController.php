<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PackageTwoController extends Controller
{
    //
    public function allPackages()
    {
    	$packages = Package::all();
    	return view('.all-packages', compact('packages'));
    }
    
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
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $show =  route('package.show',$post->id);
                $edit =  route('package.edit',$post->id);

                $nestedData['id'] = $post->id;
                $nestedData['package_name'] = $post->package_name;
                $nestedData['package_description'] = substr(strip_tags($post->package_description),0,50)."...";
                $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                $nestedData['options'] = "<a href='{$edit}' class='btn btn-sm' style='background-color:#3c968a;color:#fff;' pagename='Single package edit' data-remote='false' data-toggle='modal' data-target='.modal'>edit</a>";
                $data[] = $nestedData;

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
    
}
