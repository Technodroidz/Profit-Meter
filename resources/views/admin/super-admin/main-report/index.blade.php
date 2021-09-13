@extends('admin.super-admin.layouts.common')
@section('content')
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                           
                          <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Report</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">Report</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                  
                                                    <hr/>
                                                    <div class="card-block">
                                                        <div class="myDatatable">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Contact</th>
                                                                        <th>Package Name</th>
                                                                        <th>Package Amount</th>
                                                                        <th>Package Duration</th>
                                                                        <th>Created  Date</th>
                                                                        <th>Expriry Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($getReportData))
                                                                @foreach($getReportData as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['first_name']}} {{$list['last_name']}}</td>
                                                                        <td>{{$list['email']}}</td>
                                                                        <td>{{$list['contact']}}</td>
                                                                        <td>{{$list['plan_name']}}</td>
                                                                        <td>${{number_format ($list['plan_amount'],2)}}</td>
                                                                        <td>{{$list['plan_duration']}} Days</td>
                                                                        <td>{{$list['creation_date']}}</td>
                                                                        <td>{{$list['expiry_date']}}</td>
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