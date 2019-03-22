@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')

<div class="body-part">
  <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Calendar Connections</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="cal-c">
            <img src ="{{asset('public/assets/website/images/icon-google-cal.png')}}">
            <div class="cont">
               <h3>Google Calendar</h3>
               <p>Allows Squeedr to check Google calendar for onflicts and add events to it.</p>
            </div>
            <a href="#">Connect</a>
            <div class="clearfix"></div>
         </div>
         <div class="cal-c">
            <img src ="{{asset('public/assets/website/images/office-365.png')}}">
            <div class="cont">
               <h3>Office 365/Outlook.com</h3>
               <p>Allows Squeedr to check your Office 365, Outlook.com, live.com or hotmail calendar for conflits and add events to it.</p>
            </div>
            <a href="#">Connect</a>
            <div class="clearfix"></div>
         </div>
         <div class="cal-c">
            <img src ="{{asset('public/assets/website/images/outlook.png')}}">
            <div class="cont">
               <h3>Outlook Plug-in (for Windows users)</h3>
               <p>Allows Squeedr to check Outlook for conflicts and add events to it.<br><br>
                  Requirements: Outlook 2007, 2010, 2013 or 2016 with Windows XP, Vista 7, 8, 8.1 or 10.
               </p>
            </div>
            <a href="#">Connect</a>
            <div class="clearfix"></div>
         </div>
         <div class="cal-c">
            <img src ="{{asset('public/assets/website/images/icloud.png')}}">
            <div class="cont">
               <h3>iCloud Calendar</h3>
               <p>Allows Squeedr to check Google calendar for onflicts and add events to it.
               </p>
            </div>
            <a href="#">Connect</a>
            <div class="clearfix"></div>
         </div>
      </div>
   </div>
</div>

@endsection