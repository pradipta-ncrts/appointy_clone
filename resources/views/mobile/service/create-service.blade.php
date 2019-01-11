@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Service Add</h1>
  <ul>
    <li>&nbsp; </li>
  </ul>
</header>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 break20px">
          <div class="service-type whitebox">
              <div class="service-one">
                  <i class="fa fa-user"></i>
                  <div class="srv-cont"> 
                    <h3>One-on-One</h3>
                    <p>Allow invitees to schedule individual slots with you.</p>
                  </div>
                  <a href="{{url('mobile/add_services/solo')}}"><button type="button"> <i class="fa fa-plus"></i> Create </button></a>
                  <div class="clearfix"></div>
              </div>

              <div class="service-one">
                  <i class="fa fa-users"></i>
                  <div class="srv-cont"> 
                    <h3>Group</h3>
                    <p>Allow multiple invitees to schedule the same slot. Useful for tours, webinars, classes, workshops, etc.</p>
                  </div>
                  <a href="{{url('mobile/add_services/group')}}"><button type="button"> <i class="fa fa-plus"></i> Create </button></a>
                  <div class="clearfix"></div>
              </div>
          </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('custom_js')

@endsection