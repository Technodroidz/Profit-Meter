@extends('business_app/common_template/main')

@section('content')

    <style>
        .inlineitem input[type="checkbox"] {
            width: auto;
            display: inline-block;
        }
        .inlineitem p, .inlineitem li label {
            display: inline-block;
        }
        .inlineitem li {
            display: inline-block;
        }
        .inlineitem h4 {
            display: inline-block;
        }
    </style>

    <div class="container-fluid p-0 ">
            <!-- page title  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page_title_left  mb_30">
                    <h3 class="mb-0" >Shipping Cost <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                           
                </div>
                <div class="white_box">
                       <!--  <div class="box_header ">
                           <div class="main-title">
                                <h3 class="mb-0" >Additional  Notifications</h3>
                            </div>
                        </div> -->
                    <div class="alert" role="alert">
                        <h4 class="">Options</h4>
                           <!--  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p> -->
                        <hr>
                        <div class="inlineitem">  <label class="lms_checkbox_1" for="course_1">
                            <input type="checkbox" id="course_1">
                            <div class="slider-check round"></div>
                            </label><p class="mb-0 "> Import cost from shipping labels purchased through shopify. </p>
                        </div>
                        <hr>
                        <div class="inlineitem">  <label class="lms_checkbox_1" for="course_2">
                            <input type="checkbox" id="course_2">
                            <div class="slider-check round"></div>
                            </label><p class="mb-0 "> Multiply the shipping fee by the quantity of products purchased.</p>
                        </div>
                        <hr>
                        <div class="inlineitem">  <label class="lms_checkbox_1" for="course_3">
                            <input type="checkbox" id="course_3">
                            <div class="slider-check round"></div>
                            </label><p class="mb-0 "> Fallback the country rule when no cost for product has been set.</p>
                        </div>
                        <hr>
                        <div class="inlineitem">  <input type="checkbox" aria-label="" >&nbsp; &nbsp;
                            <p class="mb-0 ">Add shipping fees together in orders with multiple items.</p>
                        </div>

                           
                        <div class="inlineitem">  <input type="checkbox" aria-label="" checked>&nbsp; &nbsp;
                            <p class="mb-0 ">Use the highest shipping fee only in orders with multiple items. </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="white_box" style="margin-top:30px; padding:5px">
                    <!--  <div class="box_header ">
                       <div class="main-title">
                            <h3 class="mb-0" >Additional  Notifications</h3>
                        </div>
                    </div> -->
                    <div class="alert" role="alert" >
                        <div class="inlineitem">
                            <h4 class="">Country Rules</h4><button class="country"><i class="far fa-dot-circle"></i> Add Country</button>
                        </div>
                        <!--  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p> -->
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="white_box" style="margin-top:30px; padding:5px">
                    <!--  <div class="box_header ">
                       <div class="main-title">
                            <h3 class="mb-0" >Additional  Notifications</h3>
                        </div>
                    </div> -->
                    <div class="alert" role="alert" >
                        <div class="inlineitem">
                            <h4 class="">Product Rules</h4> &nbsp; &nbsp;&nbsp; &nbsp;<li>
                            <input id="checkid" type="checkbox" value="test" />
                            <label style="word-wrap:break-word">Show Deleted Products</label></li>
                        </div>
                        <!--  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p> -->
                        <hr>
                        <table class="table lms_table_active3 dataTable no-footer dtr-inline" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info" style="width: 1140px;">
                            <thead>
                                <tr role="row">
                                    <th scope="col"  tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 46%;">Product Name</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" >Status</th><th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"  >Shipping Fee</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" >Country Rules</th>
                                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"  >Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>No Data</tr>
                                
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection