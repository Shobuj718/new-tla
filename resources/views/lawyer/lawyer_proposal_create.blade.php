
@extends('master')

@section('content')

    <div class="single_project_content bid-on-case">
    <div class="single_project_title ">
        <div class="container pl-0 pr-0 single_pro_table wow fadeIn">
            
                                            
            <div class="row ml-0 mr-0">
                
                <div class="col-lg-12 pl-0 pr-0">
                    <table class="table table-borderless">
                        <thead class="bg_gray">
                            <tr>
                                <th>CASE TITLE</th>
                                <th>posted DATE</th>
                                <th>Budget</th>
                            </tr>
                        </thead>
                        <tbody class="bg_white">
                            <tr>
                                <td class="s_pro_title">
                                    <a href="https://thelawapp.com.au/case/case_devRingku_5f17d6ce85294">Test Case</a>
                                </td>
                                <td>July 22, 2020</td>
                                <td class="s_pro_price">$150</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container single_project_all">
            <div class="row bg_white">
                <div class="col-lg-8">
                    <div class="single_project_details wow fadeInLeft">
                        <h6>Case description:</h6>
                        <p>Need a Lawyer</p>
                    </div>
                    <div class="requried_skill project_tags">
                        <div class="req_title">Skills required: </div>
                        <ul>
                                                        <li><span class="badge badge-pill badge-success">FAMILY LAW</span></li>
                                                    </ul>
                    </div>

                                    </div>
                <div class="col-lg-4 wow fadeInRight">
                    <div class="about_company lawyer_information bid-sidebar wow fadeInRight">
                        <h6>About Client</h6>
                        <div class="about_company_dtls">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="https://thelawapp.com.au/assets/img/user.png" alt="Profile Image">
                                </div>
                                <div class="col-lg-9 justify-content-center align-self-center">
                                    <div class="lawyer_name">
                                        <h4><a href="https://thelawapp.com.au/devRingku">Dev Client</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="company_address">
                                <ul class="list-info-company">
                                    <li><span><i class="fa fa-star"></i>Rating</span><span class="info lawyer_rating"><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i></span></li>
                                    <li><span><i class="fa fa-leaf"></i>Total Spend</span><span class="info">$150</span></li>
                                    <li><span><i class="fa fa-briefcase"></i>Case Posted</span><span class="info">1</span></li>
                                    <li><span><i class="fa fa-map-marker"></i>Location</span><span class="info">Gaibandha</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row bidding-form">
                <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="TMxLp7mmgLQ39f6Hq2W1lT2g2EMb7mBa3WsFf9PG">                    
                    <div class="bidding-form-content">
                    <div class="col-lg-12">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 pr-0 col-form-label" for="your-rate">Your rate <span>Total amount the client will see on your bid</span></label>
                                    <div class="col-sm-7 justify-content-center align-self-center">
                                        <div class="input-group sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="number" name="budget" class="form-control" id="your-rate" value="" aria-describedby="your-rate">
                                                                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalDescription">Bid Details</label>
                                    <div class="col-md-12">
                                        <textarea id="description" name="description" rows="4" cols="83"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <!-- ===================================== SOW ===================================== -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalDescription">Scopes of work</label>
                                    <div class="col-md-12">
                                        <textarea id="description" name="description" rows="4" cols="83"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 pr-0 col-form-label" for="attach_file">Attachment <span>Attach files</span></label>
                                    <div class="col-sm-7 justify-content-center align-self-center">
                                        <ul class="list-inline" id="uploadedAttachments"></ul>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="attachment" class="custom-file-input" id="attach_file" accept="image/jpeg,image/jpg,image/png,application/pdf,application/zip">
                                                <label class="custom-file-label" for="attach_file" id="attachedFileName">Choose file</label>
                                            </div>
                                           <!-- <div class="input-group-append">
                                                <button class="btn btn-success" id="uploadAttachment" type="button"> <i class="fa fa-arrow-circle-o-up"></i> Upload</button>
                                            </div>-->
                                        </div>
                                        <div id="attach_file_error"></div>
                                    </div>
                                </div>
                            </div>
                            
                      
                            
                           
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <button type="submit" class="boxed_btn">Bid Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            
           
            
        </div>
    </div>
</div>
    
@endsection

@section('scripts')


@endsection
