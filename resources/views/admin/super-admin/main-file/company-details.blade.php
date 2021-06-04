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
                                                        <h4>Company Details</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="{{asset('')}}"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('')}}"> Company Details</a>
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
                                                        <h5>Company Details</h5>
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
                                                    @if(session()->has('status'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('status') }}
                                                        </div>
                                                    @endif
                                                    <hr/>
                                                    
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-update-company')}}" method="POST" id="addCompanyForm" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">Company name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getComapanyDetail['0']['company_name']}}" placeholder="Enter comapany name..">
                                                                </div>
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">Company Email </label>
                                                                    <input type="text" class="form-control" name="email" id="email" value="{{@$getComapanyDetail['0']['email']}}" placeholder="Enter email..">
                                                                </div>
                                                                <div class="col-sm-4 col-xs-12 form-group">
                                                                    <label class="col-form-label">Campany Number</label>
                                                                    <input type="text" class="form-control" name="number" id="number"  value="{{@$getComapanyDetail['0']['number']}}" placeholder="Enter Company..">
                                                                </div>
                                                           
                                                                <div class="col-md-4 col-xs-12">
                                                                    <label class="col-form-label">Address</label>
                                                                    <textarea class="form-control" name="address" id="address" placeholder="Type here...">{!!@$getComapanyDetail['0']['address']!!}</textarea>
                                                                </div>
                                                                
                                                                <div class="col-md-4 col-xs-12">
                                                                    <label class="col-form-label">Logo</label>
                                                                    <input type="file" class="form-control"  name="logo" id="logo">
                                                                    <input type="hidden" class="form-control" name="logo_old" id="logo_old"  value="{{@$getComapanyDetail['0']['logo']}}" >
                                                                </div>
                                                                <div class="col-md-4 col-xs-12">
                                                                @if(!empty($getComapanyDetail['0']['logo']))
                                                                <img src="{{asset('images/'.$getComapanyDetail['0']['logo'])}}" class="img-circle" hight="120px" width="100px" alt="User Image">
                                                                @else
                                                                <img src="{{asset('')}}admin/dist/img/user2-160x160.jpg" class="img-circle " alt="User Image">
                                                                @endif
                                                                
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                 <input type="hidden" class="form-control" value="{{@$getComapanyDetail['0']['id']}}" name="table_id" id="table_id">
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
       
                $('form#addCompanyForm').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email:true,
                        },
                        number: {
                            required: true,
                            maxlength:10,
                            minlength:10,
                            number:true,
                        },
                        address: {
                            required: true,
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
                        address: {
                            required: 'This field is required ',
                        },
                       

                    
                    },
                    
                });

               
            });
    </script>
@endsection