<?php 
/**
 * @Author : NCRTS
 * User Controller for Website
 * 
 */
namespace App\Http\Controllers\Website;
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

class InvoiceController extends ApiController {

	function __construct(Request $input){

		parent::__construct($input);

	}

	public function payment_options()
	{

		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}
		
		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			//'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="payment_options";
		$return = $this->curl_call($url_func_name,$post_data);
		
		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$data['payment_options'] = $return->payment_options;
			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.payment.payment-options')->with($data);
		}
		else{
			return $return;
		}
		return view('website.payment.payment-options');
	}

	public function create_invoice($order_id=NULL)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['order_id'] = $order_id;
		$post_data['page_no']=1;
		$data=array(
			//'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="invoice_booking_details";
		$return = $this->curl_call($url_func_name,$post_data);
		
		/*echo "<pre>";
		print_r($return->appoinment_details); 
		die();*/

		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$appoinmens = $return->appoinment_details;
				$appoinment_details = $appoinmens[0];
				$data['service_name'] = $appoinment_details->service_name;
				if($appoinment_details->profile_image)
				{
					$profile_image = asset('public/image/profile_image').'/'.$appoinment_details->profile_image;
				}
				else
				{
					$profile_image = asset('public/assets/website/images/logo-invoice.png');
				}
				$data['profile_image'] = $profile_image;
				$data['invoive_no'] = $appoinment_details->order_id;
				$data['invoice_date'] = strtotime($appoinment_details->invoice_date)>0 ? date('Y-m-d', strtotime($appoinment_details->invoice_date)) : date('Y-m-d');
				$data['due_date'] = strtotime($appoinment_details->due_date)>0 ? date('Y-m-d', strtotime($appoinment_details->due_date)) : date('Y-m-d');
				$data['client_name'] = $appoinment_details->client_name;
				$data['client_email'] = $appoinment_details->client_email;
				$data['qty'] = count($appoinmens);
				$unit_price = $appoinment_details->cost;
				$data['unit_price'] = $appoinment_details->currency.' '.$unit_price;
				$data['total_unit_price'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['sub_total'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['total'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['note'] = $appoinment_details->note;
				$data['terms_condition'] = $appoinment_details->terms_condition;
				$data['service_provider_name'] = $appoinment_details->name;
				$data['service_provider_address'] = $appoinment_details->business_location;
				$data['service_provider_email'] = $appoinment_details->email;
				$data['service_provider_phone'] = $appoinment_details->mobile;
				$data['currency'] = $appoinment_details->currency;
				$data['email_invoice_unit_price'] = $unit_price;
				$data['email_invoice_total_price'] = $unit_price*count($appoinmens);
				$data['total_amount'] = $unit_price*count($appoinmens);
				$data['subtotal_tax'] = 0.00;

			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.payment.create-invoice')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.payment.create-invoice');
	}

	public function send_invoice(Request $request)
    {
    	// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

        $service_logo_url = $request->input('service_name');
        $service_provider_name = $request->input('service_provider_name');
        $service_provider_address = $request->input('service_provider_address');
        $service_provider_email = $request->input('service_provider_email');
        $service_provider_phone = $request->input('service_provider_phone');
        $order_id = $request->input('invoive_no');
        $invoice_date = $request->input('invoice_date');
        $payment_terms = $request->input('payment_terms');
        $due_date = $request->input('due_date');
        $client_email = $request->input('client_name')[0];
        $service_name = $request->input('service_name');
        $appointemnt_qty = $request->input('quentity');
        $currency = $request->input('currency');
        $unit_price = $request->input('email_invoice_unit_price');
        $total_price = $request->input('email_invoice_total_price');
        $tax = $request->input('tax');
        $note_to_recepent = $request->input('note_to_receipent');
        $total_amount = $request->input('total_amount');
        $subtotal_tax = $request->input('subtotal_tax');

        $updateCond = array(
            array('order_id','=',$order_id),
        );

        $data_array = array(
      			'invoice_date' => $invoice_date,
      			'payment_terms' => $payment_terms,
      			'due_date' => $due_date,
      			'invoice_status' => "Send",
      	);

      	$update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data_array);
        

	    //Invoice to client
		$invoice_email_data['service_logo_url'] = $service_logo_url;
		$invoice_email_data['service_provider_name'] = $service_provider_name;
		$invoice_email_data['service_provider_address'] = $service_provider_address;
		$invoice_email_data['service_provider_email'] = $service_provider_email;
		$invoice_email_data['service_provider_phone'] = $service_provider_phone;
		$invoice_email_data['order_id'] = $order_id;
		$invoice_email_data['invoice_date'] = $invoice_date;
		$invoice_email_data['payment_terms'] = $payment_terms;
		$invoice_email_data['due_date'] = $due_date;
		$invoice_email_data['client_email'] = $client_email;
		$invoice_email_data['service_name'] = $service_name;
		$invoice_email_data['appointemnt_qty'] = $appointemnt_qty;
		$invoice_email_data['currency'] = $currency;
		$invoice_email_data['unit_price'] = $unit_price;
		$invoice_email_data['total_price'] = $total_price;
		$invoice_email_data['tax'] = $tax;
		$invoice_email_data['note_to_recepent'] = $note_to_recepent;
		$invoice_email_data['subtotal_tax'] = $subtotal_tax;
		$invoice_email_data['total_amount'] = $total_amount;
		$invoice_email_data['email_subject'] = "Invoice";
		$send = $this->sendmail(21,$client_email,$invoice_email_data);

		return redirect(url('invoice/'))->with('success','Invoice successfully send.');

    }

    public function save_as_draft(Request $request)
    {
    	// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

        $service_logo_url = $request->input('service_name');
        $service_provider_name = $request->input('service_provider_name');
        $service_provider_address = $request->input('service_provider_address');
        $service_provider_email = $request->input('service_provider_email');
        $service_provider_phone = $request->input('service_provider_phone');
        $order_id = $request->input('invoive_no');
        $invoice_date = $request->input('invoice_date');
        $payment_terms = $request->input('payment_terms');
        $due_date = $request->input('due_date');
        $client_email = $request->input('client_name')[0];
        $service_name = $request->input('service_name');
        $appointemnt_qty = $request->input('quentity');
        $currency = $request->input('currency');
        $unit_price = $request->input('email_invoice_unit_price');
        $total_price = $request->input('email_invoice_total_price');
        $tax = $request->input('tax');
        $note_to_recepent = $request->input('note_to_receipent');
        $total_amount = $request->input('total_amount');
        $subtotal_tax = $request->input('subtotal_tax');

        $updateCond = array(
            array('order_id','=',$order_id),
        );

        $data_array = array(
      			'invoice_date' => $invoice_date,
      			'payment_terms' => $payment_terms,
      			'due_date' => $due_date,
      			'invoice_status' => "Draft",
      	);

      	$update = $this->common_model->update_data($this->tableObj->tableNameAppointment,$updateCond,$data_array);
        
		return redirect(url('invoice/'))->with('success','Invoice successfully save as draft.');

    }

	public function invoice()
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['page_no']=1;
		$data=array(
			//'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="invoice_booking_details";
		$return = $this->curl_call($url_func_name,$post_data);
		
		/*echo "<pre>";
		print_r($return->appoinment_details); 
		die();*/

		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$appoinmens = $return->appoinment_details;
			}

			/*$appoinmen_list = array();
			foreach ($variable as $key => $value)
			{
				$appoinmen_list[] = array();
			}*/

			$data['appoinmen_list'] = $appoinmens;
			//echo '<pre>'; print_r($data); exit;
			return view('website.payment.invoice')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.payment.create-invoice');
	}

	public function invoice_details($order_id=NULL)
	{
		// Check User Login. If not logged in redirect to login page //
		$authdata = $this->website_login_checked();
		if((empty($authdata['user_no']) || ($authdata['user_no']<=0)) || (empty($authdata['user_request_key']))){
			return redirect('/login');
		}

		// Call API //
		$post_data = $authdata;
		$post_data['order_id'] = $order_id;
		$post_data['page_no']=1;
		$data=array(
			//'service_list'=>array(),
			'authdata'=>$authdata
		);

		$url_func_name="invoice_booking_details";
		$return = $this->curl_call($url_func_name,$post_data);
		
		/*echo "<pre>";
		print_r($return->appoinment_details); 
		die();*/

		// Check response status. If success return data //		
		if(isset($return->response_status))
		{
			if($return->response_status == 1)
			{
				$appoinmens = $return->appoinment_details;
				$appoinment_details = $appoinmens[0];
				$data['service_name'] = $appoinment_details->service_name;
				if($appoinment_details->profile_image)
				{
					$profile_image = asset('public/image/profile_image').'/'.$appoinment_details->profile_image;
				}
				else
				{
					$profile_image = asset('public/assets/website/images/logo-invoice.png');
				}
				$data['profile_image'] = $profile_image;
				$data['invoive_no'] = $appoinment_details->order_id;
				$data['invoice_date'] = strtotime($appoinment_details->invoice_date)>0 ? date('Y-m-d', strtotime($appoinment_details->invoice_date)) : date('Y-m-d');
				$data['payment_terms'] = $appoinment_details->payment_terms;
				$data['due_date'] = strtotime($appoinment_details->due_date)>0 ? date('Y-m-d', strtotime($appoinment_details->due_date)) : date('Y-m-d');
				$data['client_name'] = $appoinment_details->client_name;
				$data['client_email'] = $appoinment_details->client_email;
				$data['qty'] = count($appoinmens);
				$unit_price = $appoinment_details->cost;
				$data['unit_price'] = $appoinment_details->currency.' '.$unit_price;
				$data['total_unit_price'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['sub_total'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['total'] = $appoinment_details->currency.' '.($unit_price*count($appoinmens));
				$data['note'] = $appoinment_details->note;
				$data['terms_condition'] = $appoinment_details->terms_condition;
				$data['service_provider_name'] = $appoinment_details->name;
				$data['service_provider_address'] = $appoinment_details->business_location;
				$data['service_provider_email'] = $appoinment_details->email;
				$data['service_provider_phone'] = $appoinment_details->mobile;
				$data['currency'] = $appoinment_details->currency;
				$data['email_invoice_unit_price'] = $unit_price;
				$data['email_invoice_total_price'] = $unit_price*count($appoinmens);
				$data['total_amount'] = $unit_price*count($appoinmens);
				$data['subtotal_tax'] = 0.00;

			}
			//echo '<pre>'; print_r($data); exit;
			return view('website.payment.invoice-details')->with($data);
		}
		else{
			return $return;
		}
		//return view('website.payment.create-invoice');
	}

}