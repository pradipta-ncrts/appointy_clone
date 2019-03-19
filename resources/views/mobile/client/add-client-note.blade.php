@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Add Note</h1>
  <ul>
    <li><a href=""><img src="{{asset('public/assets/mobile/images/mobile-calender.png')}}" /></a> </li>
  </ul>
</header>
<main>
 <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
          <form class="form-inline">
             <div class="headRow">
                <div class="padding15px clearfix">
                   <div class="mobileNote showMobile">
                      <textarea class="form-control" rows="8" placeholder="Write a new note"></textarea>
                      <!-- <select>
                         <option>Select Staff</option>
                      </select> -->
                      <a id="myBtn" class="btn btn-block btn-mobile" >Save Notes</a>
                      <a id="myBtn" class="btn btn-block btn-mobile" >Show Only Untreated Notes <i class="fa fa-angle-right"></i> </a>
                   </div>
                </div>
             </div>
          </form>
       </div>
    </div>
 </div>
</main>

@endsection


@section('custom_js')

@endsection