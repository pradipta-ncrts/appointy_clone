@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<link href="{{asset('public/assets/website/css/spectrum.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
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
                           <div class="form-group">
                              <input type="radio" <?php if($service_details->display_location == '1') { ?> checked="checked" <?php } ?> name="service_display_location" id="booking" value="1" />
                              <label class="right35px">Display location while booking</label>
                              <div class="clearfix break10px"></div>
                              <input type="radio" <?php if($service_details->display_location == '2') { ?> checked="checked" <?php } ?> name="service_display_location" id="confirm" value="2" />
                              <label class="right35px">Display location only after confirmation</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                  <label for="service_currency">Currency <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Select currency for your service." data-placement="right"></i> </label>
                                  <select name="service_currency" id="service_currency">
                                    <option value="">Select currency</option>
                                    <option <?php if($service_details->currency_id == '1') { ?> selected="selected" <?php } ?> value="1">INR</option>
                                    <option <?php if($service_details->currency_id == '2') { ?> selected="selected" <?php } ?> value="2">USD</option>
                                    <option <?php if($service_details->currency_id == '3') { ?> selected="selected" <?php } ?> value="3">POUND</option>
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
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date & Time' step. "></i> </label>
                              <input class="form-control" type="text" name="service_link" id="service_link" value="{{$service_details->service_link}}" readonly=""/>
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
                           <input type="button" class="btn btn-grey" value="Cancel" />
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
                              <h2>July 8 - July 21, 2018</h2>
                              <div class="break10px"></div>
                              <div class="tableBH">
                                  <table class="table table-bordered table-custom table-bh tableBhMobile" >
                                    <thead>
                                        <tr>
                                          <th>Sunday</th>
                                          <th>Monday</th>
                                          <th>Tuesday</th>
                                          <th>Wednesday</th>
                                          <th>Thursday</th>
                                          <th>Friday</th>
                                          <th>Saturday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <td data-column="Sunday">
                                              <span>8</span>
                                              <div class="clearfix"></div>
                                          </td>
                                          <td data-column="Monday">
                                              <span>9</span>
                                              <div class="clearfix"></div>
                                          </td>
                                          <td data-column="Tuesday">
                                              <span>10</span>
                                              <ul>
                                                <li>9AM - 5PM</li>
                                              </ul>
                                              <div class="clearfix"></div>
                                          </td>
                                          <td><span>11</span></td>
                                          <td data-column="Wednesday">
                                              <span>TODAY</span>
                                              <ul>
                                                <li>9AM - 5PM</li>
                                              </ul>
                                              <div class="clearfix"></div>
                                          </td>
                                          <td data-column="Thursday"><span>12</span></td>
                                          <td data-column="Friday">
                                              <span>13</span>
                                              <ul>
                                                <li>9AM - 5PM</li>
                                              </ul>
                                              <div class="clearfix"></div>
                                          </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                  <div class="break10px"></div>
                                  <span class="footnote center-block text-center"> <a>Show More <i class="fa fa-angle-down"></i> </a></span> 
                              </div>
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
                        <input type="button" class="btn btn-grey" value="Cancel" />
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
                     <!--<div class="form-details">
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="Name">Name <sup>*</sup> </label>
                              <input class="form-control nomarginbottom" type="text" />
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="Location">Email Address <sup>*</sup> </label>
                              <input class="form-control nomarginbottom" type="text" />
                           </div>
                        </div>
                     </div>-->
                     <span class="footnote center-block text-left"> <a data-toggle="modal" data-target="#newquestionModal">Add New Question <i class="fa fa-plus"></i> </a></span>
                     <div class="clearfix"></div>
                     <div class="text-right">
                        <input type="submit" class="btn btn-grey" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
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
                        <input type="submit" class="btn btn-grey" value="Cancel" />
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
                     <div class="form-details">
                        <div class="col-lg-6 col-md-6 col-sm-6 row">
                           <label for="Name">On confirmation <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="By default, service details will be displayed on a Squdeer hosted confirmation page after services are scheduled. Alternatively, you can choose to automatically redirect your invitees to an external URL upon confirmation."></i> </label>
                           <div class="form-inline break10px">
                              <select>
                                 <option>Display Squeedr confirmation page</option>
                                 <option>Redirect to an external site</option>
                              </select>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <label for="Name">Display button to schedule another service? <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Direct your invitee back to your website or make it easy for them to schedule recurring services by adding a link to your service confirmation page."></i> </label>
                        <div class="form-inline break10px">
                           <input class="form-control nomarginbottom" disabled="disabled" type="text" />
                           <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a> 
                        </div>
                     </div>
                     <p class="footnote">Use this section to display custom links after this Service is confirmed.</p>
                     <div class="alert alert-info alert-custom"><span class="text-warning"> Custom links is a premium feature</span><a> Upgrade your account</a></div>
                     <a class="btn btn-info break20px">Add Custom Link</a>
                     <div class="clearfix"></div>
                     <label for="Name" class="break10px">Add Link </label>
                     <div class="form-inline break10px form-details">
                        <input class="form-control nomarginbottom"  type="text" />
                        <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off" ></i></a> 
                     </div>
                     <div class="text-right break20px">
                        <input type="submit" class="btn btn-grey" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                     </div>
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
                     <div class="alert alert-info alert-custom"> Payments is a pro Feature. <a>Upgrade your account</a> to add payments to this Service </div>
                     <div class="break20px"></div>
                     <div class="form-group">
                        <input type="radio" checked="checked" name="payment" value="nopayment" />
                        <label class="right35px">Do not collect payments for this service</label>
                        <div class="clearfix break10px"></div>
                        <input type="radio" name="payment" value="stripe" />
                        <label class="right35px">Accept payment with stripe</label>
                        <div class="clearfix break10px"></div>
                        <input type="radio" name="payment" value="paypal" />
                        <label class="right35px">Accept payments with PayPal</label>
                     </div>
                     <div class="break20px"></div>
                     <div class="text-right break20px">
                        <input type="submit" class="btn btn-grey" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="break20px"></div>
         </div>
      </div>
   </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="daterangeModaledit" role="dialog">
  <div class="modal-dialog add-pop"> 
    <!-- Modal content-->
    <div class="modal-content new-modalcustm">
      <form name="date_range_form" id="date_range_form" method="post" action="{{url('')}}" enctype="multipart/form-data">
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
                <input type="number" min="1" step="1" class="form-control" name="rolling_day">
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
              <button type="submit" class="btn btn-primary">Apply</button>
              <button class="btn" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

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
              <option value="5">Phone Numbers</option>
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
        <div class="form-group">
          <p class="text-danger" id="delete_question"><i class="fa fa-trash" aria-hidden="true"></i> Delete Question</p>
        </div>
          
        <div class="form-group">
        <div class="discount-btnbx">
            <button type="submit" class="btn btn-primary">Apply</button>
            <button class="btn">Cancel</button>
        </div>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>

@section('custom_js')
<script src="{{asset('public/assets/website/js/spectrum.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
  $('#edit_service').validate({
      rules: {
          service_name: {
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
              required: true
          },
          service_category: {
              required: true
          }
      },

      messages: {
          service_name: {
              required: 'Please enter service name'
          },
          service_currency: {
              required: 'Please choose currency'
          },
          service_price: {
              required: 'Please enter price',
              number: 'Please enter proper price'
          },
          service_link: {
              required: 'Please enter service link'
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
              required: 'Please select service duration',
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

  $('#add_invitee_question_form').validate({
      rules: {
        question: {
            required: true
        }
      },

      messages: {
        question: {
            required: 'Please select service duration'
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

</script>
@endsection