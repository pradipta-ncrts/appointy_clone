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
            <div class="form-group">

                                <input type="radio" checked="checked" name="service_displaycl" id="clpopupall" value="1">

                                <label class="right35px">All Clients</label>

                                <div class="clearfix break10px"></div>
                                </div>

               <!--<div class="notify" >

                  <input type="text" id="client-name" class="input-block-level form-control search-ap" placeholder="Client name" >

               </div>-->
               
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
               
               <div class="form-group">

                                <input type="radio" checked="checked" name="service_displaycl" id="clpopup" value="1">

                                <label class="right35px">Enrique J</label>

                                <div class="clearfix break10px"></div>

                                <input type="radio" name="service_displaycl" id="clpopup1" value="2">

                                <label class="right35px">Sadie D</label>
                                
                                <div class="clearfix break10px"></div>

                                <input type="radio" name="service_displaycl" id="clpopup2" value="3">

                                <label class="right35px">Tina D</label>
                                
                                <div class="clearfix break10px"></div>

                                <input type="radio" name="service_displaycl" id="clpopup3" value="3">

                                <label class="right35px">Lucile M</label>

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
color:#D9230F;
}

.search-query:focus + button {
z-index: 3;   
}

</style>
@endsection