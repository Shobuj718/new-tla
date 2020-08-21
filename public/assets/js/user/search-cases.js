(function ($) {
    
    function updateUI(cases){
        let caseList = '';
        
        for(let i = 0; i < cases.length; i++) {
            
            let caseTitle = '';
            
            caseTitle += '<a href="'+window.location.origin+'/case/'+cases[i].slug+'" class="case_link" >';
            caseTitle +=    '<li class="search_list_item">';
            caseTitle +=         cases[i].title;
            caseTitle +=    '</li>';
            caseTitle += '</a>';
            
            if(cases.length !== 1 || i !== cases.length-1) {
                caseTitle +=    '<hr>';    
            }
            
            caseList += caseTitle;
        }
        
        $('#caseList').html(caseList);
    }
    
    
    function getAndUpdateCasesList(){
        
        let value = $('#search').val();
 
        $.ajax({

            method: "get",
            url : '/searched-cases',
            
            data: {
                
                'search': value
            }

        }).done(function(data){
                console.log(data);
                updateUI(data.project);
        
        }).fail(function(data){
            
            console.log("failed");
        
        });
        
    }

    $(document).ready(function () {
        
        // $('#clearText').fadeOut();
        $('#caseList').fadeOut();
        $('#caseList').children().fadeOut();
        
        $('#search').on('keyup', function(){
            //alert('calls');
            let search_string = $(this).val();
            
            if(search_string !== '') {
                
                // $('#clearText').fadeIn();
                
                $('#searchListBox').fadeIn();
                $('#caseList').fadeIn();
                $('#caseList').children().fadeIn();
                
                getAndUpdateCasesList(); 
                
                // $('#clearText').on('click', function () {
                //     $('#search').val('');
                //     $('#clearText').fadeOut();
                //     $('#caseList').fadeOut();
                //     $('#caseList').children().fadeOut();
                // })
                
            } else {
                
                // $('#clearText').fadeOut();
                $('#searchListBox').fadeOut();
                $('#caseList').fadeOut();
                $('#caseList').children().fadeOut();  
                
            }
            
            
        })
    
        
    });


})(jQuery);