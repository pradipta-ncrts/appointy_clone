@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('custom_css')
<style>
.reschedule-bx{width:100%;float: left;margin: 10px 0;}
.reschedule-bx ul{margin: 0;padding: 0;list-style: none;}
.reschedule-bx ul li{float: left;margin: 0 10px 0 0;}
.reschedule-bx ul li a{color: #222;background: #ccc;border-radius:50px;width:34px;height: 34px;text-align: center;line-height: 35px;float: left;font-size: 15px;font-weight: 400;}
.reschedule-bx ul li a:hover{background: #2196F3;color: #fff;}
.apply-mulbx{width:100%;display: inline-block;padding: 0 10px;}
.apply-mulbx label{color:#000;font-size:14px;text-align: left;}
.aply-dv{width:100%;float:left;margin:0 0 18px;}
.aply-dv label{width:100%;float:left;margin:0 0 18px;font-size:16px; text-align: left;}
.apply-mulbx .rb-email, .apply-mulbx .rb-phone, .apply-mulbx .rb-after{margin:0 8px 18px 0;}
#reschedule-popup .modal-header{background:none;color:#000;padding:10px 10px;}
#reschedule-popup .close {background-color: #eee !important;width: 35px;height: 35px;border-radius: 50%;font-size: 1.3rem;text-shadow: none;color: #818181 !important;opacity: 1;margin:2px 2px 0 0;font-size: 15px;}
#reschedule-popup .modal-title{font-size: 18px;}
.email, .phone, .after {display:none;}
.rb-email:checked ~ .email {display:inline;}
.rb-phone:checked ~ .phone {display:inline;}
.rb-after:checked ~ .after {display:inline;}
.reshedule{width:90%;margin:0 auto;}

.reschedule-qus{width:100%;float:left;margin: 0 0 10px;}
.reschedule-qus span{width:100%;float:left;color:#000;font-size:16px;margin:0 0 5px;display: inline-flex;}
.reschedule-qus span b{float:left;margin: 0 0 0 6px !important;}
.reschedule-qus p{width:100%;float:left;color:#666;font-size:14px;margin:0 0 15px;}
.mb-20{margin:0 0 20px;}
.qus-chkinpt{width:100%;float:left;}
.qus-chkinpt span{margin: 5px 16px 12px 0;width: auto;}

</style>
@endsection

@section('content')
<div class="body-part">
	<div class="container-custm">
	   <div class="upper-cmnsection">
	      <div class="heading-uprlft" id="sectionTitle">Book Your Date & Time</div>
	      <div class="upr-rgtsec">
	         <div class="col-sm-5">&nbsp;
	            <!-- <div id="custom-search-input">
	               <div class="input-group">
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
					<a id="step1" href="javascript:void(0);" class="active">1</a>
					<span id="titlestep1" class="active">Client Info.</span>
				</div>
				<div class="step">
					<a id="step2" href="javascript:void(0);" class="active">2</a>
					<span id="titlestep2" class="active">Verification</span>
				</div>
				<div class="step">
					<a id="step3" href="javascript:void(0);" class="active">3</a>
					<span id="titlestep3" class="active">Date & Time</span>
				</div>
				<div class="step">
					<a id="step4" href="javascript:void(0);" class="active">4</a>
					<span id="titlestep4" class="active">Confirmation</span>
				</div>
				</div>
			</div>

			<div>
				<div class="container-fluid body-sec" id="section4">
					<div class="row booking-confirm pad5per">
						<div id="appointment_success_section">
							<h2 id="appointment_success_message">Booking is Confirmed</h2>
							<p> 
								We have just sent you an email confirmation of appointment<br>
								You will also receive an Email/SMS the day before the appointment
							</p>
						</div>
						<div class="date-bar" >
							{{$appoinment_details->appoinment_date}} - {{$appoinment_details->appoinment_raw_time}}
						</div>
						<div class="col-md-6">
							<?php if($appoinment_details->staff_name) { ?>
							<div class="user-pic">
								<?php if($appoinment_details->staff_profile_picture != ""){ ?>
									<img src="{{$appoinment_details->staff_profile_picture}}" width="60px" height="60px">
								<?php } else { ?>
									<img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}">
								<?php } ?>
								<h2>{{$appoinment_details->staff_name}}
									<span>{{$appoinment_details->expertise}}</span>
								</h2>
								<div class="clearfix"></div>
							</div>
							<?php } else { ?>
							<div class="user-pic">
								<?php
								if($appoinment_details->user_type==1)
								{
									if($appoinment_details->profile_perosonal_image!="")
									{
									?>	
										<img src="{{asset('public/image/profile_perosonal_image')}}/<?=$appoinment_details->profile_perosonal_image;?>" width="60px" height="60px">
									<?php
									}
									else
									{
									?>
										<img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}">
									<?php
									}
								}
								else
								{
									if($appoinment_details->profile_image!="")
									{
									?>
										<img src="{{asset('public/image/profile_image')}}/<?=$appoinment_details->profile_image;?>" width="60px" height="60px">
									<?php
									}
									else
									{
									?>
										<img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}">
									<?php
									}
								}
								?>
								<h2>{{$appoinment_details->business_name}}
									<span>{{ $appoinment_details->profession }}</span>
								</h2>
								<div class="clearfix"></div>
							</div>
							<?php } ?>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-user.png')}}">
									<h2>
									Client
									<span id="view_client_name">{{$appoinment_details->client_name}}</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-phone.png')}}">
									<h2>
									Phone
									<span id="view_staff_phone"><?=$appoinment_details->staff_mobile ? $appoinment_details->staff_mobile : $appoinment_details->service_provider_mobile;?></span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">
									<h2>
									Address
									<span id="view_staff_address">{{$appoinment_details->business_location}}</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-payment.png')}}">
									<h2>
									Payment Mode
									<span>
									<?php
									if($appoinment_details->payment_method==10)
									{
										echo "Stripe";
									}
									else if($appoinment_details->payment_method==11)
									{
										echo "Paypal";
									}
									else if ($appoinment_details->payment_method==1)
									{
										echo "Cash";
									}
									else
									{
										echo "Cash";
									}
									?>

									</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-sp-notes.png')}}">
									<h2>
									Special Notes 
									<span id="special_notes_section"></span>
									<textarea style="margin-top: 10px" id="special_notes" name="special_notes" rows="4"></textarea>
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-md-6">
							<!--Google map-->
							<div id="map" class="z-depth-1" style="height: 475px"></div>
						</div>
						<div class="clearfix"></div>
						<a href="{{$appoinment_details->redirect_url}}"><button type="button" class="btn btn-primary butt-next" style="margin: 30px auto 0; display: block">Book another Appointment</button></a>
					</div>
				</div>
			</div>

	   </div>
	</div>
	</div>
@endsection


@section('custom_js')
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGNBMdy-f3Pj7GsshK8pYEfxn4H68c1EM&libraries=places&callback=initialize" async defer></script>


<script type="text/javascript">
function initialize() {
    initMap();
    initAutocomplete();
  }
  var map, marker;
function initMap() {
      var myLatLng = {lat: <?=$appoinment_details->latitute ? $appoinment_details->latitute : "-34.397";?>,
          lng: <?=$appoinment_details->logngitude ? $appoinment_details->logngitude : "-34.397";?>};

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: myLatLng
      });

      <?php
      if($appoinment_details->business_location)
      {
      ?>
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: '<?=$appoinment_details->business_location;?>'
      });
      <?php
      }
      ?>
    }
</script>
@endsection