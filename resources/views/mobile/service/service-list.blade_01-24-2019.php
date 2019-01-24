@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<header class="mobileHeader showMobile" id="divBh">
   <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
   <h1>Service List</h1>
   <ul>
      <li><a href="{{url('mobile/create-service')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
   </ul>
</header>
<main>
  <ul class="clientSchedule">
     <li><a href="{{url('mobile/service-list/all')}}" class="<?=Request::segment(4) == '' ? 'active' : ''; ?>">All</a> </li>
      <?php 
       foreach ($category_list as $key => $value) 
       {
       ?>
        <li><a class="<?=Request::segment(4) == $value->category_id ? 'active' : ''; ?>" id="" href="{{ url('mobile/service-list/') }}/{{ Request::segment(3) }}/<?=$value->category_id;?>">
          <?=$value->cat;?>
          </a></li>
        <?php
       }
       ?>
  </ul>
  <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="headRow  mobileappointed clearfix" id="row2">
              <?php
              foreach ($service_list as $key => $details) 
              {
              ?>
               <div class="appointment mobSevices whitebox">
                  <div class="pull-left">
                     <p><?=$details->service_name;?></p>
                     <span><?=$details->duration;?> min<label><?=$details->currency;?>
                  <?=$details->duration ? $details->cost : '';?></label></span> 
                  </div>
                  <ul class="pull-right">
                     <li onclick="showUl(this);">
                        <a> <img src="{{asset('public/assets/mobile/images/threeDots.png')}}"/> </a> 
                        <ul>
                          <li><a href="#"><i class="fa fa-edit"></i> Edit </a> </li>
                          <li><a href="JavaScript:Void(0);" class="copy-service-link" data-service="{{ url('client-service-details') }}/<?=$details->service_id;?>"><i class="fa fa-copy"></i> Copy Link </a> </li>
                          <li><a href="JavaScript:Void(0);" class="clone-srvice" data-id="<?=$details->service_id;?>"><i class="fa fa-clone"></i> Clone </a> </li>
                          <?php
                          if($details->is_template!='1')
                          {
                          ?>
                          <li><a href="JavaScript:Void(0);" class="save-as-template" data-id="<?=$details->service_id;?>"><i class="fa fa-floppy-o"></i> Save Template </a> </li>
                          <?php
                          }
                          ?>
                          <li><a href="JavaScript:Void(0);" class="embed-srvice" data-service="{{ url('client-service-details') }}/<?=$details->service_id;?>"><i class="fa fa-code"></i> Embed </a> </li>
                          <li><a href="JavaScript:Void(0);" class="delete-srvice" data-id="<?=$details->service_id;?>"><i class="fa fa-trash"></i> Delete </a> </li>
                        </ul>
                     </li>
                     <li><button type="button" class="btn btn-sm btn-toggle chnage-service-status <?=$details->is_blocked==0 ? 'active' : ''; ?>" data-toggle="button" aria-pressed="true" autocomplete="off" id="change-status-<?=$details->service_id;?>" data-id="<?=$details->service_id;?>">
                    <div class="handle"></div>
                  </button> </li>
                  </ul>
               </div>
              <?php
              }
              ?>
            </div>
            <input type="text" id="offscreen" class="offscreen" value="">
         </div>
      </div>
   </div>
</main>

<div class="modal fade" id="modalEmbed" role="dialog">
  <div class="modal-dialog add-pop"> 
    <!-- Modal content-->
    <div class="modal-content new-modalcustm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Embed Link</h4>
      </div>
      <div class="modal-body clr-modalbdy">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="niceditor">
                <textarea style="width: 100%" id="embed_code" placeholder=""></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-12 text-center">
          <input id="copy-embed-link" type="submit" value="copy" class="btn btn-primary butt-next" style="margin: 0px auto 0; width: 150px; display: block">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
   function ShowPopup() {
         $("#popup").fadeToggle();
     }
     function togglebtn(obj){
         $(obj).toggleClass("active");
         $(obj).find("i").toggleClass("fa-toggle-off fa-toggle-on");
         $(".mobSevices ul li a.active").find("i").not($(obj).find("i")).removeClass("fa-toggle-on").addClass("fa-toggle-off");
         $(".mobSevices ul li a.active").not($(obj)).removeClass("active");
     }
     function showUl(obj){
         $(obj).find("ul").fadeToggle();
         $(".mobSevices ul li ul").not($(obj).find("ul")).fadeOut();
     }
</script>
@endsection

@section('custom_css');

<style type="text/css">
.offscreen {
position: absolute;
left: -999em;
}
.filter-option{margin-top:14px 0 0 0;}
</style>

@endsection