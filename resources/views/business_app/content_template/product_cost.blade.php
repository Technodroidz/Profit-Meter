@extends('business_app/common_template/main')

@section('content')
<div class="container-fluid p-0 ">
    <!-- page title  -->

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="mb-0" >Product Costs <a href="#" class="white_btn mb_10">Learn</a></h3>
                   
                </div>
                 <p style="float:right"> <a href="#">Download an example CSV file</a></p>


                

            </div>

        </div>
       
        <div class="col-md-8"><p>0 Orders total</p>
       <input type="text" class="search" name="" value="Search by product name, SKU, Variant" /></div>
       <div class="col-md-4">
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
                

                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                           
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                    
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Variant</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Shopify Cost</th>
                                        <th scope="col">Lifetimely Product Cost</th>
                                        <th scope="col">Lifetimely Shipping Cost</th>
                                        
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
@endsection