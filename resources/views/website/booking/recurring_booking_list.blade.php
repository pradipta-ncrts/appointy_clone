@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')


<div class="body-part">
   <div class="container-custm">
   
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Recurring Booking List</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <input type="text" id="booking_search" class="search-query form-control" placeholder="Search">
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span> 
                  </div>
               </div>
            </div>
            <a href="{{url('booking-list/all')}}" class="btn btn-info btn-sm pull-right"><i class="fa fa-refresh" aria-hidden="true"></i> Bookings</a>
         </div>
      </div> 
      
      <div class="leftpan">
          <div class="left-menu">
            <!--<ul>
                <li><a href="{{url('recurring-booking-list/all')}}" > All</a></li>
                <li><a href="{{url('recurring-booking-list/current')}}" > Current</a></li>
                <li><a href="{{url('recurring-booking-list/day')}}" > Next 3 Days</a> </li>
                <li><a href="{{url('recurring-booking-list/month')}}"> Last 1 Month</a></li>
            </ul>-->
          </div>
      </div>   
      
      <div class="rightpan">
        <div class="relativePostion">
            <div class="showDekstop clearfix">
              <div id="filter_data">
                <?php
                  if(!empty($appoinment_list))
                  {
                    foreach ($appoinment_list as $key => $value)
                    {
                ?>
                  <div class="bluebg break20px namedate">
                    <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span>
                    <span>Client: <?=$value->client_name;?></span>
                  </div>
                  <a href="{{ url('recurring-booking-details/'.$value->order_id) }}">
                    <div class="whitebox border-box">
                      <div class="staffDetail">
                        <span>Booking Id: <?=$value->order_id;?></span>
                        <p>
                          <?php if($value->staff_name!='') { ?> <label>With</label> <?=$value->staff_name;?>
                          <?php } else { ?>
                            <a class="badge assign_staff" data-order-id="<?=$value->order_id;?>" >Assign Staff <i class="fa fa-plus" aria-hidden="true"></i></a>
                          <?php } ?>
                        </p>
                        <span class="bluetxt"><?=$value->currency;?> <?=$value->cost;?></span>
                      </div>
                      <div class="staffInside">
                        <h6>Service Time: <?=$value->start_time;?> - <?=$value->end_time;?></h6>
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

<div class="modal fade" id="staffListModal" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content--> 
      <div class="modal-content new-modalcustm">
         <form name="" id="" method="post" action="" enctype="multipart/form-data">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">Staff List</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div class="notify" >
                  <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                  <?php
                     foreach ($staff_list as $key => $value)
                     {
                     ?>
                  <div class="user-bkd break20px">
                     <?php
                        if($value->staff_profile_picture)  
                        {
                        ?>
                     <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                     <?php
                        }
                        else
                        {
                        ?>
                     <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                     <?php
                        }
                        ?>
                     <h2><?=$value->full_name;?>
                        <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                     </h2>
                     <div class="row">
                        <div class="check-ft">
                           <div class="form-group">
                              <!--<input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">-->
                              <input type="radio" class="staff_id" data-duration="{{ Request::segment(2) }}" name="staff_id" value="<?=$value->staff_id;?>"  />
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>


<div class="modal fade" id="assignStaffModal" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content--> 
      <div class="modal-content new-modalcustm">
         <form name="" id="" method="post" action="" enctype="multipart/form-data">
         <input type="hidden" name="appointment_order_id" id="appointment_order_id" value="">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">Staff List</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div class="notify" >
                  <input type="text" id="assignstaffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                  <?php
                     foreach ($staff_list as $key => $value)
                     {
                     ?>
                  <div class="user-bkd break20px">
                     <?php
                        if($value->staff_profile_picture)  
                        {
                        ?>
                     <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                     <?php
                        }
                        else
                        {
                        ?>
                     <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                     <?php
                        }
                        ?>
                     <h2><?=$value->full_name;?>
                        <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                     </h2>
                     <div class="row">
                        <div class="check-ft">
                           <div class="form-group">
                              <!--<input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">-->
                              <input type="radio" class="assign_staff_id" name="staff_id" value="<?=$value->staff_id;?>"  />
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('custom_js')
<script >
    $(document).ready(function() {
        $('#booking_search').click(function() {
            $('#staffListModal').modal('show');
        });


        $(".staff_id").on('click', (function() {
            //e.preventDefault();
            var staff_id = $(this).val();
            var duration = $(this).data('duration');
            var data = addCommonParams([]);
            data.push({
                name: 'staff_id',
                value: staff_id
            }, {
                name: 'duration',
                value: duration
            });
            //console.log(data);
            $.ajax({
                url: baseUrl + "/api/recurring_appoinment_list_mobile", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                dataType: "json",
                success: function(response) // A function to be called if request succeeds
                {
                    //console.log(response);
                    //alert(response.response_status);
                    var html = '';
                    if (response.response_status == '1')
                    {
                        if (response.appoinment_list.length > 0)
                        {
                            for (i = 0; i < response.appoinment_list.length; i++)
                            {
                                var d = new Date(response.appoinment_list[i].date);
                                var curr_date = d.getDate();
                                var curr_month = d.getMonth();
                                var curr_year = d.getFullYear();
                                var day = d.getDay();
                                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                                html += '<div class="bluebg break20px namedate"><span> ' + weekday[day] + ', ' + monthNames[curr_month] + ' ' + curr_date + ', ' + curr_year + '</span><span>' + response.appoinment_list[i].client_name + '</span><div class="dropdown btn-res"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share" aria-hidden="true"></i></button><ul class="dropdown-menu dropdown-menu-right"><li><a href="JavaScript:Void(0);" class="reschedule-appoinment" id="1">Reschedule</a></li><li><a href="JavaScript:Void(0);" class="cancel-appoinment" id="1">Cancel </a></li></ul></div></div><div class="whitebox border-box"><div class="staffDetail"><span><label>With</label> ' + response.appoinment_list[i].staff_name + '</span><p>' + response.appoinment_list[i].start_time + ' - ' + response.appoinment_list[i].end_time + '</p><span class="bluetxt">' + response.appoinment_list[i].currency + response.appoinment_list[i].cost + '</span></div><div class="staffInside"><h6>' + response.appoinment_list[i].service_name + '</h6><p><span>Notes :</span>' + response.appoinment_list[i].note + ' <a href="'+baseUrl+'/create-invoice/'+response.appoinment_list[i].order_id+'" class="btn btn-warning btn-xs pull-right"><i class="fa fa-paper-plane" aria-hidden="true"></i> Invoice</a></p></div></div>';
                            }
                        } else
                        {
                            html += '<div class="bluebg break20px namedate">No data found.</div>';
                        }
                        $('#filter_data').html(html);
                        $('.animationload').hide();
                        $('#staffListModal').modal('hide');
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

        }));


        $('.assign_staff').on('click',(function(){
            var order_id = $(this).data('order-id');
            //alert(order_id);
            if(order_id!=''){
                $('#appointment_order_id').val(order_id);
                $('#assignStaffModal').modal('show');
            }
        }));

        $(".assign_staff_id").on('click',(function(){
            var staff_id = $(this).val();
            var order_id = $('#appointment_order_id').val();
            var data = addCommonParams([]);
            data.push({
                name: 'staff_id',
                value: staff_id
            }, {
                name: 'order_id',
                value: order_id
            });
            $.ajax({
                url: baseUrl + "/api/staff_assignment", // Url to which the request is send
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
        }));

    })
</script>
@endsection