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

class helpController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function help()
	{
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key'])))
		{
			return redirect('/mobile/login');
		}

		/*$user_no = $authdata['user_no'];
		
		//Review List

		$findCond = array(
			array('is_deleted','=','0'),
		);

		$selectFields = array();
		$client_field = array('	client_name', 'client_email');

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
		
		$review_list = $this->common_model->fetchDatas($this->tableObj->tableNameFeedback, $findCond, $selectFields,$joins);
		$data['review_list'] = $review_list;*/
		$data['help'] = '';
		return view('mobile.help.help')->with($data);
	}

}