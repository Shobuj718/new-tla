<nav id="menu" class="mobile-menu inner-m mm-menu mm-menu_offcanvas" aria-hidden="true">
    <div class="mm-panels"><div id="mm-1" class="mm-panel mm-panel_has-navbar mm-panel_opened">
        <div class="mm-navbar"><a class="mm-navbar__title">Menu</a></div>
            <ul class="mm-listview">
                <li class="mm-listitem"><a href="https://demo.thelawapp.com.au/dashboard/cases"> <i class="fa fa-tachometer"></i> Dashboard</a></li>
                <li class="mm-listitem"><a href="https://demo.thelawapp.com.au/messages"><i class="fa fa-envelope-o"></i>Messages<span>0</span></a></li>
                <li class="mm-listitem"><a href="https://demo.thelawapp.com.au/dashboard/notifications"><i class="fa fa-bell-o"></i>Notifications<span>0</span></a></li>
                <li class="mm-listitem">
                    <a class="mm-btn_next" href="#mm-2"><span class="mm-sronly">Open submenu (
                        Arif Kl
                    )</span></a>
                    <a href="#"><img id="profile_image" src="https://demo.thelawapp.com.au/avatars/free-profile-photo-whatsapp-41971442604.png" alt="User Photo">
                        Arif Kl<i class="fa fa-caret-down"></i>
                    </a>
               </li>
            </ul>
        </div>
        <div id="mm-2" class="mm-panel mm-hidden mm-panel_has-navbar" aria-hidden="true">
            <div class="mm-navbar"><a class="mm-btn mm-btn_prev mm-navbar__btn" href="#mm-1" aria-owns="mm-1" aria-haspopup="true"><span class="mm-sronly">Close submenu</span></a><a class="mm-navbar__title" href="#mm-1">
                Arif Kl
                </a>
            </div>
        </div>
    </div>
                        
</nav>
                    

    <div id="mm-0" class="mm-page mm-slideout">
        <div id="preloader" style="display: none;">
            <div id="status" style="display: none;">&nbsp;</div>
        </div>
        <div id="sticky-wrapper" class="sticky-wrapper" style="height: 71px;"><div class="home2 inner_header main_header" style="">
            <div class="header-area">
                    <div class="container">
                        <div class="row">
                    <div class="col-lg-2 col-sm-2 text-left">
                        <div class="site-logo wow fadeIn">
                            <a href="https://demo.thelawapp.com.au"><img src="https://demo.thelawapp.com.au/assets/img/logo-black.png" alt="Site Logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-10 text-right">
                        <div class="main-menu big-menu wow fadeIn">
                                <ul>
                                    <li class="has_submenu text-left">
                                        <a href="#"><i class="fa fa-search"></i> Get Started <i class="fa fa-caret-down"></i></a>
                                        <ul class="submenu shadow-sm" id="search-dropdown">
                                            <li><a href="{{ route(Auth::user()->type.'.find.lawyer', $user->uid) }}"> <i class="fa fa-user" aria-hidden="true"></i> FIND A LAWYER</a></li>
                                            <li><a href="{{ route(Auth::user()->type.'.search.cases', $user->uid) }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> SEARCH CASES</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route(Auth::user()->type.'.case.create', $user->uid) }}"> <i class="fa fa-plus-circle"></i> Create Case</a></li>
                                    <li><a href="{{ route(Auth::user()->type.'.get.case', $user->uid) }}"> <i class="fa fa-tachometer"></i> Dashboard</a></li>
                                    <li class="has_submenu">
                                        <a href="{{ route(Auth::user()->type.'.conversations', $user->uid) }}">
                                            <i class="fa fa-envelope-o"></i>
                                            <span id="topbar_messages_count">0</span>
                                        </a>
                                        <ul class="submenu shadow-sm" id="topbar_messages"></ul>
                                    </li>
                                    
                                    <li class="has_submenu">
                                        <a href="{{ route(Auth::user()->type.'.notifications', $user->uid) }}">
                                            <i class="fa fa-bell-o"></i>
                                            <span id="topbar_notifications_count">6</span>
                                        </a>
                                    </li>
                                    
                                    <li class="has_submenu">
                                        <a href="#" class="header-profile-button"><img id="profile_image" src="https://thelawapp.com.au/avatars/free-profile-photo-whatsapp-41971442604.png" alt="User Photo">Dev {{ Auth::user()->type }}<i class="fa fa-caret-down"></i></a>
                                        <ul class="submenu shadow-sm">
                                                    
                                            <li>
                                                <a href="{{ url('/') }}"><i class="fa fa-user"></i>User Profile</a>
                                            </li> 
                                            <li>
                                                <a href="{{ route(Auth::user()->type.'.edit.profile', $user->uid)  }}"><i class="fa fa-pencil-square-o"></i>Edit Profile</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-question"></i>Help</a></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                    {{ __('Logout') }}
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                           </li>
                                        </ul>
                                    </li>
                                </ul>
                               

                        
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
            <div class="mobile_menu inner-menu">
                <a href="#menu"><span></span></a>
            </div>
            </div>
        </div>
    </div>