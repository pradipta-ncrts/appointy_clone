@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Dashboard</div>
         <div class="upr-rgtsec">
            <div class="col-md-6">
               <ul class="tab-menu ">
                  <li><a href="#" class="active">My Squeedr</a></li>
                  <li><a href="#">Group</a></li>
                  <li><a href="#">Users</a></li>
                  <li><a href="#">Template</a></li>
               </ul>
            </div>
            <div class="col-md-6">
               <div class="full-rgt">
                  <div class="todate">Aug 7, 2018</div>
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Date <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu ">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <a class="add-w"  data-toggle="tooltip" title="Add Widget"><i class="fa fa-plus"></i></a>
         <div class="dash-info">
            <div class="col-sm-4 ">
               <div class="infobpx active">
                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                  <h3>0</h3>
                  <h4>Appointment(S)</h4>
                  <p><span>0%</span> Form last month</p>
               </div>
            </div>
            <div class="col-sm-4 ">
               <div class="infobpx">
                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                  <h3>0.00</h3>
                  <h4>Estimated Sales</h4>
                  <p><span>0%</span> Form last month</p>
               </div>
            </div>
            <div class="col-sm-4 ">
               <div class="infobpx">
                  <a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>
                  <h3>0</h3>
                  <h4>New Customers(S)</h4>
                  <p><span class="green">+0%</span> Form last month</p>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
         <hr>
         <div class="clearfix"></div>
         <div class="headRow mobileappointed arrow-d clearfix "  id="row2">
            <a href="services.html" class="more-link"  data-toggle="tooltip" title="More Services"><img src="{{asset('public/assets/website/images/threeDots.png')}}"/></a>
            <div class="appointment mobSevices  col-sm-4">
               <div class="pull-left">
                  <p>Dental Consultation</p>
                  <span>30min-1h
                  <label>$50</label>
                  </span> 
               </div>
               <ul class="pull-right">
                  <li onclick="showUl(this);">
                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>
                     <ul>
                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>
                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="appointment mobSevices  col-sm-4">
               <div class="pull-left">
                  <p>Dental Consultation</p>
                  <span>30min-1h
                  <label>$50</label>
                  </span> 
               </div>
               <ul class="pull-right">
                  <li onclick="showUl(this);">
                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>
                     <ul>
                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>
                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="appointment mobSevices  col-sm-4">
               <div class="pull-left">
                  <p>Dental Consultation</p>
                  <span>30min-1h
                  <label>$50</label>
                  </span> 
               </div>
               <ul class="pull-right">
                  <li onclick="showUl(this);">
                     <a> <img src="{{asset('public/assets/website/images/arro-down.png')}}"/> </a>
                     <ul>
                        <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                        <li><a><i class="fa fa-copy"></i> Copy URL </a> </li>
                        <li><a><i class="fa fa-envelope-o"></i> Email URL </a> </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
         <hr>
         <a class="btn btn-primary butt-next center-block" style=" margin: 20px auto;  width: 200px;"  >Quick Start Guide</a>
      </div>
   </div>
</div>
@endsection