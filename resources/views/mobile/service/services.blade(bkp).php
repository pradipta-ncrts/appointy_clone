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
            <ul class="tab-menu">
               <li><a href="#" class="active">My Squeedr</a></li>
               <li><a href="#">Group</a></li>
               <li><a href="#">Users</a></li>
               <li><a href="#">Template</a></li>
            </ul>
         </div>
         <div class="col-sm-5">
            <div id="custom-search-input">
               <div class="input-group ">
                  <input type="text" class="  search-query form-control" placeholder="Search" />
                  <span class="input-group-btn">
                  <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-1">
            <div class="filter-option"><a href="#">  <i class="fa fa-filter" aria-hidden="true"></i></a></div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class="leftpan">
      <div class="left-menu">
         <ul>
            <?php
            //echo "<pre>";
            //print_r($service_list); 
            foreach ($service_list as $key => $value) 
            {
            ?>
            <li><a class="service-list <?=$key==0 ? "active" : ""; ?>" id="<?=$key?>" href="JavaScript:Void(0);"> <?=$value->category;?></a></li>
            <?php
            }
            ?>
         </ul>
      </div>
   </div>
   <div class="rightpan">
      <div class="mobSevices lnk">
         <ul >
            <li onclick="showUl(this);">
               <a href="#"> Mysqueedr.link.com <i class="fa fa-caret-down"></i></a>
               <ul>
                  <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                  <li><a><i class="fa fa-code"></i> Embed </a> </li>
               </ul>
            </li>
         </ul>
      </div>
      <div class="new-event">
         <form class="form-horizontal" action="/action_page.php">
            <div class="form-group nomarging custom-select color-b" >
               <select >
                  <option>  New Event Type</option>
               </select>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </form>
         <div class="new-event">    
         </div>
         <div class="clearfix"></div>
      </div>
      <?php
      foreach ($service_list as $key => $value) 
      {
      ?>
      <div class="headRow mobileappointed clearfix break40px row-2" id="row<?=$key;?>" <?=$key=='0' ? '' : 'style="display: none;"';?>>
         <?php
         foreach ($value->details as $details)
         {
         ?>
         <div class="appointment mobSevices  col-sm-4">
            <div class="pull-left">
               <p><?=$details->service_name;?></p>
               <span><?=$details->duration;?> min
               <label><?=$details->currency;?> <?=$details->duration ? $details->cost : '';?></label>
               </span> 
            </div>
            <ul class="pull-right">
               <li onclick="showUl(this);">
                  <a> <img src="{{asset('public/assets/website/images/threeDots.png')}}"/> </a>
                  <ul>
                     <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                     <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                     <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                     <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                     <li><a><i class="fa fa-code"></i> Embed </a> </li>
                     <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                  </ul>
               </li>
               <li><a href="" id="<?=$details->service_id;?>" onclick="togglebtn(this);" class="chnage-service-status <?=$details->is_blocked==0 ? 'active' : ''; ?>"> <i class="fa fa-toggle-on"></i> </a> </li>
            </ul>
         </div>
         <?php
         }
         ?>
      </div>
      <?php
      }
      ?>
      <div class="clearfix"></div>
   </div>
</div>
@endsection

