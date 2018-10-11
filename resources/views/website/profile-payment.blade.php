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
            <li><a href="{{ url('profile-payment') }}" class="active"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}"> Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="images/slide-butt-add.png" /> </div>
      <div class="container-fluid">
        <div class="row">
          <div class="prof" style="padding:0;">
            <div class="prof-cont">
              <div class="col-md-12 flex"> <img src="images/profile-icon-payment.png">
                <div class="prof-cont">
                  <h3>Payment mode</h3>
                  <div class="new-modalcustm">
        <div class="clr-modalbdy profile-frm" style="padding:0 !important;">
        <div style="width:55%">
                  <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Cheques, Cash and Credit Cards </label>
              <div class="input-group"> <span class="input-group-addon"></span>
                <input id="name" type="text" class="form-control" name="name" placeholder="Cheques, Cash and Credit Cards">
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
@endsection