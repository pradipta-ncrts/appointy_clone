@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
 <h1>Client Details</h1>
 <ul>
    <li>&nbsp;</li>
    <!-- <li><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></li>
    <li><img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></li> -->
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
          <div class="whitebox cdHeading">
             <div class="share-cusbtn" style="margin: -5px 0 0 3px;">
                <button onclick="myFunction()" class="cusbtn-style"><i class="fa fa-share" aria-hidden="true"></i></button>
             </div>
             <div id="openbox">
                <ul>
                   <li><a id="invite" data-client-id="<?=$client_details->client_id;?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Invite</a></li>
                   <li><a href="{{url('mobile/edit-client')}}/<?=$client_details->client_id;?>" data-client-id=""><i class="fa fa-pencil" aria-hidden="true"></i> Edit </a></li>
                </ul>
             </div>
             <h4 class="text-center"> <?=$client_details->client_name;?></h4>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}"/>
             <label><?=$client_details->client_mobile;?></label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/birthday.png')}}"/>
             <label><?=$client_details->client_dob=='0000-00-00' ? 'NIL' : date('M d, Y', strtotime($client_details->client_details));?></label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}"/>
             <label><?=$client_details->client_address ? $client_details->client_address : 'NIL';?></label>
          </div>
          <div class="whitebox cdDetails"> <img src="{{asset('public/assets/mobile/images/customer-details/mail.png')}}"/>
             <label><?=$client_details->client_email;?></label>
          </div>
          <div class="whitebox cdDetails clearfix">
             <img src="{{asset('public/assets/mobile/images/customer-details/notes.png')}}"/>
             <p><?=$client_details->client_note ? $client_details->client_note : 'NIL';?> <!-- <a>more</a> -->
             </p>
             <?php
             $created_on = $client_details->created_on;
             ?>
             <p> <?=date("h:i A", strtotime($created_on));?>   <?=date("M d, Y", strtotime($created_on));?></p>
             <label class="pull-right"><a href="{{url('mobile/client-booking-list/all')}}/<?=$client_details->client_id;?>"> Bookings</a> </label>
          </div>
          <div class="clearfix"></div>
          <div class="break20px"></div>
          <h5 class="text-center">Transactions</h5>
          <div class="break10px"></div>
          <div class="cdList">
             <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                   <div class="border-box">
                      <ul>
                         <li>
                            <label><?=$total_appo->count;?></label>
                            Booked 
                         </li>
                         <li>
                            <label>$<?=$amount->remaining_balance;?></label>
                            Amount Due
                         </li>
                         <li>
                            <label>$<?=$amount->paid_amount;?></label>
                            Paid
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
</main>
@endsection


@section('custom_js')
<script type="text/javascript">
$(document).on('click','#invite',function(e){
    e.preventDefault();
    var client_id = $(this).data('client-id');
    //alert(client_id);
    var data = addCommonParams([]);
    data.push({name:'client_id', value:client_id});

    swal({
      title: 'Are you sure?',
      text: "An invitation email will be sent to this client with an option to generate a new password. Would you like to send now?",
      confirmButtonColor: '#3085d6',
      //cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm',
      allowOutsideClick: false
    }).then(function() {
          $.ajax({
            url: baseUrl2+"/api/send_reset_password_email", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: "json",
            success: function(response) // A function to be called if request succeeds
            {
                //console.log(response);
                $('.animationload').hide();
                if(response.result=='1')
                {
                    swal({title: "Success", text: response.message, type: "success"});
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
});


</script>


@endsection