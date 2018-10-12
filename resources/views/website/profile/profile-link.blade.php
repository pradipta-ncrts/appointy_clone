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
            <li><a href="{{ url('profile-link') }}" class="active"> My Link</a></li>
            <!--<li><a href="profile-services.html"> Services</a></li>-->
            <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}"> Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
      
      <div class="container-fluid">
        <div class="row">
        <!--<h2 class="profile-title">My Link</h2>-->
          <div class="profile-bx"> 
          <p class="profile-p">Changing your URL will mean that all of your copied links will no longer work and will need to be updated.</p>
          <div class="profile-link">
              <div class="form-group">
              <!-- <label class="control-label col-sm-2" for="url">runmobileapps.com/</label> -->
              <form action="{{ url('api/profile-url') }}" method="post" id="update-profile-url">
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="" placeholder="Your Squdeer Link" name="profile_url" value="{{ url('business-provider') }}/<?=$user_details->username;?>">
                    <button type="submit" class="btn btn-primary btn-md" style="margin-top:15px;">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
                   <!--<div class="alert alert-info" style="width:100%">
        <strong><a href="http://runmobileapps.com/supriya/squdeer/index.html" target="_blank">http://runmobileapps.com/supriya/squdeer</a></strong>
      </div>--> 
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
@endsection