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

class StaffController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}


	public function staff_list()
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
		$url_func_name="staff_list";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status)){
			if($return->response_status == 1){
				$data['staff_list'] = $return->staff_list;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.staff.staff-list')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.staff.staff-details');
	}

	public function add_staff()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('mobile/login');
		}
		
		$data['category_list'] = $this->category_list();
		$data['time_zone'] = $this->time_zone();
		return view('mobile.staff.add-staff')->with($data);
	}


	

}