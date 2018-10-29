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
                    <a class="btn-select">Select a service <i class=" fa fa-caret-down"></i></a> </div>
                  
                  <!-- <a class="btn btn-custom">Book Now</a>--> 
                  
                </div>
              </div>
              <?php

                        if($user_details->user_type==1)

                        {

                           if($user_details->profile_perosonal_image)

                           {

                           ?>
              <img src="{{asset('public/')}}/image/profile_perosonal_image/<?=$user_details->profile_perosonal_image;?>" class="profilepic"/>
              <?php 

                           }

                           else

                           {

                           ?>
              <img src="{{asset('public/assets/website/images/profile-pic.jpg')}}" class="profilepic" />
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
              <img src="{{asset('public/assets/website/images/profile-pic.jpg')}}" class="profilepic" />
              <?php

                           }

                        }

                        ?>
              <ul class="profilelinks">
                <li><a href="#">Services</a> </li>
                <li><a href="#"> Expertise </a> </li>
                <li><a href="#">Presentation </a> </li>
                <li><a href="#">Contacts</a> </li>
              </ul>
            </div>
            <div class="staffs">
              <div class="staffsinside">
                <div class="headbar"> <img src="{{asset('public/assets/website/images/popup-staffs.png')}}"/>
                  <h4>Staffs</h4>
                </div>
                <div class="owl-carousel owl-theme owl-custom">
                  <?php

                              foreach ($staff_list as $key => $value)

                              {

                              ?>
                  <div class="item">
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
                    <span>
                    <?=$value->full_name;?>
                    </span> </div>
                  <?php

                              }

                              ?>
                </div>
              </div>
            </div>
            <div class="staffs">
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
            <div class="staffs">
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
            <div class="staffs">
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
                          </span> </div>
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
            <div class="staffs">
              <div class="staffsinside">
                <div class="prof"> <img src="{{asset('public/assets/website/images/profile-icon-location.png')}}">
                  <div class="prof-cont">
                    <div class=" col-md-4"> 
                      
                      <!-- <h3>Map and access information</h3>-->
                      
                      <h5 style="margin-top:0;">Useful information</h5>
                      <p>Ground floor, Handicap access </p>
                      <h5>Smile Corrections</h5>
                      <p><img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" />
                        <?=$user_details->business_location ? $user_details->business_location : "No data found";?>
                      </p>
                      <h5>Transport</h5>
                      <p>
                        <?=$user_details->transport ? $user_details->transport : "No data found";?>
                      </p>
                      <h5>Parking</h5>
                      <p>
                        <?=$user_details->parking ? $user_details->parking : "No data found";?>
                      </p>
                    </div>
                    <div class=" col-md-4">
                      <h5 style="margin-top:0;">Contacts</h5>
                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-email.png')}}" />
                        <?=$user_details->email ? $user_details->email : "No data found";?>
                      </div>
                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-phone1.png')}}" />
                        <?=$user_details->mobile ? $user_details->mobile : "No data found";?>
                      </div>
                      <div class="inf"> <img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" /> Lauren Drive, Madison, WI 53705 </div>
                      <div class=" flex break30px">
                        <div class="prof-cont">
                          <h5>Payment mode</h5>
                          <p>
                            <?=$user_details->payment_mode ? $user_details->payment_mode : "No data found";?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class=" col-md-4 socials">
                     <div class="map-yurpage">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2531.268456989167!2d-89.4622255849775!3d43.071637097859536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8807ac17ef4bd095%3A0xc0813a752fde03f7!2sMadison%2C+WI+53705%2C+USA!5e1!3m2!1sen!2sin!4v1539428284980" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                     </div>
                    </div>
                    
                    
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
                    <div class="yurpage-ftr">
                     <ul>
                     <li><a href="#">Paris</a></li>
                     <li><a href="#">London</a></li>
                     <li><a href="#">Spain</a></li>
                     <li><a href="#">Italy</a></li>
                     </ul>
                    </div>
                      <div class="yurpage-social"> 
                      <ul>
                      <li><a target="_blank" href="<?=$user_details->facebook_link ? $user_details->facebook_link : "";?>" class="fa fa-facebook"></a></li> 
                      <li><a target="_blank" href="<?=$user_details->twitter_link ? $user_details->twitter_link : '';?>" class="fa fa-twitter"></a></li>
                      <li><a target="_blank" href="<?=$user_details->linked_in_link ? $user_details->linked_in_link : '';?>" class="fa fa-instagram"></a></li>
                      <li><a target="_blank" href="" class="fa fa-skype"></a></li>
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

            loop: true,

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

                  loop: true,

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

            loop: true,

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

                  loop: true,

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

   </script> 
   <script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
</body>
</html>