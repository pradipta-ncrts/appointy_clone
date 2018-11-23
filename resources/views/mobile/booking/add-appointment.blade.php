@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Add Appointment</h1>
  <ul>
    <li>&nbsp;<!-- <img src="images/mobile-serach.png" /> --> </li>
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
            <div class="whitebox mobile-control">
               <div class="input-group">
                  <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-client.png')}}"/> </span>
                  <select class="form-control">
                     <option>Client</option>
                  </select>
               </div>
               <div class="input-group">
                  <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-services.png')}}"/> </span>
                  <select class="form-control">
                     <option>Services</option>
                  </select>
               </div>
               <div class="input-group">
                  <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-staff.png')}}"/> </span>
                  <select class="form-control">
                     <option>Staff</option>
                  </select>
               </div>
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                  <input type="text" class="form-control nice-select date" placeholder="Date"/    >
               </div>
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-time.png')}}"/> </span>
                  <input type="text" class="form-control nice-select" placeholder="Time"/    >
               </div>
               <textarea class="form-control notes" rows="6" placeholder="Notes"></textarea>
               <ul class="colors">
                  <li class="bgred" onclick="activeColor(this);"></li>
                  <li class="bgyellow" onclick="activeColor(this);"></li>
                  <li class="bggrn" onclick="activeColor(this);"></li>
                  <li class="bglightgrn" onclick="activeColor(this);"></li>
                  <li class="bgblue" onclick="activeColor(this);"></li>
               </ul>
               <h2>Set the Color</h2>
               <input type="text" class="form-control nice-select" placeholder="Type Here"/    >
               <div class="input-group">
                  <div class="checkbox-cutm">
                     <input name="" type="checkbox" value=""> Confirmation Email
                  </div>
               </div>
               <a class="btn btn-mobile btn-block btn-size break20px">Submit</a> 
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