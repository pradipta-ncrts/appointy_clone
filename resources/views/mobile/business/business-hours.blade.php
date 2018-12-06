@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Business Hours</h1>
   <ul>
      &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
         <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row container-fixed">
         <div class="col-lg-12 nopadding">
            <form class="form-inline">
               <div class="headRow headingBar padding15px" id="businessHours">
                  <a><img src="{{asset('public/assets/mobile/images/arrowprev.gif')}}" /> </a>
                  <h1>Business Hours</h1>
                  <a><img src="{{asset('public/assets/mobile/images/arrownxt.gif')}}" /> </a> 
               </div>
               <div class="headRow">
                  <div class="padding15px clearfix">
                     <div id="scheduleBar"> <span>Current Schedule</span> <span><a href="#">Add or Update Schedule</a></span> </div>
                     <div class="bhchildmobile showMobile">
                        <div class="panel-group custm-tab-hrs" id="accordion">
                           <?php
                           $dowMap = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');

                           foreach ($staff_list as $key => $value)
                           {
                           ?>
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <div class="bhInside"> <img src="{{asset('public/assets/mobile/images/business-hours/blue-user.png')}}" />
                                       <label id="name"><?=$value->full_name;?></label>
                                    </div>
                                    <!-- <div class="time-slot">30 mins - 1 hr</div> -->
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$value->staff_id;?>"><i class="fa fa-angle-down"></i></a> 
                                 </h4>
                              </div>
                              <div id="collapse<?=$value->staff_id;?>" class="panel-collapse collapse">
                                 <?php
                                 foreach ($service_list as $key => $srv_lst)
                                 {
                                 ?>
                                 <div class="panel-body">
                                    <div class="bhscheduleInside">
                                       <h2><?=$srv_lst->service_name;?></h2>
                                       <p><span>Duration</span>: <?=$srv_lst->duration;?> mins</p>
                                    </div>
                                    <div class="custm-tab team-memtab">
                                       <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#home">Current Schedule</a></li>
                                       </ul>
                                       <div class="tab-content">
                                          <div id="home" class="tab-pane fade in active">
                                             <div class="tableBH-table">
                                                <table class="table table-bordered table-custom table-bh tableBhMobile" >
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <span>Dental Consultation (1h)</span>
                                                            <label>Scale: <strong>30 mins</strong> </label>
                                                            <img src="{{asset('public/assets/mobile/images/business-hours/tbl-delete.png')}}" />
                                                            <div class="clearfix"></div>
                                                         </td>
                                                         <?php
                                                         for($i=0;$i<7;$i++)
                                                         {
                                                            $day_no = $i+1;
                                                            $avability_list = App\Http\Controllers\BaseApiController::avability_list($value->staff_id, $srv_lst->service_id, $day_no);
                                                         ?>
                                                         <td data-column="<?=$dowMap[$i];?>">
                                                            <?php
                                                            if(!empty($avability_list))
                                                            {
                                                            ?>
                                                            <ul>
                                                               <li>from: <strong><?=$avability_list->start_time;?></strong></li>
                                                               <li>to: <strong> <?=$avability_list->end_time;?></strong></li>
                                                            </ul>
                                                            <a href="" class="update_user_shedule" data-staff-id="<?=$value->staff_id;?>" data-service-id = "<?=$srv_lst->service_id;?>" data-day-no = "<?=$day_no;?>" data-start-date = "<?=$avability_list->start_time;?>" data-end-date = "<?=$avability_list->end_time;?>"><img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" /></a>
                                                            <div class="clearfix"></div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="" class="update_user_shedule" data-staff-id="<?=$value->staff_id;?>" data-service-id = "<?=$srv_lst->service_id;?>" data-day-no = "<?=$day_no;?>"><img src="{{asset('public/assets/mobile/images/business-hours/tbl-edit.png')}}" /></a>
                                                            <div class="clearfix"></div>
                                                            <?php
                                                            }
                                                            ?>
                                                            
                                                         </td>
                                                         <?php
                                                         }
                                                         ?>
                                                         
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
                           <?php
                           }
                           ?>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</main>

<div class="modal fade" id="myModalregularShedule" role="dialog">
   <div class="modal-dialog modal-md">
      <div class="modal-content new-modalcustm">
      <form name="update_staff_availability_form" id="update_staff_availability_form" method="post" action="{{url('api/update_staff_availability_form')}}">
         <input type="hidden" name="stuff_id" value="" id="update_staff_availability_staff_id">
         <input type="hidden" name="service_id" value="" id="update_staff_availability_service_id">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title">Edit Schedule</h4>
         </div>
         <div class="modal-body clr-modalbdy">
            <div class="regular-frmbx">
              <?php
              $weekdays = array('1'=>'MON','2'=>'TUE','3'=>'WED','4'=>'THU','5'=>'FRI','6'=>'SAT','7'=>'SUN');
              foreach($weekdays as $key=>$val){
              ?>
                  <div class="row">
                      <div class="col-md-3"> <input class="styled-checkbox-update" name="day[]" id="styled-checkbox-update-{{$key}}" type="checkbox" value="{{$key}}"> <label for="styled-checkbox-update-{{$key}}">{{$val}}</label></div>
                      <div class="col-md-4">
                          <div class="input-group">
                              <span class="input-group-addon"></span>
                              <div class="form-group nomarging color-b" >
                              <!--<select >
                                  <option>Start Time</option>
                              </select>-->
                              <input class="form-control availability_start_time" name="availability_update_start_time[]" id="availability_update_start_time_{{$key}}" type="text" value="" disabled="">
                              <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-1">
                          <div class="tocls">To</div>
                      </div>
                      <div class="col-md-4">
                          <div class="input-group">
                              <span class="input-group-addon"></span>
                              <div class="form-group nomarging color-b" >
                              <!--<select >
                                  <option>End Time</option>
                              </select>-->
                              <input class="form-control availability_end_time" name="availability_update_end_time[]" id="availability_updaet_end_time_{{$key}}" type="text" value="" disabled="">
                              <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <br>
              <?php
              }
              ?>
              <!-- <div class="row">
                  <div class="col-md-12">
                     <div class="mlf-30" id="select_service" style="cursor:pointer"> <span class="child-outline child-outline--dark"></span> <span id="select_services">SELECT SERVICE<span>  </div>
                     <input type="hidden" name="service_ids" id="service_ids" value="">
                  </div>
               </div> -->

            </div>
         </div>
         <div class="modal-footer">
            <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">ADD</button> </div>
         </div>
      </form>
      </div>
   </div>
   </div>
@endsection
@section('custom_js')
<script type="text/javascript">
$(document).on('click','.update_user_shedule',function(e){
   e.preventDefault();
   $('#update_staff_availability_form').trigger("reset");
   var staff_id = $(this).data('staff-id');
   var service_id = $(this).data('service-id');
   var day_no = $(this).data('day-no');
   var start_date = $(this).data('start-date');
   var end_date = $(this).data('end-date');

   $("#update_staff_availability_staff_id").val(staff_id);
   $("#update_staff_availability_service_id").val(service_id);

   var data = addCommonParams([]);
    //alert(serviceid);
   data.push({name:'service_id', value:service_id},
                {name:'staff_id', value:staff_id});
   $.ajax({
        url: baseUrl2+"/api/edit_service_list_staff", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            $('.animationload').hide();
            if(response.result=='1')
            {
               console.log(response.message);
               $("#myModalregularShedule").modal('show');
               var i;
               for (i = 0; i < response.message.length; i++)
               { 
                  $("#styled-checkbox-update-"+response.message[i].day).prop('checked', true);
                  //$("#styled-checkbox-update-"+response.message[i].day).trigger('click');
                  $("#availability_update_start_time_"+response.message[i].day).prop('disabled', false);
                  $("#availability_update_start_time_"+response.message[i].day).val(response.message[i].start_time);
                  $("#availability_updaet_end_time_"+response.message[i].day).prop('disabled', false);
                  $("#availability_updaet_end_time_"+response.message[i].day).val(response.message[i].end_time);
               }
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            $('.animationload').show();
        }
   });
});

$('#update_staff_availability_form').validate({
   submitHandler: function(form) {
   var data = $(form).serializeArray();
   data = addCommonParams(data);
   
   //console.log(data);
   $.ajax({
       url: form.action,
       type: form.method,
       data: data,
       dataType: "json",
       success: function(response) {
           //console.log(response); //Success//
           if (response.response_status == 1) {
               //$(form)[0].reset();
               //$('#myModalregular').modal('hide');
               swal('Success!', response.response_message, 'success');
               location.reload();
           } else {
               swal('Sorry!', response.response_message, 'error');
           }
       },
       beforeSend: function() {
           $('.animationload').show();
       },
       complete: function() {
           $('.animationload').hide();
       }
   });
}
});

</script>
@endsection