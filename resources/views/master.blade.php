<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="https://demo.thelawapp.com.au/assets/img/logo.png" type="image/gif" sizes="16x16">

    <title>TLA</title>

    <!-- OPENTOK STYLES -->
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet"> 
    <link href="https://demo.thelawapp.com.au/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://demo.thelawapp.com.au/assets/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://demo.thelawapp.com.au/assets/css/jquery.mmenu.all.css">
    <link href="https://demo.thelawapp.com.au/assets/css/style.css" rel="stylesheet">
    <link href="https://demo.thelawapp.com.au/assets/css/responsive.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <style>
        .body-mask::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: rgba(0, 0, 0, .5);
        }
        .body-mask-inner {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 100%;
            display: none;
        }
        .body-mask-container {
            position: relative;
            max-width: 1020px;
            height: 100%;
            background-color: #ffffff;
            -webkit-box-shadow: 990px 0 0 #ffffff, -2px 0 7px rgba(57,73,76,.45);
            box-shadow: 990px 0 0 #ffffff, -2px 0 7px rgba(57,73,76,.45);
            margin: 0 auto;
        }
    </style>
    
     @yield('styles')
     
    <body>
    <div class="body-mask">
        <div class="body-mask-inner">
            <div class="body-mask-container">
                
            </div>
        </div>
    </div>
    @include('layouts.header')
    
    

    
    @yield('content')
    
    

    @include('layouts.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://demo.thelawapp.com.au/assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhDZ-X-FmlL7R9vg4VA7843bel7S4GOac&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('location_name');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
               // document.getElementById('city2').value = place.name;
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lng').value = place.geometry.location.lng();
    			console.log(place);
    			console.log(place.formatted_address);
                console.log(place.url);
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script>
        jQuery(document).ready(function($){
            $('.case-items-title a').click(function(e){
                e.preventDefault();
                $('.body-mask').addClass('open').fadeIn();
                $('.body-mask-inner').animate({
                    width: 'toggle'
                });
                $('body').css({'padding-right': '100px','overflow':'hidden'});
            });
            $('.body-mask').mouseup(function(e) {
                var container = $('.body-mask-container');
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.body-mask').removeClass('open').fadeOut();
                    $('.body-mask-inner').animate({
                        width: 'toggle'
                    });
                    $('body').css({'padding-right': '0','overflow-y':'auto'});
                }
            });
        });
    </script>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhDZ-X-FmlL7R9vg4VA7843bel7S4GOac&libraries=places" async defer></script>
<script>
    $(window).on('load', function() { // makes sure the whole site is loaded 
        $('#status').fadeOut(); // will first fade out the loading animation 
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
        $('body').delay(350).css({'overflow':'visible'});
        
        if($('#map').length == 1){
            initMap();
        }
        
    });
</script>

<script>

function initMap() {
        
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 50.064192, lng: -130.605469},
            zoom: 3
        });
        
        
        
        var card = $('#pac-card')[0];
        var input = $('#pac-input')[0];
    
    
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    
    
    
        var autocomplete = new google.maps.places.Autocomplete(input);
    
        
        
        // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['au','bd','usa','uk','ca','ind','nz']});
    
        
        
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
            console.log("Address: ", place.address_components);
            console.log("Lat: "+lat+" Long: "+lng);
            
            document.getElementById("lat").setAttribute('value', lat);
            document.getElementById("lng").setAttribute('value', lng);
            document.getElementById("locationName").setAttribute('value', location_name);
          
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
    
</script>-->

     @yield('scripts')
     
    </body>
</html>