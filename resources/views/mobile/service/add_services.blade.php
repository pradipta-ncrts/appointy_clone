@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection
@section('custom_css')
<link href="{{asset('public/assets/website/css/spectrum.css')}}" rel="stylesheet">
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Service Add</h1>
  <ul>
    <li>&nbsp; </li>
  </ul>
</header>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 break20px">
      <div class="whitebox">
       <form name="add_service" id="add_service" method="post" action="{{url('api/add-new-service')}}">
          <input type="hidden" name="service_type" id="service_type" value="<?php echo $type;?>" />
             <div>
                   <div class="leftbar">
                      <h5><i class="fa fa-calendar"></i> What service is this?</h5>
                   </div>
                </div>
                <div class="whitebox dsinside clearfix " style="display: block;">
                   <div class="form-details">
                      <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                               <label for="service_name">Service Name <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                               <input class="form-control nomarginbottom" type="text" name="service_name" id="service_name" />
                            </div>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                               <label for="service_location">Location <i class="fa fa-question" data-toggle="tooltip" title="Use the 'Location' field to specify how and where both parties will connect at the scheduled time.
                                  You can choose to show these details on the scheduling page, before a time is confirmed - OR - restrict the location to the confirmation page, after a meeting time has been selected." data-placement="right"></i></label>
                               <input class="form-control nomarginbottom" type="text" name="service_location" id="service_location" />
                               <span class="specialnote">e.g. Joe's Coffee, I'll Call you, etc</span> 
                            </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="form-group">
                            <input type="radio" checked="checked" name="service_display_location" id="booking" value="1" />
                            <label class="right35px">Display location while booking</label>
                            <div class="clearfix break10px"></div>
                            <input type="radio" name="service_display_location" id="confirm" value="2" />
                            <label class="right35px">Display location only after confirmation</label>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <label for="service_currency">Currency <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Select currency for your service." data-placement="right"></i> </label>
                                <select name="service_currency" id="service_currency">
                                  <option value="">Select currency</option>
                                  <option value="1">INR</option>
                                  <option value="2">USD</option>
                                  <option value="3">POUND</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                               <label for="service_price">Price <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a price for your service." data-placement="right"></i> </label>
                               <input class="form-control" type="number" min="1" name="service_price" id="service_price">
                            </div>
                         </div>
                      </div>
                      <?php if($type == 'group') { ?>
                      <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                               <label for="service_capacity">Capacity <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a capacity for your service." data-placement="right"></i> </label>
                               <input class="form-control" type="text" name="service_capacity" id="service_capacity">
                            </div>
                         </div>
                      </div>
                      <?php } ?>
                      
                      <label for="service_description">Description/Instructions</label>
                      <textarea class="form-control" rows="4" name="service_description" id="service_description"></textarea>
                      
                      <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="service_link">Service Link <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Service URL is the link you can share with your invitees if you want them to bypass the 'Pick Service' step on your Squdeer page and go directly to the 'Pick Date & Time' step. "></i> </label>
                            <input class="form-control" type="text" name="service_link" id="service_link" />
                         </div>
                         <div class="clearfix"></div>
                         
                         <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="service_category">List of categories</label>
                            <select name="service_category" id="service_category">
                               <option>Select categories</option>
                               <?php if(!empty($category_list)){ foreach($category_list as $category){ ?>
                                <option value="<?php echo $category->category_id;?>"><?php echo $category->category;?></option>
                              <?php } } ?>
                              <option value="new">New Category </option>
                            </select>
                         </div>
                         <div class="clearfix"></div>
                         

                          <div class="col-lg-6 col-md-6 col-sm-6 new-category-name" style="display: none;">
                              <label for="new_category_name">Category Name</label>
                              <input class="form-control" type="text" name="new_category_name" id="new_category_name" />
                          </div>
                          
                          <div class="clearfix"></div>
                         

                         <div class="col-lg-6 col-md-6 col-sm-6">
                              <label for="service_color">Select Color <sup>*</sup> <i class="fa fa-question" data-toggle="tooltip" title="Enter a name of your service." data-placement="right"></i> </label>
                              <input type="text" name="togglePaletteOnly" id="togglePaletteOnly" style="display:none;">
                              <input type="hidden" name="service_color" id="service_color" value="#ff0000">
                          </div>
                      </div>
                      
                      <div class="break20px">
                         <a href="{{url('mobile/service-list')}}"><input type="button" class="btn btn-grey" value="Cancel" /></a>
                         <input type="submit" class="btn btn-primary" value="Next" />
                      </div>
                   </div>
                </div>
             </div>
             <div class="break20px hidden-xs"></div>
          </form>
                               </div>
        </div>
    </div>
  </div>
</main>

@endsection
@section('custom_js')
<script src="{{asset('public/assets/website/js/spectrum.js')}}"></script>
<script>
    $('#add_service').validate({
        rules: {
            service_name: {
                required: true
            },
            service_currency: {
                required: true
            },
            service_price: {
                required: true,
                number: true
            },
            service_link: {
                required: true
            },
            service_category: {
                required: true
            }
        },

        messages: {
            service_name: {
                required: 'Please enter service name'
            },
            service_currency: {
                required: 'Please choose currency'
            },
            service_price: {
                required: 'Please enter price',
                number: 'Please enter proper price'
            },
            service_link: {
                required: 'Please enter service link'
            },
            service_category: {
                required: 'Please choose category'
            }
        },

        submitHandler: function(form) {
            var data = $(form).serializeArray();
            //data.push({name: 'device_type', value: 1});
            data = addCommonParams(data);
            $.ajax({
                url: form.action,
                type: form.method,
                data:data ,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.response_status==1)
                    {
                        if(response.service_id != ''){
                        var url = "{{url('/mobile/edit_service/')}}"+'/'+response.service_id;
                        window.location.href = url; 
                        } else {
                            swal('Sorry!',response.message,'error');
                        }
                    }
                    else{
                        swal('Sorry!',response.message,'error');
                    }
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

    $("#togglePaletteOnly").spectrum({
        showPaletteOnly: true,
        togglePaletteOnly: true,
        hideAfterPaletteSelect:true,
        togglePaletteMoreText: 'more',
        togglePaletteLessText: 'less',
        color: 'red',
        palette: [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
        ]
    });

    $("#togglePaletteOnly").on('change.spectrum', function(e, tinycolor) {
        var hexcolor = tinycolor.toHexString();
        $('#service_color').val(hexcolor);
    });

    $(document).on('change','#service_category',function() {
        let val = $(this).val();
        //alert(val);
        if(val=="new")
        {
            $(".new-category-name").show();
        }
        else
        {
            $(".new-category-name").hide();
            $('#new_category_name').val('');
        }
    });
</script>
@endsection