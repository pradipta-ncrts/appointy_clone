@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>All Clients</h1>
   <ul>
      <li>&nbsp;
        <!-- <img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /> --></li>
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row showDekstop">
         <!--Edited by Sandip - Start-->
         <!--Edited by Sandip - End-->
      </div>
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <div class="whitebox customers">
               <div class="customersLeft">
                  <h3>Latesha J</h3>
                  <div class="cdetails">
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
                        <label>802-438-0497</label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
                        <label>Jan 20, 1978</label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
                        <label>Lauren Drive, Madison, WI 53705</label>
                     </div>
                  </div>
               </div>
               <div class="customersRight">
                  <div>
                     <a href="{{url('mobile/client-details/rajibjana')}}"><i class="fa fa-angle-right"></i></a>
                  </div>
                  <div class="cunotes">
                     <!-- <img src="{{asset('public/assets/mobile/images/customer-details/black-notes.png')}}"/>
                     <label>Notes</label> -->
                  </div>
               </div>
            </div>
            <div class="whitebox customers">
               <div class="customersLeft">
                  <h3>Latesha J</h3>
                  <div class="cdetails">
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
                        <label>802-438-0497</label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
                        <label>Jan 20, 1978</label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
                        <label>Lauren Drive, Madison, WI 53705</label>
                     </div>
                  </div>
               </div>
               <div class="customersRight">
                  <div>
                     <a href="{{url('mobile/client-details/rajibjana')}}"><i class="fa fa-angle-right"></i></a>
                  </div>
                  <div class="cunotes">
                     <!-- <img src="{{asset('public/assets/mobile/images/customer-details/black-notes.png')}}"/>
                     <label>Notes</label> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection


@section('custom_js')

@endsection