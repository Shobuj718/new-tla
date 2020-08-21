window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    auth: {
        headers: {
            Authorization: 'Bearer ' + '62fd9c51ba0b2d7f664a3f75e93fba77',
        },
    },
    transports: ['websocket']
});

Echo.private('App.User.'+user_id)
    .notification((notification) => {
        $.get( "/user/notification-count", function( data ) {
            let notificationText = '<li>';
            
            switch(notification.type){
                
                
                case "App\\Notifications\\AdminApprovedProfile":
                    notificationText += 'Admin approved your ';
                    notificationText += '<a href="'+window.location.origin+'/'+auth_username+'&source_notification='+notification.id+'">profile</a>';
                    break;
                    
                case "App\\Notifications\\ProfileInReview":
                    notificationText += 'Your ';
                    notificationText += '<a href="'+window.location.origin+'/'+auth_username+'&source_notification='+notification.id+'">profile</a>';
                    notificationText += ' is in review';
                    break;
                
                // Notifications for client
                
                case "App\\Notifications\\LawyerCreatedProposal":
                    notificationText += '<a href="'+window.location.origin+'/'+notification.proposal.lawyer.username+'">'+notification.proposal.lawyer.first_name+" "+notification.proposal.lawyer.last_name.split("")[0]+'.</a>';
                    notificationText += ' has ';
                    notificationText += '<a href="'+window.location.origin+'/proposal/'+notification.proposal.slug+'&source_notification='+notification.id+'">bid</a>';
                    notificationText += ' on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.proposal.project.slug+'&source_notification='+notification.id+'">'+notification.proposal.project.title+'</a>';
                    break;
                    
                case "App\\Notifications\\LawyerUpdatedProposal":
                    notificationText += '<a href="'+window.location.origin+'/'+notification.proposal.lawyer.username+'">'+notification.proposal.lawyer.first_name+" "+notification.proposal.lawyer.last_name.split("")[0]+'.</a>';
                    notificationText += ' has updated his ';
                    notificationText += '<a href="'+window.location.origin+'/proposal/'+notification.proposal.slug+'&source_notification='+notification.id+'">bid</a>';
                    notificationText += ' on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.proposal.project.slug+'&source_notification='+notification.id+'">'+notification.proposal.project.title+'</a>';
                    break;
                    
                case "App\\Notifications\\LawyerHiredSuccessfully":
                    notificationText += 'You hired ';
                    notificationText += '<a href="'+window.location.origin+'/'+notification.proposal.lawyer.username+'">'+notification.proposal.lawyer.first_name+" "+notification.proposal.lawyer.last_name.split("")[0]+'.</a>';
                    notificationText += ' successfully on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.proposal.project.slug+'&source_notification='+notification.id+'">'+notification.proposal.project.title+'</a>';
                    break;
                
                case "App\\Notifications\\AdminApprovedProject":
                    notificationText += 'Admin approved your case ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.project.slug+'&source_notification='+notification.id+'">'+notification.project.title+'</a>';
                    break;   
                    
                case "App\\Notifications\\CaseInReview":
                    notificationText += 'Your case ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.project.slug+'&source_notification='+notification.id+'">'+notification.project.title+'</a>';
                    notificationText += ' is in review';
                    break; 
                    
                // Notification for lawyer
                
                case "App\\Notifications\\ClientAcceptedProposal":
                    notificationText += '<a href="'+window.location.origin+'/'+notification.interview.client.username+'">'+notification.interview.client.first_name+" "+notification.interview.client.last_name.split("")[0]+'.</a>';
                    notificationText += ' accepted your ';
                    notificationText += '<a href="'+window.location.origin+'/proposal/'+notification.proposal.slug+'&source_notification='+notification.id+'">bid</a>';
                    notificationText += ' on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.proposal.project.slug+'&source_notification='+notification.id+'">'+notification.proposal.project.title+'</a>';
                    break;
                    
                case "App\\Notifications\\ClientRejectedProposal":
                    // notificationText += '<a href="'+window.location.origin+'/'+notification.proposal.project.client.username+'">'+notification.proposal.project.client.first_name+" "+notification.proposal.project.client.last_name+'</a>';
                    notificationText += 'Your ';
                    notificationText += '<a href="'+window.location.origin+'/proposal/'+notification.proposal.slug+'&source_notification='+notification.id+'">bid</a>';
                    notificationText += ' has been rejected on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.proposal.project.slug+'&source_notification='+notification.id+'">'+notification.proposal.project.title+'</a>';
                    console.log(notificationText);
                    break;
                    
                case "App\\Notifications\\CalledForInterview":
                    notificationText += '<a href="'+window.location.origin+'/'+notification.interview.client.username+'">'+notification.interview.client.first_name+" "+notification.interview.client.last_name.split("")[0]+'.</a>';
                    notificationText += ' invited you for an ';
                    notificationText += '<a href="'+window.location.origin+'/messages?interview=/'+notification.interview.slug+'&source_notification='+notification.id+'">interview</a>';
                    notificationText += ' on ';
                    notificationText += '<a href="'+window.location.origin+'/case/'+notification.interview.project.slug+'&source_notification='+notification.id+'">'+notification.interview.project.title+'</a>';
                    break;
                
                default:
                    break;
            }
            
            notificationText += '</li>';
            
            $('#topbar_notifications').append(notificationText);
            $('#topbar_notifications_count').html(data.notification_count);
        });
    });


function updateMessagesHolder(selectedTabId, message){
    
    
    console.log('updateMessagesHolder');
    
    let senderClass = "receiver";
    

    if(user_id == message.sender_id){
        senderClass = "sender"
    }

    if(!message.avatar){
        message.avatar = window.location.origin+'/assets/img/user.png';
    } else {
        message.avatar = window.location.origin+'/'+message.avatar;
    }

    let messageText =   '<div class="row ml-0 mr-0 '+senderClass+'">';
    let messageTextAvatar =      '    <div class="col-lg-1 pr-0">';
    messageTextAvatar +=      '      <div class="chat_img">';
    messageTextAvatar +=      '          <img src="'+message.avatar+'" alt="User Image">';
    messageTextAvatar +=      '      </div>';
    messageTextAvatar +=      '  </div>';
    let messageTextBody =      '  <div class="col-lg-11 pr-0">';
    messageTextBody +=      '      <div class="chat_content shadow-sm">';
    messageTextBody +=      '          <div class="ch_date">'+message.create_date+'<i class="fa fa-caret-right"></i><span>'+message.create_time+'</span></div>';

    if(message.body){
        messageTextBody +=      '              <p>';
        messageTextBody +=                         message.body;
        messageTextBody +=      '              </p>';
    }

    if(message.attachment){
        if (message.attachment.endsWith('.png') || message.attachment.endsWith('.jpg') || message.attachment.endsWith('.jpeg') || message.attachment.endsWith('.bmp')) {
            messageTextBody += '<a target="_blank" href="' + window.location.origin + '/' + message.attachment + '"><img class="message-attachment" src="' + window.location.origin + '/' + message.attachment + '" alt="message attachment"></a>'
        }
        if (message.attachment.endsWith('.pdf')) {
            messageTextBody += '<a target="_blank" href="' + window.location.origin + '/' + message.attachment + '"><img class="message-attachment" src="' + window.location.origin + '/assets/img/pdf-icon.png' + '" alt="message-attachment"></a>';
        }
    }
    messageTextBody +=      '          </div>';
    messageTextBody +=      '      </div>';

    if(user_id == message.sender_id){
        messageText += messageTextBody;
        messageText += messageTextAvatar;
    }

    if(user_id == message.recipient_id){
        messageText += messageTextAvatar;
        messageText += messageTextBody;
    }

    messageText +=      '</div>';

    $('#'+selectedTabId+'-tab .messagesHolder').append(messageText);
}

function updateNewMessagesHolder(selectedTabId, message){
    
    
    console.log('updateMessagesHolder');
    
    let senderClass = "receiver";
    

    if(user_id == message.sender_id){
        senderClass = "sender"
    }

    if(!message.avatar){
        message.avatar = window.location.origin+'/assets/img/user.png';
    } else {
        message.avatar = window.location.origin+'/'+message.avatar;
    }

    let messageText =   '<div class="row ml-0 mr-0 '+senderClass+'">';
    let messageTextAvatar =      '    <div class="col-lg-1 pr-0">';
    messageTextAvatar +=      '      <div class="chat_img">';
    messageTextAvatar +=      '          <img src="'+message.avatar+'" alt="User Image">';
    messageTextAvatar +=      '      </div>';
    messageTextAvatar +=      '  </div>';
    let messageTextBody =      '  <div class="col-lg-11 pr-0">';
    messageTextBody +=      '      <div class="chat_content shadow-sm">';
    messageTextBody +=      '          <div class="ch_date">'+message.create_date+'<i class="fa fa-caret-right"></i><span>'+message.create_time+'</span></div>';

    if(message.body){
        messageTextBody +=      '              <p>';
        messageTextBody +=                         message.body;
        messageTextBody +=      '              </p>';
    }

    if(message.attachment){
        if (message.attachment.endsWith('.png') || message.attachment.endsWith('.jpg') || message.attachment.endsWith('.jpeg') || message.attachment.endsWith('.bmp')) {
            messageTextBody += '<a target="_blank" href="' + window.location.origin + '/' + message.attachment + '"><img class="message-attachment" src="' + window.location.origin + '/' + message.attachment + '" alt="message attachment"></a>'
        }
        if (message.attachment.endsWith('.pdf')) {
            messageTextBody += '<a target="_blank" href="' + window.location.origin + '/' + message.attachment + '"><img class="message-attachment" src="' + window.location.origin + '/assets/img/pdf-icon.png' + '" alt="message-attachment"></a>';
        }
    }
    messageTextBody +=      '          </div>';
    messageTextBody +=      '      </div>';

    if(user_id == message.sender_id){
        messageText += messageTextBody;
        messageText += messageTextAvatar;
    }

    if(user_id == message.recipient_id){
        messageText += messageTextAvatar;
        messageText += messageTextBody;
    }

    messageText +=      '</div>';

    $('#'+selectedTabId+'-tab .messagesHolder').append(messageText);
}

$('#sendMessage').click(function(e){
    e.preventDefault();
    let url = "/send-message";
    let selectedTabId = $('#v-pills-tab .active')[0].id;

    let data = {
        'interview_slug': selectedTabId,
        'message_body': $('#messege_content').val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(url, data, function(response){
        
        $('#messege_content').val('');
        
        //console.log(response);
        
        if(response.status == "success"){
            updateMessagesHolder(selectedTabId, response.message);
            $('#messege_content').val('');

            $("#"+selectedTabId+"-tab .chat_body").scrollTop($("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight);
            //window.location.reload();
        }
    });
});

function setAutomessage(selectedTabId){
    
    //$('#'+selectedTabId+'-tab .messagesHolder .row').remove();

    //let height = $("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight;
    
    //$('#'+selectedTabId+'-tab .messagesHolder').html('<div style="height: '+height+'px"><div class="align-middle text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Fetching messages...</span></div></div>');
    
    $.ajax({
        method: 'get',
        url: '/get-new-messages/'+selectedTabId
    }).done(function (data) {
        
        //console.log(data);
        
       // $('#'+selectedTabId+'-tab .messagesHolder').html('');
        for(let i = 0; i < data.messages.length; i++){
            updateNewMessagesHolder(selectedTabId, data.messages[i]);
            //$("#"+selectedTabId+"-tab .chat_body").animate({scrollTop: $("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight}, "fast");
            
            if(i == data.messages.length-1) {
                $("#"+selectedTabId+"-tab .chat_body").scrollTop($("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight);
            }
            
        }
        
        
    }).fail(function (data) {
        console.log(data);
    });
    
}


function getMessagesForSelectedTab(){
    
    console.log('getMessagesForSelectedTab');
    
    let selectedTabId = $('#v-pills-tab .active')[0].id;

    $('#'+selectedTabId+'-tab .messagesHolder .row').remove();

    let height = $("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight;
    
    $('#'+selectedTabId+'-tab .messagesHolder').html('<div style="height: '+height+'px"><div class="align-middle text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Fetching messages...</span></div></div>');
    
    $.ajax({
        method: 'get',
        url: '/get-messages/'+selectedTabId
    }).done(function (data) {
        
        //console.log(data);
        
        $('#'+selectedTabId+'-tab .messagesHolder').html('');
        for(let i = 0; i < data.messages.length; i++){
            updateMessagesHolder(selectedTabId, data.messages[i]);
            $("#"+selectedTabId+"-tab .chat_body").scrollTop($("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight);
        }
    }).fail(function (data) {
        console.log(data);
    });
    

   setInterval(function(){ setAutomessage(selectedTabId); }, 3000); 
   
}

function initializeOpentok(){
    let selectedTabId = $('#v-pills-tab .active')[0].id;
    
    console.log(selectedTabId);
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/get-opentok-token',
        method: "post",
        data: {
            interview_slug: selectedTabId
        }
    }).done(function(data){
        
        ot_session_id = $("#"+selectedTabId+"-tab .opentok_session").val();
        opentokCredentials.sessionId = $("#"+selectedTabId+"-tab .opentok_session").val();        
        opentokCredentials.token = data.opentok_token;
        opentokCallerName = $("#"+selectedTabId+"-tab .opentok_caller_name").val();
        OpentokApp();
    }).fail(function(data){
        console.log(data);
    });

}

function updateTopbarMessageHolder(message){
    
    console.log('updateTopbarMessageHolder');
    
    if($('#topbar-message-'+message.slug).length){
        if(message.body && message.attachment){
            $('#topbar-message-'+message.slug+" .message-body").html(message.body+"<br>"+message.attachment);      
        } else if(message.body && !message.attachment) {
            $('#topbar-message-'+message.slug+" .message-body").html(message.body); 
        } else if(!message.body && message.attachment){
            $('#topbar-message-'+message.slug+" .message-body").html(message.attachment);
        } else {
            
        }
       
    } else {
        let messageHtml = '<li data-link="'+window.location.origin+'/messages?interview='+message.slug+'" id="topbar-message-'+message.slug+'">';
        messageHtml+= '<img class="sender-avatar" src="'+window.location.origin+'/'+message.avatar+'">';
        messageHtml+= '<span class="message-body">'
        if(message.body){
            messageHtml+= message.body;
        }
        
        if(message.body && message.attachment){
            messageHtml += '<br>';
        }
        
        if(message.attachment){
            messageHtml += window.location.origin+'/'+message.attachment;
        }
        messageHtml+= '</span>';
        messageHtml+= '</li>';
        
        $('#topbar_messages').append(messageHtml);
    }
    
    $('#topbar_messages_count').html($('#topbar_messages li').length);
    
}

$(document).ready(function(){
    
    $('#topbar_messages').on('click', 'li', function(e){
        e.preventDefault();
        
        let url = $(this).data('link');
        
        window.location = url;
    });
    
    
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        initializeOpentok();        
        getMessagesForSelectedTab();
    });
    
    $('#makeVideoCall').click(function(e){
        localVideoEnabled = true;
    });
    
    $('#makeVoiceCall').click(function(e){
        localVideoEnabled = false;
    });

    if($(".messagesHolder").length > 0){
        initializeOpentok();        
        getMessagesForSelectedTab();
    }

    $('#attach_file_m').on('change', function(){
        let file = $('#attach_file_m')[0].files[0];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let selectedTabId = $('#v-pills-tab .active')[0].id;

        let formData = new FormData($('form#messageForm')[0]);
        formData.append('interview_slug', selectedTabId);
        let data = {
            'attachment': file,
            'interview_slug': selectedTabId
        };

        $.ajax({
            url: '/send-message',
            processData: false,
            contentType: false,
            cache: false,
            method: 'post',
            data: formData
        }).done(function (data) {
            
            
            
            console.log(data);
            updateMessagesHolder(selectedTabId, data.message);
            $('#messege_content').val('');

            $("#"+selectedTabId+"-tab .chat_body").scrollTop($("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight);
        }).fail(function (data) {

        });
    });

    Echo.private('chat-'+user_id )
        .listen('MessageSent', (e) => {
            
            updateTopbarMessageHolder(e.message);
            
            if($('.messagesHolder').length > 0){
                let selectedTabId = e.message.slug;
                updateMessagesHolder(selectedTabId, e.message);

                $("#"+selectedTabId+"-tab .chat_body").scrollTop($("#"+selectedTabId+"-tab .chat_body")[0].scrollHeight);
            }
        });

});