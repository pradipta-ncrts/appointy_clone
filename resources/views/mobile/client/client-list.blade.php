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
            <?php
            foreach ($client_list as $key => $value)
            {
            ?>
            <div class="whitebox customers">
               <div class="customersLeft">
                  <h3><?=$value->client_name;?></h3>
                  <div class="cdetails">
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
                        <label><?=$value->client_mobile;?></label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
                        <label><?=$value->client_dob=='0000-00-00' ? 'NIL' : date('M d, Y', strtotime($value->client_dob));?></label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
                        <label><?=$value->client_address;?></label>
                     </div>
                  </div>
               </div>
               <div class="customersRight">
                  <div>
                     <a href="{{url('mobile/client-details')}}/<?=$value->client_id;?>"><i class="fa fa-angle-right"></i></a>
                  </div>
                  <div class="cunotes">
                     <!-- <img src="{{asset('public/assets/mobile/images/customer-details/black-notes.png')}}"/>
                     <label>Notes</label> -->
                  </div>
               </div>
            </div>
            <?php
            }
            ?>
         </div>
      </div>
   </div>
</main>
@endsection


@section('custom_js')

@endsection