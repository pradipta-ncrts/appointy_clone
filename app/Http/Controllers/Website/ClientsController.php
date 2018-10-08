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
		$post_data['appointment_id']=$param_data['appointment_id'];
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
		$post_data['appointment_id']=$param_data['appointment_id'];
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
	return view('website.client.my-squeeder-page');
	}
	
	function client_service_details($parameter=NULL)
	{
	return view('website.client.client-service-details');
	}
	
}