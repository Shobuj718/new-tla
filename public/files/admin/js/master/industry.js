    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function addIndustry(){
	    var industry_name = $('#industry_name').val();
	    console.log(industry_name)

	    var next_step = true;
	    var count = 0;

	    if(industry_name === ''){
            //alert('Please enter your package industry_name.');
            $('#industry_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter industry name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }

	    /*alert(industry_name);
	    return false;*/

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/add-industry",
	            type: 'post',
	            data: {_token:CSRF_TOKEN, industry_name:industry_name },
	            success: function (data) {
	                console.log(data);

	                if(data.messageType == 'success'){
	                	Swal.fire(
						  '',
						  data.message,
						  'success'
						)
	                	count++;
	                	// reset form field
	                	$("#formID")[0].reset();

		               	// Redraw Table After Insert										
						var table = $('#industry').DataTable();

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

	function editIndustry(){
	    var industry_name = $('#industry_name').val();
	    var id = $('#id').val();
	    
	    console.log(industry_name)

	    var next_step = true;
	    var count = 0;

	    if(industry_name === ''){
            //alert('Please enter your package industry_name.');
            $('#industry_name').focus();
             $('.error_name').html('<span style="color:red;float:left;">Enter industry name</p>');
            next_step = false;
        }
        else{
            $('.error_name').html('<span style="display:none"/>')
        }

	    //return false;

	    if(next_step && count == 0){
	    	count++;
	        $.ajax({
	            url : "/update-industry/"+id,
	            type: 'post',
	            data: {_token:CSRF_TOKEN, industry_name:industry_name, id:id},
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
						var table = $('#industry').DataTable();

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
