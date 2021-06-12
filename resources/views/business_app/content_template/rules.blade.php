@extends('business_app/common_template/main')

@section('content')

    <style>
        .card-body.pad-0 {
            box-shadow: 0px 0px 10px 1px rgb(0 0 0 / 20%);
            border-radius: 4px;
        }
    </style>

    <div class="container-fluid p-0 ">
         <!-- page title  -->
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="page_title_box ">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Exclude orders from the reports <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
                <hr>
                <div class="white_card mb_30 mt_30 pad-16 br-16">
                    <form method="POST" action="{{route('business_setting_rules')}}">
                        @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                              <p>Financial status</p>
                              <div class="radio">
                                <input id="radio-1" name="financial_status" type="radio" value="pending" {{(isset($rules->financial_status) && $rules->financial_status == 'pending') ? 'checked':''}}>
                                <label for="radio-1" class="radio-label">Pending</label>
                              </div>

                              <div class="radio">
                                <input id="radio-2" name="financial_status" type="radio" value="authorized" {{(isset($rules->financial_status) && $rules->financial_status == 'authorized') ? 'checked':''}} >
                                <label  for="radio-2" class="radio-label">Authorized</label>
                              </div>
                              <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <div class="form-group">
                              <p>Orders</p>
                              <div class="checkbox">
                                <input name="zero_value_order" class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="1" {{ (isset($rules->zero_value_order) && $rules->zero_value_order == 1) ? 'checked':'' }} >
                                <label for="styled-checkbox-1">Zero value orders</label>
                              </div>
                              <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <input name="cancelled_order" class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="1" {{ (isset($rules->cancelled_order) && $rules->cancelled_order == 1)? 'checked':'' }} >

                                <label for="styled-checkbox-2">Cancelled orders</label>
                              </div>
                              <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <div class="form-group">
                              <p>Orders tags</p>
                              <input type="text" name="order_tags" class="form-control" id="order_tag" placeholder="" value="{{isset($rules->order_tags) ? $rules->order_tags : ''}}">

                              <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <br/>
                            <div class="form-group">
                              <p>Sales channel</p>
                               <div class="checkbox">
                                <input name="pos" class="styled-checkbox" id="styled-checkbox-3" type="checkbox" value="1" {{ (isset($rules->pos) && $rules->pos == 1) ? 'checked':'' }}>
                                <label for="styled-checkbox-3">POS</label>
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <input name="draft_order" class="styled-checkbox" id="styled-checkbox-4" type="checkbox" value="1" {{ (isset($rules->draft_order) && $rules->draft_order == 1) ? 'checked':'' }} >
                                <label for="styled-checkbox-4">Draft orders</label>
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                              </div>
                            </div>
                            <div class="form-group">
                              <p>Order channels</p>
                                <input type="text" name="order_channels" class="form-control w_300" value="{{ isset($rules->order_channels) ? $rules->order_channels:'' }}" >
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <br/>
                            <div class="form-group">
                              <p>Customers</p>
                              <label>Customer tags</label>
                                <input type="text" name="customer_tags" class="form-control" id="width250" value="{{ isset($rules->customer_tags) ? $rules->customer_tags:'' }}" placeholder="">
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <!-- <div class="form-group">
                              <button class="saveBtn">Save changes</button>
                            </div> -->
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Calculation logic</h3>
                            <br/>
                            <div class="form-group">
                                <input name="refund_order_cost_to_zero" class="styled-checkbox" id="styled-checkbox-5" type="checkbox" value="1" {{ (isset($rules->refund_order_cost_to_zero) && $rules->refund_order_cost_to_zero == 1) ? 'checked':'' }}>
                                <label for="styled-checkbox-5">Reset products costs to zero for all refunded orders</label>
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            <div class="form-group">
                                <input name="assign_original_order_date_to_refund" class="styled-checkbox" id="styled-checkbox-6" type="checkbox" value="1" {{ (isset($rules->assign_original_order_date_to_refund) && $rules->assign_original_order_date_to_refund == 1) ? 'checked':'' }}>
                                <label for="styled-checkbox-6">Assign refunds to the original order date instead of the processing date</label>
                                <p class="messTxt">Check to inclose unread orders from imports</p>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger hiddenError">
                                    <ul>
                                        <li>{{ session()->get('error') }}</li>
                                    </ul>
                                  </div>
                            @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="form-group">
                              <button class="saveBtn">Save changes</button>
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
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function() {

          $('input[name="order_tags"],input[name="customer_tags"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
          });
          
          $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
          }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
          });

            $('form').on('keyup keypress', function(e) {
              var keyCode = e.keyCode || e.which;
              if (keyCode === 13) { 
                e.preventDefault();
                return false;
              }
            });
          
        });

    </script>

    @endsection

@endsection