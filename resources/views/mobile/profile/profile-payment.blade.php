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
            <li><a href="{{ url('profile-payment') }}" class="active"> Payment Mode</a> </li>
            <li><a href="{{ url('profile-login') }}"> Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
      <div class="container-fluid">
        <div class="row">
          <div class="prof" style="padding:0;">
            <div class="prof-cont">
              <div class="col-md-12 flex"> <img src="{{asset('public/assets/website/images/profile-icon-payment.png')}}">
                <div class="prof-cont">
                  <h3>Payment mode</h3>
                  <div class="new-modalcustm">
                    <div class="clr-modalbdy profile-frm" style="padding:0 !important;">
                      <div style="width:55%">
                                <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                          <label>Cheques, Cash and Credit Cards </label>
                          <form action="{{ url('api/profile-payment') }}" method="post" id="update-profile-payment">
                            <div class="input-group"> <span class="input-group-addon"></span>
                              <input id="payment_mode" type="text" class="form-control" name="payment_mode" placeholder="Cheques, Cash and Credit Cards" value="<?=isset($user_details->payment_mode) && $user_details->payment_mode ? $user_details->payment_mode : '';?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-md" style="margin-top:15px;">Save Changes</button>
                          </form>
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