<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneVerificationController extends Controller
{
    
    public function sendVerificationCode(Request $request)
    {
    //  return response($request->all());
        $code_phone = Auth()->user();
      
         $code_phone = User::where('uid', $code_phone->uid)->first();
       
         
        //  $user = new User(); 
         $code_phone->phone_number      = $request->phone_number;
         $code_phone->country_code       = $request->country_code;
         $code_phone->save();
         
         return response($code_phone);
         
          $messageType = "";
         
         if($code_phone){
             $messageType = "Success";
         }else{
             $messageType= "Error";
         }
         
         
          return response()->json([
	            'messageSuccess'    => 'Package Added successfully.',
	            'messageError'      => 'Error while add new Pckage.',
	            'data'              => $code_phone,
	            'messageType'       => '',
	    ]);
    }
}
