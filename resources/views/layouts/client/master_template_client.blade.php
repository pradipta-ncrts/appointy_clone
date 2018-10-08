<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>@yield('title')</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">
	  <link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
	  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
	  
   </head>
   <body class="dashboard-bg">
	<div class="animationload" style="display: none;">
	 <div class="osahanloading"></div>
	</div>
      <div id="web">
         <header>
            <div class="container-custm">
               <div class="leftpan">
                  <div class="logo">
                     <a href="dashboard.html">
                     <img src="{{asset('public/assets/website/images/logo-light-text.png')}}" /> </a>
                  </div>
                 <!--  <div id="o-wrapper" class="o-wrapper setting-toggle">
                     <a id="c-button--slide-left" class="c-button">
                     <img src="{{asset('public/assets/website/images/setting.png')}}" alt="" />
                     </a>
                  </div> -->
               </div>
               <div class="rightpan">
                  <div class="top-nav">
                     <div class="dropdown prof-menu" href="#">
                        <!-- <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-pic" src="{{asset('public/assets/website/images/user-img.png')}}">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#">
                           <i class="fa fa-share-alt" aria-hidden="true"></i> Share links</a>
                           <a class="dropdown-item" href="calendar-connections.html">
                           <i class="fa fa-calendar" aria-hidden="true"></i> Calendar Connections</a>
                           <a class="dropdown-item" href="#">
                           <i class="fa fa-cog" aria-hidden="true"></i> Profile settings</a>
                           <a class="dropdown-item" href="#">
                           <i class="fa  fa-id-card " aria-hidden="true"></i> Memebership</a>
                           <a class="dropdown-item" href="#">
                           <i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                           <a class="dropdown-item" href="#">
                           <i class="fa fa-question-circle " aria-hidden="true"></i> Help</a>
                           <a class="dropdown-item" href="#">
                           <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div> -->
                     </div>
                  </div>
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
         });       
      </script> 

      
      <!-- slide menu script -->

      @yield('custom_js')

   </body>
</html>