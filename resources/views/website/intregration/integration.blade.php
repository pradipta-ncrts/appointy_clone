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
                   <!--  <input type="text" class="  search-query form-control" placeholder="Search" />
                    <span class="input-group-btn">
                    <button class="btn btn-danger" type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                    </button>
                    </span> -->
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

           @if(Session::has('intregration_error'))

               <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                   <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                   <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('intregration_error')}}</p>
               </div>
            @endif

            @if(Session::has('intregration_success'))

               <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('intregration_success')}}</p>
              </div>
            
            @endif
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
                       <div><a class="btn" target="_blank" href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=ca_B8Dz9Fv0Ws0PWzP6eogVk91xdJpqELoi&scope=read_write&redirect_uri=http://runmobileapps.com/squeedr/stripe-connect&state=<?=$user_id;?>"><img src="{{asset('public/assets/website/images/icon-stripe.png')}}"></a></div>
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
                       <div><a href="" id="paypal-intregrate" data-user-id = "<?=$user_id;?>"><img src="{{asset('public/assets/website/images/icon-paypal.png')}}"></a></div>
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
<!--Paypal Modal-->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Paypal</h4>
         </div>
         <form name="paypal_intregration" id="paypal_intregration" method="post" action="{{url('paypal_intregration')}}" enctype="multipart/form-data">
           <div class="modal-body clr-modalbdy">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <div class="input-group"> <span class="input-group-addon"></span>
                          <input id="paypal_email_id" type="text" class="form-control" name="paypal_email_id" placeholder="Paypal Email">
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="modal-footer">
              <div class="col-md-12 text-center">
                <input class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" type="Submit" name="Submit" value="Submit">
                <!--  <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</a> -->
              </div>
           </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('custom_js')
<script type="text/javascript">
$("#paypal-intregrate").on('click', (function(e) {
  e.preventDefault();
  var user_id = $(this).data('user-id');
  var data = addCommonParams([]);
  data.push({ name:'user_id', value:user_id });
  //console.log(data);
  $.ajax({
        url: baseUrl+"/api/get_stripe_email", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
          if(response.response_status=='1')
          {
              $('#paypal_email_id').val(response.response_message);
              $("#myModal").modal('show');
          }
          else
          {
              swal("Error", "Somthing wrong try again later." , "error");
          }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            $('.animationload').hide();
        }

    });
  
}));

$.validator.addMethod("properemail", function(value, element) {
     return this.optional(element) || /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
 });

$('#paypal_intregration').validate({
    rules: {
        paypal_email_id: {
            required: true,
            properemail: true
        }
    },

    messages: {
        paypal_email_id: {
            required: 'Please enter email.',
            properemail: 'Must be a valid email address.'
        }
    }
});
</script>
@endsection