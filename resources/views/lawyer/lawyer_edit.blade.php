@extends('master')

@section('content')

<div class="single_project breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left wow fadeInLeft">
                    <div class="breadcrumb_title">Edit Case</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="submit-project-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="submit-project-content">
                        <div class="card-body">
                            <form action="" method="post" name="lawyerCaseEdit" id="lawyerCaseEdit">
                                @csrf
                                <div class="form-group row pt-0">
                                    <label for="projectitle" class="col-sm-4 col-form-label">Case Title <span>Keep it short &amp; clear</span></label>
                                    <div class="col-sm-8">
                                        <input  type="text" class="form-control" value="{{ $project->title ?? '' }}" name="title" id="title" placeholder="Enter your case title">
                                        <input  type="hidden" class="form-control" value="{{ $project->slug ?? '' }}" name="slug" id="slug" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="budget" class="col-sm-4 col-form-label">Budget <span>Amount of money you are willing to pay</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <?php
                                            // dd($project->location_name);
                                            ?>
                                            <input type="number" value="{{$project->budget ?? ''}}" name="budget" class="form-control" aria-label="Amount (to the nearest dollar)" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                                                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="skillneeded" class="col-sm-4 col-form-label">Skills Needed <span>Keep it short &amp; clear</span></label>
                                    <div class="col-sm-8">
                                        <select class="browser-default custom-select" name="category_id">
                                        <option selected>Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="requried_skill project_tags mt-20">
                                            <ul id="selectedSkillsList">
                                                <li class="list-inline-item">
                                                        <span class="badge badge-pill badge-success">
                                                            FAMILY LAW
                                                            <span style="cursor: pointer;" class="removeSkillFromList" data-id="1">
                                                                <i class="fa fa-close"></i>
                                                            </span>
                                                        </span>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <!-- ======================== This html for google map ======================== -->
                            
                                <div class="form-group row">
                                    <label for="location" class="col-sm-4 col-form-label">Search and select your Location</label>
                                    <div class="col-sm-8">
                                        <div class="pac-card" id="pac-card">
                                            <div id="pac-container">
                                                <input id="pac-input" class="form-control pac-target-input" type="text" name="location" placeholder="Enter a location" value="{{$project->location_name ?? ''}}"  autocomplete="off">
                                                <input type="hidden" id="caseLat" name="lat" value=" {{ $project->lat ?? '' }}">
                                                <input type="hidden" id="caseLng" name="lng" value=" {{ $project->lng ?? '' }}">
                                                <input type="hidden" id="caseLocationName" name="location_name" value="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- =========================================================================== -->
                                
                                <div class="form-group row">
                                    <label for="post_code" class="col-sm-4 col-form-label">Post Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="post_code" class="form-control" id="post_code" title="Post Code" value="{{ $project->post_code ?? '' }}">
                                                                             </div>
                                </div>
                                <div class="form-group row">
                                <label for="casedetails" class="col-sm-4 col-form-label">Description <span>Please give a brief description of the matter you would like help with</span></label>
                                <div class="col-sm-8">
                                    <textarea id="description" name="description" rows="4"  cols="83">{{ $project->description ?? '' }}</textarea>
                                </div>
                            </div>
                                <div class="form-group row">
                                <label for="casefile" class="col-sm-4 col-form-label">Attachment <span>File extension: Png, Jpg, Pdf, Zip</span></label>
                                <div class="col-sm-8">
                                    <ul class="list-inline" id="uploadedAttachments"></ul>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="attachment" id="attachment" accept="image/jpeg,image/jpg,image/png,application/pdf,application/zip">

                                        </div>
                                        <!--<div class="input-group-append">
                                            <button class="btn btn-success" id="uploadAttachment" type="button"> <i class="fa fa-arrow-circle-o-up"></i> Upload</button>
                                        </div>-->
                                    </div>
                                                                        <div id="attach_file_error"></div>
                                </div>
                            </div>
                                
                                <div class="form-group row bb-0">
                                    <div class="col-sm-8 offset-sm-4">
                                        <button id="saveCase" type="submit" class="boxed_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script src="{{asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('backend/vendor/jquery/validate.min.js')}}"></script>

 <script type="text/javascript">
 
 // Wait for the DOM to be ready

    $(function() {
      $("form[name='lawyerCaseEdit']").validate({
        rules: {
          budget: "required",
          title:"required",
          description:"required",
          post_code:"required",
          location:"required",
          category_id:"required",
          attachment:"required"
        },
        messages: {
          budget: "require",
             title:"require",
          description:"require",
          post_code:"require",
          location:"require",
          category_id:"require",
           attachment:"require"
        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#lawyerCaseEdit')[0];       
                var bodyFormData = new FormData(form); 
                
                    	var file_data = $('#attachment')[0].files[0];
            	    	if(file_data !="") {
            		    console.log(file_data);
            			bodyFormData.append("attachment", file_data);
            		}
                console.log(bodyFormData);
                
                axios({
                method: 'post',
                url: "{{route('lawyer.case.update', $project->slug ?? '' )}}",
                data: bodyFormData,
                _token: '{!! csrf_token() !!}',
                headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                console.log(response);
                })
                .catch(function (response) {
                console.log(response);
                });
                
 
        }
      });
    });
    

</script>
    

@endsection