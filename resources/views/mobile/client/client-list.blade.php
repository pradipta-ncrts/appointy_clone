@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>All Clients</h1>
   <ul>
      <li data-toggle="modal" data-target="#client-filter-modal"><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></li>
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row showDekstop">
         <!--Edited by Sandip - Start-->
         <!--Edited by Sandip - End-->
      </div>
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <?php
           foreach ($client_list as $key => $value)
           {
           ?>
            <div class="whitebox customers">
               <div class="customersLeft">
                  <h3><?=$value->client_name;?></h3>
                  <div class="cdetails">
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
                        <label><?=$value->client_mobile;?></label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
                        <label><?=$value->client_dob=='0000-00-00' ? 'N/A' : date('M d, Y', strtotime($value->client_dob));?></label>
                     </div>
                     <div>
                        <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
                        <label><?=$value->client_address;?></label>
                     </div>
                  </div>
               </div>
               <div class="customersRight">
                  <div>
                     <a href="{{url('mobile/client-details')}}/<?=$value->client_id;?>"><i class="fa fa-angle-right"></i></a>
                  </div>
                  <div class="cunotes">
                     <img src="{{asset('public/assets/mobile/images/customer-details/black-notes.png')}}"/>
                     <label><a href="{{url('mobile/client-note')}}/<?=$value->client_id;?>" style="font-size:14px;color:#000;">Notes</a></label>
                  </div>
               </div>
            </div>
            <?php
               }
               
               ?>
         </div>
      </div>
   </div>
</main>
<div class="modal fade mb-custmmodal" id="client-filter-modal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content--> 
      <div class="popupInside new-modalcustm">
         <h3 class="text-center">Select Client</h3>
         <form name="" id="" method="post" action="" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="form-group">
                  <ul class="clin-ln">
                     <li style="border-bottom:0;margin-bottom:0;">
                        <input type="radio" <?=Request::segment(3)=='' ? 'checked="checked"' : ""; ?> name="client_name" id="clpopupall" value="1">
                        <label class="right35px">All Clients</label>
                        <div class="clearfix break10px"></div>
                     </li>
                  </ul>
               </div>
               <!--<div class="notify" >
                  <input type="text" id="client-name" class="input-block-level form-control search-ap" placeholder="Client name" >
                  
                  </div>-->
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="search-query form-control checked" placeholder="Search" id="client-name" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class="glyphicon glyphicon-search" id="search-client"></span>
                     </button>
                     </span>
                  </div>
               </div>
               <div class="form-group">
                  <ul class="clin-ln">
                     <?php
                     foreach ($mobile_filter_client_list as $key => $value)
                     {
                     ?>
                     <li class="customers-filter">
                        <input type="radio" name="client_name" class="checked" value="<?=$value->client_name;?>" <?=Request::segment(3)==$value->client_name ? 'checked="checked"' : ""; ?>>
                        <label class="right35px"><?=$value->client_name;?></label>
                     </li>
                     <div class="clearfix break10px"></div>
                     <?php
                      }
                     ?>
                  </ul>
               </div>
               <div class="butt-pop-ft">
                  <button type="submit" id="filter-client-list" class="btn btn-primary butt-next">Done</button> 
                  <a href="JavaScript:Void(0);" id="close-client-filter-modal" class="btn btn-primary butt-next">Cancel</a> 
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<style>
   .cdetails div{width:100%;float:left;margin: 5px 0}
   .cdetails img{float:left;}
   .cdetails label{display: inline;}
   .cunotes{width:70px;}
</style>
@endsection
@section('custom_js')
<script type="text/javascript">
   //Client Filter
   $(document).ready(function(){
     $("#search-client").on("click", function(e) 
     {
         e.preventDefault();
         //$("#client-filter-modal").modal('hide');
         var value = $("#client-name").val().toLowerCase();
         $(".customers-filter").filter(function() 
         {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
     });
   });

   $(document).ready(function(){
     $("#filter-client-list").on("click", function(e) 
     {
         e.preventDefault();
         var search_string = $("input[name=client_name]:checked").val();
         if(search_string==1)
         {
            window.location.replace(baseUrl+'client-list'); 
         }
         else
         {
            window.location.replace(baseUrl+'client-list/'+search_string); 
         }
     });
   });

   $("#close-client-filter-modal").on("click", function(e) 
   {
      e.preventDefault();
      $("#client-filter-modal").modal('hide');
   });
   
</script>
<style>
   #custom-search-input {
   margin:0 0 15px;
   padding: 0;
   }
   #custom-search-input .search-query {
   padding-right: 3px;
   padding-right: 4px \9;
   padding-left: 3px;
   padding-left: 4px \9;
   /* IE7-8 doesn't have border-radius, so don't indent the padding */
   margin-bottom: 0;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;height: 45px;    width: 107%;
   }
   #custom-search-input button {
   border: 0;
   background: none;
   /** belows styles are working good */
   padding: 2px 5px;
   margin-top: 2px;
   position: relative;
   left: -8px;
   /* IE7-8 doesn't have border-radius, so don't indent the padding */
   margin-bottom: 0;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;
   color:#337AB7;
   }
   .search-query:focus + button {
   z-index: 3;   
   }
   .clin-ln{width:100%;float:left;}
   .clin-ln li{border-top:1px solid #ccc;padding:13px 0 10px;margin:0;}
   .clin-ln li:last-child{border-bottom:1px solid #ccc;margin-bottom:20px;}
</style>
@endsection