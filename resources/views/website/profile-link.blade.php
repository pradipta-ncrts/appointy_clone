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
            <li><a href="{{ url('profile-link') }}" class="active"> My Link</a></li>
            <!--<li><a href="profile-services.html"> Services</a></li>-->
            <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}"> Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="images/slide-butt-add.png" /> </div>
      
      <div class="container-fluid">
        <div class="row">
        <!--<h2 class="profile-title">My Link</h2>-->
          <div class="profile-bx"> 
          <p class="profile-p">Changing your URL will mean that all of your copied links will no longer work and will need to be updated.</p>
          <div class="profile-link">
            <div class="form-group">
            <label class="control-label col-sm-2" for="url">runmobileapps.com/</label>
            <div class="col-sm-7">
            <input type="url" class="form-control" id="url" placeholder="http://runmobileapps.com/supriya/squdeer">
            <button type="button" class="btn btn-primary btn-md" style="margin-top:15px;">Save Changes</button>
            </div>
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