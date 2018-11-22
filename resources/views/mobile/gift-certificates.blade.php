@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
    <div class="container-custm">
      <div class="upper-cmnsection">
        <div class="heading-uprlft">Marketing</div>
        <div class="upr-rgtsec">
          <div class="col-sm-5">
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
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                <ul class="dropdown-menu">
                  <li><a href="#">JAN</a></li>
                  <li><a href="#">FEB</a></li>
                  <li><a href="#">MARCH</a></li>
                </ul>
              </div>
              <div class="filter-option"><a href="">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="leftpan">
        <div class="left-menu">
          <ul>
            <li><a href="{{ url('gift-certificates') }}" class="active"> Gift As a Gift</a></li>
            <li><a href="{{ url('marketing-discount-coupons') }}"> Discount Coupons</a> </li>
            <li><a href="{{ url('offers') }}"> Offers</a></li>
          </ul>
        </div>
      </div>
      <div class="rightpan">
        <div class="discount-box">
        <h2>Gift As a Gift</h2>
        <div class="alert alert-warning mt-20">
      Gift certificates can be purchased online on the customer booking interface only after a payment gateway has been added. If you do not have a payment gateway added, you can only sell gift certificates from the admin interface. Gift certificates can be redeemed online at the time of booking, or in person at the time of availing the service.
      </div>
        <p>Let customers gift your services to their family & friends. Create one Gift Certificate for every event. It can be a Birthday, Anniversary, Thanksgiving, New year, Mother's day or Father's day.</p>
        </div>
        <div class="gc-btnbx">
        <h3>Design your first gift certificate</h3>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Design</button>
       </div>
      </div>
  </div>
@endsection