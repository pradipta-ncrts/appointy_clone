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
                  <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
            <li><a href="{{ url('booking-options') }}" class="active"> Clients Booking Flow</a></li>
            <li><a href="{{ url('booking-rules') }}"> Booking Rules</a> </li>
            <li><a href="{{ url('booking-policies') }}"> Booking Policies</a></li>
            <li><a href="{{ url('notification-settings') }}"> Notification Settings</a></li>
            <li><a href="{{ url('email-customisation') }}"> Email Customisation</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" action="/action_page.php">
                     <div onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0"> Service Options </h2>
                        <p>From this screen, clients will be able to view your service menu and select services for
                           booking on the booking portal. 
                        </p>
                     </div>
                     <div id="collapse1" class="panel-collapse collapse">
                        <hr>
                        <p>These settings help you customize how information is displayed and which users can perform
                           from this page
                        </p>
                        <table class="col-md-6">
                           <tr>
                              <td>View service time on booking portal</td>
                              <td>
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                    <i class="fa fa-toggle-on"></i>
                              </td>
                           </tr>
                           <tr>
                           <td>View service cost on the booking portal></td>
                           <td><a onclick="togglebtn(this);" class="togg-btn active"> <i class="fa fa-toggle-on"></i></td>
                           </tr>
                           <tr>
                           <td>Require clients to select categories first on the booking portal</td>
                           <td><a onclick="togglebtn(this);" class="togg-btn active"> <i class="fa fa-toggle-on"></i></td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <table class="row">
                        <tr>
                        <td><ul>
                        <li>Do you want to selll additional items (retail / consumables) with services? <a href="#">Create Add-ons</a> </li>
                        <li>Share service-speccific URL with customers to alow them to book it directly <a href="#">Generate Service URL</a> </li>
                        </ul></td>
                        </tr>
                        </table>
                        <div class="clearfix"></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" action="/action_page.php">
                     <div onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0"> Staff Options </h2>
                        <p>From this screen, clients will be able to view your staff menu and select them for booking
                           on the booking portal. 
                        </p>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse">
                        <hr>
                        <p>These settings help you customize how information is displayed and which users can perform
                           from this page
                        </p>
                        <table class="col-md-6">
                           <tr>
                              <td>Show staff members on the booking portal</td>
                              <td>
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                    <i class="fa fa-toggle-on"></i>
                              </td>
                           </tr>
                           <tr>
                           <td>Make selection of staff mandatory</td>
                           <td><a onclick="togglebtn(this);" class="togg-btn active"> <i class="fa fa-toggle-on"></i></td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <div class="col-md-6 booking-form">
                        <div class="form-group"> In what order should appointments be allocated to staff <img src="images/reg-icon-profesion1.png">
                        <select class="form-control cust-select">
                        <option>Select Profession</option>
                        </select>
                        <div class="clearfix"></div>
                        </div>
                        </div>
                        <table class="col-md-12">
                        <tr>
                        <td><ul>
                        <li>Each staff can have their own booking URL <a href="#">Generate staff URL</a> </li>
                        <li>Each staff can service defined geographical boundaries using area codes. <a href="#">Assign staff to are code</a> </li>
                        </ul></td>
                        </tr>
                        </table>
                        <div class="clearfix"></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" action="/action_page.php">
                     <div onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0"> Availability Options </h2>
                        <p>From this screen, clients will be able to view your schedule and select date and time for
                           booking on the booking portal. 
                        </p>
                     </div>
                     <div id="collapse3" class="panel-collapse collapse">
                        <hr>
                        <p>These settings help you customize how information is displayed and which users can perform
                           from this page
                        </p>
                        <div class=" booking-form">
                           <div class="form-group sub-head">
                              <label> Availability to be shown in time interval</label>
                              <div class="clearfix"></div>
                              <div class="col-md-4 ">
                                 <select class="form-control cust-select">
                                    <option>Fixed</option>
                                 </select>
                              </div>
                              <div class="col-md-4">
                                 <select class="form-control cust-select">
                                    <option>30 min</option>
                                 </select>
                              </div>
                              <div class="clearfix"></div>
                              <small> For example: If you provide consultation from 10 AM to 6 PM then selecting 15 minutes
                              will show 10:00, 10:15, 10:30...</small> 
                           </div>
                           <div class="clearfix">&nbsp;</div>
                           <div class="form-group col-md-12">
                              <label> Look busy to customers. Strike out unavailable times instead of hiding</label>
                              <div class="clearfix"></div>
                              <div class="checkbox">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Strike out Booked times <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Strike out Blocked times <span class="checkmark"></span> </label>
                              </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
                           <h3 class="sub-head">Layout Settings</h3>
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Default tab</label>
                                 <select class="form-control cust-select">
                                    <option>Schedule</option>
                                 </select>
                              </div>
                              <div class="col-md-6 ">
                                 <label>Default view</label>
                                 <select class="form-control cust-select">
                                    <option>Week</option>
                                 </select>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-6 ">
                                 <label>Calendar start day</label>
                                 <select class="form-control cust-select">
                                    <option>Today</option>
                                 </select>
                              </div>
                              <div class="col-md-6 ">
                                 <label>Calendar start date</label>
                                 <select class="form-control cust-select">
                                    <option>Jul 01, 2018</option>
                                 </select>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" action="/action_page.php">
                     <div onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0"> Login Options </h2>
                        <p>From this screen, clients will be able to log in or sign up with your business on the booking
                           portal. 
                        </p>
                     </div>
                     <div id="collapse4" class="panel-collapse collapse">
                        <hr>
                        <p>These settings help you customize how information is displayed and which users can perform
                           from this page
                        </p>
                        <div class=" booking-form">
                           <div class="form-group col-md-12">
                              <label> Let customers choose their preferred method of login</label>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Squeedr Login <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox  col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Facebook Login <span class="checkmark"></span> </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Goolge Login <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox  col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Guest Login - Login not required <span class="checkmark"></span> </label>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="form-group col-md-12">
                              <label> What information do you require from customers at the time of booking?</label>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox" checked disabled>
                                 &nbsp;&nbsp; First name <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox  col-md-4">
                                 <label class="check">
                                 <input type="checkbox" checked disabled>
                                 &nbsp;&nbsp; Email <span class="checkmark"></span> </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox" checked disabled>
                                 &nbsp;&nbsp; Last Name <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox  col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Address <span class="checkmark"></span> </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Zip <span class="checkmark"></span> </label>
                              </div>
                              <div class="checkbox  col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; City & State <span class="checkmark"></span> </label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="checkbox col-md-4">
                                 <label class="check">
                                 <input type="checkbox">
                                 &nbsp;&nbsp; Mobile Phone <span class="checkmark"></span> </label>
                              </div>
                           </div>
                           <table class="form-group">
                              <tr>
                                 <td>
                                    <ul>
                                       <li>Do you want users to accept any terms and conditions during signup? <a href="#">Add Terms and Conditions</a> </li>
                                       <li>Do you want to restrict users of a particular domain to sign up / book appointments? <a href="#">Set domain restriction</a> </li>
                                       <li>Do you want to clietns to view your schedule and contact your business to book an appointment? <a href="#">Disable direct booking from booking portal</a> </li>
                                    </ul>
                                 </td>
                              </tr>
                           </table>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection