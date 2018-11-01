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
            $client_email = $request->input('client_email');
            $client_mobile = $request->input('client_mobile');
            $client_home_phone = $request->input('client_home_phone');
            $client_work_phone = $request->input('client_work_phone');
            $client_category = $request->input('client_category');
            $client_address = $request->input('client_address')?$request->input('client_address'):"";

            $client_timezone = $request->input('client_timezone');
            $client_note = $request->input('client_note');

            $client_profile_picture = '';
            $client_send_email = $request->input('client_send_email');
            $send_email = false;
            if(isset($client_send_email) && $client_send_email == 1){
                $send_email = true;
            }

            $conditions = array(
				'or'=>array('client_email' => $client_email)
			);
                        

            $result = $this->common_model->fetchData($this->tableObj->tableNameClient,$conditions);

            //echo '<pre>'; print_r($result); exit;
            if(!empty($result))
            {
                $this->response_message = "This email is already exist.";
            }
            else
            {
                $token1 = md5($client_email);
                $token = $token1;

                $digits = 8;
                $password = rand(pow(10, $digits-1), pow(10, $digits)-1);


                $client_data['user_id'] = $user_id;
                $client_data['client_name'] = $client_name;
                $client_data['client_email'] = $client_email;
                $client_data['client_mobile'] = $client_mobile;
                $client_data['client_home_phone'] = $client_home_phone;
                $client_data['client_work_phone'] = $client_work_phone;
                $client_data['client_category'] = $client_category;
                $client_data['client_address'] = $client_address;
                $client_data['client_timezone'] = $client_timezone;
                $client_data['client_note'] = $client_note;

                $client_data['password'] = md5($password);
                $client_data['email_verification_code'] = $token;


                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
                if($insertdata > 0){
                    /* Send Email */
                    //$other_params = "?device_type=0&device_token_key=".Session::getId();
					//$verify_link = $this->base_url('api/emailverification/'.$token.$other_params);// need to change with website url
                    $emailData['username']=$client_email;
                    $emailData['password']=$password;
                    $emailData['toName'] = $client_name;

                    $this->sendmail(6,$client_email,$emailData);
                    
                    $this->response_status='1';
                    $this->response_message = "Client successfully added.";
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
			$findCond[]=array('client_name','like','%'.$search_text.'%');
		}
		$client_list = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$findCond,$selectFields=array());
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
            array('is_blocked','=','0'),
        );
        
        $selectFields=array();
        $client_details = $this->common_model->fetchData($this->tableObj->tableNameClient,$findCond,$selectFields);

        if(!empty($client_details)){
            $response_data['client_details']=$client_details;
            $this->response_status='1';
            $this->response_message="Client details.";
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
            $client_mobile = $request->input('client_mobile');
            $client_home_phone = $request->input('client_home_phone');
            $client_work_phone = $request->input('client_work_phone');
            $client_category = $request->input('client_category');
            $client_timezone = $request->input('client_timezone');
            $client_address = $request->input('client_address');
            $client_note = $request->input('client_note');
            //$staff_profile_picture = '';

            $conditions = array(
                array('client_id','=',$client_id),
                array('user_id','=',$user_id),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );

            $result = $this->common_model->fetchData($this->tableObj->tableNameClient,$conditions);
            //echo '<pre>'; print_r($result); exit;
            if(empty($result))
            {
                $this->response_message = "Invalid client details.";
            }
            else
            {
                /*$destinationPath = './uploads/profile_image/';
                if (!empty($_FILES)) {
                    if ($_FILES['staff_profile_picture'] && $_FILES['staff_profile_picture']['name'] != "") {
                        $staff_profile_picture_name = str_replace(" ", "_", time() . $_FILES['staff_profile_picture']['name']);
                        if (move_uploaded_file($_FILES['staff_profile_picture']['tmp_name'], $destinationPath . $staff_profile_picture_name)) {
                            //$user_data['staff_profile_picture'] = $staff_profile_picture_name;
                            $staff_data['staff_profile_picture'] = url('uploads/profile_image/'.$staff_profile_picture_name);
                        }
                    }
                }*/

                $client_data['client_name'] = $client_name;
                $client_data['client_mobile'] = $client_mobile;
                $client_data['client_home_phone'] = $client_home_phone;
                $client_data['client_work_phone'] = $client_work_phone;
                $client_data['client_category'] = $client_category;
                $client_data['client_address'] = $client_address;
                $client_data['client_timezone'] = $client_timezone;
                $client_data['client_note'] = $client_note;

                $update = $this->common_model->update_data($this->tableObj->tableNameClient,$conditions,$client_data);
                
                $this->response_status='1';
                $this->response_message = "Client successfully updated.";

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
			$condition = array(
	                array('is_deleted', '=', 0),
	            );
            $selectField = array('client_email');
            $check_client = $this->common_model->fetchDatas($this->tableObj->tableNameClient,$condition,$selectField);

            $exist_client_email = array();
        	foreach ($check_client as $key => $value)
            {
            	$exist_client_email[] = $value->client_email;
            }

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
                                
                                if(in_array($row['email'],$exist_client_email))
                                {
                                    $exist++;
                                }
                                else
                                {
                                    $token1 = md5($row['email']);
                                    $token = $token1;
                                    $digits = 8;
                                    $password = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
                                    $client_data['user_id'] = $user_id;
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
                                    
                                        $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameClient,$client_data);
                                        if($insertdata)
                                        {
                                            $emailData['username'] = $row['email'];
                                            $emailData['password'] = $password;
                                            $emailData['toName'] = $row['client_name'];
                                            $this->sendmail(11,$row['email'],$emailData);
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
            array('user_id', '=', $user_id),
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
                array('user_id', '=', $user_id),
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
        $checkClient = $this->common_model->fetchData($this->tableObj->tableNameClient,$condition, $fields);
        if(!empty($checkClient))
        {
            // Send reset password email to client //
            $parameter =[
                'client_id' => $client_id,
                'time' => time()
            ];
            $parameter= Crypt::encrypt($parameter);
            $forgot_password_link = url('/client/forgot-password',$parameter);
            
            $client_email  = $checkClient->client_email;
            $emailData['forgotPasswordLink'] = $forgot_password_link;            
            $emailData['toName'] = $checkClient->client_name;

            $this->sendmail(13,$client_email,$emailData);

        }
        else
        {
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
            array('user_id', '=', $user_id),
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
                    array('user_id', '=', $user_id),
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
    public function business_provider_category_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no'); 
        
        $findCond = array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
			//array('is_blocked','=','0'),
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

		$service_category = $this->common_model->fetchDatas($this->tableObj->tableUserService, $findCond, $selectFields, $joins, $orderBy=array(),$groupBy='category_id');


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
		$response_data['category_list'] = $service_category;

        $this->json_output($response_data);
        
    }

    public function business_provider_service_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no'); 
        $category_id = $request->input('category_id'); 
        
        $findCond = array(
            array('user_id','=',$user_no),
            array('category_id','=',$category_id),
			array('is_deleted','=','0'),
		);
		
		$service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $findCond, $selectFields=array(), $joins=array(), $orderBy=array(),$groupBy='');        

		$response_data['service_list'] = $service_list;

        $this->json_output($response_data);
        
    }

    public function business_provider_staff_list(Request $request){
        $response_data = array(); 
        
        $user_no = $request->input('user_no'); 

        $findCond = array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
		);
		
		$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff, $findCond, $selectFields=array('staff_id','full_name','email'), $joins=array(), $orderBy=array(),$groupBy='');        

		$response_data['staff_list'] = $staff_list;

        $this->json_output($response_data);
        
    }


    public function client_appointment_details(Request $request)
    {
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 

        $appointment_id = $request->input('appointment_id'); 
        $client_id = $request->input('client_id'); 
        //appoinment data using id
        $appoinment_condition = array(
            array('appointment_id', '=', $appointment_id),
            array('client_id', '=', $client_id),
            array('is_deleted', '=', 0)
        );

        $appoinment_fields = array();

        $client_fields = array('client_name','client_email','client_mobile','client_address','client_dob','client_profile_picture');

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
        
        $appoinment_details = $this->common_model->fetchData($this->tableObj->tableNameAppointment,$appoinment_condition,$appoinment_fields,$joins);

        $appoinmnet = array();
        if(!empty($appoinment_details)){
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
                    "appoinment_date" => date('d, M Y',strtotime($appoinment_details->date)),
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
            );

            $response_data['appoinment_details'] = $appoinmnet;
            $this->response_status='1';
            
        } else {
            $this->response_message='Invalid appointment details / Appointment is already cancelled.';
        }
        
        
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
			$data['is_deleted'] = '1';
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



    public function send_client_verification_code(Request $request){
        $response_data = array(); 
        
        $appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id');
        $client_email = $request->input('client_email');

        $chkCond=array(
            array('client_id','=',$client_id),
            array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0)
        );

		$check_appointment = $this->common_model->row_present_check($this->tableObj->tableNameAppointment,$chkCond);
        if($check_appointment){
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
			$this->response_status='1';
			$this->response_message="Verification code has been successfully verified.";
        }else {
			$this->response_message="Verification code does not matched.";
		}

        $this->json_output($response_data);
    }
    


    public function calendar_availability_list(Request $request){
        $response_data = array(); 
        
        $appointment_id = $request->input('appointment_id');
        $client_id = $request->input('client_id');
        $staff_id = $request->input('staff_id');
        $duration = $request->input('duration');
        $order = $request->input('order');
        $cal_start = $request->input('cal_start');

        $chkCond=array(
            array('client_id','=',$client_id),
            array('appointment_id', '=', $appointment_id),
            array('is_deleted', '=', 0)
        );

		$check_appointment = $this->common_model->row_present_check($this->tableObj->tableNameAppointment,$chkCond);
        if($check_appointment){
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
                $date_array_header[$next_date] = array(date('D',strtotime($next_date)),date('d',strtotime($next_date)));
                $time_slots = array();

                $time_slot_start = $next_date." 00:00:00";
                $time_slot_end = $next_date." 23:59:59";
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

                for($j = strtotime($time_slot_start); $j < strtotime($time_slot_end); ){
                    $tmp = date('H:i:s',$j);
                    $tmp_end = strtotime(date('Y-m-d H:i:s',$j) . '+'.$duration.' minutes');;
                    $blocked = 0;
                    $booked = 0;
                    /****************check if time is blocked*************** */
                    if(!empty($blockDateTime) && is_array($blockDateTime)){
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
            //echo '<pre>'; print_r($date_array); exit;
    
            $response_data['calendar_availability_list'] = $date_array;
            $response_data['date_array_header'] = $date_array_header;
            $response_data['current_month'] = $current_month;
            $response_data['current_date'] = date('Y-m-d');            
			$this->response_status='1';
			$this->response_message="Available Calendar List";
        }else {
			$this->response_message="Appointment is not associated with the client.";
		}

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
            //Redirect url
            $parameter = [
                    'appointment_id' => '',
                    'client_id' => $user->client_id,
                    ];
            $parameter= Crypt::encrypt($parameter);
            //$cancel_url = url('/client/cancel_appointent',$parameter);
            $reschedule_url = url('/client/client-dashboard',$parameter);

            if(empty($user))
            {
                $this->response_message="Email/Username and password does not match.";
            }
            else
            {
                $this->response_status='1';
                $this->response_message = $reschedule_url;
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


}