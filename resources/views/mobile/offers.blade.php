@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
<div class="container-custm">
<div class="upper-cmnsection">
   <div class="heading-uprlft">Marketing</div>
   <div class="upr-rgtsec">
      <div class="col-sm-5">
         <div id="custom-search-input">
            <div class="input-group col-md-12">
               <input type="text" class="  search-query form-control" placeholder="Search" />
               <span class="input-group-btn">
               <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
               </span> 
            </div>
         </div>
      </div>
      <div class="col-md-7">
         <div class="full-rgt">
            <div class="dropdown custm-uperdrop">
               <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="images/arrow.png" alt=""/></button>
               <ul class="dropdown-menu">
                  <li><a href="#">JAN</a></li>
                  <li><a href="#">FEB</a></li>
                  <li><a href="#">MARCH</a></li>
               </ul>
            </div>
            <div class="filter-option"><a href="#">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
         </div>
      </div>
   </div>
</div>
<div class="leftpan">
   <div class="left-menu">
      <ul>
         <li><a href="{{ url('gift-certificates') }}"> Gift As a Gift</a></li>
         <li><a href="{{ url('marketing-discount-coupons') }}"> Discount Coupons</a> </li>
         <li><a href="{{ url('offers') }}" class="active"> Offers</a></li>
      </ul>
   </div>
</div>
<div class="rightpan">
   <div class="discount-box">
      <a class="btn cus-discount-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>  Offer </a>
      <h2>Offers</h2>
      <p>Instead of giving a discount on the price, you can offer extra services as an add-on. For example, you can offer "100% Free Delivery" or "Free Welcome Drink". It works like discount coupons and is only applicable to customers using the offer code while booking an appointment. Like "Discount Coupons", these can also be promoted on Facebook, Twitter or via Email. </p>
      <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#all">All</a></li>
         <li><a data-toggle="tab" href="#active">Active</a></li>
         <li><a data-toggle="tab" href="#inactive">Inactive</a></li>
         <li><a data-toggle="tab" href="#expired">Expired</a></li>
      </ul>
      <div class="tab-content">
         <div id="all" class="tab-pane fade in active">
            <div class="discount-innertabbx">
               <p><i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                  No Offer
               </p>
            </div>
         </div>
         <div id="active" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Some content in menu 1.</p>
         </div>
         <div id="inactive" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
         </div>
         <div id="expired" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 3.</p>
         </div>
      </div>
   </div>
</div>

<!--=========================Modal area start=========================-->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content new-modalcustm">
         <div class="modal-body clr-modalbdy bg-grey">
            <div class="col-md-6 px-0">
               <div class="discount-coupon">
                  <div class="modal-title0">
                     <h2>Discount Coupon</h2>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="input-group"> <span class="input-group-addon"><img src="{{asset('public/assets/website/images/dollar-coins.png')}}" alt="" /></span>
                              <input id="name" type="text" class="form-control" name="name" placeholder="Discount">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><img src="{{asset('public/assets/website/images/percentage.png')}}" alt="" height="10"/></span>
                              <div class="form-group nomarging custom-select color-b" >
                                 <select>
                                    <option>Discount Type</option>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 border-dashed-bottom">
                     <span class="discount-txt">TERMS AND CONDITIONS</span>
                     <span class="discount-edit"><a href="javascript:void(0)"> &nbsp; Edit</a></span>
                  </div>
                  <div class="col-xs-12">
                     <ol class="app-settings__help-text">
                        <li>% off  at 1home</li>
                        <li>Applies to all services by any staff.</li>
                        <li> Works on any week day 
                        </li>
                     </ol>
                  </div>
                  <div class="discount-btnbx">
                     <button type="button" class="btn btn-primary">Create</button>
                  </div>
               </div>
            </div>
            <div class="col-md-6 pl-0 px-0">
               <button type="button" class="close preview-clsbtn" data-dismiss="modal">&times;</button>
               <div class="preview">
                  <div class="modal-title1">
                     <h2>Preview</h2>
                  </div>
                  <div class="preview-cupnmain">
                     <div class="preview-cupnbx">
                        <div class="preview-persentage">-%</div>
                        <div class="preview-innertxt">
                           Use Coupon Code<br>
                           <span>dmim145</span>
                        </div>
                        <div class="preview-innertxt1">
                           Applies to all services<br>
                           <span>Works on any week day</span> 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--=========================Modal area end===========================-->
@endsection