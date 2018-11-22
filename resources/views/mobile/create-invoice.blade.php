@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
 <div class="body-part">
         <div class="container-custm">
            <div class="upper-cmnsection">
               <div class="heading-uprlft"> Create Invoice</div>
               <div class="upr-rgtsec">
                  <div class="col-md-5">
                  </div>
                  <div class="col-md-7">
                     <div class="full-rgt" style="margin-bottom: 8px;">
                        <a class="btn btn-primary ">Preview</a>
                        <a class="btn btn-default ">Send</a>
                        <a class="btn btn-default ">Save as daft</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="leftpan">
               <div class="left-menu">
                  <ul>
					<li><a href="{{ url('payment-options') }}"> Payment Options</a></li>
					<li><a href="{{ url('invoice') }}"> Invoice </a> </li>
					<li><a href="{{ url('create-invoice')}}"  class="active"> Create invoice <br>(Issued/Pending  Template)</a></li>
                  </ul>
               </div>
            </div>
            <div class="rightpan">
               <div class="relativePostion">
                  <div class="col-sm-7">
                     <form class="form-horizontal" action="/action_page.php">
                        <div class="temp">
                           <h3>My templates </h3>
                           <div class="form-group nomarging custom-select color-b" >
                              <select >
                                 <option>Invoice for quality (default) </option>
                              </select>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </form>
                     <div class="add-logo">
                        <img src="{{asset('public/assets/website/images/picture.png')}}"><br>
                        <span>Upload Logo</span>
                     </div>
                     <div class="flex bus-info">
                        <a href="#" class="fa fa-plus-square-o"></a>  
                        <h3 class="nomarging">Your Business Information </h3>
                        <a href="#">Edit</a>
                     </div>
                  </div>
                  <div class="col-sm-5">
                     <form class="form-horizontal" action="/action_page.php">
                        <table class="cr-inv-inf">
                           <tr>
                              <td align="right">Invoice No.</td>
                              <td><input type="text" value="0003"></td>
                              <td class="nopadding"><i class="fa fa-info-circle"></i></td>
                           </tr>
                           <tr>
                              <td align="right">Invoice Date</td>
                              <td><input type="text" value="02/08/2018"></td>
                              <td  class="nopadding"><i class="fa fa-info-circle"></i></td>
                           </tr>
                           <tr>
                              <td align="right">Reference</td>
                              <td><input type="text" placeholder="Such as PO#"></td>
                              <td  class="nopadding"></td>
                           </tr>
                           <tr>
                              <td align="right">Due Date</td>
                              <td>
                                 <div class="form-group nomarging custom-select color-b" >
                                    <select >
                                       <option> Due on receipt </option>
                                    </select>
                                    <div class="clearfix"></div>
                                 </div>
                              </td>
                              <td class="nopadding"></td>
                           </tr>
                        </table>
                     </form>
                  </div>
                  <div class="clearfix"></div>
                  <hr>
                  <div class="bil-to row">
                     <div class="col-md-6">
                        <table>
                           <tr>
                              <td>Bill to</td>
                              <td><input type="text" placeholder="Enter address or name"></td>
                           </tr>
                           <tr>
                              <td>Cc</td>
                              <td><input type="text" placeholder="Enter address"></td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-6 bill-muilty">                                
                        <a href="#"> <i class="fa fa-plus"></i> Bill multiple customers </a>
                        <i class="fa fa-info-circle"></i>
                     </div>
                  </div>
                  <div class="col-md-12 customize">
                     <table>
                        <tr>
                           <td>Customize</td>
                           <td>
                              <div class="form-group nomarging custom-select color-b" >
                                 <select >
                                    <option> Quantity </option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group nomarging custom-select color-b" >
                                 <select >
                                    <option> Add/Remove detail </option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </td>
                           <td>
                              <div class="form-group nomarging custom-select color-b" >
                                 <select >
                                    <option> EUR-Euros </option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </td>
                        </tr>
                     </table>
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
                           <td style=" width:52%;"><input type="text" placeholder="Item Name"></td>
                           <td style=" width:12%; text-align:center"><input type="text" placeholder="1"></td>
                           <td  style="width:12%; text-align:right"><input type="text" class="text-right" placeholder="0.00"></td>
                           <td style="width:12%; text-align:right">
                              <select >
                                 <option> Due on receipt </option>
                              </select>
                           </td>
                           <td width="12%" style="text-align:right"><input type="text" class="text-right" placeholder="0.00"></td>
                        </tr>
                        <tr>
                           <td style=" width:100%; " colspan="4">
                              <textarea rows="2"  style=" width:100%;">Enter detailed description (optional)
                              </textarea>
                           </td>
                        </tr>
                     </table>
                     <a href="#" class="fa fa-trash-o"></a>
                  </div>
                  <div class="clearfix"></div>
                  <div class="flex add-item">
                     <a href="#" class="fa fa-plus"></a>  
                     <a class="nomarging">Add another Item</a>  
                  </div>
                  <div class="clearfix"></div>
                  <hr>
                  <div class="sub-inv">
                     <table>
                        <tr>
                           <td style=" width:70%; text-align: right">Subtotal</td>
                           <td style=" width:30%; text-align:center"><input type="text" class="text-right" placeholder="0.00"></td>
                        </tr>
                        <tr>
                           <td style=" width:70%; text-align: right">
                              <table>
                                 <tr>
                                    <td>Discount</td>
                                    <td><input type="text" style=" width:150px;" placeholder="0"></td>
                                    <td>
                                       <select >
                                          <option> % </option>
                                       </select>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td style=" width:30%; text-align:center"><input type="text" class="text-right" placeholder="0.00"></td>
                        </tr>
                        <tr>
                           <td style=" width:70%; text-align: right">
                              <table>
                                 <tr>
                                    <td>Shipping</td>
                                    <td><input style=" width:220px;" type="text" placeholder=""></td>
                                 </tr>
                              </table>
                           </td>
                           <td style=" width:30%; text-align:center"><input type="text" class="text-right" placeholder="0.00"></td>
                        </tr>
                        <tr>
                           <td style=" width:70%; text-align: right; font-weight: 400">Total</td>
                           <td style=" width:30%; text-align:center"><input type="text" style="font-weight: 400" class="text-right" placeholder="0.00"></td>
                        </tr>
                     </table>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="note-rec">
                           <h3>Note to Receipent</h3>
                           <textarea rows="3"  style=" width:100%;">Such as "Thank you for your business"

                                            </textarea>
                           <span>4000</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="note-rec">
                           <h3>Terms and Conditions</h3>
                           <textarea rows="3"  style=" width:100%;">Such as "Thank you for your business"

                                                </textarea>
                           <span>4000</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection