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
                  <div class="input-group">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
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
                  <form class="form-horizontal" action="/action_page.php">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>
                        <h2 style="margin: 0">Reminder Notifications </h2>
                        <p>Reminder Notifications allows you to inform customers to reduce no-shows </p>
                     </div>
                     <div id="collapse1" class="panel-collapse collapse">
                        <hr>
                        <h3 class="sub-head1">Email Reminder</h3>
                        <table>
                           <tr>
                              <td>Send an email to customers</td>
                              <td> <input id="send_email_to_customer_value" type="text" style="width:50px;" class="form-control" value="12"></td>
                              <td >hours prior to appointment</td>
                              <td >
                                 <a onclick="togglebtn(this);" class="togg-btn active" id="send_email_to_customer">
                                 <i class="fa fa-toggle-on"></i>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <h3 class="sub-head1">SMS Reminder</h3>
                        <table>
                           <tr>
                              <td>Send an SMS alert to customers</td>
                              <td> <input type="text" style="width:50px;" class="form-control" value="12"></td>
                              <td >hours prior to appointment</td>
                              <td >
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                 <i class="fa fa-toggle-on"></i>
                              </td>
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
                              <select class="form-control cust-select">
                                 <option>Never send an SMS</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <table>
                           <tr>
                              <td>Admin</td>
                              <td >
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                 <i class="fa fa-toggle-on"></i>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <table>
                           <tr>
                              <td>Staff</td>
                              <td >
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                 <i class="fa fa-toggle-on"></i>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!--  <button class="btn btn-primary search-btn" type="submit">CONFIRM BOOKING</button> -->
      </div>
   </div>
</div>
@endsection