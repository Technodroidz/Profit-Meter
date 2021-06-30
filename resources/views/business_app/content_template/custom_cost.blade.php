@extends('business_app/common_template/main')

@section('content')
    <style type="text/css">
        .modal-backdrop {
          z-index: -1;
        }
    </style>

    <div class="container-fluid p-0 ">
            
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Custom Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                </div>
            </div>
           
            <div class="col-md-8"><p>0 total Custom costs</p></div>
            <div class="col-md-6">
            <input type="text" class="search form-control" name="" placeholder="Search by product name, SKU, Variant" /></div>
            <div class="col-md-3">
                <label>Show 
                    <select name="example_length" aria-controls="example" class="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select> entries
                </label>
            </div>
            <div class="col-md-3">
               <div class="view_btns">
                        
                    <button  class="mr_5 mb_10  small_blue_btn active" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Custom Cost</button>
                    <button  class="mr_5 mb_10  small_blue_btn active" data-toggle="modal" data-target="#confirm-mail"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Confirm Email</button>
                   
                    <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a>  -->
                    <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                    <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
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
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Frequency</th>
                                            <th scope="col">Included in Marketing</th>
                                            <th scope="col">Cost</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">New Custom Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                           
                    <label>Frequency</label>
                    <select class="custom-select mb-3" id="inputGroupSelect01">
                        <option selected="">One Time</option>
                        <option value="1">One Time</option>
                        <option value="2">Daily</option>
                          <option value="3">Weekly</option>
                            <option value="4">Monthly</option>
                        <option value="5">Yearly</option>
                    </select>
                        

                    <label for="basic-url">Cost</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    <label for="basic-url">Date</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    <div class="inlineitem">  <input type="checkbox" aria-label="">&nbsp; &nbsp;
                        <p class="mb-0 ">Include in marketing & CAC</p>
                    </div>
                    <p>Check to Include cost in marketing & CAC</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" >Add & Continue</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Add & Close</button>
                </div>
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
@endsection