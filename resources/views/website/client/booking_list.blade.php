@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection
@section('custom_css')
<style type="text/css">
   .namedate {
   border-radius: 5px;
   color: #fff;
   font-size: 17px;
   display: flex;
   justify-content: space-between;
   margin-bottom: 10px;padding: 8px 10px;background: #5da7d4;
   }
   .border-box {
   border: 1px solid #ccc;
   border-radius: 5px;
   padding: 15px 0;
   margin-bottom: 10px;
   }
   .whitebox {
   background: #fff;
   position: relative;
   padding: 10px;
   position: relative;
   margin-bottom: 10px;
   }
   .staffDetail {
   padding: 0 10px 10px;
   margin-bottom: 12px;
   border-bottom: 1px solid #cac8c8;
   display: flex;
   justify-content: space-between;
   font-size: 14px;
   }
   .staffDetail p {
   color: #0645a3;
   font-weight: bold;
   }
   .staffDetail span.bluetxt {
   color: #5da7d4;
   }
   .staffInside {
   padding: 0 10px;
   }
   .staffInside h6 {
   padding-bottom: 10px;
   font-size: 16px;
   }
   .staffInside p {
   color: #000;
   font-size: 14px;
   line-height: 21px;
   }
   .addReadMore.showlesscontent .SecSec,
   .addReadMore.showlesscontent .readLess {
   display: none;
   }
   .addReadMore.showmorecontent .readMore {
   display: none;
   }
   .addReadMore .readMore,
   .addReadMore .readLess {
   margin-left: 2px;
   color: blue;
   cursor: pointer;
   }
   .addReadMoreWrapTxt.showmorecontent .SecSec,
   .addReadMoreWrapTxt.showmorecontent .readLess {
   display: block;
   }
</style>
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking List</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <!-- <input type="text" id="booking_search" class="search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>  -->
                  </div>
               </div>
            </div>
            <a href="{{url('client/recurring-booking-list/'.$param.'/all')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-refresh" aria-hidden="true"></i> Recurring Bookings</a>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{url('client/booking-list/'.$param.'/all')}}" class="<?=$duration=='all' ? 'active' : ''; ?>"> All</a></li>
               <li><a href="{{url('client/booking-list/'.$param.'/current')}}" class="<?=$duration=='current' ? 'active' : ''; ?>"> Current</a></li>
               <li><a href="{{url('client/booking-list/'.$param.'/day')}}" class="<?=$duration=='day' ? 'active' : ''; ?>"> Next 3 Days</a> </li>
               <li><a href="{{url('client/booking-list/'.$param.'/month')}}" class="<?=$duration=='month' ? 'active' : ''; ?>"> Last 1 Month</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class=" showDekstop clearfix">
               <div id="filter_data">
               <input type="hidden" id="client_id" value="<?php echo $client_details->client_id;?>">
               <?php
               //echo '<pre>'; print_r($client_details);
               if(!empty($appoinment_list))
               {
                  foreach ($appoinment_list as $key => $value)
                  {
                  ?>
                  
                  <?php /* <div class="bluebg break20px namedate">
                        <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span>
                        <span><?=$value->client_name;?></span>
                        <?php if($value->status != 2) { ?>
                        <div class="dropdown btn-res">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);" class="reschedule-appoinment" data-appointment-id="<?php echo $value->appointment_id;?>">Reschedule</a></li>
                                <li><a href="javascript:void(0);" class="cancel-appoinment" data-appointment-id="<?php echo $value->appointment_id;?>">Cancel </a></li>
                            </ul>
                        </div>
                        <?php } else { ?>
                        <button class="btn btn-danger btn-xs">Cancelled</button>
                        <?php } ?>
                    </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> <?=$value->staff_name?$value->staff_name:'N/A';?></span>
                        <p><?=$value->start_time;?> - <?=$value->end_time;?></p>
                        <span class="bluetxt"><?=$value->currency;?><?=$value->cost;?></span>
                     </div>
                     <div class="staffInside">
                        <h6><?=$value->service_name;?></h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> <?=$value->note;?> </p>
                     </div>
                  </div> */ ?>

                    
                        <div class="bluebg break20px namedate">
                            <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span>
                            <span>Client: <?=$value->client_name;?></span>
                            <?php if($value->status != 2) { ?>
                                <div class="dropdown btn-res">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);" class="reschedule-appoinment" data-appointment-id="<?php echo $value->appointment_id;?>">Reschedule</a></li>
                                        <li><a href="javascript:void(0);" class="cancel-appoinment" data-appointment-id="<?php echo $value->appointment_id;?>">Cancel </a></li>
                                    </ul>
                                </div>
                                <?php } else { ?>
                                <button class="btn btn-danger btn-xs">Cancelled</button>
                            <?php } ?>
                        </div>
                        <a href="{{ url('client/booking-details/'.$param.'/'.$value->order_id) }}">
                        <div class="whitebox border-box">
                            <div class="staffDetail">
                            <span>Booking Id: <?=$value->order_id;?></span>
                            <p>
                                <?php if($value->staff_name!='') { ?> <label>With</label> <?=$value->staff_name;?>
                                <?php } else { ?>
                                <label>With</label>: Not Assigned
                                <?php } ?>
                            </p>
                            <span class="bluetxt"><?=$value->currency;?> <?=$value->total_payable_amount;?></span>
                            </div>
                            <div class="staffInside">
                            <h6><?=$value->service_name;?></h6>
                            <h4 style="padding-bottom: 10px;">Service Time: <?=$value->start_time;?> - <?=$value->end_time;?></h4>
                            <p class="addReadMore showlesscontent"><span>Notes :</span> <?=$value->note;?> </p>
                            </div>
                        </div>
                    </a>          

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
<script>
$(document).ready(function(){
    $('#booking_search').click(function(){
        $('#staffListModal').modal('show');
    });


    $(".staff_id").on('click', (function() {
        //e.preventDefault();
        var staff_id = $(this).val();
        var duration = $(this).data('duration');
        var data = addCommonParams([]);
        data.push({ name:'staff_id', value:staff_id }, { name:'duration', value:duration });
        //console.log(data);
        $.ajax({
                url: baseUrl+"/api/appoinment_list_mobile", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                dataType: "json",
                success: function(response) // A function to be called if request succeeds
                {
                    //console.log(response);
                    //alert(response.response_status);
                    var html = '';
                    if(response.response_status=='1')
                    {
                        if(response.appoinment_list.length>0)
                        {
                            for(i = 0;i<response.appoinment_list.length;i++)
                            {
                                var d = new Date(response.appoinment_list[i].date);
                                var curr_date = d.getDate();
                                var curr_month = d.getMonth();
                                var curr_year = d.getFullYear();
                                var day = d.getDay();
                                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                                html += '<div class="bluebg break20px namedate"><span> ' + weekday[day] + ', ' + monthNames[curr_month] + ' ' + curr_date + ', ' + curr_year + '</span><span>' + response.appoinment_list[i].client_name + '</span><div class="dropdown btn-res"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share" aria-hidden="true"></i></button><ul class="dropdown-menu dropdown-menu-right"><li><a href="JavaScript:Void(0);" class="reschedule-appoinment" id="' + response.appoinment_list[i].appointment_id + '">Reschedule</a></li><li><a href="JavaScript:Void(0);" class="cancel-appoinment" data-appointment-id="' + response.appoinment_list[i].appointment_id + '">Cancel </a></li></ul></div></div><div class="whitebox border-box"><div class="staffDetail"><span><label>With</label> ' + response.appoinment_list[i].staff_name + '</span><p>' + response.appoinment_list[i].start_time + ' - ' + response.appoinment_list[i].end_time + '</p><span class="bluetxt">' + response.appoinment_list[i].currency + response.appoinment_list[i].cost + '</span></div><div class="staffInside"><h6>' + response.appoinment_list[i].service_name + '</h6><p><span>Notes :</span>' + response.appoinment_list[i].note + ' </p></div></div>';
                            }
                        }
                        else
                        {
                            html += '<div class="bluebg break20px namedate">No data found.</div>';
                        }
                        $('#filter_data').html(html);
                        $('.animationload').hide();
                        $('#staffListModal').modal('hide');
                    }
                    else
                    {
                        swal("Error", "Somthing wrong try again later." , "error");
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

   
    }));


    $('.cancel-appoinment').on('click',(function(){
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
            if(isConfirm){
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

    }));


    $(document).on("click", '.reschedule-appoinment', function(e) { 
        var appointment_id = $(this).data('appointment-id');
        var client_id = $('#client_id').val();
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

})
</script>
@endsection