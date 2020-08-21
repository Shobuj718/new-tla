@extends('master')

@section('content')

<div class="single_project breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-left wow fadeInLeft">
                <div class="breadcrumb_title">Post Case</div>
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
                            <form name="lawyerCreateCase" id="lawyerCreateCase">
                            @csrf
                          
                            <div class="form-group row pt-0">
                                <label for="projectitle" class="col-sm-4 col-form-label">Case Title <span>Keep it short &amp; clear</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="projectitle" value="" placeholder="Enter your case title">
                                                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="budget" class="col-sm-4 col-form-label">Budget <span>Amount of money you are willing to pay</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="budget" class="form-control" value="" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                                                            </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                
                                <label for="skillneeded" class="col-sm-4 col-form-label">Skills Needed <span>Select from the list</span></label>
                                <div class="col-sm-8">
                                    <select class="browser-default custom-select" name="skill">
                                        <option selected value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            
                            <!-- ============================= This html for google map ============================= -->
                            
                            <div class="form-group row">
                                <label for="location" class="col-sm-4 col-form-label">Search and select your Location</label>
                                <div class="col-sm-8">
                                    <div class="pac-card" id="pac-card">
                                        <div id="pac-container">
                                            <input id="pac-input" class="form-control pac-target-input" type="text" name="location" value="" placeholder="Enter a location" autocomplete="off">
                                            <input type="hidden" id="lat" name="lat" value="">
                                            <input type="hidden" id="lng" name="lng" value="">
                                            <input type="hidden" id="locationName" name="location_name" value="">
                                        </div>
                                        
                                    </div>
                                    <div style="display: none;">
                                        <div id="map" style="position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"><div style="overflow: hidden;"></div><div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;"><div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;"><div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; z-index: 997; transform: matrix(1, 0, 0, 1, -25, -182);"><div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;"><div style="width: 256px; height: 256px;"></div></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; z-index: 997; transform: matrix(1, 0, 0, 1, -25, -182);"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div></div><div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;"><p class="gm-style-pbt"></p></div><div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;"><div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div></div><iframe aria-hidden="true" frameborder="0" tabindex="-1" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;"></iframe></div></div></div>
            
                                        <div id="infowindow-content">
                                            <img src="" width="16" height="16" id="place-icon">
                                            <span id="place-name" class="title"></span><br>
                                            <span id="place-address"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ==================================================================================== -->
                            
                            <div class="form-group row">
                                <label for="post_code" class="col-sm-4 col-form-label">Post Code</label>
                                <div class="col-sm-8">
                                    <input type="text" name="post_code" class="form-control" id="post_code" value="" title="Post Code">
                                                                    </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="casedetails" class="col-sm-4 col-form-label">Description <span>Please give a brief description of the matter you would like help with</span></label>
                                <div class="col-sm-8">
                                    <textarea id="description" name="description" rows="4" cols="83"></textarea>
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
                                        <button id="saveCase" type="submit" class="boxed_btn">Submit</button>
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

   

        // Wait for the DOM to be ready

        $(function() {
            $("form[name='lawyerCreateCase']").validate({
                rules: {
                     budget: "required",
                    title: "required",
                    location:"required",
                    post_code:"required",
                    description:"required",
                    skill:"required",
                    attachment:"required"
                    
                },
                messages: {
                    budget: "require",
                    title: "require",
                    location:"require",
                    post_code:"require",
                    description:"require",
                    skill:"require",
                    attachment:"require"
                },
                submitHandler: function(form) {
                    //form.submit();

                    //console.log('Called');
                    var form = $('#lawyerCreateCase')[0];
                    var bodyFormData = new FormData(form);
                    	var file_data = $('#attachment')[0].files[0];
            	    	if(file_data !="") {
            		    console.log(file_data);
            			bodyFormData.append("attachment", file_data);
            		}
                // console.log(bodyFormData);
                    console.log(bodyFormData);
                    //return false;

                    axios({
                        method: 'post',
                        url: "{{route('lawyer.case.store')}}",
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