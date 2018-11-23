@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
 <h1>Client</h1>
 <ul>
    <li>&nbsp;</li>
    <!-- <li><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></li>
    <li><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></li> -->
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
          <div class="whitebox cdHeading">
             <div class="share-cusbtn" style="margin: -5px 0 0 3px;">
                <button onclick="myFunction()" class="cusbtn-style"><i class="fa fa-share" aria-hidden="true"></i></button>
             </div>
             <div id="openbox">
                <ul>
                   <li><a><i class="fa fa-user-plus" aria-hidden="true"></i> Invite</a></li>
                   <li><a><i class="fa fa-share-alt" aria-hidden="true"></i> Share </a></li>
                </ul>
             </div>
             <h4 class="text-center"> Latesha J</h4>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
             <label>802-438-0497</label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
             <label>Jan 20, 1978</label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
             <label>Lauren Drive, Madison, WI 53705</label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/mail.png')}}"/>
             <label>LateshaJ@gmail.com</label>
          </div>
          <div class="whitebox cdDetails clearfix">
             <img src="{{asset('public/assets/mobile/images/customer-details/notes.png')}}"/>
             <p>Aeque enim contingit omnibus fidibus, ut incontentae 
                sint. Semper enim ex eo, quod maximas partes continet 
                latissimeque funditur, tota res appellatur. <a>more</a>
             </p>
             <p> 11:25 AM   May 8, 2018</p>
             <label class="pull-right"><a href="{{url('mobile/client-booking-list/rajibjana')}}"> Bookings</a> </label>
          </div>
          <div class="clearfix"></div>
          <div class="break20px"></div>
          <h5 class="text-center">Transactions</h5>
          <div class="break10px"></div>
          <div class="cdList">
             <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                   <div class="border-box">
                      <ul>
                         <li>
                            <label>0</label>
                            Booked 
                         </li>
                         <li>
                            <label>$0</label>
                            Amount Due
                         </li>
                         <li>
                            <label>$0</label>
                            Paid
                         </li>
                      </ul>
                   </div>
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