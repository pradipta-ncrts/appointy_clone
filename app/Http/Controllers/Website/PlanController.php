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

class PlanController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function settings_membership()
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
		$url_func_name="settings_membership";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['plan_list'] = $return->plan_list;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.plan.settings-membership')->with($data);
		}
		else
		{
			return $return;
		}
		
	}
}