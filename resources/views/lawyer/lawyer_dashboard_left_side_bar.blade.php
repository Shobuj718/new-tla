<div class="col-lg-4 col-md-4 col-sm-12 d-none d-md-block dashboard-tab">
    <div class="user-info dashboard-tablist" style="border-top: 5px solid #00c3c0;">
        <a href="#" style="display:block;clear:both;height: 67px;">
            <img src="https://thelawapp.com.au/assets/img/user.png" alt="User Photo">
            <div style="display:flex; margin-left:90px;margin-top: 20px;font-size: 17px;line-height: 24px;">Welcome back, <br> devs</div>
        </a>
        <a href="{{ route('lawyer.edit.profile', $user->uid)  }}" style="font-size:13px; margin-top:20px; margin-left:auto; margin-right:auto;display:block;clear:both; color:#00c3c0;">Edit Profile</a>
    </div>
    <div class="dashboard-menu dashboard-tablist">
        <h2>Dashboard</h2>
        <ul>
            <li class="active"><a href="https://thelawapp.com.au/dashboard/notifications"><i class="fa fa-bell-o"></i> Notifications</a></li>
            <li><a href="{{ route('lawyer.get.case', $user->uid) }}"><i class="fa fa-briefcase"></i> Available Cases</a></li>
            <li><a href="{{ route('lawyer.new.case', $user->uid) }}"><i class="fa fa-briefcase"></i> New Milestone</a></li>
            <li><a href="{{ route('lawyer.payment', $user->uid) }}"><i class="fa fa-credit-card"></i> Payments</a></li>
            <li><a href="{{ route('lawyer.conversations', $user->uid) }}"><i class="fa fa-envelope-o"></i> Conversations <span id="topbar_messages_count">1</span> </a></li>
            
            
        </ul>
    </div>
    <div class="status-menu dashboard-tablist">
        <h2>Status</h2>
            <ul class="list-info-company">
                
                <li>Rating <span>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i>  <i class="fa fa-star"></i> </span> </li>
                <li class="active"> <a href="{{ route('lawyer.approved.case', $user->uid) }}">Approved Cases <span class="info"></span></a></li>
                <li> <a href="{{ route('lawyer.pending.case', $user->uid) }}">Pending Cases <span class="info"></span></a></li>
                <li> <a href="{{ route('lawyer.active.case', $user->uid) }}">Active Cases <span class="info">0</span></a></li>
                <li> <a href="{{ route('lawyer.complete.case', $user->uid) }}">Complete Cases <span>0</span></a></li>
                <li>Reviews Received <span>0</span></li>
                <li>Reviews Given <span>0</span></li>
                <!--<li>Success Rate <span>10%</span></li>-->
            </ul>
        <div class="account-menu dashboard-tablist">
            <h2>Account Status</h2>
            <ul>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Email Verified <i class="fa fa-check"></i></a></li>
                <li><a href="#"><i class="fa fa-phone"></i> Phone Verified <i class="fa fa-check"></i></a></li>
            </ul>
        </div>
    </div>
</div>