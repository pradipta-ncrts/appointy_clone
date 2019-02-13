@extends('../layouts/client/master_template_client')
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
   <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_details->client_id;?>">
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
                                  <a href="javscript:void(0);" data-appointment-id="<?php echo $recurring_booking->appointment_id;?>" class="btn btn-primary btn-xs reschedule-appoinment">Reschedule</a>
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

<div class="modal fade" id="myModaladdappoinmentReschedule" role="dialog">
    <div class="modal-dialog add-pop">
    <!-- Modal content--> 
    <div class="modal-content new-modalcustm">
        <form name="reschedule_appoitment" id="reschedule_appoitment" method="post" action="{{ url('api/reschedule_appointment_process') }}" enctype="multipart/form-data">
            <input type="hidden" name="appointment_id" value="" id="reshedule_appointment_id">
            <input type="hidden" name="service_id" value="" id="reshedule_service_id">
            <input type="hidden" name="staff_id" id="reshedule_staff_id" value="">
            <input type="hidden" name="client_id" value="<?php echo $client_details->client_id;?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title"> Reschedule Appointments</h4>
            </div>
            <div class="modal-body clr-modalbdy">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <div class="input-group" id="reshedule_date_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="reshedule_appointmentdate" type="text" class="form-control" name="booking_date" placeholder="Date" style="position: relative; z-index: 100000;"> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <div class="input-group" id="reshedule_appointmenttime_error"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input id="reshedule_appointmenttime" type="text" class="form-control" name="booking_time" placeholder="Time"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center"> 
                    <input type="submit" id="submit_reschedule_appointmentm_form" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" name="submit" value="submit">
                    <!-- <button type="button" >Submit</button> --> </div>
            </div>
        </form>
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
                    var client_id = $('#client_id').val();
                    //alert(appointment_id);
                    $.ajax({
                        url: baseUrl + "/api/cancel_appointment_process", // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: {appointment_id: appointment_id, client_id: client_id}, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
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


        $('#reschedule_appoitment').validate({
            ignore: ":hidden:not(.selectpicker)",
            rules: {
                reshedule_date: {
                    required: true
                },
                reshedule_appointmenttime: {
                    required: true
                },
            },
            messages: {
                reshedule_date: {
                    required: 'Date is required'
                },
                reshedule_appointmenttime: {
                    required: 'Time is required'
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "booking_date") {
                    error.insertAfter($('#reshedule_date_error'));
                } else if (element.attr("name") == "booking_time") {
                    error.insertAfter($('#reshedule_appointmenttime_error'));
                }
            },

            submitHandler: function(form) {
                var data = $(form).serializeArray();
                console.log(data);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data:data ,
                    dataType: "json",
                    success: function(response) {
                    console.log(response);
                    if(response.result=='1')
                    {
                        $("#myModaladdappoinmentReschedule").modal('hide');
                        $('.animationload').hide();
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );
                        //swal("Success!", response.message, "success")
                        /*setTimeout(function()
                        {
                            window.location.reload();
                        
                        }, 1000);*/
                    }
                    else
                    {
                        swal("Error", response.message , "error");
                    }
                    },
                    beforeSend: function(){
                        $('.animationload').show();
                    },
                    complete: function(){
                        $('.animationload').hide();
                    }
                });
            }
        });
    
    });

    $(document).on("click", '.reschedule-appoinment', function(e) { 
        var appointment_id = $(this).data('appointment-id');
        var client_id = $('#client_id').val();
        //alert(client_id);
        if(appointment_id)
        {
            $.ajax({
                url: baseUrl+"/api/client_appointment_details_by_appointment_id", 
                type: "POST", 
                data: {appointment_id: appointment_id, client_id: client_id}, 
                dataType: "json",
                success: function(response) 
                {
                    console.log(response);          
                    let appointment_id = response.appoinment_details.appointment_id;
                    let service_id = response.appoinment_details.service_id;
                    let date = response.appoinment_details.appoinment_raw_date;
                    let time = response.appoinment_details.appoinment_raw_time;
                    let staff_id = response.appoinment_details.staff_id;
                    $("#reshedule_appointment_id").val(appointment_id);
                    $("#reshedule_service_id").val(service_id);
                    $("#reshedule_appointmentdate").val(date);
                    $("#reshedule_appointmenttime").val(time);
                    $("#reshedule_staff_id").val(staff_id);
                    $('#myModaladdappoinmentReschedule').modal('show');
                    $('.animationload').hide();
                    
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
        }
        else
        {
            swal("Error", response.message , "error");
        }
    });
</script>
@endsection
