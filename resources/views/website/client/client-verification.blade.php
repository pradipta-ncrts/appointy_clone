@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
	<div class="container-custm">
	   <div class="upper-cmnsection">
	      <div class="heading-uprlft" id="sectionTitle">Verification</div>
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
	               <a class="btn btn-primary butt-next1" id="next">Next</a>
	            </div>
	         </div>
	      </div>
	   </div>
	   <div class="clearfix"></div>
	   <div class="rightpan full">
			<div class="container">
				<div class="booking-steps" style="display:none;">
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
				
				<div class="container-fluid cust-box pad5per" id="section2">
					<div class="row">
					<input type="hidden" name="client_id" id="client_id" value="{{$client_details->client_id}}">
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

			</div>
	   </div>
	</div>
	</div>
@endsection


@section('custom_js')
<script>
	$(document).ready(function () {

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
							var url = '<?php echo url('/client/appointment-booking');?>'+'/'+response.parameter;
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
						$('#step3').removeClass("active");
						$('#step4').addClass("active");
						$('#titlestep3').removeClass("active");
						$('#titlestep4').addClass("active");
						$('#sectionTitle').text('Confirmation');
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

	});  
</script>
@endsection