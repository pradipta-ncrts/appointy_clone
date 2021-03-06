@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Client Database</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <div id="custom-search-input">
               <a href="#" class="imp-st" data-toggle="tooltip" title="Import Staff"><i class="fa fa-download"></i> </a> <a href="#" class="exp-st"  data-toggle="tooltip" title="Export Staff"><i class="fa fa-external-link "></i> </a>
               <div class="input-group col-md-12">
                  <input type="text" class="search-staff form-control" placeholder="Search Staff" />
                  <span class="input-group-btn">
                  <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                  </span>
               </div>
            </div>
            <div class="stf-list heightfull">
               <a href="#" class="active">
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
               <a href="#" >
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
               <a href="#" >
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
               <a href="#" >
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
               <a href="#" >
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
               <a href="#" >
                  <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                  <div>
                     <h3>Steph Pouyet</h3>
                     <small>steph.pouyet@hotmail.com</small>
                  </div>
               </a>
            </div>
         </div>
      </div>
      <div class="rightpan">
         <div class="row">
            <div class="col-lg-12">
               <form>
                  <div class="headRow  custm-linkedt custm-l " id="clientdatabase">
                     <ul>
                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                        <li><a><i class="fa fa-paper-plane"></i> Invite </a> </li>
                        <li><a><i class="fa fa-lock"></i> Verify </a> </li>
                     </ul>
                  </div>
                  <div class="headRow cdHeadbar">
                     <div class="namebar">
                        <label>ST</label>
                     </div>
                     <h3> Steph Pouyet<br/>
                        <span>steph.pouyet@hotmail.com</span> 
                     </h3>
                  </div>
                  <div class=" staff-detail">
                     <ul class="  nav nav-tabs" >
                        <li><a data-toggle="tab" href="#tab1" class="active">Info </a></li>
                        <li><a data-toggle="tab" href="#tab2">Appointments </a></li>
                        <li><a data-toggle="tab" href="#tab3">Give as a gift </a></li>
                        <li><a data-toggle="tab" href="#tab4">Payments</a></li>
                        <li><a data-toggle="tab" href="#tab5">Feedback</a></li>
                        <li><a data-toggle="tab" href="#tab6">Journey</a></li>
                        <li><a data-toggle="tab" href="#tab7">Notes</a></li>
                     </ul>
                     <div class="tab-content">
                     <div class="padding15px clearfix tab-pane fade in active" id="tab1">
                        <div class="infoBar">
                           <div>
                              <h2>Customer Notes</h2>
                              <label>Notes help you keep track of your customers</label>
                           </div>
                        </div>
                        <div class="infoBar">
                           <div>
                              <h2>Mobile</h2>
                              <label>0788852211</label>
                           </div>
                        </div>
                        <div class="infoBar">
                           <div>
                              <h2>Registration</h2>
                              <label>22 May 2018, 05:06 PM</label>
                              <span>Created by Admin</span> 
                           </div>
                           <div>
                              <h2>Last Appointment</h2>
                              <label>22 May 2018, 05:06 PM</label>
                           </div>
                        </div>
                     </div>
                    
                        <div id="tab2" class="tab-pane fade">
                           
                        <div class="headRow showDekstop clearfix">
                      <div class="col-md-12">
                          <div class="custm-linkedt1" >
                              <ul >
                                <li><a class="dropdown-item" data-toggle="modal" data-target="#myModaladdappoinment" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Appointment</a></li>               
                              </ul>
                            </div>
                        <table id="example" class="table table-striped app" style="width:100%">
                          <thead>
                            <tr>
                              <th >Date</th>            
                              <th >Service</th>
                              <th>Staff</th>
                              <th align="center" style="text-align: center;">Amount</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Sep 12, 2018  07:00am </td>
                              <td>SHowner</td>
                              <td>Johan</td>           
                              <td  style="text-align: center;">$200.00</td>
                              <td  style="text-align: center;">
                              <div class="dropdown ">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">CHECK IN <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                                <ul class="dropdown-menu">
                                  <li><a href="#">As Scheduled</a></li>
                                  <li><a href="#">Arrived Late</a></li>
                                  <li><a href="#">No show</a></li>
                                  <li><a href="#">Gift Certificates</a></li>
                                  <li><a href="#">New Status</a></li>
                                </ul>
                              </div>
                              </td>
                            </tr>
                          
                          
                          </tbody>
                        </table>

                        <div class="discount-innertabbx break20px">
                        <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                        No Discount Coupons</p>
                        </div>

                        
                      </div>
    </div>



                        </div>
                        <div id="tab3" class="tab-pane fade">
                        <div class="col-md-12">
                        <div class="custm-linkedt1" >
                              <ul >
                                <li><a class="dropdown-item" data-toggle="modal" data-target="#myGiftModal" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Gift Certificate</a></li>               
                              </ul>
                            </div>
                          
                        <div class="discount-box">
                            <h2>Gift As a Gift</h2>
                            <div class="alert alert-warning mt-20">
                          Gift certificates can be purchased online on the customer booking interface only after a payment gateway has been added. If you do not have a payment gateway added, you can only sell gift certificates from the admin interface. Gift certificates can be redeemed online at the time of booking, or in person at the time of availing the service.
                        </div>
                            <p>Let customers gift your services to their family & friends. Create one Gift Certificate for every event. It can be a Birthday, Anniversary, Thanksgiving, New year, Mother's day or Father's day.</p>
                            </div>
                            <div class="gc-btnbx">
                            <h3>Design your first gift certificate</h3>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myGiftModal">SELL GIFT CERTIFICATE</button>
                          </div>
                            </div>

                        </div>



                        <div id="tab4" class="tab-pane fade">
                           
                        <div class="headRow showDekstop clearfix">
                      <div class="col-md-12">
                          <div class="custm-linkedt1" >
                              <ul >
                                <li><a class="dropdown-item" data-toggle="modal" data-target="#myModaladdappoinment" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Payment</a></li>               
                              </ul>
                            </div>
                        <table id="example" class="table table-striped app" style="width:100%">
                          <thead>
                            <tr>
                              <th >Date</th>            
                              <th >Type</th>                              
                              <th align="center" style="text-align: center;">Amount</th>
                              <th>Tip</th>
                              <th>Mode</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Sep 12, 2018  07:00am </td>
                              <td>Membership</td>                                      
                              <td  style="text-align: center;">$200.00</td>
                              <td>&nbsp;</td> 
                              <td>Debit Card</td> 
                              <td  style="text-align: center;">
                                <a href="#"><i class=" fa fa-trash-o"></i></a> &nbsp; &nbsp; &nbsp;
                                <a href="#"><i class="fa fa-print"></i></a>
                              </td>
                            </tr>
                          
                          
                          </tbody>
                        </table>

                        <div class="discount-innertabbx break20px">
                        <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                        Customer has no payments</p>
                        </div>

                      </div>  
                      </div>

                        </div>
                        <div id="tab5" class="tab-pane fade">
                          <div class="discount-innertabbx break20px">
                          <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                          Customer has no reviews</p>
                          </div>
                        </div>
                        <div id="tab6" class="tab-pane fade">
                            <div class="journey">
                              <div class="v-line"></div>
                              <span>September 2018</span>
                              <p>No activity this month</p>
                              <div class="v-line"></div>

                              <span>August 2018</span>
                              <p>No activity this month</p>
                              <div class="v-line"></div>

                            </div>
                        </div>
                        <div id="tab7" class="tab-pane fade">
                          <div class="discount-innertabbx break20px">
                          <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                          Customer has no notes</p>
                          </div>
                        </div>
                    </div>


                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="popup">
   <div id="selectstaff">
      <div class="container-fluid">
         <div class="popupInside">
            <h3>Select Staff</h3>
            <ul>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}"/>
                  <label>Douglas N</label>
                  </a> 
               </li>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/grey-user.png')}}"/>
                  <label>Janice D</label>
                  </a> 
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myGiftModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content new-modalcustm">
        <div class="modal-body clr-modalbdy bg-grey">
          <div class="col-md-6 px-0">
          <div class="discount-coupon">
           <div class="modal-title0">
            <h2>Select Image</h2>
            </div>
            <div class="gc-bx">
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>
            <div class="col-xs-4">
            <img class="gc-image" src="https://appointy.com/admin/GiftCertificate/Images/HeaderImages/giftCertificate_01.png">
            </div>

            </div>
            
            <div class="gc-ortxt">OR</div>
            
            <div class="row">
              <div class="col-md-9">
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-upload" aria-hidden="true"></i></span>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Browse Image">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              <div class="gc-plus"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
              </div>
            </div>
            
            <div class="discount-btnbx">
             <button type="button" class="btn btn-primary">Next</button>
            </div>
          
          </div>
          </div>
          <div class="col-md-6 pl-0 px-0">
          <button type="button" class="close preview-clsbtn" data-dismiss="modal">&times;</button>
          <div class="preview">
          <div class="modal-title1">
          <h2>Preview</h2>
          </div>
          <div class="preview-cupnmain">
          <div class="gift-rgttxt">Gift Certificate</div>
          <div class="gift-code">Code:<a href="#">xxxxxxxxx</a></div>
          <div class="gift-titlergt">Lorem Ipsum</div>
          <div class="preview-cupnbx">
          <div class="preview-persentage">-%</div>
           <div class="preview-innertxt">
            Use Coupon Code<br>
            <span>dmim145</span>
            </div>
            <div class="preview-innertxt1">
            Applies to all services<br>
			<span>Works on any week day</span> 
            </div>
          </div>
          <div class="gift-rgttxt1">
          Use this code on <a href="#">https://google.com/</a><br>
		  This gift certificate is valid indefinitely 
          </div>
          <div class="col-xs-12">
          <div class="row">
          <div class="col-xs-3 text-right grey-text"> To: </div>
          <div class="col-xs-9"><div class="border-dashed-bottom1"> &nbsp; </div>
          </div>
          </div>
          <div class="row">
          <div class="col-xs-3 text-right grey-text"> From: </div>
          <div class="col-xs-9"><div class="border-dashed-bottom1"> &nbsp; </div>
          </div>
          </div>
          <div class="row">
          <div class="col-xs-3 text-right grey-text"> Message: </div>
          <div class="col-xs-9"><div class="border-dashed-bottom1"> &nbsp; </div>
          </div>
          </div>
          </div>
          
          </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection