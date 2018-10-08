@extends('../layouts/admin/master_template_admin')
@section('title')
Squdeer Admin
@endsection


@section('content')
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{asset('admin-dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#"><?=$title;?></a> </div>
    <h1><?=$title;?></h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <?php 
            if (Session::has('error_message')) 
            {
            ?>
                <div class="alert alert-danger alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-warning"></i><strong>Sorry!</strong>{{Session::get('error_message')}}</p>
                </div> 
            <?php
          } 
          if(Session::has('success_message')) 
          {
          ?>
                <div class="alert alert-success alert-dismissible margin-t-10" style="margin-bottom:15px;">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <p><i class="icon fa fa-check"></i><strong>Success!</strong> {{Session::get('success_message')}}</p>
                </div>
          <?php
          }
          ?> 
        <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <input type="checkbox" id="title-checkbox" name="title-checkbox" />
            </span>
            <h5><?=$title;?></h5>
            <a href="" class="delete-multiple-row" id="countries,country_no"><span class="label label-info" style="border-radius: 3px; background: #bd362f;">Delete</span></a>
            <a href="{{url('admin/add-country')}}"><span class="label label-info" style="border-radius: 3px; background: #04c;">Add New</span></a>
          </div>
          <div class="widget-content nopadding" id="tabledata">
            <table id="mytable" class="table table-bordered table-striped with-check data-table">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>Country</th>
                  <th>ISO Code</th>
                  <th>Dailing Code</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($results as $key => $value)
                {
                ?>
                <tr>
                  <td><input type="checkbox" name="multipleid[]" value="<?=$value->country_no;?>" class="delete-multiple" /></td>

                  <td><?=$value->country_name;?></td>
                  <td><?=$value->country_iso_code;?></td>
                  <td><?=$value->country_dialing_code;?></td>
                  <td style="text-align: center;"><span id="statusid<?=$value->country_no;?>"><a class="btn btn-mini change-status" id="<?=$value->country_no;?>,countries,is_blocked,<?=$value->is_blocked;?>,country_no" href="javascript:void(0)"><?=$value->is_blocked==0 ? '<i class="icon-ok" aria-hidden="true" style="color:#17C200"></i> Active' : '<i class="icon-remove" aria-hidden="true" style="color:#FF1F1F"></i> Inactive';?></a></span>  | <a class="btn btn-mini" href="{{url('admin/add-country/'.base64_encode($value->country_no))}}"><i class="icon-edit" style="color: #4537C8;"></i> Edit</a> | <a href="javascript:void(0)" class="btn btn-mini delete-one" id="<?=$value->country_no;?>,countries,country_no"><i class="icon-trash" style="color: #FF1F1F;"></i> Delete</a></td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection