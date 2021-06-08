@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
    <!-- page title  -->

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="mb-0" >Order Map</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="1000" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://123movies-to.org"></a><br>
                    <style>.mapouter{position:relative;text-align:right;height:500px;width:1000px;}</style>
                    <a href="https://www.embedgooglemap.net">google map for web site</a>
                    <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:1000px;}</style>
                </div>
            </div>
        </div>
    </div>
   
</div>

@endsection