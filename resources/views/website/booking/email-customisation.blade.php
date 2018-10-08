@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<?php

?>
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking Options</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span> 
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="images/arrow.png" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('booking-options') }}"> Clients Booking Flow</a></li>
               <li><a href="{{ url('booking-rules') }}"> Booking Rules</a> </li>
               <li><a href="{{ url('booking-policies') }}"> Booking Policies</a></li>
               <li><a href="{{ url('notification-settings') }}"> Notification Settings</a></li>
               <li><a href="{{ url('email-customisation') }}" class="active"> Email Customisation</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="container-fluid body-sec ">
            <p>Email notifications are automatically sent to customers when specific events occur. You can use the existing templates to make changes
               in them to better suit your business.
            </p>
            <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Email customization in a premium ffeature available with Growth and above packages  <span>Upgrade</span></div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Reminder Alert Prior to Appointment</h2>
                     <p>
                        This automatically triggered email is sent to customers prior to their appointments as a reminder and hence, helps in reducing
                        customer no-shows 
                     </p>
                  </div>
                     <form action="{{ url('api/email_customisation_update') }}" method="post" id="form1" class="email_cutomisation_form">
                        <input type="hidden" name="type" value="1">
                        <div id="collapse1" class="panel-collapse collapse booking-form1 ">
                           <div class="form-group col-md-6">
                              <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject1) && $subject1 ? $subject1: ''?>">
                              <div class="clearfix"></div>
                           </div>
                           <div class="padleft30">
                              <textarea style="width: 600px; height: 200px;" id="area1" name="message"><?=isset($message1) && $message1 ? $message1: ''?></textarea>
                           </div>
                           <input class="btn btn-primary" type="submit" name="submit" value="save">
                        </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>  
                     <h2>Waiting for Approval - Approved Appointment</h2>
                     <p>
                        This automatically triggered email will be sent to notify your customers after the admin or a staff member approves their appointment.
                        It will be sent as a follow-up to the 'Waiting for Approval' email and is different form a 'Booking Confirmation' email
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form2" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="2">
                     <div id="collapse2" class="panel-collapse booking-form1  collapse">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject2) && $subject2 ? $subject2: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area2" name="message"><?=isset($message2) && $message2 ? $message2: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                        <h2>Appointment Cancellation</h2>
                        <p>
                           This is automatically triggered email will be sent to alert a customer if an administrator or 
                           staff member cancels an appointment
                        </p>
                     </div>
                     <form action="{{ url('api/email_customisation_update') }}" method="post" id="form3" class="email_cutomisation_form">
                        <input type="hidden" name="type" value="3">
                     <div id="collapse3" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject3) && $subject3 ? $subject3: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area3" name="message"><?=isset($message3) && $message3 ? $message3: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Waiting for Approval - Appointment Denied</h2>
                     <p>
                        This is automatically triggered email will be sent to nofity your customer if the admin or a staff
                        member denies an appointment. it will be sent as a follow-up to the 'Waiting for Approval' email
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form4" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="4">
                     <div id="collapse4" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject4) && $subject4 ? $subject4: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area4" name="message"><?=isset($message4) && $message4 ? $message4: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse5" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Booking Confirmation</h2>
                     <p>
                        This is automatically triggered email will be sent to alert customers if an admin or staff member reschedules their appointments
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form5" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="5">
                     <div id="collapse5" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject5) && $subject5 ? $subject5: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area5" name="message"><?=isset($message5) && $message5 ? $message5: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse6" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Appointment Rescheduled</h2>
                     <p>
                        This is automatically triggered email will be sent to alert customers if an admin or staff member reschedules their appointments
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form6" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="6">
                     <div id="collapse6" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject6) && $subject6 ? $subject6: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area6" name="message"><?=isset($message6) && $message6 ? $message6: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse7" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Thank You</h2>
                     <p>
                        This manually triggered email will be sent to customers after their appointment is completed, asking for their feedback. A customer can leave a bad,
                        good or excellent rating with comments
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form7" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="7">
                     <div id="collapse7" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject7) && $subject7 ? $subject7: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area7" name="message"><?=isset($message7) && $message7 ? $message7: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse8" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Waiting Approval</h2>
                     <p>
                        This automatically triggered email will be sent to your customers who book appointments that need approval before final Confirmation
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form8" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="8">
                     <div id="collapse8" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" name="subject" value="<?=isset($subject8) && $subject8 ? $subject8: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area8" name="message"><?=isset($message8) && $message8 ? $message8: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse9" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>New User Registration</h2>
                     <p>
                        This welcome email will be sent to new customers added by the admin or a staff members. The email provides customers with their login details and is 
                        triggered automatically
                     </p>
                  </div>
                  <form action="{{ url('api/email_customisation_update') }}" method="post" id="form9" class="email_cutomisation_form">
                     <input type="hidden" name="type" value="9">
                     <div id="collapse9" class="panel-collapse collapse booking-form1 ">
                        <div class="form-group col-md-6">
                           <input type="text" class="form-control" placeholder="Subject" value="<?=isset($subject9) && $subject9 ? $subject9: ''?>">
                           <div class="clearfix"></div>
                        </div>
                        <div class="padleft30">
                           <textarea style="width: 600px; height: 200px;" id="area9"><?=isset($message9) && $message9 ? $message9: ''?></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit" value="save">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!--  <button class="btn btn-primary search-btn" type="submit">Save</button>-->
      </div>
   </div>
</div>
@endsection