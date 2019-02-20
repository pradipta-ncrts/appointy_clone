<?php
/**
* @Author : NCRTS
* Track :: 1
* Users Controller for Users Registration, login and basic section Related Apis
* oparetion with database
* 
*/

namespace App\Http\Controllers\Api;
//require_once('./vendor/stripe/init.php');
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Excel;

class ClientsController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}

	
	//*client add*//
    public function add_client(Request $request)
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

        $validate = Validator::make($request->all(),[
                                 'client_name'=>'required',
                                 'client_email'=>'required|email',
                                 'client_mobile'=>'required|numeric'
                                             ]);

        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $client_name = $request->input('client_name');
            $client_email = str_replace(' ', '', $request->input('client_email'));
            $client_mobile = $request->input('client_mobile');
            $client_home_phone = $request->input('client_home_phone');
            $client_work_phone = $request->input('client_work_phone');
            //$client_category = $request->input('client_category');
            $client_address = $request->input('client_address') ? $request->input('client_address'):"";

            $client_timezone = $request->input('client_timezone');
            $client_note = $request->input('client_note');

            $client_profile_picture = '';
            $client_send_email = $request->input('client_send_email');
            $send_email = false;
            if(isset($client_send_email) && $client_send_email == 1){
                $send_email = true;
            }

            $conditions = array(
			     array('client_email', '=', $client_email),
			);
            $selectFileds = array();            
            $result = $this->common_model->fetchData($this->tableObj->tableNameClient,$conditions,$selectFileds);
            //echo '<pre>'; print_r($result); exit;
            if(!empty($result))
            {
                //$this->response_message = "This email is already exist.";
                $client_id = $result->client_id;
                $client_name = $result->client_name;
                
                $client_data['user_id'] = $user_id;
                $client_data['client_id'] = $client_id;

                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserClient,$client_data);
                if($insertdata > 0){

                    /* Send Email */
                    if($send_email == true){
                        
                        //$emailData['toName'] = $client_name;

                        $email_template = $this->email_template($user_id,$type = 9);
                        
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
                        $mail_body = str_replace('{client_name}', $client_name, $mail_body);
                        $mail_body = str_replace('{user_id}', $client_email, $mail_body);
                        $mail_body = str_replace('{password}', ' ', $mail_body);
                        $mail_body = str_replace('{footer}', $templateFooter, $mail_body);

                        $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Client Registration';
                        $emailData['content'] = $mail_body;

                        $this->sendmail(6,$client_email,$emailData);
                    }
                    

                    //Notification Update start
                    $notification_data['update_message'] = "You have added ".$client_name." as a client.";
                    $notification_data['user_id'] = $user_id;

                    $notification_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
                    //Notification Update End

                    
                    $this->response_status='1';
                    $this->response_message = "Client successfully added.";
                } else {
                    $this->response_message = "Something went wrong. Please try agian later.";
                }
                
            }
            else
            {
                $token1 = md5($client_email);
                $token2 = md5($client_name);
                $token = $token1.$token2;

                $digits = 8;
                $password = rand(pow(10, $digits-1), pow(10, $digits)-1);


                //$client_data['user_id'] = $user_id;
                $client_data['client_name'] = $client_name;
                $client_data['client_email'] = $client_email;
                $client_data['client_mobile'] = $client_mobile;
                $client_data['client_home_phone'] = $client_home_phone;
                $client_data['client_work_phone'] = $client_work_phone;
                //$client_data['client_category'] = $client_category;
                $client_data['client_address'] = $client_address;
                $client_data['client_timezone'] = $client_timezone;
                $client_data['client_note'] = $client_note;

                $client_data['password'] = md5($password);
                $client_data['email_verification_code'] = $token;


                $client_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
                if($client_id > 0){

                    $user_client_data['user_id'] = $user_id;
                    $user_client_data['client_id'] = $client_id;
    
                    $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserClient,$user_client_data);
                    if($insertdata > 0){
                        /* Send Email */
                        if($send_email == true){
                            //$other_params = "?device_type=0&device_token_key=".Session::getId();
                            //$verify_link = $this->base_url('api/emailverification/'.$token.$other_params);// need to change with website url
                            //$emailData['username']=$client_email;
                            //$emailData['password']=$password;
                            //$emailData['toName'] = $client_name;

                            //
                            $email_template = $this->email_template($user_id,$type = 9);

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
                            $mail_body = str_replace('{client_name}', $client_name, $mail_body);
                            $mail_body = str_replace('{user_id}', $client_email, $mail_body);
                            $mail_body = str_replace('{password}', $password, $mail_body);
                            $mail_body = str_replace('{footer}',$templateFooter, $mail_body);
                            $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Client Registration';
                            $emailData['content'] = $mail_body;


                            $this->sendmail(6,$client_email,$emailData);
                        }

                        //Notification Update start
                        $notification_data['update_message'] = "You have added ".$client_name." as a client.";
                        $notification_data['user_id'] = $user_id;

                        $notification_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
                        //Notification Update End

                        
                        $this->response_status='1';
                        $this->response_message = "Client successfully added.";
                    } else {
                        $this->response_message = "Something went wrong. Please try agian later.";
                    }
                    
                } else {
                    $this->response_message = "Something went wrong. Please try agian later.";
                }
                
            }

            $this->json_output($response_data);
        }
    }

    // User's client Listing //
    public function client_list(Request $request){
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
        $other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
		$pageNo = ($pageNo>1)?$pageNo:1;
		$limit=$this->limit;
		$offset=($pageNo-1)*$limit;

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else{
			$user_no = $this->logged_user_no;
		}
        
        $search_text = $request->input('client_search_text');
		$findCond=array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
			array('is_blocked','=','0'),
		);
		if(!empty($search_text)){
			$findCond[]=array($this->tableObj->tableNameClient.'.client_name','like','%'.$search_text.'%');
        }
        
        $client_select_field = array('client_id','client_name','client_email','client_mobile','client_home_phone','client_work_phone','client_address','client_timezone','client_note','client_dob','is_login_allowed','is_email_verified','client_profile_picture','email_verification_code');
		$joins = array(
                    array(
                    'join_table'=>$this->tableObj->tableNameClient,
                    'join_with'=>$this->tableObj->tableNameUserClient,
                    'join_type'=>'left',
                    'join_on'=>array('client_id','=','client_id'),
                    'join_on_more'=>array('is_deleted','=','0'),
                    'select_fields' => $client_select_field,
                )
            );

        $groupBy = array('client_id' => 'DESC');

		$client_list = $this->common_model->fetchDatas($this->tableObj->tableNameUserClient,$findCond,$selectFields=array('user_client_id','created_on'),$joins,$groupBy);
        /*if(!empty($client_list)){
            for($i=0;$i<count($client_list);$i++){
                $count_query = "SELECT created_on FROM `squ_appointment` WHERE `squ_appointment`.`user_id` = '".$user_no."' AND `squ_appointment`.`client_id` = '".$client_list[$i]->client_id."' AND `squ_appointment`.`is_deleted` = '0' ORDER BY created_on DESC LIMIT 0,1";
                $last_appointment = $this->common_model->customQuery($count_query,$query_type=1);
                $client_list[$i]->last_appointment_on = $last_appointment[0]->created_on;
            }
        }*/
        $response_data['client_list']=$client_list;

		$this->response_status='1';
		// generate the service / api response
		$this->json_output($response_data);
    }
    
    // Client Details //
    public function client_details(Request $request){
        $response_data=array();	
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $client_id = $request->input('client_id');
        $user_no = $this->logged_user_no;

        $findCond=array(
            array('user_id','=',$user_no),
            array('client_id','=',$client_id),
            array('is_deleted','=','0'),
        );
        $findFields=array();
        $client_check = $this->common_model->fetchData($this->tableObj->tableNameUserClient,$findCond,$findFields);
        //echo '<pre>'; print_r($client_check); exit;
        if(!empty($client_check)){
            $selectCond=array(
                array('client_id','=',$client_id),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );
            $selectFields=array();
            $client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$selectCond,$selectFields);
            //echo '<pre>'; print_r($client_details); exit;
            //amount
            $query = "SELECT IFNULL(SUM(remaining_balance),0) AS remaining_balance, IFNULL(SUM(paid_amount),0) AS paid_amount FROM `squ_appointment` WHERE `squ_appointment`.`client_id` = '".$client_id."' AND `squ_appointment`.`is_deleted` = 0 ";
            $amount = $this->common_model->customQuery($query,$query_type=1);
    
            $count_query = "SELECT COUNT('appointment_id') as count FROM `squ_appointment` WHERE `squ_appointment`.`client_id` = '".$client_id."' AND `squ_appointment`.`is_deleted` = 0 ";
            $count = $this->common_model->customQuery($count_query,$query_type=1);
    
            if(!empty($client_details)){
                $response_data['client_details']=$client_details;
                $response_data['amount']=$amount[0];
                $response_data['count']=$count[0];
                $this->response_status='1';
                $this->response_message="Client details.";
            } else {
                $this->response_status='0';
                $this->response_message="Client is not valid.";
            }
        } else {
            $this->response_status='0';
            $this->response_message="Client is not valid.";
        }

        // generate the service / api response
        $this->json_output($response_data);

    }

    // Edit Client //
    public function edit_client(Request $request){
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
            return redirect('/login');
        }
        
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        
        $validate = Validator::make($request->all(),[
                                         'client_name'=>'required',
                                         'client_address'=>'required']);
        
        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $client_id = $request->input('client_id');
            $client_name = $request->input('client_name');
            $client_email = $request->input('client_email');
            $client_mobile = $request->input('client_mobile');
            $client_home_phone = $request->input('client_home_phone');
            $client_work_phone = $request->input('client_work_phone');
            $client_timezone = $request->input('client_timezone');
            $client_address = $request->input('client_address');
            $client_note = $request->input('client_note');

            $query = "SELECT * FROM `squ_client` WHERE `client_email` = '".$client_email."' AND `client_id` NOT IN ('".$client_id."')";
            $check_email = $this->common_model->customQuery($query,$query_type=1);
            //echo "<pre>"; print_r($check_email); die();
            if(empty($check_email))
            {
                $conditions = array(
                    array('client_id','=',$client_id),
                    array('user_id','=',$user_id),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                );

                $result = $this->common_model->fetchData($this->tableObj->tableNameUserClient,$conditions);
                if(empty($result))
                {
                    $this->response_message = "Invalid client details.";
                }
                else
                {
                    $client_data['client_name'] = $client_name;
                    $client_data['client_email'] = $client_email;
                    $client_data['client_mobile'] = $client_mobile;
                    $client_data['client_home_phone'] = $client_home_phone;
                    $client_data['client_work_phone'] = $client_work_phone;
                    //$client_data['client_category'] = $client_category;
                    $client_data['client_address'] = $client_address;
                    $client_data['client_timezone'] = $client_timezone;
                    $client_data['client_note'] = $client_note;

                    $updateConditions = array(
                        array('client_id','=',$client_id),
                        array('is_deleted','=','0'),
                        array('is_blocked','=','0'),
                    );

                    $update = $this->common_model->update_data($this->tableObj->tableNameClient,$updateConditions,$client_data);
                    
                    //Notification Update start
                    $notification_data['update_message'] = "You have updated ".$client_name."'s profile.";
                    $notification_data['user_id'] = $user_id;

                    $notification_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
                    //Notification Update End

                    $this->response_status='1';
                    $this->response_message = "Client successfully updated.";
                }
            }
            else
            {
                $this->response_message = "This email already exist.";
            }

            $this->json_output($response_data);

        }
        
    }

    // Client Import //
    public function client_import(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $file = $request->file('client_excel_file');
        //print_r($file); die();
        $type = $file->extension();
        $productInputs = array();
        //echo $type;exit;
        if($type == 'xls' || $type == 'xlsx')
        {
			$existingCompanyPrd = array();
			$fileName = $file->getClientOriginalName();
			$destinationPath = public_path() . '/import_client_excel/';
			$file->move($destinationPath, $fileName);
			$excelData = Excel::load('/public/import_client_excel/'.$fileName, function($reader) {})->get();

			//get data from client table
			/*$condition = array(
	                array('is_deleted', '=', 0),
	            );
            $selectField = array('client_email');
            $check_client = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$condition,$selectField);

            $exist_client_email = array();
        	foreach ($check_client as $key => $value)
            {
            	$exist_client_email[] = $value->client_email;
            }*/

            //echo "<pre>";print_r($exist_client_email);exit;
            $exist = 0;
            $notExit = 0;
			if(!empty($excelData) && count($excelData) > 0)
			{
                $excel_rows = $excelData->toArray();
                //echo "<pre>";print_r($excel_rows);exit;
                if(!empty($excel_rows)){
                    if(isset($excel_rows[0]['email']) && $excel_rows[0]['email']!='' && isset($excel_rows[0]['client_name']) && $excel_rows[0]['client_name']!=''){
                        foreach ($excel_rows as $row)
                        {
                            $updateMasterData = array();
                            //echo "<pre>";print_r($row);exit;
                            if(!empty($row)){
                                
                                /*if(in_array($row['email'],$exist_client_email))
                                {
                                    $exist++;
                                }*/
                                $condition = array(
                                    array('client_email', '=', $row['email']),
                                    array('is_deleted', '=', 0),
                                );
                                $selectField = array('client_id');
                                $check_client = $this->common_model->fetchData($this->tableObj->tableNameClient,$condition,$selectField);
                                if(!empty($check_client)){
                                    $checkCondition = array(
                                        array('user_id', '=', $user_id),
                                        array('client_id', '=', $check_client->client_id),
                                        array('is_deleted', '=', 0),
                                    );
                                    $checkselectField = array('user_client_id');
                                    $check_client = $this->common_model->fetchData($this->tableObj->tableNameUserClient,$checkCondition,$checkselectField);
                                    if(!empty($check_client)){
                                        $exist++;
                                    } else {
                                        
                                        $client_user_data['user_id'] = $user_id;
                                        $client_user_data['client_id'] = $check_client->client_id;
                                        $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserClient,$client_user_data);
                                        if($insertdata > 0)
                                        {
                                            $notExit++;
                                        }
                                    }
                                    
                                }
                                else
                                {
                                    $token1 = md5($row['email']);
                                    $token2 = md5($row['client_name']);
                                    $token = $token1.$token2;
                                    
                                    $digits = 8;
                                    $password = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
                                    //$client_data['user_id'] = $user_id;
                                    $client_data['client_name'] = $row['client_name']; 
                                    $client_data['password'] = md5($password); 
                                    $client_data['client_email'] = $row['email'];
                                    $client_data['client_mobile'] = $row['mobile'];
                                    //$client_data['client_home_phone'] = $row['home_phone']; 
                                    //$client_data['client_work_phone'] = $row['work_phone']; 
                                    $client_data['client_address'] = $row['address']; 
                                    $client_data['client_timezone'] = $row['timezone']; 
                                    $client_data['client_dob'] = ($row['dob'])?date('Y-m-d',strtotime($row['dob'])):''; 
                                    $client_data['client_note'] = $row['note']; 
                                    $client_data['email_verification_code'] = $token;
                                    //print_r($client_data); die();
                                    
                                    $client_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
                                    if($client_id)
                                    {
                                        $user_client_data['user_id'] = $user_id;
                                        $user_client_data['client_id'] = $client_id;
                        
                                        $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameUserClient,$user_client_data);
                                        if($insertdata > 0){
                                            /* Send Email */
                                            $emailData['username'] = $row['email'];
                                            $emailData['password'] = $password;
                                            $emailData['toName'] = $row['client_name'];
                                            $this->sendmail(11,$row['email'],$emailData);
                    
                                            //Notification Update start
                                            $notification_data['update_message'] = "You have added ".$client_name." as a client.";
                                            $notification_data['user_id'] = $user_id;
                    
                                            $notification_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
                                            //Notification Update End
                    
                                        }
                                        
                                    }
                                    $notExit++;
                                }
                                 
                            } else {
                                $this->response_message = "No records to import.";
                            }
                            
                        }
                    } else {
                        $this->response_message = "Please upload proper excel file.";
                    }  
                } else {
                    $this->response_message = "No records to import.";
                }
				
			}

			$this->response_status='1';
            //$this->response_message = $exist.' records exists, '.$notExit.' records successfully inserted.';
            $this->response_message = $notExit.' records successfully inserted.';
        }
        else
        {
        	$this->response_message = "Only excel file can import.";
        }

        //echo 'e'.$exist.'/ne'.$notExit; die();
        $this->json_output($response_data);

    }

    // Verify Client //
    public function verify_client(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $client_id = $request->input('client_id');

        $condition = array(
            array('client_id', '=', $client_id),
            array('is_deleted', '=', '0'),
        );

        $fields = array();                   
        $checkClient = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$condition, $fields);
        if(!empty($checkClient))
        {
            $param = array(
                    'is_email_verified' => 1,
                    'updated_on' => date('Y-m-d H:i:s')
            );

            $updateCond=array(
                array('client_id', '=', $client_id),
                array('is_deleted', '=', '0'),
            );
            $this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$param);

            $this->response_status='1';
            $this->response_message = "Account veried successfully.";
        }
        else
        {
            $this->response_message = "Client details is not valid.";
        }

        $this->json_output($response_data);

    }

    // Send Password EMail (Client)//
    public function send_reset_password_email(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $client_id = $request->input('client_id');

        $condition = array(
            array('client_id', '=', $client_id),
            array('user_id', '=', $user_id),
            array('is_deleted', '=', '0'),
        );

        $fields = array();                   
        $checkClient = $this->common_model->fetchData($this->tableObj->tableNameUserClient,$condition, $fields);
        if(!empty($checkClient)){
            $condition = array(
                array('client_id', '=', $client_id),
                array('is_deleted', '=', '0'),
            );
    
            $selectfields = array();                   
            $clientDetails = $this->common_model->fetchData($this->tableObj->tableNameClient,$condition, $fields);
            if(!empty($clientDetails))
            {
                // Send reset password email to client //
                $parameter =[
                    'client_id' => $client_id,
                    'time' => time()
                ];
                $parameter= Crypt::encrypt($parameter);
                $forgot_password_link = url('/client/forgot-password',$parameter);
                
                $client_email  = $clientDetails->client_email;
                $emailData['forgotPasswordLink'] = $forgot_password_link;            
                $emailData['toName'] = $clientDetails->client_name;
    
                $this->sendmail(13,$client_email,$emailData);
    
                $this->response_status='1';
                $this->response_message="New password generation link has been sent successfully.";
    
            }
            else
            {
                $this->response_message = "Client details is not valid.";
            }
        } else {
            $this->response_message = "Client details is not valid.";
        }


        

        $this->json_output($response_data);
    }


    // Regenerate Password //
    public function client_forgot_password(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $client_id = $request->input('client_id');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $condition = array(
            array('client_id', '=', $client_id),
            array('is_deleted', '=', '0'),
        );

        $fields = array();                   
        $checkClient = $this->common_model->fetchData($this->tableObj->tableNameClient,$condition, $fields);
        if(!empty($checkClient))
        {
            if($new_password == $confirm_password){
                $param = array(
                    'password' => md5($new_password),
                    'updated_on' => date('Y-m-d H:i:s')
                );

                $updateCond=array(
                    array('client_id', '=', $client_id),
                    array('is_deleted', '=', '0'),
                );
                $this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$param);

                $this->response_status='1';
                $this->response_message = "Password has been updated successfully.";
            } else {
                $this->response_message = "Confirm password does not matched with new password.";
            }
        }
        else
        {
            $this->response_message = "Client details is not valid.";
        }

        $this->json_output($response_data);
    }


    //--------------------- //
    public function business_provider_list(Request $request){
        $response_data = array(); 
        
        $client_id = $request->input('client_id'); 
        
        $findCond = array(
            array('client_id','=',$client_id),
            array('is_blocked','=','0'),
			array('is_deleted','=','0'),
		);
        $user_fields = array('user_type','name','business_name');
        $joins = array(
                array(
                'join_table'=>$this->tableObj->tableNameUser,
                'join_with'=>$this->tableObj->tableNameUserClient,
                'join_type'=>'left',
                'join_on'=>array('user_id','=','id'),
                'join_on_more'=>array(),
                'join_conditions' => array(array('is_deleted','=','0')),
                'select_fields' => $user_fields,
            ),
        );

		$business_provider_list = $this->common_model->fetchDatas($this->tableObj->tableNameUserClient, $findCond, $selectFields=array('user_id'), $joins, $orderBy=array(),$groupBy='');        

		$response_data['business_provider_list'] = $business_provider_list;

        $this->json_output($response_data);
        
    }

    public function business_provider_category_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no'); 
        $type = $request->input('type'); 
        
        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            'raw' => "(created_by = '".$user_no."' OR created_by = '0')",
		);
		
		$selectFields = array();
		$category_select_field = array('category as cat');
		$currency_field = array('currency');
		$joins = array(
                    array(
                    'join_table'=>$this->tableObj->tableNameCategory,
                    'join_table_alias'=>'servTb',
                    'join_with'=>$this->tableObj->tableUserService,
                    'join_type'=>'left',
                    'join_on'=>array('category_id','=','category_id'),
                    'join_on_more'=>array(),
                    //'join_conditions' => array(array('transaction_no','=','invoice_no')),
                    'select_fields' => $category_select_field,
                ),
                 array(
                    'join_table'=>$this->tableObj->tableNameCurrency,
                    //'join_with_alias'=>'userTb',
                    'join_with'=>$this->tableObj->tableUserService,
                    //'join_with_alias'=>'servTb',
                    'join_type'=>'left',
                    'join_on'=>array('currency_id','=','currency_id'),
                    //'join_conditions' => array(array('user_no','=','teacher_user_no')),
                    'select_fields' => $currency_field,
                ),
            );

		//$service_list_full = $this->common_model->fetchDatas($this->tableObj->tableUserService, $findCond, $selectFields, $joins);

		$service_category = $this->common_model->fetchDatas($this->tableObj->tableNameCategory, $findCond, $selectFields, $joins=array(), $orderBy=array());


		/*$service = array();
		for($i=0;$i<count($service_category);$i++)
		{

			$catCond = array(
					array('category_id','=',$service_category[$i]->category_id),
					array('user_id','=',$user_no),
					array('is_deleted','=','0'),
					//array('is_blocked','=','0'),
			);
			
			$service_category_details = $this->common_model->fetchDatas($this->tableObj->tableUserService, $catCond, $selectFields, $joins, $orderBy=array(),$groupBy='');

			$service[] = array(
						'category_id' => $service_category[$i]->category_id,
						'category' => $service_category[$i]->cat,
						'details' => $service_category_details
			);

			//$service_category_details = '';
        }*/
        //print_r($service_category); die();
        $response_data['category_list'] = $service_category;
        

        if(isset($type) && $type = 'html'){
            $category_html = '<select name="category_id" id="category_id"><option value="">Select Category</option>';
            foreach($service_category as $category){
                $category_html .= '<option value="'.$category->category_id.'">'.$category->category.'</option>';
            }
            $category_html .= '</select>';
            return $category_html;
        } else {
            $this->json_output($response_data);
        }
        
        
    }

    public function business_provider_service_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no'); 
        $category_id = $request->input('category_id');
        $type = $request->input('type'); 
        
        $findCond = array(
            array('user_id','=',$user_no),
            array('category_id','=',$category_id),
			array('is_deleted','=','0'),
		);
		
		$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $findCond, $selectFields=array(), $joins=array(), $orderBy=array(),$groupBy='');        

		$response_data['service_list'] = $service_list;

        if(isset($type) && $type = 'html'){
            $service_html = '<select name="service_id" id="service_id" ><option value="">Select Service</option>';
            foreach($service_list as $service){
                $service_html .= '<option value="'.$service->service_id.'" data-duration="'.$service->duration.'">'.$service->service_name.'</option>';
            }
            $service_html .= '</select>';
            return $service_html;
        } else {
            $this->json_output($response_data);
        }
        
    }

    public function business_provider_staff_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no');
        $service_id = $request->input('service_id');
        $type = $request->input('type'); 

        $findCond = array(
            array('service_id','=',$service_id),
			array('is_deleted','=','0'),
        );

        $staff_fields = array('full_name','email','mobile');
        $joins = array(
                array(
                'join_table'=>$this->tableObj->tableNameStaff,
                'join_with'=>$this->tableObj->tableNameStaffServiceAvailability,
                'join_type'=>'left',
                'join_on'=>array('staff_id','=','staff_id'),
                'join_on_more'=>array(),
                'join_conditions' => array(array('is_deleted','=','0')),
                'select_fields' => $staff_fields,
            ),
        );

		$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaffServiceAvailability, $findCond, $selectFields=array('staff_id'), $joins, $orderBy=array(),$groupBy='staff_id');        

		$response_data['staff_list'] = $staff_list;


        if(isset($type) && $type = 'html'){ 
            $staff_html = "";
            if(!empty($staff_list))  {
                $staff_html = '<select name="staff_id" id="staff_id"><option value="">Select Staff</option>';
                foreach($staff_list as $staff){
                    $staff_html .= '<option value="'.$staff->staff_id.'">'.$staff->full_name.'</option>';
                }
                $staff_html .= '</select><div class="clearfix"></div>';
            }     
            
            return $staff_html;
        } else {
            $this->json_output($response_data);
        }
        
    }


    public function client_appointment_details(Request $request)
    {
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 

        $order_id = $request->input('order_id'); 
        $client_id = $request->input('client_id'); 
        //appoinment data using id
        $appoinment_condition = array(
            array('order_id', '=', $order_id),
            array('client_id', '=', $client_id),
            array('is_deleted', '=', 0)
        );

        $appoinment_fields = array();

        $client_fields = array('client_name','client_email','client_mobile','client_address','client_dob','client_profile_picture','is_email_verified');

        $service_fields = array('service_name','category_id','cost','duration');

        $stuff_fields = array('full_name','mobile','staff_profile_picture');

        $currency_field = array('currency');

        $business_field = array('business_name','business_location','skype_id');

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
                    'select_fields' => $business_field,
                ),
        );
        
        $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy=array(),$groupBy='order_id');
        //echo '<pre>'; print_r($appoinment_details); exit;
        $appoinmnet = array();
        if(!empty($appoinment_details)){
            $parameter = [
                'client_id' => $client_id,
                ];
            $parameter= Crypt::encrypt($parameter);

            if($appoinment_details->is_email_verified == 0){
                $redirect_url = url('/client/client-dashboard',$parameter);
            } else {
                $redirect_url = url('/client/appointment-booking',$parameter);
            }

            /*if($appoinment_details->duration > 60)
            {
                $app_duration = $this->convertToHoursMins($appoinment_details->duration);
            }
            else
            {
                $app_duration = $appoinment_details->duration;
            }*/
            $app_duration = $appoinment_details->duration;
    
            $appoinmnet = array(
                    "appointment_id" => $appoinment_details->appointment_id,
                    "order_id" => $appoinment_details->order_id,
                    "user_id" => $appoinment_details->user_id,
                    "client_email" => $appoinment_details->client_email,
                    "client_name" => $appoinment_details->client_name,
                    "client_mobile" => $appoinment_details->client_mobile,
                    "client_dob" => ($appoinment_details->client_dob!='0000-00-00')?date('m-d-Y',strtotime($appoinment_details->client_dob)):"",
                    "client_address" => $appoinment_details->client_address,
                    "client_image" => $appoinment_details->client_profile_picture,
                    "client_id" => $appoinment_details->client_id,
                    "cost" => $appoinment_details->cost,
                    "currency" => $appoinment_details->currency,
                    "booked_on" => date('d, M Y',strtotime($appoinment_details->created_on)),
                    "updated_on" => date('d, M Y',strtotime($appoinment_details->updated_on)),
                    "appoinment_date" => date('l d, M Y',strtotime($appoinment_details->date)),
                    "duration" => $app_duration,
                    "end_time" => $appoinment_details->end_time,
                    "paid_amount" => $appoinment_details->paid_amount,
                    "remaining_balance" => $appoinment_details->remaining_balance,
                    "start_time" => $appoinment_details->start_time,
                    "staff_name" => $appoinment_details->full_name,
                    'staff_mobile' => $appoinment_details->mobile,
                    "staff_profile_picture" => $appoinment_details->staff_profile_picture,
                    "service_name" => $appoinment_details->service_name,
                    "service_id" => $appoinment_details->service_id,
                    "category_id" => $appoinment_details->category_id,
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
                    "business_name" => $appoinment_details->business_name,
                    "business_location" => $appoinment_details->business_location,
                    "skype_id" => $appoinment_details->skype_id,
                    "redirect_url" => $redirect_url,
            );

            $response_data['appoinment_details'] = $appoinmnet;
            $this->response_status='1';
            
        } else {
            $this->response_message='Invalid appointment details / Appointment is already cancelled.';
        }
        
        
        // generate the service / api response
        $this->json_output($response_data);
    }


    public function appointment_details(Request $request)
    {
        $response_data = array(); 
        $appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id'); 
        //appoinment data using id
        $appoinment_condition = array(
            array('client_id', '=', $client_id),
            array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0)
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

        $app_duration = $appoinment_details->duration;
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


    public function cancel_appointment_process(Request $request)
    {
        $response_data = array(); 
        
        $appointment_id = $request->input('appointment_id');
		$client_id = $request->input('client_id');
		$cancel_reason = $request->input('cancel_reason');

		$updateCond=array(
            array('client_id','=',$client_id),
            array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0)
        );

		$check_appointment = $this->common_model->row_present_check($this->tableObj->tableNameAppointment,$updateCond);

        if($check_appointment){
			$data['status'] = '2';
			//$data['is_deleted'] = '1';
			$data['cancelled_by'] = '3';
			$data['cancelled_reason'] = $cancel_reason;
	
			$update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data);
	
			$this->response_status='1';
			$this->response_message="Appointment has been cancelled successfully.";
	
		} else {
			$this->response_message="Appointment is not associated with the client.";
		}

        
        $this->json_output($response_data);
        
    }


    public function reschedule_appointment_process(Request $request)
    {
        $response_data = array(); 

        $appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id');
        $service_id = $request->input('service_id');
        $booking_date = $request->input('booking_date');
        $booking_time = $request->input('booking_time');
        $staff_id = $request->input('staff_id');
        $note = $request->input('special_notes');

        //Survice duration
        $service_condition = array(
            array('service_id', '=', $service_id)
        );
        $sevice_fields = array('service_id', 'duration');
        $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);
        

        //calculate end time
        $duration = $service_details->duration;
        $start_time = date('h:i A', strtotime($booking_time)); 
        $endTime = strtotime("+".$duration." minutes", strtotime($booking_time));
        $endTime = date('h:i A', $endTime); 
        $strto_start_time = strtotime($booking_date.' '.$booking_time);
        $strto_end_time = strtotime($booking_date.' '.$endTime);

        $condition = array(
            array('block_date', '=', date('Y-m-d', strtotime($booking_date))),
            array('is_deleted', '=', '0'),
            //array('user_id', '=', $user_id),
            array('staff_id', '=', $staff_id),
            'raw' => "(($strto_start_time BETWEEN strto_start_time AND strto_end_time) OR ($strto_end_time BETWEEN strto_start_time AND strto_end_time))",
        );

        $fields = array();                   
        $checkBlock = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$condition, $fields);

        //print_r($checkBlock); die();

        if(empty($checkBlock))
        {
            $param = array(
                    'date' => date('Y-m-d', strtotime($booking_date)),
                    'start_time' => $start_time,
                    'end_time' => $endTime,
                    'strto_start_time' => $strto_start_time,
                    'strto_end_time' => $strto_end_time,
                    'status' => '3',
                    'note' => $note,
                    'updated_on' => date('Y-m-d H:i:s')
                );

            $updateCond=array(
                array('appointment_id','=',$appointment_id)
            );
            $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$param);

            $this->response_status='1';
            $this->response_message = "Appointment has been rescheduled successfully.";
        }
        else
        {
            $this->response_message = "The timeslot has already blocked. Please try another timeslot.";
        }
        
        $this->json_output($response_data);

    }


    public function client_appointment_booking_process(Request $request)
    {
        //print_r($request->all()); die();
        $response_data = array(); 
        // validate the requested param for access this service api
        $validate = Validator::make($request->all(),[
                                 'user_id'=>'required',
                                 'client_id'=>'required',
                                 'service_id'=>'required',
                                 'booking_date'=>'required',
                                 'booking_time'=>'required',
                                 'client_email'=>'required'
                                ]);

        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $user_id = $request->input('user_id');
            $client = $request->input('client_id');
            $appoinment_service = $request->input('service_id');
            $staff = $request->input('staff_id');
            $date = $request->input('booking_date');
            $formatted_date = date('Y-m-d',strtotime($date));
            $appointmenttime = $request->input('booking_time');
            $numeric_day = date('N', strtotime($date));
            $order_id = 'SQU'.time().mt_rand().$user_id;
            $recurring_booking_frequency = $request->input('recurring_booking_frequency');
            if(isset($recurring_booking_frequency)){
                $recurring_booking_frequency = $recurring_booking_frequency;
            } else {
                $recurring_booking_frequency = 0;
            }
            $recurring_booking_end_type = $request->input('recurring_booking_end_type');
            $recurring_booking_end_on = $request->input('recurring_booking_end_on');
            $recurring_booking_text = $request->input('recurring_booking_text');

            $strto_start_time = strtotime($formatted_date.' '.$appointmenttime); 

            // Service Provider Details //
            $user_condition = array(
                array('id', '=', $user_id)
            );
            $user_fields = array('name', 'email', 'mobile', 'profile_image','business_location');
            $stripe_field = array('stripe_user_id');
            $paypal_field = array('email as paypal_email');
            $joins = array(
                        array(
                            'join_table'=>$this->tableObj->tableNameStripeIntregration,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableNameUser,
                            'join_type'=>'left',
                            'join_on'=>array('id','=','user_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $stripe_field,
                        ),
                        array(
                            'join_table'=>$this->tableObj->tableNamePaypalIntregration,
                            //'join_table_alias'=>'invItemTb',
                            'join_with'=>$this->tableObj->tableNameUser,
                            'join_type'=>'left',
                            'join_on'=>array('id','=','user_id'),
                            'join_on_more'=>array(),
                            //'join_conditions' => array(array('is_deleted','=','0')),
                            'select_fields' => $paypal_field,
                        ),
            );
            $orderBy = array();
            $user_details = $this->common_model->fetchData($this->tableObj->tableNameUser,$user_condition,$user_fields,$joins,$orderBy);
            

            //Client data using id
            $client_condition = array(
                array('client_id', '=', $client)
            );
            $client_fields = array('client_id', 'client_email', 'client_name', 'client_mobile');
            $client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$client_condition, $client_fields);

            //Staff data using id
            if($staff > 0){
                $stuff_condition = array(
                    array('staff_id', '=', $staff)
                );
                $stuff_fields = array('staff_id', 'email', 'full_name','mobile');
                $stuff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff,$stuff_condition, $stuff_fields);    
                $staff_email = $stuff_details->email;
                $staff_name = $stuff_details->full_name;
            }
            
            //Service details
            $service_condition = array(
                array('service_id', '=', $appoinment_service)
            );
            $sevice_fields = array('service_id', 'service_name', 'cost', 'currency_id', 'duration', 'location', 'color', 'payment_method');    
            $currency_field = array('currency');
            $joins = array(
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
            $orderBy = array();

            $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition,$sevice_fields,$joins,$orderBy);
            //$service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);
            
            $service_name = $service_details->service_name;
            $colour_code = $service_details->color;
            $service_payment_method = $service_details->payment_method;
            $duration = $service_details->duration;
            $service_price = $service_details->cost;
            $service_currency_id = $service_details->currency_id;
            $currency = $service_details->currency;
            $service_location = $service_details->location;

            //calculate end time
            $endTime = strtotime("+".$duration." minutes", strtotime($appointmenttime));
            $endTime = date('h:i A', $endTime); 


            $formatted_date_array = array();
            $return_array = array();
            $insert_data = array();
            $unavailable = 0;
            $appointemnt_qty = 0;
            $total_payable_amount = 0;

            if($recurring_booking_frequency == 1){
                if($recurring_booking_end_type == 1){
                    $formatted_end_date = date('Y-m-d',strtotime($recurring_booking_end_on));
                } else {
                    $formatted_end_date = date('Y-m-d',strtotime("+".$recurring_booking_end_on." day", strtotime($formatted_date)));
                }
                $query = "SELECT count(DISTINCT `day`) as total_day FROM `squ_service_availability` WHERE `user_id` = '".$user_id."' AND `service_id` = '".$appoinment_service."' AND `is_deleted` = 0 ";
                $checkServiceAvalibility = $this->common_model->customQuery($query,$query_type=1);

                //echo '<pre>'; print_r($checkServiceAvalibility); exit;
                /*if(!empty($checkServiceAvalibility) && $checkServiceAvalibility[0]->total_day == 7){
                    // Code Here //
                    for( $i = strtotime($date); $i <= strtotime($formatted_end_date); $i = $i + 86400 ) {
                        //$formatted_date_array[] = date( 'Y-m-d', $i );
                        $formatted_date = date( 'Y-m-d', $i );
                        $numeric_day = date( 'N', $i );
                        $return_array = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date);
                        if(empty($return_array)){
                            $unavailable++;
                            //$this->response_message = "Service is not availble for daily, please try again with other time slots.";
                            //break;
                        } else {
                            $total_payable_amount = $total_payable_amount+$return_array['total_payable_amount'];
                            array_push($insert_data,$return_array);
                        }
                    }
                
                } else {
                    $this->response_message = "Service is not availble for daily, please try again with other time slots.";
                }*/

                for( $i = strtotime($date); $i <= strtotime($formatted_end_date); $i = $i + 86400 ) {
                    //$formatted_date_array[] = date( 'Y-m-d', $i );
                    $formatted_date = date( 'Y-m-d', $i );
                    $numeric_day = date( 'N', $i );
                    $return_array = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date);
                    if(empty($return_array)){
                        $unavailable++;
                        //$this->response_message = "Service is not availble for daily, please try again with other time slots.";
                        //break;
                    } else {
                        $appointemnt_qty++;
                        $total_payable_amount = $total_payable_amount+$return_array['total_payable_amount'];
                        array_push($insert_data,$return_array);
                    }
                }
                                
            } else if($recurring_booking_frequency == 2){
                //$formatted_end_date = date('Y-m-d',strtotime("+7 day", strtotime($formatted_date)));
                if($recurring_booking_end_type == 1){
                    $formatted_end_date = date('Y-m-d',strtotime($recurring_booking_end_on));
                } else {
                    $formatted_end_date = date('Y-m-d',strtotime("+".($recurring_booking_end_on*7)." day", strtotime($formatted_date)));
                }
                
                $appoinment_condition = array(
                                    array('user_id', '=', $user_id),
                                    array('service_id', '=', $appoinment_service),
                                    array('day','=',$numeric_day),
                                    array('is_deleted','=','0'),
                                    //'raw' => "((start_date <= '".$formatted_date."' AND end_date >= '".$formatted_end_date."'))",
                                    );

                $appointment_fields = array();                   
                $checkServiceAvalibility = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability,$appoinment_condition, $appointment_fields);
                if(!empty($checkServiceAvalibility)){
                    // Code Here //
                    for($i = strtotime('N', strtotime($date)); $i <= strtotime($formatted_end_date); $i = strtotime('+1 week', $i)){
                        //$formatted_date_array[] = date('Y-m-d', $i );
                        $formatted_date = date( 'Y-m-d', $i );
                        $numeric_day = date( 'N', $i );
                        $return_array = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date);
                        if(empty($return_array)){
                            $unavailable++;
                            //$this->response_message = "Service is not availble for daily, please try again with other time slots.";
                            //break;
                        } else {
                            $appointemnt_qty++;
                            $total_payable_amount = $total_payable_amount+$return_array['total_payable_amount'];
                            array_push($insert_data,$return_array);
                        }
                    }
                    //echo '<pre>'; print_r($insert_data); exit;
                    
                } else {
                    $this->response_message = "Service is not availble for weekly, please try again with other time slots.";
                }
            } else if($recurring_booking_frequency == 3){
                //$formatted_end_date = date('Y-m-d',strtotime("+30 day", strtotime($formatted_date)));
                if($recurring_booking_end_type == 1){
                    $formatted_end_date = date('Y-m-d',strtotime($recurring_booking_end_on));
                } else {
                    $formatted_end_date = date('Y-m-d',strtotime("+".($recurring_booking_end_on*30)." day", strtotime($formatted_date)));
                }
                
                $appoinment_condition = array(
                                    array('user_id', '=', $user_id),
                                    array('service_id', '=', $appoinment_service),
                                    array('day','=',$numeric_day),
                                    array('is_deleted','=','0'),
                                    //'raw' => "((start_date <= '".$formatted_date."' AND end_date >= '".$formatted_end_date."'))",
                                    );

                $appointment_fields = array();                   
                $checkServiceAvalibility = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability,$appoinment_condition, $appointment_fields);
                if(!empty($checkServiceAvalibility)){
                    // Code Here //
                    for($i = strtotime($date); $i <= strtotime($formatted_end_date); $i = strtotime('+1 month', $i)){
                        //$formatted_date_array[] = date('Y-m-d', strtotime($recurring_booking_text.''. date('Y-m',$i)));
                        $formatted_date = date('Y-m-d', strtotime($recurring_booking_text.''. date('Y-m',$i)));
                        $numeric_day = date( 'N', $i );
                        $return_array = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date);
                        if(empty($return_array)){
                            $unavailable++;
                            //$this->response_message = "Service is not availble for daily, please try again with other time slots.";
                            //break;
                        } else {
                            $appointemnt_qty++;
                            $total_payable_amount = $total_payable_amount+$return_array['total_payable_amount'];
                            array_push($insert_data,$return_array);
                        }
                    }
                } else {
                    $this->response_message = "Service is not availble for monthly, please try again with other time slots.";
                }
            } else if($recurring_booking_frequency == 4){
                //$formatted_end_date = date('Y-m-d',strtotime("+7 day", strtotime($formatted_date)));
                if($recurring_booking_end_type == 1){
                    $formatted_end_date = date('Y-m-d',strtotime($recurring_booking_end_on));
                } else {
                    $formatted_end_date = date('Y-m-d',strtotime("+".$recurring_booking_end_on." day", strtotime($formatted_date)));
                }

                $query = "SELECT DISTINCT `day` FROM `squ_service_availability` WHERE `user_id` = '".$user_id."' AND `service_id` = '".$appoinment_service."' AND `is_deleted` = 0 ORDER BY `day` ASC";
                $checkServiceAvalibility = $this->common_model->customQuery($query,$query_type=1);
                if(!empty($checkServiceAvalibility) && $checkServiceAvalibility[0]->day == 1 && $checkServiceAvalibility[1]->day == 2 && $checkServiceAvalibility[2]->day == 3 && $checkServiceAvalibility[3]->day == 4 && $checkServiceAvalibility[4]->day == 5){
                    // Code Here //
                    for ($i = strtotime($date); $i <= strtotime($formatted_end_date); $i = strtotime("+1 day", $i)) {
                        $day = date("l", $i);
                        if ($day != 'Sunday' && $day != 'Saturday') {
                            //$formatted_date_array[] = date('Y-m-d', $i );
                            $formatted_date = date('Y-m-d', $i );
                            $numeric_day = date( 'N', $i );
                            $return_array = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date);
                            if(empty($return_array)){
                                $unavailable++;
                                //$this->response_message = "Service is not availble for weekday, please try again with other time slots.";
                                //break;
                            } else {
                                $appointemnt_qty++;
                                $total_payable_amount = $total_payable_amount+$return_array['total_payable_amount'];
                                array_push($insert_data,$return_array);
                            }
                        }
                    }
                } else {
                    $this->response_message = "Service is not availble for weekday, please try again with other time slots.";
                }
            } else if($recurring_booking_frequency == 5){
                // Custom Settings //
            } else {

                $insert_data = $this->findRecurringAvailibility($order_id,$user_id,$staff,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date='');
                //echo '<pre>'; print_r($insert_data); exit;
                if(!empty($insert_data)){
                    $appointemnt_qty = 1;
                    $total_payable_amount = $total_payable_amount+$insert_data['total_payable_amount'];
                }
                
            }

            //echo $total_payable_amount;
            //echo '<pre>'; print_r($insert_data); exit;
            //echo $unavailable; die();
            if(!empty($insert_data) && $unavailable == 0){
                //$total_cost = $total_available_day * 
                $insertdata = $this->common_model->insert_data($this->tableObj->tableNameAppointment,$insert_data);
                
                // Update Total Price //
                $updateCond=array(
                    array('client_id','=',$client),
                    array('order_id', '=', $order_id),
                    array('is_deleted', '=', 0)
                );
                $updatedata['total_payable_amount'] = $total_payable_amount;	
                $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$updatedata);

                $parameter = [
                    'order_id' => $order_id,
                    'client_id' => $client,
                    'user_id' => $user_id,
                    'recurring_booking_frequency' => $recurring_booking_frequency
                ];
                $parameter= Crypt::encrypt($parameter);

                if($recurring_booking_frequency > 0){
                    $cancel_url = url('/client/appointment_details',$parameter);
                    $reschedule_url = url('/client/appointment_details',$parameter);
                } else {
                    $cancel_url = url('/client/cancel_appointent',$parameter);
                    $reschedule_url = url('/client/reschedule-appointment',$parameter);
                }

                if($service_payment_method == 1){
                    
                    //send mail to client
                    $client_email = $client_details->client_email;
                    $client_name = $client_details->client_name;
                    $service_name = $service_details->service_name;
                    $service_cost = $service_details->cost;
                    $service_duration = $service_details->duration;
                    $service_location = $service_details->location;
                    //$service_currency = $service_details->duration;
                    $service_start_time = date('l d, Y h:i A',$strto_start_time);

                    // Email template 
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
                    $mail_body = str_replace('{staff_name}', isset($staff_name)?$staff_name:'N/A', $mail_body);
                    $mail_body = str_replace('{booking_time}', $service_start_time, $mail_body);
                    $mail_body = str_replace('{location}', $service_location, $mail_body);
                    $mail_body = str_replace('{staff_email}', isset($staff_email)?$staff_email:'N/A', $mail_body);
                    $mail_body = str_replace('{reshedule_url}', $reschedule_url, $mail_body);
                    $mail_body = str_replace('{cancel_url}', $cancel_url, $mail_body);
                    $mail_body = str_replace('{footer}', $templateFooter, $mail_body);
        
                    $emailData['subject'] = $email_template->subject ? $email_template->subject : 'Booking Confirm';
                    $emailData['content'] = $mail_body;
        
                    $this->sendmail(7,$client_email,$emailData);
        
        
                    //send mail to stuff
                    if($staff > 0){
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
                    
                    // Event Viewer //
                    //$this->add_user_event_viewer($user_id,$type=4,$staff);
                    $response_data['parameter'] = $parameter;
                    $response_data['payment_method'] = $service_payment_method;
                    $response_data['cancel_url'] = $cancel_url;
                    $response_data['reschedule_url'] = $reschedule_url;
                    
                    $this->response_status='1';
                    $this->response_message = "Your appointment has been successfully booked.";
        
                } else if($service_payment_method == 2){
                    // Redirect to Paypal Payment Gateway //
                    $response_data['parameter'] = $parameter;
                    $response_data['payment_method'] = $service_payment_method;
                    $response_data['cancel_url'] = $cancel_url;
                    $response_data['reschedule_url'] = $reschedule_url;

                    $this->response_status='1';
                    $this->response_message = "Your appointment has been successfully booked.";

                } else if($service_payment_method == 3) {
                    // Redirect to Stripe Payment Gateway //
                    $response_data['parameter'] = $parameter;
                    $response_data['payment_method'] = $service_payment_method;
                    $response_data['cancel_url'] = $cancel_url;
                    $response_data['reschedule_url'] = $reschedule_url;

                    $this->response_status='1';
                    $this->response_message = "Your appointment has been successfully booked.";
                    
                }
            } else {

                //echo "<pre>"; print_r($insert_data); die();

                /*$parameter = [
                    'order_id' => $insert_data[0]->order_id,
                    'client_id' => $insert_data[0]->client_id,
                ];
                $parameter= Crypt::encrypt($parameter);*/
                $this->response_status='0';
                $this->response_message = "Appointment can not be booked.";
            }
           
            $this->json_output($response_data);
        }
    }


    private function findRecurringAvailibility($order_id,$user_id,$staff=0,$client,$appoinment_service,$formatted_date,$numeric_day,$appointmenttime,$endTime,$recurring_booking_frequency,$formatted_end_date=''){
        
        
        //Service details
        $service_condition = array(
            array('service_id', '=', $appoinment_service)
        );
        $sevice_fields = array('service_id', 'service_name', 'cost', 'currency_id', 'duration', 'location', 'color', 'payment_method');    
        $service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$service_condition, $sevice_fields);
        $colour_code = $service_details->color;
        $payment_method = $service_details->payment_method;
        $duration = $service_details->duration;
        $service_price = $service_details->cost;
        $service_currency_id = $service_details->currency_id;

        
        //////////////////////////////////////////////
        $param = array();
        //////// Create start time & end time ////////
        $strto_start_time = strtotime($formatted_date.' '.$appointmenttime); 
        $strto_end_time = strtotime($formatted_date.' '.$endTime);
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
                if($staff > 0){
                    // Check Staff Availability //
                    $condition = array(
                        array('block_date', '=', date('Y-m-d', strtotime($formatted_date))),
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
                                $param = array(
                                    'order_id' => $order_id,
                                    'user_id' => $user_id,
                                    'service_id' => $appoinment_service,
                                    'staff_id' => $staff,
                                    'client_id' => $client,
                                    'date' => date('Y-m-d', strtotime($formatted_date)),
                                    'start_time' => date('h:i A', strtotime($appointmenttime)),
                                    'end_time' => date('h:i A', strtotime($endTime)),
                                    'strto_start_time' => $strto_start_time,
                                    'strto_end_time' => $strto_end_time,
                                    'colour_code' => $colour_code,
                                    'payment_amount' => $service_price,
                                    'total_payable_amount' => $service_price,
                                    'appointment_type' => $recurring_booking_frequency,
                                    'recurring_booking_ends_on' => $formatted_end_date,
                                    'created_on' => date('Y-m-d H:i:s'),
                                );  
                                if($payment_method == 1){
                                    $param['payment_method'] = 1;
                                } else if($payment_method == 2){
                                    $param['payment_method'] = 11;
                                } else if($payment_method == 3){
                                    $param['payment_method'] = 10;
                                }
                                
                            } else {
                                $this->response_message = "Staff is not available for this service.";
                            }

                            
                        } else {
                            $this->response_message = "Staff is not available for this service.";
                        }
                        
                    }
                    else
                    {
                        $this->response_message = "Staff is not availble, please try again with other time slots.";
                    }
                } else {
                    $param = array(
                        'order_id' => $order_id,
                        'user_id' => $user_id,
                        'service_id' => $appoinment_service,
                        //'staff_id' => $staff,
                        'client_id' => $client,
                        'date' => date('Y-m-d', strtotime($formatted_date)),
                        'start_time' => date('h:i A', strtotime($appointmenttime)),
                        'end_time' => date('h:i A', strtotime($endTime)),
                        'strto_start_time' => $strto_start_time,
                        'strto_end_time' => $strto_end_time,
                        'colour_code' => $colour_code,
                        'payment_amount' => $service_price,
                        'total_payable_amount' => $service_price,
                        'appointment_type' => $recurring_booking_frequency,
                        'recurring_booking_ends_on' => $formatted_end_date,
                        'created_on' => date('Y-m-d H:i:s'),
                    );  
                    if($payment_method == 1){
                        $param['payment_method'] = 1;
                    } else if($payment_method == 2){
                        $param['payment_method'] = 11;
                    } else if($payment_method == 3){
                        $param['payment_method'] = 10;
                    }
                }
                
            } else{
                $param = array();
                $this->response_message = "Service is not availble, please try again with other time slots.";
            }

        } else{
            $param = array();
            $this->response_message = "Service is not availble, please try again with other time slots.";
        }

        return $param;

    }


    public function send_client_verification_code(Request $request){
        $response_data = array(); 
        
        //$appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id');
        $client_email = $request->input('client_email');

        $chkCond=array(
            array('client_id','=',$client_id),
            //array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0),
            array('is_blocked', '=', 0)
        );

		$check_client = $this->common_model->row_present_check($this->tableObj->tableNameClient,$chkCond);
        if($check_client){
            $updateCond=array(
                array('client_id','=',$client_id),
                array('is_deleted', '=', 0)
            );
            $verification_code = mt_rand( 10000000, 99999999);
            $data['last_verification_code'] = $verification_code;	
            $update = $this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$data);
            // Send Mail //
            $emailData['verification_code']=$verification_code;
            $this->sendmail(9,$client_email,$emailData);
    
            $parameter = [
                'client_id' => $client_id,
                ];
            $response_data['parameter']= Crypt::encrypt($parameter);

			$this->response_status='1';
			$this->response_message="Verification code has been sent successfully.";
        }else {
			$this->response_message="Appointment is not associated with the client.";
		}

        $this->json_output($response_data);
    }


    public function appointment_verification(Request $request){
        $response_data = array(); 
        
        $verification_code = $request->input('verification_code');
        $client_id = $request->input('client_id');

        $chkCond=array(
            array('client_id','=',$client_id),
            array('last_verification_code', '=', $verification_code),
            array('is_deleted', '=', 0)
        );

		$check_verification = $this->common_model->row_present_check($this->tableObj->tableNameClient,$chkCond);
        if($check_verification){
            $data['is_email_verified'] = 1;	
            $update = $this->common_model->update_data($this->tableObj->tableNameClient,$chkCond,$data);
            
            $parameter = [
                'client_id' => $client_id,
                ];
            $response_data['parameter']= Crypt::encrypt($parameter);
			$this->response_status='1';
			$this->response_message="Verification code has been successfully verified.";
        }else {
			$this->response_message="Verification code does not matched.";
		}

        $this->json_output($response_data);
    }
    


    public function calendar_availability_list(Request $request){
        $response_data = array(); 
        
        $user_id = $request->input('user_no');
        $appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id');
        $service_id = $request->input('service_id');
        $staff_id = $request->input('staff_id');
        $duration = $request->input('duration');
        $order = $request->input('order');
        $cal_start = $request->input('cal_start');


        $chkCond=array(
            array('client_id','=',$client_id),
            array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0)
        );

		/*$check_appointment = $this->common_model->row_present_check($this->tableObj->tableNameAppointment,$chkCond);
        if($check_appointment){
            
        }else {
			$this->response_message="Appointment is not associated with the client.";
        }*/
        
        $date_array = array();
        $date_array_header = array();
        $current_month = "";
        if($cal_start==""){
            $today_date = date('Y-m-d');
        } else {
            $today_date = $cal_start;
            if($order == 2){
                $today_date = date('Y-m-d', strtotime($cal_start . '-12 day'));
                if($today_date < date('Y-m-d')){
                    $today_date = date('Y-m-d');
                }
            }
        }
        
        for($i=0;$i<7;$i++){
            $next_date = date('Y-m-d', strtotime($today_date . '+'.$i.' day'));
            $numeric_day = date('N', strtotime($next_date));
            $date_array_header[$next_date] = array(date('D',strtotime($next_date)),date('d',strtotime($next_date)));
            $time_slots = array();

            // Service Start Time & End Time //
            $query = "SELECT min(`start_time`) as min_start_time, max(`end_time`) as max_start_time FROM `squ_service_availability` WHERE `service_id` = '".$service_id."' AND `user_id` = '".$user_id."' AND `is_deleted` = 0 ";
            $start_end_time = $this->common_model->customQuery($query,$query_type=1);
            if(!empty($start_end_time) && $start_end_time[0]->min_start_time!='' && $start_end_time[0]->max_start_time != ''){
                $service_start_time = $start_end_time[0]->min_start_time.":00";
                $service_end_time = $start_end_time[0]->max_start_time.":00";
    
                $time_slot_start = $next_date." ".$service_start_time;
                $time_slot_end = $next_date." ".$service_end_time;
            } else {
                $time_slot_start = $next_date." 00:00:00";
                $time_slot_end = $next_date." 23:59:59";
            }

            $service_avalibility_date = array();
            $staff_service_avalibility = array();
            $blockDateTime = array();
            $appoinment_list = array();
            /************Get service availability************* */
            $ser_ava_condition = array(
                array('user_id', '=', $user_id),
                array('service_id', '=', $service_id),
                array('day', '=', $numeric_day),
                array('is_deleted', '=', '0'),
                'raw' => "((start_date <= '".$next_date."' AND end_date >= '".$next_date."') OR (start_date <= '".$next_date."' AND end_date = '0000:00:00'))",
            );
            $ser_ava_fields = array();                   
            $service_avalibility_date = $this->common_model->fetchDatas($this->tableObj->tableNameServiceAvailability,$ser_ava_condition, $ser_ava_fields);
            //echo '<pre>'; print_r($service_avalibility_date); exit;
            /************Get service availability************* */

            if($staff_id != ''){
                /************Get service staff availability************* */
                $ser_staff_ava_condition = array(
                    array('staff_id', '=', $staff_id),
                    array('service_id', '=', $service_id),
                    array('day', '=', $numeric_day),
                    array('is_blocked', '=', '0'),
                    array('is_deleted', '=', '0'),
                );
                $fields = array();                   
                $staff_service_avalibility = $this->common_model->fetchDatas($this->tableObj->tableNameStaffServiceAvailability,$ser_staff_ava_condition, $fields);

                //echo '<pre>'; print_r($staff_service_avalibility); exit;
                /************Get service staff availability************* */
                
                /************Get blocked time************* */
                $blockCondition = array(
                    array('staff_id','=',$staff_id),
                    array('block_date','=',$next_date),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                );
                $blockFields = array('block_date','start_time', 'end_time', 'block_reasons');
                $blockDateTime = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$blockCondition,$blockFields);     
                /***************get blocked time************************** */

                /************Get booked time************* */
                $appoinment_condition = array(
                    array('staff_id','=',$staff_id),
                    array('date','=',$next_date),
                    array('is_deleted','=','0'),
                );
                $appoinment_fields = array('appointment_id', 'staff_id', 'start_time', 'end_time', 'date','colour_code');
                $joins = array();
                $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);
                /***************get booked time************************** */

            }
            
            for($j = strtotime($time_slot_start); $j < strtotime($time_slot_end); ){
                $tmp = date('H:i:s',$j);
                $tmp_end = strtotime(date('Y-m-d H:i:s',$j) . '+'.$duration.' minutes');
                $blocked = 0;
                $booked = 0;

                /****************check if service is available*************** */
                if(!empty($service_avalibility_date) && is_array($service_avalibility_date)){
                    foreach($service_avalibility_date as $sad){
                        $ava_starttime = strtotime($next_date.' '.$sad->start_time.':00');
                        $ava_endtime = strtotime($next_date.' '.$sad->end_time.':00');
                        //echo date('Y-m-d H:i:s',$tmp_end).'---'.date('Y-m-d H:i:s',$j).'----'.date('Y-m-d H:i:s',$ava_starttime)."---".date('Y-m-d H:i:s',$ava_endtime); exit;
                        if(
                            ($j >= $ava_starttime && $j <= $ava_endtime)
                            ||
                            ($tmp_end >= $ava_starttime && $tmp_end <= $ava_endtime)                                
                        )
                            {
                            $booked = 0;
                        } else {
                            $booked = 1;
                        }
                    }
                } else {
                    $booked = 1;
                }
                /*****************check if service is available************** */

                /****************check if time is blocked*************** */
                if(!empty($blockDateTime) && is_array($blockDateTime)){
                    //echo '<pre>'; print_r($blockDateTime); exit;
                    foreach($blockDateTime as $bdt){
                        if
                        (
                        ($j >= strtotime($next_date." ".$bdt->start_time) && $j <= strtotime($next_date." ".$bdt->end_time))
                        ||
                        ($tmp_end >= strtotime($next_date." ".$bdt->start_time) && $tmp_end <= strtotime($next_date." ".$bdt->end_time))
                        ){
                            $blocked = 1;
                        }
                    }
                }
                /*****************check if time is blocked************** */

                /****************check if staff-service is available*************** */
                if(!empty($staff_service_avalibility) && is_array($staff_service_avalibility)){
                    //echo '<pre>'; print_r($staff_service_avalibility); exit;
                    foreach($staff_service_avalibility as $ssad){
                        $ssa_starttime = strtotime($next_date.' '.$ssad->start_time);
                        $ssa_endtime = strtotime($next_date.' '.$ssad->end_time);
                        if(
                            ($j >= $ssa_starttime && $j <= $ssa_endtime)
                            ||
                            ($tmp_end >= $ssa_starttime && $tmp_end <= $ssa_endtime)                                
                        )
                            {
                            $booked = 0;
                        } else {
                            $booked = 1;
                        }
                    }
                }
                /*****************check if staff-service is available************** */

                /****************check if time is booked*************** */
                if(!empty($appoinment_list) && is_array($appoinment_list)){
                    foreach($appoinment_list as $al){
                        if(
                            ($j >= strtotime($next_date." ".$al->start_time) && $j <= strtotime($next_date." ".$al->end_time))
                            ||
                            ($tmp_end >= strtotime($next_date." ".$al->start_time) && $tmp_end <= strtotime($next_date." ".$al->end_time))                                
                        )
                            {
                            $booked = 1;
                        }
                    }
                }
                /*****************check if time is booked************** */
                

                $time_slots[$tmp] = array('date'=>$next_date,'slot'=>$tmp,'date_time_formatted'=>date('D - d M, Y - h:i A',strtotime($next_date." ".$tmp)),'slot_formatted'=>date('h:i A',strtotime($tmp)),'blocked'=>$blocked,'booked'=>$booked);
                $j = $tmp_end;
            }
            $date_array[$next_date] = $time_slots;

           $current_month = date('M, Y',strtotime($next_date));
        }
        //exit;
        //echo '<pre>'; print_r($date_array); exit;

        $response_data['calendar_availability_list'] = $date_array;
        $response_data['date_array_header'] = $date_array_header;
        $response_data['current_month'] = $current_month;
        $response_data['current_date'] = date('Y-m-d');            
        $this->response_status='1';
        $this->response_message="Available Calendar List";

        $this->json_output($response_data);
    }

    
    public function client_login(Request $request)
    {
        $response_data=array();
        // validated the parameters
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required',
            'password' => 'bail|required',
        ]);
        if(!$validator->fails())
        {
            //validate the user details
            
            $table_name = $this->tableObj->tableNameClient;
            $password = $request->input('password');
            $email = $request->input('email');
            $conditions = array(
                array('password','=',md5($password)),
                array('client_email', '=', $email),
            );
            $selectFields=array();
            $user = $this->common_model->fetchData($table_name,$conditions,$selectFields);
            //print_r($user); die();
            if(empty($user))
            {
                $this->response_message="Email/Username and password does not match.";
            }
            else
            {
                //Redirect url
                $parameter = [
                    'client_id' => $user->client_id,
                    ];
                $parameter= Crypt::encrypt($parameter);

                if($user->is_email_verified == 0){
                    $redirect_url = url('/client/client-dashboard',$parameter);
                } else {
                    $redirect_url = url('/client/appointment-booking',$parameter);
                }
                
                $this->response_status='1';
                $this->response_message = $redirect_url;
            }
        }
        else
        {
            // if parameter validation checked faild
            $errors = $validator->errors()->messages();
            $this->response_message = $this->forErrorMessage($errors);
        }
        // generate the service / api response
        $this->json_output($response_data);
    }


    public function client_registration(Request $request)
    {
        $response_data=array();
        // validated the parameters
        $validator = Validator::make($request->all(), [
            'client_name' => 'required',
            'client_email' => 'bail|required',
            'password' => 'bail|required',
            'client_mobile' => 'required',
            'client_address' => 'required',
            //'client_timezone' => 'required'
        ]);
        if(!$validator->fails())
        {
            //validate the user details
            
            $table_name = $this->tableObj->tableNameClient;
            $client_name = $request->input('client_name');
            $client_email = $request->input('client_email');
            $password = $request->input('password');
            $client_mobile = $request->input('client_mobile');
            $client_address = $request->input('client_address') ? $request->input('client_address'):"";
            $client_timezone = $request->input('client_timezone');
            $conditions = array(
                array('client_email', '=', $client_email),
            );
            $selectFields=array();
            $client_details = $this->common_model->fetchData($table_name,$conditions,$selectFields);
            //print_r($client_details); die();
            if(!empty($client_details)){
                $this->response_message="This Email address is already exists.";
            } else {
                
                $token1 = md5($client_email);
                $token2 = md5($client_name);
                $token = $token1.$token2;

                $client_data['client_name'] = $client_name;
                $client_data['client_email'] = $client_email;
                $client_data['client_mobile'] = $client_mobile;
                $client_data['client_address'] = $client_address;
                $client_data['client_timezone'] = $client_timezone;

                $client_data['password'] = md5($password);
                $client_data['email_verification_code'] = $token;


                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
                if($insertdata > 0){
                    /* Send Email */
                    //$other_params = "?device_type=0&device_token_key=".Session::getId();
                    //$verify_link = $this->base_url('api/emailverification/'.$token.$other_params);// need to change with website url
                    $verify_link = $this->base_url('api/client_emailverification/'.$token);
                    $emailData['username']=$client_email;
                    $emailData['toName'] = $client_name;
                    $emailData['verify_link'] = $verify_link;

                    $this->sendmail(1,$client_email,$emailData);
                    
                    $this->response_status='1';
                    $this->response_message = "You have registered successfully. Please verify your email address.";
                } else {
                    $this->response_message = "Something went wrong. Please try agian later.";
                }
            }

        }
        else
        {
            // if parameter validation checked faild
            $errors = $validator->errors()->messages();
            $this->response_message = $this->forErrorMessage($errors);
        }
        // generate the service / api response
        $this->json_output($response_data);
    }

    public function client_emailverification($verify_token='')
	{
		$response_data=array();
		$redirectURl = $this->base_url('thank-you');
		if(!empty($verify_token))
		{
			$find_cond=array(
				array('email_verification_code','=',$verify_token),
				array('is_deleted','=','0'),
				array('is_email_verified','=','0')
			);

			$user = $this->common_model->fetchData($this->tableObj->tableNameClient,$find_cond);
			if(empty($user))
			{

				//$message = $this->message_render('email_verification_token_expired');
				//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
				\Session::flash('error_message', "Invalid Email verification token."); 
                return redirect('/client/login');
			}
			else
			{
				// create email validation token :: format : md5(client_email).md5(client_name)
				$client_email = $user->client_email;
                $client_name = $user->client_name;
                $client_id = $user->client_id;
				$token1 = md5($client_email);
				$token2 = md5($client_name);
				$token = $token1.$token2;
				$created_on = strtotime($user->created_on);
				// validate the token 
				if($token!=$verify_token){
					//$this->response_message="email_verification_token_invalid";
					//$this->json_output();
					//$message = $this->message_render('email_verification_token_expired');
					//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
					\Session::flash('error_message', "Invalid Email verification token."); 
                	return redirect('/client/login');
				}
				else if($created_on + (72*3600) >= time() )
				{
					// do the neccessary work
					$find_cond[]=array('client_id','=',$client_id);
					// updatedata 
					$updateData=array(
						'is_email_verified'=>'1',
						'updated_on'=>$this->date_format
					);
					$this->common_model->update_data($this->tableObj->tableNameClient,$find_cond,$updateData);
					//$message = $this->message_render('email_verification_success');
					//return redirect($redirectURl)->with('message',['type'=>'success','text'=>$message]);
					\Session::flash('success_message', "Successfully email verified."); 
	     			return redirect('/client/login');
				} 
				else
				{
					//$message = $this->message_render('email_verification_token_expired');
					//return redirect($redirectURl)->with('message',['type'=>'error','text'=>$message]);
					\Session::flash('error_message', "Email verification token expired."); 
                	return redirect('/client/login');
				}
			}
		}
		else
		{
			\Session::flash('error_message', "Email verification token missing."); 
            return redirect('/client/login');
			//return redirect($redirectURl)->with('message',['type'=>'error','text'=>"email_verification_token_missing"]);
		}
	}

    // Client Details //
    public function client_info(Request $request){
        $response_data=array();	
        // validate the requested param for access this service api
        $client_id = $request->input('client_id');

        $selectCond=array(
            array('client_id','=',$client_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        $selectFields=array();
        $client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$selectCond,$selectFields);
        //echo '<pre>'; print_r($client_details); exit;
        //amount
        $query = "SELECT IFNULL(SUM(remaining_balance),0) AS remaining_balance, IFNULL(SUM(paid_amount),0) AS paid_amount FROM `squ_appointment` WHERE `squ_appointment`.`client_id` = '".$client_id."' AND `squ_appointment`.`is_deleted` = 0 ";
        $amount = $this->common_model->customQuery($query,$query_type=1);

        $count_query = "SELECT COUNT('appointment_id') as count FROM `squ_appointment` WHERE `squ_appointment`.`client_id` = '".$client_id."' AND `squ_appointment`.`is_deleted` = 0 ";
        $count = $this->common_model->customQuery($count_query,$query_type=1);

        if(!empty($client_details)){
            $response_data['client_details']=$client_details;
            $response_data['amount']=$amount[0];
            $response_data['count']=$count[0];
            $this->response_status='1';
            $this->response_message="Client details.";
        } else {
            $this->response_status='0';
            $this->response_message="Client is not valid.";
        }

        // generate the service / api response
        $this->json_output($response_data);

    }
    
    public function client_appointment_list(Request $request)
    {
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $client_id = $request->input('client_id');
        

        $condition = array(
            array('client_id', '=', $client_id),
            array('user_id', '=', $user_id),
            //array('is_deleted', '=', '0'),
        );

        $appointmentFields = array('appointment_id','date','start_time','created_on','total_payable_amount','appointment_status');
        $staffFields = array('full_name');
        $serviceFields = array('service_name');

        $tableUserService = $this->tableObj->tableUserService;
        $tableStaff = $this->tableObj->tableNameStaff;
        $tableAppointement = $this->tableObj->tableNameAppointment;

        $joins = array(
                    array(
                        'join_table'=>$tableStaff,
                        'join_with'=>$tableAppointement,
                        'join_type'=>'left',
                        'join_on'=>array('staff_id','=','staff_id'),
                        'join_on_more'=>array(),
                        //'join_conditions' => array(array('is_blocked','=','0')),
                        'select_fields' => $staffFields,
                    ),
                    array(
                        'join_table'=>$tableUserService,
                        'join_with'=>$tableAppointement,
                        'join_type'=>'left',
                        'join_on'=>array('service_id','=','service_id'),
                        'join_on_more'=>array(),
                        //'join_conditions' => array(array('is_blocked','=','0')),
                        'select_fields' => $serviceFields,
                    ),
            );

        $appoinment_list = $this->common_model->fetchDatas($tableAppointement,$condition,$appointmentFields, $joins);
        $html = '';
        if(!empty($appoinment_list))
        {
            foreach ($appoinment_list as $key => $value)
            {
                $create_date = date('d M, Y', strtotime($value->created_on)); 
                $appintment_date = date('d M, Y', strtotime($value->date)).'-'. $value->start_time;
                $client_appoinment_status = $value->appointment_status;
                $client_appoinment_status = $client_appoinment_status ? $client_appoinment_status : 'CHECK IN';

                $html .= '<tr><td>'.$create_date.'</td><td>'.$appintment_date.'</td><td>'.$value->service_name.'</td><td>'.$value->full_name.'</td><td  style="text-align: center;">$'.$value->total_payable_amount.'</td><td  style="text-align: center;"><div class="dropdown "><button class="btn dropdown-toggle" type="button" data-toggle="dropdown" "><span id="change-status-'.$value->appointment_id.'">'.$client_appoinment_status.'</span> <img src="'.url('public/assets/website/images/arrow.png').'" alt=""/></button><ul class="dropdown-menu"><li><a href="javascript:void(0);" data-id="'.$value->appointment_id.'" data-status="As Scheduled" class="change-status">As Scheduled</a></li><li><a href="javascript:void(0);" data-id="'.$value->appointment_id.'" data-status="Arrived Late" class="change-status">Arrived Late</a></li><li><a href="javascript:void(0);" data-id="'.$value->appointment_id.'" data-status="No show" class="change-status">No show</a></li><li><a href="javascript:void(0);" data-id="'.$value->appointment_id.'" data-status="Gift Certificates" class="change-status">Gift Certificates</a></li></ul></div></td></tr>';
            }
        }
        else
        {
            $html .= '<tr><td colspan="6">No data found</td></tr>';
        }

        $this->response_status='1';
        $this->response_message = $html;
        $this->json_output($response_data);
    }  

    public function client_update_profile_settings(Request $request){
        $response_data = array(); 
        
        $parameter = $request->input('parameter');
        $client_id= Crypt::decrypt($parameter);
        $client_name = $request->input('client_name');
        $client_address = $request->input('client_address');
        $client_mobile = $request->input('client_mobile');
        $client_home_phone = $request->input('client_home_phone');
        $client_work_phone = $request->input('client_work_phone');
        $client_dob = $request->input('client_dob');
        if($client_dob){
            $client_dob = date('Y-m-d',strtotime($client_dob));
        }
        $client_timezone = $request->input('client_timezone');
        $client_note = $request->input('client_note');

        $chkCond=array(
            array('client_id','=',$client_id),
            array('is_deleted','=','0'),
        );
        $chkFields=array();
        $check_client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$chkCond,$chkFields);
        if(!empty($check_client_details)){
            $condition = array(
                array('client_id', '=', $client_id),
                array('is_deleted', '=', '0'),
            );
            
            $update_data['client_name'] = $client_name;
            $update_data['client_address'] = $client_address;
            $update_data['client_mobile'] = $client_mobile;
            $update_data['client_home_phone'] = $client_home_phone;
            $update_data['client_work_phone'] = $client_work_phone;
            $update_data['client_dob'] = $client_dob;
            $update_data['client_timezone'] = $client_timezone;
            $update_data['client_note'] = $client_note;
            $update_data['updated_on'] = date('Y-m-d H:i:s');
            
            $update = $this->common_model->update_data($this->tableObj->tableNameClient,$condition,$update_data);
            $this->response_status='1';
            $this->response_message = "You have been updated your profile sucessfully.";
            
        } else {
            $this->response_status='0';
            $this->response_message = "Something went wrong. Please try again later.";
        }

        $this->json_output($response_data);

    }

    public function client_booking_list(Request $request){
        $response_data = array(); 

        $current_date = date('Y-m-d');
        $duration = $request->input('duration');
        $client_id = $request->input('client_id');
        $appointment_type = $request->input('appointment_type');
        //$staff_id = $request->input('staff_id');

        if($duration=='day')
        {
            $upto_date = strtotime($current_date);
            $upto_date = date('Y-m-d', strtotime("+3 day", $upto_date));
            $appoinment_condition = array(
                array('client_id', '=', $client_id),
                array('date','>=',$current_date),
                array('date','<=',$upto_date),
                array('is_deleted', '=', 0)
            );

        }
        else if($duration=='month')
        {
            $upto_date = strtotime($current_date);
            $upto_date = date('Y-m-d', strtotime("-30 day", $upto_date));
            $appoinment_condition = array(
                array('client_id', '=', $client_id),
                array('date','>=',$upto_date),
                array('date','<=',$current_date),
                array('is_deleted', '=', 0)
            );
        }
        else if($duration=='current')
        {
            $upto_date = strtotime($current_date);
            $upto_date = date('Y-m-d');
            $appoinment_condition = array(
                array('client_id', '=', $client_id),
                array('date','=',$current_date),
                array('is_deleted', '=', 0)
            );
        }
        else
        {
            $appoinment_condition = array(
                array('client_id', '=', $client_id),
                array('is_deleted', '=', 0)
            );
        }


        /*if(isset($staff_id) && $staff_id)
        {
            $appoinment_condition[] = array('staff_id', '=', $staff_id);
        }*/

        if(isset($appointment_type) && $appointment_type)
        {
            $appoinment_condition[] = array('appointment_type','>',0);
        } else {
            $appoinment_condition[] = array('appointment_type','=',0);
        }


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

        $appoinment_list = $this->common_model->fetchDatas($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins,$orderBy,$groupBy='order_id');
        
        // Staff Section //
        $staff_list = array();
        /*$findCond = array(
                array('user_id','=',$user_no),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                //'in' => array('')
            );

        $selectFields = array('staff_id','full_name','email', 'staff_profile_picture');
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);*/
    
        $response_data['staff_list'] = $staff_list;
        $response_data['appoinment_list'] = $appoinment_list;
        $response_data['duration'] = $duration;

        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    
    }


    public function client_booking_details(Request $request)
	{
		$response_data = array(); 

        $client_id = $request->input('client_id');
        $order_id = $request->input('order_id');

		//$post_data['order_id'] = $order_id;
		$appoinment_condition = array(
            array('client_id', '=', $client_id),
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
    

    public function service_invitee_question(Request $request){
        $response_data=array();	
        // validate the requested param for access this service api
        $user_no = $request->input('user_no');
        $service_id = $request->input('service_id');

        $chkCond=array(
            array('user_id','=',$user_no),
            array('service_id','=',$service_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        //echo "<pre>"; print_r($chkCond); die();
        $chkFields = array();
        $check_service_details = $this->common_model->fetchData($this->tableObj->tableUserService,$chkCond,$chkFields);
        //echo '<pre>'; print_r($check_service_details); exit;
        if(!empty($check_service_details)){ 

            $selectCond=array(
                array('service_id','=',$service_id),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );
            $selectFields=array();
            $service_invitee_question = $this->common_model->fetchDatas($this->tableObj->tableServiceInviteeQuestion,$selectCond,$selectFields);

            if(!empty($service_invitee_question)){
                $service_invitee_question_html = "";
                $req_mark = "";
                $req_filed = "";

                $service_invitee_question_html = '<div class="book-cal col-sm-12 cust-box mb-20">';
                foreach($service_invitee_question as $question){
                    if($question->is_required == 1){
                        $req_mark = '<b class="error">*</b>';
                        $req_filed = 'required="required"';
                    }
                    if($question->answer_type == 1){
                        $service_invitee_question_html .= '<div class="reschedule-qus"><span>'.$question->question.''.$req_mark.'</span>
                        <input type="text" class="form-control" name="question_'.$question->invitee_question_id.'" '.$req_filed.'>
                        </div>';
                    } else if($question->answer_type == 2){
                        $service_invitee_question_html .= '<div class="reschedule-qus"><span>'.$question->question.''.$req_mark.'</span>
                        <textarea rows="4" cols="3" name="question_'.$question->invitee_question_id.'" '.$req_filed.'></textarea>
                        </div>';
                    } else if($question->answer_type == 3){
                        $answer_options_str = $question->answer_options;
                        $answer_options = explode('|',$answer_options_str);
                        if(!empty($answer_options)){
                            $service_invitee_question_html .= '<div class="reschedule-qus"><span>'.$question->question.''.$req_mark.'</span><div class="qus-chkinpt">';
                            foreach($answer_options as $key=>$val){
                                $service_invitee_question_html .= '<span><input name="question_'.$question->invitee_question_id.'" id="" type="radio" value="'.$val.'"> '.$val.'</span>';
                            }
                            $service_invitee_question_html .= '</div></div>';
                        }
                    } else if($question->answer_type == 4){
                        $answer_options_str = $question->answer_options;
                        $answer_options = explode('|',$answer_options_str);
                        if(!empty($answer_options)){
                            $service_invitee_question_html .= '<div class="reschedule-qus"><span>'.$question->question.''.$req_mark.'</span><div class="qus-chkinpt">';
                            foreach($answer_options as $key=>$val){
                                $service_invitee_question_html .= '<span><input name="question_'.$question->invitee_question_id.'[]" id="" type="checkbox" value="'.$val.'"> '.$val.'</span>';
                            }
                            $service_invitee_question_html .= '</div></div>';
                        }
                    }
                    
                }
                $service_invitee_question_html .= '</div>';

                $response_data['is_exist'] = '1';
                $response_data['html'] = $service_invitee_question_html;

            } else {
                $response_data['is_exist'] = '0';
            }    
            
            $this->json_output($response_data);
        } 
    }

    
    public function client_appointment_status(Request $request)
    {
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $appointment_id = $request->input('appointment_id');
        $appointment_status = $request->input('appointment_status');

        $condition = array(
            array('appointment_id', '=', $appointment_id),
            array('user_id', '=', $user_id),
            //array('is_deleted', '=', '0'),
        );
        
        $update_data['appointment_status'] = $appointment_status;

        $update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$condition,$update_data);
        $this->response_status='1';
        $this->response_message = "Successfully Update";
        $this->json_output($response_data);
    }

    function email_template($user_id, $type)
    {
        $sub_condition = array(
            array('user_id', '=', $user_id)
        );
        $sub_field = array();    
        $subcription = $this->common_model->fetchData($this->tableObj->tableNameUserSubscription,$sub_condition, $sub_field);

        if(!empty($subcription))
        {
            //$subcription_id = $subcription->id;
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


    public function get_booking_rule(Request $request)
    {
        $numberweek = [1=>"First",2=>"Second",3=>"Third",4=>"Fourth",5=>"Fifth"];
        $response_data = array(); 
        $user_id = $request->input('user_id');
        $date = $request->input('date');
        $weekday = date('l',strtotime($date));
        $weekandday = $numberweek[$this->weekOfMonth($date)];

        $findCond=array(
            array('user_id','=',$user_id),
            array('is_deleted','=','0'),
        );

        $selectFields=array();
        $booking_rule_data = $this->common_model->fetchData($this->tableObj->tableNameBookingRule,$findCond,$selectFields);

        if($booking_rule_data->recurring_booking == 1){
            $category_html = "";
            $category_html = '<select id="dropdown_change" name="recurring_booking_frequency">';
            $category_html .= '<option value="0">Does not repeat</option>';
            $category_html .= '<option value="1" data-text="Daily">Daily</option>';
            $category_html .= '<option value="2" data-text="Weekly on '.$weekday.'">Weekly on '.$weekday.'</option>';
            $category_html .= '<option value="3" data-text="'.$weekandday.' '.$weekday.'">Monthly on the '.$weekandday.' '.$weekday.'</option>';
            $category_html .= '<option value="4" data-text="Every weekday">Every weekday(Monday to Friday)</option>';
            /*$category_html .= '<option value="5">Custom...</option>';*/
            $category_html .= '</select>';
            return $category_html;
        }
    }


    public function client_profile_picture_upload(Request $request)
	{
        $response_data=array();
        $client_id = $request->input('client_id');

        if($request->file('profile_perosonal_image'))
        {
			$image = $request->file('profile_perosonal_image');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/image/profile_perosonal_image');
			$image->move($destinationPath, $name);
			$profile_perosonal_image = $name;

        }
        else
        {
        	$profile_perosonal_image = $request->input('old_profile_perosonal_image');
        }


		$updateData = array(
                'client_profile_picture' => $profile_perosonal_image,
                'updated_on' => date('Y-m-d H:i:s')
		);

		$updateCond=array(
                        array('client_id','=',$client_id),
                        array('is_deleted','=',0),
					);

		$this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$updateData);


		$this->response_status='1';
		$this->response_message="Successfully update your profile picture.";

		$this->json_output($response_data);
	}

    public function client_change_password(Request $request){
        $response_data=array();
        $client_id = $request->input('client_id');
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $new_confirm_password = $request->input('new_confirm_password');

        if($new_password==$new_confirm_password)
		{
			$condition = array(
                    array('client_id','=',$client_id),
                    array('password','=',md5($old_password)),
                    array('is_deleted','=', 0),
                );
			$selectFields = array('password');
	        $old_password = $this->common_model->fetchData($this->tableObj->tableNameClient,$condition,$selectFields);
	        if(!empty($old_password))
	        {
	        	$updateData = array(
                        'password' => md5($new_password),
                        'updated_on' => date('Y-m-d H:i:s')
				);

				$updateCond=array(
                                array('client_id','=',$client_id),
                                array('is_deleted','=', 0),
							);

				$this->common_model->update_data($this->tableObj->tableNameClient,$updateCond,$updateData);

				$this->response_status='1';
				$this->response_message="Password has been updated successfully.";
	        }
	        else
	        {
	        	$this->response_message="Old password doesn't match.";
	        }
		}
		else
		{
			$this->response_message="New password & confirm password doesn't match.";
		}
		
		$this->json_output($response_data);
    }


    /*function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", strtotime($date)));
        //Apply above formula.
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
    }*/

    function weekOfMonth($date) {
        // estract date parts
        list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
    
        // current week, min 1
        $w = 1;
    
        // for each day since the start of the month
        for ($i = 1; $i <= $d; ++$i) {
            // if that day was a sunday and is not the first day of month
            if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
                // increment current week
                ++$w;
            }
        }
    
        // now return
        return $w;
    }

    public function delete_client(Request $request)
    {
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $client_id = $request->input('client_id');
        
        $condition = array(
            array('client_id', '=', $client_id),
            //array('user_id', '=', $user_id),
        );

        $fields = array();
        $checkBooking = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$condition,$fields);
       
        if(count($checkBooking)==0)
        {

            $param = array(
                    'is_deleted' => 1,
            );
            $this->common_model->update_data($this->tableObj->tableNameClient,$condition,$param);

            $this->response_status='1';
            $this->response_message = "Client Successfully Deleted";
        }
        else
        {
            $this->response_message = "Sorry, You cunt delete this client";
        }

        $this->json_output($response_data);
    }

}