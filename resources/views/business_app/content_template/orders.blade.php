@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="mb-0" >Orders </h3>
                   
                </div>

                

            </div>

        </div>
       
        <div class="col-md-3">  
            <p>Time Period</p>
       <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" /></div>
        <div class="col-md-9"><p>Search Orders</p>
       <input type="text" class="search" name="" value="Search order number, product, customer name" /></div>
 

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                

                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                           <p>0 Orders total</p>
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                     <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Shipping</th>
                                        <th scope="col"></th>
                                        <th scope="col">Transaction</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Order Total</th>
                                        <th scope="col">Order Products</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Source</th>
                                        <th scope="col">Payment Gateway</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Handling Cost</th>
                                        <th scope="col">Refunded</th>
                                        <th scope="col">Sales Margin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection