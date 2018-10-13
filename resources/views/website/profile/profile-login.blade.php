@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('profile-settings') }}"> Profile</a></li>
               <li><a href="{{ url('profile-picture') }}"> Picture</a> </li>
               <li><a href="{{ url('profile-link') }}"> My Link</a></li>
               <!--<li><a href="profile-services.html"> Services</a></li>-->
               <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>
               <li><a href="{{ url('profile-login') }}" class="active"> Login</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
         <div class="container-fluid">
            <div class="row">
               <h2 class="profile-title">Login</h2>
               <div class="prof" style="padding:0;width:100%">
                  <form style="width:50%" action="{{ url('api/change-password') }}" method="post" id="change-password">
                     <div class="form-group">You log in with an email address and password</div>
                     <div class="form-group">
                        <label for="email"><strong>Email address:</strong></label>
                        <div class="profile-email"><?=$user_details->email;?> <span><a href="#">change email</a></span></div>
                     </div>
                     <div class="form-group">
                        <label for="pwd"><strong>Password:</strong></label>
                        <div class="profile-email">*********** <span>
                          <a href="javascript:void(0)" id="show-change-password" style="display: none;">change password</a>
                          <a href="javascript:void(0)" id="hide-change-password">change password</a>
                        </span></div>
                     </div>
                     <div id="change-password-inputs" style="display: none;">
                         <div class="form-group">
                            <label for="pwd"><strong>Old Password:</strong></label>
                            <input type="text" class="form-control" id="old_password" placeholder="Old Password" name="old_password">
                         </div>
                         <div class="form-group">
                            <label for="pwd"><strong>New Password:</strong></label>
                            <input type="text" class="form-control" id="new_passord" placeholder="New Password" name="new_passord" value="">
                         </div>
                         <div class="form-group">
                            <label for="pwd"><strong>New Confirm Password:</strong></label>
                            <input type="text" class="form-control" id="new_confirm_passord" placeholder="New Password" name="new_confirm_passord" value="">
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