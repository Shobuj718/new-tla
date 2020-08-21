@extends('master')

@section('content')


<div class="single_project breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left wow fadeInLeft">
                    <div class="breadcrumb_title">Conversation</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="conversation-area">
        <div class="container">
            <div class="row">
                <div class="col-4 chat_left pl-0 pr-0">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="chat_search_form">
                            <form action="#">
                                <div class="form-group search_chat">
                                    <label for="search-input"><i class="fa fa-search" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" id="search-input" placeholder="Search">
                                </div>
                                <div class="form-group search_chat">
                                    <select class="form-control" id="select_chat">
                                        <option>All Recent</option>
                                        <option>All Old</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        
                        <a class="nav-link active show" id="devslawyeers-5f311687a4b7f" data-toggle="pill" href="#devslawyeers-5f311687a4b7f-tab" role="tab" aria-controls="devslawyeers-5f311687a4b7f-tab" aria-selected="true">
                                <div class="user_img">
                                    <img src="https://thelawapp.com.au/assets/img/user.png" alt="User Image">
                                </div>
                                <div class="user_desc">
                                    <span class="u_name">devs c.<i class="fa fa-caret-right"></i></span>
                                    <span class="u_dsc">dev case for child custody</span>
                                </div>
                            </a>
                         
                    </div>
                </div>
                <div class="col-8 chat_right pl-0 pr-0">
                    <div class="tab-content" id="v-pills-tabContent"> 
                        <div class="tab-pane fade active show" id="devslawyeers-5f311687a4b7f-tab" role="tabpanel" aria-labelledby="devslawyeers-5f311687a4b7f">
                                <div class="chat_head_title row no-gutters">
                                    <div class="col-lg-9">
                                        dev case for child custody                                    </div>
                                    <div class="col-lg-3 text-right">
                                        Price : $ 10                                    </div>
                                </div> 
                                
                                <div class="chat_head row no-gutters">
                                    <div class="col-lg-6">
                                        <div class="lawyer_info">
                                            <h5>devs c.</h5>
                                            <!--<span class="u_dsc">dev case for child custody</span>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="lawyer_info text-right">
                                            Bid Amt. : $ 8.8                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        
                                           
                                        <div class="chat_top_btn">
                                             
                                            
                                            
                                            
                                                                                        <!-- Button trigger modal -->
                                            <a class="boxed_btn" data-toggle="modal" data-target="#feedbackModaldevslawyeers-5f311687a4b7f" href="#">
                                              Feedback
                                            </a> 
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="feedbackModaldevslawyeers-5f311687a4b7f" tabindex="-1" role="dialog" aria-labelledby="feedbackModalTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitledevslawyeers-5f311687a4b7f">Feedback for <a target="_blank" href="https://thelawapp.com.au/case/case_devclient_5f310fea5df48">"dev case for child custody"</a></h5>                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            <input type="hidden" value="devslawyeers-5f311687a4b7f" class="interview_slug">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                
                                                        <div class="form-group" style="text-align">
                                                            <label>Rate devs c.</label>
                                                            <div class="rating-container rating-sm rating-animate"><div class="rating-stars"><span class="empty-stars"><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span><span class="star"><span class="fa fa-star"></span></span></span><span class="filled-stars" style="width: 0%;"><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span><span class="star"><span class="fa fa-star checked"></span></span></span><input name="star_rating" value="0" class="star_rating rating rating-input" data-show-clear="false" data-step="1" data-size="sm" data-show-caption="false" data-empty-star="<span class=&quot;fa fa-star&quot;></span>" data-filled-star="<span class=&quot;fa fa-star checked&quot;></span>"></div></div>    
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group">
                                                            <textarea class="form-control comment" name="comment" rows="6" placeholder="Write something about devs clients"></textarea>
                                                        </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button id="saveReview" type="button" class="boxed_btn">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                                        <a href="{{ route('lawyer.create.proposal', $user->uid) }}" class="boxed_btn">View Proposal</a>                                        
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="chat_body">
                                    <input type="hidden" class="opentok_session" value="1_MX40NTgzNjIzMn5-MTU5NzA1MjU1MTYzNH43azZlaEpTMkFKbFo1alRHN29wK29yVXZ-UH4">
                                    <input type="hidden" class="opentok_caller_name" value="devs clients">
                                    <div class="messagesHolder"><div class="row ml-0 mr-0 receiver">    <div class="col-lg-1 pr-0">      <div class="chat_img">          <img src="https://thelawapp.com.au/assets/img/user.png" alt="User Image">      </div>  </div>  <div class="col-lg-11 pr-0">      <div class="chat_content shadow-sm">          <div class="ch_date">August 10, 2020<i class="fa fa-caret-right"></i><span>07:42 PM</span></div>              <p>Hello devs lawyeers, <br> Let's talk about <a href="case_devclient_5f310fea5df48">dev case for child custody</a>              </p>          </div>      </div></div></div>
                                </div>
                            </div>
                    </div>



                    <div class="chat-messege">
                        <div class="messege_head">
                            <a href="#" class="msg_btn active"><i class="fa fa-envelope-o"></i>Send message</a>
                            <a href="#" id="makeVideoCall" class="msg_btn" data-toggle="modal" data-target="#opentokCallerModal"><i class="fa fa-video-camera"></i>Video call</a>
                            <a href="#" id="makeVoiceCall" class="msg_btn" data-toggle="modal" data-target="#opentokCallerModal"><i class="fa fa-phone"></i>Voice call</a>
                        </div>
                        <div class="messege_area">
                            <form id="messageForm" action="" enctype="multipart/form-data">
                                <div class="form-group chating">
                                    <textarea name="message_body" class="form-control" id="messege_content" rows="3"></textarea>
                                    <div class="textarea_btn" style="right:15px">
                                        <button class="imoji"><i class="fa fa-smile-o"></i></button>
                                        <button type="button" class="attachfile" id="attachFile" onclick="document.getElementById('attach_file_m').click();"><i class="fa fa-paperclip"></i>Attach Files</button>
                                        <input type="file" style="display:none;" id="attach_file_m" name="attachment">
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button id="sendMessage" type="submit" class="boxed_btn">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')


@endsection