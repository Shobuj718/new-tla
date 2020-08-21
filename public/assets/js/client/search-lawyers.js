(function ($) {
    
    function updateUI(lawyers){
        let lawyerList = '';
        
        for(let i = 0; i < lawyers.length; i++) {
            
            let singleLawyer = '';
            
            singleLawyer += '<a href="'+window.location.origin+'/'+lawyers[i].username+'" class="case_link" >';
            singleLawyer +=    '<li class="search_list_item">';
            singleLawyer +=         '<h3>'+lawyers[i].first_name+' '+lawyers[i].last_name.split("")[0]+'.</h3>';
            singleLawyer +=         '<span>'+lawyers[i].professional_title+'</span>';
            singleLawyer +=    '</li>';
            singleLawyer += '</a>';
            
            if(lawyers.length !== 1 || i !== lawyers.length-1) {
                singleLawyer +=    '<hr>';    
            }
            
            lawyerList += singleLawyer;
        }
        
        $('#lawyerList').html(lawyerList);
    }
    
    
    function getAndUpdateLawyersList(){
        //alert('call');
        let value = $('#search').val();
 
        $.ajax({

            method: "get",
            url : '/search-lawyers-dashboard',
            
            data: {
                
                'search': value
            }

        }).done(function(data){
            
                updateUI(data.lawyers);
        
        }).fail(function(data){
            
            console.log("failed");
        
        });
        
    }

    $(document).ready(function () {
        
        $('#lawyerList').fadeOut();
        $('#lawyerList').children().fadeOut();
        
        $('#search').on('keyup', function(){
            
            let search_string = $(this).val();
            
            if(search_string !== '') {
                
                $('#searchListBox').fadeIn();
                $('#lawyerList').fadeIn();
                $('#lawyerList').children().fadeIn();
                
                getAndUpdateLawyersList(); 
                
            } else {
                
                $('#searchListBox').fadeOut();
                $('#lawyerList').fadeOut();
                $('#lawyerList').children().fadeOut();  
                
            }
            
        })
    
        
    });


})(jQuery);