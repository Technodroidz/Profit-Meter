@extends('business_app/common_template/main',['current_link' => isset($current_link) ? $current_link : ''])

@section('content')

    <div class="container-fluid p-0 ">
        <!-- page title  -->
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Profit Dashboard  <a href="#" class="white_btn mb_10">Learn</a></h3>
                       
                    </div>

                    <div class="view_btns">
                        <p>Last updated 5 minutes ago</p>
                        <a href="#" class="mr_5 mb_10  small_blue_btn active">Export to CSV</a>
                          <!--   <a href="#" class="mr_5 mb_10  small_blue_btn">Weekly</a>
                            <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a> -->
                           <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                            <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
                    </div>
                </div>
            </div>
            <div class="col-6">
                <p>Time Period</p>
                <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
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
                            <!--  <div class="row"> -->
                            <div class="col-12 col-sm-6 col-lg-3">
                              <div class="card card1">
                                <div class="card-body">
                                  <h5 class="card-title">Revenue</h5>
                                  <h3 class="card-subtitle mb-2">$0</h3>
                                  <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">0.0%</span> </p>
                                  
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                             <div class="card card2">
                                <div class="card-body">
                                  <h5 class="card-title">Product Costs</h5>
                                  <h3 class="card-subtitle mb-2">$0</h3>
                                  <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">0.0%</span></p>
                                  
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-lg-3">
                              <div class="card card3">
                                 <div class="card-body">
                                  <h5 class="card-title">Marketing Costs</h5>
                                  <h3 class="card-subtitle mb-2">$0</h3>
                                  <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">0.0%</span></p>
                                  
                                </div>
                              </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                               <div class="card card4">
                               <div class="card-body">
                                  <h5 class="card-title">Net Profit</h5>
                                  <h3 class="card-subtitle mb-2">$0</h3>
                                  <p class="card-text"><span style="color:#00FF7F; font-size: 15px;">0.0%</span></p>
                                  
                                </div>
                              </div>
                            
                            </div>
                          
                            <!--  <div class="col-12">
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
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="view_btns" style="float:right;">
                                    
                                    <a href="#" class="mr_5 mb_10  small_blue_btn active">Daily</a>
                                           
                                    <a href="#" class="mr_5 mb_10  small_blue_btn">Weekly</a>
                                    <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a>
                                           <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a>  -->
                                           <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                                            <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
                                </div>  
                            </div>
                      
                            <div class="col-lg-12 area">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0">Area Chart</h3>
                                        </div>
                                    </div>
                                    <canvas id="highlights"></canvas>
                                </div>
                            </div>
                            <div class="col-xl-12 bar">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0">Bar Chart</h3>
                                        </div>
                                    </div>
                                    <canvas style="height: 250px " id="barChart"></canvas>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <!-- <h3 class="mb-0">Sales Chart</h3>-->                            
                                        </div>
                                    </div>
                                    <canvas style="height: 250px" id="sales-chart"></canvas>
                                </div>
                            </div>
                        </div>
                            <!--  <div class="col-xl-6">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0">Radar Chart</h3>
                                        </div>
                                    </div>
                                    <canvas style="height: 250px" id="radarChart"></canvas>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-6">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0"> Pie Chart</h3>
                                        </div>
                                    </div>
                                    <canvas style="height: 250px" id="pieChart"></canvas>
                                </div>
                            </div> -->
                            <!--  <div class="col-xl-6">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0">Line Chart</h3>
                                        </div>
                                    </div>
                                    <canvas style="height: 250px" id="lineChart"></canvas>
                                </div>
                            </div> -->
                     
                            <!--  <div class="col-xl-4">
                                <div class="white_card card_height_100 mb_30">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Your Portfolio</h3>
                                            </div>
                                            <div class="header_more_tool">
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                      <i class="ti-more-alt"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                      <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                      <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <div class="row justify-content-center mb_30  ">
                                            <div class="col-12 text-center">
                                                <h4 class="f_s_22 f_w_700 mb-0">$63411.00</h4>
                                                <p class="f_s_11 f_w_400" >Total Balance</p>
                                            </div>
                                        </div>
                                        <div class="social_media_list">
                                            <div class="single_media d-flex justify-content-between align-items-center">
                                                <span class="mediaName"> <img src="img/currency/1.svg" alt=""> Bitcoin</span>
                                                <span class="earning_amount">
                                                    <h4>0.000242 BTC</h4>
                                                    <p>0.125 USD</p>    
                                                </span>
                                            </div>
                                            <div class="single_media d-flex justify-content-between align-items-center">
                                                <span class="mediaName"> <img src="img/currency/2.svg" alt=""> Litecoin</span>
                                                <span class="earning_amount">
                                                    <h4>0.000242 BTC</h4>
                                                    <p>0.125 USD</p>    
                                                </span>
                                            </div>
                                            <div class="single_media d-flex justify-content-between align-items-center">
                                                <span class="mediaName"> <img src="img/currency/3.svg" alt=""> Ripple</span>
                                                <span class="earning_amount">
                                                    <h4>0.000242 BTC</h4>
                                                    <p>0.125 USD</p>    
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--  <div class="col-xl-4">
                                <div class="white_card card_height_100 mb_30">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Exchange</h3>
                                            </div>
                                            <div class="header_more_tool">
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                      <i class="ti-more-alt"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                      <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                      <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <div class="exchange_widget">
                                            <form  name="myform" class="currency_validate">
                                                <div class="form-group">
                                                    <label >Currency</label>
                                                    <div class="input-group ">
                                                        <select  name="currency" class="form-control nice_Select">
                                                            <option data-display="Bitcoin" value="bitcoin">Bitcoin</option>
                                                            <option value="litecoin">Litecoin</option>
                                                        </select>
                                                        <input type="text" name="usd_amount" class="form-control" value="125.00 USD">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label >Payment Method</label>
                                                    <div class="input-group ">
                                                        <select name="currency" class="form-control nice_Select">
                                                            <option data-display="Bitcoin" value="bitcoin">Bitcoin</option>
                                                            <option value="litecoin">Litecoin</option>
                                                        </select>
                                                        <input type="text" name="usd_amount" class="form-control" value="125.00 USD">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label >Enter your amount</label>
                                                    <div class="input-group">
                                                        <input type="text" name="currency_amount" class="form-control" placeholder="0.0214 BTC">
                                                        <input type="text" name="usd_amount" class="form-control" placeholder="125.00 USD">
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <p class="mb-0">Monthly Limit</p>
                                                        <h6 class="mb-0">$49750 remaining</h6>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit" class="btn_1 w-100">Exchange Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                           
                            <!--  <div class="col-lg-4">
                                <div class="white_card mb_30 card_height_100">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Quick Transfer</h3>
                                            </div>
                                            <div class="header_more_tool">
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                      <i class="ti-more-alt"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                      <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                      <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body pb-0">
                                        <div class="recent_transfer_wrapper">
                                            <div class="transfer_thumb_conatnt">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="f_s_14 f_w_400 mb_10" >Recent Cantact</p>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <a href="#">
                                                            <p class="f_s_14 f_w_400 mb_10" >View More</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="single_transfer_pro text-center">
                                                            <div class="thumb">
                                                                <img src="img/transfer/1.png" alt="">
                                                            </div>
                                                            <h5 class="f_s_14 f_w_400 mb-0">Samuel</h5>
                                                            <p class="f_s_11 f_w_400">@samuel15</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="single_transfer_pro text-center">
                                                            <div class="thumb">
                                                                <img src="img/transfer/2.png" alt="">
                                                            </div>
                                                            <h5 class="f_s_14 f_w_400 mb-0">Samuel</h5>
                                                            <p class="f_s_11 f_w_400">@samuel15</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="single_transfer_pro text-center">
                                                            <div class="thumb">
                                                                <img src="img/transfer/3.png" alt="">
                                                            </div>
                                                            <h5 class="f_s_14 f_w_400 mb-0">Samuel</h5>
                                                            <p class="f_s_11 f_w_400">@samuel15</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="single_transfer_pro text-center">
                                                            <div class="thumb">
                                                                <img src="img/transfer/4.png" alt="">
                                                            </div>
                                                            <h5 class="f_s_14 f_w_400 mb-0">Samuel</h5>
                                                            <p class="f_s_11 f_w_400">@samuel15</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="eth_amount_number text-center">
                                                            <p>Amount ETH</p>
                                                            <h3>8,124.52</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="#" class="btn_1 w-100">Send Money</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--  <div class="col-xl-8 ">
                                <div class="white_card mb_30 card_height_100">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Revenue Statistics</h3>
                                            </div>
                                            <div class="header_more_tool">
                                                <div class="dropdown">
                                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                      <i class="ti-more-alt"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                                      <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                                      <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                                      <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body pb-0">
                                        <div id="bar_chart"></div>
                                    </div>
                                </div>
                            </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
        </script>


        <script>
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);
                
            });
        </script>

        <script>
            $('a.white_btn.mb_10').click(function(){
                $('.popover1').show();
            });
            $('.topHd i').click(function(){
                $('.popover1').hide();
            });
        </script>

    @endsection

@endsection