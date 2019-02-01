@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Client Payment Status</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="row">
            @if(Session::has('payment_error'))

               <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                   <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                   <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('payment_error')}}</p>
               </div>
            @endif

            @if(Session::has('payment_success'))

               <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('payment_success')}}</p>
              </div>
            
            @endif
         </div>
      </div>

    <!--   <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type='hidden' name='business' value='Paypal_Business_TestAccount_Id'>
      <input type='hidden' name='item_name' value='Camera'>
      <input type='hidden' name='item_number' value='CAM#N1'>
      <input type='hidden' name='amount' value='0.01'>
      <input type='hidden' name='no_shipping' value='1'>
      <input type='hidden' name='currency_code' value='USD'>
      <input type='hidden' name='notify_url' value='http://SITE NAME/payment.php'>
      <input type='hidden' name='cancel_return' value='http://SITE NAME/cancel.php'>
      <input type='hidden' name='return' value='http://SITE NAME/success.php'>
  
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="### COPY FROM BUTTON CODE ###">
      <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    </form> -->

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 
        <input type="hidden" name="business" value="rajib.ncrts-facilitator@gmail.com"> 
        <!-- Specify a Buy Now button. --> 
        <input type="hidden" name="cmd" value="_xclick"> 
        <!-- Specify details about the item that buyers will purchase. --> 
        <input type="hidden" name="item_name" value="Test Item"> 
        <input type="hidden" name="item_number" value="123456"> 
        <input type="hidden" name="amount" value="10"> 
        <input type="hidden" name="currency_code" value="USD"> 
        <!-- Specify URLs --> 
        <input type='hidden' name='cancel_return' value='http://localhost/paypal_integration_php/paypal_cancel.php'> 
        <input type='hidden' name='return' value='http://localhost/paypal_integration_php/paypal_success.php'> 
        <!-- Display the payment button. --> 
        <input type="image" name="submit" border="0" 
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online"> 
        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" > 
    </form> 
   </div>
</div>
@endsection
