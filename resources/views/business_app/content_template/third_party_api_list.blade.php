@extends('business_app/common_template/main')

@section('content')

    <style>
        .card-body.pad-0 {
            box-shadow: 0px 0px 10px 1px rgb(0 0 0 / 20%);
            border-radius: 4px;
        }
        @media (max-width:1300px){
            .col-sm-4{
                flex:0 0 33.3333333%;
                max-width:33.3333333%;
            }
            .uperPart {
                height: 240px;
                position:relative;
            }
            span.redBatch {
                margin-top: 0px;
                position: absolute;
                left: 50%;
                bottom: 16px;
                transform: translate(-50%, 0%);
            }
        }
        /**, ::after, ::before {
             box-sizing: content-box; 
        }*/

    </style>

        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3> Api List</h3>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="dashboard_breadcam text-right">
                                    <p><a href="index-2.html">Dashboard</a> <i class="fas fa-caret-right"></i>  ThemeCard</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box box_shadow position-relative mb_30     ">
                        <div class="white_box_tittle     ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap ">Basic Description Api</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box box_shadow position-relative mb_30 border_radius_0     ">
                        <div class="white_box_tittle     ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap ">Flat Card</h4>
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg ">
                        <div class="white_box_tittle     ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap ">Without shadow Card</h4>
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg ">
                        <div class="white_box_tittle     ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap  ">Card sub Title</h4>
                                <p class="">Using the card component, you can extend the default collapse behavior to create an accordion.</p>
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg parpel_bg  ">
                        <div class="white_box_tittle parpel_bg    ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Theme Color Card</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 text_white ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer">
                            <h6 class="text_white">Card Footer</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg pink_bg  ">
                        <div class="white_box_tittle pink_bg    ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Pink Bg Color Card</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 text_white ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer">
                            <h6 class="text_white">Card Footer</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30  blue_bg  ">
                        <div class="white_box_tittle blue_bg    ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Blue Card</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 text_white ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer">
                            <h6 class="text_white">Card Footer</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg  ">
                        <div class="white_box_tittle blue_bg    ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Blue Card Header</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer">
                            <h6 class="">Card Footer</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg  ">
                        <div class="white_box_tittle blue_bg    ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Blue Card Header</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer blue_bg">
                            <h6 class="text_white">Card Footer</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card_box position-relative  mb_30 white_bg  ">
                        <div class="white_box_tittle parpel_bg      ">
                            <div class="main-title2 ">
                                <h4 class="mb-2 nowrap text_white">Blue Card Header</h4>
                                
                            </div>
                        </div>
                        <!-- <div class="box_body">
                            <p class="f-w-400 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                        </div> -->
                        <div class="card_footer parpel_bg    ">
                            <h6 class="text_white">Card Footer</h6>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
@endsection


@section('script')
    
@endsection
