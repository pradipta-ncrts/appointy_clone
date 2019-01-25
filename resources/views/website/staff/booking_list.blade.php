@extends('../layouts/staff/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<style type="text/css">
   .namedate {
   border-radius: 5px;
   color: #fff;
   font-size: 17px;
   display: flex;
   justify-content: space-between;
   margin-bottom: 10px;padding: 8px 10px;background: #5da7d4;
   }
   .border-box {
   border: 1px solid #ccc;
   border-radius: 5px;
   padding: 15px 0;
   margin-bottom: 10px;
   }
   .whitebox {
   background: #fff;
   position: relative;
   padding: 10px;
   position: relative;
   margin-bottom: 10px;
   }
   .staffDetail {
   padding: 0 10px 10px;
   margin-bottom: 12px;
   border-bottom: 1px solid #cac8c8;
   display: flex;
   justify-content: space-between;
   font-size: 14px;
   }
   .staffDetail p {
   color: #0645a3;
   font-weight: bold;
   }
   .staffDetail span.bluetxt {
   color: #5da7d4;
   }
   .staffInside {
   padding: 0 10px;
   }
   .staffInside h6 {
   padding-bottom: 10px;
   font-size: 16px;
   }
   .staffInside p {
   color: #000;
   font-size: 14px;
   line-height: 21px;
   }
   .addReadMore.showlesscontent .SecSec,
   .addReadMore.showlesscontent .readLess {
   display: none;
   }
   .addReadMore.showmorecontent .readMore {
   display: none;
   }
   .addReadMore .readMore,
   .addReadMore .readLess {
   margin-left: 2px;
   color: blue;
   cursor: pointer;
   }
   .addReadMoreWrapTxt.showmorecontent .SecSec,
   .addReadMoreWrapTxt.showmorecontent .readLess {
   display: block;
   }
</style>
@endsection
@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Booking List</div>
         <div class="upr-rgtsec">
            <div class="col-sm-5">
               <div id="custom-search-input">
                  <div class="input-group ">
                     <!-- <input type="text" id="booking_search" class="search-query form-control" placeholder="Search" />
                     <span class="input-group-btn">
                     <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                     </span>  -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="leftpan">
         <div class="left-menu">
            <ul>
               <li><a href="{{url('staff-booking-list/all')}}" class="<?=$duration=='all' ? 'active' : ''; ?>"> Current</a></li>
               <li><a href="{{url('staff-booking-list/day')}}" class="<?=$duration=='day' ? 'active' : ''; ?>"> Next 3 Days</a> </li>
               <li><a href="{{url('staff-booking-list/month')}}" class="<?=$duration=='month' ? 'active' : ''; ?>"> Last 1 Month</a></li>
            </ul>
         </div>
      </div>
      <div class="rightpan">
         <div class="relativePostion">
            <div class=" showDekstop clearfix">
               <div id="filter_data">
               <?php
               if(!empty($appoinment_list))
               {
                  foreach ($appoinment_list as $key => $value)
                  {
                  ?>
                  <div class="bluebg break20px namedate">
                    <span><?=date('l', strtotime($value->date));?>, <?=date('M d, Y', strtotime($value->date));?></span>
                    <span><?=$value->client_name;?></span>
                  </div>
                  <div class="whitebox border-box">
                     <div class="staffDetail">
                        <span><label>With</label> <?=$value->staff_name;?></span>
                        <p><?=$value->start_time;?> - <?=$value->end_time;?></p>
                        <span class="bluetxt"><?=$value->currency;?><?=$value->cost;?></span>
                     </div>
                     <div class="staffInside">
                        <h6><?=$value->service_name;?></h6>
                        <p class="addReadMore showlesscontent"><span>Notes :</span> <?=$value->note;?> </p>
                     </div>
                  </div>
                  <?php
                  }
                }
                else
                {
                ?>
                <div class="bluebg break20px namedate">
                   No data found.
                </div>
                <?php
                }
                ?>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="staffListModal" role="dialog">
    <div class="modal-dialog add-pop">
        <!-- Modal content--> 
    <div class="modal-content new-modalcustm">
        <form name="" id="" method="post" action="" enctype="multipart/form-data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Staff List</h4>
            </div>
            <div class="modal-body clr-modalbdy">
                <div class="notify" >
                    <input type="text" id="staffFilter" class="input-block-level form-control search-ap" placeholder="Search Staff" >
                    <?php
                    foreach ($staff_list as $key => $value)
                    {
                    ?>
                        <div class="user-bkd break20px">
                        <?php
                        if($value->staff_profile_picture)
                        {
                        ?>
                            <img src="<?=$value->staff_profile_picture;?>" class="thumbnail rounded">
                        <?php
                        }
                        else
                        {
                        ?>
                            <img src="{{asset('public/assets/website/images/user-pic-sm-default.png')}}" class="thumbnail rounded">
                        <?php
                        }
                        ?>
                        <h2><?=$value->full_name;?>
                            <br><a href="mailto:<?=$value->email;?>"><i class="fa fa-envelope-o"></i> <?=$value->email;?></a>
                        </h2>
                        <div class="row">
                            <div class="check-ft">
                                <div class="form-group"> 
                                <!--<input name="filter_stuff_id" class="calender-inpt" type="checkbox" value="<?=$value->staff_id;?>">-->
                                <input type="radio" class="staff_id" data-duration="{{ Request::segment(2) }}" name="staff_id" value="<?=$value->staff_id;?>"  />
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
<script>
$(document).ready(function(){
    $('#booking_search').click(function(){
        $('#staffListModal').modal('show');
    });


    $(".staff_id").on('click', (function() {
        //e.preventDefault();
        var staff_id = $(this).val();
        var duration = $(this).data('duration');
        var data = addCommonParams([]);
        data.push({ name:'staff_id', value:staff_id }, { name:'duration', value:duration });
        //console.log(data);
        $.ajax({
                url: baseUrl+"/api/appoinment_list_mobile", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/valuesalue pairs (i.e. form fields and values)
                dataType: "json",
                success: function(response) // A function to be called if request succeeds
                {
                    //console.log(response);
                    //alert(response.response_status);
                    var html = '';
                    if(response.response_status=='1')
                    {
                        if(response.appoinment_list.length>0)
                        {
                            for(i = 0;i<response.appoinment_list.length;i++)
                            {
                                var d = new Date(response.appoinment_list[i].date);
                                var curr_date = d.getDate();
                                var curr_month = d.getMonth();
                                var curr_year = d.getFullYear();
                                var day = d.getDay();
                                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                                html += '<div class="bluebg break20px namedate"><span> '+weekday[day]+', '+monthNames[curr_month]+' '+curr_date+', '+curr_year+'</span><span>'+response.appoinment_list[i].client_name+'</span></div><div class="whitebox border-box"><div class="staffDetail"><span><label>With</label> '+response.appoinment_list[i].staff_name+'</span><p>'+response.appoinment_list[i].start_time+' - '+response.appoinment_list[i].end_time+'</p><span class="bluetxt">'+response.appoinment_list[i].currency + response.appoinment_list[i].cost+'</span></div><div class="staffInside"><h6>'+response.appoinment_list[i].service_name+'</h6><p><span>Notes :</span>'+response.appoinment_list[i].note+' <!-- <a>more</a> --></p></div></div>';
                            }
                        }
                        else
                        {
                            html += '<div class="bluebg break20px namedate">No data found.</div>';
                        }
                        $('#filter_data').html(html);
                        $('.animationload').hide();
                        $('#staffListModal').modal('hide');
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

})
</script>
@endsection