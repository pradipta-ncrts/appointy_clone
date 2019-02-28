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

class StaffsController extends ApiController {
	function __construct(Request $input){
		parent::__construct($input);
	}
	

	//*user staff add*//
    public function add_staff(Request $request)
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
                                 'staff_fullname'=>'required',
                                 'staff_email'=>'required|email',
                                 'staff_mobile'=>'required|numeric',
                                 'staff_description'=>'required'
                                             ]);

        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $staff_type = $request->input('staff_type');
            $full_name = $request->input('staff_fullname');
            $email = $request->input('staff_email');
            $username = $request->input('staff_username');
            $mobile = $request->input('staff_mobile');
            $home_phone = $request->input('staff_home_phone');
            $work_phone = $request->input('staff_work_phone');
            $category_id = $request->input('staff_category');
            $expertise = $request->input('staff_expertise');
            $description = $request->input('staff_description');
            $staff_send_email = $request->input('staff_send_email');
            $staff_profile_picture = '';

            $conditions = array(
				'or'=>array('email'=>$email,'username'=>$username)
			);

            $result = $this->common_model->fetchData($this->tableObj->tableNameStaff,$conditions);
            //echo '<pre>'; print_r($result); exit;
            if(!empty($result))
            {
                $this->response_message = "This username or email is already exist.";
            }
            else
            {
                $token1 = md5($email);
                $token2 = md5($username);
                $token = $token1.$token2;
                $digits = 8;
                $password = rand(pow(10, $digits-1), pow(10, $digits)-1);

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

                $staff_data['user_id'] = $user_id;
                $staff_data['username'] = $username;
                $staff_data['full_name'] = $full_name;
                $staff_data['email'] = $email;
                $staff_data['mobile'] = $mobile;
                $staff_data['home_phone'] = $home_phone;
                $staff_data['work_phone'] = $work_phone;
                $staff_data['expertise'] = $expertise;
                $staff_data['description'] = $description;
                $staff_data['category_id'] = $category_id;
                $staff_data['password'] = md5($password);
                $staff_data['email_verification_code'] = $token;
                $staff_data['staff_type'] = $staff_type;

                /*$data=array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'full_name' => $full_name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'home_phone' => $home_phone,
                    'work_phone' => $work_phone,
                    'expertise' => $expertise,
                    'description' => $description,
                    'category_id' => $category_id,
                    'password' => md5($password),
                    'email_verification_code' => $token
                );*/

                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaff,$staff_data);
                if($insertdata > 0){

                    //Notification Update start
                    $notification_data['update_message'] = "You have added ".$full_name." as a stuff.";
                    $notification_data['user_id'] = $user_id;

                    $profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);

                    //Send Notification mail
                    if($staff_send_email && $staff_send_email==1)
                    {
                        $staff_type = $staff_type == 1 ? "Manager" : "Staff";
                        $staff_email = $email;
                        $emailData['staff_name'] = $full_name;
                        $emailData['type'] = $staff_type;
                        $emailData['password'] = $password;
                        $emailData['username'] = $username;
                        $emailData['subject'] = "Staff Resgistration";
                        $this->sendmail(20,$staff_email,$emailData);
                    }

                    $this->response_status='1';
                    $this->response_message = "Staff successfully added.";
                } else {
                    $this->response_message = "Something went wrong. Please try agian later.";
                }
                
            }

            $this->json_output($response_data);

        }

    }


    // User's Staff Listing //
    public function staff_list(Request $request){
		$response_data=array();	
		// validate the requested param for access this service api
		$this->validate_parameter(1); // along with the user request key validation
		$other_user_no = $request->input('other_user_no');
        $pageNo = $request->input('page_no');
        $search_text = $request->input('staff_search_text');
		$pageNo = ($pageNo>1)?$pageNo:1;
		$limit=$this->limit;
		$offset=($pageNo-1)*$limit;

		if(!empty($other_user_no) && $other_user_no!=0){
			$user_no = $other_user_no;
		}
		else{
			$user_no = $this->logged_user_no;
		}


		$findCond=array(
            array('user_id','=',$user_no),
			array('is_deleted','=','0'),
		);

		if(!empty($search_text)){
			$findCond[]=array('full_name','like','%'.$search_text.'%');
		}

		$selectFields=array('staff_id','addess','user_id','full_name','username','email','mobile','description','home_phone','work_phone','expertise','category_id','staff_profile_picture','is_internal_staff','booking_url','is_login_allowed','is_email_verified','is_blocked','created_on');
		$staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectFields);
		$response_data['staff_list']=$staff_list;
		$this->response_status='1';
		// generate the service / api response
		$this->json_output($response_data);
    }


    //Delete//
    public function staff_delete(Request $request){
        $response_data=array();	
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $user_no = $this->logged_user_no;
        $staff_id = $request->input('staff_id');

        $findCond=array(
                        array('staff_id','=',$staff_id),
                        array('user_id','=',$user_no),
                        array('is_deleted','=','0'),
                        array('is_blocked','=','0'),
                    );
        $selectField = array('full_name','email','mobile');
        $check_staff = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectField);
        if($check_staff){
            $updateData=array(
                'is_deleted'=>1,
                'deleted_on'=>$this->date_format
            );
            $this->common_model->update_data($this->tableObj->tableNameStaff,$findCond,$updateData);
            $this->response_status='1';
            $this->response_message = "Staff successfully deleted.";
        } else {
            $this->response_message = "Staff is not associated with this user.";
        }
        
        // generate the service / api response
        $this->json_output($response_data);
        
    }

    //Details//
    public function staff_details(Request $request){
        $response_data=array();	
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $staff_id = $request->input('staff_id');
        $user_no = $this->logged_user_no;

        $findCond=array(
            array('user_id','=',$user_no),
            array('staff_id','=',$staff_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectFields=array('staff_id','staff_type','addess','user_id','full_name','username','email','mobile','description','home_phone','work_phone','expertise','category_id','staff_profile_picture','is_internal_staff','booking_url','is_login_allowed','is_email_verified','is_blocked','created_on');
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

    //Details//
    public function staff_details_mobile(Request $request){
    
        $staff_id = $request->input('post_data');
        
        $findCond=array(
            array('staff_id','=',$staff_id)
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

    public function edit_staff(Request $request){
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
                                         'staff_fullname'=>'required',
                                         'staff_description'=>'required']);
        
        if ($validate->fails())
        {
            $this->response_message = $this->decode_validator_error($validate->errors());
            $this->json_output($response_data);
        }
        else
        {
            $staff_type = $request->input('staff_type');
            $staff_id = $request->input('staff_id');
            $full_name = $request->input('staff_fullname');
            $email = $request->input('staff_email');
            //$username = $request->input('staff_username');
            $mobile = $request->input('staff_mobile');
            $home_phone = $request->input('staff_home_phone');
            $work_phone = $request->input('staff_work_phone');
            $category_id = $request->input('staff_category');
            $expertise = $request->input('staff_expertise');
            $description = $request->input('staff_description');
            $staff_profile_picture = '';

            $query = "SELECT * FROM `squ_staff` WHERE `email` = '".$email."' AND `staff_id` NOT IN ('".$staff_id."')";
            $check_email = $this->common_model->customQuery($query,$query_type=1);
            if(empty($check_email))
            {
                //Notification Update start
                $notification_data['update_message'] = "You have updated ".$full_name."'s profile.";
                $notification_data['user_id'] = $user_id;

                $profession_id = $this->common_model->insert_data_get_id($this->tableObj->tableNameNotificationUpdates, $notification_data);
                //Notification Update End

                $conditions = array(
                    array('staff_id','=',$staff_id),
                    array('user_id','=',$user_id),
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

                    $staff_data['staff_type'] = $staff_type;
                    $staff_data['full_name'] = $full_name;
                    $staff_data['email'] = $email;
                    $staff_data['mobile'] = $mobile;
                    $staff_data['home_phone'] = $home_phone;
                    $staff_data['work_phone'] = $work_phone;
                    $staff_data['expertise'] = $expertise;
                    $staff_data['description'] = $description;
                    $staff_data['category_id'] = $category_id;

                    //print_r($staff_data); die();

                    $update = $this->common_model->update_data($this->tableObj->tableNameStaff,$conditions,$staff_data);
                    
                    $this->response_status='1';
                    $this->response_message = "Staff successfully updated.";

                }
            }
            else
            {
                $this->response_message = "This email already exist.";
            }

            $this->json_output($response_data);

        }
        
    }

    public function change_status_staff(Request $request){
        // Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
            return redirect('/login');
        }
        
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        
        $staff_id = $request->input('staff_id');
        $type = $request->input('type');
        $status_value = $request->input('status_value');

        if($type == 'blocked' && $status_value == 1){
            $staff_data['is_blocked'] = 0;
            $msg = "Staff has been blocked successfully";
        } else if($type == 'blocked' && $status_value == 0) {
            $staff_data['is_blocked'] = 1;
            $msg = "Staff has been active successfully";
        } else if($type == 'internal_staff' && $status_value == 1) {
            $staff_data['is_internal_staff'] = 0;
            $msg = "Staff has been removed internal staff";
        } else if($type == 'internal_staff' && $status_value == 0) {
            $staff_data['is_internal_staff'] = 1;
            $msg = "Staff has been added as internal staff";
        } else if($type == 'login_allowed' && $status_value == 1) {
            $staff_data['is_login_allowed'] = 0;
            $msg = "Allow staff to login next time.";
        } else if($type == 'login_allowed' && $status_value == 0) {
            $staff_data['is_login_allowed'] = 1;
            $msg = "Restrict staff to login next time.";
        } 

        $conditions = array(
            array('staff_id','=',$staff_id),
            array('user_id','=',$user_id),
            array('is_deleted','=','0'),
        );

        $result = $this->common_model->fetchData($this->tableObj->tableNameStaff,$conditions);
        //echo '<pre>'; print_r($result); exit;
        if(empty($result))
        {
            $this->response_message = "Invalid staff details.";
        }
        else
        {

            
            $staff_data['updated_on'] = date('Y-m-d H:i:s');
            //echo '<pre>'; print_r($staff_data); exit;

            $update = $this->common_model->update_data($this->tableObj->tableNameStaff,$conditions,$staff_data);
            
            $this->response_status='1';
            $this->response_message = $msg;

        }

        $this->json_output($response_data);
        
    }
    
    public function add_new_location(Request $request)
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

        $staff_id = $request->input('staff_id');
        if($staff_id)
        {
            $staff_data['addess'] = $request->input('location_name');
            $staff_data['country'] = $request->input('country');
            $staff_data['city'] = $request->input('city');

            $updateCond=array(
                array('staff_id','=',$staff_id),
            );

            $update = $this->common_model->update_data($this->tableObj->tableNameStaff,$updateCond,$staff_data);

            $this->response_status='1';
            $this->response_message="Location successfully updated.";
        }
        else
        {
            $validate = Validator::make($request->all(),[
                                     'location_name'=>'required',
                                     'country'=>'required',
                                     'city'=>'required',
                                     'location_username'=>'required',
                                     'location_password'=>'required',
                                     'location_full_name'=>'required',
                                     'location_email'=>'required|email'
                                                 ]);

            if ($validate->fails())
            {
                $this->response_message = $this->decode_validator_error($validate->errors());
                $this->json_output($response_data);
            }
            else
            {
                $full_name = $request->input('location_full_name');
                $email = $request->input('location_email');
                $username = $request->input('location_username');
                $location = $request->input('location_name');
                $password = $request->input('location_password');
                $country = $request->input('country'); 
                $city = $request->input('city');
                

                $conditions = array(
                    'or'=>array('email'=>$email,'username'=>$username)
                );       

                $result = $this->common_model->fetchData($this->tableObj->tableNameStaff,$conditions);
                //echo '<pre>'; print_r($result); exit;
                if(!empty($result))
                {
                    $this->response_message = "This username or email is already exist.";
                }
                else
                {
                    /*$token1 = md5($email);
                    $token2 = md5($username);
                    $token = $token1.$token2;
                    $digits = 8;*/
                    $password = $password;

                    $staff_data['user_id'] = $user_id;
                    $staff_data['username'] = $username;
                    $staff_data['full_name'] = $full_name;
                    $staff_data['email'] = $email;
                    $staff_data['password'] = md5($password);
                    $staff_data['addess'] = $location;
                    $staff_data['country'] = $country;
                    $staff_data['city'] = $city;
                    
                    
                    //$staff_data['email_verification_code'] = $token;

                    $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaff,$staff_data);

                    if($insertdata > 0)
                    {

                        $emailData['username'] = $username;
                        $emailData['password'] = $password;
                        $emailData['toName'] = $full_name;
                        $this->sendmail(5,$email,$emailData);

                        $this->response_status='1';
                        $this->response_message = "Location successfully added.";
                    }
                    else
                    {
                        $this->response_message = "Something went wrong. Please try agian later.";
                    }
                }
            }  
        }
        
        $this->json_output($response_data);

    }


    public function staff_import(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $file = $request->file('staff_excel_file');
        //print_r($file); die();
        $type = $file->extension();
        $productInputs = array();
        //echo $type;exit;
        if($type == 'xls' || $type == 'xlsx')
        {
			$existingCompanyPrd = array();
			$fileName = $file->getClientOriginalName();
			$destinationPath = public_path() . '/import_staff_excel/';
			$file->move($destinationPath, $fileName);
			$excelData = Excel::load('/public/import_staff_excel/'.$fileName, function($reader) {})->get();

			//get data from client table
			$condition = array(
	                array('is_deleted', '=', 0),
	            );
            $selectField = array('email','username');
            $check_staff = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$condition,$selectField);

            $exist_staff_email = array();
            $exist_staff_username = array();
        	foreach ($check_staff as $key => $value)
            {
            	$exist_staff_email[] = $value->email;
            	$exist_staff_username[] = $value->username;
            }

            //echo "<pre>";print_r($exist_staff_email);exit;
            $exist = 0;
            $notExit = 0;
			if(!empty($excelData) && count($excelData) > 0)
			{
                $excel_rows = $excelData->toArray();
                //echo "<pre>";print_r($excel_rows);exit;
                if(!empty($excel_rows)){
                    if(isset($excel_rows[0]['email']) && $excel_rows[0]['email']!='' && isset($excel_rows[0]['username']) && $excel_rows[0]['username']!='' && isset($excel_rows[0]['staff_name']) && $excel_rows[0]['staff_name']!=''){
                        foreach ($excel_rows as $row)
                        {
                            $updateMasterData = array();
                            //echo "<pre>";print_r($row);exit;
                            if(!empty($row)){
                                
                                if(in_array($row['email'],$exist_staff_email) && in_array($row['username'],$exist_staff_username))
                                {
                                    $exist++;
                                }
                                else
                                {
                                    $token1 = md5($row['email']);
                                    $token2 = md5($row['username']);
                                    $token = $token1.$token2;
                                    $digits = 8;
                                    $password = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
                                    $staff_data['user_id'] = $user_id;
                                    $staff_data['full_name'] = $row['staff_name']; 
                                    $staff_data['username'] = $row['username'];
                                    $staff_data['password'] = md5($password); 
                                    $staff_data['email'] = $row['email'];
                                    $staff_data['mobile'] = $row['mobile'];
                                    $staff_data['description'] = $row['description'];
                                    //$staff_data['home_phone'] = $row['home_phone']; 
                                    //$staff_data['work_phone'] = $row['work_phone']; 
                                    $staff_data['expertise'] = $row['expertise']; 
                                    //$staff_data['address'] = $row['address'] ? $row['address'] : ''; 
                                    $staff_data['email_verification_code'] = $token;
                                    //print_r($staff_data); die();
                                    
                                        $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaff,$staff_data);
                                        if($insertdata)
                                        {
                                        $emailData['username'] = $row['username'];
                                        $emailData['password'] = $password;
                                        $emailData['toName'] = $row['staff_name'];
                                        $this->sendmail(10,$row['email'],$emailData);
                                        }
                                    $notExit++;
                                }
                                
                                
                            } else {
                                $this->response_message = "No records to import.";
                            }
                            
                        }
                    } else {
                        $this->response_message = "Plase upload proper excel file.";
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


    public function block_times(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_no = $this->logged_user_no;
        $staff_id = $request->input('staff_id');

        $findCond=array(
            array('user_id','=',$user_no),
            array('staff_id','=',$staff_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $selectField = array('full_name','email','mobile');
        $check_staff = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$findCond,$selectField);
        if($check_staff){
            // Block Date //
            $query = "select `squ_block_date_time`.`block_id`, MONTHNAME(`squ_block_date_time`.`block_date`) AS month, YEAR(`squ_block_date_time`.`block_date`) AS year, GROUP_CONCAT(squ_block_date_time.block_date) AS block_dates 
            from `squ_block_date_time` 
            where `squ_block_date_time`.`user_id` = ".$user_no." 
                and `squ_block_date_time`.`staff_id` = ".$staff_id."
                and `squ_block_date_time`.`is_deleted` = 0 
                and `squ_block_date_time`.`is_blocked` = 0 
                and `squ_block_date_time`.`is_deleted` = 0 
                group by YEAR(block_date), MONTH(block_date)";
            $block_dates = $this->common_model->customQuery($query,$query_type=1);

            for($i=0;$i<count($block_dates);$i++){
                $block_date_arr = explode(',',$block_dates[$i]->block_dates);
                for($j=0;$j<count($block_date_arr);$j++){
                    $block_date_arr[$j] = date('d',strtotime($block_date_arr[$j]));
                }
                $block_dates[$i]->block_dates = $block_date_arr;
            }

            $response_data['block_dates']=$block_dates;
            

            // Block TIme //
            $findCond=array(
                array('user_id','=',$user_no),
                array('staff_id','=',$staff_id),
                array('start_time','!=',''),
                array('end_time','!=',''),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );
            
            $selectField = array('block_date');
            $block_times = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="YEAR(block_date), MONTH(block_date), DATE(block_date)",$havings=array(),$limit=0,$offset=0,$is_count=0);
            $formatted_block_times = array();
            for($i=0;$i<count($block_times); $i++){
                $findCond=array(
                    array('user_id','=',$user_no),
                    array('staff_id','=',$staff_id),
                    array('block_date','=',$block_times[$i]->block_date),
                    array('start_time','!=',''),
                    array('end_time','!=',''),
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                );
                
                $selectField = array('block_id','start_time','end_time');
                $block_date_times = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="",$havings=array(),$limit=0,$offset=0,$is_count=0);
                
                $block_times[$i]->block_date = date('F d, Y',strtotime($block_times[$i]->block_date));
                $block_times[$i]->block_date_time = $block_date_times;
            }

            $response_data['block_times'] = $block_times;
            //echo '<pre>'; print_r($response_data); exit;
            $this->response_status='1';
            $this->response_message="Staff block date time details.";
            
        } else {
            $this->response_status='0';
            $this->response_message="Staff is not valid.";
        }

        $this->json_output($response_data);

    }


    public function delete_staff_block_time(Request $request){
        // Check User Login. If not logged in redirect to login page //
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $block_time_id = $request->input('block_time_id');
        $staff_id = $request->input('staff_id');

        $conditions = array(
            array('staff_id','=',$staff_id),
            array('user_id','=',$user_id),
            array('block_id','=',$block_time_id),
            array('is_blocked','=','0'),
        );

        $result = $this->common_model->fetchData($this->tableObj->tableNameBlockDateTime,$conditions);
        //echo '<pre>'; print_r($result); exit;
        if(empty($result))
        {
            $this->response_message = "Invalid details.";
        }
        else
        {
            $update_data['is_deleted'] = 1;

            $update = $this->common_model->update_data($this->tableObj->tableNameBlockDateTime,$conditions,$update_data);
            
            $this->response_status='1';
            $this->response_message = "Blocked times deleted successfully.";
        }
        
        $this->json_output($response_data);
    }


    public function staff_service_availability(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_no = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
        $service_id = $request->input('service_id');
        if(isset($service_id) && $service_id!=''){
            $findCond[] = array('service_id','=',$service_id);
        }

        $findCond=array(
            array('staff_id','=',$staff_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $tableNameStaffServiceAvailability = $this->tableObj->tableNameStaffServiceAvailability;
        $tableUserService = $this->tableObj->tableUserService;
        $selectField = array('staff_service_availability_id','staff_id','service_id','day','start_time','end_time');
        $serviceField = array('service_name','duration');
        $joins = array(
                    array(
                    'join_table'=>$tableUserService,
                    'join_with'=>$tableNameStaffServiceAvailability,
                    'join_type'=>'left',
                    'join_on'=>array('service_id','=','service_id'),
                    'join_on_more'=>array(),
                    'join_conditions' => array(array('is_blocked','=','0')),
                    'select_fields' => $serviceField,
                ),
            );

        $staff_availability = $this->common_model->fetchDatas($tableNameStaffServiceAvailability,$findCond,$selectField, $joins);

        $service_array = array();
        if(!empty($staff_availability)){
            foreach($staff_availability as $availability){
                if(!isset($service_array[$availability->service_id])){
                    $service_array[$availability->service_id] = array();
                }
                if(!isset($service_array[$availability->service_id][$availability->day])){
                    $service_array[$availability->service_id][$availability->day] = array();
                }
                $service_array[$availability->service_id][0] = array('service_name'=>$availability->service_name,'duration'=>$availability->duration);
                array_push($service_array[$availability->service_id][$availability->day],$availability);
            }
        }

        $conditions = array(
            array('user_id','=',$user_no),
            array('is_blocked','=','0'),
            array('is_deleted','=','0')
        );

        $service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService,$conditions);
        //echo '<pre>'; print_r($service_list); exit;

        if(!empty($service_list) && is_array($service_list)){
            foreach($service_list as $sl){
                if(!isset($service_array[$sl->service_id])){
                    $service_array[$sl->service_id] =array(array('service_name'=>$sl->service_name,'duration'=>$sl->duration));
                }
            }
        }
        //echo '<pre>'; print_r($service_array); exit;
        $html = "";
        $dowMap = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
        if(!empty($service_array)){
            foreach($service_array as $key=>$sa){
                    $html .= '<tr>
                        <td>
                            <div class="custm-tblebx"> <img src="http://runmobileapps.com/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">'.strtoupper($sa[0]['service_name']).'</a> ('.$sa[0]['duration'].'m) </div>
                            <div class="edit-staff">
                            <a data-toggle="tooltip" data-placement="top" class="delete_availability" data-service-id = "'.$key.'" data-staff-id="'.$staff_id.'"><i class="fa fa-trash delete_block_time" aria-hidden="true" style="color:red" title="Delete!"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </td>';

                        for($i = 1; $i<8; $i++){
                            if(isset($sa[$i]) && !empty($sa[$i])){
                                $html .= '<td data-column="'.$dowMap[$i-1].'">
                                        <ul>
                                        <li>'.$sa[$i][0]->start_time.'</li>
                                        <li>'.$sa[$i][0]->end_time.'</li>
                                        </ul>
                                        <div class="edit-staff">
                                            <i class="fa fa-pencil update_user_shedule" aria-hidden="true" style="color:#67bde5" title="Edit!" data-staff-id="'.$staff_id.'" data-service-id = "'.$key.'" data-day-no = "'.$i.'" data-start-date = "'.$sa[$i][0]->start_time.'" data-end-date = "'.$sa[$i][0]->end_time.'"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </td>';
                            }else{
                                $html .='<td data-column="'.$dowMap[$i-1].'">
                                            <div class="edit-staff">
                                                <i class="fa fa-pencil update_user_shedule" aria-hidden="true" style="color:#67bde5" title="Edit!" data-staff-id="'.$staff_id.'" data-service-id = "'.$key.'" data-day-no = "'.$i.'"></i>
                                            </div>
                                            <div class="clearfix"></div>
                                        </td>';
                            }
                        }
                    $html .='</tr>';
            }
            $response_data['html'] = $html;
        }



        $this->json_output($response_data);

    }

     public function service_staff_availability(Request $request){
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_no = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
        $service_id = $request->input('service_id');
        if(isset($staff_id) && $staff_id!=''){
            $findCond[] = array('staff_id','=',$staff_id);
        }

        $findCond=array(
            array('service_id','=',$service_id),
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $tableNameStaffServiceAvailability = $this->tableObj->tableNameStaffServiceAvailability;
        $tableUserService = $this->tableObj->tableUserService;
        $tableStaff = $this->tableObj->tableNameStaff;
        $selectField = array('staff_service_availability_id','staff_id','service_id','day','start_time','end_time');
        $serviceField = array('service_name','duration');
        $staffField = array('full_name');
        $joins = array(
                    array(
                        'join_table'=>$tableUserService,
                        'join_with'=>$tableNameStaffServiceAvailability,
                        'join_type'=>'left',
                        'join_on'=>array('service_id','=','service_id'),
                        'join_on_more'=>array(),
                        'join_conditions' => array(array('is_blocked','=','0')),
                        'select_fields' => $serviceField,
                    ),
                    array(
                        'join_table'=>$tableStaff,
                        'join_with'=>$tableNameStaffServiceAvailability,
                        'join_type'=>'left',
                        'join_on'=>array('staff_id','=','staff_id'),
                        'join_on_more'=>array(),
                        //'join_conditions' => array(array('is_blocked','=','0')),
                        'select_fields' => $staffField,
                    ),
            );

        $staff_availability = $this->common_model->fetchDatas($tableNameStaffServiceAvailability,$findCond,$selectField, $joins);

        //print_r($staff_availability); die();

        //echo '<pre>'; print_r($service_array); exit;
        $dowMap = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
        $service_array = array();
        $old_user_id = '';
        foreach ($staff_availability as $key => $value)
        {
            if($old_user_id!=$value->staff_id)
            {
                $dayarray = array();
                for($k=0; $k<7; $k++)
                {
                    foreach ($staff_availability as $key => $val)
                    {
                        if($value->staff_id==$val->staff_id && $val->day==$k+1)
                        {
                            $dayarray[] = array('day' => $dowMap[$k], 'day_no' => $val->day,'start_time' => $val->start_time, 'end_time' => $val->end_time);
                        }
                    }
                }
                $service_array[] = array('staff_id' => $value->staff_id,'staff_name' => $value->full_name, 'dayarray' => $dayarray);
            }
            $old_user_id = $value->staff_id;
        }

        //print_r($service_array); die();

        $html = "";
        $dowMapNew = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
        if(!empty($service_array)){
            foreach($service_array as $key=>$sa){
                    $html .= '<tr>
                        <td>
                            <div class="custm-tblebx"> <img src="http://runmobileapps.com/squeedr/public/assets/website/images/noimage.png" class="img-circle" alt="" width="35" height="35"> <a href="#">'.strtoupper($sa['staff_name']).'</a> </div>
                            <div class="edit-staff">
                            <a data-toggle="tooltip" data-placement="top" class="delete_availability" data-service-id = "'.$service_id.'" data-staff-id="'.$sa['staff_id'].'"><i class="fa fa-trash delete_block_time" aria-hidden="true" style="color:red" title="Delete!"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </td>';

                        $day_no = array();
                        $n_array = $sa['dayarray'];
                        foreach ($n_array as $key => $row)
                        {
                            $day_no[$key] = $row['day_no'];
                        }
                        array_multisort($day_no, SORT_ASC, $n_array);
                        //print_r($n_array); die();
                        //echo $n_array[0]['day']; die();
                        $m=1;
                        for($i = 0; $i<7; $i++)
                        {
                            $start_time = isset($n_array[$i]['start_time']) && $n_array[$i]['start_time'] ? $n_array[$i]['start_time'] : '';
                            $end_time = isset($n_array[$i]['end_time']) && $n_array[$i]['start_time'] ? $n_array[$i]['end_time'] : '';
                            $html .= '<td data-column="'.$dowMapNew[$i].'">
                                        <ul>
                                        <li>'.$start_time.'</li>
                                        <li>'.$end_time.'</li>
                                        </ul>
                                        <div class="edit-staff">
                                            <i class="fa fa-pencil update_user_shedule" aria-hidden="true" style="color:#67bde5" title="Edit!" data-staff-id="'.$sa['staff_id'].'" data-service-id = "'.$service_id.'" data-day-no = "'.$m.'" data-start-date = "'.$start_time.'" data-end-date = "'.$end_time.'"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </td>';

                            $m++;
                        }
                        $html .='</tr>';
            }
        }
        else
        {
           $html = "<tr><td colspan='8'>No data found</td></tr>";
        }

        $response_data['html'] = $html;
        $this->json_output($response_data);

    }



    public function add_staff_service_availability(Request $request)
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

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            array('user_id','=', $user_id)
        );
        
        $selectFields=array('service_id','service_name');
        $service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService,$findCond,$selectFields);
        $service_id = array();
        foreach ($service_list as $key => $value) 
        {
            $service_id[] = $value->service_id;
        }
        $service_ids = implode(',', $service_id);

        $staff_id = $request->input('staff_id');
        $day = $request->input('day');
        $availability_start_time = $request->input('availability_start_time');
        $availability_end_time = $request->input('availability_end_time');
        $selected_service_ids = $request->input('service_ids');
        if($selected_service_ids != ''){
            $service_id_str = $selected_service_ids;
        } else {
            $service_id_str = $service_ids;
        }
        $service_array = explode(',',$service_id_str);
        
        if(!empty($service_array)){
            if(isset($availability_start_time) && !empty($availability_start_time) && isset($availability_end_time) && !empty($availability_end_time)){
                if((count(array_filter($availability_start_time)) == count($availability_start_time)) && (count(array_filter($availability_end_time)) == count($availability_end_time))) {
                    $total_records = count($day);
                    $insert_data = array();
                    $failed_data = array();
                    foreach($service_array as $service){
                        for($i=0;$i<$total_records;$i++){
                            if($availability_start_time[$i] >= $availability_end_time[$i])
                            {
                                $failed_data[] = array('staff_id'=>$staff_id,
                                                    'service_id'=>$service,
                                                    'day'=>$day[$i],
                                                    'start_time'=>$availability_start_time[$i],
                                                    'end_time'=>$availability_end_time[$i],
                                                    'created_on'=>date('Y-m-d H:i:s')
                                                    );
                            }
                            else
                            {
                                $insert_data[] = array('staff_id'=>$staff_id,
                                                    'service_id'=>$service,
                                                    'day'=>$day[$i],
                                                    'start_time'=>$availability_start_time[$i],
                                                    'end_time'=>$availability_end_time[$i],
                                                    'created_on'=>date('Y-m-d H:i:s')
                                                    );
                            }
                        }
                    }
                    
                    //echo '<pre>'; print_r($insert_data); exit;
                    if(empty($failed_data))
                    {
                         $insertdata = $this->common_model->insert_data($this->tableObj->tableNameStaffServiceAvailability,$insert_data);
                    
                        $this->response_status='1';
                        $this->response_message = 'Schedule has been added successfully.';
                    }
                    else
                    {
                        $this->response_message="End time must be greater than start time.";
                    }
                   
                } else {
                    $this->response_message="Required field is missing.";
                }
            } else {
                $this->response_message="Nothing to update. Please enter required fileds";
            }
        } else {
            $this->response_message="No service found. Please add a service first.";
        }
        
        
        
        
        $this->json_output($response_data);

    }

    public function services_lists(Request $request)
    {
        //date_default_timezone_set('Asia/Kolkata');
        // Check User Login. If not logged in redirect to login page /
        $response_data = array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
        $user_no = $this->logged_user_no;

        $service_ids = $request->input('service_ids');
        $service_id = explode(',', $service_ids);

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            'in'=>array('service_id' => $service_id)
        );
        
        $selectFields=array();
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableUserService,$findCond,$selectFields);

        $service_name = array();
        //$service_id = array();
        foreach ($staff_list as $key => $value) 
        {
            $service_name[] = $value->service_name;
            //$service_id[] = $value->service_id;
        }

        $service_name = implode(',', $service_name);
        //$service_ids = implode(',', $service_id);
        if($service_name==''){
            $service_name = "SELECT SERVICE";
        }

        $this->response_status='1';
        $response_data['service_name'] = $service_name;
        $response_data['service_ids'] = $service_ids;
        $this->json_output($response_data);

    }


    public function delete_staff_availability(Request $request){
        // Check User Login. If not logged in redirect to login page //
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        //echo '<pre>'; print_r($request->all()); exit;
        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;

        $service_id = $request->input('service_id');
        $staff_id = $request->input('staff_id');

        $conditions = array(
            array('staff_id','=',$staff_id),
            array('service_id','=',$service_id),
            array('is_blocked','=','0'),
            array('is_deleted','=','0'),
        );

        $result = $this->common_model->fetchData($this->tableObj->tableNameStaffServiceAvailability,$conditions);
        //echo '<pre>'; print_r($result); exit;
        if(empty($result))
        {
            $this->response_message = "Invalid details.";
        }
        else
        {
            $update_data['is_deleted'] = 1;

            $update = $this->common_model->update_data($this->tableObj->tableNameStaffServiceAvailability,$conditions,$update_data);
            
            $this->response_status='1';
            $this->response_message = "Staff availability deleted successfully.";
        }
        
        $this->json_output($response_data);
    }

    public function area_code(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $area = $request->input('area');
        $pin_no = $request->input('pin_no');
        $staff_id = $request->input('staff_id');

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            array('postal_code','=',$pin_no),
            array('user_id','=',$user_id),
            array('staff_id','=',$staff_id),
        );

        $selectFields=array();
        $check_postal_code = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findCond,$selectFields);
        if(empty($check_postal_code))
        {
            $param = array(
                'user_id' => $user_id,
                'staff_id' => $staff_id,
                'postal_code' => $pin_no,
                'area' => $area
            );
            $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaffPostalCode,$param);
            if($insertdata > 0)
            {
                $query = "select `squ_staff_postal_code`.`postal_code`, COUNT(*) as count from `squ_staff_postal_code` where `squ_staff_postal_code`.`is_deleted` = 0 and `squ_staff_postal_code`.`is_blocked` = 0 and `squ_staff_postal_code`.`user_id` = '".$user_id."' and `squ_staff_postal_code`.`is_deleted` = 0 group by `postal_code`";

                $postal_code_count = $this->common_model->customQuery($query,$query_type=1);
                //print_r($postal_code_count); die();
               

                $findCond = array(
                    array('is_deleted','=','0'),
                    array('is_blocked','=','0'),
                    array('user_id','=',$user_id),
                    array('staff_id','=',$staff_id),
                );

                $selectField = array();

                $postal_codes = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="postal_code",$havings=array(),$limit=0,$offset=0,$is_count=0);
                
                $postal_code_array = array();
                foreach ($postal_codes as $key => $value)
                {
                    foreach ($postal_code_count as $keys => $ct) 
                    {
                        if($value->postal_code==$ct->postal_code)
                        {
                            $count = $ct->count;
                        }
                        else
                        {
                            $count = '1';
                        }
    
                    }

                    $postal_code_array[] = array(
                            'postal_code_id' => $value->postal_code_id,
                            'user_id' => $value->user_id,
                            'staff_id' => $value->staff_id,
                            'postal_code' => $value->postal_code,
                            'area' => $value->area,
                            'status' => $value->status,
                            'is_blocked' => $value->is_blocked,
                            'is_deleted' => $value->is_deleted,
                            'created_on' => $value->created_on,
                            'updated_on' => $value->updated_on,
                            'deleted_on' => $value->deleted_on,
                            'count' => $count,
                    );
                }

                $this->response_status='1';
                $this->response_message = array('postal_data' => $postal_code_array, 'msg' => "Postal code successfully added");
            }
        }
        else
        {
            $this->response_message = "Postal code already exist.";
        }

        $this->json_output($response_data);
    }

    public function get_post_code(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $staff_id = $request->input('staff_id');

        
        $query = "select `squ_staff_postal_code`.`postal_code`, COUNT(*) as count from `squ_staff_postal_code` where `squ_staff_postal_code`.`is_deleted` = 0 and `squ_staff_postal_code`.`is_blocked` = 0 and `squ_staff_postal_code`.`user_id` = '".$user_id."' and `squ_staff_postal_code`.`is_deleted` = 0 group by `postal_code`";

        $postal_code_count = $this->common_model->customQuery($query,$query_type=1);
        //print_r($postal_code_count); die();
       

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            array('user_id','=',$user_id),
            array('staff_id','=',$staff_id),
        );

        $selectField = array();

        $postal_codes = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="postal_code",$havings=array(),$limit=0,$offset=0,$is_count=0);
        
        $postal_code_array = array();
        foreach ($postal_codes as $key => $value)
        {
            foreach ($postal_code_count as $keys => $ct) 
            {
                if($value->postal_code==$ct->postal_code)
                {
                    $count = $ct->count;
                }
                else
                {
                    $count = '1';
                }

            }

            $postal_code_array[] = array(
                    'postal_code_id' => $value->postal_code_id,
                    'user_id' => $value->user_id,
                    'staff_id' => $value->staff_id,
                    'postal_code' => $value->postal_code,
                    'area' => $value->area,
                    'status' => $value->status,
                    'is_blocked' => $value->is_blocked,
                    'is_deleted' => $value->is_deleted,
                    'created_on' => $value->created_on,
                    'updated_on' => $value->updated_on,
                    'deleted_on' => $value->deleted_on,
                    'count' => $count,
            );
        }


        $staffFindCond = array(
            array('staff_id','=',$staff_id),
        );
        $StaffSelectedField = array('postlcode_customer_interface');
        $postlcode_customer_interface = $this->common_model->fetchData($this->tableObj->tableNameStaff,$staffFindCond,$StaffSelectedField);

        $this->response_status='1';
        $this->response_message = array('postal_data' => $postal_code_array, 'postlcode_customer_interface' => $postlcode_customer_interface, 'msg' => "Postal code successfully added");

        $this->json_output($response_data);
    }


    public function chnage_postal_code_status(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
        $status = $request->input('status');
        $ids = explode(',', $request->input('ids'));

        $status = $status=='active' ? '1' : '2';
        
        foreach ($ids as $key => $value)
        {
            $findCond=array(
                        array('postal_code_id','=',$value),
                    );

            $updateData=array(
                'status'=>$status,
                'updated_on'=>$this->date_format
            );
            $this->common_model->update_data($this->tableObj->tableNameStaffPostalCode,$findCond,$updateData);

        }
        
        $query = "select `squ_staff_postal_code`.`postal_code`, COUNT(*) as count from `squ_staff_postal_code` where `squ_staff_postal_code`.`is_deleted` = 0 and `squ_staff_postal_code`.`is_blocked` = 0 and `squ_staff_postal_code`.`user_id` = '".$user_id."' and `squ_staff_postal_code`.`is_deleted` = 0 group by `postal_code`";

        $postal_code_count = $this->common_model->customQuery($query,$query_type=1);
        //print_r($postal_code_count); die();
       

        $findCond = array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
            array('user_id','=',$user_id),
            array('staff_id','=',$staff_id),
        );

        $selectField = array();

        $postal_codes = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="postal_code",$havings=array(),$limit=0,$offset=0,$is_count=0);
        
        $postal_code_array = array();
        foreach ($postal_codes as $key => $value)
        {
            foreach ($postal_code_count as $keys => $ct) 
            {
                if($value->postal_code==$ct->postal_code)
                {
                    $count = $ct->count;
                }
                else
                {
                    $count = '1';
                }

            }

            $postal_code_array[] = array(
                    'postal_code_id' => $value->postal_code_id,
                    'user_id' => $value->user_id,
                    'staff_id' => $value->staff_id,
                    'postal_code' => $value->postal_code,
                    'area' => $value->area,
                    'status' => $value->status,
                    'is_blocked' => $value->is_blocked,
                    'is_deleted' => $value->is_deleted,
                    'created_on' => $value->created_on,
                    'updated_on' => $value->updated_on,
                    'deleted_on' => $value->deleted_on,
                    'count' => $count,
            );
        }

        $this->response_status='1';
        $this->response_message = array('postal_data' => $postal_code_array, 'msg' => "Postal code successfully added");

        $this->json_output($response_data);
    }

    public function postal_code_filter(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
        $status = $request->input('status');

        
        $query = "select `squ_staff_postal_code`.`postal_code`, COUNT(*) as count from `squ_staff_postal_code` where `squ_staff_postal_code`.`is_deleted` = 0 and `squ_staff_postal_code`.`is_blocked` = 0 and `squ_staff_postal_code`.`user_id` = '".$user_id."' and `squ_staff_postal_code`.`is_deleted` = 0 group by `postal_code`";

        $postal_code_count = $this->common_model->customQuery($query,$query_type=1);
        //print_r($postal_code_count); die();
       
        if($status=="all")
        {
            $findCond = array(
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                array('user_id','=',$user_id),
                array('staff_id','=',$staff_id),
            );
        }
        else if($status=="active")
        {
            $findCond = array(
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                array('user_id','=',$user_id),
                array('staff_id','=',$staff_id),
                array('status','=','1'),
            );
        }
        else if($status=="inactive")
        {
            $findCond = array(
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
                array('user_id','=',$user_id),
                array('staff_id','=',$staff_id),
                array('status','=','2'),
            );
        }
        

        $selectField = array();

        $postal_codes = $this->common_model->fetchDatas($this->tableObj->tableNameStaffPostalCode,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="postal_code",$havings=array(),$limit=0,$offset=0,$is_count=0);
        
        $postal_code_array = array();
        foreach ($postal_codes as $key => $value)
        {
            foreach ($postal_code_count as $keys => $ct) 
            {
                if($value->postal_code==$ct->postal_code)
                {
                    $count = $ct->count;
                }
                else
                {
                    $count = '1';
                }

            }

            $postal_code_array[] = array(
                    'postal_code_id' => $value->postal_code_id,
                    'user_id' => $value->user_id,
                    'staff_id' => $value->staff_id,
                    'postal_code' => $value->postal_code,
                    'area' => $value->area,
                    'status' => $value->status,
                    'is_blocked' => $value->is_blocked,
                    'is_deleted' => $value->is_deleted,
                    'created_on' => $value->created_on,
                    'updated_on' => $value->updated_on,
                    'deleted_on' => $value->deleted_on,
                    'count' => $count,
            );
        }

        $this->response_status='1';
        $this->response_message = array('postal_data' => $postal_code_array, 'msg' => "Postal code successfully added");

        $this->json_output($response_data);
    }

    public function change_postal_code_customer_interface(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
        
        $staffFindCond = array(
            array('staff_id','=',$staff_id),
        );
        $StaffSelectedField = array('postlcode_customer_interface');
        $postlcode_customer_interface = $this->common_model->fetchData($this->tableObj->tableNameStaff,$staffFindCond,$StaffSelectedField);

        $postlcode_customer_interface = $postlcode_customer_interface->postlcode_customer_interface == '1' ? '0' : '1';

        $findCond=array(
                    array('staff_id','=',$staff_id),
                );

        $updateData=array(
            'postlcode_customer_interface' => $postlcode_customer_interface,
            'updated_on'=>$this->date_format
        );
        
        $this->common_model->update_data($this->tableObj->tableNameStaff,$findCond,$updateData);

        $this->response_status='1';
        $this->response_message = array('postlcode_customer_interface' => $postlcode_customer_interface, 'msg' => "Successfully updated");

        $this->json_output($response_data);
    }

    public function edit_service_list_staff(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $service_id = $request->input('service_id');
        $staff_id = $request->input('staff_id');
        
        $staffFindCond = array(
            array('service_id','=',$service_id),
            array('staff_id','=',$staff_id),
        );

        $order_by = array('day' => 'ASC');
        $StaffSelectedField = '';
        $avability_list_staff_view = $this->common_model->fetchDatas($this->tableObj->tableNameStaffServiceAvailability, $staffFindCond,$StaffSelectedField,$joins = '', $order_by);

        $service_array = array();
        for($i = 1; $i<8; $i++)
        {
            if(!empty($avability_list_staff_view))
            {
                foreach ($avability_list_staff_view as $key => $value)
                {
                    if($value->day==$i)
                    {
                        $start_time = $value->start_time;
                        $end_time = $value->end_time;
                        $day = $i;
                        break;
                    }
                    else
                    {
                        $start_time = '';
                        $end_time = '';
                        $day = $i;
                    }
                }
            }
            else
            {
                $start_time = '';
                $end_time = '';
                $day = $i;
            }

            $service_array[] = array('day' => $day, 'start_time' => $start_time, 'end_time' => $end_time);
            

           /* $start_time = $avability_list_staff_view[$i]->start_time;
            $end_time = $avability_list_staff_view[$i]->end_time;
            $day = $i+1;*/
        }

        //print_r($service_array); die();

        $this->response_status='1';
        $this->response_message = $service_array;

        $this->json_output($response_data);
    }


    public function update_staff_availability_form(Request $request)
    {

        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

        //echo '<pre>'; print_r($request->all()); exit;

        $response_data=array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $service_id = $request->input('service_id');
        $staff_id = $request->input('stuff_id');
        $day = $request->input('day');
        $start_time = $request->input('availability_update_start_time');
        $end_time = $request->input('availability_update_end_time');
        
        $staffFindCond = array(
            array('service_id','=',$service_id),
            array('staff_id','=',$staff_id),
        );

        $delete = $this->common_model->delete_data($this->tableObj->tableNameStaffServiceAvailability, $staffFindCond);

        for ($i=0; $i < count($day) ; $i++)
        { 
            if($start_time[$i] && $end_time[$i])
            {
                $param = array(
                    'staff_id' => $staff_id,
                    'service_id' => $service_id,
                    'day' => $day[$i],
                    'start_time' => $start_time[$i],
                    'end_time' => $end_time[$i],
                );

                $insertdata = $this->common_model->insert_data_get_id($this->tableObj->tableNameStaffServiceAvailability,$param);
            }
        }

        $this->response_status='1';
        $this->response_message = "Successfully updated.";

        $this->json_output($response_data);
    }

    // User's Staff Listing //
    public function staff_service_availability_mobile(Request $request){
        $response_data=array(); 
        // validate the requested param for access this service api
        $this->validate_parameter(1); // along with the user request key validation
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

        //avability list
        $findCond=array(
            array('is_deleted','=','0'),
            array('is_blocked','=','0'),
        );
        
        $tableNameStaffServiceAvailability = $this->tableObj->tableNameStaffServiceAvailability;
        $tableUserService = $this->tableObj->tableUserService;
        $selectField = array('staff_service_availability_id','staff_id','service_id','day','start_time','end_time');
        

        $availability_list = $this->common_model->fetchDatas($tableNameStaffServiceAvailability,$findCond,$selectField);


        //staff list
        $staff_condition = array(
                array('user_id','=',$user_no),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
        );
        $staff_field = array('staff_id','full_name');
        $staff_list = $this->common_model->fetchDatas($this->tableObj->tableNameStaff,$staff_condition,$staff_field);

        //service list
        $servCond = array(
            array('user_id','=',$user_no),
            array('is_deleted','=','0'),
            //array('is_blocked','=','0'),
        );

        $serviceFields = array('service_id', 'service_name', 'duration');

        $service_list = $this->common_model->fetchDatas($this->tableObj->tableUserService, $servCond, $serviceFields);

        $response_data['availability_list']=$availability_list;
        $response_data['staff_list']=$staff_list;
        $response_data['service_list']=$service_list;
        $this->response_status='1';
        // generate the service / api response
        $this->json_output($response_data);
    }


    public function availability_mobile()
    {
        return "good";
    }


    public function edit_team_member_indiv(Request $request)
    {
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
                
                $response_data['response_status'] ='1';
                $response_data['response_message'] = "Staff successfully updated.";

            }

            $this->json_output($response_data);

        }
        
    }

    public function send_staff_verification_email(Request $request)
    {
        $response_data = array();
        $this->validate_parameter(1);
        $user_id = $this->logged_user_no;
        $staff_id = $request->input('staff_id');
                
        $condition = array(
            array('staff_id','=',$staff_id),
        );

        $selectFields = array();

        $staff_details = $this->common_model->fetchData($this->tableObj->tableNameStaff, $condition, $selectFields);

        if(!empty($staff_details))
        {
            $email = $staff_details->email;
            $redirect_url = Crypt::encrypt($staff_details->staff_id);
            $redirect_url = url('staff-verification-link/'.$redirect_url);
            
            //Send Verification Link
            $content = '<style>
                   body {margin:0; background:#eef2f6;}
                </style>
                <div style="max-width:650px; margin:20px auto; font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif">
                    <div style="border-radius: 8px 8px 0 0; background-color: #2ba2da; padding:15px ">
                        <table width="100%">
                          <tr>
                            <td><img src="'.asset('public/assets/website/images/logo-light-text.png').'" height="30"></td>
                            <td style="color:#FFF; text-align: right; " >&nbsp;</td>
                          </tr>
                        </table>
                    </div>
                   <div style="padding:20px; margin-top: 15px; background: #FFF; border-radius:8px;">
                      <p style="text-align:center; font-size:18px; margin-top: 0 ">Welcome to squeedr!</p>
                      <p style="text-align:center">Click the button below to verify your staff profile.</p>
                      <div style="text-align:center;">
                         <a href="{verifiactinlink}" style="border-radius: 4px;background-color: #2ba2da; color: #FFF; padding: 10px 25px; width:150px; display:inline-block; text-decoration: none;">Verify !</a>  &nbsp;
                      </div>
                   </div>
                   <br />
                    <em>- Squeedr, Your friendly Assistant</em><br />
                    <br />
                   <div style="padding:20px; margin-top: 15px; background: #ccecfa; border-radius:8px;">
                      <p style="text-align:center; font-size:18px; margin-top: 0 ">Download the app!</p>
                      <p style="text-align:center">For even easier management of your appointments.</p>
                      <div style="text-align:center;">
                         <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>
                         <a href="#" style="color: #FFF; margin: 20px 5px 0;  display:inline-block; "><img src="'.asset('public/assets/website/images/android.png').'" style="width:150px"></a>  
                      </div>
                   </div>
                   <div style="text-align:center">
                      <a target="_blank" href="https://www.facebook.com/profile.php?id=1423240701" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/facebook.png').'" width="40px; "></a>
                      <a target="_blank" href="https://twitter.com/Squeed_r" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/twitter.png').'"  width="40px; "></a>
                      <a target="_blank" href="https://www.instagram.com/squeedr/?hl=fr" style="margin:15px 15px 5px; display:inline-block"><img src="'.asset('public/assets/website/images/instagram.png').'"  width="40px; "></a>
                      <br><br>
                      <a href="#" style="text-decoration: none;color:#000; margin: 0 15px; font-size: 14px;">CONTACT</a>  |     <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">ABOUT</a>    |   <a href="#" style=" font-size: 14px;text-decoration: none;color:#000; margin: 0 15px;">FAQ</a>
                      <p>Copyright &copy; '.date('Y').'</p>
                   </div>
                </div>';
            $emailData['content'] = str_replace('{verifiactinlink}', $redirect_url, $content);
            $emailData['verify_link'] = $redirect_url;
            $emailData['toName'] = '';

            $this->sendmail(23,$email,$emailData);

            $this->response_status='1';
            $this->response_message = "Successfully verification mail send.";
        }
        else
        {
            $this->response_status='0';
            $this->response_message = "Staff email not found & already verified.";
        }

        $this->json_output($response_data);
    }

}