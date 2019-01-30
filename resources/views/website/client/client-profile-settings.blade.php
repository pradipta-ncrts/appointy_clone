@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection
@section('content')
<?php
    $timezone = App\Http\Controllers\BaseApiController::time_zone(); 
?>
<div class="body-part">
   <div class="container-custm">
      <div class="leftpan">
         <div class="left-menu">
            <ul>
                <li><a href="javascript:void(0);" class="active"> Profile</a></li>
               <!--<li><a href="{{ url('profile-settings') }}" class="active"> Profile</a></li>
               <li><a href="{{ url('profile-picture') }}"> Picture</a> </li>
               <li><a href="{{ url('profile-login') }}" > Login</a> </li>-->
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
         <div class="container-fluid">
            <div class="row">
               <div class="new-modalcustm">
                  <div class="clr-modalbdy profile-frm" style="padding:0 !important;width: 90%;">
                    <form action="{{ url('api/client-update-profile-settings') }}" method="post" id="update_client_profile_settings_form" name="update_client_profile_settings_form">
                        <input type="hidden" name="parameter" value="{{$param}}">                    
                        <div style="width:55%">
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Name </label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_name" type="text" class="form-control" name="client_name" placeholder="Full Name" value="<?=isset($client_details->client_name) && $client_details->client_name ? $client_details->client_name : '';?>">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Email</label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_email" type="text" class="form-control" name="client_email" placeholder="Email" value="<?=isset($client_details->client_email) && $client_details->client_email ? $client_details->client_email : '';?>" readonly="">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Address </label>
                                   <div class="input-group" style="border:1px solid #ccc;border-radius:5px 0 0 5px;"> <span class="input-group-addon" style="border:0"></span>
                                      <textarea style="width: 100%;border:0;height: 100px;" id="client_address" name="client_address" placeholder="Full Address" ><?=isset($client_details->client_address) && $client_details->client_address ? $client_details->client_address : '';?></textarea>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Mobile </label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_mobile" type="text" class="form-control" name="client_mobile" placeholder="Mobile" value="<?=isset($client_details->client_mobile) && $client_details->client_mobile ? $client_details->client_mobile : '';?>">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Home Phone </label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_home_phone" type="text" class="form-control" name="client_home_phone" placeholder="Home Phone" value="<?=isset($client_details->client_home_phone) && $client_details->client_home_phone ? $client_details->client_home_phone : '';?>">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Work Phone </label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_work_phone" type="text" class="form-control" name="client_work_phone" placeholder="Work Phone" value="<?=isset($client_details->client_work_phone) && $client_details->client_work_phone ? $client_details->client_work_phone : '';?>">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>DOB</label>
                                   <div class="input-group"> <span class="input-group-addon"></span>
                                      <input id="client_dob" type="date" max= "<?php echo date('Y-m-d'); ?>" class="form-control" name="client_dob" placeholder="DOB" value="<?=isset($client_details->client_dob) && $client_details->client_dob != '0000-00-00' ? $client_details->client_dob : '';?>">
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <label>Timezone </label>
                                   <div class="input-group">
                                      <span class="input-group-addon"></span>
                                      <div class="form-group nomarging color-b" >
                                         <select name="client_timezone" id="client_timezone" class="">
                                          <?php
                                          foreach($timezone as $tzone)
                                          {
                                          ?>
                                          <option value="<?=$tzone['zone'] ?>" <?php if($client_details->client_timezone!='' && $tzone['zone'] == $client_details->client_timezone) { ?> selected="" <?php } ?> >
                                            <?=$tzone['diff_from_GMT'] . ' - ' . $tzone['zone'] ?>
                                          </option>
                                          <?php
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
                                   <label>Note </label>
                                   <div class="input-group" style="border:1px solid #ccc;border-radius:5px 0 0 5px;"> <span class="input-group-addon" style="border:0"></span>
                                      <textarea style="width: 100%;border:0;height: 100px;" id="client_note" name="client_note" placeholder="Note" ><?=isset($client_details->client_note) && $client_details->client_note ? $client_details->client_note : '';?></textarea>
                                   </div>
                                </div>
                             </div>
                          </div>

                          <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                   <input type="submit" class="btn btn-primary" name="Save Changes" value="Save Changes">
                                   <input type="reset" class="btn btn-default pull-right" value="Reset" >
                                </div>
                             </div>
                          </div>
                       </div>
                    </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_js')
<script>
$('#update_client_profile_settings_form').validate({
      rules: {
          client_name: {
              required: true
          },
          client_address: {
              required: true
          },
          client_mobile: {
              required: true,
              minlength: 10,
              maxlength: 10
          },
          client_home_phone: {
              number: true
          },
          client_work_phone: {
              number: true
          },
          client_dob: {
              required: true
          }
      },

      messages: {
          client_name: {
              required: 'Please enter your full name'
          },
          client_address: {
              required: 'Please enter your address'
          },
          client_mobile: {
              required: 'Please enter your mobile number',
              minlength: 'Please enter proper mobile number',
              maxlength: 'Please enter proper mobile number',
          },
          client_home_phone: {
              required: 'Please enter valid phone number'
          },
          client_work_phone: {
              required: 'Please enter valid phone number'
          },
          client_dob: {
              required: 'Please enter your date of birth'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        $.ajax({
            url: form.action,
            type: form.method,
            data:data ,
            dataType: "json",
            success: function(response) {
                //console.log(response);
                if(response.result==1)
                {
                  swal('Success!',response.message,'success');
                }
                else{
                    swal('Sorry!',response.message,'error');
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
</script>
@endsection