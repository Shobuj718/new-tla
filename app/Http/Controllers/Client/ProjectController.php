<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;
use App\Model\Category;
use App\Model\Project;
use App\Model\Attachment;

class ProjectController extends Controller
{
    public function create(){
        $user = Auth::user();
        $categories = Category::all();
        return view('client.case_create', compact('user', 'categories'));
    }
    
    public function show($slug){
        $user = Auth::user();
        $project = Project::where('slug', $slug)->first();
        //dd($project);
        return view('client.case_show', compact('user', 'project'));
    }
    
    public function store(Request $request){

        //return response()->json(intval($request->budget));
        try {
            $user = Auth::user();
            $project = new Project();
            $project->created_by    = $user->id;
            $project->title         = $request->title;
            $project->post_code     = $request->post_code;
            $project->budget        = intval($request->budget);
            $project->slug          = uniqid("case_".$user->username."_");
            $project->description   = $request->description;
            $project->valid_till    = Carbon::now()->addMonths(2);
            $project->location_name = $request->location_name;
            $project->lat           = $request->lat;
            $project->lng           = $request->lng;
    
           if($request->hasFile('attachment')){
                $image              = $request->file('attachment');
                $image_origin_name  = $image->getClientOriginalName();
                $file_name          = pathinfo($image_origin_name, PATHINFO_FILENAME); // file
                $new_name           = $file_name.rand() . '.' . $image->getClientOriginalExtension();
                $path               = 'images/client/attachments/'.$new_name;
                
                $image->move(public_path('images/client/attachments/'), $new_name);
    
                $attachment = new Attachment();
                $attachment->project_id = $project->id;
                $attachment->name = $new_name;
                $attachment->path = $path;
                $attachment->save();
            }
           $project->save();
           
           return response()->json([
                'status'    => 'success',
                'message'   => 'Case Created Successfully done.',
                'user'      => $user,
                'project'   => $project
            ]);
           
         }catch (\Exception $ex) {
           return response()->json([
                'status'    => 'error',
                'message'   => 'Something went wrong!, Exception block',
                'error_text'      => $ex
            ]);
        }catch (\Throwable $ex) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Something went wrong!, Throwable block',
                'error_text'      => $ex
            ]);
        }
       
    }
    
    public function editCase($slug){
        
        $user = Auth::user();
        $categories = Category::all();
        $project = Project::where('slug', $slug)->first();
        

        return view('client.case_edit', compact('user', 'categories', 'project'));
    }
    
    public function updateCase(Request $request, $slug)
    {
        /*if($request->hasFile('attachment')){
            $image = $request->file('attachment');
            $image_origin_name = $image->getClientOriginalName();
            return response()->json($image_origin_name);
        }
         return response()->json('error');*/
         
        $user = Auth::user();
        $project = Project::Where('slug', $slug)->first();
        $project->title = $request->title;
        $project->slug = uniqid("case_".$user->username."_");
        $project->budget = $request->budget;
        $project->category_id = $request->category_id;
        $project->location_name = $request->location_name;
        $project->post_code = $request->post_code;
        $project->description = $request->description;
        if($request->hasFile('attachment')){
            $image = $request->file('attachment');
            $image_origin_name = $image->getClientOriginalName();
            $file_name = pathinfo($image_origin_name, PATHINFO_FILENAME); // file
            $new_name = $file_name.rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/client/attachments/'), $new_name);
            $path = 'attachments/'.$new_name;
            
            $attachment = Attachment::where('project_id', $project->id)->first();
            $attachment->name = $new_name;
            $attachment->path = $path;
            $attachment->save();
        
        }
       $project->save();
       
       return response($project);
         
          $messageType = "";
         
         if($project){
             $messageType = "Success";
         }else{
             $messageType= "Error";
         }
         
         
          return response()->json([
	            'messageSuccess'    => 'Casee Added successfully.',
	            'data'              => $project,
	            'messageType'       => '',
	    ]);
    }
     
    public function getCaseOnPopup($title_slug){
        return view('client.client_case_show_by_title');
    }
}
