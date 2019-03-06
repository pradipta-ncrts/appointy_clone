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

		/*$prof_conditions = array(
            array('is_deleted','=','0'),
        );
		$prof_data = $this->common_model->fetchDatas($this->tableObj->tableNameProfession, $prof_conditions);*/
		
		$find_query = "SELECT * FROM `squ_profession` WHERE (`squ_profession`.`created_by` = '".$user_no."' OR `squ_profession`.`created_by` = 0) AND `squ_profession`.`is_deleted` = 0 AND `squ_profession`.`is_blocked` = 0";
		$prof_data = $this->common_model->customQuery($find_query,$query_type=1);
		
		
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

		//Notification Update start
		$notification_data['update_message'] = "You have successfully updeted your profile.";
		$notification_data['user_id'] = $user_no;

		$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
		//Notification Update End
		
		$user_type = $request->input('user_type');
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
			'business_name' => $name
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

		$main_url = $request->input('main_url');
		$post_url = $request->input('profile_url');
		$post_url = $main_url.$post_url;

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

			//Notification Update start
			$notification_data['update_message'] = "Successfully updated profile picture.";
			$notification_data['user_id'] = $user_no;

			$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
			//Notification Update End
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
		$days_array = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','7'=>'Sunday');
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		//print_r($request->all()); die();

		$user_no = $authdata['user_no'];

		$service_id = $request->input('service_id');
		$interval_count = $request->input('interval_count'); 
		$is_unavailable = $request->input('is_unavailable'); 
		$date_range_type = $request->input('date_range_type'); 
		$date_range_data = $request->input('date_range_data'); 
		$rolling_day_data = $request->input('rolling_day_data'); 
		$selected_dates = $request->input('selected_dates');
		$interval_from = $request->input('interval_from'); 
		$interval_to = $request->input('interval_to'); 
		$multiple_preference = $request->input('multiple_preference'); 
		$available_days = $request->input('available_days');
		$apply_day = $request->input('apply_day');
		$from_submit = $request->input('from_submit');
		
		$day = array_search($apply_day, $days_array);
		if($from_submit == 1){
			
			if($date_range_type == 1){
				$start_date = date('Y-m-d', strtotime("+1 day"));
				$end_date = date('Y-m-d', strtotime("+".$rolling_day_data." day"));
			} else if($date_range_type == 2){
				$result = explode(' - ',$date_range_data);
				$start_date = date('Y-m-d', strtotime($result[0]));
				$end_date = date('Y-m-d', strtotime($result[1]));
			} else {
				$start_date = date('Y-m-d');
				$end_date = "";
			}
		} else if($from_submit == 2){
			$start_date = date('Y-m-d', strtotime($apply_day));
			$end_date = date('Y-m-d', strtotime($apply_day));
		} 

		//echo $start_date; exit;
		
		$insert_data = array();
		if($is_unavailable == 0){
			if($from_submit == 1 || $from_submit == 2){
				for($i=0;$i<=$interval_count;$i++){
					$insert_data[] = array(
						'service_id' => $service_id,
						'user_id' => $user_no,
						'day' => $day,
						'start_time' => $interval_from[$i],
						'end_time' => $interval_to[$i],
						'start_date' => $start_date,
						'end_date' => $end_date,
						'created_on' => date('Y-m-d H:i:s')
					);
				} 
			} else {
				if($multiple_preference == 1){
					$date_array = explode(',',$selected_dates);
					for($j=0;$j<count($date_array);$j++){
						for($i=0;$i<=$interval_count;$i++){
							$insert_data[] = array(
								'service_id' => $service_id,
								'user_id' => $user_no,
								'day' => array_search(date('l', strtotime($date_array[$j])), $days_array),
								'start_time' => $interval_from[$i],
								'end_time' => $interval_to[$i],
								'start_date' => date('Y-m-d', strtotime($date_array[$j])),
								'end_date' => date('Y-m-d', strtotime($date_array[$j])),
								'created_on' => date('Y-m-d H:i:s')
							);
						} 
					}
				} else {
					if($date_range_type == 1){
						$start_date = date('Y-m-d', strtotime("+1 day"));
						$end_date = date('Y-m-d', strtotime("+".$rolling_day_data." day"));
					} else if($date_range_type == 2){
						$result = explode(' - ',$date_range_data);
						$start_date = date('Y-m-d', strtotime($result[0]));
						$end_date = date('Y-m-d', strtotime($result[1]));
					} else {
						$start_date = date('Y-m-d');
						$end_date = "";
					}
	
					for($j=0;$j<count($available_days);$j++){
						for($i=0;$i<=$interval_count;$i++){
							$insert_data[] = array(
								'service_id' => $service_id,
								'user_id' => $user_no,
								'day' => $available_days[$j],
								'start_time' => $interval_from[$i],
								'end_time' => $interval_to[$i],
								'start_date' => $start_date,
								'end_date' => $end_date,
								'created_on' => date('Y-m-d H:i:s')
							);
						}
					}
				}
			}

			//print_r($insert_data); die();
			if(!empty($insert_data)){
				$insertdata = $this->common_model->insert_data($this->tableObj->tableNameServiceAvailability,$insert_data);
			}
		}
		
		
        $response_data['response_status'] ='1';
        $response_data['message'] = "Service availability updated successfully.";

        $this->json_output($response_data);
	}


	public function change_email(Request $request)
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

		$email = $request->input('email');

		$query = "SELECT * FROM `squ_user` WHERE `email` = '".$email."' AND `id` NOT IN ('".$user_no."')";
		$check_email = $this->common_model->customQuery($query,$query_type=1); 
		
		if(empty($check_email))
		{
			$param = array(
					'email' => $email,
			);

			$updateCond=array(
							array('id','=',$user_no)
						);

			$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$param);

			$this->response_status = '1';
			$this->response_message = "Successfully updated.";
		}
		else
		{
			$this->response_message = "This email already register.";
		}
		
		$this->json_output($response_data);
	}

}