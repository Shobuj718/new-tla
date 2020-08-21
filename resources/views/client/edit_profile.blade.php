@extends('master')

@section('content')

 <div class=" breadcrumb-row">
    <div class="container">
        <div class="tla-breadcrumbs">Client / Edit Profile</div>
    </div>
</div>
    
<section class="client-edit-profile">
    <div class="container">
        <div class="client-edit-profile-row ptb15">
            
            <div class="client-edit-profile-first-column">
                <div class="client-edit-profile-first-column-inner">
                    <div class="border_1p whitebg client-edit-profile-first-column-top-box mb15 ptb25">
                        <div class="clientt-image">
                            
                            <?php if($user->avatar) { ?>
                                <img id="clientImageShow" class="clientImageUrl" src="{{asset('images/client/avatars/'.$user->avatar)}}"  alt="Client Image" />
                            <?php } else { ?>
                                <img id="clientImageShow"   src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQdwbqQHkf9g_PlvKPp4oGbhfQl1-D8DHizIw&usqp=CAU" alt="Client Image"   />
                            <?php } ?>
                            <img class="clientImageVisible" style="display:none;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQdwbqQHkf9g_PlvKPp4oGbhfQl1-D8DHizIw&usqp=CAU" alt="Client Image">
                        </div>
                        <div class="clientt-btn">
                            <a class="clientt-btn-upload" href="#" onclick="clientProfileImage()">upload</a>
                            <a class="clientt-btn-delete" href="#" onclick="clientProfileImageDelete()">delete</a>
                        </div>
                        <span id="profile_image_success" style="color:#1cd6d3"></span>
                        <span id="profile_image_delete" style="color:red"></span>
                    </div>
                    <div class="border_1p whitebg client-edit-profile-first-column-bottom-box">
                        <div class="user_function">
                            <ul>
                                <li><a href="https://thelawapp.com.au/upgrade"><i class="fa fa-money"></i>Account Details</a></li>
                                <li><a href="https://thelawapp.com.au/nupurbss"><i class="fa fa-eye"></i> Verify your phone</a></li>                                          
                                <li><a class="change-pass" href="#"><i class="fa fa-key"></i>Change Password</a></li>
                                <li><a class="deactivate-account" href="#"><i class="fa fa-trash-o"></i>Deactivate your profile</a></li>
                                <li><a href="https://thelawapp.com.au/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>Logout </a>
                                
                                    <form id="logout-form" action="https://thelawapp.com.au/logout" method="POST" style="display: none;">
                                        <input type="hidden" name="_token" value="n2z40VuemdtXqvx8ZoD5nirMrQO6bgP7qixPljyp">
                                    </form>                
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="client-edit-profile-middle-column plr15">
                <div class="client-edit-profile-middle-column-inner">
                    <div class="border_1p whitebg client-edit-profile-middle-column-box client-edit-profile-middle-column-box1 mb15 plr25 ptb10">
                        <form id="clientProfile" name="clientProfile">
                            <div class="client-form-row">
                                <h4>Account Details</h4>
                                <span id="success_message" style="color:#1cd6d3"></span>
                            </div>
                            <div class="client-form-row client-form-two-col">
                                <div class="width48 client-form-name-first">
                                    <label>First name *</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="Your first name " value="{{ $user->first_name ?? '' }}">
                                </div>
                                <div class="width48 client-form-name-last">
                                    <label>First name *</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Your last name " value="{{ $user->first_name ?? '' }}">
                                </div>
                            </div>
                            <div class="client-form-row client-form-two-col">
                                <div class="width48 client-form-email">
                                        <label>Email Address *</label>
                                        <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ $user->email ?? '' }}">
                                </div>
                                <div class="width48 client-form-postcode">
                                        <label>Postcode</label>
                                        <input type="text" name="post_code" id="post_code" placeholder="e.g 1234" value="{{ $user->post_code ?? '' }}">
                                </div>
                            </div>
                            <div class="client-form-row">
                                    <label>Search and select your Location *</label>
                                    <input type="text" name="location_name" id="location_name" placeholder="Enter a location" value="{{ $user->location_name ?? '' }}" class="valid" aria-invalid="false">
                                    <input type="hidden" name="lat" id="lat" value="{{ $user->lat ?? '' }}">
                                    <input type="hidden" name="lng" id="lng" value="{{ $user->lng ?? '' }}">
                            </div>
                            
                            <div class="client-form-row">
                                <label>About</label>
                                <textarea name="about" id="about" placeholder="Write here">{{ $user->about ?? '' }}</textarea>
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="border_1p whitebg client-edit-profile-middle-column-box client-edit-profile-middle-column-box2 mb15 plr25 ptb10">
                        <form id="user_phone_code" name="user_phone_code">
                            <div class="client-form-row">
                                <h4 >Verify your phone</h4>
                                <span id="send_message_success" style="color:#1cd6d3"></span>
                            </div>
                            <div class="client-form-row client-form-two-col">
                                <div class="width28 client-form-select">
                                    <label>Select country</label>
                                    <select id="country_code" name="country_code">
                                        <option value="" selected hidden>Select</option>
                                        <option value="+61">AUS(+61)</option>
                                        <option value="+1">USA(+1)</option>
                                        <option value="+64">NZ(+64)</option>
                                        <option value="+44">UK(+44)</option>
                                        <option value="+1">CA(+1)</option>
                                        <option value="+91">IND(+91)</option>
                                        <option value="+88">BD(+88)</option>
                                    </select>
                                </div>
                                <div class="width68 client-form-phone">
                                    <label>Phone number</label>
                                    <input type="text" name="phone_number" id="phone_number" placeholder="Enter your your phone no">
                                </div>
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit" id="sendVarifyButton">Send Verification Code</button>
                                <button style="display:none ;" id="resendVerificationCode">Re-send Verification Code</button>
                            </div>
                        </form>
                        <form id="user_phone_verify" name="user_phone_verify" style="display:none">
                            
                            <div class="client-form-row">
                                <label>Verification code</label>
                                <input type="text" name="verification_code" id="verification_code" placeholder="Enter verification code">
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="border_1p whitebg client-edit-profile-middle-column-box client-edit-profile-middle-column-box3 mb15 plr25 ptb10">
                        <form id="user_password_change" name="user_password_change">
                            <div class="client-form-row">
                                <h4>Change password</h4>
                                <span id="password_change"></span>
                            </div>
                            <div class="client-form-row">
                                <label>Current Password</label>
                                <input type="password" name="current_password" id="current_password" placeholder="Enter current password">
                            </div>
                            <div class="client-form-row">
                                <label>New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Enter new password">
                            </div>
                            <div class="client-form-row">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="border_1p whitebg client-edit-profile-middle-column-box client-edit-profile-middle-column-box4 plr25 ptb10">
                        <form>
                            <div class="client-form-row">
                                <h4>Deactivates your profile</h4>
                            </div>
                            <div class="client-form-row">
                                <label>I'm leaving because...</label>
                                <select name="I'm leaving because" id="_leaving">
                                  <option value="volvo">Choose a reason</option>
                                  <option value="volvo">Australia</option>
                                  <option value="saab">USA</option>
                                  <option value="mercedes">Bangladesh</option>
                                  <option value="audi">Ghana</option>
                                  <option value="audi">Uganda</option>
                                </select>
                            </div>
                            <div class="client-form-row">
                                <label>Tell us more (optional)</label>
                                <textarea placeholder="Write here"></textarea>
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="client-edit-profile-last-column">
                <div class="client-edit-profile-last-column-inner">
                    <div class="border_1p whitebg client-edit-profile-last-column-box client-edit-profile-last-column-box1 mb15 plr15 ptb10">
                        <div class="client-form-row">
                            <h4>Profile status</h4>
                        </div>
                        <div class="profile-ac-status">
                            <div class="profile-ac-status-single profile-ac-status-single-top">
                                <h4>Account Details</h4>
                                <div class="profile-ac-status-single-right">
                                    <div class="profile-ac-status-fill"></div>
                                    <span>100%</span>
                                </div>
                            </div>
                            <div class="profile-ac-status-single profile-ac-status-single-bottom">
                                <h4>Verify your phone</h4>
                                <div class="profile-ac-status-single-right">
                                    <span>Not verified yet</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border_1p whitebg client-edit-profile-last-column-box client-edit-profile-last-column-box2 plr15 ptb15">
                        <div class="client-form-row">
                            <h4>Notifications</h4>
                        </div>
                        <div class="profile-ac-notifications">
                            <div class="profile-ac-notifications-single">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form method="post" id="upload_logo" enctype="multipart/form-data" style="display:none;">
    {{ csrf_field() }}
    <input type="file" name="upload_client_profile_image" id="upload_client_profile_image"   />
</form>
    
    @endsection

@section('scripts')

<script src="{{asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('backend/vendor/jquery/validate.min.js')}}"></script>

<script type="text/javascript">
 
 // Wait for the DOM to be ready

    $(function() {
      $("form[name='clientProfile']").validate({
        rules: {
          first_name: "required",
          last_name: "required",
          location: "required",
          post_code: "required",
          about: "required",
          email: "required",
          location_name: "required",
        },
        messages: {
          first_name: "required",
          last_name: "required",
          location: "required",
          post_code: "required",
          about: "required",
          email: "required",
          location_name: "required",
        },
        submitHandler: function(form) {
          //form.submit();
          
                //console.log('Called');
                var form = $('#clientProfile')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('client.update.profile')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                    console.log(response.data.message);
                    $('#success_message').html(response.data.message).delay(5000).fadeOut();
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    
    //send verification code
    $(function() {
      $("form[name='user_phone_code']").validate({
        rules: {
          phone_number: "required",
          country_code: {
                required: {
                    depends: function(element) {
                        return $("#country_code").val() == '';
                    }
                }
            },
        },
        messages: {
          phone_number: "required",
          country_code: "required",
        },
        submitHandler: function(form) {
            
                console.log('Called');
                var form = $('#user_phone_code')[0];       
                var bodyFormData = new FormData(form);    
                console.log(bodyFormData);
                
                axios({
                    method: 'post',
                    url: "{{route('send.varification.code')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                    console.log(response.data.message);
                    $('#send_message_success').html(response.data.message).delay(5000).fadeOut();
                    $('#sendVarifyButton').css('display', 'none');
                    $('#resendVerificationCode').css('display', 'block');
                    $('#user_phone_verify').css('display', 'block');
                    
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    
    
    //confirm verification code
    $(function() {
      $("form[name='user_phone_verify']").validate({
        rules: {
          verification_code: "required",
        },
        messages: {
          verification_code: "required",
        },
        submitHandler: function(form) {
            
                console.log('Called');
                var form = $('#user_phone_verify')[0];       
                var bodyFormData = new FormData(form);    
                console.log(bodyFormData);
                
                axios({
                    method: 'post',
                    url: "{{route('varify.code')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                    $('#send_message_success').html(response.data.message).delay(5000).fadeOut();
                    $('#sendVarifyButton').css('display', 'block');
                    $('#resendVerificationCode').css('display', 'none');
                    $('#user_phone_verify').css('display', 'none');
                    //$("#user_phone_code")[0].reset();
                    $("#user_phone_verify")[0].reset();
                    
                })
                .catch(function (response) {
                    console.log(response);
                    $('#send_message_success').html('Invalid token!').delay(5000).fadeOut();
                });
                
 
        }
      });
    });
    
    //user change password
    $(function() {
      $("form[name='user_password_change']").validate({
        rules: {
            current_password: "required",
            new_password: "required",
            confirm_password: {
              equalTo: "#new_password",
            }
        },
        messages: {
            current_password: "required",
            new_password: "required",
            confirm_password: "new & confirm password does't match!",
        },
        submitHandler: function(form) {
            
                var form = $('#user_password_change')[0];       
                var bodyFormData = new FormData(form);    
                console.log(bodyFormData);
                
                axios({
                    method: 'post',
                    url: "{{route('client.password.change')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                    $('#password_change').html(response.data.message).css('color',response.data.color).delay(10000).fadeOut();
                    $("#user_password_change")[0].reset();
                })
                .catch(function (response) {
                    console.log(response);
                    $('#password_change').html('Something wrong!').delay(10000).fadeOut();
                });
                
 
        }
      });
    });
    
    //upload client profile image
    function clientProfileImage(){
        $("input[id='upload_client_profile_image']").focus().click();
        
         $("#upload_client_profile_image").change(function() {
             readURL(this);
            var bodyFormData = new FormData()
            if($("#upload_client_profile_image")[0].files.length>0){
               bodyFormData.append("upload_client_profile_image",$("#upload_client_profile_image")[0].files[0])
               console.log(bodyFormData);
               console.log('ok');
            }
            
            axios({
                method: 'post',
                url: "{{route('client.profile.image.upload')}}",
                data: bodyFormData,
                headers: {'Content-Type': 'multipart/form-data' }
            })
            .then(function (response) {
                console.log(response);
                $('#profile_image_success').html(response.data.message).delay(5000).fadeOut();
                $(".clientImageUrl").css('display', 'block');
                $(".clientImageVisible").css('display', 'none');
            })
            .catch(function (response) {
                console.log(response);
            });
            
         });
        
    }
    
    //delete client profile
    function clientProfileImageDelete(){
        var bodyFormData = new FormData()
        axios({
            method: 'post',
            url: "{{route('client.profile.image.delete')}}",
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' }
        })
        .then(function (response) {
            console.log(response);
            $('#profile_image_delete').html(response.data.message).delay(5000).fadeOut();
            $(".clientImageUrl").css('display', 'none');
            $(".clientImageVisible").css('display', 'block');
            
        })
        .catch(function (response) {
            console.log(response);
        });
    }
    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#clientImageShow').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    

</script>


@endsection