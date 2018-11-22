@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Reports</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-7 nopadding">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop" style="margin:0 0px 0 0;">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">This Month <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Yesterday</a></li>
                        <li><a href="#">Last Week</a></li>
                        <li><a href="#">This Week</a></li>
                     </ul>
                  </div>
                  <div class="dropdown custm-uperdrop"  style="margin:0 0px 0 0;">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">By Squdeer Date <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">By Booking Date</a></li>
                     </ul>
                  </div>
                  <div class="dropdown custm-uperdrop"  style="margin:0 0px 0 0;">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Detailed Report <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Group By Date</a></li>
                        <li><a href="#">Group By Month</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="reports.html" class="active"> Sales Reports </a></li>
               <li><a href="#"> Appointement Reports </a> </li>
               <li><a href="#"> Clients Reports </a></li>
               <li><a href="#"> Staff Reports </a></li>
               <li><a href="#" > Clients Alerts report</a> </li>
               <li><a href="#" > SMS Delivery Reports</a> </li>
               <li><a href="#" > Credit Charges Reports </a> </li>
               <li><a href="#"> Event Report </a> </li>
               <li><a href="#" > Cancellation </a> </li>
            </ul>
         </div>
      </div>
      <form class="form-horizontal" action="/action_page.php">
         <div class="rightpan  ">
            <div class="container magbt15 nopadding ">
               <div class="title-bar cust-box" >
                  <div class="ico-btn">
                     <a href="#" class="fa fa-filter"></a>
                     <a href="#" class="fa fa-print"></a>
                     <a href="#" class="fa fa-save"></a>
                  </div>
                  <h2>Sales Reports </h2>
               </div>
            </div>
            <div class="container-fluid " style="margin: 0 0 15px 0; "  >
               <div class="row  ">
                  <div class="col-md-8 booking-form">
                     <!-- <h3> Search </h3>-->
                     <div class="search-report ">
                        <div class="form-group" >
                           <div class="col-sm-3">
                              <input type="text" class="form-control" placeholder="From Date">
                           </div>
                           <div class="col-sm-3">
                              <input type="text" class="form-control" placeholder="To Date">
                           </div>
                           <div class="col-sm-4">
                              <select class="form-control cust-select">
                                 <option>Detail Reports</option>
                              </select>
                           </div>
                           <div class="col-sm-2">
                              <button class="btn btn-primary " style="margin: 10px 0 0 0" type="submit">Search</button>
                           </div>
                        </div>
                        <a href="#">Advance Search</a>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <div class="col-md-4 text-center ">
                     <div class="rep">
                        <h1>0%</h1>
                        <h3>Totall Booking</h3>
                     </div>
                  </div>
               </div>
            </div>
      </form>
      <div class="container-fluid cust-box " style="min-height: 250px;">
      <div class="row">
      <div class="chart "> There is no record available</div>
      </div>
      </div>
      </div>
   </div>
</div>
@endsection