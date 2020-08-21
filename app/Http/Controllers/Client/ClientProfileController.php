<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Auth;

class ClientProfileController extends Controller
{
    public function getProfile(){
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }
    public function editProfile(){
        $user = Auth::user();
        return view('client.edit_profile', compact('user'));
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
            
            if($user->type == "client"){
                $user->approved = 1;
            }
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
    
    public function profileImageUpload(Request $request){
        
        //return response()->json($request->all());
        
        try {
            
            $user = Auth()->user();
            if($request->hasFile('upload_client_profile_image')){
                $image              = $request->file('upload_client_profile_image');
                $image_origin_name  = $image->getClientOriginalName();
                $file_name          = pathinfo($image_origin_name, PATHINFO_FILENAME); // file
                $new_name           = $file_name.rand() . '.' . $image->getClientOriginalExtension();
                $path               = 'images/client/avatars/'.$new_name;
                
                $image->move(public_path('images/client/avatars/'), $new_name);
                $user->avatar = $new_name;
            }
            $user->save();
            
            
            return response()->json([
                'status'    => 'success',
                'message'   => 'Image upload successfully done.',
                'user'      => $user
            ]);
            
        } catch (\Exception $ex) {
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
    
    public function profileImageDelete(Request $request){
        
        //return response()->json($request->all());
        
        $user = Auth()->user();
        \File::delete(public_path('images/client/avatars/'. $user->avatar));
        $user->avatar = '';
        $user->save();
        
        return response()->json([
            'status'    => 'success',
            'message'   => 'Image deleted successfully done.',
            'user'      => $user,
            'public_path'      => public_path()
        ]);
        
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
