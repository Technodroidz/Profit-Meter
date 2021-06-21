@extends('business_app/common_template/main')

@section('content')

    <style>
        .changeBtn {
            border: 1px solid #CCC;
            height: 38px;
            margin-top: 0!important;
            color: #bdbdbd;
            background:#fff;
        }
        .changeBtn.active {
            color: #000;
            border-bottom: 2px solid #3fd03f;
        }

        #switch {
            -webkit-appearance: none;
            background-color: #ccc;
            border-radius: 43px;
            position: relative;
            cursor: pointer;
            padding: 10px 25px !important;
            height: 14px;
            width: 30px;
            margin-left: 10px;
            display: inline-flex;
            vertical-align: middle;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: $grey;
            transition: .4s;
        }
        .switch::after {
            top: 6px;
            left: 6px;
            content: '';
            width: 15px;
            height: 15px;
            background-color: transparent;
            position: absolute;
            border-radius: 100%;
            transition: 1s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: $blue;
        }

        input:focus + .slider {
            box-shadow: 0 0 0 4px rgba(21, 156, 228, 0.7);
            outline: none;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        #content {
            justify-content: center;
            padding: 0px 12px;
            width: 400px;
            margin: 14px auto;
            border-left: 2px solid #3fd03f;
        }

        #reportrange{height:38px;padding:9px 10px;}
        .small_blue_btn.active {
            height: 38px;
            padding: 11px 16px;
        }
        .small_all_btn.active {
            height: 38px;
            padding: 11px 16px;
            background: #fff;
            color:#3fd03f;
            border-right:6px;
        }

        .pad-16{padding:16px;}
        .br-16{border-radius:16px;}
        .sp{display:inline-block;}
        span.learn {
            border: 1px solid #ccc;
            padding: 4px 10px;
            font-size: 14px;
            color: gray;
            cursor: pointer;
        }
        ul.listGroup {
            margin: 32px 0px 0px 0px;
        }
        .listGroup li {
            display: inline-block;
          margin-right:32px;
        }

        .listGroup li:last-child{margin-right:0px;}
        .listCard h3 {
            margin: 0;
        }
        span.cardIcon {
            font-size: 14px;
            color: gray;
        }
        span.profile_info {
            display: inline-block;
            height: 100%;
        }
        div#filters {
            margin-top: -38px;
            z-index: 99!important;
        }
        @media  (max-width:1300px){
          .myCustomCols .col-md-2{
            flex:0 0 26.666667%!important;
            max-width: 26.666667%!important;
          }
          .myCustomCols .col-md-3{
            flex:0 0 32.666667%!important;
            max-width: 32.666667%!important;
          }
          .myCustomCols .col-md-1{
            flex:0 0 10.333333%!important;
            max-width: 10.333333%!important;
          }
        }

        @media (max-width:1500px){
            .myCustomCols .col-md-2{
                flex: 0 0 23.666667%;
                max-width: 23.666667%;
            }
            .myCustomCols .col-md-3{
                flex: 0 0 28.666667%;
                max-width: 28.666667%;
            }
        }
    </style>

    <div class="container-fluid p-0 myCustomCols">
            <!-- page title  -->

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Lifetime Value <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
            </div>
            <div  class="col-md-2 col-xs-12">
              <p>Time Period</p>
              <div id="reportrange"  class="pull-left">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                  <span></span> <b class="caret"></b>
              </div>
            </div>
            <div class="col-md-3 col-xs-12">
              <p>Timeframe</p>
              <div class="btn-group">
                <button type="button" class="btn btn-block changeBtn">Week</button>
                <button type="button" class="btn btn-block changeBtn active">Month</button>
                <button type="button" class="btn btn-block changeBtn">Quarter</button>
                <button type="button" class="btn btn-block changeBtn">Year</button>
              </div>
            </div>
            <div class="col-md-3 col-xs-12">
              <p>Metrics</p>
              <select class="form-control">
                <option>Accumulated sales per customer</option>
                <option>Accumulated sales margin per customer</option>
                <option>Customers</option>
                <option>Cohort transactions</option>
                <option>Cohort sales</option>
                <option>Accumulated orders per customer</option>
              </select>
            </div>
            <div class="col-md-1 col-xs-12">
              <p>Format</p>
              <div class="btn-group">
                <button type="button" class="btn btn-block changeBtn active">€</button>
                <button type="button" class="btn btn-block changeBtn">%</button>
              </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <p>&nbsp;</p>
                <a href="#" class="mr_5 mb_10  small_blue_btn active"><i class="fas fa-file-export"></i> Export to CSV</a>
                <span class="profile_info">
                    <a href="#" class="mr_5 mb_10  small_all_btn active"><i class="fas fa-sliders-h"></i> All filters</a>
                    <div class="profile_info_iner" id="filters">
                        <div class="profile_author_name">
                            <p>Products</p>
                        </div>
                        <div class="profile_info_details">
                            <form>
                                <div class="form-group">
                                    <label>Product (first order)</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="All Products">
                                </div>
                                <div class="form-group">
                                    <label>SKU (first order)</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="All SKUs">
                                </div>
                                <div class="form-group">
                                    <label>Product types (first order)</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="All Product types">
                                </div>
                            </form>
                        </div>
                    </div>
                </span>
            </div>
            <div class="col-md-12">
                <div id="content">
                  <span class="sp"><strong>CAC payback</strong></span>
                  <label class="switch" id="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <p>Set costs for better accuracy</p>
                </div>
            </div>
            <!-- Table start -->
            <div class="col-md-12">
                <div class="white_card card_height_100 mb_30 mt_30 pad-16 br-16">
                    <div class="table-responsive">
                        <table class="table border-collapse">
                            <thead>
                                <tr>
                                    <th>First order at</th>
                                    <th>New customers</th>
                                    <th>CAC</th>
                                    <th>R-%</th>
                                    <th>First order</th>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sep-2020</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Oct-2020</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Nov-2020</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Dec-2020</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Jan-2021</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Feb-2021</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>March-2021</td>
                                    <td>0</td>
                                    <td>€0</td>
                                    <td>0%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="white_card card_height_100 mb_30 mt_30 pad-16 br-16">
                    <h3>LTV averages <span class="learn" data-toggle="modal" data-target="#confirm-mail1"><i class="fas fa-info-circle"></i> Learn</span></h3>
                    <ul class="listGroup">
                        <li>
                            <div class="listCard">
                                <h3>N/A <span class="cardIcon"><i class="fas fa-info-circle"></i></span></h3>
                                <p class="avg">3-month LTV avg.</p>
                            </div>
                        </li>
                        <li>
                            <div class="listCard">
                                <h3>N/A <span class="cardIcon"><i class="fas fa-info-circle"></i></span></h3>
                                <p class="avg">6-month LTV avg.</p>
                            </div>
                        </li>
                        <li>
                            <div class="listCard">
                                <h3>N/A <span class="cardIcon"><i class="fas fa-info-circle"></i></span></h3>
                                <p class="avg">12-month LTV avg.</p>
                            </div>
                        </li>
                        <li>
                            <div class="listCard">
                                <h3>N/A <span class="cardIcon"><i class="fas fa-info-circle"></i></span></h3>
                                <p class="avg">24-month LTV avg.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


                                    
    <!-- confirm mail start -->
    <div id="confirm-mail1" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="login-card card-block login-card-modal">
                <form class="md-float-material">
                    <div class="text-center">
                        <img src="img\logo.png" alt="logo.png">
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

@endsection