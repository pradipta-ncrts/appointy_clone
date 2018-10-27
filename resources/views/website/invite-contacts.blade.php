@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Invite Contacts</div>
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
               <li><a href="#" class="active">Import and Invite</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <form class="form-inline" action="{{ url('api/import-invite-contact') }}" method="post" autocomplete="off" id="import-invite-contact">
            <input type="hidden" name="discount_type" value="yes" id="discount_type">
            <div class="headRow nopadding">
               <h3>Attach an invite offer </h3>
               <p>You can invite customers with or without a discount, but customers are more likely to schedule a booking if they have an incentive.</p>
               <p class="note">Select the best discount that you can offer to your clients, or click on the link to invite customers to schedule without a discount offer.</p>
            </div>
            <div class="headRow cardin">
               <div class="form-group">
                  <label>Import Clients</label>
                  <!--<input type="text" class="form-control smallTextbox" />-->
                  <select class="form-control largeTextbox" name="discount" id="discount">
                     <option value="">Select Discount</option>
                     <?php
                     for ($i=1; $i < 51; $i++)
                     { 
                     ?>
                     <option value="<?=$i;?>"><?=$i. '%';?></option>
                     <?php
                     }
                     ?>
                  </select>
                  <label>discount</label>
               </div>
               <div class="clearfix"></div>
               <div class="break20px"></div>
               <h3>Import your existing contacts</h3>
               <div class="form-group">
                  <input type="file" class="form-control largeTextbox" name="contacts_excel_file" id="contacts_excel_file" />
                  <p class="note break10px">You can upload a CSV file of your customers to import them. These customers will then be shown in Customer Tab Section.</p>
               </div>
               <div class="clearfix"></div>
               <div class="break20px"></div>
                  <div class="btnGrp"> 
                     <input type="submit" value="Invite with a discount" class="btn btn-primary btn-sm" id="invite_with_dicount">
                  <label class="btn">Or</label>
                     <input type="submit" value="Invite without a discount" class="btn btn-success btn-sm" id="invite_without_dicount">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection