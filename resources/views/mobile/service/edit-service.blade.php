@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Service Edit</h1>
  <ul>
    <li>&nbsp; </li>
  </ul>
</header>

<main>
   <div class="container-fluid">
      <div class="row">


        <div class="col-md-12 " id="ss" style="margin-top: 20px">
               <div class="cust-box " >
                  <div class=" mg ds">
                     <div class="leftbar">
                        <h5><i class="fa fa-calendar"></i> What service is this?</h5>
                     </div>
                     <div class="rightbar">
                        <ul>
                           <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="headRow whitebox dsinside clearfix " style="display: none;">
                    <form name="edit_service" id="edit_service" method="post" action="http://runmobileapps.com/squeedr/api/update-service" novalidate="novalidate">
                    <input type="hidden" name="service_id" value="15">
                    <div class="form-details">
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="service_name">Service Name <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                                 <input class="form-control nomarginbottom" type="text" name="service_name" id="service_name" value="rtyu">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="service_location">Location <i class="fa fa-question" data-toggle="tooltip" title="Use the 'Location' field to specify how and where both parties will connect at the scheduled time.
                                    You can choose to show these details on the scheduling page, before a time is confirmed - OR - restrict the location to the confirmation page, after a meeting time has been selected." data-placement="right"></i></label>
                                 <input class="form-control nomarginbottom" type="text" name="service_location" id="service_location" value="">
                                 <span class="specialnote">e.g. Joe's Coffee, I'll Call you, etc</span> 
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="form-group">
                              <input type="radio" checked="checked" name="service_display_location" id="booking" value="1">
                              <label class="right35px">Display location while booking</label>
                              <div class="clearfix break10px"></div>
                              <input type="radio" name="service_display_location" id="confirm" value="2">
                              <label class="right35px">Display location only after confirmation</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                  <label for="service_currency">Currency <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Select currency for your service." data-placement="right"></i> </label>
                                  <select name="service_currency" id="service_currency">
                                    <option value="">Select currency</option>
                                    <option selected="selected" value="1">INR</option>
                                    <option value="2">USD</option>
                                    <option value="3">POUND</option>
                                  </select>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="service_price">Price <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a price for your service." data-placement="right"></i> </label>
                                 <input class="form-control" type="text" name="service_price" id="service_price" value="567">
                              </div>
                           </div>
                        </div>
                                                <div class="break20px"></div>
                            <label for="service_description">Description/Instructions</label>
                            <textarea class="form-control" rows="4" name="service_description" id="service_description"></textarea>
                        <div class="break20px"></div>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date &amp; Time' step. "></i> </label>
                              <input class="form-control" type="text" name="service_link" id="service_link" value="yru" readonly="">
                           </div>
                           <div class="clearfix"></div>
                           <div class="break10px"></div>
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="service_category">List of categories</label>
                              <select name="service_category" id="service_category">
                                 <option value="">Select categories</option>
                                                                   <option value="1">Service</option>
                                                                  <option value="2">Resource</option>
                                                                  <option value="3">Meeting</option>
                                                                  <option value="new">New Category </option>   
                              </select>
                           </div>
                           <div class="clearfix"></div>
                           <div class="break10px"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 new-category-name" style="display: none;">
                                <label for="new_category_name">Category Name</label>
                                <input class="form-control" type="text" name="new_category_name" id="new_category_name">
                            </div>
                           <div class="clearfix"></div>
                           <div class="break10px"></div>
                           <div class="col-lg-6 col-md-6 col-sm-6">
                                <label for="service_color">Select Color <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                                <input type="text" name="togglePaletteOnly" id="togglePaletteOnly" style="display:none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(255, 0, 0);"></div></div><div class="sp-dd">▼</div></div>
                                <input type="hidden" name="service_color" id="service_color" value="#ff0000">
                            </div>
                        </div>
                        
                        <div class="text-right break20px">
                           <input type="button" class="btn btn-grey" value="Cancel">
                           <input type="submit" class="btn btn-primary" value="Next">
                        </div>
                    </div>
                    </form>
                  </div>
                  
               </div>
               <div class="break20px "></div>
               <div class="cust-box">
                <form name="servie_duration_form" id="servie_duration_form" method="post" action="http://runmobileapps.com/squeedr/api/update-service-duration" novalidate="novalidate">
                <input type="hidden" name="service_id" value="15">
                  <div class="mg ds">
                      <div class="leftbar">
                        <h5><i class="fa fa-history"></i> When can people book this service?</h5>
                      </div>
                      <div class="rightbar">
                        <ul>
                            <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                      </div>
                  </div>
                  <div class="headRow whitebox dsinside clearfix" style="">
                      <div class="form-details">ss
                        <div>
                            <label for="Service Duration">Service Duration <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="This is where you can define how long your service will be. It can be as short as 1 minute or as long as 12 hours."></i> </label>
                            <input type="hidden" name="service_duration" id="service_duration" value="15">
                            <ul class="minutes">
                                 <li class="duration active" data-duration="15"><a>15<br>
                                  <label>min</label>
                                  </a> 
                              </li>
                              <li class="duration " data-duration="30"><a>30<br>
                                  <label>min</label>
                                  </a> 
                              </li>
                              <li class="duration " data-duration="45"><a>45<br>
                                  <label>min</label>
                                  </a> 
                              </li>
                                 <li class="duration " data-duration="0"><a><input type="number" min="1" step="1" id="custom_duration" style="width:40%"><br>
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
                                  <table class="table table-bordered table-custom table-bh tableBhMobile">
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
                                            <option value="10">10min</option>
                                            <option value="15">15min</option>
                                            <option value="20">20min</option>
                                            <option value="30">30min</option>
                                            <option value="60">60min</option>
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
                                 <input type="number" name="max_service" id="max_service" min="1" step="1" class="form-control" style="width:40%;">
                                    </div>
                                  </div>
                              </div>
                              <div class="from-group">
                                  <h4><strong>Minimum Scheduling Notice</strong></h4>
                                  <div class="row">
                                    <div class="col-md-6">Use this setting to prevent last minute events.</div>
                                    <div class="col-md-6">
                                        <label>Prevent events less than</label>
                                 <input type="number" name="minimum_scheduling_notice" id="minimum_scheduling_notice" min="1" step="1" class="form-control" style="width:40%;"> hours away
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
                                              <option selected="" value="0">0min</option>
                                              <option value="5">5min</option>
                                              <option value="10">10min</option>
                                              <option value="15">15min</option>
                                              <option value="30">30min</option>
                                              <option value="45">45min</option>
                                              <option value="60">60min</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>Buffer after service</label>
                                          <select name="buffer_after_service" id="buffer_after_service">
                                              <option selected="" value="0">0min</option>
                                              <option value="5">5min</option>
                                              <option value="10">10min</option>
                                              <option value="15">15min</option>
                                              <option value="30">30min</option>
                                              <option value="45">45min</option>
                                              <option value="60">60min</option>
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
                            <input type="hidden" name="is_secret" id="is_secret" value="0">
                            <!--<label>Secret Service <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="To make an service type available to only select invitees, you'll want to make the service type secret. This will make that service type only visible to people with whom you choose to share the service type link and will not show up on your main Squdeer page."></i> </label>
                            <div class="clearfix"></div>
                            <p class="inlineBlock">Hide this Service from your main Squdeer page.</p>
                            <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a>-->
                            <label>Secret Service <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="To make an service type available to only select invitees, you'll want to make the service type secret. This will make that service type only visible to people with whom you choose to share the service type link and will not show up on your main Squdeer page."></i> </label>
                            <div class="clearfix"></div>
                            <p class="inlineBlock">Hide this Service from your main Squdeer page.</p>
                            <button type="button" id="change-secret" class="btn btn-sm btn-toggle " data-toggle="button" aria-pressed="false" autocomplete="off">
                              <div class="handle"></div>
                            </button> 
                        </div>
                      </div>
                      <div class="break20px"></div>
                      <div class="text-right">
                        <input type="button" class="btn btn-grey" value="Cancel">
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close">
                      </div>
                  </div>
                </form>
               </div>
                              <div class="break20px "></div>
               <h3 class="break30px">&nbsp; Additional Options</h3>
               <div class="cust-box">
                  <div class="mg ds">
                     <div class="leftbar">
                        <h5><i class="fa fa-user"></i> Invitee Questions</h5>
                     </div>
                     <div class="rightbar">
                        <ul>
                           <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="headRow whitebox  dsinside clearfix " style="">

                    <div class="form-details">
                        <div class="row">
                           <div class="col-lg-6">
                              <label>Test Question1  </label>
                              <input class="form-control nomarginbottom" type="text">
                           </div>                          
                        </div>
                     </div>

                      <div class="form-details">
                        <div class="row">                          
                           <div class="col-lg-6">
                              <label>Test Question2 </label>
                              <textarea class="form-control" rows="4"></textarea>
                           </div>
                        </div>
                     </div>

                     <div class="form-details">
                        <div class="row">                          
                           <div class="col-lg-6 ans-box" data-toggle="modal" data-target="#ans-modal1">
                            <a href="#" class="edit-ans"><i class="fa fa-pencil"></i></a>
                            <h3>Answer Question1</h3>
                              <div class="form-group ">
                                    <input type="radio" name="payment_method" disabled="true" checked="checked" value="1">
                                    <label class="right35px">ANG2</label>
                                    <div class="clearfix break10px"></div>
                                    <input type="radio" name="payment_method" disabled="true" value="3">
                                    <label class="right35px">BDSD</label>
                                    <div class="clearfix break10px"></div>
                                    <input type="radio" name="payment_method" disabled="true" value="2">
                                    <label class="right35px">DDDA</label>
                                </div>
                          </div>      
                        </div>

                        <div class="row">                          
                           <div class="col-lg-6 ans-box" data-toggle="modal" data-target="#ans-modal2">
                            <a href="#" class="edit-ans"><i class="fa fa-pencil"></i></a>
                            <h3>Answer Question2</h3>
                             

                                <div class="checkbox">                                                                           
                                   <label class="check">
                                   <input type="checkbox" disabled="true"> &nbsp;&nbsp; ASADD
                                   <span class="checkmark"></span>
                                 </label>  
                                 <div class="checkbox">                                                                           
                                   <label class="check">
                                   <input type="checkbox" disabled="true"> &nbsp;&nbsp; FDGDF
                                   <span class="checkmark"></span>
                                 </label> 
                                 <div class="checkbox">                                                                           
                                   <label class="check">
                                   <input type="checkbox" disabled="true"> &nbsp;&nbsp; ERTERT
                                   <span class="checkmark"></span>
                                 </label>                                                                           
                        </div>
                          </div>      
                        </div>

                    </div>
                </div>

                      </div>






                     <span class="footnote center-block text-left"> <a data-toggle="modal" data-target="#newquestionModal">Add New Question <i class="fa fa-plus"></i> </a></span>
                     <div class="clearfix"></div>
                     <div class="text-right">
                        <input type="submit" class="btn btn-grey" value="Cancel">
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close">
                     </div>
                  </div>
               </div>
               <div class="break20px"></div>
               <div class="cust-box">
                  <div class="ds mg ">
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
                  <div class="headRow whitebox dsinside   clearfix " style="">
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
                        <input type="submit" class="btn btn-grey" value="Cancel">
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close">
                     </div>
                  </div>
               </div>
               <div class="break20px "></div>
               <div class="cust-box">
                  <div class="ds mg">
                     <div class="leftbar">
                        <h5><i class="fa fa-check-square-o "></i> Confirmation Page</h5>
                        
                     </div>
                     <div class="rightbar">
                        <ul>
                           <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="headRow whitebox  dsinside padding10px clearfix" style="">
                    <form name="service_confirmation_form" id="service_confirmation_form" method="post" action="http://runmobileapps.com/squeedr/api/update-service-confirmation" novalidate="novalidate">
                    <input type="hidden" name="service_id" value="15">
                     <div class="form-details">
                        <div class="col-lg-6 col-md-6 col-sm-6 row">
                           <label for="Name">On confirmation <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="By default, service details will be displayed on a Squdeer hosted confirmation page after services are scheduled. Alternatively, you can choose to automatically redirect your invitees to an external URL upon confirmation."></i> </label>
                           <div class="form-inline break10px">
                              <select name="redirect_type" id="redirect_type">
                                 <option value="1" selected="selected">Display Squeedr confirmation page</option>
                                 <option value="2">Redirect to an external site</option>
                              </select>
                           </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="redirect_squdeer_section">
                            <label for="Name">Display button to schedule another service? <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Direct your invitee back to your website or make it easy for them to schedule recurring services by adding a link to your service confirmation page."></i> </label>
                            <div class="form-inline break10px">
                            <input class="form-control" type="text" name="display_button_name" id="display_button_name" value="" disabled="disabled">
                            <button type="button" id="change_display_button" class="btn btn-sm btn-toggle " data-toggle="button" aria-pressed="false" autocomplete="off">
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
                                    <input class="form-control nomarginbottom" type="text" name="custom_button_name" id="custom_button_name" placeholder="Your Custom Link">
                                    <!--<button type="button" id="change_custom_button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" >
                                        <div class="handle"></div>
                                    </button>-->
                                    <br>
                                    <br>
                                    <input class="form-control nomarginbottom" type="text" name="custom_url" id="custom_url" placeholder="https://www.example.com">
                                </div>
                                <a class="btn btn-info break20px" id="submit_custom_link">Add</a>
                                <a class="btn btn-default break20px" id="cancel_custom_link">Cancel</a>
                            </div>
                        </div>

                        <div id="redirect_external_section" style="display:none;">
                            <p class="footnote">Redirect is a Pro Feature. Upgrade your account to redirect after confirmation.</p>
                            <div class="clearfix"></div>
                            <label for="redirect_url" class="break10px">Redirect URL </label>
                            <div class="form-inline break10px form-details">
                                <input class="form-control nomarginbottom" type="text" name="redirect_url" id="redirect_url" placeholder="https://www.example.com">
                            </div>
                        </div>

                     </div>
                     
                     <div class="text-right break20px">
                        <input type="button" class="btn btn-grey" value="Cancel">
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close">
                     </div>
                    </form>
                  </div>
               </div>
               <div class=" break20px "></div>
               <div class="cust-box">
                  <div class="ds mg">
                     <div class="leftbar">
                        <h5><i class="fa fa-credit-card"></i> Collect Payments</h5>
                     </div>
                     <div class="rightbar">
                        <ul>
                           <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="headRow whitebox  dsinside p clearfix" style="">
                    <form name="service_payment_form" id="service_payment_form" method="post" action="http://runmobileapps.com/squeedr/api/update-service-payment" novalidate="novalidate">
                    <input type="hidden" name="service_id" value="15">
                        <div class="alert alert-info alert-custom"> Payments is a pro Feature. <a>Upgrade your account</a> to add payments to this Service </div>
                        <div class="break20px"></div>
                        <div class="form-group">
                            <input type="radio" name="payment_method" checked="checked" value="1">
                            <label class="right35px">Do not collect payments for this service</label>
                            <div class="clearfix break10px"></div>
                            <input type="radio" name="payment_method" value="3">
                            <label class="right35px">Accept payment with stripe</label>
                            <div class="clearfix break10px"></div>
                            <input type="radio" name="payment_method" value="2">
                            <label class="right35px">Accept payments with PayPal</label>
                        </div>
                        <div class="break20px"></div>
                        <div class="text-right break20px">
                            <input type="button" class="btn btn-grey" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Save &amp; Close">
                        </div>
                    
                  </form></div>
               </div>
                              <div class="break20px"></div>
         </div>
      </div>
   </div>




      </div>
  </div>
</main>





@endsection


@section('custom_js')
<script type="text/javascript">
  function ShowPopup() {
         
             $("#popup").fadeToggle();
         
         }


          function slideDiv(obj) {
            $(obj).closest(".ds").next(".dsinside").slideToggle();
            $(obj).find("i").toggleClass("fa-angle-down fa-angle-up");
            $(".dsinside").not($(obj).closest(".ds").next(".dsinside")).slideUp();
            $("i.fa-custom").not($(obj).find("i")).removeClass("fa-angle-up").addClass("fa-angle-down");
            $(".schedule").fadeOut();
        }

        function showSchedule(obj) {
            $(obj).next(".schedule").fadeToggle();
        }
        
        function toggleButton(obj){
            $(obj).toggleClass("active");
            $(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");
        }
</script>
@endsection