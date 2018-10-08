<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> @yield('title') </title>
        <link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap.min.css')}}" />
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/my-icons-collection/font/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/assets/website/css/animate.css')}}" />
        <link href="{{asset('public/assets/website/css/fonts.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('public/assets/website/css/nice-select.css')}}" />
        <link rel="stylesheet" href="{{asset('public/assets/website/css/app.css')}}" />
        <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
        <link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
        <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('public/assets/website/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/website/css/autocompletestyles.css')}}">
        <script type="text/javascript">
            var authDatas = {user_no: 0};
            var device_token_key = "<?php echo Session::getId() ?>";
            var baseUrl = "<?php echo url('') ?>";
        </script> 
        @yield('custom_css') 
    </head>
    <body>
        <?php $basicdatas = App\Http\Controllers\BaseApiController::category_list();

        function get_times($default = '00:00', $interval = '+30 minutes') {
            $output = '<option value=""></option>';
            $current = strtotime('00:00');
            $end = strtotime('23:59');
            while ($current <= $end) {
                $time = date('H:i', $current);
                $sel = ( $time == $default ) ? ' selected' : '';
                $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) . '</option>';
                $current = strtotime($interval, $current);
            } return $output;
        } ?> 
        <div class="animationload" style="display: none;">
            <div class="osahanloading"></div>
        </div>
        <header class="showDekstop clearfix">
            <div class="container-custm">
                <div class="leftpan">
                    <div class="logo"> <a href="{{ url('dashboard') }}"> <img src="{{asset('public/assets/website/images/logo.svg')}}" /></a> </div>
                    <div id="o-wrapper" class="o-wrapper setting-toggle"><a id="c-button--slide-left" class="c-button"><i class="flaticon-settings"></i></a></div>
                </div>
                <div class="rightpan">
                    <div class="top-nav">
                        <a id="c-button--slide-alert" class="c-button add-notifybtn"><i class="flaticon-alarm"></i></a> 
                        <div class="dropdown prof-menu " href="#">
                            <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}"></a> 
                            <div class="dropdown-menu pm-position" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModaladdappoinment"> <i class="fa fa-calendar" aria-hidden="true"></i> Add Appointments</a> <a class="dropdown-item" data-toggle="modal" data-target="#myModaladdclient"> <i class="fa fa-users" aria-hidden="true"></i>Add Clients</a> <a class="dropdown-item" data-toggle="modal" data-target="#myModalnewteam"> <i class="fa fa-cog" aria-hidden="true"></i> New Team Member</a> <a class="dropdown-item" href="{{ url('services') }}"> <i class="fa fa-id-card " aria-hidden="true"></i>Services</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalblockdate"> <i class="fa fa-user" aria-hidden="true"></i> Block Date</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalblocktime"> <i class="fa fa-question-circle " aria-hidden="true"></i> Block Time</a> <a class="dropdown-item" href="#" > <i class="fa fa-user" aria-hidden="true"></i> Invitee's</a> </div>
                        </div>
                        <a id="c-button--slide-right" class="c-button quick-add"><i class="flaticon-four-squares"></i></a> 
                        <div class="dropdown prof-menu" href="#">
                            <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="user-pic" src="{{asset('public/assets/website/images/user-img.png')}}"></a> 
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#"> <i class="fa fa-share-alt" aria-hidden="true"></i> Share links</a> <a class="dropdown-item" href="{{ url('calendar') }}"> <i class="fa fa-calendar" aria-hidden="true"></i> Calendar Connections</a> <a class="dropdown-item" href="{{ url('profile-settings') }}"> <i class="fa fa-cog" aria-hidden="true"></i> Profile settings</a> <a class="dropdown-item" href="#"> <i class="fa fa-id-card " aria-hidden="true"></i> Memebership</a><a class="dropdown-item" href="{{ url('invitees') }}"> <i class="fa fa-user" aria-hidden="true"></i> Invitees</a> <a class="dropdown-item" href="{{ url('staff-details') }}"> <i class="fa fa-user" aria-hidden="true"></i> Users</a> <a class="dropdown-item" href="#"> <i class="fa fa-question-circle " aria-hidden="true"></i> Help</a> <a class="dropdown-item" href="{{ url('/logout') }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> </div>
                        </div>
                        <div class="main-nav">
                            <!--<a href="#" class="settings">Settings</a> --> <a href="{{ url('client-database') }}" class="sm"><i class="flaticon-multiple-users-silhouette"></i> <span>Clients</span></a> <a href="{{ url('reports') }}" class="sm"><i class="flaticon-progress-report"></i> <span>Reports</span></a> <a href="{{ url('gift-certificates') }}"><i class="flaticon-megaphone"></i> <span>Marketing</span></a> <a href="{{ url('calendar') }}"><i class="flaticon-calendar"></i><span> <span>Calendar</span></a> <a href="{{ url('dashboard') }}"><i class="flaticon-dashboard"></i> <span>Dashboard</span></a> 
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="content"> @yield('content') </div>
        <!-- /c-menu slide-left --> 
        <div id="c-menu--slide-left" class="c-menu c-menu--slide-left">
            <div class="slide-rgt"><img src="{{asset('public/assets/website/images/settings-icon-rgt.png')}}" alt=""> Settings</div>
            <button class="c-menu__close"><img src="{{asset('public/assets/website/images/cross-slide.png')}}" alt="" /></button> 
            <ul class="c-menu__items" style="overflow-y: auto; height: 80%;">
                <li class="c-menu__item"><a href="{{ url('staff-details') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/staff.png')}}" alt=""> Staff</a> <span>Add, edit or delete staff</span> </li>
                <!--<li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/settings-icon/rooms.png" alt=""> Room, Services and Packs</a> <span>Add, update, disable a service </span> </li>--> 
                <li class="c-menu__item"><a href="{{ url('booking-options') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/booking.png')}}" alt=""> Booking Options </a> <span> Add, edit or disable booking</span> </li>
                <li class="c-menu__item"><a href="{{ url('settings-membership') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/membership.png')}}" alt=""> Membership</a> <span>Add, edit or disable booking...</span> </li>
                <li class="c-menu__item"><a href="{{ url('integration') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/integration.png')}}" alt=""> Integration</a> <span>Google Calender, Facebook... </span> </li>
                <li class="c-menu__item"><a href="{{ url('privacy-settings') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/privacy.png')}}" alt=""> Privacy Settings</a> <span>Control your information is... </span> </li>
                <li class="c-menu__item"><a href="{{ url('reports') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/statistics.png')}}" alt=""> Reports</a> <span>Add, edit or delete statistics</span> </li>
                <li class="c-menu__item"><a href="{{ url('settings-business-hours') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/business.png')}}" alt=""> Business Hours</a> <span>Link service to business hours</span> </li>
                <li class="c-menu__item"><a href="{{ url('business-contact-info') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/businessdetails.png')}}" alt=""> Business Details</a> <span>Address, Timezone, Currency </span> </li>
                <li class="c-menu__item"><a href="{{ url('booking-rules') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/booking-rules.png')}}" alt=""> Booking Rules</a> <span>Control how, what, when</span> </li>
                <li class="c-menu__item"><a href="{{ url('notification-settings') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/notification.png')}}" alt=""> Notification</a> <span>Control email and text alerts</span> </li>
                <li class="c-menu__item"><a href="#" onclick="showSqeeder();" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/sqeedr.png')}}" alt=""> Your Squeedr Page</a> <span>Add, edit or delete info</span> </li>
                <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/event-viewer.png')}}" alt=""> Event Viewer</a> <span>View and control events</span> </li>
            </ul>
        </div>
        <!--End /c-menu slide-left --> 
        <!-- /c-menu slide-right --> 
        <div id="c-menu--slide-right" class="c-menu c-menu--slide-right">
            <div class="slide-rgt"><img src="{{asset('public/assets/website/images/quick-icon-rgt.png')}}" alt=""> Quick Start</div>
            <button class="c-menu__close"><img src="{{asset('public/assets/website/images/cross-slide.png')}}" alt="" /></button> 
            <ul class="c-menu__items">
                <li class="c-menu__item"><a href="{{ url('services') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon1.png')}}" alt=""> Room, Services and Packs</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
                <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon2.png')}}" alt=""> Current Appointments</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
                <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon3.png')}}" alt=""> Book with google</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
                <li class="c-menu__item"><a href="{{ url('payment-options') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon4.png')}}" alt=""> PrePayment Option</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
                <li class="c-menu__item"><a href="{{ url('invite-contacts') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon5.png')}}" alt=""> Import & Invite Contacts</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
                <li class="c-menu__item"><a href="{{ url('add-location') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon6.png')}}" alt=""> Add Location</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
            </ul>
        </div>
        <!--End /c-menu slide-right --> 
        <!-- /c-menu alert-slide-right --> 
        <div id="c-menu--slide-alert" class="c-menu c-menu--slide-right alert-slide" >
            <div class="dropdown custm-uperdrop conn-drop">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Connected App & Devices <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
                <ul class="dropdown-menu ch-p">
                    <li><a href="#">Connected <strong>Apps</strong></a></li>
                </ul>
            </div>
            <div class="slide-rgt"><img src="{{asset('public/assets/website/images/icon-bell.png')}}" alt="">Alert</div>
            <button class="c-menu__close"><img src="{{asset('public/assets/website/images/cross-slide.png')}}" alt="" /></button> 
            <ul class="nav nav-tabs1">
                <li class="active"><a data-toggle="tab" href="#tab1">Booking Status</a></li>
                <li><a data-toggle="tab" href="#tab2">Profile</a></li>
                <li><a data-toggle="tab" href="#tab3">App Update</a></li>
                <li><a data-toggle="tab" href="#tab4">Feedback</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="noti">
                        <div class="notify" >
                           <!-- <a href="#" class="flip"><img src="images/arrow.png" alt=""/></a>--> <a onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;"> <b class="fa fa-custom fa-caret-down show-arrow" ></b></a> 
                            <div class="user-bkd">
                                <div class="notify-drops">
                                    <div class="dropdown custm-uperdrop">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Status <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
                                        <ul class="dropdown-menu st-p">
                                            <li><a href="#">All</a></li>
                                            <li><a href="#">Booked</a></li>
                                            <li><a href="#">Cancelled</a></li>
                                            <li><a href="#">Rescheduled</a></li>
                                            <li><a href="#">Failed</a></li>
                                            <li><a href="#">Unapproved</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded"> 
                                <h2> Steph Pouyet <br> <span>steph.pouyet@gmail.com</span> </h2>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="usr-bkd-dt">
                                    <div class="notify-drops">
                                        <div class="dropdown custm-uperdrop">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Check In <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
                                            <ul class="dropdown-menu st-p">
                                                <li><a href="#">As Scheduled</a></li>
                                                <li><a href="#">Arrived Late</a></li>
                                                <li><a href="#">No Show</a></li>
                                                <li><a href="#">Gift Certificates</a></li>
                                                <li><a href="#">New Status</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="name"> <i class="fa fa-circle-o "></i> Dev ($120.00) <br> <i class="fa fa-user-o "></i> JASON </div>
                                    <div class="datetime"> 12:00am - 01:00pm (1hr) <br> August 13 </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                Booked: Aug 13th, 2018 <br> <br> 
                                <div class="link-e"> <a href="#"><i class="fa fa-times"></i> Cancel</a> <a href="#"><i class="fa fa-repeat"></i> Reschedule</a> <a href="#"><i class="fa fa-star-half-o "></i> Request a review</a> </div>
                                <div class="clearfix">&nbsp;</div>
                                <br> <!--<a href="#"><i class="fa fa-file-o"></i> Appointment Note</a>--> 
                                <textarea rows="4"> Write here..</textarea>
                                <br> 
                                <div class="clearfix"></div>
                                <button type="button" class="btn btn-primary butt-next break10px">Add Payment ($100.00) </button> 
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr class="notify-sep">
                        <div class="notify" >
                           <!-- <a href="#" class="flip"><img src="images/arrow.png" alt=""/></a>--> <a onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;"> <b class="fa fa-custom fa-caret-down show-arrow" ></b></a> 
                            <div class="user-bkd">
                                <div class="notify-drops">
                                    <div class="dropdown custm-uperdrop">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Status <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
                                        <ul class="dropdown-menu st-p">
                                            <li><a href="#">All</a></li>
                                            <li><a href="#">Booked</a></li>
                                            <li><a href="#">Cancelled</a></li>
                                            <li><a href="#">Rescheduled</a></li>
                                            <li><a href="#">Failed</a></li>
                                            <li><a href="#">Unapproved</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded"> 
                                <h2> Steph Pouyet <br> <span>steph.pouyet@gmail.com</span> </h2>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="usr-bkd-dt">
                                    <div class="notify-drops">
                                        <div class="dropdown custm-uperdrop">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Check In <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
                                            <ul class="dropdown-menu st-p">
                                                <li><a href="#">As Scheduled</a></li>
                                                <li><a href="#">Arrived Late</a></li>
                                                <li><a href="#">No Show</a></li>
                                                <li><a href="#">Gift Certificates</a></li>
                                                <li><a href="#">New Status</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="name"> <i class="fa fa-circle-o "></i> Dev ($120.00) <br> <i class="fa fa-user-o "></i> JASON </div>
                                    <div class="datetime"> 12:00am - 01:00pm (1hr) <br> August 13 </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                Booked: Aug 13th, 2018 <br> <br> 
                                <div class="link-e"> <a href="#"><i class="fa fa-times"></i> Cancel</a> <a href="#"><i class="fa fa-repeat"></i> Reschedule</a> <a href="#"><i class="fa fa-star-half-o "></i> Request a review</a> </div>
                                <div class="clearfix">&nbsp;</div>
                                <br> <!--<a href="#"><i class="fa fa-file-o"></i> Appointment Note</a>--> 
                                <textarea rows="4"> Write here..</textarea>
                                <br> 
                                <div class="clearfix"></div>
                                <button type="button" class="btn btn-primary butt-next break10px">Add Payment ($100.00) </button> 
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr class="notify-sep">
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade in ">
                    <div class="noti">
                        <div class="profile-nt">
                            <h2>Profile Strength: Intermediate</h2>
                            <div class="prof-st-bs">
                                <div class="prof-st"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="prof-box">
                                    <i class="fa fa-user-circle-o"></i> 
                                    <h2>Tell your story with your profile</h2>
                                    <p>You have listed your job! Now add a profile photo to help others recognize you.</p>
                                    <a href="#">Add a Photo</a> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="prof-box">
                                    <i class="fa fa-check-circle-o "></i> 
                                    <h2>30 connections!</h2>
                                    <p>Keep adding connections to increase your visibilities with employers</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="prof-box">
                                    <i class="fa fa-check-circle-o "></i> 
                                    <h2>Sources followed!</h2>
                                    <p>You'll see news from these sources in your feed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade in ">
                    <div class="noti">
                        <h2 class="app-update">Update <img src="{{asset('public/assets/website/images/icon-squeedr.png')}}"></h2>
                        <div class="feedb">
                            <div class="feedb-list">
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}"> 
                                <p> <strong>Tell About App</strong><br> You have listed your job! Now add a profile photo to help others recognize you.</p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade in ">
                    <div class="noti">
                        <div class="feedb">
                            <div class="feedb-list">
                                <span class="tt">25h</span> <img src="{{asset('public/assets/website/images/user-img.png')}}"> 
                                <p> <strong>Steph Pouyet</strong><br> Congratulate Robin Wethll and 2 others for starting new Positions<br> <small>10:30 AM</small> </p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="feedb-list">
                                <span class="tt">25h</span> <img src="{{asset('public/assets/website/images/user-img.png')}}"> 
                                <p> <strong>Steph Pouyet</strong><br> Congratulate Robin Wethll and 2 others for starting new Positions<br> <small>10:30 AM</small> </p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="feedb-list">
                                <span class="tt">25h</span> <img src="{{asset('public/assets/website/images/user-img.png')}}"> 
                                <p> <strong>Steph Pouyet</strong><br> Congratulate Robin Wethll and 2 others for starting new Positions<br> <small>10:30 AM</small> </p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End /c-mask --> 
        <div id="c-mask" class="c-mask"></div>
        
        <div class="profilepopup">
            <div class="container-custom">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile">
                            <a class="closePopUp"> <img src="{{asset('public/assets/website/images/popup-close.png')}}"/></a> 
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                    <div class="profileInside">
                                        <div class="banner-top">
                                            <div class="img-banner-parent">
                                                <div class="img-banner">
                                                    <img src="{{asset('public/assets/website/images/img-banner.jpg')}}" class="img-responsive"/> 
                                                    <div class="blackbox">
                                                        <div class="lefttext">
                                                            <h6>Dr. Esther Gladden<br/> <span>Psychiatrist</span> </h6>
                                                        </div>
                                                        <a class="btn-select">Select a service <i class=" fa fa-caret-down"></i></a> 
                                                    </div>
                                                    <!-- <a class="btn btn-custom">Book Now</a>--> 
                                                </div>
                                            </div>
                                            <img src="{{asset('public/assets/website/images/profile-pic.jpg')}}" class="profilepic" /> 
                                            <ul class="profilelinks">
                                                <li><a href="#">Services</a> </li>
                                                <li><a href="#"> Expertise </a> </li>
                                                <li><a href="#">Presentation </a> </li>
                                                <li><a href="#">Contacts</a> </li>
                                            </ul>
                                        </div>
                                        <div class="staffs">
                                            <div class="staffsinside">
                                                <div class="headbar">
                                                    <img src="{{asset('public/assets/website/images/popup-staffs.png')}}"/> 
                                                    <h4>Staffs</h4>
                                                </div>
                                                <div class="owl-carousel owl-theme owl-custom">
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img1.png')}}"/><span>Carla J. Boatner</span> </div>
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img2.png')}}"/><span>Kristen R. Anderson</span></div>
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img3.png')}}"/><span>Robert C. Booker</span></div>
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img1.png')}}"/><span>Marie N. McDaniel</span> </div>
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img2.png')}}"/><span>Marvin S. Brown</span></div>
                                                    <div class="item"><img src="{{asset('public/assets/website/images/staffs/img3.png')}}"/><span>Otis K. Holmes</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="staffs">
                                            <div class="staffsinside">
                                                <div class="prof">
                                                    <img src="{{asset('public/assets/website/images/profile-icon-presentation.png')}}"> 
                                                    <div class="prof-cont">
                                                        <h3>Presentation</h3>
                                                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ad quorum et cognitionem et usum iam corroborati natura ipsa praeeunte deducimur. Nunc ita separantur, ut disiuncta <a href="#">more</a> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="staffs">
                                            <div class="staffsinside">
                                                <div class="prof">
                                                    <img src="{{asset('public/assets/website/images/profile-icon-expertise.png')}}"> 
                                                    <div class="prof-cont">
                                                        <h3>Expertise</h3>
                                                        <p> <span class="expt">Addiction, addiction and alcoholism</span> <span class="expt">Sleep medicine</span> <span class="expt">Hyperactivity - Inhibition</span> <span class="expt">Child Psychiatry</span> <span class="expt">Sleep disorder</span> <span class="expt">Insomnia</span> <span class="expt">Child sleep apnea</span> <span class="expt">Sleep Apnea</span> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="staffs">
                                            <div class="staffsinside">
                                                <div class="prof">
                                                    <img src="{{asset('public/assets/website/images/profile-icon-service.png')}}"> 
                                                    <div class="prof-cont">
                                                        <h3>Services <small>(Select any service to book)</small> </h3>
                                                        <div class="headRow mobileappointed clearfix" id="row2" >
                                                            <div class="appointment mobSevices whitebox col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Dental Consultation</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Pack</div>
                                                            </div>
                                                            <div class="appointment mobSevices col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Smile corrections</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Meeting</div>
                                                            </div>
                                                            <div class="appointment mobSevices col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Smile corrections</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Service</div>
                                                            </div>
                                                        </div>
                                                        <div class="headRow mobileappointed clearfix" id="row2" >
                                                            <div class="appointment mobSevices whitebox col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Dental Consultation</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Meeting</div>
                                                            </div>
                                                            <div class="appointment mobSevices col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Smile corrections</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Meeting</div>
                                                            </div>
                                                            <div class="appointment mobSevices col-sm-4">
                                                                <div class="pull-left">
                                                                    <p>Smile corrections</p>
                                                                    <span>30min-1h <label>$50</label> </span> 
                                                                </div>
                                                                <div class="pull-right">Pack</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="staffs">
                                            <div class="staffsinside">
                                                <div class="prof">
                                                    <img src="{{asset('public/assets/website/images/profile-icon-location.png')}}"> 
                                                    <div class="prof-cont">
                                                        <div class=" col-md-4">
                                                            <!-- <h3>Map and access information</h3>--> 
                                                            <h4>Smile Corrections</h4>
                                                            <p><img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" /> Lauren Drive, Madison, WI 53705 </p>
                                                            <h5>Transport</h5>
                                                            <p>Metro - Lauren Drive <br> RER - LaurenDrive </p>
                                                            <h5>Parking</h5>
                                                            <p>Grenelle 2 (surface) <br> Lauren Drive, Madision, WI 53705 </p>
                                                            <h5>Useful information</h5>
                                                            <p>Ground floor, Handicap access </p>
                                                        </div>
                                                        <div class=" col-md-4">
                                                            <h3>Contacts</h3>
                                                            <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-email.png')}}" /> EstherG@gmail.com </div>
                                                            <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-phone1.png')}}" /> 802-438-0497 </div>
                                                            <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" /> Lauren Drive, Madison, WI 53705 </div>
                                                            <div class=" flex break30px">
                                                                <div class="prof-cont">
                                                                    <h3>Payment mode</h3>
                                                                    <p> Cheques, Chash and Credit Cards</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-4 socials">
                                                            <h3>Social Medias</h3>
                                                            <div class="inf"> <a href="#" class="fa fa-facebook-official"></a> <a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-instagram"></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--====================================Modal Start ====================================--> 
        <!-- Add Appoitment --> 
        <div class="modal fade" id="myModaladdappoinment" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content--> 
                <div class="modal-content new-modalcustm">
                    <form name="add_appointmentm_form" id="add_appointmentm_form" method="post" action="" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                            <h4 class="modal-title"> Add Appointments</h4>
                        </div>
                        <div class="modal-body clr-modalbdy">
                            <!--<div class="row"> <div class="col-md-12"> <div class="form-group"> <div class="input-group"> <span class="input-group-addon"><i class="fa fa-users"></i></span> <div class="form-group nomarging custom-select color-b" > <select > <option>Client</option> </select> <div class="clearfix"></div> </div> </div> </div> </div> </div>--> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-users"></i></span> <input id="client" type="text" class="form-control" name="client" placeholder="Client"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cog"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Services</option>
                                                    <option>Resources</option>
                                                    <option>Meetings</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="row"> <div class="col-md-12"> <div class="form-group"> <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span> <div class="form-group nomarging custom-select color-b" > <select > <option>Staff</option> </select> <div class="clearfix"></div> </div> </div> </div> </div> </div>--> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span> <input id="staff" type="text" class="form-control" name="staff" placeholder="Staff"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="appointmentdate" type="text" class="form-control" name="date" placeholder="Date"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                   <!--<div class="form-group"> <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="appointmenttime" type="text" class="form-control" name="time" placeholder="Time"> </div> </div>--> 
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select id="appointmenttime" onmousedown="if (this.options.length > 8) {
                                                                                        this.size = 8;
                                                                                    }" onchange='this.size = 0;' onblur="this.size = 0;"> <?php echo get_times(); ?> </select> 
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <div class="form-group">
                                        <ul class="colors">
                                            <li class="bgred" onclick="activeColor(this);"></li>
                                            <li class="bgyellow" onclick="activeColor(this);"></li>
                                            <li class="bggrn" onclick="activeColor(this);"></li>
                                            <li class="bglightgrn" onclick="activeColor(this);"></li>
                                            <li class="bgblue active" onclick="activeColor(this);"></li>
                                        </ul>
                                        <h2>Set the Color</h2>
                                        <input id="" type="text" class="form-control" name="" placeholder="Type here" style="border-left:1px solid #ccc"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <input name="" type="checkbox" value=""> Send Email confirmation </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-center"> <button type="button" id="submit_appointmentm_form" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Add Client -->
        <div class="modal fade" id="myModaladdclient" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content-->
                <div class="modal-content new-modalcustm">
                    <form name="add_client_form" id="add_client_form" method="post" action="{{url('api/add_client')}}" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Client Form</h4>
                        </div>
                        <div class="modal-body clr-modalbdy">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="client_name" type="text" class="form-control" name="client_name" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input id="client_email" type="text" class="form-control" name="client_email" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="mobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="client_mobile" type="text" class="form-control" name="client_mobile" placeholder="Mobile" style="width: 92%;">               
                                        </div>
                                        <a style="position: absolute; right:15px; top:8px; font-size: 18px" role="button" data-toggle="collapse" data-target="#client_other_phone" id="client_more_phone"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row collapse" id="client_other_phone" >
                                <div class="col-md-12">
                                    <div class="form-group" id="home_phone_error">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="client_home_phone" type="text" class="form-control" name="client_home_phone" placeholder="Home Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="work_phone_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="client_work_phone" type="text" class="form-control" name="client_work_phone" placeholder="Work Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                            <!--<select class="form-control">
                                               <option>Category Name</option>
                                               </select>-->
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select>
                                                    <option>Select Category </option>
                                                    <option>Service </option>
                                                    <option>Pack Passes </option>
                                                    <option>Resource </option>
                                                    <option>Meetings </option>
                                                    <option>New Category </option>
                                                    <option>Category </option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Select Staff </option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <input id="name1" type="text" class="form-control" name="name" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o "></i></span>
                                            <input id="name1" type="text" class="form-control" name="name" placeholder="Timezone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group textarea-md"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            <textarea style="width: 100%" id="area" placeholder="Notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="" type="checkbox" value=""> Send Email confirmation
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalnewteam" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content-->
                <div class="modal-content new-modalcustm">
                    <form name="add_team_member_form" id="add_team_member_form" method="post" action="{{url('api/add_staff')}}" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Team Member</h4>
                        </div>
                        <div class="modal-body clr-modalbdy">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="fullname_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="staff_fullname" type="text" class="form-control" name="staff_fullname" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="username_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="staff_username" type="text" class="form-control" name="staff_username" placeholder="Username">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="email_error"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input id="staff_email" type="text" class="form-control" name="staff_email" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="mobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="staff_mobile" type="text" class="form-control" name="staff_mobile" placeholder="Mobile" style="width: 92%;">               
                                        </div>
                                        <a style="position: absolute; right:15px; top:8px; font-size: 18px" role="button" data-toggle="collapse" data-target="#other_phone" id="more_phone"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row collapse" id="other_phone" >
                                <div class="col-md-12">
                                    <div class="form-group" id="home_phone_error">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="staff_home_phone" type="text" class="form-control" name="staff_home_phone" placeholder="Home Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="work_phone_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input id="staff_work_phone" type="text" class="form-control" name="staff_work_phone" placeholder="Work Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group" id="category_error">
                                            <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="staff_category" id="staff_category" >
                                                    <option value="">Select Category </option>
<?php
if (!empty($basicdatas['category_list']))
    foreach ($basicdatas['category_list'] as $key => $value) {
        echo "<option value='" . $value->category_id . "'>" . $value->category . "</option>";
    }
?>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group textarea-md" id="expertise_error"> <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                                            <textarea style="width: 100%" name="staff_expertise" id="staff_expertise" placeholder="Expertise (i.e. Insomnia, Sleep disorder, Hyperactivity,...)"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group textarea-md" id="description_error"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            <textarea style="width: 100%" name="staff_description" id="staff_description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="borderbtn">
                                        <span class="custom-select-icon"><i class="fa fa-image"></i></span>
                                        <label class="margleft30">Add picture</label> 
                                        <div class="add-gly">
                                            <div class="add-picture"><img id="blah" src="#" alt="" style="display:none;" width="60px" height="60px" /></div>
                                            <!--<div class="add-picture-text">UPLOAD PICTURE</div>-->
                                            <input type="file" name="staff_profile_picture" id="staff_profile_picture" style="margin: 30px 0; padding: 0 4px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="staff_send_email" type="checkbox" value="1"> Login details will send to the Team member
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary butt-next" type="submit" style="margin: 0px auto 0; width: 150px; display: block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalregular" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Add Schedule for Cheb</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="regular-frmbx">
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1"> <label for="styled-checkbox-1">Mon</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2"> <label for="styled-checkbox-2">Tue</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-3" type="checkbox" value="value3"> <label for="styled-checkbox-3">Wed</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-4" type="checkbox" value="value4"> <label for="styled-checkbox-4">Thu</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-5" type="checkbox" value="value5"> <label for="styled-checkbox-5">Fri</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-6" type="checkbox" value="value6"> <label for="styled-checkbox-6">Sat</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"> <input class="styled-checkbox" id="styled-checkbox-7" type="checkbox" value="value7"> <label for="styled-checkbox-7">Sun</label></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="tocls">To</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalirregular" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Add Schedule</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="regular-frmbx">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <span class="label label-default">9am - 5pm</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="staff-plus"><a href="#"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" /></a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Date</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mlf-30"> <span class="child-outline child-outline--dark"></span> Repeat on other days </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mlf-30"> <span class="child-outline child-outline--dark"></span> All Services </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group"> <input name="" type="checkbox" value=""> <label>This time will be opened irrespective of staff availability in future.</label> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group"> <a href="#"><i class="fa fa-plus"></i> Select Staff</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModaledit" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Edit Schedule Group</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="regular-frmbx">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span> <input id="date" class="form-control" name="date" placeholder=" Schedule Name" type="text"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="date" class="form-control" name="date" placeholder="Start Date" type="text"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right"> <small>Last Forever or <a href="#">Set End Date</a></small> </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Update</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalnew-schedule" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Add Schedule Group</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="regular-frmbx">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span> <input id="date" class="form-control" name="date" placeholder=" Schedule Name" type="text"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="date" class="form-control" name="date" placeholder="Start Date" type="text"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right"> <small>Last Forever or <a href="#">Set End Date</a></small> </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Create</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModallist-time" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Add Schedule for Cheb</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="regular-frmbx">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <span class="label label-default">9am - 5pm</span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>End Time</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="staff-plus"><a href="#"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" /></a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 
                                            <div class="form-group nomarging custom-select color-b" >
                                                <select >
                                                    <option>Start Date</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mlf-30"> <span class="child-outline child-outline--dark"></span> Repeat on other days </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mlf-30"> <span class="child-outline child-outline--dark"></span> All Services </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group"> <input name="" type="checkbox" value=""> <label>This time will be opened irrespective of staff availability in future.</label> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group"> <a href="#"><i class="fa fa-plus"></i> Select Staff</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalblockdate" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content--> 
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Block Date</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class='col-sm-12'>
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="date" type="text" class="form-control" name="date" placeholder="Date"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-ban"></i></span> <input id="block" type="text" class="form-control" name="block" placeholder="Block for"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-question-circle-o"></i></span> <input id="reasons" type="text" class="form-control" name="reasons" placeholder="Reasons"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span class="custom-select-icon"><i class="fa fa-file"></i></span> <label class="margleft25">Note</label> 
                                    <div class="niceditor"> <textarea style="width: 100%" id="area1"></textarea> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</a> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="myModalblocktime" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content--> 
                <div class="modal-content new-modalcustm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Block Time</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="startdate" type="text" class="form-control" name="startdate" placeholder="Start Time"> </div>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="enddate" type="text" class="form-control" name="enddate" placeholder="End Time"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-sm-12'>
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="date" type="text" class="form-control" name="date" placeholder="Date"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-ban"></i></span> <input id="block" type="text" class="form-control" name="block" placeholder="Block for"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-question-circle-o"></i></span> <input id="reasons" type="text" class="form-control" name="reasons" placeholder="Reasons"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span class="custom-select-icon"><i class="fa fa-file"></i></span> <label class="margleft25">Note</label> 
                                    <div class="niceditor"> <textarea style="width: 100%" id="area2"></textarea> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</a> </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================================Modal End =========================================--> 
        
    <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script>
    <script src="{{asset('public/assets/website/js/script.js')}}"></script>
    <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
    <script src="{{asset('public/assets/website/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/website/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/website/js/owl.carousel.js')}}"></script>
    <script src="{{asset('public/assets/website/js/jquery.autocomplete.min.js')}}"></script> <!-- Sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> <!-- jQuery Cookie -->
    <script src="{{asset('public/assets/website/js/jquery.cookie.min.js')}}"></script>
    <!-- Form Validation -->
    <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>

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
    <script type="text/javascript">
        function ShowPopup() {
            $("#popup").fadeToggle();
        }

        function togglebtn(obj) {
            $(obj).toggleClass("active");
            $(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");
            $(".mobSevices ul li a.active").find("i").not($(obj).find("i")).removeClass("fa-toggle-on").addClass("fa-toggle-off");
            $(".mobSevices ul li a.active").not($(obj)).removeClass("active");
        }

        function showUl(obj) {
            $(obj).find("ul").fadeToggle();
            $(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();
        }
        $(document).ready(function () {
        })
    </script> <!-- slide menu script -->
    <script src="{{asset('public/assets/website/js/menu.js')}}"></script>
    <script>
        /** * Slide left instantiation and action. */
        var slideLeft = new Menu({
            wrapper: '#o-wrapper',
            type: 'slide-left',
            menuOpenerClass: '.c-button',
            maskId: '#c-mask'
        });
        var slideLeftBtn = document.querySelector('#c-button--slide-left');
        slideLeftBtn.addEventListener('click', function (e) {
            e.preventDefault;
            slideLeft.open();
        }); /** * Slide right instantiation and action. */
        var slideRight = new Menu({
            wrapper: '#o-wrapper',
            type: 'slide-right',
            menuOpenerClass: '.c-button',
            maskId: '#c-mask'
        });
        var slideRightBtn = document.querySelector('#c-button--slide-right');
        slideRightBtn.addEventListener('click', function (e) {
            e.preventDefault;
            slideRight.open();
        }); /** * Slide Alert instantiation and action. */
        var slideAlert = new Menu({
            wrapper: '#o-wrapper',
            type: 'slide-alert',
            menuOpenerClass: '.c-button',
            maskId: '#c-mask'
        });
        var slideAlertBtn = document.querySelector('#c-button--slide-alert');
        slideAlertBtn.addEventListener('click', function (e) {
            e.preventDefault;
            slideAlert.open();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("ul.menu li a").click(function () {
                $(this).addClass("active");
                $(("li a.active")).not($(this)).removeClass("active");
            });
            $(".closePopUp").click(function () {
                $(".profilepopup").fadeOut();
                $('body').css('overflow-y', 'auto');
            });
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true
                    },
                    600: {
                        items: 5,
                        nav: true
                    },
                    1000: {
                        items: 10,
                        nav: false,
                        loop: true,
                        margin: 30
                    }
                }
            });
        });

        function ShowPopup() {
            $("#popup").fadeToggle();
        }

        function showSqeeder() {
            $(".profilepopup").fadeIn();
            $('body').css('overflow-y', 'hidden');
        }
    </script>
    <script src="{{asset('public/assets/website/js/jquery.nice-select.min.js')}}"></script> 
    <!-- Image Preview -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').show();
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#blah').hide();
            }
        }
        $("#staff_profile_picture").change(function () {
            readURL(this);
        });
    </script>
    
    <script>
        // Add New Staff (New Member) // 
        /*$("#add_team_member_form").bind('click',function(e){
         e.preventDefault();
         $('#add_team_member_form').submit();
         });*/

        $('#add_team_member_form').validate({
            rules: {
                staff_fullname: {
                    required: true
                },
                staff_username: {
                    required: true
                },
                staff_email: {
                    required: true,
                    email: true
                },
                staff_mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                staff_description: {
                    required: true
                }
            },
            messages: {
                staff_fullname: {
                    required: 'Please enter fullname'
                },
                staff_username: {
                    required: 'Please enter username'
                },
                staff_email: {
                    required: 'Please enter email',
                    email: 'Please enter proper email'
                },
                staff_mobile: {
                    required: 'Please enter mobile no',
                    number: 'Please enter proper mobile no',
                    minlength: 'Please enter minimum 10 digit mobile no',
                    maxlength: 'Please enter maximum 10 digit mobile no'
                },
                staff_description: {
                    required: 'Please enter description'
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "staff_fullname") {
                    error.insertAfter($('#fullname_error'));
                } else if (element.attr("name") == "staff_username") {
                    error.insertAfter($('#username_error'));
                } else if (element.attr("name") == "staff_email") {
                    error.insertAfter($('#email_error'));
                } else if (element.attr("name") == "staff_mobile") {
                    error.insertAfter($('#mobile_error'));
                } else if (element.attr("name") == "staff_description") {
                    error.insertAfter($('#description_error'));
                }
            },
            submitHandler: function (form) {
                var data = $(form).serializeArray();
                data = addCommonParams(data);
                var files = $("#add_team_member_form input[type='file']")[0].files;
                var form_data = new FormData();
                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        form_data.append('staff_profile_picture', files[i]);
                    }
                }
                // append all data in form data 
                $.each(data, function (ia, l) {
                    form_data.append(l.name, l.value);
                });
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: form_data,
                    dataType: "json",
                    processData: false, // tell jQuery not to process the data 
                    contentType: false, // tell jQuery not to set contentType 
                    success: function (response) {
                        console.log(response); //Success//
                        if (response.response_status == 1) {
                            $(form)[0].reset();
                            $('#myModalnewteam').modal('hide');
                            swal('Success!', response.response_message, 'success');
                            location.reload();
                        } else {
                            swal('Sorry!', response.response_message, 'error');
                        }
                    },
                    beforeSend: function () {
                        $('.animationload').show();
                    },
                    complete: function () {
                        $('.animationload').hide();
                    }
                });
            }
        });
        
        var countries = [{
                value: 'Pradipta Barik',
                data: '1'
            }, {
                value: 'Rajib Jana',
                data: '2'
            }, {
                value: 'Souvik Bose',
                data: '3'
            }, {
                value: 'Ayan Banerjee',
                data: '4'
            }, {
                value: 'Sudip Ghosh',
                data: '5'
            }, {
                value: 'Monaj Das',
                data: '6'
            }, {
                value: 'Mrinmoy Das',
                data: '7'
            }];
        $('#client').autocomplete({
            lookup: countries
        });
        $('#staff').autocomplete({
            lookup: countries
        });
    </script>
    <script>
        $('.carousel').carousel({
            interval: false
        });
    </script>
    
    <?php
    if (isset($professions) && $professions) {
    ?>
    <script>
            var profession = [
            <?php
            foreach ($professions as $prof) {
            ?>
                    {
                        value: '<?= $prof->profession; ?>',
                        data: '<?= $prof->profession_id; ?>'
                    },
            <?php
            }
            ?>
            ];
            $('#profession').autocomplete({
                lookup: profession,
            });
    </script>
    <?php
    }
    ?>
    
    <script src="{{asset('public/assets/website/js/ncrtsdev.js')}}"></script>
    <script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
    
    @yield('custom_js') 
    
</body>
</html>