@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
  <div class="container-custm">
     <div class="upper-cmnsection">
        <div class="heading-uprlft">Integration</div>
        <div class="upr-rgtsec">
           <div class="col-sm-5">
              <div id="custom-search-input">
                 <div class="input-group col-md-12">
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
        <div class="left-menu" id="nav-left">
           <ul>
              <li><a href="#apps" > Apps</a></li>
              <li><a href="#social"> Social</a> </li>
              <li><a href="#inc-payments"> Payments</a> </li>
              <li><a href="#inc-calendar"> Calendar</a> </li>
              <li><a href="#int-analytic"> Analytic</a> </li>
           </ul>
        </div>
     </div>
     <div class="rightpan ">
        <div class="btn-slide">
           <img src="images/slide-butt-add.png" />
        </div>
        <div >
           <div class="intg">
              <div class="col-lg-12 ">
                 <h3 id="apps">APPS</h3>
                 <hr>
                 <div class="col-md-6 col-sm-6 ">
                    <div class="inte"  data-toggle="modal" data-target="#myModal-1">
                       <img src="{{asset('public/assets/website/images/icon-zoom.png')}}">
                       <h2>Zoom</h2>
                       <p>Run your business anytime and from anywhere from your Zoom App</p>
                       <div class="clearfix"></div>
                    </div>
                    <div class="modal fade" id="myModal-1" role="dialog">
                       <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                             <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                             <div class="modal-body flex">
                                <div> <img src="{{asset('public/assets/website/images/icon-zoom.png')}}"></div>
                                <div>
                                   <h2>Zoom</h2>
                                   <p>Run your business anytime and from anywhere from your Android device</p>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-zapier.png')}}"></div>
                       <div>
                          <h2>Zapier</h2>
                          <p>
                             Transfer information between Appointy and thousands of other apps
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-6">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-IOS.png')}}"></div>
                       <div >
                          <h2>IOS</h2>
                          <p>Run your business anytime and from anywhere from your iOS device</p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-android.png')}}"></div>
                       <div >
                          <h2>Android</h2>
                          <p>
                             Run your business anytime and from anywhere from your Android device
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="clearfix"></div>
                 <h3 id="social">SOCIAL</h3>
                 <hr>
                 <div class="col-md-6 col-sm-6 ">
                    <div class="inte"  data-toggle="modal" data-target="#myModal-2">
                       <div><img src="{{asset('public/assets/website/images/icon-facebook.png')}}"></div>
                       <div>
                          <h2>Facebook</h2>
                          <p>Benefits of linking with "Facebook Page" - 
                             Promote discount coupons on Facebook Page.
                             Post reviews from your customers to your Facebook Page.
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                    <div class="modal fade" id="myModal-2" role="dialog">
                       <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                             <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                             <div class="modal-body flex">
                                <div><img src="{{asset('public/assets/website/images/icon-facebook.png')}}"></div>
                                <div>
                                   <h2>Facebook</h2>
                                   <p>Benefits of linking with "Facebook Page"</p>
                                   <ul>
                                      <li> Promote discount coupons on Facebook Page.</li>
                                      <li> Post reviews from your customers to your Facebook Page.</li>
                                      <li>Add Appointy scheduling directly to your Facebook Page.</li>
                                   </ul>
                                   <a href="#">Connect with Facebook</a>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-skype.png')}}"></div>
                       <div >
                          <h2>Skype</h2>
                          <p>Allows you to update your Skype account. </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-6">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-twitter.png')}}"></div>
                       <div >
                          <h2>Twitter</h2>
                          <p>Allows you to update your Twitter account Benefits of linking with Twitter. Discount coupons can be promoted to your followers.</p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="clearfix"></div>
                 <h3 id="inc-payments">PAYMENTS</h3>
                 <hr>
                 <div class="col-md-6 col-sm-6 ">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-stripe.png')}}"></div>
                       <div >
                          <h2>Stripe</h2>
                          <p>
                             Automatically collect full or partial payments at the time an event is scheduled.
                             Alow your clients to pay with debit or credit card.
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-6">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-paypal.png')}}"></div>
                       <div >
                          <h2>Paypal</h2>
                          <p>
                             Automatically collect full or partial payments at the time an event is scheduled.
                             Alow your clients to pay with PayPal, debit or credit card.
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="clearfix"></div>
                 <h3 id="inc-calendar">Calendar</h3>
                 <hr>
                 <div class="col-md-6 col-sm-6 ">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-outlook-calendar.png')}}"></div>
                       <div>
                          <h2>Outlook Calendar (Office-365)</h2>
                          <p>
                             Sync Squeedr bookings in Outlook Calendar and manage your entire schedule in one place
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-ical.png')}}"></div>
                       <div>
                          <h2>iCal</h2>
                          <p>
                             View your Appointy bookings in the default calendar on your phone/desktop
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-6">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-google-cal.png')}}"></div>
                       <div>
                          <h2>Google Calendar</h2>
                          <p>
                             Squeedr can update your Google Calendar in real-time. As soon as an appointment is booked on Squeedr, your Calendar is updated.
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="clearfix"></div>
                 <h3 id="int-analytic">Analytic</h3>
                 <hr>
                 <div class="col-md-6 col-sm-6">
                    <div class="inte">
                       <div><img src="{{asset('public/assets/website/images/icon-google-analytics.png')}}"></div>
                       <div >
                          <h2>Google Analytics</h2>
                          <p>
                             Track your Event Types and create goals with Google Analytics.
                          </p>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                 </div>
                 <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
           </div>
        </div>
     </div>
  </div>
</div>
@endsection