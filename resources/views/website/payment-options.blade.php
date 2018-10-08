@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Payment Options</div>
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
            <ul>
               <li><a href="{{ url('payment-options') }}" class="active"> Payment Options</a></li>
               <li><a href="{{ url('invoice') }}"> Invoice </a> </li>
               <li><a href="{{ url('create-invoice') }}"> Create invoice <br>(Issued/Pending Template)</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan ">
         <div class="container-fluid">
            <div >
               <div class="row break30px">
                  <div class="pay cust-box ">
                     <div style="cursor: pointer;">
                        <a class=" serv-togg " onclick="toggleButton(this);" style="position: absolute; right:30px; top:17px"  >
                           <samll>Inactive</samll>
                           <i class="fa fa-toggle-off"></i> <small>Active</small>
                        </a>
                        <div class="clearfix"></div>
                        <h2>Pre-Payment</h2>
                     </div>
                     <div >
                        <div class="mag">
                           <p>Accepting pre payment is a premium feature available in PRO and above membership.
                              <u>Upgrade to premium membership</u>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="pay cust-box">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>   
                        <h2>Pre-Payment Charges</h2>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse ">
                        <div class="">
                           <p>How much pre payment do you want to charge your customers?</p>
                           <p> Full service Amount</p>
                           <form class="form-horizontal" action="/action_page.php">
                              <table>
                                 <tr>
                                    <td>Charge</td>
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" placeholder="">
                                          <div class="clearfix"></div>
                                       </div>
                                    </td>
                                    <td>$ &nbsp; fixed booking free</td>
                                 </tr>
                                 <tr>
                                    <td>Charge</td>
                                    <td>
                                       <div class="form-group">
                                          <input type="text" class="form-control" placeholder="">
                                          <div class="clearfix"></div>
                                       </div>
                                    </td>
                                    <td>% &nbsp; of service value</td>
                                 </tr>
                              </table>
                              <button class="butt-save" type="submit">Save</button>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="pay  cust-box">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>   
                        <h2>Payment Settings</h2>
                     </div>
                     <div id="collapse3" class="panel-collapse collapse ">
                        <div class="col-md-6 nopadding ">
                           <h3>Payment Gateway</h3>
                           <table>
                              <tr>
                                 <td>
                                    <div class="checkbox">
                                       <label class="check"><input type="checkbox"> &nbsp;&nbsp; Enable PayPal
                                       <span class="checkmark"></span></label>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="checkbox">
                                       <label class="check"><input type="checkbox"> &nbsp;&nbsp; Enable Stripe
                                       <span class="checkmark"></span></label>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                           <hr>
                           <form class="form-horizontal" action="/action_page.php">
                              <div class="form-group">
                                 <input type="text" class="form-control1" placeholder="User Name">
                                 <div class="clearfix"></div>
                              </div>
                              <button class="butt-save" type="submit">Save</button>
                              <div class="clearfix">&nbsp;</div>
                              <p><strong>Enable:</strong>  Check this box to accept payments through your PayPal account. <br>
                                 <strong> Username:</strong>  Enter your PayPal email address through which you want to accept payments. eg. payments@squeedr.com
                              </p>
                           </form>
                        </div>
                        <div class="col-md-6">
                           <h4>To collect payments, visit your <a href="#">Integration Page</a> 
                              and choose your prefered provider. 
                           </h4>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <div class="pay  cust-box">
                     <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="cursor: pointer;">
                        <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>  
                        <h2>Payment Terms</h2>
                     </div>
                     <div id="collapse4" class="panel-collapse collapse ">
                        <div class="">
                           <h3>Start building your organization</h3>
                           <div class="clearfix"></div>
                           <p> Add more users to your account to pay for their premium accounts and to access team scheduling features.
                              Free during trial. As low as <strong>$8 </strong>  per user/mo after.
                           </p>
                           <div class="row">
                              <div class="col-md-12 margtop20 ">
                                 <div class="borderbtn">
                                    <label class="">Terms</label>
                                    <div class="cus-textarea col-lg-12" >
                                       <textarea style="width:600px ; height: 150px;" id="area1" ></textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
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