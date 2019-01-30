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
	               <a class="btn btn-primary butt-next1" id="next1">Next</a>
				   <a class="btn btn-primary butt-next1" id="next2" style="display:none;">Next</a>
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
					<a id="step4" href="javascript:void(0);">4</a>
					<span id="titlestep4">Confirmation</span>
				</div>
				</div>
			</div>

			<div>
			<form class="form-horizontal" name="appointment_booking_form" id="appointment_booking_form" action="{{url('api/client_appointment_booking_process')}}" method="post">
				<input type="hidden" name="client_id" id="client_id" value="{{$client_details->client_id}}">
				<input type="hidden" name="client_email" id="client_email" value="{{$client_details->client_email}}">
				<input type="hidden" name="booking_date" id="booking_date" value="">
				<input type="hidden" name="booking_time" id="booking_time" value="">

				<div class="container-fluid body-sec" id="section3" >
					<div class="row ">
						<div class="col-md-12 booking-form ">

						<div id="select_date_section" >
							<div class="dp-fields  cust-box">
								<div class="col-sm-6">
								<div class="form-group  color-b" >
									<select name="user_id" id="user_id">
										<option value="">Select Service Provider </option>
										<?php if(!empty($business_provider_list)) { foreach($business_provider_list as $business_provider) { ?>
										<option value="{{$business_provider->user_id}}"><?php if($business_provider->user_type == 1) echo $business_provider->name; else $business_provider->business_name; ?></option>
										<?php } } ?>
									</select>
									<div class="clearfix"></div>
								</div>
								<div class="form-group  color-b" >
									<select name="category_id" id="category_id">
										<option>Select Category </option>
										
									</select>
									<div class="clearfix"></div>
								</div>
								<div class="form-group  color-b" >
									<select name="service_id" id="service_id">
										<option>Select Service</option>
										
									</select>
									<div class="clearfix"></div>
								</div>
								<div class="form-group  color-b" id="staff_section">
									
								</div>
								<div class="clearfix"></div>
								</div>
								<div class="col-sm-6">
									<div class="next-available">
										<a onclick="get_availibility_calender(2)">Check Availability</a>
										<h3></h3>
									</div>

									<!--<div class="reshedule">
										<select id="dropdown_change">
											<option value="0">Does not repeat</option>
											<option value="1">Daily</option>
											<option value="2">Weekly on Friday</option>
											<option value="3">Monthly on the second friday </option>
											<option value="4">Every weekday(Monday to Friday) </option>
											<option value="5">Custom...</option>
										</select>
									</div>-->
									
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="book-cal" class="book-cal col-sm-12 cust-box" style="display:none;">
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
						<div id="question_answer_section" style="display:none;">					
							<!--<div class="book-cal col-sm-12 cust-box mb-20">
								<div class="reschedule-qus">
									<span>What is Lorem Ipsum?<b class="error">*</b></span>
									<textarea rows="4" cols="3"></textarea>
								</div>
								<div class="reschedule-qus">
									<span>What is Lorem Ipsum?<b class="error">*</b></span>
									<input type="text" class="form-control">
								</div>
								<div class="reschedule-qus">
									<span>What is Lorem Ipsum?<b class="error">*</b></span>
									<div class="qus-chkinpt">
										<span><input name="required1" id="" type="radio" value="1"> Lorem Ipsum1</span>
										<span><input name="required2" id="" type="radio" value="2"> Lorem Ipsum2</span>
										<span><input name="required3" id="" type="radio" value="3"> Lorem Ipsum3</span>
										<span><input name="required4" id="" type="radio" value="4"> Lorem Ipsum4</span>
										<span><input name="required5" id="" type="radio" value="5"> Lorem Ipsum5</span>
									</div>
								</div>
								<div class="reschedule-qus">
									<span>What is Lorem Ipsum?<b class="error">*</b></span>
									<div class="qus-chkinpt">
										<span><input name="is_required1" id="" type="checkbox" value="1"> Lorem Ipsum1</span>
										<span><input name="is_required2" id="" type="checkbox" value="2"> Lorem Ipsum2</span>
										<span><input name="is_required3" id="" type="checkbox" value="3"> Lorem Ipsum3</span>
										<span><input name="is_required4" id="" type="checkbox" value="4"> Lorem Ipsum4</span>
										<span><input name="is_required5" id="" type="checkbox" value="5"> Lorem Ipsum5</span>
									</div>
								</div>
								<div class="reschedule-qus">
									<button class="btn btn-primary" type="button">Submit</button>
								</div>
							</div>-->
						</div>

						</div>
					</div>
				</div>

			</form>
			</div>
	   </div>
	</div>

	<!-- Modal -->
	<div id="reschedule-popup" class="modal" role="dialog">
		<div>
			<!-- Modal content-->
			<div class="modal-content" style="box-shadow:none;border:0;width:100%;">
				<!--<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Custom Recurrence</h4>
					</div>-->
				<div class="modal-body clearfix">
					<div class="form-group clearfix">
						<label class="control-label col-sm-4" for="email">Repeat every:</label>
						<div class="col-sm-4">
						<input type="number" name="quantity" min="1" max="10" class="form-control">
						</div>
						<div class="col-sm-4">
						<select class="form-control">
							<option>Week</option>
							<option>day</option>
							<option>Month</option>
							<option>year</option>
						</select>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-sm-12">Repeat on:</label>
						<div class="col-sm-12">
						<div class="reschedule-bx">
							<ul>
								<li><a>S</a></li>
								<li><a>M</a></li>
								<li><a>T</a></li>
								<li><a>W</a></li>
								<li><a>F</a></li>
								<li><a>S</a></li>
							</ul>
						</div>
						</div>
					</div>
					<div class="apply-mulbx">
						<input class="rb-email" name="contact-preference" id="rb-email" type="radio" checked="checked" />
						<label class="label" for="rb-email">Never</label>
						<br>
						<input class="rb-phone" name="contact-preference" id="rb-phone" type="radio" />
						<label class="label" for="rb-phone">On</label>
						<br>
						<input class="rb-after" name="contact-preference" id="rb-after" type="radio" />
						<label class="label" for="rb-after">After</label>
						<br>
						<label class="label email" for="email">
						<div class="aply-dv">No data</div>
						</label>
						<label class="label phone" for="phone">
						<div class="aply-dv">
							<div class="form-group">
								<div class="col-md-3"><input type="text" class="form-control" placeholder="" /></div>
							</div>
						</div>
						</label>
						<label class="label after" for="after">
						<div class="aply-dv">
							<div class="form-group">
								<div class="col-md-3"><input type="number" name="quantity" min="1" max="10" class="form-control" placeholder="13"></div>
								<div class="col-md-9"><input type="text" class="form-control" placeholder="Occurrences" /></div>
							</div>
						</label>
						</div>
					</div>
					<div class="form-group">
						<div class="discount-btnbx mtop">
						<button type="submit" class="btn btn-primary pull-left">Cancel</button>
						<button class="btn pull-right" data-dismiss="modal">Done</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>										

</div>
@endsection


@section('custom_js')

<script>
	$(document).ready(function () {
		$("#user_id").on("change", function(){
			var user_id = $(this).val();
			$.ajax({
				url: '<?php echo url("api/business_provider_category_list")?>',
				type: "POST",
				data: {user_no:user_id,type:'html'},
				dataType: "html",
				success: function(response) {
					$('#category_id').html( response );
				},

				beforeSend: function(){
					$('.animationload').show();
				},

				complete: function(){
					$('.animationload').hide();
				}
			});
		});

		$("#category_id").on("change", function(){
			var category_id = $(this).val();
			var user_id = $("#user_id").val();
			$.ajax({
				url: '<?php echo url("api/business_provider_service_list")?>',
				type: "POST",
				data: {user_no:user_id,category_id:category_id,type:'html'},
				dataType: "html",
				success: function(response) {
					$('#service_id').html( response );
				},

				beforeSend: function(){
					$('.animationload').show();
				},

				complete: function(){
					$('.animationload').hide();
				}
			});
		});

		$("#service_id").on("change", function(){
			var service_id = $(this).val();
			//var selected = $(this).find('option:selected');
       		//var duration = selected.data('duration');
			var user_id = $("#user_id").val();

			$.ajax({
				url: '<?php echo url("api/business_provider_staff_list")?>',
				type: "POST",
				data: {user_no:user_id,service_id:service_id,type:'html'},
				dataType: "html",
				success: function(response) {
					$('#staff_section').html( response );
				},

				beforeSend: function(){
					$('.animationload').show();
				},

				complete: function(){
					$('.animationload').hide();
				}
			});
		});
		

		$("#next1").on("click", function(){
			var user_id = $("#user_id").val();
			var category_id = $("#category_id").val();
			var service_id = $("#service_id").val();
			var client_id = $("#client_id").val();
			var booking_date = $("#booking_date").val();
			var booking_time = $("#booking_time").val();

			if(user_id > 0 && category_id > 0 && service_id > 0 && client_id > 0 && booking_date != '' && booking_time != ''){
				$.ajax({
					url: '<?php echo url("api/service_invitee_question")?>',
					type: "POST",
					data: {user_no:user_id,service_id:service_id},
					dataType: "json",
					success: function(response) {
						console.log(response);
						if(response.is_exist == 1){
							$('#select_date_section').hide();
							$('#question_answer_section').html(response.html);
							$('#question_answer_section').show();
							$('#next1').hide();
							$('#next2').show();
						} else {
							//$("#appointment_booking_form").valid();
							$('form#appointment_booking_form').submit();
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
				swal('Sorry!','Please choose booking date and time ','error');
			}

			
		});

		$('#next2').on('click', function() {
			//$("#appointment_booking_form").valid();
			$('form#appointment_booking_form').submit();
		});

		$('#appointment_booking_form').validate({
			ignore: [],
			rules: {
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
				client_id: {
					required: 'Client id is missing'
				},
				booking_date: {
					required: 'Please select appointment date'
				},
				booking_time: {
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
						if(response.response_status==1)
						{
							//swal('Success!',response.message,'success');
							var url = '<?php echo url('/client/appointment-confirmation');?>'+'/'+response.parameter;
                            window.location.href = url;
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

		$('#reschedule-popup').dialog({
			modal: true,
			autoOpen: false,
			title: "Custom Recurrence",
			width: 500
		});

		$('#dropdown_change').change(function () {
			if ($(this).val() == "5") {
				$('#reschedule-popup').dialog('open');
			}
		});

	});  

	var cal_start = "";
	function get_availibility_calender(order){
		var selected = $("#service_id").find('option:selected');
		var duration = selected.data('duration');

		var data = [];
		var user_no = $("#user_id").val();
		var client_id = $("#client_id").val();
		var service_id = $("#service_id").val();
		var staff_id = $("#staff_id").val();
		var appointment_id = "";
		if(order == undefined){
			order = 1; //next
		}

		if(client_id > 0 && service_id > 0 ){
			data.push({name:'user_no',value:user_no},
			{name:'service_id',value:service_id},
			{name:'staff_id',value:staff_id},
			{name:'duration',value:duration},
			{name:'client_id',value:client_id},
			{name:'appointment_id',value:appointment_id},
			{name:'cal_start',value:cal_start},
			{name:'order',value:order}
			);
			//console.log(data);
			$.ajax({
				url: "<?php echo url('api/calendar_availability_list');?>",
				type: "POST",
				data: data,
				dataType: "json",
				success: function(response) {
					console.log(response);
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
						$("#book-cal").show();
					}
					else{
						$("#book-cal").hide();
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
			swal('Sorry!','Please select the service first','error');
		}

		
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