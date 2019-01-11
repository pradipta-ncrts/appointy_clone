@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Add Appointment</h1>
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
            <form name="add_appointmentm_form" id="add_appointmentm_form" method="post" action="{{ url('api/add_appoinment') }}" enctype="multipart/form-data">
              <div class="whitebox mobile-control">
                 <div class="input-group">
                    <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-client.png')}}"/> </span>
                    <select class="form-control" name="client" id="client">
                       <option value="">Select Client</option>
                       <?php
                       foreach ($clients_list['client_list'] as $key => $cli)
                       {
                       ?>
                       <option value="<?=$cli->client_id;?>"><?=$cli->client_name;?></option>
                       <?php
                       }
                       ?>
                    </select>
                 </div>
                 <div class="input-group">
                    <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-services.png')}}"/> </span>
                    <select class="form-control" name="appoinment_service" id="appoinment_service_mobile">
                       <option value="">Select Service</option>
                        <?php
                        foreach ($services_list['service_list'] as $key => $serv)
                        {
                        ?>
                        <option value="<?=$serv->service_id;?>"><?=$serv->service_name;?></option>
                        <?php
                        }
                        ?>
                    </select>
                 </div>
                 <div class="input-group">
                    <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-staff.png')}}"/> </span>
                    <select class="form-control" name="staff" id="staff">
                       <option value="">Select Staff</option>
                        <?php
                        foreach ($stuffs_list['stuff_list'] as $key => $stf)
                        {
                        ?>
                        <option value="<?=$stf->staff_id;?>"><?=$stf->full_name;?></option>
                        <?php
                        }
                        ?>
                    </select>
                 </div>
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}"/> </span>
                    <input id="appointmentdate" type="text" class="form-control" name="date" placeholder="Date">
                 </div>
                 <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-time.png')}}"/> </span>
                    <input id="appointmenttime" type="text" class="form-control" name="appointmenttime" placeholder="Time">
                 </div>
                 <textarea class="form-control notes" rows="6" placeholder="Notes" name="appoinment_note" id="appoinment_note"></textarea>
                 <ul class="colors" style="display: none;" id="colour-code-main-row-mobile">
                    <li id="set_service_colour_mobile" class="activeColor active"></li>
                 </ul>
                <input type="hidden" name="colour_code" value="" id="colour_code_mobile">    
                  <div class="input-group">
                    <div class="checkbox-cutm">
                       <input name="apoinment_mail" type="checkbox" value="true"> Confirmation Email
                    </div>
                 </div>
                 <input type="Submit" name="Submit" id="submit" value="submit" class="btn btn-mobile btn-block btn-size break20px"> 
              </div>
            </form>
         </div>
      </div>
   </div>
</main>

@endsection


@section('custom_js')
<script type="text/javascript">
//Set appointment colour
$("#appoinment_service_mobile").on('change', (function(e) {
    e.preventDefault();
    var service_id = $(this).val();
    if(service_id)
    {
        var data = addCommonParams([]);
        data.push({name:'service_id', value:service_id});
        console.log(data);
        $.ajax({
            url: baseUrl2+"/api/get-service-colour-code", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
            dataType: "json",
            success: function(response) // A function to be called if request succeeds
            {
                console.log(response);
                //alert(response.response_status);
                if(response.response_status=='1')
                {
                    //alert(response.response_message.colors)
                    $("#set_service_colour_mobile").css('background-color', response.response_message.colors);
                    $("#colour_code_mobile").val(response.response_message.colors);
                    $("#colour-code-main-row-mobile").show();
                }
                else
                {
                    swal("Error", "Somthing wrong service colour not found." , "error");
                }
            },
            beforeSend: function()
            {
                $('.animationload').show();
            },
            complete: function()
            {
                $('.animationload').hide();
            }
        });
    }
    else
    {
        $("#colour-code-main-row-mobile").hide();
    }
}));
</script>
@endsection