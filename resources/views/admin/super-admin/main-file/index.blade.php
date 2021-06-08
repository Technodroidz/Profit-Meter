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
                                                        <h4>User Profile</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="{{asset('')}}"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">User Profile</a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">User Profile</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->

                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!--profile cover start-->
                                  
                                        <!--profile cover end-->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- tab header start -->
                                                <div class="tab-header card">
                                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#binfo" role="tab">Change Password</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- tab header end -->
                                                <!-- tab content start -->
                                                <div class="tab-content">
                                                    <!-- tab panel personal start -->
                                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                                        <!-- personal card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">About Me</h5>
                                                                <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                                    <i class="icofont icofont-edit"></i> Edit
                                                                </button>
                                                            </div>
                                                            @if(session()->has('status'))
                                                        <div class="alert alert-success hiddenError">
                                                            {{ session()->get('status') }}
                                                        </div>
                                                            @endif
                                                            @if(session()->has('message'))
                                                        <div class="alert alert-danger hiddenError">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                            @endif
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <form>
                                                                                                <table class="table m-0">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <th scope="row">
                                                                                                                First Name 
                                                                                                            </th>
                                                                                                            <td>{{@$getUserData['name']}}</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th scope="row">
                                                                                                                Last Name</th>
                                                                                                            <td>{{@$getUserData['last_name']}}</td>
                                                                                                        </tr>
                                                                                                   
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">
                                                                                                            Email</th>
                                                                                                        <td><a href="#!">{{@$getUserData['email']}}</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">
                                                                                                            Mobile
                                                                                                            Number</th>
                                                                                                        <td>{{@$getUserData['mobile_number']}}</td>
                                                                                                    </tr>
                                                                                                 
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                </div>
                                                                                <!-- end of row -->
                                                                            </div>
                                                                            <!-- end of general info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    <!-- end of row -->
                                                                </div>
                                                                <!-- end of view-info -->
                                                                <div class="edit-info">
                                                                @if ($errors->any())
                                                        <div class="alert alert-danger hiddenError">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                                <form action="{{asset('submit-profile')}}" method="POST" id="adduserForm" enctype='multipart/form-data'>
                                                       @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                                            <input type="text" class="form-control" name="name" value="{{@$getUserData['name']}}" placeholder="First Name">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <div class="input-group">
                                                                                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                                            <input type="text" class="form-control" name="last_name" value="{{@$getUserData['last_name']}}" placeholder="Last Name">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                       
                                                                                        
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                    <div class="col-lg-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                                            <input type="text" class="form-control" name="email" value="{{@$getUserData['email']}}" placeholder="Email ">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <div class="input-group">
                                                                                                            <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                                            <input type="text" class="form-control" name="mobile_number" value="{{@$getUserData['mobile_number']}}" placeholder="Mobile Number">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                    <div class="col-lg-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                                            <input type="file" class="form-control" name="owner_pic" value="">
                                                                                                            
                                                                                                        </div> 
                                                                                                    </td>
                                                                                                </tr>
                                                                                              
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                </div>
                                                                                <!-- end of row -->
                                                                                <div class="text-center">
                                                                                    <input type="hidden" name="id" value="{{@$getUserData['id']}}" >
                                                                                    <button class="btn btn-primary waves-effect waves-light m-r-20" type="submit">Save changes</button>
                                                                                    <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <!-- end of edit info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    </form>
                                                                    <!-- end of row -->
                                                                </div>
                                                                <!-- end of edit-info -->
                                                            </div>
                                                            <!-- end of card-block -->
                                                        </div>
                                                        <!-- personal card end-->
                                                    </div>
                                                    <!-- tab pane personal end -->
                                                    <!-- tab pane info start -->
                                                    <div class="tab-pane" id="binfo" role="tabpanel">
                                                        <!-- info card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Change Password</h5>
                                                            </div>
                                                            <div class="card-block">
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
                                                        <div class="alert alert-success hiddenError">
                                                            {{ session()->get('status') }}
                                                        </div>
                                                    @endif
                                                            <form action="{{asset('submit-password-update')}}" method="POST" id="passwordValidation" enctype='multipart/form-data'>
                                                       @csrf
                                                                    <div class="row">
                                                               
                                                                    <div class="col-md-6 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Current Password</label>
                                                                                <input type="password" class="form-control" name="current_password" value="" placeholder="">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-6 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>New Password</label>
                                                                                <input type="password" class="form-control" name="new_password" value="" placeholder="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Confirm Password</label>
                                                                                <input type="password" class="form-control" name="new_confirm_password" value="" placeholder="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-12">
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <div class="form-group" style="text-align:right;">
                                                                                        <label style="width:100%;">&nbsp;</label>
                                                                                        <input type="hidden" name="id" value="{{@$getUserData['id']}}" >
                                                                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label style="width:100%;">&nbsp;</label>
                                                                                        <a href="{{asset('profile')}}" class="btn btn-danger">Cancel</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- info card end -->
                                                    </div>
                                                    <!-- tab pane info end -->
                                                </div>
                                                <!-- tab content end -->
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

                $('form#passwordValidation').validate({
                    rules: {
                        current_password: {
                            required: true,
                        },
                      
                    
                        new_password: {
                            required: true,
                        },
                        new_confirm_password: {
                            required: true,
                        },
                    },
                    messages: {
                        current_password: {
                            required: 'This field is required',
                        },
                        new_password: {
                            required: 'This field is required',
                        },
                        new_confirm_password: {
                            required: 'This field is required',
                        },
                     
                    },
                    
                });

            });
    </script>
@endsection