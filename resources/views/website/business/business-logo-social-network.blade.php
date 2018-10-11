@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Business Details</div>
         <div class="upr-rgtsec">
            &nbsp;
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{ url('business-contact-info') }}" > Business Contact Info.</a></li>
               <li><a href="{{ url('business-logo-social-network') }}" class="active"> Business Logo & Social Info.</a> </li>
            </ul>
         </div>
      </div>
   
      <div class="rightpan">
         <div class="col-lg-12">
            <form action="{{ url('api/update-logo-social') }}" method="post" id="update-social-logo">
               <div class="headRow">
                  <div class=" clearfix">
                     <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                           <div class="form-details">
                              <a href="" id="profile-image-remove" <?=$userDetails->profile_image ? '' : 'style="display: none;"'; ?>><i class="fa fa-close"></i></a>
                              <div class="upload-logo" id="profile-image-upload">
                                 <?php
                                 $image = $userDetails->profile_image ? 'image/profile_image/'.$userDetails->profile_image : "assets/website/images/picture.png";
                                 ?>
                                 <img id="image_upload_preview" src="{{asset('public/'.$image)}}" height="60px" width="80px"><br>
                                 <span>Upload Business Logo</span>
                              </div>
                              
                              
                              <!-- <div class="upload-logo">
                                 <img src="{{asset('public/assets/website/images/picture.png')}}"><br>
                                 <span>Upload Other Photos</span>
                              </div> -->
                           </div>
                        </div>
                        <input accept="image/*" type="file" id="profile-image" name="profile_image" style="display: none;">
                        <input type="hidden" name="old_profile_image" id="old_profile_image" value="<?=$userDetails->profile_image?>">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                           <div class="form-details">
                              <label for="Phone">Facebook Link</label>
                              <input class="form-control" type="text" placeholder="Facebook Link" name="facebook_link" value="<?=$userDetails->facebook_link ? $userDetails->facebook_link : "";?>" />
                              <label for="Phone">Twitter Link</label>
                              <input class="form-control" type="text" placeholder="Twitter Link" name="twitter_link" value="<?=$userDetails->twitter_link ? $userDetails->twitter_link : "";?>" />
                              <label for="Phone">Linked IN Link</label>
                              <input class="form-control" type="text" placeholder="Linked IN Link" name="linked_in_link" value="<?=$userDetails->linked_in_link ? $userDetails->linked_in_link : "";?>" />
                              <label for="Phone">User Website Link</label>
                              <input class="form-control" type="text" placeholder="User Website Link" name="user_wesite_link" value="<?=$userDetails->user_wesite_link ? $userDetails->user_wesite_link : "";?>" />
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <button type="submit" id="business-logo-social-info-update" class="btn btn-primary butt-next" style="margin: 30px auto 0; width: 150px; display: block">Update</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div id="popup">
   <div id="selectstaff">
      <div class="container-fluid">
         <div class="popupInside">
            <h3>Select Staff</h3>
            <ul>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/blue-user.png')}}"/>
                  <label>Douglas N</label>
                  </a> 
               </li>
               <li><a onclick="staffcheck(this)"><img src="{{asset('public/assets/website/images/business-hours/grey-user.png')}}"/>
                  <label>Janice D</label>
                  </a> 
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!-- <div style="display: none;">
   <form action="" method="" enctype="multipart/form-data">
      <input type="file" id="profile-image" name="profile_image">
   </form>
</div> -->
@endsection