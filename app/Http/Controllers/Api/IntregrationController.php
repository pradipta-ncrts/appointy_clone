<?php
/**
* @Author : NCRTS
* Track :: 1
* Users Controller for Users Registration, login and basic section Related Apis
* oparetion with database
* 
*/

namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use Validator;
use Session;
use Excel;

class IntregrationController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}


	public function get_stripe_email(Request $request)
    {

    	 // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $authdata['user_no'];

        $findCond=array(
            array('user_id','=',$user_id),
        );
        //$select_fields=array('user_no','email','first_name');
        $paypal = $this->common_model->fetchData($this->tableObj->tableNamePaypalIntregration,$findCond);
        if(!empty($paypal))
        {
            $this->response_message = $paypal->email;
        }
        else
        {
            $this->response_message = "";
        }
        
        $this->response_status = '1';
        // generate the service / api response
        $this->json_output($response_data);
    }

}