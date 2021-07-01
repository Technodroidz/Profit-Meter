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
                                                        <h4>Subscription</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('subscription')}}">Subscription</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Subscription Plans</h5>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-spinner-alt-5"></i>
                                                        </div>
                                                    </div>
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger hiddenError">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if(session()->has('message'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                    @endif
                                                    <hr/>
                                                     
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-subscruption')}}" method="POST" id="addSocialIconsForm1" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Package name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getSubscribeData['0']['package_name']}}" placeholder="Enter package name" <?php echo (@$getSubscribeData['0']['package_name_slug']=='trial-plan'? 'readonly':'') ?>>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Package amount (In $) </label>
                                                                    <input type="text" class="form-control" name="amount" id="amount" value="{{@$getSubscribeData['0']['package_amount']}}" placeholder="Enter Amount" step="any" <?php echo (@$getSubscribeData['0']['package_name_slug']=='trial-plan'? 'readonly':'') ?>>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Package duration (In Days)</label>
                                                                    <input type="number" class="form-control number" name="duration" id="duration" value="{{@$getSubscribeData['0']['package_duration']}}" placeholder="Enter package duration">
                                                                </div>
                                                            
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Package short description</label>
                                                                    <textarea class="form-control" name="sort_description" id="sort_description" placeholder="Type here...">{!!@$getSubscribeData['0']['short_decription']!!}</textarea>
                                                                </div>
                                                                
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Package long description</label>
                                                                    <textarea class="form-control" name="long_description" id="long_description" placeholder="Type here...">{!!@$getSubscribeData['0']['package_log_description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@$getSubscribeData['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Table start-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Subscription Plans</h5>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-spinner-alt-5"></i>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="card-block">
                                                        <div class="myDatatable">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Package Name</th>
                                                                        <th>Package Amount ($)</th>
                                                                        <th>Package Duration (In Days)</th>
                                                                        <th>Package short Description</th>
                                                                        <th>Package Long Description</th>
                                                                        <th>Status</th> 
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($getSubscriber))
                                                                @foreach($getSubscriber as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['package_name']}}</td>
                                                                        <td>$ {{$list['package_amount']}}</td>
                                                                        <td> {{$list['package_duration']}}</td>
                                                                        <td>{{$list['short_decription']}}</td>
                                                                        <td>{{$list['package_log_description']}}</td>
                                                                        <td>@if($list['package_name_slug']=='trail-plan') @else
                                                                        <input type="checkbox" data-status="{{$list['id']}}"class="statusSwitch"@if($list['status']==1) checked @endif id="customSwitch{{$list['id']}}">
                                                                        @endif
                                                                        </td>
                                                                        <td class="d-flex">
                                                                            <a href="{{ URL('subscription-user-edit', $list['id']) }}" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                          @if($list['package_name_slug']=='trial-plan')
                                                                          @else
                                                                          <a href="{{ URL('subscruption-user-delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a>
                                                                          @endif
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
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->

@stop

@section('custom_script')

    <script>

        $(document).ready(function () { 

            jQuery.validator.addMethod("dollarsscents", function(value, element) {
                return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
            }, "You must include two decimal places");
       
                $('form#addSocialIconsForm1').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                     
                        duration: {
                            required: true,
                            number:true,
                            maxlength:3,
                        },
                        amount: {
                            required: true,
                            maxlength:8,
                            number:true,
                            dollarsscents: true,
                        },
                        sort_description: {
                            required: true,
                        },
                        long_description:{
                            required:true,
                        }
                
                    },
                    messages: {
                        name: {
                            required: 'This field is required',
                        },
                        duration: {
                            required: 'This field is required ',
                        },
                        amount: {
                            required: 'This field is required',
                        },
                       
                        sort_description: {
                            required: 'This field is required ',
                        },
                        long_description: {
                            required: 'This field is required ',
                        },

                    
                    },
                    
                });

               
            });


            $('.statusSwitch').on('change',function(){
                $.ajax({
                    type: 'POST',
                    url: "{{asset('status-subscription')}}",
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