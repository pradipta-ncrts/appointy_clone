@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Feedback list</h1>
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
                      <?php
                      if(!empty($review_list))
                      {
                          foreach ($review_list as $key => $value)
                          {
                      ?>
                        <div class="whitebox">
                           <h2><?=date('d M, Y', strtotime($value->created_on));?><strong><?=date('h:m A', strtotime($value->created_on));?></strong></h2>
                           <label><?=$value->client_name;?></label>
                           <span><i class="fa fa-envelope"></i><?=$value->client_email;?> </span>
                           <p class="addReadMore showlesscontent"><?=$value->feedback;?> </p>
                        </div>
                      <?php
                          }
                      }
                      else
                      {
                      ?>
                      <div class="whitebox">
                           <h2>No data found.</h2>
                        </div>
                      <?php
                      }
                      ?>
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