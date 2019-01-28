<?php 
/**
 * @Author : NCRTS
 * User Controller for Website
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
use Excel;

use DateTime;

class StaffController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}
	
	//***** Staff Dashboard *****//
	public function staff_dashboard(Request $request)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		$staff_id = $authdata['user_no']; 
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['filter_data'] = '';
		$post_data['staff_id'] = $staff_id;

		//filter staff
		$filter_data = $request->input('appoinmnet_filter_stuff_id');
		//print_r($filter_data); die();
		if(!empty($filter_data))
		{
			$post_data['filter_data'] = implode(',', $filter_data);
		}
		$data=array(
			'appoinment_list'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="appoinment_list_staff";
		$return = $this->curl_call($url_func_name,$post_data);

		// Service List //
		//$service_post_data = $authdata;
		//$service_url_func_name="service_list";
		//$service_return = $this->curl_call($service_url_func_name,$service_post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['appoinment_list'] = $return->appoinment_list;
				$data['staff_list'] = $return->staff_list;
				$data['staff_list_filter'] = $return->staff_list_filter;
				$data['calendar_settings'] = $return->calendar_settings;
				$data['filter_data'] = $return->filter_data;
				$data['block_date_time'] = $return->block_date_time;
				$data['service_list'] = $return->service_list;
				$data['staff_data'] = $return->staff_data;

			}
			//echo '<pre>'; print_r($data); exit;
			//return view('website.calendar')->with($data);
			return view('website.staff.staff-dashboard')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function staff_booking_list(Request $data,$duration)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['filter_data'] = '';
		$post_data['staff_id'] = $authdata['user_no'];
		$post_data['duration'] = $duration;
		$data=array(
			'appoinment_list'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="staff_appoinment_list_mobile";
		$return = $this->curl_call($url_func_name,$post_data);

		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['appoinment_list'] = $return->appoinment_list;
				$data['duration'] = $duration;
				$data['staff_list'] = $return->staff_list;
				$data['staff_data'] = $return->staff_data;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.staff.booking_list')->with($data);
		}
		else
		{
			return $return;
		}
	}

	

}