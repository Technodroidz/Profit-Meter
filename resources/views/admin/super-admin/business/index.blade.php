@extends('admin.super-admin.layouts.common')
@section('content')

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Business</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('')}}">Business</a>
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
                                                        <h5>Business Users </h5>
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
                                                        <div class="alert alert-success hiddenError">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                    @endif
                                                    <hr/>
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-business')}}" method="POST" id="adduserForm" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-6 col-xs-12 form-group">
                                                                    <label class="col-form-label">User name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getBussinessData['0']['user_name']}}" placeholder="Enter  name">
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12 form-group">
                                                                    <label class="col-form-label">Join Date</label>
                                                                    <input type="date" class="form-control" name="join_date" id="join_date" value="{{@$getBussinessData['0']['join_data']}}" placeholder="Enter Join Date">
                                                                </div>
                                                                <div class="col-sm-6 col-xs-12 form-group">
                                                                    <label class="col-form-label">Pnone Number</label>
                                                                    <input type="text" class="form-control" name="number" id="number" value="{{@$getBussinessData['0']['phone_number']}}" placeholder="Enter Phone Number">
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label class="col-form-label">Email Address</label>
                                                                    <input type="text" class="form-control" name="email" id="email" value="{{@$getBussinessData['0']['email']}}" placeholder="Enter Email">
                                                                </div>
                                                             
                                                            </div>
                                                            <hr/>
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                <input type="hidden" class="form-control" name="upd_image" id="upd_image">
                                                                 <input type="hidden" class="form-control" value="{{@$getBussinessData['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Business Users</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">Business Users</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!--Table start-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Business Users</h5>
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
                                                                        <th>User Name</th>
                                                                        <th>Joining date</th>
                                                                        <th>Phone No.</th>
                                                                        <th>Email Address</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                           
                                                              @if(!empty($getBussiness))
                                                              @foreach($getBussiness  as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['user_name']}}</td>
                                                                        <td>{{$list['join_data']}}</td>
                                                                        <td>{{$list['phone_number']}}</td>
                                                                        <td>{{$list['email']}}</td>
                                                                        <td class="d-flex">
                                                                            <a href="{{ URL('bussiness-user-edit', $list['id']) }}" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                            <a href="{{asset('business')}}" class="greenBtn"><i class="fa fa-eye"></i></a>
                                                                            <a href="{{ URL('busssiness-user-delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['user_name']}} ?');"><i class="fa fa-trash"></i></a>
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

@stop

@section('custom_script')

    <script>

        $(document).ready(function () { 
       
                $('form#adduserForm').validate({
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
                        last_name: {
                            required: true,
                        },
                        bussiness_name:{

                            required: true,
                        }
                      
                
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
                        bussiness_name: {
                            required: 'This field is required ',
                        },
                       

                    
                    },
                    
                });

               
            });
    </script>
@endsection