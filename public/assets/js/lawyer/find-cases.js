(function ($) {
    
    let priceRange = [];
    let location_keywords;
    
    function strip(html) {
        
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }
    
    function stripTagsAndShorten(str) {
        return strip(str).substring(0, 255);
    }
    
    // function initMap(markersList) {
    //   var map = new google.maps.Map(document.getElementById('findCasesMap'), {
    //     zoom: 8,
    //     center: {lat: parseFloat(markersList[0].location.lat), lng: parseFloat(markersList[0].location.lng)}
    //   });
    
    //   setMarkers(map, markersList);
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

    // this is a new feature for case searching since things are changing
    
    function updateSelectedLocationsListView(selectedOptions){
        $('#selectedLocationsList li').remove();
        for(let i = 0; i < selectedOptions.length; i++){
            $('#selectedLocationsList').append('<li class="list-inline-item"><span class="badge badge-pill badge-success">'+selectedOptions[i].text+' <span style="cursor: pointer;"' +
                ' class="removeSkillFromList" data-id="'+selectedOptions[i].id+'"><i' +
                ' class="fa fa-close"></i></span></span></li>')
        }
    }

    // ----------------------------------------- UI ---------------------------------------------
    
    function updateUiWithCases(cases){
        let caseLists = '';
        let markersList = [];

        for(let i = 0; i < cases.length; i++){
            let singleCase = '';
            let now = moment();
            let then = moment(cases[i].created_at, 'YYYY-MM-DD HH:mm:ss');
            
            singleCase +='<div class="project_box">';
            singleCase +=    '<div class="row">';
            singleCase +=        '<div class="col-lg-9">';
            singleCase +=            '<h6><a href="'+window.location.origin+'/case/'+cases[i].slug+'">'+cases[i].title+'</a></h6>';
            singleCase +=            '<div class="project_details">';
            singleCase +=                '<ul>';
            singleCase +=                    '<li><a href="#"><i class="fa fa-user"></i>'+cases[i].client.first_name+' '+cases[i].client.last_name.split("")[0]+'.</a></li>';
            
            // If case location field is required, no need to add this logic here.
            if(cases[i].location){
                singleCase +=                    '<li><a href="#"><i class="fa fa-map-marker"></i>'+cases[i].location.city+'</a></li>';
            }
            
            singleCase +=                    '<li><a href="#"><i class="fa fa-clock-o"></i>'+moment.duration(now.diff(then)).humanize()+'</a></li>';
            singleCase +=                '</ul>';
            singleCase +=            '</div>';
            singleCase +=            '<p >'+stripTagsAndShorten(cases[i].description)+'</p>';
            singleCase +=            '<div class="project_tags">';
            singleCase +=                '<ul>';
            
            if(cases[i].skills.length){
                for(let j=0; j < cases[i].skills.length; j++){
                    singleCase +=                   '<li><span class="badge badge-pill badge-success">'+cases[i].skills[j].name+'</span></li>';
                }
            }
            
            singleCase +=                '</ul>';
            singleCase +=            '</div>';
            singleCase +=        '</div>';
            singleCase +=        '<div class="col-lg-3">';
            singleCase +=            '<div class="project_budget">';
            singleCase +=                'Budget';
            singleCase +=                '<div class="project_price">';
            singleCase +=                    '$'+cases[i].budget+'';
            singleCase +=                '</div>';
            singleCase +=            '</div>';
            singleCase +=            '<div class="project_btn">';
            
            // singleCase +=                '<a href="#" class="boxed_btn">Bid Now</a>';
            
            singleCase +=            '</div>';
            singleCase +=        '</div>';
            singleCase +=    '</div>';
            singleCase +='</div>';
            
            caseLists += singleCase;
            
            // let existingMarkerIndex = markersList.findIndex(function(marker){
            //     return marker.location.id == cases[i].location.id;
            // });
            
            // if(existingMarkerIndex > -1){
            //     markersList[existingMarkerIndex].count += 1;
            // }
            
            // if(existingMarkerIndex == -1){
            //     markersList.push({location: cases[i].location, count: 1}); 
            // }
        }
        
        $('#caseList').html(caseLists);
        
         if(markersList.length){
             initMapff(markersList);    
         }
    }
    


    function getAndUpdateCasesList(){
        
        let selectedSkills = $('#skillsNeeded').val();
        // let location_keywords = location_string;
        // let location_keywords = $('#pac-input').val();
        // console.log("location_keywords", location_keywords);
        // let selectedLocation = $('#location').val();
        // console.log(selectedLocation);
        
        let selectedTimeframe = $('#timeframe').val();
        let timeframe = selectedTimeframe.split('-');
        
        let startDate = timeframe[0].split('/');
        startDate.reverse();
        startDate = startDate.join('-').replace(' ', '');
        
        let endDate = timeframe[1].split('/');
        endDate.reverse();
        endDate = endDate.join('-').replace(' ', '');
        
        let lowestPrice = priceRange[0];
        let highestPrice = priceRange[1];
        
        let data = {
                selectedSkills: selectedSkills,
                // selectedLocation: selectedLocation,
                location_keywords: location_keywords,
                startDate: startDate+' 00:00:00',
                endDate: endDate+' 23:59:59',
                lowestPrice: lowestPrice,
                highestPrice: highestPrice
            };
        
        if(page){
            data.page = page;
        }
            
        $.ajax({
            method: "get",
            url: '/search-cases',
            
            data: data
            
        }).done(function(data){
            
            console.log(data);
            
            $('#casesFound').html(data.cases.total);
            
            updateUiWithCases(data.cases.data);
            
            $('#pagination').html(data.pagination_links);
            
        }).fail(function(data){
            console.log(data);
        });
    }
    
    
    
    
    
    
    function initMapff() {

        // var map = new google.maps.Map(document.getElementById('map'), {
        //     center: {lat: 50.064192, lng: -130.605469},
        //     zoom: 3
        // });
        
        var map = new google.maps.Map(document.getElementById('findCasesMap'), {
            center: {lat: -25.734968, lng: 134.489563},
            zoom: 3
        });
        
        
        
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
            getAndUpdateCasesList();
            
            
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
        
        if($('#findCasesMap').length == 1){
            initMapff();
        }
        
        var slider = new Slider('#price-range');
        priceRange = slider.getValue();
        
        slider.on('slideStop', function(e){
            page = 1;
            priceRange = slider.getValue(); 
            getAndUpdateCasesList();
        });
        
        $('#timeframe').on('hide.daterangepicker', function(){
            page = 1;
            getAndUpdateCasesList();
        });
        
        var start = startDateInQuery ? moment(startDateInQuery, "YYYY-MM-DD HH:mm:ss") : moment().subtract(60, 'days');
        var end = endDateInQuery ? moment(endDateInQuery, "YYYY-MM-DD HH:mm:ss") : moment();
    
        function cb(start, end) {
            $('#timeframe').html(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
        }
    
        $('#timeframe').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                format: 'DD/MM/YYYY'
            }
        }, cb);
    
        cb(start, end);

    
        
        getAndUpdateCasesList();
        
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
            let currentlySelected = $('#location').val();
            let idToRemoveIndex = currentlySelected.indexOf(idToRemove.toString());

            if (idToRemoveIndex > -1) {
                currentlySelected.splice(idToRemoveIndex, 1);
            }

            $('#location').selectpicker('val', currentlySelected);
        });
        

        $('#skillsNeeded').selectpicker({
            "liveSearch": true,
            "size": 5,
            "liveSearchPlaceholder": "e.g. Family law",
            "noneSelectedText": "Select required skills"
        });
        
        $('#location').selectpicker({
            "liveSearch": true,
            "size": 5,
            "liveSearchPlaceholder": "e.g. Perth, Australia",
            "noneSelectedText": "Select location"
        });


        $('#skillsNeeded').on('changed.bs.select', function(e) {
            let selections = $('#skillsNeeded option:selected');
            let selectedOptions = [];
            for(let i = 0; i < selections.length; i++){
                let obj = {};
                obj.id = $(selections[i]).val();
                obj.text = $(selections[i]).text();
                selectedOptions.push(obj);
            }

            updateSelectedSkillsListView(selectedOptions);
            page = 1;
            
            getAndUpdateCasesList();
        });
        
        $('#clearInput').on('click', function() {
            $('#pac-input').val('');
            location_keywords = null;
            console.log(location_keywords);
            getAndUpdateCasesList();
        });
        
        $('#location').on('changed.bs.select', function(e){
            let selections = $('#location option:selected');
            let selectedOptions = [];
            for(let i = 0; i < selections.length; i++){
                let obj = {};
                obj.id = $(selections[i]).val();
                obj.text = $(selections[i]).text();
                selectedOptions.push(obj);
            }
            
            // console.log(selectedOptions);

            updateSelectedLocationsListView(selectedOptions);
            
        
            getAndUpdateCasesList();
        });
    });
})(jQuery);