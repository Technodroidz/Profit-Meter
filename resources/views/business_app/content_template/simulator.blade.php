@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
    <!-- page title  -->
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="mb-0" >Simulator</h3>
                   
                </div>
               <!--  <div class="monitor_list_widget">
                    <div class="simgle_monitor_list">
                        <div class="simgle_monitor_count d-flex align-items-center">
                            <span>Purchase</span>
                            <div id="monitor_1"></div>
                        </div>
                        <h4 class="counter">6,250</h4>
                    </div>
                    <div class="simgle_monitor_list">
                        <div class="simgle_monitor_count d-flex align-items-center">
                            <span>Purchase</span>
                            <div id="monitor_2"></div>
                        </div>
                        <h4 >$ <span class="counter">55,250</span> </h4>
                    </div>
                    <div class="simgle_monitor_list">
                        <div class="simgle_monitor_count d-flex align-items-center">
                            <span>Purchase</span>
                            <div id="monitor_3"></div>
                        </div>
                        <h4 >$ <span class="counter">451.6 </span>M </h4>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xl-12">
            <div class="mb_30">
               <!--  <div class="white_card_header ">
                    <div class="box_header m-0">
                        <ul class="nav  theme_menu_dropdown">
                            <li class="nav-item">
                              <a class="nav-link active" href="#">Analytics</a>
                            </li>
                          </ul>
                          <div class="button_wizerd">
                              <a href="#" class="white_btn mr_5">ToDo</a>
                              <a href="#" class="white_btn">Settings</a>
                          </div>
                    </div>
                </div> -->
                <div class="white_card_body anlite_table p-0">
                    <div class="row">

                        <div class="col-12 col-sm-6 col-lg-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Profit</h5>
                              <h3 class="card-subtitle mb-2">14k</h3>
                              <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">2.3%</span> Last Year </p>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                         <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Profit</h5>
                              <h3 class="card-subtitle mb-2">14k</h3>
                              <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">2.3%</span> Last Year </p>
                              
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-lg-4">
                          <div class="card">
                             <div class="card-body">
                              <h5 class="card-title">Profit</h5>
                              <h3 class="card-subtitle mb-2">14k</h3>
                              <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">2.3%</span> Last Year </p>
                              
                            </div>
                          </div>
                        </div>


                        <div class="col-12 ">
                            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                                <div class="page_title_left mb_10">
                                    <h3 class="mb-0" >Overview</h3>
                                    <p>Statistics, Predictive Analytics Data Visualization, Big Data Analytics, etc.</p>
                                </div>
                                <div class="page_title_right">
                                    <div class="dropdown CRM_dropdown  mr_5 mb_10">
                                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            14 March 2020
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="#">Today</a>
                                          <a class="dropdown-item" href="#">This Week</a>
                                          <a class="dropdown-item" href="#">Last week</a>
                                        </div>
                                      </div>
                                    <a href="#" class="white_btn mb_10">Export</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="white_card   card_height_100 mb_30">
                                <div class="white_card_header">
                                    <div class="box_header m-0 flex-wrap">
                                        <div class="main-title mb_10">
                                            <h3 class="m-0">254856 USD </h3>
                                            <p>125648 USD (20%)</p>
                                        </div>
                                        <div class="view_btns">
                                            <a href="#" class="mr_5 mb_10  small_blue_btn active">All</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn active">1M</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">6M</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body"  >
                                    <div id="areaLine_chart1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="white_card   card_height_100 mb_30">
                                <div class="white_card_header">
                                    <div class="box_header m-0 flex-wrap">
                                        <div class="main-title mb_10">
                                            <h3 class="m-0">254856 USD </h3>
                                            <p>125648 USD (20%)</p>
                                        </div>
                                        <div class="view_btns">
                                            <a href="#" class="mr_5 mb_10  small_blue_btn active">All</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn active">1M</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">6M</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body"  >
                                    <div id="areaLine_chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection