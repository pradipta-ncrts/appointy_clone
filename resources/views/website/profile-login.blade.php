@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
    <div class="container-custm">
      <div class="upper-cmnsection">
        <div class="heading-uprlft">Profile</div>
        <div class="upr-rgtsec" style="display:none;">
          <div class="col-md-5">
            <div id="custom-search-input">
              <div class="input-group col-md-12">
                <input type="text" class="  search-query form-control" placeholder="Search" />
                <span class="input-group-btn">
                <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                </span> </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="full-rgt">
              <div class="dropdown custm-uperdrop">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="images/arrow.png" alt=""/></button>
                <ul class="dropdown-menu">
                  <li><a href="#">JAN</a></li>
                  <li><a href="#">FEB</a></li>
                  <li><a href="#">MARCH</a></li>
                </ul>
              </div>
              <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
            </div>
          </div>
        </div>
      </div>
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
      <div class="btn-slide"> <img src="images/slide-butt-add.png" /> </div>
      <div class="container-fluid">
        <div class="row">
        <h2 class="profile-title">Login</h2>
          <div class="prof" style="padding:0;width:100%"> 
             <form action="" style="width:50%">
   <div class="form-group">You log in with an email address and password</div>          
  <div class="form-group">
    <label for="email"><strong>Email address:</strong></label>
    <div class="profile-email">chebalger@outlook.fr <span><a href="#">change email</a></span></div>
  </div>
  <div class="form-group">
    <label for="pwd"><strong>Password:</strong></label>
    <div class="profile-email">*********** <span><a href="#">change password</a></span></div>
  </div>
<!--  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>-->
</form> 
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
@endsection