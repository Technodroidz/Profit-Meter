@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
         <!-- page title  -->
        <div class="row">
            <div class="col-12 col-md-12">
               <div class="page_title_box ">
                  <div class="page_title_left">
                     <h3 class="mb-0">Account Settings <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                  </div>
               </div>
               <hr>
               <div class="white_card pad-16 br-16 mt_30 mb_30">
                  <h4>Your profile</h4>
                  <br>
                  <form>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>First name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="First Name">
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Last name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Phone number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+918754632514">
                          </div>
                          <div class="col-md-12 form-group">
                            <label>Company name</label>
                            <input type="text" name="company" class="form-control" placeholder="Company Name">
                          </div>
                          <div class="col-md-12 form-group">
                            <label>What industry do you work in?</label>
                            <select class="form-control">
                              <option>Please select</option>
                              <option>Company 1</option>
                              <option>Company 2</option>
                              <option>Company 3</option>
                              <option>Company 4</option>
                            </select>
                          </div>
                          <div class="col-md-12 form-group">
                            <button class="updateProfile">Update Profile</button>
                          </div>                        
                        </div>  
                          <br>
                          <br>                        
                        <h4>Change Password</h4>
                        <div class="row">
                          <div class="col-md-6 col-xs-12 form-group">
                            <label>Old password</label>
                            <input type="password" name="oldpass" class="form-control" placeholder="Old password">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-xs-12 form-group">
                            <label>New password</label>
                            <input type="password" name="newpass" class="form-control" placeholder="New password">
                          </div>
                          <div class="col-md-6 col-xs-12 form-group">
                            <label>Confirm password</label>
                            <input type="password" name="conpass" class="form-control" placeholder="Confirm password">
                          </div>
                          <div class="col-md-12 form-group">
                            <button class="updateProfile">Update Password</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h4 class="text-center">Your Plan</h4>
                        <br>
                        <div class="row">
                          <div class="col-md-12 col-xs-12 form-group">
                            <div class="planCard">
                              <p class="planTitle">BASIC</p>
                              <h2 class="planPrice">$9</h2>
                              <p class="prMonth">per month</p>
                              <h4>Unlimited history data:</h4>
                              <ul>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Profit Dashboard</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Simulate Your Potential Revenue and Profit</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan"> Pull your spending from Facebook, Google Ads and Snapchat</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan"> Import your Disputes data from Stripe and PayPal</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan"> Track all your Expenses</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan"> Self-serve knowledge base</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan"> Lifetime Value Analysis</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Priority 7/7 support</span>
                                </li>
                              </ul>
                              <a href="#" class="crntPlan">Current plan</a>
                            </div>
                          </div>
                          <!-- <div class="col-md-6 col-xs-12 form-group">
                            <div class="planCard">
                              <p class="planTitle">PROFESSIONAL</p>
                              <h2 class="planPrice">$49</h2>
                              <p class="prMonth">per month</p>
                              <h4>Unlimited history data:</h4>
                              <ul>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Track your orders & KP is on a signle dashboard</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Pull your cost data from Facebook & Google Ads</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Full lifetime value analyst</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Lifecycle analysis</span>
                                </li>
                                <li>
                                  <span class="iconRight"><i class="fas fa-check"></i></span>
                                  <span class="textPlan">Repurchase rate analysis</span>
                                </li>
                              </ul>
                              <a href="#" class="chngPlan">Change plan</a>
                            </div>
                          </div> -->
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
      </div>
    </div>

@endsection
