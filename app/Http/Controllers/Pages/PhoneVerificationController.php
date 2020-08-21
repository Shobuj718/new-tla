<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

// use App\Events\LawyerUpdatedHisProfile;
use App\Notifications\WelcomeEmail;
use Illuminate\Http\Request;
use Authy\AuthyApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LawyerUpdatedHisProfile;

class PhoneVerificationController extends Controller
{
    public function sendVerificationCode(Request $request){
        
        //return response()->json($request->all());
        
        $this->validate($request, [
            'country_code' => 'required',
            'phone_number' => 'required'
        ]);
        $authyApi = new AuthyApi(config('services.twilio.api_key'));
        //return response()->json(config('services.twilio.api_key'));
        $user = Auth::user();
        $authyUser = $authyApi->registerUser(
            $user->email,
            $request->phone_number,
            $request->country_code
            //config('services.twilio.country_code')
        );

        if ($authyUser->ok()) {
            $user->authy_id = $authyUser->id();
            //$user->country_code = config('services.twilio.country_code');
            $user->country_code = $request->country_code;
            $user->phone_number = $request->phone_number;
            $user->save();

            $sms = $authyApi->requestSms($user->authy_id);
            return response()->json([
                'user'      => $user,
                'sms'       => $sms,
                'status'    => 'success',
                'message'   => "Good Work! We've sent you a confirmation SMS. Please enter the code below to confirm your account."
            ]);

        } else {
            $errors = $authyUser->errors();
            if(is_object($errors)){
                $errors->status = "error";
            }

            if(is_array($errors)){
                $errors["status"] = "error";
            }

            return response()->json($errors);
        }
    }

    public function resendVerificationCode(Request $request){
        $user = Auth::user();

        if($user->country_code != $request->country_code && $user->phone_number != $request->phone_number){
            return $this->sendVerificationCode($request);
        }

        $authyApi = new AuthyApi(config('services.twilio.api_key'));
        $sms = $authyApi->requestSms($user->authy_id);

        if ($sms->ok()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Verification code re-sent!'
            ]);
        } else {
            $errors = $sms->errors();
            if(is_object($errors)){
                $errors->status = "error";
            }

            if(is_array($errors)){
                $errors["status"] = "error";
            }
            return response()->json($errors);
        }
    }

    public function verify(Request $request){
        //return response()->json($request->all());
        $this->validate($request, [
            'verification_code' => 'required'
        ]);
        
        //return response()->json($request->all());

        $authyApi = new AuthyApi(config('services.twilio.api_key'));
        $user = Auth::user();
        $verification = $authyApi->verifyToken($user->authy_id, $request->verification_code);
        if ($verification->ok()) {
            $user->phone_verified = true;
            $user->save();
            
            if($user->type == "lawyer"){
                // event(new LawyerUpdatedHisProfile($user));  
                //Notification::send(User::where('type', 'admin')->first(), new LawyerUpdatedHisProfile($user));
            } else {
                //if($user->profileComplete()){
                    $user->approved = true;
                    $user->save();
                    //Notification::send($user, new WelcomeEmail($user));
                //}
            }

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'message' => 'Phone verified successfully done.'
            ]);
        } else {
            $errors = $verification->errors();

            if(is_object($errors)){
                $errors->status = "error";
            }

            if(is_array($errors)){
                $errors["status"] = "error";
            }
            return response()->json($errors);
        }
    }
    
    public function getPhoneVarifyOrNot(Request $request){
        return response()->json([
                'success' => 'message'
            ]);
    }
    
    public function accountDetailsVarify(Request $request){
        //$user = Auth::where('id', $request->user_id)->first();
        
        return response()->json([
            //'user' => $user,
            'data' => $request->all()
        ]);

        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $email = $user->email;
        $location_name = $user->location_name;
        $post_code = $user->post_code;

        if($first_name && $last_name && $email && $location_name && $post_code){
            return response()->json([
                'success' => 'message'
            ]);
        }
    }
    
}
