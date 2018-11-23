@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Bookings</h1>
   <ul>
      <li><a href="" id="showpopup"><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></a> </li>
   </ul>
</header>
<main>
   <div class="showMobile">
      <div class="clientHead">
         <h3>All Clients</h3>
         <!-- <a><i class="fa fa-angle-right"></i></a> -->
      </div>
      <ul class="clientSchedule">
         <li><a href="#" class="active">Current</a> </li>
         <li><a href="#">Next 3 Days</a> </li>
         <li><a href="#">Last 1 Month</a> </li>
      </ul>
      <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12">
               <div class="bluebg break20px namedate">
                  <span>Thursday, Apr 26, 2018</span>
                  <span>John G</span>
               </div>
               <div class="whitebox border-box">
                  <div class="staffDetail">
                     <span><label>With</label> Esther</span>
                     <p>12:15 - 12:30 PM</p>
                     <span class="bluetxt">$200</span>
                  </div>
                  <div class="staffInside">
                     <h6>Smile Corrections</h6>
                     <p><span>Notes :</span> Aeque enim contingit omnibus fidibus, ut incontentae sint semper enim ex eo, quod maximas partes <a>more</a></p>
                  </div>
               </div>
               <div class="bluebg break20px namedate">
                  <span>Thursday, Apr 26, 2018</span>
                  <span>John G</span>
               </div>
               <div class="whitebox border-box">
                  <div class="staffDetail">
                     <span><label>With</label> Esther</span>
                     <p>12:15 - 12:30 PM</p>
                     <span class="bluetxt">$200</span>
                  </div>
                  <div class="staffInside">
                     <h6>Smile Corrections</h6>
                     <p><span>Notes :</span> Aeque enim contingit omnibus fidibus, ut incontentae sint semper enim ex eo, quod maximas partes <a>details</a></p>
                  </div>
               </div>
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
                  <h3>Select Client</h3>
                  <div class="mobile-control">
                     <input type="radio" name="all" value="each time" />
                     <label>All Clients</label>
                     <div class="clearfix"></div>
                     <div class="break20px"></div>
                     <div class="input-group custom-group">
                        <input class="form-control" type="text" onkeyup="searchFilter();" id="searchInput" placeholder="Select Clients by Name" />
                        <span class="input-group-addon" onclick="searchFilter();"><img src="{{asset('public/assets/mobile/images/mobile-blue-search.png')}}"/> </span>
                     </div>
                     <div id="radioControl">
                        <div class="radioEach">
                           <input type="radio" name="staff" checked="checked" value="each time" />
                           <label>Enrique J</label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
                        </div>
                        <div class="radioEach">
                           <input type="radio" name="staff" value="each time" />
                           <label>Sadie D</label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
                        </div>
                        <div class="radioEach">
                           <input type="radio" name="staff" value="each time" />
                           <label>Tina D</label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
                        </div>
                        <div class="radioEach">
                           <input type="radio" name="staff" value="each time" />
                           <label>Lucile M</label>
                           <div class="clearfix"></div>
                           <div class="break20px"></div>
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


@section('custom_js')
<script type="text/javascript">
$("#showpopup").on('click',function(e){
   e.preventDefault();
   $( "#popup" ).show();
});
</script>
@endsection