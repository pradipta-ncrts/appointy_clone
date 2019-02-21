@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<link href="{{asset('public/assets/website/css/spectrum.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
    .fc-scroller { overflow-x: visible !Important; }
    .mtop{margin-top:10px;}
    .apply-mulbx label{color:000;font-size:14px;text-align: left;}
    .aply-dv{width:100%;float:left;margin:0 0;}
    .aply-dv label{width:100%;float:left;margin:0 0 18px;font-size:16px; text-align: left;}
    .apply-mulbx .rb-email, .apply-mulbx .rb-phone{margin:0 8px 18px 0;}
    .email,
    .phone {display:none;}
    .rb-email:checked ~ .email {display:inline;}
    .rb-phone:checked ~ .phone {display:inline;}
</style>
@endsection
@section('content')
<?php 
$show_from = "07:00:00";
$show_till = "21:00:00";
$increment = "00:15:00";
$sel_increment = "15";
//echo $show_from."<<>>".$show_till."<<>>".$increment; exit;
$month_array = array('0'=>'JAN','1'=>'FEB','2'=>'MAR','3'=>'APR','4'=>'MAY','5'=>'JUN','6'=>'JUL','7'=>'AUG','8'=>'SEP','9'=>'OCT','10'=>'NOV','11'=>'DEC');
$currency_list = App\Http\Controllers\BaseApiController::currency_list();
$timezone = App\Http\Controllers\BaseApiController::time_zone(); 
?>
<div class="body-part">
    <div class="container-custm">
        <div class="upper-cmnsection">
            <div class="heading-uprlft">Update Service</div>
        </div>
        <!--<div class="leftpan">
            <div class="left-menu">
            <ul>
                <li><a href="{{url('/add_services')}}" class="active"> Add Service & Additional Options</a></li>
            </ul>
            </div>
            </div>-->
        <div class="full">
            <div class="col-md-12 row" id="ss" style="margin-top: 20px">
            <div class="cust-box">
                <div class="headRow whitebox ds clearfix ">
                    <div class="leftbar">
                        <h5><i class="fa fa-calendar"></i> What service is this?</h5>
                    </div>
                    <div class="rightbar">
                        <ul>
                        <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="headRow whitebox dsinside clearfix ">
                    <form name="edit_service" id="edit_service" method="post" action="{{url('api/update-service')}}">
                        <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
                        <div class="form-details">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="service_name">Service Name <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                                    <input class="form-control nomarginbottom" type="text" name="service_name" id="service_name" value="{{$service_details->service_name}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="service_location">Location <i class="fa fa-question" data-toggle="tooltip" title="Use the 'Location' field to specify how and where both parties will connect at the scheduled time.
                                    You can choose to show these details on the scheduling page, before a time is confirmed - OR - restrict the location to the confirmation page, after a meeting time has been selected." data-placement="right"></i></label>
                                    <input class="form-control nomarginbottom" type="text" name="service_location" id="service_location" value="{{$service_details->location}}" />
                                    <span class="specialnote">e.g. Joe's Coffee, I'll Call you, etc</span> 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="service_location">Timezone</label>
                                 <select data-live-search="true" name="service_timezone" id="service_timezone" >
                                    <option value="">Select Timezone </option>
                                    <?php
                                    foreach($timezone as $tzone)
                                    {
                                    ?>
                                    <option <?php if(!empty($service_details->timezone) && $service_details->timezone == $tzone['zone']) { ?> selected="" <?php } ?> value="<?=$tzone['zone'] ?>">
                                      <?=$tzone['diff_from_GMT'] . ' - ' . $tzone['zone'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <br>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="radio" <?php if($service_details->display_location == '1') { ?> checked="checked" <?php } ?> name="service_display_location" id="booking" value="1" />
                                <label class="right35px">Display location while booking</label>
                                <div class="clearfix break10px"></div>
                                <input type="radio" <?php if($service_details->display_location == '2') { ?> checked="checked" <?php } ?> name="service_display_location" id="confirm" value="2" />
                                <label class="right35px">Display location only after confirmation</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <label for="service_currency">Currency <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Select currency for your service." data-placement="right"></i> </label>
                                    <select name="service_currency" id="service_currency">
                                    <option value="">Select currency</option>
                                    <?php if(!empty($currency_list['currency_list'])) { foreach($currency_list['currency_list'] as $currency) { ?>
                                    <option <?php if($service_details->currency_id == $currency->currency_id) { ?> selected="selected" <?php } ?> value="{{$currency->currency_id}}">{{$currency->currency}}</option>
                                    <?php } } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="service_price">Price <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a price for your service." data-placement="right"></i> </label>
                                    <input class="form-control" type="text" name="service_price" id="service_price" value="{{$service_details->cost}}">
                                </div>
                            </div>
                        </div>
                        <?php if($service_details->capacity > 0) { ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label for="service_capacity">Capacity <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a capacity for your service." data-placement="right"></i> </label>
                                    <input class="form-control" type="text" name="service_capacity" id="service_capacity" value="{{$service_details->capacity}}">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="break20px"></div>
                        <label for="service_description">Description/Instructions</label>
                        <textarea class="form-control" rows="4" name="service_description" id="service_description">{{$service_details->description}}</textarea>
                        <div class="break20px"></div>
                        <div class="row">
                            <!--<div class="col-lg-6 col-md-6 col-sm-6">
                                <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date & Time' step. "></i> </label>
                                <input class="form-control" type="text" name="service_link" id="service_link" value="{{$service_details->service_link}}" readonly=""/>
                            </div>-->
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date & Time' step. "></i> </label>
                                <?php echo url('client/service-details/');?>
                            </div>
                           <div class="col-lg-3 col-md-3 col-sm-3">
                              <label for="service_link">&nbsp;</label>
                              <input class="form-control" type="text" name="service_link" id="service_link" value="{{$service_details->service_link}}" />
                           </div>
                            <div class="clearfix"></div>
                            <div class="break10px"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label for="service_category">List of categories</label>
                                <select name="service_category" id="service_category">
                                    <option value="">Select categories</option>
                                    <?php if(!empty($category_list)){ foreach($category_list as $category){ ?>
                                    <option <?php if($service_details->category_id == $category->category_id) { ?> selected="selected" <?php } ?> value="<?php echo $category->category_id;?>"><?php echo $category->category;?></option>
                                    <?php } } ?>
                                    <option value="new">New Category </option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="break10px"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 new-category-name" style="display: none;">
                                <label for="new_category_name">Category Name</label>
                                <input class="form-control" type="text" name="new_category_name" id="new_category_name" />
                            </div>
                            <div class="clearfix"></div>
                            <div class="break10px"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label for="service_color">Select Color <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                                <input type="text" name="togglePaletteOnly" id="togglePaletteOnly" style="display:none;">
                                <input type="hidden" name="service_color" id="service_color" value="{{$service_details->color}}">
                            </div>
                        </div>
                        <div class="text-right break20px">
                            <input type="button" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                            <input type="submit" class="btn btn-primary" value="Next" />
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="break20px hidden-xs"></div>
            <div class="cust-box">
                <form name="servie_duration_form" id="servie_duration_form" method="post" action="{{url('api/update-service-duration')}}">
                    <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
                    <div class="headRow whitebox ds  clearfix ">
                        <div class="leftbar">
                        <h5><i class="fa fa-history"></i> When can people book this service?</h5>
                        </div>
                        <div class="rightbar">
                        <ul>
                            <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="headRow whitebox dsinside clearfix" <?php if($service_details->duration == '0') { ?> style="display:block" <?php } ?> >
                        <div class="form-details">
                        <div>
                            <label for="Service Duration">Service Duration <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="This is where you can define how long your service will be. It can be as short as 1 minute or as long as 12 hours."></i> </label>
                            <input type="hidden" name="service_duration" id="service_duration" value="{{$service_details->duration}}">
                            <ul class="minutes">
                                <li class="duration <?php if($service_details->duration == 15 ) echo 'active'; ?>" data-duration="15"><a>15<br/>
                                    <label>min</label>
                                    </a> 
                                </li>
                                <li class="duration <?php if($service_details->duration == 30 ) echo 'active'; ?>" data-duration="30"><a>30<br/>
                                    <label>min</label>
                                    </a> 
                                </li>
                                <li class="duration <?php if($service_details->duration == 45 ) echo 'active'; ?>" data-duration="45"><a>45<br/>
                                    <label>min</label>
                                    </a> 
                                </li>
                                <li class="duration <?php if($service_details->duration != 15 && $service_details->duration != 30 && $service_details->duration != 45) echo 'Active'; ?>" data-duration="0"><a><input type="number" min="1" step="1" id="custom_duration" style="width:40%" <?php if($service_details->duration != 15 && $service_details->duration != 30 && $service_details->duration != 45) { ?> value="{{$service_details->duration}}" <?php } ?> ><br/>
                                    <label>custom min</label>
                                    </a> 
                                </li>
                            </ul>
                        </div>
                        </div>
                        <div class="form-details break20px">
                        <div>
                            <label>Date Range <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="This is where you can set a date range for your availability. You can choose between a rolling number of days into the future, a specific range of dates, or indefinitely into the future."></i> </label>
                            <p>Services can be scheduled over 60 running days<a data-toggle="modal" data-target="#daterangeModaledit"> Edit</a> </p>
                        </div>
                        </div>
                        <!--<div class="form-details break20px">
                        <div>
                            <label>Service Timezone <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Use this setting to control how your available hours are displayed from your scheduling page. Lock the timezone for in-person meetings or keep it set to local for meetings held virtually."></i> </label>
                            <p>You are in Central European Time. Your invitees will see your availability in their local time zone.<a data-toggle="modal" data-target="#myModaledit1"> Edit</a> </p>
                        </div>
                        </div>-->
                        <div class="form-details break20px">
                        <div>
                            <label>Availability <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="This is where you can set your available hours for this service type. Squdeer will offer time slots within these availability windows. Your default availability is 9:00am-5:00pm Monday through Friday, but this can be adjusted either one day at a time, or for several days at once."></i> </label>
                            <p>Set your available hours when people can schedule meetings with you. </p>
                        </div>
                        </div>
                        <div class="break20px"></div>
                        <!--<ul class="schedulebh showDekstop clearfix">
                        <li><a href="#" class="active">Hours </a></li>
                        <li><a href="#">Advanced </a></li>
                        </ul>-->
                        <div class="discount-box">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#hours">Hours</a></li>
                            <li><a data-toggle="tab" href="#advanced">Advanced</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="hours" class="tab-pane fade in active">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                                <div id="updated_calendar" style="display:none;"></div>
                            </div>
                            <div id="advanced" class="tab-pane fade">
                                <div class="from-group">
                                    <h4><strong>Availability Increments</strong></h4>
                                    <div class="row">
                                    <div class="col-md-6">Set the frequency of available time slots for your invitees.</div>
                                    <div class="col-md-6">
                                        <label>Show availability in increments of</label>
                                        <select name="availability_increments" id="availability_increments">
                                            <option value="10" <?php if($service_details->availability_increments == 10) { ?> selected="" <?php } ?> >10min</option>
                                            <option value="15" <?php if($service_details->availability_increments == 15) { ?> selected="" <?php } ?> >15min</option>
                                            <option value="20" <?php if($service_details->availability_increments == 20) { ?> selected="" <?php } ?> >20min</option>
                                            <option value="30" <?php if($service_details->availability_increments == 30) { ?> selected="" <?php } ?> >30min</option>
                                            <option value="60" <?php if($service_details->availability_increments == 60) { ?> selected="" <?php } ?> >60min</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="from-group">
                                    <h4><strong>Event Max Per Day</strong></h4>
                                    <div class="row">
                                    <div class="col-md-6">Use this optional setting to limit the number of events that can be scheduled in a day.</div>
                                    <div class="col-md-6">
                                        <label>Max number of events per day</label>
                                        <input type="number" name="max_service" id="max_service" min="1" step="1" class="form-control" style="width:40%;" <?php if($service_details->max_service > 0) { ?> value="{{$service_details->max_service}}" <?php } ?> >
                                    </div>
                                    </div>
                                </div>
                                <div class="from-group">
                                    <h4><strong>Minimum Scheduling Notice</strong></h4>
                                    <div class="row">
                                    <div class="col-md-6">Use this setting to prevent last minute events.</div>
                                    <div class="col-md-6">
                                        <label>Prevent events less than</label>
                                        <input type="number" name="minimum_scheduling_notice" id="minimum_scheduling_notice" min="1" step="1" class="form-control" style="width:40%;" <?php if($service_details->max_service > 0) { ?> value="{{$service_details->minimum_scheduling_notice}}" <?php } ?>> hours away
                                    </div>
                                    </div>
                                </div>
                                <div class="from-group">
                                    <h4><strong>Service Buffers</strong></h4>
                                    <div class="row">
                                    <div class="col-md-6">Use this to set aside preparation, rest or travel time before or after service. For example, if you define a 5 minute buffer before your services Squdeer will make sure you have 5 minutes of free time before your scheduled services.</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Buffer before service</label>
                                            <select name="buffer_before_service" id="buffer_before_service">
                                                <option <?php if($service_details->buffer_before_service == 0) { ?> selected="" <?php } ?> value="0">0min</option>
                                                <option <?php if($service_details->buffer_before_service == 5) { ?> selected="" <?php } ?> value="5">5min</option>
                                                <option <?php if($service_details->buffer_before_service == 10) { ?> selected="" <?php } ?> value="10">10min</option>
                                                <option <?php if($service_details->buffer_before_service == 15) { ?> selected="" <?php } ?> value="15">15min</option>
                                                <option <?php if($service_details->buffer_before_service == 30) { ?> selected="" <?php } ?> value="30">30min</option>
                                                <option <?php if($service_details->buffer_before_service == 45) { ?> selected="" <?php } ?> value="45">45min</option>
                                                <option <?php if($service_details->buffer_before_service == 60) { ?> selected="" <?php } ?> value="60">60min</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Buffer after service</label>
                                            <select name="buffer_after_service" id="buffer_after_service">
                                                <option <?php if($service_details->buffer_after_service == 0) { ?> selected="" <?php } ?> value="0">0min</option>
                                                <option <?php if($service_details->buffer_after_service == 5) { ?> selected="" <?php } ?> value="5">5min</option>
                                                <option <?php if($service_details->buffer_after_service == 10) { ?> selected="" <?php } ?> value="10">10min</option>
                                                <option <?php if($service_details->buffer_after_service == 15) { ?> selected="" <?php } ?> value="15">15min</option>
                                                <option <?php if($service_details->buffer_after_service == 30) { ?> selected="" <?php } ?> value="30">30min</option>
                                                <option <?php if($service_details->buffer_after_service == 45) { ?> selected="" <?php } ?> value="45">45min</option>
                                                <option <?php if($service_details->buffer_after_service == 60) { ?> selected="" <?php } ?> value="60">60min</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-details break20px">
                        <div>
                            <input type="hidden" name="is_secret" id="is_secret" value="{{$service_details->is_secret}}">
                            <!--<label>Secret Service <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="To make an service type available to only select invitees, you'll want to make the service type secret. This will make that service type only visible to people with whom you choose to share the service type link and will not show up on your main Squdeer page."></i> </label>
                                <div class="clearfix"></div>
                                <p class="inlineBlock">Hide this Service from your main Squdeer page.</p>
                                <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a>-->
                            <label>Secret Service <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="To make an service type available to only select invitees, you'll want to make the service type secret. This will make that service type only visible to people with whom you choose to share the service type link and will not show up on your main Squdeer page."></i> </label>
                            <div class="clearfix"></div>
                            <p class="inlineBlock">Hide this Service from your main Squdeer page.</p>
                            <button type="button" id="change-secret" class="btn btn-sm btn-toggle <?php if($service_details->is_secret == 1) echo 'Active'; ?>" data-toggle="button" aria-pressed="false" autocomplete="off" >
                                <div class="handle"></div>
                            </button>
                        </div>
                        </div>
                        <div class="break20px"></div>
                        <div class="text-right">
                        <input type="button" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                        </div>
                    </div>
                </form>
            </div>
            <?php if($service_details->duration > '0') { ?>
            <div class="break20px hidden-xs"></div>
            <h3 class="break30px">&nbsp; Additional Options</h3>
            <div class="cust-box">
                <div class="headRow whitebox  ds clearfix ">
                    <div class="leftbar">
                        <h5><i class="fa fa-user"></i> Invitee Questions</h5>
                    </div>
                    <div class="rightbar">
                        <ul>
                        <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="headRow whitebox  dsinside clearfix ">
                    <?php if(!empty($service_invitee_question)) { foreach($service_invitee_question as $invitee_question) { ?>
                        
                        <div class="form-details">
                            <div class="row">
                            <div class="col-lg-6 ans-box answertype" data-invitee-question-id="{{$invitee_question->invitee_question_id}}" data-answer-type="{{$invitee_question->answer_type}}">
                                <a href="javascript:void(0);" class="edit-ans"><i class="fa fa-pencil"></i></a>
                                <h3>{{$invitee_question->question}}</h3>
                                <?php if($invitee_question->answer_type == 1) { ?>
                                    <input class="form-control nomarginbottom" type="text" />
                                <?php } else if($invitee_question->answer_type == 2) { ?>
                                    <textarea class="form-control" rows="4"  ></textarea>
                                <?php } else if($invitee_question->answer_type == 3) { ?>
                                    <div class="form-group ">
                                        <?php if(!empty($invitee_question->answer_options)) { 
                                            $answer_option = explode('|',$invitee_question->answer_options);
                                            foreach($answer_option as $option) {
                                        ?>
                                        <input type="radio" name="payment_method"  disabled="true" value="">
                                        <label class="right35px">{{$option}}</label>
                                        <div class="clearfix break10px"></div>
                                        <?php } } ?>
                                    </div>
                                <?php } else if($invitee_question->answer_type == 4) { ?>
                                    <div class="checkbox">
                                        <?php if(!empty($invitee_question->answer_options)) { 
                                            $answer_option = explode('|',$invitee_question->answer_options);
                                            foreach($answer_option as $option) {
                                        ?>
                                        <label class="check">
                                        <input type="checkbox"  disabled="true"> &nbsp;&nbsp; {{$option}}
                                        <span class="checkmark"></span>
                                        </label>  
                                        <?php } } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            </div>
                        </div>

                    <?php } } ?>
                    
                    
                    <div class="form-details">
                        <div class="row">
                        <span class="footnote center-block text-left"> <a data-toggle="modal" data-target="#newquestionModal">Add New Question <i class="fa fa-plus"></i> </a></span>
                        <div class="clearfix"></div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                            <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="break20px hidden-xs"></div>
            <div class="cust-box">
                <div class="headRow whitebox  ds clearfix ">
                    <div class="leftbar">
                        <h5><i class="fa fa-envelope"></i> Invitee Notifications</h5>
                        <!--<ul>
                        <li>Calender, Invitations, No Reminders</li>
                        </ul>-->
                    </div>
                    <div class="rightbar">
                        <ul>
                        <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="headRow whitebox dsinside   clearfix ">
                    <div class="form-details break20px">
                        <div>
                        <label>Email Confirmationss <i class="fa fa-question"></i> </label>
                        <p>Your invitee will receive an email confirmation with links to create their own calender Service <a> Personalize</a> / <a> Switch to calender invitations</a> </p>
                        </div>
                    </div>
                    <div class="form-details break20px">
                        <div>
                        <label>Email Cancellations </label>
                        <p>Email notifications will be sent to your invitee if you cancel the service.<a> Personalize</a> </p>
                        </div>
                    </div>
                    <!--<div class="form-details break20px">
                        <div>
                        <label>Text reminders <i class="fa fa-question"></i> </label>
                        <div class="clearfix"></div>
                        <p class="inlineBlock">Your invitees will have the option to send text reminders. <a> Inactive</a> </p>
                        <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a> 
                        </div>
                        </div>-->
                    <div class="form-details break20px">
                        <div>
                        <label>Email reminders <i class="fa fa-question"></i> </label>
                        <div class="clearfix"></div>
                        <p class="inlineBlock">Your invitees will have the option to receive a reminder email. <a> Inactive</a> </p>
                        <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a> 
                        </div>
                    </div>
                    <div class="text-right break20px">
                        <input type="submit" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                    </div>
                </div>
            </div>
            <div class="break20px hidden-xs"></div>
            <div class="cust-box">
                <div class="headRow whitebox  ds padding10px clearfix ">
                    <div class="leftbar">
                        <h5><i class="fa fa-check-square-o "></i> Confirmation Page</h5>
                    </div>
                    <div class="rightbar">
                        <ul>
                        <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="headRow whitebox  dsinside padding10px clearfix">
                    <form name="service_confirmation_form" id="service_confirmation_form" method="post" action="{{url('api/update-service-confirmation')}}">
                        <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
                        <div class="form-details">
                        <div class="col-lg-6 col-md-6 col-sm-6 row">
                            <label for="Name">On confirmation <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="By default, service details will be displayed on a Squdeer hosted confirmation page after services are scheduled. Alternatively, you can choose to automatically redirect your invitees to an external URL upon confirmation."></i> </label>
                            <div class="form-inline break10px">
                                <select name="redirect_type" id="redirect_type">
                                    <option value="1" <?php if($service_details->redirect_type == 1) { ?> selected="selected" <?php } ?>>Display Squeedr confirmation page</option>
                                    <option value="2" <?php if($service_details->redirect_type == 2) { ?> selected="selected" <?php } ?>>Redirect to an external site</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="redirect_squdeer_section" <?php if($service_details->redirect_type == 2) { ?> style="display:none;"<?php } ?> >
                            <label for="Name">Display button to schedule another service? <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Direct your invitee back to your website or make it easy for them to schedule recurring services by adding a link to your service confirmation page."></i> </label>
                            <div class="form-inline break10px">
                                <input class="form-control" type="text" name="display_button_name" id="display_button_name" <?php if($service_details->display_button_name != '') { ?> value = "{{$service_details->display_button_name}}" <?php } else { ?> value="" disabled="disabled" <?php } ?> />
                                <button type="button" id="change_display_button" class="btn btn-sm btn-toggle <?php if($service_details->display_button_name != '') { echo 'active'; } ?>" data-toggle="button" aria-pressed="false" autocomplete="off" >
                                    <div class="handle"></div>
                                </button>
                            </div>
                            <p class="footnote">Use this section to display custom links after this Service is confirmed.</p>
                            <div class="alert alert-info alert-custom"> Custom links is a premium feature Upgrade your account</div>
                            <a class="btn btn-info break20px" id="add_custom_link">Add Custom Link</a>
                            <div class="clearfix"></div>
                            <div id="add_custom_link_section" style="display: none;">
                                <label for="add_link" class="break10px">Add Link </label>
                                <div class="form-inline break10px form-details">
                                    <input class="form-control nomarginbottom"  type="text" name="custom_button_name" id="custom_button_name" placeholder="Your Custom Link" <?php if($service_details->custom_button_name != '') { ?> value = "{{$service_details->custom_button_name}}" <?php } ?> />
                                    <!--<button type="button" id="change_custom_button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" >
                                    <div class="handle"></div>
                                    </button>-->
                                    <br>
                                    <br>
                                    <input class="form-control nomarginbottom"  type="text" name="custom_url" id="custom_url" placeholder="https://www.example.com" <?php if($service_details->custom_url != '') { ?> value = "{{$service_details->custom_url}}" <?php } ?> />
                                </div>
                                <a class="btn btn-info break20px" id="submit_custom_link">Add</a>
                                <a class="btn btn-default break20px" id="cancel_custom_link">Cancel</a>
                            </div>
                        </div>
                        <div id="redirect_external_section" <?php if($service_details->redirect_type == 1) { ?> style="display:none;" <?php } ?>>
                            <p class="footnote">Redirect is a Pro Feature. Upgrade your account to redirect after confirmation.</p>
                            <div class="clearfix"></div>
                            <label for="redirect_url" class="break10px">Redirect URL </label>
                            <div class="form-inline break10px form-details">
                                <input class="form-control nomarginbottom"  type="text" name="redirect_url" id="redirect_url" placeholder="https://www.example.com" <?php if($service_details->redirect_url != '') { ?> value = "{{$service_details->redirect_url}}" <?php } ?>/>
                            </div>
                        </div>
                        </div>
                        <div class="text-right break20px">
                        <input type="button" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                        </div>
                    </form>
                </div>
            </div>
            <div class=" break20px hidden-xs"></div>
            <div class="cust-box">
                <div class="headRow whitebox ds clearfix ">
                    <div class="leftbar">
                        <h5><i class="fa fa-credit-card"></i> Collect Payments</h5>
                    </div>
                    <div class="rightbar">
                        <ul>
                        <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="headRow whitebox  dsinside p clearfix">
                    <form name="service_payment_form" id="service_payment_form" method="post" action="{{url('api/update-service-payment')}}">
                        <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
                        <div class="alert alert-info alert-custom"> Payments is a pro Feature. <a>Upgrade your account</a> to add payments to this Service </div>
                        <div class="break20px"></div>
                        <div class="form-group">
                            <input type="radio" name="payment_method" <?php if($service_details->payment_method == 1) { ?> checked="checked" <?php } ?> value="1" />
                            <label class="right35px">Do not collect payments for this service</label>
                            <div class="clearfix break10px"></div>
                            <input type="radio" name="payment_method" <?php if($service_details->payment_method == 3) { ?> checked="checked" <?php } ?> value="3" />
                            <label class="right35px">Accept payment with stripe</label>
                            <div class="clearfix break10px"></div>
                            <input type="radio" name="payment_method" <?php if($service_details->payment_method == 2) { ?> checked="checked" <?php } ?> value="2" />
                            <label class="right35px">Accept payments with PayPal</label>
                        </div>
                        <div class="break20px"></div>
                        <div class="text-right break20px">
                            <input type="button" class="btn btn-grey" onclick="slideDiv(this);" value="Cancel" />
                            <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                        </div>
                    <form>
                </div>
            </div>
            <?php } ?>
            <div class="break20px"></div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Date Range Modal -->
<div class="modal fade" id="daterangeModaledit" role="dialog">
    <div class="modal-dialog add-pop">
    <!-- Modal content-->
    <div class="modal-content new-modalcustm">
        <form name="date_range_form" id="date_range_form" method="post" action="" enctype="multipart/form-data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Availability</h4>
            </div>
            <div class="modal-body clr-modalbdy">
                <div class="form-group">
                <label class="setting-lbl"><strong>When can services be scheduled?</strong></label>
                <select class="category" data-show-subtext="true" data-live-search="true" id="service_schedule_type" name="service_schedule_type" >
                    <option value="1">Over a period of rolling days</option>
                    <option value='2'>Over a date range</option>
                    <option value='3'>Indefinitely</option>
                </select>
                </div>
                <div class="form-group" id="rolling_date_section">
                <label class="setting-lbl">Your invitees will be offered availability for a number of days into the future.</label>
                <div class="row">
                    <div class="col-md-5">
                        <input type="number" min="1" step="1" class="form-control" name="rolling_day" id="rolling_day">
                    </div>
                    <div class="col-md-7"><span class="setting-spn">rolling days</span></div>
                </div>
                </div>
                <div class="form-group" id="date_range_section">
                <label class="setting-lbl">Your invitees will be offered availability within a defined range of dates.</label>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="date_range" id="date_range">
                    </div>
                </div>
                </div>
                <div class="form-group">
                <div class="discount-btnbx">
                    <button type="button" id="date_range_submit" class="btn btn-primary">Apply</button>
                    <button class="btn" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Invitee Question Modal -->
<div class="modal fade" id="newquestionModal" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <form name="add_invitee_question_form" id="add_invitee_question_form" method="post" action="{{url('api/add-invitee-question')}}" >
            <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
            <input type="hidden" name="is_question_active" id="is_question_active" value="1">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <h4 class="modal-title">New Question</h4>
            </div>
            <div class="modal-body clr-modalbdy">
               <div class="form-group">
                  <label class="setting-lbl"><strong>Question</strong> <sup>*</sup></label>
                  <textarea name="question" id="question" rows="5" cols="5"></textarea>
               </div>
               <div class="form-group">
                  <button type="button" id="isBlocked" class="isBlocked btn btn-sm btn-toggle pull-right active" data-toggle="button" aria-pressed="true" autocomplete="off">
                     <div class="handle"></div>
                  </button>
                  <input name="is_required" id="is_required" type="checkbox" value="1"> Required
               </div>
               <div class="form-group">
                  <label class="setting-lbl">Answer Type</label>
                  <select class="category" data-show-subtext="true" data-live-search="true" id="answer_type" name="answer_type">
                     <option value="1">One Line</option>
                     <option value="2">Multiple Lines</option>
                     <option value="3">Radio Buttons</option>
                     <option value="4">Checkboxes</option>
                     <!--<option value="5">Phone Numbers</option>-->
                  </select>
               </div>
               <div id="multiple_options" style="display:none;">
                  <div class="form-group">
                     <label class="setting-lbl">Answers</label>
                     <p id="answer_text"></p>
                     <input name="answers[]" id="answer1" class="form-control" type="text" value="" placeholder="Answer 1" >
                  </div>
                  <div class="form-group">
                     <input name="answers[]" id="answer2" class="form-control" type="text" value="" placeholder="Answer 2" >
                  </div>
                  <div id="TextBoxesGroup"></div>
                  <div class="form-group">
                     <a href="javascript:void(0);" id="addButton"> <i class="fa fa-plus"></i> Add Another</a>
                     <a href="javascript:void(0);" class="text-danger"  id="removeButton" style="display:none"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
                  </div>
               </div>
               <br>
               <!--<div class="form-group">
                  <p class="text-danger" id="delete_question"><i class="fa fa-trash" aria-hidden="true"></i> Delete Question</p>
               </div>-->
               <div class="form-group">
                  <div class="discount-btnbx">
                     <button type="submit" class="btn btn-primary">Apply</button>
                     <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Edit Answer Modal -->
<div class="modal fade" id="updatequestionModal" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content-->
        <div class="modal-content new-modalcustm">
            <form name="update_invitee_question_form" id="update_invitee_question_form" method="post" action="{{url('api/update-invitee-question')}}" >
                <input type="hidden" name="invitee_question_id" id="update_invitee_question_id" value="">
                <input type="hidden" name="is_question_active" id="update_is_question_active" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Update Question</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="form-group">
                        <label class="setting-lbl"><strong>Question</strong> <sup>*</sup></label>
                        <textarea name="question" id="update_question" rows="5" cols="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="update_isBlocked" class="isBlocked btn btn-sm btn-toggle pull-right active" data-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                        <input name="is_required" id="update_is_required" type="checkbox" value="1"> Required
                    </div>
                    <div class="form-group">
                        <label class="setting-lbl">Answer Type</label>
                        <select class="category" data-show-subtext="true" data-live-search="true" id="update_answer_type" name="answer_type">
                            <option value="1">One Line</option>
                            <option value="2">Multiple Lines</option>
                            <option value="3">Radio Buttons</option>
                            <option value="4">Checkboxes</option>
                            <!--<option value="5">Phone Numbers</option>-->
                        </select>
                    </div>
                    <div id="update_multiple_options" style="display:none;">
                        
                    </div>
                    <br>
                    <div class="form-group">
                        <p class="text-danger" id="delete_question" style="cursor:pointer"><i class="fa fa-trash" aria-hidden="true"></i> Delete Question</p>
                    </div>
                    <div class="form-group">
                        <div class="discount-btnbx">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <button class="btn" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Calendar Modal -->
<div class="modal fade" id="calendarModal" role="dialog">
    <div class="modal-dialog add-pop">
    <!-- Modal content-->
    <div class="modal-content new-modalcustm">
        <form name="update_availability_form" id="update_availability_form" method="post" action="{{url('api/update-service-availability')}}" enctype="multipart/form-data">
        <input type="hidden" name="service_id" value="{{$service_details->service_id}}">
        <input type="hidden" name="interval_count" id="interval_count" value="0">
        <input type="hidden" name="is_unavailable" id="is_unavailable" value="0">
        <input type="hidden" name="date_range_type" id="date_range_type" value="3">
        <input type="hidden" name="date_range_data" id="date_range_data" value="">
        <input type="hidden" name="rolling_day_data" id="rolling_day_data" value="">
        <input type="hidden" name="selected_dates" id="selected_dates" value="">

            <div id="primary_div">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Availability</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="form-group" id="interval_section">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="setting-lbl">From</label>
                                <input type="time" class="form-control" name="interval_from[]" value="09:00">
                            </div>
                            <div class="col-md-6">
                                <label class="setting-lbl">To</label>
                                <input type="time" class="form-control" name="interval_to[]" value="17:00">
                            </div>
                        </div>
                    </div>

                    <div id="IntervalsGroup"></div>
                    
                    <div class="form-group" id="other_interval_section">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="addInterval" style="cursor: pointer">
                                    <span class="add-interval-button pointer">+ New Interval</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="removeInterval" style="cursor: pointer; display: none;">
                                    <span class="remove-interval-button pointer text-danger" > Delete</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="unavailable_area_section" style="display:none;">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" style="width: 100%">Unavailable</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="unavailable_section">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="button" class="btn btn-primary" id="interval_unavailable" value="I'm Unavilable">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="available_section" style="display:none;">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="button" class="btn btn-default" id="interval_available" value="I'm Avilable">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="apply_all" data-day="" class="btn btn-primary" style="width: 100%">Apply to all <span id="today"></span></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="apply_only" data-day="" class="btn btn-primary" style="width: 100%">Apply to only selected date</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="">
                            <div class="pull-left" id="apply_multiple" style="cursor:pointer;">Or apply to multiple...</div>
                            <div class="pull-right text-danger" style="cursor:pointer;" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>

                
                </div>
            </div>
            
            <div id="secondary_div" class="apply-mulbx" style="display:none;">
                <div class="modal-header">
                    <button type="button" class="pull-left" id="apply_multiple_back"><</button>
                    <h4 class="modal-title">Apply to multiple...</h4>
                </div>   
                <div class="modal-body clr-modalbdy">
                    <input class="rb-email" name="multiple_preference" value="1" id="rb-email" type="radio" checked="checked" />
                    <label class="label" for="rb-email">specific dates</label>
                    <br>
                    <input class="rb-phone" name="multiple_preference" value="2" id="rb-phone" type="radio" />
                    <label class="label" for="rb-phone">repeating days of the week</label>
                    <br>
                    <label class="label email" for="email">
                        <div class="aply-dv">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="available_dates"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                    <label class="label phone" for="phone">
                        <div class="aply-dv">
                            <label><input type="checkbox" name="available_days[]" value="1"> Monday</label>
                            <label><input type="checkbox" name="available_days[]" value="2"> Tuesday</label>
                            <label><input type="checkbox" name="available_days[]" value="3"> Wednesday</label>
                            <label><input type="checkbox" name="available_days[]" value="4"> Thursday</label>
                            <label><input type="checkbox" name="available_days[]" value="5"> Friday</label>
                            <label><input type="checkbox" name="available_days[]" value="6"> Saturday</label>
                            <label><input type="checkbox" name="available_days[]" value="7"> Sunday</label>
                        </div>    
                    </label>

                    <div class="form-group ">
                        <div class="discount-btnbx mtop">
                            <input type="button" id="apply_multiple_submit" class="btn btn-primary pull-left" value="Apply">
                            <button class="btn pull-right" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    </div>
</div>

@section('custom_js')
<!-- fullCalendar -->
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/moment.min.js')}}"></script>
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/assets/website/plugins/fullcalendar/scheduler/scheduler.min.js')}}"></script>

<script src="{{asset('public/assets/website/js/spectrum.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

   $('#edit_service').validate({
       rules: {
           service_name: {
               required: true
           },
           service_timezone: {
               required: true
           },
           service_currency: {
               required: true
           },
           service_price: {
               required: true,
               number: true
           },
           service_link: {
               required: true,
               alphanumeric: true
           },
           service_category: {
               required: true
           }
       },
   
       messages: {
           service_name: {
               required: 'Please enter service name'
           },
           service_timezone: {
               required: 'Please enter service timezone'
           },
           service_currency: {
               required: 'Please choose currency'
           },
           service_price: {
               required: 'Please enter price',
               number: 'Please enter proper price'
           },
           service_link: {
               required: 'Please enter service link',
               alphanumeric: 'Letters, numbers, and underscores only please'
           },
           service_category: {
               required: 'Please choose category'
           }
       },
   
       submitHandler: function(form) {
           var data = $(form).serializeArray();
           //data.push({name: 'device_type', value: 1});
           data = addCommonParams(data);
           $.ajax({
               url: form.action,
               type: form.method,
               data:data ,
               dataType: "json",
               success: function(response) {
                   console.log(response);
                   if(response.response_status==1)
                   {
                       if(response.service_id != ''){
                           var url = "{{url('/edit_service/'.$request_data)}}";
                           window.location.href = url;
                       } else {
                           swal('Sorry!',response.message,'error');
                       }
                   }
                   else{
                       swal('Sorry!',response.message,'error');
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
   
   $('#servie_duration_form').validate({
       rules: {
           service_duration: {
               required: true,
               min: 1,
           }
       },
   
       messages: {
           service_duration: {
               required: 'Please enter service questions',
               min: 'Please enter value',
           }
       },
   
       submitHandler: function(form) {
           var data = $(form).serializeArray();
           //data.push({name: 'device_type', value: 1});
           data = addCommonParams(data);
           $.ajax({
               url: form.action,
               type: form.method,
               data:data ,
               dataType: "json",
               success: function(response) {
                   //console.log(response);
                   if(response.response_status==1)
                   {
                       if(response.service_id != ''){
                       var url = "{{url('/edit_service/'.$request_data)}}";
                       window.location.href = url; 
                       } else {
                           swal('Sorry!',response.message,'error');
                       }
                   }
                   else{
                       swal('Sorry!',response.message,'error');
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
   
   $('#service_confirmation_form').validate({
       rules: {
           redirect_url: {
               required : function () {
                               return $("#redirect_type").val() == '2';
                           }
           }
       },
   
       messages: {
           redirect_url: {
               required: 'Please enter redirect URL',
           }
       },
   
       submitHandler: function(form) {
           var data = $(form).serializeArray();
           //data.push({name: 'device_type', value: 1});
           data = addCommonParams(data);
           $.ajax({
               url: form.action,
               type: form.method,
               data:data ,
               dataType: "json",
               success: function(response) {
                   //console.log(response);
                   if(response.response_status==1)
                   {
                       if(response.service_id != ''){
                       var url = "{{url('/edit_service/'.$request_data)}}";
                       window.location.href = url; 
                       } else {
                           swal('Sorry!',response.message,'error');
                       }
                   }
                   else{
                       swal('Sorry!',response.message,'error');
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
   
   $('#service_payment_form').validate({
       submitHandler: function(form) {
           var data = $(form).serializeArray();
           //data.push({name: 'device_type', value: 1});
           data = addCommonParams(data);
           $.ajax({
               url: form.action,
               type: form.method,
               data:data ,
               dataType: "json",
               success: function(response) {
                   //console.log(response);
                   if(response.response_status==1)
                   {
                       if(response.service_id != ''){
                       var url = "{{url('/edit_service/'.$request_data)}}";
                       window.location.href = url; 
                       } else {
                           swal('Sorry!',response.message,'error');
                       }
                   }
                   else{
                       swal('Sorry!',response.message,'error');
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
   
   $('#add_invitee_question_form').validate({
       rules: {
           question: {
               required: true
           }
       },
   
       messages: {
           question: {
               required: 'Please enter service questions'
           }
       },
   
       submitHandler: function(form) {
           var data = $(form).serializeArray();
           //data.push({name: 'device_type', value: 1});
           data = addCommonParams(data);
           $.ajax({
               url: form.action,
               type: form.method,
               data:data ,
               dataType: "json",
               success: function(response) {
                   //console.log(response);
                   if(response.response_status==1)
                   {
                       if(response.service_id != ''){
                       var url = "{{url('/edit_service/'.$request_data)}}";
                       window.location.href = url; 
                       } else {
                           swal('Sorry!',response.message,'error');
                       }
                   }
                   else{
                       swal('Sorry!',response.message,'error');
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

   $('#update_invitee_question_form').validate({
        rules: {
            question: {
                required: true
            }
        },

        messages: {
            question: {
                required: 'Please enter service questions'
            }
        },

        submitHandler: function(form) {
            var data = $(form).serializeArray();
            //data.push({name: 'device_type', value: 1});
            data = addCommonParams(data);
            $.ajax({
                url: form.action,
                type: form.method,
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.response_status==1)
                    {
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                $('#updatequestionModal').modal('hide');
                                location.reload();
                            }
                        );
                    }
                    else{
                        swal('Sorry!',response.message,'error');
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
   })
   
   $("#togglePaletteOnly").spectrum({
           showPaletteOnly: true,
           togglePaletteOnly: true,
           hideAfterPaletteSelect:true,
           togglePaletteMoreText: 'more',
           togglePaletteLessText: 'less',
           color: '{{$service_details->color}}',
           palette: [
               ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
               ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
               ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
               ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
               ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
               ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
               ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
               ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
           ]
   });
   
   $("#togglePaletteOnly").on('change.spectrum', function(e, tinycolor) {
       var hexcolor = tinycolor.toHexString();
       $('#service_color').val(hexcolor);
   });
   
   $('.duration').click(function(){
       var duration = $(this).data('duration');
       $('.duration').removeClass('active');
       $(this).addClass('active');
       $('#service_duration').val(duration);
       $('#custom_duration').val('');
   });
   
   $('#custom_duration').keyup(function(){
       $('#service_duration').val($(this).val());
   });
   
   
   $(function() {
       $('#date_range_section').hide(); 
       $('#service_schedule_type').change(function(){
           if($('#service_schedule_type').val() == '1') {
               $('#rolling_date_section').show(); 
               $('#date_range_section').hide();
           } else if($('#service_schedule_type').val() == '2') {
               $('#rolling_date_section').hide(); 
               $('#date_range_section').show(); 
           } else {
           $('#rolling_date_section').hide(); 
           $('#date_range_section').hide();
           }
       });
   
       $('input[name="date_range"]').daterangepicker();

       $('#date_range_submit').click(function(){
            
            var service_schedule_type = $('#service_schedule_type').val();
            var rolling_day = $('#rolling_day').val();
            var date_range = $('#date_range').val();
            var result = date_range.split(' - ');
            var start_date = result[0];
            var end_date = result[1];

            // Update Values //
            $("#date_range_type").val(service_schedule_type);
            if(service_schedule_type == 1){
                $("#date_range_data").val('');
                $("#rolling_day_data").val(rolling_day);
            } else if(service_schedule_type == 2){
                $("#date_range_data").val(date_range);
                $("#rolling_day_data").val('');
            } else {
                $("#date_range_data").val('');
                $("#rolling_day_data").val('');
            }


            var validRange = "";
            if(service_schedule_type == 1){
                validRange = function(nowDate) {
                            return {
                            start: nowDate,
                            end: nowDate.clone().add(rolling_day, 'days')
                            };
                        }
            } else if(service_schedule_type == 2){
                validRange = {
                    start: start_date,
                    end: end_date
                }
            }
            
           // Display Updated Calendar //
            $('#calendar').hide();
            $('#updated_calendar').show();
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            // document ready
            var date = new Date();
            var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
            var currView = "";
            var minTime = "<?php echo $show_from;?>";
            var maxTime = "<?php echo $show_till;?>";
            var slotDuration = "<?php echo $increment;?>";

            $('#updated_calendar').fullCalendar({
                //hide the license warning//
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                //Settings//
                slotDuration: slotDuration,
                allDaySlot: false,
                minTime: minTime,
                maxTime: maxTime,
                defaultView: 'month',
                timeFormat: 'hh:mm a',
                //date//
                //defaultDate: '2018-04-07',
                editable: false,
                selectable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: false, // can click day/week names to navigate views

                validRange: validRange,
                
                header: {
                    left: '',
                    center: 'prev,title,next',
                    right: ''
                },

                events: [
                    { id: '1', resourceId: '2', start: '2018-12-21T09:00:00', end: '2018-12-21T10:00:00', title: 'event 1' },
                    { id: '2', resourceId: '3', start: '2018-12-21T09:30:00', end: '2018-12-21T10:30:00', title: 'event 2' },
                    { id: '3', resourceId: '2', start: '2018-12-25T07:30:00', end: '2018-12-25T08:30:00', title: 'event 3' },
                    { id: '4', resourceId: '3', start: '2018-12-25T10:00:00', end: '2018-12-25T11:15:00', title: 'event 4' }
                ],

                /*selectConstraint: "businessHours",*/
                
                select: function(start, end, jsEvent, view, resource) {
                    //alert('Current view: ' + view.name);
                    // You could fill in the start and end fields based on the parameters
                    /*if(start.isBefore(moment())) {
                        $('#calendar').fullCalendar('unselect');
                        return false;
                    }*/
                    if(start.isBefore(moment())) {
                        $('#calendar').fullCalendar('unselect');
                        return false;
                    }
                    
                },

                dayRender: function(date, cell){
                    if (moment().diff(date,'days') > 0){
                        cell.css("background-color","#f2f2f2");
                    }
                },

                dayClick: function(date, jsEvent, view) {
                    $('#modalTitle').text(date.format());
                    $('#today').text(date.format('dddd'));
                    $('#apply_all').attr('data-day',date.format('dddd'));
                    $('#apply_only').attr('data-day',date.format());
                    $('#calendarModal').modal('show');
                }

            });

            
            //Modal Hide//
            $("#daterangeModaledit").modal('hide');
       });
   
   
       $('#answer_type').change(function(){
           if($('#answer_type').val() == '3') {
               $('#answer_text').html('<small>Invitee can select one of the following:</small>');
               $('#multiple_options').show();
           } else if($('#answer_type').val() == '4'){
               $('#answer_text').html('<small>Invitee can select one or many of the following:</small>');
               $('#multiple_options').show();
           } else {
               $('#multiple_options').hide();
           }
       });

   });
   
   $('#daterangeModaledit').on('hidden.bs.modal', function () {
       $(this).find('form').trigger('reset');
       $('#rolling_date_section').show(); 
       $('#date_range_section').hide();
   });
   
   $('#change-secret').click(function(){
       var ariapressed = $(this).attr('aria-pressed');
       if(ariapressed === 'false'){
           $('#is_secret').val('1');
       } else {
           $('#is_secret').val('0');
       }
   });
   
   
   $('#isBlocked').click(function(){
       var ariapressed = $(this).attr('aria-pressed');
       if(ariapressed === 'false'){
           $('#is_question_active').val('1');
       } else {
           $('#is_question_active').val('0');
       }
   });

   $('#update_isBlocked').click(function(){
       var ariapressed = $(this).attr('aria-pressed');
       if(ariapressed === 'false'){
           $('#update_is_question_active').val('1');
       } else {
           $('#update_is_question_active').val('0');
       }
   });
   
   $(document).ready(function(){
   
           var counter = 2;
       
           $("#addButton").click(function () {
       // alert(counter);   
           counter++;
           $('#removeButton').show();
               if(counter==10){
                   $('#addButton').hide();
               } 
               
               var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
               newTextBoxDiv.after().html('<div class="form-group"><input name="answers[]" id="answer'+counter+'" class="form-control" type="text" value="" placeholder="Answer '+counter+'" ></div>');
           
               newTextBoxDiv.appendTo("#TextBoxesGroup");
               
           $('#count').val(counter);
           });
   
           $("#removeButton").click(function () {
           //alert(counter);
               if(counter==10)
               {
                   $('#addButton').show();
               }  
               $("#TextBoxDiv" + counter).remove();
           
               if(counter==3){
               $("#TextBoxDiv" + counter).remove();
               $('#removeButton').hide();
               }
               counter--;
               $('#count').val(counter);
           });
               
   });
   
   $(document).on('change','#service_category',function() {
       let val = $(this).val();
       //alert(val);
       if(val=="new")
       {
           $(".new-category-name").show();
       }
       else
       {
           $(".new-category-name").hide();
           $('#new_category_name').val('');
       }
   });
   
   $(document).on('change','#redirect_type',function() {
       let val = $(this).val();
       //alert(val);
       if(val=="1")
       {
           $("#redirect_squdeer_section").show();
           $("#redirect_external_section").hide();
           $('#display_button_name').val('');
           $('#display_button_name').prop( "disabled", true );
           $('#change_display_button').removeClass('active');
           $('#redirect_url').val('');
           $('#custom_button_name').val('');
           $('#custom_url').val('');
   
       }
       else
       {
           $("#redirect_squdeer_section").hide();
           $("#redirect_external_section").show();
           $('#display_button_name').val('');
           $('#display_button_name').prop( "disabled", true );
           $('#change_display_button').removeClass('active');
           $('#redirect_url').val('');
           $('#custom_button_name').val('');
           $('#custom_url').val('');
       }
   });
   
   $('#add_custom_link').click(function(){
       $('#add_custom_link').hide();
       $('#add_custom_link_section').show();
   });
   
   $('#cancel_custom_link').click(function(){
       $('#add_custom_link').show();
       $('#add_custom_link_section').hide();
   });
   
   $('#change_display_button').click(function(){
     var ariapressed = $(this).attr('aria-pressed');
     if(ariapressed === 'false'){
       $('#display_button_name').val('Schedule another service');
       $('#display_button_name').prop( "disabled", false );
     } else {
       $('#display_button_name').val('');
       $('#display_button_name').prop( "disabled", true );
     }
   });
   
   $('.answertype').click(function(e){
        e.preventDefault();
        var data = addCommonParams([]);
        var invitee_question_id = $(this).data('invitee-question-id');
        var answer_type = $(this).data('answer-type');
        $('#update_invitee_question_id').val(invitee_question_id);
        $('#update_answer_type').val(answer_type);
        data.push({name:'invitee_question_id',value:invitee_question_id});
        if(invitee_question_id)
        {
            $.ajax({
                url: baseUrl+"/api/invitee-question-details", 
                type: "POST", 
                data: data, 
                dataType: "json",
                success: function(response) 
                {
                    console.log(response);          
                    let invitee_question_id = response.invitee_question_details.invitee_question_id;
                    let service_id = response.invitee_question_details.service_id;
                    let question = response.invitee_question_details.question;
                    let answer_type = response.invitee_question_details.answer_type;
                    let answer_options = response.invitee_question_details.answer_options;
                    let is_required = response.invitee_question_details.is_required;
                    let is_blocked = response.invitee_question_details.is_blocked;
                    $("#update_invitee_question_id").val(invitee_question_id);
                    $("textarea#update_question").val(question);
                    if(is_required == 1){
                        $("input[name='is_required']").prop('checked', true);
                    } else {
                        $("input[name='is_required']").prop('checked', false);
                    }
                    //$('#answer_type select').val(answer_type);
                    if(is_blocked == 1){
                        $("#update_isBlocked").removeClass('active');
                    } else {
                        $("#update_isBlocked").addClass('active');
                    }
                    
                    $('#update_answer_type').prop("disabled", true);
                    $('#update_answer_type option[value="'+answer_type+'"]').attr('selected','selected');
                    var checkbox_text = "";
                    if(answer_type == 3 || answer_type == 4){
                        var chk_arr = answer_options.split('|');
                        var chk_arr_lngh = chk_arr.length;
                        checkbox_text += '<div class="form-group"><label class="setting-lbl">Answers</label><p><small>Invitee can select one of the following:</small></p><input name="answers[]" id="" class="form-control" type="text" value="'+chk_arr[0]+'" placeholder="Answer 1" ></div>'
                        if(chk_arr_lngh > 1){
                            for(var i=1; i < chk_arr_lngh; i++){
                                checkbox_text += '<div class="form-group"><input name="answers[]" id="" class="form-control" type="text" value="'+chk_arr[i]+'" placeholder="Answer 2" ></div>';
                            }
                        }
                    }

                    $('#update_multiple_options').html(checkbox_text).show();
                    $('#updatequestionModal').modal('show');
                    $('.animationload').hide();
                    
                },
                beforeSend: function()
                {
                    $('.animationload').show();
                },
                
            });
        }
        else
        {
            swal("Error", response.message , "error");
        }

   });

    $("#delete_question").click(function (event) {
        event.preventDefault();
        let invitee_question_id = $('#update_invitee_question_id').val();
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will loose all the details of the invitee question!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, not now!",
        closeOnConfirm: false,
        closeOnCancel: true
        },function(isConfirm){

            if (isConfirm){
                let data = addCommonParams([]);
                //alert(invitee_question_id);
                data.push({name:'invitee_question_id', value:invitee_question_id});
                $.ajax({
                    url: baseUrl+"/api/delete-invitee-question", 
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
                        //$('.animationload').hide();
                    }
                });
            }
        });
    });


    // Calendar //
    $(function() {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
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
            defaultView: 'month',
            timeFormat: 'hh:mm a',
            //date//
            //defaultDate: '2018-04-07',
            editable: false,
            selectable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: false, // can click day/week names to navigate views
            displayEventTime: false,

            header: {
                left: '',
                center: 'prev,title,next',
                right: ''
            },

            events: [
                <?php
                foreach ($service_availability_list as $key => $value)
                {
                ?>
                { 
                    title: '<?=date('h:i A',strtotime($value['start_date_time'])).' - '.date('h:i A',strtotime($value['end_date_time']));?>',
                    start: '<?=$value['start_date_time'];?>',
                    end: '<?=$value['end_date_time'];?>',
                },
               <?php
                }
               ?>
                /*{ id: '1', start: '2019-01-21T09:00:00', end: '2019-01-21T10:00:00', title: '9AM - 5PM' },
                { id: '2', start: '2019-01-21T09:30:00', end: '2019-01-21T10:30:00', title: 'event 2' },
                { id: '3', start: '2019-01-25T07:30:00', end: '2019-01-25T08:30:00', title: 'event 3' },
                { id: '4', start: '2019-01-25T10:00:00', end: '2019-01-25T11:15:00', title: 'event 4' }*/
            ],

            /*selectConstraint: "businessHours",*/
            
            select: function(start, end, jsEvent, view, resource) {
                //alert('Current view: ' + view.name);
                // You could fill in the start and end fields based on the parameters
                /*if(start.isBefore(moment())) {
                    $('#calendar').fullCalendar('unselect');
                    return false;
                }*/
                if(start.isBefore(moment())) {
                    $('#calendar').fullCalendar('unselect');
                    return false;
                }
                
            },

            dayRender: function(date, cell){
                if (moment().diff(date,'days') > 0){
                    cell.css("background-color","#f2f2f2");
                }
            },

            dayClick: function(date, jsEvent, view) {
                $('#modalTitle').text(date.format());
                $('#today').text(date.format('dddd'));
                $('#apply_all').attr('data-day',date.format('dddd'));
                $('#apply_only').attr('data-day',date.format());
                $('#calendarModal').modal('show');
            }

        });
    });

    $(document).ready(function(){

        var counter = 0;
        
        $("#addInterval").click(function () {
            // alert(counter);   
            counter++;
            $('#removeInterval').show();
            if(counter==20){
                $('#addInterval').hide();
            } 

            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'IntervalDiv' + counter);
            newTextBoxDiv.after().html('<div class="form-group"><div class="row"><div class="col-md-6"><label class="setting-lbl">From</label><input type="time" class="form-control" name="interval_from[]"></div><div class="col-md-6"><label class="setting-lbl">To</label><input type="time" class="form-control" name="interval_to[]"></div></div></div>');

            newTextBoxDiv.appendTo("#IntervalsGroup");

            $('#interval_count').val(counter);
        });

        $("#removeInterval").click(function () {
            //alert(counter);
            if(counter==20)
            {
                $('#addInterval').show();
            }  
            $("#IntervalDiv" + counter).remove();

            if(counter==1){
                $("#IntervalDiv" + counter).remove();
                $('#removeInterval').hide();
            }
            counter--;
            $('#interval_count').val(counter);
        });

        $('#interval_unavailable').click(function(){
            $("#interval_section").hide();
            $("#other_interval_section").hide();
            $("#unavailable_area_section").show();
            $("#is_unavailable").val(1);
            $("#unavailable_section").hide();
            $("#available_section").show();
        });

        $('#interval_available').click(function(){
            $("#interval_section").show();
            $("#other_interval_section").show();
            $("#unavailable_area_section").hide();
            $("#is_unavailable").val(0);
            $("#unavailable_section").show();
            $("#available_section").hide();
        });

        $("#apply_multiple").click(function(){
            $("#primary_div").hide();
            $("#secondary_div").show();
        });

        $("#apply_multiple_back").click(function(){
            $("#primary_div").show();
            $("#secondary_div").hide();
        });


        $("#available_dates").multiDatesPicker({
            minDate:0
        });   


        // Edit Availability Form Submit //
        $("#apply_all").click(function(){
            var form = $(this).parents('form:first');
            var apply_day = $(this).data('day');
            var data = $(form).serializeArray();
            data.push({name: 'apply_day', value: apply_day},{name: 'from_submit', value: 1});
            data = addCommonParams(data);
            console.log(data);
            $.ajax({
                url: baseUrl+"/api/update-service-availability", 
                type: "POST",
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.response_status==1)
                    {
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                $('#calendarModal').modal('hide');
                                location.reload();
                            }
                        );
                    }
                    else{
                        swal('Sorry!',response.message,'error');
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

        $("#apply_only").click(function(){
            var form = $(this).parents('form:first');
            var apply_day = $(this).data('day');
            var data = $(form).serializeArray();
            data.push({name: 'apply_day', value: apply_day},{name: 'from_submit', value: 2});
            data = addCommonParams(data);
            console.log(data);
            $.ajax({
                url: baseUrl+"/api/update-service-availability", 
                type: "POST", 
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.response_status==1)
                    {
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                $('#calendarModal').modal('hide');
                                location.reload();
                            }
                        );
                    }
                    else{
                        swal('Sorry!',response.message,'error');
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

        $("#apply_multiple_submit").click(function(){
            var form = $(this).parents('form:first');
            var available_dates = $('#available_dates').val();
            $('#selected_dates').val(available_dates);
            var data = $(form).serializeArray();
            data.push({name: 'from_submit', value: 3});
            data = addCommonParams(data);
            console.log(data);
            $.ajax({
                url: baseUrl+"/api/update-service-availability", 
                type: "POST",
                data:data ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response.response_status==1)
                    {
                        swal({title: "Success", text: response.message, type: "success"},
                            function(){ 
                                $('#calendarModal').modal('hide');
                                location.reload();
                            }
                        ); 
                    }
                    else{
                        swal('Sorry!',response.message,'error');
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


        $('#calendarModal').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
        });


        /*$('input[type=radio][name=multiple_preference]').change(function() {
            alert(this.value);
            if (this.value == '1') {
                // Clear Select //
                $('input[name=available_days]').removeAttr('checked');
            }
            else if (this.value == '2') {
                // Clear calendar //
                $('#selected_dates').val('');
            }
        });*/

    });
</script>
@endsection