<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>Squeedr</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/mobile.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">
   </head>
   <body class="dashboard-bg">
      <div id="web">
         <header>
            <div class="container-custm">
               <div class="leftpan">
                  <div class="logo">
                     <a href="dashboard.html">
                     <img src="{{asset('public/assets/website/images/logo-light-text.png')}}" /> </a>
                  </div>
                  <!-- <div id="o-wrapper" class="o-wrapper setting-toggle">
                     <a id="c-button--slide-left" class="c-button">
                     <img src="{{asset('public/assets/website/images/setting.png')}}" alt="" />
                     </a>
                  </div> -->
               </div>
               
            </div>
         </header>
         <div class="body-part">
            <div class="container-custm">
               <div class="upper-cmnsection">
                  <div class="heading-uprlft">Client Info.</div>
                  <div class="upr-rgtsec">
                     <div class="col-sm-5">
                        <!-- <div id="custom-search-input">
                           <div class="input-group ">
                              <input type="text" class="  search-query form-control" placeholder="Search" />
                              <span class="input-group-btn">
                              <button class="btn btn-danger" type="button">
                              <span class=" glyphicon glyphicon-search"></span>
                              </button>
                              </span>
                           </div>
                        </div> -->
                     </div>
                     <div class="col-md-7">
                        <div class="full-rgt">
                           <a class="btn btn-primary butt-next1">Next</a>
                           <!--   <div class="dropdown custm-uperdrop">
                              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates
                              
                                  <img src="images/arrow.png" alt="" />
                              
                              </button>
                              
                              <ul class="dropdown-menu">
                              
                                  <li>
                              
                                      <a href="#">JAN</a>
                              
                                  </li>
                              
                                  <li>
                              
                                      <a href="#">FEB</a>
                              
                                  </li>
                              
                                  <li>
                              
                                      <a href="#">MARCH</a>
                              
                                  </li>
                              
                              </ul>
                              
                              </div>
                              
                              <div class="filter-option">
                              
                              <a href="/">Show Filter
                              
                                  <i class="fa fa-filter" aria-hidden="true"></i>
                              
                              </a>
                              
                              </div>-->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="rightpan full">
                  <div class="container">
                     <div class="booking-steps">
                        <hr>
                        <div class="step">
                           <a href="" >1</a>
                           <span >Date & Time</span>
                        </div>
                        <div class="step">
                           <a href="" class="active">2</a>
                           <span class="active">Client Info.</span>
                        </div>
                        <div class="step">
                           <a href="">3</a>
                           <span>Verification</span>
                        </div>
                        <div class="step">
                           <a href="">4</a>
                           <span>Confirmation</span>
                        </div>
                     </div>
                  </div>
                  <div class="container-fluid cust-box pad5per">
                     <div class="row ">
                        <table class="radio-booking">
                           <tr>
                              <td>
                                 <label class="radio">Are you an existing user?  
                                 <input type="radio"  name="radio">
                                 <span class="radiomark"></span>
                                 </label>
                              </td>
                              <td>or</td>
                              <td>
                                 <label class="radio">Are you a new user
                                 <input type="radio" checked="checked" name="radio">
                                 <span class="radiomark"></span>
                                 </label>
                              </td>
                           </tr>
                        </table>
                        <div class="col-md-12 booking-form1">
                           <form class="form-horizontal" action="/action_page.php">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-title.png')}}">
                                 <input type="text" class="form-control" id="email" placeholder="Title">
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-6 booking-form1">
                           <form class="form-horizontal" action="/action_page.php">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-user.png')}}">
                                 <input type="email" class="form-control" id="email" placeholder="First Name">
                                 <div class="clearfix"></div>
                              </div>
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-dob.png')}}">
                                 <input type="email" class="form-control" id="email" placeholder="DOB (Optionsal)">
                                 <div class="clearfix"></div>
                              </div>
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-phone.png')}}">
                                 <input type="email" class="form-control" id="email" placeholder="Mobile">
                                 <div class="clearfix"></div>
                              </div>
                              <div class="checkbox">
                                 <label class="check"><input type="checkbox"> &nbsp;&nbsp; Accept Squeedr CGU
                                 <span class="checkmark"></span></label>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-6 booking-form1">
                           <form class="form-horizontal" action="">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-user.png')}}">
                                 <input type="text" class="form-control"  placeholder="Last Name">
                                 <div class="clearfix"></div>
                              </div>
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-email.png')}}">
                                 <input type="email" class="form-control" id="email" placeholder="Email">
                                 <div class="clearfix"></div>
                              </div>
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/icon-password.png')}}">
                                 <input type="email" class="form-control" id="email" placeholder="Password">
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                        <div class="clearfix"></div>
                        <p class="msg">A code will be sent to you on that mobile number to validate your account</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="mobile">
         <div class="top-bar">
            <a href="#" class="menu">
            <img src="{{asset('public/assets/website/images/mob/top-btn-menu.png')}}" class="img-responsive">
            </a>
            <a href="#" class="note">
            <img src="{{asset('public/assets/website/images/mob/top-btn-add-note.png')}}" class="img-responsive">
            </a>
            <a href="#" class="search">
            <img src="{{asset('public/assets/website/images/mob/top-btn-search.png')}}" class="img-responsive">
            </a>
            <h2>Tile</h2>
         </div>
         <div class="mob-body">
         </div>
      </div>
      <!-- /c-menu slide-left -->
    
      <!--End /c-menu slide-left -->
      <!-- /c-menu slide-right -->
      <div id="c-menu--slide-right" class="c-menu c-menu--slide-right">
         <div class="slide-rgt"><img src="images/quick-icon-rgt.png" alt=""> Quick Start</div>
         <button class="c-menu__close"><img src="images/cross-slide.png" alt="" /></button>
         <ul class="c-menu__items">
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon1.png" alt=""> Room, Services and Packs</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon2.png" alt=""> Current Appointments</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon3.png" alt=""> Book with google</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon4.png" alt=""> PrePayment Option</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon5.png" alt=""> Import & Invite Contacts</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
            <li class="c-menu__item"><a href="#" class="c-menu__link"><img src="images/slide-rgt-icon6.png" alt=""> Add Location</a>
               <span>There are many varitions of passages of Lorem Ipsum available</span>
            </li>
         </ul>
      </div>
      <!--End /c-menu slide-right -->
      <div id="c-mask" class="c-mask"></div>
      <!-- /c-mask -->
      <!-- <script src="js/bootstrap.min.js"></script> -->
      <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script>
      <script src="{{asset('public/assets/website/js/script.js')}}"></script>
      <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
      <script>
         //Make the DIV element draggagle:
         
         dragElement(document.getElementById(("mydiv")));
         
         
         
         function dragElement(elmnt) {
         
             var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
         
             if (document.getElementById(elmnt.id + "header")) {
         
                 /* if present, the header is where you move the DIV from:*/
         
                 document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
         
             } else {
         
                 /* otherwise, move the DIV from anywhere inside the DIV:*/
         
                 elmnt.onmousedown = dragMouseDown;
         
             }
         
         
         
             function dragMouseDown(e) {
         
                 e = e || window.event;
         
                 e.preventDefault();
         
                 // get the mouse cursor position at startup:
         
                 pos3 = e.clientX;
         
                 pos4 = e.clientY;
         
                 document.onmouseup = closeDragElement;
         
                 // call a function whenever the cursor moves:
         
                 document.onmousemove = elementDrag;
         
             }
         
         
         
             function elementDrag(e) {
         
                 e = e || window.event;
         
                 e.preventDefault();
         
                 // calculate the new cursor position:
         
                 pos1 = pos3 - e.clientX;
         
                 pos2 = pos4 - e.clientY;
         
                 pos3 = e.clientX;
         
                 pos4 = e.clientY;
         
                 // set the element's new position:
         
                 elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
         
                 elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
         
             }
         
         
         
             function closeDragElement() {
         
                 /* stop moving when mouse button is released:*/
         
                 document.onmouseup = null;
         
                 document.onmousemove = null;
         
             }
         
         }
         
      </script>
      <script type="text/javascript">
         function slideDiv(obj) {
         
             $(obj).closest(".ds").next(".dsinside").slideToggle();
         
             $(obj).find("i").toggleClass("fa-angle-down fa-angle-up");
         
             $(".dsinside").not($(obj).closest(".ds").next(".dsinside")).slideUp();
         
             $("i.fa-custom").not($(obj).find("i")).removeClass("fa-angle-up").addClass("fa-angle-down");
         
             $(".schedule").fadeOut();
         
         }
         
      </script> 
      <script>
         $(document).ready(function () {
         
             $("#adv-sh").click(function () {
         
                 $("#adv-op").toggle();
         
             });
         
         });
         
         
         
      </script> 
      <script type="text/javascript">
         $(document).ready(function () {
         
             $("ul.menu li a").click(function () {
         
                 $(this).addClass("active");
         
                 $(("li a.active")).not($(this)).removeClass("active");
         
             });
         
             $("#select_date").datepicker('setDate', 'now');
         
             $("#select_date").data('datepicker').hide = function () { };
         
             $("#select_date").datepicker('show');
         
             if ($(window).width() >= 767) {
         
                 $('div').removeClass("showDekstop");
         
             }
         
             $('.owl-carousel').owlCarousel({
         
                  loop: true,
         
                  margin: 10,
         
                  responsiveClass: true,
         
                  responsive: {
         
                     0: {
         
                         items: 3,
         
                         nav: false
         
                     },
         
                      600: {
         
                         items: 3,
         
                         nav: true
         
                     },
         
                        1000: {
         
                         items: 4,
         
                         nav: true,
         
                         loop: false,
         
                         margin: 0
         
         
         
                     }
         
                 }
         
             })
         
         });
         
         function ShowPopup() {
         
             $("#popup").fadeToggle();
         
         }
         
         function togglebtn(obj) {
         
             $(obj).toggleClass("active");
         
             $(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");
         
             $(".mobSevices ul li a.active").find("i").not($(obj).find("i")).removeClass("fa-toggle-on").addClass("fa-toggle-off");
         
             $(".mobSevices ul li a.active").not($(obj)).removeClass("active");
         
         }
         
         function showUl(obj) {
         
             $(obj).find("ul").fadeToggle();
         
             $(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();
         
         }
         
                 $(document).ready(function () { })
         
         
         
             
      </script>
      <!-- slide menu script -->
      <script src="js/menu.js"></script>
      <script>
         /**
         
          * Slide left instantiation and action.
         
          */
         
         var slideLeft = new Menu({
         
           wrapper: '#o-wrapper',
         
           type: 'slide-left',
         
           menuOpenerClass: '.c-button',
         
           maskId: '#c-mask'
         
         });
         
         
         
         var slideLeftBtn = document.querySelector('#c-button--slide-left');
         
         
         
         slideLeftBtn.addEventListener('click', function(e) {
         
           e.preventDefault;
         
           slideLeft.open();
         
         });
         
         
         
         /**
         
          * Slide right instantiation and action.
         
          */
         
         var slideRight = new Menu({
         
           wrapper: '#o-wrapper',
         
           type: 'slide-right',
         
           menuOpenerClass: '.c-button',
         
           maskId: '#c-mask'
         
         });
         
         
         
         var slideRightBtn = document.querySelector('#c-button--slide-right');
         
         
         
         slideRightBtn.addEventListener('click', function(e) {
         
           e.preventDefault;
         
           slideRight.open();
         
         });
         
      </script>
   </body>
</html>