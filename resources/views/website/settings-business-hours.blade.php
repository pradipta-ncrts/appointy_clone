@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Business Hours</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
               <div id="custom-search-input" style="display:none;">
                  <div class="input-group col-md-12">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span> 
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <!-- <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div> -->
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         
         <div class="left-menu">
            <div id="custom-search-input">
               <div class="input-group col-md-12">
                  <input type="text" name="staff_search_text" id="staff_search_text" class="search-staff form-control" placeholder="Search <?=$type=='services' ? 'staff' : 'services';?>" <?php if(!empty($staff_search_text)) { ?> value="<?php echo $staff_search_text;?>" <?php } ?> />
                  <span class="input-group-btn">
                  <button class="btn btn-danger" id="staff_search_btn" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                  </span>
               </div>
            </div>
            <?php
         if($type=="services")
         {
         ?>
            <div class="stf-list heightfull">
            <?php
                //echo '<pre>'; print_r($staff_list);
                if(!empty($staff_list)){
                    foreach($staff_list as $staff){
            ?>
               <a href="javascript:void(0);" id="<?php echo $staff->staff_id;?>" class="stafflistitem">
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
            <?php
         }
         if($type=="staffs")
         {
         ?>
         <div class="stf-list heightfull">
               <?php
               //echo '<pre>'; print_r($service_list); die();
               if(!empty($service_list))
               {
                  foreach($service_list as $serv)
                  {
                     if($serv->is_blocked==0)
                     {
               ?>
               <a href="javascript:void(0);" id="<?php echo $serv->service_id;?>" class="servicelistitem">
                   <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" />
                  
                    <div>
                        <h3><?php echo ucwords($serv->service_name);?></h3>
                        <small>30min</small>
                    </div>
               </a>
               <?php 
                     }
                  } 
               } 
               else
               { 
               ?>
               <a>No service found</a>
               <?php 
               }   
               ?>
            </div>
         <?php
         }
         ?>
         </div>
         
      </div>
      <div class="rightpan" style="min-height:610px;">
         <div class="relativePostion">
            <div class=" showDekstop clearfix">
               <div class="col-md-12">
                  <!-- Nav tabs -->
                  <div class="staff-detail">
                     <ul class="nav nav-tabs">
                        <li class="<?=$type=="services" ? 'active' : '';?>" data-toggle="tooltip" data-placement="top" title="Staff View"><a id="tab-one" data-toggle="tab" href="#tab1"><img src="{{asset('public/assets/website/images/company-workers.png')}}" alt="" /></a></li>
                        <li class="<?=$type=="staffs" ? 'active' : '';?>" data-toggle="tooltip" data-placement="top" title="Services View"><a id="tab-two" data-toggle="tab" href="#tab2"><img src="{{asset('public/assets/website/images/servicesicon.png')}}" alt="" /></a></li>
                        <!-- <li data-toggle="tooltip" data-placement="top" title="List View"><a data-toggle="tab" href="#tab3"><img src="{{asset('public/assets/website/images/list.png')}}" alt="" /></a></li> -->
                       <!--  <li data-toggle="tooltip" data-placement="top" title="Add Additional Times"><a class="btn cus-discount-btn" data-toggle="modal" data-target="#myModallist-time"><img src="{{asset('public/assets/website/images/plus-rounded.png')}}" alt="" /></a></li> -->
                     </ul>
                     <div class="tab-content" style="position:relative;padding:0;">
                        <div id="tab1" class="tab-pane fade in active">
                           <ul class="nav nav-tabs staff-inertab">
                              <li class="active"><a data-toggle="tab" href="#regulariner">REGULAR</a></li>
                              <!-- <li><a data-toggle="tab" href="#irregulariner">IRREGULAR</a></li> -->
                           </ul>
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
                                       <?php
                                       if($type=="services")
                                       {
                                       ?>
                                          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
                                       <?php
                                       }
                                       else
                                       {
                                       ?>
                                          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" disabled=""><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
                                       <?php
                                       }
                                       ?>
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
                                                  <th><?=$type;?></th>
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
                        <div id="tab2" class="tab-pane fade">
                           <div id="tab1" class="tab-pane fade in active">
                              <ul class="nav nav-tabs staff-inertab">
                                 <li class="active"><a data-toggle="tab" href="#regulariner1">REGULAR</a></li>
                                 <!-- <li><a data-toggle="tab" href="#irregulariner1">IRREGULAR</a></li> -->
                              </ul>
                              <div class="tab-content" style="padding:0;">
                                 <div id="regulariner1" class="tab-pane fade in active">
                                    <div class="row">
                                       <div class="col-md-3"></div>
                                       <div class="col-md-6">
                                          <div class="dropdown custm-uperdrop">
                                             <button class="btn dropdown-toggle staff-drptxt" type="button" data-toggle="dropdown">Current Schedule (23 May 2018 - 01 Jan 2070)</button>
                                             <ul class="dropdown-menu">
                                                <li class="custm-staffdrp">Current Schedule (23 May 2018 - 01 Jan 2070) 
                                                   <a href="#" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil"></i></a>
                                                   <a href="#"><i class="fa fa-trash-o"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="modal" data-target="#myModalnew-schedule"> Add new schedule </a></li>
                                             </ul>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="dropdown custm-uperdrop">
                                             <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
                                             <ul class="dropdown-menu">
                                                <li><a href="#" data-toggle="modal" data-target="#myModalregular">Regular</a></li>
                                                <!-- <li><a href="#" data-toggle="modal" data-target="#myModalirregular">Irregular</a></li> -->
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
                                          <tbody>
                                             <tr>
                                                <td>
                                                   <div class="custm-tblebx"> <img src="{{asset('public/assets/website/images/noimage.png')}}" class="img-circle" alt="" width="35" height="35"> <a href="#">SHower</a> (60m) </div>
                                                   <div class="edit-staff">
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-delete.png')}}" height="15">
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
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
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
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </td>
                                                <td data-column="Thursday"></td>
                                                <td data-column="Friday">
                                                   &nbsp;
                                                   <div class="edit-staff">
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <!-- <div id="irregulariner1" class="tab-pane fade">
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
                                                   <div class="custm-tblebx"> <img src="{{asset('public/assets/website/images/noimage.png')}}" class="img-circle" alt="" width="35" height="35"> <a href="#">SHower</a> (60m) </div>
                                                   <div class="edit-staff">
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-delete.png')}}" height="15">
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
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
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
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
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
                                                      <img src="{{asset('public/assets/website/images/business-hours/tbl-edit.png')}}" height="15">
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                        <div id="tab3" class="tab-pane fade">
                           <div class="listview-txt">Choose Start Date: <span>07 Aug 2018</span> </div>
                           <a class="btn cus-discount-btn" data-toggle="modal" data-target="#myModallist-time"><i class="fa fa-plus" aria-hidden="true"></i> Add Additional Times </a>
                           <div class="tableBH-table">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-custom1 table-bh tableBhMobile">
                                 <tr>
                                    <td>Date</td>
                                    <td>Services</td>
                                    <td>Time</td>
                                 </tr>
                                 <tr>
                                    <td>Aug 07 2018</td>
                                    <td>SHower</td>
                                    <td>09:45 am - 11:30 am (1 hr 45 min) </td>
                                 </tr>
                                 <tr>
                                    <td>Aug 07 2018</td>
                                    <td>SHower</td>
                                    <td>09:45 am - 11:30 am (1 hr 45 min) </td>
                                 </tr>
                              </table>
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
<div id="popup">
   <div id="selectstaff">
      <div class="container-fluid">
         <div class="popupInside">
            <h3>Select Staff</h3>
            <ul>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}"/>
                  <label>Douglas N</label>
                  </a> 
               </li>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/grey-user.png')}}"/>
                  <label>Janice D</label>
                  </a> 
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<input type="hidden" name="editStaff" id="editStaff" value="">
<input type="hidden" name="editService" id="editService" value="">

@endsection

@section('custom_js')
<script type="text/javascript">
$("#staff_search_btn").click(function(){
  var url = "<?php echo url('settings-business-hours').'/'.$type;?>";
  var staff_search_text = $("#staff_search_text").val();
  if(staff_search_text!=""){
      window.location.replace(url+'/'+staff_search_text);
  } else {
      window.location.replace(url);
  }
});

$('.stafflistitem').click(function(){
     $('.stafflistitem').removeClass('active');
     $(this).addClass('active');
     //$('#tab-one').trigger('click');

     var staff_id = $(this).attr('id');
     $('#editStaff').val(staff_id);
     //alert(staff_id);
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

$('.stafflistitem').eq(0).trigger('click');

$('.servicelistitem').click(function(){
     $('.servicelistitem').removeClass('active');
     $(this).addClass('active');
     //$('#tab-two').trigger('click');

     var service_id = $(this).attr('id');
     $('#editService').val(service_id);
     //alert(service_id);
     $('#staff-availability-section').html("");
     var data = addCommonParams([]);
     data.push({name:'service_id', value:service_id});
     console.log(data);
     $.ajax({
         url: "<?php echo url('api/service_staff_availability')?>",
         type: "post",
         data: data,
         dataType: "json",
         success: function(response) {
             console.log(response); //Success//
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

$('.servicelistitem').eq(0).trigger('click');

$('#add_staff_availability_form').validate({
   submitHandler: function(form) {
   var data = $(form).serializeArray();
   data = addCommonParams(data);
   var staff_id = $('#editStaff').val();
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

$(document).on('click','.delete_availability',function(e){
    e.preventDefault();
    var service_id = $(this).data('service-id');
    var staff_id = $('#editStaff').val();
    
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

$(document).on('click','#tab-one',function(e){
  e.preventDefault();
  var url = "<?php echo url('settings-business-hours').'/services'?>";
  window.location.replace(url);
});

$(document).on('click','#tab-two',function(e){
  e.preventDefault();
  var url = "<?php echo url('settings-business-hours').'/staffs'?>";
  window.location.replace(url);
});

$(document).on('click','.update_user_shedule',function(){
   $('#update_staff_availability_form').trigger("reset");
   var staff_id = $(this).data('staff-id');
   var service_id = $(this).data('service-id');
   var day_no = $(this).data('day-no');
   var start_date = $(this).data('start-date');
   var end_date = $(this).data('end-date');

   $("#update_staff_availability_staff_id").val(staff_id);
   $("#update_staff_availability_service_id").val(service_id);

   var data = addCommonParams([]);
    //alert(serviceid);
   data.push({name:'service_id', value:service_id},
                {name:'staff_id', value:staff_id});
   $.ajax({
        url: baseUrl+"/api/edit_service_list_staff", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            $('.animationload').hide();
            if(response.result=='1')
            {
               console.log(response.message);
               $("#myModalregularShedule").modal('show');
               var i;
               for (i = 0; i < response.message.length; i++)
               { 
                  $("#styled-checkbox-update-"+response.message[i].day).prop('checked', true);
                  //$("#styled-checkbox-update-"+response.message[i].day).trigger('click');
                  $("#availability_update_start_time_"+response.message[i].day).prop('disabled', false);
                  $("#availability_update_start_time_"+response.message[i].day).val(response.message[i].start_time);
                  $("#availability_updaet_end_time_"+response.message[i].day).prop('disabled', false);
                  $("#availability_updaet_end_time_"+response.message[i].day).val(response.message[i].end_time);
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
        }
   });
});

$('#update_staff_availability_form').validate({
   submitHandler: function(form) {
   var data = $(form).serializeArray();
   data = addCommonParams(data);
   
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
</script>
@endsection