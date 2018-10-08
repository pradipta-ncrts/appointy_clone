@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Membership Plan</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="row">
            <div class="col-lg-12">
               <form class="form-inline">
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
                  <div class="plan ">
                     <a href="#" class="arrow-left"><img src="{{asset('public/assets/website/images/arrowprev.gif')}}"></a>
                     <a href="#"  class="arrow-right"><img src="{{asset('public/assets/website/images/arrownxt.gif')}}"></a>     
                     <table>
                        <tr>
                           <td>Monthly</td>
                           <td><label class="switch-m">
                              <input type="checkbox" checked>
                              <span class="slider-m round-m"></span> </label>
                           </td>
                           <td>Yearly</td>
                        </tr>
                     </table>
                  </div>
                  <div id="planList">
                     <!--  <div class="listItem">
                        <h4>Free Plan</h4>
                        <span>Prime Monthly</span>
                        <h5>
                          <label>$12<sup>99</sup></label>
                          /Month</h5>
                        <button class="btn btn-large btn-grey">Current Plan</button>
                        <ul>
                          <li>30 days subscription free</li>
                          <li>Forum based support </li>
                          <li>Email notification through priority gateway </li>
                          <li>Appointment Details posted on Google Calendar</li>
                        </ul>
                        </div>-->
                     <div class="listItem">
                        <h4>Pro Plan</h4>
                        <span>Prime Monthly</span>
                        <h5>
                           <label>$16<sup>99</sup></label>
                           /Month
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
                        <h5>
                           <label>$25<sup>99</sup></label>
                           /Month
                        </h5>
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
                  <a class="btn btn-block btn-mobile btn-size showMobile">Select Plan</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection