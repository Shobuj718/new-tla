    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addTimezone(){
	    var city_name 		= $('#city_name').val();
	    var timezone_name 	= $('#timezone_name').val();
	    var timezone_offset = $('#timezone_offset').val();
	    var timezone_gmt 	= $('#timezone_gmt').val();
	    console.log(timezone_name)

	    var next_step = true;
	    var count = 0;

	    if(city_name === ''){
            //alert('Please enter your package city_name.');
            $('#city_name').focus();
             $('.error_city_name').html('<span style="color:red;float:left;">Enter city name</p>');
            next_step = false;
        }
        else{
            $('.error_city_name').html('<span style="display:none"/>')
        }
	    if(timezone_name === ''){
            //alert('Please enter your package timezone_name.');
            $('#timezone_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter country name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(timezone_gmt === ''){
            //alert('Please enter your package timezone_gmt.');
            $('#timezone_gmt').focus();
             $('.error_timezone_gmt').html('<span style="color:red;float:left;">Enter timezone gmt</p>');
            next_step = false;
        }
        else{
            $('.error_timezone_gmt').html('<span style="display:none"/>')
        }
	    if(timezone_offset === ''){
            //alert('Please enter your package timezone_offset.');
            $('#timezone_offset').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter timezone offset</p>');
            next_step = false;
        }
        else{
            $('.error_code').html('<span style="display:none"/>')
        }

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/add-timezone",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, city_name:city_name, timezone_name:timezone_name, timezone_gmt:timezone_gmt, timezone_offset:timezone_offset},
	            success: function (data) {
	                console.log(data);

	                if(data.messageType == 'success'){
	                	Swal.fire(
						  '',
						  data.message,
						  'success'
	                		// form rese
						)
	                	count++;
	                	// reset form field
	                	$("#formID")[0].reset();

		               	// Redraw Table After Insert										
						var table = $('#country').DataTable();

						// #myInput is a <input type="text"> element
						$('.input-sm').on( 'keyup', function () {
							table.search( this.value ).draw();
						} );
						$( ".input-sm" ).trigger( "keyup" );

	                }

	                if(data.messageType == 'error'){
	                	Swal.fire(
						  '',
						  data.message,
						  'error'
	                		// form rese
						)
	                }

	            },
	            error: function(xhr, ajaxOptions, thrownError, data) {
	            	console.log(data);
	            	/*count++;
	            	Swal.fire(
						  '',
						  data.message,
						  'error'
						)*/
	                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	            }
	        });
	    }
	}

	function editTimezone(){
	    var city_name       = $('#city_name').val();
	    var timezone_name   = $('#timezone_name').val();
	    var timezone_offset = $('#timezone_offset').val();
	    var timezone_gmt    = $('#timezone_gmt').val();
	    var id    			= $('#id').val();
	    
	    console.log(timezone_name);

	    var next_step = true;
	    var count = 0;

	    if(city_name === ''){
            //alert('Please enter your package city_name.');
            $('#city_name').focus();
             $('.error_city_name').html('<span style="color:red;float:left;">Enter city name</p>');
            next_step = false;
        }
        else{
            $('.error_city_name').html('<span style="display:none"/>')
        }
	    if(timezone_name === ''){
            //alert('Please enter your package timezone_name.');
            $('#timezone_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter country name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(timezone_gmt === ''){
            //alert('Please enter your package timezone_gmt.');
            $('#timezone_gmt').focus();
             $('.error_timezone_gmt').html('<span style="color:red;float:left;">Enter timezone gmt</p>');
            next_step = false;
        }
        else{
            $('.error_timezone_gmt').html('<span style="display:none"/>')
        }
	    if(timezone_offset === ''){
            //alert('Please enter your package timezone_offset.');
            $('#timezone_offset').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter timezone offset</p>');
            next_step = false;
        }
        else{
            $('.error_code').html('<span style="display:none"/>')
        }

        //alert(id);
	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/update-timezone/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, city_name:city_name, timezone_name:timezone_name, timezone_gmt:timezone_gmt, timezone_offset:timezone_offset, id:id},
	            success: function (data) {
	                console.log(data);

	                if(data.messageType == 'success'){
	                	Swal.fire(
						  '',
						  data.message,
						  'success'
	                		// form rese
						)
	                	count++;

						// reset form field
	                	$("#formID")[0].reset();

		               	// Redraw Table After Insert										
						var table = $('#posts').DataTable();

						$('.input-sm').val("");
						// #myInput is a <input type="text"> element
						$('.input-sm').on( 'keyup', function () {
							table.search( this.value ).draw();
						} );
						$( ".input-sm" ).trigger( "keyup" );

	                }

	                if(data.messageType == 'error'){
	                	Swal.fire(
						  '',
						  data.message,
						  'error'
	                		// form rese
						)
	                }

	            },
	            error: function(xhr, ajaxOptions, thrownError, data) {
	            	console.log(data);
	            	/*count++;
	            	Swal.fire(
						  '',
						  data.message,
						  'error'
						)*/
	                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	            }
	        });
	    }
}
