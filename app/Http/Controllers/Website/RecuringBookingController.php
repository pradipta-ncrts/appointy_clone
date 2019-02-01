<?php 
/**
 * @Author : NCRTS
 * Client Controller for Website
 * 
 */
namespace App\Http\Controllers\Website;
require_once('./vendor/stripe/init.php');
use App\Http\Requests;
use App\Http\Controllers\BaseApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\TablesController;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Session;
use Cookie;

use DateTime;

class RecuringBookingController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}


    public function recuring_booking_list($parameter=NULL)
	{
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }

		$data = array();
		return view('website.booking.recuring_booking_list')->with($data);
	}

    public function recuring_booking_details($parameter=NULL)
    {
        $authdata = $this->website_login_checked();
        if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
           return redirect('/login');
        }
        
        $data = array();
        return view('website.booking.recuring_booking_details')->with($data);
    }
    
	
}