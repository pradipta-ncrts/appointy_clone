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
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5><?=$title;?></h5>
          </div>
          <style type="text/css">
            .select2-container {
              width: 25% !important;
            }
          </style>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('admin/modify-country') }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <input type="hidden" name="country_no" value="<?=isset($result->country_no) && $result->country_no ? $result->country_no : ''; ?>">
              <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
                  <input type="text" name="country_name" id="" required="" value="<?=isset($result->country_name) && $result->country_name ? $result->country_name : ''; ?>">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">ISO Code</label>
                <div class="controls">
                  <input type="text" name="country_iso_code" id="" required="" value="<?=isset($result->country_iso_code) && $result->country_iso_code ? $result->country_iso_code : ''; ?>">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Dialing Code</label>
                <div class="controls">
                  <input type="text" name="country_dialing_code" id="" required="" value="<?=isset($result->country_dialing_code) && $result->country_dialing_code ? $result->country_dialing_code : ''; ?>">
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