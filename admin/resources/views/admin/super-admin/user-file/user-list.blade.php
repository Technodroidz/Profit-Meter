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
                                                    <hr/>
                                                    <div class="card-block">
                                                        <div class="myDatatable">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>First name</th>
                                                                        <th>Last name</th>
                                                                        <th>Business name</th>
                                                                        <th>Email</th>
                                                                        <th>Contact no.</th>
                                                                        <th>Shopify store URL</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($getdata))
                                                                @foreach($getdata as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['name']}}</td>'
                                                                        <td>{{$list['last_name']}}</td>'
                                                                        <td>{{$list['bussiness_name']}}</td>
                                                                        <td>{{$list['email']}}</td>
                                                                        <td>{{$list['number']}}</td>
                                                                        <td>{{$list['shofiy_store_url']}}</td>
                                                                     
                                                                        <td class="d-flex">
                                                                      
                                                                      
                                                                            <a href="{{ URL('user-update', $list['id']) }}" class="greenBtn"><i class="fa fa-edit"></i></a>
                                                                            <a href="{{ URL('user-delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete {{$list['package_name']}} ?');"><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{asset('admin/tinymce/tinymce.min.js')}}"></script>

    <script>
    
             $(".data_edit").on('click',function(){

                var image_path = "{{asset('images/')}}/";
                $('#title').val($(this).data('value').title);
                $('#sub_title').val($(this).data('value').sub_title);
                //tinyMCE.activeEditor.setContent($(this).data('value').description);
                //tinyMCE.activeEditor.setContent($(this).data('value').description_long);
                tinymce.get("description").setContent($(this).data('value').description);
                tinymce.get("description_long").setContent($(this).data('value').description_long);
                $('#table_id').val($(this).data('value').id);
                // $("#image_img").attr("src",image_path+$(this).data('value').image).trigger("change");
                $("#image_img").attr("src","https://ik.imagekit.io/aidhmwk1rm7/"+$(this).data('value').image+"?tr=w-300,h-220").trigger("change");
                $('#image_bk').val($(this).data('value').image); 
                $('#language_id').val($(this).data('value').language_id.language_code);
            });

            $('form#addForm').validate({
                console.log("dilip");
                return false;
                rules: {
                    name:{
                        required: true,
                    },
                    amount:{
                        required: true,
                    },
                    duration: {
                        required: false,
                    },
                    sort_description:{
                        required: true,
                    },
                    long_description:{
                        required: true,
                    },
                   
                messages: {
                    name:{
                        required: ' Name is required',
                    },
                    amount:{
                        required: 'Amount is required',
                    },
                    duration: {
                        required: 'Duration is required',
                    },
                    sort_description:{
                        required: 'Short Description is required',
                    },
                    long_description:{
                        required: 'Long Description is required',
                    },
                   
                },
                submitHandler: function (form) {
                    return true;
                }
            });
        });

            $(document).on('click', '.delete-record',function(){
                row = $(this).parent('td').parent('tr');
                $('#footer_action_button').text("Delete");
                $('#footer_action_button').removeClass('glyphicon-check');
                $('#footer_action_button').addClass('glyphicon-trash');
                $('.actionBtn').removeClass('btn-success');
                $('.actionBtn').addClass('btn-danger');
                $('.actionBtn').addClass('delete_user_assign');
                $('.modal-title').text('Delete ?');
                $('.modal-footer').find('input[name=deleteId]').val($(this).data('value').id);
                $('.deleteContent').show();
                $('.form-horizontal').hide();
                $('.title').html($(this).data('value').title);
                $('#myModal').modal('show');
            });

            $('.modal-footer').on('click', '.delete_user_assign',function(){
                let deleteId = $('input[name=deleteId]').val(); 
                $.ajax({
                    type: 'POST',
                    url: "{{asset('admin-panel/delete-about-us-pages')}}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': deleteId
                    },
                    success: function (data) {
                        window.swal({
                            title: "Record deleted successfully...",                        
                            timer: 1000,
                            className: "messagedivcontainer",
                            button:false,
                            icon: 'success',
                        });
                        setTimeout(function(){
                            location.reload();
                        },500); 
                    }
                });
            });

            $('.statusSwitch').on('change',function(){
                $.ajax({
                    type: 'POST',
                    url: '{{asset('admin-panel/status-about-us-pages')}}', // window.location.origin + '/change-user-assn-project-status',
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