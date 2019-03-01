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
      <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.css" rel="stylesheet">
      <link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
      <style type="text/css">
         .addReadMore.showlesscontent .SecSec,
         .addReadMore.showlesscontent .readLess {
         display: none;
         }
         .addReadMore.showmorecontent .readMore {
         display: none;
         }
         .addReadMore .readMore,
         .addReadMore .readLess {
         margin-left: 2px;
         color: blue;
         cursor: pointer;
         }
         .addReadMoreWrapTxt.showmorecontent .SecSec,
         .addReadMoreWrapTxt.showmorecontent .readLess {
         display: block;
         }
         .nice-select{width: 100% !important;border: 1px solid #ccc;border-radius: 0;}
      </style>
      <script type="text/javascript">
         var authDatas={user_no:0}; 
         
         var device_token_key="<?php echo Session::getId()?>"; 
         
         var baseUrl ="<?php echo url('')?>/mobile/"; 
         
         var baseUrl2 ="<?php echo url('')?>"; 
         
      </script>
      @yield('custom_css')
   </head>
   <body>
      <?php
         $stuffs_list = App\Http\Controllers\BaseApiController::stuffs_list();
         
         $services_list = App\Http\Controllers\BaseApiController::services_list();
         
         $clients_list = App\Http\Controllers\BaseApiController::clients_list();
         
         ?>
      <div class="animationload" style="display: none;">
         <div class="osahanloading"></div>
      </div>
      @yield('content')
      <button class="popup-button" onclick="ShowPopup(this);"><img src="{{asset('public/assets/mobile/images/plus.png')}}" /> </button>
      <div id="popup">
         <ul class="showMobile menuList">
            <!-- <li><a>List of Notes <img src="{{asset('public/assets/mobile/images/add-menu/list-of-notes.png')}}"/></a></li> -->
            <li><a onclick="blockTime();">Block Time <img src="{{asset('public/assets/mobile/images/add-menu/block-time.png')}}"/></a></li>
            <li><a onclick="blockDate();">Block Date <img src="{{asset('public/assets/mobile/images/add-menu/block-date.png')}}"/></a></li>
            <li><a href="{{url('mobile/service-list/all')}}">Services <img src="{{asset('public/assets/mobile/images/add-menu/services.png')}}"/></a></li>
            <li><a href="{{url('mobile/staff-list')}}">Staff <img src="{{asset('public/assets/mobile/images/add-menu/staff.png')}}"/></a></li>
            <li><a href="{{url('mobile/add-client')}}">Add Clients <img src="{{asset('public/assets/mobile/images/add-menu/clients.png')}}"/></a></li>
            <li><a href="{{url('mobile/add-appointment')}}">Add Appointment <img src="{{asset('public/assets/mobile/images/add-menu/appointment.png')}}"/></a></li>
         </ul>
         <div id="blockDate" class="showMobile">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                     <div class="popupInside dashDateTime showMobile">
                        <form name="block_date_add" id="block_date_add" method="post" action="{{ url('api/add_block_date') }}" enctype="multipart/form-data">
                           <div class="mobile-control">
                              <h3>Block Date</h3>
                              <div class="break10px"></div>
                              <div class="row">
                                 <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                       <input id="bolck_start_time" type="text" class="form-control" name="bolck_start_time" placeholder="Start Time">
                                       <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                 </div>
                                 <div class="col-xs-2 text-center">
                                    <label class="customlabel">to</label>    
                                 </div>
                                 <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                       <input id="bolck_end_time" type="text" class="form-control" name="bolck_end_time" placeholder="End Time">
                                       <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="input-group custom-group">
                                 <input id="block_date" type="text" class="form-control" name="block_date" placeholder="Date" style="position: relative; z-index: 100000;">  
                                 <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                              </div>
                              <div class="break10px"></div>
                              <h6>Reasons</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <textarea class="form-control paddingLeft12px" style="width: 100%" id="date_block_reasons" name="date_block_reasons" placeholder="Reasons"></textarea>
                              </div>
                              <!-- <div class="input-group custom-group">
                                 <input id="date_block_reasons" type="text" class="form-control" name="date_block_reasons" placeholder="Reasons">   
                                 <span class="input-group-addon"> 
                                 </span>
                              </div> -->
                              <h6>Note</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <textarea class="form-control paddingLeft12px" style="width: 100%" id="date_block_note" name="date_block_note" placeholder="Note"></textarea>
                              </div>
                              <div class="break20px"></div>
                              <h6>Block For</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <input type="text" class="form-control" value="" name="date_block_for" id="date_block_for" placeholder="Block for">
                                 <input type="hidden" name="date_block_for_ids" id="date_block_for_ids" value="">
                                 <!-- <input class="form-control nice-select" type="text" placeholder="All Staff" /> -->
                              </div>
                           </div>
                           <input class="btn btn-block btn-mobile break10px" type="submit" value="Block" name="Block">
                           <!-- <a class="btn btn-block btn-mobile break10px">Block</a> -->
                        </form>
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
                        <form name="block_date_add" id="block_time_add" method="post" action="{{ url('api/add_block_time') }}" enctype="multipart/form-data">
                           <div class="mobile-control">
                              <h6>Select Time</h6>
                              <div class="break10px"></div>
                              <div class="row">
                                 <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                       <input id="bolck_start_time" type="text" class="form-control" name="bolck_start_time" placeholder="Start Time">
                                       <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                 </div>
                                 <div class="col-xs-2 text-center">
                                    <label class="customlabel">to</label>    
                                 </div>
                                 <div class="col-xs-5">
                                    <div class="input-group custom-group">
                                       <input id="bolck_end_time" type="text" class="form-control" name="bolck_end_time" placeholder="End Time">
                                       <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-clock.png')}}"/> </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="input-group custom-group">
                                 <input id="block_time_date" type="text" class="form-control" name="block_time_date" placeholder="Date" style="position: relative; z-index: 100000;">   
                                 <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                              </div>
                              <!-- <div class="input-group custom-group">
                                 <input id="block_time_reason" type="text" class="form-control" name="block_time_reason" placeholder="Reasons">   
                              </div> -->
                              <div class="break10px"></div>
                              <h6>Reasons</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <textarea class="form-control paddingLeft12px" style="width: 100%" id="block_time_reason" name="block_time_reason" placeholder="Reasons"></textarea>
                              </div>
                              <h6>Note</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <textarea class="form-control paddingLeft12px" style="width: 100%" id="block_time_note" name="block_time_note" placeholder="Note"></textarea>
                              </div>
                              <div class="break20px"></div>
                              <h6>Block For</h6>
                              <div class="break10px"></div>
                              <div class="custom-group">
                                 <input id="time_block_for" type="text" class="form-control" name="time_block_for" placeholder="Block for"> 
                                 <input type="hidden" name="time_block_for_ids" value="" id="time_block_for_ids">
                                 <!-- <input class="form-control nice-select" type="text" placeholder="All Staff" /> -->
                              </div>
                           </div>
                           <input class="btn btn-block btn-mobile break10px" type="submit" value="Block" name="Block">
                           <!-- <a class="btn btn-block btn-mobile break10px">Block</a> -->
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade mb-custmmodal" id="staffListModalForTime" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content--> 
            <div class="popupInside new-modalcustm">
               <form name="" id="" method="post" action="" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">×</button>
                     <h4 class="modal-title">Staff List</h4>
                  </div>
                  <div class="filter-op">
                     <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="staff-select-all-time">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="staff-deselect-all-time">Deselect All</a></span>
                  </div>
                  <div class="modal-body">
                     <div class="notify" >
                        <input type="text" id="staffFilterTime" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                        <?php
                           foreach ($stuffs_list['stuff_list'] as $key => $value)
                           
                           {   
                           
                           ?>
                        <div class="user-bkd">
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
                           <div class="check-ft">
                              <input name="filter_stuff_id_time" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">
                           </div>
                        </div>
                        <?php
                           }
                           
                           ?>
                     </div>
                     <div class="butt-pop-ft">
                        <button type="submit" id="add-stuff-into-input-time" class="btn btn-primary butt-next">Done</button> 
                        <a href="JavaScript:Void(0);" id="cancel-staff-list-time" class="btn btn-primary butt-next">Cancel</a> 
                     </div>
                  </div>
               </form>
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
                     <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="staff-select-all">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="staff-deselect-all">Deselect All</a></span>
                  </div>
                  <div class="modal-body">
                     <div class="notify" >
                        <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                        <?php
                           foreach ($stuffs_list['stuff_list'] as $key => $value)
                           
                           {   
                           
                           ?>
                        <div class="user-bkd">
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
                           <div class="check-ft"> 
                              <input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">
                           </div>
                        </div>
                        <?php
                           }
                           
                           ?>
                     </div>
                     <div class="butt-pop-ft">
                        <button type="submit" id="add-stuff-into-input" class="btn btn-primary butt-next">Done</button> 
                        <a href="JavaScript:Void(0);" id="cancel-staff-list" class="btn btn-primary butt-next">Cancel</a> 
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Add Appoitment --> 
      <div class="modal fade mb-custmmodal" id="myModaladdappoinmentReschedule" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content--> 
            <div class="popupInside new-modalcustm">
               <form name="reschedule_appoitment" id="reschedule_appoitment" method="post" action="{{ url('api/reschedule_appoitment') }}" enctype="multipart/form-data">
                  <input type="hidden" name="reshedule_appointment_id" value="" id="reshedule_appointment_id">
                  <input type="hidden" name="reshedule_service_id" value="" id="reshedule_service_id">
                  <input type="hidden" name="reshedule_staff_id" id="reshedule_staff_id" value="">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button> 
                     <h4 class="modal-title"> Reschedule Appointments</h4>
                  </div>
                  <div class="modal-body">
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
                        <!-- <button type="button" >Submit</button> --> 
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Reshedule Appoitment End-->
      <!-- Add Appoitment --> 
      <div class="modal fade" id="myModaladdappoinment" role="dialog">
         <div class="modal-dialog">
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
                              <div id="client_error">
                                 <label >Select Client</label>
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
                              <div id="appoinment_service_error">
                                 <label >Select Service</label>
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
                              <div id="staff_error">
                                 <label >Select Staff</label>
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
                              <label >Date</label>
                              <div id="date_error"> <input id="appointmentdate" type="text" class="form-control" name="date" placeholder="Date" style="position: relative; z-index: 100000;border-left: 1px solid #ccc;"> </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label >Time</label>
                              <div id="appointmenttime_error"> <input id="appointmenttime" type="text" class="form-control" name="appointmenttime" placeholder="Time" style="border-left: 1px solid #ccc;"> </div>
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
                              <label>Notes</label>
                              <div class="textarea-md" id="appoinment_note_error"> 
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
                        <!-- <button type="button" >Submit</button> --> 
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- End Appoitment -->
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
         
         function showUl(obj) {
         
         $(obj).find("ul").fadeToggle();
         
         $(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();
         
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
      <script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
      <script src="{{asset('public/assets/mobile/js/ncrts.js')}}"></script>
      <script src="{{asset('public/assets/mobile/js/ncrtsdev.js')}}"></script>
      <script>
         $( function() {
         
            var $var = $("#appointmentdate,#reshedule_appointmentdate,#block_time_date"); 
         
                $var.datepicker({
         
                minDate:0,
         
            });
         
            var $var2 = $("#client_dob,#edit_client_dob"); 
         
                $var2.datepicker({
         
                    maxDate:0,
         
            });
         
            /*var $dp2 = $("#reshedule_appointmentdate"); 
         
            $dp2.datepicker({
         
                //changeYear: true,
         
                //changeMonth: true,
         
                minDate:1,
         
            });*/
         
         
         
            var $dp3 = $("#block_date"); 
         
            $dp3.multiDatesPicker({
         
            minDate:0,
         
            });   
         
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
         
         
         
         /*Add More Section Start*/
         
          function AddReadMore() {
         
          //This limit you can set after how much characters you want to show Read More.
         
          var carLmt = 280;
         
          // Text to show when text is collapsed
         
          var readMoreTxt = " ... show more";
         
          // Text to show when text is expanded
         
          var readLessTxt = " show less";
         
         
         
         
         
          //Traverse all selectors with this class and manupulate HTML part to show Read More
         
          $(".addReadMore").each(function() {
         
              if ($(this).find(".firstSec").length)
         
                  return;
         
         
         
              var allstr = $(this).text();
         
              if (allstr.length > carLmt) {
         
                  var firstSet = allstr.substring(0, carLmt);
         
                  var secdHalf = allstr.substring(carLmt, allstr.length);
         
                  var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
         
                  $(this).html(strtoadd);
         
              }
         
         
         
          });
         
          //Read More and Read Less Click Event binding
         
          $(document).on("click", ".readMore,.readLess", function() {
         
              $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
         
          });
         
         }
         
         $(function() {
         
          //Calling function after Page Load
         
          AddReadMore();
         
         });
         
         /*Add More Section End*/
         
      </script>
      @yield('custom_js')
   </body>
</html>