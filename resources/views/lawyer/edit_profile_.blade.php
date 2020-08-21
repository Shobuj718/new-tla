@extends('master')

@section('content')

     <!--tab start-->
   <div class="home-case-area user_profile_area">
        <div class="case_header_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs_link">
                            <div class="row">
                                <div class="tabs_ul col-lg-12 order-md-1 order-sm-2 order-2 wow fadeIn">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link-style active show" id="account-details-tab" data-toggle="pill" href="#account-details" role="tab" aria-controls="account-details" aria-selected="true">
                                                Account Details
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="user_profile_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="case_table_area">
                        <div class="tab-content" id="pills-tabContent">
                            
                            <div class="tab-pane fade active show" id="account-details" role="tabpanel" aria-labelledby="account-details-tab" style=" border-top: 5px solid #00c3c0;">
                                <div class="col-lg-12">
                                    
                                <div class="user_acc_details">
                                        <div class="row">
                                            <div class="col-lg-2 text-center">
                                                <div class="profile_img">
                                                    <img src="https://thelawapp.com.au/assets/img/user.png" alt="Profile Photo">
                                                </div>
                                                
                                                <form id="profile_picture_form" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="button" id="loadProfile" value="Change" onclick="document.getElementById('change_file').click();">
                                                        <input type="file" style="display:none;" id="change_file" name="change_file" accept="image/*">
                                                    </div>
                                                </form>
                                                
                                                <div class="previewProPic" style="display: none; margin-top: 10px;">
                                                    <span>Preview</span>
                                                    <img style="width: 80px; height: 80px; border-radius: 50%;" src="" alt="preview image">
                                                    <span>Click "Save Details" to upload this image.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <form  id="lawyerProfile" name="lawyerProfile" >
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="first_name" class="required">First Name</label>
                                                        <input type="text" class="form-control error" name="first_name" id="first_name" aria-describedby="namehelp" value="{{$user->first_name}}">
                                                        <span id="first_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id="last_name" aria-describedby="namehelp" value="{{$user->last_name}}">
                                                        <span id="last_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email Address : </label>
                                                   <input  class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$user->email}}">

                                                        <span id="email_error"></span>
                                                    </div>
                                                    <!-- This can't be removed even after making the whole changing on location, because who knows client's mind -->
                                                    <div style="display: none;">
                                                        <div class="form-group">
                                                            <label for="location">Choose Location</label>
                                                            <select id="location" name="location" class="form-control">
                                                                <option value="">Select a city</option>
                                                                    <option selected="" value="1">Sydney, Australia</option>
                                                                    <option value="2">South Melbourne, Australia</option>
                                                                    <option value="3">Brisbane, Australia</option>
                                                                </select>
                                                        </div>    
                                                    </div>
                                                    
                                                    <!-- This html for google map-->
                                                    <div class="form-group">
                                                        <label for="location">Search and select your Location</label>
                                                        <div class="pac-card" id="pac-card">
                                                            <div id="pac-container">
                                                                    <input id="pac-input" name="location_name" class="form-control pac-target-input" type="text" placeholder="Enter a location" value="{{$user->location_name}}" autocomplete="off">
                                                                    <input type="hidden" name="lat" id="lat" value="-27.4697707">
                                                                    <input type="hidden" name="lng" id="lng" value="153.0251235">
                                                                                                    
                                                            </div>
                                                        </div>
                                                        <span id="location_error"></span>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label for"post_code"="">Postcode</label>
                                                        <input type="text" class="form-control" name="post_code" id="post_code" value="{{$user->post_code}}" placeholder="e.g 1234">
                                                        <span id="postcode_error"></span>
                                                    </div>
                                                   
                                                    <div class="form-group rich_editor">
                                                       <label for="about_you">About</label>
                                                        <textarea class="form-control" id="about_you" name="about_you">{{ $user->about }}</textarea>
                                                                   <span id="about_you_error"></span>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                         <button id="saveAccountDetails" type="submit" class="boxed_btn">Confirm Account</button>
                                                        <input type="hidden" name="user_id" id="user_id" value="61">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="phone-verification" role="tabpanel" aria-labelledby="phone-verification-tab" style="border-top: 5px solid #00c3c0;">
                                <div class="col-lg-12">
                            
                                    <div class="user_profile_details phn-v" >
                                        <div class="phone_verify" >
                                            <h4>Verify your phone</h4>
                                            <form id="phone_verification" name="phone_verification">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-2 pr-0" style="display:;">
                                                        <select name="country_code" id="country_code"> 
                                                              <option value="">..Select Option..</option>
                                                            <option value="+61">AUS(+61)</option>
                                                            <option value="+1">USA(+1)</option>
                                                            <option value="+64">NZ(+64)</option>
                                                            <option value="+44">UK(+44)</option>
                                                            <option value="+1">CA(+1)</option>
                                                            <option value="+91">IND(+91)</option>
                                                            <option value="+88">BD(+88)</option>
                                                            
                                                        </select> 
                                                    </div>
                                                   <php
                                                  <?php
                                                    // dd($user);
                                                  ?>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="phone_number" name="phone_number" aria-describedby="phone_number" value="{{$user->phone_number}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="phone_number_error"></div>
                                                <div class="form-group">
                                                    <button id="sendVerificationCode" type="submit" class="boxed_btn">Next</button>
                
                                                    <button style="display: none;" id="resendVerificationCode" type="button" class="boxed_btn">Re-send Verification Code</button>
                                                </div>
                            
                                                <p id="message" style="display: none;font-size: 14px;" class="notify"><span>Good Work! We've sent you a confirmation SMS. Please enter the code below to confirm your account.</span></p>
                            
                                            </form>
                                        </div>
                            
                                        <div class="phone_verify_code">
                                            <form >
                                                <div class="row" id="hideResendVarification">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" style="display: none;" class="form-control" id="verificationCode" aria-describedby="phone_verify" placeholder="Enter verification code">
                                                        </div>
                                                    </div>
                                                    <div id="verification_code_error"></div>
                                                </div>
                                                <div class="form-group" id="hideSubmitButton">
                                                    <!-- <button type="submit" style="display: none;" class="boxed_btn" id="submitVerificationCode">Submit</button> -->
                            
                                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link-style" id="account-details-tab" data-toggle="pill" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">
                                                                <span data-toggle="tooltip" data-placement="top" title="Missing required information!"><button type="submit" onclick="getPhoneVarifyOrNot()" style="display:none ;" class="boxed_btn" id="submitVerificationCode">Submit &amp; Next</button></span>
                                                               <input type="hidden" name="user_id" id="user_id" value="61">
                                                            </a>
                                                        </li>
                                                    </ul>
                            
                                                </div>
                                                <div id="verificationMessage" class="alert"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-4">
                    <div class="edit_profile_sidebar" style="border-top: 5px solid #00c3c0;">
                        <div class="user_function">
                            <ul>
                                <li><a class="change-pass" href="#"><i class="fa fa-key"></i>Change Password</a></li>
                                    <li><a class="deactivate-account" href="#"><i class="fa fa-trash-o"></i>Deactivates your profile</a></li>
                                    
                            </ul>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    
    
    @endsection

@section('scripts')


<script src="{{asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('backend/vendor/jquery/validate.min.js')}}"></script>

<script type="text/javascript">
 
 // Wait for the DOM to be ready

    $(function() {
      $("form[name='lawyerProfile']").validate({
        rules: {
          first_name: "required",
          last_name:"required",
          email: "required",
          location_name:"required",
          about_you:"required",
          post_code:"required"
        },
        messages: {
          first_name: "require",
         last_name:"require",
          email: "require",
          location_name:"require",
          about_you:"require",
          post_code:"require"
          
        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#lawyerProfile')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('lawyer.update.profile')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    
</script>

<script>
     $(function() {
      $("form[name='phone_verification']").validate({
        rules: {
         country_code: "required",
          phone_number:"required"
         
        },
        messages: {
          country_code: "require",
         phone_number:"require"
          
        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#phone_verification')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('lawyer.send.varification.code')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
</script>

    
  


@endsection