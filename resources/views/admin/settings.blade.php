@extends('admin/master_template_admin')
@section('title')
Squeedr Admin
@endsection


@section('content')

<?php
$settings_data = array();
foreach ($settings as $part)
{
    $settings_data[$part->config_type] = $part->config_value;
}
?>

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
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5><?=$title;?></h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('admin-settings-update')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">Admin Email</label>
                <div class="controls">
                  <input type="text" name="admin_email" id="" required="" value="<?=$settings_data['admin_email'];?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contact Email</label>
                <div class="controls">
                  <input type="text" name="contact_email" id="" required="" value="<?=$settings_data['contact_email'];?>">
                </div>
              </div>
              
              <div class="form-actions">
                <input type="submit" value="Submit" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection