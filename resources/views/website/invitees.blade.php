@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Invitees</div>
         <div class="upr-rgtsec">
            <div class="col-md-5">
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="search-query form-control" id="filterList" placeholder="Search" name="filter_list" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search" id="submitFilterList"></span> </button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="full-rgt">
                  <div class="dropdown custm-uperdrop">
                     <!-- <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Upcoming Dates <img src="images/arrow.png" alt=""/></button>
                     <ul class="dropdown-menu">
                        <li><a href="#">JAN</a></li>
                        <li><a href="#">FEB</a></li>
                        <li><a href="#">MARCH</a></li>
                     </ul> -->
                  </div>
                  <!-- <div class="filter-option"><a href="/">Show Filter <i class="fa fa-filter" aria-hidden="true"></i></a></div> -->
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="#"> Active</a></li>
               <li><a href="#"> Inactive</a> </li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class="headRow showDekstop clearfix">
               <div class="col-md-12 table-set">
                  <table id="example" class="table table-striped" style="width:100%">
                     <thead>
                        <tr>
                           <th>Email</th>
                           <th>Status</th>
                           <th>Journey</th>
                           <th align="right" style="text-align: right;">Date Invited</th>
                           <th align="center" style="text-align: center;">&nbsp;</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($client_list as $key => $value)
                        {
                           $i=0;
                           if($value->is_send_invitation==1)
                           {

                        ?>
                        <tr class="searchResult" id="tableRemove_<?=$value->client_id;?>">
                           <td><?=$value->client_email;?></td>
                           <td>Mail Sent</td>
                           <td>&nbsp;</td>
                           <td align="right"><?=date('M, d Y', strtotime($value->created_on));?></td>
                           <td align="center"  class="dropdown">
                              <a href="#" class=" dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                              <ul class="dropdown-menu">
                                 <li><a href="#" class="remove" id="<?=$value->client_id;?>"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Remove</a></li>
                                 <li><a href="#" class="resend" id="<?=$value->client_id;?>" data-email="<?=$value->client_email;?>" data-name="<?=$value->client_name;?>" data-discount="<?=$value->discount;?>" ><i class="fa fa-envelope-open-o " aria-hidden="true"></i>&nbsp; Resend Invite</a></li>
                              </ul>
                           </td>
                        </tr>
                        <?php
                              $i++;
                           }
                        }
                        if($i==0)
                        {
                        ?>
                        <tr>
                           <!-- <td colspan="5" align="">No data found.</td> -->
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
</div>
@endsection

@section('custom_js')
<script>
$(document).ready(function(){

    $(".remove").on('click', (function() {
        //e.preventDefault();
        var client_id = $(this).attr('id');
        //alert(client_id);
        var data = addCommonParams([]);
        data.push({ name:'client_id', value:client_id });
        //console.log(data);
        $.ajax({
                url: baseUrl+"/api/remove_invitee", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                dataType: "json",
                success: function(response) // A function to be called if request succeeds
                {
                    console.log(response);
                    //alert(response.response_status);
                    if(response.response_status=='1')
                    {
                        $("#tableRemove_"+client_id).remove();
                        swal("Succes", response.message , "success");
                        $('.animationload').hide();
                    }
                    else
                    {
                        swal("Error", "Somthing wrong try again later." , "error");
                    }
                },
                beforeSend: function()
                {
                    $('.animationload').show();
                },
                complete: function()
                {
                    //$('.animationload').hide();
                }
            });
    }));

    $("#submitFilterList").on("click", function() {
       var value = $("#filterList").val().toLowerCase();
       $(".searchResult").filter(function() {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
       });
   });

    $(".resend").on('click', (function() {
        //e.preventDefault();
        var client_id = $(this).attr('id');
        var client_name = $(this).data('name');
        var client_email = $(this).data('email');
        var discount = $(this).data('discount');
        var data = addCommonParams([]);
        data.push({ name:'client_id', value:client_id }, { name:'client_name', value:client_name }, { name:'client_email', value:client_email }, { name:'discount', value:discount });
        //console.log(data);
        $.ajax({
                url: baseUrl+"/api/resend_invitee", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                dataType: "json",
                success: function(response) // A function to be called if request succeeds
                {
                    console.log(response);
                    //alert(response.response_status);
                    if(response.response_status=='1')
                    {
                        //$("#tableRemove_"+client_id).remove();
                        swal("Succes", response.message , "success");
                        $('.animationload').hide();
                    }
                    else
                    {
                        swal("Error", "Somthing wrong try again later." , "error");
                    }
                },
                beforeSend: function()
                {
                    $('.animationload').show();
                },
                complete: function()
                {
                    //$('.animationload').hide();
                }
            });
    }));

});
</script>
@endsection