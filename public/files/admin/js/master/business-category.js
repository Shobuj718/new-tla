    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addBusinessCategory(){
	    var business_category_name = $('#business_category_name').val();
	    console.log(business_category_name)

	    var next_step = true;
	    var count = 0;

	    if(business_category_name === ''){
            //alert('Please enter your package business_category_name.');
            $('#business_category_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter business category name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }

	    //alert(name);
	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/add-business-category",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, business_category_name:business_category_name },
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
						var table = $('#business-category').DataTable();

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

	function editBusinessCategory(){
	    var business_category_name = $('#business_category_name').val();
	    var id = $('#id').val();
	    
	    console.log(business_category_name)

	    var next_step = true;
	    var count = 0;

	    if(business_category_name === ''){
            //alert('Please enter your package business_category_name.');
            $('#business_category_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter currency name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }

	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/edit-business-category/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, business_category_name:business_category_name, id:id},
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

		               	// Redraw Table After Insert										
						var table = $('#business-category').DataTable();

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
