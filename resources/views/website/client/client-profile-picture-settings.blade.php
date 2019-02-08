@extends('../layouts/client/master_template_client')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
    <div class="container-custm">
      <div class="leftpan">
        <div class="left-menu">
          <ul>
            <li><a href="{{ url('client/profile-settings/'.$param) }}" > Profile</a></li>
            <li><a href="{{ url('client/profile-picture-settings/'.$param) }}" class="active"> Picture</a> </li>
            <li><a href="{{ url('client/login-settings/'.$param) }}" > Login</a> </li>
          </ul>
        </div>
      </div>
    <div class="rightpan">
      <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>
      <div class="container-fluid">
      <!--<h2 class="profile-title">Upload Picture</h2>-->
        <div class="row">
          <div class="profile-bx"> 
            <form action="{{ url('api/client_profile_picture_upload') }}" method="post" id="client_profile_picture_form">
              <div style="width:100%;float:left;">
              <p class="profile-p">Uploaded pictures will display at the top of your profile page (maximum file size of 5MB)</p>
                  <div data-toggle="modal" style="float:left;margin-top:0;">
                  <a href="" id="client_profile_picture-remove" <?=$client_details->client_profile_picture ? '' : 'style="display: none;"'; ?>><i class="fa fa-close"></i></a>
                      <div class="upload-logo" id="client_profile_picture_upload">
                         <?php
                         $image = $client_details->client_profile_picture ? 'image/profile_perosonal_image/'.$client_details->client_profile_picture : "assets/website/images/picture.png";
                         ?>
                         <img id="client_profile_picture_preview" src="{{asset('public/'.$image)}}" height="60px" width="80px"><br>
                         <span>Upload Profile Picture</span>
                      </div>
                  </div>
                  <input accept="image/*" type="file" id="client_profile_picture" name="profile_perosonal_image" style="display: none;">
                  <input type="hidden" name="old_client_profile_picture" value="<?=$client_details->client_profile_picture;?>">
                  <input type="hidden" name="client_id" value="<?=$client_details->client_id;?>">
                  <div class="clearfix"></div>
                     <button type="submit" id="client_profile_picture-update-button" class="btn btn-primary butt-next">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('custom_js')
<script>
var baseUrl ="<?php echo url('')?>"; 

$("#client_profile_picture_upload").on('click',function(e){
   e.preventDefault();
   $( "#client_profile_picture" ).trigger( "click" );
});


function readURL(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#client_profile_picture_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#client_profile_picture").change(function () {
    readURL(this);
    $('#client_profile_picture-remove').show();
});

$("#client_profile_picture-remove").click(function (e) {
    e.preventDefault();
    $('.animationload').show();
    $('#client_profile_picture-remove').hide();
    $('#old_client_profile_picture').val('');
    $('#client_profile_picture').val('');
    $('#client_profile_picture_preview').attr('src', baseUrl+'/public/assets/website/images/picture.png');
    $('.animationload').hide();

});

$("#client_profile_picture_form").on('submit', (function(e) {
    e.preventDefault();
    var data = $('#client_profile_picture_form').serializeArray();
    //var files = $("#profile-image input[type='file']")[0].files;
    var profile_perosonal_image = document.getElementById('client_profile_picture');

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
        url: baseUrl+"/api/client_profile_picture_upload", // Url to which the request is send
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
</script>
@endsection