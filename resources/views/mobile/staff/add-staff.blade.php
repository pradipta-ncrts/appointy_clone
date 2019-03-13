@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Add Team</h1>
   <ul>
      <li>
         &nbsp;<!-- <img src="images/mobile-serach.png" /> --> 
      </li>
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
            <form name="add_team_member_form" id="add_team_member_form" method="post" action="{{url('api/add_staff')}}" enctype="multipart/form-data">
               <div class="whitebox mobile-control">
                  <div class="customcontrol">
                     <select class="form-control" name="staff_type" id="staff_type" >
                        <option value="1">Manager</option>
                        <option value="2">Staff</option>
                     </select>
                  </div>
                  <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-first-name.png')}}"/> </span>
                     <input id="staff_fullname" type="text" class="form-control" name="staff_fullname" placeholder="Full Name">
                  </div>
                  <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-first-name.png')}}"/> </span>
                     <input id="staff_username" type="text" class="form-control" name="staff_username" placeholder="Username">
                  </div>
                  <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-email.png')}}"/> </span>
                     <input id="staff_email" type="text" class="form-control" name="staff_email" placeholder="Email Address">
                  </div>
                  <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-phone.png')}}"/> </span>
                     <input id="staff_mobile" type="text" class="form-control" name="staff_mobile" placeholder="Mobile" style="width: 92%;">
                  </div>
                  <a role="button" id="client_more_phone"><i class="fa fa-plus"></i></a>
                  <div id="client_other_phone" style="display: none;">
                     <div class="input-group"> <span class="input-group-addon"></span>
                        <input id="staff_home_phone" type="text" class="form-control" name="staff_home_phone" placeholder="Home Phone">
                     </div>
                     <div class="input-group"> <span class="input-group-addon"></span>
                        <input id="staff_work_phone" type="text" class="form-control" name="staff_work_phone" placeholder="Work Phone">
                     </div>
                  </div>
                  <div class="customcontrol">
                     <select class="form-control" name="staff_category" id="staff_category" >
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
                  
                  <textarea class="form-control notes" name="staff_expertise" id="staff_expertise" placeholder="Expertise (i.e. Insomnia, Sleep disorder, Hyperactivity,...)"></textarea>

                  <textarea class="form-control notes" name="staff_description" id="staff_description" placeholder="Description"></textarea>
                  <div class="input-group"> <span class="input-group-addon"></span>
                      <div class="add-gly">
                          <div class="add-picture"><img id="blah" src="#" alt="" style="display:none;" width="60px" height="60px" /></div>
                          <!--<div class="add-picture-text">UPLOAD PICTURE</div>-->
                          <input type="file" name="staff_profile_picture" id="staff_profile_picture" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
                      </div>
                  </div>
                  <div class="input-group">
                     <div class="checkbox-cutm">
                        <input name="staff_send_email" type="checkbox" value="1"> Login details will send to the Team member
                     </div>
                  </div>
                  <input class="btn btn-mobile btn-block btn-size break20px" type="submit" name="Proceed" value="Proceed">
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