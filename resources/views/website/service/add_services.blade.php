@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Add Service</div>  
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{url('/add_services')}}" class="active"> Add Service & Additional Options</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="col-md-12 row" id="ss">
            <form name="add_service1" id="add_service1" method="post">
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
                     <div class="form-details">
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="service_name">Service Name <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                                 <input class="form-control nomarginbottom" type="text" name="service_name" id="service_name" />
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="Location">Location <i class="fa fa-question" data-toggle="tooltip" title="Use the 'Location' field to specify how and where both parties will connect at the scheduled time.
                                    You can choose to show these details on the scheduling page, before a time is confirmed - OR - restrict the location to the confirmation page, after a meeting time has been selected." data-placement="right"></i></label>
                                 <input class="form-control nomarginbottom" type="text" name="service_location" id="service_location" />
                                 <span class="specialnote">e.g. Joe's Coffee, I'll Call you, etc</span> 
                              </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="form-group">
                              <input type="radio" checked="checked" name="service_display" id="booking" value="1" />
                              <label class="right35px">Display location while booking</label>
                              <div class="clearfix break10px"></div>
                              <input type="radio" name="service_display" id="confirm" value="2" />
                              <label class="right35px">Display location only after confirmation</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="price">Price <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a price for your service." data-placement="right"></i> </label>
                                 <input class="form-control" type="text" name="service_price" id="service_price">
                              </div>
                           </div>
                        </div>
                        <div class="break20px"></div>
                        <label for="Business Description">Description/Instructions</label>
                        <textarea class="form-control" rows="4" name="service_description" id="service_description"></textarea>
                        <div class="break20px"></div>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="Service Link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date & Time' step. "></i> </label>
                              <input class="form-control" type="text" />
                           </div>
                           <div class="clearfix"></div>
                           <div class="break10px"></div>
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="Service Link">List of categories</label>
                              <select name="service_category" id="service_category">
                                 <option>Select categories</option>
                                 <?php if(!empty($category_list)){ foreach($category_list as $category){ ?>
                                  <option value="<?php echo $category->category_id;?>"><?php echo $category->category;?></option>
                                <?php } } ?>
                              </select>
                           </div>
                        </div>
                        <div class="text-right break20px">
                           <input type="submit" class="btn btn-grey" value="Cancel" />
                           <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="break20px hidden-xs"></div>
               <div class="cust-box">
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
                  <div class="headRow whitebox dsinside clearfix">
                     <div class="form-details">
                        <div>
                           <label for="Service Duration">Service Duration <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="This is where you can define how long your service will be. It can be as short as 1 minute or as long as 12 hours."></i> </label>
                           <ul class="minutes">
                              <li class="active"><a>15<br/>
                                 <label>min</label>
                                 </a> 
                              </li>
                              <li><a>30<br/>
                                 <label>min</label>
                                 </a> 
                              </li>
                              <li><a>45<br/>
                                 <label>min</label>
                                 </a> 
                              </li>
                              <li><a>-<br/>
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
                                       <select>
                                          <option>10min</option>
                                          <option>15min</option>
                                          <option>20min</option>
                                          <option>30min</option>
                                          <option>60min</option>
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
                                       <input type="text" class="form-control" style="width:40%;">
                                    </div>
                                 </div>
                              </div>
                              <div class="from-group">
                                 <h4><strong>Minimum Scheduling Notice</strong></h4>
                                 <div class="row">
                                    <div class="col-md-6">Use this setting to prevent last minute events.</div>
                                    <div class="col-md-6">
                                       <label>Prevent events less than</label>
                                       <input type="text" class="form-control" style="width:40%;"> hours away
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
                                          <select>
                                             <option>0min</option>
                                             <option>5min</option>
                                             <option>10min</option>
                                             <option>15min</option>
                                             <option>30min</option>
                                             <option>45min</option>
                                             <option>60min</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label>Buffer after service</label>
                                          <select>
                                             <option>0min</option>
                                             <option>5min</option>
                                             <option>10min</option>
                                             <option>15min</option>
                                             <option>30min</option>
                                             <option>45min</option>
                                             <option>60min</option>
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
                           <label>Secret Service <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="To make an service type available to only select invitees, you'll want to make the service type secret. This will make that service type only visible to people with whom you choose to share the service type link and will not show up on your main Squdeer page."></i> </label>
                           <div class="clearfix"></div>
                           <p class="inlineBlock">Hide this Service from your main Squdeer page.</p>
                           <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a> 
                        </div>
                     </div>
                     <div class="break20px"></div>
                     <div class="text-right">
                        <input type="submit" class="btn btn-grey" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save &amp; Close" />
                     </div>
                  </div>
               </div>
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
                        <ul>
                           <li>Calender, Invitations, No Reminders</li>
                        </ul>
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
                     <div class="form-details break20px">
                        <div>
                           <label>Text reminders <i class="fa fa-question"></i> </label>
                           <div class="clearfix"></div>
                           <p class="inlineBlock">Your invitees will have the option to send text reminders. <a> Inactive</a> </p>
                           <a class="toggle" onclick="toggleButton(this);"><i class="fa fa-toggle-off"></i></a> 
                        </div>
                     </div>
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
               <div class="break20px"></div>
            </form>
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
      <form name="" id="" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Availability</h4>
        </div>
        <div class="modal-body clr-modalbdy">
          <div class="form-group">
            <label class="setting-lbl"><strong>When can services be scheduled?</strong></label>
            <select class="selectpicker category" data-show-subtext="true" data-live-search="true" id="service_category" name="service_category" >
              <option value="">Over a period of rolling days</option>
              <option value='1'>Over a date range</option>
              <option value='2'>Indefinitely</option>
            </select>
          </div>
          <div class="form-group">
            <label class="setting-lbl">Your invitees will be offered availability for a number of days into the future.</label>
            <div class="row">
              <div class="col-md-5">
                <input type="text" class="form-control">
              </div>
              <div class="col-md-7"><span class="setting-spn">rolling days</span></div>
            </div>
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

<div class="modal fade" id="newquestionModal" role="dialog">
  <div class="modal-dialog add-pop"> 
    <!-- Modal content-->
    <div class="modal-content new-modalcustm">
      <form name="" id="" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">New Question</h4>
        </div>
        <div class="modal-body clr-modalbdy">
        <div class="form-group">
            <label class="setting-lbl"><strong>Question</strong> <sup>*</sup></label>
            <textarea rows="5" cols="5"></textarea>
          </div>
        <div class="form-group">
            
            <button type="button" id="isBlocked" class="isBlocked btn btn-sm btn-toggle pull-right" data-toggle="button" aria-pressed="true" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
            <input name="" type="checkbox" value=""> Required
          </div> 
        <div class="form-group">
            <label class="setting-lbl">Answer Type</label>
            <select class="selectpicker category" data-show-subtext="true" data-live-search="true" id="service_category" name="service_category">
              <option value="">One Line</option>
              <option value="1">Multiple Lines</option>
              <option value="2">Radio Buttons</option>
              <option value="2">Checkboxes</option>
              <option value="2">Phone Numbers</option>
            </select>
          </div>
          <div class="form-group">
          <p class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete Question</p>
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