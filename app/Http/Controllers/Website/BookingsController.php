<?php 

/**
 * @Author : NCRTS
 * Booking Controller for Website
 * 
 */
namespace App\Http\Controllers\Website;
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





	public function booking_options()

	{

		// Check User Login. If not logged in redirect to login page //

		$authdata = $this->website_login_checked();

		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){

			return redirect('/login');

		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			'authdata'=>$authdata
		);

		$url_func_name="booking_flow_data";
		$return = $this->curl_call($url_func_name,$post_data);
		$booking_flow_data = $return->booking_flow_data;
		if(isset($booking_flow_data) && $booking_flow_data)
		{
			$data['time_on_booking_portal'] = $booking_flow_data->time_on_booking_portal;
			$data['cost_on_booking_portal'] = $booking_flow_data->cost_on_booking_portal;
			$data['categories_first_on_booking_portal'] = $booking_flow_data->categories_first_on_booking_portal;
			$data['staff_members_on_booking_portal'] = $booking_flow_data->staff_members_on_booking_portal;
			$data['selection_staff_mandatory'] = $booking_flow_data->selection_staff_mandatory;
			$data['login_first_name'] = $booking_flow_data->login_first_name;
			$data['login_last_name'] = $booking_flow_data->login_last_name;
			$data['login_zip'] = $booking_flow_data->login_zip;
			$data['login_mobile'] = $booking_flow_data->login_mobile;
			$data['login_email'] = $booking_flow_data->login_email;
			$data['login_address'] = $booking_flow_data->login_address;
			$data['login_dob'] = $booking_flow_data->login_dob;
			$data['login_city'] = $booking_flow_data->login_city;
		}
		else
		{
			$data['time_on_booking_portal'] = 0;
			$data['cost_on_booking_portal'] = 0;
			$data['categories_first_on_booking_portal'] = 0;
			$data['staff_members_on_booking_portal'] = 0;
			$data['selection_staff_mandatory'] = 0;
			$data['login_first_name'] = 0;
			$data['login_last_name'] = 0;
			$data['login_zip'] = 0;
			$data['login_mobile'] = 0;
			$data['login_email'] = 0;
			$data['login_address'] = 0;
			$data['login_dob'] = 0;
			$data['login_city'] = 0;
		}

		return view('website.booking.booking-options', $data);

	}





	public function booking_rules()

	{

		// Check User Login. If not logged in redirect to login page //

		$authdata = $this->website_login_checked();

		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){

			return redirect('/login');

		}



		return view('website.booking.booking-rules');

	}


	public function email_customisation()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			'staff_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="email_customisation_data";
		$return = $this->curl_call($url_func_name,$post_data);
		//echo "<pre>";
		//print_r($return); die();
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data = array();
				$email_customisation_data = $return->email_customisation_data;
				foreach ($email_customisation_data as $key => $value)
				{
					if($value->type==1)
					{
						$data['subject1'] = $value->subject;
						$data['message1'] = $value->message;
					}
					else if($value->type==2)
					{
						$data['subject2'] = $value->subject;
						$data['message2'] = $value->message;
					}
					else if($value->type==3)
					{
						$data['subject3'] = $value->subject;
						$data['message3'] = $value->message;
					}
					else if($value->type==4)
					{
						$data['subject4'] = $value->subject;
						$data['message4'] = $value->message;
					}
					else if($value->type==5)
					{
						$data['subject5'] = $value->subject;
						$data['message5'] = $value->message;
					}
					else if($value->type==6)
					{
						$data['subject6'] = $value->subject;
						$data['message6'] = $value->message;
					}
					else if($value->type==7)
					{
						$data['subject7'] = $value->subject;
						$data['message7'] = $value->message;
					}
					else if($value->type==8)
					{
						$data['subject8'] = $value->subject;
						$data['message8'] = $value->message;
					}
					else if($value->type==9)
					{
						$data['subject9'] = $value->subject;
						$data['message9'] = $value->message;
					}
				}
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.booking.email-customisation')->with($data);
		}
		else
		{
			return $return;
		}
	}


	public function booking_policies()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
		return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$data=array(
		'authdata'=>$authdata
		);
		$url_func_name="booking_policy_list";
		$return = $this->curl_call($url_func_name,$post_data);

		// Check response status. If success return data //	
		if(isset($return->response_status)){
		if($return->response_status == 1){
		//1 =  Cancellation Policy, 2 =  Additional Information, 3 =  Terms & Conditions
		$data['cancellation_policy'] = "";
		$data['additional_information'] = "";
		$data['terms_conditions'] = "";
		if(!empty($return->policy_list)){
		foreach($return->policy_list as $policy_list){
		if($policy_list->type == 1){
		$data['cancellation_policy'] = $policy_list->content;
		}
		if($policy_list->type == 2){
		$data['additional_information'] = $policy_list->content;
		}
		if($policy_list->type == 3){
		$data['terms_conditions'] = $policy_list->content;
		}
		}
		}
		}
		//echo '<pre>'; print_r($data); exit;
		return view('website.booking.booking-policies')->with($data);
		}
		else{
		return $return;
		}

		//return view('website.booking.booking-policies');
	}


	public function notification_settings()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		
		// Call API //
		$post_data = $authdata;
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
		}
		return view('website.booking.notification-settings');
	}

}