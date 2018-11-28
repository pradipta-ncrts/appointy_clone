<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/bootstrap.min.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/fonts.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/font-awesome.min.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/animate.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/bootstrap-datepicker.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/nice-select.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/styles.css')}}" >
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/app.css')}}" />
      <link rel="stylesheet" href="{{asset('public/assets/mobile/css/custom.css')}}" />
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
      <link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-timepicker.min.css')}}" />
      <link href="{{asset('public/assets/mobile/css/ncrts.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
      <script type="text/javascript">
          var authDatas={user_no:0}; 
          var device_token_key="<?php echo Session::getId()?>"; 
          var baseUrl ="<?php echo url('')?>/mobile/"; 
      </script>
      @yield('custom_css')
   </head>
   <body>
    <div class="animationload" style="display: none;">
        <div class="osahanloading"></div>
    </div>
        @yield('content')
        <?php
        if(Request::segment(2)=='my-profile')
        {
        ?>
        <button class="popup-button" onclick="ShowPopup(this);"><img src="{{asset('public/assets/mobile/images/edit.png')}}" /> </button>
        <?php
        }
        else
        {
        ?>
        <button class="popup-button" onclick="ShowPopup(this);"><img src="{{asset('public/assets/mobile/images/plus.png')}}" /> </button>
        <?php
        }
        ?>
        <div id="popup">
            <ul class="showMobile menuList">
                <!-- <li><a>List of Notes <img src="{{asset('public/assets/mobile/images/add-menu/list-of-notes.png')}}"/></a></li> -->
                <li><a onclick="blockTime();">Block Time <img src="{{asset('public/assets/mobile/images/add-menu/block-time.png')}}"/></a></li>
                <li><a onclick="blockDate();">Block Date <img src="{{asset('public/assets/mobile/images/add-menu/block-date.png')}}"/></a></li>
                <li><a href="{{url('mobile/service-list')}}">Services <img src="{{asset('public/assets/mobile/images/add-menu/services.png')}}"/></a></li>
                <li><a href="{{url('mobile/staff-list')}}">Staff <img src="{{asset('public/assets/mobile/images/add-menu/staff.png')}}"/></a></li>
                <li><a href="{{url('mobile/add-client')}}">Add Clients <img src="{{asset('public/assets/mobile/images/add-menu/clients.png')}}"/></a></li>
                <li><a href="{{url('mobile/add-appointment')}}">Add Appointment <img src="{{asset('public/assets/mobile/images/add-menu/appointment.png')}}"/></a></li>
            </ul>
            <div id="blockDate" class="showMobile">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="popupInside dashDateTime showMobile">
                            <h3>Block Date</h3>
                            <div class="mobile-control">
                            <div class="input-group">
                                <input class="form-control nice-select" type="text" placeholder="Select Date" />    
                                <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                            </div>
                            <h6>Reason</h6>
                            <div class="break10px"></div>
                            <textarea class="form-control paddingLeft12px" rows="4" placeholder="Write Here"></textarea>
                            <div class="break20px"></div>
                            <h6>Block For</h6>
                            <div class="break10px"></div>
                            <input class="form-control nice-select" type="text" placeholder="All Staff" />
                            </div>
                            <a class="btn btn-block btn-mobile break10px">Block</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div id="blockTime" class="showMobile">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="popupInside dashDateTime showMobile">
                            <h3>Block Time</h3>
                            <div class="mobile-control">
                            <h6>Select Time</h6>
                            <div class="break10px"></div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                        <input class="form-control" type="text" placeholder="Select Time" />    
                                        <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                </div>
                                <div class="col-xs-2 text-center">
                                    <label class="customlabel">to</label>    
                                </div>
                                <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                        <input class="form-control" type="text" placeholder="Select Time" />    
                                        <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group custom-group">
                                <input class="form-control" type="text" placeholder="Select Date" />    
                                <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                            </div>
                            <h6>Reason</h6>
                            <div class="break10px"></div>
                            <div class="custom-group">
                                <textarea class="form-control paddingLeft12px" rows="4" placeholder="Write Here"></textarea>
                            </div>
                            <div class="break20px"></div>
                            <h6>Block For</h6>
                            <div class="break10px"></div>
                            <div class="custom-group">
                                <input class="form-control nice-select" type="text" placeholder="All Staff" />
                            </div>
                            </div>
                            <a class="btn btn-block btn-mobile break10px">Block</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <script src="{{asset('public/assets/mobile/js/jquery.min.js')}}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{asset('public/assets/mobile/js/jquery.nice-select.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("ul.menu li a").click(function () {
                    $(this).addClass("active");
                    $(("li a.active")).not($(this)).removeClass("active");
                });
                /*$("#select_date").datepicker('setDate', 'now');
                $("#select_date").data('datepicker').hide = function () {};
                $("#select_date").datepicker('show');*/
                $('select').niceSelect();
                $(".showSidenav").click(function(e){
                    $(".menuoverlay").fadeIn();
                    $(".sideNavbar").removeClass("sideToggle");
                    e.stopPropagation();
                });
                $(".sideNavbar").click(function(e){
                    e.stopPropagation();
                });
                $(".menuoverlay").click(function(){
                    $(".menuoverlay").fadeOut();
                    $(".sideNavbar").addClass("sideToggle");
                });
                if(screen.width >=767){
                    $("table tr td").removeClass("bluebg");
                }
            });
            function ShowPopup(obj) {
                alert('hii');
                //$("#popup").fadeToggle();
                $(obj).next("#popup").fadeToggle();
                $(obj).toggleClass("rotatebtn");             
                $("#blockDate").fadeOut('2000');
                $("#blockTime").fadeOut('2000');
                //$("#popup").fadeOut('2000');
                $(".menuList").fadeIn('10');
            }
            function blockDate(){
                $(".menuList").fadeOut('fast');
                $("#blockDate").fadeIn();
            }
            function blockTime(){
                $(".menuList").fadeOut('fast');
                $("#blockTime").fadeIn();
            }
            function popup(){
                $(".menuList").fadeOut('fast');
                $("#popup").fadeIn();
            }
            
            function activeColor(obj) {
                $(obj).toggleClass("active");
                $("ul.colors li.active").not($(obj)).removeClass("active");
                $(".selectcolor ul li.active").not($(obj)).removeClass("active");
            }
        </script>
        <script type="text/javascript">
        function myFunction() {
        var x = document.getElementById("openbox");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
            }
        }
        </script> 



        <script src="{{asset('public/assets/mobile/plugins/sweetalert/sweetalert.min.js')}}"></script> 
        <!-- jQuery Cookie -->
        <script src="{{asset('public/assets/mobile/js/jquery.cookie.min.js')}}"></script>
        <!-- Form Validation -->
        <script src="{{asset('public/assets/mobile/js/jquery.validate.min.js')}}"></script>

        <script src="{{asset('public/assets/mobile/js/jquery-ui.js')}}"></script>
        <script src="{{asset('public/assets/mobile/js/bootstrap-timepicker.min.js')}}"></script>

        <!-- sideToggle-->
        <script src="{{asset('public/assets/mobile/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('public/assets/mobile/js/ncrts.js')}}"></script>
        <script src="{{asset('public/assets/mobile/js/ncrtsdev.js')}}"></script>

        <script>
         $( function() {
            var $var = $("#appointmentdate,#reshedule_appointmentdate,#block_time_date"); 
                $var.datepicker({
                minDate:0,
            });

            /*var $dp2 = $("#reshedule_appointmentdate"); 
            $dp2.datepicker({
                //changeYear: true,
                //changeMonth: true,
                minDate:1,
            });*/

            /*var $dp3 = $("#block_date"); 
            $dp3.multiDatesPicker({
            minDate:0,
            });  */ 
         });
       </script>
       <script type="text/javascript">
          $(".activeColor").click(function()
          {
             let colour_code = $(this).attr('data-colour');
             $(".activeColor").removeClass('active');
             $('#colour_code').val(colour_code);
             $(this).addClass('active');
          });
          
          $('#appointmenttime,#reshedule_appointmenttime,#bolck_start_time,#bolck_end_time').timepicker({defaultTime: ''});

          $('.availability_start_time,.availability_end_time').timepicker({defaultTime: ''});
         </script>
        @yield('custom_js')
   </body>
</html>