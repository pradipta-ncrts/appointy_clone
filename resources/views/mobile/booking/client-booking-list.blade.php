@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Bookings</h1>
  <ul>
    <li>&nbsp;<!-- <img src="images/mobile-serach.png" /> --> </li>
  </ul>
</header>
<main>
  <div class="showMobile">
    <div class="clientHead">
      <h3>Mike J. Yelten</h3>
      <!-- <a><i class="fa fa-angle-right"></i></a> --> </div>
    <ul class="clientSchedule">
      <li><a href="{{url('mobile/client-booking-list/all')}}/<?=$client_id;?>" class="<?=$duration=='all' ? 'active' : ''; ?>">Current</a> </li>
      <li><a href="{{url('mobile/client-booking-list/day')}}/<?=$client_id;?>" class="<?=$duration=='day' ? 'active' : ''; ?>">Next 3 Days</a> </li>
      <li><a href="{{url('mobile/client-booking-list/month')}}/<?=$client_id;?>" class="<?=$duration=='month' ? 'active' : ''; ?>">Last 1 Month</a> </li>
    </ul>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="custm-share">
            <div class="bluebg break20px namedate"> <span>Thursday, Apr 26, 2018 test</span> </div>
            <div class="dropdown btn-res">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-share"
                  aria-hidden="true"></i></button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Reschedule</a></li>
                <li><a href="#">Cancel </a></li>
              </ul>
            </div>
          </div>

          <div class="whitebox border-box">
            <div class="staffDetail"> <span>
                <label>With</label>
                Esther</span>
              <p>12:15 - 12:30 PM</p>
              <span class="bluetxt">$200</span> </div>
            <div class="staffInside">
              <h6>Smile Corrections</h6>
              <p><span>Notes :</span> Aeque enim contingit omnibus fidibus, ut incontentae sint semper enim ex eo, quod
                maximas partes <a>more</a></p>
            </div>
          </div>

          <div class="custm-share">
            <div class="bluebg break20px namedate"> <span>Thursday, Apr 26, 2018 test</span> </div>
            <div class="dropdown btn-res">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-share"
                  aria-hidden="true"></i></button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Reschedule</a></li>
                <li><a href="#">Cancel </a></li>
              </ul>
            </div>
          </div>
          <div class="whitebox border-box">
            <div class="staffDetail"> <span>
                <label>With</label>
                Esther</span>
              <p>12:15 - 12:30 PM</p>
              <span class="bluetxt">$200</span> </div>
            <div class="staffInside">
              <h6>Smile Corrections</h6>
              <p><span>Notes :</span> Aeque enim contingit omnibus fidibus, ut incontentae sint semper enim ex eo, quod
                maximas partes <a>more</a></p>
            </div>
          </div>
          <!--<a class="btn btn-block btn-mobile btn-size showMobile">Reschedule</a>-->
        </div>
      </div>
    </div>
  </div>
</main>

@endsection


@section('custom_js')
<script type="text/javascript">
  function ShowPopup() {
         
             $("#popup").fadeToggle();
         
         }
</script>
@endsection