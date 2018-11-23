@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Review List</h1>
  <ul>
    <li>&nbsp;<!-- <img src="images/mobile-serach.png" /> --> </li>
  </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <form class="form-inline">
               <div class="headRow">
                  <div class="padding15px clearfix">
                     <div class="mobileNote lon showMobile" >
                        <div class="whitebox">
                           <h2>30 Apr, 2018 <strong>10:15 AM</strong></h2>
                           <label>Latesha J</label>
                           <span><i class="fa fa-envelope"></i>LateshaJ@gmail.com </span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis 
                              suae urbis conservatorem Codrum, quis Erechthei filias non 
                              maxime laudat Id quaeris, inquam, in quo <a>show more</a>
                           </p>
                        </div>
                        <div class="whitebox">
                           <h2>30 Apr, 2018 <strong>10:15 AM</strong></h2>
                           <label>Latesha J</label>
                           <span><i class="fa fa-envelope"></i>LateshaJ@gmail.com </span>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis 
                              suae urbis conservatorem Codrum, quis Erechthei filias non 
                              maxime laudat Id quaeris, inquam, in quo <a>show more</a>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</main>

@endsection

@section('custom_js')

@endsection