@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
  <div class="container-custm">
    <div class="upper-cmnsection">
      <div class="heading-uprlft">Dashboard</div>
      <div class="upr-rgtsec">
        <div class="col-md-6">
          <ul class="tab-menu  nav nav-tabs">
            <li class="<?=Request::segment(2) == 'all' ? 'active' : ''; ?>"><a class="<?=Request::segment(2) == 'all' ? 'active' : ''; ?>" href="{{ url('services/all') }}">My Squeedr</a></li>
            <li class="<?=Request::segment(2) == 'group' ? 'active' : ''; ?>"><a class="<?=Request::segment(2) == 'group' ? 'active' : ''; ?>" href="{{ url('services/group') }}">Group</a></li>
            <li class="<?=Request::segment(2) == 'users' ? 'active' : ''; ?>"><a class="<?=Request::segment(2) == 'users' ? 'active' : ''; ?>" href="{{ url('services/users') }}">Users</a></li>
            <li class="<?=Request::segment(2) == 'template' ? 'active' : ''; ?>"><a class="<?=Request::segment(2) == 'template' ? 'active' : ''; ?>" href="{{ url('services/template') }}">Template</a></li>
          </ul>
        </div>
        <div class="col-sm-6">
          <div class="filter-option pull-right"><a href="" data-toggle="modal" data-target="#staffFilterModal">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="leftpan">
      <div class="left-menu">
        <ul>
          <?php
         //echo "<pre>";
         //print_r($service_list); 
         foreach ($category_list as $key => $value) 
         {
         ?>
          <li class="<?=Request::segment(3) == $value->category_id ? 'active' : ''; ?>"><a class="<?=Request::segment(3) == $value->category_id ? 'active' : ''; ?>" id="" href="{{ url('services') }}/{{ Request::segment(2) }}/<?=$value->category_id;?>">
            <?=$value->cat;?>
            </a></li>
          <?php
         }
         ?>
        </ul>
      </div>
    </div>
    <div class="rightpan">
      <div class="tab-content">
        <div  id="tab1" class="tab-pane fade in active">
          <div class="mobSevices lnk">
            <ul>
              <li onclick="showUl(this);"> <a href="#"> My Squeeder Link <i class="fa fa-caret-down"></i></a>
                <ul>
                  <li><a href="" data-url="{{ url('business-provider') }}/<?=$user_name->username;?>" id="copy-link"><i class="fa fa-copy"></i> Copy Link </a> </li>
                  <li><a href="" data-url="{{ url('business-provider') }}/<?=$user_name->username;?>" id="embed-link"><i class="fa fa-code"></i> Embed </a> </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="new-event">
            <form class="form-horizontal" action="">
              <div class="form-group nomarging color-b" >
                <select name="create_new_service" id="create_new_service">
                  <option value="">New Event Type</option>
                  <option value="one-to-one">One to One</option>
                  <option value="group">Group</option>
                </select>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
            </form>
            <div class="new-event"> </div>
            <div class="clearfix"></div>
          </div>
          <div class="headRow mobileappointed clearfix break40px row-2">
            <?php
            if(empty($service_list))
            {
            echo "<h2>No service found!</h2>";
            }
            foreach ($service_list as $key => $details) 
            {
              $enc_service_id= Crypt::encrypt($details->service_id);
            ?>
            <div class="appointment mobSevices check-<?=$details->is_blocked==0 ? 'active' : 'inactive'; ?> col-sm-4">
              <div class="pull-left">
                <p>
                  <?=$details->service_name;?>
                </p>
                <span>
                <?=$details->duration;?>
                min
                <label>
                  <?=$details->currency;?>
                  <?=$details->duration ? $details->cost : '';?>
                </label>
                </span> </div>
              <ul class="pull-right">
                <li onclick="showUl(this);"> <a> <img src="{{asset('public/assets/website/images/threeDots.png')}}"/> </a>
                  <ul>
                    <li><a href="{{url('/edit_service/'.$enc_service_id)}}" class=""><i class="fa fa-edit"></i> Edit </a> </li>
                    <?php /* <li><a href="JavaScript:Void(0);" class="edit-service" data-id="<?=$details->service_id;?>"><i class="fa fa-edit"></i> Edit </a> </li> */ ?>
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
                <li>
                  <button type="button" class="btn btn-sm btn-toggle chnage-service-status <?=$details->is_blocked==0 ? 'active' : ''; ?>" data-toggle="button" aria-pressed="true" autocomplete="off" id="change-status-<?=$details->service_id;?>" data-id="<?=$details->service_id;?>">
                    <div class="handle"></div>
                  </button>
                   <!-- <a href="" data-toggle="button" id="change-status-<?=$details->service_id;?>" data-id="<?=$details->service_id;?>" class="chnage-service-status <?=$details->is_blocked==0 ? 'active' : ''; ?>"> <i class="fa fa-toggle-on"></i> </a> -->
                </li>
              </ul>
            </div>
            <?php
            }
            ?>
          </div>
          <input type="text" id="offscreen" class="offscreen" value="">
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  @endsection
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
   <!--show filter 12-11-2018 -->
  <div class="modal fade" id="staffFilterModal" role="dialog">
    <div class="modal-dialog add-pop"> 
      <!-- Modal content-->
      <div class="modal-content new-modalcustm">
      <form name="service_status_filter" id="service_status_filter" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Filter by Status</h4>
        </div>
        <div class="modal-body clr-modalbdy">
         <div class="notify">
            <div class="user-bkd break20px">
              <h2 id="">Active</h2>
              <div class="row" id="apoinment-mail-notification">
                <div class="check-ft">
                  <div class="form-group">
                    <input name="active" class="calender-inpt" type="checkbox" value="1">
                  </div>
                </div>
              </div>
            </div>
            <div class="user-bkd break20px"> 
              <h2 id="">Inactive</h2>
              <div class="row" id="apoinment-mail-notification">
                <div class="check-ft">
                  <div class="form-group">
                    <input name="inactive" class="calender-inpt" type="checkbox" value="2">
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="butt-pop-ft">
          <button type="submit" class="btn btn-primary butt-next" id="submit_service_status_filter">Done</button>
          <a href="" class="btn btn-primary butt-next" style="margin-bottom: -20px;">Reset</a> </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.offscreen {
position: absolute;
left: -999em;
}
.filter-option{margin-top:14px 0 0 0;}
</style>
