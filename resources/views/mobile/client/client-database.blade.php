@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Client Database</div>
         <!--<div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
               </div>
            </div>
         </div>-->
      </div>
        <div class="leftpan">
            <div class="left-menu">
                <div id="custom-search-input">
                    
                    <a href="javascript:void(0);" id="import_client_icon" class="imp-st" data-toggle="tooltip" title="Import Client"><i class="fa fa-download"></i> </a> 
                    <form name="client_import_form" id="client_import_form" action="{{url('api/client_import')}}" method="post">
                    <input type="file" name="client_import_excel" id="client_import_excel" style="display:none;" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    </form>
                    <a href="{{url('client-export')}}" class="exp-st"  data-toggle="tooltip" title="Export Client"><i class="fa fa-external-link "></i> </a>
               

                    <div class="input-group col-md-12">
                        <input type="text" name="client_search_text" id="client_search_text" class="search-staff form-control" placeholder="Search Client" <?php if(!empty($client_search_text)) { ?> value="<?php echo $client_search_text;?>" <?php } ?> />
                        <span class="input-group-btn">
                        <button class="btn btn-danger" id="client_search_btn" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                        </span>
                    </div>
                </div>
                <div class="stf-list heightfull">
                <?php
                    //echo '<pre>'; print_r($client_list);
                    if(!empty($client_list)){
                        foreach($client_list as $client){
                ?>
                    <a href="javascript:void(0);" class="stafflistitem" data-json='<?php echo str_replace("'",'',json_encode($client));?>'>
                        <?php if($client->client_profile_picture != ''){ ?>
                            <img class="user-pic" src="<?php echo $client->client_profile_picture;?>" width="35px" height="35px" /> 
                        <?php } else { ?>
                            <img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}" /> 
                        <?php } ?>
                    
                        <div>
                            <h3><?php echo ucwords($client->client_name);?></h3>
                            <small><?php echo $client->client_email;?></small>
                        </div>
                    </a>
                <?php 
                    } } else { 
                ?>
                    <a>No client created yet</a>
                <?php 
                    }   
                ?>
                </div>
            </div>
        </div>

        <div class="rightpan">
            <div class="row">
                <div class="col-lg-12">
                    <form>
                        <?php 
                        if(!empty($client_list)){
                        ?>
                        <div class="headRow  custm-linkedt custm-l" id="clientdatabase" style="width:230px!important">
                            <ul>
                                <li><a id="editClient"><i class="fa fa-edit"></i> Edit </a> </li>
                                <li><a id="invite" data-client-id=""><i class="fa fa-paper-plane"></i> Invite </a> </li>
                                <li id="verifySection"><a id="verify" data-client-id=""><i class="fa fa-lock"></i> Verify </a> </li>
                            </ul>
                        </div>
                        <div class="headRow cdHeadbar">
                            <div class="namebar">
                                <!--<label>ST</label>-->
                                <img id="clientImg" src="" class="img-circle" alt="" width="70" height="70">
                            </div>
                            
                            <h3><b id="clientName"></b><br/>
                                <span id="clientEmail"></span> 
                            </h3>
                        </div>
                        <div class="staff-detail">
                            <ul class="nav nav-tabs" >
                                <li><a data-toggle="tab" href="#tab1" id="detailsTab" class="active">Info </a></li>
                                <li><a data-toggle="tab" href="#tab2" id="appointments">Appointments </a></li>
                                <li><a data-toggle="tab" href="#tab3">Give as a gift </a></li>
                                <li><a data-toggle="tab" href="#tab4">Payments</a></li>
                                <li><a data-toggle="tab" href="#tab5">Feedback</a></li>
                                <li><a data-toggle="tab" href="#tab6">Journey</a></li>
                                <li><a data-toggle="tab" href="#tab7">Notes</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="padding15px clearfix tab-pane fade in active" id="tab1">
                                    <div class="infoBar">
                                        <div>
                                            <h2>Customer Notes</h2>
                                            <label id="clientNote">Notes help you keep track of your customers</label>
                                        </div>
                                    </div>
                                    <div class="infoBar">
                                        <div>
                                            <h2>Mobile</h2>
                                            <label id="clientMobile">0788852211</label>
                                        </div>
                                    </div>
                                    <div class="infoBar">
                                        <div>
                                            <h2>Registration</h2>
                                            <label id="clientRegDate">22 May 2018, 05:06 PM</label>
                                            <span >Created by Admin</span> 
                                        </div>
                                        <div>
                                            <h2>Last Appointment</h2>
                                            <label>22 May 2018, 05:06 PM</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane fade">
                                    <div class="headRow showDekstop clearfix">
                                        <div class="col-md-12">
                                        <div class="custm-linkedt1" >
                                            <ul >
                                                <li><a class="dropdown-item" data-toggle="modal" data-target="#myModaladdappoinment" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Appointment</a></li>
                                            </ul>
                                        </div>
                                        <table id="example" class="table table-striped app" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th >Create Date</th>
                                                    <th >Date</th>
                                                    <th >Service</th>
                                                    <th>Staff</th>
                                                    <th align="center" style="text-align: center;">Amount</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody id="get-appointment-data">
                                                <!-- <tr>
                                                    <td>Sep 12, 2018  07:00am </td>
                                                    <td>SHowner</td>
                                                    <td>Johan</td>
                                                    <td  style="text-align: center;">$200.00</td>
                                                    <td  style="text-align: center;">
                                                    <div class="dropdown ">
                                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">CHECK IN <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">As Scheduled</a></li>
                                                            <li><a href="#">Arrived Late</a></li>
                                                            <li><a href="#">No show</a></li>
                                                            <li><a href="#">Gift Certificates</a></li>
                                                            <li><a href="#">New Status</a></li>
                                                        </ul>
                                                    </div>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                        <!-- <div class="discount-innertabbx break20px">
                                            <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                                No Discount Coupons
                                            </p>
                                        </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3" class="tab-pane fade">
                                    <div class="col-md-12">
                                        <div class="custm-linkedt1" >
                                        <ul >
                                            <li><a class="dropdown-item" data-toggle="modal" data-target="#myGiftModal" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Gift Certificate</a></li>
                                        </ul>
                                        </div>
                                        <div class="discount-box">
                                        <h2>Gift As a Gift</h2>
                                        <div class="alert alert-warning mt-20">
                                            Gift certificates can be purchased online on the customer booking interface only after a payment gateway has been added. If you do not have a payment gateway added, you can only sell gift certificates from the admin interface. Gift certificates can be redeemed online at the time of booking, or in person at the time of availing the service.
                                        </div>
                                        <p>Let customers gift your services to their family & friends. Create one Gift Certificate for every event. It can be a Birthday, Anniversary, Thanksgiving, New year, Mother's day or Father's day.</p>
                                        </div>
                                        <div class="gc-btnbx">
                                        <h3>Design your first gift certificate</h3>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myGiftModal">SELL GIFT CERTIFICATE</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab4" class="tab-pane fade">
                                    <div class="headRow showDekstop clearfix">
                                        <div class="col-md-12">
                                        <div class="custm-linkedt1" >
                                            <ul >
                                                <li><a class="dropdown-item" data-toggle="modal" data-target="#myModaladdappoinment" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add Payment</a></li>
                                            </ul>
                                        </div>
                                        <table id="example" class="table table-striped app" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th >Date</th>
                                                    <th >Type</th>
                                                    <th align="center" style="text-align: center;">Amount</th>
                                                    <th>Tip</th>
                                                    <th>Mode</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sep 12, 2018  07:00am </td>
                                                    <td>Membership</td>
                                                    <td  style="text-align: center;">$200.00</td>
                                                    <td>&nbsp;</td>
                                                    <td>Debit Card</td>
                                                    <td  style="text-align: center;">
                                                    <a href="#"><i class=" fa fa-trash-o"></i></a> &nbsp; &nbsp; &nbsp;
                                                    <a href="#"><i class="fa fa-print"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="discount-innertabbx break20px">
                                            <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                                Customer has no payments
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab5" class="tab-pane fade">
                                    <div class="discount-innertabbx break20px">
                                        <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                        Customer has no reviews
                                        </p>
                                    </div>
                                </div>
                                <div id="tab6" class="tab-pane fade">
                                    <div class="journey">
                                        <div class="v-line"></div>
                                        <span>September 2018</span>
                                        <p>No activity this month</p>
                                        <div class="v-line"></div>
                                        <span>August 2018</span>
                                        <p>No activity this month</p>
                                        <div class="v-line"></div>
                                    </div>
                                </div>
                                <div id="tab7" class="tab-pane fade">
                                    <div class="discount-innertabbx break20px">
                                        <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                        Customer has no notes
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>

<div class="modal fade" id="myModaleditclient" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content-->
        <div class="modal-content new-modalcustm">
            <form name="edit_client_form" id="edit_client_form" method="post" action="{{url('api/edit_client')}}" enctype="multipart/form-data">
                <input type="hidden" name="client_id" id="edit_client_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Update Client</h4>
                </div>
                <div class="modal-body clr-modalbdy">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_client_name_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="edit_client_name" type="text" class="form-control" name="client_name" placeholder="Client Name" >
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_client_email_error"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="edit_client_email" type="text" class="form-control" name="client_email" placeholder="Email Address" disabled="">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_client_mobile_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_client_mobile" type="text" class="form-control" name="client_mobile" placeholder="Mobile" style="width: 92%;">               
                            </div>
                            <a style="position: absolute; right:15px; top:8px; font-size: 18px" role="button" data-toggle="collapse" data-target="#edit_other_phone" id="edit_more_phone"><i class="fa fa-plus"></i></a>
                        </div>
                        </div>
                    </div>
                    <div class="row collapse" id="edit_other_phone" >
                        <div class="col-md-12">
                        <div class="form-group" id="edit_client_home_phone_error">
                            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_client_home_phone" type="text" class="form-control" name="client_home_phone" placeholder="Home Phone">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="edit_client_work_phone_error"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input id="edit_client_work_phone" type="text" class="form-control" name="client_work_phone" placeholder="Work Phone">
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
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client_category" id="edit_client_category" >
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
                            <div class="input-group" id="edit_client_address_error"> <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input id="edit_client_address" type="text" class="form-control" name="client_address" placeholder="Address">
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon"><i class="fa fa-clock-o "></i></span>
                                <!--<select class="form-control">
                                    <option>Category Name</option>
                                    </select>-->
                                <div class="form-group nomarging color-b" id="edit_client_timezone">
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="client_timezone" id="edit_client_timezone" >
                                    <option value="">Select Timezone </option>
                                    <?php
                                    foreach($timezone as $tzone)
                                    {
                                    ?>
                                    <option value="<?=$tzone['zone'] ?>">
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
                            <div class="input-group textarea-md" id="edit_client_note_error"> <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                <textarea style="width: 100%" name="client_note" id="edit_client_note" placeholder="Client Note"></textarea>
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

<div class="modal fade" id="modalInviteClient" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <div class="modal-header" style="padding: 20px 21px 0px 21px !important;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body clr-modalbdy">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <h4>An invitation email will be sent to this client with an option to generate a new password. Would you like to send now?</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="col-md-12 text-center">
               <input id="send_client_email" type="button" value="Send" class="btn btn-primary" style="margin: 0px auto 0; width: 150px; display: block">
            </div>
         </div>
     </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modalVerifyClient" role="dialog">
   <div class="modal-dialog add-pop">
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
         <div class="modal-header" style="padding: 20px 21px 0px 21px !important;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body clr-modalbdy">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <h4>Make this account verified</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="col-md-12 text-center">
               <input id="cancel_verify" type="button" value="No" class="btn btn-danger" >
               <input id="approve_verify" type="button" value="Yes" class="btn btn-primary" >
            </div>
         </div>
     </form>
      </div>
   </div>
</div>
<input type="hidden" name="global_client_id" id="global_client_id" value="">

@endsection


@section('custom_js')
<script>
var client_id = 0;
$('.stafflistitem').click(function(){
    $('.stafflistitem').removeClass('active');
    $(this).addClass('active');
    var data = $(this).data('json');
    $('#detailsTab').trigger('click');

    client_id = data.client_id;
    $("#global_client_id").val(client_id);
    $('#clientNote').html("");
    if(data.client_note !== undefined){
        $('#clientNote').html(data.client_note);
    }
    $('#clientMobile').html("");
    if(data.client_mobile !== undefined){
        $('#clientMobile').html(data.client_mobile);
    }
    $('#clientRegDate').html("");
    if(data.created_on !== undefined){
        $('#clientRegDate').html(data.created_on);
    }
    $('#clientEmail').html("");
    if(data.client_email !== undefined){
        $('#clientEmail').html(data.client_email);
    }
    $('#clientName').html("");
    if(data.client_name !== undefined){
        $('#clientName').html(data.client_name);
    }

    $('#clientImg').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");
    if(data.client_profile_picture !== undefined){
        if(data.client_profile_picture == ""){
            $('#clientImg').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");
        }else{
            $('#clientImg').attr('src',data.client_profile_picture);
        }
    }

    $('#verifySection').html("");
    if(data.is_email_verified == 0){
        $('#verifySection').html('<a id="verify" data-client-id=""><i class="fa fa-lock"></i> Verify </a>');
    } else {
        $('#verifySection').html('<a class="btn btn-xs btn-success"><i class="fa fa-ok"></i> Verified </a>');
    }

    if(data.client_id !== undefined){
        $('#invite').attr("data-client-id",data.client_id);
        $('#verify').attr("data-client-id",data.client_id);
    }
});

$(document).ready(function(){
    $('.stafflistitem').eq(0).trigger('click');

    $("#client_search_btn").click(function(){
        var url = "<?php echo url('client-database')?>";
        var client_search_text = $("#client_search_text").val();
        if(client_search_text!=""){
            window.location.replace(url+'/'+client_search_text);
        } else {
            window.location.replace(url);
        }
    });

});

// Import Client Section //
$(document).on('click', '#import_client_icon', function(){
    $('#client_import_excel').trigger('click');
});

$(document).on('change','#client_import_excel',function(e){
    e.preventDefault();
    data = addCommonParams([]);
    var files = $("#client_import_form input[type='file']")[0].files;
    var form_data = new FormData();
    if(files.length>0){
        for(var i=0;i<files.length;i++){
            form_data.append('client_excel_file',files[i]);
        }
    }
    // append all data in form data 
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    $.ajax({
        url: baseUrl+"/api/client_import", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"},
                function(){ 
                    location.reload();
                });
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


$(document).on('click','#invite',function(e){
    e.preventDefault();
    $('#modalInviteClient').modal('show');

});

$(document).on('click','#send_client_email',function(e){
    e.preventDefault();
    //alert(client_id);
    var data = addCommonParams([]);
    data.push({name:'client_id', value:client_id});

    if(client_id > 0){
        $.ajax({
        url: baseUrl+"/api/send_reset_password_email", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            //console.log(response);
            $('#modalVerifyClient').modal('hide');
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
    } else {
        swal("Error", "Invalid client details", "error");
    }
    
});

$(document).on('click','#verify',function(e){
    $('#modalVerifyClient').modal('show');
});

$(document).on('click','#cancel_verify',function(e){
    $('#modalVerifyClient').modal('hide');
});

$(document).on('click','#approve_verify',function(e){
    e.preventDefault();
    //alert(client_id);
    var data = addCommonParams([]);
    data.push({name:'client_id', value:client_id});

    if(client_id > 0){
        $.ajax({
        url: baseUrl+"/api/verify_client", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            //console.log(response);
            $('#modalVerifyClient').modal('hide');
            $('.animationload').hide();
            if(response.result=='1')
            {
                swal({title: "Success", text: response.message, type: "success"});
                $('#verifySection').html('<a class="btn btn-xs btn-success"><i class="fa fa-ok"></i> Verified </a>');
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
    } else {
        swal("Error", "Invalid client details", "error");
    }
    
});


$('#editClient').click(function(e){
    var data = addCommonParams([]);
    //alert(serviceid);
    data.push({name:'client_id', value:client_id});
    $.ajax({
        url: baseUrl+"/api/client_details", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            //console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                /*if(response.client_details.client_profile_picture!=''){
                    var profile_picture = response.client_details.client_profile_picture;
                } else {
                    profile_picture = "<?php echo asset('public/assets/website/images/business-hours/blue-user.png');?>";
                }*/
                $('#modalTitle').text('Update '+response.client_details.client_name);
                $('#edit_client_name').val(response.client_details.client_name);
                $('#edit_client_email').val(response.client_details.client_email);
                $('#edit_client_mobile').val(response.client_details.client_mobile);
                $('#edit_client_home_phone').val(response.client_details.client_home_phone);
                $('#edit_client_work_phone').val(response.client_details.client_work_phone);
                $("#edit_client_category").val(response.client_details.client_category).trigger('change');
                $("#edit_client_timezone").val(response.client_details.client_timezone).trigger('change');
                $('#edit_client_address').val(response.client_details.client_address);
                $('#edit_client_note').val(response.client_details.client_note);
                //$('#edit_staff_image').attr('src',profile_picture);
                $('#edit_client_id').val(response.client_details.client_id);
                $('#myModaleditclient').modal('show');
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

$('#edit_client_form').validate({
        rules: {
            edit_client_name: {
                required: true
            },
            edit_client_email: {
                required: true,
                email: true
            },
            edit_client_mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            edit_client_address: {
                required: true
            }
        },
        messages: {
            edit_client_name: {
                required: 'Please enter client name'
            },
            edit_client_email: {
                required: 'Please enter email',
                email: 'Please enter proper email'
            },
            edit_client_mobile: {
                required: 'Please enter mobile no',
                number: 'Please enter proper mobile no',
                minlength: 'Please enter minimum 10 digit mobile no',
                maxlength: 'Please enter maximum 10 digit mobile no'
            },
            edit_client_address: {
                required: 'Please enter address'
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "client_name") {
                error.insertAfter($('#edit_client_name_error'));
            } else if (element.attr("name") == "client_email") {
                error.insertAfter($('#edit_client_email_error'));
            } else if (element.attr("name") == "staff_client_mobile") {
                error.insertAfter($('#edit_client_mobile_error'));
            } else if (element.attr("name") == "client_address") {
                error.insertAfter($('#edit_client_address_error'));
            }
        },
        submitHandler: function(form) {
            var data = $(form).serializeArray();
            data = addCommonParams(data);
            /*var files = $("#edit_client_form input[type='file']")[0].files;
            var form_data = new FormData();
            if (files.length > 0) {
                for (var i = 0; i < files.length; i++) {
                    form_data.append('client_profile_picture', files[i]);
                }
            } 
            // append all data in form data 
            $.each(data, function(ia, l) {
                form_data.append(l.name, l.value);
            });*/
            $.ajax({
                url: form.action,
                type: form.method,
                data: data,
                //data: form_data,
                dataType: "json",
                //processData: false, // tell jQuery not to process the data 
                //contentType: false, // tell jQuery not to set contentType 
                success: function(response) {
                    //alert(response.response_status);
                    console.log(response); //Success//
                    if (response.response_status == '1') {
                        $(form)[0].reset();
                        $('#myModaleditclient').modal('hide');
                        swal({title: "Success", text: response.response_message, type: "success"},
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

$('#appointments').click(function(e){
    var client_id = $("#global_client_id").val();
    var data = addCommonParams([]);
    data.push({name:'client_id', value:client_id});
    $.ajax({
        url: baseUrl+"/api/client_appointment_list", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                $("#get-appointment-data").html(response.message);
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
$(document).on('click','.change-status',function(e){
//$('.change-status').click(function(e){
    var appointment_id = $(this).data('id');
    var appointment_status = $(this).data('status');
    var data = addCommonParams([]);
    data.push({name:'appointment_id', value:appointment_id},{name:'appointment_status', value:appointment_status});
    $.ajax({
        url: baseUrl+"/api/client_appointment_status", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            //console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                $('#change-status-'+appointment_id).text(appointment_status);
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



</script>
@endsection