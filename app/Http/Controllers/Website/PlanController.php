<?php 
/**
 * @Author : NCRTS
 * User Controller for Website
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
use Excel;

use DateTime;

class PlanController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function settings_membership()
	{	
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="settings_membership";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['plan_list'] = $return->plan_list;
				$data['check_plan_id'] = $return->check_plan_id;
				//echo '<pre>'; print_r($return); exit;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.plan.settings-membership')->with($data);
		}
		else
		{
			return $return;
		}
		
	}


	public function make_payment($parameter=NULL)
	{
        $authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
            return redirect('/login');
        }
        $user_no = $authdata['user_no'];
        $data= Crypt::decrypt($parameter);
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $user_email = $data['user_email'];
        $plan_id = $data['plan_id'];
        $plan_name = $data['plan_name'];
        $duration_in_day = $data['duration_in_day'];
        $duration_in_month = $data['duration_in_month'];
        $plan_price = $data['plan_price'];
        $payble_amount = $data['payble_amount'];
        $payable_currency = 'usd';

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
                    return redirect(url('settings-membership/'))->with('payment_error','You have insufficient balance for this transaction.');
                }
            } else {
                // Error Message //
                //\Session::flash('payment_error_status', 'This card does not support this currency.');
                return redirect(url('settings-membership/'))->with('payment_error','This card does not support this currency.');
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
                    // Update user subscription table
                    $start_date = $this->date_format;
                    $end_date = date('Y-m-d H:i:s', strtotime($start_date. ' + '.$duration_in_day.' days'));

                    $input_array = array(
                  			'user_id' => $user_id,
                  			'subscription_id' => $plan_id,
                  			'subscription_name' => $plan_name,
                  			'subscription_price' => $plan_price,
                  			'duration_in_day' => $duration_in_day,
                  			'duration_in_month' => $duration_in_month,
                  			'payble_amount' => $payble_amount,
                  			'start_date' => $start_date,
                  			'end_date' => $end_date,
                  			'payment_status' => $final_charge['status'],
                  			'transuction_id' => $final_charge['balance_transaction'],
                  	);

                  	// Insert into stripe payment //
                    if($this->common_model->insert_data_get_id($this->tableObj->tableNameUserSubscription, $input_array)) 
                    {
						$emailData['name'] = $user_name;
						$emailData['plan_name'] = $plan_name;
						$emailData['duration_in_day'] = $duration_in_day;
						$emailData['transuction_id'] = $final_charge['balance_transaction'];

						$this->sendmail(14,$user_email,$emailData);

                    	return redirect(url('settings-membership/'))->with('payment_success','Payment successfully done.'); 
                    }
                    else
                    {
                    	return redirect(url('settings-membership/'))->with('payment_error','This card does not support this currency.');
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
                    data-email="'.$user_email.'">
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

}