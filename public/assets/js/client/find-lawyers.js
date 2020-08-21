(function ($) {
    
    let location_keywords;
    
    // function initMapMarkArea(markersList) {
    //   var map = new google.maps.Map(document.getElementById('findLawyersMap'), {
    //     zoom: 8,
    //     center: {lat: parseFloat(markersList[0].location.lat), lng: parseFloat(markersList[0].location.lng)}
    //   });
    
    //  setMarkers(map, markersList);
    // }
    
    // function setMarkers(map, markersList) {
        
    //     for (var i = 0; i < markersList.length; i++) {
    //         var latLong = {lat: parseFloat(markersList[i].location.lat), lng: parseFloat(markersList[i].location.lng)};

    //         var marker = new google.maps.Marker({
    //             position: latLong,
    //             map: map,
    //             label: markersList[i].count.toString()
    //         });
    //     }
    // }
    

    function updateSelectedSkillsListView(selectedOptions){
        $('#selectedSkillsList li').remove();
        for(let i = 0; i < selectedOptions.length; i++){
            $('#selectedSkillsList').append('<li class="list-inline-item"><span class="badge badge-pill badge-success">'+selectedOptions[i].text+' <span style="cursor: pointer;"' +
                ' class="removeSkillFromList" data-id="'+selectedOptions[i].id+'"><i' +
                ' class="fa fa-close"></i></span></span></li>')
        }
    }
    
    function updateSelectedLocationsListView(selectedOptions){
        $('#selectedLocationsList li').remove();
        for(let i = 0; i < selectedOptions.length; i++){
            $('#selectedLocationsList').append('<li class="list-inline-item"><span class="badge badge-pill badge-success">'+selectedOptions[i].text+' <span style="cursor: pointer;"' +
                ' class="removeSkillFromList" data-id="'+selectedOptions[i].id+'"><i' +
                ' class="fa fa-close"></i></span></span></li>')
        }
    }

    function updateUiWithLawyers(lawyers){
        let profileList = '';
        let markersList = [];
        
        for(let i=0; i < lawyers.length; i++){
            
            let sigleProfile = '';
            
            let totalRating = 0;
            let rating = 0;
            
            if(lawyers[i].reviews.length){
                for(let j = 0; j < lawyers[i].reviews.length; j++){
                    totalRating += parseInt(lawyers[i].reviews[j].star);
                }
                
                rating = Math.round(totalRating/lawyers[i].reviews.length);
            }
            
            let starRatingHtml = '<li class="rat">';
            
            if(rating){
                for(let k = 0; k < rating; k++){
                    starRatingHtml += '<i class="fa fa-star marked"></i>';
                }
                
                for(let l = 0; l < 5-rating; l++){
                    starRatingHtml = '<i class="fa fa-star"></i>';
                }
            }
            
            starRatingHtml += '</li>';
            
            sigleProfile += '<div class="lawyer_profile_box project_box">';
            sigleProfile +=     '<div class="row">';
            sigleProfile +=         '<div class="col-lg-2">';
            sigleProfile +=             '<div class="profile_img">';
            sigleProfile +=                 '<img src="'+window.location.origin+'/'+lawyers[i].avatar+'" alt="Profile Photo">';
            sigleProfile +=                 '<i class="fa fa-check"></i>';
            sigleProfile +=             '</div>';
            sigleProfile +=         '</div>';
            sigleProfile +=         '<div class="col-lg-5">';
            sigleProfile +=             '<div class="lawyer_name">';
            sigleProfile +=                 '<h4><a href="'+window.location.origin+'/'+lawyers[i].username+'">'+lawyers[i].first_name+' '+lawyers[i].last_name.split("")[0]+'.</a></h4>';
            
            if(lawyers[i].professional_title){
                sigleProfile +=                 '<p>'+lawyers[i].professional_title+'</p>';    
            }
            
            sigleProfile +=             '</div>';
            
            if(rating){
                sigleProfile +=             '<div class="lawyer_rat">';
                sigleProfile +=                 '<ul class="ratings">';
                sigleProfile +=                         '<li class="feedback">'+rating+'</li>';
                sigleProfile +=                         starRatingHtml;
                sigleProfile +=                     '</ul>';
                sigleProfile +=             '</div>';
            }
            
            sigleProfile +=         '</div>';
            sigleProfile +=         '<div class="col-lg-5">';
            sigleProfile +=             '<div class="lawyer_info" style="display: flex;flex-direction: row-reverse;">';
            
            if(lawyers[i].location_name){
                var location_array = lawyers[i].location_name.split(",");
                var address = location_array.slice(location_array.length - 3, location_array.length - 1);
                if(address.length) {
                    sigleProfile +=                 ''+address[0]+' , '+address[1]+' <i style="margin-top: 4px; margin-right: 10px;" class="fa fa-map-marker"></i>';    
                } else {
                    sigleProfile +=                 '<i style="margin-top: 4px; margin-right: 10px;" class="fa fa-map-marker"></i>';    
                }
                // sigleProfile +=                 ''+lawyers[i].location.city+' '+lawyers[i].location.country+' <i style="margin-top: 4px; margin-right: 10px;" class="fa fa-map-marker"></i>';
                
            }
            
            sigleProfile +=             '</div>';
            sigleProfile +=             '<div class="project_btn">';
            sigleProfile +=                 '<a href="'+window.location.origin+'/'+lawyers[i].username+'" class="boxed_btn">View Profile</a>';
            sigleProfile +=             '</div>';
            sigleProfile +=         '</div>';
            sigleProfile +=     '<div class="clearfix"></div>';
            sigleProfile +=     '</div>';
            sigleProfile += '</div>';
            
            // if(lawyers[i].location){
            //     let existingMarkerIndex = markersList.findIndex(function(marker){
            //         return marker.location.id == lawyers[i].location.id;
            //     });
                
            //     if(existingMarkerIndex > -1){
            //         markersList[existingMarkerIndex].count += 1; 
            //     }
                
            //     if(existingMarkerIndex == -1){
            //         markersList.push({location: lawyers[i].location, count: 1});    
            //     }
                
            // }
            
            profileList += sigleProfile;
        }
        
        $('#lawyerProfileList').html(profileList);
        
        if(markersList.length){
            initMapee(markersList);    
        }
        
    }
    

    function getAndUpdateLawyersList(){
        let selectedSkills = $('#skillsNeeded').val();
        // let selectedLocation = $('#caseLocation').val();
        console.log(location_keywords);
        let data = {
                selectedSkills: selectedSkills,
                // selectedLocation: selectedLocation
                location_keywords: location_keywords
            };
            
        if(page){
            data.page = page;
        }
        
        $.ajax({
            method: "get",
            url: '/search-lawyers',
            data: data
        }).done(function(data){
            
            $('#lawyersFound').html(data.lawyers.total);
            
            updateUiWithLawyers(data.lawyers.data);
            
            $('#pagination').html(data.pagination_links);
            console.log(data);
            
        }).fail(function(data){
            
        });
    }
    
    
    
    function initMapee() {

        var map = new google.maps.Map(document.getElementById('findLawyersMap'), {
            center: {lat: -25.734968, lng: 134.489563},
            zoom: 3
        });
        
        // var map = new google.maps.Map(document.getElementById('findLawyersMap'), {
        //     zoom: 8,
        //     center: {lat: 50.064192, lng: -130.605469},
        //     // center: {lat: parseFloat(markersList[0].location.lat), lng: parseFloat(markersList[0].location.lng)}
        // });
        
        
        
        // var card = document.getElementById('pac-card');
        // var input = document.getElementById('pac-input');
        
        var card = $('#pac-card')[0];
        var input = $('#pac-input')[0];
        // var countries = document.getElementById('country-selector');
    
    
    
        // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    
    
    
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
            
            // locationKeywords = location_name;
            
            // var locationStringArray = location_name.split(",");
            // var formatedLocationArray = locationStringArray.slice(locationStringArray.length-3, locationStringArray.length-1);
            // var address = formatedLocationArray[0] + ',' + formatedLocationArray[1];
            
            
            // $('#location_keywords').val(location_name);
            location_keywords = location_name;
            getAndUpdateLawyersList();
            
            
            // -------------------- test code --------------------------
            // console.log(address_components);
            console.log(location_name); 
            // console.log("Address: ", address);
            // console.log(address_components);
            // console.log(postalCodeExists);
            // console.log(place);
            // console.log(lat, lng, location_name);
            // -------------------- End of test code --------------------
      
          
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
        
        if($('#findLawyersMap').length == 1){
            initMapee();
        }
        
        getAndUpdateLawyersList();
        
        $('#selectedSkillsList').on('click', '.removeSkillFromList', function(e){
            e.preventDefault();
            let idToRemove = $(this).data("id");
            let currentlySelected = $('#skillsNeeded').val();
            let idToRemoveIndex = currentlySelected.indexOf(idToRemove.toString());

            if (idToRemoveIndex > -1) {
                currentlySelected.splice(idToRemoveIndex, 1);
            }

            $('#skillsNeeded').selectpicker('val', currentlySelected);
        });
        
        $('#selectedLocationsList').on('click', '.removeSkillFromList', function(e){
            e.preventDefault();
            let idToRemove = $(this).data("id");
            let currentlySelected = $('#caseLocation').val();
            let idToRemoveIndex = currentlySelected.indexOf(idToRemove.toString());

            if (idToRemoveIndex > -1) {
                currentlySelected.splice(idToRemoveIndex, 1);
            }

            $('#caseLocation').selectpicker('val', currentlySelected);
        });

        $('#skillsNeeded').selectpicker({
            "liveSearch": true,
            "size": 5,
            "liveSearchPlaceholder": "e.g. Family law",
            "noneSelectedText": "Select required skills"
        });

        $('#caseLocation').selectpicker({
            "liveSearch": true,
            "size": 5,
            "liveSearchPlaceholder": "e.g. Perth, Australia",
            "noneSelectedText": "Select location"
        });


        $('#skillsNeeded').on('changed.bs.select', function(e){
            let selections = $('#skillsNeeded option:selected');
            let selectedOptions = [];
            for(let i = 0; i < selections.length; i++){
                let obj = {};
                obj.id = $(selections[i]).val();
                obj.text = $(selections[i]).text();
                selectedOptions.push(obj);
            }

            updateSelectedSkillsListView(selectedOptions);
            
            
            getAndUpdateLawyersList();
        });
        
        $('#clearInput').on('click', function() {
            $('#pac-input').val('');
            location_keywords = null;
            console.log(location_keywords);
            getAndUpdateLawyersList();
        });
        
        $('#caseLocation').on('changed.bs.select', function(e){
            let selections = $('#caseLocation option:selected');
            let selectedOptions = [];
            for(let i = 0; i < selections.length; i++){
                let obj = {};
                obj.id = $(selections[i]).val();
                obj.text = $(selections[i]).text();
                selectedOptions.push(obj);
            }

            updateSelectedLocationsListView(selectedOptions);
            
        
            getAndUpdateLawyersList();
        });
    });
})(jQuery);