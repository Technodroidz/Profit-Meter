@extends('business_app/common_template/main')

@section('content')
<style>
    button.small_blue_btn.active {
        background: #373063;
        color: #fff;
        margin-left: 20px;
        border: none;
        height: 38px;
        border-radius: 4px;
        padding: 9px 16px;
    }
</style>

    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="page_title_left  mb_30">
                    <h3 class="mb-0">Transaction Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                               
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

                        <!-- <a href="" style="color: #7b7b7b;"><u>See Shopify Payment Pricing</u></a><br><br><br>
                        <p>Current plan based on your data<br> Shopify Transaction costs (Shopify payments 0% + 0 USD, other 0%) --><!-- <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i> </a> -->
                        <!-- </p> -->

                        <button style="float:right;" class="small_blue_btn active" data-toggle="modal" data-target="#TransactionCostModal">Add Gateway</button>


                        <table class="table lms_table_active3 dataTable no-footer dtr-inline" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info" style="width: 1140px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 40%;"><b>Name</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Shopify Percentage Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Percentage Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Fixed Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($transaction_cost as $list) 
                                    <tr id="transaction_cost_{{$list->id}}">
                                        <td>{{ $list->payment_gateway }}</td>
                                        <td>{{$list->shopify_percentage_fee}}</td>
                                        <td>{{$list->percentage_fee}}</td>
                                        <td>{{$list->fixed_fee}}</td>
                                        <td>
                                            <button id = "transaction_cost_loader_{{$list->id}}" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </button>
                                            <button type="button" class="close transaction_cst_btn" aria-label="Close" data-url="{{route('delete_transaction_cost')}}" data-request="inline-post-ajax" data-method="post" data-variable="transaction_cost_id" data-transaction_cost_id="{{$list->id}}" data-disable_element_class=".transaction_cst_btn" data-loader="#transaction_cost_loader_{{$list->id}}" data-swal_message="Are You Sure to Delete.">
                                              <span aria-hidden="true"><i class="fa fa-trash"></i></span>
                                            </button>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    
    <div class="modal fade exampleModalCenter"  id="TransactionCostModal" tabindex="-1" role="dialog" aria-labelledby="TransactionCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Transaction Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="handling_cost_form" action="{{ route('add_transaction_cost') }}" method="post">
                    <div class="modal-body">
                        <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                          <strong class="show_error_msg">Error</strong>
                          <button type="button" class="close dismiss_alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        @csrf
                        <label for="basic-url">Payment Gateway</label>

                        <div class="input-group mb-3">
                            <select class="custom-select mb-3 frequency_name" name="payment_gateway">
                                <option value="">Select a gateway</option>
                                @foreach($payment_gateway_list as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="basic-url">Shopify Percentage Fee</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="text" class="form-control cost" value="" name="shopify_percentage_fee" aria-describedby="basic-addon3">
                        </div>
                        <label for="basic-url">Percentage Fee</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="text" class="form-control cost" value="" name="percentage_fee" aria-describedby="basic-addon3">
                        </div>
                        <label for="basic-url">Fixed Fee</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"> 
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control cost" value="" name="fixed_fee" aria-describedby="basic-addon3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          <span class="sr-only">Loading...</span>
                        </button>
                        <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=handling_cost_form]" >Add</button>
                        <button type="button" class="btn btn-primary disable_btn_class" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
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
