@extends('business_app/common_template/main')

@section('content')

    <style>
        .inlineitem input[type="checkbox"] {
            width: auto;
            display: inline-block;
        }
        .inlineitem p, .inlineitem li label {
            display: inline-block;
        }
        .inlineitem {
            display: flex;
            align-items: center;
        }
        .inlineitem li {
            display: inline-block;
        }
        .inlineitem h4 {
            display: inline-block;
        }
        input{margin-bottom: 0px;}
    </style>

    <div class="container-fluid p-0 ">
            <!-- page title  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page_title_left  mb_30">
                    <h3 class="mb-0" >Shipping Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                           
                </div>
                <div class="white_box">
                       <!--  <div class="box_header ">
                           <div class="main-title">
                                <h3 class="mb-0" >Additional  Notifications</h3>
                            </div>
                        </div> -->
                    <form role="shipping_cost_setting" action="{{ route('save_shipping_cost_setting') }}" method="post" >
                        @csrf
                        <div class="alert" role="alert">
                            <h4 class="">Options</h4>

                            <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                              <strong id="shipping_setting_error" class="show_error_msg">Error</strong>
                              <button type="button" class="close dismiss_alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                               <!--  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p> -->
                            <!-- <hr> -->
                            <!-- <div class="inlineitem">  <label class="lms_checkbox_1" for="course_1">
                                <input type="checkbox" id="course_1">
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Import cost from shipping labels purchased through shopify. </p>
                            </div> -->
                            <hr>
                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_2">
                                <input type="checkbox" name="multiply_shipping_fee" id="course_2" value="1" {{ isset($shipping_cost_setting['multiply_shipping_fee']) && $shipping_cost_setting['multiply_shipping_fee'] == 1 ? 'checked':'' }} data-target="input[name=highest_shipping_fee]" onchange="checkUncheck($(this));">
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Multiply the shipping fee by the quantity of products purchased.</p>
                            </div>
                            <hr>
                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_3">
                                <input type="checkbox" id="course_3" name="fallback_country_rule" value="1" {{ isset($shipping_cost_setting['fallback_country_rule']) && $shipping_cost_setting['fallback_country_rule'] == 1 ? 'checked':'' }}>
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Fallback the country rule when no cost for product has been set.</p>
                            </div>
                            <hr>
                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_4">
                                <input type="checkbox" id="course_4" name="multiply_handling_fee" value="1" {{ isset($shipping_cost_setting['multiply_handling_fee']) && $shipping_cost_setting['multiply_handling_fee'] == 1 ? 'checked':'' }} data-target="input[name=highest_handling_fee]" onchange="checkUncheck($(this));">
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Multiply the Handling Cost by the quantity of products purchased.</p>
                            </div>
                            <hr>

                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_5">
                                <input type="checkbox" id="course_5" name="shipping_fee_together" value="1" {{ isset($shipping_cost_setting['shipping_fee_together']) && $shipping_cost_setting['shipping_fee_together'] == 1 ? 'checked':'' }} >
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Add shipping fees together in orders with multiple items.</p>
                            </div>
                            <hr>

                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_6">
                                <input type="checkbox" id="course_6" name="highest_shipping_fee" value="1" {{ isset($shipping_cost_setting['highest_shipping_fee']) && $shipping_cost_setting['highest_shipping_fee'] == 1 ? 'checked':'' }} data-target="input[name=multiply_shipping_fee]" onchange="checkUncheck($(this));">
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Use the highest shipping fee only in orders with multiple items.</p>
                            </div>
                            <hr>

                            <div class="inlineitem">  <label class="lms_checkbox_1" for="course_7">
                                <input type="checkbox" id="course_7" name="highest_handling_fee" value="1" {{ isset($shipping_cost_setting['highest_handling_fee']) && $shipping_cost_setting['highest_handling_fee'] == 1 ? 'checked':'' }} data-target="input[name=multiply_handling_fee]" onchange="checkUncheck($(this));">
                                <div class="slider-check round"></div>
                                </label><p class="mb-0 "> Use the highest Handling fee only in orders with multiple items.</p>
                            </div>
                            <hr>

                            <!-- <div class="inlineitem">  <input type="checkbox" aria-label=""  name="shipping_fee_together" value="1" {{ isset($shipping_cost_setting['shipping_fee_together']) && $shipping_cost_setting['shipping_fee_together'] == 1 ? 'checked':'' }}>&nbsp; &nbsp;
                                <p class="mb-0 ">Add shipping fees together in orders with multiple items.</p>
                            </div> -->

                               
                            <!-- <div class="inlineitem">  <input type="checkbox" aria-label="" name="highest_shipping_fee" value="1" {{ isset($shipping_cost_setting['highest_shipping_fee']) && $shipping_cost_setting['highest_shipping_fee'] == 1 ? 'checked':'' }} data-target="input[name=multiply_shipping_fee]" onchange="checkUncheck($(this));">&nbsp; &nbsp;
                                <p class="mb-0 ">Use the highest shipping fee only in orders with multiple items. </p>
                            </div> -->

                            

                            <!-- <div class="inlineitem">  <input type="checkbox" aria-label="" name="highest_handling_fee" value="1" {{ isset($shipping_cost_setting['highest_handling_fee']) && $shipping_cost_setting['highest_handling_fee'] == 1 ? 'checked':'' }} data-target="input[name=multiply_handling_fee]" onchange="checkUncheck($(this));">&nbsp; &nbsp;
                                <p class="mb-0 ">Use the highest Handling fee only in orders with multiple items. </p>
                            </div> -->
                            <button id = "shipping_cost_form_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                              <span class="sr-only">Loading...</span>
                            </button><br/>
                            <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=shipping_cost_setting]" data-show_error="#shipping_setting_error" data-disable_element_class=".disable_btn_class" data-loader="#shipping_cost_form_loader" >Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="white_box" style="margin-top:30px; padding:5px">
                    <!--  <div class="box_header ">
                       <div class="main-title">
                            <h3 class="mb-0" >Additional  Notifications</h3>
                        </div>
                    </div> -->
                    <div class="alert" role="alert" >
                        <div class="inlineitem">
                            <h4 class="">Country Rules</h4><button class="country" data-toggle="modal" data-target="#countryRuleModal"><i class="far fa-dot-circle"></i> Add Country</button>
                        </div>
                        <!--  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p> -->
                        <hr>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="QA_table mb_30">
                                   
                                    <!-- table-responsive -->
                                    <table id="shopify_products" class="table lms_table_active3">
                                        <thead>
                                            <tr style="background: #f2f2f2;">
                                                <th scope="col">Country</th>
                                                <th scope="col">Shipping Cost</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($country_rules as $key => $value)
                                            <tr id="country_rule_{{$value->id}}">
                                                <td>{{$value->country}}</td>
                                                <td>{{$value->shipping_cost}}</td>
                                                <td>
                                                    <button id = "country_rule_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="close country_rule_btn" aria-label="Close" data-url="{{route('delete_shipping_country_rule')}}" data-request="inline-post-ajax" data-method="post" data-variable="country_rule_id" data-country_rule_id="{{$value->id}}" data-show_error="#country_rule_error" data-disable_element_class=".country_rule_btn" data-loader="#country_rule_loader" data-swal_message="Are You Sure to Delete.">
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
            </div>

            <!-- <div class="col-lg-12">
                <div class="white_box" style="margin-top:30px; padding:5px">
                     <div class="box_header ">
                       <div class="main-title">
                            <h3 class="mb-0" >Additional  Notifications</h3>
                        </div>
                    </div>
                    <div class="alert" role="alert" >
                        <div class="inlineitem">
                            <h4 class="">Product Rules</h4> &nbsp; &nbsp;&nbsp; &nbsp;<li>
                            <input id="checkid" type="checkbox" value="test" />
                            <label style="word-wrap:break-word">Show Deleted Products</label></li>
                        </div>
                         <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                        <hr>
                        <table class="table lms_table_active3 dataTable no-footer dtr-inline" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info" style="width: 1140px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col"  tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 46%;">Product Name</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" >Status</th><th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"  >Shipping Fee</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" >Country Rules</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"  >Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>No Data</tr>
                                
                           </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </div>


@endsection

@section('modal')
    <div class="modal fade form_modal" id="countryRuleModal" tabindex="-1" role="dialog" aria-labelledby="countryRuleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form_role" action="{{ route('add_shipping_country_rule') }}" method="post" >
                    @csrf                    
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Country Rule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                          <strong id="show_country_rule_error" class="show_error_msg">Error</strong>
                          <button type="button" class="close dismiss_alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <label>Country</label>
                        <select class="custom-select mb-3 frequency_name" id="frequency_name" name="country">
                            <option value="">Please Select One</option>
                            @foreach($country_list as $country)
                                <option value="{{$country}}">{{$country}}</option>
                            @endforeach
                        </select>

                        <label for="basic-url">Shipping Cost</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control cost" id="cost" value="" name="shipping_cost" aria-describedby="basic-addon3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id = "form_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          <span class="sr-only">Loading...</span>
                        </button>
                        <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=form_role]" data-show_error="#show_country_rule_error" data-disable_element_class=".disable_btn_class" data-loader="#form_loader" >Add</button>
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

    function checkUncheck(e) {
        var _target = e.data('target');

        if(e.is(':checked')){
            $(_target).prop('checked', false);
        }else{
            $(_target).prop('checked', true);
        }
    }

</script>
@endsection
