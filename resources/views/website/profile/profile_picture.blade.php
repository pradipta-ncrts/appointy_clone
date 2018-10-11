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
            <li><a href="{{ url('profile-picture') }}" class="active"> Picture</a> </li>
            <li><a href="{{ url('profile-link') }}"> My Link</a></li>
            <!--<li><a href="profile-services.html"> Services</a></li>-->
             <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}" > Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="images/slide-butt-add.png" /> </div>
      <div class="container-fluid">
      <!--<h2 class="profile-title">Upload Picture</h2>-->
        <div class="row">
          <div class="profile-bx"> 
          <div style="width:100%;float:left;">
          <!--<div class="profile-picbx"  data-toggle="modal" data-target="#myModapic-upload"><i class="fa fa-picture-o" aria-hidden="true"></i><span class="ng-tns-c3-3">Upload Picture</span></div>-->
          <p class="profile-p">Uploaded pictures will display at the top of your profile page (maximum file size of 5MB)</p>
          <div class="add-logo" data-toggle="modal" data-target="#myModapic-upload" style="float:left;margin-top:0;">
          <img src="images/picture.png" alt="" style="height:60px !important;width:auto !important"><br>
          <span>Upload Picture</span>
          </div>
          
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
@endsection