@extends('business_app/common_template/main')

@section('content')
    <style type="text/css">
        .QA_section .QA_table .table thead th:first-child,
        .QA_section .QA_table .table thead th:last-child {
            border: none!important;
        }
    </style>

    <div class="container-fluid p-0 ">
         <!-- page title  -->
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                  <div class="page_title_left">
                     <h3 class="mb-0" >Data Sync Status <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                  </div>
                  <div class="view_btns">
                      <!-- <p>Click To Sync Shopify Products</p> -->

                      <button id = "shopify_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                      </button>
                      <a data-url="{{route('sync_shopify')}}" data-request="inline-post-ajax" data-method="post" data-variable="module_name" data-module_name="shopify_products" href="javascript:void(0);" class="mr_5 mb_10  small_blue_btn active shopify_btn" data-show_error="#show_shopify_error" data-disable_element_class=".shopify_btn" data-loader="#shopify_loader" data-swal_message="Are You Sure to Sync Shopify Products.">Sync Shopify Products</a>

                      <a data-url="{{route('sync_google_ads')}}" data-request="inline-post-ajax" data-method="post" data-variable="module_name" data-module_name="shopify_products" href="javascript:void(0);" class="mr_5 mb_10  small_blue_btn active shopify_btn" data-show_error="#show_shopify_error" data-disable_element_class=".shopify_btn" data-loader="#shopify_loader" data-swal_message="Are You Sure to Sync Google Ads.">Sync Google Ads</a>

                      <a data-url="{{route('sync_paypal_disputes')}}" data-request="inline-post-ajax" data-method="post" data-variable="module_name" data-module_name="shopify_products" href="javascript:void(0);" class="mr_5 mb_10  small_blue_btn active shopify_btn" data-show_error="#show_shopify_error" data-disable_element_class=".shopify_btn" data-loader="#shopify_loader" data-swal_message="Are You Sure to Sync Paypal Disputes.">Sync Paypal Disputes</a>

                      <a data-url="{{route('sync_snapchat_ads')}}" data-request="inline-post-ajax" data-method="post" data-variable="module_name" data-module_name="shopify_products" href="javascript:void(0);" class="mr_5 mb_10  small_blue_btn active shopify_btn" data-show_error="#show_shopify_error" data-disable_element_class=".shopify_btn" data-loader="#shopify_loader" data-swal_message="Are You Sure to Sync Snapchat Ads.">Sync Snapchat Ads</a>
                      @csrf
                      

                  </div>
                </div>
                <hr>
                <div class="sucCard mb_30 mt_30">
                  <div class="topCard">
                    Status
                  </div>
                  <div class="cardBot">
                    <button class="saveBtn">Success</button>
                    <p>Last scheduled 4 minutes ago</p>
                    <p>Last completed 4 minutes ago</p>
                  </div>
                </div>
                <div class="white_card mt_30 mb_30">
                <div class="white_card_body">
                  <div class="QA_section">
                    <div class="QA_table mb_30">
                      <table class="table ">
                        <thead>
                          <tr>
                            <th style="width:250px;">Data</th>
                            <th>Process</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Collection</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                  100
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Customers</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="5"
                                aria-valuemin="0" aria-valuemax="100" style="width:5%">
                                  5
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Orders</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="10"
                                aria-valuemin="0" aria-valuemax="100" style="width:10%">
                                  10
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Products</td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width:25%">
                                  25
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
                         
                      </div>
                   </div>
                </div>
            </div>
        </div>
    </div>

@endsection