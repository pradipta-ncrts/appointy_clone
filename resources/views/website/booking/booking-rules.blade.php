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
                 <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
              </div>
           </div>
        </div>
     </div>
     <div class="leftpan">
        <div class="left-menu">
           <ul>
            <li><a href="{{ url('booking-options') }}"> Clients Booking Flow</a></li>
            <li><a href="{{ url('booking-rules') }}" class="active"> Booking Rules</a> </li>
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
                 <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                    <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                    <h2  style="margin:0">Booking Rules & Layout</h2>
                 </div>
                 <div id="collapse1" class="panel-collapse collapse">
                    <form class="form-horizontal" action="">
                       <h3 class="sub-head">Book appointments directly from the site</h3>
                       <table class="col-md-12">
                          <tr>
                             <td  class="col-md-8">
                                <p>If this is disabled, customers will be able to check your availablity on the booking portal and see
                                   a message directing them to contact you by phone or in person to make an appointment.
                                   This setting will also be applied to your mini-website and the widget integrated aon your website.
                                </p>
                             </td>
                             <td  class="col-md-4 text-right">
                                <a onclick="togglebtn(this);" class="togg-btn active">
                                   <i class="fa fa-toggle-on"></i>
                             </td>
                          </tr>
                       </table>
                       <div class="clearfix"></div>
                       <h3 class="sub-head">Who can schedule</h3> 
                       <div class="col-md-6 booking-form">
                       <div class="checkbox">
                       <label class="check">
                       <input type="checkbox"> &nbsp;&nbsp; Pre-Paying Members
                       <span class="checkmark"></span>
                       </label>
                       </div>
                       </div>
                       <div class="col-md-3 ">    
                       <div class="form-group booking-form"> 
                       <select class="form-control cust-select">
                       <option>Does not require Approval</option>
                       </select>
                       <div class="clearfix"></div>
                       </div>    
                       </div>
                       <div class="col-md-6 ">
                       <div class="checkbox">
                       <label class="check">
                       <input type="checkbox"> &nbsp;&nbsp; Phone Verified members
                       <span class="checkmark"></span>
                       </label>
                       </div>
                       </div>    
                       <div class="col-md-3 ">
                       <div class="form-group booking-form"> 
                       <select class="form-control cust-select">
                       <option>Does not require Approval</option>
                       </select>
                       <div class="clearfix"></div>
                       </div>
                       </div>
                       <div class="col-md-6 ">
                       <div class="checkbox">
                       <label class="check">
                       <input type="checkbox"> &nbsp;&nbsp; Email Verified members
                       <span class="checkmark"></span>
                       </label>
                       </div>
                       <small style="margin-left: 28px;">Non Email Verrified Members</small>
                       </div>    
                       <div class="col-md-3 ">
                       <div class="form-group booking-form"> 
                       <select class="form-control cust-select">
                       <option>Does not require Approval</option>
                       </select>
                       <div class="clearfix"></div>
                       </div>
                       </div>
                       <div class="clearfix"></div>
                       <h3 class="sub-head">Customer Booking Sequence </h3> 
                       <table class="radio-booking">
                       <tr>
                       <td>
                       <label class="radio" style="font-weight: 300">Service &RightArrow; Staff &RightArrow; Available tile slots
                       <input type="radio"  checked="checked"   name="radio">
                       <span class="radiomark"></span>
                       </label>
                       </td>
                       </tr>
                       <tr>
                       <td>
                       <label class="radio"style="font-weight: 300">Service &RightArrow; Available tile slots &RightArrow; Staff
                       <input type="radio"name="radio">
                       <span class="radiomark"></span>
                       </label>
                       </td>
                       </tr>
                       </table>
                       <div class="clearfix"></div>
                       <h3 class="sub-head">Tracking Code </h3> 
                       <div class="col-md-6 padtop15">
                       Google adwords script page URL
                       </div>
                       <div class="col-md-6 ">    
                       <div class="form-group booking-form"> 
                       <input type="text" class="form-control"  placeholder="URL">
                       <div class="clearfix"></div>
                       </div>    
                       </div>
                       <div class="clearfix"></div>
                       <table class="col-md-12">
                       <tr>
                       <td  class="col-md-8 padtop15">                                        
                       <p>Run script when user is redirected to payment getway
                       </p> 
                       </td>
                       <td  class="col-md-4 text-right">
                       <a onclick="togglebtn(this);" class="togg-btn active">
                       <i class="fa fa-toggle-off"></i>
                       </td>
                       </tr>
                       </table>
                       <div class="clearfix"></div>
                       <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Google tracking code is a premium feature available in Professional & above membership <span>Upgrade</span></div>
                       <table class="col-md-12">
                       <tr>
                       <td  class="col-md-8 padtop15">                                        
                       <p>If you want to show your customer's name with their reviews
                       </p> 
                       </td>
                       <td  class="col-md-4 text-right">
                       <a onclick="togglebtn(this);" class="togg-btn active">
                       <i class="fa fa-toggle-off"></i>
                       </td>
                       </tr>
                       </table>
                       <div class="clearfix"></div>
                       <table class="col-md-12">
                       <tr>
                       <td  class="col-md-8 padtop15">                                        
                       <p>Allow your customers to promote their appointment on social networks
                       </p> 
                       </td>
                       <td  class="col-md-4 text-right">
                       <a onclick="togglebtn(this);" class="togg-btn active">
                       <i class="fa fa-toggle-off"></i>
                       </td>
                       </tr>
                       </table>
                       <div class="clearfix"></div>
                       <h3 class="sub-head">URL of calendar on your site </h3> 
                       <div class="col-md-12 ">    
                       <div class="form-group booking-form"> 
                       <input type="text" class="form-control"  placeholder="URL">
                       <small>
                       If your are integrating Squeedr on your site enter the URL of that page in the text
                       box below. We will use this URL to redirect users to your desired page after 
                       payments, email verifications, rating, etc. Leave empty if you are not integrating 
                       your calendar on your website. By default, user will be redirectd to https://booking.squeedr.com/user
                       </small>
                       <div class="clearfix"></div>
                       </div>  
                       </div>
                       <div class="clearfix"></div>
                       <h3 class="sub-head">Social Channels </h3> 
                       <p>Direct happy and potential customers from booking portal to your social media
                       profiles by adding their links here. This helps in building strong customer relationships and increases the social
                       media engagement on your business page.
                       </p>
                       <div class="col-md-3 padtop15">
                       Facebook page URL
                       </div>
                       <div class="col-md-6 booking-form1 ">    
                       <div class="form-group booking-form"> 
                       <input type="text" class="form-control"  placeholder="URL">
                       <div class="clearfix"></div>
                       </div>    
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-3 padtop15">
                       Twitter page URL
                       </div>
                       <div class="col-md-6 booking-form1 ">    
                       <div class="form-group booking-form"> 
                       <input type="text" class="form-control"  placeholder="URL">
                       <div class="clearfix"></div>
                       </div>    
                       </div>
                       <div class="clearfix"></div>
                       <button class="btn btn-primary search-btn" type="submit">Save</button>
                    </form>
                 </div>
              </div>
           </div>
        </div>
        <div class="container-fluid body-sec ">
        <div class="row ">
        <div class="col-md-12 booking-opt">
        <form class="form-horizontal" action="/action_page.php">
        <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i> 
        <h2 style="margin:0"> Lead & Cancellation Time </h2>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
        <div class="col-md-8 padtop20 ">                                    
        Minimum advance notice required to book an appointment                               
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="120">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>Min</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 padtop20 ">                                    
        Minimum notice required for cancelling an appointment                
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="1">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>Days</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 padtop20 ">                                    
        Minimum notice required for resheduling an appointment           
        </div>
        <div class="col-md-2  col-sm-2">    
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="1">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>Days</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 padtop20 ">                                    
        How many days in advance can appointments be booked?           
        </div>
        <div class="col-md-4 ">    
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="90">
        <div class="clearfix"></div>
        </div>    
        </div>    
        <div class="clearfix"></div>
        <div class="col-md-8 padtop20 ">                                    
        Minimum time interval required between appointments          
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="0">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>Days</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 padtop20 ">                                    
        Set time interval forAdministrator calendar       
        </div>
        <div class="col-md-2 col-sm-2">    
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>15</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="container-fluid body-sec ">
        <div class="row ">
        <div class="col-md-12 booking-opt">
        <form class="form-horizontal" action="/action_page.php">
        <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i> 
        <h2 style="margin: 0">Booking Restrictions </h2>
        </div>
        <div id="collapse3" class="panel-collapse collapse">
        <table class="col-md-12">
        <tr>
        <td  class="col-md-8 padtop15">     
        <h3 class="sub-head1">Geographical Restriction</h3>                                   
        <p>Allow international users (outside France) to book appointments
        </p> 
        </td>
        <td  class="col-md-4 text-right">
        <a onclick="togglebtn(this);" class="togg-btn active">
        <i class="fa fa-toggle-off"></i>
        </td>
        </tr>
        </table>
        <div class="clearfix"></div>
        <table class="col-md-12">
        <tr>
        <td  class="col-md-8 padtop15">     
        <h3 class="sub-head1">Booking Limit per Customer</h3>                                   
        <p>By default, all customers are allowed to schedule unlimited appointments. You can choose to restrict the number
        of bookings that customers can make in a day, week or month
        </p> 
        </td>
        <td  class="col-md-4 text-right">
        <a onclick="togglebtn(this);" class="togg-btn active">
        <i class="fa fa-toggle-off"></i>
        </td>
        </tr>
        </table>
        <div class="clearfix"></div>
        <div class="col-md-4">
        <h3>Booking Allowed</h3>
        <div class=" booking-form"> 
        <select class="form-control cust-select">
        <option>Unlimited</option>
        </select>
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-4">
        <h3>From</h3>
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="Jul 11, 2018">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="col-md-4">
        <h3>Till</h3>
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="" value="Jul 11, 2025">
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <table class="col-md-12">
        <tr>
        <td  class="col-md-8 padtop15">     
        <h3 class="sub-head1">Back-to-Back Booking</h3>                                   
        <p>Enable this to allow customers to select multiple services at the time of booking. In this case, 
        only those times will be shown as available when
        the selected services can be performed consecutively
        </p> 
        </td>
        <td  class="col-md-4 text-right">
        <a onclick="togglebtn(this);" class="togg-btn active">
        <i class="fa fa-toggle-off"></i>
        </td>
        </tr>
        </table>
        <div class="clearfix"></div>
        <table class="col-md-12">
        <tr>
        <td  class="col-md-8 padtop15">     
        <h3 class="sub-head1">Recurring Booking</h3>                                   
        <p>Enable this to allow customers to book multiple seats in a single transaction (For the same service / time combination)
        </p> 
        </td>
        <td  class="col-md-4 text-right">
        <a onclick="togglebtn(this);" class="togg-btn active">
        <i class="fa fa-toggle-off"></i>
        </td>
        </tr>
        </table>
        <div class="clearfix"></div>
        <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Recurring appointments is a premium feature availbale in Growth and above membership. <span>Upgrade</span></div>
        <h3 class="sub-head">Show recurring options to</h3>
        <div class="clearfix"></div>
        <div class="checkbox col-md-3">                                                                           
        <label class="check">
        <input type="checkbox"> &nbsp;&nbsp; Customer
        <span class="checkmark"></span>
        </label>                                                                            
        </div>
        <div class="checkbox col-md-3">                                                                           
        <label class="check">
        <input type="checkbox"> &nbsp;&nbsp; Admin
        <span class="checkmark"></span>
        </label>                                                                            
        </div>
        <table class="col-md-12">
        <tr>
        <td  class="col-md-8 padtop15">     
        <h3 class="sub-head1">Qualntity Booking</h3>                                   
        <p>Enable this to allow customers to reserve appointment for more than one person in a single transaction.
        In the order summary page, the customer will be able to see the number of availbale slots for that service / 
        time combination, and choose to book one or more in a single transaction
        </p> 
        </td>
        <td  class="col-md-4 text-right">
        <a onclick="togglebtn(this);" class="togg-btn active">
        <i class="fa fa-toggle-off"></i>
        </td>
        </tr>
        </table>
        <div class="col-md-6 ">
        <h3>Enter the alias for quantity</h3>
        <div class=" booking-form"> 
        <input type="text" class="form-control"  placeholder="Qualntity" >
        <div class="clearfix"></div>
        </div>    
        </div>
        <div class="clearfix"></div>
        <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Quantity booking is a premium feature available in Growth and above membership.
        <span>Upgrade</span></div>
        </div>
        </form>
        </div>
        </div>
        </div>
     </div>
  </div>
</div>
@endsection