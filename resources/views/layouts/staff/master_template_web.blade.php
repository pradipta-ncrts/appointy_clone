<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>@yield('title')</title>
      <!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">-->
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/my-icons-collection/font/flaticon.css')}}">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/app.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/slide-menu.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
      <script type="text/javascript">
          var baseUrl = "<?php echo url('') ?>";
      </script> 
   </head>
   @yield('custom_css')
   <body class="dashboard-bg">
      <?php 
      $basicdatas = App\Http\Controllers\BaseApiController::category_list(); 
      $user_new_category = App\Http\Controllers\BaseApiController::user_new_category(); 
      
      /*echo "<pre>";
      print_r($stuffs_list); die();*/
      ?> 
      <div class="animationload" style="display: none;">
         <div class="osahanloading"></div>
      </div>
     
     <header class="showDekstop clearfix">
        <div class="container-custm">
           <div class="leftpan">
              <div class="logo">
                 <a href="{{ url('staff-dashboard') }}">
                 <img src="{{asset('public/assets/website/images/logo-light-text.png')}}" /></a>
              </div>
           </div>
           <div class="rightpan">
              <div class="top-nav">
                
                 <div class="dropdown prof-menu" href="#">
                    <a href="#" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                    <?php
                    if(!empty($staff_data) && $staff_data->staff_profile_picture)
                    {
                    ?>
                      <img class="user-pic" src="<?=$staff_data->staff_profile_picture;?>">
                    <?php
                    }
                    else
                    {
                    ?>
                      <img class="user-pic" src="http://localhost/squder/public/assets/website/images/profilePic.png">
                    <?php
                    }
                    ?>
                    </a> 
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalsharelinks"> <a class="dropdown-item" href="{{ url('staff-dashboard') }}"> <i class="fa fa-calendar" aria-hidden="true"></i> Calendar Connections</a> <a class="dropdown-item" href="javascript:void(0);" id="editStaff" data-staff-id="<?=$staff_data->staff_id;?>"> <i class="fa fa-cog" aria-hidden="true"></i> Profile settings</a> <a class="dropdown-item" href="javascript:void(0);" id="change-password" data-staff-id="<?=$staff_data->staff_id;?>"> <i class="fa fa-user" aria-hidden="true"></i> Change Password</a> <!-- <a class="dropdown-item" href="http://localhost/squder/staff-details"> <i class="fa fa-user" aria-hidden="true"></i> Users</a> <a class="dropdown-item" href="http://localhost/squder/help"> <i class="fa fa-question-circle " aria-hidden="true"></i> Help</a> --> <a class="dropdown-item" href="{{ url('logout') }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> </div>
                 </div>
                 <div class="main-nav">
                   
                    <a href="{{ url('staff-booking-list') }}/all"><i class="flaticon-calendar"></i><span> <span>Booking List</span></span></a>
                    <a href="{{ url('staff-dashboard') }}"><i class="flaticon-calendar"></i><span> <span>Calendar</span></span></a> 
                 </div>
              </div>
           </div>
        </div>
     </header>
     <div id="content"> @yield('content') </div>
      
      <div id="c-mask" class="c-mask"></div>
      <!-- /c-mask -->
      <!--Modal -->
      <div class="modal fade" id="myModaleditstaff" role="dialog">
        <div class="modal-dialog add-pop">
            <!-- Modal content-->
            <div class="modal-content new-modalcustm">
                <form name="edit_team_member_form" id="edit_team_member_form" method="post" action="{{url('api/edit_staff_login_data')}}" enctype="multipart/form-data">
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
                                         foreach ($basicdatas['category_list'] as $key => $value)
                                         {
                                            echo "<option value='".$value->category_id."'>".$value->category."</option>";
                                         }
                                         foreach ($user_new_category['user_new_category'] as $key => $value1)
                                         {
                                            echo "<option value='".$value1->category_id."'>".$value1->cat."</option>";
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

      <div class="modal fade" id="myModalChnagePassword" role="dialog">
        <div class="modal-dialog add-pop">
            <!-- Modal content-->
            <div class="modal-content new-modalcustm">
               <form name="change_passord" method="post" action="{{ url('api/staff_changepssword') }}" id="change_passord">
                    <input type="hidden" name="staff_id" id="staff_id" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="old_passsword" type="text" class="form-control" name="old_passsword" placeholder="Old Password">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="new_password" type="text" class="form-control" name="new_password" placeholder="New Password">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body clr-modalbdy">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="new_confirm_password" type="text" class="form-control" name="new_confirm_password" placeholder="Confirm Password" value="">
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

      <!-- <script src="js/bootstrap.min.js"></script> -->
      <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script>
      <script src="{{asset('public/assets/website/js/script.js')}}"></script>
      <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
      <script src="{{asset('public/assets/website/js/jquery-ui.js')}}"></script>
      <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>
      <!-- Sweetalert -->
      <script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script>
      <script src="{{asset('public/assets/website/js/ncrts.js')}}"></script>
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
    <!--staff update-->
    <script type="text/javascript">
      $('#editStaff').click(function(event){
      event.preventDefault();
      var staff_id = $(this).attr('data-staff-id');
      //alert(staff_id); 
      var data = [];
      //alert(serviceid);
      data.push({name:'staff_id', value:staff_id});
      $.ajax({
          url: baseUrl+"/api/staff-details-login", 
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

  //Update staff data

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
            //data = addCommonParams(data);
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
                        swal({title: "Success", text: response.message, type: "success"},
                        function(){ 
                            location.reload();
                        });
                        
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

    $('#change-password').click(function(event){
    event.preventDefault();
    var staff_id = $(this).attr('data-staff-id');
    $("#staff_id").val(staff_id);
    $("#myModalChnagePassword").modal('show');
    });


    //================Submit AJAX request ==================
    $('#change_passord').validate({
          //ignore: ":hidden:not(.selectpicker)",
          rules: {
              old_passsword: {
                  required: true
              },
              new_password: {
                  required: true
              },
              new_password: {
                  required: true,
             minlength: 8,
             pwcheck: true
                  //passwordCk: true
              },
              new_confirm_password: {
                  required: true,
                  equalTo : "#new_password"
              }
          },
          
          messages: {
              old_passsword: {
                  required: 'Please enter old password'
              },
              new_password: {
                  required: 'Please enter new password'
              },
              new_password: {
                  required: 'Please enter password',
             minlength: 'Please enter minimum 8 character password',
             pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
              },
             
              new_confirm_password: {
                  required: 'Please enter new confirm password'
              }
          },

          submitHandler: function(form) {
            var data = $(form).serializeArray();
            //data = addCommonParams(data);
            $.ajax({
                url: form.action,
                type: form.method,
                data:data ,
                dataType: "json",
                success: function(response) {
                  //console.log(response);
                  if(response.result=='1')
                  {
                      swal("Success", response.message , "success");
                      $('#change_passord')[0].reset();
                      $("#change-password").modal('hide');
                      //console.log(response);
                  }
                  else
                  {
                      swal("Error", response.message , "error");
                  }
                },
                beforeSend: function(){
                    $('.animationload').show();
                },
                complete: function(){
                    $('.animationload').hide();
                }
            });
          }
      });
    //================Submit AJAX request ==================
    
    </script>
    <!-- slide menu script -->
      @yield('custom_js')
   </body>
</html>