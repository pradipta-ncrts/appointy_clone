@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Profile</h1>
   <ul>
    <li><img src="{{asset('public/assets/mobile/images/chng-pass.png')}}" data-toggle="modal" data-target="#change-password" /></li>
    <li><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}"/></li>
    <li><a href="{{ url('mobile/calendar')}}"><img src="{{asset('public/assets/mobile/images/mobile-calender.png')}}"/></li>
   </ul>
</header>
<style type="text/css">
.offscreen {
position: absolute;
left: -999em;
}
.filter-option{margin-top:14px 0 0 0;}
</style>

<main>
   <div class="container-fluid">
      <div class="row showDekstop">
         <!--Edited by Sandip - Start--> 
         <!--Edited by Sandip - End--> 
      </div>
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <div class="whitebox profileMobile profileMobileHeading">
               <div class="profileImg"><a href="#"  data-toggle="modal" data-target="#expertise1" style=" position: absolute; bottom: 0; left: 60px;">  <i class="fa fa-pencil"></i></a> 
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
               <div class="profileDetails" style="width:100%;">
                  <h1><?=$user_details->user_type==1 ? $user_details->name :  $user_details->business_name;?></h1>
                  <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a>
                  <span><?=$user_details->prof ? $user_details->prof : "No data found";?></span><!--  <span>Time Zone - Kolkata,WB, India</span>  -->
               </div>
               <!--<a class="share"><i class="fa fa-share-alt"></i> </a> -->
               <div class="share-cusbtn" >
                  <a onclick="myFunction()" class="cusbtn-style"><i class="fa fa-share" aria-hidden="true"></i></a> 
               </div>
               <div id="openbox">
                  <ul>
                     <li><a href="" data-url="{{ url('mobile/my-squeedr') }}/<?=$user_details->username;?>" id="copy-link"><i class="fa fa-user-plus" aria-hidden="true"></i> Copy</a></li>
                     <input type="text" id="offscreen" class="offscreen" value="">

                     <!-- <li><a href="" data-url="http://localhost/squder/business-provider/test" id="embed-link"><i class="fa fa-share-alt" aria-hidden="true"></i> Share </a></li> -->
                  </ul>
               </div>
            </div>
            <div class="whitebox expertise clearfix border-add">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/expertise.png')}}" />
                  <h4>Expertise</h4>
                  <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a>
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
            <div class="whitebox pt border-add">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/presentation.png')}}" />
                  <h4>Presentation</h4>
                  <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a>
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
            
            <div class="whitebox map border-add">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/map.png')}}" />
                  <h4>Map and access Information</h4>
                  <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a>
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
            <div class="whitebox border-add">
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
            <div class="whitebox profileMobile border-add">
               <div class="payment">
                  <div class="profileheading">
                     <img src="{{asset('public/assets/mobile/images/profile/payment-method.png')}}" />
                     <h4>Payment Method</h4>
                     <a href="#"  data-toggle="modal" data-target="#expertise"> <i class="fa fa-pencil"></i></a>
                  </div>
                  <span><?=$user_details->payment_mode ? $user_details->payment_mode : "No data found";?></span> 
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<!--================================Modal area start================================-->
<div class="modal fade in" id="expertise" role="dialog" >
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm" style="float: none;">
         <form name="update_profile_mobile" id="update-profile-mobile" method="post" action="{{ url('api/update-profile-mobile') }}" enctype="multipart/form-data" novalidate="novalidate">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">Update Profile</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <!-- <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                          <div class="add-picture">
                           <?php
                           if($user_details->profile_perosonal_image)
                           {
                           ?>
                           <img id="blah" src="{{asset('public/image/profile_perosonal_image')}}/<?php echo $user_details->profile_perosonal_image;?>" width="60px" height="60px" />
                           <?php
                           }
                           else
                           {
                           ?>
                           <img id="blah" src="{{asset('public/assets/mobile/images/profilePic.png')}}" width="60px" height="60px" /> 
                           <?php
                           }
                           ?>
                          </div>
                          <input type="file" name="profile_perosonal_image" id="profile_perosonal_image" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
                        </div>
                     </div>
                  </div>
               </div> -->
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="profile_name" type="text" class="form-control" name="profile_name" placeholder="Full Name" value="<?=isset($user_details->name) && $user_details->name ? $user_details->name : '';?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <select name="profile_profession" id="profile_profession" >
                        <option value="">Select Profession </option>
                        <?php
                        if(!empty($profession))
                        {
                            foreach ($profession as $key => $value)
                            {
                            ?>
                                <option value="<?=$value->profession_id;?>" <?=isset($user_details->profession) && $user_details->profession==$value->profession_id ? "selected" : '';?>><?=$value->profession;?></option>
                            <?php
                            }
                        }
                        ?>
                      </select>
                    </div>
                 </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"><span class="input-group-addon"></span>
                           <input id="business_location" placeholder="Enter your address" type="text" class="form-control" name="business_location" value="<?=$user_details->business_location ? $user_details->business_location : "";?>" onFocus="geolocate()"
></input>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="expertise" type="text" class="form-control" name="expertise" placeholder="Expertise" value="<?=isset($user_details->expertise) && $user_details->expertise ? $user_details->expertise : '';?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="presentation" type="text" class="form-control" name="presentation" placeholder="Presentation" value="<?=isset($user_details->presentation) && $user_details->presentation ? $user_details->presentation : '';?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <textarea class="form-control" rows="4" name="business_description" placeholder="Business Description"><?=$user_details->business_description ? $user_details->business_description : "";?></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input class="form-control" type="text" placeholder="Transport" name="transport" value="<?=$user_details->transport ? $user_details->transport : "";?>" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                          <input class="form-control" type="text" placeholder="Parking" name="parking" value="<?=$user_details->parking ? $user_details->parking : "";?>" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                         <input id="payment_mode" type="text" class="form-control" name="payment_mode" placeholder="Cheques, Cash and Credit Cards" value="<?=isset($user_details->payment_mode) && $user_details->payment_mode ? $user_details->payment_mode : '';?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade in" id="expertise1" role="dialog" >
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm" style="float: none;">
         <form action="{{ url('api/profile-personal-image') }}" method="post" id="profile-personal-image">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">Update Profile Picture</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="input-group"> <span class="input-group-addon"></span>
                          <div class="add-picture">
                           <?php
                           if($user_details->profile_perosonal_image)
                           {
                           ?>
                           <img id="blah" src="{{asset('public/image/profile_perosonal_image')}}/<?php echo $user_details->profile_perosonal_image;?>" width="60px" height="60px" />
                           <?php
                           }
                           else
                           {
                           ?>
                           <img id="blah" src="{{asset('public/assets/mobile/images/profilePic.png')}}" width="60px" height="60px" /> 
                           <?php
                           }
                           ?>
                          </div>
                          <input type="file" name="profile_perosonal_image" id="profile_perosonal-image" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
                          <input type="hidden" name="old_profile_perosonal_image" value="<?=$user_details->profile_perosonal_image;?>">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" id="profile-personal-image-update-button">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!--================================Modal area end==================================-->


<div class="modal fade in" id="change-password" role="dialog" >
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm" style="float: none;">
         <form name="change_passord" method="post" action="{{ url('api/changepssword') }}" id="change_passord">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body clr-modalbdy">
            <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                         <label>Old Password</label> 
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="old_passsword" type="text" class="form-control" name="old_passsword" placeholder="Old Password">
                        </div>
                     </div>
                  </div>
               </div>

            <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                         <label>New Password</label> 
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="new_password" type="text" class="form-control" name="new_password" placeholder="New Password">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                         <label>Confirm Password</label> 
                        <div class="input-group"> <span class="input-group-addon"></span>
                           <input id="new_confirm_password" type="text" class="form-control" name="new_confirm_password" placeholder="Confirm Password" value="">
                        </div>
                     </div>
                  </div>
               </div>
                <div class="modal-footer">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary butt-next">Save</button>
                  <a href="{{ url('mobile/my-profile') }}" class="btn btn-default butt-next">Cancel</a>
               </div>
            </div>


            </div>
        </form>
     </div>
    </div>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#profile_perosonal-image").change(function() {
  readURL(this);
});

 $('#update-profile-mobile').validate({

       //ignore: ":hidden:not(.selectpicker)",
       rules: {
           profile_name: {
               required: true
           },
           profile_profession: {
               required: true
           },
           business_location: {
               required: true
           },
           expertise: {
               required: true
           },
           presentation: {
               required: true
           },
           business_description: {
               required: true
           },
           transport: {
               required: true
           },
           parking: {
               required: true
           },
           payment_mode: {
               required: true
           },
       },
       
       messages: {
           profile_name: {
               required: "Please enter country"
           },
           profile_profession: {
               required: "Please enter profession"
           },
           business_location: {
               required: "Please enter business location"
           },
           expertise: {
               required: "Please enter expertise"
           },
           presentation: {
               required: "Please enter presentation"
           },
           business_description: {
               required: "Please enter bisiness description"
           },
           transport: {
               required: "Please enter country"
           },
           parking: {
               required: "Please enter transport"
           },
           payment_mode: {
               required: "Please enter payment mode"
           },
       },

       submitHandler: function(form) {
         var data = $(form).serializeArray();
         data = addCommonParams(data);
         /*var profile_perosonal_image = document.getElementById('profile_perosonal-image');
         var form_data = new FormData();

         if(profile_perosonal_image.files.length>0){
           for(var i=0;i<profile_perosonal_image.files.length;i++){
               form_data.append('profile_perosonal_image',profile_perosonal_image.files[0]);
           }
         }

         $.each(data, function( ia, l ){
           form_data.append(l.name, l.value);
         });*/

         $.ajax({
             url: form.action,
             type: form.method,
             data:data ,
             dataType: "json",
             success: function(response) {
               console.log(response);
               if(response.response_status=='1')
               {
                  swal("Success!", response.response_message, "success");
                  location.reload();
               }
               else
               {
                   swal("Error", response.response_message , "error");
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


$("#profile-personal-image").on('submit', (function(e) {
    e.preventDefault();
    //data = addCommonParams(data);
    var data = $('#profile-personal-image').serializeArray();
    data = addCommonParams(data);
    //var files = $("#profile-image input[type='file']")[0].files;
    var profile_perosonal_image = document.getElementById('profile_perosonal-image');

    var form_data = new FormData();

    if(profile_perosonal_image.files.length>0){
        for(var i=0;i<profile_perosonal_image.files.length;i++){
            form_data.append('profile_perosonal_image',profile_perosonal_image.files[0]);
        }
    }
   
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    //console.log(form_data);

    $.ajax({
        url: baseUrl2+"/api/profile-personal-image", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal("Success!", response.message, "success");
                location.reload();
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });
}));

$("#copy-link").click(function (event) {
  event.preventDefault();
  $('.animationload').show();
  let url = $(this).data('url');
  $('#offscreen').val(url);
  var copyTextarea = document.querySelector('.offscreen');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    //console.log('Copying text command was ' + msg);
    swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();
  } catch (err) {
    //console.log('Oops, unable to copy');
    swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();
  }
});
</script>

<script type="text/javascript">
//================Password Check====================
$.validator.addMethod("passwordCk", function (pwd, element) {
  //pwd = pwd.replace(/\s+/g, "");
  return this.optional(element) && pwd.length > 8 && pwd.match(/^[ A-Za-z0-9_@./#&+-]*$/);
}, "Password must be 8 character, alphaneumeric & one special character.");
//================Password Check====================
</script>

<script type="text/javascript">
$.validator.addMethod("pwcheck", function(value) {
   return /[a-zA-Z]+/.test(value) // consists of only these
      && /[0-9]+/.test(value) // has a digit
      && /[*@&%!#$]+/.test(value) // has a Special character
});
//================Submit AJAX request ==================
$('#change_passord').validate({
      //ignore: ":hidden:not(.selectpicker)",
      rules: {
          old_passsword: {
              required: true
          },
          new_password: {
              required: true
          },
          new_password: {
              required: true,
         minlength: 8,
         pwcheck: true
              //passwordCk: true
          },
          new_confirm_password: {
              required: true,
              equalTo : "#new_password"
          }
      },
      
      messages: {
          old_passsword: {
              required: 'Please enter old password'
          },
          new_password: {
              required: 'Please enter new password'
          },
          new_password: {
              required: 'Please enter password',
         minlength: 'Please enter minimum 8 character password',
         pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
          },
         
          new_confirm_password: {
              required: 'Please enter new confirm password'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        data = addCommonParams(data);
        $.ajax({
            url: form.action,
            type: form.method,
            data:data ,
            dataType: "json",
            success: function(response) {
              //console.log(response);
              if(response.result=='1')
              {
                  swal("Success", response.message , "success");
                  $('#change_passord')[0].reset();
                  $("#change-password").modal('hide');
                  //console.log(response);
              }
              else
              {
                  swal("Error", response.message , "error");
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
//================Submit AJAX request ==================
</script>
@endsection