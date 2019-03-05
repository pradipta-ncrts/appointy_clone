@extends('../layouts/website/master_template_web')

@section('title')

Squeedr

@endsection

@section('content')

<div class="body-part">

   <div class="container-custm">

      <div class="leftpan">

         <div class="left-menu">

            <ul>

               <li><a href="{{ url('profile-settings') }}" class="active"> Profile</a></li>

               <li><a href="{{ url('profile-picture') }}"> Picture</a> </li>

               <li><a href="{{ url('profile-link') }}"> My Link</a></li>

               <!--<li><a href="profile-services.html"> Services</a></li>-->

               <li><a href="{{ url('profile-payment') }}"> Payment Mode</a> </li>

               <li><a href="{{ url('profile-login') }}" > Login</a> </li>

            </ul>

         </div>

      </div>

      <div class="rightpan">

         <div class="btn-slide"> <img src="{{asset('public/assets/website/images/slide-butt-add.png')}}" /> </div>

         <div class="container-fluid">

            <div class="row">

               <div class="new-modalcustm">

                  <div class="clr-modalbdy profile-frm" style="padding:0 !important;width: 90%;">

                    <form action="{{ url('api/update-profile-settings') }}" method="post" id="update-profile-settings">
                    <input type="hidden" id="user_type" name="user_type" value="<?=$user_details->user_type;?>">
                        <div style="width:55%">

                          <div class="calen-txt">

                             Branding <img src="{{asset('public/assets/website/images/info-cross.png')}}" alt="" />

                             <button type="button" class="btn btn-sm btn-toggle pull-right <?=isset($user_details->branding) && $user_details->branding==1 ? 'active' : '';?>" id="branding" data-toggle="button" aria-pressed="true" autocomplete="hide">

                              

                                <div class="handle"></div>

                             </button>

                          </div>

                          <input type="hidden" id="profile_branding" name="branding" value="<?=$user_details->branding;?>">

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <label>Name <img src="{{asset('public/assets/website/images/info-cross.png')}}" alt="" /></label>

                                   <div class="input-group"> <span class="input-group-addon"></span>

                                      <input id="profile_name" type="text" class="form-control" name="profile_name" placeholder="Full Name" value="<?=isset($user_details->name) && $user_details->name ? $user_details->name : '';?>">

                                   </div>

                                </div>

                             </div>

                          </div>

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="profile_profession" id="profile_profession" >

                                    <option value="">Select Profession </option>

                                    <?php

                                    if(!empty($profession))

                                    {

                                        foreach ($profession as $key => $value)

                                        {

                                        ?>

                                            <option value="<?=$value->profession_id;?>" <?=isset($user_details->profession) && $user_details->profession ? "selected" : '';?>><?=$value->profession;?></option>

                                        <?php

                                        }

                                    }

                                    ?>

                                  </select>

                                </div>

                             </div>

                          </div>

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <label>Presentation </label>

                                   <div class="input-group" style="border:1px solid #ccc;border-radius:5px 0 0 5px;"> <span class="input-group-addon" style="border:0"></span>

                                      <textarea style="width: 100%;border:0;height: 100px;" id="presentation" name="presentation" placeholder="Presentation" ><?=isset($user_details->presentation) && $user_details->presentation ? $user_details->presentation : '';?></textarea>

                                   </div>

                                </div>

                             </div>

                          </div>

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <label>Expertise </label>

                                   <div class="input-group"> <span class="input-group-addon"></span>

                                      <input data-role="tagsinput" id="expertise" type="text" class="form-control" name="expertise" placeholder="Expertise" value="<?=isset($user_details->expertise) && $user_details->expertise ? $user_details->expertise : '';?>">

                                   </div>

                                </div>

                             </div>

                          </div>

                          <!-- <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <label>Language</label>

                                   <div class="input-group">

                                      <span class="input-group-addon"></span>

                                      <div class="form-group nomarging custom-select color-b" >

                                         <select >

                                            <option>Select Language </option>

                                         </select>

                                         <div class="clearfix"></div>

                                      </div>

                                   </div>

                                </div>

                             </div>

                          </div> 

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <label>Timezone <span class="pull-right">Current Time: 12pm</span> </label>

                                   <div class="input-group">

                                      <span class="input-group-addon"></span>

                                      <div class="form-group nomarging custom-select color-b" >

                                         <select >

                                            <option>Select Timezone </option>

                                         </select>

                                         <div class="clearfix"></div>

                                      </div>

                                   </div>

                                </div>

                             </div>

                          </div>-->

                          <div class="row">

                             <div class="col-md-12">

                                <div class="form-group">

                                   <input type="submit" class="btn btn-primary" name="Save Changes" value="Save Changes">

                                   <input type="reset" class="btn btn-default" name="cancel" value="cancel">

                                   <button type="button" id="delete-account" class="btn btn-default pull-right">Delete Account</button>

                                </div>

                             </div>

                          </div>

                       </div>

                    </form>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

@endsection