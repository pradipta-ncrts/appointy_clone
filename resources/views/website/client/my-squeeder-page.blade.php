<!DOCTYPE html>



<html>

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="">

<meta name="author" content="">

<title>My Squeedr</title>

<link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap.min.css')}}" />



<!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet"> -->



<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/my-icons-collection/font/flaticon.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />

<link rel="stylesheet" href="{{asset('public/assets/website/css/animate.css')}}" />

<link href="{{asset('public/assets/website/css/fonts.css')}}" rel="stylesheet" />

<link rel="stylesheet" href="{{asset('public/assets/website/css/nice-select.css')}}" />

<link rel="stylesheet" href="{{asset('public/assets/website/css/app.css')}}" />

<link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">

<link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">

<link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">

<link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">

<link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

<link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('public/assets/website/css/owl.carousel.min.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/website/css/autocompletestyles.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-select.min.css')}}" />

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<link rel="stylesheet" href="{{asset('public/assets/website/css/bootstrap-timepicker.min.css')}}" />

</head>



<body>

<div class="profilepopup1">

  <div class="container-custom">

    <div class="profile">

      <div class="row">

        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">

          <div class="profileInside">

            <div class="banner-top">

              <div class="img-banner-parent">

              <div class="opacitybx">

                <ul class="breadcrumb">

                    <li><a href="{{ url('client/login') }}">Client Login</a></li>

                    <li><a href="{{ url('client/registration') }}">Client Registration</a></li>

                </ul>

                </div>

                <div class="img-banner">

                  <?php

                   if($user_details->timeline_image)

                   {

                   ?>

                  <img src="{{asset('public/')}}/image/timeline_image/<?=$user_details->timeline_image;?>" class="img-responsive"/>

                  <?php

                   }

                   else

                   {

                   ?>

                  <img src="{{asset('public/assets/website/images/img-banner.jpg')}}" class="img-responsive"/>

                  <?php

                    }

                  ?>

                  <div class="blackbox">

                    <div class="lefttext">

                      <h6>

                        <?=$user_details->user_type==1 ? $user_details->name :  $user_details->business_name;?>

                        <br/>

                        <span>

                        <?=$user_details->prof ? $user_details->prof : "No data found";?>

                        </span> </h6>

                    </div>

                    <!--<a class="btn-select">Select a service <i class=" fa fa-caret-down"></i></a>--> </div>

                    



                  

                  <!-- <a class="btn btn-custom">Book Now</a>--> 

                  

                </div>

              </div>

              <div class="dropdown pull-right mysl-drp">

  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select a service

      <span class="caret"></span></button>

      <ul class="dropdown-menu">

        <?php

        if(empty($service_list))

        {

           echo "<h2>No service found!</h2>";

        }

        foreach ($service_list as $key => $details) 

        {

        ?>

        <li><a href="{{url('/client/service-details/'.$details->service_id)}}"><?=$details->service_name;?></a></li>

        <?php

        }

        ?>

      </ul>

    </div>

              

              <?php

              if($user_details->user_type==1)

              {

                 $url = asset('public/').'/image/profile_perosonal_image/'.$user_details->profile_perosonal_image;

                 if($user_details->profile_perosonal_image && file_exists($url))

                 {

                 ?>

              <img src="{{asset('public/')}}/image/profile_perosonal_image/<?=$user_details->profile_perosonal_image;?>" class="profilepic"/>

              <?php 

               }

               else

               {

               ?>

              <img src="{{asset('public/assets/website/images/noimage1.png')}}" class="profilepic" />

              <?php

              }

              ?>

              <?php

              }

              else

              {

                  if($user_details->profile_image)

                  {

              ?>

              <img src="{{asset('public/')}}/image/profile_perosonal_image/<?=$user_details->profile_image;?>" class="profilepic"/>

              <?php 

                  }

                  else

                  {

               ?>

              <img src="{{asset('public/assets/website/images/noimage1.png')}}" class="profilepic" />

              <?php

                  }

              }

              ?>

              <ul class="profilelinks">

                <li><a id="service_link" href="javascript:void(0);">Services</a> </li>

                <li><a id="expertise_link" href="javascript:void(0);">Expertise </a> </li>

                <li><a id="presentation_link" href="javascript:void(0);">Presentation </a> </li>

                <li><a id="contact_link" href="javascript:void(0);">Contacts</a> </li>

              </ul>

            </div>

            <div class="staffs" id="staff_section">

              <div class="staffsinside">

                <div class="headbar"> <img src="{{asset('public/assets/website/images/popup-staffs.png')}}"/>

                  <h4>Staffs</h4>

                </div>

                <div class="owl-carousel owl-theme owl-custom">



                            <?php

              foreach ($staff_list as $key => $value)

              {

              ?>  

                  <a href="{{url('/client/view-staffs/'.$value->username)}}"><div class="item">

                    <?php

                     if($value->staff_profile_picture != '')

                     { 

                     ?>

                    <img class="user-pic" src="<?php echo $value->staff_profile_picture;?>" width="35px" height="35px" />

                    <?php

                    } 

                    else

                    {

                    ?>

                    <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" />

                    <?php

                     } 

                    ?>

                    <span><?=$value->full_name;?></span> 

                  </div></a>

                  <?php

                    }

                    ?>

                    

                    

                </div>

              </div>

            </div>

            <div class="staffs" id="presentation_section">

              <div class="staffsinside">

                <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-presentation.png')}}">

                  <div class="prof-cont">

                    <h3>Presentation</h3>

                    <p>

                      <?=$user_details->presentation ? $user_details->presentation : "No data found";?>

                      <!-- <a href="#">more</a> --> </p>

                  </div>

                </div>

              </div>

            </div>

            <div class="staffs" id="expertise_section">

              <div class="staffsinside">

                <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-expertise.png')}}">

                  <div class="prof-cont">

                    <h3>Expertise</h3>

                    <p>

                      <?php

                      if(!empty($user_details->expertise))

                      {

                         $expertise = explode(',', $user_details->expertise);

                         foreach ($expertise as $key => $value)

                         {

                         ?>

                      <span class="expt">

                      <?=$value;?>

                      </span>

                      <?php

                         }

                      }

                      else

                      {

                         echo "No expertise found.";

                      }

                      ?>

                    </p>

                  </div>

                </div>

              </div>

            </div>

            <div class="staffs" id="service_section">

              <div class="staffsinside">

                <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-service.png')}}">

                  <div class="prof-cont">

                    <h3>Services <small>(Select any service to book)</small> </h3>

                    <div class="headRow mobileappointed clearfix" id="row2">

                      <?php

                        if(empty($service_list))

                        {

                           echo "<h2>No service found!</h2>";

                        }

                        foreach ($service_list as $key => $details) 

                        {

                        ?>

                      <div class="appointment mobSevices col-sm-4">

                        <a href="{{url('/client/service-details/'.$details->service_id)}}">

                        <div class="pull-left">

                          <p>

                            <?=$details->service_name;?>

                          </p>

                          <span>

                          <?=$details->duration;?>

                          min

                          <label>

                            <?=$details->currency;?>

                            <?=$details->duration ? $details->cost : '';?>

                          </label>

                          </span> 

                        </div></a>

                        <div class="pull-right">

                          <?=$details->cat;?>

                        </div>

                      </div>

                      <?php

                        }

                        ?>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="staffs" id="contact_section">

              <div class="staffsinside">

                <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">

                  <div class="prof-cont">

                    <div class=" col-md-4"> 

                      <!-- <h3>Map and access information</h3>-->

                      <h5 style="margin-top:0;">Business Information</h5>

                      <p> <?=$user_details->business_description ? strip_tags($user_details->business_description) : "N/A";?> </p>

                      <h5>Smile Corrections</h5>

                      <p><img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" />

                        <?=$user_details->business_location ? $user_details->business_location : "N/A";?>

                      </p>

                      <h5>Transport</h5>

                      <p>

                        <?=$user_details->transport ? $user_details->transport : "N/A";?>

                      </p>

                      <h5>Parking</h5>

                      <p>

                        <?=$user_details->parking ? $user_details->parking : "N/A";?>

                      </p>

                    </div>

                    <div class=" col-md-4">

                      <h5 style="margin-top:0;">Contacts</h5>

                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-email.png')}}" />

                        <?=$user_details->email ? $user_details->email : "N/A";?>

                      </div>

                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-phone1.png')}}" />

                        <?=$user_details->mobile ? $user_details->mobile : "N/A";?>

                      </div>

                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" /> <?=$user_details->business_location ? $user_details->business_location : "N/A";?> </div>

                      <div class=" flex break30px">

                        <div class="prof-cont">

                          <h5>Payment mode</h5>

                          <p>

                            <?=$user_details->payment_mode ? $user_details->payment_mode : "N/A";?>

                          </p>

                        </div>

                      </div>

                    </div>

                    <div class=" col-md-4 socials">

                     <div class="map-yurpage">

                     <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2531.268456989167!2d-89.4622255849775!3d43.071637097859536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8807ac17ef4bd095%3A0xc0813a752fde03f7!2sMadison%2C+WI+53705%2C+USA!5e1!3m2!1sen!2sin!4v1539428284980" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe> -->

                     <div id="map"></div>

                     </div>

                    </div>

                    

                    

                    

                  </div>

                </div>

              </div>

            </div>



            <div class="col-md-12">

                    <div class="yurpage-ftr">

                     <ul>

                      <?php

                      foreach ($staff_list as $key => $value)

                      {

                        if($value->city)

                        {

                      ?>

                       <li><a href="#"><?=$value->city;?></a></li>

                      <?php

                        }

                      }

                      ?>

                     </ul>

                    </div>

                      <div class="yurpage-social"> 

                      <ul>

                      <li><a target="_blank" href="<?=$user_details->facebook_link ? $user_details->facebook_link : "";?>" class="fa fa-facebook"></a></li> 

                      <li><a target="_blank" href="<?=$user_details->twitter_link ? $user_details->twitter_link : '';?>" class="fa fa-twitter"></a></li>

                      <li><a target="_blank" href="<?=$user_details->linked_in_link ? $user_details->linked_in_link : '';?>" class="fa fa-instagram"></a></li>

                      <!--<li><a target="_blank" href="" class="fa fa-skype"></a></li>-->

                      </ul>

                      </div>

                    </div>



                    

          </div>

        </div>

      </div>

    </div>

  </div>

</div>



<!--====================================Modal area End ========================================--> 



<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --> 



<script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script> 

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script> 

<script src="{{asset('public/assets/website/js/script.js')}}"></script> 

<script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script> 

<script src="{{asset('public/assets/website/js/jquery.dataTables.min.js')}}"></script> 

<script src="{{asset('public/assets/website/js/dataTables.bootstrap.min.js')}}"></script> 

<script src="{{asset('public/assets/website/js/owl.carousel.js')}}"></script> 

<script src="{{asset('public/assets/website/js/jquery.autocomplete.min.js')}}"></script> 



<!-- Sweetalert --> 



<script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script> 



<!-- jQuery Cookie --> 



<script src="{{asset('public/assets/website/js/jquery.cookie.min.js')}}"></script> 



<!-- Form Validation --> 



<script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script> 

<script src="{{asset('public/assets/website/js/bootstrap-select.min.js')}}"></script> 

<script src="{{asset('public/assets/website/js/jquery-ui.js')}}"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script> 

<script src="{{asset('public/assets/website/js/bootstrap-timepicker.min.js')}}"></script> 

<script type="text/javascript">



      function slideDiv(obj) {



         $(obj).closest(".ds").next(".dsinside").slideToggle();



         $(obj).find("i").toggleClass("fa-angle-down fa-angle-up");



         $(".dsinside").not($(obj).closest(".ds").next(".dsinside")).slideUp();



         $("i.fa-custom").not($(obj).find("i")).removeClass("fa-angle-up").addClass("fa-angle-down");



         $(".schedule").fadeOut();



      }



   </script> 

<script>



      $(document).ready(function() {



         $("#adv-sh").click(function() {



            $("#adv-op").toggle();



         });



      });



   </script> 

<script type="text/javascript">



      function ShowPopup() {



         $("#popup").fadeToggle();



      }







      function togglebtn(obj) {



         $(obj).toggleClass("active");



         $(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");



         $(".mobSevices ul li a.active").find("i").not($(obj).find("i")).removeClass("fa-toggle-on").addClass("fa-toggle-off");



         $(".mobSevices ul li a.active").not($(obj)).removeClass("active");



      }







      function showUl(obj) {



         $(obj).find("ul").fadeToggle();



         $(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();



      }



      $(document).ready(function() {})



   </script> <!-- slide menu script --> 



   <script src="{{asset('public/assets/website/js/menu.js')}}"></script> 

   <script>



      /** * Slide left instantiation and action. */



      var slideLeft = new Menu({



         wrapper: '#o-wrapper',



         type: 'slide-left',



         menuOpenerClass: '.c-button',



         maskId: '#c-mask'



      });



      var slideLeftBtn = document.querySelector('#c-button--slide-left');



      slideLeftBtn.addEventListener('click', function(e) {



         e.preventDefault;



         slideLeft.open();



      }); /** * Slide right instantiation and action. */



      var slideRight = new Menu({



         wrapper: '#o-wrapper',



         type: 'slide-right',



         menuOpenerClass: '.c-button',



         maskId: '#c-mask'



      });



      var slideRightBtn = document.querySelector('#c-button--slide-right');



      slideRightBtn.addEventListener('click', function(e) {



         e.preventDefault;



         slideRight.open();



      }); /** * Slide Alert instantiation and action. */



      var slideAlert = new Menu({



         wrapper: '#o-wrapper',



         type: 'slide-alert',



         menuOpenerClass: '.c-button',



         maskId: '#c-mask'



      });



      var slideAlertBtn = document.querySelector('#c-button--slide-alert');



      slideAlertBtn.addEventListener('click', function(e) {



         e.preventDefault;



         slideAlert.open();



      });



   </script> 

   <script type="text/javascript">



      $(document).ready(function() {



         $("ul.menu li a").click(function() {



            $(this).addClass("active");



            $(("li a.active")).not($(this)).removeClass("active");



         });



         $(".closePopUp").click(function() {



            $(".profilepopup").fadeOut();



            $('body').css('overflow-y', 'auto');



         });



         $('.owl-carousel').owlCarousel({



            //loop: true,



            margin: 10,



            responsiveClass: true,



            responsive: {



               0: {



                  items: 8,



                  nav: true,



                  margin: 20



               },



               600: {



                  items: 8,



                  nav: true,



                  margin: 22



               },



               1000: {



                  items: 10,



                  nav: false,



                  //loop: true,



                  margin: 25



               }



            }



         });



      });







      function ShowPopup() {



         $("#popup").fadeToggle();



      }







      function showSqeeder() {



         $(".profilepopup").fadeIn();



         $('body').css('overflow-y', 'hidden');



      }



   </script> 

   <script type="text/javascript">



      $(document).ready(function() {



         $("ul.menu li a").click(function() {



            $(this).addClass("active");



            $(("li a.active")).not($(this)).removeClass("active");



         });



         $(".closePopUp").click(function() {



            $(".profilepopup").fadeOut();



            $('body').css('overflow-y', 'auto');



         });



         $('.owl-carousel').owlCarousel({



           // loop: true,



            margin: 10,



            responsiveClass: true,



            responsive: {



               0: {



                  items: 2,



                  nav: true



               },



               600: {



                  items: 5,



                  nav: true



               },



               1000: {



                 items: 10,



                  nav: false,



                  //loop: true,



                  margin: 30



               }



            }



         });



      });







      function ShowPopup() {



         $("#popup").fadeToggle();



      }







      function showSqeeder() {



         $(".profilepopup").fadeIn();



         $('body').css('overflow-y', 'hidden');



      }



   </script> 

   <script src="{{asset('public/assets/website/js/jquery.nice-select.min.js')}}"></script> 



   <!-- Image Preview --> 



   <script>



      function readURL(input) {



         if (input.files && input.files[0]) {



            var reader = new FileReader();



            reader.onload = function(e) {



               $('#blah').show();



               $('#blah').attr('src', e.target.result);



            }



            reader.readAsDataURL(input.files[0]);



         } else {



            $('#blah').hide();



         }



      }



      $("#staff_profile_picture").change(function() {



         readURL(this);



      });



   </script> <!-- NCRTS JS --> 



   <script src="{{asset('public/assets/website/js/ncrtsdev.js')}}"></script> 

   <script>

      $('.carousel').carousel({

         interval: false

      });



      $("#service_link").click(function() {

          $('html,body').animate({

              scrollTop: $("#service_section").offset().top},

              'slow');

      });



      $("#presentation_link").click(function() {

          $('html,body').animate({

              scrollTop: $("#presentation_section").offset().top},

              'slow');

      });



      $("#expertise_link").click(function() {

          $('html,body').animate({

              scrollTop: $("#expertise_section").offset().top},

              'slow');

      });



      $("#contact_link").click(function() {

          $('html,body').animate({

              scrollTop: $("#contact_section").offset().top},

              'slow');

      });

   </script> 

   <script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>

   <!--Google Address Loaction Trac-->
      
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGNBMdy-f3Pj7GsshK8pYEfxn4H68c1EM&libraries=places&callback=initialize" async defer></script>

      <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGNBMdy-f3Pj7GsshK8pYEfxn4H68c1EM&libraries=places&callback=initializemap"
        async defer></script> -->
      <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 250px;
        }
      </style>

      <script type="text/javascript">
        function initialize() {
            initMap();
            initAutocomplete();
          }
          var map, marker;
        function initMap() {
              var myLatLng = {lat: <?=$user_details->latitute ? $user_details->latitute : "-34.397";?>,
                  lng: <?=$user_details->logngitude ? $user_details->logngitude : "-34.397";?>};

              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
              });

              <?php
              if($user_details->business_location)
              {
              ?>
              var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '<?=$user_details->business_location;?>'
              });
              <?php
              }
              ?>
            }
            // This example displays an address form, using the autocomplete feature
            // of the Google Places API to help users fill in the information.

          // This example requires the Places library. Include the libraries=places
          // parameter when you first load the API. For example:
          // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

          var placeSearch, autocomplete, autocomplete1, autocomplete2, autocomplete3;
          var componentForm = {
            street_number: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'long_name',
            country: 'long_name',
            postal_code: 'long_name'
          };

           function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('business_location'), {types: ['geocode']});
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            //autocomplete.setFields('address_components');
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);


            // geographical location types.
            autocomplete1 = new google.maps.places.Autocomplete(
                document.getElementById('client_address'), {types: ['geocode']});
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            //autocomplete1.setFields('address_components');
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete1.addListener('place_changed', fillInAddress);

            // geographical location types.
            autocomplete2 = new google.maps.places.Autocomplete(
                document.getElementById('edit_client_address'), {types: ['geocode']});
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            //autocomplete2.setFields('address_components');
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete2.addListener('place_changed', fillInAddress);


            // geographical location types.
            autocomplete3 = new google.maps.places.Autocomplete(
                document.getElementById('service_location'), {types: ['geocode']});
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            //autocomplete3.setFields('address_components');
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete3.addListener('place_changed', fillInAddress);
          }

          function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
            var latitute = place.geometry.location.lat();
            $("#latitute").val(latitute);
            var logngitude = place.geometry.location.lng();
            $("#logngitude").val(logngitude);
            var address = '';
            if (place.address_components) {
              address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
            }
            else
            {
              address = place.address_components;
            }

            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17); // Why 17? Because it looks good.
            }
            if (!marker) {
              marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
              });
            } else marker.setMap(null);
            marker.setOptions({
              position: place.geometry.location,
              map: map
            });
            
            google.maps.event.addListener(marker, 'click', function() {
              var infowindow = new google.maps.InfoWindow();
              infowindow.setContent(address);
              infowindow.open(map, marker);
            }); 


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
                  radius: position.coords.accuracy,
                });
                autocomplete.setBounds(circle.getBounds());
              });
            }
          }
      </script>

</body>

</html>