@extends('master')

@section('content')


 <div class=" breadcrumb-row">
    <div class="container">
        <div class="tla-breadcrumbs">Lawyer / Create case</div>
    </div>
</div>
    
<section class="client-edit-profile">
    <div class="container">
        <div class="client-edit-profile-row ptb15">
            <div class="client-edit-profile-first-column">
                <div class="client-edit-profile-first-column-inner">
                    <div class="border_1p whitebg client-edit-profile-first-column-top-box mb15 ptb25">
                        <div class="clientt-image">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQdwbqQHkf9g_PlvKPp4oGbhfQl1-D8DHizIw&usqp=CAU" alt="Client Image">
                        </div>
                        <div class="clientt-btn">
                            <a class="clientt-btn-upload" href="#">upload</a>
                            <a class="clientt-btn-delete" href="#">delete</a>
                        </div>
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
            <div class="post-case-middle-column pl15 width75">
                <div class="client-edit-profile-middle-column-inner">
                    <div class="border_1p whitebg client-edit-profile-middle-column-box client-edit-profile-middle-column-box1 mb15 plr25 ptb10">
                        <form  id="lawyerCaseCreated" name="lawyerCaseCreated">
                            <div class="client-form-row">
                                <h4>Case Details</h4>
                                <span id="success_message" style="color:#1cd6d3"></span>
                            </div>
                            <div class="client-form-row">
                                <label>Case Title (keep it short & clear)</label>
                                <input type="text" name="title" id="title" placeholder="Enter your case title">
                            </div>
                            <div class="client-form-row">
                                <label>Budget Amount of money you are willing to pay</label>
                                <div class="monney-field">
                                    <p style="border-right: none"> $ </p>
                                    <input type="number" name="budget" id="budget" placeholder="Enter your budget">
                                    <p style="border-left: none"> .00 </p>
                                </div>
                            </div>
                            <div class="client-form-row client-form-two-col">
                                <div class="width48 client-form-email">
                                    <label>Search and select your Location</label>
                                    <input type="text" name="location_name" id="location_name" placeholder="Enter a location" class="valid" aria-invalid="false">
                                    <input type="hidden" name="lat" id="lat" value="">
                                    <input type="hidden" name="lng" id="lng" value="">
                                </div>
                                <div class="width48 client-form-postcode">
                                        <label>Postcode</label>
                                        <input type="text" name="post_code" id="post_code" placeholder="e.g 1234">
                                </div>
                            </div>
                            <div class="client-form-row">
                                <label>Description Please give a brief description of the matter you would like help with</label>
                                <textarea name="description" id="description" placeholder="Write here"></textarea>
                            </div>
                            <div class="client-form-row">
                                <label>Attachment File extension: Png, Jpg, Pdf, Zip</label>
                                <input type="file" name="attachment" id="attachment">
                            </div>
                            <div class="client-form-row client-form-button pt10">
                                <button type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    @endsection

@section('scripts')

<script src="{{asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('backend/vendor/jquery/validate.min.js')}}"></script>

<script type="text/javascript">
 
 // Wait for the DOM to be ready

    $(function() {
      $("form[name='lawyerCaseCreated']").validate({
        rules: {
          title: "required",
          budget: "required",
          location_name: "required",
          post_code: "required",
          description: "required",
          attachment: "required",
        },
        messages: {
          title: "required",
          budget: "required",
          location_name: "required",
          post_code: "required",
          description: "required",
          attachment: "required"
        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#lawyerCaseCreated')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('lawyer.case.store')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                    $('#success_message').html(response.data.message).delay(5000).fadeOut();
                    $("#lawyerCaseCreated")[0].reset();
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    
     $(function() {
      $("form[name='user_phone_code']").validate({
        rules: {
          phone_number: "required",
          country_code: "required",
        },
        messages: {
          phone_number: "Please enter your phone_number",
          country_code: "Please enter your country_code",

        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#user_phone_code')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('client.send.varification.code','uId')}}",
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