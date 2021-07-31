@extends('business_app/common_template/main')

@section('content')

    <style>
        #reportrange{margin-top:0px!important;}
        img.tableImg {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 10px;
        }
    </style>

<div class="container-fluid p-0 ">
            <!-- page title  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="white_box_tittle list_header mb-0">
                        <h4>Google Ads Campaign List for Customer - {{$customer_id}}</h4>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                    <tr>
                                        <th scope="col">Campaign ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Resource Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Clicks</th>
                                        <th scope="col">Cost Micros</th>
                                        <th scope="col">Impressions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campaign_list as $value)

                                    <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3"> {{$value['campaign']['id']}} </span>
                                            </div>
                                        </td>
                                        <td> {{$value['campaign']['name']}} </td>
                                        <td> {{$value['campaign']['resourceName']}} </td>
                                        <td> {{$value['campaign']['status']}} </td>
                                        <td> {{$value['metrics']['clicks']}} </td>
                                        <td> {{$value['metrics']['costMicros']}} </td>
                                        <td> {{$value['metrics']['impressions']}} </td>
                                        
                                    </tr>

                                    @endforeach
                                    <!-- <tr>
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
    @section('script')


    <script>
        $(function() {
         
            var start = moment().subtract(29, 'days');
            var end = moment();
         
            function cb(start, end) {
                $('#reportrange span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            }
         
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
         
            cb(start, end);
             
        });
    </script>
    @endsection
@endsection