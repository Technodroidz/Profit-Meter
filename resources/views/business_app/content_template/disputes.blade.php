@extends('business_app/common_template/main')

@section('content')

<style>
         #reportrange{display:inline-block;margin-right:10px;}
         .pad-16{padding:16px;}
         .br-16{border-radius:16px;}
         .switch {
              position: relative;
              display: inline-block;
              width: 60px;
              height: 20px;
              padding: 12px 25px !important;
              margin-bottom: 0px;
              vertical-align: middle;
            }
            .switch::after{
             background-color: transparent;
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
              background-color: #ccc;
              -webkit-transition: .4s;
              transition: .4s;
            }

            .slider:before {
              position: absolute;
              content: "";
              height: 17px;
              width: 17px;
              left: 4px;
              bottom: 4px;
              background-color: white;
              -webkit-transition: .4s;
              transition: .4s;
            }

            input:checked + .slider {
              background-color: #2196F3;
            }

            input:focus + .slider {
              box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
              -webkit-transform: translateX(26px);
              -ms-transform: translateX(26px);
              transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
              border-radius: 34px;
            }

            .slider.round:before {
              border-radius: 50%;
            }
            a.apFilter {
                border: 1px solid #ccc;
                padding: 8px 16px;
                border-radius: 6px;
                color: green;
            }
      </style>




    <div class="container-fluid p-0 ">
       <!-- page title  -->
       <div class="row">
            <div class="col-12">
             <p>Time Period</p>
             <div id="reportrange"  class="pull-left">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                <span></span> <b class="caret"></b>
             </div>
             <span class="help">
             <a class="help" data-toggle="modal" data-target="#confirm-mail"><i class="fas fa-info-circle"></i> Help </a>
             </span>
            </div>
            <div class="col-md-12">
             <div class="white_card mb_30 mt_30 pad-16 br-16">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                   <div class="page_title_left">
                      <h3 class="mb-0" >Dispute Report</h3>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-6 form-group">
                      <select class="form-control">
                         <option>All gateways</option>
                         <option>Gateways 1</option>
                         <option>Gateways 2</option>
                         <option>Gateways 3</option>
                         <option>Gateways 4</option>
                      </select>
                   </div>
                   <div class="col-md-6 form-group">
                      <select class="form-control">
                         <option>All products</option>
                         <option>Products 1</option>
                         <option>Products 2</option>
                         <option>Products 3</option>
                         <option>Products 4</option>
                      </select>
                   </div>
                   <div class="col-md-12">
                        <h4>Disputes state</h4>
                        <div class="row">
                            <div class="col-md-3 col-xs-4">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                                <span class="tTxt">Won</span>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                                <span class="tTxt">Lost</span>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                                <span class="tTxt">Open</span>
                            </div>
                            <div class="col-md-12 text-right">
                                <a href="#" class="apFilter"><i class="fas fa-sync-alt"></i> Apply filters</a>
                            </div>
                        </div>
                   </div>
                </div>
             </div>
             <div class="white_card mb_30 mt_30 pad-16 br-16">
                <canvas id="highlights"></canvas>
            </div>
            <div class="white_card mb_30 mt_30 pad-16 br-16">
                <div class="row">
                    <div class="col-md-3 col-xs-6 text-center">
                        <h4>Dispute Count</h4>
                        <h2 style="color:#3fd03f;">0</h2>
                        <p class="cGray">Total number of disputes</p>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center">
                        <h4>Won/Lost Disputes</h4>
                        <h2 style="color:#3fd03f;">0/0</h2>
                        <p class="cGray">Won and lost disputes</p>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center">
                        <h4>Disputed Revenue</h4>
                        <h2 style="color:#3fd03f;">0</h2>
                        <p class="cGray">Total disputed revenue</p>
                    </div>
                    <div class="col-md-3 col-xs-6 text-center">
                        <h4>Open Disputed Revenue</h4>
                        <h2 style="color:#3fd03f;">0</h2>
                        <p class="cGray">Revenue held by gateway</p>
                    </div>
                </div>
            </div>
          </div>
          
       </div>
    </div>

@endsection