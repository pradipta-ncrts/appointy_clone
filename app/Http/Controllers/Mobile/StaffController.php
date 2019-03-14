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

	public function staff_dashboard()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/mobile/login');
		}

		$staff_id = $authdata['user_no'];
		$findCond=array(
            array('staff_id','=',$staff_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array('staff_id','addess','user_id','full_name','username','email','mobile','description','home_phone','work_phone','expertise','category_id','staff_profile_picture','is_internal_staff','booking_url','is_login_allowed','is_email_verified','is_blocked','created_on');
        $staff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff,$findCond,$selectFields);
        $data['staff_details'] = $staff_details;
        //$data['category_list'] = $this->category_list();
		//$data['time_zone'] = $this->time_zone();
		return view('mobile.staff.staff-dashboard')->with($data);
	}

    public function staff_calendar(Request $data)
    {
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/mobile/login');
        }
        // Call API //
        $post_data = $authdata;
        $post_data['page_no']=1;
        $post_data['filter_data'] = '';

        //filter staff
        $post_data['staff_id'] = $authdata['user_no'];
        //print_r($filter_data); die();
        $data=array(
            'appoinment_list'=>array(),
            'authdata'=>$authdata
        );
        //print_r($post_data); die();
        $url_func_name="appoinment_list_staff_mobile";
        $return = $this->curl_call($url_func_name,$post_data);
        
        // Check response status. If success return data //     
        if(isset($return->response_status))
        {
            if($return->response_status == 1)
            {
                $data['appoinment_list'] = $return->appoinment_list;
                $data['staff_list'] = $return->staff_list;
                //$data['staff_list_filter'] = $return->staff_list_filter;
                //$data['calendar_settings'] = $return->calendar_settings;
                //$data['filter_data'] = $return->filter_data;
                //$data['block_date_time'] = $return->block_date_time;
            }
            //echo '<pre>'; print_r($data); exit;
            //return view('mobile.user.calendar.calendar')->with($data);
            return view('mobile.staff.calendar')->with($data);
        }
        else
        {
            return $return;
        }
    }

	public function staff_booking_list(Request $request,$duration)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/mobile/login');
		}

		$staff_id = $authdata['user_no'];
		$current_date = date('Y-m-d');
        $duration = $duration; 
        if($duration=='day')
        {
            $upto_date = strtotime($current_date);
            $upto_date = date('Y-m-d', strtotime("+7 day", $upto_date));
            $appoinment_condition = array(
                array('staff_id', '=', $staff_id),
                array('date','>=',$current_date),
                array('date','<=',$upto_date),
            );
        }
        else if($duration=='month')
        {
            $upto_date = strtotime($current_date);
            $upto_date = date('Y-m-d', strtotime("+30 day", $upto_date));
            $appoinment_condition = array(
                array('staff_id', '=', $staff_id),
                array('date','>=',$current_date),
                array('date','<=',$upto_date),
            );
        }
        else
        {
            $appoinment_condition = array(
                array('staff_id', '=', $staff_id),
            );
        }

         
        // Appoinment section //
        $appoinment_fields = array('appointment_id', 'start_time', 'end_time', 'date','note');
        $stuff_fields = array('full_name as staff_name');
        $service_field = array('service_name', 'cost');
        $currency_field = array('currency');
        $client_field = array('client_name');

        $joins = array(
                    array(
                        'join_table'=>$this->tableObj->tableNameStaff,
                        //'join_table_alias'=>'invItemTb',
                        'join_with'=>$this->tableObj->tableNameAppointment,
                        'join_type'=>'left',
                        'join_on'=>array('staff_id','=','staff_id'),
                        'join_on_more'=>array(),
                        'join_conditions' => array(array('is_deleted','=','0')),
                        'select_fields' => $stuff_fields,
                    ),
                    array(
                        'join_table'=>$this->tableObj->tableNameClient,
                        //'join_table_alias'=>'invItemTb',
                        'join_with'=>$this->tableObj->tableNameAppointment,
                        'join_type'=>'left',
                        'join_on'=>array('client_id','=','client_id'),
                        'join_on_more'=>array(),
                        'join_conditions' => array(array('is_deleted','=','0')),
                        'select_fields' => $client_field,
                    ),
                    array(
                        'join_table'=>$this->tableObj->tableUserService,
                        //'join_table_alias'=>'invItemTb',
                        'join_with'=>$this->tableObj->tableNameAppointment,
                        'join_type'=>'left',
                        'join_on'=>array('service_id','=','service_id'),
                        'join_on_more'=>array(),
                        'join_conditions' => array(array('is_deleted','=','0')),
                        'select_fields' => $service_field,
                    ),
                    array(
                        'join_table'=>$this->tableObj->tableNameCurrency,
                        //'join_table_alias'=>'invItemTb',
                        'join_with'=>$this->tableObj->tableUserService,
                        'join_type'=>'left',
                        'join_on'=>array('currency_id','=','currency_id'),
                        'join_on_more'=>array(),
                        'join_conditions' => array(array('is_deleted','=','0')),
                        'select_fields' => $currency_field,
                    ),
        );
        
        $data['appoinment_list'] = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);
        $data['duration'] = $duration;

        //print_r($data); die();

        return view('mobile.staff.booking-list')->with($data);
	}	

}