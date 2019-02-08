@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
         <div class="container-custm">
            <div class="upper-cmnsection">
               <div class="heading-uprlft">Invoice</div>
               <div class="upr-rgtsec">
                  <div class="col-md-5">
                  </div>
                  <div class="col-md-7">
                  </div>
               </div>
            </div>
            <div class="leftpan">
               <div class="left-menu">
                  <ul>
                     <li>
                        <a href="{{ url('payment-options') }}"> Payment Options</a>
                     </li>
                     <li>
                        <a href="{{ url('invoice') }}"> Invoice </a>
                     </li>
                     <li>
                        <a href="{{ url('create-invoice') }}"> Create invoice <br>(Issued/Pending Template)</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="rightpan">
               <div class="relativePostion">
                  <div class="headRow showDekstop clearfix">
                     <div class="col-md-12 inv-det">
                        <div class="col-sm-5 bill-to">
                           <img src="{{asset('public/assets/website/images/logo-invoice.png')}}">
                           <h2>Jhon Doe</h2>
                           <p>
                              8 Elm Street
                              <br> Cambridge, CB1 4DH
                              <br> United Kingdom
                              <br>
                              <br> Phone : 222 158 2552 <br>
                              Email : johndoe@gmail.com
                              <br><br>
                           <h2>Bill To</h2>
                           johndoe@gmail.com
                           </p>
                        </div>
                        <div class="col-sm-7 inv-dtil">
                           <h1>INVOICE</h1>
                           <table>
                              <tr>
                                 <th>Invoice No.</th>
                                 <td>0001</td>
                              </tr>
                              <tr>
                                 <th>Invoice Date</th>
                                 <td>28/07/2018</td>
                              </tr>
                              <tr>
                                 <th>Payment Terms</th>
                                 <td>Due on Receipt</td>
                              </tr>
                              <tr>
                                 <th>Due Date</th>
                                 <td>28/07/2018</td>
                              </tr>
                           </table>
                        </div>
                        <div class="col-sm-12 inv-bal">
                           <table width="100%">
                              <tr>
                                 <th width="55%">Description</th>
                                 <th width="15%" style="text-align: center">Quantity</th>
                                 <th width="15%"  style="text-align: right">Unit Price</th>
                                 <th width="15%"  style="text-align: right">Amount</th>
                              </tr>
                              <tr>
                                 <td>Test Product</td>
                                 <td style="text-align: center">1</td>
                                 <td style="text-align: right">$215.00</td>
                                 <td style="text-align: right">$215.00</td>
                              </tr>
                           </table>
                           <hr>
                           <table width="100%">
                              <tr>
                                 <td width="55%"><strong>Note to Receipient(s)</strong><br> Thansk for you business</td>
                                 <td width="15%" style="text-align: right"><strong>Subtotal</strong> <br> Tax (8.6%)</td>
                                 <td width="15%" style="text-align: right"></td>
                                 <td width="15%" style="text-align: right">$215.00 <br> $18.49</td>
                              </tr>
                              <tr>
                                 <th width="55%"></th>
                                 <th width="15%" style="text-align: right"><strong>Total</strong></th>
                                 <th width="15%" style="text-align: right"></th>
                                 <th width="15%" style="text-align: right"><strong>$233.49</strong></th>
                              </tr>
                           </table>
                           <a class="btn btn-primary break20px">Pay Invoice</a>
                           <a class="btn btn-default break20px">Print</a>
                           <a class="btn btn-primary break20px pull-right">Download</a>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <div class="custm-tab team-memtab">
                     <ul class="nav nav-tabs">
                        <li class="active">
                           <a data-toggle="tab" href="#tabmenu1">Active</a>
                        </li>
                        <li>
                           <a data-toggle="tab" href="#tabmenu2">Inactive</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection