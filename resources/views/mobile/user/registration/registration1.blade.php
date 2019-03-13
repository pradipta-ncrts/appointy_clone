<!doctype html>

<html>

   <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, minimal-ui" />

      <title>Squeedr</title>

      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">

      <link href="{{asset('public/assets/mobile/css/bootstrap.min.css')}}" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/mobile/css/font-awesome.min.css')}}" />

      <link href="{{asset('public/assets/mobile/css/styles.css')}}" rel="stylesheet">

      <link href="{{asset('public/assets/mobile/css/mobile.css')}}" rel="stylesheet">

      <link href="{{asset('public/assets/mobile/css/custom.css')}}" rel="stylesheet">

      <link href="{{asset('public/assets/mobile/css/ncrts.css')}}" rel="stylesheet">

      <script type="text/javascript"> var js_base_url = '<?=url('');?>/';</script>

   </head>

   <body class="login-bg">

      <div class="animationload" style="display: none;">

            <div class="osahanloading"></div>

      </div>

      <div id="mobile" class="mobile-login">

         <div class="login-form" >

            <div class="logo-login"> <img src="{{asset('public/assets/mobile/images/logo-login.png')}}"> </div>

            <div class="user-type">

                 <a href="" class="active user-status" id="1">Individual</a> &nbsp; &nbsp;

                 <a href="" class="user-status" id="2">Business</a>

            </div>

            <form class="form-horizontal" action="{{ url('api/registration-step1') }}" method="post" id="registration-form-one">

             <input type="hidden" name="user_type" id="user_type" value="1">

             <input type="hidden" name="request_url" id="request_url" value="<?=$request_url;?>">

               <div class="form-group">

                  <img src="{{asset('public/assets/mobile/images/reg-icon-user.png')}}">

                  <input type="text" class="form-control" placeholder="Personal Name" name="full_name" id="full_name">

                  <div class="clearfix"></div>

               </div>

               <div class="form-group">

                  <img src="{{asset('public/assets/mobile/images/reg-icon-user.png')}}">

                  <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name">

                  <div class="clearfix"></div>

               </div>

               <div class="form-group">

                  <img src="{{asset('public/assets/mobile/images/reg-icon-pass.png')}}">

                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">

                  <div class="clearfix"></div>

               </div>

               <div class="form-group" id="owner_details" style="display: none;">

                  <img src="{{asset('public/assets/mobile/images/reg-icon-user.png')}}">

                  <input type="text" class="form-control" placeholder="Owner Name" name="owner_full_name" id="owner_full_name">

                  <div class="clearfix"></div>

               </div>

               <div class="form-group">

                  <img src="{{asset('public/assets/mobile/images/reg-icon-phone.png')}}">

                  <select class="form-control cust-select" name="country" id="country"> 

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

               <button type="submit" class="btn btn-default btn-mob-st">Sign Up</button>

            </form>

         </div>

      </div>

      <!-- <script src="js/bootstrap.min.js"></script> --> 

      <script src="{{asset('public/assets/mobile/js/jquery.min.js')}}"></script> 

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

      <script src="{{asset('public/assets/mobile/js/parallax.min.js')}}"></script> 

      <script src="{{asset('public/assets/mobile/js/script.js')}}"></script>



      <!--=================select box=========================-->

      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

      <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>

      <!--==================Sweetalert=========================-->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

       <!--=================select box=========================-->

       <!--===========================autocomplete========================-->

       <script src="{{asset('public/assets/website/js/jquery.autocomplete.min.js')}}"></script>

      <script type="text/javascript">

         //================Tab select ==================

         $('.user-status').click(function(event) {

            event.preventDefault(); 

            var type = $(this).attr("id");

            $('.user-type').find('a').removeClass('active');

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

      $('#registration-form-one').validate({



            ignore: ":hidden:not(.selectpicker)",



            rules: {

                full_name: {

                    required: true

                },

                user_name: {

                    required: true

                },

                password: {

                    required: true,

          minlength: 8,

          pwcheck: true

                    //passwordCk: true

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

                        window.location = js_base_url+'mobile/registration-step2/'+response.message;

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

   </body>

</html>