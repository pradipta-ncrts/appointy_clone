<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>@yield('title')</title>
      <!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">-->
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/my-icons-collection/font/flaticon.css')}}">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/app.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">      
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">
	  <link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
	  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
      <link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-timepicker.min.css')}}" />
      <script type="text/javascript">
		  var baseUrl ="<?php echo url('')?>"; 
	  </script>
      @yield('custom_css') 
   </head>
   
   <body class="dashboard-bg">
    <?php 
    if(isset($_COOKIE['sqd_client_id']) && $_COOKIE['sqd_client_id'] > 0){
        $logged_client = App\Http\Controllers\BaseApiController::logged_client();
        $inner_client_details = $logged_client['inner_client_details'];
        /*echo "<pre>";
        print_r($inner_client_details); die();*/
    }
    ?> 

      <div>
        <div class="animationload" style="display: none;">
            <div class="osahanloading"></div>
        </div>
         <header>
            <div class="container-custm">
               <div class="leftpan">
                  <div class="logo">
                     <a href="#">
                     <img src="{{asset('public/assets/website/images/logo-light-text.png')}}" /> </a>
                  </div>
                 <!--  <div id="o-wrapper" class="o-wrapper setting-toggle">
                     <a id="c-button--slide-left" class="c-button">
                     <img src="{{asset('public/assets/website/images/setting.png')}}" alt="" />
                     </a>
                  </div> -->
               </div>
               <div class="rightpan">
                    <?php if(!empty($inner_client_details)) { ?>
                    <div class="top-nav">
                        
                        <div class="dropdown prof-menu" href="#">
                            <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                <!--<img class="user-pic" src="{{asset('public/assets/website/images/user-img.png')}}">-->
                                <?php
                                //echo '<pre>'; print_r($inner_client_details); exit;
                                if($inner_client_details->client_profile_picture != '')
                                {
                                    $image =  $inner_client_details->client_profile_picture ? 'image/profile_perosonal_image/'.$inner_client_details->client_profile_picture : 'assets/website/images/user-img.png';
                                ?>
                                <img class="user-pic" src="{{asset('public/'.$image)}}">
                                <?php
                                }
                                else
                                {
                                ?>
                                <img class="user-pic" src="{{asset('public/'.$image)}}">
                                <?php
                                }
                                ?>
                            </a> 
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                                <a class="dropdown-item" href="javascript:void(0);" id="profileSettings"> <i class="fa fa-cog" aria-hidden="true"></i> Profile settings</a> 
                                <a class="dropdown-item" href="{{ url('client/logout') }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> 
                            </div>
                        </div>
                        <div class="main-nav">
                        <a href="javascript:void(0);" id="clientBookingList"><i class="flaticon-calendar"></i><span> <span>Booking List</span></a>
                        <a href="javascript:void(0);" id="clientBookingService"><i class="flaticon-calendar"></i><span> <span>Calendar</span></span></a> 
                        </div>
                    </div>
                    <?php } ?>
               </div>
            </div>
         </header>
        <div id="content"> @yield('content') </div> 
      </div>
      <div id="c-mask" class="c-mask"></div>
      <!-- /c-mask -->
      <!-- <script src="js/bootstrap.min.js"></script> -->
      <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script>
      <script src="{{asset('public/assets/website/js/script.js')}}"></script>
      <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
	  <script src="{{asset('public/assets/website/js/jquery-ui.js')}}"></script>
      <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>
	  <!-- Sweetalert -->
	  <script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script>

      <script src="{{asset('public/assets/website/js/bootstrap-timepicker.min.js')}}"></script>
     
      <script type="text/javascript">
         function slideDiv(obj) {
             $(obj).closest(".ds").next(".dsinside").slideToggle();
             $(obj).find("i").toggleClass("fa-angle-down fa-angle-up");
             $(".dsinside").not($(obj).closest(".ds").next(".dsinside")).slideUp();
             $("i.fa-custom").not($(obj).find("i")).removeClass("fa-angle-up").addClass("fa-angle-down");
             $(".schedule").fadeOut();
         }
      </script> 
      <script>
        $(document).ready(function () {
            $("#adv-sh").click(function () {
                $("#adv-op").toggle();
            });


            var param = '<?php echo Request::segment(3);?>';
            $("#clientBookingList").click(function(){
                window.location = "<?php echo url('/client/booking-list/');?>"+"/"+param+"/all";
            });

            $("#clientBookingService").click(function(){
                window.location = "<?php echo url('/client/appointment-booking/');?>"+"/"+param;
            });

            $("#profileSettings").click(function(){
                window.location = "<?php echo url('/client/profile-settings/');?>"+"/"+param;
            });


        });   

        $( function() {
         var $var = $("#reshedule_appointmentdate");
             $var.datepicker({
               minDate:0,
            });
        });

        $('#reshedule_appointmenttime').timepicker({defaultTime: ''});
      </script> 

      
      <!-- slide menu script -->

      @yield('custom_js')

   </body>
</html>