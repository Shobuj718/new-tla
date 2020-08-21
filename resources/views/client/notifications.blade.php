@extends('master')

@section('content')

<div class="page-title">
    <div class="container">
        <h1>Dashboard | Notifications</h1>
    </div>
</div>

    <div class="dashboard-section">
        <div class="container">
            <div class="dashboard-content">
                <div class="row">

                    @include('client.dashboard.client_dashboard_left_side_bar')                   
                    <div class="col-lg-8 col-md-8 col-sm-12 dashboard-contentarea">
                        <div class="search-dashboard" style="border-top: 5px solid #00c3c0;">
    <div class="row align-items-center">
        <div class="col-md-9 col-sm-12 form-group">
            <input style="float: right;" type="search" class="form-control" name="search" id="search" placeholder="Search Lawyers">
            <!--<button type="submit"><i class="fa fa-search"></i></button>-->
        </div>
        <div class="col-md-3 col-sm-12 case-profile-link">
            <!--<a class="btn boxed_btn" href="https://thelawapp.com.au/edit-profile">Edit Profile</a>-->
            <a class="btn boxed_btn" href="{{ route(Auth::user()->type.'.case.create', $user->uid) }}">Create Case</a>
        </div>
    </div>
    <div id="searchListBox">
        <ul class="search_list" id="lawyerList" style="display: none;">
            
        </ul>
    </div>
</div>                        <div class="dashboard-menu-content dashboard-content-title notification-list">
                                <h2>Notifications</h2>
                                <div class="row">
                                    <div class="col-md-5 col-sm-12">
                                        <div class="sorting-list action-list">
                                            <form action="">
                                                <ul>
                                                    <li>
                                                        <div class="select-all">
                                                            <label class="checkbox-container">
                                                                <input id="notificationsSelectCheckbox" type="checkbox" name="checkall">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <select id="notificationsSelectMenu" class="form-control">
                                                            <option value="all">All</option>
                                                            <option value="none">None</option>
                                                            <option value="read">Read</option>
                                                            <option value="unread">Unread</option>
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <div class="delete">
                                                            <button type="submit" id="deleteNotifications" class="btn btn-outline-light" disabled="">Delete</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-dashboard">
                                    
                                                                                                                    
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="true">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="1c4423cc-fbe2-451b-be60-ab2fc71c86d6">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/nupurbss?source_notification=1c4423cc-fbe2-451b-be60-ab2fc71c86d6">
                                                                                                                        <span class="not-job-title">Nupur A.</span>
                                                        </a>
                                                        hired successfully for 
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f31192eac01f?source_notification=1c4423cc-fbe2-451b-be60-ab2fc71c86d6">
                                                            
                                                            "<span class="not-job-title"> dev need to immigration in aus </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   19:56 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="4a6dd485-2179-4f85-8f67-cfe6ee1fcd95">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/nupurbss">
                                                                                                                        <span class="not-job-title">Nupur A.</span>
                                                        </a>
                                                        <a href="https://thelawapp.com.au/proposal/proposal_nupurbss_5f31195b2bae6?source_notification=4a6dd485-2179-4f85-8f67-cfe6ee1fcd95">
                                                            <span class="not-job-title">bid</span>
                                                        </a> 
                                                        on
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f31192eac01f?source_notification=4a6dd485-2179-4f85-8f67-cfe6ee1fcd95">
                                                            "<span class="not-job-title"> dev need to immigration in aus </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   19:54 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="411e4490-6bf0-4c0e-b54d-73d65b53ff79">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>Admin approved your case<a href="https://thelawapp.com.au/case/case_devclient_5f31192eac01f?source_notification=411e4490-6bf0-4c0e-b54d-73d65b53ff79">"<span class="not-job-title">dev need to immigration in aus</span>"</a></h2>
                                                                                                        <p class="not-meta">10 August, 2020   07:54 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="f36f6eb4-0cd4-488b-817c-f5ce2ffb7aed">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>Your case <a href="https://thelawapp.com.au/case/case_devclient_5f31192eac01f?source_notification=f36f6eb4-0cd4-488b-817c-f5ce2ffb7aed">"<span class="not-job-title">dev need to immigration in aus</span>"</a>is in review.</h2>
                                                    <p class="not-meta">10 August, 2020   19:53 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="0f4b0844-5102-43d8-b67a-38116aecca83">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/devslawyeers?source_notification=0f4b0844-5102-43d8-b67a-38116aecca83">
                                                                                                                        <span class="not-job-title">devs l.</span>
                                                        </a>
                                                        hired successfully for 
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f310fea5df48?source_notification=0f4b0844-5102-43d8-b67a-38116aecca83">
                                                            
                                                            "<span class="not-job-title"> dev case for child custody </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   19:46 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="3a4e74f4-38be-4f39-a345-8565bcfff5ed">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/devslawyeers">
                                                                                                                        <span class="not-job-title">devs l.</span>
                                                        </a>
                                                        <a href="https://thelawapp.com.au/proposal/proposal_devslawyeers_5f311589d49f1?source_notification=3a4e74f4-38be-4f39-a345-8565bcfff5ed">
                                                            <span class="not-job-title">bid</span>
                                                        </a> 
                                                        on
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f310fea5df48?source_notification=3a4e74f4-38be-4f39-a345-8565bcfff5ed">
                                                            "<span class="not-job-title"> dev case for child custody </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   19:38 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="51eede65-721c-4e18-8abb-9afc4833a343">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>Admin approved your case<a href="https://thelawapp.com.au/case/case_devclient_5f310fea5df48?source_notification=51eede65-721c-4e18-8abb-9afc4833a343">"<span class="not-job-title">dev case for child custody</span>"</a></h2>
                                                                                                        <p class="not-meta">10 August, 2020   07:15 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="c96f1f95-f005-464d-81a6-8b70fa75bfcb">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>Your case <a href="https://thelawapp.com.au/case/case_devclient_5f310fea5df48?source_notification=c96f1f95-f005-464d-81a6-8b70fa75bfcb">"<span class="not-job-title">dev case for child custody</span>"</a>is in review.</h2>
                                                    <p class="not-meta">10 August, 2020   19:14 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="46f76dfb-4ea0-4341-99c4-113bfdfec280">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/devslawyeers?source_notification=46f76dfb-4ea0-4341-99c4-113bfdfec280">
                                                                                                                        <span class="not-job-title">devs l.</span>
                                                        </a>
                                                        hired successfully for 
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f2fc78988d73?source_notification=46f76dfb-4ea0-4341-99c4-113bfdfec280">
                                                            
                                                            "<span class="not-job-title"> dev test for vehicle accident </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   16:19 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" name="check" data-notification-source="5365c68b-a4dc-4593-adc5-2ac475c63af9">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="https://thelawapp.com.au/devslawyeers?source_notification=5365c68b-a4dc-4593-adc5-2ac475c63af9">
                                                                                                                        <span class="not-job-title">devs l.</span>
                                                        </a>
                                                        hired successfully for 
                                                        <a href="https://thelawapp.com.au/case/case_devclient_5f2fc78988d73?source_notification=5365c68b-a4dc-4593-adc5-2ac475c63af9">
                                                            
                                                            "<span class="not-job-title"> dev test for vehicle accident </span>"
                                                        </a>
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   16:01 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                
                                                                                                                
                                    
                                                                            <div class="dashboard-menu-content pagination-area">
                                            <ul class="pagination" role="navigation">
        
                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                <span class="page-link" aria-hidden="true">‹</span>
            </li>
        
        
                    
            
            
                                                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                                <li class="page-item"><a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=2">2</a></li>
                                                                                <li class="page-item"><a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=3">3</a></li>
                                                                                <li class="page-item"><a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=4">4</a></li>
                                                                                <li class="page-item"><a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=5">5</a></li>
                                                                                <li class="page-item"><a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=6">6</a></li>
                                                        
        
                    <li class="page-item">
                <a class="page-link" href="https://thelawapp.com.au/dashboard/notifications?page=2" rel="next" aria-label="Next »">›</a>
            </li>
            </ul>

                                        </div>
                                                                    </div>
                            </div>
                        </div>            
                        <!-- =========================
                        DASHBOARD CONTENT SECTION END
                        ============================== -->  
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection