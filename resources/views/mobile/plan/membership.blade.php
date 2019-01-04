@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Membership</h1>
   <ul>
    &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
      <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
               <div class="headRow headingBar padding15px showDekstop">
                  <div>
                     <h1>Membership Plan</h1>
                  </div>
                  <div class="text-right">
                     <button type="submit" class="btn btn-custom">Save</button>
                     <button class="popup-button showDekstop" type="button" onclick="ShowPopup(this);"><img src="{{asset('public/assets/mobile/images/plus.png')}}" /> </button>
                  </div>
               </div>
               <div class="row showMobile break20px">
                  @if(Session::has('payment_error'))

                     <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                         <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('payment_error')}}</p>
                     </div>
                  @endif

                  @if(Session::has('payment_success'))

                     <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('payment_success')}}</p>
                    </div>
                  
                  @endif
                  <div class="col-xs-12" id="planMobile">
                     <?php
                     foreach ($plan_list as $key => $value) 
                     {
                     ?>
                     <div class="whitebox <?=$key==0 ? "active" : ""; ?>" onclick="changePlan(this,<?=$value->plan_id;?>);">
                        <div class="pricecheck"></div>
                        <h4><?=$value->plan_name;?></h4>
                        <h5><?=$value->plan_tag_line;?></h5>
                        <h6><span>$<?=number_format($value->price,0);?><sup>00</sup></span>/Month</h6>
                     </div>
                     <?php
                     }
                     ?>
                  </div>
               </div>
               <?php
               foreach ($plan_list as $key => $value) 
               {
               ?>
               <div id="plandetails<?=$value->plan_id;?>" class="planlist"style="<?=$key==0 ? '' : 'display: none;';?>">
                  <div id="freeplan" class="padding15px">
                     <label class="showMobile">Your Current Membership</label>
                     <h2><?=$value->plan_name;?></h2>
                     <span><?=$value->plan_tag_line;?></span> 
                     <?php
                        if(isset($check_plan_id->subscription_id) && $check_plan_id->subscription_id)
                        {
                           if($check_plan_id->subscription_id!=$value->plan_id)
                           {
                        ?>
                        <button class="btn showMobile choose-plan" id="<?=$value->plan_id;?>">Choose Plan</button>
                        <?php
                           }
                           else
                           {
                           ?>
                           <button class="btn showMobile choose-plan" id="" disabled="">Subscribed</button>
                           <?php
                           }
                        }
                        else
                        {
                        ?>
                        <button class="btn showMobile choose-plan" id="<?=$value->plan_id;?>">Choose Plan</button>
                        <?php
                        }
                        ?>
                     <!-- <button class="btn showMobile">Compare Plans</button>    -->   
                  </div>
                  <div class="showMobile whitebox" id="listItem">
                     <?=$value->description;?>
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
<script type="text/javascript">
function changePlan(obj,id){
   $('.animationload').show();
   $('.planlist').hide();
   $('#plandetails'+id).show();
   $(obj).addClass('active');
   $('#planMobile .active').not($(obj)).removeClass('active');
   $('.animationload').hide();
}
</script>

@endsection