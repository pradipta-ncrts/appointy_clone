@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh"> 
  <a href="{{url('mobile/dashboard')}}"><img src="{{asset('public/assets/mobile/images/mobile-back.png')}}" /> </a>
  <h1>Staff List</h1>
  <ul>
    <li><a href="{{url('mobile/add-staff')}}"><img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
  </ul>
</header>
<main>
   <div class="container-fluid">
      <div class="row">
         <div class="mobileStaff break10px showMobile" >
            <?php
            if(!empty($staff_list))
            {
              foreach ($staff_list as $key => $value)
              {
            ?>
            <div class="whitebox">
               <h2><?=$value->full_name;?></h2>
               <span><?=$value->expertise;?></span>
               <ul>
                  <li><i class="fa fa-envelope"></i><?=$value->email;?></li>
                  <li><i class="fa fa-phone"></i><?=$value->mobile ? $value->mobile : 'NIL'; ?></li>
               </ul>
               <ol>
                  <li><?=$value->addess;?></li>
                  <!-- <li>Sleep Medicine</li>
                  <li><a>More </a></li> -->
               </ol>
            </div>
            <?php
                }
            }
            else
            {
            ?>
              <div class="whitebox">
               <h2>No data found.</h2>
              </div>
            <?php
            }
            ?>
         </div>
      </div>
   </div>
</main>

@endsection


@section('custom_js')
<script type="text/javascript">
  function ShowPopup() {
         
             $("#popup").fadeToggle();
         
         }
</script>
@endsection