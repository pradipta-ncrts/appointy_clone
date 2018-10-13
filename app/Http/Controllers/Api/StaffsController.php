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
            $full_name = $request->input('staff_fullname');
            $email = $request->input('staff_email');
            $username = $request->input('staff_username');
            $mobile = $request->input('staff_mobile');
            $home_phone = $request->input('staff_home_phone');
            $work_phone = $request->input('staff_work_phone');
            $category_id = $request->input('staff_category');
            $expertise = $request->input('staff_expertise');
            $description = $request->input('staff_description');
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
            $msg = "Staff has been added as internal staff";
        } else if($type == 'internal_staff' && $status_value == 0) {
            $staff_data['is_internal_staff'] = 1;
            $msg = "Staff has been removed internal staff";
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
				foreach ($excel_rows as $row)
				{
					$updateMasterData = array();
					//echo "<pre>";print_r($row);exit;
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
				}
			}

			$this->response_status='1';
            $this->response_message = $exist .'row exist <br>'.$notExit. 'row successfully insert';
        }
        else
        {
        	$this->response_message = "Only excel file can import.";
        }

        echo 'e'.$exist.'/ne'.$notExit; die();
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
            $findCond=array(
                array('user_id','=',$user_no),
                array('staff_id','=',$staff_id),
                array('start_time','=',""),
                array('end_time','=',""),
                array('is_deleted','=','0'),
                array('is_blocked','=','0'),
            );

            //$selectField = array('block_id','GROUP_CONCAT(block_date)');
            //$block_dates = $this->common_model->fetchDatas($this->tableObj->tableNameBlockDateTime,$findCond,$selectField,$joins=array(),$orderBy=array(),$groupBy="YEAR(block_date), MONTH(block_date)",$havings=array(),$limit=0,$offset=0,$is_count=0);
            $query = "select `squ_block_date_time`.`block_id`, MONTHNAME(`squ_block_date_time`.`block_date`) AS month, YEAR(`squ_block_date_time`.`block_date`) AS year, GROUP_CONCAT(squ_block_date_time.block_date) AS block_dates 
            from `squ_block_date_time` 
            where `squ_block_date_time`.`user_id` = ".$user_no." 
                and `squ_block_date_time`.`staff_id` = ".$staff_id."
                and `squ_block_date_time`.`start_time` = ''
                and `squ_block_date_time`.`end_time` = ''
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









}