@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Verification</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">&nbsp;
                  <!-- <div class="input-group ">
                     <input type="text" class=" search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div> -->
               </div>
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
	               <a href="{{ url('client/booking-verify') }}" class="active">3</a>
	               <span class="active">Verification</span>
	            </div>
	            <div class="step">
	               <a href="{{ url('client/booking-details') }}">4</a>
	               <span>Confirmation</span>
	            </div>
	        </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row">
               <div class="col-md-12 booking-form verify pad5per">
                  <h3> Enter here the code, sent on your email address</h3>
                  <form class="form-horizontal" action="/action_page.php">
                     <div class="form-group verify-code">
                        <input type="text" class="form-control"  placeholder="Enter the code here  ( i.e. 123548 )">
                        <div class="clearfix"></div>
                     </div>
                     <button class="butt-verify" type="submit">Validate</button>
                  </form>
               </div>
               <div class="clearfix">&nbsp;</div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection