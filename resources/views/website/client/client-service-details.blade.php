@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection
@section('content')
<div class="body-part">
    <div class="container-custm">
    <?php if(!empty($service_details)) { ?>

        <div class="upper-cmnsection">
            <div class="heading-uprlft">Service Details</div>
            <div class="upr-rgtsec">
                <div class="col-sm-5">
                <div id="custom-search-input">
                    <!--<div class="input-group ">
                        <input type="text" class="  search-query form-control" placeholder="Search" />
                        <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"> <span class=" glyphicon glyphicon-search"></span> </button>
                        </span> 
                    </div>-->
                </div>
                </div>
                <button class="btn btn-primary pull-right" type="button"> Book Now</button>
            </div>
        </div>

        <div class="leftpan">
            <div class="left-menu">
                <ul>
                <?php if(!empty($service_list)) { foreach($service_list as $service) { ?>
                <li><a href="{{url('client/service-details/'.$service->service_link)}}" <?php if(Request::segment(3) == $service->service_link) { ?> class="active" <?php } ?>> {{$service->service_name}}</a></li>
                <?php } } ?>
                </ul>
            </div>
        </div>

        <div class="rightpan">
            <div class="relativePostion">
                <div class=" showDekstop clearfix">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <div class="staff-detail">
                            <div class="booking-listnw">
                                <div class="booking-listnw-bx">
                                    <div class="staff-detailtab-bx">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                <div class="col-sm-10">
                                                    <h4>{{$service_details->service_name}}</h4>
                                                    <?php if($service_details->location!='') { ?>
                                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$service_details->location}}</p>
                                                    <?php } ?>
                                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$service_details->duration}} mins</p>
                                                </div>
                                                <div class="col-sm-2"><button type="button" class="btn btn-default pull-right"> <!--<i class="fa fa-usd" aria-hidden="true"></i>-->{{$service_details->currency}} {{$service_details->cost}} </button></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>Service Description</h4>
                                                    <p>{{$service_details->description}}</p>
                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                <div class="col-sm-10">
                                                    <h4>Link</h4>
                                                    <p id="bookingUrl">{{url('client/service-details/'.$service_details->service_link)}}</p>
                                                </div>
                                                <!--<div class="col-sm-2">
                                                    <button type="button" class="btn btn-default pull-right"> <i class="fa fa-files-o" aria-hidden="true"></i> COPY </button>
                                                </div>-->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                <div class="col-sm-10">
                                                    <h4>Accept Payment</h4>
                                                    <p>
                                                    <div class="paypal-iconbx">
                                                    <?php if($service_details->payment_method == '1') { ?>
                                                        Free
                                                    <?php } else if($service_details->payment_method == '2') { ?>
                                                        <img src="{{asset('public/assets/website/images/paypal.png')}}"/>
                                                    <?php } else if($service_details->payment_method == '3') { ?>
                                                        <img src="{{asset('public/assets/website/images/stripe-logo.png')}}"/>
                                                    <?php } else { ?>
                                                        <img src="{{asset('public/assets/website/images/paypal.png')}}"/>
                                                        <img src="{{asset('public/assets/website/images/stripe-logo.png')}}"/>
                                                    <?php } ?>
                                                    </div></p>
                                                </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custm-tab team-memtab">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tabmenu1">Active</a></li>
                    <li><a data-toggle="tab" href="#tabmenu2">Inactive</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tabmenu1" class="tab-pane fade in active">
                        <div class="mobileStaff showMobile">
                            <div class="whitebox">
                                <h2>Dr. Concepcion M.</h2>
                                <span>Psychiatrist</span>
                                <ul>
                                <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                                <li><i class="fa fa-phone"></i>802-438-0497</li>
                                </ul>
                                <ol>
                                <li>Addiction, Alcoholism</li>
                                <li>Sleep Medicine</li>
                                <li><a>More </a></li>
                                </ol>
                            </div>
                            <div class="whitebox">
                                <h2>Dr. Concepcion M.</h2>
                                <span>Psychiatrist</span>
                                <ul>
                                <li><i class="fa fa-envelope"></i>LateshaJ@gmail.com</li>
                                <li><i class="fa fa-phone"></i>802-438-0497</li>
                                </ul>
                                <ol>
                                <li>Addiction, Alcoholism</li>
                                <li>Sleep Medicine</li>
                                <li><a>More </a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div id="tabmenu2" class="tab-pane fade">
                        <p>Some content in tab menu 2.</p>
                    </div>
                </div>
            </div>
            
        </div>

    <?php } else { ?>

        <div class="upper-cmnsection">
            <div class="heading-uprlft" style="padding-bottom:8px">Sorry, No service found</div>
        </div>

    <?php } ?>

    </div>
</div>
@endsection

@section('custom_js')

@endsection