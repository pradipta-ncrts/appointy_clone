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
			return redirect('mobile/dashboard');
		}
        return view('mobile.user.login.login');
	}

	//***** logout section *****//
	public function logout()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('mobile/login');
		}
		// API call //
		$post_data = $authdata;
		//print_r($post_data); die();
		$url_func_name="logout";
		$return = $this->curl_call($url_func_name,$post_data);

		//print_r($return); die();
		// Check response status. If success return data //
		if(isset($return->response_status)){
			$this->remove_all_cookies();
			return redirect('mobile/login');
		}
		else{
			$this->remove_all_cookies();
			return redirect('mobile/login');
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
                return redirect('/mobile');
        	}
        	else
        	{
        		$redirect_url = Crypt::encrypt($email);
        		$redirect_url = url('mobile/registration-step1/'.$redirect_url);
        		
				//Send Verification Link
				$emailData['verify_link'] = $redirect_url;
				$emailData['toName'] = '';

				$this->sendmail(1,$email,$emailData);

        		\Session::flash('success_message', "A email sent to your mail.");
        		return redirect('/mobile');
        	}
		}
        return view('mobile.user.registration.registration');
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
        	return view('mobile.user.registration.registration1', $data);
        }
        else
        {
        	\Session::flash('error_message', "Email already exists."); 
            return redirect('/mobile');
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
	        return view('mobile.user.registration.registration2',$data);
        }
        else
        {
        	\Session::flash('error_message', "Email already exists."); 
            return redirect('/mobile');
        }
		
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
			return view('mobile.user.dashboard.dashboard')->with($data);
		}
		else
		{
			return $return;
		}

		//return view('website.user.dashboard.dashboard');
	}
	

	public function my_profile()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('mobile/login');
		}

		return view('mobile.profile.my-profile');
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

	public function business_hours()
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
		$url_func_name="staff_service_availability_mobile";
		$return = $this->curl_call($url_func_name,$post_data);

		//$service_post_data = $authdata;
		$service_url_func_name="service_list";
		$service_return = $this->curl_call($service_url_func_name,$post_data);

		/*$staff_list = $return->staff_list;
		$service_list = $return->service_list;
		foreach ($staff_list as $key => $stf) 
		{
			foreach ($service_list as $key => $srv)
			{
				$array_set[] = $srv;
			}
		}
		echo "<pre>";
		print_r($staff_list);
		echo "<pre>";
		print_r($service_list);
		die();
		*/

		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				//$data['availability_list'] = $return->availability_list;
				$data['staff_list'] = $return->staff_list;
				$data['service_list'] = $return->service_list;
			}

			return view('mobile.business.business-hours')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.settings-business-hours');
	}


	

}