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

class UsersController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	//***** User Login *****// 
	public function login()
	{
        // Check User Login. If logged in redirect to dashboard //
		$authdata = $this->website_login_checked();
		if((!empty($authdata['user_no']) || $authdata['user_no'] > 0 ) && !empty($authdata['user_request_key'])){
			//$this->remove_all_cookies(); // for manualy cookie remove testing
			return redirect('/dashboard');
		}
        return view('website.user.login.login');
	}

	//***** logout section *****//
	public function logout()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		// API call //
		$post_data = $authdata;
		//print_r($post_data); die();
		$url_func_name="logout";
		$return = $this->curl_call($url_func_name,$post_data);
		// Check response status. If success return data //
		if(isset($return->response_status)){
			return redirect('/login');
		}
		else{
			$this->remove_all_cookies();
			return $return;
		}
	}


	//***** User Registartion *****//
	public function registration(Request $data)
	{
		$email = $data->input('email');
		if($email)
		{
			$condition = array(
                        array('email','=',$email),
                    );
        	$checkEmail = $this->common_model->fetchData('user',$condition);
        	if(!empty($checkEmail))
        	{
        		\Session::flash('error_message', "Email already exists."); 
                return redirect('/');
        	}
        	else
        	{
        		$redirect_url = Crypt::encrypt($email);
        		$redirect_url = url('registration-step1/'.$redirect_url);
        		
				//Send Verification Link
				$emailData['verify_link'] = $redirect_url;
				$emailData['toName'] = '';

				$this->sendmail(1,$email,$emailData);

        		\Session::flash('success_message', "A email sent to your mail.");
        		return redirect('/');
        	}
		}
        return view('website.user.registration.registration');
	}


	//***** User Registartion step 1 *****//

	public function registration_step1(Request $data, $request_url=NULL)
	{
		$data['professions'] = $this->master_data_list($table=$this->tableObj->tableNameProfession);
		$data['country'] = $this->master_data_list($table=$this->tableObj->tableNameCountry);
		$data['request_url'] = $request_url;
		$email = Crypt::decrypt($request_url);
		$condition = array(
                    array('email','=',$email),
                );
    	$checkEmail = $this->common_model->fetchData('user',$condition);
    	if(empty($checkEmail))
    	{
        	return view('website.user.registration.registration1', $data);
        }
        else
        {
        	\Session::flash('error_message', "Email already exists."); 
            return redirect('/');
        }
	}

	//***** User Registartion step 2 *****//
	public function registration_step2($request_url=NULL)
	{
		$data['request_url'] = $request_url;
		$email = Crypt::decrypt($request_url);
		$condition = array(
                    array('email','=',$email),
                );
    	$checkEmail = $this->common_model->fetchData('user',$condition);
    	if(!empty($checkEmail))
    	{
        	$conditions = array(
	                        array('is_blocked', '=', 0),
	                    );
			$data['category'] = $this->master_data_list($table=$this->tableObj->tableNameCategory);
			$data['currency'] = $this->master_data_list($table=$this->tableObj->tableNameCurrency);
	        return view('website.user.registration.registration2',$data);
        }
        else
        {
        	\Session::flash('error_message', "Email already exists."); 
            return redirect('/');
        }
		
	}

	
	//***** Thank You *****//
	public function thank_you()
	{
		$data = array();
		return view('website.user.thank_you')->with($data);
	}

	public function dashboard(Request $data,$type="")
	{
		//echo '<pre>'; print_r($_COOKIE); exit;
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/login');
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
			return view('website.user.dashboard.dashboard')->with($data);
		}
		else
		{
			return $return;
		}

		//return view('website.user.dashboard.dashboard');
	}

	public function business_contact_info()
	{
		// Check User Login. If logged in redirect to dashboard //
		$authdata = $this->website_login_checked();
		if((!empty($authdata['user_no']) || $authdata['user_no'] > 0 ) && !empty($authdata['user_request_key'])){
			$country = $this->master_data_list($table=$this->tableObj->tableNameCountry);
			$professions = $this->master_data_list($table=$this->tableObj->tableNameProfession);


			$user_id = $_COOKIE['sqd_user_no'];

			$condition = array(
	                        array('id','=',$user_id),
	                    );

			$userDetails = $this->common_model->fetchData($this->tableObj->tableNameUser,$condition);
			

			$prof_conditions = array(
                array('profession_id', '=', $userDetails->profession),
            );
            $prof_data = $this->common_model->fetchData($this->tableObj->tableNameProfession, $prof_conditions);

			$country_key = array_search($userDetails->country, array_column($country, 'country_no'));

			$business_location = $userDetails->business_location;
			$data['country_name'] = $country[$country_key]->country_name;
			$data['profession_name'] = $prof_data->profession;
			$data['country'] = $country;
			$data['professions'] = $professions;
			$data['userDetails'] = $userDetails;

			//$this->remove_all_cookies(); // for manualy cookie remove testing
			return view('website.business.business-contact-info', $data);
		}
        return view('website.user.login.login');
	}

	public function business_logo_social_network()
	{
		// Check User Login. If logged in redirect to dashboard //
		$authdata = $this->website_login_checked();
		if((!empty($authdata['user_no']) || $authdata['user_no'] > 0 ) && !empty($authdata['user_request_key'])){

			$user_id = $authdata['user_no'];
			$condition = array(
	                        array('id','=',$user_id),
	                    );

			$userDetails = $this->common_model->fetchData($this->tableObj->tableNameUser,$condition);
			
			$data['userDetails'] = $userDetails;
			//$this->remove_all_cookies(); // for manualy cookie remove testing
			return view('website.business.business-logo-social-network', $data);
		}
        return view('website.user.login.login');
	}



	public function calendar(Request $data)
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['filter_data'] = '';

		//filter staff
		$filter_data = $data->input('appoinmnet_filter_stuff_id');
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
		$url_func_name="appoinment_list";
		$return = $this->curl_call($url_func_name,$post_data);
		
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
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.calendar')->with($data);
		}
		else
		{
			return $return;
		}


	}


	public function gift_certificates()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.gift-certificates');
		}

		return view('website.gift-certificates');
	}

	public function marketing_discount_coupons()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.marketing-discount-coupons');
		}

		return view('website.marketing-discount-coupons');
	}

	public function offers()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.offers');
		}

		return view('website.offers');
	}

	public function reports()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.reports');
		}

		return view('website.reports');
	}

	public function client_database($client_search_text="")
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
				$data['client_search_text'] = $client_search_text;
				$data['category_list'] = $service_return->category_list;
				$data['timezone'] = $zones_array;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.client.client-database')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.client.client-database');

	}

	// Client Export //
	public function client_export(){
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		
		$user_no = $authdata['user_no'];
		$findCond=array(
						array('user_id','=',$user_no),
						array('is_deleted','=','0'),
						array('is_blocked','=','0'),
					);
			
		$selectFields=array('client_name','client_email','client_mobile','client_home_phone','client_work_phone','client_address','client_timezone','client_note','client_dob','is_login_allowed','is_email_verified','is_blocked','created_on');
		$client_list = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$findCond,$selectFields);
			
		$exportData[] = ['Client Name', 'Email','Mobile','Home Phone','Work Phone','Address','Timezone','Note','DOB','Is Login Allowed','Is Email Verified','Is Blocked','Created On'];
		if(!empty($client_list)){
			//$exportData = array('Product Name','Product Description','Regular Price','Sale Price','Product Code','Floor Location','Product Stock','Product Lot','Vendor Code','Second Language Value','Third Language Value','Tags');
			foreach($client_list as $client){
				$exportData[] = array(
					'Client Name'   => ($client->client_name) ? $client->client_name : '',
					'Email'  => ($client->client_email) ? $client->client_email : '',
					'Mobile'   => ($client->client_mobile) ? $client->client_mobile : '',
					'Home Phone'   => ($client->client_home_phone) ? $client->client_home_phone : '',
					'Work Phone'   => ($client->client_work_phone) ? $client->client_work_phone : '',
					'Address'   => ($client->client_address) ? $client->client_address : '',
					'Timezone'   => ($client->client_timezone) ? $client->client_timezone : '',
					'Note'   => ($client->client_note) ? $client->client_note : '',
					'DOB'   => ($client->client_dob & $client->client_dob != '0000-00-00') ? date('m-d-Y',strtotime($client->client_dob)) : '',
					'Is Login Allowed'   => ($client->is_login_allowed) ? $client->is_login_allowed : '0',
					'Is Email Verified'   => ($client->is_email_verified) ? $client->is_email_verified : '0',
					'Is Blocked'   => ($client->is_blocked) ? $client->is_blocked : '0',
					'Created On'   => ($client->created_on) ? $client->created_on : ''
				);
			}
			//echo "<pre>";print_r($exportData);exit;
			$type = 'xls';
			return Excel::create('client_list', function($excel) use ($exportData) {
			$excel->sheet('mySheet', function($sheet) use ($exportData)
			{
				$sheet->fromArray($exportData, null, 'A1', false, false);
			});
			})->download('xlsx');
			
		}
	}

	public function staff_details($staff_search_text="")
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['staff_search_text']=$staff_search_text;

		$data=array(
			'staff_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="staff_list";
		$return = $this->curl_call($url_func_name,$post_data);

		$service_post_data = $authdata;
		$service_url_func_name="service_list";
		$service_return = $this->curl_call($service_url_func_name,$service_post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status)){
			if($return->response_status == 1){
				$data['staff_list'] = $return->staff_list;
				$data['staff_search_text'] = $staff_search_text;
				$data['category_list'] = $service_return->category_list;

			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.staff.staff-details')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.staff.staff-details');
	}


	// Staff Export //
	public function staff_export()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		

		$user_no = $authdata['user_no'];
		$findCond=array(
						array('user_id','=',$user_no),
						array('is_deleted','=','0'),
						array('is_blocked','=','0'),
					);
			
		$selectFields=array('full_name','username','email','mobile','description','home_phone','work_phone','expertise','category_id','addess','staff_profile_picture','is_internal_staff','booking_url','is_login_allowed','is_email_verified','is_blocked','created_on');
		$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);
			
		$exportData[] = ['Staff Name', 'Username','Email','Mobile','Description','Home Phone','Work Phone','Expertise','Category Id','Address','Profile Picture','Is Internal Staff','Booking URL','Is Login Allowed','Is Email Verified','Is Blocked','Created On'];
		if(!empty($staff_list)){
			//$exportData = array('Product Name','Product Description','Regular Price','Sale Price','Product Code','Floor Location','Product Stock','Product Lot','Vendor Code','Second Language Value','Third Language Value','Tags');
			foreach($staff_list as $staff){
				$exportData[] = array(
					'Staff Name'   => ($staff->full_name) ? $staff->full_name : '',
					'Username'    => ($staff->username) ? $staff->username : '',
					'Email'  => ($staff->email) ? $staff->email : '',
					'Mobile'   => ($staff->mobile) ? $staff->mobile : '',
					'Description'   => ($staff->description) ? $staff->description : '',
					'Home Phone'   => ($staff->home_phone) ? $staff->home_phone : '',
					'Work Phone'   => ($staff->work_phone) ? $staff->work_phone : '',
					'Expertise'   => ($staff->expertise) ? $staff->expertise : '',
					'Category Id'   => ($staff->category_id) ? $staff->category_id : '',
					'Address'   => ($staff->addess) ? $staff->addess : '',
					'Profile Picture'   => ($staff->staff_profile_picture) ? $staff->staff_profile_picture : '',
					'Is Internal Staff'   => ($staff->is_internal_staff) ? $staff->is_internal_staff : '0',
					'Booking URL'   => ($staff->booking_url) ? $staff->booking_url : '',
					'Is Login Allowed'   => ($staff->is_login_allowed) ? $staff->is_login_allowed : '0',
					'Is Email Verified'   => ($staff->is_email_verified) ? $staff->is_email_verified : '0',
					'Is Blocked'   => ($staff->is_blocked) ? $staff->is_blocked : '0',
					'Created On'   => ($staff->created_on) ? $staff->created_on : ''
				);
			}
			//echo "<pre>";print_r($exportData);exit;
			$type = 'xls';
			return Excel::create('staff_list', function($excel) use ($exportData) {
			$excel->sheet('mySheet', function($sheet) use ($exportData)
			{
				$sheet->fromArray($exportData, null, 'A1', false, false);
			});
			})->download('xlsx');
			
		}
	}

	public function invite_contacts()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		$user_no = $authdata['user_no'];
		return view('website.invite-contacts');
	}


	public function services($type,$category=false)
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
			return view('website.service.services')->with($data);
		}
		else{
			return $return;
		}

		//return view('website.services');
	}


	public function create_new_service(){
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		return view('website.service.create_new_service');
	}


	public function add_services($type=""){
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		if($type!=""){
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
				return view('website.service.add_services')->with($data);
			}
			else{
				return $return;
			}
		} else {
			return redirect('create_new_service');
		}
		
		//return view('website.service.add_services');
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
			// Check response status. If success return data //		
			if(isset($return->response_status))
			{
				if($return->response_status == 1)
				{
					$data['category_list'] = $return_cat->category_list;
					$data['service_details'] = $return->service_details;
					$data['request_data'] = $request_data;
					
				}
				//echo '<pre>'; print_r($data); exit;
				return view('website.service.edit_services')->with($data);
			} else {
				return $return;
			}
			
			//return view('website.service.edit_services');
		} else {
			return redirect('create_new_service');
		}
	}


	public function settings_business_hours($type="",$staff_search_text="")
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$post_data['staff_search_text']=$staff_search_text;

		$data=array(
			'staff_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="staff_list";
		$return = $this->curl_call($url_func_name,$post_data);

		//$service_post_data = $authdata;
		$service_url_func_name="service_list";
		$service_return = $this->curl_call($service_url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status)){
			if($return->response_status == 1){
				$data['staff_list'] = $return->staff_list;
				$data['staff_search_text'] = $staff_search_text;
				$data['service_list'] = $service_return->service_list;
				$data['type'] = $type;

			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.settings-business-hours')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.settings-business-hours');
	}

	public function booking_options()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.booking-options');
		}

		return view('website.booking-options');
	}


	public function booking_rules()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.booking-rules');
		}

		return view('website.booking-rules');
	}

	public function booking_policies()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.booking-policies');
		}

		return view('website.booking-policies');
	}

	public function notification_settings()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.notification-settings');
		}

		return view('website.notification-settings');
	}

	public function email_confirmation()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.email-confirmation');
		}

		return view('website.email-confirmation');
	}

	public function integration()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.integration');
		}

		return view('website.integration');
	}

	

	public function invitees()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.invitees');
		}

		return view('website.invitees');
	}


	public function payment_options()
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
			//'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="payment_options";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['payment_options'] = $return->payment_options;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.payment.payment-options')->with($data);
		}
		else{
			return $return;
		}
		return view('website.payment.payment-options');
	}

	public function create_invoice()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.create-invoice');
		}

		return view('website.create-invoice');
	}

	public function invoice()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.invoice');
		}

		return view('website.invoice');
	}

	public function invoice_details()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.invoice-details');
		}

		return view('website.invoice-details');
	}

	public function add_location()
	{
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
			return view('website.loaction.add-location')->with($data);
		}
		else{
			return $return;
		}

		//return view('website.add-location');
	}

	public function privacy_settings()
	{
		if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'])
		{
			return view('website.privacy-settings');
		}

		return view('website.privacy-settings');

	}

		

	public function event_viewer(){
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			'event_viewer_list'=>array(),
			'authdata'=>$authdata
		);
		$url_func_name="event_viewer_list";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status)){
			if($return->response_status == 1){
				$data['event_viewer_list'] = $return->event_viewer_list;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.event-viewer')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.event-viewer');
	}


	/******* Test purpose ***** */
	public function cancel_appointent_url()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}

		$parameter =[
			'appointment_id' => 35,
			'client_id' => 2,
        ];
		$parameter= Crypt::encrypt($parameter);
		echo $cancel_appointent_url = url('/client/cancel_appointent',$parameter);
		exit;
	}

}