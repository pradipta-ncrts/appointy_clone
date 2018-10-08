<!DOCTYPE html>
<html lang="en">
    
<head>
        <title> {{ $title }} </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{asset('public/assets/admin/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('public/assets/admin/css/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/assets/admin/css/matrix-login.css')}}" />
        <link href="{{asset('public/assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">         
            <form id="loginform" class="form-vertical" action="{{url('admin/check-login')}}" method="post"> 
				 <div class="control-group normal_text"> <h3>Squeedr Admin</h3></div>
                <?php if (Session::has('err_message')) { ?>
                <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong> {{Session::get('err_message')}}</p>
                </div> 
                <?php } ?><!-- / Error Message -->
                <?php if (Session::has('success_message')) { ?>
                <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('success_message')}}</p>
                </div>
                <?php } ?> 
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username" name="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" required="" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                   <!--  <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span> -->
                    <span class="pull-right"><input type="submit" name="login" class="btn btn-success" value="login" /></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" required="" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>
        </div>
        
        <script src="{{asset('public/assets/admin/js/jquery.min.js')}}"></script>  
        <script src="{{asset('public/assets/admin/js/matrix.login.js')}}"></script> 
    </body>

</html>
