<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profitrack | Super admin</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.m``in.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , R`esponsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('')}}files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files\bower_components\bootstrap\dist\css\bootstrap.min.css">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="{{asset('')}}files\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files\assets\css\custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}files\assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!--Wrapper Content Start-->
    <div class="tj-wrapper">


        <!--Style Switcher Section End-->
     

        @yield('content')

       <!-- Required Jquery -->
<script type="text/javascript" src="{{asset('')}}files\bower_components\jquery\dist\jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\jquery-ui\jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\popper.js\dist\umd\popper.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\bootstrap\dist\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('')}}files\bower_components\jquery-slimscroll\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('')}}files\bower_components\modernizr\modernizr.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\modernizr\feature-detects\css-scrollbars.js"></script>

    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="{{asset('')}}files\assets\pages\advance-elements\moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\assets\pages\advance-elements\bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="{{asset('')}}files\bower_components\bootstrap-daterangepicker\daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="../{{asset('')}}files/bower_components/datedropper/js/datedropper.min.js"></script>
    <!-- data-table js -->
    <script src="{{asset('')}}files\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="{{asset('')}}files\assets\pages\data-table\js\dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('')}}files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="{{asset('')}}files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <!-- ck editor -->
    <script src="{{asset('')}}files\assets\pages\ckeditor\ckeditor.js"></script>
    <!-- echart js -->
    <script src="{{asset('')}}files\assets\pages\chart\echarts\js\echarts-all.js" type="text/javascript"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{asset('')}}files\bower_components\i18next\i18next.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\i18next-xhr-backend\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\i18next-browser-languagedetector\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="{{asset('')}}files\bower_components\jquery-i18next\jquery-i18next.min.js"></script>
    <script src="{{asset('')}}files\assets\pages\user-profile.js"></script>
    <script src="{{asset('')}}files\assets\js\pcoded.min.js"></script>
    <script src="{{asset('')}}files\assets\js\vartical-layout.min.js"></script>
    <script src="{{asset('')}}files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('')}}files\assets\js\script.js"></script>
    @yield('custom_script')
</body>

</html>