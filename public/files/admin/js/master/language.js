    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addLanguage(){
	    var language_name 	= $('#language_name').val();
	    var short_name 		= $('#short_name').val();
	    console.log(language_name)

	    var next_step = true;
	    var count = 0;

	    if(language_name === ''){
            //alert('Please enter your package language_name.');
            $('#language_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter language name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(short_name === ''){
            //alert('Please enter your package name.');
            $('#short_name').focus();
             $('.short_code_error_name').html('<span style="color:red;float:left;">Enter language short short code</p>');
            next_step = false;
        }
        else{
            $('.short_code_error_name').html('<span style="display:none"/>')
        }

	    /*alert(language_name);
	    return false;*/

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/add-language",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, language_name:language_name, short_name:short_name},
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
						var table = $('#language').DataTable();

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

	function editLanguage(){
	    var language_name = $('#language_name').val();
	    var short_name = $('#short_name').val();
	    var id = $('#id').val();
	    
	    console.log(language_name)

	    var next_step = true;
	    var count = 0;

	    if(language_name === ''){
            //alert('Please enter your package language_name.');
            $('#language_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter language name.</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(short_name === ''){
            //alert('Please enter your package name.');
            $('#short_name').focus();
             $('.short_code_error_name').html('<span style="color:red;float:left;">Enter language short name.</p>');
            next_step = false;
        }
        else{
            $('.short_code_error_name').html('<span style="display:none"/>')
        }

        /*alert(language_name);
	    return false;*/

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/update-language/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, language_name:language_name, short_name:short_name, id:id},
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
						var table = $('#language').DataTable();

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
