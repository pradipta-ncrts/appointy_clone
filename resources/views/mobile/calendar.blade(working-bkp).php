@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.print.min.css')}}" media="print">
<link rel="stylesheet" href="{{asset('public/assets/website/plugins/fullcalendar/scheduler/scheduler.min.css')}}">
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Calendar</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
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
                           <div class="link-e">
                              <a href="#"><i class="fa fa-times"></i> Cancel</a>
                              <a href="#"><i class="fa fa-repeat"></i> Reschedule</a>
                              <a href="#"><i class="fa fa-star-half-o "></i> Request a review</a>
                           </div>
                           <div class="clearfix">&nbsp;</div>
                           <br>
                           <!--<a href="#"><i class="fa fa-file-o"></i> Appointment Note</a>-->
                           <textarea rows="4"> Write here..</textarea>
                           <br>
                           <div class="clearfix"></div>
                           <button type="button" class="btn btn-primary butt-next break10px">Add Payment ($100.00) </button> 
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
                <form name="add_appointmentm_form" id="add_appointmentm_form" method="post" action="{{ url('api/add_appoinment') }}" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    <h4 class="modal-title"> Satff Filter</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <?php
                                foreach ($staff_list as $key => $value)
                                {
                                ?>
                                <input name="appoinmnet_filter_stuff_id" type="checkbox" value="<?=$value->staff_id;?>">
                                <div class="user-bkd">
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
                                    <br><span><?=$value->email;?></span>
                                </h2>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center"> 
                        <input type="submit" id="submit_appointmentm_form" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block" name="submit" value="submit">
                        <!-- <button type="button" >Submit</button> --> </div>
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

        $('#calendar').fullCalendar({
            //hide the license warning//
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            //Settings//
            slotDuration: '00:15:00',
            allDaySlot: false,
            minTime: "07:00:00",
            maxTime: "21:00:00",
            defaultView: 'agendaDay',
            //date//
            //defaultDate: '2018-04-07',
            editable: true,
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
                { id: '<?=$value->staff_id;?>', title: '<?=$value->full_name;?>'},
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
                    start: new Date('<?=$value->start_date;?>'),
                    end: new Date('<?=$value->end_time;?>'),
                    //allDay: false,
                    backgroundColor: "<?=$value->colour_code;?>",
                    borderColor: "<?=$value->colour_code;?>",
                    appointment_id: '<?=$value->appointment_id;?>',
                },
               <?php
                }
               ?>
            ],

            select: function(start, end, jsEvent, view, resource) {
                //console.log(resource);
                // Display the modal.
                // You could fill in the start and end fields based on the parameters
                if(start.isBefore(moment())) {
                    $('#calendar').fullCalendar('unselect');
                    return false;
                }
                //alert(currView);
                if(currView == 'agendaDay'){
                    var strtdt = moment(start).format();
                    var enddt = moment(end).format();
                    //alert(moment(start).format('LT'));
                    $('#appointmenttime').val(moment(start).format('LT'));
                    $('#appointmentdate').val(moment(start).format('l'));
                    $("div.selectStaff select").val(resource.id);
                    $('div.selectStaff option:not(:selected)').attr('disabled', true);
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
                data.push({name:'appointment_id',value:30});
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

                        console.log(result.appoinment_details);
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
            
        });


        $(".fc-axis").css("text-align","center");
        $(".fc-axis.fc-widget-header").html('<i class="fa fa-cog" style="font-size: 25px;"></i>');
        $(".fc-addButton-button").html('<i class="fa fa-file-text"></i>');
        $(".fc-refreshButton-button").html('<i class="fa fa-refresh"></i>');
        

        $(document).click(function(){
            $(".fc-axis.fc-widget-header").html('<i class="fa fa-cog" style="font-size: 25px;"></i>');
            $(".fc-axis").css("text-align","center");
        });

    });

    
</script>

@endsection