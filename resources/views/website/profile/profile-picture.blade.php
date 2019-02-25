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
            <li><a href="{{ url('profile-picture') }}" class="active"> Picture</a> </li>
            <li><a href="{{ url('profile-link') }}"> My Link</a></li>
            <!--<li><a href="profile-services.html"> Services</a></li>-->
            <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}" > Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
      <div class="container-fluid">
      <!--<h2 class="profile-title">Upload Picture</h2>-->
        <div class="row">
          <div class="profile-bx"> 
            <form action="{{ url('api/profile-personal-image') }}" method="post" id="profile-personal-image">
              <div style="width:100%;float:left;">
              <p class="profile-p">Uploaded pictures will display at the top of your profile page (maximum file size of 5MB)</p>
                  <div data-toggle="modal" style="float:left;margin-top:0;">
                  <a href="" id="profile_perosonal-image-remove" <?=$user_details->profile_perosonal_image ? '' : 'style="display: none;"'; ?>><i class="fa fa-close"></i></a>
                      <div class="upload-logo" id="profile_perosonal-image-upload">
                         <?php
                         $image = $user_details->profile_perosonal_image ? 'image/profile_perosonal_image/'.$user_details->profile_perosonal_image : "assets/website/images/business-hours/blue-user.png";
                         ?>
                         <img id="profile_perosonal_image_preview" src="{{asset('public/'.$image)}}" height="80" width="80"><br>
                         <span>Upload Profile Picture</span>
                      </div>
                  </div>
                  <input accept="image/x-png,image/gif,image/jpeg" type="file" id="profile_perosonal-image" name="profile_perosonal_image" style="display: none;">
                  <input type="hidden" name="old_profile_perosonal_image" value="<?=$user_details->profile_perosonal_image;?>">
                  <div class="clearfix"></div>
                     <button type="submit" id="profile-personal-image-update-button" class="btn btn-primary butt-next">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection