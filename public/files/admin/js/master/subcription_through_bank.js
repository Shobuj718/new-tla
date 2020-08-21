    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addSubscriptionThroughBank(){

	    var bank_name       = $('#bank_name').val();
	    var bank_acc        = $('#bank_acc').val();
	    var sub_email       = $('#sub_email').val();
	    var sub_amt         = $('#sub_amt').val();
	    var package_id      = $('#package_id').val();
	    var user_id         = $('#user_id').val();
	    var sub_currency    = $('#sub_currency').val();
	    
	    console.log(bank_name)

	    var next_step = true;
	    var count = 0;

	    if(bank_name == ''){
            $('#bank_name').focus();
             $('.error_bank_name').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_bank_name').html('<span style="display:none"/>')
        }
	    if(bank_acc == ''){
            $('#bank_acc').focus();
             $('.error_bank_acc').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_bank_acc').html('<span style="display:none"/>')
        }
	    /*if(sub_email == ''){
            $('#sub_email').focus();
             $('.error_sub_email').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_sub_email').html('<span style="display:none"/>')
        }*/
        
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!filter.test(sub_email))
        {
            $('#sub_email').focus();
            $('.error_sub_email').html('<span style="color:red;float:left;"> * invalid email</p>');
            next_step = false;
        }
        else{
            $('.error_sub_email').html('<span style="display:none"/>')
        }  
      
	    if(sub_amt == ''){
            $('#sub_amt').focus();
             $('.error_sub_amt').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_sub_amt').html('<span style="display:none"/>')
        }
	    if(package_id == ''){
            $('#package_id').focus();
             $('.error_package_id').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_package_id').html('<span style="display:none"/>')
        }
	    if(sub_currency == ''){
            $('#sub_currency').focus();
             $('.error_sub_currency').html('<span style="color:red;float:left;">* required</p>');
            next_step = false;
        }
        else{
            $('.error_sub_currency').html('<span style="display:none"/>')
        }

	    //alert(name);
	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "https://cdn.miyn.app/add-subscription-through-bank",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, user_id:user_id, bank_name:bank_name, bank_acc:bank_acc, sub_email:sub_email, sub_amt:sub_amt, package_id:package_id, sub_currency:sub_currency},
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
