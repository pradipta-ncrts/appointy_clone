<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Dashboard</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/fonts.css" />
      <link rel="stylesheet" href="css/font-awesome.min.css" />
      <link rel="stylesheet" href="css/animate.css" />
      <link href="css/fonts.css" rel="stylesheet" />
      <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
      <link rel="stylesheet" href="css/nice-select.css" />
      <link href="css/styles.css" rel="stylesheet">
      <link rel="stylesheet" href="css/app.css" />
   </head>
   <body>
      <header class="mobileHeader showMobile" id="divBh">
         <a class="showSidenav"><img src="images/menu-icon.png" /> </a>
         <h1>Dashboard</h1>
         <ul>
            <li><a> <img src="images/mobile-notes.png" /></a> </li>
            <li><a> <img src="images/mobile-serach.png" /></a> </li>
         </ul>
      </header>
      <div class="menuoverlay">
         <div class="sideNavbar sideToggle">
            <div class="profileMenuImg">
               <img src="images/profilepicmobile.jpg" />   
               <span>Esther F. Gladden</span>   
            </div>
            <ul>
               <li><a><img src="images/sidenav/bookings.png"/> <span>Bookings</span> </a> </li>
               <li><a><img src="images/sidenav/review.png"/> <span>Reviews</span> </a> </li>
               <li><a><img src="images/sidenav/customers.png"/> <span>Customers</span> </a> </li>
               <li><a><img src="images/sidenav/feedback.png"/> <span>Feedback</span> </a> </li>
               <li><a><img src="images/sidenav/customers.png"/> <span>Customers</span> </a> </li>
               <li><a><img src="images/sidenav/background.png"/> <span>Change Background   </span> </a> </li>
               <li><a><img src="images/sidenav/about.png"/> <span>About</span> </a> </li>
               <li><a><img src="images/sidenav/logout.png"/> <span>Logout</span> </a> </li>
            </ul>
         </div>
      </div>
      <header class="showDekstop clearfix">
         <div class="leftpan">
            <div class="logo"><a href="dashboard.html"><img src="images/logo-light-text.png" /></a></div>
            <div class="search">
               <input type="text" placeholder="Search"> <img src="images/icon-search.png" />      
            </div>
         </div>
         <div class="rightpan">
            <div class="top-nav">
               <a href="#"><img src="images/icon-logout.png" >Logout</a>
               <a href="#"><img src="images/icon-help.png" >Help</a>
               <div class="dropdown prof-menu" href="#">
                  <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                  <img class="user-pic" src="images/user-img.png">Minnie</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item" href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>  Share links</a>
                     <a class="dropdown-item" href="calendar-connections.html"><i class="fa fa-calendar" aria-hidden="true"></i>  Calendar Connections</a>
                     <a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i>  Profile settings</a>
                     <a class="dropdown-item" href="#"><i class="fa  fa-id-card " aria-hidden="true"></i>  Memebership</a>
                     <a class="dropdown-item" href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                     <a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a>
                     <a class="dropdown-item" href="#"><i class="fa fa-ban" aria-hidden="true"></i>  Delete Profile</a>
                     <a class="dropdown-item" href="#"><i class="fa fa-question-circle " aria-hidden="true"></i>  Help</a>
                  </div>
               </div>
               <a href="#"><img src="images/preview.png" ></a>
            </div>
            <div class="main-nav">
               <a href="#" class="settings">Settings</a>               
               <a href="#" class="customers">Customers</a>
               <a href="#" class="reports">Reports</a>
               <a href="#" class="marketing">Marketing</a>
               <a href="#" class="calendar">Calendar</a>
               <a href="#" class="dashboard active">Dashboard</a>
            </div>
         </div>
      </header>
      <nav class="showDekstop">
         <div class="row">
            <div class="col-lg-12">
               <input type="range" class="slider" /> 
            </div>
            <div id="select_date"></div>
            <ul>
               <li>
                  <a href="#"><img src="images/staff.gif" /> <span>Staff</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/rooms.gif" /> <span>Rooms, Services &amp; Packs</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/appointments.gif" /> <span>Current Appointments</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/google.gif" /> <span>Book with google</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/prepayment.gif" /> <span>PrePayment Option</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/import.gif" /> <span>Import &amp; Invite Contacts</span> </a>
               </li>
               <li>
                  <a href="#"><img src="images/location.gif" /> <span>Add Location</span> </a>
               </li>
            </ul>
         </div>
      </nav>
      <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="headRow clearfix showDekstop">
                     <div class="col-lg-4 col-md-6 col-sm-12">
                        <ul class="pagination">
                           <li class="active"><a href="#">Day</a></li>
                           <li><a href="#">Week</a></li>
                           <li><a href="#">Month</a></li>
                           <li><a href="#">Agenda</a></li>
                           <li><a href="#">Availability</a></li>
                        </ul>
                     </div>
                     <div class="col-lg-4 col-md-3 col-sm-6">
                        <div id="dates">
                           <a href="#"><img src="images/headprev.gif" /> </a> <span>Wed, Apr 25, 2018</span>
                           <a href="#"><img src="images/headnext.gif" /> </a>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-3">
                        <ul class="addons">
                           <li>
                              <a href="#"><img src="images/add-note.gif" /> <span>Add Note</span></a>
                           </li>
                           <li>
                              <a href="#"><img src="images/daIly-calender.gif" /><span>Daily Report</span></a>
                           </li>
                           <li>
                              <a href="#"><img src="images/refresh.gif" /><span>Refresh</span></a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="dashHeader showMobile">
                     <div class="dashSchedule">
                        <ul>
                           <li><span>Wed, Apr 25, 2018</span></li>
                           <li><img src="images/mobile-control-icons/mobile-calender.png" /> </li>
                        </ul>
                        <ul>
                           <li><a>Day</a></li>
                           <li><a>Week</a> </li>
                           <li><a>Month</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="table-responsive" id="tbleDash">
                     <table class="table table-bordered table-custom table-dashboard">
                        <thead>
                           <tr>
                              <th><img src="images/settings-icon.png" class="showDekstop" /> <i class="fa fa-gear showMobile"></i> </th>
                              <th class="mobileHead">
                                 <span class="name">Minnie </span><img src="images/table-arrow-down.png" class="showMobile"/>
                                 <img src="images/table-dots.png" class="showMobile pull-right"/>
                                 <ul>
                                    <li><img src="images/table-calender.png" /><span>See Weekly Schedule </span></li>
                                    <li><img src="images/block-icon.png" /><span>Block</span> </li>
                                 </ul>
                              </th>
                              <th>
                                 <span class="name">Thomas</span>
                                 <ul>
                                    <li><img src="images/table-calender.png" /><span>See Weekly Schedule</span> </li>
                                    <li><img src="images/block-icon.png" /><span>Block</span> </li>
                                 </ul>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>10 am</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>11 am</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>12 am</td>
                              <td class="bluebg">
                                 <div class="showMobile">
                                    <ul>
                                       <li>
                                          <h4>12:15 PM</h4>
                                       </li>
                                       <li>
                                          <p>( 1 Hours ) - $200</p>
                                       </li>
                                    </ul>
                                    <h5>Smile corrections</h5>
                                    <label>New Brunswick, New Jersey, United States</label>
                                    <ul>
                                       <li>
                                          <img src="images/tbl-phone.png"/> 
                                          <p> 222-333-4444</p>
                                       </li>
                                       <li>
                                          <img src="images/tbl-doc.png"/>
                                          <p>Notes</p>
                                       </li>
                                    </ul>
                                 </div>
                              </td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>1 pm</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>2 pm</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <button class="popup-button" onclick="ShowPopup(this);"><img src="images/plus.png" /> </button>
      <div id="popup">
         <div class="popUpmenu showDekstop ">
            <div class="container" style="background: none;">
               <div class="row">
                  <div class="col-md-12">
                     <ul class="menuList">
                        <li><a><img src="images/add-menu/appointment.png"/>Add Appointment </a></li>
                        <li><a><img src="images/add-menu/clients.png"/>Add Clients </a></li>
                        <li><a><img src="images/add-menu/staff.png"/>Staff </a></li>
                        <li><a><img src="images/add-menu/services.png"/>Rooms,Services &amp; Packs </a></li>
                        <li><a><img src="images/add-menu/block-time.png"/>Block Time </a></li>
                        <li><a><img src="images/add-menu/block-date.png"/>Block Date </a></li>
                        <li><a><img src="images/add-menu/list-of-notes.png"/> List of Notes </a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <ul class="showMobile menuList">
            <li><a>List of Notes <img src="images/add-menu/list-of-notes.png"/></a></li>
            <li><a onclick="blockTime();">Block Time <img src="images/add-menu/block-time.png"/></a></li>
            <li><a onclick="blockDate();">Block Date <img src="images/add-menu/block-date.png"/></a></li>
            <li><a>Services <img src="images/add-menu/services.png"/></a></li>
            <li><a>Staff <img src="images/add-menu/staff.png"/></a></li>
            <li><a>Add Clients <img src="images/add-menu/clients.png"/></a></li>
            <li><a>Add Appointment <img src="images/add-menu/appointment.png"/></a></li>
         </ul>
         <div id="blockDate" class="showMobile">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                     <div class="popupInside dashDateTime showMobile">
                        <h3>Block Date</h3>
                        <div class="mobile-control">
                           <div class="input-group">
                              <input class="form-control nice-select" type="text" placeholder="Select Date" />    
                              <span class="input-group-addon"><img src="images/mobile-control-icons/mobile-calender.png"/> </span>
                           </div>
                           <h6>Reason</h6>
                           <div class="break10px"></div>
                           <textarea class="form-control paddingLeft12px" rows="4" placeholder="Write Here"></textarea>
                           <div class="break20px"></div>
                           <h6>Block For</h6>
                           <div class="break10px"></div>
                           <input class="form-control nice-select" type="text" placeholder="All Staff" />
                        </div>
                        <a class="btn btn-block btn-mobile break10px">Block</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="blockTime" class="showMobile">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="popupInside dashDateTime showMobile">
                        <h3>Block Time</h3>
                        <div class="mobile-control">
                           <h6>Select Time</h6>
                           <div class="break10px"></div>
                           <div class="row">
                              <div class="col-xs-5">
                                 <div class="input-group custom-group">
                                    <input class="form-control" type="text" placeholder="Select Time" />    
                                    <span class="input-group-addon"><img src="images/mobile-clock.png"/> </span>
                                 </div>
                              </div>
                              <div class="col-xs-2 text-center">
                                 <label class="customlabel">to</label>    
                              </div>
                              <div class="col-xs-5">
                                 <div class="input-group custom-group">
                                    <input class="form-control" type="text" placeholder="Select Time" />    
                                    <span class="input-group-addon"><img src="images/mobile-clock.png"/> </span>
                                 </div>
                              </div>
                           </div>
                           <div class="input-group custom-group">
                              <input class="form-control" type="text" placeholder="Select Date" />    
                              <span class="input-group-addon"><img src="images/mobile-control-icons/mobile-calender.png"/> </span>
                           </div>
                           <h6>Reason</h6>
                           <div class="break10px"></div>
                           <div class="custom-group">
                              <textarea class="form-control paddingLeft12px" rows="4" placeholder="Write Here"></textarea>
                           </div>
                           <div class="break20px"></div>
                           <h6>Block For</h6>
                           <div class="break10px"></div>
                           <div class="custom-group">
                              <input class="form-control nice-select" type="text" placeholder="All Staff" />
                           </div>
                        </div>
                        <a class="btn btn-block btn-mobile break10px">Block</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function () {
             $("ul.menu li a").click(function () {
                 $(this).addClass("active");
                 $(("li a.active")).not($(this)).removeClass("active");
             });
             $("#select_date").datepicker('setDate', 'now');
             $("#select_date").data('datepicker').hide = function () {};
             $("#select_date").datepicker('show');
             $(".showSidenav").click(function(e){
             $(".menuoverlay").fadeIn();
             $(".sideNavbar").removeClass("sideToggle");
             e.stopPropagation();
             });
           $(".sideNavbar").click(function(e){
               e.stopPropagation();
             });
             $(".menuoverlay").click(function(){
             $(".menuoverlay").fadeOut();
             $(".sideNavbar").addClass("sideToggle");
         });
             if(screen.width >=767){
                 $("table tr td").removeClass("bluebg");
             }
         });
         function ShowPopup(obj) {
             //$("#popup").fadeToggle();
             $(obj).next("#popup").fadeToggle();
             $(obj).toggleClass("rotatebtn");
         }
         function blockDate(){
             $(".menuList").fadeOut('fast');
             $("#blockDate").fadeIn();
         }
         function blockTime(){
             $(".menuList").fadeOut('fast');
             $("#blockTime").fadeIn();
         }
      </script>
      <!-- sideToggle-->
      <script src="js/bootstrap-datepicker.js"></script>
   </body>
</html>