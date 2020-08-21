(function ($) {

    function clearFileInput(inputId){
        let input = $(inputId);
        input.replaceWith(input.val('').clone(true));
    }

    function updateFileName(filename){
        $('#attachedFileName').html(filename);
    }

    function updateAttachmentsList(uploadedFile){
        $('#uploadedAttachments').append('<li><span class="badge badge-pill badge-success">'+uploadedFile.name+' <span style="cursor: pointer;" class="removeFileFromList" data-path="'+uploadedFile.path+'"><i' +
            ' class="fa fa-close"></i><input type="hidden" name="attachments[]" value="'+uploadedFile.path+'"></span></span></li>');
    }
    
    function printResponseMessage(data) {
            $('#response_messages').html('<p  style="color:red">' + data.message + '</p>');
        
    }

    $(document).ready(function () {
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
                url: '/delete-proposal-attachment',
                data: {filepath: filepath}
            }).done(function (data) {
                console.log(clickedElement);
                clickedElement[0].parentElement.remove();
                console.log(data);
                //printResponseMessage(data);
                
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
            let proposal_id = $('#proposal_id').val();
            let fd = new FormData();
            fd.append('attachment', attachment_file);
            fd.append('proposal_id', proposal_id);
            
            console.log(proposal_id);
            //return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "post",
                url: '/upload-proposal-attachment',
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


        tinymce.init({
            selector: '#proposalDescription',
            element_format: 'html',
            plugins: [
                "a11ychecker advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools", " lists link linkchecker media mediaembed noneditable powerpaste preview", " searchreplace table template textcolor tinymcespellchecker visualblocks wordcount"
            ]
        });
    });
})(jQuery);