<?php 
/**
 * @Author : NCRTS
 * Client Controller for Website
 * 
 */
namespace App\Http\Controllers\Website;
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\TablesController;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Session;
use Cookie;

use DateTime;

class ClientsController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	function cancel_appointment($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);
		}
		$data=array(
			'appointment_details'=>array()
		);
		// Call API //
		$post_data['order_id']=$param_data['order_id'];
		$post_data['client_id']=$param_data['client_id'];

		$url_func_name="client_appointment_details";
		$return = $this->curl_call($url_func_name,$post_data);
		//echo "<pre>";
		//print_r($return); die();
		if($return->response_status == 1)
		{
			$data['appointment_details'] = $return->appoinment_details;
			//echo '<pre>'; print_r($data); exit;
		}
		else{
			$data['appointment_details'] = array();
			$data['message'] = $return->response_message;
		}

		return view('website.client.cancel-appointment',$data);
		
	}


	function reschedule_appointment($parameter=NULL)
	{
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);
		}

		$data=array(
			'appointment_details'=>array()
		);
		// Call API //
		$post_data['order_id']=$param_data['order_id'];
		$post_data['client_id']=$param_data['client_id'];

		$url_func_name="client_appointment_details";
		$return = $this->curl_call($url_func_name,$post_data);
		//echo "<pre>";
		//print_r($return); die();
		if($return->response_status == 1)
		{
			$data['appointment_details'] = $return->appoinment_details;
			$user_id = $return->appoinment_details->user_id;
			$staff_id = $return->appoinment_details->staff_id;
			$duration = $return->appoinment_details->duration;
			$category_id = $return->appoinment_details->category_id;

			// Call API //
			$cat_post_data['user_no']=$user_id;
			
			$url_func_name="business_provider_category_list";
			$return = $this->curl_call($url_func_name,$cat_post_data);
			$data['category_list'] = $return->category_list;

			// Call API //
			$service_post_data['user_no']=$user_id;
			$service_post_data['category_id']=$category_id;
			
			$url_func_name="business_provider_service_list";
			$return = $this->curl_call($url_func_name,$service_post_data);
			$data['service_list'] = $return->service_list;

			// Call API //
			$staff_post_data['user_no']=$user_id;
			
			$url_func_name="business_provider_staff_list";
			$return = $this->curl_call($url_func_name,$staff_post_data);
			$data['staff_list'] = $return->staff_list;

			// Call API //
			/*$calendar_post_data['user_no']=$user_id;
			$calendar_post_data['staff_id']=$staff_id;
			$calendar_post_data['duration']=$duration;
			$calendar_post_data['client_id']=$param_data['client_id'];
			$calendar_post_data['appointment_id']=$param_data['appointment_id'];
			
			$url_func_name="calendar_availability_list";
			$return = $this->curl_call($url_func_name,$calendar_post_data);
			//echo '<pre>'; print_r($return); exit;
			$data['calendar_availability_details'] = $return;*/
			
		}
		else{
			$data['appointment_details'] = array();
			$data['message'] = $return->response_message;
		}

		//echo '<pre>'; print_r($data); exit;
		return view('website.client.reschedule-appointment',$data);
	}
	

	function client_info($parameter=NULL)
	{
		return view('website.client.client-info');
	}
	
	function booking_verify($parameter=NULL)
	{
		return view('website.client.booking-verify');
	}
	
	function booking_details($parameter=NULL)
	{
		return view('website.client.booking-details');
	}


	function business_provider($parameter=NULL)
	{
		$username = $parameter; 
		$findCond = array(
            array('username','=',$username),
			array('is_deleted','=','0'),
		);
		$selectFields = array();
		$profession_select_field = array('profession as prof');
		$joins = array(
		             array(
		                'join_table'=>$this->tableObj->tableNameProfession,
		                //'join_with_alias'=>'userTb',
		                'join_with'=>$this->tableObj->tableNameUser,
		                //'join_with_alias'=>'servTb',
		                'join_type'=>'left',
		                'join_on'=>array('profession','=','profession_id'),
		                //'join_conditions' => array(array('user_no','=','teacher_user_no')),
		                'select_fields' => $profession_select_field,
		            ),
        );
		$user_details = $this->common_model->fetchData($this->tableObj->tableNameUser, $findCond, $selectFields,$joins);

		//staff list
		$staffCondition = array(
            array('user_id','=',$user_details->id),
            array('is_internal_staff','=', '0'),
			array('is_deleted','=','0'),
			array('is_blocked','=','0'),
		);
		$staffFields = array();
		$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff, $staffCondition, $staffFields);
		//echo "<pre>";
		//print_r($staff_list); die();

		//service list
		$servCond = array(
            array('user_id','=',$user_details->id),
			array('is_deleted','=','0'),
			array('is_blocked','=','0'),
			array('is_secret','=','0'),
		);
		$serviceFields = array();
		$currency_field = array('currency');
		$category_select_field = array('category as cat');
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

		$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $servCond, $serviceFields, $joins, $orderBy=array());
		
		
		$data['user_details'] = $user_details;
		$data['staff_list'] = $staff_list;
		$data['service_list'] = $service_list;
		return view('website.client.my-squeeder-page',$data);
	}
	
	function client_service_details($service_id=NULL)
	{
		$service_list = array();
		$service_details=array();

		if($service_id!=NULL){
			$findCond=array(
				array('service_id','=',$service_id),
				array('is_deleted','=','0'),
				array('is_blocked','=','0'),
			);
			//echo '<pre>'; print_r($findCond); exit;
			$selectFields=array();
			$category_select_field = array('category');
			$currency_field = array('currency');
			$joins = array(
						 array(
							'join_table'=>$this->tableObj->tableNameCategory,
							'join_with'=>$this->tableObj->tableUserService,
							'join_type'=>'left',
							'join_on'=>array('category_id','=','category_id'),
							'select_fields' => $category_select_field,
						),
						array(
							'join_table'=>$this->tableObj->tableNameCurrency,
							'join_with'=>$this->tableObj->tableUserService,
							'join_type'=>'left',
							'join_on'=>array('currency_id','=','currency_id'),
							'select_fields' => $currency_field,
						),
			);
			$service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$findCond,$selectFields,$joins);
			//echo '<pre>'; print_r($service_details); exit;
			$user_id = $service_details->user_id;
			// All services of service provider //
			$findserviceCond=array(
				array('user_id','=',$user_id),
				array('is_deleted','=','0'),
				array('is_blocked','=','0'),
				array('is_secret','=','0'),
			);
			
			$selectserviceFields=array('service_id','service_name','description','service_link');
			$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService,$findserviceCond,$selectserviceFields);
			
	
			$data=array(
				'service_list'=>$service_list,
				'service_details'=>$service_details
			);
	
			//echo '<pre>'; print_r($data); exit;
		}

		return view('website.client.client-service-details',$data);
	}

	function client_login($parameter=NULL)
	{
		return view('website.client.client-login');
	}

	function client_registration($parameter=NULL)
	{
		return view('website.client.client-registration');
	}

	function client_dashboard($parameter=NULL)
	{
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			$data=array(
				'client_details'=>array()
			);
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
	
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
	
			if($return->response_status == 1)
			{
				$data['client_details'] = $return->client_details;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-dashboard',$data);
		} else {
			return redirect('client/login');
		}
	}

	function client_verification($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			$data=array(
				'client_details'=>array()
			);
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
	
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
	
			if($return->response_status == 1)
			{
				$data['client_details'] = $return->client_details;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-verification',$data);
		} else {
			return redirect('client/login');
		}
		
	}


	function client_appointment_booking($parameter=NULL)
	{
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			$data=array(
				'client_details'=>array()
			);
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
	
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
	
			if($return->response_status == 1)
			{
				// Call API //
				$bp_url_func_name="business_provider_list";
				$bp_return = $this->curl_call($bp_url_func_name,$post_data);
				//echo "<pre>";print_r($bp_return); die();

				$data['client_details'] = $return->client_details;
				$data['business_provider_list'] = $bp_return->business_provider_list;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-appointment-booking',$data);
		} else {
			return redirect('client/login');
		}
		
	}


	function client_appointment_confirmation($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			$data=array(
				'client_details'=>array()
			);
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
	
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
	
			if($return->response_status == 1)
			{
				// Call API //
				$post_data['order_id'] = $param_data['order_id'];
				$appo_url_func_name="client_appointment_details";
				$appo_return = $this->curl_call($appo_url_func_name,$post_data);
				//echo "<pre>";print_r($appo_return); die();


				$data['client_details'] = $return->client_details;
				$data['appoinment_details'] = $appo_return->appoinment_details;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['appoinment_details'] = array();
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-appointment-confirmation',$data);
		} else {
			return redirect('client/login');
		}
	}
	

	function view_staff_list($username=NULL){
		$staff_postal_code_list = array();
		$staff_list=array();
		$staff_details=array();
		$data = array();
		if($username!=NULL){
			$findCond=array(
				array('username','=',$username),
				array('is_internal_staff','=','0'),
				array('is_deleted','=','0'),
				array('is_blocked','=','0'),
			);
			//echo '<pre>'; print_r($findCond); exit;
			$selectFields=array();
			$category_select_field = array('category');
			$joins = array(
						 array(
							'join_table'=>$this->tableObj->tableNameCategory,
							'join_with'=>$this->tableObj->tableNameStaff,
							'join_type'=>'left',
							'join_on'=>array('category_id','=','category_id'),
							'select_fields' => $category_select_field,
						),
			);
			$staff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff,$findCond,$selectFields,$joins);
			//echo '<pre>'; print_r($staff_details); exit;
			if(!empty($staff_details)){
				$user_id = $staff_details->user_id;
				$staff_id = $staff_details->staff_id;
				
		
				$findpostCond=array(
					array('staff_id','=',$staff_id),
					array('is_deleted','=','0'),
					array('is_blocked','=','0'),
				);
				
				$selectpostFields=array('postal_code','area');
				$staff_postal_code_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findpostCond,$selectpostFields);
				$staff_details->pincodes = $staff_postal_code_list;
	
				// All Staff List //
				$findstaffCond=array(
					array('user_id','=',$user_id),
					array('is_internal_staff','=',0),
					array('is_deleted','=','0'),
					array('is_blocked','=','0'),
				);
				
				$selectstaffFields=array('staff_id','full_name','username','email','staff_profile_picture');
				$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findstaffCond,$selectstaffFields);
				
					
			}
			
	
			$data=array(
				'staff_list'=>$staff_list,
				'staff_details'=>$staff_details,
				'username'=>$username
			);
	
			//echo '<pre>'; print_r($data); exit;
		}

		return view('website.client.view-staff-list',$data);
	}

	
	function forgot_password($parameter=NULL)
	{
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			$client_id=$param_data['client_id'];
			$sent_time=$param_data['time'];
	
			$check_condition = array(
				array('client_id', '=', $client_id),
				array('is_deleted', '=', 0),
			);
			$select_fields = array();
			$client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$check_condition, $select_fields);
			
			/*if(time() < $sent_time+7200){
				// Success //
			} else {
				// Link Expired //
			}*/
	
			if(!empty($client_details)){
				$data['client_id'] = $client_id;
				return view('website.client.client-forgot-password',$data);
			} else {
				// Invalid Token //
				echo 'Invalid token'; exit;
			}
		} else {
			// Invalid Params //
			echo 'Invalid Parameters'; exit;
		}

	}




	function client_booking_list($parameter=NULL,$duration){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{
				// Call API //
				$post_data['duration'] = $duration;
				$url_func_name="client_booking_list";
				$client_booking_list = $this->curl_call($url_func_name,$post_data);
				//echo "<pre>";print_r($client_booking_list->appoinment_list); die();


				$data['client_details'] = $return->client_details;
				$data['appoinment_list'] = $client_booking_list->appoinment_list;
				$data['duration'] = $duration;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['appoinment_list'] = array();
				$data['duration'] = $duration;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.booking_list',$data);
		} else {
			return redirect('client/login');
		}
	}

	function client_recurring_booking_list($parameter=NULL,$duration){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{
				// Call API //
				$post_data['duration'] = $duration;
				$post_data['appointment_type'] = '1';
				$url_func_name="client_booking_list";
				$client_booking_list = $this->curl_call($url_func_name,$post_data);
				//echo "<pre>";print_r($client_booking_list->appoinment_list); die();


				$data['client_details'] = $return->client_details;
				$data['appoinment_list'] = $client_booking_list->appoinment_list;
				$data['duration'] = $duration;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['appoinment_list'] = array();
				$data['duration'] = $duration;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.recurring_booking_list',$data);
		} else {
			return redirect('client/login');
		}
	}

	function client_booking_details($parameter=NULL,$order_id){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);
			
			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{
				// Call API //
				$post_data['order_id'] = $order_id;
				$url_func_name="client_booking_details";
				$client_booking_details = $this->curl_call($url_func_name,$post_data);
				//echo "<pre>";print_r($client_booking_details); die();


				$data['client_details'] = $return->client_details;
				$data['appointment_details'] = $client_booking_details->appointment_details;
				$data['recurring_booking_list'] = $client_booking_details->recurring_booking_list;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['appointment_details'] = array();
				$data['recurring_booking_list'] = array();
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.recurring_booking_details',$data);
		} else {
			return redirect('client/login');
		}
	}


	function client_profile_settings($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{

				$data['client_details'] = $return->client_details;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-profile-settings',$data);
		} else {
			return redirect('client/login');
		}
	}

	function client_profile_picture_settings($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{
				$data['client_details'] = $return->client_details;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-profile-picture-settings',$data);
		} else {
			return redirect('client/login');
		}
	}

	function client_login_settings($parameter=NULL){
		if($parameter!=NULL){
			$param_data = Crypt::decrypt($parameter);

			// Call API //
			$post_data['client_id']=$param_data['client_id'];
			
			$url_func_name="client_info";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo "<pre>";print_r($return); die();
			
			if($return->response_status == 1)
			{

				$data['client_details'] = $return->client_details;
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
			else{
				$data['client_details'] = array();
				$data['param'] = $parameter;
				$data['message'] = $return->response_message;
			}
	
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-login-settings',$data);
		} else {
			return redirect('client/login');
		}
	}
	
}