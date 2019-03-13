@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Invoice List</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                    <!--  <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                     </span> -->
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <!-- <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Search by <img src="images/arrow.png" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">All</a></li>
                        <li><a href="#">Issued</a></li>
                        <li><a href="#">Pending</a></li>
                     </ul> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      @if(Session::has('success'))
         <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('success')}}</p>
        </div>
      
      @endif
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('payment-options') }}"> Payment Options</a></li>
               <li><a href="{{ url('invoice') }}" class="active"> Invoice </a> </li>
               <!-- <li><a href="{{ url('create-invoice')}}"> Create invoice <br>(Issued/Pending  Template)</a></li> -->
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class="headRow showDekstop clearfix">
               <div class="col-md-12 inv-list">
                  <table id="example" class="table table-striped" style="width:100%">
                     <thead>
                        <tr>
                           <th  style="text-align: left;">Date</th>
                           <th style="text-align: center;">Invoice Number</th>
                           <th style="text-align: center;">Recipient</th>
                           <th  style="text-align: center;">Status</th>
                           <th style="text-align: center;">Action</th>
                           <th  style="text-align: center;">Amount</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($appoinmen_list as $key => $value)
                        {
                        ?>
                        <tr>
                           <td align="left"><?=date('d M Y', strtotime($value->invoice_date));?></td>
                           <td align="center"><?=$value->order_id;?></td>
                           <td align="center"><?=$value->client_email;?></td>
                           <td align="center"><?=$value->invoice_status;?></td>
                           <td align="center"><a href="{{ url('invoice-details') }}/<?=$value->order_id;?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>
                           <td align="right"><?=$value->currency;?> <?=$value->total_payable_amount;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="custm-tab team-memtab">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#tabmenu1">Active</a></li>
               <li><a data-toggle="tab" href="#tabmenu2">Inactive</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
@endsection