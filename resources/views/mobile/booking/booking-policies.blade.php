@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
 <div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking Options</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul>
                  </div>
                  <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('booking-options') }}" > Clients Booking Flow</a></li>
               <li><a href="{{ url('booking-rules') }}"> Booking Rules</a> </li>
               <li><a href="{{ url('booking-policies') }}" class="active"> Booking Policies</a></li>
              <!--  <li><a href="{{ url('notification-settings') }}"> Notification Settings</a></li>
               <li><a href="{{ url('email-customisation') }}"> Email Customisation</a> </li> -->
             </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Cancellation Policy</h2>
                     <p>
                        Use the area to specify your Cancellation policy. Your cutomers will be able to view this policy before they book an appointment. 
                        This policy can alos be sent to customers as a part of appointment related emails.
                     </p>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse">
                  <form class="form-horizontal" id="booking_policy_form" name="booking_policy_form" action="{{url('api/save_booking_policy')}}" method="post">
                    <input type="hidden" name="type" value="1">
                     <div class="padleft30">
                        <textarea name="content" maxlength="2000" style="width: 100%;" id="content" onkeyup="countChar(this)" <?php if(empty($cancellation_policy) || $cancellation_policy== '') { ?> onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" <?php } ?> ><?php if(!empty($cancellation_policy) || $cancellation_policy!= '') echo $cancellation_policy; else echo 'Write your policy content here... '; ?></textarea>
                        <div class="col-md-9">
                           <!--Tips: Please use the following tags to insert your business information.<br>
                           {yourphone} &RightArrow; insert your business phone number <br>
                           {mail}  &RightArrow;  insherst your business email ID<br>
                           {Cancellation Hour}  &RightArrow;  insert th minimum notice required for cancelling an appointment -->
                        </div>
                        <div class="col-md-3 text-right"><small id="cancelNum">2000 characters remaining</small></div>
                        <button class="btn btn-primary pull-left" type="submit">Save</button>
                     </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Additional Information</h2>
                     <p>
                        Use the area to specify any additional information or policy. This can be sent to the customers as a part of Appointment related emails.
                     </p>
                  </div>
                  <div id="collapse2" class="panel-collapse collapse">
                     
                     <form class="form-horizontal" id="booking_policy_form1" name="booking_policy_form1" action="{{url('api/save_booking_policy')}}" method="post">
                        <input type="hidden" name="type" value="2">
                        <div class="padleft30">
                            <textarea name="content" maxlength="2000" style="width: 100%;" id="content1" onkeyup="countChar1(this)" <?php if(empty($additional_information) || $additional_information== '') { ?> onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" <?php } ?> ><?php if(!empty($additional_information) || $additional_information!= '') echo $additional_information; else echo 'Write your policy content here... '; ?></textarea>
                            <div class="col-md-9">
                              <!--Tips: Please use the following tags to insert your business information.<br>
                              {yourphone} &RightArrow; insert your business phone number <br>
                              {mail}  &RightArrow;  insherst your business email ID<br>
                              {Cancellation Hour}  &RightArrow;  insert th minimum notice required for cancelling an appointment -->
                            </div>
                            <div class="col-md-3 text-right"><small id="cancelNum1">2000 characters remaining</small></div>
                            <button class="btn btn-primary pull-left" type="submit">Save</button>
                        </div>
                      </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid body-sec">
            <div class="row ">
               <div class="col-md-12 booking-opt">
                  <div onclick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;">
                     <i class="fa fa-custom fa-angle-down" style="font-size: 30px; float: right;"></i>    
                     <h2>Terms & Conditions</h2>
                     <p>
                        Use the area in order to specify term & conditions specific to your business. Your user will need to agree to these terms before book their first appointment.
                        Everytime you update / change these terms, your customers will need to give their consent again before booking any further appointments.
                     </p>
                  </div>
                  <div id="collapse3" class="panel-collapse collapse">
                      <form class="form-horizontal" id="booking_policy_form2" name="booking_policy_form2" action="{{url('api/save_booking_policy')}}" method="post">
                        <input type="hidden" name="type" value="3">
                        <div class="padleft30">
                            <textarea name="content" maxlength="2000" style="width: 100%;" id="content2" onkeyup="countChar2(this)" <?php if(empty($terms_conditions) || $terms_conditions == '') { ?> onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" <?php } ?> ><?php if(!empty($terms_conditions) || $terms_conditions!= '') echo $terms_conditions; else echo 'Write your policy content here... '; ?></textarea>
                            <div class="col-md-9">
                              <!--Tips: Please use the following tags to insert your business information.<br>
                              {yourphone} &RightArrow; insert your business phone number <br>
                              {mail}  &RightArrow;  insherst your business email ID<br>
                              {Cancellation Hour}  &RightArrow;  insert th minimum notice required for cancelling an appointment -->
                            </div>
                            <div class="col-md-3 text-right"><small id="cancelNum2">2000 characters remaining</small></div>
                            <button class="btn btn-primary pull-left" type="submit">Save</button>
                        </div>
                      </form>
                  </div>
               </div>
            </div>
         </div>
         <!--  <button class="btn btn-primary search-btn" type="submit">Save</button>-->
      </div>
   </div>
</div>
@endsection

@section('custom_js')
<script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 2000) {
          val.value = val.value.substring(0, 2000);
        } else {
          $('#cancelNum').text((2000 - len)+' characters remaining');
        }
      };

      function countChar1(val) {
        var len = val.value.length;
        if (len >= 2000) {
          val.value = val.value.substring(0, 2000);
        } else {
          $('#cancelNum1').text((2000 - len)+' characters remaining');
        }
      };

      function countChar2(val) {
        var len = val.value.length;
        if (len >= 2000) {
          val.value = val.value.substring(0, 2000);
        } else {
          $('#cancelNum2').text((2000 - len)+' characters remaining');
        }
      };


      /*$('#booking_policy_form').validate({
          submitHandler: function(form) {
            var data = $(form).serializeArray();
            //data.push({name: 'device_type', value: 1});
            data = addCommonParams(data);
            $.ajax({
                url: form.action,
                type: form.method,
                data:data ,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.result==1){
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
      });*/

      $(document).ready(function() {
        $("form").submit(function() {
          // Getting the form ID
          var  formID = $(this).attr('id');
          var formDetails = $('#'+formID);
          var data = formDetails.serializeArray();
          data = addCommonParams(data);
          var action_url = formDetails.attr("action");
          $.ajax({
            type: "POST",
            url: action_url,
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response);
                if(response.result==1){
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
          return false;
        });
      });
</script>
@endsection