@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('custom_css')
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
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Dashboard</div>
         <div class="upr-rgtsec">
            <div class="col-md-6">
               <ul class="tab-menu ">
                    <li><a href="{{url('dashboard/')}}" <?php if(!isset($type) || $type=='') { ?> class="active" <?php } ?> >My Squeedr</a></li>
                    <li><a href="{{url('dashboard/group')}}" <?php if(isset($type) && $type=='group') { ?> class="active" <?php } ?> >Group</a></li>
                    <li><a href="{{url('dashboard/users')}}" <?php if(isset($type) && $type=='users') { ?> class="active" <?php } ?> >Users</a></li>
                    <li><a href="{{url('dashboard/template')}}" <?php if(isset($type) && $type=='template') { ?> class="active" <?php } ?> >Template</a></li>
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
      <?php
      $dashboard_reports_array = array();
      foreach($dashboard_reports as $value)
      {
        $dashboard_reports_array[] = (array)$value;
      }
      //echo "<pre>";
      //print_r($dashboard_reports_array);
      ?>
      <div class="rightpan full">
         <!--<a class="add-w" data-toggle="tooltip" title="Add Widget"><i class="fa fa-plus"></i></a>-->
        <div class="dropdown custm-uperdrop">
            <button class="btn dropdown-toggle add-w" type="button" data-toggle="dropdown"><span id="selected_duration"><i class="fa fa-plus"></i></span></button>
            <ul class="dropdown-menu dshbrd-drp">
                <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="1" <?=in_array('1', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Appointement Reports</li>
                <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="2" <?=in_array('2', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Sales Reports</li>
                <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="3" <?=in_array('3', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Clients Reports</li>
                <?php /* <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="4" <?=in_array('4', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Cancellation Reports</li>
                <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="5" <?=in_array('5', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Service Report</li>
                <li><input class="dashboard_reports" name="dashboard_reports[]" type="checkbox" value="6" <?=in_array('6', array_column($dashboard_reports_array, 'report_id')) ? "checked" : ""; ?>/>Credit Charges Reports</li> */ ?>
            </ul>
        </div>

         <div class="dash-info">
         <?php if(!empty($dashboard_reports)) { foreach($dashboard_reports as $report) { ?>
            <div class="col-sm-4 ">
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
					<?php /*} /else if($report->report_id == '4') { ?>

                    <?php } else if($report->report_id == '5') { ?>

                    <?php } else if($report->report_id == '6') { ?>

                    <?php } */ ?>
                  
               </div>
            </div>
         <?php } } else { ?>
            <div class="col-sm-12 ">
               &nbsp;
            </div>
         <?php } ?>
            
            <div class="clearfix"></div>
         </div>
         <?php
         if(!empty($dashboard_reports))
         {
            echo "<hr>";
         }
         ?>
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
                        <li><a href="JavaScript:Void(0);" class="copy-service-link" data-service="{{ url('client/service-details') }}/<?=$service->service_id;?>"><i class="fa fa-copy"></i> Copy URL </a> </li>
                        <li><a href="JavaScript:Void(0);" class="embed-srvice" data-service="{{ url('client-service-details') }}/<?=$service->service_id;?>"><i class="fa fa-code"></i> Embed  </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <?php } } else { ?>

            <?php } ?>
         </div>
         <hr>
         <a class="btn btn-primary butt-next center-block" style=" margin: 20px auto;  width: 200px;" data-toggle="modal" data-target="#myModalQuickGuide"  >Quick Guide</a>
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
                    swal({title: "Success", text: response.message, type: "success"},
                        function(){ 
                            location.reload();
                        }
                    );
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

    $('.dashboard_reports').click(function(){
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
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );
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