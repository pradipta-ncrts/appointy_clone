@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Staff</h1>
  <ul>
    <li><a href="{{url('mobile/add-staff')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
  </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="mobileStaff break10px showMobile" >
            <div class="whitebox">
               <h2>Dr. Concepcion M.</h2>
               <span>Psychiatrist</span>
               <ul>
                  <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                  <li><i class="fa fa-phone"></i>802-438-0497</li>
               </ul>
               <ol>
                  <li>Addiction, Alcoholism</li>
                  <li>Sleep Medicine</li>
                  <li><a>More </a></li>
               </ol>
            </div>
            <div class="whitebox">
               <h2>Dr. Concepcion M.</h2>
               <span>Psychiatrist</span>
               <ul>
                  <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                  <li><i class="fa fa-phone"></i>802-438-0497</li>
               </ul>
               <ol>
                  <li>Addiction, Alcoholism</li>
                  <li>Sleep Medicine</li>
                  <li><a>More </a></li>
               </ol>
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