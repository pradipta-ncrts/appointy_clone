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
            <li><a href="{{ url('profile-settings') }}" class="active"> Profile</a></li>
            <li><a href="{{ url('profile-picture') }}"> Picture</a> </li>
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
        <div class="row">
        <div class="new-modalcustm">
        <div class="clr-modalbdy profile-frm" style="padding:0 !important;width: 90%;">
        <div style="width:55%">
        <div class="calen-txt">Branding <img src="images/info-cross.png" alt="" />
        
        <button type="button" class="btn btn-sm btn-toggle pull-right active" data-toggle="button" aria-pressed="true" autocomplete="hide">
        <div class="handle"></div>
        </button>
        </div>
        
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Name <img src="images/info-cross.png" alt="" /></label>
              <div class="input-group"> <span class="input-group-addon"></span>
                <input id="name" type="text" class="form-control" name="name" placeholder="Full Name">
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
              <label>Profession</label>
                <div class="input-group"> <span class="input-group-addon"></span>
                  <div class="form-group nomarging custom-select color-b" >
                        <select >
                          <option>Select Profession </option>
                        </select>
                        <div class="clearfix"></div>
                      </div>
                </div>
              </div>
            </div>
          </div>
        <!--<div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Welcome Message <img src="images/info-cross.png" alt="" /></label>
              <div class="input-group textarea-md"> <span class="input-group-addon"></span>
                <textarea style="width: 100%" id="area" placeholder="Welcome Message"></textarea>
              </div>
            </div>
          </div>
        </div>-->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Presentation </label>
              <div class="input-group" style="border:1px solid #ccc;border-radius:5px 0 0 5px;"> <span class="input-group-addon" style="border:0"></span>
                <textarea style="width: 100%;border:0;height: 100px;" id="area" placeholder="Presentation" ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Expertise </label>
              <div class="input-group"> <span class="input-group-addon"></span>
                <input id="name" type="text" class="form-control" name="name" placeholder="Expertise">
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Language</label>
              <div class="input-group"> <span class="input-group-addon"></span>
                <div class="form-group nomarging custom-select color-b" >
                      <select >
                        <option>Select Language </option>
                      </select>
                      <div class="clearfix"></div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Timezone <span class="pull-right">Current Time: 12pm</span> </label>
              <div class="input-group"> <span class="input-group-addon"></span>
                <div class="form-group nomarging custom-select color-b" >
                      <select >
                        <option>Select Timezone </option>
                      </select>
                      <div class="clearfix"></div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             <button type="button" class="btn btn-primary">Save Changes</button>
             <button type="button" class="btn btn-default">Cancel</button>
             <button type="button" class="btn btn-default pull-right">Delete Account</button>
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