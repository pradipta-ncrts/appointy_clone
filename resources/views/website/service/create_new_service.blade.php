@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Create New Service</div>  
      </div>
      <!--<div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{url('/add_services')}}" class="active"> Add Service & Additional Options</a></li>
            </ul>
         </div>
      </div>-->
      <div class="full">
        <div class="col-lg-12">
          <div class="service-type">
              
              <div class="service-one" style="padding-top: 50px">
                  <i class="fa fa-user"></i>
                  <div class="srv-cont"> 
                    <h3>One-on-One</h3>
                    <p>Allow invitees to schedule individual slots with you.</p>
                  </div>
                  <a href="{{url('add_services/solo')}}"><button type="button"> <i class="fa fa-plus"></i> Create </button></a>
                  <div class="clearfix"></div>
              </div>

              <div class="service-one" style="padding-top: 40px">
                  <i class="fa fa-users"></i>
                  <div class="srv-cont"> 
                    <h3>Group</h3>
                    <p>Allow multiple invitees to schedule the same slot. Useful for tours, webinars, classes, workshops, etc.</p>
                  </div>
                  <a href="{{url('add_services/group')}}"><button type="button"> <i class="fa fa-plus"></i> Create </button></a>
                  <div class="clearfix"></div>
              </div>
          </div>
        </div>

      </div>
   </div>
</div>
@endsection