(function ($) {
    "use strict";
    
   let place_name, place_lat, place_lng;

    function printResponseMessage(data){
        if(data.status == 'success'){
            $('#response_message').html('<div class="alert alert-success mt-20">'+data.message+'</div>');
        }

        if(data.status == 'error'){
            $('#response_message').html('<div class="alert alert-danger mt-20">'+data.message+'</div>');
        }
    }
    
    // get location from google map
    
    
    
    $(document).ready(function(){
        
        /*if($('#map').length == 1){
            initMap();
        }*/
        
        function readURL(input) {

          if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
              $('.previewProPic img').attr('src', e.target.result);
            }
        
            reader.readAsDataURL(input.files[0]);
          }
        }
        
        $("#change_file").on('change', function() {
          readURL(this);
          $('.previewProPic').css({"display": "block"});
        });
        
        $('#saveAccountDetails').click(function (e) {
            e.preventDefault();
            $('.err-message').remove();
            $('#response_message .alert').remove();

            let firstName = $('#first_name').val();
            let lastName = $('#last_name').val();
            let email = $('#email').val();
            // let location = $('#location').val();
            let location = $('#pac-input').val(); // this val take google location, for required clent location input form(s)
            //let location = 1;
            let post_code = $('#post_code').val();
            
            let location_name = place_name;
            let lat = place_lat;
            let lng = place_lng;
            let about_you = tinyMCE.activeEditor.getContent();
            
            console.log(about_you);
           // return false;

            if (!firstName) {
                $('#first_name_error').html("<span class='err-message'>The first name field is required!</span>");
            }
            if (!lastName) {
                $('#last_name_error').html("<span class='err-message'>The last name field is required!</span>");
            }
            if (!email) {
                $('#email_error').html("<span class='err-message'>The email field is required!</span>");
            }
            if (!location) {
                $('#location_error').html("<span class='err-message'>The location field is required!</span>");
            }
            if(!post_code) {
                $('#postcode_error').html("<span class='err-message'>The Post Code field is required!</span>");
            }
            if(!about_you) {
                $('#about_you_error').html("<span class='err-message'>The Post Code field is required!</span>");
            }
            
            if (firstName && lastName && email && location && about_you) {
             
                
                $('.previewProPic').css({"display": "none"});
             
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let fd = new FormData($('form#profile_picture_form')[0]);
                fd.append('first_name', firstName);
                fd.append('last_name', lastName);
                fd.append('email', email);
                fd.append('location', '1'); // set location always integer, this is set previous developer(s)
                fd.append('post_code', post_code);
                fd.append('lat' , lat);
                fd.append('lng' , lng);
                fd.append('location_name' , location); // previously set location_name, for now entry and update set it location(s)
                fd.append('about_you' , about_you);
                //alert(location); //check the input location(s)
                $.ajax({
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    method: "post",
                    url: '/save-account-details',
                    data: fd
                }).done(function (data) {
                    console.log(data);
                    if(data.account_tab_complete){
                        $('#account-details-tab').html("Account Details");
                    }
                    
                    if(data.profile_complete){
                        $('.profile-complete-popup').addClass('show');
                    }
                    
                    if(data.avatar){
                        $('.profile_img img')[0].src = window.location.origin+"/"+data.avatar;
                        $('#profile_image')[0].src = window.location.origin+"/"+data.avatar;
                    }
                    printResponseMessage(data);
                }).fail(function (data) {
                    let errors = data.responseJSON.errors;

                    $('#first_name_error').html("<span class='err-message'>"+errors['first_name']+"</span>");
                    $('#last_name_error').html("<span class='err-message'>"+errors['last_name']+"</span>");
                    $('#email_error').html("<span class='err-message'>"+errors['email']+"</span>");
                    $('#location_error').html("<span class='err-message'>"+errors['location']+"</span>");
                    $('#postcode_error').html("<span class='err-message'>"+errors['post_code']+"</span>");
                });
            }
        });
        
        $('.profile-complete-popup .close').click(function () {
            if ($('.profile-complete-popup').hasClass('show')) {
                $('.profile-complete-popup').removeClass('show');
            }
        });
        
        // phone verification
        $('#sendVerificationCode').click(function (e) {
            e.preventDefault();
            $('#response_message .alert').remove();
            let phone_number = $('#phone_number').val();
            let country_code = $('#country_code').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: sendVerificationCodeUrl,
                data: {phone_number: phone_number, country_code: country_code}
            }).done(function (msg) {
                console.log(msg);
                if (msg.status == "success") {
                    $('#message').css({"display": "block"});
                    $('#sendVerificationCode').css({"display": "none"});
                    $('#resendVerificationCode').css({"display": "block"});
                    $('#verificationCode').css({"display": "block"});
                    $('#submitVerificationCode').css({"display": "block"});
                }
                if (msg.status == "error") {
                    $('#message span').html(msg.message);
                    $('#message').css({"display": "block"});
                }
            }).fail(function (data) {
                let error = data.responseJSON;
                console.log(error);
            });
        });

        $('#resendVerificationCode').click(function (e) {
            e.preventDefault();
            $('#response_message .alert').remove();

            var phone_number = $('#phone_number').val();
            var country_code = $('#country_code').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: resendVerificationCodeUrl,
                data: {phone_number: phone_number, country_code: country_code}
            }).done(function (msg) {
                if (msg.status == "success") {
                    $('#message').css({"display": "block"});
                    $('#sendVerificationCode').css({"display": "none"});
                    $('#resendVerificationCode').css({"display": "block"});
                    $('#verificationCode').css({"display": "block"});
                    $('#submitVerificationCode').css({"display": "block"});
                    $('#verificationCode').css({"display": "block"});
                    $('#submitVerificationCode').css({"display": "block"});
                    $('#verificationCode').val('');
                    
                }
                if (msg.status == "error") {
                    $('#message span').html(msg.message);
                    $('#message').css({"display": "block"});
                }
            });
        });

        $('#submitVerificationCode').click(function (e) {
            e.preventDefault();
            $('#response_message .alert').remove();

            let verification_code = $('#verificationCode').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: postVerificationCodeUrl,
                data: {verification_code: verification_code}
            }).done(function (msg) {
                if (msg.status == "success") {
                    //$('#account-details').trigger('click');
                    $('#verificationMessage').html(msg.message);
                    $('#verificationMessage').removeClass('alert-danger');
                    $('#verificationMessage').addClass('alert-success');
                    $('#verificationMessage').css({"display": "block"});

                    $('#phone-verification-tab').html('Phone Verification');
                    
                    
                    
                    if(msg.profile_complete){
                        $('.profile-complete-popup').addClass('show');    
                    }

                    $.ajax({
                        method: "get",
                        url: "/user-info",
                    }).done(function (data) {
                        $('#verified_phone_no').html("<div class='alert alert-success'>Verified With: " + data.country_code + " " + data.phone_number+"</div>");
                    });
                }
                if (msg.status == "error") {
                    $('#verificationMessage').html(msg.message);
                    $('#verificationMessage').removeClass('alert-success');
                    $('#verificationMessage').addClass('alert-danger');
                    $('#message').css({"display": "block"});
                }
            });
        });
    });
})(jQuery);
