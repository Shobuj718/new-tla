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

                    @include('lawyer.dashboard.lawyer_dashboard_left_side_bar')                   
                    <div class="col-lg-8 col-md-8 col-sm-12 dashboard-contentarea" style="border-top: 5px solid #00c3c0;">
                        
                        <div class="search-dashboard">
                            <div class="row align-items-center">
                                <div class="col-md-12 col-sm-12 form-group case-search">
                                    <input style="float: right;" type="search" class="form-control" name="search" id="search" placeholder="Search Cases">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                                <!--<div class="col-md-6 col-sm-12 case-profile-link">
                                    <a class="btn boxed_btn" href="https://thelawapp.com.au/edit-profile">Edit Profile</a>
                                </div>-->
                            </div>
                            <div id="searchListBox">
                                <ul class="search_list" id="caseList" style="display: none;">
                                    
                                </ul>
                            </div>
                        </div>
                        
                        
                        <div class="dashboard-menu-content dashboard-content-title notification-list">
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
                                                            <button type="button" id="deleteNotifications" class="btn btn-outline-light">Delete</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-dashboard">
                                                                                                                    
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" class="notification-checkbox" data-notification-source="5099d9a3-f438-4842-9aa4-7a3bcdc84675">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="url($notification[" data"]["interview"]["client"]["username"])"="">
                                                                                                                        <span class="not-job-title">
                                                                <!--changed here-->
                                                                
                                                                
                                                            </span>
                                                        </a>
                                                        accepted your proposal on 
                                                        
                                                                                                                
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   19:46 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" class="notification-checkbox" data-notification-source="6140a79b-f4d4-4bb8-ad67-4034acb554ca">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="url($notification[" data"]["interview"]["client"]["username"])"="">
                                                                                                                        <span class="not-job-title">
                                                                <!--changed here-->
                                                                
                                                                
                                                            </span>
                                                        </a>
                                                        accepted your proposal on 
                                                        
                                                                                                                
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   16:19 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                
                                                                                
                                                                                                                                                            
                                                                                
                                                                                    <div class="notification-item" data-read="false">
                                                <div class="not-select">
                                                    <form action="">
                                                        <label class="checkbox-container">
                                                        <input type="checkbox" class="notification-checkbox" data-notification-source="97c1b626-c48c-4603-b1de-da73bd964723">
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <div class="not-title">
                                                    <h2>
                                                        <a href="url($notification[" data"]["interview"]["client"]["username"])"="">
                                                                                                                        <span class="not-job-title">
                                                                <!--changed here-->
                                                                
                                                                
                                                            </span>
                                                        </a>
                                                        accepted your proposal on 
                                                        
                                                                                                                
                                                    </h2>
                                                    <p class="not-meta">10 August, 2020   16:01 pm</p>
                                                </div>
                                            </div>
                                                                                
                                                                                
                                                                                                                <div class="not-action">
                                        <a class="btn boxed_btn" href="#">View All</a>
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