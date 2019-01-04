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

	public function profile_payment(Request $request)
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
			'payment_mode' => $name = $request->input('payment_mode'),
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

	public function profile_url(Request $request)
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

		$condition = array(
                        array('id','=',$user_no),
                    );
		$selectFields = array('username');
        $user_details = $this->common_model->fetchData($this->tableObj->tableNameUser,$condition,$selectFields);
		
		$prev_url = url('business-provider').'/'.$user_details->username;

		$post_url = $request->input('profile_url');

		if($prev_url==$post_url)
		{
			$this->response_status='1';
			$this->response_message="Successfully updated.";
		}
		else
		{
			$this->response_message="Please enter valid profile url";
		}

		$this->json_output($response_data);
	}

	public function profile_personal_image(Request $request)
	{
		$response_data=array();
		$this->validate_parameter(1);

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}

        if($request->file('profile_perosonal_image'))
        {
			$image = $request->file('profile_perosonal_image');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/image/profile_perosonal_image');
			$image->move($destinationPath, $name);
			$profile_perosonal_image = $name;
        }
        else
        {
        	$profile_perosonal_image = $request->input('old_profile_perosonal_image');
        }


		$updateData = array(
				'profile_perosonal_image' => $profile_perosonal_image,
		);

		$updateCond=array(
						array('id','=',$user_no)
					);

		$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Successfully update.";

		$this->json_output($response_data);
	}

	public function change_password(Request $request)
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

		$old_password = $request->input('old_password');
		$new_passord = $request->input('new_passord');
		$new_confirm_passord = $request->input('new_confirm_passord');
		if($new_passord==$new_confirm_passord)
		{
			$condition = array(
                    array('id','=',$user_no),
                    array('password','=',md5($old_password)),
                );
			$selectFields = array('password');
	        $old_password = $this->common_model->fetchData($this->tableObj->tableNameUser,$condition,$selectFields);
	        if(!empty($old_password))
	        {
	        	$updateData = array(
						'password' => md5($new_passord),
				);

				$updateCond=array(
								array('id','=',$user_no)
							);

				$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);

				$this->response_status='1';
				$this->response_message="Successfully updated.";
	        }
	        else
	        {
	        	$this->response_message="Old password mismatch.";
	        }
		}
		else
		{
			$this->response_message="New password & confirm password mismatch.";
		}
		
		$this->json_output($response_data);
	}

	public function update_profile_mobile(Request $request)
    {
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		$user_no = $authdata['user_no'];

        $profile_name = $request->input('profile_name');
        $profile_profession = $request->input('profile_profession');
        $business_location = $request->input('business_location');
        $business_description = $request->input('business_description');
        $expertise = $request->input('expertise');
        $transport = $request->input('transport');
        $presentation = $request->input('presentation');
        $parking = $request->input('parking');
        $payment_mode = $request->input('payment_mode');
               
        if($request->file('profile_perosonal_image'))
        {
			$image = $request->file('profile_perosonal_image');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/image/profile_perosonal_image');
			$image->move($destinationPath, $name);
			$profile_perosonal_image = $name;

			$profile_data['profile_perosonal_image'] = $profile_perosonal_image;
        }
        

        $profile_data['name'] = $profile_name;
        $profile_data['profession'] = $profile_profession;
        $profile_data['business_location'] = $business_location;
        $profile_data['payment_mode'] = $payment_mode;
        $profile_data['business_description'] = $business_description;
        $profile_data['presentation'] = $presentation;
        $profile_data['expertise'] = $expertise;
        $profile_data['transport'] = $transport;
        $profile_data['parking'] = $parking;
        
        $findCond = array(
			array('id', '=', $user_no),
		);

        $update = $this->common_model->update_data($this->tableObj->tableNameUser,$findCond,$profile_data);

        $response_data['response_status'] ='1';
        $response_data['response_message'] = "Staff successfully added.";

        $this->json_output($response_data);
	}

	public function update_service_availability(Request $request)
    {
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		print_r($request->all()); die();

		$user_no = $authdata['user_no'];

        $profile_name = $request->input('profile_name');
        $profile_profession = $request->input('profile_profession');
        $business_location = $request->input('business_location');
        $business_description = $request->input('business_description');
        $expertise = $request->input('expertise');
        $transport = $request->input('transport');
        $presentation = $request->input('presentation');
        $parking = $request->input('parking');
        $payment_mode = $request->input('payment_mode');
               
   
        $response_data['response_status'] ='1';
        $response_data['response_message'] = "Staff successfully added.";

        $this->json_output($response_data);
	}

	
	

}