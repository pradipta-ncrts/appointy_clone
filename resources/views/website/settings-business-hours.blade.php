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
                        <div class="dropdown custm-uperdrop">
                           <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
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
                     <a href="#" class="active">
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                     <a href="#" >
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                     <a href="#" >
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                     <a href="#" >
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                     <a href="#" >
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                     <a href="#" >
                        <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <div>
                           <h3>Douglas N</h3>
                           <small>30min</small>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
            <div class="rightpan" style="min-height:610px;">
               <div class="relativePostion">
                  <div class=" showDekstop clearfix">
                     <div class="col-md-12">
                        <!-- Nav tabs -->
                        <div class="staff-detail">
                           <ul class="nav nav-tabs">
                              <li class="active" data-toggle="tooltip" data-placement="top" title="Staff View"><a data-toggle="tab" href="#tab1"><img src="{{asset('public/assets/website/images/company-workers.png')}}" alt="" /></a></li>
                              <li data-toggle="tooltip" data-placement="top" title="Services View"><a data-toggle="tab" href="#tab2"><img src="{{asset('public/assets/website/images/servicesicon.png')}}" alt="" /></a></li>
                              <li data-toggle="tooltip" data-placement="top" title="List View"><a data-toggle="tab" href="#tab3"><img src="images/list.png" alt="" /></a></li>
                              <li data-toggle="tooltip" data-placement="top" title="Add Additional Times"><a class="btn cus-discount-btn" data-toggle="modal" data-target="#myModallist-time"><img src="{{asset('public/assets/website/images/plus-rounded.png')}}" alt="" /></a></li>
                           </ul>
                           <div class="tab-content" style="position:relative;padding:0;">
                              <div id="tab1" class="tab-pane fade in active">
                                 <ul class="nav nav-tabs staff-inertab">
                                    <li class="active"><a data-toggle="tab" href="#regulariner">REGULAR</a></li>
                                    <li><a data-toggle="tab" href="#irregulariner">IRREGULAR</a></li>
                                 </ul>
                                 <div class="tab-content" style="padding:0;">
                                    <div id="regulariner" class="tab-pane fade in active">
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
                                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" style="margin: -3px 0 0 -16px;"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
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
                                                   <th>STAFF</th>
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
                                                      <div class="custm-tblebx"> <img src="{{asset('public/assets/website/images/noimage.png')}}" class="img-circle" alt="" width="35" height="35"> <a href="#">Jason</a> </div>
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
                                    </div>
                                    <div id="irregulariner" class="tab-pane fade">
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
                                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" style="margin: -3px 0 0 -16px;"><img src="{{asset('public/assets/website/images/add-circular-button.png')}}" alt="" height="18"></button>
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
                                                   <th>STAFF</th>
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
                                                      <div class="custm-tblebx"> <img src="{{asset('public/assets/website/images/noimage.png')}}" class="img-circle" alt="" width="35" height="35"> <a href="#">Jason</a> </div>
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
                                    </div>
                                 </div>
                              </div>
                              <div id="tab2" class="tab-pane fade">
                                 <div id="tab1" class="tab-pane fade in active">
                                    <ul class="nav nav-tabs staff-inertab">
                                       <li class="active"><a data-toggle="tab" href="#regulariner1">REGULAR</a></li>
                                       <li><a data-toggle="tab" href="#irregulariner1">IRREGULAR</a></li>
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
                                       <div id="irregulariner1" class="tab-pane fade">
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
                                       </div>
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
@endsection