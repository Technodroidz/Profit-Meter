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
                <div class="page_title_box ">
                  <div class="page_title_left">
                     <h3 class="mb-0" >Data Sync Status <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
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