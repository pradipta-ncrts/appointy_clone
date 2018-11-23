@extends('../layouts/mobile/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<header class="mobileHeader showMobile" id="divBh">
    <a class="showSidenav"><img src="{{asset('public/assets/mobile/images/menu-icon.png')}}" /> </a>
    <h1>Dashboard</h1>
    <ul>
        <li>&nbsp;</li>
        <!-- <li><a> <img src="{{asset('public/assets/mobile/images/mobile-notes.png')}}" /></a> </li>
        <li><a> <img src="{{asset('public/assets/mobile/images/mobile-serach.png')}}" /></a> </li> -->
    </ul>
</header>

<div class="menuoverlay">
    <div class="sideNavbar sideToggle">
        <div class="profileMenuImg">
            <a href="{{url('mobile/my-profile')}}"><img src="{{asset('public/assets/mobile/images/profilepicmobile.jpg')}}" /></a>
            <span>Esther F. Gladden</span>
        </div>
        <ul>
            <li><a href="{{url('mobile/booking-list')}}"><img src="{{asset('public/assets/mobile/images/sidenav/bookings.png')}}" /> <span>Bookings</span> </a> </li>
            <li><a href="{{url('mobile/review-list')}}"><img src="{{asset('public/assets/mobile/images/sidenav/review.png')}}" /> <span>Feedback</span> </a> </li>
            <li><a href="{{url('mobile/client-list')}}"><img src="{{asset('public/assets/mobile/images/sidenav/customers.png')}}" /> <span>Customers</span> </a> </li>
            <li><a href="{{url('mobile/settings')}}"><img src="{{asset('public/assets/mobile/images/sidenav/feedback.png')}}" /> <span>Settings</span> </a> </li>
            <!-- <li><a><img src="{{asset('public/assets/mobile/images/sidenav/customers.png')}}" /> <span>Customers</span> </a> </li> -->
            <li><a><img src="{{asset('public/assets/mobile/images/sidenav/background.png')}}" /> <span>Change Background </span> </a> </li>
            <li><a><img src="{{asset('public/assets/mobile/images/sidenav/about.png')}}" /> <span>About</span> </a> </li>
            <li><a href="{{url('mobile/logout')}}"><img src="{{asset('public/assets/mobile/images/sidenav/logout.png')}}" /> <span>Logout</span> </a> </li>
        </ul>
    </div>
</div>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashHeader showMobile">
                    <div class="dashSchedule">
                        <ul>
                            <li><span>Wed, Apr 25, 2018</span></li>
                            <li><img src="{{asset('public/assets/mobile/images/mobile-control-icons/mobile-calender.png')}}" /> </li>
                        </ul>
                        <ul>
                            <li><a>Day</a></li>
                            <li><a>Week</a> </li>
                            <li><a>Month</a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive showMobile" id="tbleDash">
                    <table class="table table-bordered table-custom table-dashboard">
                        <thead>
                            <tr>
                                <th> <i class="fa fa-gear showMobile"></i>
                                </th>
                                <th class="mobileHead"><span class="name">Minnie </span><img src="{{asset('public/assets/mobile/images/table-arrow-down.png')}}"
                                        class="showMobile" />

                                    <img src="{{asset('public/assets/mobile/images/table-dots.png')}}" class="showMobile pull-right" />
                                    <ul>
                                        <li><img src="{{asset('public/assets/mobile/images/table-calender.png')}}" /><span>See Weekly Schedule </span></li>
                                        <li><img src="{{asset('public/assets/mobile/images/block-icon.png')}}" /><span>Block</span> </li>
                                    </ul>
                                </th>
                                <th><span class="name">Thomas</span>
                                    <ul>
                                        <li><img src="{{asset('public/assets/mobile/images/table-calender.png')}}" /><span>See Weekly Schedule</span>
                                        </li>
                                        <li><img src="{{asset('public/assets/mobile/images/block-icon.png')}}" /><span>Block</span> </li>
                                    </ul>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10 am</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>11 am</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>12 am</td>
                                <td class="bluebg">
                                    <div class="showMobile">
                                        <ul>
                                            <li>
                                                <h4>12:15 PM</h4>
                                            </li>
                                            <li>
                                                <p>( 1 Hours ) - $200</p>
                                            </li>
                                        </ul>

                                        <h5>Smile corrections</h5>
                                        <label>New Brunswick, New Jersey, United States</label>

                                        <ul>
                                            <li><img src="{{asset('public/assets/mobile/images/tbl-phone.png')}}" />
                                                <p> 222-333-4444</p>
                                            </li>
                                            <li><img src="{{asset('public/assets/mobile/images/tbl-doc.png')}}" />
                                                <p>Notes</p>
                                            </li>
                                        </ul>

                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1 pm</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2 pm</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('custom_js')

@endsection