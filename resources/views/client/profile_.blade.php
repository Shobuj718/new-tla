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

<div class="single_project_content single-profile-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-profile-details wow fadeInLeft">
                        <div class="profile_section_title">About Client</div>
                        <div class="profile_tags" style=" border-top: 5px solid #00c3c0;">
                            <div class="lawyer_profile_top">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="https://thelawapp.com.au/assets/img/user.png" alt="Profile Image">
                                        
                                        <a href="https://thelawapp.com.au/edit-profile" style="font-size:13px; margin-top:20px; margin-left:auto; margin-right:auto;">Edit Profile</a>
                                    </div>
                                    
                                    <div class="col-lg-8">
                                        <div class="lawyer_name">
                                            <h4><a href="https://thelawapp.com.au/devclient">{{ $user->username }}</a></h4>
                                            <h6></h6>
                                            <p>0 Reviews</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="requried_skill project_tags">
                                            <ul>
                                                                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="lawyer_overview">
                                        <h5>Overview</h5>
                                        <p>{{ $user->about }}</p>
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
                                    <li><span>
                                        <i class="fa fa-star"></i>
                                        Rating
                                        </span>
                                        <span class="info lawyer_rating">
                                            <div class="rating-container rating-sm rating-animate rating-disabled"><div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i></div><div class="rating-stars"><span class="empty-stars"><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span></span><span class="filled-stars" style="width: 0%;"><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span></span><input name="input-3" value="" class="rating rating-input" data-size="sm" data-show-caption="false" data-readonly="true" data-empty-star="<span class=&quot;fa fa-star&quot;></span>" data-filled-star="<span class=&quot;fa fa-star checked&quot;></span>" readonly="readonly"></div></div>
                                        </span>
                                    </li>
                                    <li><span><i class="fa fa-briefcase"></i>Case Posted</span><span class="info">5</span></li>
                                    <li><span><i class="fa fa-phone"></i>Phone Verification</span><span class="info">{{ $user->phone_verified }}</span></li>
                                    <li><span><i class="fa fa-map-marker"></i>Location</span><span class="info">
                                                                                    {{ $user->location_name }}
                                                                            </span></li>
                                </ul>
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