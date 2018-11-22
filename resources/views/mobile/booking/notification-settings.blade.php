@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking Options</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <!-- <div class="input-group">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div> -->
               </div>
            </div>
            <div class="col-md-7">
               <!-- <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div> -->
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('booking-options') }}"> Clients Booking Flow</a></li>
               <li><a href="{{ url('booking-rules') }}"> Booking Rules</a> </li>
               <li><a href="{{ url('booking-policies') }}"> Booking Policies</a></li>
               <li><a href="{{ url('notification-settings') }}" class="active"> Notification Settings</a></li>
               <li><a href="{{ url('email-customisation') }}"> Email Customisation</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <!-- <form class="form-horizontal" action=""> -->
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0">Reminder Notifications </h2>
                        <p>Reminder Notifications allows you to inform customers to reduce no-shows </p>
                     </div>
                     <?php
                     //echo "<pre>";
                     //print_r($notification_settings_data);
                     if($notification_settings_data && $notification_settings_data->is_email_send && $notification_settings_data->is_email_send==1)
                     {
                        $is_email_send = 1;
                     }
                     else
                     {
                        $is_email_send = 0;
                     }
                     ?>
                     <div id="collapse1" class="panel-collapse collapse">
                        <hr>
                        <h3 class="sub-head1">Email Reminder</h3>
                        <table>
                           <tr>
                              <td>Send an email to customers</td>
                              <td> <input id="email_send_time_duration" type="text" style="width:50px;" class="form-control" name="email_send_time_duration" value="<?=$notification_settings_data && $notification_settings_data->email_send_time ? $notification_settings_data->email_send_time : 0;?>"></td>
                              <td >hours prior to appointment</td>
                              <td >
                                 <a data-value="<?=$is_email_send;?>" onclick="togglebtn(this);" class="togg-btn <?=$is_email_send==1 ? "active" : "" ;?>" id="send_email_to_customer">
                                 <i class="fa fa-toggle-<?=$is_email_send==1 ? "on" : "off" ;?>"></i></a>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <h3 class="sub-head1">SMS Reminder</h3>
                        <table>
                           <tr>
                              <td>Send an SMS alert to customers</td>
                              <td> <input id="sms_send_time_duration" type="text" style="width:50px;" class="form-control" name="sms_send_time_duration" value="<?=$notification_settings_data && $notification_settings_data->sms_send_time ? $notification_settings_data->sms_send_time : 0;?>"></td>
                              <td >hours prior to appointment</td>
                              <?php
                              //echo "<pre>";
                              //print_r($notification_settings_data);
                              if($notification_settings_data && $notification_settings_data->is_sms_send && $notification_settings_data->is_sms_send==1)
                              {
                                 $is_sms_send = 1;
                              }
                              else
                              {
                                 $is_sms_send = 0;
                              }
                              ?>
                              <td >
                                 <a data-value="<?=$is_sms_send;?>" onclick="togglebtn(this);" class="togg-btn <?=$is_sms_send==1 ? "active" : "" ;?>" id="send_sms_to_customer">
                                 <i class="fa fa-toggle-<?=$is_sms_send==1 ? "on" : "off" ;?>"></i></a>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                     </div>
                  <!-- </form> -->
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <!-- <form class="form-horizontal" action=""> -->
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0"> Booking Notifications </h2>
                        <p>Booking Notifications allows you to inform customers </p>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse">
                        <hr>
                        <div class="col-md-8 booking-form">
                           <div class="form-group">
                              When to send
                              <select class="form-control cust-select" name="when_to_send" id="when_to_send">
                                 <option value="0" <?=$notification_settings_data && $notification_settings_data->is_admin==0 ? "selected" : "";?>>Never send an SMS</option>
                                 <option value="1" <?=$notification_settings_data && $notification_settings_data->is_admin==1 ? "selected" : "";?>>Whenever an appointment requires approval</option>
                                 <option value="2" <?=$notification_settings_data && $notification_settings_data->is_admin==2 ? "selected" : "";?>>Each time an appointment is booked</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <table>

                           <?php
                           //echo "<pre>";
                           //print_r($notification_settings_data);
                           if($notification_settings_data && $notification_settings_data->is_admin && $notification_settings_data->is_admin==1)
                           {
                              $is_admin = 1;
                           }
                           else
                           {
                              $is_admin = 0;
                           }
                           ?>
                           <tr>
                              <td>Admin</td>
                              <td >
                                 <a data-value="<?=$is_admin;?>" onclick="togglebtn(this);" class="togg-btn <?=$is_admin==1 ? "active" : "" ;?>" id="is_admin_update">
                                 <i class="fa fa-toggle-<?=$is_admin==1 ? "on" : "off" ;?>"></i></a>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <table>
                           <?php
                           //echo "<pre>";
                           //print_r($notification_settings_data);
                           if($notification_settings_data && $notification_settings_data->is_stuff && $notification_settings_data->is_stuff==1)
                           {
                              $is_stuff = 1;
                           }
                           else
                           {
                              $is_stuff = 0;
                           }
                           ?>
                           <tr>
                              <td>Staff</td>
                              <td >
                                 <a data-value="<?=$is_stuff;?>" onclick="togglebtn(this);" class="togg-btn <?=$is_stuff==1 ? "active" : "" ;?>" id="is_stuff_update">
                                 <i class="fa fa-toggle-<?=$is_stuff==1 ? "on" : "off" ;?>"></i></a>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                     </div>
                  <!-- </form> -->
               </div>
            </div>
         </div>
         <!--  <button class="btn btn-primary search-btn" type="submit">CONFIRM BOOKING</button> -->
      </div>
   </div>
</div>
@endsection