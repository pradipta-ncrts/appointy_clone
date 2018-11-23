@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Business Hours</h1>
   <ul>
    &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
      <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row container-fixed">
         <div class="col-lg-12 nopadding">
            <form class="form-inline">
               <div class="headRow headingBar padding15px" id="businessHours">
                  <a><img src="{{asset('public/assets/mobile/images/arrowprev.gif')}}" /> </a>
                  <h1>Business Hours</h1>
                  <a><img src="{{asset('public/assets/mobile/images/arrownxt.gif')}}" /> </a> 
               </div>
               <div class="headRow padding15px" id="bhlist">
                  <div id="bh">
                     <div class="bhchild active"> <img src="images/business-hours/blue-user.png" /> <span>Douglas N</span> <a class="gear"> <i class="fa fa-gear"></i> </a> </div>
                     <div class="bhchild running"> <img src="images/business-hours/blue-user.png" /> <span>Janice D</span><a class="gear"> <i class="fa fa-gear"></i> </a></div>
                     <div class="bhchild disabled"><img src="images/business-hours/grey-user.png" /> <span>Janice D</span><a class="gear"> <i class="fa fa-gear"></i> </a></div>
                     <div class="bhchild running"> <img src="images/business-hours/blue-user.png" /> <span>Janice D</span><a class="gear"> <i class="fa fa-gear"></i> </a></div>
                  </div>
               </div>
               <div class="headRow">
                  <ul class="schedulebh showDekstop clearfix">
                     <li><a href="#" class="active">Work Schedule </a></li>
                     <li><a href="#">Future Unavailability </a></li>
                     <li><a href="#">Staff Details </a></li>
                  </ul>
                  <div class="padding15px clearfix">
                     <div id="scheduleBar"> <span>Current Schedule</span> <span><a href="#">Add or Update Schedule</a></span> </div>
                     <div class="bhchildmobile showMobile">
                        <div class="panel-group custm-tab-hrs" id="accordion">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <div class="bhInside"> <img src="{{asset('public/assets/mobile/images/business-hours/blue-user.png')}}" />
                                       <label id="name">Douglas N</label>
                                    </div>
                                    <div class="time-slot">30 mins - 1 hr</div>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-angle-down"></i></a> 
                                 </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse">
                                 <div class="panel-body">
                                    <div class="bhscheduleInside">
                                       <h2>Dental Consultation</h2>
                                       <p><span>Time Slot</span>: 30 mins - 1 hr</p>
                                    </div>
                                    <div class="custm-tab team-memtab">
                                       <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#home">Work Schedule</a></li>
                                          <li><a data-toggle="tab" href="#menu1">Feature Unavailability</a></li>
                                       </ul>
                                       <div class="tab-content">
                                          <div id="home" class="tab-pane fade in active">
                                             <div class="tableBH-table">
                                                <table class="table table-bordered table-custom table-bh tableBhMobile" >
                                                   <thead>
                                                      <tr>
                                                         <th></th>
                                                         <th>Sunday</th>
                                                         <th>Monday</th>
                                                         <th>Tuesday</th>
                                                         <th>Wednesday</th>
                                                         <th>Thursday</th>
                                                         <th>Friday</th>
                                                         <th>Saturday</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <span>Dental Consultation (1h)</span>
                                                            <label>Scale: <strong>30 mins</strong> </label>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-delete.png')}}" />
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
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td></td>
                                                         <td data-column="Wednesday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="images/business-hours/tbl-edit.png" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td data-column="Thursday"></td>
                                                         <td data-column="Friday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <div id="menu1" class="tab-pane fade">
                                             <p>Some content in menu 1.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <div class="bhInside"> <img src="{{asset('public/assets/mobile/images/business-hours/blue-user.png')}}" />
                                       <label id="name">Douglas N1 </label>
                                    </div>
                                    <div class="time-slot">30 mins - 1 hr</div>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i class="fa fa-angle-down"></i></a> 
                                 </h4>
                              </div>
                              <div id="collapse2" class="panel-collapse collapse">
                                 <div class="panel-body">
                                    <div class="bhscheduleInside">
                                       <h2>Dental Consultation</h2>
                                       <p><span>Time Slot</span>: 30 mins - 1 hr</p>
                                    </div>
                                    <div class="custm-tab team-memtab">
                                       <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#home">Work Schedule</a></li>
                                          <li><a data-toggle="tab" href="#menu1">Feature Unavailability</a></li>
                                       </ul>
                                       <div class="tab-content">
                                          <div id="home" class="tab-pane fade in active">
                                             <div class="tableBH-table">
                                                <table class="table table-bordered table-custom table-bh tableBhMobile" >
                                                   <thead>
                                                      <tr>
                                                         <th></th>
                                                         <th>Sunday</th>
                                                         <th>Monday</th>
                                                         <th>Tuesday</th>
                                                         <th>Wednesday</th>
                                                         <th>Thursday</th>
                                                         <th>Friday</th>
                                                         <th>Saturday</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <span>Dental Consultation (1h)</span>
                                                            <label>Scale: <strong>30 mins</strong> </label>
                                                            <img src="images/business-hours/tbl-delete.png" />
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
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td></td>
                                                         <td data-column="Wednesday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td data-column="Thursday"></td>
                                                         <td data-column="Friday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <div id="menu1" class="tab-pane fade">
                                             <p>Some content in menu 1.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <div class="bhInside"> <img src="{{asset('public/assets/mobile/images/business-hours/blue-user.png')}}" />
                                       <label id="name">Douglas N2</label>
                                    </div>
                                    <div class="time-slot">30 mins - 1 hr</div>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><i class="fa fa-angle-down"></i></a> 
                                 </h4>
                              </div>
                              <div id="collapse3" class="panel-collapse collapse">
                                 <div class="panel-body">
                                    <div class="bhscheduleInside">
                                       <h2>Dental Consultation</h2>
                                       <p><span>Time Slot</span>: 30 mins - 1 hr</p>
                                    </div>
                                    <div class="custm-tab team-memtab">
                                       <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#home">Work Schedule</a></li>
                                          <li><a data-toggle="tab" href="#menu1">Feature Unavailability</a></li>
                                       </ul>
                                       <div class="tab-content">
                                          <div id="home" class="tab-pane fade in active">
                                             <div class="tableBH-table">
                                                <table class="table table-bordered table-custom table-bh tableBhMobile" >
                                                   <thead>
                                                      <tr>
                                                         <th></th>
                                                         <th>Sunday</th>
                                                         <th>Monday</th>
                                                         <th>Tuesday</th>
                                                         <th>Wednesday</th>
                                                         <th>Thursday</th>
                                                         <th>Friday</th>
                                                         <th>Saturday</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <span>Dental Consultation (1h)</span>
                                                            <label>Scale: <strong>30 mins</strong> </label>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-delete.png')}}" />
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
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td></td>
                                                         <td data-column="Wednesday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <td data-column="Thursday"></td>
                                                         <td data-column="Friday">
                                                            <ul>
                                                               <li>from: <strong>10:00 AM</strong></li>
                                                               <li>to: <strong> 07:30 PM</strong></li>
                                                            </ul>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <div id="menu1" class="tab-pane fade">
                                             <p>Some content in menu 1.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <span class="footlink pull-right break10px"><a href="#">Add additional work times</a> </span>
                     <div class="clearfix"></div>
                     <ul class="footnote">
                        <li>As per lead time setting, booking will be allowed 120 minute from now for the next 90 days.</li>
                        <li>Time will open in an interval of 30 minutes. <a href="#">Change interval</a></li>
                        <li>You can create multiple schedules for example, "Winter Schedule" or "Summer Schedule" from here</li>
                     </ul>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</main>


@endsection


@section('custom_js')


@endsection