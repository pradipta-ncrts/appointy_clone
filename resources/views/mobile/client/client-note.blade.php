@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Client Note</h1>
  <ul>
    <li><a href="{{url('mobile/add-client-notes')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}"></a></li>
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
                           <h2><?=date('d M, Y', strtotime($client_details->created_on));?><strong><?=date('h:m A', strtotime($client_details->created_on));?></strong></h2>
                           <label><?=$client_details->client_name;?></label>
                           <span><i class="fa fa-envelope"></i><?=$client_details->client_email;?> </span>
                           <p><?=$client_details->client_note;?> <!-- <a>show more</a> -->
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