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

class ProfileController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}

	// User's service Listing //
    public function profile_settings(Request $request)
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
            array('id','=',$user_no),
			array('is_deleted','=','0'),
		);

		
		$selectFields = array();
		
		$user_details = $this->common_model->fetchData($this->tableObj->tableNameUser, $findCond, $selectFields);

		$prof_conditions = array(
            array('is_deleted','=','0'),
        );
        $prof_data = $this->common_model->fetchDatas($this->tableObj->tableNameProfession, $prof_conditions);
		
		$response_data['user_details'] = $user_details;
		$response_data['profession'] = $prof_data;
		
		$this->response_status = '1';
		// generate the service / api response
		$this->json_output($response_data);
	}

	// User's service Listing //
    public function update_profile_settings(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}
		
		$name = $request->input('profile_name');
		$profession = $request->input('profile_profession');
		$presentation = $request->input('presentation');
		$expertise = $request->input('expertise');
		$branding = $request->input('branding');


		$param = array(
			'name' => $name,
			'profession' => $profession,
			'presentation' => $presentation,
			'expertise' => $expertise,
			'branding' => $branding,
		);
		//now update service status 
		$findCond = array(
			array('id', '=', $user_no),
		);
		
		$this->common_model->update_data($this->tableObj->tableNameUser,$findCond,$param);

		$this->response_status='1';
		$this->response_message="Successfully updated.";

		$this->json_output($response_data);

	}

	
	public function delete_account(Request $request)
	{
		$response_data=array();
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}
		
		$param = array(
			'status' => '1',
		);
		//now update service status 
		$findCond = array(
			array('id', '=', $user_no),
		);
		
		$this->common_model->update_data($this->tableObj->tableNameUser,$findCond,$param);

		$this->response_status='1';
		$this->response_message="Successfully deleted.";

		$this->json_output($response_data);

	}

}