<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
      <title>Squeedr</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"  />
      <link href="{{asset('public/assets/mobile/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/mobile.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/mobile/css/custom.css')}}" rel="stylesheet">
   </head>
   <body class="login-bg">
      <div id="mobile" class="mobile-login">
         <div class="login-form">
            <div class="logo-login"><img src="{{asset('public/assets/mobile/images/logo-login.png')}}"></div>
            <h2 class="slogan">For people who<br>
               want more!
            </h2>
            <button type="submit"  onclick="location.href='{{ url("mobile/registration-step") }}'" class="btn btn-default btn-mob-st">SIGN UP</button>
            <button type="submit" onclick="location.href='{{ url("mobile/login") }}'" class="btn btn-default btn-mob-st">LOG IN</button>
            <!--<img class="or-login" src="{{asset('public/assets/mobile/images/mob/or.png')}}">
            <button type="submit" class="btn btn-default btn-mob-st"><i class="fa fa-facebook-official" aria-hidden="true"></i> &nbsp; LOG IN WITH FACEBOOK</button>-->
            <p>Can't log in?</p>
            <a href="#" class="contact">Contact <strong>Squeedr</strong></a> 
         </div>
      </div>
      <!-- <script src="js/bootstrap.min.js"></script> --> 
      <script src="{{asset('public/assets/mobile/js/jquery.min.js')}}"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
      <script src="{{asset('public/assets/mobile/js/parallax.min.js')}}"></script> 
      <script src="{{asset('public/assets/mobile/js/script.js')}}"></script>
   </body>
</html>