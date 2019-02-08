@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="leftpan">
         <div class="left-menu">
            <ul>
            <li><a href="{{ url('client/profile-settings/'.$param) }}" > Profile</a></li>
            <li><a href="{{ url('client/profile-picture-settings/'.$param) }}" > Picture</a> </li>
            <li><a href="{{ url('client/login-settings/'.$param) }}" class="active"> Login</a> </li>
          </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
         <div class="container-fluid">
            <div class="row">
               <h2 class="profile-title">Login</h2>
               <div class="prof" style="padding:0;width:100%">
                  <form style="width:50%" action="{{ url('api/client_change_password') }}" method="post" id="change-password">
                     <input type="hidden" name="client_id" value="{{$client_details->client_id}}">
                     <div class="form-group">You log in with an email address and password</div>
                     <div class="form-group">
                        <label for="email"><strong>Email address:</strong></label>
                        <div class="profile-email"><?=$client_details->client_email;?> <!--<span><a href="#">change email</a></span>--></div>
                     </div>
                     <div class="form-group">
                        <label for="pwd"><strong>Password:</strong></label>
                        <div class="profile-email">*********** <span>
                          <a href="javascript:void(0)" id="show-change-password" style="display: none;">Change Password</a>
                          <a href="javascript:void(0)" id="hide-change-password">Change Password</a>
                        </span></div>
                     </div>
                     <div id="change-password-inputs" style="display: none;">
                         <div class="form-group">
                            <label for="pwd"><strong>Old Password:</strong></label>
                            <input type="password" class="form-control" id="old_password" placeholder="Old Password" name="old_password">
                         </div>
                         <div class="form-group">
                            <label for="pwd"><strong>New Password:</strong></label>
                            <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" value="">
                         </div>
                         <div class="form-group">
                            <label for="pwd"><strong>New Confirm Password:</strong></label>
                            <input type="password" class="form-control" id="new_confirm_password" placeholder="New Password" name="new_confirm_password" value="">
                         </div>
                         <div class="clearfix"></div>
                         <button type="submit" id="" class="btn btn-primary butt-next">Update</button>
                         <button type="button" id="close-change-password" class="btn btn-primary butt-next">Close</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_js')
<script>
$("#hide-change-password").click(function(e){
    e.preventDefault();
    $("#hide-change-password").hide();
    $("#show-change-password").show();
    $("#change-password-inputs").show();
});
$("#show-change-password").click(function(e){
    e.preventDefault();
    $("#show-change-password").hide();
    $("#hide-change-password").show();
    $("#change-password-inputs").hide();
});

$("#close-change-password").click(function(e){
    e.preventDefault();
    $("#show-change-password").hide();
    $("#hide-change-password").show();
    $("#change-password-inputs").hide();
});

$.validator.addMethod("pwcheck", function(value) {
  return /[a-zA-Z]+/.test(value) // consists of only these
    && /[0-9]+/.test(value) // has a digit
    && /[*@&%!#$]+/.test(value) // has a Special character
});

$('#change-password').validate({
      rules: {
          old_password: {
              required: true
          },
          new_password: {
              required: true,
              minlength: 8,
              pwcheck: true
              //passwordCk: true
          },
          new_confirm_password: {
              required: true
          }
      },
      
      messages: {
          old_password: {
              required: 'Old password required'
          },
          new_password: {
              required: 'New password required',
              minlength: 'Please enter minimum 8 character password',
              pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
          },
          new_confirm_password: {
              required: 'Confirm password required'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        $.ajax({
            url: form.action,
            type: form.method,
            data:data ,
            dataType: "json",
            success: function(response) {
              console.log(response);
              $('.animationload').hide();
              if(response.result=='1')
              {
                $("#change-password-inputs").hide();
                $('#change-password').trigger("reset");
                swal("Success!", response.message, "success")
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
</script>
@endsection