@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Confirmation</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">&nbsp;
               <!-- <div id="custom-search-input">
                  <div class="input-group ">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div> -->
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="container">
            <div class="booking-steps ">
	            <hr>
	            <div class="step">
	               <a href="{{ url('client/client-appointment') }}" class="active">1</a>
	               <span class="active">Date & Time</span>
	            </div>
	            <div class="step">
	               <a href="{{ url('client/client-info') }}" class="active">2</a>
	               <span class="active">Client Info.</span>
	            </div>
	            <div class="step">
	               <a href="{{ url('client/booking-verify') }}" class="active">3</a>
	               <span class="active">Verification</span>
	            </div>
	            <div class="step">
	               <a href="{{ url('client/booking-details') }}" class="active">4</a>
	               <span class="active">Confirmation</span>
	            </div>
	        </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row booking-confirm pad5per">
               <h2>Booking is Confirmed</h2>
               <p> 
                  We have just sent you an email confirmation of appointment<br>
                  You will also receive an SMS the day before the appointment
               </p>
               <div class="date-bar">
                  Wednesday - 16 May, 2018 - 10:20 AM
               </div>
               <div class="col-md-6">
                  <div class="user-pic">
                     <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}">
                     <h2>Dr. Esther Gladden
                        <span>Psychiatrist</span>
                     </h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="prof-info">
                     <div class="col-sm-12">
                        <img src="{{asset('public/assets/website/images/profile-icon-user.png')}}">
                        <h2>
                           Patient
                           <span>Joanna D. Lopez</span> 
                        </h2>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="prof-info">
                     <div class="col-sm-12">
                        <img src="{{asset('public/assets/website/images/profile-icon-phone.png')}}">
                        <h2>
                           Phone
                           <span>111 255 666 </span> 
                        </h2>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="prof-info">
                     <div class="col-sm-12">
                        <img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">
                        <h2>
                           Address
                           <span>Lauren Drive, Madison, WI 53705 </span> 
                        </h2>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="prof-info">
                     <div class="col-sm-12">
                        <img src="{{asset('public/assets/website/images/profile-icon-payment.png')}}">
                        <h2>
                           Payment Mode
                           <span>Online</span> 
                        </h2>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="prof-info">
                     <div class="col-sm-12">
                        <img src="{{asset('public/assets/website/images/profile-icon-sp-notes.png')}}">
                        <h2>
                           Special Notes 
                           <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id enim volumus,
                           id contendimus, ut officii fructus sit ipsum officium. Ut necesse sit omnium rerum,
                           quae natura vigeant, similem esse finem, non eundem.</span> 
                        </h2>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <!--Google map-->
                  <div id="map-container" class="z-depth-1" style="height: 475px"></div>
               </div>
               <div class="clearfix"></div>
               <a class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block">CONFIRM</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection