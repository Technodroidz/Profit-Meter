@extends('business_app/common_template/main')

@section('content')

<div class="container-fluid p-0 ">
            <!-- page title  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="white_box_tittle list_header mb-0">
                        <h4>Products</h4>
                       <!--  <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ml-10">
                                <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1">Add New</a>
                            </div>
                        </div> -->
                        <div class="view_btns">
                            <a href="#" class="mr_5 mb_10  small_blue_btn">Days</a>
                            <a href="#" class="mr_5 mb_10  small_blue_btn active">Weeks</a>
                            <a href="#" class="mr_5 mb_10  small_blue_btn">Months</a>
                            <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
                          
                        </div>
                    </div>
                    <button style="float: right; background:#00FF7F; border:none; color:#fff; padding:10px;">Add Filter</button>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity Sold</th>
                                        <th scope="col">Revenue</th>
                                        <th scope="col">Profit</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">55612</span>
                                            </div>
                                        </td>
                                        <td>
                                            Bathing Shampoo</td>
                                        <td>451</td>
                                        <td>5654</td>
                                        <td>5624</td>
                                        
                                    </tr>
                                   
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