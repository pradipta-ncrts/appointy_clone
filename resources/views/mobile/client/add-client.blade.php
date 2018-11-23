@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Add Client</h1>
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
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-first-name.png')}}"/> </span>
                  <input type="text" class="form-control nice-select" placeholder="First Name"/    >
               </div>
               <div class="customcontrol">
                  <input type="text" class="form-control nice-select" placeholder="Last Name"/    >
               </div>
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-email.png')}}"/> </span>
                  <input type="email" class="form-control nice-select" placeholder="Email"/    >
               </div>
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-phone.png')}}"/> </span>
                  <input type="text" class="form-control nice-select" placeholder="Mobile"/    >
               </div>
               <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-address.png')}}"/> </span>
                  <input type="text" class="form-control nice-select" placeholder="Address"/    >
               </div>
               <div class="customcontrol">
                  <select class="form-control">
                     <option>Time Zone</option>
                  </select>
               </div>
               <div class="customcontrol">
                  <select class="form-control">
                     <option>Post Code</option>
                  </select>
               </div>
               <textarea class="form-control notes" rows="3" placeholder="Notes"></textarea>
               <div class="input-group">
                  <div class="checkbox-cutm">
                     <input name="" type="checkbox" value=""> Confirmation Email
                  </div>
               </div>
               <a id="myBtn" class="btn btn-mobile btn-block btn-size break20px">Proceed</a> 
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