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

        //Appointment Data
        $appointment_id = "1";
        $user_id = '43';
        $order_id = '123456';
        $service_name = 'Test Appoiintemnt';
        $unit_price = "10";
        $appointemnt_qty = "1";
        $total_price = ($unit_price*$appointemnt_qty);
        $tax = "0";
        $subtotal_tax = (($total_price*$tax)/100);
        $currency = 'INR';
        $total_amount = ($total_price+$subtotal_tax);
        $payment_method = '10'; 
        $invoice_date = date('Y-m-d');
        $payment_terms = "Due on recive";
        $due_date = date('Y-m-d');
        $strto_start_time = time();
        $service_start_time = date('l d, Y h:i A',$strto_start_time);
        $service_location = 'Kolkata';
        $service_duration = '20 mint';
        //$service_cost = $total_amount;
        $reschedule_url = 'google.com';
        $cancel_url = 'google.com';


        //Service Provider Data
        $service_provider_name = "NCR Technosolution";
        $service_logo_url = '';
        $service_provider_address = 'Chatterjee International <br> Park Street <br> Kolkata - 700071';
        $service_provider_email = "rajib.ncrts@gmail.com";
        $service_provider_phone = '9876543210';
        $stripe_user_id = "test12345";


        //Client Data
        $client_name = 'Any Clinet';
        $client_email = "rajib.ncrts@gmail.com";
        $client_phone = '9876543210';
        

        //Staff Data
        $staff_name = 'Rajib Jana';
        $staff_email = "rajib.ncrts@gmail.com";
        $staff_phone = '9876543210';

        $note_to_recepent = "Thank you for booking with us";


        //Currency convert
        $payable_currency = 'usd';
        $currency_string = strtoupper($currency).'_'.strtoupper($payable_currency);
		$json = file_get_contents("http://free.currencyconverterapi.com/api/v6/convert?q=".$currency_string."&compact=y");
  		$obj = json_decode($json, true); 
  		$current_currency_value = floatval($obj["$currency_string"]);

  		$payble_amount = $total_amount*$current_currency_value;
		

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

            //print_r($avaialable_currency_list); die();
            //echo $avaialable_currency_list['usd']; die();
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
                //echo "<pre>";
                //print_r($final_charge); die();
                if($final_charge['status'] == 'succeeded')
                {
       
                	//Transfer Amount to Service Provider

                	/*$transfer = \Stripe\Transfer::create(array(
						"amount" => number_format($payble_amount, 2, '.', '') * 100,
						"currency" => $payable_currency,
						"source_transaction" => $final_charge['id'],
						"destination" => $stripe_user_id,
						"transfer_group" => $order_id,
					));*/




                    // Update user appointment table
                    $updateCond = array(
		                array('order_id','=',$order_id),
		            );

                    $data_array = array(
                    		'paid_amount' => $total_amount,
                  			'payment_status' => '1',
                  			'payment_method' => $payment_method,
                  			'transuction_id' => $final_charge['id'],
                  			'invoice_date' => $invoice_date,
                  			'payment_terms' => $payment_terms,
                  			'due_date' => $due_date,
                  			'is_deleted' => 0,
                  	);
                   /* echo "<pre>";
                  	print_r($updateCond);

                  	echo "<pre>";
                  	print_r($data_array);

                  	echo $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data_array); die();*/
                  	// Insert into stripe payment //
                    if($update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data_array)) 
                    {

                    	//Booking confirmation mail to client
                    	$email_template = $this->email_template($user_id,$type = 5);
						$templateHeader = '<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
						   <table width="100%">
						      <tr>
						         <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>
						         <td style="color:#FFF; text-align: right; " >&nbsp;</td>
						      </tr>
						   </table>
						</div>';

						$templateFooter = '<div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">
						   <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>
						   <p style="text-align:center">For even easier management of your appointments.</p>
						   <div style="text-align:center;">
						      <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a> 
						      <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  
						   </div>
						</div>
						<div style="text-align:center">
						   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>
						   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>
						   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>
						   <br><br>
						   <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>
						   <p>Copyright &copy; '.date('Y').'</p>
						</div>';

						$mail_body = $email_template->message;
						$mail_body = str_replace('{header}', $templateHeader, $mail_body);
						$mail_body = str_replace('{client_name}', $client_email, $mail_body);
						$mail_body = str_replace('{service_name}', $service_name, $mail_body);
						$mail_body = str_replace('{staff_name}', $staff_name, $mail_body);
						$mail_body = str_replace('{booking_time}', $service_start_time, $mail_body);
						$mail_body = str_replace('{location}', $service_location, $mail_body);
						$mail_body = str_replace('{staff_email}', $staff_email, $mail_body);
						$mail_body = str_replace('{reshedule_url}', $reschedule_url, $mail_body);
						$mail_body = str_replace('{cancel_url}', $cancel_url, $mail_body);
						$mail_body = str_replace('{footer}', $templateFooter, $mail_body);
						$emailData['subject'] = $email_template->subject ? $email_template->subject : 'Booking Confirm';
						$emailData['content'] = $mail_body;
						$this->sendmail(7,$client_email,$emailData);

						//booking confirmation mail to stuff
						$stuff_email_data['client_name'] = $client_name;
						$stuff_email_data['staff_email'] = $staff_email;
						$stuff_email_data['staff_name'] = $staff_name;
						$stuff_email_data['service_name'] = $service_name;
						$stuff_email_data['service_cost'] = $total_amount;
						$stuff_email_data['service_duration'] = $service_duration;
						$stuff_email_data['service_location'] = $service_location;
						$stuff_email_data['reschedule_url'] = $reschedule_url;
						$stuff_email_data['cancel_url'] = $cancel_url;
						$stuff_email_data['service_start_time'] = $service_start_time;
						$stuff_email_data['email_subject'] = "Booking Confirm";
						$this->sendmail(8,$staff_email,$stuff_email_data);

						//Invoice to client
						$invoice_email_data['service_logo_url'] = $service_logo_url;
						$invoice_email_data['service_provider_name'] = $service_provider_name;
						$invoice_email_data['service_provider_address'] = $service_provider_address;
						$invoice_email_data['service_provider_email'] = $service_provider_email;
						$invoice_email_data['service_provider_phone'] = $service_provider_phone;
						$invoice_email_data['order_id'] = $order_id;
						$invoice_email_data['invoice_date'] = $invoice_date;
						$invoice_email_data['payment_terms'] = $payment_terms;
						$invoice_email_data['due_date'] = $due_date;
						$invoice_email_data['client_email'] = $client_email;
						$invoice_email_data['service_name'] = $service_name;
						$invoice_email_data['appointemnt_qty'] = $appointemnt_qty;
						$invoice_email_data['currency'] = $currency;
						$invoice_email_data['unit_price'] = $unit_price;
						$invoice_email_data['total_price'] = $total_price;
						$invoice_email_data['tax'] = $tax;
						$invoice_email_data['note_to_recepent'] = $note_to_recepent;
						$invoice_email_data['subtotal_tax'] = $subtotal_tax;
						$invoice_email_data['total_amount'] = $total_amount;
						$invoice_email_data['email_subject'] = "Invoice";
						$send = $this->sendmail(21,$client_email,$invoice_email_data);

                    	return redirect(url('client_payment_status/'))->with('payment_success','Payment successfully done.'); 
                    }
                    else
                    {
                    	return redirect(url('client_payment_status/'))->with('payment_error','This card does not support this currency.');
                    }
                }

            } catch (\Exception $e) {
                // Error Message //

                /*$body = $e->getJsonBody();
                //print_r($body); 
				$err = $body['error'];
				$msg = $err['message'];
				return redirect(url('client_payment_status/'))->with('payment_error',$msg);*/

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

    
    public function client_paypal_payment(Request $request,$parameter=NULL)
	{
		$appointment_id = "1";
        $user_id = '43';
        $order_id = '123456';
        $service_name = 'Test Appoiintemnt';
        $unit_price = "10";
        $appointemnt_qty = "1";
        $total_price = ($unit_price*$appointemnt_qty);
        $tax = "0";
        $subtotal_tax = (($total_price*$tax)/100);
        $currency = 'INR';
        $total_amount = ($total_price+$subtotal_tax);
        $payment_method = '10'; 
        $invoice_date = date('Y-m-d');
        $payment_terms = "Due on recive";
        $due_date = date('Y-m-d');
        $strto_start_time = time();
        $service_start_time = date('l d, Y h:i A',$strto_start_time);
        $service_location = 'Kolkata';
        $service_duration = '20 mint';
        //$service_cost = $total_amount;
        $reschedule_url = 'google.com';
        $cancel_url = 'google.com';


        //Service Provider Data
        $service_provider_name = "NCR Technosolution";
        $service_logo_url = '';
        $service_provider_address = 'Chatterjee International <br> Park Street <br> Kolkata - 700071';
        $service_provider_email = "rajib.ncrts@gmail.com";
        $service_provider_phone = '9876543210';
        $paypalID = "rajib.ncrts-facilitator@gmail.com";


        //Client Data
        $client_name = 'Any Clinet';
        $client_email = "rajib.ncrts@gmail.com";
        $client_phone = '9876543210';
        

        //Staff Data
        $staff_name = 'Rajib Jana';
        $staff_email = "rajib.ncrts@gmail.com";
        $staff_phone = '9876543210';

        $note_to_recepent = "Thank you for booking with us";


        //Currency convert
        $payable_currency = 'usd';
        $currency_string = strtoupper($currency).'_'.strtoupper($payable_currency);
		$json = file_get_contents("http://free.currencyconverterapi.com/api/v6/convert?q=".$currency_string."&compact=y");
  		$obj = json_decode($json, true); 
  		$current_currency_value = $obj[$currency_string]['val'];

  		$payble_amount = number_format($total_amount*$current_currency_value, 2);
		
        /////// If Stripe token is already generated //////
  		if(!empty($request->all()))
		{
            echo "<pre>";
            print_r($request->all()); die();

            $enableSandbox = true;
            $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
			// Set the PayPal account.
		    $data['business'] = $request->input('business');

		    // Set the PayPal return addresses.
		    $data['return'] = stripslashes($request->input('return'));
		    $data['cancel_return'] = stripslashes($request->input('cancel_return'));
		    $data['notify_url'] = stripslashes($request->input('notify_url'));
		    // Set the details about the product being purchased, including the amount
		    // and currency so that these aren't overridden by the form data.
		    $data['item_name'] = $request->input('item_name');
		    $data['amount'] = $request->input('amount');
		    $data['currency_code'] = 'USD';

		    // Add any custom fields for the query string.
		    //$data['custom'] = USERID;

		    // Build the query string from the data.
		    $queryString = http_build_query($data);

		    // Redirect to paypal IPN
		    header('location:' . $paypalUrl . '?' . $queryString);
           
        } else {
            echo '<form action="'.url('client_paypal_payment').'" method="post" target="_top" name="paypal_payment">
		      <input type="hidden" name="business" value="'.$paypalID.'">
		      <input type="hidden" name="item_name" value="'.$service_name.'">
		      <input type="hidden" name="item_number" value="'.$order_id.'">
		      <input type="hidden" name="amount" value="'.$payble_amount.'">
		      <input type="hidden" name="cmd" value="_xclick">
		      <input type="hidden" name="currency_code" value="'.strtoupper($payable_currency).'">
		      <input type="hidden" name="notify_url" value="'.url('client_paypal_payment').'">
		      <input type="hidden" name="cancel_return" value="'.url('client_payment_cancel').'">
		     
		      <input type="hidden" name="return" value="'.url('client_paypal_success').'">
		    </form>
            <script>
               window.onload = function(){
				  document.forms["paypal_payment"].submit();
				}		
            </script>';

        }
	}

	public function client_payment_status($parameter=NULL)
	{
		$data = array();
		return view('website.client.client_payment_status')->with($data);
	}

	function email_template($user_id, $type)
    {
        $sub_condition = array(
            array('user_id', '=', $user_id)
        );
        $sub_field = array();    
        $subcription_id = $this->common_model->fetchData($this->tableObj->tableNameUserSubscription,$sub_condition, $sub_field);
        //$subcription_id = $subcription_id->id;
        if(!empty($subcription_id))
        {
            $email_template_condition = array(
                array('user_id', '=', $user_id),
                array('type', '=', $type)
            );
            $email_template_field = array();    
            $email_template = $this->common_model->fetchData($this->tableObj->tableNameUserEmailCustomisation,$email_template_condition, $email_template_field);
            if(empty($email_template))
            {
                $email_template_condition = array(
                    array('type', '=', $type)
                );
                $email_template_field = array();    
                $email_template = $this->common_model->fetchData($this->tableObj->tableNameEmailTemplateMaster,$email_template_condition, $email_template_field);
            }
        }
        else
        {
            $email_template_condition = array(
                array('type', '=', $type)
            );
            $email_template_field = array();    
            $email_template = $this->common_model->fetchData($this->tableObj->tableNameEmailTemplateMaster,$email_template_condition, $email_template_field);
        }
        return $email_template;
    }

    public function client_paypal_success(Request $request)
	{
		echo "<pre>";
		print_r($request->all()); die();
	}

    
	
}