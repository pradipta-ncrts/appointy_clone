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
use Excel;

class UsersController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}


	//***** User Login *****//
	public function login(Request $request)
	{
		$response_data=array();
		// validated the parameters
		$validator = Validator::make($request->all(), [
			'email' => 'bail|required',
			'password' => 'bail|required',
		]);
		if(!$validator->fails())
		{
			//validate the user details

			$table_name = $this->tableObj->tableNameUser;
			$password = $request->input('password');
			$email = $request->input('email');
			$conditions = array(
				array('password','=',md5($password)),
				array('is_deleted','=',0),
				'or'=>array('email'=>$email,'username'=>$email)
			);
			$selectFields=array('id','email','user_type','is_email_verified','created_on','is_deleted','is_blocked');
			$user = $this->common_model->fetchData($table_name,$conditions,$selectFields);
			if(empty($user))
			{
				$this->response_message="Email/Username and password does not match.";
			}
			else
			{

				$service_conditions = array(
						array('user_id', '=', $user->id),
				);
				$service = $this->common_model->fetchDatas($this->tableObj->tableUserService,$service_conditions,$selectFields=array());
				//check user complete registration step2 or not
				if(empty($service))
				{
					setcookie('new_email', $email, time() + (86400 * 30), "/");
					$response_data['enc_email'] = Crypt::encrypt($user->email);
					$this->response_status='1';
					$this->response_message = "complete_step_two";
				}
				else
				{
					//echo '<pre>'; print_r($user); exit;
					$is_blocked = $user->is_blocked;
					if($is_blocked == 0)
					{
						$created_on = strtotime($user->created_on);
						//checked is the email is verified or not 
						if($user->is_email_verified == 0 || $user->is_email_verified == 1)
						{
							//If user is registered within 3days
							/*if(($created_on + (72*3600)) >= time() )
							{*/
								// create the user request key for validating the farther request of the user
								$this->logged_user_no = $user->id;
								$user_request_key = $this->generate_request_key();
								$user_details['user_no']=$this->logged_user_no;
								$user_details['user_type']=$user->user_type;
								$user_details['user_request_key']=$user_request_key;
								//$user_details['is_basic_data_saved']=$user->is_basic_data_saved;
								$response_data['user']=$user_details;
								$this->response_status='1';
							/*}
							else
							{
								$this->response_message="email_need_to_verify_for_login";
							}*/
						}
						else
						{
							$this->logged_user_no = $user->user_no;
							$user_request_key = $this->generate_request_key();
							$user_details['user_no']=$this->logged_user_no;
							$user_details['user_type']=$user->user_type;
							$user_details['user_request_key']=$user_request_key;
							//$user_details['is_basic_data_saved']=$user->is_basic_data_saved;
							$response_data['user']=$user_details;
							$this->response_status='1';
						}
					}
					else
					{
						$this->response_message="account_blocked";
					}
				}
			}
		}
		else
		{
			// if parameter validation checked faild
			$errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
		}
		// generate the service / api response
		$this->json_output($response_data);
	}


	//***** Staff Login *****//
	public function staff_login(Request $request)
	{
		$response_data=array();
		// validated the parameters
		$validator = Validator::make($request->all(), [
			'email' => 'bail|required',
			'password' => 'bail|required',
		]);
		if(!$validator->fails())
		{
			//validate the user details

			$table_name = $this->tableObj->tableNameStaff;
			$password = $request->input('password');
			$email = $request->input('email');
			$conditions = array(
				array('password','=',md5($password)),
				array('is_deleted', '=', 0),
				'or'=>array('email'=>$email,'username'=>$email)
			);
			$selectFields=array();
			$user = $this->common_model->fetchData($table_name,$conditions,$selectFields);
			if(empty($user))
			{
				$this->response_message="Email/Username and password does not match.";
			}
			else
			{
				//echo '<pre>'; print_r($user); exit;
				$is_blocked = $user->is_blocked;
				if($is_blocked == 0)
				{
					$created_on = strtotime($user->created_on);
					//checked is the email is verified or not 
					if($user->is_email_verified == 0 || $user->is_email_verified == 1)
					{
						//If user is registered within 3days
						/*if(($created_on + (72*3600)) >= time() )
						{*/
							// create the user request key for validating the farther request of the user
							$this->logged_user_no = $user->staff_id;
							$user_request_key = $this->generate_request_key();
							$user_details['user_no']=$this->logged_user_no;
							$user_details['user_type']='Staff';
							$user_details['user_request_key']=$user_request_key;
							//$user_details['is_basic_data_saved']=$user->is_basic_data_saved;
							$response_data['user']=$user_details;
							$this->response_status='1';
						/*}
						else
						{
							$this->response_message="email_need_to_verify_for_login";
						}*/
					}
					else
					{
						$this->logged_user_no = $user->staff_id;
						$user_request_key = $this->generate_request_key();
						$user_details['user_no']=$this->logged_user_no;
						$user_details['user_type']='Staff';
						$user_details['user_request_key']=$user_request_key;
						//$user_details['is_basic_data_saved']=$user->is_basic_data_saved;
						$response_data['user']=$user_details;
						$this->response_status='1';
					}
				}
				else
				{
					$this->response_message="account_blocked";
				}
			}
		}
		else
		{
			// if parameter validation checked faild
			$errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
		}
		// generate the service / api response
		$this->json_output($response_data);
	}

	/***Login ***/
	public function logout(Request $request)
	{
		//echo "+++++++++";
		//echo '<pre>'; print_r($request->all()); die();
		$response_data=array();
		// validate the requested param for access this service api
		$this->validate_parameter(1);
		// now remove the request key 
		$user_no = $request->input('user_no');
		$user_request_key = $request->input('user_request_key');
		$deleteConds=array(
			array('request_key','=',$user_request_key),
			array('user_id','=',$user_no),
		);

		/*$deleteConds=array(
			array('request_key','=',$this->user_request_key),
			array('user_id','=',$this->logged_user_no),
		);*/

		
		$this->common_model->removeDatas($this->tableObj->tableNameUserRequestKey,$deleteConds);
		//remove all the cookies 
		$this->remove_all_cookies();
		$this->response_status=1;
		// generate the service / api response
		$this->json_output($response_data);
	}

	/**** Change Password******/

	public function forgotpassword(Request $request){
		$response_data=array();
		// validated the parameters
		$validator = Validator::make($request->all(), [
            'email' => 'required|email'
            ]
		);

        if ($validator->fails()) {
			// if parameter validation checked faild
            $errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
        } else {
			// all validations are passed
			$email = $request->input('email');
			// find the email in the user table
			$findCond=array(
				array('email','=',$email),
				array('is_email_verified','=','1'),
			);

			$findCond = $this->set_common_param_for_fetch($findCond);
			$selectFileds=array('user_no','email','username','first_name');
			$user = $this->common_model->fetchData($this->tableObj->tableNameUser,$findCond,$selectFileds);
			if(empty($user)){
				$this->response_message="email_not_registered";
			}
			else{
				// create the token 
				$email = $user->email;
				$username = $user->username;
				$user_no = $user->user_no;
				$token1 = md5($email);
				$token2 = md5($username.$user_no);
				$token = $token1.$token2;
				// insert the data 
				$saveData=array(
					'user_no'=>$user_no,
					'token'=>$token,
				);

				$saveData =  array_merge($saveData,$this->set_common_param_for_saving());
				$save_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameForgotPassword,$saveData);
				if($save_id>0){
					// send mail 

					$verify_link = $this->base_url('retrieve-password/'.$token); //need to change the link with website
					$emailData['verify_link']=$verify_link;
					$emailData['toName']=$user->first_name;
					$this->sendmail(2,$email,$emailData);
					$this->response_message="reset_password_link_sent";
					$this->response_status='1';
				}
				else{
					$this->response_message="data_saving_error";
				}
			}
		}
		// generate the service / api response
		$this->json_output($response_data);
	}


	/**** Reset Password *****/

	public function resetpassword($verify_token=''){
		$response_data=array();
		if(!empty($verify_token)){
			// validate the user verify token
			$findCond=array(
				array('token','=',$verify_token),
			);
			$findCond = $this->set_common_param_for_fetch($findCond);
			$select_fields=array('forgot_password_no','user_no');
			$joins=array(
				array(
					'join_type'=>'inner',
					'join_with'=>$this->tableObj->tableNameForgotPassword,
					'join_table'=>$this->tableObj->tableNameUser,
					'join_on'=>array('user_no','=','user_no'),
					'join_conditions'=>array(
						array('is_email_verified','=','1'),
						array('is_deleted','=','0'),
					),
					'select_fields'=>array('email','first_name')
				)
			);
			$user = $this->common_model->fetchData($this->tableObj->tableNameForgotPassword,$findCond,$select_fields,$joins);
			if(empty($user)){
				$this->response_message="reset_password_link_invalid";
			}
			else{
				// validation for password format
				$validator = Validator::make($this->postParam->all(),
					[
						'password' => 'bail|required|min:8|regex:/[A-Z]+/|regex:/[0-1]+/|regex:/[*@&%!#$]+/',
				]);

				if(!$validator->fails()){
					//print_r($user);
					$password = $this->postParam->input('password');
					$user_no = $user->user_no;
					$email = $user->email;
					$forgot_password_no = $user->forgot_password_no;
					//now update the new password 
					$updateData=array(
						'password'=>md5($password),
						'updated_on'=>$this->date_format
					);
					$updateCond=array(
						array('user_no','=',$user_no)
					);
					$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);
					// remove the password token 
					$findCond[]=array('forgot_password_no','=',$forgot_password_no);
					$this->common_model->removeDatas($this->tableObj->tableNameForgotPassword,$findCond);
					// now send email for password changed 
					$this->sendmail(3,$email,array('toName'=>$user->first_name));
					$this->response_message="password_reset_successfully";
					$this->response_status='1';
				}
				else{
					$errors = $validator->errors()->messages();
					$this->response_message = $this->forErrorMessage($errors);
				}
			}
		}
		else{
			$this->response_message="reset_password_link_invalid";
		}
		// generate the service / api response
		$this->json_output($response_data);
	}

	

	/**** Change Password *****/

	public function changepssword(Request $request)
	{
		$response_data=array();
		// validate the requested param for access this service api
		// all validations are passed
		$this->validate_parameter(1); 
		$user_no = $this->logged_user_no; 
		//print_r($request->all()); die();
		$old_password = $request->input('old_passsword');
		$password = $request->input('new_password');
		// find the user password 
		$findCond=array(
			array('password','=',md5($old_password)),
			array('id','=',$user_no),
		);
		//$select_fields=array('user_no','email','first_name');
		$user = $this->common_model->fetchData($this->tableObj->tableNameUser,$findCond);
		if(empty($user))
		{
			$this->response_message="Old password not matched";
		}
		else
		{
			// now update the password with new one
			$updateData=array(
				'password'=>md5($password),
				'updated_on'=>$this->date_format
			);
			$updateCond=array(
				array('id','=',$user_no)
			);
			$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);
			// send mail
			//$email = $user->email;
			//$this->sendmail(4,$email,array('toName'=>$user->first_name));
			// update your password 
			$this->response_message="Password change successfully";
			$this->response_status='1';
		}
		
		// generate the service / api response
		$this->json_output($response_data);
	}


	/**** Registration Process Step One****/
	public function registration_step1(Request $request)
	{
		$response_data=array();
		//validation section 
		$validator = Validator::make($this->postParam->all(),
			[
				'full_name' => 'bail|required',
				'user_name' => 'bail|required',
				'password' => 'bail|required|min:8',
				'phone' => 'bail|required',
				'profession' => 'bail|required',
				'country' => 'bail|required',
				
		]);

		if(!$validator->fails())
		{
			$full_name = $request->input('full_name');
			$user_type = $request->input('user_type');
			$username = $request->input('user_name');
			$password = $request->input('password');
			$country_code = $request->input('country_code');
			$mobile = $country_code.$request->input('phone');
			$profession = $request->input('profession');
			$country = $request->input('country');  
			$request_url = $request->input('request_url');
			$email = Crypt::decrypt($request_url);

			$api_key = $this->getToken(24);

			//Check duplicate email id
			$condition = array(
                      'or' => array('email'=>$email,'username'=>$username)
                    );
        	$checkEmail = $this->common_model->fetchData('user',$condition);

        	if(empty($checkEmail))
        	{
        		//check profession 
        		$profession_condition = array(
								array('profession', '=', $profession), 
								array('is_blocked', '=', '0'),
							);
				$check_profession = $this->common_model->fetchData($this->tableObj->tableNameProfession, $profession_condition);
				if(!empty($check_profession))
				{
					$profession = $check_profession->profession_id;
				}
				else
				{
					$profession_param = array('profession' => $profession, 'is_blocked' => '1');
					$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameProfession, $profession_param);
					$profession = $profession_id;
				}

				$param = array(
						'name' => $full_name,
						'api_key' => $api_key,
						'user_type' => $user_type,
						'username' => $username,
						'password' => md5($password),
						'mobile' => $mobile,
						'profession' => $profession,
						'country' => $country,
						'is_email_verified' => '1',
						'email' => $email	
				);

				$user_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameUser, $param);
	            if($user_id > 0)
	            {
					// Registered as Stafff //
					$token1 = md5($email);
					$token2 = md5($username);
					$token = $token1.$token2;

					$staff_data['user_id'] = $user_id;
					$staff_data['username'] = $username;
					$staff_data['full_name'] = $full_name;
					$staff_data['email'] = $email;
					$staff_data['mobile'] = $mobile;
					$staff_data['password'] = md5($password);
					$staff_data['email_verification_code'] = $token;
					$staff_data['is_email_verified'] = 1;
					$staff_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaff,$staff_data);
					if($staff_id > 0){

						//if profession new update created by
						$condition = array(
							array('profession_id', '=', $profession),
							array('is_blocked', '=', '1'),
						);
						
						$update_data['created_by'] = $user_id;
	
						$update = $this->common_model->update_data($this->tableObj->tableNameProfession,$condition,$update_data);
	
						$this->response_message = $request_url;
						$this->response_status = '1';

					} else {
						$this->response_message="Somthing wrong.Try again later.";
						$this->response_status='0';
					}

	            }
	            else
	            {
	            	$this->response_message="Somthing wrong.Try again later.";
					$this->response_status='0';
	            }
        	}
        	else
        	{
        		$this->response_message="Email/Username already exist.";
        		$this->response_status='0';
        	}
		}
		else
		{
			$errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
			$this->response_status='0';
		}

		// generate the service / api response
		$this->json_output($response_data);
	}


	public function emailverification($verify_token='')
	{
		$response_data=array();
		$redirectURl = $this->base_url('thank-you');
		if(!empty($verify_token))
		{
			$find_cond=array(
				array('email_verification_code','=',$verify_token),
				array('is_deleted','=','0'),
				array('is_email_verified','=','0')
			);

			$user = $this->common_model->fetchData($this->tableObj->tableNameUser,$find_cond);
			if(empty($user))
			{

				//$message = $this->message_render('email_verification_token_expired');
				//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
				\Session::flash('error_message', "Email verification token expired."); 
                return redirect('/login');
			}
			else
			{
				// create email validation token :: format : md5(email).md5(username.user_no)
				$email = $user->email;
				$username = $user->username;
				$user_no = $user->id;
				$token1 = md5($email);
				$token2 = md5($username.$user_no);
				$token = $token1.$token2;
				$created_on = strtotime($user->created_on);
				// validate the token 
				if($token!=$verify_token){
					//$this->response_message="email_verification_token_invalid";
					//$this->json_output();
					//$message = $this->message_render('email_verification_token_expired');
					//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
					\Session::flash('error_message', "Email verification token expired."); 
                	return redirect('/login');
				}
				else if($created_on + (72*3600) >= time() )
				{
					// do the neccessary work
					$find_cond[]=array('id','=',$user_no);
					// updatedata 
					$updateData=array(
						'is_email_verified'=>'1',
						'updated_on'=>$this->date_format
					);
					$this->common_model->update_data($this->tableObj->tableNameUser,$find_cond,$updateData);
					//$message = $this->message_render('email_verification_success');
					//return redirect($redirectURl)->with('message',['type'=>'success','text'=>$message]);
					\Session::flash('success_message', "Successfully email verified."); 
	     			return redirect('/login');
				} 
				else
				{
					//$message = $this->message_render('email_verification_token_expired');
					//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
					\Session::flash('error_message', "Email verification token expired."); 
                	return redirect('/login');
				}
			}
		}
		else
		{
			\Session::flash('error_message', "Email verification token missing."); 
            return redirect('/login');
			//return redirect($redirectURl)->with('message',['type'=>'error','text'=>"email_verification_token_missing"]);
		}
	}

	/**** Registration Process Step One****/
	public function registration_step2(Request $request)
	{
		$response_data=array();
		$category = $request->input('category');
		$new_category_name = $request->input('new_category_name');
		$service = $request->input('service');
		$cost = $request->input('cost');
		$currency = $request->input('currency');
		$duration = $request->input('duration');
		$custom_duration = $request->input('custom_duration');  
		$capacity = $request->input('capacity'); 
		$request_url = $request->input('request_url');
		$email = Crypt::decrypt($request_url);
		//$email = $_COOKIE['new_email'];

		$emailCodtion = array(
	                     array('email', '=', $email)
	                    );
	    $checkEmail = $this->common_model->fetchData($this->tableObj->tableNameUser,$emailCodtion);
	    if(!empty($checkEmail))
	    {
	    	$count = 0;
		    foreach ($category as $key => $value)
		    {
				$service_link = str_replace("_"," ",$service[$key]).'_'.$count;

		    	if($value=='new')
		    	{
		    		$param = array('category' => $new_category_name[$key], 'created_by' =>$checkEmail->id,'is_blocked' => 1);
		    		$category_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameCategory, $param);
		    	}
		    	else
		    	{
		    		$category_id = $value;
		    	}

		    	if($duration[$key] == "Custom")
		    	{
		    		$duration_new = $custom_duration[$key];
		    	}
		    	else
		    	{
		    		$duration_new = $duration[$key];
		    	}

		    	$param = array(
		    			'user_id' => $checkEmail->id,
						'category_id' => $category_id,
						'service_name' => $service[$key],
						'cost' => $cost[$key],
						'currency_id' => $currency[$key],
						'duration' => $duration_new,
						'capacity' => $capacity[$key],
						'service_link' => $service_link,
				);

		    	//inset into service table
		    	$this->common_model->insert_data_get_id($this->tableObj->tableUserService, $param);
		    	$count++;
		    }
		    //print_r($param); die();	
			$this->response_status='1';
			$this->response_message="Verification link send to your email.";
	    }
	    else
	    {
	    	$this->response_message="Invalid url";
        	$this->response_status='0';
	    }
	   

		// generate the service / api response
		$this->json_output($response_data);
	}

	public function update_contact_info(Request $request)
	{
		$response_data=array();
		$this->validate_parameter(1);

		$business_name = $request->input('business_name');
		$business_location = $request->input('business_location');
		$street_number = $request->input('street_number');
		$route = $request->input('route');
		$city = $request->input('city');
		$state = $request->input('state');
		$mobile = $request->input('mobile');  
		$office_phone = $request->input('office_phone');
		$skype_id = $request->input('skype_id');
		$zip_code = $request->input('zip_code');
		$business_description = $request->input('business_description');
		$transport = $request->input('transport');
		$parking = $request->input('parking');
		

		//find latitute & longitude
		/*$googleKey = 'AIzaSyAgeuUB8s5lliHSAP_GKnXd70XwlAZa4WE'; 
		$search = $business_location;
		$geoData = $this->google_maps_search($search, $googleKey);
		print_r($geoData); die();
		if (!$geoData) {
		    echo "Error: " . $id . "\n";
		    exit;
		}

		$mapData = $this->map_google_search_result($geoData);
		print_r($mapData); die();*/

		//$profession = $request->input('profession');

		//check profession 
		/*$profession_condition = array(
						array('profession', '=', $profession), 
						array('is_blocked', '=', '0'),
					);
		$check_profession = $this->common_model->fetchData($this->tableObj->tableNameProfession, $profession_condition);
		if(!empty($check_profession))
		{
			$profession = $check_profession->profession_id;
		}
		else
		{
			$profession_param = array('profession' => $profession, 'is_blocked' => '1');
			$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameProfession, $profession_param);
			$profession = $profession_id;
		}*/

		//Notification Update start
		$notification_data['update_message'] = "You have successfully updeted your business details.";
		$notification_data['user_id'] = $this->logged_user_no;

		$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
		//Notification Update End

		$updateData = array(
				'business_name' => $business_name,
				'business_location' => $business_location,
				'street_number' => $street_number,
				'route' => $route,
				'city' => $city,
				'state' => $state,
				'mobile' => $mobile,
				'transport' => $transport,
				'parking' => $parking,
				'office_phone' => $office_phone,
				'skype_id' => $skype_id,
				'zip_code' => $zip_code,
				'business_description' => $business_description,
		);

		$user_no = $_COOKIE['sqd_user_no'];

		$updateCond=array(
						array('id','=',$user_no)
					);

		$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Business contact info updated successfully.";

		$this->json_output($response_data);
	}

	public function update_logo_social(Request $request)
	{
		$response_data=array();
		$this->validate_parameter(1);

		$facebook_link = $request->input('facebook_link');
		$twitter_link = $request->input('twitter_link');
		$linked_in_link = $request->input('linked_in_link');
		$user_wesite_link = $request->input('user_wesite_link');
		if($request->file('profile_image'))
        {
			$image = $request->file('profile_image');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/image/profile_image');
			$image->move($destinationPath, $name);
			$profile_image = $name;
        }
        else
        {
        	$profile_image = $request->input('old_profile_image');
        }

        if($request->file('timeline_image'))
        {
			$image = $request->file('timeline_image');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/image/timeline_image');
			$image->move($destinationPath, $name);
			$timeline_image = $name;
        }
        else
        {
        	$timeline_image = $request->input('old_timeline_image');
        }

        //Notification Update start
		$notification_data['update_message'] = "You have successfully updeted your social information.";
		$notification_data['user_id'] = $this->logged_user_no;

		$profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
		//Notification Update End


		$updateData = array(
				'facebook_link' => $facebook_link,
				'twitter_link' => $twitter_link,
				'linked_in_link' => $linked_in_link,
				'user_wesite_link' => $user_wesite_link,
				'profile_image' => $profile_image,
				'timeline_image' => $timeline_image,
		);

		$user_no = $_COOKIE['sqd_user_no'];

		$updateCond=array(
						array('id','=',$user_no)
					);

		$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Social info updated successfully.";

		$this->json_output($response_data);
	}


	public function dashboard(Request $request)
	{
		$response_data=array();
		$this->validate_parameter(1);

		$user_id = $this->logged_user_no;

		$duration = $request->input('duration');
		//$type = $request->input('type');
		$total_appointments = 0;
		$total_sales = 0;
		$total_customers = 0;
		$appointments_difference = 0;
		$sales_difference = 0;
		$customers_difference = 0;

		$find_cond=array(
			array('user_id','=',$user_id),
			array('is_deleted','=','0')
		);

		$dashboard_reports = $this->common_model->fetchDatas($this->tableObj->tableNameUserDashboardReport,$find_cond);
		if(!empty($dashboard_reports))
		{
			$start = date('Y-m-01 00:00:00');
			$finish = date('Y-m-t 00:00:00');
			$prev_start = date('Y-m-d H:i:s',strtotime('first day of last month'));
			$prev_finish = date('Y-m-d H:i:s',strtotime('last day of last month'));
	
			if($duration == '1'){
				// This Week //
				$start = (date('D') != 'Mon') ? date('Y-m-d H:i:s', strtotime('last Monday')) : date('Y-m-d H:i:s');
				$finish = (date('D') != 'Sun') ? date('Y-m-d H:i:s', strtotime('next Sunday')) : date('Y-m-d H:i:s');
				//Prev Week//
				$previous_week = strtotime("-1 week +1 day");
				$start_week = strtotime("last monday midnight",$previous_week);
				$end_week = strtotime("next sunday",$start_week);
				$prev_start = date("Y-m-d H:i:s",$start_week);
				$prev_finish = date("Y-m-d H:i:s",$end_week);
			} else if($duration == '2'){
				// Previous Week //
				$previous_week = strtotime("-1 week +1 day");
				$start_week = strtotime("last monday midnight",$previous_week);
				$end_week = strtotime("next sunday",$start_week);
				$start = date("Y-m-d H:i:s",$start_week);
				$finish = date("Y-m-d H:i:s",$end_week);
				//Prev Week//
				$prev_previous_week = strtotime("-2 week +1 day");
				$prev_start_week = strtotime("last monday midnight",$prev_previous_week);
				$prev_end_week = strtotime("next sunday",$prev_start_week);
				$prev_start = date("Y-m-d H:i:s",$prev_start_week);
				$prev_finish = date("Y-m-d H:i:s",$prev_end_week);
			} else if($duration == '3'){
				// This Month
				$start = date('Y-m-01 00:00:00');
				$finish = date('Y-m-t 00:00:00');
				//Prev Month//
				$prev_start = date('Y-m-d H:i:s',strtotime('first day of last month'));
				$prev_finish = date('Y-m-d H:i:s',strtotime('last day of last month'));
			} else if($duration == '4'){
				// Previous Month
				$start = date('Y-m-d H:i:s',strtotime('first day of last month'));
				$finish = date('Y-m-d H:i:s',strtotime('last day of last month'));
				//Prev Month//
				$prev_start = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-2, 1));
				$prev_finish = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 0));
			} else if($duration == '5'){
				// This Year
				$start = date('Y-01-01 00:00:00');
				$finish = date('Y-12-31 00:00:00');
				//Prev Year//
				$prev_start = date("Y-m-d H:i:s",strtotime("last year January 1st"));
				$prev_finish = date("Y-m-d H:i:s",strtotime("last year December 31st"));
			} else if($duration == '6'){
				// Previous Year
				$start = date("Y-m-d H:i:s",strtotime("last year January 1st"));
				$finish = date("Y-m-d H:i:s",strtotime("last year December 31st"));
				//Prev Year//
				$year = date('Y') - 2; // Get current year and subtract 1
				$prev_start = date("Y-m-d H:i:s",strtotime("January 1st, ".$year));
				$prev_finish = date("Y-m-d H:i:s",strtotime("December 31st, ".$year));
			}
			
			$duration_query = " AND created_on >= '".$start."' AND created_on <= '".$finish."'";
			$prev_duration_query = " AND created_on >= '".$prev_start."' AND created_on <= '".$prev_finish."'";

			
			foreach($dashboard_reports as $report){
				if($report->report_id == '1'){
					// Total Appointments //
					$appointments_query = "SELECT COUNT(*) AS total_appointments FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$duration_query;
					$appointments = $this->common_model->customQuery($appointments_query,$query_type=1);
					$total_appointments = $appointments[0]->total_appointments;

					$prev_appointments_query = "SELECT COUNT(*) AS prev_total_appointments FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$prev_duration_query;
					$prev_appointments = $this->common_model->customQuery($prev_appointments_query,$query_type=1);
					$prev_total_appointments = $prev_appointments[0]->prev_total_appointments;

					if($prev_total_appointments > 0){
						$appointments_difference = round(($total_appointments - $prev_total_appointments) / $prev_total_appointments) * 100;			
					} else {
						$appointments_difference = round($total_appointments - $prev_total_appointments) * 100;
					}
				} else if($report->report_id == '2') {
					// Total Sales //
					$sales_query = "SELECT IFNULL(SUM(paid_amount),0) AS total_sales FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$duration_query;
					$sales = $this->common_model->customQuery($sales_query,$query_type=1);
					$total_sales = $sales[0]->total_sales;

					$prev_sales_query = "SELECT IFNULL(SUM(paid_amount),0) AS prev_total_sales FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$prev_duration_query;
					$prev_sales = $this->common_model->customQuery($prev_sales_query,$query_type=1);
					$prev_total_sales = $prev_sales[0]->prev_total_sales;

					if($prev_total_sales > 0){
						$sales_difference = round(($total_sales - $prev_total_sales) / $prev_total_sales) * 100;			
					} else {
						$sales_difference = round(($total_sales - $prev_total_sales)) * 100;			
					}

				} else if($report->report_id == '3') {
					// Total Customers //
					$customers_query = "SELECT COUNT(*) AS total_customers FROM `squ_client` WHERE `squ_client`.`user_id` = '".$user_id."' AND `squ_client`.`is_deleted` = 0 ".$duration_query;
					$customers = $this->common_model->customQuery($customers_query,$query_type=1);
					$total_customers = $customers[0]->total_customers;

					$prev_customers_query = "SELECT COUNT(*) AS prev_total_customers FROM `squ_client` WHERE `squ_client`.`user_id` = '".$user_id."' AND `squ_client`.`is_deleted` = 0 ".$prev_duration_query;
					$prev_customers = $this->common_model->customQuery($prev_customers_query,$query_type=1);
					$prev_total_customers = $prev_customers[0]->prev_total_customers;

					if($prev_total_customers > 0){
						$customers_difference = round(($total_customers - $prev_total_customers) / $prev_total_customers) * 100;
					} else {
						$customers_difference = round(($total_customers - $prev_total_customers)) * 100;
					}

				} else if($report->report_id == '4') {

				} else if($report->report_id == '5') {

				} else if($report->report_id == '6') {

				}
			}
		}
		else
		{

		}
		

		// All Appointments //
		/*$appointmentsQuery = "SELECT date(`squ_appointment`.`date`) as date, COUNT(*) AS appointments FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$duration_query." GROUP BY date(`squ_appointment`.`date`) ORDER BY date(`squ_appointment`.`date`) ASC";
		$appointment_data = $this->common_model->customQuery($appointmentsQuery,$query_type=1);

		// All Sales //
		$salesQuery = "SELECT date(`squ_appointment`.`date`) as date, SUM(paid_amount) AS sales FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_id."' AND `squ_appointment`.`is_deleted` = 0 ".$duration_query." GROUP BY date(`squ_appointment`.`date`) ORDER BY date(`squ_appointment`.`date`) ASC";
		$sales_data = $this->common_model->customQuery($salesQuery,$query_type=1);

		// All CUstomers //
		$customersQuery = "SELECT date(`squ_client`.`created_on`) as date, COUNT(*) AS customers FROM `squ_client` WHERE `squ_client`.`user_id` = '".$user_id."' AND `squ_client`.`is_deleted` = 0 ".$duration_query." GROUP BY date(`squ_client`.`created_on`) ORDER BY date(`squ_client`.`created_on`) ASC";
		$customer_data = $this->common_model->customQuery($customersQuery,$query_type=1);*/
		

		//Service list 
		$servCond = array(
            array('user_id','=',$user_id),
			array('is_deleted','=','0'),
			//array('is_blocked','=','0'),
		);

		$type = $request->input('type'); 
		if($type == "group")
		{
			$servCond[] = array('capacity','>','0');
		}
		if($type == "users")
		{
			$servCond[] = array('capacity','=','0');
		}

		$serviceFields = array();
		$currency_field = array('currency');

		$joins = array(
		             array(
		                'join_table'=>$this->tableObj->tableNameCurrency,
		                //'join_with_alias'=>'userTb',
		                'join_with'=>$this->tableObj->tableUserService,
		                //'join_with_alias'=>'servTb',
		                'join_type'=>'left',
		                'join_on'=>array('currency_id','=','currency_id'),
		                //'join_conditions' => array(array('user_no','=','teacher_user_no')),
		                'select_fields' => $currency_field,
		            ),
        );

		$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $servCond, $serviceFields, $joins, $orderBy=array());
		

		$response_data['total_appointments'] = $total_appointments;
		$response_data['total_sales'] = $total_sales;
		$response_data['total_customers'] = $total_customers;
		$response_data['appointments_difference'] = $appointments_difference;
		$response_data['sales_difference'] = $sales_difference;
		$response_data['customers_difference'] = $customers_difference;
		$response_data['service_list'] = $service_list;
		//$response_data['appointment_data'] = $appointment_data;
		//$response_data['sales_data'] = $sales_data;
		//$response_data['customer_data'] = $customer_data;
		$response_data['dashboard_reports'] = $dashboard_reports;
		$this->response_status = '1';

		$this->json_output($response_data);
	}


	// User's service Listing //
    public function service_list(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$other_user_no = $request->input('other_user_no');
		$search_text = $request->input('staff_search_text');
		$pageNo = $request->input('page_no');
		$pageNo = ($pageNo > 1) ? $pageNo : 1;
		$limit=$this->limit;
		$offset=($pageNo-1)*$limit;

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}
        
		$findCond = array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
			//array('is_blocked','=','0'),
		);
		
		$selectFields = array('category_id');
		$category_select_field = array('category as cat');
		$joins = array(
                    array(
                    'join_table'=>$this->tableObj->tableNameCategory,
                    'join_table_alias'=>'servTb',
                    'join_with'=>$this->tableObj->tableUserService,
                    'join_type'=>'left',
                    'join_on'=>array('category_id','=','category_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $category_select_field,
                ),
            );

		$service_category = $this->common_model->fetchDatas($this->tableObj->tableUserService, $findCond, $selectFields, $joins, $orderBy=array(),$groupBy='category_id');


		//Service list 
		$servCond = array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
			//array('is_blocked','=','0'),
		);

		$type = $request->input('type'); 
		if($type == "group")
		{
			$servCond[] = array('capacity','>','0');
			$servCond[] = array('is_template','=','0');
		}
		if($type == "users")
		{
			$servCond[] = array('capacity','=','0');
			$servCond[] = array('is_template','=','0');
		}
		if($type == "template")
		{
			$servCond[] = array('is_template','=','1');
		}

		$category = $request->input('category'); 
		if(!empty($category))
		{
			$servCond[] = array('category_id','=', $category);
		}

		if(!empty($search_text)){
			$servCond[]=array('service_name','like','%'.$search_text.'%');
		}

		$serviceFields = array();
		$currency_field = array('currency');

		$joins = array(
		             array(
		                'join_table'=>$this->tableObj->tableNameCurrency,
		                //'join_with_alias'=>'userTb',
		                'join_with'=>$this->tableObj->tableUserService,
		                //'join_with_alias'=>'servTb',
		                'join_type'=>'left',
		                'join_on'=>array('currency_id','=','currency_id'),
		                //'join_conditions' => array(array('user_no','=','teacher_user_no')),
		                'select_fields' => $currency_field,
		            ),
        );

		$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $servCond, $serviceFields, $joins, $orderBy=array());

		//user name
		$userField = array('username');
		$userCond = array(
            array('id','=',$user_no),
		);
		
		$user_name = $this->common_model->fetchData($this->tableObj->tableNameUser, $userCond, $userField);

		
		$response_data['category_list'] = $service_category;
		$response_data['service_list'] = $service_list;
		$response_data['user_name'] = $user_name;
		$this->response_status = '1';
		// generate the service / api response
		$this->json_output($response_data);
	}

	// User's service Listing //
    public function chnage_service_status(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$service_id = $request->input('service_id');

		$findCond = array(
            array('service_id','=',$service_id),
		);
		
		$selectFields = array();

		$service_details = $this->common_model->fetchData($this->tableObj->tableUserService, $findCond, $selectFields);

		//now update service status 
		$param = array(
			'is_blocked' => $service_details->is_blocked== '0' ? '1' : '0',
			'updated_on' => $this->date_format
		);
		
		$this->common_model->update_data($this->tableObj->tableUserService,$findCond,$param);

		$this->response_status='1';
		$this->response_message = array('msg' => "Successfully service status updated." , 'status' => $service_details->is_blocked== '0' ? '1' : '0' );;

		$this->json_output($response_data);

	}

	public function country_phone_code(Request $request)
	{
		$response_data=array();

		$country_no = $request->input('data');
		$findCond = array(
            array('country_no','=',$country_no),
		);

		
		$selectFields = array();
		$countryDetails = $this->common_model->fetchData($this->tableObj->tableNameCountry, $findCond, $selectFields);
		$response_data['response_message'] = $countryDetails;
		$this->response_status = '1';
		// generate the service / api response
		$this->json_output($response_data);

	}

	public function clone_service(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$service_id = $request->input('service_id');

		$findCond = array(
            array('service_id','=',$service_id),
		);
		
		$selectFields = array();

		$service_details = $this->common_model->fetchData($this->tableObj->tableUserService, $findCond, $selectFields);

		if(!empty($service_details))
		{
			unset($service_details->service_id);
			unset($service_details->created_on);
			unset($service_details->is_deleted);
			unset($service_details->updated_on);

			$service_details = json_decode(json_encode($service_details), TRUE);

			$param = $service_details;

			$insert = $this->common_model->insert_data_get_id($this->tableObj->tableUserService,$param);
			if($insert)
			{
				$this->response_status = '1';
				$this->response_message="Successfully clone this service.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}

		}
		else
		{
			$this->response_message = "No service avaliabele for clone.";
		}
		
		$this->json_output($response_data);

	}

	public function delete_service(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$user_no = $this->logged_user_no;
		$service_id = $request->input('service_id');

		$findCond = array(
            array('service_id','=',$service_id),
		);

		//now update service status 
		$param = array(
			'is_deleted' => '1',
			'deleted_on' => $this->date_format,
			'updated_on' => $this->date_format
		);
		
		$this->common_model->update_data($this->tableObj->tableUserService,$findCond,$param);

		// Event Viewer //
		$this->add_user_event_viewer($user_no,$type=3);

		$this->response_status='1';
		$this->response_message="Successfully service status updated.";

		$this->json_output($response_data);

	}

	public function service_template(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$user_no = $this->logged_user_no;
		$service_id = $request->input('service_id');

		$findCond = array(
            array('service_id','=',$service_id),
		);

		//now update service status 
		$param = array(
			'is_template' => '1',
			'updated_on' => $this->date_format
		);
		
		$this->common_model->update_data($this->tableObj->tableUserService,$findCond,$param);

		// Event Viewer //
		//$this->add_user_event_viewer($user_no,$type=3);

		$this->response_status='1';
		$this->response_message="Successfully service status updated.";

		$this->json_output($response_data);

	}

	/*public function add_new_service(Request $request)
    {
    	$response_data=array();
		$this->validate_parameter(1);

		$other_user_no = $request->input('other_user_no');

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else
		{
			$user_no = $this->logged_user_no;
		}

		$response_data=array();
		$category = $request->input('service_category');
		$new_category_name = $request->input('new_category_name'); 
		$service = $request->input('service_name');
		$cost = $request->input('service_cost');
		$currency = $request->input('service_currency');
		$duration = $request->input('service_duration');
		$custom_duration = $request->input('custom_duration');  
		$capacity = $request->input('service_capacity');
		$checkGroup = $request->input('checkGroup');
		$update_service_id = $request->input('update_service_id');
		if($checkGroup==1)
		{
			$capacity = $capacity;
		}
		else
		{
			$capacity = 0;
		}

		$user_id = $user_no;

		if($update_service_id)
		{
			if($category=='new')
	    	{
	    		$this->response_message="You can't add new category when update service.";
	    		$this->json_output($response_data);
	    	}
	    	else
	    	{
	    		$updateCond=array(
					array('category_id','=',$category),
					array('is_blocked','=','1'),
				);

	    		$cparam = array(
	    			'category' => $new_category_name,
	    		);

	    		$this->common_model->update_data($this->tableObj->tableNameCategory,$updateCond,$cparam);

	    		$category_id = $category;
	    	}
		}
		else
		{
			if($category=='new')
	    	{
	    		$param = array('category' => $new_category_name, 'is_blocked' => 1);
	    		$category_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameCategory, $param);
	    	}
	    	else
	    	{
	    		$category_id = $category;
	    	}
		}

    	if($duration == "Custom")
    	{
    		$duration_new = $custom_duration;
    	}
    	else
    	{
    		$duration_new = $duration;
    	}

    	$param = array(
    			'user_id' => $user_id,
				'category_id' => $category_id,
				'service_name' => $service,
				'cost' => $cost,
				'currency_id' => $currency,
				'duration' => $duration_new,
				'capacity' => $capacity,
		);

		if($update_service_id)
		{
			$updateCond=array(
				array('service_id','=',$update_service_id),
			);

    		$this->common_model->update_data($this->tableObj->tableUserService,$updateCond,$param);

			// Event Viewer //
			$this->add_user_event_viewer($user_no,$type=2);

    		$this->response_status='1';
			$this->response_message="Successfully service updated.";
		}
		else
		{
			$insert = $this->common_model->insert_data_get_id($this->tableObj->tableUserService, $param);
			if($insert)
			{
				// Event Viewer //
				$this->add_user_event_viewer($user_no,$type=1);

				$this->response_status='1';
				$this->response_message="Successfully service added.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}
		}

		$this->json_output($response_data);

	}*/
	
	public function add_new_service(Request $request){
		$response_data=array();
		$this->validate_parameter(1);
		$user_no = $this->logged_user_no;

		$response_data=array();

		$service_category = $request->input('service_category');
		$service_name = $request->input('service_name');
		$service_location = $request->input('service_location');
		$service_timezone = $request->input('service_timezone');
		$service_display_location = $request->input('service_display_location');
		$service_currency = $request->input('service_currency');
		$service_price = $request->input('service_price');  
		$service_capacity = $request->input('service_capacity');
		$service_description = $request->input('service_description');
		$service_link = $request->input('service_link');
		$service_color = $request->input('service_color');
		$service_type = $request->input('service_type');
		$new_category_name = $request->input('new_category_name');

		if($service_type=='solo')
		{
			$service_capacity = 0;
		}

		if($service_category == 'new'){
			$param = array('category' => $new_category_name, 'created_by' => $user_no);
			$category_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameCategory, $param);
		} else {
			$category_id = $service_category;
		}

		$condition = array(
			array('user_id', '=', $user_no),
			array('service_link', '=', $service_link),
			array('is_blocked', '=', 0),
			array('is_deleted', '=', 0),
		);
		$selectField = array('service_link');
		$check_service_link = $this->common_model->fetchDatas($this->tableObj->tableUserService,$condition,$selectField);
		if(!empty($check_service_link)){
			$this->response_message="Has already been taken.";
		} else {
			$serviceData = array(
    			'user_id' => $user_no,
				'category_id' => $category_id,
				'service_name' => $service_name,
				'cost' => $service_price,
				'currency_id' => $service_currency,
				'timezone' => $service_timezone,
				'location' => $service_location,
				'display_location' => $service_display_location,
				'capacity' => $service_capacity,
				'description' => $service_description,
				'service_link' => $service_link,
				'color' => $service_color,
				'duration' => 15,
			);
			$service_id = $this->common_model->insert_data_get_id($this->tableObj->tableUserService, $serviceData);
			if($service_id > 0)
			{
				$response_data['service_id'] = Crypt::encrypt($service_id);
				$this->response_status='1';
				$this->response_message="Service added successfully.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}

		}	

		$this->json_output($response_data);

	}

	public function service_details(Request $request)
	{
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$service_id = $request->input('service_id');

		$findCond = array(
	        array('service_id','=',$service_id),
		);
		
		$selectFields = array();

		$service_details = $this->common_model->fetchData($this->tableObj->tableUserService, $findCond, $selectFields);

		$catCond = array(
	        array('category_id','=',$service_details->category_id),
		);

		$category = $this->common_model->fetchData($this->tableObj->tableNameCategory, $catCond);

		$response_data['service_details'] = $service_details;
		$response_data['category'] = $category;
		$this->response_status='1';
		$this->response_message="Service Details.";
		

		$this->json_output($response_data);
	}

	public function update_service(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$user_no = $this->logged_user_no;

		$service_id = $request->input('service_id');
		$service_category = $request->input('service_category');
		$service_name = $request->input('service_name');
		$service_timezone = $request->input('service_timezone');
		$service_location = $request->input('service_location');
		$service_display_location = $request->input('service_display_location');
		$service_currency = $request->input('service_currency');
		$service_price = $request->input('service_price');  
		$service_capacity = $request->input('service_capacity');
		$service_description = $request->input('service_description');
		$service_link = $request->input('service_link');
		$service_color = $request->input('service_color');
		$new_category_name = $request->input('new_category_name');

		if($service_category == 'new'){
			$param = array('category' => $new_category_name, 'created_by' => $user_no);
			$category_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameCategory, $param);
		} else {
			$category_id = $service_category;
		}

		$updateData = array(
				'category_id' => $category_id,
				'service_name' => $service_name,
				'cost' => $service_price,
				'currency_id' => $service_currency,
				'timezone' => $service_timezone,
				'location' => $service_location,
				'display_location' => $service_display_location,
				'capacity' => $service_capacity,
				'description' => $service_description,
				'service_link' => $service_link,
				'color' => $service_color,
		);


		$updateCond=array(
						array('service_id','=',$service_id),
						array('is_deleted','=',0)
					);

		$this->common_model->update_data($this->tableObj->tableUserService,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Service updated successfully.";

		$this->json_output($response_data);
	}

	public function update_service_duration(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$service_id = $request->input('service_id');
		$service_duration = $request->input('service_duration');
		$availability_increments = $request->input('availability_increments');
		$max_service = $request->input('max_service');
		$minimum_scheduling_notice = $request->input('minimum_scheduling_notice');
		$buffer_before_service = $request->input('buffer_before_service');
		$buffer_after_service = $request->input('buffer_after_service');
		$is_secret = $request->input('is_secret');

		$updateData = array(
				'duration' => $service_duration,
				'availability_increments' => $availability_increments,
				'max_service' => $max_service,
				'minimum_scheduling_notice' => $minimum_scheduling_notice,
				'buffer_before_service' => $buffer_before_service,
				'buffer_after_service' => $buffer_after_service,
				'is_secret' => $is_secret,
		);


		$updateCond=array(
						array('service_id','=',$service_id),
						array('is_deleted','=',0)
					);

		$this->common_model->update_data($this->tableObj->tableUserService,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Service updated successfully.";

		$this->json_output($response_data);
	}

	public function update_service_payment(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$service_id = $request->input('service_id');
		$payment_method = $request->input('payment_method');

		$updateData = array(
				'payment_method' => $payment_method
		);

		$updateCond=array(
						array('service_id','=',$service_id),
						array('is_deleted','=',0)
					);

		$this->common_model->update_data($this->tableObj->tableUserService,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Service updated successfully.";

		$this->json_output($response_data);
	}

	public function update_service_confirmation(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$service_id = $request->input('service_id');
		$redirect_type = $request->input('redirect_type');
		$display_button_name = $request->input('display_button_name');
		$custom_button_name = $request->input('custom_button_name');
		$custom_url = $request->input('custom_url');
		$redirect_url = $request->input('redirect_url');

		$updateData = array(
				'redirect_type' => $redirect_type,
				'redirect_url' => $redirect_url,
				'display_button_name' => $display_button_name,
				'custom_button_name' => $custom_button_name,
				'custom_url' => $custom_url,
		);

		$updateCond=array(
						array('service_id','=',$service_id),
						array('is_deleted','=',0)
					);

		$this->common_model->update_data($this->tableObj->tableUserService,$updateCond,$updateData);

		$this->response_status='1';
		$this->response_message="Service updated successfully.";

		$this->json_output($response_data);
	}


	public function add_invitee_question(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$service_id = $request->input('service_id');
		$question = $request->input('question');
		$isrequired = $request->input('is_required');
		if(isset($isrequired) && $isrequired!=''){
			$is_required = 1;
		} else {
			$is_required = 0;
		}
		$answer_type = $request->input('answer_type');
		$answers = $request->input('answers'); 
		$answer_options = '';
		if(!empty($answers)){
			$answer_options = implode('|',$answers);
		}
		
		$is_question_active = $request->input('is_question_active');
		if($is_question_active == 1){
			$is_blocked = 0;
		} else {
			$is_blocked = 1;
		}

		$condition = array(
			array('service_id','=',$service_id),
			array('is_deleted','=','0')
		);
		$checkService = $this->common_model->fetchData($this->tableObj->tableUserService,$condition);

		if(!empty($checkService))
		{
			$param = array(
				'service_id' => $service_id,
				'question' => $question,
				'answer_type' => $answer_type,
				'answer_options' => $answer_options,
				'is_required' => $is_required,
				'is_blocked' => $is_blocked
			);

			$invitee_question_id = $this->common_model->insert_data_get_id($this->tableObj->tableServiceInviteeQuestion,$param);
			if($invitee_question_id)
			{
				$this->response_status='1';
				$this->response_message="Question added successfully.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}
		} else {
			$this->response_message="Invalid Service.";
		}

		$this->json_output($response_data);
	}

	public function update_invitee_question(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$invitee_question_id = $request->input('invitee_question_id');
		$question = $request->input('question');
		$isrequired = $request->input('is_required');
		if(isset($isrequired) && $isrequired!=''){
			$is_required = 1;
		} else {
			$is_required = 0;
		}
		$answer_type = $request->input('answer_type');
		$answers = $request->input('answers'); 
		$answer_options = '';
		if(!empty($answers)){
			$answer_options = implode('|',$answers);
		}
		
		$is_question_active = $request->input('is_question_active');
		/*if($is_question_active == 1){
			$is_blocked = 0;
		} else {
			$is_blocked = 1;
		}*/

		$condition = array(
			array('invitee_question_id','=',$invitee_question_id),
			array('is_deleted','=','0')
		);
		$checkServiceInviteeQuestion = $this->common_model->fetchData($this->tableObj->tableServiceInviteeQuestion,$condition);

		if(!empty($checkServiceInviteeQuestion))
		{
			$updateData=array(
				'question' => $question,
				'answer_options' => $answer_options,
				'is_required' => $is_required,
				'is_blocked' => $is_question_active
			);
			$updateCond=array(
				array('invitee_question_id','=',$invitee_question_id),
				array('is_deleted','=','0')
			);
			$this->common_model->update_data($this->tableObj->tableServiceInviteeQuestion,$updateCond,$updateData);
			
			$this->response_status='1';
			$this->response_message="Successfully Updated.";

		} else {
			$this->response_message="Invalid Invitee Question.";
		}

		$this->json_output($response_data);
	}

	public function delete_invitee_question(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$invitee_question_id = $request->input('invitee_question_id');
		
		$condition = array(
			array('invitee_question_id','=',$invitee_question_id),
			array('is_deleted','=','0')
		);
		$checkServiceInviteeQuestion = $this->common_model->fetchData($this->tableObj->tableServiceInviteeQuestion,$condition);

		if(!empty($checkServiceInviteeQuestion))
		{
			$updateData=array(
				'is_deleted' => 1,
				'deleted_on' => date('Y-m-d H:i:s')
			);
			$updateCond=array(
				array('invitee_question_id','=',$invitee_question_id),
				array('is_deleted','=','0')
			);
			$this->common_model->update_data($this->tableObj->tableServiceInviteeQuestion,$updateCond,$updateData);
			
			$this->response_status='1';
			$this->response_message="Successfully Deleted.";

		} else {
			$this->response_message="Invalid Invitee Question.";
		}

		$this->json_output($response_data);
	}

	public function service_invitee_question(Request $request){
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$service_id = $request->input('service_id');

		$findCond = array(
	        array('service_id','=',$service_id),
		);
		
		$selectFields = array();
		$service_invitee_question = $this->common_model->fetchDatas($this->tableObj->tableServiceInviteeQuestion, $findCond, $selectFields);

		$response_data['service_invitee_question'] = $service_invitee_question;
		$this->response_status='1';
		$this->response_message="Service Invitee Question.";

		$this->json_output($response_data);
	}

	public function invitee_question_details(Request $request){
		$response_data=array();
		$this->validate_parameter(1);

		$user_no = $this->logged_user_no;
		$invitee_question_id = $request->input('invitee_question_id');

		$findCond = array(
			array('invitee_question_id','=',$invitee_question_id),
			array('is_deleted','=',0)
		);
		$selectFields = array();

		$invitee_question_details = $this->common_model->fetchData($this->tableObj->tableServiceInviteeQuestion, $findCond, $selectFields);

		$response_data['invitee_question_details'] = $invitee_question_details;
		$this->response_status='1';
		$this->response_message="Service Invitee Question Details.";

		$this->json_output($response_data);
	}

	public function service_availability(Request $request){
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$service_id = $request->input('service_id');

		$findCond = array(
	        array('service_id','=',$service_id),
		);
		
		$selectFields = array();
		$service_availability = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability, $findCond, $selectFields);

		$response_data['service_availability'] = $service_availability;
		$this->response_status='1';
		$this->response_message="Service Availability.";

		$this->json_output($response_data);
	}


	public function payment_options(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();
        $payment_options = $this->common_model->fetchData($this->tableObj->tableNamePaymentOptions,$findCond,$selectFields);
        $response_data['payment_options'] = $payment_options;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function pre_payment_charges(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();

        $payment_options = $this->common_model->fetchData($this->tableObj->tableNamePaymentOptions,$findCond,$selectFields);
        if(empty($payment_options))
        {
			$param = array(
				'user_id' => $user_no,
				'charge_fixed_booking' => $request->input('charge_fixed_booking'),
				'charge_service_value' => $request->input('charge_service_value')
			);

			$save_id = $this->common_model->insert_data_get_id($this->tableObj->tableNamePaymentOptions,$param);
			if($save_id)
			{
				$this->response_status='1';
				$this->response_message="Successfully Updated.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}
        }
        else
        {
        	$updateData=array(
				'charge_fixed_booking' => $request->input('charge_fixed_booking'),
				'charge_service_value' => $request->input('charge_service_value')
			);
			$updateCond=array(
				array('user_id','=',$user_no)
			);
			$this->common_model->update_data($this->tableObj->tableNamePaymentOptions,$updateCond,$updateData);

			$this->response_status='1';
			$this->response_message="Successfully Updated.";
        }
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function payment_settings(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();

        $payment_options = $this->common_model->fetchData($this->tableObj->tableNamePaymentOptions,$findCond,$selectFields);
        if(empty($payment_options))
        {
			$param = array(
				'user_id' => $user_no,
				'is_enable_paypal' => $request->input('paypal') ? 1 : 0,
				'is_enable_stripe' => $request->input('stripe') ? 1 : 0,
				'username' => $request->input('username')
			);

			$save_id = $this->common_model->insert_data_get_id($this->tableObj->tableNamePaymentOptions,$param);
			if($save_id)
			{
				$this->response_status='1';
				$this->response_message="Successfully Updated.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}
        }
        else
        {
        	$updateData=array(
				'is_enable_paypal' => $request->input('paypal') ? 1 : 0,
				'is_enable_stripe' => $request->input('stripe') ? 1 : 0,
				'username' => $request->input('username')
			);
			$updateCond=array(
				array('user_id','=',$user_no)
			);
			$this->common_model->update_data($this->tableObj->tableNamePaymentOptions,$updateCond,$updateData);

			$this->response_status='1';
			$this->response_message="Successfully Updated.";
        }
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function payment_terms(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();

        $payment_options = $this->common_model->fetchData($this->tableObj->tableNamePaymentOptions,$findCond,$selectFields);
        if(empty($payment_options))
        {
			$param = array(
				'user_id' => $user_no,
				'payment_terms' => $request->input('payment_terms')
			);

			$save_id = $this->common_model->insert_data_get_id($this->tableObj->tableNamePaymentOptions,$param);
			if($save_id)
			{
				$this->response_status='1';
				$this->response_message="Successfully Updated.";
			}
			else
			{
				$this->response_message="Somthing wrong try again later.";
			}
        }
        else
        {
        	$updateData=array(
				'payment_terms' => $request->input('payment_terms')
			);
			$updateCond=array(
				array('user_id','=',$user_no)
			);
			$this->common_model->update_data($this->tableObj->tableNamePaymentOptions,$updateCond,$updateData);

			$this->response_status='1';
			$this->response_message="Successfully Updated.";
        }
        // generate the service / api response
        $this->json_output($response_data);
    }

  
    public function import_invite_contact(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }

        $file = $request->file('contacts_excel_file');
        $discount_type = $request->input('discount_type');
        if($discount_type=='yes')
        {
        	$discount = $request->input('discount'); 
        }
        else
        {
        	$discount = 0; 
        }
        
        //print_r($file); die();
        $type = $file->extension();
        $productInputs = array();
        //echo $type;exit;
        if($type == 'xls' || $type == 'xlsx')
        {
			$existingCompanyPrd = array();
			$fileName = $file->getClientOriginalName();
			$destinationPath = public_path() . '/import_invite_excel/';
			$file->move($destinationPath, $fileName);
			$excelData = Excel::load('/public/import_invite_excel/'.$fileName, function($reader) {})->get();

			//get data from client table
			$condition = array(
	                array('is_deleted', '=', 0),
	            );
            $selectField = array('client_email');
            $check_client = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$condition,$selectField);

            $exist_client_array = array();
        	foreach ($check_client as $key => $value)
            {
            	$exist_client_array[] = $value->client_email;
            }

            $exist = 0;
            $notExit = 0;
			if(!empty($excelData) && count($excelData) > 0)
			{
				$excel_rows = $excelData->toArray();
				foreach ($excel_rows as $row)
				{
					$updateMasterData = array();
					//echo "<pre>";print_r($row);exit;
					foreach($row as $key=>$val)
					{
						//echo "<pre>";print_r($val);exit;
						$client_name = $val['name'];
						$client_email = $val['email'];
						$client_mobile = $val['phone'];

						if(in_array($val['email'],$exist_client_array))
						{
							
							$updateData=array(
								'discount' => $discount,
								'updated_on' => $this->date_format
							);
							$updateCond=array(
								array('client_email','=',$client_email)
							);
							$this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$updateData);

							
							$emailData['username'] = $client_email;
							//$emailData['password'] = $password;
							$emailData['toName'] = $client_name;

							$emailData['discount'] = $discount;
							$this->sendmail(11,$client_email,$emailData);

							$exist++;
						}
						else
						{
							$token1 = md5($client_email);
							$token = $token1;
							$digits = 8;
							$password = rand(pow(10, $digits-1), pow(10, $digits)-1);
							$client_data['user_id'] = $user_no;
							$client_data['client_name'] = $client_name;
							$client_data['client_email'] = $client_email;
							$client_data['client_mobile'] = $client_mobile;
							$client_data['password'] = md5($password);
							$client_data['email_verification_code'] = $token;
							$client_data['discount'] = $discount;

							$insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
							if($insertdata > 0)
							{
								$emailData['username'] = $client_email;
								$emailData['password'] = $password;
								$emailData['toName'] = $client_name;

								$this->sendmail(6,$client_email,$emailData);

							}

							$emailData['discount'] = $discount;
							$this->sendmail(11,$client_email,$emailData);
							$notExit++;
						}
					}
				}
			}

			$total = $exist + $notExit;
			$this->response_status = '1';
			$this->response_message = $total." Mial send successfully.";
        }
        else
        {
        	$this->response_message = "Only excel file can import.";
        }

        //echo 'e'.$exist.'/ne'.$notExit; die();
        $this->json_output($response_data);
    }


    function google_maps_search($address, $key = '')
	{
	    $url = sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s', urlencode($address), urlencode($key));
	    $response = file_get_contents($url);
	    $data = json_decode($response, 'true');
	    return $data;
	}

	function map_google_search_result($geo)
	{
	    if (empty($geo['status']) || $geo['status'] != 'OK' || empty($geo['results'][0])) {
	        return null;
	    }
	    $data = $geo['results'][0];
	    $postalcode = '';
	    foreach ($data['address_components'] as $comp) {
	        if (!empty($comp['types'][0]) && ($comp['types'][0] == 'postal_code')) {
	            $postalcode = $comp['long_name'];
	            break;
	        }
	    }
	    $location = $data['geometry']['location'];
	    $formatAddress = !empty($data['formated_address']) ? $data['formated_address'] : null;
	    $placeId = !empty($data['place_id']) ? $data['place_id'] : null;

	    $result = [
	        'lat' => $location['lat'],
	        'lng' => $location['lng'],
	        'postal_code' => $postalcode,
	        'formated_address' => $formatAddress,
	        'place_id' => $placeId,
	    ];
	    return $result;
	}

	function event_viewer_list(Request $request){
		$response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
		$pageNo = $request->input('page_no');
		$staff_name = $request->input('staff_name');
		$type = $request->input('type');

        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        $user_no = $this->logged_user_no;
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
		);
		if(isset($type) && $type > 0){
			$findCond[]=array('type','=',$type);
		}

		if(isset($staff_name) && $staff_name != ''){
			$findCond[]=array($this->tableObj->tableNameStaff.'.full_name','=',$staff_name);
		}
        
        $selectFields = array('event_viewer_id','type_name','message', 'created_on');
		$user_select_field = array('name as username');
		$staff_select_field = array('full_name as staffname');
		$joins = array(
                    array(
                    'join_table'=>$this->tableObj->tableNameUser,
                    'join_table_alias'=>'',
                    'join_with'=>$this->tableObj->tableNameUserEventViewer,
                    'join_type'=>'left',
                    'join_on'=>array('user_id','=','id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $user_select_field,
				),
				array(
                    'join_table'=>$this->tableObj->tableNameStaff,
                    'join_table_alias'=>'',
                    'join_with'=>$this->tableObj->tableNameUserEventViewer,
                    'join_type'=>'left',
                    'join_on'=>array('staff_id','=','staff_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $staff_select_field,
                ),
            );

		$event_viewer_list = $this->common_model->fetchDatas($this->tableObj->tableNameUserEventViewer, $findCond, $selectFields, $joins, $orderBy=array(),$groupBy='');
		for($i=0;$i<count($event_viewer_list);$i++){
			$event_viewer_list[$i]->created_on = date('d M, Y h:m A', strtotime($event_viewer_list[$i]->created_on));
		}
		$response_data['event_viewer_list'] = $event_viewer_list;
		$this->response_status='1';
		$this->response_message="event_viewer_list";

        // generate the service / api response
        $this->json_output($response_data);

	}


	function change_status_dashboard_report(Request $request){
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		
		$user_id = $this->logged_user_no;
		$report_id = $request->input('report_id');

		$findCond=array(
            array('user_id','=',$user_id),
			array('report_id','=',$report_id),
        );
        
        $selectFields=array();

        $user_dashboard_reports = $this->common_model->fetchData($this->tableObj->tableNameUserDashboardReport,$findCond,$selectFields);
        if(empty($user_dashboard_reports))
        {
			// Insert //
			$saveData = array('user_id' => $user_id, 'report_id' => $report_id);
			$user_dashboard_report_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserDashboardReport, $saveData);
			if($user_dashboard_report_id > 0){
				$this->response_status='1';
				$this->response_message="Report widget added successfully.";
			} else {
				$this->response_message="Something went wrong.";
			}
		} 
		else 
		{
			// Delete //
			$deleteConds = array(
				array('user_id','=',$user_id),
				array('report_id','=',$report_id),
			);
			
			$this->common_model->delete_data($this->tableObj->tableNameUserDashboardReport,$deleteConds);
	
			$this->response_status='1';
			$this->response_message="Report widget deleted successfully.";

		}

		$this->json_output($response_data);
	}


	// User Category List //
	public function user_categories(Request $request){
		$response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $user_no = $this->logged_user_no;
		
		/*$findCond=array(
            array('is_deleted','=','0'),
			array('is_blocked','=','0'),
			'or'=>array('created_by'=>0,'created_by'=>$user_no)
		);
		$category_list = $this->common_model->fetchDatas($this->tableObj->tableNameCategory, $findCond, $selectFields=array(), $joins=array(), $orderBy=array());*/

		$find_query = "SELECT * FROM `squ_categories` WHERE (`squ_categories`.`created_by` = '".$user_no."' OR `squ_categories`.`created_by` = 0) AND `squ_categories`.`is_deleted` = 0 AND `squ_categories`.`is_blocked` = 0";
		$category_list = $this->common_model->customQuery($find_query,$query_type=1);
		
	
		$response_data['category_list'] = $category_list;
		$this->response_status='1';
		$this->response_message="category list";

        // generate the service / api response
        $this->json_output($response_data);
	}


	public function update_service_availability(Request $request)
	{
		$response_data=array();
		$this->validate_parameter(1);
		$user_no = $this->logged_user_no;

		$response_data=array();

		//print_r($request->all()); die();

		$start_time = $request->input('start_time');
		$end_time = $request->input('end_time');
		$start_date = $request->input('start_date');
		$end_date = $request->input('end_date');
		
		$this->response_status='1';
		$this->response_message="Successfully Updated.";
		$this->json_output($response_data);

	}



	// cryptographically secure random number //

	private function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
	
	private function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited
	
		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
		}
	
		return $token;
	}
	
	
}