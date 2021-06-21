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
                                                        <h4>Page</h4>
                                                        <a href="{{asset('view_pages')}}"><span>Back</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('view_pages')}}">Page</a>
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
                                                        <h5>Page</h5>
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
                                                        <div class="alert alert-success">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                    @endif
                                                    <hr/>
                                                  
                                                    <div class="card-block">
                                                   
                                                    <form action="{{asset('submit-page')}}" method="POST" id="addPageForm" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Title</label>
                                                                    <input type="text" class="form-control" name="title" id="title" value="{{@$getdata['0']['title']}}" placeholder="Enter  title" readonly>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control editor" name="long_description" id="long_description" placeholder="Type here...">{!!@$getdata['0']['long_description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr/>
                                                           
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@$getdata['0']['id']}}" name="table_id" id="table_id">
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

<script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>

    <script>

        $(document).ready(function () { 

            CKEDITOR.replace('long_description' );

                $('form#addPageForm').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: 'This field is required',
                        },
                    },
                    
                });

            });
            
  
        var Ckeditor = function () {
        // Private functions
        var demos = function () {
            ClassicEditor
                .create( document.querySelector( '#long_description' ) )
                .then( editor => {
                } )
                .catch( error => {
                } );
        }
    
        return {
            init: function() {
                demos();
            }
        };
    }();
    
    // Initialization
    jQuery(document).ready(function() {
        Ckeditor.init();
    });

    CKEDITOR.replace( 'long_description' );
    $("form#addPageForm").submit( function(e) {
        var messageLength = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!messageLength ) {
            alert( 'Please enter a description' );
            e.preventDefault();
        }
    });
    
    </script>
@endsection