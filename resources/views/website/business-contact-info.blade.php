@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
 <div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Business Details</div>
         <div class="upr-rgtsec">
            &nbsp;
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('business-contact-info') }}"  class="active"> Business Contact Info.</a></li>
               <li><a href="{{ url('business-logo-social-network') }}"> Business Logo & Social Info.</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="col-lg-12">
            <form action="{{ url('api/update-contact-info') }}" method="post" id="update-contact-info">
               <div class="headRow nopadding" id="businessdetails">
                  <ul class="footnote">
                     <li>Here you can manage the profession, contact, and physical address for each location of your business, as well as the information that will appear on the "About Us" section on you booking portal.</li>
                  </ul>
               </div>
               <div class="headRow">
                  <div class=" clearfix">
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <div class="form-details">
                              <label for="Profession">Profession</label>
                              <input type="text" class="form-control" name="profession" id="profession" placeholder="Profession" value="<?=$profession_name;?>">
                              <label for="Business Name">Business Name</label>
                              <input class="form-control" type="text" name="business_name" placeholder="Business name" value="<?=$userDetails->business_name ? $userDetails->business_name : "";?>" />
                              <label for="Business Location">Business Location</label>
                              <div id="locationField">
                                <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" class="form-control" name="business_location" value="<?=$userDetails->business_location ? $userDetails->business_location : "";?>"></input>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Country">Street</label>
                                    <input placeholder="Street" id="street_number" class="form-control" name="street_number" value="<?=$userDetails->street_number ? $userDetails->street_number : "";?>"></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Region">Route</label>
                                    <input id="route" placeholder="Route" name="route" class="form-control" value="<?=$userDetails->route ? $userDetails->route : "";?>"></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="City">City</label>
                                    <input id="locality" placeholder="City" name="city" class="form-control" value="<?=$userDetails->city ? $userDetails->city : "";?>"></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Region">State</label>
                                    <input id="administrative_area_level_1" placeholder="State" name="state" class="form-control" value="<?=$userDetails->state ? $userDetails->state : "";?>"></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Region">Zipcode</label>
                                    <input id="postal_code" placeholder="Zip code" name="zip_code" class="form-control" value="<?=$userDetails->zip_code ? $userDetails->zip_code : "";?>"></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Region">Country</label>
                                    <input id="country" placeholder="Country" name="country" class="form-control" value="<?=$country_name;?>" readonly=""></input>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="City">Mobile Phone</label>
                                    <input class="form-control" type="text" name="mobile" placeholder="Mobile Phone" value="<?=$userDetails->mobile ? $userDetails->mobile : "";?>" readonly=""/>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="Region">Office Phone</label>
                                    <input class="form-control" type="text" name="office_phone" placeholder="Office Phone" value="<?=$userDetails->office_phone ? $userDetails->office_phone : "";?>" />
                                 </div>
                              </div>
                              <label for="Phone">Skype ID</label>
                              <input class="form-control" type="text" placeholder="Skype ID" name="skype_id" value="<?=$userDetails->skype_id ? $userDetails->skype_id : "";?>" />
                              <label for="Business Description">Business Description</label>
                              <textarea class="form-control" rows="4" name="business_description" placeholder="Business Description" onkeyup="countChar(this)"><?=$userDetails->business_description ? $userDetails->business_description : "";?></textarea>
                              <span class="specialnote" id="specialnote_count">HTML Tags not allowed, 1000 characters remaining</span>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <iframe class="img-thumbnail" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14743.31409025346!2d88.39881!3d22.510616!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd9bfd73a5d056f32!2sNCR+Technosolutions+%7C+Mobile+App+Development+Company!5e0!3m2!1sen!2sin!4v1531414309030" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="clearfix"></div>
                        <!-- <input type="submit" value="Update" name="Update" class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block" id="update"> -->
                        <button type="submit" id="business-info-update" class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block">Update</button>
                        <!-- <a class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block" id="update">Update</a> -->
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="popup">
   <div id="selectstaff">
      <div class="container-fluid">
         <div class="popupInside">
            <h3>Select Staff</h3>
            <ul>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}"/>
                  <label>Douglas N</label>
                  </a> 
               </li>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/grey-user.png')}}"/>
                  <label>Janice D</label>
                  </a> 
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuUB8s5lliHSAP_GKnXd70XwlAZa4WE&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
} 
</script>

<script>
function countChar(val) {
  var len = val.value.length;
  if (len >= 1000) {
    val.value = val.value.substring(0, 1000);
  } else {
   var count = 1000 - len;
    $('#specialnote_count').text('HTML Tags not allowed, '+count+' characters remaining');
  }
};
</script>





