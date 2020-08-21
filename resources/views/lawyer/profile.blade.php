@extends('master')

@section('content')

<div class="single_project breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-left wow fadeInLeft">
                <div class="breadcrumb_title">profile page</div>
            </div>
        </div>
    </div>
</div>


        <div class="single_project_content single-profile-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-profile-details wow fadeInLeft">
                        <div class="profile_section_title">About Lawyer</div>
                        <div class="profile_tags">
                            <div class="lawyer_profile_top" style=" border-top: 5px solid #00c3c0;">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="https://thelawapp.com.au/assets/img/user.png" alt="Profile Image">
                                            <a href="https://thelawapp.com.au/edit-profile" style="font-size:13px; margin-top:20px; margin-left:auto; margin-right:auto;">Edit Profile</a>
                                                                               
                                    </div>
                                    <?php 
                                    // dd($user->review);
                                    ?>
                                    <div class="col-lg-10">
                                        <div class="lawyer_name">
                                              <!--<a href="#">{{$user->name}}</a>-->
                                                <h4><a href="https://thelawapp.com.au/edit-profile" style="font-size:13px; margin-top:20px; margin-left:auto; margin-right:auto;">{{$user->first_name}}</a></h4>
                                                       <?php
                                                    //   dd($project_data);
                                                       ?>                           
                                            
                                            <h6>Family Lawyer</h6>
                                            <p>0 Reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-lg-12">
                                    <div class="lawyer_overview">
                                        <h5>Skill</h5>
                                        <div class="requried_skill project_tags">
                                            <ul>
                                                                                                    <li><span class="badge badge-pill badge-secondary">FAMILY LAW</span></li>
                                                                                                    <li><span class="badge badge-pill badge-secondary">WILLS, TRUSTS &amp; ESTATES</span></li>
                                                                                                    <li><span class="badge badge-pill badge-secondary">BANKRUPTCY/ TAXATION LAW</span></li>
                                                                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="lawyer_overview">
                                        <h5>Overview</h5>
                                        <p><span style="font-weight: bold; color: #5f6368; font-family: arial, sans-serif;"></span><span style="color: #4d5156; font-family: arial, sans-serif;">{{$user->about}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="lawyer_review">
                                        <h5>Work history and Reviews (0)</h5>
                                                                                                                                                                                                            
                                    </div>
                                </div>
                            </div>
                            
                            
    <style>
        .rating-sm {
           font-size: 1em;
        }
    </style>                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-4">
                    <div class="about_company lawyer_information wow fadeInRight">
                        <div class="profile_section_title">Info</div>
                        
                        <div class="about_company_dtls">
                            <div class="company_address" style=" border-top: 5px solid #00c3c0;">
                                <ul class="list-info-company">
                                    <li>
                                        <span><img class="fa fa-star" src="/images/profile/rating.png"> Rating </span>
                                        <span class="info lawyer_rating">
                                            <div class="rating-container rating-sm rating-animate rating-disabled"><div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i></div><div class="rating-stars"><span class="empty-stars"><span class="star"><i class="fa fa-star"></i></span><span class="star"><i class="fa fa-star"></i></span><span class="star"><i class="fa fa-star"></i></span><span class="star"><i class="fa fa-star"></i></span><span class="star"><i class="fa fa-star"></i></span></span><span class="filled-stars" style="width: 0%;"><span class="star"><i class="fa fa-star checked"></i></span><span class="star"><i class="fa fa-star checked"></i></span><span class="star"><i class="fa fa-star checked"></i></span><span class="star"><i class="fa fa-star checked"></i></span><span class="star"><i class="fa fa-star checked"></i></span></span><input name="input-3" value="" class="rating rating-input" data-size="sm" data-show-caption="false" data-readonly="true" data-empty-star="<i class=&quot;fa fa-star&quot;></i>" data-filled-star="<i class=&quot;fa fa-star checked&quot;></i>" readonly="readonly"></div></div>
                                        </span>
                                    </li>
                                    <li><span><img class="fa fa-star" src="/images/profile/experience.png"> Experience</span><span class="info">2+ Years</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/case-completed.png"> Case completed</span><span class="info">0</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/phone-verification.png"> Phone Verification</span><span class="info">Yes</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/payment-verified.png"> Payment verified</span><span class="info">Yes</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/certificate-verified.png"> Certificate verified</span><span class="info">Yes</span></li>
                                    <!--Field 1. Law Society Member Number -->
                                    <!--Field 2. Current Practising Certificate Number -->
                                    
                                                                        
                                    <li><span><img class="fa fa-star" src="/images/profile/law-society-member.png"> Law Society Membership Number</span><span class="info"> 2121212121</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/current_practice-number.png"> Current Practising Certificate Number</span><span class="info"> 212121</span></li>
                                    <li><span><img class="fa fa-star" src="/images/profile/location.png"> Location</span><span class="info">
                                        
                                        
                                        
                                                                                    Brisbane QLD
                                                                                
                                    </span></li>
                                </ul>
                            </div>
                        </div>
                        
                        
                        
                        
                                                        
                            <div class="profile_section_title mt-20">Documents</div>

                            <div class="about_company_dtls">
                                <div class="company_details">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <i class="fa fa-file-text"></i>
                                            <a class="badge badge-secondary" target="_blank" href="https://thelawapp.com.au/certificates/62/images-1-1790752168.jpg">Legal Cost Agreement</a>
                                        </div>
                                    </div>
                                    <div class="row">
    
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                            <i class="fa fa-file-text"></i>
                                            <a class="badge badge-secondary" target="_blank" href="https://thelawapp.com.au/certificates/62/87586518452205231.jpg">certtt</a>
                                        </div>
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                            <i class="fa fa-file-text"></i>
                                            <a class="badge badge-secondary" target="_blank" href="https://thelawapp.com.au/certificates/62/white-transparent-leaf-on-mirror-260nw-10291716971664957012.webp">ddd</a>
                                        </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                                            </div>
                </div>
            </div>
        </div>
        

@endsection

@section('scripts')


@endsection