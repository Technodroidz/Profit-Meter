@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
         <!-- page title  -->
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="page_title_box ">
                  <div class="page_title_left">
                     <h3 class="mb-0" >Exclude orders from the reports <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                  </div>
               </div>
               <hr>
               <div class="white_card mb_30 mt_30 pad-16 br-16">
                  <form>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <p>Financial status</p>
                          <div class="radio">
                            <input id="radio-1" name="radio" type="radio">
                            <label for="radio-1" class="radio-label">Pending</label>
                          </div>

                          <div class="radio">
                            <input id="radio-2" name="radio" type="radio">
                            <label  for="radio-2" class="radio-label">Authorized</label>
                          </div>
                          <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                          <p>Orders</p>
                          <div class="checkbox">
                            <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="Zero value orders">
                            <label for="styled-checkbox-1">Zero value orders</label>
                          </div>
                          <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                          <div class="checkbox">
                            <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="Cancelled orders">
                            <label for="styled-checkbox-2">Cancelled orders</label>
                          </div>
                          <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                          <p>Orders tags</p>
                          <input type="text" name="input" class="form-control" id="width250" value="Arv tags" placeholder="">
                          <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <br/>
                        <div class="form-group">
                          <p>Sales channel</p>
                           <div class="checkbox">
                            <input class="styled-checkbox" id="styled-checkbox-3" type="checkbox" value="POS">
                            <label for="styled-checkbox-3">POS</label>
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="checkbox">
                            <input class="styled-checkbox" id="styled-checkbox-4" type="checkbox" value="Draft orders">
                            <label for="styled-checkbox-4">Draft orders</label>
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <p>Order channels</p>
                            <input type="text" name="" class="form-control w_300" value="Arv New">
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <br/>
                        <div class="form-group">
                          <p>Customers</p>
                          <label>Customer tags</label>
                            <input type="text" name="input" class="form-control" id="width250" value="Arv tags" placeholder="">
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                          <button class="saveBtn">Save changes</button>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h3>Calculation logic</h3>
                        <br/>
                        <div class="form-group">
                            <input class="styled-checkbox" id="styled-checkbox-5" type="checkbox" value="Reset products costs to zero for all refunded orders">
                            <label for="styled-checkbox-5">Reset products costs to zero for all refunded orders</label>
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                            <input class="styled-checkbox" id="styled-checkbox-6" type="checkbox" value="Assign refunds to the original order date instead of the processing date">
                            <label for="styled-checkbox-6">Assign refunds to the original order date instead of the processing date</label>
                            <p class="messTxt">Check to inclose unread orders from imports</p>
                        </div>
                        <div class="form-group">
                          <button class="saveBtn">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </form>
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
         <!-- footer part -->
         <!-- <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <p class="text-center">2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> DashboardPack</a></p>
               </div>
            </div>
         </div> -->

@endsection