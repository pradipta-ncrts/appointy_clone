@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<style type="text/css">
   .namedate {
   border-radius: 5px;
   color: #fff;
   font-size: 17px;
   display: flex;
   justify-content: space-between;
   margin-bottom: 10px;padding: 8px 10px;background: #5da7d4;
   }
   .border-box {
   border: 1px solid #ccc;
   border-radius: 5px;
   padding: 15px 0;
   margin-bottom: 10px;
   }
   .whitebox {
   background: #fff;
   position: relative;
   padding: 10px;
   position: relative;
   margin-bottom: 10px;
   }
   .staffDetail {
   padding: 0 10px 10px;
   margin-bottom: 12px;
   border-bottom: 1px solid #cac8c8;
   display: flex;
   justify-content: space-between;
   font-size: 14px;
   }
   .staffDetail p {
   color: #0645a3;
   font-weight: bold;
   }
   .staffDetail span.bluetxt {
   color: #5da7d4;
   }
   .staffInside {
   padding: 0 10px;
   }
   .staffInside h6 {
   padding-bottom: 10px;
   font-size: 16px;
   }
   .staffInside p {
   color: #000;
   font-size: 14px;
   line-height: 21px;
   }
   .addReadMore.showlesscontent .SecSec,
   .addReadMore.showlesscontent .readLess {
   display: none;
   }
   .addReadMore.showmorecontent .readMore {
   display: none;
   }
   .addReadMore .readMore,
   .addReadMore .readLess {
   margin-left: 2px;
   color: blue;
   cursor: pointer;
   }
   .addReadMoreWrapTxt.showmorecontent .SecSec,
   .addReadMoreWrapTxt.showmorecontent .readLess {
   display: block;
   }
</style>
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking List</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <input type="text" class="  search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span> 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="" class="active"> Current</a></li>
               <li><a href=""> Next 3 Days</a> </li>
               <li><a href=""> Last 1 Month</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class=" showDekstop clearfix">
               <div id="filter_data">
                  <div class="bluebg namedate">
                     <span>Thursday, Jan 17, 2019</span>
                     <span>Soumi </span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> john</span>
                        <p>12:00 PM - 12:15 PM</p>
                        <span class="bluetxt">INR100</span>
                     </div>
                     <div class="staffInside">
                        <h6>Test New Service</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Thursday, Dec 20, 2018</span>
                     <span>QA</span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> Dr Gladden</span>
                        <p>1:00 PM - 01:15 PM</p>
                        <span class="bluetxt">INR13</span>
                     </div>
                     <div class="staffInside">
                        <h6>Health Checkup</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes  </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Monday, Dec 10, 2018</span>
                     <span>Tom Smith</span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> john</span>
                        <p>6:10 AM - 06:25 AM</p>
                        <span class="bluetxt">INR100</span>
                     </div>
                     <div class="staffInside">
                        <h6>Test New Service</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Monday, Dec 10, 2018</span>
                     <span>Soumi </span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> Dr Gladden</span>
                        <p>12:00 PM - 12:15 PM</p>
                        <span class="bluetxt">INR20</span>
                     </div>
                     <div class="staffInside">
                        <h6>Service Name 123</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test notes </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Thursday, Jan 10, 2019</span>
                     <span>Soumi </span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> Dr Gladden</span>
                        <p>12:15 PM - 12:30 PM</p>
                        <span class="bluetxt">INR100</span>
                     </div>
                     <div class="staffInside">
                        <h6>Test New Service</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Friday, Jan 11, 2019</span>
                     <span>Soumi </span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> Dr Gladden</span>
                        <p>12:15 PM - 12:30 PM</p>
                        <span class="bluetxt">INR20</span>
                     </div>
                     <div class="staffInside">
                        <h6>Service Name 123</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test </p>
                     </div>
                  </div>
                  <div class="bluebg break20px namedate">
                     <span>Monday, Dec 31, 2018</span>
                     <span>Souvik Boke</span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> john</span>
                        <p>12:00 PM - 12:15 PM</p>
                        <span class="bluetxt">INR100</span>
                     </div>
                     <div class="staffInside">
                        <h6>Test New Service</h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes test notes  </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_js')

@endsection