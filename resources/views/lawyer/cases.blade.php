@extends('master')

@section('content')

<div class="container">
    <h1>Dashboard | Cases</h1>
</div>

<div class="dashboard-section">
        <div class="container">
            
                                    
            <div class="dashboard-content">
                
                <div class="row">

                    @include('lawyer.lawyer_dashboard_left_side_bar')                    
                    <div class="col-lg-8 col-md-8 col-sm-12 dashboard-contentarea " style="border-top: 5px solid #00c3c0;">
                        <div class="search-dashboard">
                            <div class="row align-items-center">
                                <div class="col-md-12 col-sm-12 form-group case-search">
                                    <input style="float: right;" type="search" class="form-control" name="search" id="search" placeholder="Search Cases">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-6 col-sm-12 case-profile-link">
                                    <!--<a class="btn boxed_btn" href="https://thelawapp.com.au/edit-profile">Edit Profile</a>-->
                                    <!--<a class="btn boxed_btn" href="https://thelawapp.com.au/create-case">Create Case</a>-->
                                </div>
                            </div>
                            <div id="searchListBox">
                                <ul class="search_list" id="caseList" style="display: none;">
                                    
                                </ul>
                            </div>
                        </div>                        
                        <div class="dashboard-menu-content dashboard-content-title">
                            <div class="dashboard_heading">
                                <h2>Cases</h2>
                            </div>
                        </div>
                            @foreach($cases as $case)
                        <div class="dashboard-menu-content case-item">
                        <div class="case-title">
                            <h2>
                                <a href="{{ route('lawyer.case.show', $case->slug) }}">{{$case->title}}</a>
                                <span class="published-date"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($case->created_at)->diffForHumans()}}</span>
                                <span class="case-status">
                                    Status:
                                    {!! $case->status !!}
                                </span>
                            </h2>
                        </div>
                        <div class="case-meta-data">
                            <ul>
                                {{--<li><span>5</span> Messages</li>--}}
                                <li><span>{{$case->bids->count()}}</span> Bid</li>
                                <li><span> $ {{$case->budget}}</span> Budget</li>
                                <li><span> $ {{$case->avg_bid}}</span> Avg. Bid (AUD)</li>
                            </ul>
                        </div>
                        <div class="case-short-description">
                            <p>
                                {!! $case->short_description !!}
                                <a href="{{ route('lawyer.case.show', $case->slug) }}">view</a>
                            </p>
                        </div>
                        <div class="case-action">
                            <!--<select class="form-control">-->
                            <!--    <option value="">Actions</option>-->
                            <!--    <option value="edit">Edit</option>-->
                            <!--    <option value="view">View Case</option>-->
                            <!--    <option value="end">End</option>-->
                            <!--</select>-->
                        </div>
                    </div>
                    @endforeach
                        
                    @if($cases->hasMorePages())
                        <div class="dashboard-menu-content pagination-area">
                            {{$cases->links()}}
                        </div>
                    @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection

@section('scripts')




@endsection