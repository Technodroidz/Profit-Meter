@extends('admin.super-admin.layouts.common')
@section('content')
<div class="pcoded-content">
                        <div class="pcoded-inner-content">
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
                                                        <h5>User List</h5>
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
                                                    @if(session()->has('success'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('success') }}
                                                        </div>
                                                    @endif
                                                    <hr/>
                                                    <div class="card-block">
                                                        <div class="myDatatable">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Contact no.</th>
                                                                        <th>Shopify store URL</th>
                                                                        <th>Subscription Status</th>
                                                                        <th>Subscription Date</th>
                                                                        <th>Status </th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                              
                                                                @if(!empty($getdata))
                                                                @foreach($getdata as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        
                                                                        <td>{{$list['name'].' '.$list['last_name']}}</td>
                                                                     {{--   <td>{{$list['bussiness_name']}}</td>--}}
                                                                        <td>{{$list['email']}}</td>
                                                                        <td>{{$list['number']}}</td>
                                                                        <td>{{$list['shopify_url']}}</td>
                                                                        <td>{{$list['subscription_status'].' ('.$list['plan_name'].')'}}</td>
                                                                        <td>{{$list['subscription_date']}}</td>
                                                                        <td><input type="checkbox" data-status="{{$list['id']}}"class="statusSwitchUser"@if($list['status']==1) checked @endif id="statusSwitchUser{{$list['id']}}"></td>
                                                                        <td class="d-flex">
                                                                      
                                                                      
                                                                            <a href="{{ URL('user-update', $list['id']) }}" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                            <a href="{{ URL('user-delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a>
                                          
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

            $('.statusSwitchUser').on('change',function(){
                
                $.ajax({
                    type: 'POST',
                    url: "{{asset('status-user-change')}}",
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
                       
                    }
                });
            });
    </script>
@endsection