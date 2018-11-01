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
use Illuminate\Support\Facades\Crypt;
use Validator;
use Session;

class PlanController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}

	// Plan Listing //
    public function settings_membership(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$other_user_no = $request->input('other_user_no');
		$pageNo = $request->input('page_no');
		$pageNo = ($pageNo > 1) ? $pageNo : 1;
		$limit = $this->limit;
		$offset = ($pageNo-1)*$limit;

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}
        
		$findCond = array(
            array('is_blocked','=','0'),
			array('is_deleted','=','0'),
		);

		
		$selectFields = array();
		
		$plan_list = $this->common_model->fetchDatas($this->tableObj->tableNamePlan, $findCond, $selectFields);

		$selectFields = array('subscription_id');
		$orderBy = array('id' => 'DESC');
		$check_plan_id = $this->common_model->fetchData($this->tableObj->tableNameUserSubscription, $findCond, $selectFields,$joins=array(),$orderBy);
		
		$response_data['plan_list'] = $plan_list;
		$response_data['check_plan_id'] = $check_plan_id;
		
		$this->response_status = '1';
		// generate the service / api response
		$this->json_output($response_data);
	}

	//chnage plan duration

	public function change_plan_duration(Request $request)
    {
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

		$duration = $request->input('duration');
        
		$findCond = array(
            array('is_blocked','=','0'),
			array('is_deleted','=','0'),
		);

		
		$selectFields = array();
		$plan_list = $this->common_model->fetchDatas($this->tableObj->tableNamePlan, $findCond, $selectFields);
		$plan_list_array = array();
		$day = $duration == 1 ? "Month" : "Year";
		foreach ($plan_list as $key => $value)
		{
			$price = ($value->price*$duration);
			$plan_list_array[] = array('plan_id' => $value->plan_id, 'price' => $price,'duration' => $day);
		}
				
		$this->response_status = '1';
		// generate the service / api response
		$this->response_message = $plan_list_array;
		$this->json_output($response_data);
	}

	public function send_to_stripe(Request $request)
    {
        $response_data=array();
        $this->validate_parameter(1);

        $user_id = $this->logged_user_no;
        $plan_id = $request->input('plan_id');
		$duration = $request->input('duration');
		if($duration==1)
		{
			$duration_in_month = 1;
			$duration_in_day = 30;
		}
		else
		{
			$duration_in_month = 12;
			$duration_in_day = 365;
		}

		//user details
        $user_condition = array(
            array('id','=',$user_id),
		);

		
		$selectFields = array('name','email');
		$user = $this->common_model->fetchData($this->tableObj->tableNameUser, $user_condition, $selectFields);

		//plan details
		$planCondition = array(
            array('plan_id','=',$plan_id),
		);

		
		$selectFields = array();
		$plan = $this->common_model->fetchData($this->tableObj->tableNamePlan, $planCondition, $selectFields);

		$parameter = array(
			'user_id' => $user_id,
			'user_name' => $user->name,
			'user_email' => $user->email,
			'plan_id' => $plan->plan_id,
			'plan_name' => $plan->plan_name,
			'duration_in_day' => $duration_in_day,
			'duration_in_month' => $duration_in_month,
			'plan_price' => $plan->price,
			'payble_amount' => $plan->price*$duration_in_month
        );

		$parameter= Crypt::encrypt($parameter);
		$url = url('/make-payment',$parameter); 
						
		$this->response_status = '1';
		// generate the service / api response
		$this->response_message = $url;
		$this->json_output($response_data);
	}

	
	

}