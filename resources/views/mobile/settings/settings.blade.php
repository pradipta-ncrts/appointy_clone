@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Settings</h1>
  <ul>
    <li>&nbsp;<!-- <a href="{{url('mobile/add-staff')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> --> </li>
  </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <div class="whitebox mobilesettings">
               <div class="settingslist"> <img src="{{asset('public/assets/mobile/images/mobile-membership.png')}}" />
                  <label>Membership</label>
               </div>
               <a href="{{url('mobile/membership')}}"><i class="fa fa-angle-right"></i></a> 
            </div>
            <div class="whitebox mobilesettings">
               <div class="settingslist"> <img src="{{asset('public/assets/mobile/images/mobile-services.png')}}" />
                  <label>Services</label>
               </div>
               <a href="{{url('mobile/service-list/all')}}"><i class="fa fa-angle-right"></i></a>
            </div>
            <div class="whitebox mobilesettings">
               <div class="settingslist"> <img src="{{asset('public/assets/mobile/images/mobile-business-hours.png')}}" />
                  <label>Business Hours</label>
               </div>
               <a href="{{url('mobile/business-hours')}}"><i class="fa fa-angle-right"></i></a> 
            </div>
         </div>
      </div>
   </div>
</main>

@endsection


@section('custom_js')

@endsection