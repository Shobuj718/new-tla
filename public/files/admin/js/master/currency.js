    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addCurrencyData(){
	    var currency_name = $('#currency_name').val();
	    var currency_shortcode = $('#currency_shortcode').val();
	    console.log(currency_name)

	    var next_step = true;
	    var count = 0;

	    if(currency_name === ''){
            //alert('Please enter your package currency_name.');
            $('#currency_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter currency name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(currency_shortcode === ''){
            //alert('Please enter your package name.');
            $('#currency_shortcode').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter currency short code</p>');
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
	            url : "/add-currency",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, currency_name:currency_name, currency_shortcode:currency_shortcode},
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
						var table = $('#currency').DataTable();

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

	function editCurrencyData(){
	    var currency_name = $('#currency_name').val();
	    var currency_shortcode = $('#currency_shortcode').val();
	    var id = $('#id').val();
	    
	    console.log(currency_name)

	    var next_step = true;
	    var count = 0;

	    if(currency_name === ''){
            //alert('Please enter your package currency_name.');
            $('#currency_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter currency name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }
	    if(currency_shortcode === ''){
            //alert('Please enter your package name.');
            $('#currency_shortcode').focus();
             $('.error_code').html('<span style="color:red;float:left;">Enter currency short code</p>');
            next_step = false;
        }
        else{
            $('.error_code').html('<span style="display:none"/>')
        }

	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/edit-currency/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, currency_name:currency_name, currency_shortcode:currency_shortcode, id:id},
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
						var table = $('#currency').DataTable();

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
