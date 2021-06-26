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
                                                        <h4>Email Settings</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="#!">Email Settings</a>
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
                                                        <h5>Email Settings</h5>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-spinner-alt-5"></i>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="card-block">
                                                    <form action="{{asset('submit-email-configration')}}" method="POST" id="emailValidation" enctype='multipart/form-data'>
                                                       @csrf
                                                            @foreach ($getemail as $settingValue)
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}</label>
                                                                    @if($settingValue->option_name !='email_encryption_type')
                                                                    <div class="col-sm-10">
                                                                        <input type="{{ $settingValue->input_type }}" class="form-control" name="{{ $settingValue->option_name }}"  placholder="{{ strtoupper(str_replace('_', ' ', $settingValue->option_name)) }}"  value="{{ @$settingValue->option_value }}">
                                                                    </div>
                                                                    @else
                                                               <div class="col-sm-10">
                                                                <select class="currency-selector input-group-addon" name="{{$settingValue->option_name }}">
                                                                <option value="1" >NONE</option>
                                                                  <option value="TLS" <?php echo ('TLS'==@$settingValue->option_value  ?'selected':''); ?>>TLS</option>
                                                                  <option value="SMTP" <?php echo ('SMTP'==@$settingValue->option_value  ?'selected':''); ?>>SMTP</option>
                                                                </select>
                                                                </div>
                                                                    @endif
                                                                </div>
                                                             
                                                            @endforeach
                                                    
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Host Name </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="host_name" placeholder="smtp.gmail.com" value="{{@$getemail['0']['host_name']}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">User</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" Placeholder="User Email" name="email_user" value="{{@$getemail['0']['email_user']}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Password</label>
                                                                <div class="col-sm-10">
                                                                    <input type="password" class="form-control" Placeholder="Password" name="password" value="{{@$getemail['0']['password']}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Port</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" Placeholder="465" name="port_number" value="{{@$getemail['0']['port_number']}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Mail Encription Type {{$getemail['0']['mail_encription_type']}}</label>
                                                                <div class="col-sm-10">
                                                                <select class="currency-selector input-group-addon" name="mail_encription_type">
                                                                  <option value="TLS" <?php echo ('TLS'==$getemail['0']['mail_encription_type'] ?'selected':''); ?>>TLS</option>
                                                                  <option value="SMTP" <?php echo ('SMTP'==$getemail['0']['mail_encription_type'] ?'selected':''); ?>>SMTP</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <hr/> -->
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                                <!-- <input type="hidden" class="form-control" name="id" value="{{@$getemail['0']['id']}}"> -->
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
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
                $('form#emailValidation').validate({
                    rules: {
                        host_name: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        email_user: {
                            required: true,
                            email:true,
                        },
                        port_number: {
                            required: true,
                        },
                    },
                    messages: {
                        host_name: {
                            required: 'This field is required',
                        },
                        password: {
                            required: 'This field is required',
                        },
                        email_user: {
                            required: 'This field is required',
                        },
                        port_number: {
                            required: 'This field is required',
                        },
                     
                    },
                    
                });


     
            });
    </script>
@endsection