@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Profile</h1>
   <ul>
    &nbsp;
      <!-- <li><img src="images/mobile-notes.png" /></li>
      <li><img src="images/mobile-calender.png" /></li> -->
   </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row showDekstop">
         <!--Edited by Sandip - Start--> 
         <!--Edited by Sandip - End--> 
      </div>
      <div class="row showMobile break20px">
         <div class="col-xs-12">
            <div class="whitebox profileMobile profileMobileHeading">
               <div class="profileImg"> <img src="{{asset('public/assets/mobile/images/profilePic.png')}}" /> </div>
               <div class="profileDetails">
                  <h1>Dr. Esther Gladden</h1>
                  <span>Psychiatrist</span> <span>Time Zone - Kolkata,WB, India</span> 
               </div>
               <!--<a class="share"><i class="fa fa-share-alt"></i> </a> -->
               <div class="share-cusbtn" >
                  <a onclick="myFunction()" class="cusbtn-style"><i class="fa fa-share" aria-hidden="true"></i></a> 
               </div>
               <div id="openbox">
                  <ul>
                     <li><a><i class="fa fa-user-plus" aria-hidden="true"></i> Invite</a></li>
                     <li><a><i class="fa fa-share-alt" aria-hidden="true"></i> Share </a></li>
                  </ul>
               </div>
            </div>
            <div class="profile-mobaccordion">
               <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                              <div class="profileheading">
                                 <img src="{{asset('public/assets/mobile/images/profile-icon-service.png')}}" />
                                 <h4>Services</h4>
                                 <i class="fa fa-angle-down"></i>
                              </div>
                           </a>
                        </h4>
                     </div>
                     <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="headRow  mobileappointed clearfix" id="row2" >
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Dental Consultation</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);" class="active"> <i class="fa fa-toggle-on"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                              <div class="profileheading">
                                 <img src="{{asset('public/assets/mobile/images/profile-icon-packs.png')}}" />
                                 <h4>Packs</h4>
                                 <i class="fa fa-angle-down"></i>
                              </div>
                           </a>
                        </h4>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="headRow  mobileappointed clearfix" id="row2" >
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Dental Consultation</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);" class="active"> <i class="fa fa-toggle-on"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                              <div class="profileheading">
                                 <img src="{{asset('public/assets/mobile/images/profile-icon-resources.png')}}" />
                                 <h4>Resources</h4>
                                 <i class="fa fa-angle-down"></i>
                              </div>
                           </a>
                        </h4>
                     </div>
                     <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="headRow  mobileappointed clearfix" id="row2" >
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Dental Consultation</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);" class="active"> <i class="fa fa-toggle-on"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                              <div class="profileheading">
                                 <img src="{{asset('public/assets/mobile/images/profile-icon-meeting.png')}}" />
                                 <h4>Meetings</h4>
                                 <i class="fa fa-angle-down"></i>
                              </div>
                           </a>
                        </h4>
                     </div>
                     <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="headRow  mobileappointed clearfix" id="row2" >
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Dental Consultation</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);" class="active"> <i class="fa fa-toggle-on"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                              <div class="appointment mobSevices nomarginbottommobile">
                                 <div class="pull-left">
                                    <p>Smile corrections</p>
                                    <span>30min-1h
                                    <label>$50</label>
                                    </span> 
                                 </div>
                                 <ul class="pull-right">
                                    <li onclick="showUl(this);">
                                       <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a>
                                       <ul>
                                          <li><a><i class="fa fa-edit"></i> Edit </a> </li>
                                          <li><a><i class="fa fa-copy"></i> Copy Link </a> </li>
                                          <li><a><i class="fa fa-clone"></i> Clone </a> </li>
                                          <li><a><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                                          <li><a><i class="fa fa-code"></i> Embed </a> </li>
                                          <li><a><i class="fa fa-trash"></i> Delete </a> </li>
                                       </ul>
                                    </li>
                                    <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i> </a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="whitebox expertise clearfix">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/expertise.png')}}" />
                  <h4>Expertise</h4>
               </div>
               <ul>
                  <li>Addiction, addiction and alcoholism</li>
                  <li>Sleep medicine</li>
                  <li>Sleep disorder</li>
                  <li>Hyperactivity - Inhibition</li>
               </ul>
               <a class="pull-right more">More</a> 
            </div>
            <div class="whitebox pt">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/presentation.png')}}" />
                  <h4>Presentation</h4>
               </div>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ad quorum et cognitionem et usum iam corroborati natura ipsa praeeunte deducimur. Nunc ita separantur, ut disiuncta more </p>
            </div>
            <div class="whitebox map">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/map.png')}}" />
                  <h4>Map and access Information</h4>
               </div>
               <div class="mapcontent">
                  <div class="mapleft">
                     <h5>Smile Corrections</h5>
                     <img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}" class="map">
                     <label>Lauren Drive, Madison, WI 53705 </label>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <h6>Transport</h6>
                     <span>Grenelle 2 (surface)</span> <span>Lauren Drive, Madision, WI 53705</span>
                     <div class="clearfix"></div>
                     <div class="break10px"></div>
                     <h6>Useful Information</h6>
                     <span>Grenelle 2 (surface)</span> <span>Ground floor, Handicap access</span> 
                  </div>
                  <div class="mapright"> <img src="{{asset('public/assets/mobile/images/profile/map-pic.png')}}" class="gmap"/> <a><img src="{{asset('public/assets/mobile/images/profile/zoom-in.png')}}"/> </a> </div>
               </div>
            </div>
            <div class="whitebox ">
               <div class="profileheading">
                  <img src="{{asset('public/assets/mobile/images/profile/contact.png')}}" />
                  <h4>Contact</h4>
               </div>
               <div class="profileDetails">
                  <ul>
                     <li><img src="{{asset('public/assets/mobile/images/customer-details/mail.png')}}" />EstherG@gmail.com </li>
                     <li><img src="{{asset('public/assets/mobile/images/customer-details/mobile.png')}}" />802-438-0497 </li>
                     <li><img src="{{asset('public/assets/mobile/images/customer-details/address.png')}}" />Lauren Drive, Madison, WI 53705 </li>
                  </ul>
               </div>
            </div>
            <div class="whitebox profileMobile">
               <div class="payment">
                  <div class="profileheading">
                     <img src="{{asset('public/assets/mobile/images/profile/payment-method.png')}}" />
                     <h4>Payment Method</h4>
                  </div>
                  <span>Cheques, Chash and
                  Credit Cards</span> 
               </div>
            </div>
         </div>
      </div>
   </div>
</main>


@endsection


@section('custom_js')


@endsection