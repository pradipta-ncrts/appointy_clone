<!DOCTYPE html>
<html lang="en">
<head>
<title> @yield('title') :: <?=$title;?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/matrix-media.css')}}" />
<link href="{{asset('public/assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('public/assets/admin/css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"> var js_base_url = '<?=url('');?>/';</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="{{url('admin/dashboard')}}">Squdeer Admin</a></h1>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome
    <?php
    $name = Session::get('login');
    echo $name->username;
    ?>
  </span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="{{url('admin/change-password')}}"><i class="icon-check"></i> Change Password</a></li>
        <li class="divider"></li>
        <li><a href="{{url('admin/logout')}}"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="{{url('admin/logout')}}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="<?php if(strpos(Request::segment(2), 'dashboard') !== false) { echo "active"; } ?>"><a href="{{asset('admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu <?php if(strpos(Request::segment(2), 'category') !== false || strpos(Request::segment(2), 'country') !== false || strpos(Request::segment(2), 'profession') !== false || strpos(Request::segment(2), 'currency') !== false) { echo "active"; } ?>"> <a href="#"><i class="icon icon-th-list"></i><span>Settings</span></a>
      <ul>
        <li class="<?php if(strpos(Request::segment(2), 'category') !== false) { echo "active"; } ?>"><a href="{{asset('admin/category')}}">Categories</a></li>

        <li class="<?php if(strpos(Request::segment(2), 'country') !== false) { echo "active"; } ?>"><a href="{{asset('admin/country')}}">Country</a></li>

        <li class="<?php if(strpos(Request::segment(2), 'profession') !== false) { echo "active"; } ?>"><a href="{{asset('admin/profession')}}">Profession</a></li>

        <li class="<?php if(strpos(Request::segment(2), 'currency') !== false) { echo "active"; } ?>"><a href="{{asset('admin/currency')}}">Currency</a></li>

      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->
<!--main-container-part-->
<div id="content">
@yield('content')
</div>
<!--end-main-container-part-->
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> <?=date('Y');?> &copy; Squdeer Admin. Brought to you by <a href="http://www.ncrts.com">NCRTS</a> </div>
</div>

<!--end-Footer-part-->

<script src="{{asset('public/assets/admin/js/jquery.min.js')}}"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('public/assets/admin/js/jquery.ui.custom.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/jquery.uniform.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/select2.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/jquery.validate.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.form_validation.js')}}"></script>

<script src="{{asset('public/assets/admin/js/excanvas.min.js')}}"></script> 
<!-- <script src="{{asset('public/assets/admin/js/jquery.flot.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/jquery.flot.resize.min.js')}}"></script> --> 
<script src="{{asset('public/assets/admin/js/jquery.peity.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/fullcalendar.min.js')}}"></script> 
<!-- <script src="{{asset('public/assets/admin/js/matrix.dashboard.js')}}"></script>-->
<script src="{{asset('public/assets/admin/js/jquery.gritter.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.interface.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.chat.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/jquery.wizard.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.popover.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('public/assets/admin/js/matrix.tables.js')}}"></script> 

<script src="{{asset('public/assets/admin/js/custom.js')}}"></script> 

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script type="text/javascript">
   $( function() {
    $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
</script>

</body>
</html>
