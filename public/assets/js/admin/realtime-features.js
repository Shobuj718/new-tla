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
        $.get( "/admin/notification-count", function( data ) {
            notificationsCount = JSON.parse(data);
            notificationText = '';

            console.log(notificationsCount);

            for( i = 0; i < notificationsCount.notifications_count.length; i++){
                switch(notificationsCount.notifications_count[i].type){
                    case "App\\Notifications\\UserSignedUp":
                        notificationText += '<a href="'+window.location.origin+'/admin/users/pending-users"> <div style="display: inline-block;" class="btn btn-danger btn-circle m-r-10"><i class="fa fa-users"></i></div> <div style="display: inline-block;" class="mail-contnet"> <span class="mail-desc">'+notificationsCount.notifications_count[i].count+' New User Signed Up.</span> </div> </a>';
                        break;
                    default:
                        notificationText += '';
                }
            }
            console.log(notificationText);
            $('.notification-center').html(notificationText);
            $('div.notifications.notify').html('<span class="heartbit"></span> <span class="point"></span>');
        });
    });

