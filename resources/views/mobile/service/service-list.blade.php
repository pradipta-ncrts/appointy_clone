@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Staff</h1>
  <ul>
    <li><a href="{{url('mobile/add-service')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
  </ul>
</header>
<main>
 <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
          <div class="headRow  mobileappointed clearfix" id="row2">
             <div class="appointment mobSevices whitebox">
                <div class="pull-left">
                   <p>Dental Consultation</p>
                   <span>30min-1h <label>$50</label></span> 
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
                   <li><a onclick="togglebtn(this);" class="active"> <i class="fa fa-toggle-on"></i>  </a> </li>
                </ul>
             </div>
             <div class="appointment mobSevices">
                <div class="pull-left">
                   <p>Smile corrections</p>
                   <span>30min-1h <label>$50</label></span> 
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
                   <li><a onclick="togglebtn(this);"> <i class="fa fa-toggle-off"></i>  </a> </li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </div>
</main>

@endsection


@section('custom_js')

@endsection