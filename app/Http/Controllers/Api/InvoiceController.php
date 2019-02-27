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


class InvoiceController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}



    public function invoice_booking_details(Request $request)
    {
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        if(!empty($other_user_no) && $other_user_no!=0){
            $user_no = $other_user_no;
        }
        else
        {
            $user_no = $this->logged_user_no;
        }

        $order_id = $request->input('order_id'); 
        //appoinment data using id
        if(isset($order_id) && $order_id)
        {
            $appoinment_condition = array(
                array('user_id', '=', $user_no),
                array('order_id', '=', $order_id)
            );
        }
        else
        {
            $appoinment_condition = array(
                array('user_id', '=', $user_no),
                //array('order_id', '=', $order_id)
            );
        }

        $appoinment_fields = array();
        $client_fields = array('client_name','client_email');
        $service_fields = array('service_name','cost','duration');
        $stuff_fields = array('full_name');
        $currency_field = array('currency');
        $user_data = array('name', 'business_location', 'email', 'mobile', 'profile_image');
        $booking_policy_field = array('content as terms_condition');

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
                array(
                    'join_table'=>$this->tableObj->tableNameUser,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableNameAppointment,
                    'join_type'=>'left',
                    'join_on'=>array('user_id','=','id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $user_data,
                ),
                array(
                    'join_table'=>$this->tableObj->tableNameBookingPolicy,
                    //'join_table_alias'=>'invItemTb',
                    'join_with'=>$this->tableObj->tableNameAppointment,
                    'join_type'=>'left',
                    'join_on'=>array('user_id','=','user_id'),
                    //'join_on_more'=>array('type' '=', 3),
                    'join_conditions' => array(array('type', '=', 3)),
                    'select_fields' => $booking_policy_field,
                ),
        );

        $appoinment_details = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy=array(),$groupBy='order_id');
        //echo "<pre>";
        //print_r($appoinment_details); die();


        $response_data['appoinment_details'] = $appoinment_details;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);

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

}