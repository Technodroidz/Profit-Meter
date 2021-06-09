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

@endsection