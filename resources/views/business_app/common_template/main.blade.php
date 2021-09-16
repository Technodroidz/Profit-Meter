<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:49:09 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profitrack</title>

    <link rel="icon" href="{{asset('business_app')}}/img/mini_logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/bootstrap.min.css" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/themefy_icon/themify-icons.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/owl_carousel/css/owl.carousel.css" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/gijgo/gijgo.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/tagsinput/tagsinput.css" />

    <!-- date picker -->
     <link rel="stylesheet" href="{{asset('business_app')}}/vendors/datepicker/date-picker.css" />

     <link rel="stylesheet" href="{{asset('business_app')}}/vendors/vectormap-home/vectormap-2.0.2.css" />
     
     <!-- scrollabe  -->
     <link rel="stylesheet" href="{{asset('business_app')}}/vendors/scroll/scrollable.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/datatable/css/buttons.dataTables.min.css" />
    <!-- text editor css -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/text_editor/summernote-bs4.css" />
    <!-- morris css -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/material_icon/material-icons.css" />

    <!-- menu css  -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/css/colors/default.css" id="colorSkinCSS">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    

</head>
<body class="crm_body_bg">
    


<!-- main content part here -->
 
<!-- sidebar  -->
<nav class="sidebar dark_sidebar" data-current_link="{{isset($current_link) ? $current_link : ''}}" >
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="{{route('home')}}"><img src="{{asset('business_app')}}/img/mini.png" alt="Profitrack"></a>
        <a class="small_logo" href="{{route('home')}}"><img src="{{asset('business_app')}}/img/mini.png" alt="Profitrack"></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        @if(session()->get('user_subscribed') == true)
        <li class="">
            <a href="{{route('home')}}" aria-expanded="false" data-link="home">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/1.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Dashboard </span>
                </div>
            </a>
           <!--  <ul>
                <li><a href="index_2.html">Default</a></li>
              <li><a href="index_3.html">Light Sidebar</a></li>
              <li><a href="index-2.html">Dark Sidebar</a></li>
            </ul> -->
        </li>
        <li class="">
            <a  href="{{route('business_simulator')}}" aria-expanded="false" data-link="simulator">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Simulator</span>
                </div>
            </a>
        </li>
        <li class="">
            <a  href="{{route('business_lifetime_value')}}" aria-expanded="false" data-link="lifetime_value">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/3.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Lifetime Value</span>
                </div>
            </a>
        </li> 
        <li class="">
            <a class="has-arrow" href="javascript:void(0);" aria-expanded="false" data-link="reports">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/4.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Reports</span>
                </div>
            </a>

            <ul>
                <li><a href="{{route('business_report_products')}}" data-link="products">Products</a></li>
                <li><a href="{{route('business_report_orders')}}" data-link="orders">Orders</a></li>
                <li><a href="{{route('business_report_map')}}" data-link="map">Map</a></li>
                <li><a href="{{route('business_report_disputes')}}" data-link="disputes">Disputes</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="javascript:void(0);" aria-expanded="false" data-link="expenses">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/5.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Expenses</span>
                </div>
            </a>

            <ul>
                <li><a href="{{route('business_expenses_product_cost')}}" data-link="product_cost">Product Costs</a></li>
                <li><a href="{{route('business_expenses_shipping_cost')}}" data-link="shipping_cost">Shipping Costs</a></li>
                <!-- <li><a href="{{route('business_expenses_handling_cost')}}" data-link="handling_cost">Handling Costs</a></li> -->
                <li><a href="{{route('tax')}}" data-link="tax">Tax</a></li>
                <li><a href="{{route('business_expenses_transaction_cost')}}" data-link="transaction_cost">Transaction Costs</a></li>
                <!-- <li><a href="{{route('business_category')}}" data-link="business_category">Category</a></li> -->
                <li><a href="{{route('business_expenses_custom_cost')}}" data-link="custom_cost">Custom Costs</a></li>
          
            </ul>
        </li>
        <!--   <li class="">
            <a href="Channels.html" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Channels</span>
                </div>
            </a>
            
        </li> -->
        <li class="">
            <a href="{{route('business_integration')}}" aria-expanded="false" data-link="integration">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/7.svg" alt="">
                </div>
                <div class="nav_title">
                       <span>Integrations</span>
                </div>
            </a>
            
        </li>

        @endif
        <li class="">
            <a class="has-arrow" href="javascript:void(0);" aria-expanded="false" data-link="setting">
                <div class="nav_icon_small">
                    <img src="{{asset('business_app')}}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Settings</span>
                </div>
            </a>
            <ul>
                <li><a href="{{route('business_setting_rules')}}" data-link="rules">Rules</a></li>
                @if(session()->get('user_subscribed') == true)
                    <li><a href="{{route('business_setting_sync_status')}}" data-link="sync_status">Sync Status</a></li>
                @endif
                <li><a href="{{route('business_setting_account')}}" data-link="account">Account</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!--/ sidebar  -->


<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="line_icon open_miniSide d-none d-lg-block" style="cursor:pointer;">
                        <img src="{{asset('business_app')}}/img/line_img.png" alt="">
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <!-- <li>
                                <a class="CHATBOX_open nav-link-notify" href="#"> <img src="{{asset('business_app')}}/img/icon/msg.svg" alt="">   </a>
                            </li> -->
                            <li>
                                <a class="bell_notification_clicker nav-link-notify" href="#"> <img src="{{asset('business_app')}}/img/icon/bell.svg" alt="">
                                    <!-- <span>2</span> -->
                                </a>
                                <!-- Menu_NOtification_Wrap  -->
                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    <h4>Notifications</h4>
                                </div>
                                <div class="Notification_body">
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/2.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>Cool Marketing </h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/4.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>Awesome packages</h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/3.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>what a packages</h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/2.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>Cool Marketing </h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/4.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>Awesome packages</h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <!-- single_notify  -->
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{asset('business_app')}}/img/staf/3.png" alt=""></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#"><h5>what a packages</h5></a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        <a href="#" class="btn_1 green">See More</a>
                                    </div>
                                </div>
                            </div>
                            <!--/ Menu_NOtification_Wrap  -->
                            </li>
                            
                        </div>
                        <div class="profile_info d-flex align-items-center">
                            <div class="profile_thumb mr_20">
                            
                               
                                @if(!empty(Auth::user()->profile_pick))
                                <img src="{{asset('images/'.Auth::user()->profile_pick)}}" class="img-circle" height="200" width="200" alt="User Image" style="height:auto;">
                                @else
                                <img src="{{asset('business_app')}}/img/transfer/4.png" alt="#">
                                @endif
                            </div>
                            <div class="author_name">
                                <h4 class="f_s_15 f_w_500 mb-0">{{Auth::User()->name}}</h4>
                                <!-- <p class="f_s_12 f_w_400">Manager</p> -->
                            </div>
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <!-- <p>Manager</p> -->
                                    <h5>{{Auth::User()->name}}</h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="{{route('business_setting_account')}}">My Profile </a>
                                    <!-- <a href="#">Settings</a> -->
                                    <a href="{{route('business_logout')}}">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner overly_inner ">
        <div class="alert alert-success alert-dismissible fade show success_message_div" role="alert" style="display:none;">
          <strong id="show_success_message">Success Message</strong>
          <button type="button" class="close dismiss_alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>{{ session()->get('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{!! session()->get('error') !!}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        @yield('content')

    </div>
    @yield('modal')
    <!-- footer part -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <p class="text-center">2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> DashboardPack</a></p>
            
            </div>
        </div>
    </div>
<!-- Loader html -->
    

<!-- Loader Html Ends -->
</section>
<!-- main content part end -->


<!-- ### CHAT_MESSAGE_BOX   ### -->

<div class="CHAT_MESSAGE_POPUPBOX">
    <div class="CHAT_POPUP_HEADER">
        <div class="MSEESAGE_CHATBOX_CLOSE">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.09939 5.98831L11.772 10.661C12.076 10.965 12.076 11.4564 11.772 11.7603C11.468 12.0643 10.9766 12.0643 10.6726 11.7603L5.99994 7.08762L1.32737 11.7603C1.02329 12.0643 0.532002 12.0643 0.228062 11.7603C-0.0760207 11.4564 -0.0760207 10.965 0.228062 10.661L4.90063 5.98831L0.228062 1.3156C-0.0760207 1.01166 -0.0760207 0.520226 0.228062 0.216286C0.379534 0.0646715 0.578697 -0.0114918 0.777717 -0.0114918C0.976738 -0.0114918 1.17576 0.0646715 1.32737 0.216286L5.99994 4.889L10.6726 0.216286C10.8243 0.0646715 11.0233 -0.0114918 11.2223 -0.0114918C11.4213 -0.0114918 11.6203 0.0646715 11.772 0.216286C12.076 0.520226 12.076 1.01166 11.772 1.3156L7.09939 5.98831Z" fill="white"/>
            </svg>
        </div>
        <h3>Chat with us</h3>
        <div class="Chat_Listed_member">
            <ul>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{asset('business_app')}}/img/staf/1.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{asset('business_app')}}/img/staf/2.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{asset('business_app')}}/img/staf/3.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{asset('business_app')}}/img/staf/4.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{asset('business_app')}}/img/staf/5.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                            <div class="more_member_count">
                                <span>90+</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="CHAT_POPUP_BODY">
        <p class="mesaged_send_date">
        Sunday, 12 January
        </p>
    
    <div class="CHATING_SENDER">
        <div class="SMS_thumb">
            <img src="{{asset('business_app')}}/img/staf/1.png" alt="">
        </div>
        <div class="SEND_SMS_VIEW">
            <P>Hi! Welcome .
            How can I help you?</P>
        </div>
    </div>
    
    <div class="CHATING_SENDER CHATING_RECEIVEr">
        
        <div class="SEND_SMS_VIEW">
            <P>Hello</P>
        </div>
        <div class="SMS_thumb">
            <img src="{{asset('business_app')}}/img/staf/1.png" alt="">
        </div>
    </div>
    
    </div>
    <div class="CHAT_POPUP_BOTTOM">
        <div class="chat_input_box d-flex align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Write your message" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn " type="button"> 
                        <!-- svg      -->
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.7821 3.21895C14.4908 -1.07281 7.50882 -1.07281 3.2183 3.21792C-1.07304 7.50864 -1.07263 14.4908 3.21872 18.7824C7.50882 23.0729 14.4908 23.0729 18.7817 18.7815C23.0726 14.4908 23.0724 7.50906 18.7821 3.21895ZM17.5813 17.5815C13.9525 21.2103 8.04773 21.2108 4.41871 17.5819C0.78907 13.9525 0.789485 8.04714 4.41871 4.41832C8.04752 0.789719 13.9521 0.789304 17.5817 4.41874C21.2105 8.04755 21.2101 13.9529 17.5813 17.5815ZM6.89503 8.02162C6.89503 7.31138 7.47107 6.73534 8.18131 6.73534C8.89135 6.73534 9.46739 7.31117 9.46739 8.02162C9.46739 8.73228 8.89135 9.30811 8.18131 9.30811C7.47107 9.30811 6.89503 8.73228 6.89503 8.02162ZM12.7274 8.02162C12.7274 7.31138 13.3038 6.73534 14.0141 6.73534C14.7241 6.73534 15.3002 7.31117 15.3002 8.02162C15.3002 8.73228 14.7243 9.30811 14.0141 9.30811C13.3038 9.30811 12.7274 8.73228 12.7274 8.02162ZM15.7683 13.2898C14.9712 15.1332 13.1043 16.3243 11.0126 16.3243C8.8758 16.3243 6.99792 15.1272 6.22834 13.2744C6.09642 12.9573 6.24681 12.593 6.56438 12.4611C6.64238 12.4289 6.72328 12.4136 6.80293 12.4136C7.04687 12.4136 7.27836 12.5577 7.37772 12.7973C7.95376 14.1842 9.38048 15.0799 11.0126 15.0799C12.6077 15.0799 14.0261 14.1836 14.626 12.7959C14.7625 12.4804 15.1288 12.335 15.4441 12.4717C15.7594 12.6084 15.9048 12.9745 15.7683 13.2898Z" fill="#707DB7"/>
                        </svg>

                        <!-- svg      -->
                    </button>
                    <button class="btn" type="button">
                         <!-- svg  -->
                         <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 0.289062C4.92455 0.289062 0 5.08402 0 10.9996C0 16.9152 4.92455 21.7101 11 21.7101C17.0755 21.7101 22 16.9145 22 10.9996C22 5.08472 17.0755 0.289062 11 0.289062ZM11 20.3713C5.68423 20.3713 1.375 16.1755 1.375 10.9996C1.375 5.82371 5.68423 1.62788 11 1.62788C16.3158 1.62788 20.625 5.82371 20.625 10.9996C20.625 16.1755 16.3158 20.3713 11 20.3713ZM15.125 10.3302H11.6875V6.98314C11.6875 6.61363 11.3795 6.31373 11 6.31373C10.6205 6.31373 10.3125 6.61363 10.3125 6.98314V10.3302H6.875C6.4955 10.3302 6.1875 10.6301 6.1875 10.9996C6.1875 11.3691 6.4955 11.669 6.875 11.669H10.3125V15.016C10.3125 15.3855 10.6205 15.6854 11 15.6854C11.3795 15.6854 11.6875 15.3855 11.6875 15.016V11.669H15.125C15.5045 11.669 15.8125 11.3691 15.8125 10.9996C15.8125 10.6301 15.5045 10.3302 15.125 10.3302Z" fill="#707DB7"/>
                        </svg>

                         <!-- svg  -->
                         <input type="file">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/### CHAT_MESSAGE_BOX  ### -->

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

<div id="confirm-mail" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="login-card card-block login-card-modal">
            <form class="md-float-material">
                <div class="text-center">
                    <img src="{{asset('')}}business_app/img/logo.png" alt="logo.png">
                </div>
                <div class="card m-t-15">
                    <div class="auth-box card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12 confirm">
                                <h3 class="text-center txt-primary"><i class="icofont icofont-check-circled text-primary"></i>
                                    Confirmation</h3>
                            </div>
                        </div>
                        <p class="text-inverse text-left m-t-15 f-16"><b>Dear
                                Username</p>
                        <p class="text-inverse text-left m-b-0">Welcome to our
                            website. Really Exciting to have you here!</p>
                        <p class="text-inverse text-left m-b-20">Please click the
                            link below to verify that this is your email address.
                        </p>
                        <p class="text-inverse text-left m-b-30">Thank you and enjoy
                            our website.</p>
                    </div>
                </div>
            </form>
            <!-- end of form -->
        </div>
    </div>
</div>

<!-- footer  -->
<script src="{{asset('business_app')}}/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="{{asset('business_app')}}/js/popper.min.js"></script>
<!-- bootstarp js -->
<script src="{{asset('business_app')}}/js/bootstrap.min.js"></script>
<!-- sidebar menu  -->
<script src="{{asset('business_app')}}/js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="{{asset('business_app')}}/vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="{{asset('business_app')}}/vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="{{asset('business_app')}}/vendors/count_up/jquery.counterup.min.js"></script>

<!-- nice select -->
<script src="{{asset('business_app')}}/vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="{{asset('business_app')}}/vendors/owl_carousel/js/owl.carousel.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<!-- responsive table -->
<script src="{{asset('business_app')}}/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/jszip.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/pdfmake.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/vfs_fonts.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="{{asset('business_app')}}/vendors/datatable/js/buttons.print.min.js"></script>

<!-- datepicker  -->
<script src="{{asset('business_app')}}/vendors/datepicker/datepicker.js"></script>
<script src="{{asset('business_app')}}/vendors/datepicker/datepicker.en.js"></script>
<script src="{{asset('business_app')}}/vendors/datepicker/datepicker.custom.js"></script>

<script src="{{asset('business_app')}}/js/chart.min.js"></script>
<script src="{{asset('business_app')}}/vendors/chartjs/roundedBar.min.js"></script>

<!-- progressbar js -->
<script src="{{asset('business_app')}}/vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="{{asset('business_app')}}/vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="{{asset('business_app')}}/vendors/text_editor/summernote-bs4.js"></script>
<script src="{{asset('business_app')}}/vendors/am_chart/amcharts.js"></script>

<!-- scrollabe  -->
<script src="{{asset('business_app')}}/vendors/scroll/perfect-scrollbar.min.js"></script>
<script src="{{asset('business_app')}}/vendors/scroll/scrollable-custom.js"></script>

<!-- vector map  -->
<script src="{{asset('business_app')}}/vendors/vectormap-home/vectormap-2.0.2.min.js"></script>
<script src="{{asset('business_app')}}/vendors/vectormap-home/vectormap-world-mill-en.js"></script>

<!-- apex chrat  -->
<script src="{{asset('business_app')}}/vendors/apex_chart/apex-chart2.js"></script>
<script src="{{asset('business_app')}}/vendors/apex_chart/apex_dashboard.js"></script>

<!-- <script src="{{asset('business_app')}}/vendors/echart/echarts.min.js"></script> -->

<!-- responsive table -->

<!-- custom js -->

<script src="{{asset('business_app')}}/vendors/chartjs/chartjs_init.js"></script>


<script src="{{asset('business_app')}}/vendors/chart_am/core.js"></script>
<script src="{{asset('business_app')}}/vendors/chart_am/charts.js"></script>
<script src="{{asset('business_app')}}/vendors/chart_am/animated.js"></script>
<script src="{{asset('business_app')}}/vendors/chart_am/kelly.js"></script>
<script src="{{asset('business_app')}}/vendors/chart_am/chart-custom.js"></script>
<!-- custom js -->
<script src="{{asset('business_app')}}/js/dashboard_init.js"></script>
<script src="{{asset('business_app')}}/js/custom.js"></script>
<script src="{{asset('business_app')}}/js/business_app_custom.js"></script>

<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
    <script src="{{asset('')}}backend/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ asset('admin_new/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/sweetalert.min.js') }}"></script>
@yield('script')

</body>

<div class="se-pre-con"></div>

<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:53:00 GMT -->
</html>
