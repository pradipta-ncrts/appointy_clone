@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking Options</div>
         <!--<div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>-->
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('booking-options') }}"> Clients Booking Flow</a></li>
               <li><a href="{{ url('booking-rules') }}" class="active"> Booking Rules</a> </li>
               <li><a href="{{ url('booking-policies') }}"> Booking Policies</a></li>
               <!-- <li><a href="{{ url('notification-settings') }}"> Notification Settings</a></li>
               <li><a href="{{ url('email-customisation') }}"> Email Customisation</a> </li> -->
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2  style="margin:0">Booking Rules & Layout</h2>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse">
                     <form class="form-horizontal" action="">
                        <h3 class="sub-head">Book appointments directly from the site</h3>
                        <table class="col-md-12">
                           <tr>
                              <td  class="col-md-8">
                                 <p>If this is disabled, customers will be able to check your availablity on the booking portal and see
                                    a message directing them to contact you by phone or in person to make an appointment.
                                    This setting will also be applied to your mini-website and the widget integrated aon your website.
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                    <button type="button" id="book_appointments_directly" data-type-name="book_appointments_directly" class="booking_rule_option btn btn-sm btn-toggle pull-right <?php if(!empty($booking_rule_data) && $booking_rule_data->book_appointments_directly == 1) echo 'active';?>" data-toggle="button" autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" name="lead_cancellation_time_form" id="lead_cancellation_time_form" action="{{url('api/update_lead_cancellation_time')}}" method="post" >
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i> 
                        <h2 style="margin:0"> Lead & Cancellation Time </h2>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse">
                        <div class="col-md-8 padtop20 ">                                    
                           Minimum advance notice required to book an appointment                               
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <input type="number" min=0 class="form-control" name="min_notice_book" id="min_notice_book" placeholder="" value="<?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_book!='') echo $booking_rule_data->min_notice_book; else echo '120';?>">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <select name="min_notice_book_type" id="min_notice_book_type" class="form-control cust-select">
                                 <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_book_type=='Min') echo 'selected=""'; else echo 'selected=""';?> value="Min">Min</option>
                                 <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_book_type=='Hr') echo 'selected=""'; ?> value="Hr">Hr</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-8 padtop20 ">                                    
                           Minimum notice required for cancelling an appointment                
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <input type="number" min=0 class="form-control" name="min_notice_cancel" id="min_notice_cancel"  placeholder="" value="<?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_cancel!='') echo $booking_rule_data->min_notice_cancel; else echo '1';?>">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <select class="form-control cust-select" name="min_notice_cancel_type" id="min_notice_cancel_type">
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_cancel_type=='Min') echo 'selected=""'; else echo 'selected=""';?> value="Min">Min</option>
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_cancel_type=='Hr') echo 'selected=""'; ?> value="Hr">Hr</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-8 padtop20 ">                                    
                           Minimum notice required for resheduling an appointment           
                        </div>
                        <div class="col-md-2  col-sm-2">
                           <div class=" booking-form">
                              <input type="number" min=0 class="form-control" name="min_notice_reschedule" id="min_notice_reschedule" placeholder="" value="<?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_reschedule!='') echo $booking_rule_data->min_notice_reschedule; else echo '1';?>">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <select name="min_notice_reschedule_type" id="min_notice_reschedule_type" class="form-control cust-select">
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_reschedule_type=='Min') echo 'selected=""'; else echo 'selected=""';?> value="Min">Min</option>
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_notice_reschedule_type=='Hr') echo 'selected=""'; ?> value="Hr">Hr</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <!-- <div class="clearfix"></div>
                        <div class="col-md-8 padtop20 ">                                    
                           How many days in advance can appointments be booked?           
                        </div>
                        <div class="col-md-4 ">
                           <div class=" booking-form">
                              <input type="text" class="form-control"  placeholder="" value="90">
                              <div class="clearfix"></div>
                           </div>
                        </div> -->
                        <div class="clearfix"></div>
                        <div class="col-md-8 padtop20 ">                                    
                           Minimum time interval required between appointments          
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <input type="number" min=0 class="form-control" name="min_time_interval" id="min_time_interval" placeholder="" value="<?php if(!empty($booking_rule_data) && $booking_rule_data->min_time_interval!='') echo $booking_rule_data->min_time_interval; else echo '0';?>">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <select name="min_time_interval_type" id="min_time_interval_type" class="form-control cust-select">
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_time_interval_type=='Min') echo 'selected=""'; else echo 'selected=""';?> value="Min">Min</option>
                                    <option <?php if(!empty($booking_rule_data) && $booking_rule_data->min_time_interval_type=='Hr') echo 'selected=""';?> value="Hr">Hr</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                       <!--  <div class="col-md-8 padtop20 ">                                    
                           Set time interval forAdministrator calendar       
                        </div>
                        <div class="col-md-2 col-sm-2">
                           <div class=" booking-form">
                              <select class="form-control cust-select">
                                 <option>15</option>
                        ct>
                              <div class="clearfix"></div>
                           </div>
                        </div> -->
                        <div class="clearfix"></div>
                        <button class="btn btn-primary search-btn" type="submit">Save</button> 
                        <div class="clearfix"></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec ">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <form class="form-horizontal" action="">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i> 
                        <h2 style="margin: 0">Booking Restrictions </h2>
                     </div>
                     <div id="collapse3" class="panel-collapse collapse">
                        <!-- <table class="col-md-12">
                           <tr>
                              <td  class="col-md-8 padtop15">
                                 <h3 class="sub-head1">Geographical Restriction</h3>
                                 <p>Allow international users (outside France) to book appointments
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                 <i class="fa fa-toggle-off"></i>
                              </td>
                           </tr>
                        </table> -->
                        <div class="clearfix"></div>
                        <table class="col-md-12">
                           <tr>
                              <td  class="col-md-8 padtop15">
                                 <h3 class="sub-head1">Booking Limit per Customer</h3>
                                 <p>By default, all customers are allowed to schedule unlimited appointments. You can choose to restrict the number
                                    of bookings that customers can make in a day, week or month
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                 <button type="button" id="booking_limit" data-type-name="booking_limit" class="booking_rule_option btn btn-sm btn-toggle pull-right <?php if(!empty($booking_rule_data) && $booking_rule_data->booking_limit == 1) echo 'active';?>" data-toggle="button" autocomplete="off">
                                    <div class="handle"></div>
                                </button>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                           <h3>Booking Allowed</h3>
                           <div class=" booking-form">
                              <select class="form-control cust-select">
                                 <option>Unlimited</option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <h3>From</h3>
                           <div class=" booking-form">
                              <input type="text" class="form-control"  placeholder="" value="Jul 11, 2018">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <h3>Till</h3>
                           <div class=" booking-form">
                              <input type="text" class="form-control"  placeholder="" value="Jul 11, 2025">
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <!--<table class="col-md-12">
                           <tr>
                              <td  class="col-md-8 padtop15">
                                 <h3 class="sub-head1">Back-to-Back Booking</h3>
                                 <p>Enable this to allow customers to select multiple services at the time of booking. In this case, 
                                    only those times will be shown as available when
                                    the selected services can be performed consecutively
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                    <button type="button" id="back_to_back_booking" data-type-name="back_to_back_booking" class="service_option btn btn-sm btn-toggle pull-right <?php /* if($time_on_booking_portal == 1) echo 'active'; */ ?>" data-toggle="button" autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                              </td>
                           </tr>
                        </table>
                        <div class="clearfix"></div>-->
                        <table class="col-md-12">
                           <tr>
                              <td  class="col-md-8 padtop15">
                                 <h3 class="sub-head1">Recurring Booking</h3>
                                 <p>Enable this to allow customers to book multiple seats in a single transaction (For the same service / time combination)
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                <button type="button" id="recurring_booking" data-type-name="recurring_booking" class="booking_rule_option btn btn-sm btn-toggle pull-right <?php if(!empty($booking_rule_data) && $booking_rule_data->recurring_booking == 1) echo 'active';?>" data-toggle="button" autocomplete="off">
                                    <div class="handle"></div>
                                </button>
                                 
                              </td>
                           </tr>
                        </table>
                        <div id="recurring_option_section" >
                            <div class="clearfix"></div>
                            <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Recurring appointments is a premium feature availbale in Growth and above membership. <span>Upgrade</span></div>
                            <h3 class="sub-head">Show recurring options to</h3>
                            <div class="clearfix"></div>
                            <div class="checkbox col-md-3">                                                                           
                            <label class="check">
                            <input type="checkbox" class="recurring_option" data-option-name="show_recurring_options_customer" <?php if(!empty($booking_rule_data) && $booking_rule_data->show_recurring_options_customer == 1) { ?> checked="" <?php } ?>> &nbsp;&nbsp; Customer
                            <span class="checkmark"></span>
                            </label>                                                                            
                            </div>
                            <div class="checkbox col-md-3">                                                                           
                            <label class="check">
                            <input type="checkbox" class="recurring_option" data-option-name="show_recurring_options_admin" <?php if(!empty($booking_rule_data) && $booking_rule_data->show_recurring_options_admin == 1) { ?> checked="" <?php } ?>> &nbsp;&nbsp; Admin
                            <span class="checkmark"></span>
                            </label>                                                                            
                            </div>
                        </div>
                        <?php /* <table class="col-md-12">
                           <tr>
                              <td  class="col-md-8 padtop15">
                                 <h3 class="sub-head1">Qualntity Booking</h3>
                                 <p>Enable this to allow customers to reserve appointment for more than one person in a single transaction.
                                    In the order summary page, the customer will be able to see the number of availbale slots for that service / 
                                    time combination, and choose to book one or more in a single transaction
                                 </p>
                              </td>
                              <td  class="col-md-4 text-right">
                                 <a onclick="togglebtn(this);" class="togg-btn active">
                                 <i class="fa fa-toggle-off"></i>
                              </td>
                           </tr>
                        </table>
                        <div class="col-md-6 ">
                           <h3>Enter the alias for quantity</h3>
                           <div class=" booking-form">
                              <input type="text" class="form-control"  placeholder="Qualntity" >
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="notfy-msg"><i class="fa fa-warning"></i> &nbsp; Quantity booking is a premium feature available in Growth and above membership.
                           <span>Upgrade</span>
                        </div> */ ?>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_js')
<script>
    $(document).on('click','.booking_rule_option',function(){
        var booking_rule_type_name = $(this).data('type-name');
        var status_value = 0;  
        if ( $(this).hasClass("active") ) {
                status_value = 1;
        }
        //alert(service_type_name+' ==== '+status_value);
        var data = addCommonParams([]);
        data.push({name:'type', value: booking_rule_type_name},{name:'status', value:status_value});
        $.ajax({
                url: baseUrl+"/api/update_booking_rule", 
                type: "POST", 
                data: data, 
                dataType: "json",
                success: function(response) 
                {
                //console.log(response);
                $('.animationload').hide();
                if(response.result=='1')
                {
                    swal({title: "Success", text: response.message, type: "success"});
                }
                else
                {
                    swal("Error", response.message , "error");
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

    });

    $('#lead_cancellation_time_form').validate({
        submitHandler: function(form) {
            var data = $(form).serializeArray();
            data = addCommonParams(data);
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
                        //console.log(response);
                        $('.animationload').hide();
                        if(response.result=='1')
                        {
                                swal({title: "Success", text: response.message, type: "success"});
                        }
                        else
                        {
                                swal("Error", response.message , "error");
                        }
                    }
                    else
                    {
                        swal("Error", response.message , "error");
                    }
                },
                beforeSend: function(){
                    $('.animationload').show();
                }
            });
        }
    });

    $('.recurring_option').change(function() {
            var recurring_type_name = $(this).data('option-name');
            var status_value = 0;
            if(this.checked) {
                  status_value = 1;
            }
            //alert(recurring_type_name+'----'+status_value);  
            var data = addCommonParams([]);
            data.push({name:'type', value: recurring_type_name},{name:'status', value:status_value});
            $.ajax({
                  url: baseUrl+"/api/update_booking_rule", 
                  type: "POST", 
                  data: data, 
                  dataType: "json",
                  success: function(response) 
                  {
                    //console.log(response);
                    $('.animationload').hide();
                    if(response.result=='1')
                    {
                            swal({title: "Success", text: response.message, type: "success"});
                    }
                    else
                    {
                            swal("Error", response.message , "error");
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
      });
</script>
@endsection