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
                                                        <h4>Page List</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                      
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('')}}">Page</a>
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
                                                    @if(session()->has('message'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                    @endif
                                                    <div class="card-block">
                                                        <div class="myDatatable">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Title</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($getTempleteData))
                                                                @foreach($getTempleteData as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['title']}}</td>
                                                                        <td class="d-flex">
                                                                            <!-- <a href="javascript:void(0)" id="showTemlete{{$list['id']}}" class="greenBtn"><i class="fa fa-edit"></i></a> -->
                                                                            <a href="{{ URL('edit-page', $list['id']) }}" id="" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                        {{--    <a href="{{ URL('delete-templete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a> --}}
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
  


@stop

@section('custom_script')

    <script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{asset('admin/tinymce/tinymce.min.js')}}"></script>
    <script>
 $('.statusSwitch').on('change',function(){
    
                $.ajax({
                    type: 'POST',
                    url: '{{asset('change-status-page')}}', // window.location.origin + '/change-user-assn-project-status',
                    data: {
                        '_token':"{{ csrf_token() }}",
                        'id': $(this).data('id'),
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