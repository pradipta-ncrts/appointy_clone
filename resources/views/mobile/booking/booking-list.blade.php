@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Bookings</h1>
   <ul>
      <li><a onclick="popup();"><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></a> </li>
   </ul>
</header>
<main>
   <div class="showMobile">
      <div class="clientHead">
         <h3>All Bookings</h3>
         <!-- <a><i class="fa fa-angle-right"></i></a> -->
      </div>
      <ul class="clientSchedule">
         <li><a href="{{url('mobile/booking-list/all')}}" class="<?=$duration=='all' ? 'active' : ''; ?>">Current</a> </li>
         <li><a href="{{url('mobile/booking-list/day')}}" class="<?=$duration=='day' ? 'active' : ''; ?>">Next 3 Days</a> </li>
         <li><a href="{{url('mobile/booking-list/month')}}" class="<?=$duration=='month' ? 'active' : ''; ?>">Last 1 Month</a> </li>
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
                        <p class="addReadMore showlesscontent"><span>Notes :</span> <?=$value->note;?> </p>
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
<div id="popup">
   <div class="centerAlign">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12">
               <div class="popupInside dashDateTime showMobile">
                  <h3>Select Staff</h3>
                  <div class="mobile-control">
                    <div id="radioControl">
                        <div class="radioEach">
                           <input type="radio" class="staff_id" data-duration="{{ Request::segment(3) }}" name="staff_id" value="" checked="" />
                           <label>All</label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
                        </div>
                     </div>
                     <div class="input-group custom-group">
                        <input class="form-control" type="text" placeholder="Select Staff by Name" id="booking_staff_filter" />
                        <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-blue-search.png')}}"/> </span>
                     </div>
                     <div id="radioControl">
                        <?php
                        foreach ($staff_list as $key => $value)
                        {
                        ?>
                        <div class="radioEach">
                           <input type="radio" class="staff_id" data-duration="{{ Request::segment(3) }}" name="staff_id" value="<?=$value->staff_id;?>"  />
                           <label><?=$value->full_name;?></label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
                        </div>
                        <?php
                        }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_js')

@endsection