@extends('business_app/common_template/main')

@section('content')
    <style>
        .search{width:100%;}
        #reportrange{
            padding: 8px 10px;
            height: 38px;
            margin: 0px 0px 16px 0px;
        }
        i.fa.fa-search {
            position: absolute;
            top: 44px;
            left: 30px;
            font-size: 18px;
            color: #6c757d;
        }
        .search {
            width: 100%;
            padding-left: 50px;
            height:38px;
        }
        select {
            word-wrap: normal;
            height: 38px;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
    </style>

    <div class="container-fluid p-0 ">
        <!-- page title  -->
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Orders <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
            </div>
           
            <div class="col-md-2 col-xs-6">  
                    <p>Time Period</p>
                <div id="reportrange"  class="pull-left">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
            <div class="col-md-10 col-xs-6">
                <p>Search Orders</p>
                <i class="fa fa-search"></i>
                <input type="text" class="search form-control" name="" placeholder="Search order number, product, customer name" />
            </div>
     
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header" style="box-shadow:none;">
                       <span class="profile_info" id="myDropBtn">
                        <button class="addFilter">+ Add Filter</button><div class="profile_info_iner" id="filters">
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

                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                               <p>0 Orders total</p>
                                <!-- table-responsive -->
                                <label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label>
                                <table class="table lms_table_active3">
                                    <thead>
                                        <tr style="background: #f2f2f2;">
                                            <th scope="col">Order Number</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Products</th>
                                            <th scope="col">Revenue</th>
                                            <th scope="col">Profit</th>
                                            <th scope="col">Net Margin</th>
                                            <th scope="col">COGS</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col">Shipping Costs</th>
                                            <th scope="col">Handling Costs</th>
                                            <th scope="col">Transaction Costs</th>
                                            <th scope="col">Taxes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $value)
                                        <tr>
                                           <td>{{$value['order_number']}}</td>
                                           <td>{{$value['created_at']}}</td>
                                           <td>John Doe</td>
                                           <td>{{$value['financial_status']}}</td>
                                           <td>{{$value['line_items'][0]['title']}}</td>
                                           <td>5200</td>
                                           <td>2500</td>
                                           <td>3522</td>
                                           <td>5485</td>
                                           <td>{{$value['current_total_price']}}</td>
                                           <td>25</td>
                                           <td>35</td>
                                           <td>52</td>
                                           <td>{{$value['current_total_tax']}}</td>
                                        </tr>
                                        @endforeach

                                        <!-- <tr>
                                           <td>5200002</td>
                                           <td>15 May 2021</td>
                                           <td>Iris</td>
                                           <td>Active</td>
                                           <td>20</td>
                                           <td>5200</td>
                                           <td>2500</td>
                                           <td>3522</td>
                                           <td>5485</td>
                                           <td>1500</td>
                                           <td>25</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr>
                                        <tr>
                                           <td>5200003</td>
                                           <td>15 May 2021</td>
                                           <td>John Doe</td>
                                           <td>Active</td>
                                           <td>35</td>
                                           <td>5200</td>
                                           <td>2500</td>
                                           <td>3522</td>
                                           <td>5485</td>
                                           <td>1500</td>
                                           <td>25</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr>
                                        <tr>
                                           <td>5200004</td>
                                           <td>15 May 2021</td>
                                           <td>John Doe</td>
                                           <td>Active</td>
                                           <td>35</td>
                                           <td>5200</td>
                                           <td>2500</td>
                                           <td>3522</td>
                                           <td>5485</td>
                                           <td>1500</td>
                                           <td>25</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr>
                                        <tr>
                                           <td>5200004</td>
                                           <td>15 May 2021</td>
                                           <td>John Doe</td>
                                           <td>Active</td>
                                           <td>35</td>
                                           <td>5200</td>
                                           <td>2500</td>
                                           <td>3522</td>
                                           <td>5485</td>
                                           <td>1500</td>
                                           <td>25</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
          $('input[name="daterange"]').daterangepicker({
            opens: 'left'
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          });
        });
            
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
            
        });
    </script>

@endsection