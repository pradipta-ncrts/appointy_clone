@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
	<div class="container-custm">
	   <div class="upper-cmnsection">
	      <div class="heading-uprlft" id="sectionTitle">Reachedule Date & Time</div>
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
	               <a class="btn btn-primary butt-next1" id="next1">Next</a>
				   <a class="btn btn-primary butt-next1" id="next2" style="display:none;">Next</a>
				   <a class="btn btn-primary butt-next1" id="next3" style="display:none;">Next</a>
				   
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
					<a id="step2" href="javascript:void(0);">2</a>
					<span id="titlestep2">Verification</span>
				</div>
				<div class="step">
					<a id="step3" href="javascript:void(0);">3</a>
					<span id="titlestep3">Date & Time</span>
				</div>
				<div class="step">
					<a id="step4" href="javascript:void(0);">4</a>
					<span id="titlestep4">Confirmation</span>
				</div>
				</div>
			</div>

			<div>
			<form class="form-horizontal" name="application_booking_form" id="application_booking_form" action="{{url('api/reschedule_appointment_process')}}" method="post">
				<input type="hidden" name="appointment_id" id="appointment_id" value="{{$appointment_details->appointment_id}}">
				<input type="hidden" name="service_id" id="service_id" value="{{$appointment_details->service_id}}">
				<input type="hidden" name="client_id" id="client_id" value="{{$appointment_details->client_id}}">
				<input type="hidden" name="client_email" id="client_email" value="{{$appointment_details->client_email}}">
				<input type="hidden" name="booking_date" id="booking_date" value="">
				<input type="hidden" name="booking_time" id="booking_time" value="">

				<div class="container-fluid break20px" id="section1">
					<div class="row ">
						<!--<table class="radio-booking">
							<tr>
								<td>
									<label class="radio">Are you an existing user?  
									<input type="radio"  name="radio">
									<span class="radiomark"></span>
									</label>
								</td>
								<td>or</td>
								<td>
									<label class="radio">Are you a new user
									<input type="radio" checked="checked" name="radio">
									<span class="radiomark"></span>
									</label>
								</td>
							</tr>
						</table>-->
						<!--<div class="col-md-12 booking-form1">
							<form class="form-horizontal" action="/action_page.php">
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-title.png')}}">
									<input type="text" class="form-control" id="email" placeholder="Title">
									<div class="clearfix"></div>
								</div>
							</form>
						</div>-->
						<div class="col-md-6 booking-form1">
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-user.png')}}">
									<input type="text" class="form-control" name="client_name" id="client_name" placeholder="Full Name" value="{{$appointment_details->client_name}}">
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-phone.png')}}">
									<input type="text" class="form-control" id="client_mobile" name="client_mobile" placeholder="Mobile" value="{{$appointment_details->client_mobile}}">
									<div class="clearfix"></div>
								</div>
						</div>
						<div class="col-md-6 booking-form1">
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-email.png')}}">
									<input type="email" class="form-control" id="client_email" name="client_email" placeholder="Email" value="{{$appointment_details->client_email}}">
									<div class="clearfix"></div>
								</div>
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-dob.png')}}">
									<input type="text" class="form-control" id="client_dob" name="client_dob" placeholder="DOB (optional)" value="{{$appointment_details->client_dob}}">
									<div class="clearfix"></div>
								</div>
						</div>
						<div class="col-md-12 booking-form1">
								<div class="form-group">
									<img src="{{asset('public/assets/website/images/icon-title.png')}}">
									<input type="text" class="form-control" id="client_address" name="client_address" placeholder="Address" value="{{$appointment_details->client_address}}">
									<div class="clearfix"></div>
								</div>
								<div class="checkbox">
									<label class="check"><input name="accept_cgu" id="accept_cgu" value="1" type="checkbox"> &nbsp;&nbsp; Accept Squeedr CGU
									<span class="checkmark"></span></label>
								</div>
						</div>
						<div class="clearfix"></div>
						<p class="msg">A code will be sent to you on that mobile number to validate your account</p>
					</div>
				</div>

				<div class="container-fluid cust-box pad5per" id="section2" style="display:none;">
					<div class="row">
						<div class="col-md-12 booking-form verify pad5per" id="verification_section">
							<h3> Enter here the code, sent on your email address</h3>
								<div class="form-group verify-code">
								<input type="text" name="verification_code" id="verification_code" class="form-control"  placeholder="Enter the code here  ( i.e. 12345678 )">
								<div class="clearfix"></div>
								</div>
								<button class="butt-verify" id="validate_verification_code">Validate</button>
						</div>
						<div class="col-md-12 booking-form verify pad5per" id="verification_success_section" style="display:none;">
							<h2> Verification code has been successfully verified.</h2>
						</div>
						<div class="clearfix">&nbsp;</div>
					</div>
				</div>

				<div class="container-fluid body-sec" id="section3" style="display:none;">
					<div class="row ">
						<div class="col-md-12 booking-form ">
							<div class="dp-fields  cust-box">
								<div class="col-sm-6">
								<div class="form-group  color-b" >
									<select name="category_id" id="category_id">
										<option>Select Category </option>
										<?php if(!empty($category_list)) { foreach($category_list as $category) { ?>
										<option <?php if($category->category_id == $appointment_details->category_id) { ?> selected="" <?php } ?> value="{{$category->category_id}}">{{$category->category}}</option>
										<?php } } ?>
									</select>
									<div class="clearfix"></div>
								</div>
								<div class="form-group  color-b" >
									<select name="service_id" id="service_id">
										<option>Select service</option>
										<?php if(!empty($service_list)) { foreach($service_list as $service) { ?>
										<option <?php if($service->service_id == $appointment_details->service_id) { ?> selected="" <?php } ?> value="{{$service->service_id}}">{{$service->service_name}}</option>
										<?php } } ?>
									</select>
									<div class="clearfix"></div>
								</div>
								<?php if(!empty($staff_list)) { ?>
								<div class="form-group  color-b" >
									<select name="staff_id" id="staff_id">
										<option>Select Staff </option>
										<?php if(!empty($staff_list)) { foreach($staff_list as $staff) { ?>
										<option <?php if($staff->staff_id == $appointment_details->staff_id) { ?> selected="" <?php } ?> value="{{$staff->staff_id}}">{{$staff->full_name}}</option>
										<?php } } ?>
										
									</select>
									<div class="clearfix"></div>
								</div>
								<?php } ?>
								<div class="clearfix"></div>
								</div>
								<div class="col-sm-6">
								<div class="next-available">
									<a>Appointment On</a>
									<h3>{{$appointment_details->appoinment_date}} {{date('h:i A',strtotime($appointment_details->start_time))}}</h3>
								</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="book-cal col-sm-12 cust-box">
								<p >Select appointment date
									<span id="current_month">May 2018</span>
								</p>
								<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
									<div class="carousel-inner">
									<div class="item active">
										<table class="day">
											
										</table>
									</div>

									</div>
									<!-- Left and right controls -->
									<a class="left carousel-control" href="#myCarousel" onclick="get_availibility_calender(2)" data-slide="prev">
									<img src="{{asset('public/assets/website/images/arrow-left.png')}}">
									</a>
									<a class="right carousel-control" href="#myCarousel" onclick="get_availibility_calender()" data-slide="next">
									<img src="{{asset('public/assets/website/images/arrow-right.png')}}">
									</a>
								</div>
								<!--<a href="#" class="view-more-schedule">View More Schedules</a>-->
							</div>
						</div>
					</div>
				</div>

				<div class="container-fluid body-sec" id="section4" style="display:none;">
					<div class="row booking-confirm pad5per">
						<div id="appointment_success_section" style="display:none;">
							<h2 id="appointment_success_message">Booking is Confirmed</h2>
							<p> 
								We have just sent you an email confirmation of appointment<br>
								You will also receive an SMS the day before the appointment
							</p>
						</div>
						<div class="date-bar" id="selected_date_time">
							Wednesday - 16 May, 2018 - 10:20 AM
						</div>
						<div class="col-md-6">
							<div class="user-pic">
								<?php if($appointment_details->staff_profile_picture != ""){ ?>
									<img src="{{$appointment_details->staff_profile_picture}}" width="60px" height="60px">
								<?php } else { ?>
									<img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}">
								<?php } ?>
								<h2>{{$appointment_details->staff_name}}
									<!--<span>Psychiatrist</span>-->
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-user.png')}}">
									<h2>
									Client
									<span id="view_client_name">{{$appointment_details->client_name}}</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-phone.png')}}">
									<h2>
									Phone
									<span id="view_client_phone">{{$appointment_details->staff_mobile}}</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">
									<h2>
									Address
									<span id="view_client_address">{{$appointment_details->business_location}}</span> 
									</h2>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="prof-info">
								<div class="col-sm-12">
									<img src="{{asset('public/assets/website/images/profile-icon-payment.png')}}">
									<h2>
									Payment Mode
									<span>Cash</span> 
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
							<div id="map-container" class="z-depth-1" style="height: 475px"></div>
						</div>
						<div class="clearfix"></div>
						<button id="appointment_submit" type="submit" class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block">CONFIRM</button>
					</div>
				</div>
			</form>
			</div>
	   </div>
	</div>
	</div>
@endsection


@section('custom_js')


<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="/assets/gmap3.js?body=1" type="text/javascript"></script>

<script type="text/javascript">

	var geocoder = new google.maps.Geocoder();
	var address = "<?php echo $appointment_details->business_location;?>";
	var latitude = "";
	var longitude = "";

	geocoder.geocode( { 'address': address}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {
			latitude = results[0].geometry.location.lat();
			longitude = results[0].geometry.location.lng();
			
		} 
	}); 

	//alert(latitude);

	// Regular map
	function regular_map() {
		var var_location = new google.maps.LatLng(latitude, longitude);
		var var_mapoptions = {
			center: var_location,
			zoom: 14
		};
		var var_map = new google.maps.Map(document.getElementById("map-container"),
			var_mapoptions);
		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title: "<?php echo $appointment_details->business_location;?>"
		});
	}

	// Initialize maps
	google.maps.event.addDomListener(window, 'load', regular_map);
</script>
<script>
	$(document).ready(function () {
		$("#client_dob").datepicker({
			   dateFormat: 'mm-dd-yy',
               changeYear: true,
               changeMonth: true,
               maxDate: 0,
		});

		$('#next1').click(function(){
			if($("#accept_cgu").prop('checked') == true){
				var data = [];
                var appointment_id = $('#appointment_id').val();
				var client_id = $('#client_id').val();
				var client_email = $('#client_email').val();
                data.push({name:'client_id',value:client_id},{name:'appointment_id',value:appointment_id},{name:'client_email',value:client_email});
				//console.log(data);
				$.ajax({
					url: "<?php echo url('api/send_client_verification_code');?>",
					type: "POST",
					data:data ,
					dataType: "json",
					success: function(response) {
						console.log(response);
						if(response.result==1)
						{
							$('#next1').hide();
							$('#next2').show();
							$('#next3').hide();
							//$('#step1').removeClass("active");
							$('#step2').addClass("active");
							//$('#titlestep1').removeClass("active");
							$('#titlestep2').addClass("active");
							//$('#sectionTitle').text('Client Info.');
							$('#section1').hide();
							$('#section2').show();
							$('#section3').hide();
							$('#section4').hide();
						}
						else{
							swal('Sorry!',response.message,'error');
						}
					},

					beforeSend: function(){
						$('.animationload').show();
					},

					complete: function(){
						$('.animationload').hide();
					}
				});

				
			} else {
				swal('Warning!','Please accept Squeedr CGU','error');
			}
			
		});

		$('#next2').click(function(){
			$('#next1').hide();
			$('#next2').hide();
			$('#next3').show();
			//$('#step2').removeClass("active");
			$('#step3').addClass("active");
			//$('#titlestep2').removeClass("active");
			$('#titlestep3').addClass("active");
			//$('#sectionTitle').text('Verification');
			$('#section1').hide();
			$('#section2').hide();
			$('#section3').show();
			$('#section4').hide();
			
		});

		$('#validate_verification_code').click(function(e){
			e.preventDefault();
			var verification_code = $('#verification_code').val();
			//alert(verification_code);
			if(verification_code!=""){
				var data = [];
                var client_id = $('#client_id').val();
                data.push({name:'client_id',value:client_id},{name:'verification_code',value:verification_code});
				console.log(data);
				$.ajax({
					url: "<?php echo url('api/appointment_verification');?>",
					type: "POST",
					data: data,
					dataType: "json",
					success: function(response) {
						console.log(response);
						if(response.result==1)
						{
							$('#verification_section').hide();
							$('#verification_success_section').show();
						}
						else{
							swal('Sorry!',response.message,'error');
						}
					},

					beforeSend: function(){
						$('.animationload').show();
					},

					complete: function(){
						$('.animationload').hide();
					}
				});
			} else {
				swal('Error!','Please enter verification code','error');
			}
		})

		$('#next3').click(function(){
			var data = [];
			var client_id = $('#client_id').val();
			var verification_code = $('#verification_code').val();
			data.push({name:'client_id',value:client_id},{name:'verification_code',value:verification_code});
			//console.log(data);
			$.ajax({
				url: "<?php echo url('api/appointment_verification');?>",
				type: "POST",
				data:data ,
				dataType: "json",
				success: function(response) {
					console.log(response);
					if(response.result==1)
					{
						$('#next1').hide();
						$('#next2').hide();
						$('#next3').hide();
						//$('#step3').removeClass("active");
						$('#step4').addClass("active");
						//$('#titlestep3').removeClass("active");
						$('#titlestep4').addClass("active");
						//$('#sectionTitle').text('Confirmation');
						$('#section1').hide();
						$('#section2').hide();
						$('#section3').hide();
						$('#section4').show();
					}
					else{
						swal('Sorry!',response.message,'error');
					}
				},

				beforeSend: function(){
					$('.animationload').show();
				},

				complete: function(){
					$('.animationload').hide();
				}
			});
			
		});


		$('#application_booking_form').validate({
			ignore: [],
			rules: {
				appointment_id: {
					required: true
				},
				client_id: {
					required: true
				},
				booking_date: {
					required: true
				},
				booking_time: {
					required: true
				}
			},

			messages: {
				appointment_id: {
					required: 'Appointment id is missing'
				},
				client_id: {
					required: 'Client id is missing'
				},
				booking_date: {
					required: 'Please select appointment date'
				},
				client_id: {
					required: 'Please select appointment time'
				}
			},

			submitHandler: function(form) {
				var data = $(form).serializeArray();
				console.log(data);
				$.ajax({
					url: form.action,
					type: form.method,
					data: data,
					dataType: "json",
					success: function(response) {
						console.log(response);
						if(response.result==1)
						{
							var special_notes = $('#special_notes').val();
							$('#appointment_success_message').text(response.message);
							$('#appointment_success_section').show();
							$('#appointment_submit').hide();
							$('#special_notes_section').html(special_notes);
							$('#special_notes_section').show();
							$('#special_notes').hide();
							//Need to reset form //
							
						}
						else{
							swal('Sorry!',response.message,'error');
						}
					},

					beforeSend: function(){
						$('.animationload').show();
					},

					complete: function(){
						$('.animationload').hide();
					}
				});
			}
		});


	});  

	$(document).ready(function(){
		get_availibility_calender();
	});

	var cal_start = "";
	function get_availibility_calender(order){
		var data = [];
		var user_no = "<?php echo $appointment_details->user_id;?>";
		var staff_id = "<?php echo $appointment_details->staff_id;?>";
		var duration = "<?php echo $appointment_details->duration;?>";
		var client_id = "<?php echo $appointment_details->client_id;?>";
		var appointment_id = "<?php echo $appointment_details->appointment_id;?>";
		var service_id = "<?php echo $appointment_details->service_id;?>";
		if(order == undefined){
			order = 1; //next
		}
		data.push({name:'user_no',value:user_no},
		{name:'staff_id',value:staff_id},
		{name:'service_id',value:service_id},
		{name:'duration',value:duration},
		{name:'client_id',value:client_id},
		{name:'appointment_id',value:appointment_id},
		{name:'cal_start',value:cal_start},
		{name:'order',value:order}
		);
		console.log(data);
		$.ajax({
			url: "<?php echo url('api/calendar_availability_list');?>",
			type: "POST",
			data: data,
			dataType: "json",
			success: function(response) {
				//console.log(response);
				if(response.result==1)
				{
					//console.log(response);
					//$('#verification_section').hide();
					//$('#verification_success_section').show();
					$('#current_month').text(response.current_month);
					var date_array_header = Object.keys(response.date_array_header);
					//console.log(date_array_header);
					html = "<tr>";
					for(i = 0;i<date_array_header.length;i++){
						var day_active = "";
						var tmp = date_array_header[i];
						if(tmp == response.current_date){
							day_active = "active";
						}
						//alert(response.date_array_header[tmp]);
						html += "<td>";
						html += "<a href='#' class='days "+day_active+"'>"+response.date_array_header[tmp][0];
						html += "<br>";
						html += "<span>"+response.date_array_header[tmp][1]+"</span>";
						html += "</a>";
						html += "</td>";
					}
					html += "</tr>";
					//console.log(response.calendar_availability_list[tmp]);
					cal_start = tmp;
					var daily_element_array = Object.keys(response.calendar_availability_list[tmp]);
					//console.log(daily_element_array);
					var whole = daily_element_array.length;
					//console.log(whole);
					//return false;
					var k = 0;
					while(k<whole){
						html += "<tr>";
						for(i = 0;i<date_array_header.length;i++){
							var row = date_array_header[i];
							var column = daily_element_array[k];
									var btn_class= response.calendar_availability_list[row][column].slot_formatted;
									var style = ""
									if(response.calendar_availability_list[row][column].booked == 1){
										btn_class = "-------";
										style="pointer-events: none; cursor: default";
									}else if(response.calendar_availability_list[row][column].blocked == 1){
										btn_class = "-------";
										style="pointer-events: none; cursor: default";
									}
									html += "<td>";
									html += "<a href='javascript:void(0)' class='times' style='"+style+"' data-date-time-formatted='"+response.calendar_availability_list[row][column].date_time_formatted+"' data-slot='"+response.calendar_availability_list[row][column].slot+"' data-date='"+response.calendar_availability_list[row][column].date+"' >"+btn_class;
									html += "</a>";
									html += "</td>";
						}
						html += "</tr>";
						k++;
					}	
					$('.day').html(html);
				}
				else{
					swal('Sorry!',response.message,'error');
				}
			},

			beforeSend: function(){
				$('.animationload').show();
			},

			complete: function(){
				$('.animationload').hide();
			}
		});
	}
	$(document).on('click','a.times',function(){
		$('#booking_date').val('');
		$('#booking_time').val('');
		$(document).find('a.times').removeClass('active');	
		$(this).addClass('active');
		var slot = $(this).attr('data-slot');
		var date =$(this).attr('data-date');
		var selected_date_time =$(this).attr('data-date-time-formatted');
		$('#booking_date').val(date);
		$('#booking_time').val(slot);
		$('#selected_date_time').text(selected_date_time);
	});
</script>
@endsection