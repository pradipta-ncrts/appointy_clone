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
        <form name="" id="" method="post" action="" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="notify" >
                  <input type="text" id="client-name" class="input-block-level form-control search-ap" placeholder="Client name" >
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

@endsection

@section('custom_js')
<script type="text/javascript">
//Staff Filter
$(document).ready(function(){
  $("#filter-client-list").on("click", function(e) 
  {
      e.preventDefault();
      $("#client-filter-modal").modal('hide');
      var value = $("#client-name").val().toLowerCase();
      $(".customers").filter(function() 
      {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
  });
});

$("#close-client-filter-modal").on("click", function(e) 
{
   e.preventDefault();
   $("#client-filter-modal").modal('hide');
});
</script>
@endsection