@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
<div class="container-custm">
   <div class="upper-cmnsection">
      <div class="heading-uprlft">Recuring Booking Detail</div>
   </div>
   <div class="leftpan">
      <div class="left-menu">
         <!--<ul>
            <li><a href="{{url('booking-list/all')}}" > All</a></li>
            <li><a href="{{url('booking-list/current')}}" > Current</a></li>
            <li><a href="{{url('booking-list/day')}}" > Next 3 Days</a> </li>
            <li><a href="{{url('booking-list/month')}}"> Last 1 Month</a></li>
         </ul>-->
      </div>
   </div>
   <div class="rightpan">
      <div class="relativePostion">
         <div class="showDekstop clearfix">
            <div class="bluebg break20px namedate">
               <span><?=date('l', strtotime($appointment_details->date));?>, <?=date('M d, Y', strtotime($appointment_details->date));?></span>
               <span>Client: <?=$appointment_details->client_name;?></span>
            </div>
            <div class="whitebox border-box">
               <div class="staffDetail">
                  <span>Booking Id: <?=$appointment_details->order_id;?></span>
                  <p><label>With:</label> <?php if($appointment_details->staff_name!='') echo $appointment_details->staff_name; else echo 'Not Assigned'; ?></p>
                  <span class="bluetxt"><?=$appointment_details->currency;?> <?=$appointment_details->cost;?></span>
               </div>
               <div class="staffInside">
                  <h3><strong><?=$appointment_details->service_name;?></strong></h3>
                  <h6>Service Time: <?=$appointment_details->start_time;?> - <?=$appointment_details->end_time;?></h6>
                  <?php if(!empty($recurring_booking_list)) { ?>
                  <div class="recuring-bookingtble">
                     <table width="100%" border="0" class="table table-bordered table-custom1 table-bh tableBhMobile">
                        <thead>
                           <tr>
                              <th style="text-align:left">Booked Date</th>
                              <th style="text-align:left">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php foreach($recurring_booking_list as $recurring_booking) { ?>
                           <tr>
                              <td><?=date('l', strtotime($recurring_booking->date));?>, <?=date('M d, Y', strtotime($recurring_booking->date));?></td>
                              <td>
                                 <?php if($recurring_booking->status != 2) { ?> 
                                  <a href="javscript:void(0);" data-appointment-id="<?php echo $recurring_booking->appointment_id;?>" id="<?php echo $recurring_booking->appointment_id;?>" class="btn btn-primary btn-xs reschedule-appoinment">Reschedule</a>
                                  <a href="javscript:void(0);" data-appointment-id="<?php echo $recurring_booking->appointment_id;?>" class="btn btn-danger btn-xs cancel_appointment">Cancel</a>
                                 <?php } else { ?>
                                  <a href="javscript:void(0);" data-appointment-id="<?php echo $recurring_booking->appointment_id;?>" class="btn btn-danger btn-xs">Cancelled</a>
                                 <?php } ?>
                              </td>
                           </tr>
                        <?php } ?>
                        </tbody>
                     </table>
                  </div>
                  <?php } ?>
                  <p class="addReadMore showlesscontent"><span>Notes :</span> <?=$appointment_details->note;?> </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection

@section('custom_js')
<script >
    $(document).ready(function() {
      $('.cancel_appointment').click(function(){
        var target = $(this);
        swal({
        title: "Are you sure?",
        text: "Once cancelled, you can not modify the details of the appointment!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, not now!",
        closeOnConfirm: false,
        closeOnCancel: true
        },function(isConfirm){
            if (isConfirm){
                var appointment_id = target.data('appointment-id');
                var data = addCommonParams([]);
                data.push({
                    name: 'appoinment_id',
                    value: appointment_id
                });
                $.ajax({
                    url: baseUrl + "/api/appoinment-cancel", // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                    dataType: "json",
                    success: function(response) // A function to be called if request succeeds
                    {
                        //console.log(response);
                        if (response.response_status == '1')
                        {
                            swal({title: "Success", text: response.message, type: "success"},
                                function(){ 
                                    location.reload();
                                }
                            );
                        } else
                        {
                            swal("Error", "Somthing wrong try again later.", "error");
                        }
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    },
                    complete: function()
                    {
                        //$('.animationload').hide();
                    }
                });
            }
        });

      });
    });
</script>
@endsection
