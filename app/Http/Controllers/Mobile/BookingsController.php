<?php 

/**
 * @Author : NCRTS
 * Booking Controller for Website
 * 
 */
namespace App\Http\Controllers\Mobile;
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\TablesController;
use Validator;
use Session;
use Cookie;
use DateTime;

class BookingsController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
}

	public function booking_list(Request $data,$duration)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('mobile/login');
		}

		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['filter_data'] = '';

		//echo $duration; die();
		//filter staff
		/*$filter_data = $data->input('appoinmnet_filter_stuff_id');
		if(!empty($filter_data))
		{
			$post_data['filter_data'] = implode(',', $filter_data);
		}*/

		$post_data['duration'] = $duration;
		$data=array(
			'appoinment_list'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="appoinment_list_mobile";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['appoinment_list'] = $return->appoinment_list;
				$data['duration'] = $duration;
				$data['staff_list'] = $return->staff_list;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.booking.booking-list')->with($data);
		}
		else
		{
			return $return;
		}
	}

	/*public function client_booking_list(Request $data,$duration,$client_id)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('mobile/login');
		}

		$post_data['duration'] = $duration;
		$post_data['client_id'] = $client_id;
		$data=array(
			'appoinment_list'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="client_appoinment_list_mobile";
		$return = $this->curl_call($url_func_name,$post_data);

		//print_r($return); die();
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['appoinment_list'] = $return->appoinment_list;
				$data['duration'] = $duration;
				$data['client_id'] = $client_id;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.booking.client-booking-list')->with($data);
		}
		else
		{
			return $return;
		}
	}*/

	public function client_booking_list(Request $data,$duration,$client_id)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('mobile/login');
		}

		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['filter_data'] = '';

		//echo $duration; die();
		//filter staff
		/*$filter_data = $data->input('appoinmnet_filter_stuff_id');
		if(!empty($filter_data))
		{
			$post_data['filter_data'] = implode(',', $filter_data);
		}*/

		$post_data['duration'] = $duration;
		$post_data['client_id'] = $client_id;
		$data=array(
			'appoinment_list'=>array(),
			'authdata'=>$authdata
		);
		//print_r($post_data); die();
		$url_func_name="client_appoinment_list_mobile";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['appoinment_list'] = $return->appoinment_list;
				$data['duration'] = $duration;
				$data['client_id'] = $client_id;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.booking.client-booking-list')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function booking_client_filter($param=NULL)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		
		// Call API //
		/*$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="notification_settings_data";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['notification_settings_data'] = $return->notification_settings_data;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.booking.notification-settings')->with($data);
		}
		else{
			return $return;
		}*/
		return view('mobile.booking.booking-client-filter');
	}


	public function add_appointment($param=NULL)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		$data['clients_list'] = $this->clients_list();
		$data['services_list'] = $this->services_list();
		$data['stuffs_list'] = $this->stuffs_list();
		return view('mobile.booking.add-appointment')->with($data);
		
	}
	

	

}