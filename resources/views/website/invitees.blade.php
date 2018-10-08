@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Invitees</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="images/arrow.png" alt=""/></button>
                     <ul class="dropdown-menu">
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
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="#"> Active</a></li>
               <li><a href="#"> Inactive</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class="headRow showDekstop clearfix">
               <div class="col-md-12 table-set">
                  <table id="example" class="table table-striped" style="width:100%">
                     <thead>
                        <tr>
                           <th>Email</th>
                           <th>Status</th>
                           <th>Journey</th>
                           <th align="right" style="text-align: right;">Date Invited</th>
                           <th align="center" style="text-align: center;">&nbsp;</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <tr>
                           <td>lamie74@gmail.com</td>
                           <td>Pending</td>
                           <td>&nbsp;</td>
                           <td align="right">Aug 10, 2018</td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#"><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="custm-tab team-memtab">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#tabmenu1">Active</a></li>
               <li><a data-toggle="tab" href="#tabmenu2">Inactive</a></li>
            </ul>
            <div class="tab-content">
               <div id="tabmenu1" class="tab-pane fade in active">
                  <div class="mobileStaff showMobile" >
                     <div class="whitebox">
                        <h2>Dr. Concepcion M.</h2>
                        <span>Psychiatrist</span>
                        <ul>
                           <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                           <li><i class="fa fa-phone"></i>802-438-0497</li>
                        </ul>
                        <ol>
                           <li>Addiction, Alcoholism</li>
                           <li>Sleep Medicine</li>
                           <li><a>More </a></li>
                        </ol>
                     </div>
                     <div class="whitebox">
                        <h2>Dr. Concepcion M.</h2>
                        <span>Psychiatrist</span>
                        <ul>
                           <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                           <li><i class="fa fa-phone"></i>802-438-0497</li>
                        </ul>
                        <ol>
                           <li>Addiction, Alcoholism</li>
                           <li>Sleep Medicine</li>
                           <li><a>More </a></li>
                        </ol>
                     </div>
                  </div>
               </div>
               <div id="tabmenu2" class="tab-pane fade">
                  <p>Some content in tab menu 2.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection