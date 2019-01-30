<?php 
/**
 * @Author : NCRTS
 * Client Controller for Website
 * 
 */
namespace App\Http\Controllers\Website;
require_once('./vendor/stripe/init.php');
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\TablesController;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Session;
use Cookie;

use DateTime;

class ClientsPaymentController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}


	public function client_stripe_payment($parameter=NULL)
	{

        //$data = Crypt::decrypt($parameter);
        $appointment_id = "1";
        $user_id = '43';
        $payble_amount = '10';
        $currency = 'INR';
        $client_email = 'rajib.ncrts@gmail.com';
        $staff_email = 'rajib.ncrts@gmail.com';
        $service_profider_email = 'rajib.ncrts@gmail.com';
        $payable_currency = 'usd';

        //Currency convert
        $currency_string = strtoupper($currency).'_'.strtoupper($payable_currency);
				
		$json = file_get_contents("http://free.currencyconverterapi.com/api/v6/convert?q=".$currency_string."&compact=y");
  		$obj = json_decode($json, true); 
  		$current_currency_value = floatval($obj["$currency_string"]);

  		$payble_amount = $payble_amount*$current_currency_value;
		

        \Stripe\Stripe::setApiKey(config('constants.stripe.SECRET_KEY'));

        /////// If Stripe token is already generated //////
        if (isset($_REQUEST['stripeToken']) && !empty($_REQUEST['stripeToken']))
        {
            //echo $_REQUEST['stripeToken']; exit;
            $check_balnace = \Stripe\Balance::retrieve();
            $balanceArr = $check_balnace->__toArray(true);
            $available_amount = $balanceArr['available']['0']['amount'];
            $available = $balanceArr['available'];
            $avaialable_currency_list = array();
            foreach ($available as $avl) {
                $avaialable_currency_list[$avl['currency']] = $avl['amount'];
            }

            // Check Card Details (Available Balance & Currency) //
            if (isset($avaialable_currency_list['usd']) || isset($avaialable_currency_list['gbp']) ) {
                if ($avaialable_currency_list[$payable_currency] < ($payble_amount * 100)) {
                    // Error Message //
                    //\Session::flash('payment_error_status', 'You have insufficient balance for this transaction.');
                    return redirect(url('client_payment_status/'))->with('payment_error','You have insufficient balance for this transaction.');
                }
            } else {
                // Error Message //
                //\Session::flash('payment_error_status', 'This card does not support this currency.');
                return redirect(url('client_payment_status/'))->with('payment_error','This card does not support this currency.');
            }

            // Charge Payment //
            try {
                $charge = \Stripe\Charge::create(array(

                            "amount" => $payble_amount * 100,
                            "currency" => 'usd',
                            "source" => $_REQUEST['stripeToken'],
                            "transfer_group" => $user_id,
                ));

                $final_charge = $charge->__toArray(true);
                if($final_charge['status'] == 'succeeded')
                {
                    // Update user appointment table
                    $updateCond = array(
		                array('user_id','=',$user_id),
		                array('appointment_id', '=', $appointment_id),
		            );

                    $data_array = array(
                  			'total_payable_amount' => $payble_amount,
                  			//'payment_status' => $final_charge['status'],
                  			//'transuction_id' => $final_charge['balance_transaction'],

                  	);

                  	// Insert into stripe payment //
                    if($update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data_array)) 
                    {
						
                    	//TO DO : Send confirmation mail to Client & Service Provider.
                    	return redirect(url('client_payment_status/'))->with('payment_success','Payment successfully done.'); 
                    }
                    else
                    {
                    	return redirect(url('client_payment_status/'))->with('payment_error','This card does not support this currency.');
                    }
                }

            } catch (Exception $e) {
                // Error Message //
            }
        } else {
            echo '<form action="" method="POST" style="display:none;">
            <input name="payment_amount" id="payment_amount" value="' . $payble_amount . '" />
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="' .config('constants.stripe.PUBLIC_KEY'). '"
                    data-amount="' . ($payble_amount * 100) . '"
                    data-name="Squeedr"
                    data-description="Squeedr"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto" 
                    data-currency="USD" 
                    data-email="'.$client_email.'">
                </script>
            </form>
                <script
                    src="https://code.jquery.com/jquery-1.12.4.min.js"
                    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                    crossorigin="anonymous"></script>
                <script>
                    $( document ).ready(function() {
                        $(".stripe-button-el").click();
                    });		
                </script>';

        }

    }

    
    public function client_paypal_payment($parameter=NULL)
	{
		$data = array();
		return view('website.client.paytm')->with($data);
	}

	public function client_payment_status($parameter=NULL)
	{
		$data = array();
		return view('website.client.client_payment_status')->with($data);
	}
	
}