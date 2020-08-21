(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
        
        if($('#scopeOfWorkDetails').length){
            tinymce.init({
                selector: '#scopeOfWorkDetails',
                element_format : 'html',
                verify_html: false,
                plugins: [
                    "advlist anchor autolink code codesample colorpicker contextmenu fullscreen help image imagetools", " lists link media noneditable preview", " searchreplace table template textcolor" +
                    " visualblocks wordcount"
                ]
            });
        }
        
        // $('#phone_number').intlTelInput({
        //   initialCountry: "auto",
        //   geoIpLookup: function(callback) {
        //     $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        //       var countryCode = (resp && resp.country) ? resp.country : "";
        //     //   alert(countryCode);
        //       callback(countryCode);
        //     });
        //   },
        //   utilsScript: "utils.js" // just for formatting/placeholders etc
        // });
        
        
        
        $("#lawyerCredentials").hide();
        
        
        /**
         * save review
         */
         
        $('#saveReview').click(function(e){
            let selectedTabId = $('#v-pills-tab .active')[0].id;
            let interview_slug = $('#'+selectedTabId+'-tab .interview_slug').val();
            let star = $('#'+selectedTabId+'-tab .star_rating').val();
            let comment = $('#'+selectedTabId+'-tab .comment').val();
            
            let data = {
                    interview_slug: interview_slug,
                    star: star,
                    comment: comment
                };
                
            console.log(data);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                method: "post",
                url: "/save-review",
                data: data
            }).done(function(data){
                console.log(data);
            }).fail(function(data){
                console.log(data);
            });
        });



        /*---------------------------------------
         DATA TABLE
         -----------------------------------------*/
        $('#payment-table').DataTable({
            searching: false,
            pagingType: 'simple',
            responsive: true,
        });

        /*---------------------------------------
         CHANGE PASSWORD POPUP
         -----------------------------------------*/
        $('.change-pass').click(function () {
            if ($('.change-pass-popup').hasClass('show')) {
                $('.change-pass-popup').removeClass('show');
            } else {
                $('.change-pass-popup').addClass('show');
            }
        });

        $('.change-pass-popup .close').click(function () {
            if ($('.change-pass-popup').hasClass('show')) {
                $('.change-pass-popup').removeClass('show');
            }
        });
        
        /*---------------------------------------
         DEACTIVATE ACCOUNT POPUP
         -----------------------------------------*/
        $('.deactivate-account').click(function () {
            if ($('.deactivate-account-popup').hasClass('show')) {
                $('.deactivate-account-popup').removeClass('show');
            } else {
                $('.deactivate-account-popup').addClass('show');
            }
        });

        $('.deactivate-account-popup .close').click(function () {
            if ($('.deactivate-account-popup').hasClass('show')) {
                $('.deactivate-account-popup').removeClass('show');
            }
        });
        
        /*---------------------------------------
         ACTIVATE ACCOUNT POPUP
         -----------------------------------------*/
        $('.activate-account').click(function () {
            if ($('.activate-account-popup').hasClass('show')) {
                $('.activate-account-popup').removeClass('show');
            } else {
                $('.activate-account-popup').addClass('show');
            }
        });

        $('.activate-account-popup .close').click(function () {
            if ($('.activate-account-popup').hasClass('show')) {
                $('.activate-account-popup').removeClass('show');
            }
        });

        //Home Latest Project Table and Featured Project Table	
        $('#latest_project, #featured_projects').DataTable({
            language: {
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>'
                },
                aria: {
                    paginate: {
                        previous: 'Previous',
                        next: 'Next'
                    }
                },
                "info": "<a href='#'>View All Projects</a><i class='fa fa-angle-double-right'></i>"
            },
            "ordering": false,
            "info": true,
            "searching": false,
            "pageLength": 6,
            "lengthMenu": false,
        });



        $(function () {
            $(".pro_box_main").slice(0, 4).show();
            $("#loadMore").on('click', function (e) {
                e.preventDefault();
                $(".pro_box_main:hidden").slice(0, 2).show("slow");
                if ($(".pro_box_main:hidden").length == 0) {
                    $("#loadMore").fadeOut('slow');
                }
            });
        });

        $(function () {
            $(".pro_box_main2").slice(0, 4).show();
            $("#loadMore2").on('click', function (e) {
                e.preventDefault();
                $(".pro_box_main2:hidden").slice(0, 2).show("slow");
                if ($(".pro_box_main2:hidden").length == 0) {
                    $("#loadMore2").fadeOut('slow');
                }
            });
        });

        $(function () {
            $(".pro_box_main3").slice(0, 4).show();
            $("#loadMore3").on('click', function (e) {
                e.preventDefault();
                $(".pro_box_main3:hidden").slice(0, 2).show("slow");
                if ($(".pro_box_main3:hidden").length == 0) {
                    $("#loadMore3").fadeOut('slow');
                }
            });
        });

       /* $('.counter').counterUp({
            delay: 100,
            time: 1000
        });*/
        
        
        
        
        // number count for stats, using jQuery animate

$('#reactProCounter').waypoint(function() {
     $('.counter').each(function() {
      var $this = $(this),
          countTo = $this.attr('data-count');
      
      $({ countNum: $this.text()}).animate({
        countNum: countTo
      },
    
      {
    
        duration: 3000,
        easing:'linear',
        step: function() {
          $this.text(Math.floor(this.countNum));
        },
        complete: function() {
          $this.text(this.countNum);
          //alert('finished');
        }
    
      });  
    });
});
        


        if ($('.datepicker').length > 0) {
            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy',
                startDate: '-3d'
            });
        }

        $(function () {
            $('#menu').mmenu();
        });

        $(".cmt_btn").click(function () {
            $(".comment_form").toggleClass("active");
        });

        $(".edit_profile_sidebar .switch").hover(function () {
            $(".check_tooltip").toggleClass("active");
        });
        
        
        function updateSignupSwitch(){
            
            if ($('.switch input').is(':checked')) {
                $(".switch").addClass('worked');
                $(".sign_in_page .sign_left_bg h1").html("Qualified lawyer?<br>Find new customers needing legal help.");
                $("#hintUser").html("Registering as ");
                $("#lawyerCredentials").show();
                $("#userTypeOnPopUp").html("Lawyer");
                $("#lsm_number").val('');
                $("#cpc_number").val('');
                
            } else {
                $(".switch").removeClass('worked');
                $(".sign_in_page .sign_left_bg h1").html("Need legal help?<br>Find a qualified lawyer in a flash.");
                $("#hintUser").html("Registering as ");
                $("#lawyerCredentials").hide();
                $("#userTypeOnPopUp").html("Client");
                $("#lsm_number").val(0);
                $("#cpc_number").val(0);
            }
        }
        
        if($('.switch input').length){
            updateSignupSwitch();
        }


        //signup page toggle switch
        $('.switch input').change(function () {
            updateSignupSwitch();
        });

        //sticky Navbar
        $(".main_header").sticky({topSpacing: 0});
        
        
        //For Home Page Practice Box
        $( ".practice-box" ).hover(function() {
        $(this).each(function () {
            $(this).find(".practice-front").toggleClass("hide");
            $(this).find(".practice-back").toggleClass("show");
        });
        });
        
        $(function() {
            $(".practice_slice").slice(0, 6).show();
            $("#loadPractice").on('click', function(e) {
                e.preventDefault();
                $(".practice_slice:hidden").slice(0, 3).show("slow");
                if ($(".practice_slice:hidden").length == 0) {
                    $("#loadPractice").hide('slow');
                }
            });
        });
        

        //Rich Editor
        //Rich Editor
        tinymce.init({
            selector: '.rich_editor textarea',
            element_format: 'html',
            plugins: [
                "a11ychecker advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools", " lists link linkchecker media mediaembed noneditable powerpaste preview", " searchreplace table template textcolor tinymcespellchecker visualblocks wordcount"
            ]
        });


        let initialSrc = "https://thelawapp.com.au/assets/img/logo.png";
        let scrollSrc = "https://thelawapp.com.au/assets/img/logo-black.png";
        
        $(window).scroll(function() {
            var value = $(this).scrollTop();
            if (value > 0)
                $(".landingPagelogo").attr("src", scrollSrc);
            else
                $(".landingPagelogo").attr("src", initialSrc);
        });

    });

}(jQuery));