@extends('business_app/common_template/main')

@section('content')
    <style>
        i.fa.fa-search {
            position: absolute;
            top: 10px;
            left: 30px;
            font-size: 18px;
            color: #6c757d;
        }
        .search {
            width: 100%;
            padding-left: 50px;
            height:38px;
        }
        select {
            word-wrap: normal;
            height: 38px;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
    </style>

    <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="mb-0" >Product Costs <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-8"><p>0 total products</p>
                </div>
                <div class="col-md-4"><p style="float: right;"> <a href="#">Download an example CSV file</a></p>
                </div>
                <div class="col-md-6"> <i class="fa fa-search"></i>
                    <input type="text" class="search form-control" name="" placeholder="Search by product name, SKU, Variant" />
                </div>
                <div class="col-md-3"><label>Show 
                    <select name="example_length" aria-controls="example" class="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select> entries</label>
                </div>
                <div class="col-md-3">
                   <div class="view_btns">
                            
                        <a href="#" class="mr_5 mb_10  small_blue_btn active">Export to CSV</a>
                        <a href="#" class="mr_5 mb_10  small_blue_btn">CSV Import</a>
                        <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">Monthly</a>  -->
                        <!--  <a href="#" class="mr_5 mb_10  small_blue_btn">1Y</a>
                            <a href="#" class="mr_5 mb_10  small_blue_btn">YTD</a> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header" style="box-shadow:none;">
                           <span class="profile_info" id="myDropBtn">
                            <button class="addFilter">+ Add Filter</button><div class="profile_info_iner" id="filters">
                            <div class="profile_author_name">
                                <p>Products</p>
                            </div>
                                    <div class="profile_info_details">
                                        <form>
                                            <div class="form-group">
                                                <label>Product (first order)</label>
                                                <input type="text" class="form-control" name="" id="" placeholder="All Products">
                                            </div>
                                            <div class="form-group">
                                                <label>SKU (first order)</label>
                                                <input type="text" class="form-control" name="" id="" placeholder="All SKUs">
                                            </div>
                                            <div class="form-group">
                                                <label>Product types (first order)</label>
                                                <input type="text" class="form-control" name="" id="" placeholder="All Product types">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </span>
                        </div>

                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="QA_table mb_30">
                                   
                                    <!-- table-responsive -->
                                    <table class="table lms_table_active3 ">
                                        <thead>
                                            
                                            <tr style="background: #f2f2f2;">
                                                <th scope="col">Title</th>
                                                <th scope="col">Variant</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Product Cost</th>
                                                <th scope="col">Shipping Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $value)
                                                @foreach ($value['variants'] as $val)
                                                    <tr>
                                                       <td>{{$val['id']}}</td>
                                                       <td>{{$value['title'].' '.$val['title']}}</td>
                                                       <td>{{$val['sku']}}</td>
                                                       <td>{{$val['price']}}</td>
                                                       <td>{{$val['price']}}</td>
                                                       <td>45</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                            <!-- <tr>
                                               <td>This is product title</td>
                                               <td>2541</td>
                                               <td>568520</td>
                                               <td>2500</td>
                                               <td>25</td>
                                               <td>45</td>
                                            </tr>
                                            <tr>
                                               <td>This is product title</td>
                                               <td>2541</td>
                                               <td>568520</td>
                                               <td>2500</td>
                                               <td>25</td>
                                               <td>45</td>
                                            </tr>
                                            <tr>
                                               <td>This is product title</td>
                                               <td>2541</td>
                                               <td>568520</td>
                                               <td>2500</td>
                                               <td>25</td>
                                               <td>45</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection