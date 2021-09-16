@extends('business_app/common_template/main')

@section('content')
    <style>
        i.fa.fa-search {
            position: absolute;
            top: 10px;
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
        .small_blue_btn{height: 38px;padding: 11px 16px;}
        .dataTables_wrapper .dataTables_filter input{height: 38px;}
    </style>

    <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="mb-0" >Product Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-8"><p id="totalRecords">0 total products</p>
                </div>
                <!-- <div class="col-md-4"><p style="float: right;"> <a href="#">Download an example CSV file</a></p>
                </div> -->
                <!-- <div class="col-md-6"> <i class="fa fa-search"></i>
                    <input type="text" class="search form-control" name="" placeholder="Search by product name, SKU, Variant" />
                </div> -->
                <!-- <div class="col-md-3"><label>Show 
                    <select name="example_length" aria-controls="example" class="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select> entries</label>
                </div> -->
                <div class="col-md-3" style="text-align: right;">
                   <div class="view_btns">
                            
                        <!-- <a href="#" class="mr_5 mb_10  small_blue_btn active">Export to CSV</a> -->
                        <a href="#" class="mr_5 mb_10  small_blue_btn" data-toggle="modal" data-target="#importProductsModal">Excel Import</a>
                        <!-- <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a> 
                        <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                        <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <!-- <div class="white_card_header" style="box-shadow:none;">
                           <span class="profile_info" id="myDropBtn">
                            <button class="addFilter">+ Add Filter</button><div class="profile_info_iner" id="filters">
                            <div class="profile_author_name">
                                <p>Products</p>
                            </div>
                                    <div class="profile_info_details">
                                        <form>
                                            <div class="form-group">
                                                <label>Product (first order)</label>
                                                <input type="text" class="form-control" name="" placeholder="All Products">
                                            </div>
                                            <div class="form-group">
                                                <label>SKU (first order)</label>
                                                <input type="text" class="form-control" name="" placeholder="All SKUs">
                                            </div>
                                            <div class="form-group">
                                                <label>Product types (first order)</label>
                                                <input type="text" class="form-control" name="" placeholder="All Product types">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </span>
                        </div> -->

                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="QA_table mb_30">
                                   
                                    <!-- table-responsive -->
                                    <table id="shopify_products" class="table table-responsive">
                                        <thead>
                                            <tr style="background: #f2f2f2;">
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Variant ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Variant</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Product Cost</th>
                                                <th scope="col">Shipping Cost</th>
                                                <th scope="col">Handling Cost</th>
                                            </tr>
                                        </thead>
                                        @csrf
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('modal')

    <div class="modal fade exampleModalCenter"  id="productCostModal" tabindex="-1" role="dialog" aria-labelledby="productCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Product Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="hh">Product costs can vary over time. To keep your analitics calculations correct, update product costs period.</p>
                    <h3 class="he product_detail">VANS | AUTHENTIC | LO PRO | BURGANDY/WHITE - [VN-01-burgandy-4]</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Product Costs</label>
                        </div>
                        <div class="col-md-3">
                            <label>Start Date (Optional)</label>
                        </div>
                        <div class="col-md-3">
                            <label>End Date (Optional)</label>
                        </div>
                    </div>
                </div>
                <div id="append_added_product_row" class="modal-body">
                    <form role="product_cost_form" action="{{ route('add_product_cost') }}" method="post">
                        @csrf
                        <input type="hidden" name="variant_id">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text"  class="form-control" name="product_cost" placeholder="Product Cost">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="start_datepicker form-control" name="start_date" placeholder="Start Date" readonly="readonly">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="end_datepicker form-control" name="end_date" placeholder="End Date" readonly="readonly">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  <span class="sr-only">Loading...</span>
                                </button>
                                <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=product_cost_form]" data-add_more_append_element="#append_added_product_row">Add</button>
                            </div>
                        </div>
                        <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                          <strong id="product_cost_error" class="show_error_msg">Error</strong>
                          <button type="button" class="close dismiss_alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade exampleModalCenter"  id="shippingCostModal" tabindex="-1" role="dialog" aria-labelledby="shippingCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Shipping Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="hh">Shipping costs can vary over region. To keep your analitics calculations correct, update shipping costs region.</p>
                    <h3 class="he product_detail">VANS | AUTHENTIC | LO PRO | BURGANDY/WHITE - [VN-01-burgandy-4]</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Country Region</label>
                        </div>
                        <div class="col-md-3">
                            <label>Shipping Cost</label>
                        </div>
                    </div>
                </div>

                <div id="append_added_shipping_row" class="modal-body">
                    <form role="shipping_cost_form" action="{{ route('add_shipping_cost_per_product') }}" method="post">
                        @csrf
                        <input type="hidden" name="variant_id">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="custom-select mb-3 frequency_name form-control" name="country">
                                    <option value="">Please Select One</option>
                                    @foreach($country_list as $country)
                                        <option value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="shipping_cost" placeholder="shipping Cost">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  <span class="sr-only">Loading...</span>
                                </button>
                                <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=shipping_cost_form]" data-add_more_append_element="#append_added_shipping_row">Add</button>
                            </div>
                        </div>
                        <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                          <strong id="shipping_cost_error" class="show_error_msg">Error</strong>
                          <button type="button" class="close dismiss_alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary disable_btn_class" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade exampleModalCenter"  id="handlingCostModal" tabindex="-1" role="dialog" aria-labelledby="handlingCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Handling Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="handling_cost_form" action="{{ route('add_handling_cost') }}" method="post">
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong class="show_error_msg">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @csrf
                        
                    <label for="basic-url">Handling Cost</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control cost" value="" name="handling_cost" aria-describedby="basic-addon3">
                    </div>
                    <input type="hidden" name="variant_id">
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

    <div class="form_modal modal fade exampleModalCenter"  id="importProductsModal" tabindex="-1" role="dialog" aria-labelledby="importProductsModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Import Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="import_products_form" action="{{ route('import_products') }}" method="post">
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong class="show_error_msg">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @csrf
                        
                    <label for="basic-url">Upload products excel file</label>
                    <div class="input-group mb-3">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div> -->
                        <input type="file" class="form-control cost" name="import_products" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="sr-only">Loading...</span>
                    </button>
                    <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=import_products_form]" >Add</button>
                    <button type="button" class="btn btn-primary disable_btn_class" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">

    function savedProductHtml(saved_product_json){
        
        let saved_product_cost = JSON.parse(saved_product_json);
        var saved_product_html = '';
        jQuery.each(saved_product_cost.product_json, function(index, item) {
            // do something with `item` (or `this` is also `item` if you like)
            
            saved_product_html +=  '<div id="product_cost_'+item.id+'" class="row saved_product_cost_list">'+
                                '<div class="col-md-3">'+
                                    '<input type="text" class="form-control" name="product_cost" value="'+item.profitrack_product_cost+'" readonly>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<input type="text" class="form-control" name="start_date" value="'+item.start_date+'" readonly="readonly">'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<input type="text" class="form-control" name="end_date" value="'+item.end_date+'" readonly="readonly">'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<button id = "product_cost_loader_'+item.id+'" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">'+
                                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
                                    '</button>'+
                                    '<button type="button" class="close" aria-label="Close" data-url="'+'{{ route('delete_product_cost') }}'+'" data-request="inline-post-ajax" data-method="post" data-variable="product_cost_id" data-product_cost_id="'+item.id+'" data-show_error="#product_cost_error" data-disable_element_class=".product_cst_btn_'+item.id+'" data-loader="#product_cost_loader_'+item.id+'" data-swal_message="Are You Sure to Delete?" data-remove_element="#product_cost_'+item.id+'">'+
                                      '<span aria-hidden="true"><i class="fa fa-trash"></i></span>'+
                                    '</button>'+
                                '</div>'+
                            '</div>';
        });

        return saved_product_html;
    }

    function savedShippingCostHtml(saved_shipping_json){
        
        let saved_shipping_cost = JSON.parse(saved_shipping_json);
        var saved_shipping_html = '';
        jQuery.each(saved_shipping_cost.product_json, function(index, item) {
            // do something with `item` (or `this` is also `item` if you like)
            saved_shipping_html +=  '<div id="shipping_cost_'+item.id+'" class="row saved_shipping_cost_list">'+
                                '<div class="col-md-6">'+
                                    '<input type="text" class="form-control" name="country" value="'+item.country+'" readonly="readonly">'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<input type="text" class="form-control" name="shipping_cost" value="'+item.shipping_cost+'" readonly>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<button id = "shipping_cost_loader_'+item.id+'" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">'+
                                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
                                    '</button>'+
                                    '<button type="button" class="close" aria-label="Close" data-url="'+'{{ route('delete_shipping_cost_per_product') }}'+'" data-request="inline-post-ajax" data-method="post" data-variable="shipping_cost_id" data-shipping_cost_id="'+item.id+'" data-show_error="#shipping_cost_error" data-disable_element_class=".shipping_cst_btn_'+item.id+'" data-loader="#shipping_cost_loader_'+item.id+'" data-swal_message="Are You Sure to Delete?" data-remove_element="#shipping_cost_'+item.id+'">'+
                                      '<span aria-hidden="true"><i class="fa fa-trash"></i></span>'+
                                    '</button>'+
                                '</div>'+
                            '</div>';
        });

        return saved_shipping_html;
    }

    $('body').on('click','.remove_episode',function(e){
        var $this           = $(this);
        var episode_id      = $this.parent().parent().attr('data-episode_id');
        var total_episodes  = $('.episode_item').length;


        $("body .episode_item").each(function(){
            var current_episode = $(this).attr('data-episode_id');

            if(current_episode > episode_id){
                current_episode_value = current_episode -parseInt(1);
                $(this).attr('data-episode_id',current_episode_value);
                $(this).find('.episode_number').html('E'+current_episode_value);
            }
        });
        
        $this.parent().parent().remove();
        episode_name = episode_name - parseInt(1);

    });


        $(document).on('click','.add_prftrck_hnd_cst',function(){
            let variant_id = $(this).data('variant_id');
            $('input[name="variant_id"]').val(variant_id);
        });

        $(document).on('click','body .add_prftrck_prdct_cst',function(){
            let variant_id              = $(this).data('variant_id');
            $('input[name="variant_id"]').val(variant_id);
            var records_populated = $(this).attr('data-records_populated');
            var product_detail = $(this).attr('data-product_detail');
            $('.product_detail').html(product_detail);

            if(records_populated === 'no'){
                let saved_product_json      = $(this).data('saved_product_json');
                let saved_product_cost_html = savedProductHtml(decodeURIComponent(saved_product_json));
                $('#append_added_product_row').find('.saved_product_cost_list').remove();
                $('#append_added_product_row').prepend(saved_product_cost_html);
                $(this).attr('data-records_populated','yes');
            }

        });

        $(document).on('click','.add_prftrck_shp_cst',function(){
            let variant_id              = $(this).data('variant_id');
            $('input[name="variant_id"]').val(variant_id);
            var records_populated   = $(this).attr('data-records_populated');
            var product_detail      = $(this).attr('data-product_detail');
            $('.product_detail').html(product_detail);

            if(records_populated === 'no'){
                let saved_shipping_json      = $(this).data('saved_product_json');
                let saved_shipping_cost_html = savedShippingCostHtml(decodeURIComponent(saved_shipping_json));
                console.log(saved_shipping_cost_html);
                $('#append_added_shipping_row').find('.saved_shipping_cost_list').remove();
                $('#append_added_shipping_row').prepend(saved_shipping_cost_html);
                $(this).attr('data-records_populated','yes');
            }

        });

        var url = "{{route('product_ajax_list')}}";
        // $('.page-event').click(function(){
        //     var oTable = $('#shopify_products').dataTable();
        //     oTable.fnPageChange( 'first' );
        // })

        var table = $('#shopify_products').DataTable({
            dom: 'lBfrtip',
            buttons: [
                { 
                  extend: 'excel',
                  text: 'Export to Excel'
               }
                // 'csv', 'excel',
            ],
          
            "aaSorting": [],
            "pagingType":'simple_numbers',
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "stateSave":false,
            "ajax": {
                "url": url,
                "type": "POST",
                // "drawCallback": function (response) { 
                //     // Here the response
                //     console.log(response);
                // }
                "dataSrc": function (response) {
                    let total_records_text = response.recordsTotal+' total products';
                    $('#totalRecords').html(total_records_text);
                    return response.data;
                },
            },
           
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },],
            // "createdRow": function ( row, data, index ) {
            //     var outer_text= $('td', row).eq(10)[0].outerText.trim();
            //     if(outer_text == 'Cancelled'){
            //         $('td', row).eq(10).addClass('highlight1');
            //     }
            //     var inner_text = $('td', row).eq(6)[0].innerText.trim();
            //     if(inner_text == ''){
            //         $('td', row).eq(6).addClass('highlight');
            //     }
            // }
           
        });

        // if(performance.navigation.type == 1) { 
        //     var oTable = $('#shopify_products').dataTable();
        //     oTable.fnPageChange( 'first' );
        // } 

        // table.on('page.dt', function() {
        //     $('html, body').animate({
        //       scrollTop: $(".dataTables_wrapper").offset().top
        //     }, 'fast');
        // });
        // $('.dataTables_filter').children().before('<button type="button" class="pull-right" id="clear_search" >Clear</button>');

        // $('#clear_search').click(function(){
        //     table.search('').draw();
        // });

</script>
@endsection
