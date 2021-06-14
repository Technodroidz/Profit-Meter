<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/forgot_pass.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:53:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Reset Password</title>

    <link rel="icon" href="{{asset('business_app')}}/img/mini_logo.png" type="image/png">
    <!-- <link rel="icon" href="img/favicon.png" type="image/png"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/bootstrap.min.css" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/vendors/font_awesome/css/all.min.css" />
    <!-- datatable CSS -->
     <!-- scrollabe  -->
     <link rel="stylesheet" href="{{asset('business_app')}}/vendors/scroll/scrollable.css" />

    <!-- menu css  -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('business_app')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('business_app')}}/css/colors/default.css" id="colorSkinCSS">
</head>
<body class="crm_body_bg">


<section class="main_content dashboard_part large_header_bg" style="padding-left: unset;">
    
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <!-- <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3> Default Dashboard</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-right">
                                    <p><a href="index-2.html">Dashboard</a> <i class="fas fa-caret-right"></i> Forgot Password</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <!-- sign_in  -->
                                <div class="modal-content cs_modal">
                                    <div class="modal-header theme_bg_1">
                                        <h5 class="modal-title text_white">Reset Password</h5>
                                    </div>
                                    <div class="modal-body">
                                        @if(session()->has('error'))
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                              <strong>{{ session()->get('error') }}</strong>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                        @endif
                                        @if(session()->has('success'))
                                            <div class="alert alert-success alert-dismissable hiddenError" role="alert">
                                                {{ session()->get('success') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('update_business_reset_password') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm  Password">
                                            </div>
                                            <button type="submit" class="btn_1 full_width text-center">SEND</button>
                                        
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer part -->
<div class="footer_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> DashboardPack</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main content part end -->

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
  </div>
  <!-- footer  -->
  <!-- jquery slim -->
  <script src="{{asset('business_app')}}/js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="{{asset('business_app')}}/js/popper.min.js"></script>
  <!-- bootstarp js -->
  <script src="{{asset('business_app')}}/js/bootstrap.min.js"></script>
  <!-- sidebar menu  -->
  <script src="{{asset('business_app')}}/js/metisMenu.js"></script>
  
  <!-- scrollabe  -->
  <script src="{{asset('business_app')}}/vendors/scroll/perfect-scrollbar.min.js"></script>
  <script src="{{asset('business_app')}}/vendors/scroll/scrollable-custom.js"></script>
  
  <!-- custom js -->
  <script src="{{asset('business_app')}}/js/custom.js"></script>
  </body>
  
<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/forgot_pass.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:53:51 GMT -->
</html>