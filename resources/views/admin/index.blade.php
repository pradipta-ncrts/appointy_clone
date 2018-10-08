@extends('../layouts/admin/master_template_admin')
@section('title')
Squdeer Admin
@endsection


@section('content')
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <h2 style="text-align: center;">Welcome to Squdeer Admin</h2>
   <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="#"> <i class="icon-user"></i> <span class="label label-important"><?=count($userCount)?></span> Total Users </a> </li>
        
        <li class="bg_ly"> <a href="#"> <i class="icon-user"></i><span class="label label-success"><?=count($verifiedUsers);?></span> Verified Users </a> </li>

        <li class="bg_lr"> <a href="#"> <i class="icon-user"></i><span class="label label-success"><?=count($blockUsers);?></span> Block Users </a> </li>
       <li class="bg_lo"> <a href="#"> <i class="icon-th-list"></i><span class="label label-success"><?=count($transuctions);?></span> Total Number Truncstion</a> </li>
        <li class="bg_lg"> <a href="#"> <i class="icon-info-sign" aria-hidden="true"></i><span class="label label-success"><?=$totalTrancuction;?></span> Total Trancuction </a> </li>
        <li class="bg_ly"> <a href="#"> <i class="icon-info-sign"></i><span class="label label-success"><?=$totalTransfer;?></span> Total Transfer </a> </li>
        <!-- <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
        <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
        <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li> -->

      </ul>
    </div>
<!--End-Action boxes-->    
  </div>
@endsection