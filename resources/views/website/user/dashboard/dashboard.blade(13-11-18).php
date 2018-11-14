@extends('../layouts/website/master_template_web')

@section('title')

Squeedr

@endsection



@section('content')

<div class="body-part">

   <div class="container-custm">

      <div class="upper-cmnsection">

         <div class="heading-uprlft">Dashboard</div>

         <div class="upr-rgtsec">

            <div class="col-md-6">

               <ul class="tab-menu ">

                  <li><a href="#" class="active">My Squeedr</a></li>

                  <li><a href="#">Group</a></li>

                  <li><a href="#">Users</a></li>

                  <li><a href="#">Template</a></li>

               </ul>

            </div>

            <div class="col-md-6">

               <div class="full-rgt">

                  <div class="todate"><?php echo date('M d, Y');?></div>

                  <div class="dropdown custm-uperdrop">

                  <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span id="selected_duration">This Month</span> <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>

                     <ul class="dropdown-menu">

                        <li><a href="javascript:void(0);" class="duration" data-duration = "1" data-selected-duration="This Week">This Week</a></li>

                        <li><a href="javascript:void(0);" class="duration" data-duration = "2" data-selected-duration="Last Week">Last Week</a></li>

                        <li><a href="javascript:void(0);" class="duration" data-duration = "3" data-selected-duration="This Month">This Month</a></li>

                        <li><a href="javascript:void(0);" class="duration" data-duration = "4" data-selected-duration="Last Month">Last Month</a></li>

                        <li><a href="javascript:void(0);" class="duration" data-duration = "5" data-selected-duration="This Year">This Year</a></li>

                        <li><a href="javascript:void(0);" class="duration" data-duration = "6" data-selected-duration="Last Year">Last Year</a></li>

                    </ul>

                  </div>

                  <!--<div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>-->

               </div>

            </div>

         </div>

      </div>

      <div class="clearfix"></div>

      <div class="rightpan full">

         <!--<a class="add-w"  data-toggle="tooltip" title="Add Widget"><i class="fa fa-plus"></i></a>-->
         
         <div class="dropdown custm-uperdrop">

          <button class="btn dropdown-toggle add-w" type="button" data-toggle="dropdown"><span id="selected_duration"><i class="fa fa-plus"></i></span></button>

                     <ul class="dropdown-menu dshbrd-drp">

                        <li><input name="" type="checkbox" value="" />Sales Reports</li>

                        <li><input name="" type="checkbox" value="" />Appointement Reports</li>

                        <li><input name="" type="checkbox" value="" />Clients Reports</li>

                        <li><input name="" type="checkbox" value="" />Staff Reports</li>

                        <li><input name="" type="checkbox" value="" />Clients Alerts report</li>

                        <li><input name="" type="checkbox" value="" />SMS Delivery Reports</li>

                    </ul>

                  </div>
         

         <div class="dash-info">

            <div class="col-sm-4 ">

               <div class="infobpx active">

                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>

                  <h3 id="total_appointments">{{$total_appointments}}</h3>

                  <h4>Appointment(S)</h4>

                  <p id="appointments_difference"><span <?php if($appointments_difference > 0) { ?> class="green" <?php } ?>>{{$appointments_difference}}%</span> Form last month</p>

               </div>

            </div>

            <div class="col-sm-4 ">

               <div class="infobpx">

                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>

                  <h3 id="total_sales">{{number_format(round($total_sales,2),2)}}</h3>

                  <h4>Estimated Sales</h4>

                  <p id="sales_difference"><span <?php if($sales_difference > 0) { ?> class="green" <?php } ?>>{{$sales_difference}}%</span> Form last month</p>

               </div>

            </div>

            <div class="col-sm-4 ">

               <div class="infobpx">

                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>

                  <h3 id="total_customers">{{$total_customers}}</h3>

                  <h4>New Customers(S)</h4>

                  <p id="customers_difference"><span <?php if($customers_difference > 0) { ?> class="green" <?php } ?>>{{$customers_difference}}%</span> Form last month</p>

               </div>

            </div>

            <div class="clearfix"></div>

         </div>

         <hr>

         <div class="clearfix"></div>

         <div class="headRow mobileappointed arrow-d clearfix row-2"  id="row2">

            <!--<a href="services.html" class="more-link"  data-toggle="tooltip" title="More Services"><img src="{{asset('public/assets/website/images/threeDots.png')}}"/></a>-->

            <div class="appointment mobSevices  col-sm-4">

               <div class="pull-left">

                  <p>Dental Consultation</p>

                  <span>30min-1h

                  <label>$50</label>

                  </span> 

               </div>

               <ul class="pull-right">

                  <li onclick="showUl(this);">

                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>

                     <ul>

                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>

                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>

                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>

                     </ul>

                  </li>

               </ul>

            </div>

            <div class="appointment mobSevices  col-sm-4">

               <div class="pull-left">

                  <p>Dental Consultation</p>

                  <span>30min-1h

                  <label>$50</label>

                  </span> 

               </div>

               <ul class="pull-right">

                  <li onclick="showUl(this);">

                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>

                     <ul>

                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>

                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>

                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>

                     </ul>

                  </li>

               </ul>

            </div>

            <div class="appointment mobSevices  col-sm-4">

               <div class="pull-left">

                  <p>Dental Consultation</p>

                  <span>30min-1h

                  <label>$50</label>

                  </span> 

               </div>

               <ul class="pull-right">

                  <li onclick="showUl(this);">

                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>

                     <ul>

                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>

                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>

                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>

                     </ul>

                  </li>

               </ul>

            </div>

         </div>

         <hr>

         <a class="btn btn-primary butt-next center-block" style=" margin: 20px auto;  width: 200px;" data-toggle="modal" data-target="#myModalQuickGuide"  >Quick Start Guide</a>

      </div>

   </div>

</div>





<!--Quick Guide-->

 <!--====================================Modal area start ====================================--> 

 <div class="modal fade" id="myModalQuickGuide" role="dialog">

         <div class="modal-dialog quick-pop">

            <!-- Modal content-->

            <div class="modal-content new-modalcustm">

            

               <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h4 class="modal-title">Quick Guide</h4>

               </div>

               <div class="modal-body clr-modalbdy">



                  <h3>1. Sunc Calendars</h3>

                  



                  <p>Squeedr works in sync with Google Calendar, Office 365, Outlook or iCloud to avoid scheduling cpnflicts when creating 

                  new events.</p>



                    <h5> 1.1 Personalize your email</h5>

                    <p>Customize your e-mails. Set-up e-mal tempates that reflect your brand's identity and tone.</p>

                    <hr >



                    <h3>2. Manege your business hours</h3>

                 



                  <p>Events types lets you create an event according to your availability, meeting duration, lovation, etc..., for meetings 

                      or for individual invitees.

                  </p>



                    <h5> 2.2 Setup your services, staff and location</h5>

                    <ul>

                        <li>Create events to define your services </li>

                        <li>Setup scgeduling pages for individual team members </li>

                        <li>Create location-based events.</li>

                    </ul>



                <hr >





                    <h3>3. Share yourlink</h3>

                 



                  <p>Share yoru link and let invitees schedule the meeting from the available slots. Email the link in a short snippet linke this:

                      <br><br>

                        <span class="cl-blue">

                            Subject: Lets connect,<br>

                            Hi matt,<br>

                            It would be lovely if we could chat. Why don't you go ahead and decide the time at (insert dummy Squeedr link)?<br>

                            <br>

                            Let's Chat soon!<br><br>

                            - Sam

                        </span>

                  </p>



 <hr >

                <h3>4. Customize your Squeedr page</h3>

                  <hr style="margin-top:10px; margin-top:5px;">



                  <p>Your personal Squeedr page lists all available events on a single page making it easier for invitees to schedule appointments.

                      Customize the page to align it with your brand and coporate indentity.

                  </p>



                    <h5> 4.4 Business Details</h5>

                    <p></p>













               </div>

              

              

            </div>

         </div>

      </div>

@endsection



@section('custom_js')

<script>

$(document).ready(function(){

    $('.duration').click(function(){

        var appointments_difference_class = "";

        var sales_difference_class = "";

        var customers_difference_class = "";

        var duration = $(this).data('duration');

        var selected_duration = $(this).data('selected-duration');

        var diff_text = "";

        if(duration == 1 || duration == 2){

            diff_text = "FROM LAST WEEK";

        }

        if(duration == 3 || duration == 4){

            diff_text = "FROM LAST MONTH";

        }

        if(duration == 5 || duration == 6){

            diff_text = "FROM LAST YEAR";

        }

        var data = addCommonParams([]);

        data.push({name:'duration',value:duration});

        $.ajax({

            url: "<?php echo url('api/dashboard');?>",

            type: "POST",

            data:data ,

            dataType: "json",

            success: function(response) {

                console.log(response);

                if(response.result=='1')

                {

                    $('.animationload').hide();

                    $("#total_appointments").text(response.total_appointments);

                    $("#total_sales").text(response.total_sales);

                    $("#total_customers").text(response.total_customers);

                    $("#selected_duration").text(selected_duration);

                    if(response.appointments_difference > 0){

                        appointments_difference_class="green";

                    }

                    if(response.sales_difference > 0){

                        sales_difference_class="green";

                    }

                    if(response.customers_difference > 0){

                        customers_difference_class="green";

                    }

                    $("#appointments_difference").html('<span class="'+appointments_difference_class+'">'+response.appointments_difference+'% </span>'+ diff_text);

                    $("#sales_difference").html('<span class="'+sales_difference_class+'">'+response.sales_difference+'% </span>'+ diff_text);

                    $("#customers_difference").html('<span class="'+customers_difference_class+'">'+response.customers_difference+'% </span>'+ diff_text);

                    

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

    })

})

    

</script>

@endsection

<style type="text/css">
.custm-uperdrop{float:right !important;}
.add-w{right: -40px !important;top: 40px !important;color: #337ab7 !important;font-size: 22px !important;}
.dshbrd-drp li{display: block;
    padding: 3px 12px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;}
</style>