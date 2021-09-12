@extends('admin.super-admin.layouts.common')
@section('content')

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Payment Gateway Settings</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="{{asset('admin-panel')}}"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">Payment Gateway Settings</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <!-- <div class="page-body"> -->
                                        
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Pay Pal Payment Gateway Settings</h5>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-spinner-alt-5"></i>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-payment-configration')}}" method="POST" id="payPalFormValidation" enctype='multipart/form-data'>
                                                       @csrf
                                                            
                                                            @foreach ($getPayment['paypal'] as $settingValue)
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}</label>
                                                                    @if($settingValue->option_name !='paypal_status')
                                                                    <div class="col-sm-10">
                                                                        <input type="{{ $settingValue->input_type }}" class="form-control" name="{{ $settingValue->option_name }}"  placholder="{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}"  value="{{ @$settingValue->option_value }}">
                                                                    </div>
                                                                    @else
                                                                    <div class="col-sm-10">
                                                                    <select class="currency-selector input-group-addon" name="{{$settingValue->option_name }}">
                                                                    <option value="ACTIVE" <?php echo ('ACTIVE'==@$settingValue->option_value  ?'selected':''); ?>>Active</option>
                                                                    <option value="Inactive" <?php echo ('Inactive'==@$settingValue->option_value  ?'selected':''); ?>>Inactive</option>
                                                                    </select>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach

                                                            
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    <!-- </div> -->
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main body end -->
                                <!-- Main-body start -->
                                <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!--Table start-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Stripe Payment Gateway Settings</h5>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-spinner-alt-5"></i>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-payment-configration')}}" method="POST" id="payStripFormValidation" enctype='multipart/form-data'>
                                                       @csrf
                                                            @foreach ($getPayment['stripe'] as $settingValue)
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}</label>
                                                                    @if($settingValue->option_name !='stripe_status')
                                                                    <div class="col-sm-10">
                                                                        <input type="{{ $settingValue->input_type }}" class="form-control" name="{{ $settingValue->option_name }}"  placholder="{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}"  value="{{ @$settingValue->option_value }}">
                                                                    </div>
                                                                    @else
                                                                    <div class="col-sm-10">
                                                                    <select class="currency-selector input-group-addon" name="{{$settingValue->option_name }}">
                                                                    <option value="ACTIVE" <?php echo ('ACTIVE'==@$settingValue->option_value  ?'selected':''); ?>>Active</option>
                                                                    <option value="Inactive" <?php echo ('Inactive'==@$settingValue->option_value  ?'selected':''); ?>>Inactive</option>
                                                                    </select>
                                                                    </div>
                                                                    @endif
                                                                    
                                                                </div>
                                                            @endforeach
                                                           
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main body end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateSymbol(e){
          var selected = $(".currency-selector option:selected");
          $(".currency-symbol").text(selected.data("symbol"))
          $(".currency-amount").prop("placeholder", selected.data("placeholder"))
          $('.currency-addon-fixed').text(selected.text())
        }
        
        $(".currency-selector").on("change", updateSymbol)
        
        updateSymbol()
    </script>
    <style>
        .input-group-addon {
            background-color: #01a9ac;
            color: #fff;
            padding: 5px 16px;
            height: 38px;
            font-size: 20px;
        }
        select.currency-selector {
            background: #01a9ac;
            border: none;
            color: #fff;
        }
    </style>
@stop


@section('custom_script')

    <script>
        $(document).ready(function () { 
                $('form#payPalFormValidation').validate({
                    rules: {
                        privet_key: {
                            required: true,
                        },
                      
                    
                        public_key: {
                            required: true,
                        },
                    },
                    messages: {
                        privet_key: {
                            required: 'This field is required',
                        },
                        public_key: {
                            required: 'This field is required',
                        },
                     
                    },
                    
                });


                $('form#payStripFormValidation').validate({
                    rules: {
                        privet_key: {
                            required: true,
                        },
                      
                    
                        public_key: {
                            required: true,
                        },
                    },
                    messages: {
                        privet_key: {
                            required: 'This field is required',
                        },
                        publick_key: {
                            required: 'This field is required',
                        },
                     
                    },
                    
                });
            });
    </script>
@endsection