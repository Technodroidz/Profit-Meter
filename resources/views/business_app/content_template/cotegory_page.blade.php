@extends('business_app/common_template/main')

@section('content')

    <div class="container-fluid p-0 ">
            
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Category List<a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
            </div>
           
           
            <div class="col-md-6">
            <input type="text" class="search form-control" name="" placeholder="" /></div>
            
            <div class="col-md-3">
               <div class="view_btns">
                        
                    <button  class="mr_5 mb_10  small_blue_btn active" data-toggle="modal" data-target=".exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Category</button>
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                               
                                <!-- table-responsive -->
                                <table class="table lms_table_active3 ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($getCategorylist))
                                        @foreach($getCategorylist as $key=>$list)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$list['category_name']}} </td>
                                                <td>
                                                <input type="checkbox" data-status="{{$list['id']}}" class="statusSwitch" @if($list['status']==1) checked @endif id="customSwitch{{$list['id']}}">
                                                </td>
                                                <td>
                                                <a href="#" class="greenBtn data_edit" data-value="{{json_encode($list)}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{ URL('business/category/delete', $list['id']) }}" data-toggle='confirmation' id='deleteadd' data-placement='left' class="redBtn" onclick="return confirm('Are you sure you want to Delete  ?');"><i class="fa fa-trash"></i></a>
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
    </div>

        

    <div class="modal fade exampleModalCenter" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="formMaster" action="{{route('business_category_submit')}}" method="POST" enctype='multipart/form-data'>
                @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="hidden"  name="id" id="id" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" >Add & Continue</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add & Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <div id="confirm-mail" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="login-card card-block login-card-modal">
                <form class="md-float-material">
                    <div class="text-center">
                        <img src="img\logo.png" alt="logo.png">
                    </div>
                    <div class="card m-t-15">
                        <div class="auth-box card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12 confirm">
                                    <h3 class="text-center txt-primary"><i class="icofont icofont-check-circled text-primary"></i>
                                        Confirmation</h3>
                                </div>
                            </div>
                            <p class="text-inverse text-left m-t-15 f-16"><b>Dear Username</p>
                            <p class="text-inverse text-left m-b-0">Welcome to our website. Really Exciting to have you here!</p>
                            <p class="text-inverse text-left m-b-20">Please click the link below to verify that this is your email address.
                            </p>
                            <p class="text-inverse text-left m-b-30">Thank you and enjoy our website.</p>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
        </div>
    </div>
    <style>
    .modal-backdrop{
        position: unset;
    }
    </style>
@endsection

@section('script')
    <script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script>

        $(function () {
            $('.select2').select2()
        });

        $(".data_edit").on('click',function(){
          
            $('#name').val($(this).data('value').category_name);
            $('#id').val($(this).data('value').id);
            $('.exampleModalCenter').modal('show')
        });

        $('form#formMaster').validate({
            rules: {
                name:{
                    required: true,
                },
                price: {
                    required: true,
                },
                backstyle_id:{
                    required: true,
                },
                image:{
                    required: false,
                },
            },
            messages: {
                name:{
                    required: 'Name is required',
                },
                price: {
                    required: 'Price is required',
                },
                backstyle_id:{
                    required: 'Lining Id is required',
                },
                image:{
                    required: 'Image is required',
                },
            },
            submitHandler: function (form) {
                return true;
            }
        });

        $('.statusSwitch').on('change',function(){
                $.ajax({
                    type: 'POST',
                    url: "{{asset('business/category/status')}}",
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