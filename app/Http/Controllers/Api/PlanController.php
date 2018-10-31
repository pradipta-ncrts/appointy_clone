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
		
		$response_data['plan_list'] = $plan_list;
		
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
	

}