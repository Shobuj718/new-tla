(function ($) {
    
    function selectAllNotifications(){
        $('.notification-item input[type="checkbox"]').prop("checked", true);
    }
    
    function selectReadNotifications(){
        $('.notification-item[data-read="true"] input[type="checkbox"]').prop("checked", true);
    }
    
    function selectUnreadNotifications(){
        $('.notification-item[data-read="false"] input[type="checkbox"]').prop("checked", true);
    }
    
    function unselectAllNotifications(){
        $('.notification-item input[type="checkbox"]').prop("checked", false);
    }
    
    function updateSelection(){
        
        let selectedFilter = $('#notificationsSelectMenu').val();
        
        if($("#notificationsSelectCheckbox")[0].checked) {
            switch(selectedFilter){
                case "all":
                    selectAllNotifications();
                    break;
                case "read":
                    selectReadNotifications();
                    break;
                case "unread":
                    selectUnreadNotifications();
                    break;
                case "none":
                    unselectAllNotifications();
                    break;
                default:
                    break;
            }
        }
        
        else {
            
            unselectAllNotifications();
        }
    }
    
    function deleteNotifications(notificationIds) {
        
        let data = {
            notificationIds: notificationIds
        };
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
           method: "post",
           url: '/delete-notifications',
           data: data
           
        }).done(function(data) {
            console.log(data);
            
            if(data.status === "success"){
                window.location = window.location;
            }
            
        }).fail(function (data) {
            console.log("failed");
            
        });
    }
    
    $(document).ready(function(){
        $("#notificationsSelectCheckbox").change(function() {
            updateSelection();
        });
        
        
        $("#notificationsSelectMenu").change(function(){
            updateSelection();
        });
        
        $('#deleteNotifications').click(function(e){
            e.preventDefault();
            
            let selectedNotifications = $('.notification-checkbox:checked');
            
            let selectedNotificationIds = [];
            
            for(let i = 0; i < selectedNotifications.length; i++){
                selectedNotificationIds.push($(selectedNotifications[i]).data('notification-source'));    
            }
            
            deleteNotifications(selectedNotificationIds);
        });
    });
    
})(jQuery);