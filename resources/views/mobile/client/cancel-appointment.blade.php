<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title>Squeedr</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<style>
		body {margin:0; background:#eef2f6;}
		label .error{
			color: red;
			margin: 2px 0 5px 0;
		}
	</style>
</head>
<body>
<div class="animationload" style="display: none;">
      <div class="osahanloading"></div>
</div>
<?php
if(!empty($appointment_details)) {
?>

<div style="max-width:650px; margin:20px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
        <table width="100%">
          <tr>
            <td><img src="{{asset('public/assets/website/images/logo-light-text.png')}}" height="30"></td>
           
          </tr>
        </table>
    </div>
    <div style="padding:20px; background: #FFF; border-radius:0 0 8px 8px ;">  
        
      
        <p style="font-size:15px; margin-bottom: 30px; text-align: center;color: #888;">
            <?php echo ucwords($appointment_details->client_name);?>
        </p>

        <hr style="border:0;border-top:1px solid #ccc; " >

        <table width="100%">
            <tr>
                <td style="padding:20px; width: 50%;">
                    <h2 style="font-size:18px; font-weight:normal; display: flex"><img src="{{asset('public/assets/website/images/icon-circle.png')}}" style="width:18px; height:18px; vertical-align: middle; margin:5px 10px 0 0"> Meeting: <?php echo ucwords($appointment_details->staff_name).', '.ucwords($appointment_details->business_name);?></h2>
                    <h3 style="font-size:14px; font-weight:normal; color: #1196d3; display: flex"><img src="{{asset('public/assets/website/images/icon-clock.png')}}" style="width:18px; height:18px; vertical-align: middle; margin:2px 10px 0 0"> <?php echo $appointment_details->start_time.' - '.date('l F d, Y',strtotime($appointment_details->appoinment_raw_date));?></h3>
                    <h3 style="font-size:14px; font-weight:normal; color: #888; display: flex"><img src="{{asset('public/assets/website/images/icon-earth.png')}}" style="width:18px; height:18px; vertical-align: middle; margin:0px 10px 0 0"> <?php echo $appointment_details->business_location;?></h3>
                    <h3 style="font-size:14px; font-weight:normal;color: #888; display: flex"><img src="{{asset('public/assets/website/images/icon-strategy.png')}}" style="width:18px; height:18px; vertical-align: middle; margin:0px 10px 0 0"> <?php echo $appointment_details->note;?></h3>
                    <h3 style="font-size:14px; font-weight:normal;color: #888; display: flex"><img src="{{asset('public/assets/website/images/icon-skype-ep.png')}}" style="width:18px; height:18px; vertical-align: middle; margin:0px 10px 0 0"> <?php echo $appointment_details->skype_id;?></h3>
                </td>
                <td style="padding:20px; width:50%;">
				<form name="client_cancel_appointment_form" id="client_cancel_appointment_form" action="{{url('api/cancel_appointment_process')}}" method="post">
				<input type="hidden" name="appointment_id" value="<?php echo $appointment_details->appointment_id;?>">
				<input type="hidden" name="client_id" value="<?php echo $appointment_details->client_id;?>">
                    <h2  style="font-size:18px; font-weight:normal;">Cancel Event?</h2>
                    <span style="font-size:14px;color: #888;">Reason for cancelling</span>
                    <textarea name="cancel_reason" id="cancel_reason" rows="4" style="width:100%; margin: 6px 0 15px;"></textarea>
                    <button type="submit" style="border-radius: 4px;background-color: #2ba2da; color: #FFF; padding: 15px 35px; display:inline-block; text-decoration: none;cursor:pointer">Cancel Event</button>
				</form>
                </td>
            </tr>
        </table>

    </div>
    
	<div style="text-align:center">
		<a target="_blank" href="https://www.facebook.com/profile.php?id=1423240701" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/facebook.png')}}" width="40px; "></a>
		<a target="_blank" href="https://twitter.com/Squeed_r" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/twitter.png')}}"  width="40px; "></a>
		<a target="_blank" href="https://www.instagram.com/squeedr/?hl=fr" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/instagram.png')}}"  width="40px; "></a>
		<br><br>
	   <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  | 	
	   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a> 	| 	
	   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>
	   <p>Copyright &copy; 2018</p>
	</div>

</div>
<?php } else { ?>
<div style="max-width:650px; margin:20px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
	<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
        <table width="100%">
          <tr>
            <td><img src="{{asset('public/assets/website/images/logo-light-text.png')}}" height="30"></td>
           
          </tr>
        </table>
    </div>
	<div style="padding:20px; background: #FFF; border-radius:0 0 8px 8px ;">
		<h2><?php echo $message;?></h2>
	</div>
</div>
<?php } ?>

<script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script> 
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!--==================Sweetalert=========================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
//================Submit AJAX request ==================
$('#client_cancel_appointment_form').validate({
      rules: {
          cancel_reason: {
              required: true
          }
      },

      messages: {
          cancel_reason: {
              required: 'Please enter cancel reason'
          }
      },

      submitHandler: function(form) {
        var data = $(form).serializeArray();
        $.ajax({
            url: form.action,
            type: form.method,
            data:data,
            dataType: "json",
            success: function(response) {
                console.log(response);
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
//================Submit AJAX request===================
</script>

</body>
</html>
