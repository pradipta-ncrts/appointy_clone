@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('custom_css')
<style type="text/css">
    @media (max-width: 767px){.mobileHeader ul li img {max-width: 23px;}}
    .mbprof{display: inline-block;color: #fff;position: relative;bottom: 10px;right: 0;font-size: 14px;background: #3F526F;border-radius: 50px;width: 30px;height: 30px;line-height: 33px;}

  .offscreen {
   position: absolute;
   left: -999em;
   }
   .filter-option{margin-top:14px 0 0 0;}

   .pac-container {
        z-index: 10000 !important;
    }
 </style>
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
    <a class="showSidenav"><img src="{{asset('public/assets/mobile/images/menu-icon.png')}}" /> </a>
    <h1>Dashboard</h1>
    <ul>
      <li><a href="{{url('mobile/calendar')}}"> <img src="{{asset('public/assets/mobile/images/calendar.png')}}" /></a> </li> 
      <li><a href="{{url('mobile/review-list')}}"> <img src="{{asset('public/assets/mobile/images/notification.png')}}" /></a> </li>
    </ul>
</header>
<?php
$mysquder_page_inner = App\Http\Controllers\BaseApiController::mysquder_page_inner();
$inner_user_details = $mysquder_page_inner['inner_user_details'];
?>

<div class="menuoverlay">
    <div class="sideNavbar sideToggle">
        <div class="profileMenuImg">
           <a href="#">
            <?php
            if($user_details->profile_perosonal_image)
            {
            ?>
            <img src="{{asset('public/image/profile_perosonal_image')}}/<?php echo $user_details->profile_perosonal_image;?>" />
            <?php
            }
            else
            {
            ?>
            <img src="{{asset('public/assets/mobile/images/sidenav/blue-user.png')}}" />
            <?php
            }
            ?>
            </a>
            <a href="{{url('mobile/my-profile')}}" class="mbprof"><i class="fa fa-pencil"></i></a>
            <span><?=$user_details->name;?></span>
        </div>
        <ul>
          

            <!-- <li><a href="{{url('mobile/calendar')}}"><img src="{{asset('public/assets/mobile/images/sidenav/bookings.png')}}" /> <span>Calendar</span> </a> </li> -->
            <li><a href="{{url('mobile/booking-list/all')}}"><img src="{{asset('public/assets/mobile/images/sidenav/calendar.png')}}" /> <span>Bookings</span> </a> </li>
            <!-- <li><a href="{{url('mobile/review-list')}}"><img src="{{asset('public/assets/mobile/images/sidenav/feedback.png')}}" /> <span>Feedback</span> </a> </li> -->
            <li><a href="#" data-toggle="modal" data-target="#myModalsharelinks" id="openModalShareLink"><img src="{{asset('public/assets/mobile/images/sidenav/feedback.png')}}" /> <span>Share your link</span> </a> </li>
            <li><a href="{{url('mobile/client-list')}}"><img src="{{asset('public/assets/mobile/images/sidenav/customers.png')}}" /> <span>Clients</span> </a> </li>
            <!--<li><a href="{{url('mobile/my-profile')}}"><img src="{{asset('public/assets/mobile/images/sidenav/user.png')}}" /> <span>Profile Settings</span> </a> </li>-->
            <li><a href="{{url('mobile/settings')}}"><img src="{{asset('public/assets/mobile/images/sidenav/settings.png')}}" /> <span>Settings</span> </a> </li>
            <!-- <li><a><img src="{{asset('public/assets/mobile/images/sidenav/customers.png')}}" /> <span>Customers</span> </a> </li> -->
            <li><a href="{{url('mobile/scan')}}"><img src="{{asset('public/assets/mobile/images/sidenav/qr-code.png')}}" /> <span>Scan </span> </a> </li>
            <li><a href="{{url('mobile/membership')}}"><img src="{{asset('public/assets/mobile/images/sidenav/upgrade.png')}}" /> <span>Upgrade</span> </a> </li>
            <li><a href="{{url('mobile/help')}}"><img src="{{asset('public/assets/mobile/images/sidenav/information.png')}}" /> <span>Help</span> </a> </li>
            <li><a href="" id="logout"><img src="{{asset('public/assets/mobile/images/sidenav/logout.png')}}" /> <span>Logout</span> </a> </li>
        </ul>
    </div>
</div>

<main>
    <div class="container-fluid">



        <div class="row">

                           <ul class="tab-menu ">
                                <li><a href="{{url('mobile/dashboard/')}}" <?php if(!isset($type) || $type=='') { ?> class="active" <?php } ?> >My Squeedr</a></li>
                                <li><a href="{{url('mobile/dashboard/group')}}" <?php if(isset($type) && $type=='group') { ?> class="active" <?php } ?> >Group</a></li>
                                <li><a href="{{url('mobile/dashboard/users')}}" <?php if(isset($type) && $type=='users') { ?> class="active" <?php } ?> >Users</a></li>
                                <li><a href="{{url('mobile/dashboard/template')}}" <?php if(isset($type) && $type=='template') { ?> class="active" <?php } ?> >Template</a></li>
                           </ul>
                     
<div class="col-md-12">
                           
                              <div class="todate"><?php echo date('M d, Y');?></div>
                              <div class="dropdown custm-uperdrop" style=" margin:5px; ">
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
                               <div class="clearfix"></div>                         
                        </div>
                         <div class="clearfix"></div>

            <div class="col-lg-12 break20px">
               <div class="container-custm ">
                 
                 
                  <?php
                  $dashboard_reports_array = array();
                  foreach($dashboard_reports as $value)
                  {
                    $dashboard_reports_array[] = (array)$value;
                  }
                  //echo "<pre>";
                  //print_r($dashboard_reports_array);
                  ?>
                  <div style="position: relative;">
                     <!--<a class="add-w" data-toggle="tooltip" title="Add Widget"><i class="fa fa-plus"></i></a>-->
                    

                     <div class="dash-info">
                     <?php if(!empty($dashboard_reports)) { foreach($dashboard_reports as $report) { ?>
                        <div class="col-sm-12">
                           <div class="infobpx active">
                              
                                <?php if($report->report_id == '1') { ?> 
                                    <a class="rem-w" data-dashboard-report = "1" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                                    <h3 id="total_appointments">{{$total_appointments}}</h3>
                                    <h4>Appointment(S)</h4>
                                    <p id="appointments_difference"><span <?php if($appointments_difference > 0) { ?> class="green" <?php } ?>>{{$appointments_difference}}%</span> Form last month</p>
                                <?php } else if($report->report_id == '2') { ?>
                                    <a class="rem-w" data-dashboard-report = "2" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                                    <h3 id="total_sales">{{number_format(round($total_sales,2),2)}}</h3>
                                    <h4>Estimated Sales</h4>
                                    <p id="sales_difference"><span <?php if($sales_difference > 0) { ?> class="green" <?php } ?>>{{$sales_difference}}%</span> Form last month</p>
                                <?php } else if($report->report_id == '3') { ?>
                                    <a class="rem-w" data-dashboard-report = "3" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                                    <h3 id="total_customers">{{$total_customers}}</h3>
                                    <h4>New Customers(S)</h4>
                                    <p id="customers_difference"><span <?php if($customers_difference > 0) { ?> class="green" <?php } ?>>{{$customers_difference}}%</span> Form last month</p>
                                <?php } ?>
                                <?php /*} else if($report->report_id == '4') { ?>

                                <?php } else if($report->report_id == '5') { ?>

                                <?php } else if($report->report_id == '6') { ?>

                                <?php } */?>
                              
                           </div>
                        </div>
                     <?php } } else { ?>
                        <div class="col-sm-12 ">
                           &nbsp;
                        </div>
                     <?php } ?>
                        
                        <div class="clearfix"></div>
                     </div>

                     <div class="dropdown custm-uperdrop" style=" float: none; text-align: center;">

                       <button class="btn dropdown-toggle add-w" type="button" data-toggle="dropdown" style="margin: 0 auto"><span id="selected_duration"><i class="fa fa-plus"></i></span></button>
                       
                        <ul class="dropdown-menu dshbrd-drp" style="margin: 0 auto; width: 200px; left: 0; right: 0;">
                            <li><input name="dashboard_reports[]" type="checkbox" value="1" <?=in_array('1', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Appointement Reports</li>
                            <li><input name="dashboard_reports[]" type="checkbox" value="2" <?=in_array('2', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Sales Reports</li>
                            <li><input name="dashboard_reports[]" type="checkbox" value="3" <?=in_array('3', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Clients Reports</li>
                            
                        </ul>

                        
                    </div>



 <div class="clearfix"></div>


                     <hr>
                     <div class="clearfix"></div>
                     <div class="headRow mobileappointed arrow-d clearfix row-2"  id="row2">
                        <!--<a href="services.html" class="more-link"  data-toggle="tooltip" title="More Services"><img src="{{asset('public/assets/website/images/threeDots.png')}}"/></a>-->
                        <?php if(!empty($service_list)) { foreach($service_list as $service) { 
                            $enc_service_id = Crypt::encrypt($service->service_id);
                        ?>
                        <div class="appointment mobSevices  col-sm-4">
                           <div class="pull-left">
                              <p>{{ucwords($service->service_name)}}</p>
                              <span>{{$service->duration}} mins
                              <label>{{$service->currency}} {{$service->cost}}</label>
                              </span> 
                           </div>
                           <ul class="pull-right">
                              <li onclick="showUl(this);">
                                 <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>
                                 <ul>
                                    <li><a href="{{url('edit_service/'.$enc_service_id)}}"><i class="fa fa-edit"></i> Edit </a> </li>
                                    <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>
                                    <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <?php } } else { ?>

                        <?php } ?>
                     </div>
                     <hr>
                     <a class="btn btn-primary butt-next center-block" style=" margin: 20px auto;  width: 200px;" data-toggle="modal" data-target="#myModalQuickGuide"  >Quick Start Guide</a>
                  </div>
               </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="myModalQuickGuide" role="dialog">
         <div class="modal-dialog quick-pop">
            <!-- Modal content-->
            <div class="modal-content new-modalcustm">
            
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Quick Guide</h4>
               </div>
               <div class="modal-body clr-modalbdy">
                             <div style="margin-bottom: 10px;">
                                <input type="checkbox" name="show_user_guide" id="show_user_guide" <?=$inner_user_details->login_counter==2 || $inner_user_details->login_counter==1 ? "checked" : ""; ?>> Always show user guide.
                             </div>    
                                   <a href="{{ url('mobile/calendar') }}"><h3>1. Sync Calendars</h3></a>
                                   <p>Squeedr works in sync with Google Calendar, Office 365, Outlook or iCloud to avoid scheduling conflicts when creating 
                                       new events.
                                   </p>
                                   <a href=""><h5> 1.1 Personalize your email</h5></a>
                                   <p>Customize your e-mails. Set-up e-mal tempates that reflect your brand's identity and tone.</p>
                                   <hr >
                                   <a href="{{ url('mobile/business-hours') }}"><h3>2. Manage your business hours</h3></a>
                                   <p>Events types lets you create an event according to your availability, meeting duration, location, etc..., for meetings 
                                       or for individual invitees.
                                   </p>
                                   <a href="{{ url('mobile/service-list/all') }}"><h5> 2.2 Setup your services, staff and location</h5></a>
                                   <ul>
                                       <li>Create events to define your services </li>
                                       <li>Setup scheduling pages for individual team members </li>
                                       <li>Create location-based events.</li>
                                   </ul>
                                   <hr >
                                   <a href="" id="share-your-link"><h3>3. Share your link</h3></a>
                                   <p>Share your link and let invitees schedule the meeting from the available slots. Email the link in a short snippet linke this:
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
                                   <a href="{{ url('mobile/my-profile') }}"><h3>4. Customize your Squeedr page</h3></a>
                                   <hr style="margin-top:10px; margin-top:5px;">
                                   <p>Your personal Squeedr page lists all available events on a single page making it easier for invitees to schedule appointments.
                                       Customize the page to align it with your brand and coporate indentity.
                                   </p>
                                   <a href=""><h5> 4.4 Business Details</h5></a>
                                   <p></p>
               
                              </div>
              
              
            </div>
         </div>
      </div>

<!--=============================Modal area start ====================================-->
<div class="modal fade" id="myModalsharelinks" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm new-modalcustm1">
         <form name="share_link_form" id="share_link_form" method="post" action="">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Share Links</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <span>Copy Your Link</span>
                        <div class="input-group" id="">
                           <input id="copy_link_url" type="text" class="form-control" name="copy_link_url" value="{{ url('business-provider') }}/<?php echo $inner_user_details->username;?>">
                           <button type="button" class="shl-btns" data-url="{{ url('business-provider') }}/<?=$inner_user_details->username;?>" id="copy-link"><i class="fa fa-link"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <span>Email Your Link</span>
                        <div class="input-group" id="clientname_error">
                           <input id="client_name" type="text" class="form-control" name="client_name" value="{{ url('business-provider') }}/<?php echo $inner_user_details->username;?>">
                           <button type="button" class="shl-btns" id="email_your_link"><i class="fa fa-envelope-o"></i></button>
                           <a style="display: none;" href="mailto:?subject=Link&body={{ url('business-provider') }}/<?=$inner_user_details->username;?>" target="_top" id="email_your_link_click">Click Here</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <span>Embed on Your Website</span>
                        <div class="input-group" id="clientname_error">
                           <input id="client_name" type="text" class="form-control" name="client_name" value="{{ url('business-provider') }}/<?=$inner_user_details->username;?>">
                           <button type="button" class="shl-btns" data-url="{{ url('business-provider') }}/<?=$inner_user_details->username;?>" id="embed-link"><i class="fa fa-code"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modalEmbed" role="dialog">
    <div class="modal-dialog add-pop"> 
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Embed Link</h4>
        </div>
        <div class="modal-body clr-modalbdy">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="niceditor">
                  <textarea style="width: 100%" id="embed_code" placeholder=""></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-12 text-center">
            <input id="copy-embed-link" type="submit" value="copy" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">
          </div>
        </div>
      </div>
    </div>
  </div>
<!--===========================Modal area End ========================================-->

<input type="text" id="offscreen" class="offscreen" value="">
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
    });
    
    $('.rem-w').click(function(){
        var report_id = $(this).data('dashboard-report');
        var data = addCommonParams([]);
        data.push({name:'report_id',value:report_id});
        $.ajax({
            url: "<?php echo url('api/change_status_dashboard_report');?>",
            type: "POST",
            data:data ,
            dataType: "json",
            success: function(response) {
                //console.log(response);
                if(response.result=='1')
                {
                  swal("Success", response.message, "success");
                  location.reload();
                    /*swal({title: "Success", text: response.message, type: "success"},
                        function(){ 
                            location.reload();
                        }
                    );*/
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
    });

    $('input[type="checkbox"]').click(function(){
        var count_checked = $("[name='dashboard_reports[]']:checked").length; // count the checked rows
        if(count_checked >=4 ){
            swal("Error", "Maximum 3 widgets are allowed" , "error");
            $(this).prop('checked', false);
        } else {
            var report_id = $(this).val();
            var data = addCommonParams([]);
            data.push({name:'report_id',value:report_id});
            $.ajax({
                url: "<?php echo url('api/change_status_dashboard_report');?>",
                type: "POST",
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.result=='1')
                    {
                       swal("Success", response.message, "success");
                       location.reload();
                        /*swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );*/
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
 
</script>

<?php
  if($inner_user_details->login_counter==1 || $inner_user_details->login_counter==2)
  {
  ?>
  <script type="text/javascript">
     $(document).ready(function() { 
        var a = localStorage.getItem("showPopup");
        if(a!="Yes")
        {
           $("#myModalQuickGuide").modal("show");
           localStorage.setItem("showPopup", "Yes");
        }
     });
  </script>
  <?php
  }
  else
  {
  ?>
  <script type="text/javascript">
     localStorage.removeItem("showPopup");
  </script>
  <?php
  }
  ?>

<script type="text/javascript">
  $('#logout').click(function(e){
      e.preventDefault();
      localStorage.removeItem("showPopup");
      window.location.replace(baseUrl+"logout");
  });
  
</script>

<script type="text/javascript">
   $('#show_user_guide').click(function(e){
      e.preventDefault();
      var user_guide_value = $(this).val();
      var data = addCommonParams([]);
      data.push({name:'user_guide_value',value:user_guide_value});
      $.ajax({
          url: "<?php echo url('api/update_guide_value');?>",
          type: "POST",
          data:data ,
          dataType: "json",
          success: function(response) {
              //console.log(response);
              if(response.result=='1')
              {
                  swal("Success", response.message, "success");
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
});
</script>
<script type="text/javascript">
$('#openModalShareLink').click(function(e){
    e.preventDefault();
    $("#myModalsharelinks").modal('show');
});

$("#copy-link").click(function (event) {
  event.preventDefault();
  $('.animationload').show();
  let url = $(this).data('url');
  $('#offscreen').val(url);
  var copyTextarea = document.querySelector('.offscreen');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    //console.log('Copying text command was ' + msg);
    swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();
  } catch (err) {
    //console.log('Oops, unable to copy');
    swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();
  }
});

$("#embed-link").click(function (event) {
  event.preventDefault();
  let url = $(this).data('url');
  $("#modalEmbed").modal('show');
  var ifrm = '<iframe src="'+url+'"></iframe>';
  $("#embed_code").val(ifrm);
});

$("#copy-embed-link").click(function (event) {
  event.preventDefault();
  var copyTextarea = document.querySelector('#embed_code');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    /*swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();*/
  } catch (err) {
    console.log('Oops, unable to copy');
    /*swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();*/
  }
});
//Share your link popup
$(document).ready(function() {
  $("#share-your-link").click(function(e) {
    e.preventDefault();
    $('.animationload').show();
    $("#myModalQuickGuide").modal('hide');
    $("#myModalsharelinks").modal('show');
    $('.animationload').hide();
  });
});
</script>

@endsection