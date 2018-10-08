@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft" style="padding-bottom:8px">Staff Details</div>
         <div class="upr-rgtsec">
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
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <div id="custom-search-input">
               <a href="#" class="imp-st" data-toggle="tooltip" title="Import Staff"><i class="fa fa-download"></i> </a> <a href="#" class="exp-st"  data-toggle="tooltip" title="Export Staff"><i class="fa fa-external-link "></i> </a>
               <div class="input-group col-md-12">
                  <input type="text" class="search-staff form-control" placeholder="Search Staff" />
                  <span class="input-group-btn">
                  <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
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
                <a>No Staff created yet</a>
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
                            <li><a href="javascript:void(0);"  data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </a></li>
                        </ul>
                    </div>
                    <?php 
                    if(!empty($staff_list)){
                    ?>
                    <div class="staff-detailuser">
                        <img id="staffImgDisp" src="" class="img-circle" alt="" width="55" height="55">
                        <h4><b id="staffNameDisp"></b> <a href="#" style="font-size: 14px; margin-left: 10px; font-weight: 300;"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> </a></h4>
                        <p id="staffEmailDisp"></p>
                    </div>
                    <!-- Nav tabs -->
                    <div class="staff-detail">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" id="detailsTab" href="#tab1">Details</a></li>
                            <li><a data-toggle="tab" href="#tab2">Availability</a></li>
                            <li><a data-toggle="tab" href="#tab3">Block Time</a></li>
                            <li><a data-toggle="tab" href="#tab4">Postal Codes</a></li>
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
                                            <button type="button" id="isBlocked" class="btn btn-sm btn-toggle pull-right" data-toggle="button" aria-pressed="true" autocomplete="off">
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
                            <p>No record found</p>
                            </div>
                            <div id="tab3" class="tab-pane fade">
                            <!--<h3>Menu 3</h3>-->
                            <p>No record found</p>
                            </div>
                            <div id="tab4" class="tab-pane fade">
                            <!--<h3>Menu 4</h3>-->
                            <p>No record found</p>
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
@endsection

@section('custom_js')
<script>
$('.stafflistitem').click(function(){
    $('.stafflistitem').removeClass('active');
    $(this).addClass('active');
    var data = $(this).data('json');
    $('#detailsTab').trigger('click');

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
        if(data.is_blocked == 1){
            $('#isBlocked').removeClass('active');
        }else{
            $('#isBlocked').addClass('active');
        }
    }

    $('#isInternalStaff').removeClass('active');
    if(data.is_internal_staff !== undefined){
        if(data.is_internal_staff == 0){
            $('#isInternalStaff').removeClass('active');
        }else{
            $('#isInternalStaff').addClass('active');
        }
    }

    $('#isLoginAllowed').removeClass('active');
    if(data.is_login_allowed !== undefined){
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
$(document).ready(function(){
    $('.stafflistitem').eq(0).trigger('click');
});
</script>

@endsection