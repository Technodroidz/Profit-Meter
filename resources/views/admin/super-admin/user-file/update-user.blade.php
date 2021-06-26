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
                                                        <h4>User Update</h4>
                                                        <a href="{{asset('user-list')}}">Back</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('user-list')}}">User Update</a>
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
                                                        <h5>User Update</h5>
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
                                                    <form action="{{asset('submit-user-update')}}" method="POST" id="userFormValidation" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">First Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getdata['0']['name']}}" placeholder="Name">
                                                                </div>
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">Last Name</label>
                                                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{@$getdata['0']['last_name']}}" placeholder="Last Name">
                                                                </div>
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">Password</label>
                                                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password">
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Contact Number</label>
                                                                    <input type="text" class="form-control" name="number" id="number" value="{{@$getdata['0']['number']}}" placeholder="Contact Number">
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Email</label>
                                                                    <input type="text" class="form-control" name="email" id="email" value="{{@$getdata['0']['email']}}" placeholder="Email" readonly>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Shopify store url</label>
                                                                    <textarea class="form-control" name="shofiy_store_url" id="shofiy_store_url" placeholder="Shopify store url">{!!@$getdata['0']['shopify_url']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                 <input type="hidden" class="form-control" value="{{@$getdata['0']['id']}}" name="id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Table start-->
                                        
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
                $('form#userFormValidation').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                      
                        number: {
                            required: true,
                            maxlength:16,
                            minlength:7,
                            number:true,
                        },
                        last_name: {
                            required: true,
                        },
                       
                       
                        shofiy_store_url:{
                            required: true,
                        },
                        password: {
                            required: false,
                            minlength:6,
                           
                        },
                      
                
                    },
                    messages: {
                        name: {
                            required: 'This field is required',
                        },
                        email: {
                            required: 'This field is required',
                        },
                        number: {
                            required: 'This field is required ',
                        },
                        last_name: {
                            required: 'This field is required ',
                        },
                       
                        shofiy_store_url: {
                            required: 'This field is required ',
                        },
                        password: {
                            required: 'Minimum six characters is required ',
                        },
                    
                    },
                    
                });

               
            });
    </script>
@endsection