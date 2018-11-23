@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Membership</h1>
   <ul>
    &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
      <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <form class="form-inline">
               <div class="headRow headingBar padding15px showDekstop">
                  <div>
                     <h1>Membership Plan</h1>
                  </div>
                  <div class="text-right">
                     <button type="submit" class="btn btn-custom">Save</button>
                     <button class="popup-button showDekstop" type="button" onclick="ShowPopup(this);"><img src="images/plus.png" /> </button>
                  </div>
               </div>
               <div class="row showMobile break20px">
                  <div class="col-xs-12" id="planMobile">
                     <div class="whitebox" onclick="changePlan(this);">
                        <div class="pricecheck"></div>
                        <h4>Free Plan</h4>
                        <h5>Prime Monthly</h5>
                        <h6><span>$12<sup>99</sup></span>/Month</h6>
                     </div>
                     <div class="whitebox" onclick="changePlan(this);">
                        <div class="pricecheck"></div>
                        <h4>Pro Plan</h4>
                        <h5>Prime Monthly</h5>
                        <h6><span>$12<sup>99</sup></span>/Month</h6>
                     </div>
                     <div class="whitebox" onclick="changePlan(this);">
                        <div class="pricecheck"></div>
                        <h4>Business Plan</h4>
                        <h5>Prime Monthly</h5>
                        <h6><span>$12<sup>99</sup></span>/Month</h6>
                     </div>
                  </div>
               </div>
               <div id="freeplan" class="padding15px">
                  <label class="showMobile">Your Current Membership</label>
                  <h2>Free Plan</h2>
                  <span>Billed monthly</span> 
                  <button class="btn showMobile">Compare Plans</button>      
               </div>
               <div id="planList">
                  <div class="listItem">
                     <h4>Free Plan</h4>
                     <span>Prime Monthly</span>
                     <h5><label>$12<sup>99</sup></label> /Month</h5>
                     <button class="btn btn-large btn-grey">Choose Plan</button>
                     <ul>
                        <li>30 days subscription free</li>
                        <li>Forum based support </li>
                        <li>Email notification through priority gateway </li>
                        <li>Appointment Details posted on Google Calendar</li>
                     </ul>
                  </div>
                  <div class="listItem">
                     <h4>Pro Plan</h4>
                     <span>Prime Monthly</span>
                     <h5>
                        <label>$16<sup>99</sup></label> /Month
                     </h5>
                     <button class="btn btn-large btn-green">Choose Plan</button>
                     <ul>
                        <li>Everything from Freemium Plan</li>
                        <li>Two way Google Calendar linking</li>
                        <li>Email notification through priority gateway</li>
                        <li>Appointment Details posted on Google Calendar</li>
                        <li>Email and other customization</li>
                        <li>Handle complex schedules with precision scheduling</li>
                        <li>Take custom information at the time of booking</li>
                     </ul>
                  </div>
                  <div class="listItem">
                     <h4>Business Plan</h4>
                     <span>Prime Monthly</span>
                     <h5><label>$25<sup>99</sup></label> /Month</h5>
                     <button class="btn btn-large btn-green">Choose Plan</button>
                     <ul>
                        <li>Everything from Pro Plan</li>
                        <li>Enhanced email marketing limit(500 email/day)</li>
                        <li>Separate staff logins</li>
                        <li>Separate staff google calendar linking</li>
                        <li>Advanced Reporting</li>
                     </ul>
                  </div>
               </div>
               <div class="showMobile whitebox" id="listItem">
                  <ul>
                     <li>30 days subscription free</li>
                     <li>Forum based support </li>
                     <li>Email notification through priority gateway </li>
                     <li>Appointment Details posted on Google Calendar</li>
                  </ul>
               </div>
               <a class="btn btn-block btn-mobile showMobile">Select Plan</a>
            </form>
         </div>
      </div>
   </div>
</main>


@endsection


@section('custom_js')


@endsection