@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
    <div class="container-custm">
      <div class="upper-cmnsection">
        <div class="heading-uprlft">Help</div>
        <div class="upr-rgtsec">
          <div class="col-md-5">
           
          </div>
          <div class="col-md-7">
            <div class="full-rgt">
              
             
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      
      <div class="rightpan full "> 
          <div class="row showDekstop"> 
      
      <!--Edited by Sandip - Start-->
      
      <div class="col-lg-12 col-md-12">
        <div class="row" id="settingsPage">


          <div class=" col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" data-toggle="modal" data-target="#myModalCalendarFilter"  href="#"> 
            
            <h2>Start Using Squeedr</h2>
            </a> </div>
         
          <div class=" col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" href="#" data-toggle="modal" data-target="#myModalPayment" > 
              
            <h2>Setup Business Hours</h2>
          </a> </div>

          <div class=" col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix"> 
            <h2>Customiz
                ations</h2>
            </a> </div>
          <div class=" col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" href="#">
            <h2>Squeedr for Websites</h2>
          </a> </div>

          <div class="col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix"> 
            <h2>Scheduling Options</h2>
             </a> </div>

          <div class="col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" href="#">
            <h2>Setup Integrations</h2>
             </a> </div>
          
             <div class="col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" href="#">
            <h2>Feedback & Suggestions</h2>
             </a> </div>
             <div class="col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix" href="#">
            <h2>Squeedr Community</h2>
             </a> </div>

          <div class=" col-md-4 col-sm-4 text-center"> <a class="whitebox clearfix"> 
            <h2>Accounts Settings</h2>
            </a> </div>

            <div class=" col-md-8 col-sm-8 col-md-offset-2 text-center"> <a class="whitebox clearfix"> 
            <h2>Need help with something not listed here? <strong>GET IN TOUCH</strong></h2>
            </a> </div>
         
       
        
           


        </div>
      </div>
      
      <!--Edited by Sandip - End--> 
      
    
          
      </div>
  </div>
 </div>

  <!--Filter Calendar-->
  <div class="modal fade in" id="myModalCalendarFilter" role="dialog">
            <div class="modal-dialog add-pop">
               <!-- Modal content-->
               <div class="modal-content new-modalcustm">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">×</button>
                     <h4 class="modal-title">Filter Calendar</h4>
                  </div>
                   <div class="filter-op"> All staff selected   <span><a href="#">Select All</a>  &nbsp; | &nbsp;  <a href="#">Deselect All</a></span></div>

                  <div class="modal-body clr-modalbdy">
                     <div class="notify" >

                     <input type="text" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                        
                        <div class="user-bkd break20px">                            
                           <img id="clientImg" src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                           <h2 id="clientDetails">Steph Pouyet
                              <br><a href="mailto:steph.pouyet@gmail.com"><i class="fa fa-envelope-o"></i> Email</a>
                           </h2>                           
                           <div class="row" id="apoinment-mail-notification">
                     <div class="check-ft">
                        <div class="form-group"> <input name="apoinment_mail" type="checkbox" value="true"> </div>
                     </div>
                  </div>
                        </div>


                        <div class="user-bkd break20px">                            
                            <img id="clientImg" src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                            <h2 id="clientDetails">Steph Pouyet
                               <br><a href="mailto:steph.pouyet@gmail.com"><i class="fa fa-envelope-o"></i> Email</a>
                            </h2>
                            <input name="client_send_email" class="check-ft" type="checkbox" value="">
                         </div>
                        <div>   

                        <div class="user-bkd break20px">                            
                            <img id="clientImg" src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                            <h2 id="clientDetails">Steph Pouyet
                               <br><a href="mailto:steph.pouyet@gmail.com"><i class="fa fa-envelope-o"></i> Email</a>
                            </h2>
                            <input name="client_send_email" class="check-ft" type="checkbox" value="">
                         </div>
                        <div>     
                          
                        
                                                     
                        </div>
                          <div class=butt-pop-ft>
                         <button type="button" class="btn btn-primary butt-next break20px">Done</button> 
                         <button type="button" class="btn btn-primary butt-next break20px">Reset</button> 
                                </div>
                        <div class="clearfix"></div>


                      </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>



 <!--Payment-->
 <!--====================================Modal area start ====================================--> 
 <div class="modal fade" id="myModalPayment" role="dialog">
         <div class="modal-dialog add-pop">
            <!-- Modal content-->
            <div class="modal-content new-modalcustm">
            <form name="add_client_form" id="add_client_form" method="post" action="{{url('api/add_client')}}" enctype="multipart/form-data">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Payment</h4>
               </div>
               <div class="modal-body clr-modalbdy">

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                              <input id="amount" type="text" class="form-control" name="client_name" placeholder="Amount">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                              <input id="addi-charg" type="text" class="form-control" name="client_name" placeholder="Additional Chanrges">
                           </div>
                        </div>
                     </div>
                  </div>

                   <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                              <input id="addi-charg" type="text" class="form-control" name="client_name" placeholder="Discount">
                           </div>
                        </div>
                     </div>
                  </div>
                
                  

              
                 
                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group textarea-md"> <span class="input-group-addon" style="vertical-align: top;padding-top: 9px;"><i class="fa fa-file" ></i></span>
                              <textarea style="width: 100%" name="client_note" id="client_note" placeholder="Payment Note"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>

                  <hr style="margin-top:10px;">

                <table width="100%">
                  <tr>
                      <td>Total</td>
                      <td style="text-align:right"><i class="fa fa-eur"></i> 10.00</td>
                  </tr>
                </table>

                 <a href="#" style="margin:10px 0 20px; display:block" data-toggle="collapse" data-target="#code"><i class="fa fa-gift"></i> Redeem Gift Certificate</a>

                <div class="row collapse" aria-expanded="true" id="code">
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                              <input id="addi-charg" type="text" class="form-control" name="client_name" placeholder="Code">
                           </div>
                        </div>
                     </div>

                     <div class="col-md-7">
                        <button type="submit" class=" butt-next" style="margin: 0px 5px; width:76px; padding:8px 0px;  display: inline-block">Apply</button>
                        <button type="submit" class="butt-cancle" style="margin: 0px 5px; width:76px;padding:8px 0px; display: inline-block">Cancel</button>
                     </div>



                  </div>
            

               </div>
               <div class="modal-footer">
                  <div class="col-md-12 text-center">
                     <button type="submit" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">PAY NOW</button>
                  </div>
               </div>
              </form>
            </div>
         </div>
      </div>

@endsection