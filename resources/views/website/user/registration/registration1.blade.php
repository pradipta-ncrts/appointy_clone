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
            <div class="row">
               <div class="col-sm-5">
                  <h2>Sign Up</h2>
               </div>
               
               <div class="col-md-5 col-sm-6 from-reg1">
                  <div class="reg-type">
                     <a href="javascript:void(0);" class="active user-status" id="1">Individual</a> &nbsp; &nbsp;
                     <a href="javascript:void(0);" class="user-status" id="2">Business</a>
                  </div>
                  <form class="form-horizontal" action="{{ url('api/registration-step1') }}" method="post" id="registration-form-one">
                     <input type="hidden" name="user_type" id="user_type" value="1">
                     <input type="hidden" name="request_url" id="request_url" value="<?=$request_url;?>">
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-username.png')}}">
                        <input type="text" class="form-control" placeholder="Personal Name" name="full_name" id="full_name" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-username.png')}}">
                        <input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-pass.png')}}">
                        <a><i class="fa fa-eye log-i toggle-password" aria-hidden="true"></i></a>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>

                    <div id="owner_details" style="display:none;">
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-username.png')}}">
                        <input type="text" class="form-control" placeholder="Owner Name" name="owner_full_name" id="owner_full_name" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/login-icon-email.png')}}">
                        <input type="text" class="form-control" placeholder="Owner Email Address" name="owner_email" id="owner_email" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-username.png')}}">
                        <input type="text" class="form-control" placeholder="Owner Username" name="owner_username" id="owner_username" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-pass.png')}}">
                        <a><i class="fa fa-eye log-i toggle-password-owner" aria-hidden="true"></i></a>
                        <input type="password" class="form-control" placeholder="Owner Password" name="owner_password" id="owner_password" autocomplete="off">
                        <div class="clearfix"></div>
                     </div>
                    </div>

                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-location.png')}}">
                         <select class="selectpicker required" data-show-subtext="true" data-live-search="true" name="country" id="country"> 
                           <option value="">Select country</option>
                           <?php
                           foreach ($country as $key => $value)
                           {
                              echo "<option value='".$value->country_no."'>".$value->country_name."</option>";
                           }
                           ?>
                        </select>
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-phone1.png')}}">
                        <div class="row">
                        <!-- <div class="col-sm-2">
                        <select >
                           <option value="">+91</option>
                        </select>
                        <div class="clearfix"></div>
                        </div> -->
                        <div class="col-sm-3">
                        <input type="text" class="form-control required customphone" placeholder="Code" name="country_code" id="country_code" readonly="">
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control required customphone" placeholder="Mobile" name="phone" id="phone">
                        </div>
                        </div>
                        
                        <div class="clearfix"></div>
                     </div>
                     <div class="form-group">
                        <img src="{{asset('public/assets/website/images/reg-icon-profesion1.png')}}">
                        <input type="text" class="form-control" name="profession" id="profession" placeholder="Profession">
                        
                        <div class="clearfix"></div>
                     </div>
                     
                     <button type="submit" id="sing-up">Sign Up</button>
                     <div class="clearfix"></div>
                     <p>By signing up, you agree to our <a href="{{ url('terms-and-condition') }}">terms of use</a> and 
                        <a href="{{ url('privacy-policy') }}">privacy policy</a>
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
         //================Tab select ==================
         $('.user-status').click(function(event) {
            event.preventDefault(); 
            var type = $(this).attr("id");
            $('.reg-type').find('a').removeClass('active');
            $(this).addClass('active');
            $('#user_type').val(type);
            if($(this).text()=='Individual')
            {
                $("#full_name").attr('placeholder', 'Personal name');
                $("#owner_details").hide();
            }
            else
            {
                $("#full_name").attr('placeholder', 'Business name');
                $("#owner_details").show();
            }
         });
         //================Tab select end ==================
         //================Show password ==================
         $(document).on('click', '.toggle-password', function() {
              $(this).toggleClass("fa-eye fa-eye-slash");
              
              var input = $("#password");
              input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
          });

          $(document).on('click', '.toggle-password-owner', function() {
              $(this).toggleClass("fa-eye fa-eye-slash");
              
              var input = $("#owner_password");
              input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
          });
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

		$.validator.addMethod("pwcheck", function(value) {
			return /[a-zA-Z]+/.test(value) // consists of only these
				&& /[0-9]+/.test(value) // has a digit
				&& /[*@&%!#$]+/.test(value) // has a Special character
		}, "Password must contain minimum 1 character, 1 digit and 1 special character.");

        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^\w+$/i.test(value);
        }, "Letters, numbers, and underscores only please");
      //================Submit AJAX request ==================
      $('#registration-form-one').validate({

            ignore: ":hidden:not(.selectpicker)",

            rules: {
                full_name: {
                    required: true
                },
                user_name: {
                    required: true,
                    alphanumeric: true
                },
                password: {
                    required: true,
					minlength: 8,
					pwcheck: true
                    //passwordCk: true
                },
                owner_full_name :  {
                    required : function(){
                                        return $("#user_type").val() == 2;
                                }
                },
                owner_email :  {
                    required : function(){
                                        return $("#user_type").val() == 2;
                                },
                    email : true
                },
                owner_username :  {
                    required : function(){
                                        return $("#user_type").val() == 2;
                                },
                    alphanumeric : true
                },
                owner_password :  {
                    required : function(){
                                        return $("#user_type").val() == 2;
                                },
                    minlength: 8,
					pwcheck: true
                },
                phone: {
                    required: true,
                    phoneUS: true
                },
                profession: {
                    required: true
                },
                country: {
                    required: true
                }
            },
            
            messages: {
                full_name: {
                    required: 'Please enter name'
                },
                user_name: {
                    required: 'Please enter username'
                },
                password: {
                    required: 'Please enter password',
					minlength: 'Please enter minimum 8 character password',
					pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
                },

                owner_full_name :  {
                    required : 'Please enter owner name'
                },
                owner_email :  {
                    required : 'Please enter owner email',
                    email : 'Please enter valid email address'
                },
                owner_username :  {
                    required : 'Please enter owner username'
                },
                owner_pssword :  {
                    required : 'Please enter owner password',
                    minlength: 'Please enter minimum 8 character password',
					pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
                },

                phone: {
                    required: 'Please enter mobile'
                },
                profession: {
                    required: 'Please select profession'
                },
                country: {
                    required: 'Please select country'
                }
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
                        window.location = js_base_url+'registration-step2/'+response.message;
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
      <script type="text/javascript">
        $(function() {
          var txt = $("#user_name");
          var func = function() {
            txt.val(txt.val().replace(/\s/g, ''));
          }
          txt.keyup(func).blur(func);
        });

        //fetch country code
        $("#country").change(function (e) {
            e.preventDefault();
            let data = $(this).val();
            //alert(data);
            $.ajax({
                url: js_base_url+"/api/country-phone-code", 
                type: "POST", 
                data: { data : data }, 
                dataType: "json",
                success: function(response) 
                {
                    $('#country_code').val('+'+response.response_message.phonecode);
                    $('.animationload').hide();
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
            
        });
      </script>
      <script type="text/javascript">
         var countries = [
            <?php
            foreach ($professions as $key => $value)
            {
            ?>
                { value: '<?=$value->profession;?>', data: '<?=$value->profession_id;?>' },
            <?php
            }
            ?>
            ];

            $('#profession').autocomplete({
                lookup: countries,
            });
      </script>
<style>
.autocomplete-suggestions{background:#fff;padding:10px 0;border:1px solid #ccc;}
.autocomplete-suggestion{padding:0 10px 10px;border-bottom:1px solid #ccc;margin:0 0 10px;}
.autocomplete-suggestion:last-child{margin:0;border:0;padding:0 10px 0;}
.log-i{margin-top: 13px;}
</style>
   </body>
</html>

