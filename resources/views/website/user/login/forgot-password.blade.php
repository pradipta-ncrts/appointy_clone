<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Squeedr</title>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
<link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
<link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/website/css/mobile.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<script type="text/javascript">
  var baseUrl = '<?=url('');?>/';
</script>
</head>
<body class="login-bg">
<div class="animationload" style="display: none;">
      <div class="osahanloading"></div>
</div>
<div id="web">
  <div class="login-container">
  <div class="login-webview">
   <div class="logo-login"><img src="{{asset('public/assets/website/images/logo-login.png')}}"></div> 
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
    <?php
    if($user_data=='')
    {
    ?>
    <div class="login-type">
      <a href="" class="active user-status" id="1">Admin Login</a> &nbsp; &nbsp;
      <a href="" class="user-status" id="2">Team Login</a>
    </div>
    <?php
    }
    ?>
    <div class="login-form">
      <form action="{{ url('send_reset_password_link') }}" method="post" autocomplete="off" id="forgot-password">
        <input type="hidden" name="user_type" id="user_type" value="1">
        <?php
        if($user_data)
        {
        ?>
        <input type="hidden" name="user_id" value="<?=$user_data;?>">
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-passwod.png')}}">
          <input type="password" class="form-control" id="pwd"  placeholder="Password" name="password">
          <!-- <a><i class="fa fa-eye log-i toggle-password" aria-hidden="true"></i></a> -->
          <div class="clearfix"></div>
        </div>
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-passwod.png')}}">
          <input type="password" class="form-control" id=""  placeholder="Confirm Password" name="confirm_password">
          <!-- <a><i class="fa fa-eye log-i toggle-password" aria-hidden="true"></i></a> -->
          <div class="clearfix"></div>
        </div>
        <?php
        }
        else
        {
        ?>
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-email.png')}}">
          <input type="text" class="form-control" id="email" placeholder="Email" name="email">
          <div class="clearfix"></div>
        </div>
        <?php
        }
        ?>
        <button type="submit" class="btn btn-default">Reset Password</button>
        <div class="clearfix"></div>
      </form>
    </div>
    </div>
  </div>
</div>
<!-- <script src="js/bootstrap.min.js"></script> --> 
<script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script> 
<script src="{{asset('public/assets/website/js/script.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!--==================Sweetalert=========================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<!--=================select box=========================-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

<script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
<script src="{{asset('public/assets/website/js/ncrtsdev.js')}}"></script>
<script type="text/javascript">
  //================Tab select ==================
   $('.user-status').click(function(event) {
      event.preventDefault(); 
      var type = $(this).attr("id");
      $('.login-type').find('a').removeClass('active');
      $(this).addClass('active');
      $('#user_type').val(type);
   });
   //================Tab select end ==================

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
</script>
</body>
</html>
