<style>
    body.modal-open .modal {
        overflow: hidden;
        padding: 0 15px;
    }
    .modal-open .modal.in .modal-dialog {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        top: 0;
        max-height: calc(100% - 30px);
        margin: 20px auto;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        min-height: 300px;
    }
    .modal .modal-content {
        /*height: 100%;*/
        overflow: hidden;
    }
    .modal .modal-body {
        height: calc(100% - 56px);
        overflow: hidden;
        padding: 0 0 15px;
    }
    .modal .panel-content {
        height: 100%;
        overflow: hidden;
    }
    .modal .panel-content form {
        height: 100%;
        display: flex;
        flex-flow: wrap row;
        width: 100%;
        overflow: hidden;
    }
    .modal .modal-content .modal-content-area {
        width: 100%;
        max-height: calc(100% - 50px);
        overflow-y: auto;
        overflow-x: hidden;
        padding: 0 25px 10px;
    }
    /* Let's get this party started */
    .modal .modal-content .modal-content-area::-webkit-scrollbar {
        width: 8px;
    }
    /* Track */
    .modal .modal-content .modal-content-area::-webkit-scrollbar-track {
        background-color: #f9f9f9;
        -webkit-box-shadow: inset 0 0 3px #f9f9f9;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
    /* Handle */
    .modal .modal-content .modal-content-area::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #e1e1e1; 
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: #e1e1e1; 
    }
    .modal .modal-content .form-group {
        margin: 0 auto;
        padding: 10px 0;
        max-width: 90%;
        border-bottom: 0;
    }
    .modal .modal-content .modal-content-area .form-group .control-label {
        padding: 0;
        text-align: left;
        font-size: 12px;
        font-weight: 500;
    }
    .modal-content-area .form-group .form-control:focus, .modal-content-area .form-group .cke_wysiwyg_frame:focus {
        border-color: #189279;
        box-shadow: none;
    }
    .modal .modal-content .modal-footer {
        width: 100%;
        align-self: flex-end;
        padding: 0 30px;
        text-align: left;
    }
    @media screen and (max-width: 767px) {
        body.modal-open .modal {
            padding: 0;
        }
    }
    
</style>
<div class="panel-content">
    <form id="inline-validation" class="form-stripe">
        @csrf
        <div class="modal-content-area">
            <div class="form-group">
                <label for="name" class="control-label">Create Skill<span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>
           
            
            <div class="form-group">
                <label for="summaryckeditor" class="control-label">Description</label>
                <textarea class="form-control" type="text" id="summaryckeditor" class="summaryckeditor" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="imagae" class="control-label">Image<span class="required">*</span></label>
                <input type="file" class="form-control" id="imagae" name="imagae" >
            </div>
        </div>
        <div class="modal-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

@section('js')
        <script>
           $(function() {

            "use strict";
        
            //INLINE VALIDATION
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $("#inline-validation").validate({
        
                highlight: function(label) {
                    $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(label) {
                    $(label).closest('.form-group').removeClass('has-error');
                    label.remove();
                },
        
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 8
                    },
                    username: {
                        required: true,
                        minlength: 2,
                        maxlength: 8
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 4,
                        maxlength: 10
                    },
                    'confirmation': {
                        required: true,
                        minlength: 4,
                        maxlength: 10,
                        equalTo: "#password"
                    },
                    age: {
                        required: true,
                        number: true,
                        range: [18, 100]
                    },
                    url: {
                        url: true
                    }
                }
            });
        </script>

@endsection
  
  






