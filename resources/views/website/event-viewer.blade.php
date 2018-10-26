@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
   <div class="upper-cmnsection">
         <div class="heading-uprlft">Activity Events</div>
         <div class="upr-rgtsec">
            <!--<div class="col-md-6">
               <ul class="tab-menu ">
                  <li><a href="#" class="active">My Squeedr</a></li>
                  <li><a href="#">Group</a></li>
                  <li><a href="#">Users</a></li>
                  <li><a href="#">Template</a></li>
               </ul>
            </div>-->
            <div class="col-md-6 pull-right">
               <div class="full-rgt">
                  <div class="filter-option"><a href="/">Export / Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
   <div class="clearfix"></div>
   <div class="rightpan full"> 
   <a class="btn btn-default">Show or Hide my actions</a>
     
   <table id="example" class="table table-striped app" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>When</th>
                                                    <th>Type</th>
                                                    <th>Action</th>
                                                    <th align="center" style="text-align: center;">Author</th>
                                                    <th align="center" style="text-align: center;">Calender</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sep 12, 2018  07:00am </td>
                                                    <td>SHowner</td>
                                                    <td>Johan</td>
                                                    <td style="text-align: center;">$200.00</td>
                                                    <td style="text-align: center;">
                                                    Sep 12, 2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sep 12, 2018  07:00am </td>
                                                    <td>SHowner</td>
                                                    <td>Johan</td>
                                                    <td style="text-align: center;">$200.00</td>
                                                    <td style="text-align: center;">
                                                    Sep 12, 2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sep 12, 2018  07:00am </td>
                                                    <td>SHowner</td>
                                                    <td>Johan</td>
                                                    <td style="text-align: center;">$200.00</td>
                                                    <td style="text-align: center;">
                                                    Sep 12, 2018
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
   </div>
      
</div>
</div>
@endsection
