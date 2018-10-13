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

class ProfileController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function profile_settings()
	{	
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="profile_settings";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['user_details'] = $return->user_details;
				$data['profession'] = $return->profession;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.profile.profile-settings')->with($data);
		}
		else
		{
			return $return;
		}
		
	}

	public function profile_picture()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="profile_settings";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['user_details'] = $return->user_details;
				$data['profession'] = $return->profession;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.profile.profile-picture')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function profile_link()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="profile_settings";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['user_details'] = $return->user_details;
				$data['profession'] = $return->profession;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.profile.profile-link')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function profile_payment()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="profile_settings";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['user_details'] = $return->user_details;
				$data['profession'] = $return->profession;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.profile.profile-payment')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function profile_login()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		
		$data=array(
			'authdata' => $authdata
		);
		//print_r($post_data); die();
		$url_func_name="profile_settings";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['user_details'] = $return->user_details;
				$data['profession'] = $return->profession;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.profile.profile-login')->with($data);
		}
		else
		{
			return $return;
		}
	}

	public function help()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.help');
		}

		return view('website.help');
	}
}