<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Project;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Auth;

class LawyerProfileController extends Controller
{
    public function getProfile(){
        $user = Auth::user();
        //  $users =  Auth()->user();
        //$project_data = Project::all();
        return view('lawyer.profile', compact('user'));
    }
    
    public function editProfile(){
        $user = Auth::user();
        return view('lawyer.edit_profile', compact('user'));
    }
    
    public function updateProfile(Request $request){
        
        //return response()->json($request->all());
        try {
            
            $user = Auth()->user();
            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->lat              = $request->lat;
            $user->lng              = $request->lng;
            $user->location_name    = $request->location_name;
            $user->post_code        = $request->post_code;
            $user->about            = $request->about;
            $user->save();
            
            
            return response()->json([
                'status'    => 'success',
                'message'   => 'Account details updated!',
                'user'      => $user
            ]);
            
        } catch (\Exception $ex) {
           //dd('Exception block', $ex);
           return response()->json([
                'status'    => 'error',
                'message'   => 'Something went wrong!, Exception block',
                'error_text'      => $ex
            ]);
        } catch (\Throwable $ex) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Something went wrong!, Throwable block',
                'error_text'      => $ex
            ]);
        }
        
        
    }
    
    public function userChangePassword(Request $request){
        
        return response()->json($request->all());
        
        $user = Auth::user();
        
        if(!Hash::check($request->current_password, $user->password)){
            return response()->json(['success'=>false, 'color'=>'red',  'message' => 'Current password does not match.']);
        }
        //if(Hash::check($request->new_password, $user->password)){
        else{
            
            $user->password = Hash::make($request->new_password);
            $user->original_password  = $request->new_password;
            $user->save();
            return response()->json(['success'=>true, 'color'=>'#1cd6d3', 'message' => 'Password updated successfully done.']);
            
            //return redirect('/edit-profile')->with('success', 'Password updated successfully!');
        }
        
    }
    
}
