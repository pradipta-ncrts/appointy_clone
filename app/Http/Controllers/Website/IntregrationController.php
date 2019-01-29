<?php 



/**

 * @Author : NCRTS

 * Booking Controller for Website

 * 

 */

namespace App\Http\Controllers\Website;
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\TablesController;
use Validator;
use Session;
use Cookie;
use DateTime;

class IntregrationController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

}

	public function integration()
	{	
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		$data['user_id'] = $authdata['user_no'];
		return view('website.intregration.integration')->with($data);
		
	}

	public function stripe_connect(Request $request)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		//echo "<pre>";
		//print_r($request->all());

		$user_id = $authdata['user_no'];
        if($request->state==$user_id)
        {
        	$in_data = $request->code;
			$token_request_body = array(
				'grant_type' => 'authorization_code',
				'client_id' => 'ca_B8Dz9Fv0Ws0PWzP6eogVk91xdJpqELoi',//this is actually development client id
				'code' => $in_data,
				'client_secret' => 'sk_test_mYBT9h1w3PgJOPLuBk9RErEe'
			);

			$req = curl_init('https://connect.stripe.com/oauth/token');
			curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($req, CURLOPT_POST, true );
			curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
			// TODO: Additional error handling
			$respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
			$resp = json_decode(curl_exec($req), true);
			curl_close($req);

			if(isset($resp['error']) && $resp['error'])
			{
				return redirect('/integration')->with('intregration_success','Already intregrated in stripe.');
			}
			else
			{
				$stripe_data['user_id'] = $user_id;
				$stripe_data['access_token'] = $resp['access_token'];
				$stripe_data['refresh_token'] = $resp['refresh_token'];
				$stripe_data['token_type'] = $resp['token_type'];
				$stripe_data['stripe_publishable_key'] = $resp['stripe_publishable_key'];
				$stripe_data['stripe_user_id'] = $resp['stripe_user_id'];
				$stripe_data['scope'] = $resp['scope'];

				$condition = array(
	                array('user_id','=',$user_id),
	                array('is_deleted','=','0'),
	        	);

	        	$fields = array('intregration_id');

				$check = $this->common_model->fetchData($this->tableObj->tableNameStripeIntregration,$condition,$fields);
				if(!empty($check))
				{
					//update
					$updatedata = $this->common_model->update_data($this->tableObj->tableNameStripeIntregration,$condition,$stripe_data);

				}
				else
				{
					//insert
					$insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStripeIntregration,$stripe_data);
				}

				return redirect('/integration')->with('intregration_success','Stripe successfully intregraeted.');
			}
        }
        else
        {
        	return redirect('/integration')->with('intregration_error','Somthing wrong please try again later.');
        }

	}

	public function paypal_intregration(Request $request)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		$user_id = $authdata['user_no'];
		$paypal_data['user_id'] = $user_id;
		$paypal_data['email'] = $request->input('paypal_email_id');
		

		$condition = array(
            array('user_id','=',$user_id),
            array('is_deleted','=','0'),
    	);

    	$fields = array('intregration_id');

		$check = $this->common_model->fetchData($this->tableObj->tableNamePaypalIntregration,$condition,$fields);
		if(!empty($check))
		{
			//update
			$updatedata = $this->common_model->update_data($this->tableObj->tableNamePaypalIntregration,$condition,$paypal_data);

		}
		else
		{
			//insert
			$insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNamePaypalIntregration,$paypal_data);
		}

		return redirect('/integration')->with('intregration_success','Paypal successfully intregraeted.');
	}

}