<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class PhoneVerificationController extends Controller
{
   public function sendVerificationCode(Request $request){
       
        // return response($request->all());
         
        $user =  Auth()->user();
        $lawyer=  User::where('uid', $user->uid)->first();

    //      //return response($package);
        
         $lawyer->country_code = $request->country_code;
         $lawyer->phone_number = $request->phone_number;
         $lawyer->save();
         
          return response()->json([
	            'messageSuccess'    => 'Lawyer Updated successfully.',
	            'messageError'      => 'Error while Update new Lawyer.',
	            'data'              => $lawyer,
	            'messageType'       => '',
	    ]);
   }
}
