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
      <link href="{{asset('public/assets/website/css/app.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/custom.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/css/ncrts.css')}}" rel="stylesheet">
      <link href="{{asset('public/assets/website/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
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
                  <h2>Resource, Services <br> & Events passes </h2>
               </div>
               <div class="col-lg-5 col-md-6 col-sm-6 from-reg1">
                  <form class="form-horizontal clearfix" action="{{ url('api/process-registration-step2') }}" method="post" id="process-registration-step2">
                   <div class="clone-div12 row-2">
                      
                   </div>
                  </form>

                  <form class="form-horizontal" action="" method="post" autocomplete="off" id="registration-form-two">
                     <div class="clone-div">
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <select class="selectpicker category" data-show-subtext="true" data-live-search="true"  name="category" id="category" >
                              <option value="">Select Category </option>
                              <?php
                               foreach ($category as $key => $value)
                               {
                                  echo "<option value='".$value->category_id."'>".$value->category."</option>";
                               }
                               ?>                              
                              <option value="new">New Category</option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group new-category-name" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Category Name " name="new_category_name" id="new_category_name">
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-category.png')}}">
                           <input type="text" class="form-control" placeholder="Service Name " name="service" id="service">
                           <div class="clearfix"></div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <input type="text" class="form-control" placeholder="Cost" name="cost" id="cost">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="col-md-6 drop-sm">
                              <div class="form-group">
                                 <img src="{{asset('public/assets/website/images/reg-icon-currency.png')}}">
                                 <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="currency" id="currency">
                                    <option value="">Select Currency </option>
                                    <?php
                                     foreach ($currency as $key => $value)
                                     {
                                        echo "<option value='".$value->currency_id."'>".$value->currency_icon."</option>";
                                     }
                                     ?>
                                 </select>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <select class="selectpicker duration" data-show-subtext="true" data-live-search="true" name="duration" id="duration" >
                              <option value="">Select Duration </option>
                              <option value="15">15 min </option>
                              <option value="30">30 min </option>
                              <option value="45">45 min </option>
                              <option value="60">60 min </option>
                              <option value="Custom">Custom min</option>
                           </select>
                           <div class="clearfix"></div>
                        </div>
                        <div class="form-group custom-duration" style="display: none;">
                           <img src="{{asset('public/assets/website/images/reg-icon-duration.png')}}">
                           <input type="text" class="form-control" placeholder="Custom duration " name="custom_duration" id="custom_duration">
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
                                 <input type="text" class="form-control" placeholder="Capacity " name="capacity" id="capacity">
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
                   </form>
                     <div class="row">
                        <div class="col-md-4"><button type="button" id="skip">Skip</button></div>
                        <div class="col-md-4"> <button type="button" id="submit" style="display: none;">Submit</button></div>
                     </div>
                     <div class="clearfix"></div>
               </div>
            </div>
         </div>
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
      <script src="{{asset('public/assets/website/plugins/sweetalert/sweetalert.min.js')}}"></script>
      <!--=================select box=========================-->
      <script type="text/javascript">
         //================catrgory select ==================
            //$(document).ready(function(){
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
               $("#capacity").val('');
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
         //================Submit AJAX request ==================
         $(".add-new").bind('click',function(e){
           e.preventDefault();
           $('#registration-form-two').submit();
         });

         $('#registration-form-two').validate({
            ignore: ":hidden:not(.selectpicker)",
            //ignore: [],
            rules: {
                'category': {
                    required: true
                },
                'service': {
                    required: true
                },
                'cost': {
                    required: true,
                    number: true
                },
                'currency': {
                    required: true
                },
                'duration': {
                    required: true
                },
                'custom_duration': {
                    required: true,
                    number: true
                },
                'capacity': {
                    required: true,
                    number: true
                },
            },
            messages: {
                'category': {
                    required: 'Please select category'
                },
                'service': {
                    required: 'Please enter service'
                },
                'cost': {
                    required: 'Please enter cost'         
                },
                'currency': {
                    required: 'Please enter currency'         
                },
                'duration': {
                    required: 'Please enter duration'
                },
                'custom_duration': {
                    required: 'Please enter duration'
                },
                'capacity': {
                    required: 'Please enter capacity'
                },
            },
            submitHandler: function(form) {
              var data = $(form).serializeArray();
              data = JSON.stringify(data);
              var html = "<input type='hidden' class='service_data' name='service_data[]' value='"+data+"'>";
              //$(".new_form_data").last().after(html);
              
              var preview_data = JSON.parse(data);
              
              var category = $("#category option:selected").text();
              if(category=="New Category")
              {
                  category = $("#new_category_name").val();
              }
              else
              {
                  category = $("#category option:selected").text();
              }
              var service = $("#service").val();
              var cost = $("#cost").val();
              var currency = $("#currency").val();
              var currency_array = '<?=json_encode($currency);?>';
              var currency_array = JSON.parse(currency_array);
              for (var i=0;i<currency_array.length;i++)
              {
                  if(currency_array[i].currency_id==currency)
                  {
                    var currency_icon = currency_array[i].currency;
                  }
              }
              var duration = $("#duration option:selected").text();
              if(duration=="Custom min")
              {
                  duration = $("#custom_duration").val()+' min';
              }
              else
              {
                 duration = $("#duration option:selected").text();
              }

              var capacity = $("#capacity").val();
              if(capacity)
              {
                  capacity = capacity;
              }
              else
              {
                  capacity = 0;
              }


              var preview_html = '<div class="clone-div12 row-2">'+html+'<div class="row"><div class="col-md-10"><div class="appointment mobSevices"><div class="col-md-6"><p>'+service+'</p><span>'+duration+'<small>'+currency_icon+' '+cost+'</small></span> </div><div class="col-md-6"><p>'+category+'</p><span>Capacity: '+capacity+'</span> </div></div></div><div class="col-md-2"><a href="" class="remvbtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></div></div>';

              $(".clone-div12.row-2").last().after(preview_html);
              $("#registration-form-two").trigger('reset');
              $("#category").val('default');
              $("#category").selectpicker("refresh");
              $(".new-category-name").hide();
              $("#currency").val('default');
              $("#currency").selectpicker("refresh");
              $("#duration").val('default');
              $("#duration").selectpicker("refresh");
              $(".custom-duration").hide();
              $("#submit").show();


              
            }
         });

         //================Submit AJAX request ==================
         $("#skip").click(function(){
            var login_url = js_base_url+'login';
            swal({title: "Success", text: "Thank you for registering with us. Please login to continue.", type: "success"},
            function(){ 
                window.location = login_url;
            })
         });

         $(document).on('click','#submit',function(event) {
         event.preventDefault();
         alert();
         $("#process-registration-step2").submit();
         
         });
      </script>
      <script type="text/javascript">
      $(document).on('click','.remvbtn',function(event) {
         event.preventDefault();
         var count = $('.clone-div12.row-2').length;
         if(count==2)
         {
            $("#submit").hide();
         }
         $(this).parents('.clone-div12.row-2').remove();
      });
      </script>
   </body>
</html>