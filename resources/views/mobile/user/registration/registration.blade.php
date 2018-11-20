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
   </head>
   <body class="login-bg">
      <div id="mobile" class="mobile-login">
         <div class="login-form">
            <div class="logo-login mb-version"><img src="{{asset('public/assets/mobile/images/logo-login.png')}}"></div>
            <form action="">
               <div class="form-group">
                  <img src="{{asset('public/assets/mobile/images/login-icon-email.png')}}">
                  <input type="email" class="form-control" id="email" placeholder="Email ( e.g.  john@gmail.com )">
                  <div class="clearfix"></div>
               </div>
            </form>
            <button type="submit" onclick="location.href='login2.html'" class="btn btn-default btn-mob-st">NEXT</button>
            <p class="terms" style="margin-top:5px;">By creating your account, you agree to <strong>Squeedr</strong><br>
               <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a> 
            </p>
         </div>
      </div>
      <!-- <script src="js/bootstrap.min.js"></script> --> 
      <script src="{{asset('public/assets/mobile/js/jquery.min.js')}}"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
      <script src="{{asset('public/assets/mobile/js/parallax.min.js')}}"></script> 
      <script src="{{asset('public/assets/mobile/js/script.js')}}"></script>
   </body>
</html>