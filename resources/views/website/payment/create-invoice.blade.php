@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
 <div class="body-part">
   <div class="container-custm">
      <form class="form-horizontal" action="{{ url('send_invoice') }}" id="invoive-form" method="post">
         <input type="hidden" name="service_provider_name" value="<?=$service_provider_name;?>">
         <input type="hidden" name="service_provider_address" value="<?=$service_provider_address;?>">
         <input type="hidden" name="service_provider_email" value="<?=$service_provider_email;?>">
         <input type="hidden" name="service_provider_phone" value="<?=$service_provider_phone;?>">
         <input type="hidden" name="currency" value="<?=$currency;?>">
         <input type="hidden" name="unit_price" value="<?=$email_invoice_unit_price;?>">
         <input type="hidden" name="email_invoice_total_price" value="<?=$email_invoice_total_price;?>">
         <input type="hidden" name="total_amount" value="<?=$total_amount;?>">
         <input type="hidden" name="subtotal_tax" value="<?=$subtotal_tax;?>">
         
         <div class="upper-cmnsection">
            <div class="heading-uprlft"> Create Invoice</div>
            <div class="upr-rgtsec">
               <div class="col-md-5">
               </div>
               <div class="col-md-7">
                  <div class="full-rgt" style="margin-bottom: 8px;">
                     <a class="btn btn-primary ">Preview</a>
                     <a href="" class="btn btn-default" id="send_invoice">Send</a>
                     <a class="btn btn-default ">Save as daft</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="leftpan">
            <div class="left-menu">
               <ul>
				<!-- <li><a href="{{ url('payment-options') }}"> Payment Options</a></li> -->
				<li><a href="{{ url('invoice') }}"> Invoice </a> </li>
				<!-- <li><a href="{{ url('create-invoice')}}"  class="active"> Create invoice <br>(Issued/Pending  Template)</a></li> -->
               </ul>
            </div>
         </div>
         <div class="rightpan">
            <div class="relativePostion">
               <div class="col-sm-7">
                  <div class="temp">
                     <h3>Service Name </h3>
                     <div class="form-group nomarging  color-b" >
                        <select name="service_name">
                           <option value="<?=$service_name;?>"><?=$service_name;?> </option>
                        </select>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <div class="add-logo">
                     <img src="<?=$profile_image;?>"><br>
                     <input type="hidden" name="invoice_logo" value="<?=$profile_image;?>">
                     <span>Upload Logo</span>
                  </div>
                  <div class="flex bus-info">
                     <!-- <a href="#" class="fa fa-plus-square-o"></a> -->  
                     <h3 class="nomarging">Your Business Information </h3>
                     <a href="{{ url('business-contact-info') }}">Edit</a>
                  </div>
               </div>
               <div class="col-sm-5">
                  <table class="cr-inv-inf">
                     <tr>
                        <td align="right">Invoice No.</td>
                        <td><input type="text" name="invoive_no" value="<?=$invoive_no;?>" readonly></td>
                        <td class="nopadding"><i class="fa fa-info-circle"></i></td>
                     </tr>
                     <tr>
                        <td align="right">Invoice Date</td>
                        <td><input type="text" name="invoice_date" value="<?=$invoice_date;?>" readonly ></td>
                        <td  class="nopadding"><i class="fa fa-info-circle"></i></td>
                     </tr>
                     <tr>
                        <td align="right">Reference Type</td>
                           <td>
                              <div class="form-group nomarging  color-b" >
                                 <select name="payment_terms" class="payment_terms">
                                    <option value="Due on recive"> Due on recive </option>
                                    <option value="Due on date"> Due on date </option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </td>
                        <td  class="nopadding"></td>
                     </tr>
                     <tr>
                        <td align="right">Due Date</td>
                        <td><input type="text" id="due_date" name="due_date" value="<?=$due_date;?>"></td>
                        <td class="nopadding"></td>
                     </tr>
                  </table>
               </div>
               <div class="clearfix"></div>
               <hr>
               <div class="bil-to row">
                  <div class="col-md-6">
                     <table class="add-more-client">
                        <tr>
                           <td>Bill to</td>
                           <td><input type="text" name="client_name[]" value="<?=$client_name;?>" readonly></td>
                        </tr>
                        <tr>
                           <td>Cc</td>
                           <td><input type="text" name="client_email[]" value="<?=$client_email;?>" readonly></td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-md-6 bill-muilty">                                
                     <a href="" class="create-add-more"> <i class="fa fa-plus"></i> Bill multiple customers </a>
                     <i class="fa fa-info-circle"></i>
                  </div>
               </div>

               <div class="col-md-12 crinv-item">
                  <table>
                     <tr>
                        <th style=" width:52%;">Description</th>
                        <th style=" width:12%; text-align:center">Quantity</th>
                        <th style=" width:12%; text-align:center">Price</th>
                        <th style=" width:12%; text-align:center">Tax</th>
                        <th style=" width:12%; text-align:center">Amount</th>
                     </tr>
                     <tr>
                        <td style=" width:52%;"><input type="text" value="<?=$service_name;?>" name="service_name" readonly></td>
                        <td style=" width:12%; text-align:center"><input type="text" name="quentity" value="<?=$qty;?>" readonly></td>
                        <td  style="width:12%; text-align:right"><input type="text" class="text-right" name="unit_price" value="<?=$unit_price;?>" readonly></td>
                        <td style="width:12%; text-align:right">
                           <select name="tax">
                              <option value="0"> 0 % </option>
                           </select>
                        </td>
                        <td width="12%" style="text-align:right"><input type="text" class="text-right" name="total_unit_price" value="<?=$total_unit_price;?>" readonly></td>
                     </tr>
                     <tr>
                        <td style=" width:100%; " colspan="4">
                           <textarea rows="2" style=" width:100%;" name="invoice_description" placeholder="Enter detailed description (optional)" readonly><?=$note;?></textarea>
                        </td>
                     </tr>
                  </table>
                  <!-- <a href="#" class="fa fa-trash-o"></a> -->
               </div>
               <div class="clearfix"></div>
               <!-- <div class="flex add-item">
                  <a href="#" class="fa fa-plus"></a>  
                  <a class="nomarging">Add another Item</a>  
               </div> -->
               <div class="clearfix"></div>
               <hr>
               <div class="sub-inv">
                  <table>
                     <tr>
                        <td style=" width:70%; text-align: right">Subtotal</td>
                        <td style=" width:30%; text-align:center"><input type="text" class="text-right" name="sub_total" value="<?=$sub_total;?>" readonly></td>
                     </tr>
                     <tr>
                        <td style=" width:70%; text-align: right">
                           <table>
                              <tr>
                                 <td>Discount</td>
                                 <td><input type="text" style=" width:150px;" placeholder="0" name="discount"></td>
                                 <td>
                                    <select name="discount_percent">
                                       <option> % </option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td style=" width:30%; text-align:center"><input type="text" class="text-right" placeholder="0.00" name="discount_price"></td>
                     </tr>
                 
                     <tr>
                        <td style=" width:70%; text-align: right; font-weight: 400">Total</td>
                        <td style=" width:30%; text-align:center"><input type="text" style="font-weight: 400" class="text-right" name="total" value="<?=$total;?>" readonly></td>
                     </tr>
                  </table>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="note-rec">
                        <h3>Note to Receipent</h3>
                        <textarea rows="3"  style=" width:100%;" placeholder="Such as Thank you for your business" name="note_to_receipent"></textarea>
                        <span>4000</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="note-rec">
                        <h3>Terms and Conditions</h3>
                        <textarea rows="3"  style=" width:100%;" name="terms_condition" readonly><?=$terms_condition;?></textarea>
                        <span><?php echo 4000-strlen($terms_condition);?></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
$('.create-add-more').on('click', function(e){
   e.preventDefault();
   var html = '<div class="bil-to row"><div class="col-md-6"><table class="add-more-client"><tr><td>Bill to</td><td><input type="text" name="client_name[]"></td></tr><tr><td>Cc</td><td><input type="text" name="client_email[]"></td></tr></table></div><div class="col-md-6 bill-muilty"><a href="" class="remove-add-more"> <i class="fa fa-trash-o"></i> </a></div></div>';
   $('.bil-to').last().after(html);
});

$(document).on("click", '.remove-add-more', function(e) { 
  e.preventDefault();
  $(this).parent().parent().remove();  
});

$('#send_invoice').on('click', function(e){
   e.preventDefault();
   $("#invoive-form").submit();
});


</script>
@endsection