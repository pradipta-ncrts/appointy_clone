<?php 
/**
 * @Author : NCRTS
 * User Controller for Website
 * 
 */
namespace App\Http\Controllers\Mobile;
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

class ServiceController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function service_list(Request $data,$type="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
		// Check User Login. If not logged in redirect to login page //
		/*$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
		

		// Call API //
		$post_data = $authdata;
		$post_data['duration'] = '';
		$post_data['type'] = '';

		$duration = $data->input('duration');
		//$type = $data->input('type');
		if(!empty($duration) || !empty($type))
		{
			$post_data['duration'] = $duration;
			$post_data['type'] = $type;
		}
		$data=array(
			'total_appointments'=>0,
			'total_sales'=>0,
			'total_customers'=>0,
			'appointments_difference' => 0,
			'sales_difference' => 0,
			'customers_difference' => 0,
			'appointment_data'=>array(),
			'sales_data'=>array(),
			'customer_data'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="dashboard";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['total_appointments'] = $return->total_appointments;
				$data['total_sales'] = $return->total_sales;
				$data['total_customers'] = $return->total_customers;
				$data['appointments_difference'] = $return->appointments_difference;
				$data['sales_difference'] = $return->sales_difference;
				$data['customers_difference'] = $return->customers_difference;
				$data['service_list'] = $return->service_list;
				//$data['appointment_data'] = $return->appointment_data;
				//$data['sales_data'] = $return->sales_data;
				//$data['customer_data'] = $return->customer_data;
				$data['dashboard_reports'] = $return->dashboard_reports;
				$data['duration'] = $duration;
				$data['type'] = $type;
				
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.user.dashboard.dashboard')->with($data);
		}
		else
		{
			return $return;
		}*/

		return view('mobile.service.service-list');
	}

	public function add_service(Request $data,$type="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
		// Check User Login. If not logged in redirect to login page //
		/*$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
		

		// Call API //
		$post_data = $authdata;
		$post_data['duration'] = '';
		$post_data['type'] = '';

		$duration = $data->input('duration');
		//$type = $data->input('type');
		if(!empty($duration) || !empty($type))
		{
			$post_data['duration'] = $duration;
			$post_data['type'] = $type;
		}
		$data=array(
			'total_appointments'=>0,
			'total_sales'=>0,
			'total_customers'=>0,
			'appointments_difference' => 0,
			'sales_difference' => 0,
			'customers_difference' => 0,
			'appointment_data'=>array(),
			'sales_data'=>array(),
			'customer_data'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="dashboard";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['total_appointments'] = $return->total_appointments;
				$data['total_sales'] = $return->total_sales;
				$data['total_customers'] = $return->total_customers;
				$data['appointments_difference'] = $return->appointments_difference;
				$data['sales_difference'] = $return->sales_difference;
				$data['customers_difference'] = $return->customers_difference;
				$data['service_list'] = $return->service_list;
				//$data['appointment_data'] = $return->appointment_data;
				//$data['sales_data'] = $return->sales_data;
				//$data['customer_data'] = $return->customer_data;
				$data['dashboard_reports'] = $return->dashboard_reports;
				$data['duration'] = $duration;
				$data['type'] = $type;
				
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.user.dashboard.dashboard')->with($data);
		}
		else
		{
			return $return;
		}*/

		return view('mobile.service.add-service');
	}


	

}