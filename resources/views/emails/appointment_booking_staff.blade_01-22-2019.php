<style>
    body {margin:0; background:#eef2f6;}
</style>


<div style="max-width:650px; margin:20px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
        <table width="100%">
          <tr>
            <td><img src="{{asset('public/assets/website/images/logo-light-text.png')}}" height="30"></td>
            <td style="color:#FFF; text-align: right; " >Confirm  Booking <img src="{{asset('public/assets/website/images/confirm.png')}}" height="25" style="vertical-align: middle; margin-left:8px;"></td>
          </tr>
        </table>
    </div>
    <div style="padding:20px; background: #FFF; border-radius:0 0 8px 8px ;">
        <h2 style="margin:0; padding:0; font-size:20px; font-weight: normal"><?php echo ucwords($staff_name);?></h2>
        <span style="color:#888;font-size:18px;"><?php echo ucwords($service_name);?></span>
		<span style="color:#888;font-size:14px;"><?php echo $service_cost;?></span>

        <p style="font-size:15px; margin-bottom: 20px;"><?php echo $service_start_time;?> </p>

        <div style="text-align:center;">
            <a href="#" style="border-radius: 4px;background-color: #2ba2da; color: #FFF; padding: 10px 25px; width:150px; display:inline-block; text-decoration: none;">Re-schedule</a>  &nbsp;
            <a href="#" style="border-radius: 4px;background-color: #888;color: #FFF; padding: 6px 25px; text-decoration: none;padding: 10px 25px; width:150px; display: inline-block; ">Cancel</a>
        </div>
    </div>
    <div style="padding:20px; margin-top: 15px; background: #FFF; border-radius:8px ;">
        <p style="text-align:center; font-size:18px; margin-top: 0 ">To read before the appointment</p>

        <table style="font-size:15px;">
            <tr>
                <td style="vertical-align: middle;"><img src="{{asset('public/assets/website/images/tick.png')}}" style="vertical-align: middle; margin-right:15px; width:30px;"></td>
                <td style="padding:15px 0; vertical-align: middle;">Please bring your medical prescriptions and the list of medications you are taking.</td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 5px;"><img src="{{asset('public/assets/website/images/tick.png')}}" style="vertical-align: middle; margin-right:15px; width:30px;"></td>
                <td style="padding:0 0 15px 0">Please introduce yourself with your most recent dental results or those of your children (dental panoramic, scanner, etc.).</td>
            </tr>
            <tr>
                    <td style="vertical-align: top; padding-top: 5px;"><img src="{{asset('public/assets/website/images/tick.png')}}" style="vertical-align: middle; margin-right:15px; width:30px;"></td>
                    <td style="padding:0 0 15px 0">In order to make this appointment, you must be referred by your dentist or specialist. Thank you for bringing the letter of it on the day of your consultation.</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 5px;"><img src="{{asset('public/assets/website/images/tick.png')}}" style="vertical-align: middle; margin-right:15px; width:30px;"></td>
                    <td style="padding:0 0 15px 0">Thank you to bring your vital card or certificate of less than 3 months and also bring your mutual card with rights in course of validity. If not, you will be forced to advance all fees.</td>
                </tr>
        </table>
        
    </div>

    <div style="padding:20px; margin-top: 15px; background: #FFF; border-radius: 8px ;">
            <p style="text-align:center; font-size:18px; margin-top: 0 ">Payment Mode</p>
    
            <table style="font-size:15px;">
            
                <tr>                   
                    <td style="padding:15px 10px">
                           <a href="#" style="background:#17b355; padding: 10px 25px; text-decoration: none; border-radius: 5px; color:#FFF;font-weight: bold"> <img src="{{asset('public/assets/website/images/tick-w.png')}}" style="vertical-align: middle; width:18px;"> Credit Card</a>
                    </td>
                    <td style="padding:15px 10px">
                            <a href="#" style="background:#17b355; padding: 10px 25px; text-decoration: none; border-radius: 5px; color:#FFF;font-weight: bold"> <img src="{{asset('public/assets/website/images/tick-w.png')}}" style="vertical-align: middle; width:18px;"> Net Banking</a>
                     </td>
                     <td style="padding:15px 10px">
                            <a href="#" style="background:#17b355; padding: 10px 25px; text-decoration: none; border-radius: 5px; color:#FFF;font-weight: bold"> <img src="{{asset('public/assets/website/images/tick-w.png')}}" style="vertical-align: middle; width:18px;"> Cheque</a>
                     </td>
                </tr>
               
            </table>
            
        </div>

        <div style="padding:20px; margin-top: 15px; background: #FFF; border-radius:8px;">
                <p style="text-align:center; font-size:18px; margin-top: 0 ">Contact Information</p>
        
                Meythet Dental Center<br>
                21 Frangy Road<br>
                74960 Meythet<br><br>

                <a href="#" style="text-decoration: none; color:#2ba2da; margin-bottom:10px; display: block;">GET THE ROUTE</a>

                <table width="100%">
                    <tr>
                        <td><img src="{{asset('public/assets/website/images/profile-icon-phone1.png')}}" style="vertical-align:middle; height:25px; margin-right: 0px;"> 802-438-0497 </td>
                        <td><img src="{{asset('public/assets/website/images/profile-icon-email.png')}}" style="vertical-align:middle; height:25px; margin-right: 0px;"> EstherG@gmail.com </td>
                        <td><img src="{{asset('public/assets/website/images/profile-icon-location1.png')}}" style="vertical-align:middle; height:25px; margin-right: 0px;"> Lauren Drive, Madison, WI 53705 </td>
                    </tr>
                </table>
                
            </div>

            <div style="padding:20px; margin-top: 15px; background: #FFF; border-radius:8px;">
                    <p style="text-align:center; font-size:18px; margin-top: 0 ">My Account</p>
            
                    <p style="text-align:center">Access your account, manage your appointments and your loved ones.</p>
                  
                    <div style="text-align:center;">
                            <a href="#" style="border-radius: 4px;background-color: #2ba2da; color: #FFF; padding: 10px 25px; width:150px; display:inline-block; text-decoration: none;">Register Here!</a>  &nbsp;
                           
                    </div>                   
            </div>

            <div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">
                    <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>
            
                    <p style="text-align:center">For even easier management of your appointments.</p>
                
                    
                    <div style="text-align:center;">
                            <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="{{asset('public/assets/website/images/android.png')}}" style="width:150px"></a> 
                            <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="{{asset('public/assets/website/images/android.png')}}" style="width:150px"></a>  
                           
                    </div>                   
            </div>


            <div style="text-align:center">
                <a target="_blank" href="https://www.facebook.com/profile.php?id=1423240701" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/facebook.png')}}" width="40px; "></a>
                <a target="_blank" href="https://twitter.com/Squeed_r" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/twitter.png')}}"  width="40px; "></a>
                <a target="_blank" href="https://www.instagram.com/squeedr/?hl=fr" style="margin:15px 15px 5px; display:inline-block"><img src="{{asset('public/assets/website/images/instagram.png')}}"  width="40px; "></a>
                <br><br>
               <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  | 	<a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a> 	| 	<a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>
               <p>Copyright &copy; <?php date('Y');?></p>
            </div>

    
</div>