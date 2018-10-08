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
</head>

<body class="login-bg">
<div id="web">
  <div class="login-container">
  <div class="login-webview">
   <div class="logo-login"><img src="{{asset('public/assets/website/images/logo-login.png')}}"></div>
    <div class="login-form">
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
            ?> 
        <form action="" method="post" autocomplete="off" id="registration">
          <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-email.png')}}">
            <input type="text" class="form-control" id="email" placeholder="Email" name="email">
            <div class="clearfix"></div>
          </div>
          <button type="submit" class="btn btn-default">Register</button>
        </form>
        <div class="clearfix"></div>
        <img class="or-login" src="{{asset('public/assets/website/images/or.png')}}">
        <a href="{{ url('/login') }}" class="btn btn-default">LOG IN</a>
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

<script type="text/javascript">

$.validator.addMethod("properemail", function(value, element) {
       return this.optional(element) || /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
   });

//================Submit AJAX request ==================
$('#registration').validate({
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
//================Submit AJAX request===================
</script>
<style type="text/css">
.login-form input[type=text]{
      background: none;
      border: 0;
      width: 330px;
      color: #FFF;
      padding: 23px 10px;
      font-size: 16px;
}
</style>
</body>
</html>
