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
                        <h4>Paypal Dispute List for Account </h4>
                        <h3>{{$paypal_account->email}}</h3>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                    <tr>
                                        <th scope="col">Dispute ID</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Dispute State</th>
                                        <th scope="col">Dispute Amount Currency</th>
                                        <th scope="col">Dispute Amount Value</th>
                                        <th scope="col">Dispute Life Cycle Stage</th>
                                        <th scope="col">Created At</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disputes as $value)

                                    <tr>
                                        <td>
                                            <div class="trade d-flex align-items-center">
                                               
                                                <span class="ml-3">{{$value['dispute_id']}}</span>
                                            </div>
                                        </td>
                                        <td> {{$value['reason']}} </td>
                                        <td> {{$value['dispute_status']}} </td>
                                        <td> {{$value['dispute_state']}} </td>
                                        <td> {{$value['dispute_amount_currency_code']}} </td>
                                        <td> {{$value['dispute_amount_value']}}</td>
                                        <td> {{$value['dispute_life_cycle_stage']}}</td>
                                        <td> {{$value['create_time']}}</td>
                                        
                                    </tr>

                                    @endforeach
                                   
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