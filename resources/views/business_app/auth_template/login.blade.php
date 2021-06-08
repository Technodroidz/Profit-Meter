<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:53:50 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profit Meter Login</title>

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
                                <h3> Profit Meter</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index-2.html">Dashboard</a> <i class="fas fa-caret-right"></i> login</p>
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
                                    <div class="modal-header justify-content-center theme_bg_1">
                                        <h5 class="modal-title text_white">Profit Meter</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter your email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <a href="#" class="btn_1 full_width text-center">Log in</a>
                                            <p>Need an account? <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal"  href="{{ url('business/register')  }}"> Sign Up</a></p>
                                            <div class="text-center">
                                                <a href="{{ url('business/forgot-password')  }}" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                                            </div>

                                        </form>


                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('home') }}" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <!-- <p class="subtitle"> -->
                                                  <label for="shop">Enter your shop domain to log in or install this app.</label>
                                                <!-- </p> -->
                                                <input id="shop" name="shop" type="text" autofocus="autofocus" placeholder="example.myshopify.com" class="form-control">
                                            </div>
                                          
                                            <button type="submit" class="btn_2 full_width text-center" style="border:2px dashed;">Login with Shopify</button>
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
    <!-- <div class="footer_part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_iner text-center">
                        <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> DashboardPack</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
  
<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 09:53:50 GMT -->
</html>