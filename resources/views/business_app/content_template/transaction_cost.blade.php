@extends('business_app/common_template/main')

@section('content')

    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="page_title_left  mb_30">
                    <h3 class="mb-0">Transaction Cost <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                               
                </div>
                <div class="white_box">
                            <!--  <div class="box_header ">
                               <div class="main-title">
                                    <h3 class="mb-0" >Additional  Notifications</h3>
                                </div>
                            </div> -->
                    <div class="alert" role="alert">
                        <h6>Transaction Costs</h6>
                        <p>Transaction costs are fees taken by shopify and payment providers from the  order revenue</p>
                        <ul style="font-size: 24px; margin-left: 20px; color:#2795fb">
                            <li  style="list-style-type: circle;">
                                <p>If an end customer uses Shopify Pyments for checking out, then Shopify takes a % fee and a fixed amount in USD based on the merchant's Shopify plan.</p>
                            </li>
                            <li  style="list-style-type: circle;">
                                <p>If an end cusotmer uses some other payment gateway Shopify takes alternative % fee based on the merchant's Shopify plan.</p>
                            </li>
                        </ul>
                        <br>

                        <a href="" style="color: #7b7b7b;"><u>See Shopify Payment Pricing</u></a><br><br><br>
                        <p>Current plan based on your data<br> Shopify Transaction costs (Shopify payments 0% + 0 USD, other 0%)<a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                        </p>

                        <button style="float:right;margin-right: 61px;" class="small_blue_btn active">Add Gateway</button>


                        <table class="table lms_table_active3 dataTable no-footer dtr-inline" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info" style="width: 1140px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 60%;"><b>Name</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Percentage Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Fixed Fee</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr> 
                            </tbody>
                        </table>
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
    </script>

@endsection