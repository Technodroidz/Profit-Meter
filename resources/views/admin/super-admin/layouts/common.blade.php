<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profitrack | Super admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , R`esponsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('')}}files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="{{asset('')}}files/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- Menu sidebar static layout -->
<body>
    
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <!-- Pre-loader start -->
            <div class="theme-loader">
                <div class="ball-scale">
                    <div class='contain'>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pre-loader end -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>  
                        <a href="{{asset('admin-panel')}}">
                            <span>Profitrack</span>
                             <!--  @if(isset($getbasic['getcompany']['0']['logo']) && !empty($getbasic['getcompany']['0']['logo']))
                            <img src="{{asset('images/'.$getbasic['getcompany']['0']['logo'])}}" class="img-circle" height="150" width="50" alt="User Image" style="height:auto;">
                            @else
                           
                            <img src="{{asset('')}}admin/dist/img/user2-160x160.jpg" class="img-circle " height="150" width="50" style="height:auto;" alt="User Image">
                            @endif -->
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">                           
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                         @if(!empty(Auth::guard('webadmin')->user()->profile_picture))
                                            <img src="{{asset('images/'.Auth::guard('webadmin')->user()->profile_picture)}}" class="img-circle" height="120" width="100" alt="User Image" style="height:auto;">
                                            @else
                                            <img src="{{asset('')}}admin/dist/img/user2-160x160.jpg" class="img-circle " alt="User Image">
                                          @endif
                                        <span>{{Auth::guard('webadmin')->user()->name}}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="{{asset('profile')}}">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{asset('logout')}}">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                        <div class="form-icon">
                                            <i class="icofont icofont-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="{{ asset('files/assets/images/avatar-3.jpg') }}" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="{{asset('')}}files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="{{asset('')}}files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="{{asset('')}}files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="{{asset('')}}files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="{{asset('')}}files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="{{asset('')}}files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{asset('admin-panel')}}">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>

                                 <!-- <li class="">
                                    <a href="{{asset('company-details')}}">
                                        <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                                        <span class="pcoded-mtext">Company Details</span>
                                    </a>
                                </li> -->
                                
                                <li class="">
                                    <a href="{{asset('subscription')}}">
                                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                                        <span class="pcoded-mtext">Subscription Plan</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="{{asset('report')}}">
                                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                                        <span class="pcoded-mtext">Report</span>
                                    </a>
                                </li>
                               
                                <li class="">
                                    <a href="{{asset('user-list')}}">
                                        <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                                        <span class="pcoded-mtext">Business User List</span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                        <span class="pcoded-mtext">Settings</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="{{asset('paymentgateway')}}">
                                                <span class="pcoded-mtext">Payment Gateway</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{asset('email')}}">
                                                <span class="pcoded-mtext">Email</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{asset('templete')}}">
                                                <span class="pcoded-mtext">Email Templates</span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="{{asset('view_pages')}}">
                                                <span class="pcoded-mtext">Pages</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    @yield('content')

                </div>
            </div>
        </div>
    </div>

<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('')}}files/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('')}}files/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('')}}files/bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="{{asset('')}}files/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="{{asset('')}}files/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{asset('')}}files/bower_components/datedropper/datedropper.min.js"></script>
    <!-- data-table js -->
    <script src="{{asset('')}}files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('')}}files/assets/pages/data-table/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('')}}files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('')}}files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
  
    <!-- echart js -->
    <script src="{{asset('')}}files/assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>
    <!-- i18next.min.js -->

    <script type="text/javascript" src="{{asset('')}}files/bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
    <script src="{{asset('')}}files/assets/pages/user-profile.js"></script>
    <script src="{{asset('')}}files/assets/js/pcoded.min.js"></script>
    <script src="{{asset('')}}files/assets/js/vartical-layout.min.js"></script>
    <script src="{{asset('')}}files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('')}}files/assets/js/script.js"></script>
    <script src="{{asset('')}}backend/js/demo/peity-demo.js"></script>
    <script src="{{asset('')}}backend/js/plugins/validate/jquery.validate.min.js"></script>
      <script src="{{ asset('admin_new/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/dataTables.bootstrap.min.js') }}"></script>
   
    @yield('custom_script')
</body>

</html>
