@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Staff List</h1>
  <ul>
    <li><a href="{{url('mobile/add-staff')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
  </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="mobileStaff break10px showMobile" >
            <?php
            if(!empty($staff_list))
            {
              foreach ($staff_list as $key => $value)
              {
            ?>
            <div class="whitebox">
               <h2><?=$value->full_name;?></h2>
               <span><?=$value->expertise;?></span>
               <ul>
                  <li><i class="fa fa-envelope"></i><?=$value->email;?></li>
                  <li><i class="fa fa-phone"></i><?=$value->mobile ? $value->mobile : 'NIL'; ?></li>
               </ul>
               <a href="javascript:void(0);" class="editStaff" data-staff-id="<?=$value->staff_id;?>" style=" position: absolute;  right: 17px;  bottom: 13px;"><i class="fa fa-pencil"></i> </a>
               <ol>
                  <li><?=$value->addess;?></li>
                  <!-- <li>Sleep Medicine</li>
                  <li><a>More </a></li> -->
               </ol>
            </div>
            <?php
                }
            }
            else
            {
            ?>
              <div class="whitebox">
               <h2>No data found.</h2>
              </div>
            <?php
            }
            ?>
         </div>
      </div>
   </div>
</main>
<div class="modal fade" id="myModaleditstaff" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content-->
        <div class="modal-content new-modalcustm">
            <form name="edit_team_member_form" id="edit_team_member_form" method="post" action="{{url('api/edit_staff')}}" enctype="multipart/form-data">
                <input type="hidden" name="staff_id" id="edit_staff_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Update Team Member</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_fullname_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_staff_fullname" type="text" class="form-control" name="staff_fullname" placeholder="Full Name" >
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_username_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_staff_username" type="text" class="form-control" name="staff_username" placeholder="Username" disabled="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_email_error"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="edit_staff_email" type="text" class="form-control" name="staff_email" placeholder="Email Address" disabled="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_mobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_mobile" type="text" class="form-control" name="staff_mobile" placeholder="Mobile" style="width: 92%;">               
                            </div>
                            <a style="position: absolute; right:15px; top:8px; font-size: 18px" role="button" data-toggle="collapse" data-target="#edit_other_phone" id="edit_more_phone"><i class="fa fa-plus"></i></a>
                        </div>
                        </div>
                    </div>
                    <div class="row collapse" id="edit_other_phone" >
                        <div class="col-md-12">
                        <div class="form-group" id="edit_home_phone_error">
                            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_home_phone" type="text" class="form-control" name="staff_home_phone" placeholder="Home Phone">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_work_phone_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_staff_work_phone" type="text" class="form-control" name="staff_work_phone" placeholder="Work Phone">
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_category_error">
                                <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                <div class="form-group nomarging color-b" >
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="staff_category" id="edit_staff_category" >
                                    <option value="">Select Category </option>
                                    <?php
                                    if(!empty($category_list))
                                    foreach ($category_list as $key => $value)
                                    {
                                        echo "<option value='".$value->category_id."'>".$value->cat."</option>";
                                    }
                                    ?>
                                    </select>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group textarea-md" id="edit_expertise_error"> <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                                <textarea style="width: 100%" name="staff_expertise" id="edit_staff_expertise" placeholder="Expertise (i.e. Insomnia, Sleep disorder, Hyperactivity,...)"></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group textarea-md" id="edit_description_error"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                <textarea style="width: 100%" name="staff_description" id="edit_staff_description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="borderbtn">
                            <span class="custom-select-icon"><i class="fa fa-image"></i></span>
                            <label class="margleft30">Add picture</label> 
                            <div class="add-gly">
                                <div class="add-picture"><img id="edit_staff_image" src="#" alt="" width="60px" height="60px" /></div>
                                <!--<div class="add-picture-text">UPLOAD PICTURE</div>-->
                                <input type="file" name="staff_profile_picture" id="edit_staff_profile_picture" style="margin: 30px 0; padding: 0 4px;" accept="image/*">
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary butt-next" type="submit" style="margin: 0px auto 0; width: 150px; display: block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('custom_js')
<script type="text/javascript">
$('.editStaff').click(function(e){
      var staff_id = $(this).attr('data-staff-id');
      //alert(staff_id);
      var data = addCommonParams([]);
      //alert(serviceid);
      data.push({name:'staff_id', value:staff_id});
      $.ajax({
          url: baseUrl2+"/api/staff-details", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              //console.log(response);
              $('.animationload').hide();
              if(response.result=='1')
              {
                  if(response.staff_details.staff_profile_picture!=''){
                      var profile_picture = response.staff_details.staff_profile_picture;
                  } else {
                      profile_picture = "<?php echo asset('public/assets/website/images/business-hours/blue-user.png');?>";
                  }
                  $('#modalTitle').text('Update '+response.staff_details.full_name);
                  $('#edit_staff_fullname').val(response.staff_details.full_name);
                  $('#edit_staff_username').val(response.staff_details.username);
                  $('#edit_staff_email').val(response.staff_details.email);
                  $('#edit_staff_mobile').val(response.staff_details.mobile);
                  $('#edit_staff_home_phone').val(response.staff_details.home_phone);
                  $('#edit_staff_work_phone').val(response.staff_details.work_phone);
                  $("#edit_staff_category").val(response.staff_details.category_id).trigger('change');
                  $('#edit_staff_expertise').val(response.staff_details.expertise);
                  $('#edit_staff_description').val(response.staff_details.description);
                  $('#edit_staff_image').attr('src',profile_picture);
                  $('#edit_staff_id').val(response.staff_details.staff_id);
                  $('#myModaleditstaff').modal('show');
              }
              else
              {
                  swal("Error", response.message , "error");
              }
          },
          beforeSend: function()
          {
              $('.animationload').show();
          }
      });
      
  });

 $('#edit_team_member_form').validate({
      rules: {
          edit_staff_fullname: {
              required: true
          },
          edit_staff_username: {
              required: true
          },
          edit_staff_email: {
              required: true,
              email: true
          },
          edit_staff_mobile: {
              required: true,
              number: true,
              minlength: 10,
              maxlength: 10
          },
          edit_staff_description: {
              required: true
          }
      },
      messages: {
          edit_staff_fullname: {
              required: 'Please enter fullname'
          },
          edit_staff_username: {
              required: 'Please enter username'
          },
          edit_staff_email: {
              required: 'Please enter email',
              email: 'Please enter proper email'
          },
          edit_staff_mobile: {
              required: 'Please enter mobile no',
              number: 'Please enter proper mobile no',
              minlength: 'Please enter minimum 10 digit mobile no',
              maxlength: 'Please enter maximum 10 digit mobile no'
          },
          edit_staff_description: {
              required: 'Please enter description'
          }
      },
      errorPlacement: function(error, element) {
          if (element.attr("name") == "staff_fullname") {
              error.insertAfter($('#edit_fullname_error'));
          } else if (element.attr("name") == "staff_username") {
              error.insertAfter($('#edit_username_error'));
          } else if (element.attr("name") == "staff_email") {
              error.insertAfter($('#edit_email_error'));
          } else if (element.attr("name") == "staff_mobile") {
              error.insertAfter($('#edit_mobile_error'));
          } else if (element.attr("name") == "staff_description") {
              error.insertAfter($('#edit_description_error'));
          }
      },
      submitHandler: function(form) {
          var data = $(form).serializeArray();
          data = addCommonParams(data);
          var files = $("#edit_team_member_form input[type='file']")[0].files;
          var form_data = new FormData();
          if (files.length > 0) {
              for (var i = 0; i < files.length; i++) {
                  form_data.append('staff_profile_picture', files[i]);
              }
          } 
          // append all data in form data 
          $.each(data, function(ia, l) {
              form_data.append(l.name, l.value);
          });
          $.ajax({
              url: form.action,
              type: form.method,
              data: form_data,
              dataType: "json",
              processData: false, // tell jQuery not to process the data 
              contentType: false, // tell jQuery not to set contentType 
              success: function(response) {
                  console.log(response); //Success//
                  if (response.response_status == 1) {
                      $(form)[0].reset();
                      $('#myModaleditstaff').modal('hide');
                      swal("Success", response.message, "success");
                      location.reload();
                      
                  } else {
                      swal('Sorry!', response.response_message, 'error');
                  }
              },
              beforeSend: function() {
                  $('.animationload').show();
              },
              complete: function() {
                  $('.animationload').hide();
              }
          });
      }
});
</script>
@endsection