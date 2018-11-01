@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Membership Plan</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="row">
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
            <div class="col-lg-12">
               <!-- <form class="form-inline"> -->
                  <div class="plan ">
                     <a href="#" class="arrow-left"><img src="{{asset('public/assets/website/images/arrowprev.gif')}}"></a>
                     <a href="#"  class="arrow-right"><img src="{{asset('public/assets/website/images/arrownxt.gif')}}"></a>     
                     <table>
                        <tr>
                           <td>Monthly</td>
                           <td><label class="switch-m">
                              <input type="checkbox" class="change-plan-duration">
                              <span class="slider-m round-m"></span> </label>
                           </td>
                           <td>Yearly</td>
                        </tr>
                     </table>
                  </div>
                  <div class="planList">
                     <?php
                     foreach ($plan_list as $key => $value) 
                     {
                     ?>
                     <div class="listItem">
                        <h4><?=$value->plan_name;?></h4>
                        <span><?=$value->plan_tag_line;?></span>
                        <h5>
                           <span id="get-plan-list-<?=$value->plan_id;?>">
                              <label>$<?=number_format($value->price,0);?><sup>00</sup></label>
                              /Month
                           </span>
                        </h5>
                        <?php
                        if($check_plan_id->subscription_id!=$value->plan_id)
                        {
                        ?>
                        <button class="btn btn-large btn-green choose-plan" id="<?=$value->plan_id;?>">Choose Plan</button>
                        <?php
                        }
                        ?>
                        <?=$value->description;?>
                     </div>
                     <?php
                     }
                     ?>
                  </div>
                  <!-- <a class="btn btn-block btn-mobile btn-size showMobile">Select Plan</a> -->
               <!-- </form> -->
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
