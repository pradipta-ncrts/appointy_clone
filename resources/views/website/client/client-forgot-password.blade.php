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
<link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
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
    <div class="login-type" style="color:#fff">Reset Password</div> 
    <div class="clearfix"></div>
    <div class="login-form">
      <form action="{{ url('api/client_forgot_password') }}" method="post" autocomplete="off" id="clientforgotpasswordform">
      <input type="hidden" name="client_id" value="{{$client_id}}">
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-passwod.png')}}">
            <input type="password" class="form-control" id="pwd"  placeholder="New Password" name="new_password">
            <div class="clearfix"></div>
        </div>
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-passwod.png')}}">
            <input type="password" class="form-control" id="conpwd"  placeholder="Confirm Password" name="confirm_password">
            <div class="clearfix"></div>
        </div>
        <button type="submit" class="btn btn-default">RESET</button>
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
<script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>
<!-- Sweetalert -->
<script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script>
<!--=================select box=========================-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

<script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
<script src="{{asset('public/assets/website/js/ncrtsdev.js')}}"></script>
<script type="text/javascript">
//================Submit AJAX request ==================
$('#clientforgotpasswordform').validate({
    rules: {
        new_password: {
            required: true
        },
        confirm_password: {
            required: true,
            equalTo: '#pwd'
        }
    },

    messages: {
        new_password: {
            required: 'Please enter password'
        },
        confirm_password: {
            required: 'Please enter confirm password',
            equalTo: 'Please enter same password'
        }
    },

    submitHandler: function(form) {
    var data = $(form).serializeArray();
    //data.push({name: 'device_type', value: 1});
    data = addCommonParams(data);
    $.ajax({
        url: form.action,
        type: form.method,
        data:data ,
        dataType: "json",
        success: function(response) {
            console.log(response);
            if(response.result==1)
            {
                //var url = response.message;
                //console.log(url);
                //alert(url);
                //window.location=url;
                swal({title: "Success", text: response.message, type: "success"},
                function(){ 
                    location.reload();
                });
            }
            else{
                swal('Sorry!',response.message,'error');
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
//================Submit AJAX request===================
</script>
</body>
</html>
