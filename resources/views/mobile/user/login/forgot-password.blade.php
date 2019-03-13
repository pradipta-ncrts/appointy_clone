<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
      <title>Squeedr</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/mobile/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/mobile/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/mobile.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/ncrts.css')}}" rel="stylesheet">
      <script type="text/javascript">
        var baseUrl ="<?php echo url('')?>"; 
      </script>
   </head>
   <body class="login-bg">
      <div class="animationload" style="display: none;">
            <div class="osahanloading"></div>
      </div>
      <div id="mobile" class="mobile-login">
         <div class="login-form">
            <div class="logo-login mb-version"><img src="{{asset('public/assets/mobile/images/logo-login.png')}}"></div>
            <?php 
            if (Session::has('error_message')) 
            {
            ?>
                <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('error_message')}}</p>
                </div> 
            <?php
            } 
            if (Session::has('success_message')) 
            {
            ?>
                <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-check"></i><strong>Success!</strong>{{Session::get('success_message')}}</p>
                </div> 
            <?php
            } 
            ?> 
            <form action="{{ url('mobile/send_reset_password_link') }}" method="post" autocomplete="off" id="forgot-password">
              <input type="hidden" name="type" value="1" id="type">
              <?php
              if($user_data=='')
              {
              ?>
               <table>
                  <tr>
                     <td>Admin Login</td>
                     <td><label class="switch-m">
                        <input type="checkbox" name="user_type" id="user_type">
                        <span class="slider-m round-m"></span> </label>
                     </td>
                     <td>Team Login</td>
                  </tr>
               </table>
               <div class="form-group">
                  <img src="{{asset('public/assets/mobile/images/login-icon-email.png')}}">
                  <!-- <input type="email" class="form-control" id="email" placeholder="Email ( e.g.  john@gmail.com )"> -->
                  <!-- <input type="email" class="form-control" id="email" placeholder="Email ( e.g.  john@gmail.com )" name="email">  -->
                  <input type="text" class="form-control" id="email" placeholder="Email" name="email">
                  <div class="clearfix"></div>
               </div>
               <?php
                }
                else
                {
               ?>
               <input type="hidden" name="user_id" value="<?=$user_data;?>">
               <div class="form-group">
                  <img src="{{asset('public/assets/mobile/images/login-icon-passwod.png')}}">
                  <input type="password" class="form-control" id="pwd"  placeholder="Password" name="password">
                  <div class="clearfix"></div>
               </div>
               <div class="form-group">
                  <img src="{{asset('public/assets/mobile/images/login-icon-passwod.png')}}">
                  <input type="password" class="form-control" id=""  placeholder="Confirm Password" name="confirm_password">
                  <div class="clearfix"></div>
               </div>
               <?php
                }
               ?>
               <!-- <label>Password must be 8 to 15 characters and include at least one 
               number and one letter</label> -->
               <button type="submit" class="btn btn-default btn-mob-st">Reset Password</button>
               <div class="clearfix"></div>
            </form>
         </div>
      </div>
      <!-- <script src="js/bootstrap.min.js"></script> --> 
      <script src="{{asset('public/assets/mobile/js/jquery.min.js')}}"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
      <script src="{{asset('public/assets/mobile/js/parallax.min.js')}}"></script> 
      <script src="{{asset('public/assets/mobile/js/script.js')}}"></script>

      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

      <!--==================Sweetalert=========================-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <!--=================select box=========================-->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

      <script src="{{asset('public/assets/mobile/js/ncrts.js')}}"></script>
      <script src="{{asset('public/assets/mobile/js/ncrtsdev.js')}}"></script>
      <script type="text/javascript">
      //================Tab select ==================
       $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            
            var input = $("#pwd");
            input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
        });

      //================Password Check====================
        $.validator.addMethod("passwordCk", function (pwd, element) {
          //pwd = pwd.replace(/\s+/g, "");
          return this.optional(element) && pwd.length > 8 && pwd.match(/^[ A-Za-z0-9_@./#&+-]*$/);
        }, "Password must be 8 character, alphaneumeric & one special character.");
        //================Password Check====================

    </script>
    <script type="text/javascript">

    $.validator.addMethod("properemail", function(value, element) {
           return this.optional(element) || /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
       });
    <?php
    if($user_data=='')
    {
    ?>
    //================Submit AJAX request ==================
    $('#forgot-password').validate({
          rules: {
              email: {
                  required: true,
                  properemail: true
              }
          },

          messages: {
              email: {
                  required: 'Please enter email.',
                  properemail: 'Must be a valid email address.'
              }
          }
      });
    <?php
    }
    else
    {
    ?>
    //================Submit AJAX request===================
    $('#forgot-password').validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                pwcheck: true
            },
            confirm_password: {
                required: true,
                equalTo: '#pwd'
            }
        },

        messages: {
            password: {
                required: 'Please enter password',
                minlength: 'Please enter minimum 8 character password',
                pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
            },
            confirm_password: {
                required: 'Please enter confirm password',
                equalTo: 'Please enter same password'
            }
        },
    });
    <?php
    }
    ?>
    $('#user_type').change(function(){
        var c = this.checked ? '2' : '1';
        $('#type').val(c);
    });
    </script>

   </body>
</html>