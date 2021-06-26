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
                                                        <h4>Email Template</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('templete')}}">Email Template</a>
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
                                                                        <th>Name</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($getTempleteData))
                                                                @foreach($getTempleteData as $key=>$list)
                                                                    <tr>
                                                                        <td>{{++$key}}</td>
                                                                        <td>{{$list['name']}}</td>
                                                                        <td class="d-flex">
                                                                            <a href="{{ URL('edit-templete', $list['id']) }}" id="" class="greenBtn"><i class="fa fa-edit"></i></a>
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

 
@endsection