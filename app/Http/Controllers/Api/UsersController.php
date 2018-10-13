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
				'or'=>array('email'=>$email,'username'=>$email)
			);
			$selectFields=array('id','user_type','is_email_verified','created_on','is_deleted','is_blocked');
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

	/***Login ***/
	public function logout(Request $request)
	{
		//echo "+++++++++"; die();
		$response_data=array();
		// validate the requested param for access this service api
		$this->validate_parameter(1);
		// now remove the request key 
		$deleteConds=array(
			array('request_key','=',$this->user_request_key),
			array('user_id','=',$this->logged_user_no),
		);
		
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

	public function changepssword(Request $request){

		$response_data=array();
		// validate the requested param for access this service api
		$this->validate_parameter(1);
		//validation section 
		$validator = Validator::make($this->postParam->all(),
			[
				'old_password' => 'bail|required',
				'password' => 'bail|required|min:8|different:old_password|regex:/[A-Z]+/|regex:/[0-9]+/|regex:/[*@&%!#$]+/',
		]);



		if(!$validator->fails()){
			// all validations are passed
			$user_no = $this->logged_user_no;
			$old_password = $request->input('old_password');
			$password = $request->input('password');
			// find the user password 
			$findCond=array(
				array('password','=',md5($old_password)),
				array('user_no','=',$user_no)
			);
			$select_fields=array('user_no','email','first_name');
			$user = $this->common_model->fetchData($this->tableObj->tableNameUser,$findCond,$select_fields);
			if(empty($user)){
				$this->response_message="old_password_not_matched";
			}
			else{
				// now update the password with new one
				$updateData=array(
					'password'=>md5($password),
					'updated_on'=>$this->date_format
				);
				$updateCond=array(
					array('user_no','=',$user_no)
				);
				$this->common_model->update_data($this->tableObj->tableNameUser,$updateCond,$updateData);
				// send mail
				$email = $user->email;
				$this->sendmail(4,$email,array('toName'=>$user->first_name));
				// update your password 
				$this->response_message="password_change_successfully";
				$this->response_status='1';
			}
		}
		else{
			// if parameter validation checked faild
			$errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
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
				'user_name' => 'bail|required',
				'password' => 'bail|required|min:8',
				'phone' => 'bail|required',
				'profession' => 'bail|required',
				'country' => 'bail|required',
				
		]);

		if(!$validator->fails())
		{
			$user_type = $request->input('user_type');
			$username = $request->input('user_name');
			$password = $request->input('password');
			$country_code = $request->input('country_code');
			$mobile = $country_code.$request->input('phone');
			$profession = $request->input('profession');
			$country = $request->input('country');  
			$email = $_COOKIE['new_email'];

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
					'user_type' => $user_type,
					'username' => $username,
					'password' => md5($password),
					'mobile' => $mobile,
					'profession' => $profession,
					'country' => $country,
					'email' => $email	
			);

			$condition = array(
	                        array('username','=',$username),
	                    );
	        $checkUsername = $this->common_model->fetchData($this->tableObj->tableNameUser,$condition);

	        $emailCodtion = array(
	                        array('email','=',$email),
	                    );
	        $checkEmail = $this->common_model->fetchData($this->tableObj->tableNameUser,$emailCodtion);

	        if(empty($checkUsername) && empty($checkEmail))
	        {
	        	$user_no = $this->common_model->insert_data_get_id($this->tableObj->tableNameUser, $param);
	            if($user_no)
	            {
					// create email validation token :: format : md5(email).md5(username.user_no)
					$email = $email;
					$token1 = md5($email);
					$token2 = md5($username.$user_no);
					$token = $token1.$token2;
					//update the user with the token
					$update_condition=array(
						array('id','=',$user_no),
						array('email','=',$email)
					);
					$update_data=array('email_verification_code'=>$token);
					$this->common_model->update_data($this->tableObj->tableNameUser,$update_condition,$update_data);
					// send mail 
					$other_params = "?device_type=0&device_token_key=".Session::getId();
					$verify_link = $this->base_url('api/emailverification/'.$token.$other_params);// need to change with website url
					$emailData['verify_link']=$verify_link;
					$emailData['toName']=$username;

					$this->sendmail(1,$email,$emailData);

					// return section
					$response_data['token'] = $token;
					$response_data['user_type'] = $user_type;
					$this->response_status='1';
					$this->response_message="Verification link send to your email.";

	            }
	            else
	            {
	            	$this->response_message="Somthing wrong.Try again later.";
					$this->response_status='0';
	            }
	        }
	        else
	        {
	        	$this->response_message="User already exist.";
				$this->response_status='0';
	        }
		}
		else
		{
			$errors = $validator->errors()->messages();
			$this->response_message = $this->forErrorMessage($errors);
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
		$email = $_COOKIE['new_email'];

		$emailCodtion = array(
	                     'or'=>array('email'=>$email,'username'=>$email)
	                    );
	    $checkEmail = $this->common_model->fetchData($this->tableObj->tableNameUser,$emailCodtion);
	    $count = 0;
	    foreach ($category as $key => $value)
	    {
	    	if($value=='new')
	    	{
	    		$param = array('category' => $new_category_name[$key], 'is_blocked' => 1);
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
			);

	    	//inset into service table
	    	$this->common_model->insert_data_get_id($this->tableObj->tableUserService, $param);
	    	$count++;
	    }

	    //print_r($param); die();
			
		$this->response_status='1';
		$this->response_message="Verification link send to your email.";

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

	// User's service Listing //
    public function service_list(Request $request)
    {
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$other_user_no = $request->input('other_user_no');
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
		}
		if($type == "users")
		{
			$servCond[] = array('capacity','=','0');
		}

		$category = $request->input('category'); 
		if(!empty($category))
		{
			$servCond[] = array('category_id','=', $category);
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
		$this->response_message="Successfully service status updated.";

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

		$this->response_status='1';
		$this->response_message="Successfully service status updated.";

		$this->json_output($response_data);

	}

	public function add_new_service(Request $request)
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
	    		$this->response_message="You cun't add new category when update service.";
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

    		$this->response_status='1';
			$this->response_message="Successfully service updated.";
		}
		else
		{
			$insert = $this->common_model->insert_data_get_id($this->tableObj->tableUserService, $param);
			if($insert)
			{
				$this->response_status='1';
				$this->response_message="Successfully service added.";
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

		$this->response_status='1';
		$this->response_message['service_detils'] = $service_details;
		$this->response_message['category'] = $category;

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
        $discount = $request->file('discount'); 
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
						if(in_array($val['email'],$exist_client_array))
						{
							$exist++;
						}
						else
						{
							$notExit++;
						}
					}
				}
			}
        }
        else
        {
        	$this->response_message = "Only excel file can import.";
        }

        echo 'e'.$exist.'/ne'.$notExit; die();
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

}