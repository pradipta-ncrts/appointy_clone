<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Session;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{

    //Validator

    function decode_validator_error($input)
    {
        $error_array = json_decode($input,true);
        $msg= "";
        foreach($error_array as $k=>$v){
            $msg .= $v[0];
        }
        return $msg;
    }


    /*admin login*/
    public function login(Request $data)
    {
        $data['title'] = "Login Page";
        if(Session::has('login'))
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return view('admin/login',$data);
        }
    }

    /*Admin Dashbord */
    public function index(Request $data)
    {
        $data['title'] = "Dashbord";
        $data['totalTrancuction'] = '0';
        $data['totalTransfer'] = '0';
        $data['transuctions'] = '0';
        $data['userCount'] = '0';
        $data['verifiedUsers'] = '0';
        $data['blockUsers'] = '0';
        return view('admin/index',$data);
    }
    
    /*check login*/
    public function check_login(Request $request)
    {
        $validate = Validator::make($request->all(),[
                                     'username'=>'required',
                                     'password'=>'required'
                                    ]);

        if ($validate->fails())
        {
            $error = $this->decode_validator_error($validate->errors()); 
            \Session::flash('err_message', $error);                   
            return redirect('admin/login');
        }
        else
        {
            $username = $request->input('username'); 
            $password = md5($request->input('password'));
            $conditions = array(
                            array('username','=',$username),
                            array('password','=',$password),
                            );

           // echo $this->adminTableObj->tableNameMasterAdmin; die();

            $result = $this->common_model->fetchData($this->adminTableObj->tableNameMasterAdmin, $conditions);
            if($result)
            {
                Session::set('login', $result);
                return redirect('admin/dashboard');
            }
            else
            {
                \Session::flash('err_message', "Invalid Credential");
                return redirect('admin/login');
            }
        }
    }


    /*Logout*/
    public function logout(Request $data)
    {
        Session::forget('login');
        return redirect('admin/login');
    }

    
    //admin settings
    public function admin_settings(Request $data)
    {
        $data['title'] = "Admin Settings";
        $data['settings'] = $this->user_model->settings_data();
        return view('admin/settings',$data);       
    }


    //admin change password view
    public function change_password(Request $data)
    {
        $data['title'] = "Chnage Password";
        return view('admin/change_password',$data);        
    }

    //admin new password update
    public function update_password(Request $data)
    {
        $old_password = $data->input('old_pwd');
        $new_password = $data->input('pwd');
        $new_confirm_password = $data->input('pwd2');

        $condition = array(
                        array('password','=',md5($old_password)),
                    );
        $check_old_password = $this->common_model->fetchData($this->adminTableObj->tableNameMasterAdmin,$condition);
        if(!empty($check_old_password))
        {
            if($new_password==$new_confirm_password)
            {
                $where = array(
                        array('id','=',1)
                    );

                $data = array('updated_on' => date("Y-m-d H:i:s"), 'password' => md5($new_confirm_password));
                $update = $this->common_model->update_data($this->adminTableObj->tableNameMasterAdmin, $where, $data);
                if($update)
                {
                    \Session::flash('success_message', "Password successfully chnaged."); 
                    return redirect('admin/change-password');
                }
                else
                {
                    \Session::flash('error_message', "Update fails."); 
                    return redirect('admin/change-password');
                }
            }
            else
            {
                \Session::flash('error_message', "Password & confirm password mis-match"); 
                return redirect('admin/change-password');
            }
        }
        else
        {
            \Session::flash('error_message', "Old password mismatch."); 
            return redirect('admin/change-password');
        }
    }


     /*active / inactive */


    public function update_status(Request $post=null)
    {
       $post_data = explode(',', $post['post_data']);

       $id = $post_data[0]; 
       $table_name = $post_data[1];
       $field_name = $post_data[2];
       $status = $post_data[3];
       $condition_field = $post_data[4];
       if($id && $table_name && $field_name && $condition_field)
       {
            $status = $status==1 ? 0 : 1;
            $where = array(
                        array($condition_field,'=',$id)
                    );

            $data = array('updated_on' => date("Y-m-d H:i:s"), $field_name => $status);
            $update = $this->common_model->update_data($table_name, $where, $data); 

            if($update)
            {
                return Response::make([
                        'responce' => 'success',
                        'status' => $status,
                        'row_id' => $id,
                        'table_name' => $table_name,
                        'field_name' => $field_name,
                        'condition_field' => $condition_field,
                                 ]);
            }
            else
            {
                $message = "Please try again later";
                return Response::make([
                        'message' => $message
                                 ]);
            }
       }
       else
       {
            $message = "Sorry! Delete Faild";
            return Response::make([
                            'message' => $message
                                 ]);
       }
    }


    public function delete_single_entity(Request $post=null)
    {
       $post_data = explode(',', $post['post_data']);
       $delete_id = $post_data[0]; 
       $table = $post_data[1];
       $field_name = $post_data[2];
       if($delete_id && $table && $field_name)
       {
            $where = array(
                        array($field_name,'=',$delete_id)
                    );

            
            $delete = $this->common_model->removeDatas($table, $where);

            return Response::make([
                        'message' => 'success'
                                 ]);
       }
       else
       {
            $message = "Sorry! Delete Faild";
            return Response::make([
                            'message' => $message
                                 ]);
       }

    }
    //delete multiple entry

    public function delete_multiple_entity(Request $post=null)
    {
       $post_data = trim($post['post_data'],",");
       $ids = explode(',', $post_data);
       $table_data = explode(',', $post['table_data']);
       $table_name = $table_data[0];
       $field_name = $table_data[1];
       $count = 0;
       for ($i=0; $i < count($ids) ; $i++)
       { 
            $is_blocked = 1;
            $where = array(
                        array($field_name,'=',$ids[$i])
                    );

            $delete = $this->common_model->removeDatas($table_name, $where);

            $count++;
       }

       if($count>0)
       {
            return Response::make([
                    'message' => 'success',
                             ]);
       }
       else
       {
            return Response::make([
                    'message' => 'Somthing wrong try again later.',
                             ]);
       }
    }

    //profession 
    public function profession(Request $data)
    {
        $data['title'] = "Profession";
        $conditions = array(
                        array('is_deleted', '=', 0),
                    );
        $data['results'] = $this->common_model->fetchDatas($this->adminTableObj->tableNameProfession,$conditions);
        return view('admin/profession',$data);     
    }

    //add profession view

    public function add_profession(Request $post,$post_id = null)
    {
        $data['title'] = "Profession";
        if($post_id!=null)
        {
            $condition = array(
                            array('profession_id','=',base64_decode($post_id)),
                        );
            $data['result'] = $this->common_model->fetchData($this->adminTableObj->tableNameProfession,$condition);
        }

        return view('admin/profession_add',$data);    
    } 

    //add & edit profession

    public function modify_profession(Request $post)
    {
        $from_data = $post->only('profession');
        if($post->input('profession_id'))
        {
            $date = array('updated_on' => date('Y-m-d H:i:s'));
            $parma = array_merge($from_data,$date);
            $where = array(
                        array('profession_id','=',$post->input('profession_id'))
                    );

            $update = $this->common_model->update_data($this->adminTableObj->tableNameProfession, $where, $parma);

            if($update)
            {
                \Session::flash('success_message', "Successfully updated."); 
                return redirect('admin/profession');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/profession');
            }
        }
        else
        {
            $date = array('created_on' => date('Y-m-d H:i:s'));
            $param = array_merge($from_data,$date);
            $insert = $this->common_model->insert_data_get_id($this->adminTableObj->tableNameProfession,$param);
            if($insert)
            {
                \Session::flash('success_message', "Successfully added."); 
                return redirect('admin/profession');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/profession');
            }
        }
        
    }


    //categoty 
    public function category(Request $data)
    {
        $data['title'] = "Category";
        $conditions = array(
                        array('is_deleted', '=', 0),
                    );
        $data['results'] = $this->common_model->fetchDatas($this->adminTableObj->tableNameCategory,$conditions);
        return view('admin/category',$data);    
    }

    //add category view

    public function add_category(Request $post,$post_id = null)
    {
        $data['title'] = "Category";
        if($post_id!=null)
        {
            $condition = array(
                            array('category_id','=',base64_decode($post_id)),
                        );
            $data['result'] = $this->common_model->fetchData($this->adminTableObj->tableNameCategory,$condition);
        }

        return view('admin/category_add',$data);    
    } 


    //add & edit category

    public function modify_category(Request $post)
    {
        $from_data = $post->only('category');
        if($post->input('category_id'))
        {
            $date = array('updated_on' => date('Y-m-d H:i:s'));
            $parma = array_merge($from_data,$date);
            $where = array(
                        array('category_id','=',$post->input('category_id'))
                    );

            $update = $this->common_model->update_data($this->adminTableObj->tableNameCategory, $where, $parma);

            if($update)
            {
                \Session::flash('success_message', "Successfully updated."); 
                return redirect('admin/category');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/category');
            }
        }
        else
        {
            $date = array('created_on' => date('Y-m-d H:i:s'));
            $param = array_merge($from_data,$date);
            $insert = $this->common_model->insert_data_get_id($this->adminTableObj->tableNameCategory,$param);
            if($insert)
            {
                \Session::flash('success_message', "Successfully added."); 
                return redirect('admin/category');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/category');
            }
        }
        
    }

    //categoty 
    public function country(Request $data)
    {
        $data['title'] = "Country";
        $conditions = array(
                        array('is_deleted', '=', 0),
                    );
        $data['results'] = $this->common_model->fetchDatas($this->adminTableObj->tableNameCountry,$conditions);
        return view('admin/country',$data);    
    }

     //add country view

    public function add_country(Request $post,$post_id = null)
    {
        $data['title'] = "Country";
        if($post_id!=null)
        {
            $condition = array(
                            array('country_no','=',base64_decode($post_id)),
                        );
            $data['result'] = $this->common_model->fetchData($this->adminTableObj->tableNameCountry,$condition);
        }

        return view('admin/country_add',$data);    
    } 


    //add & edit category
    public function modify_country(Request $post)
    {
        $from_data = $post->only('country_name', 'country_iso_code', 'country_dialing_code');
        if($post->input('country_no'))
        {
            $date = array('updated_on' => date('Y-m-d H:i:s'));
            $parma = array_merge($from_data,$date);
            $where = array(
                        array('country_no','=',$post->input('country_no'))
                    );

            $update = $this->common_model->update_data($this->adminTableObj->tableNameCountry, $where, $parma);

            if($update)
            {
                \Session::flash('success_message', "Successfully updated."); 
                return redirect('admin/country');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/cpuntry');
            }
        }
        else
        {
            $date = array('created_on' => date('Y-m-d H:i:s'));
            $param = array_merge($from_data,$date);
            $insert = $this->common_model->insert_data_get_id($this->adminTableObj->tableNameCountry,$param);
            if($insert)
            {
                \Session::flash('success_message', "Successfully added."); 
                return redirect('admin/country');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/country');
            }
        }
        
    }

    public function single_delete(Request $post)
    {
        $post_data = trim($post['post_data'],",");
        $user_ids = explode(',', $post_data);
        $count = 0;
        for ($i=0; $i < count($user_ids) ; $i++)
        {
            $user_id = $user_ids[$i];

            $condition = array(
                        array('user_no','=',$user_id),
                    );
            $user_data = $this->common_model->fetchData($this->adminTableObj->tableNameUser,$condition);
            if($user_data)
            {
                if($user_data->user_type==3)
                {
                    // $condition = array(
                    //             array('created_by','=',$user_data->created_by),
                    //         );
                    $condition = array(
                            'raw'=>"( created_by='$user_data->user_no' OR user_no='$user_data->user_no')"
                        );
                    $child_user_data = $this->common_model->fetchDatas($this->adminTableObj->tableNameUser,$condition);
                    foreach ($child_user_data as $key => $value)
                    {
                        $master_user_id = $value->user_no; 

                        //if field name 'user_no'
                        $coreCondition = array(
                                    array('user_no','=',$master_user_id),
                                    );

                        //delete from attachments table 
                        $this->common_model->delete_data($this->adminTableObj->tableNameAttachment,$coreCondition);

                        //delete from tutor_requests using user_no
                        $this->common_model->delete_data('tutor_requests',$coreCondition);

                        //Blog realated data delete
                        $this->delete_blog($master_user_id,$coreCondition);

                        //Blog realated data delete
                        $this->delete_channels($master_user_id,$coreCondition);

                        //product realated data delete
                        $this->product_delete($master_user_id,$coreCondition);

                        //product realated data delete
                        $this->post_delete($master_user_id,$coreCondition);

                        //classroom related data delete

                        $this->delete_classroom($master_user_id,$coreCondition);

                        //delete user
                        $this->common_model->delete_data($this->adminTableObj->tableNameUser,$coreCondition);
                    }
                }
                else
                {
                    $master_user_id = $user_data->user_no;

                    //if field name 'user_no'
                    $coreCondition = array(
                                array('user_no','=',$master_user_id),
                                );

                    //delete from attachments table 
                    $this->common_model->delete_data($this->adminTableObj->tableNameAttachment,$coreCondition);

                    //delete from tutor_requests using user_no
                    $this->common_model->delete_data('tutor_requests',$coreCondition);

                    //Blog realated data delete
                    $this->delete_blog($master_user_id,$coreCondition);

                    //Blog realated data delete
                    $this->delete_channels($master_user_id,$coreCondition);

                    //product realated data delete
                    $this->product_delete($master_user_id,$coreCondition);

                    //product realated data delete
                    $this->post_delete($master_user_id,$coreCondition);

                    //classroom related data delete

                    $this->delete_classroom($master_user_id,$coreCondition);

                    //delete user
                    $this->common_model->delete_data($this->adminTableObj->tableNameUser,$coreCondition);
                }
                  
            }

            $count++;
        }

        if($count>0)
        {
            return "success";
        }
       
    } 

    //currency 
    public function currency(Request $data)
    {
        $data['title'] = "Currency";
        $conditions = array(
                        array('is_deleted', '=', 0),
                    );
        $data['results'] = $this->common_model->fetchDatas($this->adminTableObj->tableNameCurrency,$conditions);
        return view('admin/currency',$data);     
    }

    //add currency view

    public function add_currency(Request $post,$post_id = null)
    {
        $data['title'] = "Currency";
        if($post_id!=null)
        {
            $condition = array(
                            array('currency_id','=',base64_decode($post_id)),
                        );
            $data['result'] = $this->common_model->fetchData($this->adminTableObj->tableNameCurrency,$condition);
        }

        return view('admin/currency_add',$data);    
    } 

    //add & edit currency

    public function modify_currency(Request $post)
    {
        $from_data = $post->only('currency');
        if($post->input('currency_id'))
        {
            $date = array('updated_on' => date('Y-m-d H:i:s'));
            $parma = array_merge($from_data,$date);
            $where = array(
                        array('currency_id','=',$post->input('currency_id'))
                    );

            $update = $this->common_model->update_data($this->adminTableObj->tableNameCurrency, $where, $parma);

            if($update)
            {
                \Session::flash('success_message', "Successfully updated."); 
                return redirect('admin/currency');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/currency');
            }
        }
        else
        {
            $date = array('created_on' => date('Y-m-d H:i:s'));
            $param = array_merge($from_data,$date);
            $insert = $this->common_model->insert_data_get_id($this->adminTableObj->tableNameCurrency,$param);
            if($insert)
            {
                \Session::flash('success_message', "Successfully added."); 
                return redirect('admin/currency');
            }
            else
            {
                \Session::flash('error_message', "Update fails."); 
                return redirect('admin/currency');
            }
        }
        
    }

}