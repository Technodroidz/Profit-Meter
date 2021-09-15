@extends('business_app/common_template/main')

@section('content')
<style>
    form .modal-body, form .modal-footer{padding:1rem 0px;}
    .modal-footer>*{margin: 0px}
</style>

    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="page_title_left  mb_30">
                    <h3 class="mb-0">Tax Rate <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                               
                </div>
                <div class="white_box">
                            <!--  <div class="box_header ">
                               <div class="main-title">
                                    <h3 class="mb-0" >Additional  Notifications</h3>
                                </div>
                            </div> -->
                    <div class="alert" role="alert">
                        <h6>Vat Tax</h6>
                        <p>Tax paid by the merchant on the sales revenue (for example VAT)</p>
<!--                         <ul style="font-size: 24px; margin-left: 20px; color:#2795fb">
                            <li  style="list-style-type: circle;">
                                <p>If an end customer uses Shopify Pyments for checking out, then Shopify takes a % fee and a fixed amount in USD based on the merchant's Shopify plan.</p>
                            </li>
                            <li  style="list-style-type: circle;">
                                <p>If an end cusotmer uses some other payment gateway Shopify takes alternative % fee based on the merchant's Shopify plan.</p>
                            </li>
                        </ul>
                        <br> -->

                        <!-- <a href="" style="color: #7b7b7b;"><u>See Shopify Payment Pricing</u></a><br><br><br>
                        <p>Current plan based on your data<br> Shopify Transaction costs (Shopify payments 0% + 0 USD, other 0%)<a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                        </p>

                        <button style="float:right;margin-right: 61px;" class="small_blue_btn active" data-toggle="modal" data-target="#TransactionCostModal">Add Gateway</button>


                        <table class="table lms_table_active3 dataTable no-footer dtr-inline" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info" style="width: 1140px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 60%;"><b>Name</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Percentage Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Fixed Fee</b></th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table> -->
                        <form role="tax_form" action="{{ route('update_tax_rate') }}" method="post">
                            <div class="modal-body">
                                <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                                  <strong class="show_error_msg">Error</strong>
                                  <button type="button" class="close dismiss_alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                @csrf

                                <label for="basic-url">Tax Rate</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="text" class="form-control cost" name="tax_rate" value="{{isset($tax['value']) ? $tax['value'] : ''}}" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  <span class="sr-only">Loading...</span>
                                </button>
                                <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=tax_form]" >Save</button>
                            </div>
                        </form>
                    </div>
                </div>
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
