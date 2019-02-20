   //================Custom validation for 10 digit phone====================
   $.validator.addMethod("phoneUS", function (phone_number, element) {
     phone_number = phone_number.replace(/\s+/g, "");
     return this.optional(element) || phone_number.length > 11 && phone_number.length < 14;
   }, "Please specify a valid phone number with country prefix.");
   //================Custom validation for 10 digit phone====================

 //================Submit AJAX request ==================
 $('#update-contact-info').validate({

       ignore: ":hidden:not(.selectpicker)",

       rules: {
           /*profession: {
               required: true
           },*/
           business_name: {
               required: true
           },
           business_location: {
               required: true
           },
           street_number: {
               required: true
           },
           route: {
               required: true
           },
           city: {
               required: true
           },
           state: {
               required: true
           },
           zip_code: {
               required: true
           },
           country: {
               required: true
           },
           mobile: {
               required: true,
               phoneUS: true
           },
           office_phone: {
               required: true
           },
           skype_id: {
               required: true,
           },
           business_description: {
               required: true,
           },
           transport: {
               required: true
           },
           parking: {
               required: true
           },
           
       },
       
       messages: {
           /*profession: {
               required: 'Please select profession'
           },*/
           business_name: {
               required: 'Please enter business name'
           },
           business_location: {
               required: 'Please enter business location'
           },
           street_number: {
               required: 'Please enter street number'
           },
           route: {
               required: 'Please enter route'
           },
           city: {
               required: 'Please enter city'
           },
           state: {
               required: 'Please enter state'
           },
           zip_code: {
               required: 'Please enter zip code'
           },
           country: {
               required: 'Please enter country'
           },
           mobile: {
               required: 'Please enter mobile'
           },
           office_phone: {
               required: 'Please enter office phone'
           },
           skype_id: {
               required: 'Please enter skype id'
           },
           business_description: {
               required: 'Please enter business description'
           },
           transport: {
               required: 'Please enter transport'
           },
           parking: {
               required: 'Please enter parking'
           },
       },

       submitHandler: function(form) {
         var data = $(form).serializeArray();
         data = addCommonParams(data);
         $.ajax({
             url: form.action,
             type: form.method,
             data:data ,
             dataType: "json",
             success: function(response) {
               console.log(response);
               if(response.result=='1')
               {
                  swal("Success!", response.message, "success")
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

$("#business-info-update").bind('click',function(e){
   e.preventDefault();
   $('#update-contact-info').submit();
});


$("#profile-image-upload").on('click',function(e){
   e.preventDefault();
   $( "#profile-image" ).trigger( "click" );
});

$("#timeline-image-upload").on('click',function(e){
   e.preventDefault();
   $( "#timeline-image" ).trigger( "click" );
});


function readURL(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#image_upload_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#timeline_image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profile-image").change(function () {
    readURL(this);
    $('#profile-image-remove').show();
});

$("#timeline-image").change(function () {
    readURL2(this);
    $('#timeline-image-remove').show();
});

$("#profile-image-remove").click(function (e) {
    e.preventDefault();
    $('.animationload').show();
    $('#profile-image-remove').hide();
    $('#old_profile_image').val('');
    $('#profile-image').val('');
    $('#image_upload_preview').attr('src', baseUrl+'/public/assets/website/images/picture.png');
    $('.animationload').hide();

});

$("#timeline-image-remove").click(function (e) {
    e.preventDefault();
    $('.animationload').show();
    $('#timeline-image-remove').hide();
    $('#old_timeline_image').val('');
    $('#timeline-image').val('');
    $('#timeline_image_preview').attr('src', baseUrl+'/public/assets/website/images/picture.png');
    $('.animationload').hide();

});

//==================social & logo update=====================

$("#update-social-logo").on('submit', (function(e) {
    e.preventDefault();
    //data = addCommonParams(data);
    var data = $('#update-social-logo').serializeArray();
    data = addCommonParams(data);
    //var files = $("#profile-image input[type='file']")[0].files;
    var profile_image = document.getElementById('profile-image');
    var timeline_image = document.getElementById('timeline-image');

    var form_data = new FormData();

    if(profile_image.files.length>0){
        for(var i=0;i<profile_image.files.length;i++){
            form_data.append('profile_image',profile_image.files[0]);
        }
    }

    if(timeline_image.files.length>0){
        for(var i=0;i<timeline_image.files.length;i++){
            form_data.append('timeline_image',timeline_image.files[0]);
        }
    }
   
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    //console.log(form_data);

    $.ajax({
        url: baseUrl+"/api/update-logo-social", // Url to which the request is send
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
                swal("Success!", response.message, "success")
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
}));

//==================social & logo update=====================

$(".service-list").click(function (e) {
    e.preventDefault();
    $('.animationload').show();
    $('.service-list').removeClass("active");
    $(this).addClass("active");
    $(".break40px").hide();
    let id = $(this).attr('id');
    $("#row"+id).show();
    $('.animationload').hide();

});


    $('#add_client_form').validate({
            rules: {
                client_name: {
                    required: true
                },
                client_email: {
                    required: true,
                    email: true
                },
                client_mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
            },
            messages: {
                client_name: {
                    required: 'Please enter fullname'
                },
                client_email: {
                    required: 'Please enter email',
                    email: 'Please enter proper email'
                },
                client_mobile: {
                    required: 'Please enter mobile no',
                    number: 'Please enter proper mobile no',
                    minlength: 'Please enter minimum 10 digit mobile no',
                    maxlength: 'Please enter maximum 10 digit mobile no'
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "client_name") {
                    error.insertAfter($('#clientname_error'));
                } else if (element.attr("name") == "client_email") {
                    error.insertAfter($('#clientemail_error'));
                } else if (element.attr("name") == "client_mobile") {
                    error.insertAfter($('#clientmobile_error'));
                } 
            },
            submitHandler: function(form) {
                    var data = $(form).serializeArray();
                    data = addCommonParams(data);
                    var files = $("#add_team_member_form input[type='file']")[0].files;
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
            $('#myModaladdclient').modal('hide');
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


    $(".email_cutomisation_form").submit(function(e) {
        // Getting the form ID
        e.preventDefault();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        var  formID = $(this).attr('id');
        var formDetails = $('#'+formID);
        data = formDetails.serializeArray();
        data = addCommonParams(data);

        var action = formDetails.attr('action');

        $.ajax({
          type: "POST",
          url: action,
          data: data,
          dataType: "json",
          beforeSend: function() {
              $('.animationload').show();
          },
          success: function(response) {
              console.log(response); //Success//
              if (response.response_status == 1) {
                $('.animationload').hide();
                swal('Success!', response.response_message, 'success');
              } else {
                swal('Sorry!', response.response_message, 'error');
              }
            }
        });
    });

//================Submit AJAX request for add new appoinment ==================
 $('#add_appointmentm_form').validate({

       ignore: ":hidden:not(.selectpicker)",

       rules: {
           client: {
               required: true
           },
           appoinment_service: {
               required: true
           },
           staff: {
               required: true
           },
           date: {
               required: true
           },
           appointmenttime: {
               required: true
           },
           appoinment_note: {
               required: true
           },
       },
       
       messages: {
           client: {
               required: 'Client is required'
           },
           appoinment_service: {
               required: 'Service is required'
           },
           staff: {
               required: 'Staff is required'
           },
           date: {
               required: 'Date is required'
           },
           appointmenttime: {
               required: 'Time is required'
           },
           appoinment_note: {
               required: 'Note is required'
           },
       },

       errorPlacement: function(error, element) {
            if (element.attr("name") == "client") {
                error.insertAfter($('#client_error'));
            } else if (element.attr("name") == "appoinment_service") {
                error.insertAfter($('#appoinment_service_error'));
            } else if (element.attr("name") == "staff") {
                error.insertAfter($('#staff_error'));
            } else if (element.attr("name") == "date") {
                error.insertAfter($('#date_error'));
            } else if (element.attr("name") == "appointmenttime") {
                error.insertAfter($('#appointmenttime_error'));
            }else if (element.attr("name") == "appoinment_note") {
                error.insertAfter($('#appoinment_note_error'));
            }
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
               if(response.result=='1')
               {
                    $('.animationload').hide();
                    $("#myModaladdappoinment").hide();
                    $("#add_appointmentm_form").trigger("reset");
                    swal({title: "Success", text: response.message, type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                    //swal("Success!", response.message, "success")
                    /*setTimeout(function()
                    {
                        window.location.reload();
                   
                    }, 1000);*/
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
 //================Submit AJAX request add new appoinment ==================

//=================apoinment Reschedule start=========================================
 $(".reschedule-appoinment").click(function (e) {
  e.preventDefault();
  let data = addCommonParams([]);
  let id = $("#appoinment-id").val();
  data.push({name:'appointment_id',value:id});
  if(id)
  {
       $.ajax({
            url: baseUrl+"/api/appointment_details", 
            type: "POST", 
            data: data, 
            dataType: "json",
            success: function(response) 
            {
                console.log(response);          
                let appointment_id = response.appoinment_details.appointment_id;
                let service_id = response.appoinment_details.service_id;
                let date = response.appoinment_details.appoinment_raw_date;
                let time = response.appoinment_details.appoinment_raw_time;
                let staff_id = response.appoinment_details.staff_id;
                $("#reshedule_appointment_id").val(appointment_id);
                $("#reshedule_service_id").val(service_id);
                $("#reshedule_appointmentdate").val(date);
                $("#reshedule_appointmenttime").val(time);
                $("#reshedule_staff_id").val(staff_id);
                $('#myModaladdappoinmentReschedule').modal('show');
                $('.animationload').hide();
                
                /*if(response.result=='1')
                {
                    swal({title: "Success", text: response.message, type: "success"},
                        function(){ 
                            $('#myModalAppointmentContent').modal('hide');
                            location.reload();
                        }
                    );  
                }*/
                /*else
                {
                    swal("Error", response.message , "error");
                }*/
            },
            beforeSend: function()
            {
                $('.animationload').show();
            },
            complete: function()
            {
                $('#myModalAppointmentContent').modal('hide');
            }
        });
  }
  else
  {
      swal("Error", response.message , "error");
  }
});


  $('#reschedule_appoitment').validate({

       ignore: ":hidden:not(.selectpicker)",

       rules: {
           reshedule_date: {
               required: true
           },
           reshedule_appointmenttime: {
               required: true
           },
       },
       
       messages: {
           reshedule_date: {
               required: 'Date is required'
           },
           reshedule_appointmenttime: {
               required: 'Time is required'
           },
       },

       errorPlacement: function(error, element) {
            if (element.attr("name") == "reshedule_date") {
                error.insertAfter($('#reshedule_date_error'));
            } else if (element.attr("name") == "reshedule_appointmenttime") {
                error.insertAfter($('#reshedule_appointmenttime_error'));
            }
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
               if(response.result=='1')
               {
                    $("#myModaladdappoinmentReschedule").modal('hide');
                    $('.animationload').hide();
                    swal({title: "Success", text: response.message, type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                    //swal("Success!", response.message, "success")
                    /*setTimeout(function()
                    {
                        window.location.reload();
                   
                    }, 1000);*/
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
//=================apoinmnet Reschedule end=====================================
$('#select_service').on('click', function(e) {
    e.preventDefault();
    $("#serviceListModal").modal('show');
});

$('.service-select-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $('input:checkbox[name=filter_service_id]').each(function() {
      if ( $(this).is(':visible'))
      {
        this.checked = true;  
      }
        //this.checked = true;                        
    });
});

$('.service-deselect-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $('input:checkbox[name=filter_service_id]').each(function() {
    if ( $(this).is(':visible'))
     {
        this.checked = false;  
     }                      
    });
});

$('#add-service-into-input').click(function(event) { 
    event.preventDefault();
    var service_ids = [];
    $("input:checkbox[name=filter_service_id]:checked").each(function(){
        service_ids.push($(this).val());
    });
  
    let data = addCommonParams([]);
    data.push({name:'service_ids',value:service_ids});
    $.ajax({
        url: baseUrl+"/api/services_lists", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            console.log(response);
            if(response.response_status=='1')
            {
                $("#select_services").text(response.service_name); 
                $("#service_ids").val(response.service_ids); 
                $("#serviceListModal").modal('hide');
                $('.animationload').hide();     
            } 
        },
        beforeSend: function()
        {
            $('.animationload').show();
        },
        complete: function()
        {
            //$('#myModalAppointmentContent').modal('hide');
        }
    });
});

$('#cancel-service-list').click(function(event) { 
    event.preventDefault();
    $("#serviceListModal").modal('hide');
});


//=================Block Date Start=============================================

$('#date_block_for').on('click keyup keypress blur change', function(e) {
    e.preventDefault();
    $("#staffListModal").modal('show');
});

//Staff Filter
$(document).ready(function(){
  $("#staffFilter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $("#assignstaffFilter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


$('.staff-select-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
      if ( $(this).is(':visible'))
      {
        this.checked = true;  
      }
        //this.checked = true;                        
    });
});
$('.staff-deselect-all').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
    if ( $(this).is(':visible'))
     {
        this.checked = false;  
     }                      
    });
});

$('#add-stuff-into-input').click(function(event) { 
    event.preventDefault();
    var staff_ids = [];
    $("input:checkbox[name=filter_stuff_id]:checked").each(function(){
        staff_ids.push($(this).val());
    });
  
    let data = addCommonParams([]);
    data.push({name:'staf_id',value:staff_ids});
    $.ajax({
          url: baseUrl+"/api/staffs_list", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  $("#date_block_for").val(response.staffs_name); 
                  $("#date_block_for_ids").val(response.staffs_ids); 
                  $("#staffListModal").modal('hide');
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});



$('#block_date_add').validate({

       ignore: ":hidden:not(.selectpicker)",

       rules: {
           block_date: {
               required: true
           },
           date_block_for: {
               required: true
           },
           date_block_reasons: {
               required: true
           },
           
       },
       
       messages: {
           block_date: {
               required: 'Date is required'
           },
           date_block_for: {
               required: 'Block for required'
           },
           date_block_reasons: {
               required: 'Reason is required'
           },
           
       },

       errorPlacement: function(error, element) {
            if (element.attr("name") == "block_date") {
                error.insertAfter($('#block_date_error'));
            } else if (element.attr("name") == "date_block_for") {
                error.insertAfter($('#date_block_for_error'));
            }else if (element.attr("name") == "date_block_reasons") {
                error.insertAfter($('#date_block_reasons_error'));
            }
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
               if(response.result=='1')
               {
                    $("#myModalblockdate").modal('hide');
                    $('.animationload').hide();
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
             beforeSend: function(){
                 $('.animationload').show();
             },
             complete: function(){
                 $('.animationload').hide();
             }
         });
       }
   });

$('#cancel-staff-list').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $("#staffListModal").find('form').trigger('reset');
    $("#staffListModal").modal('hide');
});

//=================Bloack Date End==============================================
//=================Block Time Start=============================================
$('#time_block_for').on('click keyup keypress blur change', function(e) {
    e.preventDefault();
    $("#staffListModalForTime").modal('show');
});

$('#add-stuff-into-input-time').click(function(event) { 
    event.preventDefault();
    var staff_ids = [];
    $("input:checkbox[name=filter_stuff_id_time]:checked").each(function(){
        staff_ids.push($(this).val());
    });
  
    let data = addCommonParams([]);
    data.push({name:'staf_id',value:staff_ids});
    $.ajax({
          url: baseUrl+"/api/staffs_list", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  $("#time_block_for").val(response.staffs_name); 
                  $("#time_block_for_ids").val(response.staffs_ids); 
                  $("#staffListModalForTime").modal('hide');
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});

$('#cancel-staff-list-time').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $("#staffListModalForTime").find('form').trigger('reset');
    $("#staffListModalForTime").modal('hide');
});

$(document).ready(function(){
  $("#staffFilterTime").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


$('.staff-select-all-time').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
      if ( $(this).is(':visible'))
      {
        this.checked = true;  
      }
        //this.checked = true;                        
    });
});
$('.staff-deselect-all-time').click(function(event) { 
    event.preventDefault();
    // Iterate each checkbox
    $(':checkbox').each(function() {
    if ( $(this).is(':visible'))
     {
        this.checked = false;  
     }                      
    });
});

$('#block_time_add').validate({

   ignore: ":hidden:not(.selectpicker)",

   rules: {
       bolck_start_time: {
           required: true
       },
       bolck_end_time: {
           required: true
       },
       block_time_date: {
           required: true
       },
       time_block_for: {
           required: true
       },
       block_time_reason: {
           required: true
       },
       
   },
   
   messages: {
       bolck_start_time: {
           required: 'Start time is required'
       },
       bolck_end_time: {
           required: 'End time is required'
       },
       block_time_date: {
           required: 'Date is required'
       },
       time_block_for: {
           required: 'Block for is required'
       },
       block_time_reason: {
           required: 'Reasion is required'
       },
       
   },

   errorPlacement: function(error, element) {
        if (element.attr("name") == "bolck_start_time") {
            error.insertAfter($('#bolck_start_time_error'));
        } else if (element.attr("name") == "bolck_end_time") {
            error.insertAfter($('#bolck_end_time_error'));
        }else if (element.attr("name") == "block_time_date") {
            error.insertAfter($('#block_time_date_error'));
        }else if (element.attr("name") == "time_block_for") {
            error.insertAfter($('#time_block_for_error'));
        }else if (element.attr("name") == "block_time_reason") {
            error.insertAfter($('#block_time_reason_error'));
        }
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
           if(response.result=='1')
           {
               $("#myModalblocktime").modal('hide');
                $('.animationload').hide();
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
         beforeSend: function(){
             $('.animationload').show();
         },
         complete: function(){
             $('.animationload').hide();
         }
     });
   }
});



//================Block Time End===============================================

//================Update Appintment payment start==============================
$('#addPayment').click(function(event) { 
    event.preventDefault();
    var total_amount_tobe_paid = $(this).data('payment-amount');
    var payment_amount = $(this).data('payment-amount');
    var additional_amount = $(this).data('additional-amount');
    var discount_amount = $(this).data('discount-amount');
    var total_payable_amount = $(this).data('total-payable-amount');
    var paid_amount = $(this).data('paid-amount');
    var remaining_balance = $(this).data('remaining-balance');
    var payment_note = $(this).data('payment-note');
    var appointment_id = $(this).data('appointment-id');
    var currency = $(this).data('currency');

    $('#payment_method').val(1);
    $('#total_amount_tobe_paid').val(total_amount_tobe_paid);
    $('#payment_appointment_id').val(appointment_id);
    $('#payment_amount').val(payment_amount); 
    $('#additional_charges').val(additional_amount); 
    $('#discount_amount').val(discount_amount); 
    $('#payment_note').val(payment_note); 
    $('#total-amount-currency').val(currency);
    $('#total-amount').text(total_payable_amount);
    $("#myModalPayment").modal('show');
    
});

$('#payment_amount, #additional_charges, #discount_amount').keyup(function(e) { 
    e.preventDefault();
    let tot = 0;
    $('.animationload').show();
    let payment_amount = $('#payment_amount').val(); 
    if(payment_amount=='')
    {
        payment_amount = 0;
    }

    let additional_charges = $('#additional_charges').val();
    if(additional_charges=='')
    {
        additional_charges = 0;
    }
    let discount_amount = $('#discount_amount').val();
    if(discount_amount=='')
    {
        discount_amount = 0;
    }
    tot = (parseFloat(payment_amount)+parseFloat(additional_charges))-parseFloat(discount_amount);
    $('#total-amount').text(tot.toFixed(2));
    $('.animationload').hide();
    
});

 $(document).on('keydown', '#payment_amount, #additional_charges, #discount_amount', function(e){
      -1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||
      (/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||
      e.metaKey===true))&&(!0===e.ctrlKey||
      !0===e.metaKey)||
      35<=e.keyCode&&40>=e.keyCode||
      (e.shiftKey||48>e.keyCode||
      57<e.keyCode)&&(96>e.keyCode||
      105<e.keyCode)&&e.preventDefault()
 });

 $('#update-payment-info').validate({
 
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
           if(response.result=='1')
           {

                $('.animationload').hide();
                console.log(response);
               $("#myModalPayment").modal('hide');
                $('.animationload').hide();
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
         beforeSend: function(){
             $('.animationload').show();
         },
         complete: function(){
             $('.animationload').hide();
         }
     });
   }
});
//================Update Appintemnt payment end================================
        

//================Notification setting start===================================
$('#email_send_time_duration').keyup(function(e) { 
    e.preventDefault();
    let val = $(this).val();
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"email_send_time"});

    setTimeout(function(){ 
          $.ajax({
              url: baseUrl+"/api/update_notification_settings", 
              type: "POST", 
              data: data, 
              dataType: "json",
              success: function(response) 
              {
                  console.log(response);
                  if(response.response_status=='1')
                  {
                      swal({title: "Success", text: response.message, type: "success"});
                      $('.animationload').hide();     
                  } 
              },
              beforeSend: function()
              {
                  $('.animationload').show();
              },
              complete: function()
              {
                  //$('#myModalAppointmentContent').modal('hide');
              }
          });
     }, 1000);
    
});


$('#sms_send_time_duration').keyup(function(e) { 
    e.preventDefault();
    let val = $(this).val();
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"sms_send_time"});

    setTimeout(function(){ 
          $.ajax({
              url: baseUrl+"/api/update_notification_settings", 
              type: "POST", 
              data: data, 
              dataType: "json",
              success: function(response) 
              {
                  console.log(response);
                  if(response.response_status=='1')
                  {
                      swal({title: "Success", text: response.message, type: "success"});
                      $('.animationload').hide();     
                  } 
              },
              beforeSend: function()
              {
                  $('.animationload').show();
              },
              complete: function()
              {
                  //$('#myModalAppointmentContent').modal('hide');
              }
          });
     }, 1000);
    
});

$('#send_email_to_customer').click(function(e) { 
    e.preventDefault();
    let val = $(this).data('value');
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"is_email_send"});
      $.ajax({
          url: baseUrl+"/api/update_notification_settings", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  swal({title: "Success", text: response.message, type: "success"});
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});

$('#send_sms_to_customer').click(function(e) { 
    e.preventDefault();
    let val = $(this).data('value');
    //alert(val);
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"is_sms_send"});
      $.ajax({
          url: baseUrl+"/api/update_notification_settings", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  swal({title: "Success", text: response.message, type: "success"});
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});


$('#is_admin_update').click(function(e) { 
    e.preventDefault();
    let val = $(this).data('value');
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"is_admin"});
      $.ajax({
          url: baseUrl+"/api/update_notification_settings", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  swal({title: "Success", text: response.message, type: "success"});
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});

$('#is_stuff_update').click(function(e) { 
    e.preventDefault();
    let val = $(this).data('value');
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"is_stuff"});
      $.ajax({
          url: baseUrl+"/api/update_notification_settings", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  swal({title: "Success", text: response.message, type: "success"});
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});

$('#when_to_send').change(function(e) { 
    e.preventDefault();
    let val = $(this).val();
    if(val==0)
    {
        $("#send_sms_to_admin_customer_div").hide();
    }
    else
    {
        $("#send_sms_to_admin_customer_div").show();
    }
    let data = addCommonParams([]);
    data.push({name:'post_veriable',value:val},
      {name:'field_name',value:"when_to_send"});
      $.ajax({
          url: baseUrl+"/api/update_notification_settings", 
          type: "POST", 
          data: data, 
          dataType: "json",
          success: function(response) 
          {
              console.log(response);
              if(response.response_status=='1')
              {
                  swal({title: "Success", text: response.message, type: "success"});
                  $('.animationload').hide();     
              } 
          },
          beforeSend: function()
          {
              $('.animationload').show();
          },
          complete: function()
          {
              //$('#myModalAppointmentContent').modal('hide');
          }
      });
});

//================Notification setting end===================================

//================Service Section Start======================================

$(".chnage-service-status").click(function (e) {
    e.preventDefault();
    let data = addCommonParams([]);
    let id = $(this).data('id');
    data.push({name:'service_id',value:id});
    $.ajax({
        url: baseUrl+"/api/chnage-service-status", 
        type: "POST", 
        data: data, 
        dataType: "json",
        success: function(response) 
        {
            console.log(response);
            $('.animationload').hide();
            if(response.result=='1')
            {
                if(response.message.status==1)
                {
                    $("#change-status-"+id).removeClass('active');
                }
                else
                {
                    $("#change-status-"+id).addClass('active');
                }
                swal({title: "Success", text: response.message.msg, type: "success"});
                //swal(title: "Success", text: response.message.msg, type: "success");
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

$("#copy-link").click(function (event) {
  event.preventDefault();
  $('.animationload').show();
  let url = $(this).data('url');
  $('#offscreen').val(url);
  var copyTextarea = document.querySelector('.offscreen');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    //console.log('Copying text command was ' + msg);
    swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();
  } catch (err) {
    //console.log('Oops, unable to copy');
    swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();
  }
});


$(".copy-service-link").click(function (event) {
  event.preventDefault();
  $('.animationload').show();
  let url = $(this).data('service');
  //alert(url);
  $('#offscreen').val(url);
  var copyTextarea = document.querySelector('.offscreen');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();
  } catch (err) {
    console.log('Oops, unable to copy');
    swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();
  }
});

$(".clone-srvice").click(function (event) {
  event.preventDefault();

  let data = addCommonParams([]);
  let id = $(this).data('id');
  data.push({name:'service_id', value:id});
  $.ajax({
      url: baseUrl+"/api/clone-service", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          console.log(response);
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
 
});

$(".save-as-template").click(function (event) {
  event.preventDefault();
  let data = addCommonParams([]);
  let id = $(this).data('id');
  data.push({name:'service_id', value:id});
  $.ajax({
      url: baseUrl+"/api/service-template", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          console.log(response);
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
 
});


$(".delete-srvice").click(function (event) {
  event.preventDefault();
  let serviceid = $(this).attr('data-serviceid');
  swal({
    title: "Are you sure?",
    text: "Once cancelled, you will loose all the details of the appointment!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, not now!",
    closeOnConfirm: false,
    closeOnCancel: true
    },function(isConfirm){

        if (isConfirm){
            let data = addCommonParams([]);
            //alert(serviceid);
            data.push({name:'service_id', value:serviceid});
            $.ajax({
                url: baseUrl+"/api/delete-service", 
                type: "POST", 
                data: data, 
                dataType: "json",
                success: function(response) 
                {
                    console.log(response);
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

$("#submit_service_status_filter").click(function (event) {
  event.preventDefault();
  $('.animationload').show();
  var data = $("#service_status_filter").serializeArray();
  console.log(data);
  if(data.length > 0)
  {
      if(data.length < 2)
      {
          if(data[0].value==1)
          {
              //alert('1');
              $(".check-active").show();
              $(".check-inactive").hide();
              $("#staffFilterModal").modal('hide');
          }
          else
          {
              //alert('2')
              $(".check-inactive").show();
              $(".check-active").hide();
              $("#staffFilterModal").modal('hide');
          }
      }
      else
      {
         $(".check-active").show();
         $(".check-inactive").show();
         $("#staffFilterModal").modal('hide');
      }
  }
  else
  {
      $(".check-active").show();
      $(".check-inactive").show();
      $("#staffFilterModal").modal('hide');
  }
  
  $('.animationload').hide();
});

$("#embed-link").click(function (event) {
  event.preventDefault();
  let url = $(this).data('url');
  $("#modalEmbed").modal('show');
  var ifrm = '<iframe src="'+url+'"></iframe>';
  $("#embed_code").val(ifrm);
});

$("#copy-embed-link").click(function (event) {
  event.preventDefault();
  var copyTextarea = document.querySelector('#embed_code');
  copyTextarea.focus();
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    /*swal("Success!", "Successfully copied link", "success");
    $('.animationload').hide();*/
  } catch (err) {
    console.log('Oops, unable to copy');
    /*swal("Error!", "Oops, unable to copy", "errro");
    $('.animationload').hide();*/
  }
});

$(".embed-srvice").click(function (event) {
  event.preventDefault();
  let url = $(this).data('service');
  $("#modalEmbed").modal('show');
  var ifrm = '<iframe src="'+url+'"></iframe>';
  $("#embed_code").val(ifrm);
});



   $(document).on('change','.category',function() {
       //$('.category').on('change', function(event){
       let val = $(this).val();
       //alert(val);
       if(val=="new")
       {
          $(this).parent().siblings(".new-category-name").show();
       }
       else
       {
          $(this).parent().siblings(".new-category-name").hide();
       }
    });


    $(document).on('change','.duration',function() {
      let val = $(this).val();
      if(val=="Custom")
      {
         $(this).parent().siblings(".custom-duration").show();
      }
      else
      {
         $(this).parent().siblings(".custom-duration").hide();
      }
   });

   $(document).on('click','.user-status',function(event) {
      event.preventDefault(); 
      //capacity
      var val = $(this).text();
      if(val=="One to One")
      {
         $(this).parent().next().next(".capacity").hide();
         $(this).parent().next(".capacity").find(".group").removeClass('tg-btn-ac');
         $(this).parent().next(".capacity").find(".group").addClass('tg-btn');
         $(this).addClass('tg-btn-ac');
         $("#checkGroup").val('');
      }
      else if(val=="Group")
      {
         $(this).parent().siblings(".capacity").show();
         $(this).addClass('tg-btn-ac');
         $(this).parent().prev(".capacity").find(".one-to-one").removeClass('tg-btn-ac');
         $(this).parent().prev(".capacity").find(".one-to-one").addClass('tg-btn');
         $("#checkGroup").val('1');
      }
   });

      //================Submit AJAX request ==================
   

  $('#add-new-service').validate({
        ignore: ":hidden:not(.selectpicker)",
        //ignore: [],
        rules: {
            'service_category': {
                required: true
            },
            'new_category_name': {
                  required: function(){
                        return $("#service_category").val() == "new";
                  }
            },
            'service_name': {
                required: true
            },
            'service_cost': {
                required: true
            },
            'service_currency': {
                required: true
            },
            'service_duration': {
                required: true
            },
            'custom_duration': {
                  required: function(){
                        return $("#service_duration").val() == "Custom";
                  }
            },
            'service_capacity': {
                  required: function(){
                        return $("#checkGroup").val() == "1";
                  }
            },
          },

        messages: {
            'service_category': {
                required: 'Please select category'
            },
            'new_category_name': {
                required: 'Please enter new category'
            },
            'service_name': {
                required: 'Please enter service'
            },
            'service_cost': {
                required: 'Please enter cost'
            },
            'service_currency': {
                required: 'Please enter currency'
            },
            'service_duration': {
                required: 'Please enter duration'
            },
            'custom_duration': {
                required: 'Please enter custom duration'
            },
            'service_capacity': {
                required: 'Please enter capacity'
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
                      $('#myModalServices').modal('hide');
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
              beforeSend: function(){
                  $('.animationload').show();
              },
              complete: function(){
                  $('.animationload').hide();
              }
          });
        }
    });

$(".edit-service").click(function (event) {
  event.preventDefault();

  let data = addCommonParams([]);
  let id = $(this).data('id');
  data.push({name:'service_id', value:id});
  $.ajax({
      url: baseUrl+"/api/service-details", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          console.log(response);
          $('.animationload').hide();
          if(response.result=='1')
          {
              $("#service_category").val(response.message.category.category_id).trigger('change');
              if(response.message.category.is_blocked==1)
              {
                  $(".category").parent().siblings(".new-category-name").show();
                  $("#new_category_name").val(response.message.category.category);
              }

              $("#service_name").val(response.message.service_detils.service_name);
              $("#service_cost").val(response.message.service_detils.cost);
              $("#service_currency").val(response.message.service_detils.currency_id).trigger('change');
              if(response.message.service_detils.duration > 60)
              {
                  $('.duration').parent().siblings(".custom-duration").show();
                  $("#custom_duration").val(response.message.service_detils.duration);
                  $("#service_duration").val('Custom').trigger('change');
              }
              else
              {
                  $("#service_duration").val(response.message.service_detils.duration).trigger('change');
              }

              if(response.message.service_detils.capacity==0)
              {
                  /*$('.user-status').parent().next().next(".capacity").hide();
                  $('.user-status').parent().next(".capacity").find(".group").removeClass('tg-btn-ac');
                  $('.user-status').parent().next(".capacity").find(".group").addClass('tg-btn');
                  $('.user-status').addClass('tg-btn-ac');*/
                  $("#service_capacity").val(0);
                  $('.one-to-one').trigger('click');
                  $("#checkGroup").val('');
              }
              else
              {
                  /*$("#service_capacity").val(response.message.service_detils.capacity);
                  $('.user-status').parent().siblings(".capacity").show();
                  $('.user-status').addClass('tg-btn-ac');
                  $('.user-status').parent().prev(".capacity").find(".one-to-one").removeClass('tg-btn-ac');
                  $('.user-status').parent().prev(".capacity").find(".one-to-one").addClass('tg-btn');*/
                  $("#service_capacity").val(response.message.service_detils.capacity);
                  $( ".group" ).trigger( "click" );
                  $("#checkGroup").val('1');
              }

              $("#update_service_id").val(response.message.service_detils.service_id);
              $('#myModalServices').modal('show');
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

$("#create_new_service").change(function (event) {
  event.preventDefault();
  let val = $(this).val();
  if(val=='group')
  {
     var url = baseUrl+'/add_services/group';
     window.location.replace(url);
  }
  if(val=='one-to-one')
  {
     var url = baseUrl+'/add_services/solo';
     window.location.replace(url);
  }

});

$("input[id*='service_cost']").keydown(function (event)
{
    if (event.shiftKey == true) {
        event.preventDefault();
    }

    if((event.keyCode >= 48 && event.keyCode <= 57) || 
      (event.keyCode >= 96 && event.keyCode <= 105) || 
      event.keyCode == 8 || event.keyCode == 9 || 
      event.keyCode == 37 || event.keyCode == 39 || 
      event.keyCode == 46 || event.keyCode == 190){

    } 
    else
    {
        event.preventDefault();
    }
    if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
        event.preventDefault();
});

$('#service_capacity,#custom_duration').on('keydown', function(e){
    -1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||
    (/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||
    e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||
    35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||
    57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()
});

//================Service Section End========================================

//================Repayment Option Start=====================================
$('#add-pre-payment-charege').validate({
      
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
                    swal({title: "Success", text: response.message, type: "success"});
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


$('#payment-settings').validate({
      
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
                    swal({title: "Success", text: response.message, type: "success"});
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

$('#payment-terms').validate({
      
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
                    swal({title: "Success", text: response.message, type: "success"});
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


//================Repayment Option End=====================================

//===============Add Location Start========================================

$('#add-new-location').validate({
    ignore: ":hidden:not(.selectpicker)",
    //ignore: [],
    rules: {
       
        'location_name': {
            required: true
        },
        'country': {
            required: true
        },
        'city': {
            required: true
        },
        'location_username': {
            required: true
        },
        'location_password': {
            required: true
        },
        'location_full_name': {
            required: true
        },
        'location_email': {
            required: true
        },
      },

    messages: {
        
        'location_name': {
            required: 'Please enter location'
        },
        'country': {
            required: 'Please enter country'
        },
        'city': {
            required: 'Please enter city'
        },
        'location_username': {
            required: 'Please enter username'
        },
        'location_password': {
            required: 'Please enter password'
        },
        'location_full_name': {
            required: 'Please enter full name'
        },
        'location_email': {
            required: 'Please enter email'
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
                  $('#myModalServices').modal('hide');
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
          beforeSend: function(){
              $('.animationload').show();
          },
          complete: function(){
              $('.animationload').hide();
          }
      });
    }
});

$("#add-location-exist-user").click(function (event) {
    event.preventDefault();
    $("#staffListModalForAddLocation").modal('show');
  
});


$(document).ready(function(){
  $("#staffFilterAddLOcation").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function(){
  $("#staffFilterAddLOcation").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".break20px").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(".add-location-exist-user").click(function (event) {
    event.preventDefault();
    $('.animationload').show();

    $("#location_staff_id").val($(this).data('staffid'));

    $("#location_password").parent().parent().parent().hide();
   
    $("#autocomplete").val($(this).data('location'));
    $("#country").val($(this).data('country'));
    $("#city").val($(this).data('city'));
    
    $("#location_username").val($(this).data('username'));
    $("#location_username").prop("readonly", true);

    $("#location_full_name").val($(this).data('fullname'));
    $("#location_full_name").prop("readonly", true);

    $("#location_email").val($(this).data('email'));
    $("#location_email").prop("readonly", true);

    $("#staffListModalForAddLocation").modal('hide');
    $('.animationload').hide();

});


//==============Add Loaction End===========================================

//==============Invite Contact & dicount===================================

$("#invite_without_dicount").on('click', (function(e) {
    e.preventDefault();
    //data = addCommonParams(data);
    $('#discount_type').val('no');
    var data = $('#import-invite-contact').serializeArray();
    data = addCommonParams(data);
    var files = $("#import-invite-contact input[type='file']")[0].files;
    if(files.length==0)
    {
        swal("Error", "Please select import file." , "error");
        return false;
    }
    var form_data = new FormData();
    if(files.length>0){
        for(var i=0;i<files.length;i++){
            form_data.append('contacts_excel_file',files[i]);
        }
    }
    // append all data in form data 
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    $.ajax({
        url: baseUrl+"/api/import-invite-contact", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            //$('.animationload').hide();
            if(response.result=='1')
            {
                $('#import-invite-contact').trigger("reset");
                swal("Success!", response.message, "success")
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            //$('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });
}));

$("#invite_with_dicount").on('click', (function(e) {
    e.preventDefault();
    $('#discount_type').val('yes');
    //data = addCommonParams(data);
    var data = $('#import-invite-contact').serializeArray();
    data = addCommonParams(data);
    var files = $("#import-invite-contact input[type='file']")[0].files;
    //console.log(files.length);
    if(files.length==0)
    {
        swal("Error", "Please select import file." , "error");
        return false;
    }
    var form_data = new FormData();
    if(files.length>0){
        for(var i=0;i<files.length;i++){
            form_data.append('contacts_excel_file',files[i]);
        }
    }
    // append all data in form data 
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    $.ajax({
        url: baseUrl+"/api/import-invite-contact", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            //$('.animationload').hide();
            if(response.result=='1')
            {
                $('#import-invite-contact').trigger("reset");
                swal("Success!", response.message, "success")
            }
            else
            {
                swal("Error", response.message , "error");
            }
        },
        beforeSend: function()
        {
            //$('.animationload').show();
        },
        complete: function()
        {
            //$('.animationload').hide();
        }
    });
}));


//==============Invite & dicount end======================================

//===============Profile section start====================================
$("#branding").click(function (event) {
    event.preventDefault();
    let bval = $("#profile_branding").val();
    if(bval==1)
    {
        $("#profile_branding").val(0);
    }
    else
    {
        $("#profile_branding").val(1);
    }
});


$('#update-profile-settings').validate({
    ignore: ":hidden:not(.selectpicker)",
    //ignore: [],
    rules: {
       
        'profile_name': {
            required: true
        },
        'profile_profession': {
            required: true
        },
        'presentation': {
            required: true
        },
        'expertise': {
            required: true
        },
      },

    messages: {
        
        'profile_name': {
            required: "Name is required"
        },
        'profile_profession': {
            required: "Profession is required"
        },
        'presentation': {
            required: "Presentation is required"
        },
        'expertise': {
            required: "Expertise is required"
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
                  $('#myModalServices').modal('hide');
                  swal({title: "Success", text: response.message, type: "success"});
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


$("#delete-account").click(function (event) {
  event.preventDefault();
  let serviceid = '';
  swal({
    title: "Are you sure?",
    text: "Once cancelled, you will loose all the details of the appointment!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, not now!",
    closeOnConfirm: false,
    closeOnCancel: true
    },function(isConfirm){

        if (isConfirm){
            let data = addCommonParams([]);
            //alert(serviceid);
            data.push({name:'service_id', value:serviceid});
            $.ajax({
                url: baseUrl+"/api/delete-account", 
                type: "POST", 
                data: data, 
                dataType: "json",
                success: function(response) 
                {
                    console.log(response);
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

$('#update-profile-payment').validate({
    ignore: ":hidden:not(.selectpicker)",
    //ignore: [],
    rules: {
        'payment_mode': {
            required: true
        },
      },

    messages: {
        'payment_mode': {
            required: "Payemt mode is required"
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
                  $('#myModalServices').modal('hide');
                  swal({title: "Success", text: response.message, type: "success"});
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

$('#update-profile-url').validate({
    ignore: ":hidden:not(.selectpicker)",
    //ignore: [],
    rules: {
        'profile_url': {
            required: true
        },
      },

    messages: {
        'profile_url': {
            required: "Profile mode is required"
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
                  $('#myModalServices').modal('hide');
                  swal({title: "Success", text: response.message, type: "success"});
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


$("#profile_perosonal-image-upload").on('click',function(e){
   e.preventDefault();
   $( "#profile_perosonal-image" ).trigger( "click" );
});


function readURL3(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#profile_perosonal_image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profile_perosonal-image").change(function () {
    readURL3(this);
    $('#profile_perosonal-image-remove').show();
});

$("#profile_perosonal-image-remove").click(function (e) {
    e.preventDefault();
    $('.animationload').show();
    $('#profile_perosonal-image-remove').hide();
    $('#old_profile_perosonal_image').val('');
    $('#profile_perosonal-image').val('');
    $('#profile_perosonal_image_preview').attr('src', baseUrl+'/public/assets/website/images/picture.png');
    $('.animationload').hide();

});

$("#profile-personal-image").on('submit', (function(e) {
    e.preventDefault();
    //data = addCommonParams(data);
    var data = $('#profile-personal-image').serializeArray();
    data = addCommonParams(data);
    //var files = $("#profile-image input[type='file']")[0].files;
    var profile_perosonal_image = document.getElementById('profile_perosonal-image');

    var file = profile_perosonal_image.files[0];
    //console.log(file);
    var fileType = file.type;
    //alert(fileType);
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
         swal("Error", "Invalid file format." , "error");
         return false;
    }

    var form_data = new FormData();

    if(profile_perosonal_image.files.length>0){
        for(var i=0;i<profile_perosonal_image.files.length;i++){
            form_data.append('profile_perosonal_image',profile_perosonal_image.files[0]);
        }
    }
   
    $.each(data, function( ia, l ){
        form_data.append(l.name, l.value);
    });

    //console.log(form_data);

    $.ajax({
        url: baseUrl+"/api/profile-personal-image", // Url to which the request is send
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
                swal("Success!", response.message, "success")
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
}));

      
$.validator.addMethod("pwcheck", function(value) {
  return /[a-zA-Z]+/.test(value) // consists of only these
    && /[0-9]+/.test(value) // has a digit
    && /[*@&%!#$]+/.test(value) // has a Special character
});
     
$('#change-password').validate({
      ignore: ":hidden:not(.selectpicker)",
      rules: {
          old_password: {
              required: true
          },
          new_passord: {
              required: true,
              minlength: 8,
              pwcheck: true
              //passwordCk: true
          },
          new_confirm_passord: {
              required: true
          }
      },
      
      messages: {
          old_password: {
              required: 'Old password required'
          },
          new_passord: {
              required: 'New password required',
              minlength: 'Please enter minimum 8 character password',
              pwcheck: 'Password must contain minimum 1 character, 1 digit and 1 special character.'
          },
          new_confirm_passord: {
              required: 'Confirm password required'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        data = addCommonParams(data);
        //data = addCommonParams(data);
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
                $("#change-password-inputs").hide();
                $('#change-password').trigger("reset");
                swal("Success!", response.message, "success")
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

$.validator.addMethod("properemail", function(value, element) {
       return this.optional(element) || /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
   });

$('#change-email').validate({
      rules: {
          email: {
              required: true,
              properemail: true
          },
      },
      
      messages: {
          email: {
              required: 'Please enter email',
              properemail: 'Must be a valid email address.'
          },
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        data = addCommonParams(data);
        //data = addCommonParams(data);
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
                $("#change-email-inputs").hide();
                //$('#change-email').trigger("reset");
                swal("Success!", response.message, "success")
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

$("#hide-change-password").click(function(e){
    e.preventDefault();
    $("#hide-change-password").hide();
    $("#show-change-password").show();
    $("#change-password-inputs").show();
});
$("#show-change-password").click(function(e){
    e.preventDefault();
    $("#show-change-password").hide();
    $("#hide-change-password").show();
    $("#change-password-inputs").hide();
});

$("#hide-change-email").click(function(e){
    e.preventDefault();
    $("#hide-change-email").hide();
    $("#show-change-email").show();
    $("#change-email-inputs").show();
});
$("#show-change-email").click(function(e){
    e.preventDefault();
    $("#show-change-email").hide();
    $("#hide-change-email").show();
    $("#change-email-inputs").hide();
});

$("#close-change-password").click(function(e){
    e.preventDefault();
    $("#show-change-password").hide();
    $("#hide-change-password").show();
    $("#change-password-inputs").hide();
});


//===============Profile section end====================================
//===============Plan Section ==========================================
$(".change-plan-duration").on('click', (function() {
    //e.preventDefault();
    //data = addCommonParams(data);   
    if($(this).prop('checked') == true)
    {
        var duration = "12";
    }
    else
    {
        var duration = "1";
    }
    var data = addCommonParams([]);
    data.push({name:'duration', value:duration});
  
    console.log(data);

    $.ajax({
        url: baseUrl+"/api/change_plan_duration", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            //alert(response.response_status);
            if(response.response_status=='1')
            {
                for(var i=0; i < response.message.length; i++)
                {
                    $("#get-plan-list-"+response.message[i].plan_id).html('<label>$'+response.message[i].price+'<sup>00</sup></label>/'+response.message[i].duration);
                    $("#get-plan-list-"+response.message[i].plan_id).next().html("ball");
                }

                //$(".listItem h5:contains('Month')").html("doll");
                $('.animationload').hide();
            }
            else
            {
                swal("Error", "Somthing wrong try again later." , "error");
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
}));


$(".choose-plan").on('click', (function() {
    //e.preventDefault();
    //data = addCommonParams(data);   
    if($(".change-plan-duration").prop('checked') == true)
    {
        var duration = "12";
    }
    else
    {
        var duration = "1";
    }

    var plan_id = $(this).attr('id');
    var data = addCommonParams([]);
    data.push({name:'duration', value:duration}, { name:'plan_id', value:plan_id });
  
    console.log(data);
    if(plan_id==1)
    {
        swal("Success!", "Successfully subscribe", "success");
    }
    else
    {
        $.ajax({
            url: baseUrl+"/api/send-to-stripe", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
            dataType: "json",
            success: function(response) // A function to be called if request succeeds
            {
                console.log(response);
                //alert(response.response_status);
                if(response.response_status=='1')
                {
                    window.location.href = response.message;
                }
                else
                {
                    swal("Error", "Somthing wrong try again later." , "error");
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

    
}));

//===============Plan Section ==========================================

//Set appointment colour

$("#appoinment_service").on('change', (function(e) {
    e.preventDefault();
    var service_id = $(this).val();
    if(service_id)
    {
        var data = addCommonParams([]);
        data.push({name:'service_id', value:service_id});
        console.log(data);
        $.ajax({
            url: baseUrl+"/api/get-service-colour-code", // Url to which the request is send
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
                    $("#set_service_colour").css('background-color', response.response_message.colors);
                    $("#colour_code").val(response.response_message.colors);
                    $("#colour-code-main-row").show();
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
        $("#colour-code-main-row").hide();
    }
}));


//Set appointment colour

$(".flaticon-alarm").on('click', (function(e) {
    e.preventDefault();
    var data = addCommonParams([]);
    //data.push({name:'service_id', value:service_id});
    //console.log(data);
    $.ajax({
        url: baseUrl+"/api/notification_appoinment_list", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
        dataType: "json",
        success: function(response) // A function to be called if request succeeds
        {
            console.log(response);
            //alert(response.response_status);
            if(response.response_status=='1')
            {
                /*var html = '';
                for(let i=0 ; i<=response.appoinment_list.length; i++)
                {
                    html +='<div class="notify"><a onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse_2" style="cursor: pointer;"> <b class="fa fa-custom fa-caret-down show-arrow" ></b></a> <div class="user-bkd"><img src="http://localhost/squder/public/assets/website/images/user-pic-sm-default.png" class="thumbnail rounded"> <h2> Steph Pouyet <br> <a href="mailto:steph.pouyet@gmail.com"><i class="fa fa-envelope-o"></i> Email</a> </h2></div><div id="collapse_2" class="panel-collapse collapse"><div class="usr-bkd-dt"><div class="notify-drops"><div class="dropdown custm-uperdrop"><button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Check In <img src="http://localhost/squder/public/assets/website/images/arrow.png" alt=""/></button> <ul class="dropdown-menu st-p"><li><a href="#">As Scheduled</a></li><li><a href="#">Arrived Late</a></li><li><a href="#">No Show</a></li><li><a href="#">Gift Certificates</a></li><li><a href="#">New Status</a></li></ul></div></div><div class="name"> <i class="fa fa-circle-o "></i> Dev ($120.00) <br> <i class="fa fa-user-o "></i> JASON </div><div class="datetime"> 12:00am - 01:00pm (1hr) <br> August 13 </div></div><div class="clearfix">&nbsp;</div>Booked: Aug 13th, 2018 <br> <br> <div class="link-e"> <a href="#"><i class="fa fa-times"></i> Cancel</a> <a href="#"><i class="fa fa-repeat"></i> Reschedule</a> <a href="#"><i class="fa fa-star-half-o "></i> Request a review</a> </div><div class="clearfix">&nbsp;</div><br><textarea rows="4"> Write here..</textarea><br> <div class="clearfix"></div><button type="button" class="btn btn-primary butt-next break10px" data-toggle="modal" data-target="#myModalPayment">Add Payment ($100.00) </button> </div><div class="clearfix"></div></div><hr class="notify-sep">';

                }
                alert(html);*/

                $("#get-booking-notify-list").html(response.html);
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
}));


//notification cancel
//$(".cancel-appoinment-notification").on('click', (function(e) {
$(document).on("click", '.cancel-appoinment-notification', function(e) { 
//$(".cancel-appoinment-notification").click(function (e) {
    e.preventDefault();
    let data = addCommonParams([]);
    let id = $(this).attr('id');
    //alert(id);
    data.push({name:'appoinment_id',value:id});
    if(id)
    {
        swal({
            title: "Are you sure?",
            text: "Once cancelled, you will loose all the details of the appointment!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, not now!",
            closeOnConfirm: false,
            closeOnCancel: false
            },function(isConfirm){

                if (isConfirm){
                    $.ajax({
                        url: baseUrl+"/api/appoinment-cancel", 
                        type: "POST", 
                        data: data, 
                        dataType: "json",
                        success: function(response) 
                        {
                            console.log(response);
                            $('.animationload').hide();
                            if(response.result=='1')
                            {
                                swal({title: "Success", text: response.message, type: "success"},
                                    function(){ 
                                        $('#myModalAppointmentContent').modal('hide');
                                        location.reload();
                                    }
                                );  
                            }
                            else
                            {
                                swal("Error", response.message, "error");
                            }
                        },
                        beforeSend: function()
                        {
                            $('.animationload').show();
                        },
                        complete: function()
                        {
                            $('#myModalAppointmentContent').modal('hide');
                        }
                    });
                    
                }
            });
    }
    else
    {
        swal("Error", response.message , "error");
    }
});

//Notification appointment reshedule
//$(".reschedule-appoinment").click(function (e) {
$(document).on("click", '.reschedule-appoinment', function(e) { 
  e.preventDefault();
  let data = addCommonParams([]);
  let id = $(this).attr('id');
  data.push({name:'appointment_id',value:id});
  if(id)
  {
       $.ajax({
            url: baseUrl+"/api/appointment_details", 
            type: "POST", 
            data: data, 
            dataType: "json",
            success: function(response) 
            {
                console.log(response);          
                let appointment_id = response.appoinment_details.appointment_id;
                let service_id = response.appoinment_details.service_id;
                let date = response.appoinment_details.appoinment_raw_date;
                let time = response.appoinment_details.appoinment_raw_time;
                let staff_id = response.appoinment_details.staff_id;
                $("#reshedule_appointment_id").val(appointment_id);
                $("#reshedule_service_id").val(service_id);
                $("#reshedule_appointmentdate").val(date);
                $("#reshedule_appointmenttime").val(time);
                $("#reshedule_staff_id").val(staff_id);
                $('#myModaladdappoinmentReschedule').modal('show');
                $('.animationload').hide();
                
                /*if(response.result=='1')
                {
                    swal({title: "Success", text: response.message, type: "success"},
                        function(){ 
                            $('#myModalAppointmentContent').modal('hide');
                            location.reload();
                        }
                    );  
                }*/
                /*else
                {
                    swal("Error", response.message , "error");
                }*/
            },
            beforeSend: function()
            {
                $('.animationload').show();
            },
            complete: function()
            {
                $('#myModalAppointmentContent').modal('hide');
            }
        });
  }
  else
  {
      swal("Error", response.message , "error");
  }
});

//Notification add payment
$(document).on("click", '.addPayment', function(e) {
//$('.addPayment').click(function(event) { 
    event.preventDefault();
    var total_amount_tobe_paid = $(this).data('payment-amount');
    var payment_amount = $(this).data('payment-amount');
    var additional_amount = $(this).data('additional-amount');
    var discount_amount = $(this).data('discount-amount');
    var total_payable_amount = $(this).data('total-payable-amount');
    var paid_amount = $(this).data('paid-amount');
    var remaining_balance = $(this).data('remaining-balance');
    var payment_note = $(this).data('payment-note');
    var appointment_id = $(this).data('appointment-id');
    var currency = $(this).data('currency');

    $('#payment_method').val(1);
    $('#total_amount_tobe_paid').val(total_amount_tobe_paid);
    $('#payment_appointment_id').val(appointment_id);
    $('#payment_amount').val(payment_amount); 
    $('#additional_charges').val(additional_amount); 
    $('#discount_amount').val(discount_amount); 
    $('#payment_note').val(payment_note); 
    $('#total-amount-currency').val(currency);
    $('#total-amount').text(total_payable_amount);
    $("#myModalPayment").modal('show');
    
});

//Notification note add
$(document).on("click", '.saveNoteForNotification', function(e) { 
  e.preventDefault();
  let data = addCommonParams([]);
  let app_id = $(this).attr('id');
  let app_note = $("#update_note_"+app_id).val();
  data.push({name:'appoinment-id',value:app_id},{name:'booking_note',value:app_note});
  console.log(data);
  $.ajax({
      url: baseUrl+"/api/update_appointment_note", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          console.log(response);          
          if(response.result=='1')
          {
              $('.animationload').hide();
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
          $('#myModalAppointmentContent').modal('hide');
      }
  });
});


//Notification appointment status

$(document).on("click", '.appointment_status', function(e) { 
  e.preventDefault();
  let data = addCommonParams([]);
  let appo_id = $(this).data('id');
  let appo_status = $(this).data('value');
  data.push({name:'id',value:appo_id},{name:'status',value:appo_status});
  console.log(data);
  $.ajax({
      url: baseUrl+"/api/notification_appointment_status", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          console.log(response);          
          if(response.result=='1')
          {
              $('.animationload').hide();
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
          $('#myModalAppointmentContent').modal('hide');
      }
  });
});

//Notification Profile info
$(document).on("click", '.notification-profile-info', function(e) { 
  e.preventDefault();
  //alert();
  let data = addCommonParams([]);
  $.ajax({
      url: baseUrl+"/api/notification_profile_info", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          if(response.result=='1')
          {
              $('#get-notification-profile-info').html(response.response_message);
          }
          else
          {
              $('#get-notification-profile-info').html('<div>Somthing wron, try again.</div>');
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
});

//Notification feedback
$(document).on("click", '.notification-feedback', function(e) { 
  e.preventDefault();
  //alert();
  let data = addCommonParams([]);
  $.ajax({
      url: baseUrl+"/api/notification_feedback", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          if(response.result=='1')
          {
              $('#get-notification-feedback').html(response.response_message);
          }
          else
          {
              $('#get-notification-feedback').html('<div>No data found.</div>');
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
});

//Notification update
$(document).on("click", '.notification-update', function(e) { 
  e.preventDefault();
  //alert();
  let data = addCommonParams([]);
  $.ajax({
      url: baseUrl+"/api/notification_update", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          if(response.result=='1')
          {
              $('#get-notification-update').html(response.response_message);
          }
          else
          {
              $('#get-notification-update').html('<div>No data found.</div>');
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
});

$(document).on("click", '.request-for-review', function(e) { 
  e.preventDefault();
  //alert();
  let data = addCommonParams([]);
  let appointemt_id = $(this).data('id');
  data.push({name:'appointemt_id',value:appointemt_id});
  $.ajax({
      url: baseUrl+"/api/request_for_review", 
      type: "POST", 
      data: data, 
      dataType: "json",
      success: function(response) 
      {
          if(response.result=='1')
          {
              //$('#get-notification-update').html(response.response_message);
              swal({title: "Success", text: response.message, type: "success"});
          }
          else
          {
              swal({title: "Error", text: response.message, type: "error"});
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
});

$('#edit_more_phone').click(function(){
    var html = $(this).html();
    if(html=='<i class="fa fa-plus"></i>')
    {
        $("#edit_other_phone").show();
        $(this).html('<i class="fa fa-minus"></i>');
    }
    else
    {
        $("#edit_other_phone").hide();
        $(this).html('<i class="fa fa-plus"></i>');
    }
});

$('#more_phone').click(function(){
    var html = $(this).html();
    if(html=='<i class="fa fa-plus"></i>')
    {
        $("#other_phone").show();
        $(this).html('<i class="fa fa-minus"></i>');
    }
    else
    {
        $("#other_phone").hide();
        $(this).html('<i class="fa fa-plus"></i>');
    }
});

$('#client_more_phone').click(function(){
    var html = $(this).html();
    if(html=='<i class="fa fa-plus"></i>')
    {
        $("#client_other_phone").show();
        $(this).html('<i class="fa fa-minus"></i>');
    }
    else
    {
        $("#client_other_phone").hide();
        $(this).html('<i class="fa fa-plus"></i>');
    }
});






//c-menu--slide-alert


