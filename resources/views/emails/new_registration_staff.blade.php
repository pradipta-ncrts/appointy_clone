<style>
   body {margin:0; background:#eef2f6;}
</style>
<div style="max-width:650px; margin:20px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
   <div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
      <table width="100%">
         <tr>
            <td><img src="{{asset('public/assets/website/images/logo-light-text.png')}}" height="30"></td>
            <td style="color:#FFF; text-align: right; " >&nbsp;</td>
         </tr>
      </table>
   </div>
   Hi <?=$staff_name;?>,<br><br>
    Your are register as a <?=$type;?> with squeedr. 
    <br><br>   
    Username : <?=$username;?>  
    <br><br>
    Password : <?=$password;?>  
    <br><br>                        
    <br><br> 
    <br><br><br>
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
      <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>
      <p>Copyright &copy; <?php date('Y');?></p>
   </div>
</div>