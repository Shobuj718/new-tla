(function ($) {

    function clearFileInput(inputId){
        let input = $(inputId);
        input.replaceWith(input.val('').clone(true));
    }

    function updateSelectedSkillsListView(selectedOptions){
        $('#selectedSkillsList li').remove();
        for(let i = 0; i < selectedOptions.length; i++){
            $('#selectedSkillsList').append('<li class="list-inline-item"><span class="badge badge-pill badge-success">'+selectedOptions[i].text+' <span style="cursor: pointer;"' +
                ' class="removeSkillFromList" data-id="'+selectedOptions[i].id+'"><i' +
                ' class="fa fa-close"></i></span></span></li>')
        }
    }

    function updateFileName(filename){
        $('#attachedFileName').html(filename);
    }

    function updateAttachmentsList(uploadedFile){
        $('#uploadedAttachments').append('<li><span class="badge badge-pill badge-success">'+uploadedFile.name+' <span style="cursor: pointer;" class="removeFileFromList" data-path="'+uploadedFile.path+'"><i' +
                ' class="fa fa-close"></i><input type="hidden" name="attachments[]" value="'+uploadedFile.path+'"></span></span></li>');
    }
    
    
    /*function initMapd() {
    
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
            // var location_name = place.formatted_address.split(",")[0];
            
            
            
            
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
            
            console.log(lat);
            
            if(window.location != "https://thelawapp.com.au/edit-profile") {
                document.getElementById("caseLat").setAttribute('value', lat);
                document.getElementById("caseLng").setAttribute('value', lng);
                document.getElementById("caseLocationName").setAttribute('value', location_name);        
            }
            
            
            // -------------------- test code --------------------------
            console.log(address_components);
            console.log('hghghghg');
            console.log(location_name);
            // console.log(address_components);
            // console.log(postalCodeExists);
            // console.log(place);
             console.log(lat, lng, location_name);
            // -------------------- End of test code --------------------
            
            // $(document).ready(function () {
            //     $('#caseLat').val(lat);
            //     $('#caseLng').val(lng);
            //     $('#caseLocationName').val(location_name);
            //     console.log(lat, lng);
            // });
          
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
        
        
    }*/
    
    $(document).ready(function () {
        
        
        
        $('#selectedSkillsList').on('click', '.removeSkillFromList', function(e){
            e.preventDefault();
            let idToRemove = $(this).data("id");
            let currentlySelected = $('#skillsNeeded').val();
            let idToRemoveIndex = currentlySelected.indexOf(idToRemove.toString());

            if (idToRemoveIndex > -1) {
                currentlySelected.splice(idToRemoveIndex, 1);
            }
            
            console.log(currentlySelected);

            $('#skillsNeeded').selectpicker('val', currentlySelected);
        });

        $('#skillsNeeded').selectpicker({
            "liveSearch": true,
            "size": 3,
            maxOptions:3,
            "liveSearchPlaceholder": "e.g. Family law",
            "noneSelectedText": "Select required skills"
        });

        $('#caseLocation').selectpicker({
            "liveSearch": true,
            "size": 3,
            maxOptions:3,
            "liveSearchPlaceholder": "e.g. Perth, Australia",
            "noneSelectedText": "Select location"
        });

        $('#attach_file').on("change", function(e){
            let filename = $('#attach_file')[0].files[0].name;
            updateFileName(filename);
        });

        $('#uploadedAttachments').on('click', '.removeFileFromList', function(e){
            let clickedElement = $(this);
            let filepath = clickedElement.data('path');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: '/delete-attachment',
                data: {filepath: filepath}
            }).done(function (data) {
                console.log(clickedElement);
                clickedElement[0].parentElement.remove();
                console.log(data);
            }).fail(function (data) {
                console.log(data);
                let errors = data.responseJSON.errors;
                console.log(errors);
            });
        });

        $('#uploadAttachment').click(function(e){
            e.preventDefault();
            $('#attach_file_error').html('');
            let attachment_file = $('#attach_file')[0].files[0];
            let project_id = $('#project_id').val();

            let fd = new FormData();
            fd.append('attachment', attachment_file);
            fd.append('project_id', project_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: '/upload-attachment',
                processData: false,
                contentType: false,
                cache: false,
                data: fd
            }).done(function (data) {
                updateAttachmentsList(data);
                clearFileInput('#attach_file');
                updateFileName("Choose File");
            }).fail(function (data) {
                let errors = data.responseJSON.errors;
                $('#attach_file_error').html('<span class="err-message">'+errors['attachment']+'</span>');
            });
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
            
        });

        tinymce.init({
            selector: '#projectDescription',
            element_format: 'html',
            plugins: [
                "a11ychecker advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools", " lists link linkchecker media mediaembed noneditable powerpaste preview", " searchreplace table template textcolor tinymcespellchecker visualblocks wordcount"
            ]
        });
        
        console.log($('#map').length);
        
        if($('#map').length == 1){
            initMapd();
        }
        
    });
})(jQuery);