<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
      <title>Squeedr</title>
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/website/css/font-awesome.min.css')}}" />
      <link href="{{asset('public/assets/website/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/mobile.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom-selectbox.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
      <script type="text/javascript"> var js_base_url = '<?=url('');?>/';</script>
   </head>
   <body class="login-bg">
       <div class="animationload" style="display: none;">
            <div class="osahanloading"></div>
      </div>
      <div id="web">
         <div class="reg-1st ">
            <div class="logo-reg">
               <img src="{{asset('public/assets/website/images/logo.svg')}}">
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="reg-container container-fixed1">
            <div class="row">
               <div class="col-sm-5">
                  <h2>Resource, Services <br> & Pack passes </h2>
               </div>
               <div class="col-lg-5 col-md-6 col-sm-6 from-reg1">
                  <form class="form-horizontal" action="{{ url('api/registration-step2') }}" method="post" autocomplete="off" id="registration-form-two">
                     <div class="clone-div">
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <select class="selectpicker category" data-show-subtext="true" data-live-search="true"  name="category[]" >
                              <option value="">Select Category </option>
                              <?php
                              foreach ($category as $key => $value)
                              {
                                 echo "<option value='".$value->category_id."'>".$value->category."</option>";
                              }
                              ?>
                              <option value="new">New Category </option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group new-category-name" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Category Name " name="new_category_name[]" >
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Service Name " name="service[]" >
                           <div class="clearfix"></div>
                        </div>
                       
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <input type="text" class="form-control" placeholder="Cost " name="cost[]" >
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="col-md-6 drop-sm">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="currency[]"  >
                                    <option value="">Select Currency </option>
                                     <?php
                                      foreach ($currency as $key => $value)
                                      {
                                         echo "<option value='".$value->currency_id."'>".$value->currency."</option>";
                                      }
                                      ?>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <select class="selectpicker duration" data-show-subtext="true" data-live-search="true" name="duration[]" >
                              <option value="">Select Duration </option>
                              <option value="15">15 min </option>
                              <option value="30">30 min </option>
                              <option value="45">45 min </option>
                              <option value="60">60 min </option>
                              <option value="Custom">Custom min </option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group custom-duration" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <input type="text" class="form-control" placeholder="Custom duration " name="custom_duration[]" >
                           <div class="clearfix"></div>
                        </div>

                        <div class="row">
                           <div class="col-md-4 capacity">
                              <a href="" class="tg-btn-ac user-status one-to-one">One to One</a>
                           </div>
                           <div class="col-md-3 capacity">
                              <a href="" class="tg-btn user-status group">Group</a>
                           </div>
                           <div class="col-md-5 capacity" style="display: none;">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-capacity.png')}}">
                                 <input type="text" class="form-control" placeholder="Capacity " name="capacity[]">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                        <div class="row">
                           <div class="col-md-12">
                              &nbsp;
                           </div>
                           <div class="col-md-4">
                              <a href="" class="add-new"><i class="fa fa-plus"></i> Add New</a>
                           </div>
                        </div>
                     <button type="submit" id="submit">Submit</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div id="mobile" class="mobile-login">
         <div class="logo-login">
            <img src="{{asset('public/assets/website/images/logo-login.png')}}">
         </div>
      </div>
      <!--category hidden-->
      <div id="category-html" style="display: none;">
         <select class=" category" data-show-subtext="true" data-live-search="true"  name="category[]" >
            <option value="">Select Category </option>
            <?php
            foreach ($category as $key => $value)
            {
               echo "<option value='".$value->category_id."'>".$value->category."</option>";
            }
            ?>
            <option value="new">New Category </option>
         </select>
      </div>
      <!--category hidden-->

      <!--currency hidden-->
      <div id="currency-html" style="display: none;">
        <select class="" data-show-subtext="true" data-live-search="true" name="currency[]"  name="currency" >
            <option value="">Select Currency </option>
             <?php
              foreach ($currency as $key => $value)
              {
                 echo "<option value='".$value->currency_id."'>".$value->currency."</option>";
              }
              ?>
         </select>
      </div>
      <!--currency hidden-->
      <!--currency hidden-->
      <div id="duration-html" style="display: none;">
        <select class=" duration" data-show-subtext="true" data-live-search="true" name="duration[]" >
            <option value="">Select Duration </option>
            <option value="15">15 min </option>
            <option value="30">30 min </option>
            <option value="45">45 min </option>
            <option value="60">60 min </option>
            <option value="Custom">Custom min </option>
         </select>
      </div>
      <!--currency hidden-->

      <!-- <script src="js/bootstrap.min.js"></script> -->
      <script src="{{asset('public/assets/website/js/jquery.min.js')}}"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
      <script src="{{asset('public/assets/website/js/parallax.min.js')}}"></script> 
      <script src="{{asset('public/assets/website/js/script.js')}}"></script>
      <script src="{{asset('public/assets/website/js/custom-selectbox.js')}}"></script>
      <!--=================select box=========================-->
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
       <script src="{{asset('public/assets/website/js/jquery.validate.min.js')}}"></script>
      <!--==================Sweetalert=========================-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
       <!--=================select box=========================-->
      <script type="text/javascript">
         //================catrgory select ==================
            
        // $(document).ready(function(){
            //$(document).find('select.category').on('change', function() {
               $(document).on('change','.category',function() {
               //$('.category').on('change', function(event){
               let val = $(this).val();
               //alert(val);
               if(val=="new")
               {
                  $(this).parent().siblings(".new-category-name").show();
               }
               else
               {
                  $(this).parent().siblings(".new-category-name").hide();
               }
            });
         //});
         //================category select end ==================

         //================catrgory select ======================
            //$(document).find('select.duration').on('change', function() {
            $(document).on('change','.duration',function() {
            let val = $(this).val();
            if(val=="Custom")
            {
               $(this).parent().siblings(".custom-duration").show();
            }
            else
            {
               $(this).parent().siblings(".custom-duration").hide();
            }
         });
         //================category select end ==================

         //================Tab select ==================
         $(document).on('click','.user-status',function(event) {
         //$('.user-status').click(function(event) {
            event.preventDefault(); 
            //capacity
            var val = $(this).text();
            if(val=="One to One")
            {
               $(this).parent().next().next(".capacity").hide();
               $(this).parent().next(".capacity").find(".group").removeClass('tg-btn-ac');
               $(this).parent().next(".capacity").find(".group").addClass('tg-btn');
               $(this).addClass('tg-btn-ac');
               
            }
            else if(val=="Group")
            {
               $(this).parent().siblings(".capacity").show();
               $(this).addClass('tg-btn-ac');
               $(this).parent().prev(".capacity").find(".one-to-one").removeClass('tg-btn-ac');
               $(this).parent().prev(".capacity").find(".one-to-one").addClass('tg-btn');
            }
         });
         //================Tab select end ==================
         //================Add more category================
         $('.add-new').click(function(event) {
            event.preventDefault(); 

            let category = $("#category-html").html();
            let currency = $("#currency-html").html();
            let duration = $("#duration-html").html();
            //let imgurl = "{{asset('public/assets/website/images/reg-icon-category.png')}}";
            let html = '<div class="clone-div"><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">'+category+'<div class="clearfix"></div></div><div class="form-group new-category-name" style="display: none;"><img src="{{asset('public/assets/website/images/reg-icon-category.png')}}"><input type="text" class="form-control" placeholder="Category Name " name="new_category_name[]" ><div class="clearfix"></div></div><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-category.png')}}"><input type="text" class="form-control" placeholder="Service Name " name="service[]" ><div class="clearfix"></div></div><div class="row"><div class="col-md-6"><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}"><input type="text" class="form-control" placeholder="Cost " name="cost[]" ><div class="clearfix"></div></div></div><div class="col-md-6 drop-sm"><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">'+currency+'<div class="clearfix"></div></div></div></div><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">'+duration+'<div class="clearfix"></div></div><div class="form-group custom-duration" style="display: none;"><img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}"><input type="text" class="form-control" placeholder="Custom duration " name="custom_duration[]" ><div class="clearfix"></div></div><div class="row"><div class="col-md-4 capacity"><a href="" class="tg-btn-ac user-status one-to-one">One to One</a></div><div class="col-md-3 capacity"><a href="" class="tg-btn user-status group">Group</a></div><div class="col-md-5 capacity" style="display: none;"><div class="form-group"><img src="{{asset('public/assets/website/images/reg-icon-capacity.png')}}"><input type="text" class="form-control" placeholder="Capacity " name="capacity[]"><div class="clearfix"></div></div></div></div><div class="row"><div class="col-md-12">&nbsp;</div><div class="col-md-4"><a href="" class="remove-new"><i class="fa fa-minus"></i> Remove</a></div></div></div>';
            $(".clone-div").last().after(html);

            $('.clone-div').find('select').addClass('selectpicker');
            //$('.selectpicker').selectpicker('refresh');
            $('.selectpicker').selectpicker('render');


         });
         //================Add more category================
         //================add more remove==================
         $(document).on('click','.remove-new',function(event) {
           event.preventDefault();
           $(this).parents('.clone-div').remove();
         });
         //================add more remove==================
      //================Submit AJAX request ==================
      $("#submit").bind('click',function(e){
         e.preventDefault();
         $('#registration-form-two').submit();
      });



      $('#registration-form-two').validate({
            ignore: ":hidden:not(.selectpicker)",
            //ignore: [],
            rules: {
                'category[]': {
                    required: true
                },
                'service[]': {
                    required: true
                },
                'cost[]': {
                    required: true
                },
                'currency[]': {
                    required: true
                },
                'duration[]': {
                    required: true
                },
                
                
            },
            
            messages: {
                'category[]': {
                    required: 'Please select category'
                },
                'service[]': {
                    required: 'Please enter service'
                },
                'cost[]': {
                    required: 'Please enter cost'
                },
                'currency[]': {
                    required: 'Please enter currency'
                },
                'duration[]': {
                    required: 'Please enter duration'
                },
            },

            submitHandler: function(form) {
              var data = $(form).serializeArray();
              console.log(data);
              $.ajax({
                  url: form.action,
                  type: form.method,
                  data:data ,
                  dataType: "json",
                  success: function(response) {
                       console.log(response);
                       if(response.result=='1')
                       {
                           window.location = js_base_url+'login';
                       }
                       else
                       {
                           swal("Error", response.message , "error");
                           setTimeout(function(){ 

                              window.location = js_base_url+'login';

                           }, 3000);
                           
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
      //================Submit AJAX request ==================
      </script>
   </body>
</html>