<?php
/**
* @Author : NCRTS
* Track :: 1
* Users Controller for Users Registration, login and basic section Related Apis
* oparetion with database
* 
*/

namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;

class BookingsController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	//*client add*//
    public function email_customisation_update(Request $request)
    {
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
		}
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $authdata['user_no'];
        $type = $request->input('type');
        $subject = $request->input('subject') ? $request->input('subject') : '';
        $message = $request->input('message') ? $request->input('message') : '';

         $conditions = array(
                array('type', '=', $type),
                array('user_id', '=', $user_id),
            );
                        
        $check = $this->common_model->fetchData($this->tableObj->tableNameUserEmailCustomisation,$conditions);

        if(empty($check))
        {
            $data['user_id'] = $user_id;
            $data['type'] = $type;
            $data['subject'] = $subject;
            $data['message'] = $message;

            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserEmailCustomisation,$data);
            if($insert)
            {
                $this->response_status='1';
                $this->response_message="Email content successfully updated.";
            }
            else
            {
                $this->response_message="Something went wrong. Please try again later.";
            }
            
        }
        else
        {
            $updateCond=array(
                array('user_id','=',$user_id),
                array('type', '=', $type),
            );

            $data['type'] = $type;
            $data['subject'] = $subject;
            $data['message'] = $message;

            $update = $this->common_model->update_data($this->tableObj->tableNameUserEmailCustomisation,$updateCond,$data);

            $this->response_status='1';
            $this->response_message="Email content successfully updated.";
        } 

        //return redirect('/email-customisation');
        $this->json_output($response_data);
    }

    public function email_customisation_data(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $pageNo = ($pageNo>1)?$pageNo:1;
        $limit=$this->limit;
        $offset=($pageNo-1)*$limit;

        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }
        
        $findCond=array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameUserEmailCustomisation,$findCond,$selectFields);
        $response_data['email_customisation_data']=$staff_list;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function add_appoinment(Request $request)
    {
        //print_r($request->all()); die();
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }
        else{
            $user_id = $this->logged_user_no;
        }

        $validate = Validator::make($request->all(),[
                                 'client'=>'required',
                                 'appoinment_service'=>'required',
                                 'staff'=>'required',
                                 'date'=>'required',
                                 'appointmenttime'=>'required',
                                 'appoinment_note'=>'required'
                                ]);

        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $client = $request->input('client');
            $appoinment_service = $request->input('appoinment_service');
            $staff = $request->input('staff');
            $date = $request->input('date');
            $appointmenttime = $request->input('appointmenttime');
            $appoinment_note = $request->input('appoinment_note');
            $colour_code = $request->input('colour_code');
            $apoinment_mail = $request->input('apoinment_mail');
            $reshedule_appointment_id = $request->input('reshedule_appointment_id');

            //User data using id
            /*$user_condition = array(
                array('id', '=', $user_id)
            );

            $user_fields = array('email', 'mobile', 'business_name', 'street_number', 'city', 'state', 'zip_code');
                        
            $user_details = $this->common_model->fetchData($this->tableObj->tableNameUser,$user_condition, $user_fields);*/


            //Client data using id
            $client_condition = array(
                array('client_id', '=', $client)
            );

            $client_fields = array('client_id', 'client_email', 'client_name');
                        
            $client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$client_condition, $client_fields);

            //Stuff data using id
            $stuff_condition = array(
                array('staff_id', '=', $staff)
            );

            $stuff_fields = array('staff_id', 'email', 'full_name');
                        
            $stuff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff,$stuff_condition, $stuff_fields);

            //Survice details
            $service_condition = array(
                array('service_id', '=', $appoinment_service)
            );

            $sevice_fields = array('service_id', 'service_name', 'cost', 'currency_id', 'duration');
                        
            $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);

            //calculate end time
            $duration = $service_details->duration;
            $service_price = $service_details->cost;
            $service_currency_id = $service_details->currency_id;
            $endTime = strtotime("+".$duration." minutes", strtotime($appointmenttime));
            $endTime = date('h:i A', $endTime); 

            $strto_start_time = strtotime($date.' '.$appointmenttime); 
            $strto_end_time = strtotime($date.' '.$endTime);

            //check date time block or not

            $condition = array(
                array('block_date', '=', date('Y-m-d', strtotime($date))),
                array('is_deleted', '=', '0'),
                array('user_id', '=', $user_id),
                array('staff_id', '=', $staff),
                'raw' => "(($strto_start_time BETWEEN strto_start_time AND strto_end_time) OR ($strto_end_time BETWEEN strto_start_time AND strto_end_time))",
            );

            $fields = array();                   
            $checkBlock = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$condition, $fields);

            //print_r($checkBlock); die();

            if(empty($checkBlock))
            {
                $param = array(
                        'user_id' => $user_id,
                        'service_id' => $appoinment_service,
                        'staff_id' => $staff,
                        'client_id' => $client,
                        'date' => date('Y-m-d', strtotime($date)),
                        'start_time' => $appointmenttime,
                        'end_time' => $endTime,
                        'strto_start_time' => $strto_start_time,
                        'strto_end_time' => $strto_end_time,
                        'colour_code' => $colour_code,
                        'note' => $appoinment_note,
                        'payment_amount' => $service_price,
                        'total_payable_amount' => $service_price,
                    );      
                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameAppointment,$param);
                if($insertdata > 0)
                {
                    if($apoinment_mail)
                    {

                        $parameter = [
                            'appointment_id' => $insertdata,
                            'client_id' => $client,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        $cancel_url = url('/client/cancel_appointent',$parameter);
                        $reschedule_url = url('/client/reschedule-appointment',$parameter);
                        //send mail to client
                        $client_email = $client_details->client_email;
                        $client_name = $client_details->client_name;
                        $staff_email = $stuff_details->email;
                        $staff_name = $stuff_details->full_name;
                        $service_name = $service_details->service_name;
                        $service_cost = $service_details->cost;
                        $service_duration = $service_details->duration;
                        //$service_currency = $service_details->duration;
                        $service_start_time = date('l d, Y h:i A',$strto_start_time);

                        $client_email_data['client_email'] = $client_email;
                        $client_email_data['client_name'] = $client_name;
                        $client_email_data['staff_email'] = $staff_email;
                        $client_email_data['staff_name'] = $staff_name;
                        $client_email_data['service_name'] = $service_name;
                        $client_email_data['service_cost'] = $service_cost;
                        $client_email_data['service_duration'] = $service_duration;
                        $client_email_data['reschedule_url'] = $reschedule_url;
                        $client_email_data['cancel_url'] = $cancel_url;
                        $client_email_data['service_start_time'] = $service_start_time;
                        //$client_email_data['service_currency'] = $service_currency;
                        //$client_email_data['service_start_time'] = $service_start_time;

                        $client_email_data['email_subject'] = "Booking confirmed: ".$service_name." with ".$staff_name." on ".$service_start_time;
                       /* echo "<pre>";
                        print_r($client_email_data); die();*/
                        $this->sendmail(7,$client_email,$client_email_data);


                        //send mail to stuff
                        $stuff_email = $stuff_details->email;
                        $stuff_name = $stuff_details->full_name;
                        $stuff_email_data['email_subject'] = "Booked: ".$service_name." with ".$client_name." on ".$service_start_time;
                        
                        $stuff_email_data['email_data'] = "Booked: ".$service_name." with ".$client_name." on ".$service_start_time;
                        $this->sendmail(8,$staff_email,$stuff_email_data);

                    }

                    // Event Viewer //
				    $this->add_user_event_viewer($user_id,$type=4,$staff);
                    
                    $this->response_status='1';
                    $this->response_message = "An appointment has been successfully booked.";
                }
                else
                {
                    $this->response_message = "Something went wrong. Please try agian later.";
                }
            }
            else
            {
                $this->response_message = "Time slot has already blocked, please try again with other time slots.";
            }
           
            $this->json_output($response_data);
        }
    }


    public function appoinment_list(Request $request)
    {
        //date_default_timezone_set('Asia/Kolkata');
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_no = $other_user_no;
        }
        else{
            $user_no = $this->logged_user_no;
        }

        //print_r($request->all()); die();

        $filter_data = $request->input('filter_data');

        //'in'=>array('grade_no'=>$garde_arr)

        //appoinment data using id
        if(!empty($filter_data))
        {
            $filter_data = explode(',', $filter_data);
            $appoinment_condition = array(
                array('user_id', '=', $user_no),
                'in'=>array('staff_id' => $filter_data)
            );

            $findCond = array(
                array('user_id','=',$user_no),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                'in'=>array('staff_id' => $filter_data)
            );

        }
        else
        {
            $appoinment_condition = array(
                array('user_id', '=', $user_no),
            );

            $findCond = array(
                array('user_id','=',$user_no),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                //'in' => array('')
            );
        }


        $filter_list_condition = array(
                array('user_id','=',$user_no),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
        );
        
        // Appoinment section //
        $appoinment_fields = array('appointment_id', 'staff_id', 'start_time', 'end_time', 'date','colour_code');

        $stuff_fields = array('full_name');

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
        );
        
        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);
        $appoinment_array = array();
        foreach ($appoinment_list as $key => $value)
        {
            $appoinment_array[] = array(
                    'service_name' => $value->full_name,
                    'appointment_id' => $value->appointment_id,
                    'start_date' => date('D d, M Y H:i:s e', strtotime($value->date.' '.$value->start_time)),
                    'end_time' => date('D d, M Y H:i:s e', strtotime($value->date.' '.$value->end_time)),
                    'colour_code' => $value->colour_code,
                    'staff_id' => $value->staff_id,
            );
        }

        // Staff Section //
        $selectFields = array('staff_id','full_name','email', 'staff_profile_picture');
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);

        // Staff Section for filter list//
        $selectFieldsFilter = array('staff_id','full_name','email', 'staff_profile_picture');
        $staff_list_filter = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$filter_list_condition,$selectFieldsFilter);

        // Calendar Settings //
        $selectCond = array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0')
        );
        $selectFields = array('ca_settings_id','show_from','show_till', 'increment');
        $calendar_settings = $this->common_model->fetchData($this->tableObj->tableNameCalendarSettings,$selectCond,$selectFields);


        //block date & time data

        $blockCondition = array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        $blockFields = array('staff_id','block_date','start_time', 'end_time', 'block_reasons');
        $blockDateTime = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$blockCondition,$blockFields);
        $block_date_array = array();
        foreach ($blockDateTime as $key => $blkdt)
        {
            $start_time = $blkdt->start_time ? date('D d, M Y H:i:s e', strtotime($blkdt->block_date.' '.$blkdt->start_time)) : date('D d, M Y H:i:s e', strtotime($blkdt->block_date.' '.'00:00'));

            $end_time = $blkdt->end_time ? date('D d, M Y H:i:s e', strtotime($blkdt->block_date.' '.$blkdt->end_time)) : date('D d, M Y H:i:s e', strtotime($blkdt->block_date.' '.'23:59'));

            $block_date_array[] = array(
                        'block_staff_id' => $blkdt->staff_id,
                        'block_start_time' => $start_time,
                        'block_end_time' => $end_time,
                        'block_reasons' => $blkdt->block_reasons,
            );
        }

        $response_data['staff_list'] = $staff_list;
        $response_data['appoinment_list'] = $appoinment_array;
        $response_data['staff_list_filter'] = $staff_list_filter;
        $response_data['calendar_settings'] = $calendar_settings;
        $response_data['filter_data'] = $filter_data;
        $response_data['block_date_time'] = $block_date_array;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function appointment_details(Request $request)
    {
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_no = $other_user_no;
        }
        else{
            $user_no = $this->logged_user_no;
        }

        $appointment_id = $request->input('appointment_id'); 
        //appoinment data using id
        $appoinment_condition = array(
            array('user_id', '=', $user_no),
            array('appointment_id', '=', $appointment_id)
        );

        $appoinment_fields = array();

        $client_fields = array('client_name','client_email','client_profile_picture');

        $service_fields = array('service_name','cost','duration');

        $stuff_fields = array('full_name');

        $currency_field = array('currency');

        $joins = array(
                    array(
                    'join_table'=>$this->tableObj->tableNameClient,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableNameAppointment,
                    'join_type'=>'left',
                    'join_on'=>array('client_id','=','client_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $client_fields,
                ),
                array(
                    'join_table'=>$this->tableObj->tableNameStaff,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableNameAppointment,
                    'join_type'=>'left',
                    'join_on'=>array('staff_id','=','staff_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $stuff_fields,
                ),
                array(
                    'join_table'=>$this->tableObj->tableUserService,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableNameAppointment,
                    'join_type'=>'left',
                    'join_on'=>array('service_id','=','service_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $service_fields,
                ),
                array(
                    'join_table'=>$this->tableObj->tableNameCurrency,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableUserService,
                    'join_type'=>'left',
                    'join_on'=>array('currency_id','=','currency_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $currency_field,
                ),
        );
        
        $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);

        if($appoinment_details->duration > 60)
        {
            $app_duration = $this->convertToHoursMins($appoinment_details->duration);
        }
        else
        {
            $app_duration = $appoinment_details->duration;
        }

        $appoinmnet = array(
                "appointment_id" => $appoinment_details->appointment_id,
                "client_email" => $appoinment_details->client_email,
                "client_name" => $appoinment_details->client_name,
                "client_image" => $appoinment_details->client_profile_picture,
                "client_id" => $appoinment_details->client_id,
                "cost" => $appoinment_details->cost,
                "currency" => $appoinment_details->currency,
                "booked_on" => date('d, M Y',strtotime($appoinment_details->created_on)),
                "updated_on" => date('d, M Y',strtotime($appoinment_details->updated_on)),
                "appoinment_date" => date('d, M Y',strtotime($appoinment_details->date)),
                "duration" => $app_duration,
                "end_time" => $appoinment_details->end_time,
                "paid_amount" => $appoinment_details->paid_amount,
                "remaining_balance" => $appoinment_details->remaining_balance,
                "start_time" => $appoinment_details->start_time,
                "staff_name" => $appoinment_details->full_name,
                "service_name" => $appoinment_details->service_name,
                "service_id" => $appoinment_details->service_id,
                "status" => $appoinment_details->status,
                "payment_status" => $appoinment_details->payment_status,
                "payment_note" => $appoinment_details->payment_note,
                "payment_amount" => $appoinment_details->payment_amount,
                "additional_amount" => $appoinment_details->additional_amount,
                "discount_amount" => $appoinment_details->discount_amount,
                "gift_certificate_amount"=> $appoinment_details->gift_certificate_amount,
                "gift_voucher_id" => $appoinment_details->gift_voucher_id,
                "total_payable_amount" => $appoinment_details->total_payable_amount,
                "appoinment_raw_date" => date('m/d/Y',strtotime($appoinment_details->date)),
                "appoinment_raw_time" => $appoinment_details->start_time,
                "staff_id" => $appoinment_details->staff_id,
                "note" => $appoinment_details->note,
        );
        
        $response_data['appoinment_details'] = $appoinmnet;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function appoinment_cancel(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }
        else{
            $user_id = $this->logged_user_no;
        }

        $appoinment_id = $request->input('appoinment_id');
        $user_id = $user_id;


        $updateCond=array(
            array('user_id','=',$user_id),
            array('appointment_id', '=', $appoinment_id),
        );

        $data['status'] = '2';
        $data['is_deleted'] = '1';
        $data['cancelled_by'] = '1';

        $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data);

        // Event Viewer //
        $this->add_user_event_viewer($user_no,$type=6);

        $this->response_status='1';
        $this->response_message="Appointment has been cancelled successfully.";

        $this->json_output($response_data);
        
    }


    public function calendar_settings(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }else{
            $user_id = $this->logged_user_no;
        }

        $show_from = $request->input('show_from');
        $show_till = $request->input('show_till');
        $increment = $request->input('increment');

        $conditions = array(
            array('user_id', '=', $user_id)
        );
                    
        $check = $this->common_model->fetchData($this->tableObj->tableNameCalendarSettings,$conditions);
        if(!empty($check)){
            // Update //
            $data['show_from'] = $show_from;
            $data['show_till'] = $show_till;
            $data['increment'] = $increment;

            $update = $this->common_model->update_data($this->tableObj->tableNameCalendarSettings,$conditions,$data);

            $this->response_status='1';
            $this->response_message = "Calendar view settings has been updated successfully.";
        } else {
            // Insert //
            $param = array(
                'user_id' => $user_id,
                'show_from' => $show_from,
                'show_till' => $show_till,
                'increment' => $increment,
            );
            $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameCalendarSettings,$param);
            if($insertdata > 0)
            {
                $this->response_status='1';
                $this->response_message = "Calendar view settings has been updated successfully.";
            } 
            else
            {
                $this->response_message = "Something went wrong. Please try agian later.";
            }

        }

        $this->json_output($response_data);
    }

    public function reschedule_appoitment(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }
        else{
            $user_id = $this->logged_user_no;
        }
            $reshedule_appointment_id = $request->input('reshedule_appointment_id');
            $reshedule_service_id = $request->input('reshedule_service_id');
            $reshedule_date = $request->input('reshedule_date');
            $reshedule_appointmenttime = $request->input('reshedule_appointmenttime');
            $reshedule_staff_id = $request->input('reshedule_staff_id');

            //Survice duration
            $service_condition = array(
                array('service_id', '=', $reshedule_service_id)
            );

            $sevice_fields = array('service_id', 'duration');
                        
            $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);
            

            //calculate end time
            $duration = $service_details->duration;
            $endTime = strtotime("+".$duration." minutes", strtotime($reshedule_appointmenttime));
            $endTime = date('h:i A', $endTime); 
            $strto_start_time = strtotime($reshedule_date.' '.$reshedule_appointmenttime);
            $strto_end_time = strtotime($reshedule_date.' '.$endTime);

            $condition = array(
                array('block_date', '=', date('Y-m-d', strtotime($reshedule_date))),
                array('is_deleted', '=', '0'),
                array('user_id', '=', $user_id),
                array('staff_id', '=', $reshedule_staff_id),
                'raw' => "(($strto_start_time BETWEEN strto_start_time AND strto_end_time) OR ($strto_end_time BETWEEN strto_start_time AND strto_end_time))",
            );

            $fields = array();                   
            $checkBlock = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$condition, $fields);

            //print_r($checkBlock); die();

            if(empty($checkBlock))
            {
                $param = array(
                        'date' => date('Y-m-d', strtotime($reshedule_date)),
                        'start_time' => $reshedule_appointmenttime,
                        'end_time' => $endTime,
                        'strto_start_time' => $strto_start_time,
                        'strto_end_time' => $strto_end_time,
                        'status' => '3',
                        'updated_on' => date('Y-m-d H:i:s')
                    );

                $updateCond=array(
                    array('appointment_id','=',$reshedule_appointment_id)
                );
                $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$param);

                // Event Viewer //
                $this->add_user_event_viewer($user_no,$type=5,$reshedule_staff_id);
                    
                $this->response_status='1';
                $this->response_message = "Appointment has been rescheduled successfully .";
            }
            else
            {
                $this->response_message = "The timeslot has already blocked. Please try another timeslot.";
            }
            
            $this->json_output($response_data);
    }


    public function update_payment_info(Request $request)
    {
        $response_data=array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');

        if(!empty($other_user_no) && $other_user_no!=0){
        $user_no = $other_user_no;
        }
        else{
        $user_no = $this->logged_user_no;
        }

        $total_amount_tobe_paid = $request->input('total_amount_tobe_paid');
        $appointment_id = $request->input('appointment_id');
        $payment_method = $request->input('payment_method');
        $payment_amount = $request->input('payment_amount');
        $additional_charges = $request->input('additional_charges');
        $discount_amount = $request->input('discount_amount');
        $payment_note = $request->input('payment_note');
        
        if(($payment_amount+$additional_charges)>=$discount_amount)
        {
            //$remaining_balance = $total_amount_tobe_paid - (($payment_amount+$additional_charges)-$discount_amount);
            $paid_amount = (($payment_amount+$additional_charges)-$discount_amount);
            $param = array(
                    'paid_amount' => $paid_amount,
                    'remaining_balance' => '0.00',
                    'total_payable_amount' => $paid_amount, 
                    'payment_method' => $payment_method,
                    'additional_amount' => $additional_charges,
                    'discount_amount' => $discount_amount,
                    'payment_note' => $payment_note,
                    'payment_status' => '1'
            );

            $updateCond=array(
                array('appointment_id','=',$appointment_id),
            );

            $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$param);

            $this->response_status='1';
            $this->response_message = "Payment successfully updated.";
        }
        else
        {
            $this->response_message = "Sorry! Discount amount should be lass than or equal to payble amount.";
        }

        $this->json_output($response_data);
    }


    public function staffs_list(Request $request)
    {
        //date_default_timezone_set('Asia/Kolkata');
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_no = $other_user_no;
        }
        else{
            $user_no = $this->logged_user_no;
        }

        $staf_id = $request->input('staf_id');
        $staf_id = explode(',', $staf_id);

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            'in'=>array('staff_id' => $staf_id)
        );
        
        $selectFields=array();
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);

        $staffs_name = array();
        $staffs_ids = array();
        foreach ($staff_list as $key => $value) 
        {
            $staffs_name[] = $value->full_name;
            $staffs_ids[] = $value->staff_id;
        }

        $staffs_name = implode(',', $staffs_name);
        $staffs_ids = implode(',', $staffs_ids);

        $this->response_status='1';
        $response_data['staffs_name'] = $staffs_name;
        $response_data['staffs_ids'] = $staffs_ids;
        $this->json_output($response_data);

    }

    public function update_appointment_note(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $user_id = $this->logged_user_no;

        $appoinment = $request->input('appoinment-id');
        $booking_note = $request->input('booking_note');

        //Condition
        $appo_condition = array(
        array('appointment_id', '=', $appoinment),
        array('user_id', '=', $user_id)
        );
        $appointment_chk = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appo_condition, $fields=array());
        if(!empty($appointment_chk))
        {
            $param = array(
                'note' => $booking_note,
                'updated_on' => date('Y-m-d H:i:s'),
                );

            $this->common_model->update_data($this->tableObj->tableNameAppointment,$appo_condition,$param);

            $this->response_status='1';
            $this->response_message = "Appointment note has been updated successfully.";
        }
        else
        {
            $this->response_message = "Appointment is not assoiated with this user.";
        }
            $this->json_output($response_data);
    }

    public function add_block_date(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }
        else{
            $user_id = $this->logged_user_no;
        }

        $start_time = $request->input('bolck_start_time');
        $end_time = $request->input('bolck_end_time');
        $block_date = explode(',', $request->input('block_date'));
        $date_block_for = $request->input('date_block_for');
        $staff_ids = explode(',', $request->input('date_block_for_ids'));
        $date_block_reasons = $request->input('date_block_reasons');
        $date_block_note = $request->input('date_block_note');
        $user_id = $user_id;
        //check date in appointment table
        $format_date = array();
        foreach ($block_date as $key => $value)
        {
            $format_date[] = date('Y-m-d', strtotime($value));
        }

        //$format_date = implode($format_date);
        $findCond = array(
            array('is_deleted','=','0'),
            'in'=>array('date' =>  $format_date),
        );

        $select_fields = array('staff_id');

        $appoinment_staff_ids = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$findCond,$select_fields);

        $new_appoinment_staff_ids = array();
        foreach ($appoinment_staff_ids as $key => $value)
        {
            if(in_array($value->staff_id, $staff_ids))
            {
                $new_appoinment_staff_ids[] = $value->staff_id;
            }
        }

        if(!empty($new_appoinment_staff_ids))
        {
            $this->response_status = '0';
            $this->response_message = "It seems an appointment has already scheduled for staff/staffs, hence you can't able to block.";
        }
        else
        {
            $count = 0;
            foreach ($block_date as $key => $date)
            {
                foreach ($staff_ids as $key => $block_user)
                {
                    $newDateFormat = date('Y-m-d', strtotime($date));
                    $condition = array(
                            array('block_date', '=', $newDateFormat),
                            array('staff_id', '=', $block_user),
                            array('is_deleted', '=', '0'),
                            array('is_blocked', '=', '0'),
                            array('user_id', '=', $user_id),
                        );

                    $fields = array();
                                
                    $checkDate = $this->common_model->fetchData($this->tableObj->tableNameBlockDateTime,$condition, $fields);
                    if(empty($checkDate))
                    {
                        if($start_time && $end_time)
                        {
                            $strto_start_time = strtotime($newDateFormat.' '.$start_time);
                            $strto_end_time = strtotime($newDateFormat.' '.$end_time);
                        }
                        else
                        {
                            $strto_start_time = strtotime($newDateFormat.' 12:00 AM');
                            $strto_end_time = strtotime($newDateFormat.' 11:59 PM');
                        }
                         
                         $param = array(
                                'user_id' => $user_id,
                                'staff_id' => $block_user,
                                'block_date' => $newDateFormat,
                                'block_reasons' => $date_block_reasons,
                                'block_note' => $date_block_note,
                                'start_time' => $start_time,
                                'end_time' => $end_time,
                                'strto_start_time' => $strto_start_time,
                                'strto_end_time' => $strto_end_time,
                         );  

                         $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameBlockDateTime,$param);
                    }
                }
                $count++;
            }
            
            if($count > 0)
            {
                $this->response_status = '1';
                $this->response_message = "Date has been blocked for staff/staffs successfully.";
            }
            else
            {
                $this->response_status = '0';
                $this->response_message = "Something went wrong. Please try again later.";
            }
        }

        $this->json_output($response_data);
        
    }

    public function add_block_time(Request $request)
    {
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_id = $other_user_no;
        }
        else{
            $user_id = $this->logged_user_no;
        }

        $bolck_start_time = $request->input('bolck_start_time');
        $bolck_end_time = $request->input('bolck_end_time');
        $block_time_date = $request->input('block_time_date');
        $staff_ids = explode(',', $request->input('time_block_for_ids'));
        $block_time_reason = $request->input('block_time_reason');
        $block_time_note = $request->input('block_time_note');
        $user_id = $user_id;

        /*echo $sql = "SELECT MIN(strto_start_time), MAX(strto_end_time) FROM squ_appointment";

        die();*/

        $start_time_check = strtotime($block_time_date.' '.$bolck_start_time);
        $end_time_check = strtotime($block_time_date.' '.$bolck_end_time);

        $condition = array(
            array('date', '=', date('Y-m-d', strtotime($block_time_date))),
            array('is_deleted', '=', '0'),
            array('user_id', '=', $user_id),
            //'raw' => "($start_time_check BETWEEN strto_start_time AND strto_end_time)",
            'raw' => "((strto_start_time BETWEEN $start_time_check AND $end_time_check) OR (strto_end_time BETWEEN $start_time_check AND $end_time_check))",
            'in' => array('staff_id' =>  $staff_ids),
        );

        $fields = array();                   
        $checkArray = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$condition, $fields);
        if(!empty($checkArray))
        {
            $this->response_status = '0';
            $this->response_message = "It seems an appointment has already scheduled for staff/staffs, hence you can't able to block.";
        }
        else
        {
            $count = 0;
            foreach ($staff_ids as $key => $block_user)
            {
                $newDateFormat = date('Y-m-d', strtotime($block_time_date));
                $condition = array(
                        array('block_date', '=', $newDateFormat),
                        array('staff_id', '=', $block_user),
                        array('start_time', '=', $bolck_start_time),
                        array('end_time', '=', $bolck_end_time),
                        array('is_deleted', '=', '0'),
                        array('is_blocked', '=', '0'),
                        array('user_id', '=', $user_id),
                    );

                $fields = array();
                            
                $checkDate = $this->common_model->fetchData($this->tableObj->tableNameBlockDateTime,$condition, $fields);
                if(empty($checkDate))
                {
                     $strto_start_time = strtotime($newDateFormat.' '.$bolck_start_time);
                     $strto_end_time = strtotime($newDateFormat.' '.$bolck_end_time);
                     $param = array(
                            'user_id' => $user_id,
                            'staff_id' => $block_user,
                            'block_date' => $newDateFormat,
                            'start_time' => $bolck_start_time,
                            'end_time' => $bolck_end_time,
                            'block_reasons' => $block_time_reason,
                            'block_note' => $block_time_note,
                            'strto_start_time' => $strto_start_time,
                            'strto_end_time' => $strto_end_time
                     );  

                     $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameBlockDateTime,$param);
                }

                $count++;
            }
            if($count > 0)
            {
                $this->response_status = '1';
                $this->response_message = "Timeslot has been blocked successfully.";
            }
            else
            {
                $this->response_status = '0';
                $this->response_message = "Something went wrong. Please try again later.";
            }
        }

        $this->json_output($response_data);
        
    }

    public function save_booking_policy(Request $request)
    {
           // Check User Login. If not logged in redirect to login page //
            $authdata = $this->website_login_checked();
            if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
                      return redirect('/login');
            }
                   //echo '<pre>'; print_r($request->all()); exit;
           $response_data=array();
           $this->validate_parameter(1);
           $user_id = $this->logged_user_no;

           
           $type = $request->input('type');
           $content = $request->input('content');

           $conditions = array(
               array('type', '=', $type),
               array('user_id' ,'=', $user_id)
           );
             
           $result = $this->common_model->fetchData($this->tableObj->tableNameBookingPolicy,$conditions);
           if(!empty($result))
           {
               // Update //
               $update_policy_data['content'] = $content;
               $this->common_model->update_data($this->tableObj->tableNameBookingPolicy,$conditions,$update_policy_data);
               
               $this->response_status='1';
               $this->response_message = "Policy content has been updated successfully.";
           }
           else
           {
               // Insert //
               $policy_data['user_id'] = $user_id;
               $policy_data['type'] = $type;
               $policy_data['content'] = $content;

               $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameBookingPolicy,$policy_data);
               if($insertdata > 0){
                   $this->response_status='1';
                   $this->response_message = "Policy content has been added successfully.";
               } else {
                   $this->response_message = "Something went wrong. Please try agian later.";
               }
               
           }

           $this->json_output($response_data);

    }

    public function booking_policy_list(Request $request)
    {
        $response_data=array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');

        if(!empty($other_user_no) && $other_user_no!=0){
        $user_no = $other_user_no;
        }
        else{
        $user_no = $this->logged_user_no;
        }
               
        $findCond=array(
                   array('user_id','=',$user_no),
        array('is_deleted','=','0')
        );

        $selectFields=array();
        $policy_list = $this->common_model->fetchDatas($this->tableObj->tableNameBookingPolicy,$findCond,$selectFields);
        $response_data['policy_list']=$policy_list;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }


    public function update_notification_settings(Request $request)
    {
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_id = $other_user_no;
        }
        else
        {
            $user_id = $this->logged_user_no;
        }

        $type = $request->input('field_name');
        $veriable = $request->input('post_veriable') ? $request->input('post_veriable') : '';

        $conditions = array(
                array('user_id', '=', $user_id),
            );
                        
        $check = $this->common_model->fetchData($this->tableObj->tableNameNotificationSettings,$conditions);
        if(empty($check))
        {
            $data['user_id'] = $user_id;
            $data[$type] = $veriable;
            
            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationSettings,$data);
            if($insert)
            {
                $this->response_status='1';
                $this->response_message="Successfully updated.";
            }
            else
            {
                $this->response_message="Something went wrong. Please try again later.";
            }
            
        }
        else
        {
            $updateCond=array(
                array('user_id','=',$user_id),
            );

            if($type=='is_email_send')
            {
                $veriable = $check->is_email_send==1 ? 0 : 1;
            }

            if($type=='is_sms_send')
            {
                $veriable = $check->is_sms_send==1 ? 0 : 1;
            }

            if($type=='is_admin')
            {
                $veriable = $check->is_admin==1 ? 0 : 1;
            }
            
            if($type=='is_stuff')
            {
                $veriable = $check->is_stuff==1 ? 0 : 1;
            }

            

            $data[$type] = $veriable;

            $update = $this->common_model->update_data($this->tableObj->tableNameNotificationSettings,$updateCond,$data);

            $this->response_status='1';
            $this->response_message="Successfully updated.";
        } 

        //return redirect('/email-customisation');
        $this->json_output($response_data);
    }

    public function notification_settings_data(Request $request)
    {
        $response_data=array();
        $this->validate_parameter(1);
        if(!empty($other_user_no) && $other_user_no!=0)
        {
            $user_id = $other_user_no;
        }
        else
        {
            $user_id = $this->logged_user_no;
        }

        $conditions = array(
                array('user_id', '=', $user_id),
            );
                        
        $notification_settings_data = $this->common_model->fetchData($this->tableObj->tableNameNotificationSettings,$conditions);
        

        $response_data['notification_settings_data'] = $notification_settings_data;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

        
}