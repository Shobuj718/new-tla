@extends('master')

@section('content')

<div class="single_project_content">
        <div class="single_project_title">
            <div class="container pl-0 pr-0 single_pro_table wow fadeIn">
                <div class="row ml-0 mr-0">
                    <div class="col-lg-12 pl-0 pr-0">
                        
                        @if(session('success'))
        				  <div class="alert alert-success alert-dismissable">
        					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        					  {{session('success')}}
        				  </div>
        				@endif
                        
                        <table class="table table-borderless">
                            <thead class="bg_gray">
                            <tr>
                                <th>CASE TITLE</th>
                                <th>BY</th>
                                <th>posted DATE</th>
                                <th>Budget</th>
                                @if($project->created_by == Auth::user()->id)
                                <th>
                                    Action
                                </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="bg_white">
                                <tr>
                                    <td class="s_pro_title">{{$project->title}}</td>
                                    <td>{{$project->client->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($project->created_at)->format('j, F, Y')}}</td>
                                    <td class="s_pro_price">${{$project->budget}}</td>
                                     
                                    
                                    @if($project->created_by == Auth::user()->id)
                                    <td><a class="boxed_btn" href="{{ route('client.case.edit', $project->slug) }}">Edit</a></td>
                                        @if($project->status == "<span class='pending'>Pending</span>" || $project->status == "<span class='approved'>Approved</span>")
                                            <td><a class="boxed_btn" href="{{ route('client.case.edit', $project->slug) }}">Edit</a></td>
                                        @endif
                                        @if($project->status == "<span class='active'>Active</span>")
                                            <td><a class="boxed_btn" href="{{url('/complete-case/'.$project->slug)}}">Case Complete</a></td>
                                            <td><a class="boxed_btn" id="create-subcase-button" href="#">Create new case</a></td>
                                        @endif
                                        @if($project->status == "<span class='complete'>Complete</span>")
                                            <td><button class="boxed_btn">Completed</button></td>
                                            <td><a class="boxed_btn" id="create-subcase-button" href="#">Create new case</a></td>
                                        @endif
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container single_project_all">
                <div class="row bg_white">
                    <div class="col-lg-12 wow fadeIn">
                        <ul class="meta_data">
                            <li>
                                <a href="#"><span>1</span>Bids</a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>
                                        <sup>$</sup>
                                        1
                                    </span>
                                    Avg Bid (AUD)
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                                                            <span>Open</span> till 1 month from now
                                                                    </a>
                            </li>
                            <li class="create_a_pro">
                                <a href="https://thelawapp.com.au/create-similar-case/case_devclient_5f31192eac01f">
                                    <span><i class="fa fa-plus-circle"></i></span>Create similar case
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="social">
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row bg_white padd_bottom20">
                    <div class="col-lg-8">
                        <div class="single_project_details wow fadeInLeft">
                            <h6>Case description:</h6>
                            <p><span style="color: #5f6f81; font-family: Raleway, sans-serif; font-size: 13px;">Amount of money you are willing to pay</span><span style="color: #5f6f81; font-family: Raleway, sans-serif; font-size: 13px;">Amount of money you are willing to pay</span><span style="color: #5f6f81; font-family: Raleway, sans-serif; font-size: 13px;">Amount of money you are willing to pay</span><span style="color: #5f6f81; font-family: Raleway, sans-serif; font-size: 13px;">Amount of money you are willing to pay</span></p>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight">
                        <div class="requried_skill project_tags">
                            <div class="req_title">Skills required: </div>
                            <ul>
                                                                    <li><span class="badge badge-success">FAMILY LAW</span></li>
                                                                    <li><span class="badge badge-success">WILLS, TRUSTS &amp; ESTATES</span></li>
                                                                    <li><span class="badge badge-success">BANKRUPTCY/ TAXATION LAW</span></li>
                                                            </ul>
                        </div>
                                            </div>
                </div>

                <div class="s_p_bottom">
                    <div class="row">
                        <div class="col-lg-12 pl-0 wow fadeInLeft pr-0">
                                                        <table class="table table-borderless table-responsive-sm">
                                <thead class="bg_gray">
                                <tr>
                                    <th>Bidding Lawyers (1)</th>
                                    <th>reputation</th>
                                    <th>bid</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                        <tbody class="table_w_bg">
                                            <tr>
                                                <td class="row_title"><img src="https://thelawapp.com.au/avatars/maxresdefault1313477525.jpg" alt="Profile">
                                                    <div class="bid_f">
                                                        <a href="https://thelawapp.com.au/nupurbss">Nupur A.</a>
                                                        <span>Employment Law</span>
                                                    </div>
                                                    <div class="bid_profile">
                                                        <a href="https://thelawapp.com.au/proposal/proposal_nupurbss_5f31195b2bae6" class="v_pro">View Proposal</a>
                                                    </div>
                                                </td>
    
                                                <td>
                                                    <ul class="ratings">
                                                        <li class="rat"><div class="rating-container rating-sm rating-animate rating-disabled"><div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i></div><div class="rating-stars"><span class="empty-stars"><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span></span><span class="filled-stars" style="width: 0%;"><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span></span><input name="input-3" value="" class="rating rating-input" data-size="sm" data-show-caption="false" data-readonly="true" data-empty-star="<span class=&quot;fa fa-star&quot;></span>" data-filled-star="<span class=&quot;fa fa-star checked&quot;></span>" readonly="readonly"></div></div></li>
                                                        <!--<li class="rat"><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i><i class="fa fa-star marked"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>-->
                                                        <li class="year">3+ Years</li>
                                                    </ul>
                                                </td>
    
                                                <td class="s_pro_price">
                                                    <sup>$1</sup>
                                                </td>
                                                    <td class="td_action">
                                                    <a href="https://thelawapp.com.au/call-for-interview/nupurbss/case_devclient_5f31192eac01f/proposal_nupurbss_5f31195b2bae6" class="boxed_btn interview">Interview</a>
                                                        <span style="width: 97px; margin-left: 4px;" class="badge badge-success">Accepted</span>
                                                    </td>
                                            </tr>
                                            
                                        </tbody>
                                                                    <!--<tr>
                                        <td>
                                            <a href="#">this is sub case title....</a>
                                        </td>
                                    </tr>-->
                                                            </table>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')


@endsection