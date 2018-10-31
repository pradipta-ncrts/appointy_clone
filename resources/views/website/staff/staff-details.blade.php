@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft" style="padding-bottom:8px">Staff Details</div>
         <!--<div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="#">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>-->
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <div id="custom-search-input">
               <a href="javascript:void(0);" id="import_staff_icon" class="imp-st" data-toggle="tooltip" title="Import Staff"><i class="fa fa-download"></i> </a> 
               <form name="staff_import_form" id="staff_import_form" action="{{url('api/staff_import')}}" method="post">
               <input type="file" name="staff_import_excel" id="staff_import_excel" style="display:none;" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
               </form>
               <a href="{{url('staff-export')}}" class="exp-st"  data-toggle="tooltip" title="Export Staff"><i class="fa fa-external-link "></i> </a>
               <div class="input-group col-md-12">
                  <input type="text" name="staff_search_text" id="staff_search_text" class="search-staff form-control" placeholder="Search Staff" <?php if(!empty($staff_search_text)) { ?> value="<?php echo $staff_search_text;?>" <?php } ?> />
                  <span class="input-group-btn">
                  <button class="btn btn-danger" id="staff_search_btn" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                  </span>
               </div>
            </div>
            <div class="stf-list heightfull">
            <?php
                //echo '<pre>'; print_r($staff_list);
                if(!empty($staff_list)){
                    foreach($staff_list as $staff){
            ?>
               <a href="javascript:void(0);" class="stafflistitem" data-json='<?php echo str_replace("'",'',json_encode($staff));?>'>
                    <?php if($staff->staff_profile_picture != ''){ ?>
                        <img class="user-pic" src="<?php echo $staff->staff_profile_picture;?>" width="35px" height="35px" /> 
                    <?php } else { ?>
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                    <?php } ?>
                  
                    <div>
                        <h3><?php echo ucwords($staff->full_name);?></h3>
                        <small>30min</small>
                    </div>
               </a>
            <?php 
                } } else { 
            ?>
                <a>No staff found</a>
            <?php 
                }   
            ?>
            </div>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class=" showDekstop clearfix">
               <div class="col-md-12">
                    <div class="custm-linkedt">
                        <ul>
                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModalnewteam" title="Add Staff"><i class="fa fa-plus" aria-hidden="true"></i> </a></li>
                            <?php 
                            if(!empty($staff_list)){
                            ?>
                            <li><a href="javascript:void(0);" id="deleteStaff" data-staff-id="" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php 
                    if(!empty($staff_list)){
                    ?>
                    <div class="staff-detailuser">
                        <img id="staffImgDisp" src="" class="img-circle" alt="" width="55" height="55">
                        <h4><b id="staffNameDisp"></b> <a href="javascript:void(0);" id="editStaff" data-staff-id="" style="font-size: 14px; margin-left: 10px; font-weight: 300;" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> </a></h4>
                        <p id="staffEmailDisp"></p>
                    </div>
                    <!-- Nav tabs -->
                    <div class="staff-detail">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab1"id="detailsTab">Details</a></li>
                            <li><a data-toggle="tab" href="#tab2" id="availabilityTab">Availability</a></li>
                            <li><a data-toggle="tab" href="#tab3" id="block_time" >Block Time</a></li>
                            <li><a data-toggle="tab" href="#tab4" id="postalcodeTab">Postal Codes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="staff-detailtab-bx">
                                    <ul>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Staff Description</h4>
                                                <p id="staffDesc">No Description</p>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Active</h4>
                                                <p>Disable this to temporarily suspend this staff's account. The staff details will not be deleted from the
                                                    system
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" id="isBlocked" class="isBlocked btn btn-sm btn-toggle pull-right" data-toggle="button" aria-pressed="true" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Internal Staff</h4>
                                                <p>Internal staff cannot be viewed or booked by customers.</p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="isInternalStaff" type="button" class="btn btn-sm btn-secondary btn-toggle pull-right" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Login Allowed</h4>
                                                <p id="loginAllowedMsg">Restrict Jason to login next time. Allow Jason to view/manage/block dates and times for their schedule
                                                    only. Staff can also search customers but cannot export the customer list
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button   id="isLoginAllowed" type="button" class="btn btn-sm btn-secondary btn-toggle pull-right" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Booking URL</h4>
                                                <p id="bookingUrl">https://booking.appointy.com/</p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-default pull-right"> <i class="fa fa-files-o" aria-hidden="true"></i> COPY </button>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Integrations</h4>
                                                <p>No Integrations</p>
                                            </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                            <div class="col-sm-10">
                                                <h4>Email Verification</h4>
                                                <p id="staffEmail">lamie74@gmail.com <span class="label label-danger"><i>Not Verified</i></span></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-default pull-right"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> SEND EMAIL</button>
                                            </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane fade">
                                <!--<h3>Menu 2</h3>-->
                                <!--<p>No record found</p>-->
                                <!--<ul class="nav nav-tabs staff-inertab">
                                    <li class="active"><a data-toggle="tab" href="#regulariner1" aria-expanded="false">REGULAR</a></li>
                                    <li ><a data-toggle="tab" href="#irregulariner1" aria-expanded="true">IRREGULAR</a></li>
                                </ul>-->
                                <div class="tab-content" style="padding:0;">
                                    <div id="regulariner1" class="tab-pane fade active in">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                            <div class="dropdown custm-uperdrop">
                                                <button class="btn dropdown-toggle staff-drptxt" type="button" data-toggle="dropdown" aria-expanded="false">Current Schedule (23 May 2018 - 01 Jan 2070)</button>
                                                <!--<ul class="dropdown-menu">
                                                    <li class="custm-staffdrp">Current Schedule (23 May 2018 - 01 Jan 2070) 
                                                        <a href="#" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil"></i></a>
                                                        <a href="#"><i class="fa fa-trash-o"></i></a>
                                                    </li>
                                                    <li><a href="#" data-toggle="modal" data-target="#myModalnew-schedule"> Add new schedule </a></li>
                                                </ul>-->
                                            </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="dropdown custm-uperdrop">
                                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" data-toggle="modal" data-target="#myModalregular">Regular</a></li>
                                                    <!--<li><a href="#" data-toggle="modal" data-target="#myModalirregular">Irregular</a></li>-->
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="tableBH-table">
                                            <table class="table table-bordered table-custom1 table-bh tableBhMobile">
                                                <thead>
                                                    <tr>
                                                        <th>SERVICES</th>
                                                        <th>Monday</th>
                                                        <th>Tuesday</th>
                                                        <th>Wednesday</th>
                                                        <th>Thursday</th>
                                                        <th>Friday</th>
                                                        <th>Saturday</th>
                                                        <th>Sunday</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="staff-availability-section">
                                                    <!--<tr>
                                                        <td>
                                                            <div class="custm-tblebx"> <img src="http://localhost/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">SHower</a> (60m) </div>
                                                            <div class="edit-staff">
                                                            <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-delete.png" height="15">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <td data-column="Sunday">
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <td data-column="Monday">
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <td data-column="Tuesday">
                                                            <ul>
                                                            <li>10:00 AM</li>
                                                            <li>07:30 PM</li>
                                                            </ul>
                                                            <div class="edit-staff">
                                                            <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <td></td>
                                                        <td data-column="Wednesday">
                                                            <ul>
                                                            <li>10:00 AM</li>
                                                            <li>07:30 PM</li>
                                                            </ul>
                                                            <div class="edit-staff">
                                                            <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <td data-column="Thursday"></td>
                                                        <td data-column="Friday">
                                                            &nbsp;
                                                            <div class="edit-staff">
                                                            <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </td>
                                                    </tr>-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--<div id="irregulariner1" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6 text-center">
                                            <div class="dropdown staff-irregular-txt">
                                                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                                <button class="btn dropdown-toggle staff-drptxt" type="button" data-toggle="dropdown">Aug 06 - Aug 12</button>
                                                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                            </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="dropdown custm-uperdrop">
                                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><img src="images/add-circular-button.png" alt="" height="18"></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" data-toggle="modal" data-target="#myModalregular">Regular</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#myModalirregular">Irregular</a></li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="tableBH-table">
                                            <table class="table table-bordered table-custom1 table-bh tableBhMobile">
                                            <thead>
                                                <tr>
                                                    <th>SERVICES</th>
                                                    <th>Mon06</th>
                                                    <th>Tue07</th>
                                                    <th>Wed08</th>
                                                    <th>Thu09</th>
                                                    <th>Fri10</th>
                                                    <th>Sat11</th>
                                                    <th>Sun12</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="custm-tblebx"> <img src="http://localhost/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">SHower</a> (60m) </div>
                                                        <div class="edit-staff">
                                                        <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-delete.png" height="15">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </td>
                                                    <td data-column="Sunday">
                                                        <div class="clearfix"></div>
                                                    </td>
                                                    <td data-column="Monday">
                                                        <div class="clearfix"></div>
                                                    </td>
                                                    <td data-column="Tuesday">
                                                        &nbsp;
                                                        <div class="edit-staff">
                                                        <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </td>
                                                    <td></td>
                                                    <td data-column="Wednesday">
                                                        <ul>
                                                        <li>10:00 AM</li>
                                                        <li>07:30 PM</li>
                                                        </ul>
                                                        <div class="edit-staff">
                                                        <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </td>
                                                    <td data-column="Thursday"></td>
                                                    <td data-column="Friday">
                                                        <ul>
                                                        <li>10:00 AM</li>
                                                        <li>07:30 PM</li>
                                                        </ul>
                                                        <div class="edit-staff">
                                                        <img src="http://localhost/squeedr/public/assets/website/images/business-hours/tbl-edit.png" height="15">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <div id="tab3" class="tab-pane fade">

                                <ul class="nav nav-tabs tabnew-staff">
                                    <li class="active"><a data-toggle="tab" href="#tabnewadd" aria-expanded="true">Date</a></li>
                                    <li><a data-toggle="tab" href="#tabnewadd1" aria-expanded="true">Time of Date</a></li>
                                    <!--<li><a data-toggle="tab" href="#tabnewadd2" aria-expanded="true">Calender</a></li>-->
                                    <li class="pull-right"> 
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalblockdate">Block Date</button>
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalblocktime">Block Time</button>
                                    </li>
                                </ul>
                            
                                <div class="tab-content">
                                    <div id="tabnewadd" class="tab-pane fade in active">
                                        <h3 class="tabnewtxt">Unavailable Dates</h3>
                                        <div id="blockedDates">
                                            
                                        </div>
                                    </div>
                                    <div id="tabnewadd1" class="tab-pane fade">
                                        <h3 class="tabnewtxt">Unavailable Times</h3>
                                        <div id="blockedTimes">
                                            
                                        </div>
                                        
                                    </div>
                                    <!--<div id="tabnewadd2" class="tab-pane fade">
                                    <h3>Calendar</h3>
                                    <p>Some content in menu 2.</p>
                                    </div>-->
                                </div>
                            </div>
                            <div id="tab4" class="tab-pane fade">
                                <h3 class="tabnewtxt1">Area codes</h3>
                                <div class="dropdown custm-uperdrop">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">All<img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="show-postal-code" data-status="all" href="javascript:void(0)">All</a></li>
                                        <li><a class="show-postal-code" data-status="active" href="javascript:void(0)">Active<!-- <span class="badge">15</span> --></a></li>
                                        <li><a class="show-postal-code" data-status="inactive" href="javascript:void(0)">Inactive<!-- <span class="badge">5</span> --></a></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary btn-xs add-area-code">Add</button>
                                </div>
                                <p class="tabnewp">Area codes are defined geographical boundaries within a location. Staff can be assigned to these area codes. Customers will only be shown staff members in the area code they select</p>
                                <div class="staff-detailtab-bx">
                                    <ul>
                                        <li>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <p>Show area codes on customer interface</p>
                                                </div>

                                                <div class="col-sm-2">
                                                    <button type="button" id="postlcode_customer_interface" class="postlcode_customer_interface btn btn-sm btn-toggle pull-right" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                        <div class="handle"></div>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="postal-cdbx">
                                    <!-- <div class="dropdown stff-drp">
                                        <button class="btn dropdown-toggle btn-xs" type="button" data-toggle="dropdown" aria-expanded="false" title="Select"><i class="fa fa-minus-circle" aria-hidden="true"></i><img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""></button>
                                        <ul class="dropdown-menu">
                                            <li><a id="checked-all" href="javascript:void(0)">All</a></li>
                                            <li><a id="unchecked-all" href="javascript:void(0)">None</a></li>
                                        </ul>
                                    </div> -->
                                    <button type="button" class="btn btn-default btn-xs set-status" data-status="inactive" title="Set Inactive"><i class="fa fa-ban" aria-hidden="true"></i></button>

                                    <button type="button" class="btn btn-default btn-xs set-status" data-status="active" title="Set Active"><i class="fa fa-check" aria-hidden="true"></i></button>
                                </div>

                                <div class="tableBH-table stfftable" id="postal_code_html">
                                    <table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Area</th>
                                                <th>Assigned Staffs</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <!--   <tr>
                                                <td colspan="4">No data found.</td>
                                            </tr> -->
                                            
                                            <!-- <tr>
                                                <td>
                                                    <div class="custm-tblebx">
                                                        <input name="staff_send_email" type="checkbox" value="1"> 700081
                                                    </div>
                                                </td>
                                                <td>India</td>
                                                <td>0</td>
                                                <td>Active</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
               </div>
            </div>
         </div>

         <div class="custm-tab team-memtab">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#tabmenu1">Active</a></li>
               <li><a data-toggle="tab" href="#tabmenu2">Inactive</a></li>
            </ul>
            <div class="tab-content">
               <div id="tabmenu1" class="tab-pane fade in active">
                  <div class="mobileStaff showMobile" >
                     <div class="whitebox">
                        <h2>Dr. Concepcion M.</h2>
                        <span>Psychiatrist</span>
                        <ul>
                           <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                           <li><i class="fa fa-phone"></i>802-438-0497</li>
                        </ul>
                        <ol>
                           <li>Addiction, Alcoholism</li>
                           <li>Sleep Medicine</li>
                           <li><a>More </a></li>
                        </ol>
                     </div>
                     <div class="whitebox">
                        <h2>Dr. Concepcion M.</h2>
                        <span>Psychiatrist</span>
                        <ul>
                           <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                           <li><i class="fa fa-phone"></i>802-438-0497</li>
                        </ul>
                        <ol>
                           <li>Addiction, Alcoholism</li>
                           <li>Sleep Medicine</li>
                           <li><a>More </a></li>
                        </ol>
                     </div>
                  </div>
               </div>
               <div id="tabmenu2" class="tab-pane fade">
                  <p>Some content in tab menu 2.</p>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>

<div class="modal fade" id="myModaleditstaff" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content-->
        <div class="modal-content new-modalcustm">
            <form name="edit_team_member_form" id="edit_team_member_form" method="post" action="{{url('api/edit_staff')}}" enctype="multipart/form-data">
                <input type="hidden" name="staff_id" id="edit_staff_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Update Team Member</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_fullname_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_staff_fullname" type="text" class="form-control" name="staff_fullname" placeholder="Full Name" >
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_username_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_staff_username" type="text" class="form-control" name="staff_username" placeholder="Username" disabled="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_email_error"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="edit_staff_email" type="text" class="form-control" name="staff_email" placeholder="Email Address" disabled="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_mobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_mobile" type="text" class="form-control" name="staff_mobile" placeholder="Mobile" style="width: 92%;">               
                            </div>
                            <a style="position: absolute; right:15px; top:8px; font-size: 18px" role="button" data-toggle="collapse" data-target="#edit_other_phone" id="edit_more_phone"><i class="fa fa-plus"></i></a>
                        </div>
                        </div>
                    </div>
                    <div class="row collapse" id="edit_other_phone" >
                        <div class="col-md-12">
                        <div class="form-group" id="edit_home_phone_error">
                            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_home_phone" type="text" class="form-control" name="staff_home_phone" placeholder="Home Phone">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_work_phone_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_work_phone" type="text" class="form-control" name="staff_work_phone" placeholder="Work Phone">
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_category_error">
                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                <div class="form-group nomarging color-b" >
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="staff_category" id="edit_staff_category" >
                                    <option value="">Select Category </option>
                                    <?php
                                    if(!empty($category_list))
                                    foreach ($category_list as $key => $value)
                                    {
                                        echo "<option value='".$value->category_id."'>".$value->cat."</option>";
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
                            <div class="input-group textarea-md" id="edit_expertise_error"> <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                                <textarea style="width: 100%" name="staff_expertise" id="edit_staff_expertise" placeholder="Expertise (i.e. Insomnia, Sleep disorder, Hyperactivity,...)"></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group textarea-md" id="edit_description_error"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                <textarea style="width: 100%" name="staff_description" id="edit_staff_description" placeholder="Description"></textarea>
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
                                <div class="add-picture"><img id="edit_staff_image" src="#" alt="" width="60px" height="60px" /></div>
                                <!--<div class="add-picture-text">UPLOAD PICTURE</div>-->
                                <input type="file" name="staff_profile_picture" id="edit_staff_profile_picture" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
                            </div>
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
<div class="modal fade" id="addAreaCode" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <form name="area_code" id="area_code" method="post" action="{{ url('api/area_code') }}" enctype="multipart/form-data">
            <input type="hidden" name="staff_id" id="postal_code_staff_id" value="">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Area Code</h4>
         </div>
         <div class="modal-body clr-modalbdy">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="input-group"> <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input id="area" type="text" class="form-control" name="area" placeholder="Area name">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="input-group"> <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                        <input id="pin_no" type="text" class="form-control" name="pin_no" placeholder="Pin No">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="col-md-12 text-center">
               <input type="submit" value="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">
            </div>
         </div>
     </form>
      </div>
   </div>
</div>
@endsection


@section('custom_js')
<script>
$('.stafflistitem').click(function(){
    
    $('.stafflistitem').removeClass('active');
    $(this).addClass('active');
    var data = $(this).data('json');
    $('#detailsTab').trigger('click');

    $("#deleteStaff").attr('data-staff-id',data.staff_id);
    $("#editStaff").attr('data-staff-id',data.staff_id);

    $('#staffDesc').html("");
    if(data.description !== undefined){
        $('#staffDesc').html(data.description);
    }
    
    $('#loginAllowedMsg').html("");
    if(data.full_name !== undefined){
        $('#loginAllowedMsg').html("Restrict "+data.full_name+" to login next time. Allow "+data.full_name+" to view/manage/block dates and times for their schedule only. Staff can also search customers but cannot export the customer list");
    }
    $('#bookingUrl').html("");
    if(data.booking_url !== undefined){
        $('#bookingUrl').html(data.booking_url);
    }
    $('#staffNameDisp').html("");
    if(data.full_name !== undefined){
        $('#staffNameDisp').html(data.full_name);
    }
    $('#staffEmailDisp').html("");
    if(data.email !== undefined){
        $('#staffEmailDisp').html(data.email);
    }
    $('#staffEmail').html("");
    if(data.email !== undefined){
        var temp = data.email+"&nbsp;";
        if(data.is_email_verified == 0){
            temp += '<span class="label label-danger"><i>Not Verified</i></span>';
        }else{
            temp += '<span class="label label-success"><i>Verified</i></span>';
        }
        $('#staffEmail').html(temp);
    }

    $('#isBlocked').removeClass('active');
    if(data.is_blocked !== undefined){
        $('#isBlocked').attr('data-block-status',data.is_blocked);
        $('#isBlocked').attr('data-staff-id',data.staff_id);
        if(data.is_blocked == 1){
            $('#isBlocked').removeClass('active');
        }else{
            $('#isBlocked').addClass('active');
        }
    }

    $('#isInternalStaff').removeClass('active');
    if(data.is_internal_staff !== undefined){
        $('#isInternalStaff').attr('data-internal-staff',data.is_internal_staff);
        $('#isInternalStaff').attr('data-staff-id',data.staff_id);
        if(data.is_internal_staff == 0){
            $('#isInternalStaff').removeClass('active');
        }else{
            $('#isInternalStaff').addClass('active');
        }
    }

    $('#isLoginAllowed').removeClass('active');
    if(data.is_login_allowed !== undefined){
        $('#isLoginAllowed').attr('data-login-allowed',data.is_login_allowed);
        $('#isLoginAllowed').attr('data-staff-id',data.staff_id);
        if(data.is_login_allowed == 0){
            $('#isLoginAllowed').removeClass('active');
        }else{
            $('#isLoginAllowed').addClass('active');
        }
    }

    $('#staffImgDisp').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");
    if(data.staff_profile_picture !== undefined){
        if(data.staff_profile_picture == ""){
            $('#staffImgDisp').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");
        }else{
            $('#staffImgDisp').attr('src',data.staff_profile_picture);
        }
    }
});

    
$(document).on('click','#isBlocked',function(){
    var staff_id = '';
    var blocked_status = '';
    var staff_id = $(this).attr('data-staff-id');
    var blocked_status = $(this).attr('data-block-status');
    //alert(staff_id); return false;
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:blocked_status},{name:'type', value:'blocked'});
    $.ajax({
        url: baseUrl+"/api/change-status-staff", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            //console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"});
                if (blocked_status == '0') {
                    $('#isBlocked').attr('data-block-status','1');
                    $('#isBlocked').removeClass('active');
                } else {
                    $('#isBlocked').attr('data-block-status','0');
                    $('#isBlocked').addClass('active');
                }
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });

});

$(document).on('click','#isInternalStaff',function(){
    var staff_id = '';
    var internal_staff = '';
    var staff_id = $(this).attr('data-staff-id');
    var internal_staff = $(this).attr('data-internal-staff');
    //alert(staff_id); return false;
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:internal_staff},{name:'type', value:'internal_staff'});
    $.ajax({
        url: baseUrl+"/api/change-status-staff", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            //console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"});
                if (internal_staff == '0') {
                    $('#isInternalStaff').attr('data-internal-staff','1');
                    $('#isInternalStaff').addClass('active');
                } else {
                    $('#isInternalStaff').attr('data-internal-staff','0');
                    $('#isInternalStaff').removeClass('active');
                }
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });

});

$(document).on('click','#isLoginAllowed',function(){
    var staff_id = '';
    var login_allowed = '';
    var staff_id = $(this).attr('data-staff-id');
    var login_allowed = $(this).attr('data-login-allowed');
    //alert(login_allowed); return false;
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:login_allowed},{name:'type', value:'login_allowed'});
    $.ajax({
        url: baseUrl+"/api/change-status-staff", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            //console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"});
                if (login_allowed == '0') {
                    $('#isLoginAllowed').attr('data-login-allowed','1');
                    $('#isLoginAllowed').addClass('active');
                } else {
                    $('#isLoginAllowed').attr('data-login-allowed','0');
                    $('#isLoginAllowed').removeClass('active');
                }
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });

});


$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    $('#example').DataTable( {
        "paging":   false,
        //"info":     false
    } );

    $("#staff_search_btn").click(function(){
        var url = "<?php echo url('staff-details')?>";
        var staff_search_text = $("#staff_search_text").val();
        if(staff_search_text!=""){
            window.location.replace(url+'/'+staff_search_text);
        } else {
            window.location.replace(url);
        }
    });

    $('.stafflistitem').eq(0).trigger('click');

    $('#deleteStaff').click(function(e){
        e.preventDefault();
        var staff_id = $(this).attr('data-staff-id');
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will never access this staff!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, not now!",
        closeOnConfirm: false,
        closeOnCancel: true
        },function(isConfirm){

            if (isConfirm){
                var data = addCommonParams([]);
                //alert(serviceid);
                data.push({name:'staff_id', value:staff_id});
                $.ajax({
                    url: baseUrl+"/api/delete-staff", 
                    type: "POST", 
                    data: data, 
                    dataType: "json",
                    success: function(response) 
                    {
                        //console.log(response);
                        $('.animationload').hide();
                        if(response.result=='1')
                        {
                            swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );
                        }
                        else
                        {
                            swal("Error", response.message , "error");
                        }
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    },
                    complete: function()
                    {
                        //$('.animationload').hide();
                    }
                });
            }
        });
        
    });

    $('#editStaff').click(function(e){
        var staff_id = $(this).attr('data-staff-id');
        var data = addCommonParams([]);
        //alert(serviceid);
        data.push({name:'staff_id', value:staff_id});
        $.ajax({
            url: baseUrl+"/api/staff-details", 
            type: "POST", 
            data: data, 
            dataType: "json",
            success: function(response) 
            {
                //console.log(response);
                $('.animationload').hide();
                if(response.result=='1')
                {
                    if(response.staff_details.staff_profile_picture!=''){
                        var profile_picture = response.staff_details.staff_profile_picture;
                    } else {
                        profile_picture = "<?php echo asset('public/assets/website/images/business-hours/blue-user.png');?>";
                    }
                    $('#modalTitle').text('Update '+response.staff_details.full_name);
                    $('#edit_staff_fullname').val(response.staff_details.full_name);
                    $('#edit_staff_username').val(response.staff_details.username);
                    $('#edit_staff_email').val(response.staff_details.email);
                    $('#edit_staff_mobile').val(response.staff_details.mobile);
                    $('#edit_staff_home_phone').val(response.staff_details.home_phone);
                    $('#edit_staff_work_phone').val(response.staff_details.work_phone);
                    $("#edit_staff_category").val(response.staff_details.category_id).trigger('change');
                    $('#edit_staff_expertise').val(response.staff_details.expertise);
                    $('#edit_staff_description').val(response.staff_details.description);
                    $('#edit_staff_image').attr('src',profile_picture);
                    $('#edit_staff_id').val(response.staff_details.staff_id);
                    $('#myModaleditstaff').modal('show');
                }
                else
                {
                    swal("Error", response.message , "error");
                }
            },
            beforeSend: function()
            {
                $('.animationload').show();
            }
        });
        
    });

    $('#edit_team_member_form').validate({
            rules: {
                edit_staff_fullname: {
                    required: true
                },
                edit_staff_username: {
                    required: true
                },
                edit_staff_email: {
                    required: true,
                    email: true
                },
                edit_staff_mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                edit_staff_description: {
                    required: true
                }
            },
            messages: {
                edit_staff_fullname: {
                    required: 'Please enter fullname'
                },
                edit_staff_username: {
                    required: 'Please enter username'
                },
                edit_staff_email: {
                    required: 'Please enter email',
                    email: 'Please enter proper email'
                },
                edit_staff_mobile: {
                    required: 'Please enter mobile no',
                    number: 'Please enter proper mobile no',
                    minlength: 'Please enter minimum 10 digit mobile no',
                    maxlength: 'Please enter maximum 10 digit mobile no'
                },
                edit_staff_description: {
                    required: 'Please enter description'
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "staff_fullname") {
                    error.insertAfter($('#edit_fullname_error'));
                } else if (element.attr("name") == "staff_username") {
                    error.insertAfter($('#edit_username_error'));
                } else if (element.attr("name") == "staff_email") {
                    error.insertAfter($('#edit_email_error'));
                } else if (element.attr("name") == "staff_mobile") {
                    error.insertAfter($('#edit_mobile_error'));
                } else if (element.attr("name") == "staff_description") {
                    error.insertAfter($('#edit_description_error'));
                }
            },
            submitHandler: function(form) {
                var data = $(form).serializeArray();
                data = addCommonParams(data);
                var files = $("#edit_team_member_form input[type='file']")[0].files;
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
                            $('#myModaleditstaff').modal('hide');
                            swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            });
                            
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

    /*function readURLstaff(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit_staff_image').show();
                $('#edit_staff_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#edit_staff_image').hide();
        }
    }

    $("#edit_staff_profile_picture").change(function() {
        readURLstaff(this);
    });*/

    $('#block_time').click(function(){
        var staff_id = $('#editStaff').attr('data-staff-id');
        var data = addCommonParams([]);
        data.push({name:'staff_id', value:staff_id});
        $.ajax({
            url: "<?php echo url('api/block-times')?>",
            type: "post",
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response); //Success//
                if (response.response_status == 1) {
                    
                    var date_html = "";
                    if(response.block_dates.length > 0){
                        for(i = 0;i<response.block_dates.length;i++){
                            
                            date_html += '<div class="tabnewrow">';
                            date_html += '<div class="row">';
                            date_html += '<div class="col-md-4"> '+response.block_dates[i].month+' '+response.block_dates[i].year+'</div>';
                            date_html += '<div class="col-md-8">';
                            date_html += '<div class="tabnewdt">';
                            date_html += '<ul>';
                            for(j = 0;j<response.block_dates[i].block_dates.length;j++){
                                date_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_dates[i].block_dates[j]+'<i class="fa fa-trash delete_block_time" data-block-time-id="'+response.block_dates[i].block_id+'" aria-hidden="true" title="Delete!"></i></a></li>';
                            }
                            date_html += '</ul>';
                            date_html += '</div>';
                            date_html += '</div>';
                            date_html += '</div>';
                            date_html += '</div>';
                        }
                    } else {
                        date_html += '<div class="tabnewrow">';
                        date_html += '<div class="row">';
                        date_html += 'No records found';
                        date_html += '</div>';
                        date_html += '</div>';
                    }


                    var time_html = "";
                    if(response.block_times.length > 0){
                        for(i = 0;i<response.block_times.length;i++){
                            
                            time_html += '<div class="tabnewrow">';
                            time_html += '<div class="row">';
                            time_html += '<div class="col-md-4">'+response.block_times[i].block_date+'</div>';
                            time_html += '<div class="col-md-8">';
                            time_html += '<div class="tabnewdt">';
                            time_html += '<ul>';
                            for(j = 0;j<response.block_times[i].block_date_time.length;j++){
                                time_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_times[i].block_date_time[j].start_time+' - '+response.block_times[i].block_date_time[j].end_time+'<i class="fa fa-trash delete_block_time" aria-hidden="true" data-block-time-id="'+response.block_times[i].block_date_time[j].block_id+'" title="Delete!"></i></a></li>';
                            }
                            time_html += '</ul>';
                            time_html += '</div>';
                            time_html += '</div>';
                            time_html += '</div>';
                            time_html += '</div>';
                        }
                    } else {
                        time_html += '<div class="tabnewrow">';
                        time_html += '<div class="row">';
                        time_html += 'No records found';
                        time_html += '</div>';
                        time_html += '</div>';
                    }
					
                    $('#blockedDates').html(date_html);
                    $('#blockedTimes').html(time_html);
                    
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
    });

    $('#availabilityTab').click(function(){
        var staff_id = $('#editStaff').attr('data-staff-id');
        $('#staff-availability-section').html("");
        var data = addCommonParams([]);
        data.push({name:'staff_id', value:staff_id});
        $.ajax({
            url: "<?php echo url('api/staff_service_availability')?>",
            type: "post",
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response); //Success//
                /*if (response.response_status == 1) {
                    
                    var date_html = "";
                    if(response.block_dates.length > 0){
                        for(i = 0;i<response.block_dates.length;i++){
                            
                            date_html += '<div class="tabnewrow">';
                            date_html += '<div class="row">';
                            date_html += '<div class="col-md-4"> '+response.block_dates[i].month+' '+response.block_dates[i].year+'</div>';
                            date_html += '<div class="col-md-8">';
                            date_html += '<div class="tabnewdt">';
                            date_html += '<ul>';
                            for(j = 0;j<response.block_dates[i].block_dates.length;j++){
                                date_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_dates[i].block_dates[j]+'<i class="fa fa-trash delete_block_time" data-block-time-id="'+response.block_dates[i].block_id+'" aria-hidden="true" title="Delete!"></i></a></li>';
                            }
                            date_html += '</ul>';
                            date_html += '</div>';
                            date_html += '</div>';
                            date_html += '</div>';
                            date_html += '</div>';
                        }
                    } else {
                        date_html += '<div class="tabnewrow">';
                        date_html += '<div class="row">';
                        date_html += 'No records found';
                        date_html += '</div>';
                        date_html += '</div>';
                    }


                    var time_html = "";
                    if(response.block_times.length > 0){
                        for(i = 0;i<response.block_times.length;i++){
                            
                            time_html += '<div class="tabnewrow">';
                            time_html += '<div class="row">';
                            time_html += '<div class="col-md-4">'+response.block_times[i].block_date+'</div>';
                            time_html += '<div class="col-md-8">';
                            time_html += '<div class="tabnewdt">';
                            time_html += '<ul>';
                            for(j = 0;j<response.block_times[i].block_date_time.length;j++){
                                time_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_times[i].block_date_time[j].start_time+' - '+response.block_times[i].block_date_time[j].end_time+'<i class="fa fa-trash delete_block_time" aria-hidden="true" data-block-time-id="'+response.block_times[i].block_date_time[j].block_id+'" title="Delete!"></i></a></li>';
                            }
                            time_html += '</ul>';
                            time_html += '</div>';
                            time_html += '</div>';
                            time_html += '</div>';
                            time_html += '</div>';
                        }
                    } else {
                        time_html += '<div class="tabnewrow">';
                        time_html += '<div class="row">';
                        time_html += 'No records found';
                        time_html += '</div>';
                        time_html += '</div>';
                    }
					
                    $('#blockedDates').html(date_html);
                    $('#blockedTimes').html(time_html);
                    
                } else {
                    swal('Sorry!', response.response_message, 'error');
                }*/
                $('#staff-availability-section').html(response.html);
                //$('div.edit-staff').hide();
            },
            beforeSend: function() {
                $('.animationload').show();
            },
            complete: function() {
                $('.animationload').hide();
            }
        });
    });


    $('#add_staff_availability_form').validate({
            submitHandler: function(form) {
            var data = $(form).serializeArray();
            data = addCommonParams(data);
            var staff_id = $('#editStaff').attr('data-staff-id');
            data.push({name:'staff_id', value:staff_id});
            //console.log(data);
            $.ajax({
                url: form.action,
                type: form.method,
                data: data,
                dataType: "json",
                success: function(response) {
                    //console.log(response); //Success//
                    if (response.response_status == 1) {
                        $(form)[0].reset();
                        $('#myModalregular').modal('hide');
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
    
});


$(document).on('click', '#import_staff_icon', function(){
    $('#staff_import_excel').trigger('click');
});

$(document).on('change','#staff_import_excel',function(e){
    e.preventDefault();
    data = addCommonParams([]);
    var files = $("#staff_import_form input[type='file']")[0].files;
    var form_data = new FormData();
    if(files.length>0){
        for(var i=0;i<files.length;i++){
            form_data.append('staff_excel_file',files[i]);
        }
    }
    // append all data in form data 
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    $.ajax({
        url: baseUrl+"/api/staff_import", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"},
                function(){ 
                    location.reload();
                });
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        }
    });
});

$(document).on('click','.delete_block_time',function(e){
    e.preventDefault();
    //data = addCommonParams([]);
    var block_time_id = $(this).attr('data-block-time-id');
    var staff_id = $('#editStaff').attr('data-staff-id');
    
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will never access this blocked date/time!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, not now!",
        closeOnConfirm: false,
        closeOnCancel: true
        },function(isConfirm){

            if (isConfirm){
                var data = addCommonParams([]);
                //alert(serviceid);
                data.push({name:'block_time_id', value:block_time_id},
                          {name:'staff_id', value:staff_id});
                $.ajax({
                    url: baseUrl+"/api/delete_staff_block_time", // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    dataType: "json",
                    success: function(response) // A function to be called if request succeeds
                    {
                        //console.log(response);
                        $('.animationload').hide();
                        if(response.result=='1')
                        {
                            //swal("Success!", response.message, "success")
                            swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            });
                        }
                        else
                        {
                            swal("Error", response.message , "error");
                        }
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    }
                });
            }
        });


});

$(document).on('click','.delete_availability',function(e){
    e.preventDefault();
    var service_id = $(this).data('service-id');
    var staff_id = $(this).data('staff-id');
    
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will never access this blocked date/time!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, not now!",
        closeOnConfirm: false,
        closeOnCancel: true
        },function(isConfirm){

            if (isConfirm){
                var data = addCommonParams([]);
                //alert(serviceid);
                data.push({name:'service_id', value:service_id},
                            {name:'staff_id', value:staff_id});
                
                $.ajax({
                    url: baseUrl+"/api/delete_staff_availability", // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    dataType: "json",
                    success: function(response) // A function to be called if request succeeds
                    {
                        //console.log(response);
                        $('.animationload').hide();
                        if(response.result=='1')
                        {
                            //swal("Success!", response.message, "success")
                            swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            });
                        }
                        else
                        {
                            swal("Error", response.message , "error");
                        }
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    }
                });                                                             
            }
        });

    

});

$(document).on('click', '.add-area-code', function(){
    var staff_id = $('#editStaff').attr('data-staff-id');
    //alert(staff_id);
    $("#postal_code_staff_id").val(staff_id);
    $('#addAreaCode').modal('show');
});

$.validator.addMethod("phoneUS", function (phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 5 && phone_number.length < 7;
}, "Please enter valid pin no.");

$('#area_code').validate({
    //ignore: ":hidden:not(.selectpicker)",
    //ignore: [],
    rules: {
        'area': {
            required: true
        },
        'pin_no': {
            required: true,
            digits: true,
            phoneUS: true
        },
      },

    messages: {
        'area': {
            required: 'Please enter area name'
        },
        'pin_no': {
            required: 'Please enter pin no'
        },
    },

    submitHandler: function(form) {
      var data = $(form).serializeArray();
      data = addCommonParams(data);
      console.log(data);
      $.ajax({
          url: form.action,
          type: form.method,
          data:data ,
          dataType: "json",
          success: function(response) {
               console.log(response);
               $('.animationload').hide();
               if(response.result=='1')
               {
                  $('#area_code').trigger("reset");
                  $('#addAreaCode').modal('hide');
                  //swal(title: "Success", text: response.message.msg, type: "success");
                var postal_html = "";
                if(response.message.postal_data.length > 0)
                {
                    if(response.message.postal_data[i].status=='1')
                    {
                        var status = "Active";
                    }
                    else
                    {
                        var status = "Inactive";
                    }
                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';
                    for(i = 0;i<response.message.postal_data.length;i++)
                    {
                        postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';
                    }
                    postal_html +='</tbody>';
                }

                $("#postal_code_html").html(postal_html);
                swal("Success", response.message.msg , "success");
                  
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
    }
});

$('#postalcodeTab').click(function(){
    var staff_id = $('#editStaff').attr('data-staff-id');
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id});
    $.ajax({
        url: "<?php echo url('api/get_post_code')?>",
        type: "post",
        data: data,
        dataType: "json",
        success: function(response) {
            console.log(response); //Success//
            var postal_html = "";
            if(response.message.postal_data.length > 0)
            {
                if(response.message.postal_data[i].status=='1')
                {
                    var status = "Active";
                }
                else
                {
                    var status = "Inactive";
                }

                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                for(i = 0;i<response.message.postal_data.length;i++)
                {
                    postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';
                }
                postal_html +='</tbody>';
            }
            else
            {
                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';
                postal_html +='<tr><td colspan="4">No record found</td></tr>';
                postal_html +='</tbody>';
            }


            $('#postlcode_customer_interface').removeClass('active');
            if(response.message.postlcode_customer_interface.postlcode_customer_interface == '1')
            {
                $('#postlcode_customer_interface').addClass('active');
            }
            else
            {
                $('#postlcode_customer_interface').removeClass('active');
            }

            $("#postal_code_html").html(postal_html);
        },
        beforeSend: function() {
            $('.animationload').show();
        },
        complete: function() {
            $('.animationload').hide();
        }
    });
});

$('.set-status').click(function(){
    var staff_id = $('#editStaff').attr('data-staff-id');
    var status = $(this).data('status');
    var val = [];
    $(':checkbox:checked').each(function(i){
      val[i] = $(this).val();
    });
    //alert(val);
    //return false;
    if(val!='')
    {
        var data = addCommonParams([]);
        data.push({name:'staff_id', value:staff_id}, {name:'status', value:status}, {name:'ids', value:val});
        console.log(data);
        $.ajax({
            url: "<?php echo url('api/chnage_postal_code_status')?>",
            type: "post",
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response); //Success//
                var postal_html = "";
                if(response.message.postal_data.length > 0)
                {
                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                    for(i = 0;i<response.message.postal_data.length;i++)
                    {
                        if(response.message.postal_data[i].status=='1')
                        {
                            var status = "Active";
                        }
                        else
                        {
                            var status = "Inactive";
                        }
                        postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';
                    }
                    postal_html +='</tbody>';
                }
                else
                {
                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';
                    postal_html +='<tr><td colspan="4">No record found</td></tr>';
                    postal_html +='</tbody>';
                }

                $("#postal_code_html").html(postal_html);
            },
            beforeSend: function() {
                $('.animationload').show();
            },
            complete: function() {
                $('.animationload').hide();
            }
        });
    }
    else
    {
        swal("Error", "Please check any postal code" , "error");
    }
});

$('.show-postal-code').click(function(){
    var staff_id = $('#editStaff').attr('data-staff-id');
    var status = $(this).data('status');
    
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id}, {name:'status', value:status});
    console.log(data);
    $.ajax({
        url: "<?php echo url('api/postal_code_filter')?>",
        type: "post",
        data: data,
        dataType: "json",
        success: function(response) {
            console.log(response); //Success//
            var postal_html = "";
            if(response.message.postal_data.length > 0)
            {
                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                for(i = 0;i<response.message.postal_data.length;i++)
                {
                    if(response.message.postal_data[i].status=='1')
                    {
                        var status = "Active";
                    }
                    else
                    {
                        var status = "Inactive";
                    }
                    postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';
                }
                postal_html +='</tbody>';
            }
            else
            {
                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';
                postal_html +='<tr><td colspan="4">No record found</td></tr>';
                postal_html +='</tbody>';
            }

            $("#postal_code_html").html(postal_html);
        },
        beforeSend: function() {
            $('.animationload').show();
        },
        complete: function() {
            $('.animationload').hide();
        }
    });
});

$(document).on('click','#postlcode_customer_interface',function(){
    var staff_id = $('#editStaff').attr('data-staff-id');
    var data = addCommonParams([]);
    data.push({name:'staff_id', value:staff_id});
    $.ajax({
        url: baseUrl+"/api/change_postal_code_customer_interface", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                $('#postlcode_customer_interface').removeClass('active');
                if(response.message.postlcode_customer_interface == '1')
                {
                    $('#postlcode_customer_interface').addClass('active');
                }
                else
                {
                    $('#postlcode_customer_interface').removeClass('active');
                }
                swal({title: "Success", text: response.message.msg, type: "success"});
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });

});



</script>

@endsection