@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
   <div class="upper-cmnsection">
         <div class="heading-uprlft">Activity Events</div>
         <div class="upr-rgtsec">
            <!--<div class="col-md-6">
               <ul class="tab-menu ">
                  <li><a href="#" class="active">My Squeedr</a></li>
                  <li><a href="#">Group</a></li>
                  <li><a href="#">Users</a></li>
                  <li><a href="#">Template</a></li>
               </ul>
            </div>-->
            <div class="col-md-6 pull-right">
                <div class="full-rgt">
                <div class="filter-option"><a href="" data-toggle="modal" data-target="#eventFilterModal">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div>
                </div>
            </div>
         </div>
   </div>
   <div class="clearfix"></div>
   <div class="rightpan full"> 
   <!--<a class="btn btn-default">Show or Hide my actions</a>-->
     
        <table id="example" class="table table-striped app" style="width:100%">
            <thead>
                <tr>
                    <th>When</th>
                    <th>Type</th>
                    <th>Action</th>
                    <th>Author</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody id="searchResult">
                <?php if(!empty($event_viewer_list)) { foreach($event_viewer_list as $event_viewer) { ?>
                <tr>
                    <td><?=$event_viewer->created_on;?> </td>
                    <td><?=$event_viewer->type_name;?></td>
                    <td><?=$event_viewer->message;?></td>
                    <td><?=$event_viewer->username;?></td>
                    <td><?=$event_viewer->staffname ? $event_viewer->staffname : 'N/A';?></td>
                </tr>
                <?php } } ?>
                
            </tbody>
        </table>
   </div>
      
</div>

<div class="modal fade" id="eventFilterModal" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content--> 
        <div class="modal-content new-modalcustm">
            <form name="event_viewer_search_form" id="event_viewer_search_form" method="post" action="{{url('api/event_viewer_list')}}" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Filter by </h4>
                </div>
                
                <div class="modal-body clr-modalbdy">

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group" id="clientname_error"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="staff_name" type="text" class="form-control" name="staff_name" placeholder="Staff Name">
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <div class="form-group nomarging color-b" >
                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="type" id="type" >
                                            <option value="">Select Type </option>
                                            <option value="1">Service Created</option>
                                            <option value="2">Service Edited</option>
                                            <option value="3">Service Deleted</option>
                                            <option value="4">Appointment Created</option>
                                            <option value="5">Appointment Rescheduled</option>
                                            <option value="6">Appointment Cancelled</option>
                                            
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                
                    <div class="butt-pop-ft">
                        <button type="submit" class="btn btn-primary butt-next">Done</button> 
                        <button id="resetSearchBtn" type="button" class="btn btn-primary butt-next" >Reset</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection

@section('custom_js')
<script>

$('#event_viewer_search_form').validate({
    submitHandler: function(form) {
        var data = $(form).serializeArray();
        data = addCommonParams(data);
        //console.log(data);
        $.ajax({
            url: form.action,
            type: form.method,
            data:data ,
            dataType: "json",
            success: function(response) {
                console.log(response);
                var html = '';
                if(response.event_viewer_list && response.event_viewer_list.length === 0){
                    html = '<tr><td colspan="5">No recrds found</td></tr>';
                } else {
                    var staffname = '';
                    $.each(response.event_viewer_list, function(k, v) {
                        staffname = v.staffname;
                        if(staffname==''){
                            staffname = 'N/A';
                        }
                        html += '<tr>';
                        html += '<td>'+v.created_on+'</td>';
                        html += '<td>'+v.type_name+'</td>';
                        html += '<td>'+v.message+'</td>';
                        html += '<td>'+v.username+'</td>';
                        html += '<td>'+staffname+'</td>';
                        html += '</tr>';
                    });
                }
                $('#searchResult').html(html);
                $('#eventFilterModal').modal('hide');
            },
            beforeSend: function(){
                $('.animationload').show();
            },
            complete: function(){
                $('.animationload').hide();
            }
        });
    }
});

$('#resetSearchBtn').click(function(){
    $('#event_viewer_search_form').trigger("reset");
    location.reload();
})
</script>

@endsection

