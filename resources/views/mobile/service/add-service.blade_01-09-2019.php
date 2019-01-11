@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Service Add</h1>
   <ul>
      <li>&nbsp; </li>
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div >
               <div class="leftbar">
                  <h5><i class="fa fa-calendar"></i> What service is this?</h5>
               </div>
               <!--<div class="rightbar">
                  <ul>
                     <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                  </ul>
                  </div>-->
            </div>
            <div class="headRow whitebox dsinside clearfix " style="display: block;">
               <div class="form-details">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <label for="service_name">Service Name <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                           <input class="form-control nomarginbottom" type="text" name="service_name" id="service_name">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <label for="service_location">Location <i class="fa fa-question" data-toggle="tooltip" title="Use the 'Location' field to specify how and where both parties will connect at the scheduled time.
                              You can choose to show these details on the scheduling page, before a time is confirmed - OR - restrict the location to the confirmation page, after a meeting time has been selected." data-placement="right"></i></label>
                           <input class="form-control nomarginbottom" type="text" name="service_location" id="service_location">
                           <span class="specialnote">e.g. Joe's Coffee, I'll Call you, etc</span> 
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="form-group">
                        <input type="radio" checked="checked" name="service_display_location" id="booking" value="1">
                        <label class="right35px">Display location while booking</label>
                        <div class="clearfix break10px"></div>
                        <input type="radio" name="service_display_location" id="confirm" value="2">
                        <label class="right35px">Display location only after confirmation</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                           <label for="service_currency">Currency <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Select currency for your service." data-placement="right"></i> </label>
                           <select name="service_currency" id="service_currency">
                              <option value="">Select currency</option>
                              <option value="1">INR</option>
                              <option value="2">USD</option>
                              <option value="3">POUND</option>
                           </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <label for="service_price">Price <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a price for your service." data-placement="right"></i> </label>
                           <input class="form-control" type="number" min="1" name="service_price" id="service_price">
                        </div>
                     </div>
                  </div>
                  <div class="break20px"></div>
                  <label for="service_description">Description/Instructions</label>
                  <textarea class="form-control" rows="4" name="service_description" id="service_description"></textarea>
                  <div class="break20px"></div>
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date &amp; Time' step. "></i> </label>
                        <input class="form-control" type="text" name="service_link" id="service_link">
                     </div>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="service_category">List of categories</label>
                        <select name="service_category" id="service_category">
                           <option>Select categories</option>
                           <option value="1">Service</option>
                           <option value="2">Resource</option>
                           <option value="3">Meeting</option>
                           <option value="new">New Category </option>
                        </select>
                     </div>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <div class="col-lg-6 col-md-6 col-sm-6 new-category-name" style="display: none;">
                        <label for="new_category_name">Category Name</label>
                        <input class="form-control" type="text" name="new_category_name" id="new_category_name">
                     </div>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="service_color">Select Color <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                        <input type="text" name="togglePaletteOnly" id="togglePaletteOnly" style="display:none;">
                        <div class="sp-replacer sp-light">
                           <div class="sp-preview">
                              <div class="sp-preview-inner" style="background-color: rgb(255, 0, 0);"></div>
                           </div>
                           <div class="sp-dd">▼</div>
                        </div>
                        <input type="hidden" name="service_color" id="service_color" value="#ff0000">
                     </div>
                  </div>
                  <div class=" break20px">
                     <a href="http://runmobileapps.com/squeedr/mobile/services/all"><input type="button" class="btn btn-grey" value="Cancel"></a>
                     <input type="submit" class="btn btn-primary" value="Next">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection
@section('custom_js')
<script type="text/javascript">
   function ShowPopup() {
          
              $("#popup").fadeToggle();
          
          }
</script>
@endsection