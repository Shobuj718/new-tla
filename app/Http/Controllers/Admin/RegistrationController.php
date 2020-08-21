<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('hi');
    //   $data= $this->validate($request,[
    //       'first_name' =>"required",
    //         'last_name' => "required",
    //         'email' =>"required",
    //         'username' => "required",
    //         'type' => "required",
    //         'lsm_number' => "required",
    //         'cpc_number' => "required",
    //         'password' => "required",
    //         'country_code' => "required",
    //         'gender' => "required",
    //     ]);
    //     dd($data);
    
    $users=[
        'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' =>  $request->email,
            'username' =>  $request->username,
            'lsm_number' => $request->lsm_number,
            'cpc_number' => $request->cpc_number,
            'email_confirmation_code' => $request->email_confirmation_code,
            // 'password' =>  $request->Hash::make($data['password']),
            'original_password' =>  $request->password,
            'country_code' => $request->country_code,
            'gender' =>  $request->gender,
            // 'approved' => $userType == 'client' ? true : false,
            
        
        ];
    
     dd($users);
        return response($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
