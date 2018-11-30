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
      <!-- <link href="{{asset('public/assets/mobile/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet"> -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.css" rel="stylesheet">
      <script type="text/javascript">
          var authDatas={user_no:0}; 
          var device_token_key="<?php echo Session::getId()?>"; 
          var baseUrl ="<?php echo url('')?>/mobile/"; 
          var baseUrl2 ="<?php echo url('')?>"; 
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
                            <input class="form-control nice-select" type="text" placeholder="All Staff" data-target="#staffListModal1" data-toggle="modal"/>
                            </div>
                            <a class="btn btn-block btn-mobile break10px">Block</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>



<div id="stafflm" class="showMobile">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="popupInside dashDateTime showMobile">
                            <h3>Staff List</h3>
                            <div class="mobile-control">
                           
                           
                            </div>
                            <a class="btn btn-block btn-mobile break10px">Cancel</a>
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
                            <div class="custom-group" data-toggle="modal" data-target="#staffListModal">
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
        
        
        
<div class="modal fade mb-custmmodal" id="staffListModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content--> 
        <div class="popupInside new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Staff List</h4>
                </div>
                <div class="filter-op"> 
                <span><a href="" class="staff-select-all">Select All</a>  &nbsp; | &nbsp; 
                 <a href="" class="staff-deselect-all">Deselect All</a></span></div>
                <div class="modal-body">
                   <div class="notify" >
                      <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/user-pic-sm-default.png" class="thumbnail rounded">
                        <h2>john<br>
                        <a href="mailto:johns1@gmail.com"><i class="fa fa-envelope-o"></i> johns1@gmail.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="9">
                        </div>
                        </div>
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/uploads/profile_image/1541415532Desert.jpg" class="thumbnail rounded">
                        <h2>Dr Gladden<br>
                        <a href="mailto:rituparna.majumder@ncrtechnosolutions.com"><i class="fa fa-envelope-o"></i> 
                        rituparna.majumder@ncrtechnosolutions.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="22">
                        </div>
                        </div>
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/user-pic-sm-default.png" class="thumbnail rounded">
                        <h2>rituparna123 <br>
                        <a href="mailto:ritu4mkol12@gmail.com"><i class="fa fa-envelope-o"></i> ritu4mkol12@gmail.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="23">
                        </div>
                        </div>
                       </div>
                       <div class="butt-pop-ft">
                       <button type="submit" id="add-stuff-into-input" class="btn btn-primary butt-next">Done</button> 
                       <a href="" id="cancel-staff-list" class="btn btn-primary butt-next">Cancel</a> 
                    </div>
                </div>
            </form>
          </div>
      </div>
   </div>
   
<div class="modal fade mb-custmmodal" id="staffListModal1" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content--> 
        <div class="popupInside new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Staff List</h4>
                </div>
                <div class="filter-op"> 
                <span><a href="" class="staff-select-all">Select All</a>  &nbsp; | &nbsp; 
                 <a href="" class="staff-deselect-all">Deselect All</a></span></div>
                <div class="modal-body">
                   <div class="notify" >
                      <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/user-pic-sm-default.png" class="thumbnail rounded">
                        <h2>john<br>
                        <a href="mailto:johns1@gmail.com"><i class="fa fa-envelope-o"></i> johns1@gmail.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="9">
                        </div>
                        </div>
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/uploads/profile_image/1541415532Desert.jpg" class="thumbnail rounded">
                        <h2>Dr Gladden<br>
                        <a href="mailto:rituparna.majumder@ncrtechnosolutions.com"><i class="fa fa-envelope-o"></i> 
                        rituparna.majumder@ncrtechnosolutions.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="22">
                        </div>
                        </div>
                        <div class="user-bkd">
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/user-pic-sm-default.png" class="thumbnail rounded">
                        <h2>rituparna123 <br>
                        <a href="mailto:ritu4mkol12@gmail.com"><i class="fa fa-envelope-o"></i> ritu4mkol12@gmail.com</a>
                        </h2>
                        <div class="check-ft">
                        <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="23">
                        </div>
                        </div>
                       </div>
                       <div class="butt-pop-ft">
                       <button type="submit" id="add-stuff-into-input" class="btn btn-primary butt-next">Done</button> 
                       <a href="" id="cancel-staff-list" class="btn btn-primary butt-next">Cancel</a> 
                    </div>
                </div>
            </form>
          </div>
      </div>
   </div>   
   

<style type="text/css">
.mb-custmmodal .modal-header{padding:0;margin-bottom:10px;}
.mb-custmmodal .form-control{border:1px solid #ccc;}
.mb-custmmodal .user-bkd {display: flex;position: relative;margin: 12px 0 0;}
.mb-custmmodal .rounded {height:40px;width:40px;margin-bottom: 0;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;-ms-border-radius: 50%;-o-border-radius: 50%;}
.mb-custmmodal .user-bkd h2 {font-size: 15px;font-weight: 300;margin:4px 0 0 8px;width:100%;}
.mb-custmmodal .user-bkd .check-ft {float: right;font-size:19px;color: #3097d5;}
.mb-custmmodal .butt-pop-ft{margin:15px 0;text-align: center;}
.mb-custmmodal .user-bkd a{word-wrap: break-word;float: left;display: inline-flex;word-break: break-all;font-size: 12px;width: 100%;margin: 6px 0 0;}
.mb-custmmodal .user-bkd a i{float: left;margin: 0 5px 0 0;}
</style>

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
                //$("#popup").fadeToggle();
                $(obj).next("#popup").fadeToggle();
                $(obj).toggleClass("rotatebtn");             
                $("#blockDate").fadeOut('2000');
                $("#blockTime").fadeOut('2000');
                $("#stafflm").fadeOut('2000');
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

            function stafflm(){
                $(".menuList").fadeOut('fast');
                $("#blockDate").fadeOut('fast');
                $("#stafflm").fadeIn();

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



        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.js"></script> 
        <!-- <script src="{{asset('public/assets/mobile/plugins/sweetalert/sweetalert.min.js')}}"></script> -->
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