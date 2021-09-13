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
                                                        <h4>Template</h4>
                                                        <a href="{{asset('templete')}}"><span>Back</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item" style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item" style="float: left;"><a href="{{asset('templete')}}">Template</a>
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
                                                        <h5>Template</h5>
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
                                                    @if(@$getdata['0']['id']==1)
                                                    <form action="{{asset('submit-templete')}}" method="POST" id="addTempleteForm" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Template Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getdata['0']['name']}}" placeholder="Enter  name">
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Subject</label>
                                                                    <textarea class="form-control" name="subject" id="subject" placeholder="Type here...">{!!@$getdata['0']['subject']!!}</textarea>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control editor" name="long_description" id="long_description" placeholder="Type here...">{!!@$getdata['0']['description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr/>
                                                           
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@@$getdata['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                        @if(@$getdata['0']['id']==2)
                                                    <form action="{{asset('submit-templete')}}" method="POST" id="addTempleteRegistationForm" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Template Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getdata['0']['name']}}" placeholder="Enter  name">
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Subject</label>
                                                                    <textarea class="form-control" name="subject" id="subject" placeholder="Type here...">{!!@$getdata['0']['subject']!!}</textarea>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control editor" name="long_description" id="long_description" placeholder="Type here...">{!!@$getdata['0']['description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr/>
                                                           
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@@$getdata['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                        @if(@$getdata['0']['id']==3)
                                                    <form action="{{asset('submit-templete')}}" method="POST" id="addTempleteFogotPassword" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Template Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getdata['0']['name']}}" placeholder="Enter  name">
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Subject</label>
                                                                    <textarea class="form-control" name="subject" id="subject" placeholder="Type here...">{!!@$getdata['0']['subject']!!}</textarea>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control editor" name="long_description" id="long_description" placeholder="Type here...">{!!@$getdata['0']['description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr/>
                                                           
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@@$getdata['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                        @if(@$getdata['0']['id']==4)
                                                    <form action="{{asset('submit-templete')}}" method="POST" id="addTempleteSubscriptionExpirey" enctype='multipart/form-data'>
                                                       @csrf
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12 form-group">
                                                                    <label class="col-form-label">Template Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="{{@$getdata['0']['name']}}" placeholder="Enter  name">
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Subject</label>
                                                                    <textarea class="form-control" name="subject" id="subject" placeholder="Type here...">{!!@$getdata['0']['subject']!!}</textarea>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12">
                                                                    <label class="col-form-label">Description</label>
                                                                    <textarea class="form-control editor" name="long_description" id="long_description" placeholder="Type here...">{!!@$getdata['0']['description']!!}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <hr/>
                                                           
                                                            <div class="form-group row">
                                                                <div class="col-md-12 text-right">
                                                               
                                                                 <input type="hidden" class="form-control" value="{{@@$getdata['0']['id']}}" name="table_id" id="table_id">
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
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

                $('form#addTempleteForm').validate({
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
    $("form#addTempleteForm").submit( function(e) {
        var messageLength = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
        var value = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '');
        var subscription_name = value.indexOf("{subscription_name}");
        var subscription_amount = value.indexOf("{subscription_amount}");
        var subscription_duration = value.indexOf("{subscription_duration}");
        var name = value.indexOf("{name}");
        // var subscription_name = value.indexOf("{subscription_name}");
        if(name == -1 ){
             var name_field="{name}";
         }else{
            var name_field=""; 
         }
        if(subscription_name == -1 ){
             var subscription_name_field="{subscription_name}";
         }else{
            var subscription_name_field=""; 
         }
         if(subscription_amount == -1){
             var subscription_amount_field="{subscription_amount}";
         }else{
            var subscription_amount_field=""; 
         }
         if(subscription_duration == -1){
             var subscription_duration_field="{subscription_duration}";
         }else{
            var subscription_duration_field=""; 
         }
        if(subscription_name != -1 && subscription_amount != -1  && subscription_duration != -1 && name != -1 ) {
            return true;
        } else {
            alert("Please insert "+subscription_name_field+''+name_field+''+subscription_amount_field+''+subscription_duration_field+" field .");
            e.preventDefault();
        }
        if(!messageLength ) {
            alert( 'Please enter a description' );
            e.preventDefault();
        }
    });
    $("form#addTempleteRegistationForm").submit( function(e) {
        var messageLength = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
        var value = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '');
        var name = value.indexOf("{first_name}");
        var last_name = value.indexOf("{last_name}");
        var email = value.indexOf("{email}");
        var number = value.indexOf("{mobile_number}");
        // var index = value.indexOf("{name}");
         if(name == -1 ){
             var nameField="{first_name}";
         }else{
            var nameField=""; 
         }
         if(email == -1){
             var emailField="{email}";
         }else{
            var emailField=""; 
         }
         if(number == -1){
             var numberField="{mobile_number}";
         }else{
            var numberField=""; 
         }
         if(last_name == -1){
             var lastNameField="{last_name}";
         }else{
            var lastNameField=""; 
         }
        if(name != -1 && email != -1 && number != -1 && last_name != -1 ) {
            return true;
        } else {
            alert("Please insert "+nameField+''+lastNameField+''+emailField+''+numberField+" field .");
            e.preventDefault();
            return false;
        }
        if(!messageLength ) {
            alert( 'Please enter a description' );
            e.preventDefault();
        }
    });
    $("form#addTempleteFogotPassword").submit( function(e) {
        var messageLength = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
        var value = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '');
        var email = value.indexOf("{email}");
        var link = value.indexOf("{link}");
        
        if(email == -1){
             var emailField="{email}";
         }else{
            var emailField=""; 
         }
        if(link == -1 ){
             var linkField="{link}";
         }else{
            var linkField=""; 
         }
        
        if(email != -1 && link != -1  ) {
            return true;
        } else {
            alert("Please insert "+emailField+''+linkField+" field .");
            e.preventDefault();
        }
        if(!messageLength ) {
            alert( 'Please enter a description' );
            e.preventDefault();
        }
    });

    $("form#addTempleteSubscriptionExpirey").submit( function(e) {
        var messageLength = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '').length;
        var value = CKEDITOR.instances['long_description'].getData().replace(/<[^>]*>/gi, '');
        var subscription_name = value.indexOf("{subscription_name}");
        var subscription_amount = value.indexOf("{subscription_amount}");
        var subscription_duration = value.indexOf("{subscription_duration}");
        var username = value.indexOf("{name}");
      
        if(subscription_name == -1 ){
             var subscription_name_field="{subscription_name}";
         }else{
            var subscription_name_field=""; 
         }
         if(username == -1 ){
             var user_name_field="{name}";
            
         }else{
            var user_name_field=""; 
         }
         if(subscription_amount == -1){
             var subscription_amount_field="{subscription_amount}";
         }else{
            var subscription_amount_field=""; 
         }
         if(subscription_duration == -1){
             var subscription_duration_field="{subscription_duration}";
         }else{
            var subscription_duration_field=""; 
         }
        if(subscription_name != -1 && subscription_amount != -1 && username !=-1 && subscription_duration != -1  ) {
            return true;
        } else {
            alert("Please insert "+subscription_name_field+''+user_name_field+''+subscription_amount_field+''+subscription_duration_field+" field .");
            e.preventDefault();
        }
        if(!messageLength ) {
            alert( 'Please enter a description' );
            e.preventDefault();
        }
    });
    </script>
@endsection