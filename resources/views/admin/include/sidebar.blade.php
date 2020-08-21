<div class="left-sidebar">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!--HOME-->
                                <li class="{{(Route::currentRouteName()=='admin')?'open-item':''}}"><a href="{{ route('admin') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                                <!--UI ELEMENTENTS-->
                                <li class="has-child-item close-item {{ (request()->is('admin/users*')) ? 'open-item' : 'close-item' }}">
                                    <a><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li class="{{(Route::currentRouteName()=='users.view')?'active-item':''}}"><a href="{{ route('users.view') }}" ><i class="fa fa-list" aria-hidden="true"></i> Users List</a></li>
                                        <li class="{{(Route::currentRouteName()=='users.UserApproveList')?'active-item':''}}"><a href="{{ route('users.UserApproveList') }}" ><i class="fa fa-list" aria-hidden="true"></i> User Approved List</a></li>
                                        <li class="{{(Route::currentRouteName()=='users.UserPendingList')?'active-item':''}}"><a href="{{ route('users.UserPendingList') }}" ><i class="fa fa-list" aria-hidden="true"></i> User Pending List</a></li>
                                        <li class="{{(Route::currentRouteName()=='users.UserSuspendList')?'active-item':''}}"><a href="{{ route('users.UserSuspendList') }}" ><i class="fa fa-list" aria-hidden="true"></i> User Suspend List</a></li>
                                    </ul>
                                </li>
                                 <li class="has-child-item close-item {{ (request()->is('admin/package*')) ? 'open-item' : 'close-item' }}">
                                    <a><i class="fa fa-users" aria-hidden="true"></i><span>Master Setup</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li class="{{(Route::currentRouteName()=='package.list')?'active-item':''}}"><a href="{{ route('package.list') }}" ><i class="fa fa-list" aria-hidden="true"></i> Packages List</a></li>                                    </ul>
                                </li>
                                
                                  <li class="has-child-item close-item {{ (request()->is('admin/category*')) ? 'open-item' : 'close-item' }}">
                                    <a><i class="fa fa-users" aria-hidden="true"></i><span>Category</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li class="{{(Route::currentRouteName()=='category.list')?'active-item':''}}"><a href="{{ route('category.list') }}" ><i class="fa fa-list" aria-hidden="true"></i> Category List</a></li>
                                    </ul>
                                </li>
                                  <li class="has-child-item close-item {{ (request()->is('admin/case*')) ? 'open-item' : 'close-item' }}">
                                    <a><i class="fa fa-users" aria-hidden="true"></i><span>Casses</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li class="{{(Route::currentRouteName()=='case.list')?'active-item':''}}"><a href="{{ route('case.list') }}" ><i class="fa fa-list" aria-hidden="true"></i> Case List</a></li>
                                        <li class="{{(Route::currentRouteName()=='casse.caseApproveList')?'active-item':''}}"><a href="{{ route('casse.caseApproveList') }}" ><i class="fa fa-list" aria-hidden="true"></i> Case Approve List</a></li>
                                        <li class="{{(Route::currentRouteName()=='casse.casePendingList')?'active-item':''}}"><a href="{{ route('casse.casePendingList') }}" ><i class="fa fa-list" aria-hidden="true"></i> Case Pending List</a></li>
                                        <li class="{{(Route::currentRouteName()=='casse.CaseSuspendList')?'active-item':''}}"><a href="{{ route('casse.CaseSuspendList') }}" ><i class="fa fa-list" aria-hidden="true"></i> Case Suspend List</a></li>

                                    </ul>
                                </li>
                                
                                <li><a target="_blank" href="http://myiideveloper.com/helsinki/last-version/documentation/index.html"><i class="fa fa-book" aria-hidden="true"></i><span>Online Documentation</span></a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
