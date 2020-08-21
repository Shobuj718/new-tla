<!doctype html>
<html lang="en" class="fixed left-sidebar-top">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title','Dashboard')</title>

 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/af-2.3.5/b-1.6.3/b-colvis-1.6.3/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/af-2.3.5/b-1.6.3/b-colvis-1.6.3/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.js"></script>

    <!--load progress bar-->
    <script src="{{asset('public/backend/vendor/pace/pace.min.js')}}"></script>
    <link href="{{asset('public/backend/vendor/pace/pace-theme-minimal.css')}}" rel="stylesheet" />

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{asset('public/backend/vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/vendor/animate.css/animate.css')}}">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('public/backend/vendor/data-table/media/css/dataTables.bootstrap.min.css') }}">
    <!--Notification msj-->
    <link rel="stylesheet" href="{{asset('public/backend/vendor/toastr/toastr.min.css')}}">
    <!--Magnific popup-->
    <link rel="stylesheet" href="{{asset('public/backend/vendor/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{asset('public/backend/stylesheets/css/style.css')}}">

    <script src="{{asset('public/backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
    <style type="text/css">
   .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
         color: white !important; 
         border: 0px solid #111; 
        /* background-color: #585858; */
        /* background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111)); */
        /* background: -webkit-linear-gradient(top, #585858 0%, #111 100%); */
        background: -moz-linear-gradient(top, #585858 0%, #111 100%);
        background: -ms-linear-gradient(top, #585858 0%, #111 100%);
        background: -o-linear-gradient(top, #585858 0%, #111 100%);
        /* background: linear-gradient(to bottom, #585858 0%, #111 100%); */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
         padding: 0em 0em; 
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *cursor: hand;
        color: #333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    
    table.dataTable.no-footer {
        border-bottom: 1px solid #ddd;
    }

    </style>

    @yield('css')


</head>

<body>
    
    
    
    
    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        @include('admin.include.header')
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
             @include('admin.include.sidebar')
            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">
                <!-- content HEADER -->
                <!-- ========================================================= -->
                @yield('content')
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
            <!-- RIGHT SIDEBAR -->
            <!-- ========================================================= -->

            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>
    
    
     
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
      </div>
      
    </div>
  </div>
  
  @yield('js')
<!--BASIC scripts-->
    <!-- ========================================================= -->
    
    
    <script src="{{asset('public/backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/nano-scroller/nano-scroller.js')}}"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="{{asset('public/backend/javascripts/template-script.min.js')}}"></script>
    <script src="{{asset('public/backend/javascripts/template-init.min.js')}}"></script>
    <!-- SECTION script and examples-->

    <!-- ========================================================= -->
    <script src="{{asset('public/backend/vendor/data-table/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('public/backend/vendor/data-table/media/js/dataTables.bootstrap.min.js') }}"></script>

   <!-- <script src="{{asset('public/backend/javascripts/examples/tables/data-tables.js') }}"></script>-->

    <!--Notification msj-->
    <!--<script src="{{asset('public/backend/vendor/toastr/toastr.min.js')}}"></script>-->
    <!--morris chart-->
    <script src="{{asset('public/backend/vendor/chart-js/chart.min.js')}}"></script>
    <!--Gallery with Magnific popup-->
    <!--<script src="{{asset('public/backend/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>-->
    <!--Examples-->
    <script src="{{asset('public/backend/javascripts/examples/dashboard.js')}}"></script>
    <!--<script src="{{ asset('public/backend/javascripts/examples/forms/advanced.js') }}"></script>
    <script src="{{ asset('public/backend/javascripts/custom/handlebars.min.js') }}"></script>-->
    <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>-->
     <!--<script src="//cdn.ckeditor.com/4.13.0/basic/ckeditor.js"></script>-->
     <!--<script src="{{asset('public/backend/vendor/jquery-validation/jquery.validate.min.js')}}"></script>-->
<!--Examples-->
    <!--<script src="{{asset('public/backend/javascripts/examples/forms/validation.js')}}"></script>-->
    
    <script src = 'index_bundle.js'></script>

 
      <script>
      $(function() {
        $( "#datepicker" ).datepicker();
      });
      </script>
  
    <script type="text/javascript">
        @if ($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif
    </script>


    <script>
        
        $(".modal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);

                $(".modal-title").html(link.attr("pageName"));
                var variable = link.attr("href");

                    if( typeof variable === 'undefined' || variable === null ){
                    
                    } else {
                        
                    $('.modal-body').html('<div style="display:block; text-align:center">loading</div>');
                    $(".theme-loader").fadeIn("slow");
          
          
                    $.ajax({
                            type: 'get',
                            url: link.attr("href"),
                            //data:{id: id},
                            success: function(data) {
                            $(".theme-loader").fadeOut("slow");
                            $('.modal-body').html(data);
                            },
                            error:function(err){
                            alert("error"+JSON.stringify(err));
                        }
                    });
            }
        });
                
    </script>

    
    <!--<scrpt>-->
    <!--    $(document).ready(function(){-->
	
    <!--    	boxsize();-->
        	
    <!--    	function boxsize() {-->
        	
    <!--    		var screenwidth  = screen.width;-->
    <!--    		var screenheight = screen.height;-->
    <!--    		//setTimeout(function(){ leftmenusize(); }, 0);-->
    <!--    		/ body section /-->
        
    <!--    		var bodyh = (screenheight-320);		-->
    <!--    		$(".modal-body").css({"max-height": bodyh+"px" });-->
        						 
    <!--    	}-->
        	
    <!--    });-->

    <!--</scrpt>-->
    
</body>

</html>
