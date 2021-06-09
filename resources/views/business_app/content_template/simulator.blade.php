@extends('business_app/common_template/main')

@section('content')

    <style>
        @media (min-width:1000px) and (max-width:1600px){
            .anlite_table .col-sm-6{
                flex: 0 0 50%!important;
                max-width: 50%!important;
            }
        }
        .number{width:70%;}
        .box_header{align-items:flex-start;}
        a.btnDay {
            background: #ffffff;
            display: inline-block;
            margin-left: 10px;
            padding: 6px 16px;
            border-radius: 6px;
            color:#000000;
            box-shadow: 0px 0px 10px -1px rgb(0 0 0 / 20%);
        }
        a.btnDay.active{
            background:#486dcf;
            color:#ffffff;
        }
    </style>

    <div class="container-fluid p-0 ">
        <!-- page title  -->
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="mb-0" >Simulator <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                    </div>
                    <div class="data_switch">
                        <a href="javascript:void(0);" class="btnDay active">Daily</a>
                        <a href="javascript:void(0);" class="btnDay">Weekly</a>
                        <a href="javascript:void(0);" class="btnDay">Monthly</a>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12">
                <div class="mb_30">
                    <div class="white_card_body anlite_table p-0">
                        <div class="row">

                            <div class="col-12 col-sm-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="main-title mb_10">
                                                        <h3 class="m-0">AOV</h3>
                                                    </div>
                                                <div class="box_header m-0 flex-wrap">
                                                    
                                                    <div class="">
                                                        <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                        <p style="color:#000000;"><strong>Next Day</strong></p>
                                                    </div>
                                                    <div class="number">
                                                        <h3 class="card-subtitle mb-2" id="valueReflact">$ <span id="Rf">00</span></h3>
                                                        <input type="number" id="custNumber" class="form-control" step="0.5" min="0" value="">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="main-title mb_10">
                                                        <h3 class="m-0">Conversion Rate</h3>
                                                    </div>
                                                <div class="box_header m-0 flex-wrap">
                                                    
                                                    <div class="">
                                                        <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                        <p style="color:#000000;"><strong>Next Day</strong></p>
                                                    </div>
                                                    <div class="number">
                                                        <h3 class="card-subtitle mb-2" id="valueReflact1"><span id="Rf1">00</span> %</h3>
                                                        <input type="number" id="custNumber1" class="form-control" step="0.25" minlength="0" maxlength="100" value="">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                        <div class="card">
                                             <div class="card-body">
                                                 <div class="main-title mb_10">
                                                        <h3 class="m-0">Ad Spend</h3>
                                                    </div>
                                                 <div class="box_header m-0 flex-wrap">
                                                    
                                                    <div class="">
                                                        <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                        <p style="color:#000000;"><strong>Next Day</strong></p>
                                                    </div>
                                                    <div class="number">
                                                        <h3 class="card-subtitle mb-2" id="valueReflact2"><span id="Rf2">00</span></h3>
                                                        <input type="number" id="custNumber2" class="form-control" min="0" value="">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="main-title mb_10">
                                                        <h3 class="m-0">Order Count</h3>
                                                    </div>
                                                <div class="box_header m-0 flex-wrap">
                                                    
                                                    <div class="">
                                                        <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                        <p style="color:#000000;"><strong>Next Day</strong></p>
                                                    </div>
                                                    <div class="number">
                                                        <h3 class="card-subtitle mb-2" id="valueReflact3"><span id="Rf3">00</span></h3>
                                                        <input type="number" id="custNumber3" class="form-control" min="0" value="">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="main-title mb_10">
                                                        <h3 class="m-0">Visits</h3>
                                                    </div>
                                                <div class="box_header m-0 flex-wrap">
                                                    
                                                    <div class="">
                                                        <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                        <p style="color:#000000;"><strong>Next Day</strong></p>
                                                    </div>
                                                    <div class="number">
                                                        <h3 class="card-subtitle mb-2" id="valueReflact4"><span id="Rf4">00</span></h3>
                                                        <input type="number" id="custNumber4" class="form-control" min="0" value="">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="main-title mb_10">
                                                <h3 class="m-0">Revenue</h3>
                                            </div>
                                        <div class="box_header m-0 flex-wrap">
                                            
                                            <div class="">
                                                <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                <p style="color:#000000;"><strong>Next Day</strong></p>
                                            </div>
                                            <div class="number">
                                                <h3>$<span id="Rf6">12,000</span></h3>
                                                <input type="number" id="custNumber6" class="form-control" min="0" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                         <div class="main-title mb_10">
                                                <h3 class="m-0">Profit</h3>
                                            </div>
                                        <div class="box_header m-0 flex-wrap">
                                           
                                            <div class="">
                                                <p style="color:#000000;"><strong>This Day</strong></p><br/>
                                                <p style="color:#000000;"><strong>Next Day</strong></p>
                                            </div>
                                            <div class="number">
                                                <h3>$<span id="Rf5">7,541</span></h3>
                                                <input type="number" id="custNumber5" class="form-control" min="0" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function ($) {
            "use strict";

            const ctx = document.getElementById("sales-chart").getContext('2d');
            const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke1.addColorStop(0, "#00FF00");
            gradientStroke1.addColorStop(1, "#00FF00");

            const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke2.addColorStop(0, "#0000FF");
            gradientStroke2.addColorStop(1, "#0000FF");

            
            ctx.height = 100;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    type: 'line',
                    defaultFontFamily: 'Poppins',
                    datasets: [{
                        label: "Online",
                        data: [0, 10, 20, 10, 25, 75, 50],
                        backgroundColor: 'transparent',
                        borderColor: gradientStroke1,
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',

                    }, {
                        label: "Offline",
                        data: [0, 30, 10, 60, 50, 63, 10],
                        backgroundColor: 'transparent',
                        borderColor: gradientStroke2,
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                    }]
                },
                options: {
                    responsive: true,

                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }, 
                            ticks: {
                                max: 200, 
                                min: 0, 
                                stepSize: 20
                            }
                        }]
                    },
                    title: {
                        display: false,
                        text: 'Normal Legend'
                    }
                }
            });

        })(jQuery);
    </script>
    <script>
        (function ($) {
            "use strict";

            const ctx = document.getElementById("sales-chart1").getContext('2d');
            const gradientStroke1 = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke1.addColorStop(0, "#00FF00");
            gradientStroke1.addColorStop(1, "#00FF00");

            const gradientStroke2 = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke2.addColorStop(0, "#0000FF");
            gradientStroke2.addColorStop(1, "#0000FF");

            
            ctx.height = 100;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    type: 'line',
                    defaultFontFamily: 'Poppins',
                    datasets: [{
                        label: "Online",
                        data: [0, 10, 20, 10, 25, 75, 50],
                        backgroundColor: 'transparent',
                        borderColor: gradientStroke1,
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',

                    }, {
                        label: "Offline",
                        data: [0, 30, 10, 60, 50, 63, 10],
                        backgroundColor: 'transparent',
                        borderColor: gradientStroke2,
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                    }]
                },
                options: {
                    responsive: true,

                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }, 
                            ticks: {
                                max: 200, 
                                min: 0, 
                                stepSize: 20
                            }
                        }]
                    },
                    title: {
                        display: false,
                        text: 'Normal Legend'
                    }
                }
            });

        })(jQuery);
    </script>

    <script>
        $(document).ready(function(){
            // Vikas bhardwaj Js
            $("#custNumber").bind('keyup mouseup', function () {
                var a = $('#custNumber').val();
                $('#Rf').text(a);
            });

            $("#custNumber1").bind('keyup mouseup', function () {
                var a = $('#custNumber1').val();
                $('#Rf1').text(a);
            });

            $("#custNumber2").bind('keyup mouseup', function () {
                var a = $('#custNumber2').val();
                $('#Rf2').text(a);
            });

            $("#custNumber3").bind('keyup mouseup', function () {
                var a = $('#custNumber3').val();
                $('#Rf3').text(a);
            });

            $("#custNumber4").bind('keyup mouseup', function () {
                var a = $('#custNumber4').val();
                $('#Rf4').text(a);
            });
            
            $("#custNumber5").bind('keyup mouseup', function () {
                var a = $('#custNumber5').val();
                $('#Rf5').text(a);
            });
            
             $("#custNumber6").bind('keyup mouseup', function () {
                var a = $('#custNumber6').val();
                $('#Rf6').text(a);
            });
        });
        
        
        //  Active add class

        $('.btnDay').click(function(){
            $(this).addClass('active').siblings().removeClass('active'); 
        });

    </script>

@endsection