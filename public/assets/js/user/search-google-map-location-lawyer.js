
function initMap() {
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 50.064192, lng: -130.605469},
        zoom: 3
    });
    
    
    
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var countries = document.getElementById('country-selector');



    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);



    var autocomplete = new google.maps.places.Autocomplete(input);

    
    
    // Set initial restrict to the greater list of countries.
    autocomplete.setComponentRestrictions(
        {'country': ['au']});

    
    
    // Specify only the data fields that are needed.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name', 'formatted_address']);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    
    
    autocomplete.addListener('place_changed', function() {
        
        infowindow.close();
        marker.setVisible(false);
        
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        // var location = place.formatted_address.split(",")[0];
        
        console.log(place.formatted_address);
        
        
        
        
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
        
        var locationStringArray = location_name.split(",");
        var formatedLocationArray = locationStringArray.slice(locationStringArray.length-3, locationStringArray.length-1);
        var address = formatedLocationArray[0] + ',' + formatedLocationArray[1];
        
        
        // if(window.location == "https://thelawapp.com.au/find-cases") {
        //     document.getElementById("location_keywords").setAttribute('value', location_name);
        // }
        
        // -------------------- test code --------------------------
        console.log(address_components);
        console.log(location_name); 
        console.log("Address: ", address);
        // console.log(address_components);
        // console.log(postalCodeExists);
        // console.log(place);
        // console.log(lat, lng, location_name);
        // -------------------- End of test code --------------------
        
        

        $(document).ready(function () {
            
            function printResponseMessage(data) {
                if (data.status == 'success') {
                    $('#response_message').html('<div class="alert alert-success mt-20">' + data.message + '</div>');
                }
        
                if (data.status == 'error') {
                    $('#response_message').html('<div class="alert alert-danger mt-20">' + data.message + '</div>');
                }
            }
            
            $('#saveAccountDetails').click(function (e) {
                e.preventDefault();
                $('.err-message').remove();
                $('#response_message .alert').remove();
    
                let firstName = $('#first_name').val();
                let lastName = $('#last_name').val();
                let email = $('#email').val();
                let professionalTitle = $('#professional_title').val();
                let location = $('#location').val();
                // let location = 1;
                let post_code = $('#post_code').val();
    
    
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
                    $('#professional_title_error').html("<span class='err-message'>The location field is required!</span>");
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
                    // fd.append('address', address);
    
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
                            $('#account-details-tab').html("Profile Details");
                        }
    
                        if (data.avatar) {
                            $('.profile_img img')[0].src = window.location.origin + "/" + data.avatar;
                            $('#profile_image')[0].src = window.location.origin + "/" + data.avatar;
                        }
    
                        printResponseMessage(data);
                        // clearFileInput("#change_file");
                    }).fail(function (data) {
                        let errors = data.responseJSON.errors;
    
                        $('#first_name_error').html("<span class='err-message'>" + errors['first_name'] + "</span>");
                        $('#last_name_error').html("<span class='err-message'>" + errors['last_name'] + "</span>");
                        $('#email_error').html("<span class='err-message'>" + errors['email'] + "</span>");
                        $('#location_error').html("<span class='err-message'>" + errors['location'] + "</span>");
                        $('#professional_title_error').html("<span class='err-message'>" + errors['professional_title'] + "</span>");
                    });
                }
            });
            
        });      
      
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

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
    });
    

    
    
    // Sets a listener on a given radio button. The radio buttons specify
    // the countries used to restrict the autocomplete search.
    // function setupClickListener(id, countries) {
    //     var radioButton = document.getElementById(id);
    //     radioButton.addEventListener('click', function() {
    //         autocomplete.setComponentRestrictions({'country': countries});
    //     });
    // }

    
    
    // setupClickListener('changecountry-aus', 'au');
    // setupClickListener('changecountry-aus', ['aus']);
    
    
}