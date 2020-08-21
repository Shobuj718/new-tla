    
// insert package name
function packageDataSubmit(){
    	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    	console.log(CSRF_TOKEN);
	    var package_name = $('#package_name').val();
	    var package_description = $('#package_description').val();
	    console.log(package_name)

	    var next_step = true;
	    var count = 0;

	    if(package_name === ''){
            //alert('Please enter your package name.');
            $('#package_name').focus();
             $('.error_package_name').html('<span style="color:red;float:left;">Enter package name</p>');
            next_step = false;
        }
        else{
            $('.error_package_name').html('<span style="display:none"/>')
        }
	    if(package_description === ''){
            //alert('Please enter your package name.');
            $('#package_description').focus();
             $('.error_package_description').html('<span style="color:red;float:left;">Enter package description</p>');
            next_step = false;
        }
        else{
            $('.error_package_description').html('<span style="display:none"/>')
        }

        //alert(package_name);
        
	    if(next_step && count == 0){
	    	count++;
	    	//alert(count++);
	        $.ajax({
	            url : "http://cdn.miyn.net/package-add-new",
	            type: 'POST',
	            data: {_token:CSRF_TOKEN, package_name:package_name, package_description:package_description},
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
// update package name
function packageDataEdit(){
    	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    	console.log(CSRF_TOKEN);
	    var package_name = $('#package_name').val();
	    var package_description = $('#package_description').val();
	    var package_id = $('#package_id').val();
	    console.log(package_name)

	    var next_step = true;
	    var count = 0;

	    if(package_name === ''){
            //alert('Please enter your package name.');
            $('#package_name').focus();
             $('.error_package_name').html('<span style="color:red;float:left;">Enter package name</p>');
            next_step = false;
        }
        else{
            $('.error_package_name').html('<span style="display:none"/>')
        }
	    if(package_description === ''){
            //alert('Please enter your package name.');
            $('#package_description').focus();
             $('.error_package_description').html('<span style="color:red;float:left;">Enter package description</p>');
            next_step = false;
        }
        else{
            $('.error_package_description').html('<span style="display:none"/>')
        }


	    if(next_step && count == 0){
	    	count++;
	    	//alert(count++);
	        $.ajax({
	            url : "/package-update/"+package_id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, package_name:package_name, package_description:package_description},
	            success: function (data) {
	                console.log(data);

	                if(data.messageType == 'success'){
	                	Swal.fire(
						  '',
						  data.message,
						  'success',
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
