@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>My Squeedr</h1>
   <ul>
    &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
      <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row showDekstop">
         <!--Edited by Sandip - Start--> 
         <!--Edited by Sandip - End--> 
      </div>
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <div class="whitebox profileMobile profileMobileHeading">
               <div class="profileImg">
                   <?php
                  if($user_details->profile_perosonal_image)
                  {
                  ?>
                  <img src="{{asset('public/image/profile_perosonal_image')}}/<?php echo $user_details->profile_perosonal_image;?>" />
                  <?php
                  }
                  else
                  {
                  ?>
                  <img src="{{asset('public/assets/mobile/images/profilePic.png')}}" /> 
                  <?php
                  }
                  ?>
               </div>
               <div class="profileDetails">
                  <h1><?=$user_details->user_type==1 ? $user_details->name :  $user_details->business_name;?></h1>
                 
                  <span><?=$user_details->prof ? $user_details->prof : "No data found";?></span><!--  <span>Time Zone - Kolkata,WB, India</span>  -->
               </div>
               <!--<a class="share"><i class="fa fa-share-alt"></i> </a> -->
               <div class="share-cusbtn" >
                  <a onclick="myFunction()" class="cusbtn-style"><i class="fa fa-share" aria-hidden="true"></i></a> 
               </div>
               <!-- <div id="openbox">
                  <ul>
                     <li><a href="" data-url="{{ url('mobile/my-squeedr') }}/<?=$user_details->username;?>" id="copy-link"><i class="fa fa-user-plus" aria-hidden="true"></i> Copy</a></li>
                     <input type="text" id="offscreen" class="offscreen" value="">
                  </ul>
               </div> -->
            </div>
            <div class="whitebox expertise clearfix">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/expertise.png')}}" />
                  <h4>Expertise</h4>
                 

               </div>
               <ul>
               <?php
               if(!empty($user_details->expertise))
               {
                  $expertise = explode(',', $user_details->expertise);
                  foreach ($expertise as $key => $value)
                  {
               ?> 
                  <li><?=$value;?></li>
               <?php
                  }
               }
               else
               {
                  echo "No expertise found.";
               }
               ?>
               </ul>
               <!-- <a class="pull-right more">More</a> --> 
            </div>
            <div class="whitebox pt">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/presentation.png')}}" />
                  <h4>Presentation</h4>
                  

               </div>
               <p><?=$user_details->presentation ? $user_details->presentation : "No data found";?></p>
            </div>
            <div class="profile-mobaccordion">
               <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                              <div class="profileheading">
                                 <img src="{{asset('public/assets/mobile/images/profile-icon-service.png')}}" />
                                 <h4>Services</h4>
                                 <i class="fa fa-angle-down"></i>
                              </div>
                           </a>
                        </h4>
                     </div>
                     <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="headRow  mobileappointed clearfix" id="row2">
                              <?php
                              if(empty($service_list))
                              {
                                 echo "<h2>No service found!</h2>";
                              }
                              foreach ($service_list as $key => $details) 
                              {
                              ?>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p><?=$details->service_name;?></p>
                                    <span><?=$details->duration;?> min
                                    <label><?=$details->currency;?><?=$details->duration ? $details->cost : '';?></label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li >
                                       <?=$details->cat;?>
                                    </li>
                                 </ul>
                              </div>
                              <?php
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="whitebox map">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/map.png')}}" />
                  <h4>Map and access Information</h4>
                  
               </div>
               <div class="mapcontent">
                  <div class="mapleft">
                     <h5>Smile Corrections</h5>
                     <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}" class="map">
                     <label><?=$user_details->business_location ? $user_details->business_location : "No data found";?> </label>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <h6>Business Information</h6>
                     <span><?=$user_details->business_description ? strip_tags($user_details->business_description) : "No data found";?></span>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <h6>Transport</h6>
                     <span><?=$user_details->transport ? $user_details->transport : "No data found";?></span>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <h6>Parking</h6>
                     <span><?=$user_details->parking ? $user_details->parking : "No data found";?></span> 
                  </div>
                  <div class="mapright"> <img src="{{asset('public/assets/mobile/images/profile/map-pic.png')}}" class="gmap"/> <a><img src="{{asset('public/assets/mobile/images/profile/zoom-in.png')}}"/> </a> </div>
               </div>
            </div>
            <div class="whitebox ">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/contact.png')}}" />
                  <h4>Contact</h4>
                  <!-- <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a> -->
               </div>
               <div class="profileDetails">
                  <ul>
                     <li><img src="{{asset('public/assets/mobile/images/customer-details/mail.png')}}" /><?=$user_details->email ? $user_details->email : "No data found";?> </li>
                     <li><img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}" /><?=$user_details->mobile ? $user_details->mobile : "No data found";?> </li>
                    <!--  <li><img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}" />Lauren Drive, Madison, WI 53705 </li> -->
                  </ul>
               </div>
            </div>
            <div class="whitebox profileMobile">
               <div class="payment">
                  <div class="profileheading">
                     <img src="{{asset('public/assets/mobile/images/profile/payment-method.png')}}" />
                     <h4>Payment Method</h4>
                     
                  </div>
                  <span><?=$user_details->payment_mode ? $user_details->payment_mode : "No data found";?></span> 
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

@endsection


@section('custom_js')


@endsection