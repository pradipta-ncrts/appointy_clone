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
      <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet"> -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
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
      <link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('public/assets/website/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/website/css/autocompletestyles.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-select.min.css')}}" />
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
      <link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-timepicker.min.css')}}" />

      <link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>

      <script type="text/javascript">
		  var authDatas={user_no:0}; 
		  var device_token_key="<?php echo Session::getId()?>"; 
		  var baseUrl ="<?php echo url('')?>"; 
	  </script> 
     <style type="text/css">
      .offscreen {
       position: absolute;
       left: -999em;
       }
       .filter-option{margin-top:14px 0 0 0;}
     </style>
	  @yield('custom_css') 
   </head>
   <body>
      <?php 
      $basicdatas = App\Http\Controllers\BaseApiController::category_list(); 
      function get_times( $default = '00:00', $interval = '+30 minutes' ) { 
         $output = '<option value="">Select Time</option>'; 
         $current = strtotime( '00:00' ); 
         $end = strtotime( '23:59' ); 
         while( $current <= $end ) 
         { 
            $time = date( 'h:i A', $current ); 
            $sel = ( $time == $default ) ? ' selected' : ''; 
            $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>'; 
            $current = strtotime( $interval, $current ); 
         } 
         return $output; 
      } 
      $timezone = App\Http\Controllers\BaseApiController::time_zone(); 
      $services_list = App\Http\Controllers\BaseApiController::services_list();
      $clients_list = App\Http\Controllers\BaseApiController::clients_list();
      $stuffs_list = App\Http\Controllers\BaseApiController::stuffs_list(); 
      $currency_list = App\Http\Controllers\BaseApiController::currency_list(); 
      $user_new_category = App\Http\Controllers\BaseApiController::user_new_category(); 
      $mysquder_page_inner = App\Http\Controllers\BaseApiController::mysquder_page_inner();
      $inner_user_details = $mysquder_page_inner['inner_user_details'];
      $inner_staff_list = $mysquder_page_inner['inner_staff_list'];
      $inner_service_list = $mysquder_page_inner['inner_service_list']; 
      /*echo "<pre>";
      print_r($inner_user_details); die();*/
      ?> 
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
                     <div class="dropdown-menu pm-position" aria-labelledby="dropdownMenuButton"> 
                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModaladdappoinment"> <i class="fa fa-calendar" aria-hidden="true"></i> Add Appointments</a> 
                         <a class="dropdown-item" data-toggle="modal" data-target="#myModaladdclient"> <i class="fa fa-users" aria-hidden="true"></i>Add Clients</a> 
                         <a class="dropdown-item" data-toggle="modal" data-target="#myModalnewteam"> <i class="fa fa-cog" aria-hidden="true"></i> New Team Member</a> 
                         <!--<a class="dropdown-item" data-toggle="modal" data-target="#myModalServices"> <i class="fa fa-id-card " aria-hidden="true"></i>Services</a>-->
                         <a class="dropdown-item" href="{{url('create_new_service')}}" > <i class="fa fa-id-card " aria-hidden="true"></i>Services</a>
                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalblockdate"> <i class="fa fa-user" aria-hidden="true"></i> Block Date</a> 
                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalblocktime"> <i class="fa fa-question-circle " aria-hidden="true"></i> Block Time</a> 
                         <a class="dropdown-item" href="#" > <i class="fa fa-user" aria-hidden="true"></i> Invitee's</a> </div>
                  </div>
                  <a id="c-button--slide-right" class="c-button quick-add"><i class="flaticon-four-squares"></i></a> 
                  <div class="dropdown prof-menu" href="#">
                     <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <?php
                        //echo '<pre>'; print_r($inner_user_details); exit;
                        if($inner_user_details->user_type == 1){
                            $image =  $inner_user_details->profile_perosonal_image ? 'profile_perosonal_image/'.$inner_user_details->profile_perosonal_image : asset('public/assets/website/images/user-img.png');
                        } else {
                            $image = $inner_user_details->profile_image ? 'profile_image/'.$inner_user_details->profile_image : asset('public/assets/website/images/user-img.png');
                        }
                        if($inner_user_details->profile_perosonal_image || $inner_user_details->profile_image)
                        {
                        ?>
                        <img class="user-pic" src="{{asset('public/image/')}}/<?=$image;?>">
                        <?php
                        }
                        else
                        {
                        ?>
                        <img class="user-pic" src="<?=$image;?>">
                        <?php
                        }
                        ?>
                     </a> 
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#"   data-toggle="modal" data-target="#myModalsharelinks"> <i class="fa fa-share-alt" aria-hidden="true"></i> Share links</a> <a class="dropdown-item" href="{{ url('calendar') }}"> <i class="fa fa-calendar" aria-hidden="true"></i> Calendar Connections</a> <a class="dropdown-item" href="{{ url('profile-settings') }}"> <i class="fa fa-cog" aria-hidden="true"></i> Profile settings</a> <a class="dropdown-item" href="#"> <i class="fa fa-id-card " aria-hidden="true"></i> Memebership</a><a class="dropdown-item" href="{{ url('invitees') }}"> <i class="fa fa-user" aria-hidden="true"></i> Invitees</a> <a class="dropdown-item" href="{{ url('staff-details') }}"> <i class="fa fa-user" aria-hidden="true"></i> Users</a> <a class="dropdown-item" href="{{ url('help') }}"> <i class="fa fa-question-circle " aria-hidden="true"></i> Help</a> <a class="dropdown-item" href="{{ url('/logout') }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> </div>
                  </div>
                  <div class="main-nav">
                     <!--<a href="#" class="settings">Settings</a> --> <a href="{{ url('client-database') }}" class="sm"><i class="flaticon-multiple-users-silhouette"></i> <span>Clients</span></a> <a href="{{ url('reports') }}" class="sm"><i class="flaticon-progress-report"></i> <span>Reports</span></a> <a href="{{ url('gift-certificates') }}"><i class="flaticon-megaphone"></i> <span>Marketing</span></a> <a href="{{ url('booking-list/all') }}"><i class="flaticon-calendar"></i><span> <span>Booking List</span></a><a href="{{ url('calendar') }}"><i class="flaticon-calendar"></i><span> <span>Calendar</span></a><a href="{{ url('dashboard') }}"><i class="flaticon-dashboard"></i> <span>Dashboard</span></a> 
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
            <!--<li class="c-menu__item"><a href="{{ url('privacy-settings') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/privacy.png')}}" alt=""> Privacy Settings</a> <span>Control your information is... </span> </li>-->
            <li class="c-menu__item"><a href="{{ url('reports') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/statistics.png')}}" alt=""> Reports</a> <span>Add, edit or delete statistics</span> </li>
            <li class="c-menu__item"><a href="{{ url('settings-business-hours') }}/services" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/business.png')}}" alt=""> Business Hours</a> <span>Link service to business hours</span> </li>
            <li class="c-menu__item"><a href="{{ url('business-contact-info') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/businessdetails.png')}}" alt=""> Business Details</a> <span>Address, Timezone, Currency </span> </li>
            <li class="c-menu__item"><a href="{{ url('booking-rules') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/booking-rules.png')}}" alt=""> Booking Rules</a> <span>Control how, what, when</span> </li>
            <li class="c-menu__item"><a href="{{ url('notification-settings') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/notification.png')}}" alt=""> Notification</a> <span>Control email and text alerts</span> </li>
            <li class="c-menu__item"><a href="{{ url('email-customisation') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/notification.png')}}" alt=""> Email Customisation </a> <span>Control email and text alerts</span> </li>
            <li class="c-menu__item"><a href="#" onclick="showSqeeder();" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/sqeedr.png')}}" alt=""> Your Squeedr Page</a> <span>Add, edit or delete info</span> </li>
            <li class="c-menu__item"><a href="{{ url('event-viewer') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/settings-icon/event-viewer.png')}}" alt=""> Event Viewer</a> <span>View and control events</span> </li>
         </ul>
      </div>
      <!--End /c-menu slide-left --> <!-- /c-menu slide-right --> 
      <div id="c-menu--slide-right" class="c-menu c-menu--slide-right">
         <div class="slide-rgt"><img src="{{asset('public/assets/website/images/quick-icon-rgt.png')}}" alt=""> Quick Start</div>
         <button class="c-menu__close"><img src="{{asset('public/assets/website/images/cross-slide.png')}}" alt="" /></button> 
         <ul class="c-menu__items">
            <li class="c-menu__item"><a href="{{ url('services/all') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon1.png')}}" alt=""> Room, Services and Packs</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
            <!-- <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon2.png')}}" alt=""> Current Appointments</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li> -->
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon3.png')}}" alt=""> Book with google</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
            <li class="c-menu__item"><a href="{{ url('invoice') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon4.png')}}" alt=""> PrePayment Option</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
            <li class="c-menu__item"><a href="{{ url('invite-contacts') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon5.png')}}" alt=""> Import & Invite Contacts</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
            <li class="c-menu__item"><a href="{{ url('add-location') }}" class="c-menu__link"><img src="{{asset('public/assets/website/images/slide-rgt-icon6.png')}}" alt=""> Add Location</a> <span>There are many varitions of passages of Lorem Ipsum available</span> </li>
         </ul>
      </div>
      <!--End /c-menu slide-right --> 
      <div id="c-menu--slide-alert" class="c-menu c-menu--slide-right alert-slide" >
         <!-- <div class="dropdown custm-uperdrop conn-drop">
            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Connected App & Devices <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button> 
            <ul class="dropdown-menu ch-p">
               <li><a href="#">Connected <strong>Apps</strong></a></li>
            </ul>
         </div> -->
         <div class="slide-rgt"><img src="{{asset('public/assets/website/images/icon-bell.png')}}" alt="">Alert</div>
         <button class="c-menu__close"><img src="{{asset('public/assets/website/images/cross-slide.png')}}" alt="" /></button> 
         <ul class="nav nav-tabs1">
            <li class="active"><a data-toggle="tab" href="#tab1">Booking Status</a></li>
            <li><a data-toggle="tab" href="#tab2" class="notification-profile-info">Profile</a></li>
            <li><a data-toggle="tab" href="#tab3" class="notification-update">Update <img src="{{asset('public/assets/website/images/icon-squeedr.png')}}" height="20" style="vertical-align: middle;"></a></li>
            <li><a data-toggle="tab" href="#tab4" class="notification-feedback">Feedback</a></li>
         </ul>
         <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
               <div class="noti" id="get-booking-notify-list">
               </div>
            </div>
            <div id="tab2" class="tab-pane fade in ">
               <div class="noti" id="get-notification-profile-info">
                  
               </div>
            </div>
            <div id="tab3" class="tab-pane fade in ">
               <div class="noti" id="get-notification-update">
                 <!-- <h2 class="app-update">Update <img src="{{asset('public/assets/website/images/icon-squeedr.png')}}"></h2>-->
                  <!-- <div class="feedb">
                     <div class="feedb-list">
                        <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}"> 
                        <p> <strong>Tell About App</strong><br> You have listed your job! Now add a profile photo to help others recognize you.</p>
                        <div class="clearfix"></div>
                     </div>
                  </div> -->
               </div>
            </div>
            <div id="tab4" class="tab-pane fade in ">
               <div class="noti">
                  <div class="feedb" id="get-notification-feedback">
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--End /c-menu slide-right1 --> 
      <div id="c-mask" class="c-mask"></div>
      <!-- /c-mask --> 
      <div class="profilepopup">
         <div class="container-custom">
           <div class="profile">
             <a class="closePopUp"> <img src="{{asset('public/assets/website/images/popup-close.png')}}"/></a>
             <div class="row">
               <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                 <div class="profileInside">
                   <div class="banner-top">
                     <div class="img-banner-parent">

                        <div class="opacitybx">
                            <ul class="breadcrumb">
                                <li><a href="{{ url('client/login') }}">Client Login</a></li>
                                <li><a href="{{ url('client/registration') }}">Client Registration</a></li>
                            </ul>
                        </div>

                       <div class="img-banner">
                         <?php
                          if($inner_user_details->timeline_image)
                          {
                          ?>
                         <img src="{{asset('public/')}}/image/timeline_image/<?=$inner_user_details->timeline_image;?>" class="img-responsive"/>
                         <?php
                          }
                          else
                          {
                          ?>
                         <img src="{{asset('public/assets/website/images/img-banner.jpg')}}" class="img-responsive"/>
                         <?php
                           }
                         ?>
                         <div class="blackbox">
                           <div class="lefttext">
                             <h6>
                               <?=$inner_user_details->user_type==1 ? $inner_user_details->name :  $inner_user_details->business_name;?>
                               <br/>
                               <span>
                               <?=$inner_user_details->prof ? $inner_user_details->prof : "No data found";?>
                               </span> </h6>
                           </div>
                           <!-- <a class="btn-select">Select a service <i class=" fa fa-caret-down"></i></a> --> </div>

                         
                         <!-- <a class="btn btn-custom">Book Now</a>--> 
                         
                       </div>
                     </div>
                     <div class="dropdown pull-right mysl-drp">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select a service
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                           <?php
                            if(empty($inner_service_list))
                            {
                            ?>
                              <li><a href="#">No service found</a></li>
                            <?php
                            }
                            foreach ($inner_service_list as $key => $details) 
                            {
                            ?>
                              <li><a href="{{url('/client/service-details/'.$details->service_id)}}"><?=$details->service_name;?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                      </div>
                     <?php
                     if($inner_user_details->user_type==1)
                     {
                        $url = asset('public/').'/image/profile_perosonal_image/'.$inner_user_details->profile_perosonal_image;
                        if($inner_user_details->profile_perosonal_image && file_exists($url))
                        {
                        ?>
                     <img src="{{asset('public/')}}/image/profile_perosonal_image/<?=$inner_user_details->profile_perosonal_image;?>" class="profilepic"/>
                     <?php 
                      }
                      else
                      {
                      ?>
                     <img src="{{asset('public/assets/website/images/profile-pic.jpg')}}" class="profilepic" />
                     <?php
                     }
                     ?>
                     <?php
                     }
                     else
                     {
                         if($inner_user_details->profile_image)
                         {
                     ?>
                     <img src="{{asset('public/')}}/image/profile_perosonal_image/<?=$inner_user_details->profile_image;?>" class="profilepic"/>
                     <?php 
                         }
                         else
                         {
                      ?>
                     <img src="{{asset('public/assets/website/images/profile-pic.jpg')}}" class="profilepic" />
                     <?php
                         }
                     }
                     ?>
                     <ul class="profilelinks">
                        <li><a href="#service_link">Services</a> </li>
                        <li><a href="#expertise_link">Expertise </a> </li>
                        <li><a href="#presentation_link">Presentation </a> </li>
                        <li><a href="#contact_link">Contacts</a> </li>
                     </ul>
                   </div>
                   <div class="staffs">
                     <div class="staffsinside">
                       <div class="headbar"> <img src="{{asset('public/assets/website/images/popup-staffs.png')}}"/>
                         <h4>Staffs</h4>
                       </div>
                       <div class="owl-carousel owl-theme owl-custom">
                     <?php
                     foreach ($inner_staff_list as $key => $value)
                     {
                     ?>  
                         <div class="item">
                           <?php
                            if($value->staff_profile_picture != '')
                            { 
                            ?>
                           <img class="user-pic" src="<?php echo $value->staff_profile_picture;?>" width="35px" height="35px" />
                           <?php
                           } 
                           else
                           {
                           ?>
                           <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" />
                           <?php
                            } 
                           ?>
                           <span>
                           <?=$value->full_name;?>
                           </span> </div>
                         <?php
                           }
                           ?>
                       </div>
                     </div>
                   </div>
                   <div class="staffs" id="presentation_link">
                     <div class="staffsinside">
                       <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-presentation.png')}}">
                         <div class="prof-cont">
                           <h3>Presentation</h3>
                           <p>
                             <?=$inner_user_details->presentation ? $inner_user_details->presentation : "No data found";?>
                             <!-- <a href="#">more</a> --> </p>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="staffs" id="expertise_link">
                     <div class="staffsinside">
                       <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-expertise.png')}}">
                         <div class="prof-cont">
                           <h3>Expertise</h3>
                           <p>
                             <?php
                             if(!empty($inner_user_details->expertise))
                             {
                                $expertise = explode(',', $inner_user_details->expertise);
                                foreach ($expertise as $key => $value)
                                {
                                ?>
                             <span class="expt">
                             <?=$value;?>
                             </span>
                             <?php
                                }
                             }
                             else
                             {
                                echo "No expertise found.";
                             }
                             ?>
                           </p>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="staffs" id="service_link">
                     <div class="staffsinside">
                       <div class="prof"> <img src="{{asset('public/assets/website/images/srvice-icn.png')}}">
                         <div class="prof-cont">
                           <h3>Services <small>(Select any service to book)</small> </h3>
                           <div class="headRow mobileappointed clearfix" id="row2">
                             <?php
                               if(empty($inner_service_list))
                               {
                                  echo "<h2>No service found!</h2>";
                               }
                               foreach ($inner_service_list as $key => $details) 
                               {
                               ?>
                             <div class="appointment mobSevices col-sm-4">
                               <div class="pull-left">
                                 <p>
                                   <?=$details->service_name;?>
                                 </p>
                                 <span>
                                 <?=$details->duration;?>
                                 min
                                 <label>
                                   <?=$details->currency;?>
                                   <?=$details->duration ? $details->cost : '';?>
                                 </label>
                                 </span> </div>
                               <div class="pull-right">
                                 <?=$details->cat;?>
                               </div>
                             </div>
                             <?php
                               }
                               ?>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="staffs" id="contact_link">
                     <div class="staffsinside">
                       <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">
                         <div class="prof-cont">
                           <div class=" col-md-4"> 
                             <!-- <h3>Map and access information</h3>-->
                             <h5 style="margin-top:0;">Business Information</h5>
                             <p> <?=$inner_user_details->business_description ? strip_tags($inner_user_details->business_description) : "No data found";?> </p>
                             <h5>Smile Corrections</h5>
                             <p><img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" />
                               <?=$inner_user_details->business_location ? $inner_user_details->business_location : "No data found";?>
                             </p>
                             <h5>Transport</h5>
                             <p>
                               <?=$inner_user_details->transport ? $inner_user_details->transport : "No data found";?>
                             </p>
                             <h5>Parking</h5>
                             <p>
                               <?=$inner_user_details->parking ? $inner_user_details->parking : "No data found";?>
                             </p>
                           </div>
                           <div class=" col-md-4">
                             <h5 style="margin-top:0;">Contacts</h5>
                             <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-email.png')}}" />
                               <?=$inner_user_details->email ? $inner_user_details->email : "No data found";?>
                             </div>
                             <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-phone1.png')}}" />
                               <?=$inner_user_details->mobile ? $inner_user_details->mobile : "No data found";?>
                             </div>
                             <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" /> Lauren Drive, Madison, WI 53705 </div>
                             <div class=" flex break30px">
                               <div class="prof-cont">
                                 <h5>Payment mode</h5>
                                 <p>
                                   <?=$inner_user_details->payment_mode ? $inner_user_details->payment_mode : "No data found";?>
                                 </p>
                               </div>
                             </div>
                           </div>
                           <div class=" col-md-4 socials">
                            <div class="map-yurpage">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2531.268456989167!2d-89.4622255849775!3d43.071637097859536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8807ac17ef4bd095%3A0xc0813a752fde03f7!2sMadison%2C+WI+53705%2C+USA!5e1!3m2!1sen!2sin!4v1539428284980" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                           </div>
                           
                           
                           
                         </div>
                       </div>
                     </div>
                   </div>

                   <div class="col-md-12">
                           <div class="yurpage-ftr">
                            <ul>
                             <?php
                             foreach ($inner_staff_list as $key => $value)
                             {
                               if($value->city)
                               {
                             ?>
                              <li><a href="#"><?=$value->city;?></a></li>
                             <?php
                               }
                             }
                             ?>
                            </ul>
                           </div>
                             <div class="yurpage-social"> 
                             <ul>
                             <li><a target="_blank" href="<?=$inner_user_details->facebook_link ? $inner_user_details->facebook_link : "";?>" class="fa fa-facebook"></a></li> 
                             <li><a target="_blank" href="<?=$inner_user_details->twitter_link ? $inner_user_details->twitter_link : '';?>" class="fa fa-twitter"></a></li>
                             <li><a target="_blank" href="<?=$inner_user_details->linked_in_link ? $inner_user_details->linked_in_link : '';?>" class="fa fa-instagram"></a></li>
                             <!-- <li><a target="_blank" href="" class="fa fa-skype"></a></li> -->
                             </ul>
                             </div>
                           </div>

                           
                 </div>
               </div>
             </div>
           </div>
         </div>
      </div>
      <!--====================================Modal area start ====================================--> 
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
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input id="client_name" type="text" class="form-control" name="client_name" placeholder="Full Name">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="clientemail_error"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                              <input id="client_email" type="text" class="form-control" name="client_email" placeholder="Email Address">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="clientmobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
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

                  <?php /* <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                              <!--<select class="form-control">
                                 <option>Category Name</option>
                                 </select>-->
                              <div class="form-group nomarging color-b" >
                                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client_category" id="client_category" >
                                    <option value="">Select Category </option>
                                    <?php
                                    if(!empty($basicdatas['category_list']))
                                    foreach ($basicdatas['category_list'] as $key => $value)
                                    {
                                        echo "<option value='".$value->category_id."'>".$value->category."</option>";
                                    }
                                    ?>
                                  </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> */ ?>

                  <!-- <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <div class="form-group nomarging color-b" >
                                 <select >
                                    <option>Select Staff </option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group"> <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                              <div id="locationField">
                                <input id="autocomplete" placeholder="Address" onFocus="geolocate()" type="text" class="form-control" name="client_address"></input>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group"> 
                              <span class="input-group-addon"><i class="fa fa-clock-o "></i></span>
                              <!--<select class="form-control">
                                 <option>Category Name</option>
                                 </select>-->
                              <div class="form-group nomarging color-b" >
                                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client_timezone" id="client_timezone" >
                                    <option value="">Select Timezone </option>
                                    <?php
                                    foreach($timezone as $tzone)
                                    {
                                    ?>
                                    <option value="<?=$tzone['zone'] ?>">
                                      <?=$tzone['diff_from_GMT'] . ' - ' . $tzone['zone'] ?>
                                    </option>
                                    <?php
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
                           <div class="input-group textarea-md"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                              <textarea style="width: 100%" name="client_note" id="client_note" placeholder="Client Note"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <input name="client_send_email" id="client_send_email" type="checkbox" value="1"> Send Email confirmation
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
                           <div class="input-group" id="category_error">
                              <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                              <div class="form-group nomarging color-b" >
                                  <select class="selectpicker" name="staff_type" id="staff_type" >
                                    <option value="1">Manager</option>
                                    <option value="2">Staff</option>
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
                              <div class="form-group nomarging color-b" >
                                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="staff_category" id="staff_category" >
                                    <option value="">Select Category </option>
                                    <?php
                                    if(!empty($basicdatas['category_list']))
                                    foreach ($basicdatas['category_list'] as $key => $value)
                                    {
                                        echo "<option value='".$value->category_id."'>".$value->category."</option>";
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
                              <input type="file" name="staff_profile_picture" id="staff_profile_picture" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
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
            <form name="add_staff_availability_form" id="add_staff_availability_form" method="post" action="{{url('api/add_staff_service_availability')}}">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  <h4 class="modal-title">Add Schedule</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                  <div class="regular-frmbx">
                    <?php
                    $weekdays = array('1'=>'MON','2'=>'TUE','3'=>'WED','4'=>'THU','5'=>'FRI','6'=>'SAT','7'=>'SUN');
                    foreach($weekdays as $key=>$val){
                    ?>
                        <div class="row">
                            <div class="col-md-3"> <input class="styled-checkbox" name="day[]" id="styled-checkbox-{{$key}}" type="checkbox" value="{{$key}}"> <label for="styled-checkbox-{{$key}}">{{$val}}</label></div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <div class="form-group nomarging color-b" >
                                    <!--<select >
                                        <option>Start Time</option>
                                    </select>-->
                                    <input class="form-control availability_start_time" name="availability_start_time[]" id="availability_start_time_{{$key}}" type="text" value="" disabled="">
                                    <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="tocls">To</div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <div class="form-group nomarging color-b" >
                                    <!--<select >
                                        <option>End Time</option>
                                    </select>-->
                                    <input class="form-control availability_end_time" name="availability_end_time[]" id="availability_end_time_{{$key}}" type="text" value="" disabled="">
                                    <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="mlf-30" id="select_service" style="cursor:pointer"> <span class="child-outline child-outline--dark"></span> <span id="select_services">SELECT SERVICE<span>  </div>
                           <input type="hidden" name="service_ids" id="service_ids" value="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</button> </div>
               </div>
            </form>
            </div>
         </div>
      </div>

      <div class="modal fade" id="myModalregularShedule" role="dialog">
         <div class="modal-dialog modal-md">
            <div class="modal-content new-modalcustm">
            <form name="update_staff_availability_form" id="update_staff_availability_form" method="post" action="{{url('api/update_staff_availability_form')}}">
               <input type="hidden" name="stuff_id" value="" id="update_staff_availability_staff_id">
               <input type="hidden" name="service_id" value="" id="update_staff_availability_service_id">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  <h4 class="modal-title">Edit Schedule</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                  <div class="regular-frmbx">
                    <?php
                    $weekdays = array('1'=>'MON','2'=>'TUE','3'=>'WED','4'=>'THU','5'=>'FRI','6'=>'SAT','7'=>'SUN');
                    foreach($weekdays as $key=>$val){
                    ?>
                        <div class="row">
                            <div class="col-md-3"> <input class="styled-checkbox-update" name="day[]" id="styled-checkbox-update-{{$key}}" type="checkbox" value="{{$key}}"> <label for="styled-checkbox-update-{{$key}}">{{$val}}</label></div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <div class="form-group nomarging color-b" >
                                    <!--<select >
                                        <option>Start Time</option>
                                    </select>-->
                                    <input class="form-control availability_start_time" name="availability_update_start_time[]" id="availability_update_start_time_{{$key}}" type="text" value="" disabled="">
                                    <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="tocls">To</div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <div class="form-group nomarging color-b" >
                                    <!--<select >
                                        <option>End Time</option>
                                    </select>-->
                                    <input class="form-control availability_end_time" name="availability_update_end_time[]" id="availability_updaet_end_time_{{$key}}" type="text" value="" disabled="">
                                    <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php
                    }
                    ?>
                    <!-- <div class="row">
                        <div class="col-md-12">
                           <div class="mlf-30" id="select_service" style="cursor:pointer"> <span class="child-outline child-outline--dark"></span> <span id="select_services">SELECT SERVICE<span>  </div>
                           <input type="hidden" name="service_ids" id="service_ids" value="">
                        </div>
                     </div> -->

                  </div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</button> </div>
               </div>
            </form>
            </div>
         </div>
      </div>

      <!--<div class="modal fade" id="myModalirregular" role="dialog">
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
                                 <div class="form-group nomarging color-b" >
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
                                 <div class="form-group nomarging color-b" >
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
                                 <div class="form-group nomarging color-b" >
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
      </div>-->

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
                                 <div class="form-group nomarging color-b" >
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
                                 <div class="form-group nomarging color-b" >
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
                                 <div class="form-group nomarging color-b" >
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

      <!--Block date modal for user start-->
      <div class="modal fade" id="myModalblockdate" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content-->
             <form name="block_date_add" id="block_date_add" method="post" action="{{ url('api/add_block_date') }}" enctype="multipart/form-data">
               <div class="modal-content new-modalcustm">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button> 
                     <h4 class="modal-title">Block Date</h4>
                  </div>
                  <div class="modal-body clr-modalbdy">
                     <div class="row">
                        <div class='col-sm-12'>
                           <div class="form-group">
                              <div class="input-group" id="block_date_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="block_date" type="text" class="form-control" name="block_date" placeholder="Date" style="position: relative; z-index: 100000;">
                                <!--  <input id="block_date" type="text" class="form-control" name="block_date" placeholder="Date" style="position: relative; z-index: 100000;"> --> </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class='col-sm-6'>
                           <div class="form-group">
                              <div class="input-group" id="bolck_start_time_error"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="bolck_start_time" type="text" class="form-control" name="bolck_start_time" placeholder="Start Time"> </div>
                           </div>
                        </div>
                        <div class='col-sm-6'>
                           <div class="form-group" id="bolck_end_time_error">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="bolck_end_time" type="text" class="form-control" name="bolck_end_time" placeholder="End Time"> </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <div class="input-group" id="date_block_for_error"> <span class="input-group-addon"><i class="fa fa-ban"></i></span> <input type="text" class="form-control" value="" name="date_block_for" id="date_block_for" placeholder="Block for">
                              <input type="hidden" name="date_block_for_ids" id="date_block_for_ids" value="">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <div class="form-group" id="date_block_reasons_error">
                                <span class="custom-select-icon"><i class="fa fa-question-circle-o"></i></span> <label class="margleft25">Reasons</label> 
                                <div class="niceditor"> <textarea style="width: 100%" id="date_block_reasons" name="date_block_reasons" placeholder="Reasons"></textarea> </div>
                             </div>


                              <!-- <div class="input-group" id="date_block_reasons_error"> <span class="input-group-addon"><i class="fa fa-question-circle-o"></i></span> <input id="date_block_reasons" type="text" class="form-control" name="date_block_reasons" placeholder="Reasons"> </div> -->
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <span class="custom-select-icon"><i class="fa fa-file"></i></span> <label class="margleft25">Note</label> 
                              <div class="niceditor"> <textarea style="width: 100%" id="date_block_note" name="date_block_note" placeholder="Note"></textarea> </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <div class="col-md-12 text-center"> <input type="submit" value="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block"> </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--Block date modal for user end-->

      <div class="modal fade" id="myModalblocktime" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content--> 
            <div class="modal-content new-modalcustm">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  <h4 class="modal-title">Block Time</h4>
               </div>
               <form name="block_date_add" id="block_time_add" method="post" action="{{ url('api/add_block_time') }}" enctype="multipart/form-data">
                  <div class="modal-body clr-modalbdy">
                     <div class="row">
                        <div class='col-sm-6'>
                           <div class="form-group">
                              <div class="input-group" id="bolck_start_time_error"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="bolck_start_time" type="text" class="form-control" name="bolck_start_time" placeholder="Start Time"> </div>
                           </div>
                        </div>
                        <div class='col-sm-6'>
                           <div class="form-group" id="bolck_end_time_error">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> <input id="bolck_end_time" type="text" class="form-control" name="bolck_end_time" placeholder="End Time"> </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class='col-sm-12'>
                           <div class="form-group">
                              <div class="input-group" id="block_time_date_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="block_time_date" type="text" class="form-control" name="block_time_date" placeholder="Date" style="position: relative; z-index: 100000;"> </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <div class="input-group" id="time_block_for_error"> <span class="input-group-addon"><i class="fa fa-ban"></i></span> <input id="time_block_for" type="text" class="form-control" name="time_block_for" placeholder="Block for"> 
                              <input type="hidden" name="time_block_for_ids" value="" id="time_block_for_ids">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                          <div class="form-group" id="block_time_reason_error">
                              <span class="custom-select-icon"><i class="fa fa-question-circle-o"></i></span> <label class="margleft25">Reasons</label> 
                              <div class="niceditor"> <textarea style="width: 100%" id="block_time_reason" name="block_time_reason" placeholder="Reasons"></textarea> </div>
                          </div>

                           <!-- <div class="form-group">
                              <div class="input-group" id="block_time_reason_error"> <span class="input-group-addon"><i class="fa fa-question-circle-o"></i></span> <input id="block_time_reason" type="text" class="form-control" name="block_time_reason" placeholder="Reasons"> </div>
                           </div> -->
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <span class="custom-select-icon"><i class="fa fa-file"></i></span> <label class="margleft25">Note</label> 
                              <div class="niceditor"> <textarea style="width: 100%" id="block_time_note" name="block_time_note"></textarea> </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <div class="col-md-12 text-center"> <input type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block"> </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      
      <!-- Add Appoitment --> 
      <div class="modal fade" id="myModaladdappoinment" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content--> 
            <div class="modal-content new-modalcustm">
               <form name="add_appointmentm_form" id="add_appointmentm_form" method="post" action="{{ url('api/add_appoinment') }}" enctype="multipart/form-data">

               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  <h4 class="modal-title"> Add Appointments</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <div class="input-group" id="client_error"> <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                                 <div class="form-group nomarging color-b" >
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client" id="client"> 
                                       <option value="">Select Client</option>
                                       <?php
                                       foreach ($clients_list['client_list'] as $key => $cli)
                                       {
                                       ?>
                                       <option value="<?=$cli->client_id;?>"><?=$cli->client_name;?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="appoinment_service_error">
                              <span class="input-group-addon"><i class="fa fa-cog"></i></span> 
                              <div class="form-group nomarging color-b" >
                                 <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="appoinment_service" id="appoinment_service"> 
                                    <option value="">Select Service</option>
                                    <?php
                                    foreach ($services_list['service_list'] as $key => $serv)
                                    {
                                    ?>
                                    <option value="<?=$serv->service_id;?>"><?=$serv->service_name;?></option>
                                    <?php
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
                           <div class="input-group" id="staff_error">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                              <div class="form-group nomarging color-b selectStaff" >
                                 <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="staff" id="staff"> 
                                    <option value="">Select Staff</option>
                                    <?php
                                    foreach ($stuffs_list['stuff_list'] as $key => $stf)
                                    {
                                    ?>
                                    <option value="<?=$stf->staff_id;?>"><?=$stf->full_name;?></option>
                                    <?php
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
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="input-group" id="date_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="appointmentdate" type="text" class="form-control" name="date" placeholder="Date" style="position: relative; z-index: 100000;"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="input-group" id="appointmenttime_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="appointmenttime" type="text" class="form-control" name="appointmenttime" placeholder="Time"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="colour-code-main-row" style="display: none;">
                     <div class='col-sm-12'>
                        <div class="form-group">
                           <ul class="colors">
                              <li class="activeColor active" id="set_service_colour"></li>
                              <!-- <li class="bgyellow activeColor" data-colour="#E7B152" ></li>
                              <li class="bggrn activeColor" data-colour="#4BB950" ></li>
                              <li class="bglightgrn activeColor" data-colour="#32C197" ></li>
                              <li class="bgblue activeColor" data-colour="#4C80D4"></li> -->
                           </ul>
                           <input type="hidden" name="colour_code" value="" id="colour_code">
                           <h2>Set the Color</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group textarea-md" id="appoinment_note_error"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                              <textarea style="width: 100%" name="appoinment_note" id="appoinment_note" placeholder="Note"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="apoinment-mail-notification">
                     <div class="col-md-12">
                        <div class="form-group"> <input name="apoinment_mail" type="checkbox" value="true"> Send Email confirmation </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center"> 
                     <input type="submit" id="submit_appointmentm_form" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" name="submit" value="submit">
                     <!-- <button type="button" >Submit</button> --> </div>
               </div>
            </form>
            </div>
         </div>
      </div>
      <!-- End Appoitment -->
      <!-- Reshedule Appoitment Start-->
      <!-- Add Appoitment --> 
      <div class="modal fade" id="myModaladdappoinmentReschedule" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content--> 
            <div class="modal-content new-modalcustm">
               <form name="reschedule_appoitment" id="reschedule_appoitment" method="post" action="{{ url('api/reschedule_appoitment') }}" enctype="multipart/form-data">
               <input type="hidden" name="reshedule_appointment_id" value="" id="reshedule_appointment_id">
               <input type="hidden" name="reshedule_service_id" value="" id="reshedule_service_id">
               <input type="hidden" name="reshedule_staff_id" id="reshedule_staff_id" value="">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button> 
                  <h4 class="modal-title"> Reschedule Appointments</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="input-group" id="reshedule_date_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="reshedule_appointmentdate" type="text" class="form-control" name="reshedule_date" placeholder="Date" style="position: relative; z-index: 100000;"> </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="input-group" id="reshedule_appointmenttime_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="reshedule_appointmenttime" type="text" class="form-control" name="reshedule_appointmenttime" placeholder="Time"> </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center"> 
                     <input type="submit" id="submit_reschedule_appointmentm_form" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" name="submit" value="submit">
                     <!-- <button type="button" >Submit</button> --> </div>
               </div>
            </form>
            </div>
         </div>
      </div>
      <!-- Reshedule Appoitment End-->

   <!--============================Modal area End ========================================--> 

    <!--=============================Modal area start ====================================-->
      <div class="modal fade" id="myModalsharelinks" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content-->
            <div class="modal-content new-modalcustm new-modalcustm1">
               <form name="add_client_form" id="add_client_form" method="post" action="{{url('api/add_client')}}" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Share Links</h4>
                  </div>
                  <div class="modal-body clr-modalbdy">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <span>Copy Your Link</span>
                              <div class="input-group" id="">
                                 <input id="copy_link_url" type="text" class="form-control" name="copy_link_url" value="{{ url('business-provider') }}/<?php echo $inner_user_details->username;?>">
                                 <button type="button" class="shl-btns" data-url="{{ url('business-provider') }}/<?=$inner_user_details->username;?>" id="copy-link"><i class="fa fa-link"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <span>Email Your Link</span>
                              <div class="input-group" id="clientname_error">
                                 <input id="client_name" type="text" class="form-control" name="client_name" value="{{ url('business-provider') }}/<?php echo $inner_user_details->username;?>">
                                 <button type="button" class="shl-btns" id="email_your_link"><i class="fa fa-envelope-o"></i></button>
                                 <a style="display: none;" href="mailto:?subject=Link&body={{ url('business-provider') }}/<?=$inner_user_details->username;?>" target="_top" id="email_your_link_click">Click Here</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <span>Embed on Your Website</span>
                              <div class="input-group" id="clientname_error">
                                 <input id="client_name" type="text" class="form-control" name="client_name" value="{{ url('business-provider') }}/<?=$inner_user_details->username;?>">
                                 <button type="button" class="shl-btns" data-url="{{ url('business-provider') }}/<?=$inner_user_details->username;?>" id="embed-link"><i class="fa fa-code"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
    <!--===========================Modal area End ========================================-->

    <div class="modal fade" id="serviceListModal" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content--> 
        <div class="modal-content new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Select Service</h4>
                </div>
                <div class="filter-op"> <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="service-select-all">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="service-deselect-all">Deselect All</a></span></div>
                <div class="modal-body clr-modalbdy">
                   <div class="notify" >
                      <input type="text" id="serviceFilter" class="input-block-level form-control search-ap" placeholder="Search Service" >
                      <?php
                      foreach ($services_list['service_list'] as $key => $value)
                      {   
                      ?>
                          <div class="user-bkd break20px">
                          <img src="{{asset('public/assets/website/images/noimage.png')}}" class="thumbnail rounded">
                           <h2><?=$value->service_name;?>
                           </h2>
                           <div class="row">
                              <div class="check-ft">
                                 <div class="form-group"> 
                                  <input name="filter_service_id" class="calender-inpt" type="checkbox" value="<?=$value->service_id;?>">
                                </div>
                              </div>
                           </div>
                         </div>
                      <?php
                      }
                      ?>
                   </div>
                   <div class="butt-pop-ft">
                       <button type="submit" id="add-service-into-input" class="btn btn-primary butt-next">Done</button> 
                       <a href="JavaScript:Void(0);" id="cancel-service-list" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Cancel</a> 
                    </div>
                </div>
            </form>
          </div>
      </div>
   </div>

    <!--=========================Stuff List Modal Start==========================-->
   <!--Block date modal for user start-->
   <div class="modal fade" id="staffListModal" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content--> 
        <div class="modal-content new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Staff List</h4>
                </div>
                <div class="filter-op"> <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="staff-select-all">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="staff-deselect-all">Deselect All</a></span></div>
                <div class="modal-body clr-modalbdy">
                   <div class="notify" >
                      <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                      <?php
                      foreach ($stuffs_list['stuff_list'] as $key => $value)
                      {   
                      ?>
                          <div class="user-bkd break20px">
                           <?php
                            if($value->staff_profile_picture)
                            {
                            ?>
                                <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                            <?php
                            }
                            else
                            {
                            ?>
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                            <?php
                            }
                            ?>
                           <h2><?=$value->full_name;?>
                              <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                           </h2>
                           <div class="row">
                              <div class="check-ft">
                                 <div class="form-group"> 
                                  <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">
                                </div>
                              </div>
                           </div>
                         </div>
                      <?php
                      }
                      ?>
                   </div>
                   <div class="butt-pop-ft">
                       <button type="submit" id="add-stuff-into-input" class="btn btn-primary butt-next">Done</button> 
                       <a href="JavaScript:Void(0);" id="cancel-staff-list" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Cancel</a> 
                    </div>
                </div>
            </form>
          </div>
      </div>
   </div>
   <!--Block date modal for user end-->

   <!--Block date modal for user start-->
   <div class="modal fade" id="staffListModalForTime" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content--> 
        <div class="modal-content new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Staff List</h4>
                </div>
                <div class="filter-op"> <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="staff-select-all-time">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="staff-deselect-all-time">Deselect All</a></span></div>
                <div class="modal-body clr-modalbdy">
                   <div class="notify" >
                      <input type="text" id="staffFilterTime" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                      <?php
                      foreach ($stuffs_list['stuff_list'] as $key => $value)
                      {   
                      ?>
                          <div class="user-bkd break20px">
                           <?php
                            if($value->staff_profile_picture)
                            {
                            ?>
                                <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                            <?php
                            }
                            else
                            {
                            ?>
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                            <?php
                            }
                            ?>
                           <h2><?=$value->full_name;?>
                              <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                           </h2>
                           <div class="row">
                              <div class="check-ft">
                                 <div class="form-group"> 
                                  <input name="filter_stuff_id_time" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">
                                </div>
                              </div>
                           </div>
                         </div>
                      <?php
                      }
                      ?>
                   </div>
                   <div class="butt-pop-ft">
                       <button type="submit" id="add-stuff-into-input-time" class="btn btn-primary butt-next">Done</button> 
                       <a href="JavaScript:Void(0);" id="cancel-staff-list-time" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Cancel</a> 
                    </div>
                </div>
            </form>
          </div>
      </div>
   </div>
   <!--Block date modal for user end-->
   <!--Block date modal for user start-->
   <div class="modal fade" id="staffListModalForAddLocation" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content--> 
        <div class="modal-content new-modalcustm">
            <form name="" id="" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">×</button>
                   <h4 class="modal-title">Staff List</h4>
                </div>
                
                <div class="modal-body clr-modalbdy">
                   <div class="notify" >
                      <input type="text" id="staffFilterAddLOcation" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                      <?php
                      foreach ($stuffs_list['stuff_list'] as $key => $value)
                      {   
                      ?>
                          <div class="user-bkd break20px">
                           <?php
                            if($value->staff_profile_picture)
                            {
                            ?>
                                <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                            <?php
                            }
                            else
                            {
                            ?>
                                <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                            <?php
                            }
                            ?>
                           <h2><a class="add-location-exist-user" href="JavaScript:Void(0);" data-username="<?=$value->username;?>" data-fullname="<?=$value->full_name;?>" data-email="<?=$value->email;?>" data-location="<?=$value->addess;?>" data-staffid="<?=$value->staff_id;?>" data-country="<?=$value->country;?>" data-city="<?=$value->city;?>"><?=$value->full_name;?></a>
                              <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                           </h2>
                         </div>
                      <?php
                      }
                      ?>
                   </div>
                    <div class="clearfix"></div>
                   <!-- <div class="butt-pop-ft">
                       <a href="JavaScript:Void(0);" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Cancel</a> 
                    </div> -->
                </div>
            </form>
          </div>
      </div>
   </div>
   <!--Block date modal for user end-->
   <!--======================booking payment=====================================-->
   <div class="modal fade in" id="myModalPayment" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content-->
         <div class="modal-content new-modalcustm">
            <form name="" id="update-payment-info" method="post" action="{{url('api/update_payment_info')}}" enctype="multipart/form-data" novalidate="novalidate">
            <input type="hidden" name="total_amount_tobe_paid" value="" id="total_amount_tobe_paid">
            <input type="hidden" name="appointment_id" value="" id="payment_appointment_id">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Add Payment</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="payment_method_error"> <span class="input-group-addon"><!-- <i class="fa fa-eur"></i> --></span>
                              <select id="payment_method" name="payment_method" class="form-control">
                                 <option value="1">Cash</option>
                                 <option value="2">Debit Card</option>
                                 <option value="3">Cheque</option>
                                 <option value="4">Echeck</option>
                                 <option value="5">Debit Card</option>
                                 <option value="6">Credit Card & Cash</option>
                                 <option value="7">Gift Certificate</option>
                                 <option value="8">Gift Certificates & Cash</option>
                                 <option value="9">Insurance</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="payment_amount_error"> <span class="input-group-addon"><!-- <i class="fa fa-eur"></i> --></span>
                              <input id="payment_amount" type="text" class="form-control" name="payment_amount" placeholder="Amount" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="additional_charges_error"> <span class="input-group-addon"><!-- <i class="fa fa-eur"></i> --></span>
                              <input id="additional_charges" type="text" class="form-control" name="additional_charges" placeholder="Additional Chanrges">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="discount_amount_error"> <span class="input-group-addon"><!-- <i class="fa fa-eur"></i> --></span>
                              <input id="discount_amount" type="text" class="form-control" name="discount_amount" placeholder="Discount">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group textarea-md"> <span class="input-group-addon" style="vertical-align: top;padding-top: 9px;"><!-- <i class="fa fa-file"></i> --></span>
                              <textarea style="width: 100%" name="payment_note" id="payment_note" placeholder="Payment Note"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr style="margin-top:10px;">
                  <table width="100%">
                     <tbody>
                        <tr>
                           <td>Total</td>
                           <td style="text-align:right"><sapn id="total-amount-currency">INR</sapn> <sapn id="total-amount">10.00</sapn></td>
                        </tr>
                     </tbody>
                  </table>
                  <a href="#" style="margin:10px 0 20px; display:block" data-toggle="collapse" data-target="#code" class="" aria-expanded="true"><i class="fa fa-gift"></i> Redeem Gift Certificate</a>
                  <div class="row collapse" aria-expanded="true" id="code" style="">
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                              <input id="addi-charg" type="text" class="form-control error" name="client_name" placeholder="Code">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <button type="button" class=" butt-next" style="margin: 0px 5px; width:76px; padding:8px 0px;  display: inline-block">Apply</button>
                        <button type="button" class="butt-cancle" style="margin: 0px 5px; width:76px;padding:8px 0px; display: inline-block">Cancel</button>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center">
                     <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">PAY NOW</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--======================booking payment=====================================-->

   <!--======================booking payment=====================================-->
   <div class="modal fade in" id="myModalServices" role="dialog">
      <div class="modal-dialog add-pop">
         <!-- Modal content-->
         <div class="modal-content new-modalcustm add-service">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Add Service</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                  <form class="form-horizontal" action="{{ url('api/add-new-service') }}" method="post" autocomplete="off" id="add-new-service" enctype="multipart/form-data">
                     <input type="hidden" name="update_service_id" id="update_service_id" value="">
                     <input type="hidden" name="checkGroup" id="checkGroup" value="">
                     <div class="clone-div">
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <select class="selectpicker category" data-show-subtext="true" data-live-search="true" id="service_category" name="service_category" >
                              <option value="">Select Category </option>
                              <?php
                                 foreach ($basicdatas['category_list'] as $key => $value)
                                 {
                                    echo "<option value='".$value->category_id."'>".$value->category."</option>";
                                 }
                                 foreach ($user_new_category['user_new_category'] as $key => $value1)
                                 {
                                    echo "<option value='".$value1->category_id."'>".$value1->cat."</option>";
                                 }
                                 ?>
                              <option value="new">New Category </option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group new-category-name" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Category Name " id="new_category_name" name="new_category_name" value="">
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Service Name " id="service_name" name="service_name" value="">
                           <div class="clearfix"></div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <input type="text" class="form-control" placeholder="Cost " name="service_cost" id="service_cost" value="">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="col-md-6 drop-sm">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="service_currency" id="service_currency">
                                    <option value="">Select Currency </option>
                                   <?php
                                   foreach ($currency_list['currency_list'] as $key => $value)
                                   {
                                      echo "<option value='".$value->currency_id."'>".$value->currency."</option>";
                                   }
                                   ?>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <select class="selectpicker duration" data-show-subtext="true" data-live-search="true" id="service_duration" name="service_duration" >
                              <option value="">Select Duration </option>
                              <option value="15">15 min </option>
                              <option value="30">30 min </option>
                              <option value="45">45 min </option>
                              <option value="60">60 min </option>
                              <option value="Custom">Custom min </option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group custom-duration" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <input type="text" class="form-control" placeholder="Custom duration " id="custom_duration" name="custom_duration" value="">
                           <div class="clearfix"></div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 capacity">
                              <a href="" class="tg-btn-ac user-status one-to-one">One to One</a>
                           </div>
                           <div class="col-md-3 capacity">
                              <a href="" class="tg-btn user-status group">Group</a>
                           </div>
                           <div class="col-md-5 capacity" style="display: none;">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-capacity.png')}}">
                                 <input type="text" class="form-control" placeholder="Capacity " name="service_capacity" id="service_capacity" value="">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center">
                     <button id="submit" type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--======================booking payment=====================================-->

   <div class="modal fade" id="modalEmbed" role="dialog">
    <div class="modal-dialog add-pop"> 
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Embed Link</h4>
        </div>
        <div class="modal-body clr-modalbdy">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="niceditor">
                  <textarea style="width: 100%" id="embed_code" placeholder=""></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-12 text-center">
            <input id="copy-embed-link" type="submit" value="copy" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">
          </div>
        </div>
      </div>
    </div>
  </div>
    <!--===============================Stuff List Modal End======================--> 
    <!--Quick Guide-->
   <!--==================================Modal area start ===============================--> 
   <div class="modal fade" id="myModalQuickGuide" role="dialog">
      <div class="modal-dialog quick-pop">
         <!-- Modal content-->
         <div class="modal-content new-modalcustm">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Quick Guide</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div style="margin-bottom: 10px;">
                  <input type="checkbox" name="show_user_guide" id="show_user_guide" <?=$inner_user_details->login_counter==3 ? "checked" : ""; ?>> Always show user guide.
               </div>

               <a href="{{ url('calendar') }}"><h3>1. sync Calendars</h3></a>
               <p>Squeedr works in sync with Google Calendar, Office 365, Outlook or iCloud to avoid scheduling conflicts when creating 
                  new events.
               </p>
               <a href="{{ url('email-customisation') }}"><h5> 1.1 Personalize your email</h5></a>
               <p>Customize your e-mails. Set-up e-mal tempates that reflect your brand's identity and tone.</p>
               <hr >
               <a href="{{ url('settings-business-hours/services') }}"><h3>2. Manage your business hours</h3></a>
               <p>Events types lets you create an event according to your availability, meeting duration, location, etc..., for meetings 
                  or for individual invitees.
               </p>
               <a href="{{ url('services/all') }}"><h5> 2.2 Setup your services, staff and location</h5></a>
               <ul>
                  <li>Create events to define your services </li>
                  <li>Setup scheduling pages for individual team members </li>
                  <li>Create location-based events.</li>
               </ul>
               <hr >
               <h3>3. Share your link</h3>
               <p>Share your link and let invitees schedule the meeting from the available slots. Email the link in a short snippet linke this:
                  <br><br>
                  <span class="cl-blue">
                  Subject: Lets connect,<br>
                  Hi matt,<br>
                  It would be lovely if we could chat. Why don't you go ahead and decide the time at (insert dummy Squeedr link)?<br>
                  <br>
                  Let's Chat soon!<br><br>
                  - Sam
                  </span>
               </p>
               <hr >
               <h3>4. Customize your Squeedr page</h3>
               <hr style="margin-top:10px; margin-top:5px;">
               <p>Your personal Squeedr page lists all available events on a single page making it easier for invitees to schedule appointments.
                  Customize the page to align it with your brand and coporate indentity.
               </p>
               <a href="{{ url('business-contact-info') }}"><h5> 4.4 Business Details</h5></a>
               <p></p>
            </div>
         </div>
      </div>
   </div>
   <!--====================================Modal area end ===============================-->
    <input type="text" id="offscreen" class="offscreen" value="">
	<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
   <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script>
	<script src="{{asset('public/assets/website/js/script.js')}}"></script>
	<script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
	<script src="{{asset('public/assets/website/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('public/assets/website/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('public/assets/website/js/owl.carousel.js')}}"></script>
	<script src="{{asset('public/assets/website/js/jquery.autocomplete.min.js')}}"></script> 
    <!-- Sweetalert -->
	<script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script> 
    <!-- jQuery Cookie -->
	<script src="{{asset('public/assets/website/js/jquery.cookie.min.js')}}"></script>
	<!-- Form Validation -->
	<script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>

   <script src="{{asset('public/assets/website/js/bootstrap-select.min.js')}}"></script>

   <script src="{{asset('public/assets/website/js/jquery-ui.js')}}"></script>

   <script src="{{asset('public/assets/website/js/bootstrap-timepicker.min.js')}}"></script>

   <script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
	
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
		$(document).ready(function() {
			$("#adv-sh").click(function() {
				$("#adv-op").toggle();
			});
		});
	</script>
	<script type="text/javascript">
		function ShowPopup() {
			$("#popup").fadeToggle();
		}

		/*function togglebtn(obj) {
			$(obj).toggleClass("active");
			$(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");
			$(".mobSevices ul li a.active").find("i").not($(obj).find("i")).removeClass("fa-toggle-on").addClass("fa-toggle-off");
			$(".mobSevices ul li a.active").not($(obj)).removeClass("active");
		}*/

		function showUl(obj) {
			$(obj).find("ul").fadeToggle();
			$(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();
		}

      //reset modal from
		$(document).ready(function() {
         $('#myModaladdappoinment').on('hidden.bs.modal', function (e) {
            $("#staff").val('').trigger('change');
            $(this).find('form').trigger('reset');
         });

         $('#myModalblockdate').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
         });

         $('#myModalblocktime').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
         });

         $('#myModalServices').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
         });

         $('#myModal').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
            $("#location_staff_id").val('');
            $("#location_password").parent().parent().parent().show();
            $("#location_username").prop("readonly", false);
            $("#location_full_name").prop("readonly", false);
            $("#location_email").prop("readonly", false);
         });

         $('#myModalregular').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
            //$('input:checkbox.styled-checkbox').prop('checked', false);
         });
         
      });

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
		slideLeftBtn.addEventListener('click', function(e) {
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
		slideRightBtn.addEventListener('click', function(e) {
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
		slideAlertBtn.addEventListener('click', function(e) {
			e.preventDefault;
			slideAlert.open();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("ul.menu li a").click(function() {
				$(this).addClass("active");
				$(("li a.active")).not($(this)).removeClass("active");
			});
			$(".closePopUp").click(function() {
				$(".profilepopup").fadeOut();
				$('body').css('overflow-y', 'auto');
			});
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				responsiveClass: true,
				responsive: {
					0: {
						items: 8,
						nav: true,
						margin: 20
					},
					600: {
						items: 8,
						nav: true,
						margin: 22
					},
					1000: {
						items: 10,
						nav: false,
						loop: true,
						margin: 25
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
	<script type="text/javascript">
		$(document).ready(function() {
			$("ul.menu li a").click(function() {
				$(this).addClass("active");
				$(("li a.active")).not($(this)).removeClass("active");
			});
			$(".closePopUp").click(function() {
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
				reader.onload = function(e) {
					$('#blah').show();
					$('#blah').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			} else {
				$('#blah').hide();
			}
		}
		$("#staff_profile_picture").change(function() {
			readURL(this);
		});
	</script> <!-- NCRTS JS -->
	<script src="{{asset('public/assets/website/js/ncrtsdev.js')}}"></script>
	
	<script>
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[\w.]+$/i.test(value);
    }, "Letters, numbers, and underscores only please");

		$('#add_team_member_form').validate({
            rules: {
                staff_fullname: {
                    required: true
                },
                staff_username: {
                    required: true,
                    alphanumeric: true
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
                    required: 'Please enter username',
                    alphanumeric: 'Please enter letters, numbers, and underscores only'
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
            errorPlacement: function(error, element) {
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
            submitHandler: function(form) {
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
			    $.each(data, function(ia, l) {
					form_data.append(l.name, l.value);
				});
				$.ajax({
                    url: form.action,
                    type: form.method,
                    data: form_data,
                    dataType: "json",
                    processData: false, // tell jQuery not to process the data 
                    contentType: false, // tell jQuery not to set contentType 
                    success: function(response) {
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
                    beforeSend: function() {
                        $('.animationload').show();
                    },
                    complete: function() {
                        $('.animationload').hide();
                    }
				});
            }
        });

		/*var client = [
            <?php
            foreach ($clients_list['client_list'] as $key => $cli)
            {
            ?>
            {
					value: '<?=$cli->client_name;?>',
					data: '<?=$cli->client_id;?>'
				},
            <?php
            }
            ?> 

            ];

            var staff = [
            <?php
            foreach ($stuffs_list['stuff_list'] as $key => $stf)
            {
            ?>
            {
               value: '<?=$stf->full_name;?>',
               data: '<?=$stf->staff_id;?>'
            },
            <?php
            }
            ?> 

            ];*/

				$('#client').autocomplete({
					lookup: client,
               mustMatch:true,
               showNoSuggestionNotice:true,
               triggerSelectOnValidInput:false,
				});
				$('#staff').autocomplete({
					lookup: staff,
               mustMatch:true,
               showNoSuggestionNotice:true,
               triggerSelectOnValidInput:false
				});
	</script>
	<script>
		$('.carousel').carousel({
			interval: false
		});
	</script>
	<?php
	if(isset($professions) && $professions)
	{
	?>
	<script>
	var profession = [
		<?php
		foreach($professions as $prof)
		{
		?>
		{
			value: '<?=$prof->profession;?>',
			data: '<?=$prof->profession_id;?>'
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
   <script>
   function countChar(val) {
     var len = val.value.length;
     if (len >= 1000) {
       val.value = val.value.substring(0, 1000);
     } else {
      var count = 1000 - len;
       $('#specialnote_count').text('HTML Tags not allowed, '+count+' characters remaining');
     }
   };
   </script>
   <script type="text/javascript">
      $(".activeColor").click(function()
      {
         let colour_code = $(this).attr('data-colour');
         $(".activeColor").removeClass('active');
         $('#colour_code').val(colour_code);
         $(this).addClass('active');
      });
   </script>

   <script>
     $( function() {
         var $var = $("#appointmentdate,#reshedule_appointmentdate,#block_time_date");
             $var.datepicker({
               minDate:0,
            });

         var $dp2 = $("#due_date"); 
             $dp2.datepicker({
               //changeYear: true,
               //changeMonth: true,
               minDate:1,
               dateFormat: 'yy-mm-dd',
            });

         var $dp3 = $("#block_date"); 
             $dp3.multiDatesPicker({
               minDate:0,
            }); 

             
     });
   </script>

    <script type="text/javascript">
        $('#appointmenttime,#reshedule_appointmenttime,#bolck_start_time,#bolck_end_time').timepicker({defaultTime: ''});
        $('.availability_start_time,.availability_end_time').timepicker({defaultTime: ''});

        $('input:checkbox.styled-checkbox').on('click', function(){
            var sel_val = $(this).val();
            if($('input:checkbox.styled-checkbox').is(':checked')){
                $('#availability_start_time_'+sel_val).prop('disabled', false);
                $('#availability_start_time_'+sel_val).val('');
                $('#availability_end_time_'+sel_val).prop('disabled', false);
                $('#availability_end_time_'+sel_val).val('');
            }
            else{
                $('#availability_start_time_'+sel_val).prop('disabled', true);
                $('#availability_start_time_'+sel_val).val('');
                $('#availability_end_time_'+sel_val).prop('disabled', true);
                $('#availability_end_time_'+sel_val).val('');
            }
        });
    </script>

    <script type="text/javascript">

        $('input:checkbox.styled-checkbox-update').on('click', function(){
            var sel_val = $(this).val();
            if($('input:checkbox.styled-checkbox-update').is(':checked')){
               $(this).parent().next().find('input').prop('disabled', false);
               $(this).parent().next().next().next().find('input').prop('disabled', false);
            }
            else
            {
               $(this).parent().next().find('input').prop('disabled', true);
               $(this).parent().next().next().next().find('input').prop('disabled', true);
               $(this).parent().next().find('input').val('');
               $(this).parent().next().next().next().find('input').val('');
            }
        });
    </script>
    <script type="text/javascript">

        $('#email_your_link').on('click', function(){
            $('#email_your_link_click').trigger("click");
        });
    </script>

	<script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>

   
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuUB8s5lliHSAP_GKnXd70XwlAZa4WE&libraries=places&callback=initMap"
        async defer></script>
      <script>
      $(window).load(function(){
      var autocomplete = new google.maps.places.Autocomplete($("#business_location")[0], {});
      google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      console.log(place);
      });
      });
      </script>
      <?php
      if($inner_user_details->login_counter==1 || $inner_user_details->login_counter==3)
      {
      ?>
      <script type="text/javascript">
         $(document).ready(function() { 
            var a = localStorage.getItem("showPopup");
            if(a!="Yes")
            {
               $("#myModalQuickGuide").modal("show");
               localStorage.setItem("showPopup", "Yes");
            }
         });
      </script>
      <?php
      }
      else
      {
      ?>
      <script type="text/javascript">
         localStorage.removeItem("showPopup");
      </script>
      <?php
      }
      ?>
      <script type="text/javascript">
      $('#show_user_guide').click(function(){
            var user_guide_value = $(this).val();
            var data = addCommonParams([]);
            data.push({name:'user_guide_value',value:user_guide_value});
            $.ajax({
                url: "<?php echo url('api/update_guide_value');?>",
                type: "POST",
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.result=='1')
                    {
                        swal("Success", response.message, "success");
                    }
                    else
                    {
                        swal("Error", response.message , "error");
                    }
                },
                beforeSend: function(){
                    $('.animationload').show();
                },
                complete: function(){
                    $('.animationload').hide();
                }
            });
      });
      </script>
      

      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


      <!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuUB8s5lliHSAP_GKnXd70XwlAZa4WE&callback=initMap">
    </script> -->
   <!--=========================Google Map end============================-->
	  @yield('custom_js') 
   </body>
</html>