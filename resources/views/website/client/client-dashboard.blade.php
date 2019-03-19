@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
    <div class="body-part">
        <div class="container-custm">
            <div class="upper-cmnsection">
                <div class="heading-uprlft">Client Info.</div>
                <div class="upr-rgtsec">
                    <div class="col-sm-5">
                    <!-- <div id="custom-search-input">
                        <div class="input-group ">
                            <input type="text" class="  search-query form-control" placeholder="Search" />
                            <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </div> -->
                    </div>
                    <div class="col-md-7">
                    <div class="full-rgt">
                        <a class="btn btn-primary butt-next1" id="next">Next</a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="rightpan full">
                <div class="container">
                    <div class="booking-steps" style="display:none;">
                    <hr>
                    <div class="step">
                        <a href="" class="active">1</a>
                        <span class="active">Client Info.</span>
                    </div>
                    <div class="step">
                        <a href="" >2</a>
                        <span >Verification</span>
                    </div>
                    <div class="step">
                        <a href="">3</a>
                        <span>Date & Time</span>
                    </div>
                    <div class="step">
                        <a href="">4</a>
                        <span>Confirmation</span>
                    </div>
                    </div>
                </div>
                <div class="container-fluid cust-box pad5per">
                    <div class="row ">
                        <!--<table class="radio-booking">
                            <tr>
                                <td>
                                    <label class="radio">Are you an existing user?  
                                    <input type="radio"  name="radio">
                                    <span class="radiomark"></span>
                                    </label>
                                </td>
                                <td>or</td>
                                <td>
                                    <label class="radio">Are you a new user
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="radiomark"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>-->
                        <!--<div class="col-md-12 booking-form1">
                            <form class="form-horizontal" action="/action_page.php">
                                <div class="form-group">
                                    <img src="{{asset('public/assets/website/images/icon-title.png')}}">
                                    <input type="text" class="form-control" id="email" placeholder="Title">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>-->
                        <input type="hidden" name="client_id" id="client_id" value="{{$client_details->client_id}}">
                        <div class="col-md-6 booking-form1">
                            <div class="form-group">
                                <img src="{{asset('public/assets/website/images/icon-user.png')}}">
                                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Full Name" value="{{$client_details->client_name}}">
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('public/assets/website/images/icon-phone.png')}}">
                                <input type="text" class="form-control" id="client_mobile" name="client_mobile" placeholder="Mobile" value="{{$client_details->client_mobile}}">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 booking-form1">
                            <div class="form-group">
                                <img src="{{asset('public/assets/website/images/icon-email.png')}}">
                                <input type="email" class="form-control" id="client_email" name="client_email" placeholder="Email" value="{{$client_details->client_email}}" readonly="">
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('public/assets/website/images/icon-dob.png')}}">
                                <input type="text" class="form-control" id="client_dob" name="client_dob" placeholder="DOB (optional)" value="{{$client_details->client_dob}}">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-12 booking-form1">
                            <div class="form-group">
                                <img src="{{asset('public/assets/website/images/icon-title.png')}}">
                                <input type="text" class="form-control" id="client_address" name="client_address" placeholder="Address" value="{{$client_details->client_address}}">
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <label class="check"><input name="accept_cgu" id="accept_cgu" value="1" type="checkbox"> &nbsp;&nbsp; Accept Squeedr CGU
                                <span class="checkmark"></span></label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <p class="msg">A code will be sent to you on that email address to validate your account</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
    
    
@section('custom_js')
<script>
    $(document).ready(function () {
        $("#client_dob").datepicker({
                dateFormat: 'mm-dd-yy',
                changeYear: true,
                changeMonth: true,
                maxDate: 0,
        });

        $('#next2').click(function(){
            $('#next1').hide();
            $('#next2').show();
            $('#next3').hide();
            $('#step1').removeClass("active");
            $('#step2').addClass("active");
            $('#titlestep1').removeClass("active");
            $('#titlestep2').addClass("active");
            $('#sectionTitle').text('Client Info.');
            $('#section1').hide();
            $('#section2').show();
            $('#section3').hide();
            $('#section4').hide();
        });

        $('#next').click(function(){
            if($("#accept_cgu").prop('checked') == true){
                var data = [];
                var client_id = $('#client_id').val();
                var client_email = $('#client_email').val();
                data.push({name:'client_id',value:client_id},{name:'client_email',value:client_email});
                //console.log(data);
                $.ajax({
                    url: "<?php echo url('api/send_client_verification_code');?>",
                    type: "POST",
                    data:data ,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if(response.result==1)
                        {
                            var url = '<?php echo url('/client/verification');?>'+'/'+response.parameter;
                            window.location.href = url;
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

                
            } else {
                swal('Warning!','Please accept Squeedr CGU','error');
            }
            
        });

        $('#validate_verification_code').click(function(e){
            e.preventDefault();
            var verification_code = $('#verification_code').val();
            //alert(verification_code);
            if(verification_code!=""){
                var data = [];
                var client_id = $('#client_id').val();
                data.push({name:'client_id',value:client_id},{name:'verification_code',value:verification_code});
                console.log(data);
                $.ajax({
                    url: "<?php echo url('api/appointment_verification');?>",
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if(response.result==1)
                        {
                            $('#verification_section').hide();
                            $('#verification_success_section').show();
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
            } else {
                swal('Error!','Please enter verification code','error');
            }
        })

        $('#next3').click(function(){
            var data = [];
            var client_id = $('#client_id').val();
            var verification_code = $('#verification_code').val();
            data.push({name:'client_id',value:client_id},{name:'verification_code',value:verification_code});
            //console.log(data);
            $.ajax({
                url: "<?php echo url('api/appointment_verification');?>",
                type: "POST",
                data:data ,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.result==1)
                    {
                        $('#next1').hide();
                        $('#next2').hide();
                        $('#next3').hide();
                        $('#step3').removeClass("active");
                        $('#step4').addClass("active");
                        $('#titlestep3').removeClass("active");
                        $('#titlestep4').addClass("active");
                        $('#sectionTitle').text('Confirmation');
                        $('#section1').hide();
                        $('#section2').hide();
                        $('#section3').hide();
                        $('#section4').show();
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
            
        });


        $('#application_booking_form').validate({
            ignore: [],
            rules: {
                appointment_id: {
                    required: true
                },
                client_id: {
                    required: true
                },
                booking_date: {
                    required: true
                },
                booking_time: {
                    required: true
                }
            },

            messages: {
                appointment_id: {
                    required: 'Appointment id is missing'
                },
                client_id: {
                    required: 'Client id is missing'
                },
                booking_date: {
                    required: 'Please select appointment date'
                },
                client_id: {
                    required: 'Please select appointment time'
                }
            },

            submitHandler: function(form) {
                var data = $(form).serializeArray();
                console.log(data);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if(response.result==1)
                        {
                            var special_notes = $('#special_notes').val();
                            $('#appointment_success_message').text(response.message);
                            $('#appointment_success_section').show();
                            $('#appointment_submit').hide();
                            $('#special_notes_section').html(special_notes);
                            $('#special_notes_section').show();
                            $('#special_notes').hide();
                            //Need to reset form //
                            
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


    });  
</script>
@endsection