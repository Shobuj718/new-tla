
@extends('master')

@section('content')

 <div class=" breadcrumb-row">
    <div class="container">
        <div class="tla-breadcrumbs">Dashbord / Cases</div>
    </div>
</div>
    
<section class="client-edit-profile">
    <div class="container">
        <div class="client-edit-profile-row ptb15">
            <div class="client-edit-profile-first-column">
                <div class="client-edit-profile-first-column-inner">
                    <div class="whitebg mb15 ptb25 plr25 client-dashbord-profile-box">
                        <div class="client-dashbord-profile-box-upper">
                            <div class="client-dashbord-profile-box-upper-image">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQdwbqQHkf9g_PlvKPp4oGbhfQl1-D8DHizIw&usqp=CAU" alt="Client Image">
                            </div>
                            <div class="Verified-as-a-Lawyer">
                                <img src="https://demo.thelawapp.com.au/assets/img/Verified.png" alt="Verified">
                                <span>Verified as a Lawyer</span>
                            </div>
                        </div>
                        <div class="client-dashbord-profile-box-middle">
                            <h3>Casey Arrington</h3>
                            <div class="rating-star-area">
                                <div class="star-icons">
                                   <img src="https://demo.thelawapp.com.au/assets/img/star.png" alt="star">
                                   <img src="https://demo.thelawapp.com.au/assets/img/star.png" alt="star">
                                   <img src="https://demo.thelawapp.com.au/assets/img/star.png" alt="star">
                                   <img src="https://demo.thelawapp.com.au/assets/img/star.png" alt="star">
                                   <img src="https://demo.thelawapp.com.au/assets/img/star.png" alt="star">
                                </div>
                                <span>5/5</span>
                                <span>(10)</span>
                            </div>
                        </div>
                        <div class="client-dashbord-profile-box-bottom">
                            <a href="#" class="lawyer-view-profile">View Profile</a>
                            <a href="#">Edit Profile</a>
                        </div>
                    </div>
                    <div class="client-edit-profile-first-column-bottom-box mb15 whitebg ptb10 plr25">
                        <div class="user_function-dashbord">
                            <ul>
                                <li><a href="#"><img src="https://demo.thelawapp.com.au/assets/img/bell.png" alt="icon">Notifications</a></li>
                                <li><a href="#"><img src="https://demo.thelawapp.com.au/assets/img/portfolio.png" alt="icon">Available Cases</a></li>                                          
                                <li><a href="#"><img src="https://demo.thelawapp.com.au/assets/img/flag.png" alt="icon">New Milestone</a></li>
                                <li><a href="#"><img src="https://demo.thelawapp.com.au/assets/img/pay.png" alt="icon">Payments</a></li>
                                <li><a href="#"><img src="https://demo.thelawapp.com.au/assets/img/mail.png" alt="icon">Conversations</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="client-edit-profile-second-column-bottom-box mb15 whitebg ptb10 plr25">
                        <div class="user_function-dashbord user_function-bottom">
                            <h3>Account Status</h3>
                            <ul>
                                <li><a href="#"><div><img src="https://demo.thelawapp.com.au/assets/img/mail-p.png" alt="icon">Email Verified</div> <span><img src="https://demo.thelawapp.com.au/assets/img/verifiedd.png" alt="icon"></span></a></li>
                                <li><a href="#"><div><img src="https://demo.thelawapp.com.au/assets/img/Icon-phone.png" alt="icon">Phone Verified</div> <span><img src="https://demo.thelawapp.com.au/assets/img/verifiedd.png" alt="icon"></span></a></li>                                          
                                <li><a href="#"><div><img src="https://demo.thelawapp.com.au/assets/img/pay-p.png" alt="icon">Payment Verified</div> <span><img src="https://demo.thelawapp.com.au/assets/img/verifiedd.png" alt="icon"></span></a></li>
                                <li><a href="#"><div><img src="https://demo.thelawapp.com.au/assets/img/experience.png" alt="icon">Certificate Verified</div> <span><img src="https://demo.thelawapp.com.au/assets/img/verifiedd.png" alt="icon"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-case-middle-column plr15 width75">
                <div class="client-edit-profile-middle-column-inner">
                    <div class="case-items-area border_1p whitebg">
                        <div class="case-items-header ptb15 plr25">
                            <div class="case-items-header-title">
                                <h1>Cases</h1>
                            </div>
                            <div class="case-items-header-right">
                                <div class="case-items-header-right-skrills">
                                    <select name="skrills" id="skrills">
                                      <option>Select required skills</option>
                                      <option>Family Law</option>
                                      <option>Family Law</option>
                                      <option>Family Law</option>
                                    </select>
                                </div>
                                <div class="case-items-header-right-location">
                                    <input type="text" placeholder="Enter a location">
                                    <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="case-items-container">
                            @foreach($cases as $case)
                                <div class="case-items ptb15 plr25">
                                <div class="case-items-left">
                                    <div class="case-items-title">
                                        <a href="{{ route('client.case.show', $case->slug) }}">{{ $case->title ?? '' }}</a>
                                    </div>
                                    <div class="case-items-time"> 
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <p>Posted <span>{{\Carbon\Carbon::parse($case->created_at)->diffForHumans()}}</span></p>
                                    </div>
                                    <div class="case-items-content"> 
                                        <p>{!! $case->short_description ?? '' !!}</p>
                                    </div>
                                    <div class="case-items-footer">
                                        <div class="case-items-footer-location">
                                            Location: <span>{{ $cases->location_name ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="case-items-right">
                                    <div class="case-items-right-budget">
                                        <p>Budget:</p>
                                        <span>${{ $case->budget ?? '' }}</span>
                                    </div>
                                    <div class="case-items-right-bid">
                                        Bid: <span>{{ $case->bids->count() ?? '' }}</span>
                                    </div>
                                    <div class="case-items-right-report">
                                       <a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Report</a>
                                    </div>
                                    <div class="case-items-right-button">
                                        <button>Bid Now</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    @if($cases->hasMorePages())
                        <div class="case-items-navigation">
                            <div class="case-items-navigation-inner">
                                <!--<a href="#" class="nav-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="nav-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>-->
                                {{$cases->links()}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    @endsection

@section('scripts')

<script src="{{asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('backend/vendor/jquery/validate.min.js')}}"></script>

<script type="text/javascript">
 
 // Wait for the DOM to be ready

    $(function() {
      $("form[name='clientProfile']").validate({
        rules: {
          first_name: "required",
          last_name: "required",
          location: "required",
          post_code: "required",
          about: "required",
          email: "required",
        },
        messages: {
          first_name: "Please enter your firstname",
          last_name: "Please enter your firstname",
          location: "Please enter your firstname",
          post_code: "Please enter your firstname",
          about: "Please enter your firstname",
          email: "Please enter description"
        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#clientProfile')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('client.update.profile','uId')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    
     $(function() {
      $("form[name='user_phone_code']").validate({
        rules: {
          phone_number: "required",
          country_code: "required",
        },
        messages: {
          phone_number: "Please enter your phone_number",
          country_code: "Please enter your country_code",

        },
        submitHandler: function(form) {
          //form.submit();
          
                console.log('Called');
                var form = $('#user_phone_code')[0];       
                var bodyFormData = new FormData(form);    
                
                axios({
                    method: 'post',
                    url: "{{route('client.send.varification.code','uId')}}",
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (response) {
                    console.log(response);
                });
                
 
        }
      });
    });
    

</script>

    
  


@endsection