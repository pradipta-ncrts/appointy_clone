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

	public function service_list($type,$category=false)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/mobile/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			'service_list'=>array(),
			'authdata'=>$authdata
		);
		$post_data['type'] = $type ? $type : '';
		$post_data['category'] = $category ? $category : '';
		$url_func_name="service_list";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['service_list'] = $return->service_list;
				$data['category_list'] = $return->category_list;
				$data['user_name'] = $return->user_name;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.service.service-list')->with($data);
		}
		else{
			return $return;
		}

		//return view('website.services');
	}

	public function create_service(Request $data)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
		return view('mobile.service.create-service');
		//return view('mobile.service.add-service');
	}

	public function add_services($type="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}
			if($type!="")
		{
			// Call API //
			$post_data = $authdata;
			$data=array(
				'category_list'=>array(),
				'authdata'=>$authdata
			);

			$url_func_name="user_categories";
			$return = $this->curl_call($url_func_name,$post_data);
			
			// Check response status. If success return data //		
			if(isset($return->response_status))
			{
				if($return->response_status == 1)
				{
					$data['category_list'] = $return->category_list;
					$data['type'] = $type;
				}
				//echo '<pre>'; print_r($data); exit;
				return view('mobile.service.add_services')->with($data);
			}
			else{
				return $return;
			}
		} else {
			return redirect('create_new_service');
		}
	}

	public function edit_service($request_data=""){
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		if($request_data!=""){
			
			$service_id = Crypt::decrypt($request_data);
			// Call API //
			$post_data = $authdata;
			$post_data['service_id'] = $service_id;
			$data=array(
				'category_list'=>array(),
				'service_details'=>array(),
				'authdata'=>$authdata
			);


			$url_func_name_cat="user_categories";
			$return_cat = $this->curl_call($url_func_name_cat,$post_data);

			$url_func_name="service-details";
			$return = $this->curl_call($url_func_name,$post_data);
			//echo '<pre>'; print_r($return); exit;

			$url_func_name_iq="service-invitee-question";
			$return_iq = $this->curl_call($url_func_name_iq,$post_data);

			$url_func_name_service_availability="service-availability";
			$return_service_availability = $this->curl_call($url_func_name_service_availability,$post_data);
			$service_availability = array();
			foreach($return_service_availability->service_availability as $rsa){
				if($rsa->end_date!='0000-00-00'){
					$datediff = round((strtotime($rsa->end_date) - strtotime($rsa->start_date)) / (60 * 60 * 24));
					if($datediff > 1){
						$current = strtotime($rsa->start_date);
						$last = strtotime($rsa->end_date);
					
						while( $current <= $last ) {
							$dates = date('N', $current);
							if($rsa->day == $dates){
								$service_availability[] = array('start_date_time' => date('Y-m-d',$current).' '.$rsa->start_time.':00',
								'end_date_time' => date('Y-m-d',$current).' '.$rsa->end_time.':00');
							}
							$current = strtotime('+1 day', $current);
						}
					
					} else {
						$service_availability[] = array('start_date_time' => $rsa->start_date.' '.$rsa->start_time.':00',
														'end_date_time' => $rsa->end_date.' '.$rsa->end_time.':00');
					}
				} else {
					$current = strtotime($rsa->start_date);
					//Add 1year//
					$last = strtotime("+1 years", strtotime($rsa->start_date));
				
					while( $current <= $last ) {
						$dates = date('N', $current);
						if($rsa->day == $dates){
							$service_availability[] = array('start_date_time' => date('Y-m-d',$current).' '.$rsa->start_time.':00',
							'end_date_time' => date('Y-m-d',$current).' '.$rsa->end_time.':00');
						}
						$current = strtotime('+1 day', $current);
					}
				}
			}
			//echo '<pre>'; print_r($service_availability); exit;
			// Check response status. If success return data //	

			if(isset($return->response_status))
			{
				if($return->response_status == 1)
				{
					$data['category_list'] = $return_cat->category_list;
					$data['service_details'] = $return->service_details;
					$data['service_availability_list'] = $service_availability;
					$data['request_data'] = $request_data;
				}
				//echo '<pre>'; print_r($data); exit;
				return view('mobile.service.edit_services')->with($data);
			} else {
				return $return;
			}
			
			//return view('website.service.edit_services');
		} else {
			return redirect('create_new_service');
		}
	}


	

}