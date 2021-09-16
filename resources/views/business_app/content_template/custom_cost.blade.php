@extends('business_app/common_template/main')

@section('content')
    <style type="text/css">
        .modal-backdrop {
          z-index: -1;
        }
    </style>

    <div class="container-fluid p-0 ">
            
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Custom Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
            </div>
           
            <div class="col-md-8"><p>0 total Custom costs</p></div>
            <div class="col-md-6">
                <!-- <input type="text" class="search form-control" name="" placeholder="Search by product name, SKU, Variant" /> -->
            </div>
            <div class="col-md-3">
                <!-- <label>Show 
                    <select name="example_length" aria-controls="example" class="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select> entries
                </label> -->
            </div>
            <div class="col-md-3">
               <div class="view_btns" style="text-align: right;">
                        
                    <button  class="mr_5 mb_10  small_blue_btn active "  data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Custom Cost</button>
                  
                   
                    <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a>  -->
                    <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                    <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                               
                                <!-- table-responsive -->
                                <table class="table lms_table_active3 ">
                                    <thead>
                                        
                                        <tr>
                                            <th scope="col">sr. No</th>
                                            <th scope="col">Custom Cost name</th>
                                            <!-- <th scope="col">Category name</th> -->
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Frequency</th>
                                            <th scope="col">Included in Marketing</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    @if(!empty($getBusinelist))
                                  
                                        @foreach($getBusinelist as $key=>$list)
                                        
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$list['custom_name']}} </td>
                                                <!-- <td>{{@$list['getCategory']['category_name']}} </td> -->
                                                <td>{{$list['start_date']}} </td>
                                                <td>{{$list['end_date']}} </td>
                                               
                                                <td>{{$list['frequency']}} </td>
                                                <td><input type="checkbox" class="statusSwitch" @if($list['accept_include_marketing']==1) checked @endif  readonly data-status="{{$list['id']}}"> </td>
                                                <td>{{$list['cost']}} </td>
                                                <td>
                                                <a href="#" class="greenBtn data_edit" data-value="{{$list}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{ URL('business/expenses/custom/cost/delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        

    <div class="modal fade exampleModalCenter"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">New Custom Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="formMaster" action="{{route('business_expenses_custmor_cost_submit')}}" method="POST" enctype='multipart/form-data'>
                @csrf
                    <div class="mb-3">
                        <label>Custom Cost name</label>
                        <input type="text" class="form-control name" placeholder="Custom cost name" name="name" id="name" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <label>Frequency</label>
                    <select class="custom-select mb-3 frequency_name" id="frequency_name" name="frequency_name">
                        <option value="">Please Select One</option>
                        <option value="One Time">One Time</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                    <!-- <label>Category name</label>
                    <select class="custom-select mb-3 category_id select2" searchable="Search here.." id="category_id" name="category_id">
                        @if(!empty($getCategorylist))
                        <option value="">Select One</option>
                        @foreach($getCategorylist as $list)
                        <option value="{{$list['id']}}">{{$list['category_name']}}</option>
                        @endforeach
                        @endif
                    </select> -->
                        
                    <label for="basic-url">Cost</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control cost" id="cost" value="" name="cost" aria-describedby="basic-addon3">
                    </div>
                    <label for="basic-url">Start Date</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control start_date datetimepicker1" id="start_date" name="start_date" aria-describedby="basic-addon3">
                    </div>
                    <label for="basic-url">End Date</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text " id="basic-addon3"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control end_date datetimepicker1 " name="end_date" id="end_date" aria-describedby="basic-addon3">
                    </div>
                    <input type="hidden" name="inlineitem"  value="" >
                    <div class="inlineitem">  
                        <input type="checkbox" name="inlineitem" id="inlineitem" value="1">&nbsp; &nbsp;
                        <p class="mb-0 ">Include in marketing & CAC</p>
                    </div>
                    <p>Check to Include cost in marketing & CAC</p>
                </div>
                <div class="modal-footer">
                <input type="hidden"  name="id" id="id" >
                    <button type="submit" class="btn btn-secondary" >Add & Continue</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add & Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div id="confirm-mail" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="login-card card-block login-card-modal">
                <form class="md-float-material">
                    <div class="text-center">
                        <img src="img\logo.png" alt="logo.png">
                    </div>
                    <div class="card m-t-15">
                        <div class="auth-box card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12 confirm">
                                    <h3 class="text-center txt-primary"><i class="icofont icofont-check-circled text-primary"></i>
                                        Confirmation</h3>
                                </div>
                            </div>
                            <p class="text-inverse text-left m-t-15 f-16"><b>Dear Username</p>
                            <p class="text-inverse text-left m-b-0">Welcome to our website. Really Exciting to have you here!</p>
                            <p class="text-inverse text-left m-b-20">Please click the link below to verify that this is your email address.
                            </p>
                            <p class="text-inverse text-left m-b-30">Thank you and enjoy our website.</p>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
        </div>
    </div>
    <style>
    .modal-backdrop{
        position: unset;
    }
    </style>
@endsection

@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript">

        $(function () {
            $('.select2').select2()
        });
       
        $(function() {
          $('.datetimepicker1').datetimepicker();
        });
    
        $(".data_edit").on('click',function(){
            $('#name').val($(this).data('value').custom_name);
            $('#frequency_name').val($(this).data('value').frequency);
            $('#category_id').val($(this).data('value').category_id);
            $('#cost').val($(this).data('value').cost);
            $('#start_date').val($(this).data('value').start_date);
            $('#end_date').val($(this).data('value').end_date);
            $('#inlineitem').val($(this).data('value').accept_include_marketing);
            $('#id').val($(this).data('value').id);
            $('.exampleModalCenter').modal('show')
        });

        jQuery.validator.addMethod("dollarsscents", function(value, element) {
                return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
            }, "You must include two decimal places");
       
        $('form#formMaster').validate({
            rules: {
                name:{
                    required: true,
                },
                cost: {
                    required: true,
                    maxlength:8,
                    number:true,
                    dollarsscents: true,
                },
                start_date:{
                    required: true, 
                },
                end_date:{
                    required: false, 
                },
                category_id:{
                    required: true, 
                },
                frequency_name:{
                    required: true, 
                },
               
            },
            messages: {
                name:{
                    required: 'Name is required',
                },
                cost: {
                    required: 'Cost is required',
                },
                start_date: {
                    required: 'Start Date is required',
                },
                end_date: {
                    required: 'End Date is required',
                },
                category_id: {
                    required: 'Category name is required',
                },
                frequency_name: {
                    required: 'Frequency name is required',
                },
                
            },
            submitHandler: function (form) {
                return true;
            }
        });

        $('.statusSwitch').on('change',function(){
                $.ajax({
                    type: 'POST',
                    url: "{{asset('business/category/status')}}",
                    data: {
                        '_token':"{{ csrf_token() }}",
                        'id': $(this).data('status'),
                        'status': $(this).is(":checked")
                    },
                    success: function (responseText) {
                        window.swal({
                            title: "{{ Config::get('constants.Messages.status') }}",
                            timer: 1000,
                            className: "messagedivcontainer",
                            button:false,
                            icon: 'success',
                        });
                        //$('#updated'+responseText.id).html(moment(responseText.updated_at).format('DD/MM/Y hh:mm A'));
                    }
                });
            });
            
            
    </script>
@endsection