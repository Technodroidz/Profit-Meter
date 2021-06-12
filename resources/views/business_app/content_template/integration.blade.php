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
    </style>

    <div class="container-fluid p-0 ">
         <!-- page title  -->
        <div class="row">
            <div class="col-12">
               <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                  <div class="page_title_left">
                     <h3 class="mb-0" >Integrations <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                  </div>
                  <!-- <button style="float: right; background:#00FF7F; border:none; color:#fff; padding:10px;">Add Integration</button> -->
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
                            <!-- <div class="col-12 col-sm-4 col-lg-3">
                            <div class="card">
                                <div class="card-body pad-0">
                                    <div class="uperPart ali">
                                      <img src="img/aliexpress.png">
                                      <h4 class="card-title">AliExpress</h4>
                                      <p class="txt">import orders from aliExpress</p>
                                      <span class="redBatch">NOT CONNECTED</span>
                                    </div>
                                    <div class="bottumPart">
                                        <p class="txtConetnt">
                                            Use our Chrome Extension to measily import all your orders and the corresponding costs into Profitario.
                                        </p>
                                        <a href="#" class="learnButton">Learn More</a>
                                        <div class="text-right btm">
                                            <button class="updateBtn">Update Orders</button>
                                            <button class="contBtn">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div> -->
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart fb">
                                          <img src="{{asset('')}}/business_app/img/facebook.png">
                                          <h4 class="card-title">Facebook Ads</h4>
                                          <p class="txt">import your AdSpend from Facebook</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                The Facebook Ads Extension imports all your campaigns and adsets into Profitario to give you clear pictre of your overall adspend.
                                            </p>
                                            <div class="text-right btm">
                                                <button class="stBtn">Settings</button>
                                                <button class="contBtn">Connected</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart stripe">
                                          <img src="{{asset('')}}/business_app/img/stripe.svg">
                                          <h4 class="card-title">Stripe</h4>
                                          <p class="txt">import Disputes from Stripe</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Stripe to your Profitario account to integrate disputes into your profit calculations.
                                            </p>
                                            <div class="text-right btm">
                                                <button class="stBtn">Settings</button>
                                                <button class="contBtn">Connected</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart paypal">
                                          <img src="{{asset('')}}/business_app/img/paypal.png">
                                          <h4 class="card-title">Paypal</h4>
                                          <p class="txt">import Disputes from Paypal</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Paypal to your Profitario account to integrate disputes into your profit calculations.
                                            </p>
                                            <div class="text-right btm">
                                                <button class="stBtn">Settings</button>
                                                <button class="contBtn">Connected</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart google_ana">
                                          <img src="{{asset('')}}/business_app/img/snapchat-logo-png-.png">
                                          <h4 class="card-title">Snapchat</h4>
                                          <p class="txt">import User Data from Snapchat</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Snapchat to your Profitario account to integrate Session information. Conversion Data and Customer Aqusition Cost.
                                            </p>
                                            <div class="text-right btm">
                                                <button class="stBtn">Settings</button>
                                                <button class="contBtn">Connected</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart google_ad">
                                          <img src="{{asset('')}}/business_app/img/google-ads.png">
                                          <h4 class="card-title">Google Adwords</h4>
                                          <p class="txt">import AdSpend from Google Adwords</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Adwords Extension imports all your campaigns and adSpend into Profitario to give you a clear picture of your overall adspend.
                                            </p>
                                            <div class="text-right btm">
                                                <button class="stBtn">Settings</button>
                                                <button class="contBtn">Connected</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 col-sm-4 col-lg-3">
                            <div class="card">
                                <div class="card-body pad-0">
                                    <div class="uperPart shippo">
                                      <img src="img/shippo.png">
                                      <h4 class="card-title">Shippo</h4>
                                      <p class="txt">import Shipping Cost from Shippo</p>
                                      <span class="redBatch">NOT CONNECTED</span>
                                    </div>
                                    <div class="bottumPart">
                                        <p class="txtConetnt">
                                            This Shippo Extension allows you to inport your Shipping Cost into Profitario.
                                        </p>
                                        <div class="text-right btm">
                                            <button class="stBtn">Settings</button>
                                            <button class="contBtn">Connected</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                            <div class="card">
                                <div class="card-body pad-0">
                                    <div class="uperPart shipmondo">
                                      <img src="img/shipmondo.svg">
                                      <h4 class="card-title">Shipondo</h4>
                                      <p class="txt">import Shipping Cost from Shipondo</p>
                                      <span class="redBatch">NOT CONNECTED</span>
                                    </div>
                                    <div class="bottumPart">
                                        <p class="txtConetnt">
                                            This Shipondo Extension allows you to inport your Shipping Cost into Profitario.
                                        </p>
                                        <div class="text-right btm">
                                            <button class="stBtn">Settings</button>
                                            <button class="contBtn">Connected</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div> -->
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection