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
use Validator;
use Excel;

class StaffsloginController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}
	
    public function appoinment_list_staff(Request $request)
    {
        $staff_id = $request->input('staff_id');
        $filter_data = $request->input('filter_data');

        $stf_con = array(
            array('staff_id' , '=' , $staff_id),
        );
        //staff details
        // Staff Section //
        $stf_fld = array();
        $stf_deta = $this->common_model->fetchData($this->tableObj->tableNameStaff,$stf_con,$stf_fld);
        if($stf_deta->staff_type==1)
        {
            $user_no = $stf_deta->user_id;

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

                $findCond = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    //'in' => array('')
                );
            }

            //print_r($appoinment_condition); exit;

            $filter_list_condition = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
            );
        }
        else
        {
            $user_no = $stf_deta->user_id;
            $staff_id = $stf_deta->staff_id;

            //appoinment data using id
            if(!empty($filter_data))
            {
                $filter_data = explode(',', $filter_data);
                $appoinment_condition = array(
                    array('user_id', '=', $user_no),
                    array('status', '!=', 2),
                    array('is_deleted','=','0'),
                    array('staff_id','=', $staff_id)
                    //'in'=>array('staff_id' => $filter_data)
                );

                $findCond = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    array('staff_id','=', $staff_id)
                );

            }
            else
            {
                $appoinment_condition = array(
                    array('user_id', '=', $user_no),
                    array('status', '!=', 2),
                    array('is_deleted','=','0'),
                    array('staff_id','=', $staff_id)
                );

                $findCond = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    array('staff_id','=', $staff_id)
                    //'in' => array('')
                );
            }

            //print_r($appoinment_condition); exit;

            $filter_list_condition = array(
                    array('user_id','=',$user_no),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    array('staff_id','=', $staff_id)
            );

        }
        
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

        //service data
        $service_condition = array(
                array('user_id', '=', $user_no),
                array('is_deleted', '=', '0'),
                array('is_blocked','=','0'),
        );

        $service_field = array();

        $service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService,$service_condition,$service_field);

        $response_data['staff_list'] = $staff_list;
        $response_data['appoinment_list'] = $appoinment_array;
        $response_data['staff_list_filter'] = $staff_list_filter;
        $response_data['calendar_settings'] = $calendar_settings;
        $response_data['filter_data'] = $filter_data;
        $response_data['block_date_time'] = $block_date_array;
        $response_data['staff_data'] = $stf_deta;
        $response_data['service_list'] = $service_list;
        
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function staff_appointment_details(Request $request)
    {
        $appointment_id = $request->input('appointment_id'); 
        //appoinment data using id
        $appoinment_condition = array(
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

    public function staff_appoinment_list_mobile(Request $request)
    {
        
        $staff_id = $request->input('staff_id');
        $stf_con = array(
            array('staff_id' , '=' , $staff_id),
        );
        //staff details
        // Staff Section //
        $stf_fld = array();
        $stf_deta = $this->common_model->fetchData($this->tableObj->tableNameStaff,$stf_con,$stf_fld);
        if($stf_deta->staff_type==1)
        {
            $user_no = $stf_deta->user_id;
        }
        else
        {
            $user_no = $stf_deta->user_id;
            $appoinment_condition['staff_id'] = $stf_deta->staff_id;
        }

        //print_r($request->all()); die();
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

        /*$staff_id = $request->input('staff_id');
        if(isset($staff_id) && $staff_id)
        {
            $appoinment_condition[] = array('staff_id', '=', $staff_id);
        }*/

        //appoinment data using id
        /*$appoinment_condition = array(
            array('user_id', '=', $user_no),
            array('date','>=',$current_date),
            array('date','<=',$upto_date),
            'in'=>array('staff_id' => $filter_data)
        );*/
        
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

        $orderBy = array('date' => 'DESC');

        //$orderBy = '';
        
        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy);

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
        $response_data['staff_data'] = $stf_deta;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }

    //Details//
    public function staff_details_login(Request $request)
    {
        $staff_id = $request->input('staff_id');
        $findCond=array(
            //array('user_id','=',$user_no),
            array('staff_id','=',$staff_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array('staff_id','addess','user_id','full_name','username','email','mobile','description','home_phone','work_phone','expertise','category_id','staff_profile_picture','is_internal_staff','booking_url','is_login_allowed','is_email_verified','is_blocked','created_on');
        $staff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff,$findCond,$selectFields);

        if(!empty($staff_details)){
            $response_data['staff_details']=$staff_details;
            $this->response_status='1';
            $this->response_message="Staff details.";
        } else {
            $this->response_status='0';
            $this->response_message="Staff is not valid.";
        }
        
        // generate the service / api response
        $this->json_output($response_data);

    }

     public function edit_staff_login_data(Request $request)
     {   
        $response_data = array();
        $validate = Validator::make($request->all(),[
                                         'staff_fullname'=>'required',
                                         'staff_description'=>'required']);
        
        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $staff_id = $request->input('staff_id');
            $full_name = $request->input('staff_fullname');
            //$email = $request->input('staff_email');
            //$username = $request->input('staff_username');
            $mobile = $request->input('staff_mobile');
            $home_phone = $request->input('staff_home_phone');
            $work_phone = $request->input('staff_work_phone');
            $category_id = $request->input('staff_category');
            $expertise = $request->input('staff_expertise');
            $description = $request->input('staff_description');
            $staff_profile_picture = '';

            $conditions = array(
                array('staff_id','=',$staff_id),
                //array('user_id','=',$user_id),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );

            $result = $this->common_model->fetchData($this->tableObj->tableNameStaff,$conditions);
            //echo '<pre>'; print_r($result); exit;
            if(empty($result))
            {
                $this->response_message = "Invalid staff details.";
            }
            else
            {
                $destinationPath = './uploads/profile_image/';
                if (!empty($_FILES)) {
                    if ($_FILES['staff_profile_picture'] && $_FILES['staff_profile_picture']['name'] != "") {
                        $staff_profile_picture_name = str_replace(" ", "_", time() . $_FILES['staff_profile_picture']['name']);
                        if (move_uploaded_file($_FILES['staff_profile_picture']['tmp_name'], $destinationPath . $staff_profile_picture_name)) {
                            //$user_data['staff_profile_picture'] = $staff_profile_picture_name;
                            $staff_data['staff_profile_picture'] = url('uploads/profile_image/'.$staff_profile_picture_name);

                            /*if ($data->input('old_staff_profile_picture') != "") {
                                if (file_exists($destinationPath . $data->input('old_staff_profile_picture'))) {
                                    unlink($destinationPath . $data->input('old_staff_profile_picture'));
                                }
                            }*/
                        }
                    }
                }

                $staff_data['full_name'] = $full_name;
                $staff_data['mobile'] = $mobile;
                $staff_data['home_phone'] = $home_phone;
                $staff_data['work_phone'] = $work_phone;
                $staff_data['expertise'] = $expertise;
                $staff_data['description'] = $description;
                $staff_data['category_id'] = $category_id;

                $update = $this->common_model->update_data($this->tableObj->tableNameStaff,$conditions,$staff_data);
                
                $this->response_status='1';
                $this->response_message = "Staff successfully updated.";

            }

            $this->json_output($response_data);

        }
        
    }


    /**** Change Password *****/
    public function changepssword(Request $request)
    {
        $staff_id = $request->input('staff_id'); 
        //print_r($request->all()); die();
        $old_password = $request->input('old_passsword');
        $password = $request->input('new_password');
        // find the user password 
        $findCond=array(
            array('password','=',md5($old_password)),
            array('staff_id','=',$staff_id),
        );
        //$select_fields=array('user_no','email','first_name');
        $staff = $this->common_model->fetchData($this->tableObj->tableNameStaff,$findCond);
        if(empty($staff))
        {
            $this->response_message="Old password not matched";
        }
        else
        {
            // now update the password with new one
            $updateData=array(
                'password'=>md5($password),
                'updated_on'=>$this->date_format
            );
            $updateCond=array(
                array('staff_id','=',$staff_id)
            );
            $this->common_model->update_data($this->tableObj->tableNameStaff,$updateCond,$updateData);
            // send mail
            //$email = $user->email;
            //$this->sendmail(4,$email,array('toName'=>$user->first_name));
            // update your password 
            $this->response_message="Password change successfully";
            $this->response_status='1';
        }
        
        // generate the service / api response
        $this->json_output($response_data);
    }

    

}