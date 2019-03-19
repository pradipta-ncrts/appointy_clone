<?php 
/**
 * @Author : NCRTS
 * Client Controller for Website
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

use DateTime;

class ClientsController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function client_list($client_search_text="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['client_search_text']=$client_search_text;
		$data=array(
			'client_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="client_list";
		$return = $this->curl_call($url_func_name,$post_data);

		$service_post_data = $authdata;
		$service_url_func_name="service_list";
		$service_return = $this->curl_call($service_url_func_name,$service_post_data);

		/*$timezone_post_data = $authdata;
		$timezone_url_func_name="timezone_list";
		$timezone_return = $this->curl_call($timezone_url_func_name,$timezone_post_data);*/

		$data = array();
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as $key => $zone)
        {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        //$data = $zones_array;
		
		// Check response status. If success return data //		
		if(isset($return->response_status)){
			if($return->response_status == 1){
				$data['client_list'] = $return->client_list;
				$data['mobile_filter_client_list'] = $return->mobile_filter_client_list;
				$data['client_search_text'] = $client_search_text;
				$data['category_list'] = $service_return->category_list;
				$data['timezone'] = $zones_array;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('mobile.client.client-list')->with($data);
		}
		else{
			return $return;
		}

	}

	public function client_details($client_search_text="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/mobile/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['client_id']=$client_search_text;
		$data=array(
			'client_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="client_details";
		$return = $this->curl_call($url_func_name,$post_data);

		//echo "<pre>"; print_r($return->client_details); exit;
		// Check response status. If success return data //	
		if($return->response_status == 1)
		{
			$data['client_details'] = $return->client_details;
			$data['amount'] = $return->amount;
			$data['total_appo'] = $return->count;
			return view('mobile.client.client-details')->with($data);
		}	
		else
		{
			return $return;
		}
	}

	public function add_client($client_search_text="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('mobile/login');
		}
		
		$data['category_list'] = $this->category_list();
		$data['time_zone'] = $this->time_zone();
		return view('mobile.client.add-client')->with($data);
	}

	public function edit_client(Request $data, $client_id)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('mobile/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['client_id'] = $client_id;
		$data=array(
			'client_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="client_details";
		$return = $this->curl_call($url_func_name,$post_data);

		$data['category_list'] = $this->category_list();
		$data['time_zone'] = $this->time_zone();
		$data['client_details'] = $return->client_details;


		return view('mobile.client.edit-client')->with($data);
	}


	public function client_note($client_search_text="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/mobile/login');
		}


		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['client_id']=$client_search_text;
		$data=array(
			'client_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="client_details";
		$return = $this->curl_call($url_func_name,$post_data);

		// Check response status. If success return data //	
		if($return->response_status == 1)
		{
			$data['client_details'] = $return->client_details;
			return view('mobile.client.client-note')->with($data);
		}	
		else
		{
			return $return;
		}
	}

	public function add_client_notes($client_search_text="")
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('mobile/login');
		}
		$data['add_client'] = array();
		return view('mobile.client.add-client-note')->with($data);
	}

	

	
	
}