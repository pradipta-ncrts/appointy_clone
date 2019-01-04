@extends('../layouts/mobile/master_template_staff')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
  <a href="{{url('mobile/staff-dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Bookings</h1>
   <ul>
      <!-- <li><a onclick="popup();"><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></a> </li> -->
   </ul>
</header>
<main>
   <div class="showMobile">
      <div class="clientHead">
         <h3>Booking List</h3>
         <!-- <a><i class="fa fa-angle-right"></i></a> -->
      </div>
      <ul class="clientSchedule">
         <li><a href="{{url('mobile/staff-booking-list/all')}}" class="<?=$duration=='all' ? 'active' : ''; ?>">Current</a> </li>
         <li><a href="{{url('mobile/staff-booking-list/day')}}" class="<?=$duration=='day' ? 'active' : ''; ?>">Next 3 Days</a> </li>
         <li><a href="{{url('mobile/staff-booking-list/month')}}" class="<?=$duration=='month' ? 'active' : ''; ?>">Last 1 Month</a> </li>
      </ul>
      <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12" id="filter_data">
               <?php
               if($appoinment_list)
               {
                  foreach ($appoinment_list as $key => $value)
                  {
                  ?>
                  <div class="bluebg break20px namedate">
                     <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span>
                     <span><?=$value->client_name;?></span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> <?=$value->staff_name;?></span>
                        <p><?=$value->start_time;?> - <?=$value->end_time;?></p>
                        <span class="bluetxt"><?=$value->currency;?><?=$value->cost;?></span>
                     </div>
                     <div class="staffInside">
                        <h6><?=$value->service_name;?></h6>
                        <p><span>Notes :</span> <?=$value->note;?> <!-- <a>more</a> --></p>
                     </div>
                  </div>
                  <?php
                  }
               }
               else
               {
               ?>
               <div class="bluebg break20px namedate">
                  No data found.
               </div>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
   </div>
</main>

@endsection

@section('custom_js')

@endsection