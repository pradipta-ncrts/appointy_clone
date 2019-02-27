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
            //print_r($data); die();

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
            //print_r($data); die();

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
        //fetch master email template data
        $masterTempCondition = array(
            array('is_blocked','=','0'),
        );
        $masterTempField = array();
        $masterTempData = $this->common_model->fetchDatas($this->tableObj->tableNameEmailTemplateMaster,$masterTempCondition,$masterTempField);

        $response_data['email_customisation_data'] = $staff_list;
        $response_data['master_template_data'] = $masterTempData;
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

            $formatted_date = date('Y-m-d',strtotime($date));

            $appointmenttime = $request->input('appointmenttime');

            $appoinment_note = $request->input('appoinment_note');

            $colour_code = $request->input('colour_code');

            $apoinment_mail = $request->input('apoinment_mail');

            $reshedule_appointment_id = $request->input('reshedule_appointment_id');

            $numeric_day = date('N', strtotime($date));



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

            $sevice_fields = array('service_id', 'service_name', 'cost', 'currency_id', 'duration', 'location');    

            $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);



            //calculate end time

            $duration = $service_details->duration;

            $service_price = $service_details->cost;

            $service_currency_id = $service_details->currency_id;

            $endTime = strtotime("+".$duration." minutes", strtotime($appointmenttime));

            $endTime = date('h:i A', $endTime); 



            $strto_start_time = strtotime($date.' '.$appointmenttime); 

            $strto_end_time = strtotime($date.' '.$endTime);





            // Check Service Availability Date//

            $ser_ava_condition = array(

                array('user_id', '=', $user_id),

                array('service_id', '=', $appoinment_service),

                array('day', '=', $numeric_day),

                array('is_deleted', '=', '0'),

                'raw' => "((start_date <= '".$formatted_date."' AND end_date >= '".$formatted_date."') OR (start_date <= '".$formatted_date."' AND end_date = '0000:00:00'))",

            );



            $ser_ava_fields = array();                   

            $checkServiceAvalibilityDate = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability,$ser_ava_condition, $ser_ava_fields);

            //print_r($checkServiceAvalibilityDate); die();

            if(!empty($checkServiceAvalibilityDate)){

                // Check Service Availability Time//

                $service_available = 'false';

                foreach($checkServiceAvalibilityDate as $ser_ava_dt){

                    $ava_starttime = strtotime($formatted_date.' '.$ser_ava_dt->start_time.':00');

                    $ava_endtime = strtotime($formatted_date.' '.$ser_ava_dt->end_time.':00');

                    if($strto_start_time >= $ava_starttime && $strto_end_time <= $ava_endtime){

                        $service_available = 'true';

                        break;

                    }

                }

                //echo $service_available; exit;

                if($service_available == true){

                    // Check Staff Availability //

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

                    if(empty($checkBlock)) {

                        // Check Staff-Service Availability //

                        $ser_staff_ava_condition = array(

                            array('staff_id', '=', $staff),

                            array('service_id', '=', $appoinment_service),

                            array('day', '=', $numeric_day),

                            array('is_blocked', '=', '0'),

                            array('is_deleted', '=', '0'),

                        );

    

                        $fields = array();                   

                        $checkStaffServiceAvalibility = $this->common_model->fetchDatas($this->tableObj->tableNameStaffServiceAvailability,$ser_staff_ava_condition, $fields);

                        //echo '<pre>'; print_r($checkStaffServiceAvalibility); exit;

                        if(!empty($checkStaffServiceAvalibility)){

                            // Check Available Time //

                            $staff_serviice_available = false;

                            foreach($checkStaffServiceAvalibility as $staff_ser_ava){

                                $available_starttime = strtotime($formatted_date.' '.$staff_ser_ava->start_time);

                                $available_endtime = strtotime($formatted_date.' '.$staff_ser_ava->end_time);

                                if($strto_start_time >= $available_starttime && $strto_end_time <= $available_endtime){

                                    $staff_serviice_available = true;

                                    break;

                                }

                            }

                            //echo $staff_serviice_available; exit;

                            if($staff_serviice_available == true){

                                $order_id = 'SQU'.time().mt_rand().$user_id;

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

                                    'order_id' => $order_id,

                                );  

                                //echo '<pre>'; print_r($param); exit;    

                                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameAppointment,$param);

                                if($insertdata > 0)

                                {

                                    if($apoinment_mail)

                                    {

            

                                        /*$parameter = [

                                            'appointment_id' => $insertdata,

                                            'client_id' => $client,

                                        ];*/
                                        $parameter = [
                                            'order_id' => $order_id,
                                            'client_id' => $client,
                                            'user_id' => $user_id,
                                            'recurring_booking_frequency' => 0
                                        ];

                                        $parameter= Crypt::encrypt($parameter);

                                        //$cancel_url = url('/client/cancel_appointent/'.$parameter.'/'.$order_id);

                                        //$reschedule_url = url('/client/reschedule-appointment/'.$parameter.'/'.$order_id);

                                        $cancel_url = url('/client/booking-details/'.$parameter.'/'.$order_id);

                                        $reschedule_url = url('/client/booking-details/'.$parameter.'/'.$order_id);


                                        //send mail to client

                                        $client_email = $client_details->client_email;

                                        $client_name = $client_details->client_name;

                                        $staff_email = $stuff_details->email;

                                        $staff_name = $stuff_details->full_name;

                                        $service_name = $service_details->service_name;

                                        $service_cost = $service_details->cost;

                                        $service_duration = $service_details->duration;

                                        $service_location = $service_details->location;

                                        //$service_currency = $service_details->duration;

                                        $service_start_time = date('l d, Y h:i A',$strto_start_time);



                                        //check user subscription

                                        $email_template = $this->email_template($user_id,$type = 5);



                                        $templateHeader = '<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">

                                           <table width="100%">

                                              <tr>

                                                 <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>

                                                 <td style="color:#FFF; text-align: right; " >&nbsp;</td>

                                              </tr>

                                           </table>

                                        </div>';

                                        $templateFooter = '<div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">

                                           <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>

                                           <p style="text-align:center">For even easier management of your appointments.</p>

                                           <div style="text-align:center;">

                                              <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a> 

                                              <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  

                                           </div>

                                        </div>

                                        <div style="text-align:center">

                                           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>

                                           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>

                                           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>

                                           <br><br>

                                           <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>

                                           <p>Copyright &copy; '.date('Y').'</p>

                                        </div>';



                                        $mail_body = $email_template->message;

                                        $mail_body = str_replace('{header}', $templateHeader, $mail_body);

                                        $mail_body = str_replace('{client_name}', $client_email, $mail_body);

                                        $mail_body = str_replace('{service_name}', $service_name, $mail_body);

                                        $mail_body = str_replace('{staff_name}', $staff_name, $mail_body);

                                        $mail_body = str_replace('{booking_time}', $service_start_time, $mail_body);

                                        $mail_body = str_replace('{location}', $service_location, $mail_body);

                                        $mail_body = str_replace('{staff_email}', $staff_email, $mail_body);

                                        $mail_body = str_replace('{reshedule_url}', $reschedule_url, $mail_body);

                                        $mail_body = str_replace('{cancel_url}', $cancel_url, $mail_body);

                                        $mail_body = str_replace('{footer}', $templateFooter, $mail_body);



                                        $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Booking Confirm';

                                        $emailData['content'] = $mail_body;



                                        $this->sendmail(7,$client_email,$emailData);

            

            
                                        if($staff > 0){
                                            //send mail to stuff



                                            $stuff_email_data['client_name'] = $client_name;
                                            
                                            $stuff_email_data['staff_email'] = $staff_email;

                                            $stuff_email_data['staff_name'] = $staff_name;

                                            $stuff_email_data['service_name'] = $service_name;

                                            $stuff_email_data['service_cost'] = $service_cost;

                                            $stuff_email_data['service_duration'] = $service_duration;

                                            $stuff_email_data['service_location'] = $service_location;

                                            $stuff_email_data['reschedule_url'] = $reschedule_url;

                                            $stuff_email_data['cancel_url'] = $cancel_url;

                                            $stuff_email_data['service_start_time'] = $service_start_time;

                                            $stuff_email_data['email_subject'] = "Booking Confirm";



                                            $this->sendmail(8,$staff_email,$stuff_email_data);

                                        }
                                        

            

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

                            } else {

                                $this->response_message = "Staff is not available for this service. Please set staff availability aginst the service.";

                            }



                            

                        } else {

                            $this->response_message = "Staff is not available for this service. Please set staff availability aginst the service.";

                        }

                        

                    }

                    else

                    {

                        $this->response_message = "Staff is not availble, please try again with other time slots.";

                    }

                } else{

                    $this->response_message = "Service is not availble, please try again with other time slots.";

                }



            } else{

                $this->response_message = "Service is not availble, please try again with other time slots.";

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
        $service_id = $request->input('service_id');
        $staff_ids_array = '';
        if(isset($service_id) && $service_id)
        {
            $appointment_service_field = array('staff_id');
            $service_condition = array(
                array('service_id', '=', $service_id),
                array('status', '!=', 2),
                array('is_deleted','=','0'),
            );

            $staff_ids = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$service_condition,$appointment_service_field,$joins = array(), $orderBy = array(), $groupBy = 'staff_id');
            if(count($staff_ids) > 0)
            {
                $staff_ids_array = array();
                foreach ($staff_ids as $key => $value)
                {
                    $staff_ids_array[] = $value->staff_id;
                }
            }
        }

        //'in'=>array('grade_no'=>$garde_arr)

        //appoinment data using id
        if(!empty($filter_data))
        {
            $filter_data = explode(',', $filter_data);
            $appoinment_condition = array(
                array('user_id', '=', $user_no),
                array('status', '!=', 2),
                array('is_deleted','=','0'),
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
                array('status', '!=', 2),
                array('is_deleted','=','0'),
            );

            if($staff_ids_array)
            {
                $findCond = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    'in'=>array('staff_id' => $staff_ids_array),
                );
            }
            else
            {
                $findCond = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    //'in' => array('')
                );
            }
        }



        //print_r($appoinment_condition); exit;
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



        $user_no = $user_id;



        $updateCond=array(

            array('user_id','=',$user_id),

            array('appointment_id', '=', $appoinment_id),

        );



        $data['status'] = '2';

        //$data['is_deleted'] = '1';

        $data['cancelled_by'] = '1';



        $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data);



        // Event Viewer //

        $this->add_user_event_viewer($user_no,$type=6);



        //appintment details

        $appoinment_condition = array(

            array('user_id', '=', $user_id),

            array('appointment_id', '=', $appoinment_id)

        );



        $appoinment_fields = array();



        $client_fields = array('client_name','client_email','client_profile_picture');



        $service_fields = array('service_name','cost','duration');



        $stuff_fields = array('full_name','email');



        //$currency_field = array('currency');



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

                /*array(

                    'join_table'=>$this->tableObj->tableNameCurrency,

                    //'join_table_alias'=>'invItemTb',

                    'join_with'=>$this->tableObj->tableUserService,

                    'join_type'=>'left',

                    'join_on'=>array('currency_id','=','currency_id'),

                    'join_on_more'=>array(),

                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                    'select_fields' => $currency_field,

                ),*/

        );

        

        $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);





        $email_template = $this->email_template($user_id,$type = 3);



        $templateHeader = '<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">

           <table width="100%">

              <tr>

                 <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>

                 <td style="color:#FFF; text-align: right; " >&nbsp;</td>

              </tr>

           </table>

        </div>';

        $templateFooter = '<div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">

           <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>

           <p style="text-align:center">For even easier management of your appointments.</p>

           <div style="text-align:center;">

              <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a> 

              <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  

           </div>

        </div>

        <div style="text-align:center">

           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>

           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>

           <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>

           <br><br>

           <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>

           <p>Copyright &copy; '.date('Y').'</p>

        </div>';



        $client_name = $appoinment_details->client_name;

        $client_email = $appoinment_details->client_email;

        $service_name = $appoinment_details->service_name;

        $staff_name = $appoinment_details->full_name;

        $staff_email = $appoinment_details->email;

        $service_start_time = date('l d, Y h:i A',$appoinment_details->strto_start_time);



        $mail_body = $email_template->message;



        $mail_body = str_replace('{header}', $templateHeader, $mail_body);

        $mail_body = str_replace('{client_name}', $client_name, $mail_body);

        $mail_body = str_replace('{service_name}', $service_name, $mail_body);

        $mail_body = str_replace('{staff_name}', $staff_name, $mail_body);

        $mail_body = str_replace('{appointment_time}', $service_start_time, $mail_body);

        $mail_body = str_replace('{staff_email}', $staff_email, $mail_body);

        $mail_body = str_replace('{footer}', $templateFooter, $mail_body);



        $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Appointment Cancellation';

        $emailData['content'] = $mail_body;



        $this->sendmail(15,$client_email,$emailData);



        //send mail to stuff

        $stuff_email_data['client_name'] = $client_name;

        $stuff_email_data['staff_name'] = $staff_name;

        $stuff_email_data['service_name'] = $service_name;

        $stuff_email_data['sheduled_time'] = $service_start_time;

        $stuff_email_data['subject'] = "Appointment Cancellation";

        $this->sendmail(16, $staff_email, $stuff_email_data);





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
            $numeric_day = date('N', strtotime($reshedule_date));

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


            $available = 0;

            /************Get service availability************* */
            $ser_ava_condition = array(
                array('user_id', '=', $user_id),
                array('service_id', '=', $reshedule_service_id),
                array('day', '=', $numeric_day),
                array('is_deleted', '=', '0'),
                'raw' => "((start_date <= '".date('Y-m-d', strtotime($reshedule_date))."' AND end_date >= '".date('Y-m-d', strtotime($reshedule_date))."') OR (start_date <= '".date('Y-m-d', strtotime($reshedule_date))."' AND end_date = '0000:00:00'))",
            );
            $ser_ava_fields = array();                   
            $service_avalibility_date = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability,$ser_ava_condition, $ser_ava_fields);
            //echo '<pre>'; print_r($service_avalibility_date); exit;

            if(isset($reshedule_staff_id) && $reshedule_staff_id > 0){
                /*$condition = array(
                    array('block_date', '=', date('Y-m-d', strtotime($reshedule_date))),
                    array('is_deleted', '=', '0'),
                    array('user_id', '=', $user_id),
                    array('staff_id', '=', $reshedule_staff_id),
                    'raw' => "(($strto_start_time BETWEEN strto_start_time AND strto_end_time) OR ($strto_end_time BETWEEN strto_start_time AND strto_end_time))",
                );
                $fields = array();                   
                $checkBlock = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$condition, $fields);*/
                //print_r($checkBlock); die();

                /************Get service staff availability************* */
                $ser_staff_ava_condition = array(
                    array('staff_id', '=', $reshedule_staff_id),
                    array('service_id', '=', $reshedule_service_id),
                    array('day', '=', $numeric_day),
                    array('is_blocked', '=', '0'),
                    array('is_deleted', '=', '0'),
                );
                $fields = array();                   
                $staff_service_avalibility = $this->common_model->fetchDatas($this->tableObj->tableNameStaffServiceAvailability,$ser_staff_ava_condition, $fields);
                //echo '<pre>'; print_r($staff_service_avalibility); die();

                /************Get blocked time************* */
                $blockCondition = array(
                    array('staff_id','=',$reshedule_staff_id),
                    array('block_date','=',$reshedule_date),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                );
                $blockFields = array('block_date','start_time', 'end_time', 'block_reasons');
                $blockDateTime = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$blockCondition,$blockFields);     
                //echo '<pre>'; print_r($blockDateTime); die();
                
                /************Get booked time************* */
                $appoinment_condition = array(
                    array('staff_id','=',$reshedule_staff_id),
                    array('date','=',$reshedule_date),
                    array('is_deleted','=','0'),
                );
                $appoinment_fields = array('appointment_id', 'staff_id', 'start_time', 'end_time', 'date','colour_code');
                $joins = array();
                $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);
                //echo '<pre>'; print_r($appoinment_list); die();
            }
            

            /****************check if service is available*************** */
            if(!empty($service_avalibility_date) && is_array($service_avalibility_date)){
                foreach($service_avalibility_date as $sad){
                    $ava_starttime = strtotime($reshedule_date.' '.$sad->start_time.':00');
                    $ava_endtime = strtotime($reshedule_date.' '.$sad->end_time.':00');
                    if(
                        ($strto_start_time >= $ava_starttime && $strto_start_time <= $ava_endtime)
                        ||
                        ($strto_end_time >= $ava_starttime && $strto_end_time <= $ava_endtime)                                
                    )
                        {
                        $available = 1;
                    } else {
                        $available = 0;
                    }
                }
            } else {
                $available = 0;
            }
            /*****************check if service is available************** */

            /****************check if time is blocked*************** */
            if(!empty($blockDateTime) && is_array($blockDateTime)){
                //echo '<pre>'; print_r($blockDateTime); exit;
                foreach($blockDateTime as $bdt){
                    if
                    (
                    ($strto_start_time >= strtotime($reshedule_date." ".$bdt->start_time) && $strto_start_time <= strtotime($reshedule_date." ".$bdt->end_time))
                    ||
                    ($strto_end_time >= strtotime($reshedule_date." ".$bdt->start_time) && $strto_end_time <= strtotime($reshedule_date." ".$bdt->end_time))
                    ){
                        $available = 0;
                    } else {
                        $available = 1;
                    }
                }
            }
            /*****************check if time is blocked************** */

            /****************check if staff-service is available*************** */
            if(!empty($staff_service_avalibility) && is_array($staff_service_avalibility)){
                //echo '<pre>'; print_r($staff_service_avalibility); exit;
                foreach($staff_service_avalibility as $ssad){
                    $ssa_starttime = strtotime($reshedule_date.' '.$ssad->start_time);
                    $ssa_endtime = strtotime($reshedule_date.' '.$ssad->end_time);
                    if(
                        ($strto_start_time >= $ssa_starttime && $strto_start_time <= $ssa_endtime)
                        ||
                        ($strto_end_time >= $ssa_starttime && $strto_end_time <= $ssa_endtime)                                
                    )
                        {
                        $available = 1;
                    } else {
                        $available = 0;
                    }
                }
            }
            /*****************check if staff-service is available************** */

            /****************check if time is booked*************** */
            if(!empty($appoinment_list) && is_array($appoinment_list)){
                foreach($appoinment_list as $al){
                    if(
                        ($strto_start_time >= strtotime($reshedule_date." ".$al->start_time) && $strto_start_time <= strtotime($reshedule_date." ".$al->end_time))
                        ||
                        ($strto_end_time >= strtotime($reshedule_date." ".$al->start_time) && $strto_end_time <= strtotime($reshedule_date." ".$al->end_time))                                
                    )
                    {
                        $available = 0;
                    } else {
                        $available = 1;
                    }
                }
            }
            /*****************check if time is booked************** */

            //echo $available; exit;
            if($available == 1)
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
                $user_no = $user_id;
                $this->add_user_event_viewer($user_no,$type=5,$reshedule_staff_id);
                //appintment details & send mail to client and stuff
                $appoinment_condition = array(
                    array('user_id', '=', $user_id),
                    array('appointment_id', '=', $reshedule_appointment_id)
                );

                $appoinment_fields = array();
                $client_fields = array('client_name','client_email','client_profile_picture');
                $service_fields = array('service_name','cost','duration','location');
                $stuff_fields = array('full_name','email');
                //$currency_field = array('currency');
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
                        /*array(
                            'join_table'=>$this->tableObj->tableNameCurrency,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableUserService,
                            'join_type'=>'left',
                            'join_on'=>array('currency_id','=','currency_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                            'select_fields' => $currency_field,
                        ),*/
                );

                $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);

                $email_template = $this->email_template($user_id,$type = 6);
                $templateHeader = '<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
                   <table width="100%">
                      <tr>
                         <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>
                         <td style="color:#FFF; text-align: right; " >&nbsp;</td>
                      </tr>
                   </table>
                </div>';
                $templateFooter = '<div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">
                   <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>
                   <p style="text-align:center">For even easier management of your appointments.</p>

                   <div style="text-align:center;">

                      <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a> 

                      <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  

                   </div>

                </div>

                <div style="text-align:center">

                   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>

                   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>

                   <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>

                   <br><br>

                   <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>

                   <p>Copyright &copy; '.date('Y').'</p>

                </div>';



                $client_name = $appoinment_details->client_name;

                $client_email = $appoinment_details->client_email;

                $service_name = $appoinment_details->service_name;

                $staff_name = $appoinment_details->full_name;

                $staff_email = $appoinment_details->email;

                $service_location = $appoinment_details->location;

                $note = $appoinment_details->note;

                $service_start_time = date('l d, Y h:i A',$appoinment_details->strto_start_time);



                $mail_body = $email_template->message;



                $mail_body = str_replace('{header}', $templateHeader, $mail_body);

                $mail_body = str_replace('{client_name}', $client_name, $mail_body);

                $mail_body = str_replace('{service_name}', $service_name, $mail_body);

                $mail_body = str_replace('{staff_name}', $staff_name, $mail_body);

                $mail_body = str_replace('{location}', $service_location, $mail_body);

                $mail_body = str_replace('{note}', $note, $mail_body);

                $mail_body = str_replace('{appointment_time}', $service_start_time, $mail_body);

                $mail_body = str_replace('{staff_email}', $staff_email, $mail_body);

                $mail_body = str_replace('{footer}', $templateFooter, $mail_body);



                $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Appointment Rescheduled';

                $emailData['content'] = $mail_body;



                $this->sendmail(17,$client_email,$emailData);



                //send mail to stuff

                $stuff_email_data['client_name'] = $client_name;

                $stuff_email_data['staff_name'] = $staff_name;

                $stuff_email_data['service_name'] = $service_name;

                $stuff_email_data['sheduled_time'] = $service_start_time;

                $stuff_email_data['note'] = $note;

                $stuff_email_data['location'] = $service_location;

                $stuff_email_data['subject'] = "Appointment Rescheduled";

                $this->sendmail(18, $staff_email, $stuff_email_data);

                    

                $this->response_status='1';

                $this->response_message = "Appointment has been rescheduled successfully .";





            }
            else
            {
                $this->response_message = "The timeslot is not available. Please try another timeslot.";
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



    public function appoinment_list_mobile(Request $request)

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

        $current_date = date('Y-m-d');

        $duration = $request->input('duration');

        if($duration=='day')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("+3 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

                array('appointment_type','=', 0),

            );

        }

        else if($duration=='month')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("-30 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

                array('appointment_type','=', 0),

            );

        }

        else if($duration=='current')
        {
            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d');

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','=',$current_date),

                //array('date','<=',$upto_date),

                array('appointment_type','=', 0),

            );
        }

        else

        {

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('appointment_type','=', 0),
            );

        }



        $staff_id = $request->input('staff_id');

        if(isset($staff_id) && $staff_id)

        {

            $appoinment_condition[] = array('staff_id', '=', $staff_id);

        }



        //appoinment data using id

        /*$appoinment_condition = array(

            array('user_id', '=', $user_no),

            array('date','>=',$current_date),

            array('date','<=',$upto_date),

            'in'=>array('staff_id' => $filter_data)

        );*/

        

        // Appoinment section //

        $appoinment_fields = array('appointment_id', 'order_id', 'start_time', 'end_time', 'date','note', 'status');

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

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $stuff_fields,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableNameClient,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableNameAppointment,

                        'join_type'=>'left',

                        'join_on'=>array('client_id','=','client_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $client_field,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableUserService,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableNameAppointment,

                        'join_type'=>'left',

                        'join_on'=>array('service_id','=','service_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $service_field,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableNameCurrency,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableUserService,

                        'join_type'=>'left',

                        'join_on'=>array('currency_id','=','currency_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $currency_field,

                    ),

        );



        $orderBy = array('date' => 'DESC');



        //$orderBy = '';

        

        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy,$groupBy='order_id');



        // Staff Section //

        $findCond = array(

                array('user_id','=',$user_no),

                array('is_deleted','=','0'),

                array('is_blocked','=','0'),

                //'in' => array('')

            );





        $selectFields = array('staff_id','full_name','email', 'staff_profile_picture');

        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);

    



        $response_data['staff_list'] = $staff_list;

        $response_data['appoinment_list'] = $appoinment_list;

        $response_data['duration'] = $duration;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);

    }



    public function recurring_appoinment_list_mobile(Request $request)
    
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

        $current_date = date('Y-m-d');

        $duration = $request->input('duration');

        if($duration=='day')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("+3 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

                array('appointment_type','>', 0),

            );

        }

        else if($duration=='month')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("-30 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

                array('appointment_type','>', 0),

            );

        }

        else if($duration=='current')
        {
            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d');

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','=',$current_date),

                //array('date','<=',$upto_date),

                array('appointment_type','>', 0),

            );
        }

        else

        {

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('appointment_type','>', 0),
            );

        }



        $staff_id = $request->input('staff_id');

        if(isset($staff_id) && $staff_id)

        {

            $appoinment_condition[] = array('staff_id', '=', $staff_id);

        }



        //appoinment data using id

        /*$appoinment_condition = array(

            array('user_id', '=', $user_no),

            array('date','>=',$current_date),

            array('date','<=',$upto_date),

            'in'=>array('staff_id' => $filter_data)

        );*/

        

        // Appoinment section //

        $appoinment_fields = array('appointment_id', 'order_id', 'start_time', 'end_time', 'date','note');

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

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $stuff_fields,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableNameClient,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableNameAppointment,

                        'join_type'=>'left',

                        'join_on'=>array('client_id','=','client_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $client_field,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableUserService,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableNameAppointment,

                        'join_type'=>'left',

                        'join_on'=>array('service_id','=','service_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $service_field,

                    ),

                    array(

                        'join_table'=>$this->tableObj->tableNameCurrency,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableUserService,

                        'join_type'=>'left',

                        'join_on'=>array('currency_id','=','currency_id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('is_deleted','=','0')),

                        'select_fields' => $currency_field,

                    ),

        );



        $orderBy = array('date' => 'DESC');



        //$orderBy = '';

        

        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy,$groupBy='order_id');



        // Staff Section //

        $findCond = array(

                array('user_id','=',$user_no),

                array('is_deleted','=','0'),

                array('is_blocked','=','0'),

                //'in' => array('')

            );





        $selectFields = array('staff_id','full_name','email', 'staff_profile_picture');

        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);

    



        $response_data['staff_list'] = $staff_list;

        $response_data['appoinment_list'] = $appoinment_list;

        $response_data['duration'] = $duration;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);

    }


    public function recurring_appoinment_details(Request $request){
        $response_data = array(); 
        $this->validate_parameter(1); // along with the user request key validation
        $user_no = $this->logged_user_no;
        //print_r($request->all()); die();
        $order_id = $request->input('order_id');
        
        $appoinment_condition = array(
            array('user_id', '=', $user_no),
            array('order_id','=', $order_id),
            array('is_deleted','=', 0),
        );
        
        $check_appointment = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$selectFields=array());
        
        if(!empty($check_appointment)){
            // Appointment details //
            $appoinment_fields = array('appointment_id', 'order_id', 'start_time', 'end_time', 'date','note', 'appointment_type');
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
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $stuff_fields,
                        ),
                        array(
                            'join_table'=>$this->tableObj->tableNameClient,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableNameAppointment,
                            'join_type'=>'left',
                            'join_on'=>array('client_id','=','client_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $client_field,
                        ),
                        array(
                            'join_table'=>$this->tableObj->tableUserService,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableNameAppointment,
                            'join_type'=>'left',
                            'join_on'=>array('service_id','=','service_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $service_field,
                        ),
                        array(
                            'join_table'=>$this->tableObj->tableNameCurrency,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableUserService,
                            'join_type'=>'left',
                            'join_on'=>array('currency_id','=','currency_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $currency_field,
                        ),
                    );
            
            $orderBy = array('date' => 'DESC');
            $appointment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy,$groupBy='order_id');
            $recurring_booking_list = array();
            //echo '<pre>'; print_r($appointment_details); exit;
            if(!empty($appointment_details) && $appointment_details->appointment_type > 0){
                $selectFields = array('appointment_id','user_id','client_id','date','status');
                $recurring_booking_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$selectFields);
            }
            $response_data['appointment_details'] = $appointment_details;
            $response_data['recurring_booking_list'] = $recurring_booking_list;
            $this->response_status='1';
            $this->response_message = "Appointment Details.";
                    
        } else {
            $this->response_message = "Invalid Order ID.";
        }

        // generate the service / api response
        $this->json_output($response_data);        
        
    }


    public function client_appoinment_list_mobile(Request $request)

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



        

        $current_date = date('Y-m-d');

        $duration = $request->input('duration');

        if($duration=='day')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("+7 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

            );

        }

        else if($duration=='month')

        {

            $upto_date = strtotime($current_date);

            $upto_date = date('Y-m-d', strtotime("+30 day", $upto_date));

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

                array('date','>=',$current_date),

                array('date','<=',$upto_date),

            );

        }

        else

        {

            $appoinment_condition = array(

                array('user_id', '=', $user_no),

            );

        }



        $client_id = $request->input('client_id');

        if(isset($client_id) && $client_id)

        {

            $appoinment_condition[] = array('client_id', '=', $client_id);

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

        

        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);



        //client name

        $client_condition = array(

                array('client_id', '=', $client_id),

            );



        $client_name = $this->common_model->fetchData($this->tableObj->tableNameClient,$client_condition,$client_field);



        $client_name = $client_name->client_name;



    

        $response_data['appoinment_list'] = $appoinment_list;

        $response_data['duration'] = $duration;

        $response_data['client_id'] = $client_id;

        $response_data['client_name'] = $client_name;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);

    }



    public function get_service_colour_code(Request $request)

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



        $service_id = $request->input('service_id');



        $findCond = array(

            array('service_id','=',$service_id),

        );

        

        $selectFields = array('service_id','color');



        $service_details = $this->common_model->fetchData($this->tableObj->tableUserService, $findCond, $selectFields);





        $this->response_status='1';

        $this->response_message = array('colors' => $service_details->color);;

        $this->json_output($response_data);

    }



     public function update_booking_flow(Request $request){

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

        $status = $request->input('status');



        $conditions = array(

            array('user_id','=',$user_id),

            //array('is_deleted','=','0'),

        );

        

        $staff_data['updated_on'] = date('Y-m-d H:i:s');

        $staff_data[$type] = $status;

        $staff_data['user_id'] = $user_id;



        $result = $this->common_model->fetchData($this->tableObj->tableNameBookinFlow,$conditions);

        if(empty($result))

        {

            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameBookinFlow,$staff_data);

        }

        else

        {

            $update = $this->common_model->update_data($this->tableObj->tableNameBookinFlow,$conditions,$staff_data);

        }



        $this->response_status='1';

        $this->response_message = "Successfully updated.";



        $this->json_output($response_data);

        

    }





    public function booking_flow_data(Request $request)

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

        );

        

        $selectFields=array();

        $booking_flow_data = $this->common_model->fetchData($this->tableObj->tableNameBookinFlow,$findCond,$selectFields);

        $response_data['booking_flow_data']=$booking_flow_data;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);

    }





    public function update_booking_rule(Request $request){

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

        $status = $request->input('status');



        $conditions = array(

            array('user_id','=',$user_id),

            //array('is_deleted','=','0'),

        );

        

        $booking_rule_data['updated_on'] = date('Y-m-d H:i:s');

        $booking_rule_data[$type] = $status;

        $booking_rule_data['user_id'] = $user_id;



        $result = $this->common_model->fetchData($this->tableObj->tableNameBookingRule,$conditions);

        if(empty($result))

        {

            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameBookingRule,$booking_rule_data);

        }

        else

        {

            $update = $this->common_model->update_data($this->tableObj->tableNameBookingRule,$conditions,$booking_rule_data);

        }



        $this->response_status='1';

        $this->response_message = "Successfully updated.";



        $this->json_output($response_data);

        

    }



    public function update_lead_cancellation_time(Request $request){

        // Check User Login. If not logged in redirect to login page //

        $authdata = $this->website_login_checked();

        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){

            return redirect('/login');

        }

        

        //echo '<pre>'; print_r($request->all()); exit;

        $response_data=array();

        $this->validate_parameter(1);



        $user_id = $this->logged_user_no;

        $min_notice_book = $request->input('min_notice_book');

        $min_notice_book_type = $request->input('min_notice_book_type');

        $min_notice_cancel = $request->input('min_notice_cancel');

        $min_notice_cancel_type = $request->input('min_notice_cancel_type');

        $min_notice_reschedule = $request->input('min_notice_reschedule');

        $min_notice_reschedule_type = $request->input('min_notice_reschedule_type');

        $min_time_interval = $request->input('min_time_interval');

        $min_time_interval_type = $request->input('min_time_interval_type');



        $conditions = array(

            array('user_id','=',$user_id),

            //array('is_deleted','=','0'),

        );

        

        $booking_rule_data['updated_on'] = date('Y-m-d H:i:s');

        $booking_rule_data['min_notice_book'] = $min_notice_book;

        $booking_rule_data['min_notice_book_type'] = $min_notice_book_type;

        $booking_rule_data['min_notice_cancel'] = $min_notice_cancel;

        $booking_rule_data['min_notice_cancel_type'] = $min_notice_cancel_type;

        $booking_rule_data['min_notice_reschedule'] = $min_notice_reschedule;

        $booking_rule_data['min_notice_reschedule_type'] = $min_notice_reschedule_type;

        $booking_rule_data['min_time_interval'] = $min_time_interval;

        $booking_rule_data['min_time_interval_type'] = $min_time_interval_type;

        $booking_rule_data['user_id'] = $user_id;



        $result = $this->common_model->fetchData($this->tableObj->tableNameBookingRule,$conditions);

        if(empty($result))

        {

            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameBookingRule,$booking_rule_data);

        }

        else

        {

            $update = $this->common_model->update_data($this->tableObj->tableNameBookingRule,$conditions,$booking_rule_data);

        }



        $this->response_status='1';

        $this->response_message = "Successfully updated.";



        $this->json_output($response_data);





    }





    public function booking_rule_data(Request $request)

    {

        $response_data = array(); 

        // validate the requested param for access this service api

        $this->validate_parameter(1); // along with the user request key validation

        $user_no = $this->logged_user_no;

        $findCond=array(

            array('user_id','=',$user_no),

            array('is_deleted','=','0'),

        );

        

        $selectFields=array();

        $booking_rule_data = $this->common_model->fetchData($this->tableObj->tableNameBookingRule,$findCond,$selectFields);

        $response_data['booking_rule_data']=$booking_rule_data;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);



    }



    public function notification_appoinment_list(Request $request)

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

        $current_date = date('dd-mm-yy');



        //appoinment data using id

        $appoinment_condition = array(

            array('user_id', '=', $user_no),

            array('is_deleted','=','0'),

        );

        

        // Appoinment section //

        $appoinment_fields = array();



        $service_fields = array('service_name');



        $stuff_fields = array('full_name', 'email');



        $client_fields = array('client_name', 'client_email', 'client_profile_picture');



        $currency = array('currency');



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

                    'select_fields' => $client_fields,

                ),

                array(

                    'join_table'=>$this->tableObj->tableUserService,

                    //'join_table_alias'=>'invItemTb',

                    'join_with'=>$this->tableObj->tableNameAppointment,

                    'join_type'=>'left',

                    'join_on'=>array('service_id','=','service_id'),

                    'join_on_more'=>array(),

                    'join_conditions' => array(array('is_deleted','=','0')),

                    'select_fields' => $service_fields,

                ),

                array(

                    'join_table'=>$this->tableObj->tableNameCurrency,

                    //'join_table_alias'=>'invItemTb',

                    'join_with'=>$this->tableObj->tableUserService,

                    'join_type'=>'left',

                    'join_on'=>array('currency_id','=','currency_id'),

                    'join_on_more'=>array(),

                    'join_conditions' => array(array('is_deleted','=','0')),

                    'select_fields' => $currency,

                ),

        );

        

        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);



        $html = '';

        if(!empty($appoinment_list))

        {

            foreach ($appoinment_list as $key => $value)

            {

                if($value->client_profile_picture)

                {

                    $client_profile_picture = $value->client_profile_picture;

                }

                else

                {

                    //$client_profile_picture = "http://localhost/squder/public/assets/website/images/user-pic-sm-default.png";

                    $client_profile_picture = asset('public/assets/website/images/user-pic-sm-default.png');

                }

                $html .='<div class="notify">

                   <a onClick="slideDiv(this);" data-toggle="collapse" data-parent="#accordion" href="#collapse_'.$value->appointment_id.'" style="cursor: pointer;"> <b class="fa fa-custom fa-caret-down show-arrow" ></b></a> 

                   <div class="user-bkd">

                      <img src="'.$client_profile_picture.'" class="thumbnail rounded"> 

                      <h2> '.$value->client_name.' <br> <a href="mailto:'.$value->client_email.'"><i class="fa fa-envelope-o"></i> '.$value->client_email.'</a> </h2>

                   </div>

                   <div id="collapse_'.$value->appointment_id.'" class="panel-collapse collapse">

                      <div class="usr-bkd-dt">

                         <div class="notify-drops">

                            <div class="dropdown custm-uperdrop">

                               <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Check In <img src="'.asset('public/assets/website/images/arrow.png').'" alt=""/></button> 

                               <ul class="dropdown-menu st-p">

                                  <li><a class="appointment_status" href="JavaScript:Void(0);" data-id="'.$value->appointment_id.'" data-value="As Scheduled">As Scheduled</a></li>

                                  <li><a class="appointment_status" href="JavaScript:Void(0);" data-id="'.$value->appointment_id.'" data-value="Arrived Late">Arrived Late</a></li>

                                  <li><a class="appointment_status" href="JavaScript:Void(0);" data-id="'.$value->appointment_id.'" data-value="No Show">No Show</a></li>

                                  <li><a class="appointment_status" href="JavaScript:Void(0);" data-id="'.$value->appointment_id.'" data-value="Gift Certificates">Gift Certificates</a></li>

                               </ul>

                            </div>

                         </div>

                         <div class="name"> <i class="fa fa-circle-o "></i> '.$value->service_name.' ('.$value->currency.' '.$value->total_payable_amount.') <br> <i class="fa fa-user-o "></i> '.$value->full_name.' </div>

                         <div class="datetime"> '.$value->start_time.' - '.$value->end_time.' <br> '.date('d, M Y', strtotime($value->date)).' </div>

                      </div>

                      <div class="clearfix">&nbsp;</div>

                      Booked: '.date('d, M Y', strtotime($value->created_on)).' <br> <br> 

                      <div class="link-e"> <a href="#" class="cancel-appoinment-notification" id="'.$value->appointment_id.'"><i class="fa fa-times"></i> Cancel</a> <a href="JavaScript:Void(0);" class="reschedule-appoinment" id="'.$value->appointment_id.'"><i class="fa fa-repeat"></i> Reschedule</a> <a href="JavaScript:Void(0);" data-id="'.$value->appointment_id.'" class="request-for-review"><i class="fa fa-star-half-o "></i> Request a review</a> </div>

                      <div class="clearfix">&nbsp;</div>

                      <br>

                      <form name="update_note_form" method="post" action="'.url('api/update_appointment_note').'">

                      <textarea id="update_note_'.$value->appointment_id.'" name="booking_note" rows="4" placeholder="Write here..">'.$value->note.'</textarea>

                      <br> 

                      <div class="clearfix"></div>

                      <button type="submit" class="btn btn-primary butt-next break10px saveNoteForNotification" id="'.$value->appointment_id.'">Save</button> 

                      </form>

                      <button type="button" class="btn btn-success butt-next break10px pull-right addPayment" data-payment-amount="'.$value->payment_amount.'" data-additional-amount="'.$value->additional_amount.'" data-discount-amount="'.$value->discount_amount.'" data-total-payable-amount="'.$value->total_payable_amount.'" data-paid-amount="'.$value->paid_amount.'" data-remaining-balance="'.$value->remaining_balance.'" data-payment-note="'.$value->payment_note.'" data-currency="'.$value->currency.'" data-appointment-id="'.$value->appointment_id.'">Add Payment</button> 

                   </div>

                   <div class="clearfix"></div>

                </div>

                <hr class="notify-sep">';

            }

        }

        else

        {

            $html = '<div class="noappointment">No appointment found</div>';

        }

        $response_data['html'] = $html;

        $this->response_status='1';

        // generate the service / api response

        $this->json_output($response_data);

    }



    public function notification_appointment_status(Request $request)

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



        $appoinment_id = $request->input('id');

        $appoinment_status = $request->input('status');

        $user_id = $user_id;



        $updateCond=array(

            array('user_id','=',$user_id),

            array('appointment_id', '=', $appoinment_id),

        );



        $data['appointment_status'] = $appoinment_status;



        $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data);



        $this->response_status='1';

        $this->response_message="Appointment status updated successfully.";

        $this->json_output($response_data);

        

    }



    public function notification_profile_info(Request $request)

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



        $findCond=array(

            array('id','=',$user_id),

            array('is_deleted','=','0'),

        );

        

        $selectFields = array();

        $user_data = $this->common_model->fetchData($this->tableObj->tableNameUser,$findCond,$selectFields);



        $count = 0;

        $name = $user_data->name;

        if($name)

        {

            $count = $count+1;

        }

        $email = $user_data->email;

        if($email)

        {

            $count = $count+1;

        }

        $mobile = $user_data->mobile;

        if($mobile)

        {

            $count = $count+1;

        }

        $profile_image = $user_data->profile_image;

        if($profile_image)

        {

            $count = $count+1;

        }

        $timeline_image = $user_data->timeline_image;

        if($timeline_image)

        {

            $count = $count+1;

        }

        $profile_perosonal_image = $user_data->profile_perosonal_image;

        if($profile_perosonal_image)

        {

            $count = $count+1;

        }

        $business_name = $user_data->business_name;

        if($business_name)

        {

            $count = $count+1;

        }

        $business_location = $user_data->business_location;

        if($business_location)

        {

            $count = $count+1;

        }

        $zip_code = $user_data->zip_code;

        if($zip_code)

        {

            $count = $count+1;

        }

        $office_phone = $user_data->office_phone;

        if($office_phone)

        {

            $count = $count+1;

        }

        $skype_id = $user_data->skype_id;

        if($skype_id)

        {

            $count = $count+1;

        }

        $transport = $user_data->transport;

        if($transport)

        {

            $count = $count+1;

        }

        $parking = $user_data->parking;

        if($parking)

        {

            $count = $count+1;

        }

        $business_description = $user_data->business_description;

        if($business_description)

        {

            $count = $count+1;

        }

        $presentation = $user_data->presentation;

        if($presentation)

        {

            $count = $count+1;

        }

        $expertise = $user_data->expertise;

        if($expertise)

        {

            $count = $count+1;

        }

        $facebook_link = $user_data->facebook_link;

        if($facebook_link)

        {

            $count = $count+1;

        }

        $twitter_link = $user_data->twitter_link;

        if($twitter_link)

        {

            $count = $count+1;

        }

        $linked_in_link = $user_data->linked_in_link;

        if($linked_in_link)

        {

            $count = $count+1;

        }

        $user_wesite_link = $user_data->user_wesite_link;

        if($user_wesite_link)

        {

            $count = $count+1;

        }



        $progress = ($count/20)*100;



        $capsum = 'Poor';

        if($progress>0 && $progress<=30)

        {

            $capsum = "Poor";

        }

        if($progress>30 && $progress<=65)

        {

            $capsum = "Intermediate";

        }

        if($progress>66 && $progress<=100)

        {

            $capsum = "Excelent";

        }



        $findCond=array(

            array('user_id','=',$user_id),

        );

        

        $selectFields = array();

        $appointment = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$findCond,$selectFields);

        if(!empty($appointment))

        {

            $appointment_count = count($appointment);

        }

        else

        {

            $appointment_count = 0;

        }



        if($profile_image)

        {

            $imgDiv = '<div class="col-md-12">

                            <div class="prof-box">

                               <h2>Tell your story with your profile</h2>

                               <p>You have listed your job! Now add a profile photo to help others recognize you.</p>

                               <a href="'.url('/profile-settings').'">Update</a> 

                            </div>

                         </div>';

        }

        else

        {

            $imgDiv = '<div class="col-md-12">

                            <div class="prof-box">

                               <i class="fa fa-user-circle-o"></i> 

                               <h2>Tell your story with your profile</h2>

                               <p>You have listed your job! Now add a profile photo to help others recognize you.</p>

                               <a href="'.url('/profile-picture').'">Add a Photo</a> 

                            </div>

                         </div>';

        }





        $html = '<div class="profile-nt">

                     <h2>Profile Strength: '.$capsum.'</h2>

                     <div class="prof-st-bs">

                        <div class="prof-st" style="width: '.$progress.'%"></div>

                     </div>

                  </div>

                  <div class="row">

                     '.$imgDiv.'

                     <div class="col-md-12">

                        <div class="prof-box">

                           <i class="fa fa-check-circle-o "></i> 

                           <h2>'.$appointment_count.' bookings!</h2>

                           <p>Keep adding connections to increase your visibilities with employers</p>

                        </div>

                     </div>

                  </div>';



        $this->response_status='1';

        $this->response_message = $html;

        $this->json_output($response_data);

        

    }



    public function notification_feedback(Request $request)

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



        $findCond = array(

            array('is_deleted','=','0'),

            array('user_id','=',$user_id),

        );



        $selectFields = array();

        $client_field = array('client_name', 'client_email');



        $joins = array(

                array(

                'join_table'=>$this->tableObj->tableNameClient,

                'join_table_alias'=>'servTb',

                'join_with'=>$this->tableObj->tableNameFeedback,

                'join_type'=>'left',

                'join_on'=>array('client_id','=','client_id'),

                'join_on_more'=>array(),

                //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                'select_fields' => $client_field,

            ),

        );

        $order_by = array('feedback_id' => 'DESC');

        $review_list = $this->common_model->fetchDatas($this->tableObj->tableNameFeedback, $findCond, $selectFields,$joins, $order_by);

        $html = '';

        foreach ($review_list as $key => $value)

        {

            $post_time = $this->humanTiming(strtotime($value->created_on));

            $html .=' <div class="feedb-list">

                        <span class="tt">'.$post_time.' ago</span> <img src="'.asset('public/assets/website/images/user-pic-sm-default.png').'"> 

                        <p> <strong>'.$value->client_name.'</strong><br> '.$value->feedback.'<br> <small>'.date('d, M Y h:i A', strtotime($value->created_on)).'</small> </p>

                        <div class="clearfix"></div>

                     </div>';

        }



        if(!empty($review_list))

        {

            $this->response_status='1';

        }

        else

        {

            $this->response_status='0';

        }



        $this->response_message = $html;

        $this->json_output($response_data);

    }





    public function notification_update(Request $request)

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



        $findCond = array(

            array('is_deleted','=','0'),

            array('user_id','=',$user_id),

        );



        $selectFields = array();

        $user_field = array('name', 'email');



        $joins = array(

                array(

                'join_table'=>$this->tableObj->tableNameUser,

                'join_table_alias'=>'servTb',

                'join_with'=>$this->tableObj->tableNameNotificationUpdates,

                'join_type'=>'left',

                'join_on'=>array('user_id','=','id'),

                'join_on_more'=>array(),

                //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                'select_fields' => $user_field,

            ),

        );

        $order_by = array('id' => 'DESC');

        $review_list = $this->common_model->fetchDatas($this->tableObj->tableNameNotificationUpdates, $findCond, $selectFields,$joins,$order_by);

        $html = '';

        foreach ($review_list as $key => $value)

        {

            $post_time = $this->humanTiming(strtotime($value->created_on));

            $html .=' <div class="feedb-list">

                        <span class="tt">'.$post_time.' ago</span> <img src="'.asset('public/assets/website/images/user-pic-sm-default.png').'"> 

                        <p> <strong>'.$value->name.'</strong><br> '.$value->update_message.'<br> <small>'.date('d, M Y h:i A', strtotime($value->created_on)).'</small> </p>

                        <div class="clearfix"></div>

                     </div>';

        }



        if(!empty($review_list))

        {

            $this->response_status='1';

        }

        else

        {

            $this->response_status='0';

        }



        $this->response_message = $html;

        $this->json_output($response_data);

    }





    function humanTiming ($time)

    { 

        $time = time() - $time; 

    // to get the time since that moment 

        $time = ($time<1)? 1 : $time; 

        $tokens = array ( 31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second' ); 

        foreach ($tokens as $unit => $text) 

        { 

            if ($time < $unit) 

                continue; 

            $numberOfUnits = floor($time / $unit); 

            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':''); 

        }

    }



    function email_template($user_id, $type)

    {

        $sub_condition = array(

            array('user_id', '=', $user_id)

        );

        $sub_field = array();    

        $subcription_id = $this->common_model->fetchData($this->tableObj->tableNameUserSubscription,$sub_condition, $sub_field);



        //$subcription_id = $subcription_id->id;

        if(!empty($subcription_id))

        {

            $email_template_condition = array(

                array('user_id', '=', $user_id),

                array('type', '=', $type)

            );

            $email_template_field = array();    

            $email_template = $this->common_model->fetchData($this->tableObj->tableNameUserEmailCustomisation,$email_template_condition, $email_template_field);

            if(empty($email_template))

            {

                $email_template_condition = array(

                    array('type', '=', $type)

                );

                $email_template_field = array();    

                $email_template = $this->common_model->fetchData($this->tableObj->tableNameEmailTemplateMaster,$email_template_condition, $email_template_field);

            }

        }

        else

        {

            $email_template_condition = array(

                array('type', '=', $type)

            );

            $email_template_field = array();    

            $email_template = $this->common_model->fetchData($this->tableObj->tableNameEmailTemplateMaster,$email_template_condition, $email_template_field);

        }

        

        return $email_template;

    }



    public function request_for_review(Request $request)

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



        $appointemt_id = $request->input('appointemt_id');



        $condition = array(

            array('user_id', '=', $user_id),

            array('appoitment_id', '=', $appointemt_id)

        );

        $field = array();    

        $feedback = $this->common_model->fetchData($this->tableObj->tableNameReviewRequest, $condition, $field);



        if(empty($feedback))

        {

            //insert into request for review table

            $data['user_id'] = $user_id;

            $data['appoitment_id'] = $appointemt_id;

    

            //print_r($data); die();



            $insert = $this->common_model->insert_data_get_id($this->tableObj->tableNameReviewRequest,$data);



            //appintment details

            $appoinment_condition = array(

                array('user_id', '=', $user_id),

                array('appointment_id', '=', $appointemt_id)

            );

            $appoinment_fields = array('appointment_id');



            $client_fields = array('client_email','client_name');



            $user_fields = array('name');



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

                        'join_table'=>$this->tableObj->tableNameUser,

                        //'join_table_alias'=>'invItemTb',

                        'join_with'=>$this->tableObj->tableNameAppointment,

                        'join_type'=>'left',

                        'join_on'=>array('user_id','=','id'),

                        'join_on_more'=>array(),

                        //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                        'select_fields' => $user_fields,

                    ),

            );

            

            $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);



            $email_template = $this->email_template($user_id,$type = 7);



            $templateHeader = '<div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">

               <table width="100%">

                  <tr>

                     <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>

                     <td style="color:#FFF; text-align: right; " >&nbsp;</td>

                  </tr>

               </table>

            </div>';

            $templateFooter = '<div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">

               <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>

               <p style="text-align:center">For even easier management of your appointments.</p>

               <div style="text-align:center;">

                  <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a> 

                  <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  

               </div>

            </div>

            <div style="text-align:center">

               <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>

               <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>

               <a href="#" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>

               <br><br>

               <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>

               <p>Copyright &copy; '.date('Y').'</p>

            </div>';



            $client_name = $appoinment_details->client_name;

            $client_email = $appoinment_details->client_email;

            $service_provider = $appoinment_details->name;



            //$service_start_time = date('l d, Y h:i A',$appoinment_details->strto_start_time);



            $mail_body = $email_template->message;



            $mail_body = str_replace('{header}', $templateHeader, $mail_body);

            $mail_body = str_replace('{client_name}', $client_name, $mail_body);

            $mail_body = str_replace('{service_provider}', $service_provider, $mail_body);

            $mail_body = str_replace('{footer}', $templateFooter, $mail_body);



            $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Thank You';

            $emailData['content'] = $mail_body;



            $this->sendmail(19,$client_email,$emailData);



            $this->response_status='1';

            $this->response_message="Request successfully send.";

        }

        else

        {

            $this->response_message="Request already send.";

            $this->response_status='0';

        }

    

        $this->json_output($response_data);

    }



    public function fetch_appointments(Request $request)

    {

        $response_data = array();

        $api_key = $request->input('api_key');

        $last_updated_time   = $request->input('last_updated_time');

        $appointment_type = $request->input('appointment_type');

        if($api_key)

        {

            $user_condition = array(

                array('api_key', '=', $api_key),

                array('is_deleted', '=', 0),

                array('is_blocked', '=', 0)

            );

            $user_field = array('id as user_id');    

            $user = $this->common_model->fetchData($this->tableObj->tableNameUser, $user_condition, $user_field);

            if(!empty($user))

            {

                $user_id = $user->user_id;



                if($last_updated_time)

                {

                    $appointment_condition = array(

                        array('is_deleted', '=', 0),

                        array('user_id', '=', $user_id),

                        'raw' => "(squ_appointment.created_on >= '".date('Y-m-d H:i:s',strtotime($last_updated_time))."')",

                    );

                }

                else

                {

                    $appointment_condition = array(

                        array('is_deleted', '=', 0),

                        array('user_id', '=', $user_id),

                    );

                }



                if($appointment_type)

                {

                    $appointment_condition[] = array('status', '=', $appointment_type);

                }



                $appoinment_fields = array('order_id', 'user_id', 'service_id', 'staff_id', 'client_id', 'appointment_type', 'recurring_booking_ends_on', 'date as appointment_date', 'start_time as appointment_start_time', 'end_time as appointment_end_time', 'note as appointment_note', 'payment_note', 'payment_amount', 'additional_amount', 'discount_amount', 'gift_certificate_amount', 'total_payable_amount', 'remaining_balance', 'paid_amount', 'payment_status', 'payment_method', 'cancelled_reason', 'updated_on', 'created_on');

                $client_fields = array('client_name','client_email','client_mobile','client_address');

                $service_fields = array('service_name','cost','duration','timezone','description as service_description');

                $stuff_fields = array('full_name as staff_name','email as staff_email', 'mobile as staff_mobile');

                $currency_fields = array('currency');

                $category_fields = array('category');

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
                            
                            'join_table'=>$this->tableObj->tableNameCategory,

                            //'join_table_alias'=>'invItemTb',

                            'join_with'=>$this->tableObj->tableUserService,

                            'join_type'=>'left',

                            'join_on'=>array('category_id','=','category_id'),

                            'join_on_more'=>array(),

                            //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                            'select_fields' => $category_fields,

                        ),

                        array(

                            'join_table'=>$this->tableObj->tableNameCurrency,

                            //'join_table_alias'=>'invItemTb',

                            'join_with'=>$this->tableObj->tableUserService,

                            'join_type'=>'left',

                            'join_on'=>array('currency_id','=','currency_id'),

                            'join_on_more'=>array(),

                            //'join_conditions' => array(array('transaction_no','=','invoice_no')),

                            'select_fields' => $currency_fields,

                        ),

                );

                

                $appoinment_details = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appointment_condition,$appoinment_fields,$joins,$orderBy=array(),$groupBy='order_id');

                if(!empty($appoinment_details))

                {

                    $response_data['appoinment_list'] = $appoinment_details;

                }

                else

                {

                    $this->response_message = "No result found.";

                }

                

                $this->response_status='1';

            }

            else

            {

                $this->response_status='0';

                $this->response_message="Invalid API key.";

            }

        }

        else

        {

            $this->response_status='0';

            $this->response_message="Invalid request.";

        }



        $this->json_output($response_data);

    }



    public function staff_assignment(Request $request){
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $user_no = $this->logged_user_no;

        $staff_id = $request->input('staff_id');
        $order_id = $request->input('order_id');

        $findCond=array(
            array('user_id','=',$user_no),
            array('order_id','=',$order_id),
            array('is_deleted','=','0'),
        );

        $selectFields=array();
        $appointment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$findCond,$selectFields);

        if(!empty($appointment_details)){

            $updateCond=array(
                array('user_id','=',$user_no),
                array('order_id','=',$order_id),
                array('is_deleted','=','0'),
            );

            $updatedata['staff_id'] = $staff_id;
            $updatedata['updated_on'] = date('Y-m-d H:i:s');

            $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$updatedata);

            $this->response_status='1';
            $this->response_message="Staff has been assigned successfully.";
                
        } else {
            $this->response_message="Invalid appointment details.";
        }

        // generate the service / api response
        $this->json_output($response_data);
        
    }






}