<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>Squeedr</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/mobile.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
      <script type="text/javascript"> var js_base_url = '<?=url('');?>/';</script>
   </head>
   <body class="login-bg">

      <div class="animationload" style="display: none;">
            <div class="osahanloading"></div>
      </div>

      <div id="web">
         <div class="reg-1st ">
            <div class="logo-reg">
               <img src="{{asset('public/assets/website/images/logo.svg')}}">
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="reg-container container-fixed1">
            <!-- Success Message -->
            <!--<div id="registration_success_msg" class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px; display: none;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p><i class="icon fa fa-check"></i><strong>Success!</strong>You have registered successfully. Please verify your email address.</p>
            </div>-->
        
            <div class="row">
               <div class="col-sm-5">
                  <h2>Sign Up</h2>
               </div>
               
               <div class="col-md-5 col-sm-6 from-reg1">
                  <form class="form-horizontal" action="{{ url('api/client_registration') }}" method="post" id="client-registration-form">
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-username.png')}}">
                        <input type="text" class="form-control" placeholder="Full Name" name="client_name" id="client_name">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-profesion1.png')}}">
                        <input type="text" class="form-control" placeholder="Email Address" name="client_email" id="client_email">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-pass.png')}}">
                        <a class="fa fa-eye" onclick="myFunction()"></a>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-phone1.png')}}">
                        <input type="text" class="form-control" placeholder="Mobile" name="client_mobile" id="client_mobile">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-location.png')}}">
                        <input type="text" class="form-control" placeholder="Address" name="client_address" id="client_address">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-location.png')}}">
                         <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client_timezone" id="client_timezone"> 
                           <option value="">Select Timezone</option>
                           <?php /*
                           foreach ($country as $key => $value)
                           {
                              echo "<option value='".$value->country_no."'>".$value->country_name."</option>";
                           }
                           */ ?>
                        </select>
                        <div class="clearfix"></div>
                     </div>

                     <button type="submit" id="sing-up">Sign Up</button>
                     <div class="clearfix"></div>
                     <p>By signing up, you agree to our <a href="#">terms of use</a> and 
                        <a href="#">privacy policy</a>
                     </p>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- <script src="js/bootstrap.min.js"></script> -->

      <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script> 
      <script src="{{asset('public/assets/website/js/bootstrap.min.js')}}"></script> 
      <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script> 
      <script src="{{asset('public/assets/website/js/script.js')}}"></script>
      <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
      <script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
       <!--=================select box=========================-->
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
      <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>
      <!--==================Sweetalert=========================-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
       <!--=================select box=========================-->
       <!--===========================autocomplete========================-->
       <script src="{{asset('public/assets/website/js/jquery.autocomplete.min.js')}}"></script>
       <!--============================autocomplete========================-->
      </script>
      <script type="text/javascript">
         //================Show password ==================
         function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
      }
      //================Show password end ==================

      </script>
      <script type="text/javascript">
      //================Custom validation for 10 digit phone====================
      $.validator.addMethod("phoneUS", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && phone_number.length < 11;
      }, "Please specify a valid phone number.");
      //================Custom validation for 10 digit phone====================
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
      $('#client-registration-form').validate({

            ignore: ":hidden:not(.selectpicker)",

            rules: {
                client_name: {
                    required: true
                },
                client_email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
					minlength: 8,
					pwcheck: true
                    //passwordCk: true
                },
                client_mobile: {
                    required: true
                },
                client_address: {
                    required: true
                },
                /*client_timezone: {
                    required: true
                }*/
            },
            
            messages: {
                client_name: {
                    required: 'Please enter your full name'
                },
                client_email: {
                    required: 'Please enter your email address',
                    email: 'Please enter valid email address'
                },
                password: {
                    required: 'Please enter password',
					minlength: 'Please enter minimum 8 character password',
					pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
                },
                client_mobile: {
                    required: 'Please enter your mobile number'
                },
                client_address: {
                    required: 'Please enter your address'
                },
                /*client_timezone: {
                    required: 'Please select your timezone'
                }*/
            },

            submitHandler: function(form) {
              var data = $(form).serializeArray();
              //data = addCommonParams(data);
              $.ajax({
                  url: form.action,
                  type: form.method,
                  data:data ,
                  dataType: "json",
                  success: function(response) {
                    console.log(response);
                    if(response.result=='1')
                    {
                        $('#client-registration-form').trigger("reset");
                        //$('#registration_success_msg').show();
                        swal("Success", response.message , "success");
                    }
                    else
                    {
                        $('#registration_success_msg').hide();
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


   </body>
</html>

