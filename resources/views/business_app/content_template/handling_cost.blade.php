@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
            <div class="col-lg-12">
            <div class="page_title_left  mb_30">
                            <h3 class="mb-0">Handling Cost <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                           
                        </div>
                    <div class="white_box">
                       <!--  <div class="box_header ">
                           <div class="main-title">
                                <h3 class="mb-0" >Additional  Notifications</h3>
                            </div>
                        </div> -->
                        <div class="alert" role="alert">
                            
                         <p>Handling cost are used for defining other shipping related cost from warehousing on two different levels, shipping an order from third party warehouse usually cost X per order and also a fee per item for packing products.</p>

                         <form>
                                <div class="form-group row">
                                    <label for="costperorder" class="col-sm-2 col-form-label">Cost Per Order</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Value">
                                    </div>
                                     <div class="col-sm-5">
                                        <p>e.g. packing cost per order is 0.0</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="costperitem" class="col-sm-2 col-form-label">Cost Per Item</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Enter Value">
                                    </div>
                                      <div class="col-sm-5">
                                        <p>e.g. packing cost per item is 0.0</p>
                                    </div>
                                </div>
                              
                               
                                
                            </form>
                           
                          </div>
                    </div>
                </div>

                
    
            </div>
        </div>

        <div id="confirm-mail" class="modal" role="dialog">
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