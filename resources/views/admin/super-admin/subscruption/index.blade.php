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
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">Subscription</a>
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
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getSubscribeData['0']['package_name']}}" placeholder="Enter package name">
                                                                </div>
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Package amount (In $) </label>
                                                                    <input type="text" class="form-control" name="amount" id="amount" value="{{@$getSubscribeData['0']['package_amount']}}" placeholder="Enter Amount" step="any">
                                                                </div>
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Package duration (In Months)</label>
                                                                    <input type="text" class="form-control" name="duration" id="duration" value="{{@$getSubscribeData['0']['pachage_duration']}}" placeholder="Enter package duration">
                                                                </div>
                                                                <!-- <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Status</label>
                                                                    <select class="currency-selector input-group-addon" name="status">
                                                                    <option value="" >Please Select One </option>
                                                                    <option value="1" <?php echo ('1'==@$getSubscribeData['0']['status'] ?'selected':''); ?>>Active</option>
                                                                    <option value="2" <?php echo ('2'==@$getSubscribeData['0']['status'] ?'selected':''); ?>>Deactivet</option>
                                                                    </select>
                                                                </div> -->
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Package sort description</label>
                                                                    <textarea class="form-control" name="sort_description" id="sort_description" placeholder="Type here...">{!!@$getSubscribeData['0']['pachage_duration']!!}</textarea>
                                                                </div>
                                                                
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Package long description</label>
                                                                    <textarea class="form-control" name="long_description" id="long_description" placeholder="Type here...">{!!@$getSubscribeData['0']['pachage_log_description']!!}</textarea>
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
                                                                        <th>Package Amount</th>
                                                                        <th>Package Duration</th>
                                                                        <th>Package Sort Description</th>
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
                                                                        <td>{{$list['package_amount']}}</td>
                                                                        <td>{{$list['pachage_duration']}}</td>
                                                                        <td>{{$list['short_decription']}}</td>
                                                                        <td>{{$list['pachage_log_description']}}</td>
                                                                        <td><?php echo ($list['short_decription']==1 ?'Active': 'Deactive') ?></td>
                                                                        <td class="d-flex">
                                                                      
                                                                      
                                                                            <a href="{{ URL('subscription-user-edit', $list['id']) }}" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                            <a href="{{ URL('subscruption-user-delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a>
                                                                            <!-- <a href="#definekeyword" class="btn btn-warning btn-sm data_edit" data-value="{{$list}}"><i class="fa fa-edit"></i></a>
                                                                            <a href="JavaScript:void(0);" class="delete-record btn btn-danger btn-sm" data-value="{{$list}}">
                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            </a> -->
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
       
                $('form#addSocialIconsForm1').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        amount: {
                            required: true,
                            maxlength:6,
                            number:true,
                        },
                        duration: {
                            required: true,
                            maxlength:3,
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
                        amount: {
                            required: 'This field is required',
                        },
                        duration: {
                            required: 'This field is required ',
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
    </script>
@endsection