@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Add Client</h1>
  <ul>
    <li>&nbsp;<!-- <img src="images/mobile-serach.png" /> --> </li>
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
           <form name="add_client_form" id="add_client_form" method="post" action="{{url('api/add_client')}}" enctype="multipart/form-data">
               <div class="whitebox mobile-control">
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-first-name.png')}}"/> </span>
                   <input id="client_name" type="text" class="form-control" name="client_name" placeholder="Full Name">
                 </div>
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-email.png')}}"/> </span>
                    <input id="client_email" type="text" class="form-control" name="client_email" placeholder="Email Address">
                 </div>
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-phone.png')}}"/> </span>
                    <input id="client_mobile" type="text" class="form-control" name="client_mobile" placeholder="Mobile" style="width: 92%;">
                 </div>
                 <a role="button" id="client_more_phone"><i class="fa fa-plus"></i></a>
                <div id="client_other_phone" style="display: none;">
                 <div class="input-group"> <span class="input-group-addon"></span>
                    <input id="client_home_phone" type="text" class="form-control" name="client_home_phone" placeholder="Home Phone">
                 </div>
                 <div class="input-group"> <span class="input-group-addon"></span>
                    <input id="client_work_phone" type="text" class="form-control" name="client_work_phone" placeholder="Home Phone">
                 </div>
               </div>
                 <div class="customcontrol">
                    <select class="form-control" name="client_category" id="client_category" >
                      <option value="">Select Category </option>
                      <?php
                      if(!empty($category_list['category_list']))
                      foreach ($category_list['category_list'] as $key => $value)
                      {
                          echo "<option value='".$value->category_id."'>".$value->category."</option>";
                      }
                      ?>
                    </select>
                 </div>
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-address.png')}}"/></span>
                    <input placeholder="Address" type="text" class="form-control" name="client_address"></input>
                 </div>
                 <div class="customcontrol">
                    <select class="form-control" name="client_timezone" id="client_timezone" >
                      <option value="">Select Timezone </option>
                      <?php
                      foreach($time_zone as $tzone)
                      {
                      ?>
                      <option value="<?=$tzone['zone'] ?>">
                        <?=$tzone['diff_from_GMT'] . ' - ' . $tzone['zone'] ?>
                      </option>
                      <?php
                      }
                      ?>
                    </select>
                 </div>
                 <textarea class="form-control notes" name="client_note" id="client_note" placeholder="Client Note"></textarea>
                 <div class="input-group">
                    <div class="checkbox-cutm">
                       <input name="client_send_email" id="client_send_email" type="checkbox" value=""> Send Email confirmation
                    </div>
                 </div>
                 <input class="btn btn-mobile btn-block btn-size break20px" type="submit" name="Proceed" value="Proceed" id="procesdddd">
                <!--  <a id="myBtn" class="btn btn-mobile btn-block btn-size break20px">Proceed</a> --> 
              </div>
           </form>
         </div>
      </div>
   </div>
</main>

@endsection


@section('custom_js')
<script type="text/javascript">
  $("#client_more_phone").click(function(event)
  {
      event.preventDefault();
      if ($('#client_other_phone').css('display') == 'none')
      {
          $('#client_other_phone').show();
      }
      else
      {
          $('#client_other_phone').hide();
      }
      

  });
  
</script>
@endsection