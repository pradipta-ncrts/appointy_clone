@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Locations</div>
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
      <div class="leftpan">
         <div class="left-menu">
            <ul class="  nav nav-tabs">
               <?php
               /*echo "<pre>";
               print_r($staff_list); die();*/
               $i=0;
               foreach ($staff_list as $key => $staff)
               {
                  if($staff->addess)
                  {
               ?>
               <li class="<?=$i=="0" ? "active" : "";?>"><a href="#tab<?=$key;?>" data-toggle="tab" ><?=$staff->addess;?></a></li>
               <?php
                    $i++;
                  }
                }
               ?>
            </ul>
         </div>
      </div>
      <div class="rightpan loc">
      <div class="custm-linkedt1 " >
                           <ul >
                              <li><a class="dropdown-item" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Location</a></li>
                           </ul>
                        </div>
         <div class="tab-content">
            <?php
             /*echo "<pre>";
             print_r($staff_list); die();*/
            $j=0;
            foreach ($staff_list as $key => $staff)
            {
              if($staff->addess)
              {
             ?>
            <div id="tab<?=$key;?>" class="tab-pane fade <?=$j=="0" ? "in active" : "";?>">
               <div class="relativePostion">
                  <div class="headRow showDekstop clearfix">
                     <div class="col-md-12">
                        
                        <table id="example" class="table table-striped break10px" style="width:100%">
                           <thead>
                              <tr>
                                 <!-- <th >Location</th> -->
                                 <th >Name</th>
                                 <th >Admin Email</th>
                                 <th>Admin User name</th>
                                 <th align="center" style="text-align: center;">Active</th>
                                 <th>&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <!-- <td><?php echo $staff->addess;?></td> -->
                                 <td>
                                    <div class="custm-tblebx"> 
                                       <?php if($staff->staff_profile_picture != ''){ ?>
                                       <img class="user-pic" src="<?php echo $staff->staff_profile_picture;?>" width="35px" height="35px" /> 
                                       <?php } else { ?>
                                       <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                                       <?php } ?>
                                       <a href="#"><?php echo ucwords($staff->full_name);?></a> 
                                    </div>
                                 </td>
                                 <td><?php echo $staff->email;?></td>
                                 <td><?php echo $staff->username;?></td>
                                 <td align="center"><a href="#" class="active">Active</a></td>
                                 <td>&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <?php
                $j++;
              }
            }
           ?>
         </div>
      </div>
   </div>
</div>



<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Location</h4>
         </div>
         <form class="form-horizontal" action="{{ url('api/add-new-location') }}" method="post" autocomplete="off" id="add-new-location">
          <input type="hidden" name="staff_id" id="location_staff_id">
           <div class="modal-body clr-modalbdy">
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <div class="input-group"> <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                         <div id="locationField">
                            <input id="location_name" placeholder="Enter your address" type="text" class="form-control autocomplete" name="location_name"></input>
                          </div> 
                       </div>
                    </div>
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input id="location_username" type="text" class="form-control" name="location_username" placeholder="User Name">
                       </div>
                    </div>
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-12">
                    <div class="form-group">
                       <div class="input-group"> <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input type="text" id="location_password" class="form-control" name="location_password" placeholder="Password">
                       </div>
                    </div>
                 </div>
              </div>
              <p>Administrator Details</p>
              <div class="row break10px">
                 <div class="col-md-12">
                    <div class="form-group">
                       <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input id="location_full_name" type="text" class="form-control" name="location_full_name" placeholder="Full Name">
                       </div>
                    </div>
                 </div>
              </div>
              <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope "></i></span>
                        <input id="location_email" type="text" class="form-control" name="location_email" placeholder="Email">
                     </div>
                     <small>Need to link existing account? <a href="JavaScript:Void(0);" id="add-location-exist-user">Click here</a></small>
                  </div>
               </div>
            </div>
           </div>
           <div class="modal-footer">
              <div class="col-md-12 text-center">
                 <input type="submit" name="save" value="save" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">
                 <!-- <a class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">Save</a> -->
              </div>
           </div>
         </form>
      </div>
   </div>
</div>
@endsection