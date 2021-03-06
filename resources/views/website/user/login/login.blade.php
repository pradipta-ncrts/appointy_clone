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
    <div class="login-type">
      <a href="" class="active user-status" id="1">Admin Login</a> &nbsp; &nbsp;
      <a href="" class="user-status" id="2">Team Login</a>
    </div>
    <div class="login-form">
      <form action="{{ url('api/login') }}" method="post" autocomplete="off" id="loginform">
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-email.png')}}">
          <input type="hidden" name="user_type" id="user_type" value="1">
          <input type="text" class="form-control" id="email" placeholder="Email/Username" name="email">
          <div class="clearfix"></div>
        </div>
        <div class="form-group"> <img src="{{asset('public/assets/website/images/login-icon-passwod.png')}}">
          <input type="password" class="form-control" id="pwd"  placeholder="Password" name="password">
          <a><i class="fa fa-eye log-i toggle-password" aria-hidden="true"></i></a>
          <div class="clearfix"></div>
        </div>
        <button type="submit" class="btn btn-default">LOG IN</button>
        <div class="checkbox">
          <label class="check">
            <input type="checkbox">
            &nbsp;&nbsp; Keep me signed in <span class="checkmark"></span></label>
        </div>
        <a href="{{ url('forgot-password') }}" class="forgot-pass">Forgot your password?</a>
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
     /* if($(this).text()=='Individual')
      {
          $("#full_name").attr('placeholder', 'Personal name')
      }
      else
      {
          $("#full_name").attr('placeholder', 'Business name')
      }*/
   });
   //================Tab select end ==================

    $(document).on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        
        var input = $("#pwd");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

//================Submit AJAX request ==================
$('#loginform').validate({
      rules: {
          email: {
              required: true
          },
          password: {
              required: true
          }
      },

      messages: {
          email: {
              required: 'Please enter username/email'
          },
          password: {
              required: 'Please enter password'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        //data.push({name: 'device_type', value: 1});
        if ($("#user_type").val()==1)
        {
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
                        if(response.message=='complete_step_two')
                        {
                            var redirect_param = response.enc_email;
                            var url = "{{url('/registration-step2')}}"+'/'+redirect_param;
                            window.location.href = url; 
                        }
                        else
                        {
                            var user_no = response.user.user_no;
                            var user_type = response.user.user_type;
                            var user_request_key = response.user.user_request_key;
                            var device_token_key = "";
                            //console.log(data['0']);
                            // get the user no and the request key for farther service calls
                            if($('input[name="remember_me"]').is(':checked')){
                                $.cookie("UserEmail", data['0'].value, { expires: 365 });
                                $.cookie("UserPassword", data['1'].value, { expires: 365 });
                            } else {
                                $.cookie("UserEmail", '');
                                $.cookie("UserPassword", '');
                            }

                            $.cookie("sqd_user_no", user_no, { expires: 30, path:'/' });
                            $.cookie("sqd_user_type", user_type, { expires: 30, path:'/' });
                            $.cookie("sqd_user_request_key", user_request_key, { expires: 30, path:'/' });
                            $.cookie("sqd_device_token_key", device_token_key, { expires: 30, path:'/' });

                            
                            var url = "{{url('/dashboard')}}";
                            console.log(url);
                            //alert(url);
                            window.location=url;
                        }
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
        else
        {
            data = addCommonParams(data);
            $.ajax({
                url: baseUrl+'/api/staff_login',
                type: form.method,
                data:data ,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.result==1)
                    {
                        //console.log(response.user);
                        //return false;
                        var user_no = response.user.user_no;
                        var user_type = response.user.user_type;
                        var user_request_key = response.user.user_request_key;
                        var device_token_key = "";//response.user.user_request_key;
                        //console.log(data['0']);
                        // get the user no and the request key for farther service calls
                        if($('input[name="remember_me"]').is(':checked')){
                            $.cookie("UserEmail", data['0'].value, { expires: 365 });
                            $.cookie("UserPassword", data['1'].value, { expires: 365 });
                        } else {
                            $.cookie("UserEmail", '');
                            $.cookie("UserPassword", '');
                        }

                        //alert(device_token_key);
                        //alert(user_request_key);

                        $.cookie("sqd_user_no", user_no, { expires: 30, path:'/' });
                        $.cookie("sqd_user_type", user_type, { expires: 30, path:'/' });
                        $.cookie("sqd_user_request_key", user_request_key, { expires: 30, path:'/' });
                        $.cookie("sqd_device_token_key", device_token_key, { expires: 30, path:'/' });

                        console.log($.cookie('sqd_user_no'));
                        console.log($.cookie('sqd_user_type'));
                        console.log($.cookie('sqd_user_request_key'));
                        console.log($.cookie('sqd_device_token_key'));
                        
                        
                        var url = "{{url('/staff-dashboard')}}";
                        console.log(url);
                        //alert(url);
                        window.location=url;
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
        
      }
  });
//================Submit AJAX request===================
</script>
</body>
</html>
