<?php

namespace App\Http\Controllers\Lawyer;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use Carbon\Carbon;
use App\Model\Category;
use App\Model\User;
use App\Model\Project;
use App\Model\Attachment;
class ProjectController extends Controller
{
    public function create(){
        $user = Auth::user();
        $categories = Category::all();
        return view('lawyer.case_create', compact('user', 'categories'));
    }
    
    public function show($slug){
        $user = Auth::user();
        $project = Project::where('slug', $slug)->first();
        return view('lawyer.case_show', compact('user', 'project'));
    }
    
    
    public function store(Request $request){

        //return response()->json($request->all()); 
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
                $path               = 'images/lawyer/attachments/'.$new_name;
                
                $image->move(public_path('images/lawyer/attachments/'), $new_name);
    
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
        return view('lawyer.case_edit', compact('user', 'categories','project'));
    }
    public function updateCase(Request $request, $slug){
        // return response()->json($request);
        $user =  Auth()->user();
        $project=  Project::where('slug',$slug)->first();
        $project->title = $request->title;
        $project->created_by = $user->id;
        $project->post_code=$request->post_code;
        $project->budget = $request->budget;
        $project->lat = $request->lat;
        $project->lng = $request->lng;
        $project->category_id=$request->skill;
        $project->description = $request->description;
        $project->location_name = $request->location;
        $project->slug = uniqid("case_".$user->username."_");
        $project->valid_till = Carbon::now()->addMonths(2);
        
         if($request->hasFile('attachment')){
              $attachmentImage = Attachment::where('project_id', $project->id)->first();
                      File::delete('images/lawyer/attachments/'.$attachmentImage->name);

        //      $projectImage = public_path("images/lawyer/attachments/{$attachmentImage->name}"); // get previous image from folder
        // if (File::exists($attachmentImage)) { // unlink or remove previous image from folder
        //     unlink($attachmentImage);
        // }
            $image = $request->file('attachment');
            $image_origin_name = $image->getClientOriginalName();
            $file_name = pathinfo($image_origin_name, PATHINFO_FILENAME); // file
            $new_name = $file_name.rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/lawyer/attachments/'), $new_name);
            $path = 'attachments/'.$new_name;
            
            $attachment = Attachment::where('project_id', $project->id)->first();
            $attachment->name = $new_name;
            $attachment->path = $path;
            $attachment->save(); 
        
        }
        //  return response($project);
        $project->save();
         
          return response()->json([
	            'messageSuccess'    => 'Case Updated successfully.',
	            'data'              => $project,
	            'messageType'       => '',
	    ]);
    }
    }
    

