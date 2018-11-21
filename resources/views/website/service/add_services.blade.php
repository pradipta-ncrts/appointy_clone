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
                     <!--<div class="rightbar">
                        <ul>
                           <li><a onclick="slideDiv(this);"><i class="fa fa-custom fa-angle-down"></i></a></li>
                        </ul>
                     </div>-->
                  </div>
                  <div class="headRow whitebox dsinside clearfix " style="display: block;">
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