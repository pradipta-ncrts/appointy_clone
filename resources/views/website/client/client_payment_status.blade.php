@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Client Payment Status</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <div class="row">
            @if(Session::has('payment_error'))

               <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                   <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                   <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('payment_error')}}</p>
               </div>
            @endif

            @if(Session::has('payment_success'))

               <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('payment_success')}}</p>
              </div>
            
            @endif
         </div>
      </div>
   </div>
</div>
@endsection
