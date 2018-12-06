@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Bookings</h1>
  <ul>
    <li>&nbsp;<!-- <img src="images/mobile-serach.png" /> --> </li>
  </ul>
</header>
<main>
  <div class="showMobile">
    <div class="clientHead">
      <h3><?=$client_name;?></h3>
      <!-- <a><i class="fa fa-angle-right"></i></a> --> </div>
    <ul class="clientSchedule">
      <li><a href="{{url('mobile/client-booking-list/all')}}/<?=$client_id;?>" class="<?=$duration=='all' ? 'active' : ''; ?>">Current</a> </li>
      <li><a href="{{url('mobile/client-booking-list/day')}}/<?=$client_id;?>" class="<?=$duration=='day' ? 'active' : ''; ?>">Next 3 Days</a> </li>
      <li><a href="{{url('mobile/client-booking-list/month')}}/<?=$client_id;?>" class="<?=$duration=='month' ? 'active' : ''; ?>">Last 1 Month</a> </li>
    </ul>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <?php
           if($appoinment_list)
           {
              foreach ($appoinment_list as $key => $value)
              {
              ?>
              <div class="custm-share">
                <div class="bluebg break20px namedate"> <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span> </div>
                <div class="dropdown btn-res">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-share"
                      aria-hidden="true"></i></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="JavaScript:Void(0);" class="reschedule-appoinment" id="<?=$value->appointment_id;?>">Reschedule</a></li>
                    <li><a href="JavaScript:Void(0);" class="cancel-appoinment" id="<?=$value->appointment_id;?>">Cancel </a></li>
                  </ul>
                </div>
              </div>

              <div class="whitebox border-box">
                 <div class="staffDetail">
                    <span><label>With</label> <?=$value->staff_name;?></span>
                    <p><?=$value->start_time;?> - <?=$value->end_time;?></p>
                    <span class="bluetxt"><?=$value->currency;?><?=$value->cost;?></span>
                 </div>
                 <div class="staffInside">
                    <h6><?=$value->service_name;?></h6>
                    <p><span>Notes :</span> <?=$value->note;?> <!-- <a>more</a> --></p>
                 </div>
              </div>
           <?php
                  }
               }
               else
               {
               ?>
               <div class="bluebg break20px namedate">
                  No data found.
               </div>
               <?php
               }
               ?>
         
          <!--<a class="btn btn-block btn-mobile btn-size showMobile">Reschedule</a>-->
        </div>
      </div>
    </div>
  </div>
</main>

@endsection


@section('custom_js')
<script type="text/javascript">
$(".cancel-appoinment").click(function (e) {
    e.preventDefault();
    let data = addCommonParams([]);
    let id = $(this).attr('id');
    //alert(id);
    data.push({name:'appoinment_id',value:id});
    if(id)
    {
        swal({
          title: "Are you sure?",
          text: "Once cancelled, you will loose all the details of the appointment!",
          confirmButtonColor: '#3085d6',
          //cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm',
          //allowOutsideClick: false
          }).then(function() {
             $.ajax({
                url: baseUrl2+"/api/appoinment-cancel", 
                type: "POST", 
                data: data, 
                dataType: "json",
                success: function(response) 
                {
                    console.log(response);
                    $('.animationload').hide();
                    if(response.result=='1')
                    {
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                $('#myModalAppointmentContent').modal('hide');
                                location.reload();
                            }
                        );  
                    }
                    else
                    {
                        swal("Error", response.message, "error");
                    }
                },
                beforeSend: function()
                {
                    $('.animationload').show();
                },
                complete: function()
                {
                    $('#myModalAppointmentContent').modal('hide');
                }
            });
        });
    }
    else
    {
        swal("Error", response.message , "error");
    }
});
</script>
@endsection