    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function countryDataSubmit(){
	    var country_name = $('#country_name').val();
	    var country_code = $('#country_code').val();
	    console.log(country_name)

	    var next_step = true;
	    var count = 0;

	    if(country_name === ''){
            //alert('Please enter your package country_name.');
            $('#country_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter country name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(country_code === ''){
            //alert('Please enter your package name.');
            $('#country_code').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter country code</p>');
            next_step = false;
        }
        else{
            $('.error_code').html('<span style="display:none"/>')
        }

	    //alert(name);
	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/add-country",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, country_name:country_name, country_code:country_code},
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

	function editCountryData(){
	    var country_name = $('#country_name').val();
	    var country_code = $('#country_code').val();
	    var id = $('#id').val();
	    console.log(id);

	    var next_step = true;
	    var count = 0;

	    if(country_name === ''){
            //alert('Please enter your package country_name.');
            $('#country_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter country name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(country_code === ''){
            //alert('Please enter your package name.');
            $('#country_code').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter country code</p>');
            next_step = false;
        }
        else{
            $('.error_code').html('<span style="display:none"/>')
        }

	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/update-country/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, country_name:country_name, country_code:country_code, id:id},
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
	                	$("#country")[0].reset();

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
