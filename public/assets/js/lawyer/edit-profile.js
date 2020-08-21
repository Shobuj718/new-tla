(function ($) {
    "use strict";
    
    let place_name, place_lat, place_lng;

    function updateRecurringSubscriptionStatusInDB(action){
        let url= action+"_recurring_payment";
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: url,
            method: "post"
        }).done(function (data) {
            console.log(data);
        }).fail(function (data) {
            console.log(data);
        });
    }
    
    function clearFileInput(inputId) {
        let input = $(inputId);
        input.replaceWith(input.val('').clone(true));
    }

    function printResponseMessage(data) {
        if (data.status == 'success') {
            $('#response_message').html('<div class="alert alert-success mt-20">' + data.message + '</div>');
        }

        if (data.status == 'error') {
            $('#response_message').html('<div class="alert alert-danger mt-20">' + data.message + '</div>');
        }
    }

    function reloadCertificatesSection() {
        $.ajax({
            method: "get",
            url: '/certificates'
        }).done(function (certificates) {
            console.log('loading all certificate');
            console.log(certificates);
            
            let certificatesHtml = '';
            for (let i = 0; i < certificates.length; i++) {
                certificatesHtml += '<div class="col text-center img-wrap">';
                certificatesHtml += '<button data-certificateid="' + certificates[i].id + '" class="deleteCertificate close">&times;</button>';
                certificatesHtml += '<div class="doc-image">';
                certificatesHtml += '<figure>';
                if (certificates[i].file.endsWith('.png') || certificates[i].file.endsWith('.jpg') || certificates[i].file.endsWith('.jpeg') || certificates[i].file.endsWith('.bmp')) {
                    certificatesHtml += '<img src="' + certificates[i].file + '" alt="lawyer certificate">';
                }
                if (certificates[i].file.endsWith('.pdf')) {
                    certificatesHtml += '<img src="' + window.location.origin + '/assets/img/pdf-icon.png' + '" alt="lawyer certificate">';
                }
                certificatesHtml += '</figure>';
                certificatesHtml += '<figcaption>';
                certificatesHtml += '<a href="' + window.location.origin + '/' + certificates[i].file + '" target="_blank" >';
                certificatesHtml += certificates[i].name;
                certificatesHtml += '</a>';
                certificatesHtml += '</figcaption>';
                certificatesHtml += '</div>';
                certificatesHtml += '</div>';
            }
            $('#uploadedDocuments').html(certificatesHtml);
        });
    }

    function reloadLca() {
        $.ajax({
            method: "get",
            url: '/lca'
        }).done(function (lca) {
            let certificatesHtml = '';
            if (lca.file) {
                certificatesHtml += '<div class="col text-center img-wrap">';
                certificatesHtml += '<button id="deleteLca" class="close">&times;</button>';
                certificatesHtml += '<div class="doc-image">';
                certificatesHtml += '<figure>';
                if (lca.file.endsWith('.png') || lca.file.endsWith('.jpg') || lca.file.endsWith('.jpeg') || lca.file.endsWith('.bmp')) {
                    certificatesHtml += '<img src="' + window.location.origin + '/' + lca.file + '" alt="lawyer certificate">'
                }
                if (lca.file.endsWith('.pdf')) {
                    certificatesHtml += '<img src="' + window.location.origin + '/assets/img/pdf-icon.png' + '" alt="lawyer certificate">';
                }
                if (lca.file.endsWith('.doc') || lca.file.endsWith('.docx')) {
                    certificatesHtml += '<img src="' + window.location.origin + '/assets/img/doc-icon.png' + '" alt="lawyer certificate">';
                }
                certificatesHtml += '</figure>';
                certificatesHtml += '<figcaption>';
                certificatesHtml += '<a href="' + window.location.origin + '/' + lca.file + '" target="_blank" >';
                certificatesHtml += 'LCA';
                certificatesHtml += '</a>';
                certificatesHtml += '</figcaption>';
                certificatesHtml += '</div>';
                certificatesHtml += '</div>';
            } else {
                certificatesHtml += '<div class="alert alert-danger">Upload your Legal Cost Agreement.</div>';
            }

            $('#uploadedLca').html(certificatesHtml);
        });
    }
    
    // get location from google map
    
    function initMap() {
        
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 50.064192, lng: -130.605469},
            zoom: 3
        });
        
        
        
        // var card = document.getElementById('pac-card');
        // var input = document.getElementById('pac-input');
        // var countries = document.getElementById('country-selector');
        var card = $('#pac-card')[0];
        var input = $('#pac-input')[0];
    
    
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    
    
    
        var autocomplete = new google.maps.places.Autocomplete(input);
    
        
        
        // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['au']});
    
        
        
        // Specify only the data fields that are needed.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name', 'formatted_address']);
    
        // var infowindow = new google.maps.InfoWindow();
        // var infowindowContent = document.getElementById('infowindow-content');
        // infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
    
        
        
        autocomplete.addListener('place_changed', function() {
            
            // infowindow.close();
            marker.setVisible(false);
            
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            // var location = place.formatted_address.split(",")[0];
            
            // console.log(place.formatted_address);
            
            
            
            
            var address_components = place.address_components;
            var location_name = '';
            
            if(address_components[address_components.length - 1].types.includes("postal_code")) {
                address_components.splice(address_components.length - 1, 1);
            }
            
            for (let i = 0; i < address_components.length; i++) {
                
                if(i==address_components.length-1) {
                    location_name += address_components[i].short_name;
                } else {
                    location_name += address_components[i].short_name + ',';    
                }
                
            }
            
            
            place_name = location_name;
            place_lat = lat;
            place_lng = lng;
            // -------------------- test code --------------------------
            console.log(address_components);
            console.log(location_name); 
            console.log("Address: ", address);
          
            if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }
            
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
    
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
    
            // infowindowContent.children['place-icon'].src = place.icon;
            // infowindowContent.children['place-name'].textContent = place.name;
            // infowindowContent.children['place-address'].textContent = address;
            // infowindow.open(map, marker);
        });
        
        
    }

    $(document).ready(function () {
        //read the value of recurring subscription radio button
        //$('input[name="recurring_subscription"]:checked').val();
        
        let get_max_skills = $("#max_skills").val();
        let max_skills = parseInt(get_max_skills) + 1;
        console.log(max_skills);
        
        if($('#map').length == 1){
            initMap();
        }

        $('#recurring_subscription_on').click(function(e){
            $('#recurring_subscription_on').removeClass('btn-secondary').addClass('btn-success');
            $('#recurring_subscription_on input[type="radio"]').checked = true;
            $('#recurring_subscription_off').removeClass('btn-success').addClass('btn-secondary').checked = false;
            $('#recurring_subscription_off input[type="radio"]').checked = false;
            
            updateRecurringSubscriptionStatusInDB('turn_on');
        });

        $('#recurring_subscription_off').click(function(e){
            $('#recurring_subscription_off').removeClass('btn-secondary').addClass('btn-success');
            $('#recurring_subscription_off input[type="radio"]').checked = true;
            $('#recurring_subscription_on').removeClass('btn-success').addClass('btn-secondary');
            $('#recurring_subscription_on input[type="radio"]').checked = false;

            updateRecurringSubscriptionStatusInDB('turn_off');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.previewProPic img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#change_file").on('change', function () {
            readURL(this);
            $('.previewProPic').css({"display": "block"});
        });

        $("#saveBankAccount").click(function (e) {
            e.preventDefault();
            //alert('call bank acc');
            $('.err-message').remove();
            $('#response_message .alert').remove();

            let account_name = $('#account_name').val();
            let bank_name = $('#bank_name').val();
            let bsb_no = $('#bsb_no').val();
            let account_no = $('#account_no').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: "/save-bank-account",
                data: {
                    account_name: account_name,
                    bank_name: bank_name,
                    bsb_no: bsb_no,
                    account_no: account_no
                }
            }).done(function (data) {
                //window.location.reload();
                if (data.bank_tab_complete) {
                    $('#bank-account-tab').html("Bank Account");
                }
                //printResponseMessage(data);
                
                //$("#bank-account").removeClass("nav-link-style active show");
                //$("#payment-details").addClass("nav-link-style active show");
                //$('#bankAccountHide').css({"display": "none"});
                //$('#bankAccountShow').css({"display": "block"});
                
                window.location.reload();
                        
            }).fail(function (data) {
                let errors = data.responseJSON.errors;
                
                if(errors['account_name']){
                    $('#account_name_error').html("<span class='err-message'>" + errors['account_name'] + "</span>");
                }
                if(errors['bank_name']){
                    $('#bank_name_error').html("<span class='err-message'>" + errors['bank_name'] + "</span>");
                }
                if(errors['bsb_no']){
                    $('#bsb_no_error').html("<span class='err-message'>" + errors['bsb_no'] + "</span>");
                }
                
                if(errors['account_no']){
                    $('#account_no_error').html("<span class='err-message'>" + errors['account_no'] + "</span>");
                }
                
                
            });
        });


        /*
            THIS SECTION IS FOR REMOVING LCA AND CERTIFICATES
            IT'S BEEN COMENTED OUT (WITH RESPECT) ACCORDING TO CLIENTS REQUIERMENT, PLEASE DONT DELETE THIS CODE
        */
        
        /*
        $('#uploadedDocuments').on('click', '.deleteCertificate', function (e) {
            e.preventDefault();
            $('#response_message .alert').remove();
            let certificate_id = $(this).data().certificateid;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: "/delete-certificate",
                data: {certificate_id: certificate_id}
            }).done(function (data) {
                reloadCertificatesSection();
                printResponseMessage(data);
            }).fail(function (data) {
                console.log(data);
            });
        }); */

        $('#uploadedLca').on('click', '#deleteLca', function (e) {
            e.preventDefault();
            //alert('aaaaaa');
            console.log('aaaa');
            
            $('#response_message .alert').remove();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: "/delete-lca"
            }).done(function (data) {
                reloadLca();
                printResponseMessage(data);
            }).fail(function (data) {
                console.log(data);
            });
        });

        
        
        
        $("#certificate").on('change', function (e) {
            let fileName = $('#certificate')[0].files[0].name;
            console.log(fileName);
            $('#certificateLabel').html(fileName);
        });


        $("#lca").on('change', function (e) {
            let fileName = $('#lca')[0].files[0].name;
            $('#lcaLabel').html(fileName);
        });


        $('#upload_certificate').click(function (e) {
            e.preventDefault();
            console.log('upload certificate');
            //$('#spiner').show();
            
            //$('#response_message .alert').remove();
            let certificate_name = $('#certificate_name').val();
            let certificate_count = $('#certificate_count').val();
            let certificates = $('#certificate').val();
            let certificate = $('#certificate')[0].files[0];
            
            //let fileName = $('#certificate')[0].files[0].name;
            console.log('gggg');
            console.log(certificateLabel);
            
            
            if(certificates == ''){
                $('.certificate_count_error').html('<span style="color:red;">* requireds.');
            }else{
                $('.certificate_count_error').html('<span style="display:none;">');
                $('.certificate_file_error').html('<span style="display:none;">');
            }
            if(certificate_name == ''){
                $('.certificate_name_error').html('<span style="color:red;">* required.');
            }else{
                $('.certificate_name_error').html('<span style="display:none;">');
            }
            
            if(certificates == '' || certificate_name == '' ){
                return false;
            }
            

            let fd = new FormData();
            fd.append('name', certificate_name);
            fd.append('certificate', certificate);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            console.log(certificate);
            console.log(fd);

            
            $("#certificateLabel").html("Choose File");
            
            $.ajax({
                method: "post",
                url: '/upload-certificate',
                processData: false,
                contentType: false,
                cache: false,
                data: fd
            
                
            }).done(function (data) {
                console.log('done');
                console.log(data);
                //reloadCertificatesSection();
                //printResponseMessage(data);
                //clearFileInput("#certificate");
                $("#certificate_name").val("");
                $('.certificate_file_error').text('');
                $('#certificate_count').val('1');
                //$('#spiner').hide();
                  
                
            }).fail(function (data) {
                let error = data.responseJSON;
                console.log('fail');
                //$('.certificate_file_error').html('<span style="color:red">Error, While uploading.</span>');
                console.log(error);
                $('#spiner').hide();
                
            });
        });

        $('#upload_lca').click(function (e) {
            e.preventDefault();
            $('#spinerLca').show();
            $('#response_message .alert').remove();

            let lca = $('#lca')[0].files[0];

            let fd = new FormData();
            fd.append('lca', lca);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#lcaLabel").html("Choose File");

            $.ajax({
                method: "post",
                url: '/upload-lca',
                processData: false,
                contentType: false,
                cache: false,
                data: fd
            }).done(function (data) {
                reloadLca();
                printResponseMessage(data);
                clearFileInput("#lca");
                $('#spinerLca').hide();
            }).fail(function (data) {
                let error = data.responseJSON;
                console.log(error);
                $('#spinerLca').hide();
            });
        });

        $('#saveAccountDetails').click(function (e) {
            e.preventDefault();
            $('.err-message').remove();
            $('#response_message .alert').remove();

            let firstName = $('#first_name').val();
            console.log(firstName);
            let lastName = $('#last_name').val();
            let email = $('#email').val();
            let professionalTitle = $('#professional_title').val();
            // let location = $('#location').val();
            
            //edited 9/7/19
            let pacinput = $('#pac-input').val();
            
            let location = 1;
            let post_code = $('#post_code').val();
            
            //edited 9/7/19
            let location_name = pacinput;
            
            //let location_name = place_name;
            console.log('location - ');
            console.log(pacinput);
            let lat = place_lat;
            let lng = place_lng;


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

            if (!professionalTitle) {
                $('#professional_title_error').html("<span class='err-message'>The professional title field is required!</span>");
            }

            if (firstName && lastName && email && location && professionalTitle) {

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
                fd.append('professional_title', professionalTitle);
                fd.append('location', location);
                fd.append('post_code', post_code);
                fd.append('lat' , lat);
                fd.append('lng' , lng);
                fd.append('location_name' , location_name);
                console.log(fd);
                
                $.ajax({
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    method: "post",
                    url: '/save-account-details',
                    data: fd
                }).done(function (data) {
                    console.log(data);
                    if (data.account_tab_complete) {
                        $('#account-details-tab').html('<span id="accountExclamationShow">Account Details</span>');
                    }

                    /*if (data.avatar) {
                        $('.profile_img img')[0].src = window.location.origin + "/" + data.avatar;
                        $('#profile_image')[0].src = window.location.origin + "/" + data.avatar;
                    }*/
                    
                    /*$("#account-details").removeClass("active");*/
                    $("#account-details").removeClass("nav-link-style active show");
                    $("#phone-verification").addClass("nav-link-style active show");
                    $('#accountExclamationHide').css({"display": "none"});
                    $('#accountExclamationShow').css({"display": "block"});
                    //$("#profile-details").addClass("active show");

                    //printResponseMessage(data);
                    clearFileInput("#change_file");
                    //alert('called');
                    $("#account-details-tab").removeClass(" active show");
                    $("#phone-verification-tab").addClass(" active show");
                    
                    
                }).fail(function (data) {
                    console.log(data);
                    let errors = data.responseJSON.errors;

                    $('#first_name_error').html("<span class='err-message'>" + errors['first_name'] + "</span>");
                    $('#last_name_error').html("<span class='err-message'>" + errors['last_name'] + "</span>");
                    $('#email_error').html("<span class='err-message'>" + errors['email'] + "</span>");
                    $('#location_error').html("<span class='err-message'>" + errors['location'] + "</span>");
                    $('#professional_title_error').html("<span class='err-message'>" + errors['professional_title'] + "</span>");
                    
                });
            }
        });

        $("#saveProfileDetails").click(function (e) {
            e.preventDefault();
            $('.err-message').remove();
            $('#response_message .alert').remove();
            
            let about_you = tinyMCE.activeEditor.getContent();
            let exp_years = $('#exp_years').val();
            let exp_months = $('#exp_months').val();
            let certificate_count = $('#certificate_count').val();
            let certificate_name = $('#certificate_name').val();
            let certificates = $('#certificate').val();
            
            //let file_size = $('#certificate')[0].files[0].size;
            
            
            
            if(about_you == ''){
                $('.about_you_error').html('<span style="color:red">* required</span>');
            }else{
                $('.about_you_error').html('<span style="display:none;">');
            }
            if(exp_years == ''){
                $('.exp_years_error').html('<span style="color:red">* required</span>');
            }else{
                $('.exp_years_error').html('<span style="display:none;">');
            }
            if(exp_months == ''){
                $('.exp_months_error').html('<span style="color:red">* required</span>');
            }else{
                $('.exp_months_error').html('<span style="display:none;">');
            }
            
            /*if(file_size <= 0) {
                $('.certificate_file_error').html('<span style="color:red">First you have to upload certificates.</span>');
            }else{
                $('.certificate_file_error').html('<span style="display:none;">');
            }*/
            
            if(certificate_count <= 0){
                $('.certificate_file_error').html('<span style="color:red">First you have to upload certificate.</span>');
            }else{
                $('.certificate_file_error').html('<span style="display:none;">');
            }
            
            
            if(about_you == '' || exp_years == '' || exp_months == '' || certificate_count <= 0 ){
                return false;
            }
            

            let selectedSkills = $('.skill[type="checkbox"]:checked').map(function (idx, elem) {
                return $(elem).val();
            }).toArray();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            

            $.ajax({
                method: "post",
                url: '/save-profile-details',
                data: {
                    about_you: about_you,
                    exp_months: exp_months,
                    exp_years: exp_years,
                    skills: selectedSkills
                }
            }).done(function (data) {
                //window.location.reload();
                if (data.profile_tab_complete) {
                    $('#profile-details-tab').html("Skill");
                }
                
                
                $("#phone-verification").removeClass("nav-link-style active show");
                $("#profile-details").addClass("active show");
                $('#skillVarify').css({"display": "none"});
                //$('#skillVarify2').css({"display": "block"});
                    
                // console.log(selectedSkills);
                // getSkillsName(selectedSkills);
                //printResponseMessage(data);
                
                //window.location.reload();
                
                $("#profile-details").removeClass("nav-link-style active show");
                $("#bank-account").addClass("nav-link-style active show");
                $('#skillVarify2').css({"display": "block"});
                $('#bankAccountShow').css({"display": "block"});
                //$("#profile-details").addClass("active show");
                
                $("#profile-details-tab").removeClass(" active show");
                $("#bank-account-tab").addClass(" active show");
                $("span#bankAccountShow").css({"display": "none"});
                
                
                
            }).fail(function (data) {
                let errors = data.responseJSON.errors;
                $('.err-message').remove();
                $('#about_you_error').html('<span class="err-message">' + errors['about_you'] + '</span>');
                $('#certificates_error').append('<span class="err-message">' + errors['certificate'] + '</span>');
                $('#lca_error').append('<span class="err-message">' + errors['lca'] + '</span>');
                $('#skills_error').append('<span class="err-message">' + errors['skills'] + '</span>');
                $('#exp_error').append('<span class="err-message">' + errors['exp_years'] + ' ' + errors['exp_months'] + '</span>');
            });
        });

        $('.skill[type="checkbox"]:not(:checked)').click(function (e) {
            
            let selectedSkills = $('.skill[type="checkbox"]:checked').map(function (idx, elem) {
                return $(elem).val();
            }).toArray();

            // console.log(selectedSkills);
            
            // return true;
            console.log("Total Selected skills", selectedSkills.length);
            console.log(max_skills);
            if (selectedSkills.length  <  max_skills) {
                
                return true;
                
            } else
                return false;
        });
        
        $('.skill[type="checkbox"]:checked').on('click', function() {
            if($(this).data('prechecked')){
                console.log("pre-checked");
                return false;
            } else {
                console.log('not pre-checked')
                return true;
            }
        });

        // phone verification
        $('#sendVerificationCode').click(function (e) {
            e.preventDefault();
            $('.err-message').remove();
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
                console.log(error['message']);
                $('.phone_number_error').html("<span class='err-message'>" + error['message'] + "</span>");
                
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
                    
                    //alert('called');
                    //$('#verificationMessage').html(msg.message);
                    $('#verificationMessage').removeClass('alert-danger');
                    $('#verificationMessage').addClass('alert-success');
                    $('#verificationMessage').css({"display": "block"});

                    $('#phone-verification-tab').html('Phone Verification');
                    
 

                    $.ajax({
                        method: "get",
                        url: "/user-info",
                    }).done(function (data) {
                        $('#verified_phone_no').html("<div class='alert alert-success'>Verified With: " + data.country_code + " " + data.phone_number + "</div>");
                        
                    
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