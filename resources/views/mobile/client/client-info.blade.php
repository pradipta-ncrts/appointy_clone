@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
	<div class="container-custm">
	   <div class="upper-cmnsection">
	      <div class="heading-uprlft">Client Info.</div>
	      <div class="upr-rgtsec">
	         <div class="col-sm-5">&nbsp;
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
	               <a class="btn btn-primary butt-next1">Next</a>
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
	               <a href="{{ url('client/booking-verify') }}">3</a>
	               <span>Verification</span>
	            </div>
	            <div class="step">
	               <a href="{{ url('client/booking-details') }}">4</a>
	               <span>Confirmation</span>
	            </div>
	         </div>
	      </div>
	      <div class="container-fluid cust-box pad5per">
	         <div class="row ">
	            <table class="radio-booking">
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
	            </table>
	            <div class="col-md-12 booking-form1">
	               <form class="form-horizontal" action="/action_page.php">
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-title.png')}}">
	                     <input type="text" class="form-control" id="email" placeholder="Title">
	                     <div class="clearfix"></div>
	                  </div>
	               </form>
	            </div>
	            <div class="col-md-6 booking-form1">
	               <form class="form-horizontal" action="">
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-user.png')}}">
	                     <input type="email" class="form-control" id="email" placeholder="First Name">
	                     <div class="clearfix"></div>
	                  </div>
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-dob.png')}}">
	                     <input type="email" class="form-control" id="email" placeholder="DOB (Optionsal)">
	                     <div class="clearfix"></div>
	                  </div>
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-phone.png')}}">
	                     <input type="email" class="form-control" id="email" placeholder="Mobile">
	                     <div class="clearfix"></div>
	                  </div>
	                  <div class="checkbox">
	                     <label class="check"><input type="checkbox"> &nbsp;&nbsp; Accept Squeedr CGU
	                     <span class="checkmark"></span></label>
	                  </div>
	               </form>
	            </div>
	            <div class="col-md-6 booking-form1">
	               <form class="form-horizontal" action="/action_page.php">
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-user.png')}}">
	                     <input type="text" class="form-control"  placeholder="Last Name">
	                     <div class="clearfix"></div>
	                  </div>
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-email.png')}}">
	                     <input type="email" class="form-control" id="email" placeholder="Email">
	                     <div class="clearfix"></div>
	                  </div>
	                  <div class="form-group">
	                     <img src="{{asset('public/assets/website/images/icon-password.png')}}">
	                     <input type="email" class="form-control" id="email" placeholder="Password">
	                     <div class="clearfix"></div>
	                  </div>
	               </form>
	            </div>
	            <div class="clearfix"></div>
	            <p class="msg">A code will be sent to you on that mobile number to validate your account</p>
	         </div>
	      </div>
	   </div>
	</div>
</div>
@endsection