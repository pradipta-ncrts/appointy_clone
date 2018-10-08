@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.print.min.css')}}" media="print">
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/scheduler.min.css')}}">
<style type="text/css">
    .calender-inpt{float:left;margin: 24px 26px 0 0 !important;}
    .calender-mdlstyl {display: inline-flex;position: relative;}
    .calender-mdlstyl h2{font-size: 20px;font-weight: 300;margin: 10px 0 0 15px;}
    .calender-mdlstyl span{font-size: 14px;font-weight: 300;}
    .scroll-calender{max-height:400px;overflow-y:auto;}
</style>
@endsection
@section('content')
<?php 
$show_from = "07:00:00";
$show_till = "21:00:00";
$increment = "00:15:00";
$sel_increment = "15";
if(!empty($calendar_settings)){
    if(isset($calendar_settings->show_from) && $calendar_settings->show_from!=''){
        $show_from = $calendar_settings->show_from;
    }
    if(isset($calendar_settings->show_till) && $calendar_settings->show_till!=''){
        $show_till = $calendar_settings->show_till;
    }
    if(isset($calendar_settings->increment) && $calendar_settings->increment!=''){
        $sel_increment = $calendar_settings->increment;
        $increment = "00:".$calendar_settings->increment.":00";
    }
}
//echo $show_from."<<>>".$show_till."<<>>".$increment; exit;
$month_array = array('0'=>'JAN','1'=>'FEB','2'=>'MAR','3'=>'APR','4'=>'MAY','5'=>'JUN','6'=>'JUL','7'=>'AUG','8'=>'SEP','9'=>'OCT','10'=>'NOV','11'=>'DEC');
?>
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Calendar</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
                <!--<div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="  search-query form-control" placeholder="Search" />
                        <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                        </span> 
                    </div>
                </div>-->
                &nbsp;
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu" id="months-tab">
                     <?php
                        $curr_month = date('n') - 1;
                        for($i=$curr_month+1;$i<=$curr_month+3;$i++){
                     ?>
                        <li><a data-month="<?php echo $i;?>" href="javascript:void(0);"><?=$month_array[$i];?></a></li>
                        <?php 
                        }
                        ?>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="" data-toggle="modal" data-target="#staffFilterModal">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full" style="width: 100% !important">
         <!-- THE CALENDAR -->
         <div id="calendar"></div>

         <!--Appointment Details-->
         <div class="modal fade in" id="myModalAppointmentContent" role="dialog">
            <div class="modal-dialog add-pop">
               <!-- Modal content-->
               <div class="modal-content new-modalcustm">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">×</button>
                     <h4 class="modal-title">Appointment Details</h4>
                  </div>
                  <div class="modal-body clr-modalbdy">
                     <div class="notify" >
                        <!-- <a href="#" class="flip"><img src="images/arrow.png" alt=""/></a>-->
                        <div class="user-bkd">
                            <!--<div class="notify-drops">
                                <div class="dropdown custm-uperdrop">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Check In <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""></button> 
                                    <ul class="dropdown-menu st-p">
                                        <li><a href="javascript:void(0);">As Scheduled</a></li>
                                        <li><a href="javascript:void(0);">Arrived Late</a></li>
                                        <li><a href="javascript:void(0);">No Show</a></li>
                                        <li><a href="javascript:void(0);">Gift Certificates</a></li>
                                        <li><a href="javascript:void(0);">New Status</a></li>
                                    </ul>
                                </div>
                            </div>-->
                           <img id="clientImg" src="" class="thumbnail rounded">
                           <h2 id="clientDetails">Steph Pouyet
                              <br><span>steph.pouyet@gmail.com</span>
                           </h2>
                        </div>

                        <div>
                           <div class="usr-bkd-dt">
                                <div class="name" id="serviceStaff">
                                    <i class="fa fa-circle-o "></i> Dev ($120.00) <br>
                                    <i class="fa fa-user-o "></i> JASON
                                </div>
                                <div class="datetime" id="serviceDatetime">
                                    12:00am - 01:00pm (1hr) <br>
                                    August 13
                                </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
                           <div id="appointmentDatetime">Booked: Aug 13th, 2018 </div>
                           <br> <br>

                            <div id="paymentSection">
                                <form name="update_note_form" id="update_note_form" method="post" action="{{url('api/update_appointment_note')}}">
                                    <div class="link-e">
                                            <a href="JavaScript:Void(0);" class="cancel-appoinment"><i class="fa fa-times"></i> Cancel</a>
                                        <a href="JavaScript:Void(0);" class="reschedule-appoinment"><i class="fa fa-repeat"></i> Reschedule</a>
                                        <a href="#"><i class="fa fa-star-half-o "></i> Request a review</a>
                                    </div>
                                    <input type="hidden" name="appoinment-id" id="appoinment-id" value="">
                                    <div class="clearfix">&nbsp;</div>
                                    <br>
                                    <!--<a href="#"><i class="fa fa-file-o"></i> Appointment Note</a>-->
                                    <textarea id="bookingNote" name="booking_note" rows="4"></textarea>
                                    <br>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn btn-primary butt-next break10px">Update Note</button>
                                    <button type="button" class="btn btn-success butt-next break10px pull-right">Add Payment</button> 
                                </form>
                            </div>

                            <div id="statusSection" style="display:none;">
                                <div class="link-e">
                                    
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

        <!-- Staff Filter -->
        <div class="modal fade" id="staffFilterModal" role="dialog">
            <div class="modal-dialog add-pop">
                <!-- Modal content--> 
                <div class="modal-content new-modalcustm">
                  <form name="add_appointmentm_form" id="appointmentm_filter_form" method="post" action="{{ url('calendar') }}" enctype="multipart/form-data">
                      <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">×</button>
                         <h4 class="modal-title">Filter by staff</h4>
                      </div>
                      <div class="filter-op"> <!-- All staff selected -->   <span><a href="JavaScript:Void(0);" class="select-all">Select All</a>  &nbsp; | &nbsp;  <a href="JavaScript:Void(0);" class="deselect-all">Deselect All</a></span></div>
                      <div class="modal-body clr-modalbdy">
                         <div class="notify" >
                            <input type="text" id="myInput" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                            
                            <?php
                            $staff_id = array();
                            if(!empty($filter_data))
                            {
                                foreach ($staff_list as $key => $value)
                                {
                                    $staff_id[] = $value->staff_id;
                                }
                            }
                          
                            //print_r($staff_id);
                            foreach ($staff_list_filter as $key => $value)
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
                                 <h2 id="clientDetails"><?=$value->full_name;?>
                                    <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> Email</a>
                                 </h2>
                                 <div class="row" id="apoinment-mail-notification">
                                    <div class="check-ft">
                                       <div class="form-group"> 
                                        <input name="appoinmnet_filter_stuff_id[]" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>" <?=in_array($value->staff_id, $staff_id) ? "checked" : ""; ?>>
                                      </div>
                                    </div>
                                 </div>
                               </div>
                            <?php
                            }
                            ?>
                         </div>
                         <div class="butt-pop-ft">
                             <button type="submit" class="btn btn-primary butt-next">Done</button> 
                             <a href="{{ url('calendar') }}" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Reset</a> 
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>

        <!-- Settings Modal -->
        <div class="modal fade" id="calendarsettingsModal" role="dialog">
            <div class="modal-dialog add-pop">
            <!-- Modal content--> 
            <div class="modal-content new-modalcustm">
                <form name="calendar_settings_form" id="calendar_settings_form" method="post" action="{{url('api/calendar_settings')}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        <h4 class="modal-title">Calendar Settings</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <div class="form-group nomarging color-b" >
                                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="show_from" id="show_from" >
                                            <option value="">Show from </option>
                                            <?php
                                                $start = "00:00:00";
                                                $end = "10:00:00";

                                                $tStart = strtotime($start);
                                                $tEnd = strtotime($end);
                                                $tNow = $tStart;

                                                while($tNow <= $tEnd){
                                                    $selected = "";
                                                    if(date("H:i:s",$tNow) == $show_from) {
                                                        $selected = "selected='selected'";
                                                    }
                                                    echo "<option ".$selected." value='".date("H:i:s",$tNow)."'>".date("h:i A",$tNow)."</option>";
                                                    $tNow = strtotime('+15 minutes',$tNow);
                                                }
                                            ?>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <div class="form-group nomarging color-b" >
                                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="show_till" id="show_till" >
                                            <option value="">Show till </option>
                                            <?php
                                                $start = "17:00:00";
                                                $end = "23:45:00";

                                                $tStart = strtotime($start);
                                                $tEnd = strtotime($end);
                                                $tNow = $tStart;
                                                
                                                while($tNow <= $tEnd){
                                                    $selected = "";
                                                    if(date("H:i:s",$tNow) == $show_till) {
                                                        $selected = "selected='selected'";
                                                    }
                                                    echo "<option ".$selected." value='".date("H:i:s",$tNow)."'> ".date("h:i A",$tNow)."</option>";
                                                    $tNow = strtotime('+15 minutes',$tNow);
                                                }
                                            ?>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <div class="form-group nomarging color-b" >
                                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="increment" id="increment" >
                                            <option value="">Increment </option>
                                            <?php
                                            $increment_arr = array('5','10','15','20','30','60');
                                            foreach ($increment_arr as $key=>$val)
                                            {
                                                $selected = "";
                                                if($val == $sel_increment) {
                                                    $selected = "selected='selected'";
                                                }
                                                echo "<option ".$selected." value='".$val."'>".$val." Mins</option>";
                                            }
                                            ?>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center"> 
                            <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Submit</button> 
                        </div>
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

<!-- fullCalendar -->
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/moment.min.js')}}"></script>
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/scheduler.min.js')}}"></script>

<script>
    $(function() { 
        // document ready
        var date = new Date();
        var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
        var currView = "";
        var minTime = "<?php echo $show_from;?>";
        var maxTime = "<?php echo $show_till;?>";
        var slotDuration = "<?php echo $increment;?>";

        $('#calendar').fullCalendar({
            //hide the license warning//
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            //Settings//
            slotDuration: slotDuration,
            allDaySlot: false,
            minTime: minTime,
            maxTime: maxTime,
            defaultView: 'agendaDay',
            //date//
            //defaultDate: '2018-04-07',
            editable: false,
            selectable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true, // can click day/week names to navigate views
            
            customButtons: {
                addButton: {
                    text: 'Add',
                    click: function() {
                        //alert('clicked the add button!');
                        $('#myModaladdappoinment').modal('show');
                    }
                },
                refreshButton: {
                    text: 'Refresh',
                    click: function() {
                        location.reload(true);
                    }
                }
            },
            header: {
                left: 'agendaDay,agendaWeek,month',
                center: 'prev,title,next',
                right: 'addButton,refreshButton'
            },
            buttonText: {
                month: 'Month',
                week: 'Week',
                day: 'Day'
            },

            /*resources: [
                { id: '2', title: 'Minnie', eventColor: '#4C80D4'},
                { id: '3', title: 'Thomas', eventColor: '#4BB950'}
            ],
            events: [
                { id: '1', resourceId: '2', start: '2018-09-21T09:00:00', end: '2018-09-21T10:00:00', title: 'event 1' },
                { id: '2', resourceId: '3', start: '2018-09-21T09:30:00', end: '2018-09-21T10:30:00', title: 'event 2' },
                { id: '3', resourceId: '2', start: '2018-09-25T07:30:00', end: '2018-09-25T08:30:00', title: 'event 3' },
                { id: '4', resourceId: '3', start: '2018-09-25T10:00:00', end: '2018-09-25T11:15:00', title: 'event 4' }
            ],*/

            resources: [
                <?php
                foreach ($staff_list as $key => $value)
                {
                ?>
                { id: '<?=$value->staff_id;?>', title: '<?=$value->full_name;?>',/*businessHours: {
                    start: '10:00',
                    end: '18:00'
                },*/},
                <?php
                }
                ?>
            ],
            events: [
                <?php
                foreach ($appoinment_list as $key => $value)
                {
                ?>
                { 
                    //id: '1', resourceId: 'a', start: '2018-09-21T09:00:00', end: '2018-09-21T10:00:00', title: 'event 1' },
                    id: '<?=$value->appointment_id;?>',
                    resourceId : '<?=$value->staff_id;?>',
                    title: '<?=$value->service_name;?>',
                    start: '<?=$value->start_date;?>',
                    end: '<?=$value->end_time;?>',
                    //allDay: false,
                    backgroundColor: "<?=$value->colour_code;?>",
                    borderColor: "<?=$value->colour_code;?>",
                    appointment_id: '<?=$value->appointment_id;?>',
                },
               <?php
                }
               ?>
            ],
            /*selectConstraint: "businessHours",*/
            
            select: function(start, end, jsEvent, view, resource) {
                // You could fill in the start and end fields based on the parameters
                /*if(start.isBefore(moment())) {
                    $('#calendar').fullCalendar('unselect');
                    return false;
                }*/
                if(start.isBefore(moment().add(1,'hour').format())) {
                    $('#calendar').fullCalendar('unselect');
                    return false;
                }
                //alert(currView);
                if(currView == 'agendaDay'){
                    $('#add_appointmentm_form').trigger("reset");
                    var strtdt = moment(start).format();
                    var enddt = moment(end).format();
                    //alert(moment(start).format('LT'));
                    $('#appointmenttime').val(moment(start).format('LT'));
                    $('#appointmentdate').val(moment(start).format('l'));
                    /*$("div.selectStaff select").val(resource.id);
                    $('div.selectStaff option:not(:selected)').attr('disabled', true);*/
                    $("#staff").val(resource.id).trigger('change');
                    $('#myModaladdappoinment').modal('show');
                    //$('.modal').modal('show');
                }
            },

            dayClick: function(date, jsEvent, view, resource) {
                //alert('Current view: ' + view.name);
                currView = view.name;
                if(view.name != 'agendaDay'){
                    $('#calendar').fullCalendar('gotoDate',date);
                    $('#calendar').fullCalendar('changeView','agendaDay');
                } 
            },

            eventClick: function(event, element) {
                // Display the modal and set the values to the event values.
                var data = addCommonParams([]);
                var appointment_id = event.appointment_id;
                data.push({name:'appointment_id',value:appointment_id});
                $.ajax({
                    url:"<?php echo url('api/appointment_details');?>",
                    type:"POST",
                    data:data,
                    dataType: "json",
                    success:function(result)
                    {
                        console.log(result);
                        $('#clientDetails').html('');
                        $('#serviceStaff').html('');
                        $('#serviceDatetime').html('');
                        $('#appointmentDatetime').html('');
                        $("#appoinment-id").val(result.appoinment_details.appointment_id);
                        $("#bookingNote").val('');
                        $('#statusSection').html('');
                        $('#paymentSection').show();
                        $('#statusSection').hide();

                        //console.log(result.appoinment_details);
                        if(result.appoinment_details)
                        {
                            if(result.appoinment_details.client_image == "")
                            {
                                $('#clientImg').attr('src',"{{asset('public/assets/website/images/user-pic-sm-default.png')}}");
                            }
                            else
                            {
                                $('#clientImg').attr('src',result.appoinment_details.client_image);
                            }
                            if(result.appoinment_details.client_name != "" && result.appoinment_details.client_email != "")
                            {
                                $('#clientDetails').html(result.appoinment_details.client_name+'<br><span>'+result.appoinment_details.client_email+'</span>');
                            }
                            if(result.appoinment_details.service_name != "" && result.appoinment_details.cost != "" && result.appoinment_details.staff_name != "")
                            {
                                $('#serviceStaff').html('<i class="fa fa-circle-o "></i> '+result.appoinment_details.service_name+' ('+result.appoinment_details.cost+') <br><i class="fa fa-user-o "></i> '+result.appoinment_details.staff_name);
                            }
                            if(result.appoinment_details.start_time != "" && result.appoinment_details.end_time != "" && result.appoinment_details.appoinment_date != "")
                            {
                                $('#serviceDatetime').html(result.appoinment_details.start_time+' - '+result.appoinment_details.end_time+' ('+result.appoinment_details.duration+' Minutes) <br> '+result.appoinment_details.appoinment_date);
                            }
                            if(result.appoinment_details.booked_on != "")
                            {
                                $('#appointmentDatetime').html('Booked: '+ result.appoinment_details.booked_on);
                            }
                            if(result.appoinment_details.note != "")
                            {
                                $('#bookingNote').val(result.appoinment_details.note);
                            }

                            if(result.appoinment_details.status == 2){
                                $('#paymentSection').hide();
                                $('#statusSection').html('<p style="color: red;" ><i class="fa fa-times"></i> Cancelled</p>');
                                $('#statusSection').show();
                            }

                        }

                        $("#myModalAppointmentContent").modal('show');
                        $('.animationload').hide();
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    }
                });
            },

            /*eventResize: function(event, delta, revertFunc) {
                var data = addCommonParams([]);
                var appointment_id = event.appointment_id;
                var start_time = event.start;
                var end_time = event.end;
                var reschedule_type = 'event_resize';
                $("#reshedule_appointment_id").val(appointment_id);
                data.push({name:'appointment_id',value:appointment_id},
                        {name:'start_time',value:start_time},
                        {name:'end_time',value:end_time},
                        {name:'reschedule_type',value:reschedule_type});
                $.ajax({
                    url:"<?php echo url('api/add_appoinment');?>",
                    type:"POST",
                    data:data,
                    dataType: "json",
                    success:function(result)
                    {
                        $('.animationload').hide();
                        swal("Success", response.message , "success");
                    },
                    beforeSend: function()
                    {
                        $('.animationload').show();
                    }
                });

            }*/

        });


        $(".fc-axis").css("text-align","center");
        $(".fc-axis.fc-widget-header").html('<i class="fa fa-cog" style="font-size: 25px; cursor: pointer;"></i>');
        $(".fc-addButton-button").html('<i class="fa fa-file-text"></i>');
        $(".fc-refreshButton-button").html('<i class="fa fa-refresh"></i>');
        
        
        
        $(document).click(function(){
            $(".fc-axis.fc-widget-header").html('<i class="fa fa-cog" style="font-size: 25px; cursor: pointer;"></i>');
            $(".fc-axis").css("text-align","center");
            $(".fc-axis.fc-widget-header").bind("click", function(){
                $('#calendarsettingsModal').modal('show');
            });
        });


        $(".cancel-appoinment").click(function (e) {
            e.preventDefault();
            let data = addCommonParams([]);
            let id = $("#appoinment-id").val();
            data.push({name:'appoinment_id',value:id});
            if(id)
            {
                swal({
                    title: "Are you sure?",
                    text: "Once cancelled, you will not be able to active this appointment!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },function(isConfirm){

                        if (isConfirm){
                            $.ajax({
                                url: baseUrl+"/api/appoinment-cancel", 
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
                                        swal("Error", response.message , "error");
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
                            
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
            }
            else
            {
                swal("Error", response.message , "error");
            }
        });


        $('#calendar_settings_form').validate({
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
                            $('.animationload').hide();
                            $("#calendarsettingsModal").hide();
                            $("#calendar_settings_form").trigger("reset");
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

        $('#update_note_form').validate({
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
                            $('.animationload').hide();
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

        $('#months-tab a').click(function() {
            var month = $(this).attr('data-month');
            var m = moment([moment().year(), month, 1]);
            $('#calendar').fullCalendar('gotoDate', m );
            $('.fc-month-button').trigger('click');
        });

    });
    
</script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
$('.select-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
      if ( $(this).is(':visible'))
      {
        this.checked = true;  
      }
        //this.checked = true;                        
    });
});
$('.deselect-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
    if ( $(this).is(':visible'))
     {
        this.checked = false;  
     }                      
    });
});
</script>

@endsection