@extends('../layouts/client/master_template_client')

@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
    <div class="container-custm">
      <div class="upper-cmnsection">
        <div class="heading-uprlft" style="padding-bottom:8px">Staff Details</div>
      </div>
      <div class="leftpan">
          <div class="left-menu">
              <div id="custom-search-input">   
                  <div class="input-group col-md-12">
                   
                    <input type="text" class="search-staff form-control" placeholder="Search Staff" />
                    <span class="input-group-btn">
                    <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                    </span>
                   
                  </div>
                   
                </div>
                
              <div class="stf-list heightfull">
    
                <a href="#" class="active">
                  <img src="http://runmobileapps.com/squeedr/public/assets/website/images/business-hours/blue-user.png" /> 
                  <div><h3>Douglas N</h3>
                  <small>30min</small></div>
                  </a>
    
                  <a href="#" >
                    <img src="http://runmobileapps.com/squeedr/public/assets/website/images/business-hours/blue-user.png" /> 
                    <div><h3>Douglas N</h3>
                    <small>30min</small></div>
                    </a>
    
                    <a href="#" >
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/business-hours/blue-user.png" /> 
                        <div><h3>Douglas N</h3>
                        <small>30min</small></div>
                        </a>
    
                </div>
                
            </div>
      </div>
       <div class="rightpan"> 
        <div class="relativePostion">
    <div class=" showDekstop clearfix">
      <div class="col-md-12">
        <div class="custm-linkedt">
          <ul>
             <li><a href="#" data-toggle="tooltip" title="Add Staff"><button type="button" class="btn btn-primary">Book Now</button></a></li>
          </ul>
        </div>
        <div class="staff-detailuser"> <img src="http://runmobileapps.com/squeedr/uploads/profile_image/154064492711501225258060-Rain--Rainbow-Women-Dresses-9391501225257859-1_mini.jpg" class="img-circle" alt="" width="55" height="55">
        <div class="img-boxrgt">
          <h4><strong>Jason</strong></h4> 
          <p><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Margo, India</strong> - 5:46 pm local time</p>
          <p>lamie74@gmail.com</p>
          </div>
        </div>
        
        <!-- Nav tabs -->
        
        <div class="staff-detail">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Details</a></li>
            <li><a data-toggle="tab" href="#tab2">Availability</a></li>
          </ul>
          <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
              <div class="staff-detailtab-bx">
                <ul>
                 <li>
                    <div class="row">
                      <div class="col-sm-10">
                        <h4>Booking URL</h4>
                        <p>https://booking.appointy.com/</p>
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-default pull-right"> <i class="fa fa-files-o" aria-hidden="true"></i> COPY </button>
                      </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>Available in (Postal Codes)</h4>
                        <p>700101, E715</p>
                      </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>Mobile No</h4>
                        <p>9831209888</p>
                      </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>Expertise</h4>
                        <p></p>
                      </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>Category</h4>
                        <p>Meeting</p>
                      </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                      <div class="col-sm-10">
                        <h4>Staff Description</h4>
                        <p>No Description</p>
                      </div>
                    </div>
                  </li>
                  
                  <li>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>Payment Accepted</h4>
                        <div class="paypal-iconbx">
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/paypal.png" alt="" height="50"/>
                        <img src="http://runmobileapps.com/squeedr/public/assets/website/images/stripe-logo.png" alt="" height="50"/>
                        </div>
                      </div>
                    </div>
                  </li>

                </ul>
              </div>
            </div>
            
            <div id="tab2" class="tab-pane fade">
              <div class="tab-content" style="padding:0;">
                                    <div id="regulariner1" class="tab-pane fade active in">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                            <div class="dropdown custm-uperdrop">
                                                <button class="btn dropdown-toggle staff-drptxt" type="button" data-toggle="dropdown" aria-expanded="false">Current Schedule (23 May 2018 - 01 Jan 2070)</button>    
                                            </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="tableBH-table" style="margin-top:10px;">
                                            <table class="table table-bordered table-custom1 table-bh tableBhMobile">
                                                <thead>
                                                    <tr>
                                                        <th>SERVICES</th>
                                                        <th>Monday</th>
                                                        <th>Tuesday</th>
                                                        <th>Wednesday</th>
                                                        <th>Thursday</th>
                                                        <th>Friday</th>
                                                        <th>Saturday</th>
                                                        <th>Sunday</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="staff-availability-section"><tr>
                        <td>
                            <div class="custm-tblebx"> <img src="http://runmobileapps.com/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">PSYCHIATRIC</a> (60m) </div>
                            
                            <div class="clearfix"></div>
                        </td><td data-column="Monday">
                                        <ul>
                                        <li>9:00 PM</li>
                                        <li>12:00 PM</li>
                                        </ul>
                                        
                                        <div class="clearfix"></div>
                                    </td><td data-column="Tuesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Wednesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Thursday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Friday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Saturday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Sunday">
                                            
                                            <div class="clearfix"></div>
                                        </td></tr><tr>
                        <td>
                            <div class="custm-tblebx"> <img src="http://runmobileapps.com/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">PRODUCT RELEASE</a> (60m) </div>
                            
                            <div class="clearfix"></div>
                        </td><td data-column="Monday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Tuesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Wednesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Thursday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Friday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Saturday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Sunday">
                                            
                                            <div class="clearfix"></div>
                                        </td></tr><tr>
                        <td>
                            <div class="custm-tblebx"> <img src="http://runmobileapps.com/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">SURGEON</a> (120m) </div>
                            
                            <div class="clearfix"></div>
                        </td><td data-column="Monday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Tuesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Wednesday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Thursday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Friday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Saturday">
                                            
                                            <div class="clearfix"></div>
                                        </td><td data-column="Sunday">
                                            
                                            <div class="clearfix"></div>
                                        </td></tr></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        <div class="custm-tab team-memtab">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tabmenu1">Active</a></li>
      <li><a data-toggle="tab" href="#tabmenu2">Inactive</a></li>
    </ul>
    <div class="tab-content">
      <div id="tabmenu1" class="tab-pane fade in active">
        <div class="mobileStaff showMobile" >
          <div class="whitebox">
            <h2>Dr. Concepcion M.</h2>
            <span>Psychiatrist</span>
            <ul>
              <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
              <li><i class="fa fa-phone"></i>802-438-0497</li>
            </ul>
            <ol>
              <li>Addiction, Alcoholism</li>
              <li>Sleep Medicine</li>
              <li><a>More </a></li>
            </ol>
          </div>
          <div class="whitebox">
            <h2>Dr. Concepcion M.</h2>
            <span>Psychiatrist</span>
            <ul>
              <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
              <li><i class="fa fa-phone"></i>802-438-0497</li>
            </ul>
            <ol>
              <li>Addiction, Alcoholism</li>
              <li>Sleep Medicine</li>
              <li><a>More </a></li>
            </ol>
          </div>
        </div>
      </div>
      <div id="tabmenu2" class="tab-pane fade">
        <p>Some content in tab menu 2.</p>
      </div>
    </div>
  </div>
      </div>
 </div>
@endsection


@section('custom_js')

<script>

$('.stafflistitem').click(function(){

    

    $('.stafflistitem').removeClass('active');

    $(this).addClass('active');

    var data = $(this).data('json');

    $('#detailsTab').trigger('click');



    $("#deleteStaff").attr('data-staff-id',data.staff_id);

    $("#editStaff").attr('data-staff-id',data.staff_id);



    $('#staffDesc').html("");

    if(data.description !== undefined){

        $('#staffDesc').html(data.description);

    }

    

    $('#loginAllowedMsg').html("");

    if(data.full_name !== undefined){

        $('#loginAllowedMsg').html("Restrict "+data.full_name+" to login next time. Allow "+data.full_name+" to view/manage/block dates and times for their schedule only. Staff can also search customers but cannot export the customer list");

    }

    $('#bookingUrl').html("");

    if(data.booking_url !== undefined){

        $('#bookingUrl').html(data.booking_url);

    }

    $('#staffNameDisp').html("");

    if(data.full_name !== undefined){

        $('#staffNameDisp').html(data.full_name);

    }

    $('#staffEmailDisp').html("");

    if(data.email !== undefined){

        $('#staffEmailDisp').html(data.email);

    }

    $('#staffEmail').html("");

    if(data.email !== undefined){

        var temp = data.email+"&nbsp;";

        if(data.is_email_verified == 0){

            temp += '<span class="label label-danger"><i>Not Verified</i></span>';

        }else{

            temp += '<span class="label label-success"><i>Verified</i></span>';

        }

        $('#staffEmail').html(temp);

    }



    $('#isBlocked').removeClass('active');

    if(data.is_blocked !== undefined){

        $('#isBlocked').attr('data-block-status',data.is_blocked);

        $('#isBlocked').attr('data-staff-id',data.staff_id);

        if(data.is_blocked == 1){

            $('#isBlocked').removeClass('active');

        }else{

            $('#isBlocked').addClass('active');

        }

    }



    $('#isInternalStaff').removeClass('active');

    if(data.is_internal_staff !== undefined){

        $('#isInternalStaff').attr('data-internal-staff',data.is_internal_staff);

        $('#isInternalStaff').attr('data-staff-id',data.staff_id);

        if(data.is_internal_staff == 0){

            $('#isInternalStaff').removeClass('active');

        }else{

            $('#isInternalStaff').addClass('active');

        }

    }



    $('#isLoginAllowed').removeClass('active');

    if(data.is_login_allowed !== undefined){

        $('#isLoginAllowed').attr('data-login-allowed',data.is_login_allowed);

        $('#isLoginAllowed').attr('data-staff-id',data.staff_id);

        if(data.is_login_allowed == 0){

            $('#isLoginAllowed').removeClass('active');

        }else{

            $('#isLoginAllowed').addClass('active');

        }

    }



    $('#staffImgDisp').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");

    if(data.staff_profile_picture !== undefined){

        if(data.staff_profile_picture == ""){

            $('#staffImgDisp').attr('src',"{{asset('public/assets/website/images/business-hours/blue-user.png')}}");

        }else{

            $('#staffImgDisp').attr('src',data.staff_profile_picture);

        }

    }

});



    

$(document).on('click','#isBlocked',function(){

    var staff_id = '';

    var blocked_status = '';

    var staff_id = $(this).attr('data-staff-id');

    var blocked_status = $(this).attr('data-block-status');

    //alert(staff_id); return false;

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:blocked_status},{name:'type', value:'blocked'});

    $.ajax({

        url: baseUrl+"/api/change-status-staff", 

        type: "POST", 

        data: data, 

        dataType: "json",

        success: function(response) 

        {

            //console.log(response);

            $('.animationload').hide();

            if(response.result=='1')

            {

                swal({title: "Success", text: response.message, type: "success"});

                if (blocked_status == '0') {

                    $('#isBlocked').attr('data-block-status','1');

                    $('#isBlocked').removeClass('active');

                } else {

                    $('#isBlocked').attr('data-block-status','0');

                    $('#isBlocked').addClass('active');

                }

            }

            else

            {

                swal("Error", response.message , "error");

            }

        },

        beforeSend: function()

        {

            $('.animationload').show();

        },

        complete: function()

        {

            //$('.animationload').hide();

        }

    });



});



$(document).on('click','#isInternalStaff',function(){

    var staff_id = '';

    var internal_staff = '';

    var staff_id = $(this).attr('data-staff-id');

    var internal_staff = $(this).attr('data-internal-staff');

    //alert(staff_id); return false;

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:internal_staff},{name:'type', value:'internal_staff'});

    $.ajax({

        url: baseUrl+"/api/change-status-staff", 

        type: "POST", 

        data: data, 

        dataType: "json",

        success: function(response) 

        {

            //console.log(response);

            $('.animationload').hide();

            if(response.result=='1')

            {

                swal({title: "Success", text: response.message, type: "success"});

                if (internal_staff == '0') {

                    $('#isInternalStaff').attr('data-internal-staff','1');

                    $('#isInternalStaff').addClass('active');

                } else {

                    $('#isInternalStaff').attr('data-internal-staff','0');

                    $('#isInternalStaff').removeClass('active');

                }

            }

            else

            {

                swal("Error", response.message , "error");

            }

        },

        beforeSend: function()

        {

            $('.animationload').show();

        },

        complete: function()

        {

            //$('.animationload').hide();

        }

    });



});



$(document).on('click','#isLoginAllowed',function(){

    var staff_id = '';

    var login_allowed = '';

    var staff_id = $(this).attr('data-staff-id');

    var login_allowed = $(this).attr('data-login-allowed');

    //alert(login_allowed); return false;

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id},{name:'status_value', value:login_allowed},{name:'type', value:'login_allowed'});

    $.ajax({

        url: baseUrl+"/api/change-status-staff", 

        type: "POST", 

        data: data, 

        dataType: "json",

        success: function(response) 

        {

            //console.log(response);

            $('.animationload').hide();

            if(response.result=='1')

            {

                swal({title: "Success", text: response.message, type: "success"});

                if (login_allowed == '0') {

                    $('#isLoginAllowed').attr('data-login-allowed','1');

                    $('#isLoginAllowed').addClass('active');

                } else {

                    $('#isLoginAllowed').attr('data-login-allowed','0');

                    $('#isLoginAllowed').removeClass('active');

                }

            }

            else

            {

                swal("Error", response.message , "error");

            }

        },

        beforeSend: function()

        {

            $('.animationload').show();

        },

        complete: function()

        {

            //$('.animationload').hide();

        }

    });



});





$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip(); 



    $('#example').DataTable( {

        "paging":   false,

        //"info":     false

    } );



    $("#staff_search_btn").click(function(){

        var url = "<?php echo url('staff-details')?>";

        var staff_search_text = $("#staff_search_text").val();

        if(staff_search_text!=""){

            window.location.replace(url+'/'+staff_search_text);

        } else {

            window.location.replace(url);

        }

    });



    $('.stafflistitem').eq(0).trigger('click');



    $('#deleteStaff').click(function(e){

        e.preventDefault();

        var staff_id = $(this).attr('data-staff-id');

        swal({

        title: "Are you sure?",

        text: "Once deleted, you will never access this staff!",

        type: "warning",

        showCancelButton: true,

        confirmButtonColor: '#DD6B55',

        confirmButtonText: 'Yes, I am sure!',

        cancelButtonText: "No, not now!",

        closeOnConfirm: false,

        closeOnCancel: true

        },function(isConfirm){



            if (isConfirm){

                var data = addCommonParams([]);

                //alert(serviceid);

                data.push({name:'staff_id', value:staff_id});

                $.ajax({

                    url: baseUrl+"/api/delete-staff", 

                    type: "POST", 

                    data: data, 

                    dataType: "json",

                    success: function(response) 

                    {

                        //console.log(response);

                        $('.animationload').hide();

                        if(response.result=='1')

                        {

                            swal({title: "Success", text: response.message, type: "success"},

                            function(){ 

                                location.reload();

                            }

                        );

                        }

                        else

                        {

                            swal("Error", response.message , "error");

                        }

                    },

                    beforeSend: function()

                    {

                        $('.animationload').show();

                    },

                    complete: function()

                    {

                        //$('.animationload').hide();

                    }

                });

            }

        });

        

    });



    $('#editStaff').click(function(e){

        var staff_id = $(this).attr('data-staff-id');

        var data = addCommonParams([]);

        //alert(serviceid);

        data.push({name:'staff_id', value:staff_id});

        $.ajax({

            url: baseUrl+"/api/staff-details", 

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



    /*function readURLstaff(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('#edit_staff_image').show();

                $('#edit_staff_image').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        } else {

            $('#edit_staff_image').hide();

        }

    }



    $("#edit_staff_profile_picture").change(function() {

        readURLstaff(this);

    });*/



    $('#block_time').click(function(){

        var staff_id = $('#editStaff').attr('data-staff-id');

        var data = addCommonParams([]);

        data.push({name:'staff_id', value:staff_id});

        $.ajax({

            url: "<?php echo url('api/block-times')?>",

            type: "post",

            data: data,

            dataType: "json",

            success: function(response) {

                console.log(response); //Success//

                if (response.response_status == 1) {

                    

                    var date_html = "";

                    if(response.block_dates.length > 0){

                        for(i = 0;i<response.block_dates.length;i++){

                            

                            date_html += '<div class="tabnewrow">';

                            date_html += '<div class="row">';

                            date_html += '<div class="col-md-4"> '+response.block_dates[i].month+' '+response.block_dates[i].year+'</div>';

                            date_html += '<div class="col-md-8">';

                            date_html += '<div class="tabnewdt">';

                            date_html += '<ul>';

                            for(j = 0;j<response.block_dates[i].block_dates.length;j++){

                                date_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_dates[i].block_dates[j]+'<i class="fa fa-trash delete_block_time" data-block-time-id="'+response.block_dates[i].block_id+'" aria-hidden="true" title="Delete!"></i></a></li>';

                            }

                            date_html += '</ul>';

                            date_html += '</div>';

                            date_html += '</div>';

                            date_html += '</div>';

                            date_html += '</div>';

                        }

                    } else {

                        date_html += '<div class="tabnewrow">';

                        date_html += '<div class="row">';

                        date_html += 'No records found';

                        date_html += '</div>';

                        date_html += '</div>';

                    }





                    var time_html = "";

                    if(response.block_times.length > 0){

                        for(i = 0;i<response.block_times.length;i++){

                            

                            time_html += '<div class="tabnewrow">';

                            time_html += '<div class="row">';

                            time_html += '<div class="col-md-4">'+response.block_times[i].block_date+'</div>';

                            time_html += '<div class="col-md-8">';

                            time_html += '<div class="tabnewdt">';

                            time_html += '<ul>';

                            for(j = 0;j<response.block_times[i].block_date_time.length;j++){

                                time_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_times[i].block_date_time[j].start_time+' - '+response.block_times[i].block_date_time[j].end_time+'<i class="fa fa-trash delete_block_time" aria-hidden="true" data-block-time-id="'+response.block_times[i].block_date_time[j].block_id+'" title="Delete!"></i></a></li>';

                            }

                            time_html += '</ul>';

                            time_html += '</div>';

                            time_html += '</div>';

                            time_html += '</div>';

                            time_html += '</div>';

                        }

                    } else {

                        time_html += '<div class="tabnewrow">';

                        time_html += '<div class="row">';

                        time_html += 'No records found';

                        time_html += '</div>';

                        time_html += '</div>';

                    }

					

                    $('#blockedDates').html(date_html);

                    $('#blockedTimes').html(time_html);

                    

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

    });



    $('#availabilityTab').click(function(){

        var staff_id = $('#editStaff').attr('data-staff-id');

        $('#staff-availability-section').html("");

        var data = addCommonParams([]);

        data.push({name:'staff_id', value:staff_id});

        $.ajax({

            url: "<?php echo url('api/staff_service_availability')?>",

            type: "post",

            data: data,

            dataType: "json",

            success: function(response) {

                console.log(response); //Success//

                /*if (response.response_status == 1) {

                    

                    var date_html = "";

                    if(response.block_dates.length > 0){

                        for(i = 0;i<response.block_dates.length;i++){

                            

                            date_html += '<div class="tabnewrow">';

                            date_html += '<div class="row">';

                            date_html += '<div class="col-md-4"> '+response.block_dates[i].month+' '+response.block_dates[i].year+'</div>';

                            date_html += '<div class="col-md-8">';

                            date_html += '<div class="tabnewdt">';

                            date_html += '<ul>';

                            for(j = 0;j<response.block_dates[i].block_dates.length;j++){

                                date_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_dates[i].block_dates[j]+'<i class="fa fa-trash delete_block_time" data-block-time-id="'+response.block_dates[i].block_id+'" aria-hidden="true" title="Delete!"></i></a></li>';

                            }

                            date_html += '</ul>';

                            date_html += '</div>';

                            date_html += '</div>';

                            date_html += '</div>';

                            date_html += '</div>';

                        }

                    } else {

                        date_html += '<div class="tabnewrow">';

                        date_html += '<div class="row">';

                        date_html += 'No records found';

                        date_html += '</div>';

                        date_html += '</div>';

                    }





                    var time_html = "";

                    if(response.block_times.length > 0){

                        for(i = 0;i<response.block_times.length;i++){

                            

                            time_html += '<div class="tabnewrow">';

                            time_html += '<div class="row">';

                            time_html += '<div class="col-md-4">'+response.block_times[i].block_date+'</div>';

                            time_html += '<div class="col-md-8">';

                            time_html += '<div class="tabnewdt">';

                            time_html += '<ul>';

                            for(j = 0;j<response.block_times[i].block_date_time.length;j++){

                                time_html += '<li><a data-toggle="tooltip" data-placement="top" >'+response.block_times[i].block_date_time[j].start_time+' - '+response.block_times[i].block_date_time[j].end_time+'<i class="fa fa-trash delete_block_time" aria-hidden="true" data-block-time-id="'+response.block_times[i].block_date_time[j].block_id+'" title="Delete!"></i></a></li>';

                            }

                            time_html += '</ul>';

                            time_html += '</div>';

                            time_html += '</div>';

                            time_html += '</div>';

                            time_html += '</div>';

                        }

                    } else {

                        time_html += '<div class="tabnewrow">';

                        time_html += '<div class="row">';

                        time_html += 'No records found';

                        time_html += '</div>';

                        time_html += '</div>';

                    }

					

                    $('#blockedDates').html(date_html);

                    $('#blockedTimes').html(time_html);

                    

                } else {

                    swal('Sorry!', response.response_message, 'error');

                }*/

                $('#staff-availability-section').html(response.html);

                //$('div.edit-staff').hide();

            },

            beforeSend: function() {

                $('.animationload').show();

            },

            complete: function() {

                $('.animationload').hide();

            }

        });

    });





    $('#add_staff_availability_form').validate({

            submitHandler: function(form) {

            var data = $(form).serializeArray();

            data = addCommonParams(data);

            var staff_id = $('#editStaff').attr('data-staff-id');

            data.push({name:'staff_id', value:staff_id});

            //console.log(data);

            $.ajax({

                url: form.action,

                type: form.method,

                data: data,

                dataType: "json",

                success: function(response) {

                    //console.log(response); //Success//

                    if (response.response_status == 1) {

                        $(form)[0].reset();

                        $('#myModalregular').modal('hide');

                        swal('Success!', response.response_message, 'success');

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

    

});





$(document).on('click', '#import_staff_icon', function(){

    $('#staff_import_excel').trigger('click');

});



$(document).on('change','#staff_import_excel',function(e){

    e.preventDefault();

    data = addCommonParams([]);

    var files = $("#staff_import_form input[type='file']")[0].files;

    var form_data = new FormData();

    if(files.length>0){

        for(var i=0;i<files.length;i++){

            form_data.append('staff_excel_file',files[i]);

        }

    }

    // append all data in form data 

    $.each(data, function( ia, l ){

        form_data.append(l.name, l.value);

    });



    $.ajax({

        url: baseUrl+"/api/staff_import", // Url to which the request is send

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



$(document).on('click','.delete_block_time',function(e){

    e.preventDefault();

    //data = addCommonParams([]);

    var block_time_id = $(this).attr('data-block-time-id');

    var staff_id = $('#editStaff').attr('data-staff-id');

    

    swal({

        title: "Are you sure?",

        text: "Once deleted, you will never access this blocked date/time!",

        type: "warning",

        showCancelButton: true,

        confirmButtonColor: '#DD6B55',

        confirmButtonText: 'Yes, I am sure!',

        cancelButtonText: "No, not now!",

        closeOnConfirm: false,

        closeOnCancel: true

        },function(isConfirm){



            if (isConfirm){

                var data = addCommonParams([]);

                //alert(serviceid);

                data.push({name:'block_time_id', value:block_time_id},

                          {name:'staff_id', value:staff_id});

                $.ajax({

                    url: baseUrl+"/api/delete_staff_block_time", // Url to which the request is send

                    type: "POST", // Type of request to be send, called as method

                    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)

                    dataType: "json",

                    success: function(response) // A function to be called if request succeeds

                    {

                        //console.log(response);

                        $('.animationload').hide();

                        if(response.result=='1')

                        {

                            //swal("Success!", response.message, "success")

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

            }

        });





});



$(document).on('click','.delete_availability',function(e){

    e.preventDefault();

    var service_id = $(this).data('service-id');

    var staff_id = $(this).data('staff-id');

    

    swal({

        title: "Are you sure?",

        text: "Once deleted, you will never access this blocked date/time!",

        type: "warning",

        showCancelButton: true,

        confirmButtonColor: '#DD6B55',

        confirmButtonText: 'Yes, I am sure!',

        cancelButtonText: "No, not now!",

        closeOnConfirm: false,

        closeOnCancel: true

        },function(isConfirm){



            if (isConfirm){

                var data = addCommonParams([]);

                //alert(serviceid);

                data.push({name:'service_id', value:service_id},

                            {name:'staff_id', value:staff_id});

                

                $.ajax({

                    url: baseUrl+"/api/delete_staff_availability", // Url to which the request is send

                    type: "POST", // Type of request to be send, called as method

                    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)

                    dataType: "json",

                    success: function(response) // A function to be called if request succeeds

                    {

                        //console.log(response);

                        $('.animationload').hide();

                        if(response.result=='1')

                        {

                            //swal("Success!", response.message, "success")

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

            }

        });



    



});



$(document).on('click', '.add-area-code', function(){

    var staff_id = $('#editStaff').attr('data-staff-id');

    //alert(staff_id);

    $("#postal_code_staff_id").val(staff_id);

    $('#addAreaCode').modal('show');

});



$.validator.addMethod("phoneUS", function (phone_number, element) {

    phone_number = phone_number.replace(/\s+/g, "");

    return this.optional(element) || phone_number.length > 5 && phone_number.length < 7;

}, "Please enter valid pin no.");



$('#area_code').validate({

    //ignore: ":hidden:not(.selectpicker)",

    //ignore: [],

    rules: {

        'area': {

            required: true

        },

        'pin_no': {

            required: true,

            digits: true,

            phoneUS: true

        },

      },



    messages: {

        'area': {

            required: 'Please enter area name'

        },

        'pin_no': {

            required: 'Please enter pin no'

        },

    },



    submitHandler: function(form) {

      var data = $(form).serializeArray();

      data = addCommonParams(data);

      console.log(data);

      $.ajax({

          url: form.action,

          type: form.method,

          data:data ,

          dataType: "json",

          success: function(response) {

               console.log(response);

               $('.animationload').hide();

               if(response.result=='1')

               {

                  $('#area_code').trigger("reset");

                  $('#addAreaCode').modal('hide');

                  //swal(title: "Success", text: response.message.msg, type: "success");

                var postal_html = "";

                if(response.message.postal_data.length > 0)

                {

                    if(response.message.postal_data[i].status=='1')

                    {

                        var status = "Active";

                    }

                    else

                    {

                        var status = "Inactive";

                    }

                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                    for(i = 0;i<response.message.postal_data.length;i++)

                    {

                        postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';

                    }

                    postal_html +='</tbody>';

                }



                $("#postal_code_html").html(postal_html);

                swal("Success", response.message.msg , "success");

                  

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



$('#postalcodeTab').click(function(){

    var staff_id = $('#editStaff').attr('data-staff-id');

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id});

    $.ajax({

        url: "<?php echo url('api/get_post_code')?>",

        type: "post",

        data: data,

        dataType: "json",

        success: function(response) {

            console.log(response); //Success//

            var postal_html = "";

            if(response.message.postal_data.length > 0)

            {

                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';



                for(i = 0;i<response.message.postal_data.length;i++)

                {

                    if(response.message.postal_data[i].status=='1')

                    {

                        var status = "Active";

                    }

                    else

                    {

                        var status = "Inactive";

                    }

                    

                    postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';

                }

                postal_html +='</tbody>';

            }

            else

            {

                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                postal_html +='<tr><td colspan="4">No record found</td></tr>';

                postal_html +='</tbody>';

            }





            $('#postlcode_customer_interface').removeClass('active');

            if(response.message.postlcode_customer_interface.postlcode_customer_interface == '1')

            {

                $('#postlcode_customer_interface').addClass('active');

            }

            else

            {

                $('#postlcode_customer_interface').removeClass('active');

            }



            $("#postal_code_html").html(postal_html);

        },

        beforeSend: function() {

            $('.animationload').show();

        },

        complete: function() {

            $('.animationload').hide();

        }

    });

});



$('.set-status').click(function(){

    var staff_id = $('#editStaff').attr('data-staff-id');

    var status = $(this).data('status');

    var val = [];

    $(':checkbox:checked').each(function(i){

      val[i] = $(this).val();

    });

    //alert(val);

    //return false;

    if(val!='')

    {

        var data = addCommonParams([]);

        data.push({name:'staff_id', value:staff_id}, {name:'status', value:status}, {name:'ids', value:val});

        console.log(data);

        $.ajax({

            url: "<?php echo url('api/chnage_postal_code_status')?>",

            type: "post",

            data: data,

            dataType: "json",

            success: function(response) {

                console.log(response); //Success//

                var postal_html = "";

                if(response.message.postal_data.length > 0)

                {

                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';



                    for(i = 0;i<response.message.postal_data.length;i++)

                    {

                        if(response.message.postal_data[i].status=='1')

                        {

                            var status = "Active";

                        }

                        else

                        {

                            var status = "Inactive";

                        }

                        postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';

                    }

                    postal_html +='</tbody>';

                }

                else

                {

                    postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                    postal_html +='<tr><td colspan="4">No record found</td></tr>';

                    postal_html +='</tbody>';

                }



                $("#postal_code_html").html(postal_html);

            },

            beforeSend: function() {

                $('.animationload').show();

            },

            complete: function() {

                $('.animationload').hide();

            }

        });

    }

    else

    {

        swal("Error", "Please check any postal code" , "error");

    }

});



$('.show-postal-code').click(function(){

    var staff_id = $('#editStaff').attr('data-staff-id');

    var status = $(this).data('status');

    

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id}, {name:'status', value:status});

    console.log(data);

    $.ajax({

        url: "<?php echo url('api/postal_code_filter')?>",

        type: "post",

        data: data,

        dataType: "json",

        success: function(response) {

            console.log(response); //Success//

            var postal_html = "";

            if(response.message.postal_data.length > 0)

            {

                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';



                for(i = 0;i<response.message.postal_data.length;i++)

                {

                    if(response.message.postal_data[i].status=='1')

                    {

                        var status = "Active";

                    }

                    else

                    {

                        var status = "Inactive";

                    }

                    postal_html +='<tr><td><div class="custm-tblebx"><input name="selected_checkbox" type="checkbox" value="'+response.message.postal_data[i].postal_code_id+'">'+response.message.postal_data[i].postal_code+'</div></td><td>'+response.message.postal_data[i].area+'</td><td>'+response.message.postal_data[i].count+'</td><td>'+status+'</td></tr>';

                }

                postal_html +='</tbody>';

            }

            else

            {

                postal_html +='<table id="example" class="table table-bordered table-custom1 table-bh tableBhMobile"><thead><tr><th>Code</th><th>Area</th><th>Assigned Staffs</th><th>Status</th></tr></thead><tbody>';

                postal_html +='<tr><td colspan="4">No record found</td></tr>';

                postal_html +='</tbody>';

            }



            $("#postal_code_html").html(postal_html);

        },

        beforeSend: function() {

            $('.animationload').show();

        },

        complete: function() {

            $('.animationload').hide();

        }

    });

});



$(document).on('click','#postlcode_customer_interface',function(){

    var staff_id = $('#editStaff').attr('data-staff-id');

    var data = addCommonParams([]);

    data.push({name:'staff_id', value:staff_id});

    $.ajax({

        url: baseUrl+"/api/change_postal_code_customer_interface", 

        type: "POST", 

        data: data, 

        dataType: "json",

        success: function(response) 

        {

            console.log(response);

            $('.animationload').hide();

            if(response.result=='1')

            {

                $('#postlcode_customer_interface').removeClass('active');

                if(response.message.postlcode_customer_interface == '1')

                {

                    $('#postlcode_customer_interface').addClass('active');

                }

                else

                {

                    $('#postlcode_customer_interface').removeClass('active');

                }

                swal({title: "Success", text: response.message.msg, type: "success"});

            }

            else

            {

                swal("Error", response.message , "error");

            }

        },

        beforeSend: function()

        {

            $('.animationload').show();

        },

        complete: function()

        {

            //$('.animationload').hide();

        }

    });



});







</script>



@endsection