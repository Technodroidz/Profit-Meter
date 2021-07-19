@extends('business_app/common_template/main')

@section('content')

    <style>
        .card-body.pad-0 {
            box-shadow: 0px 0px 10px 1px rgb(0 0 0 / 20%);
            border-radius: 4px;
        }
        @media (max-width:1300px){
            .col-sm-4{
                flex:0 0 33.3333333%;
                max-width:33.3333333%;
            }
            .uperPart {
                height: 240px;
                position:relative;
            }
            span.redBatch {
                margin-top: 0px;
                position: absolute;
                left: 50%;
                bottom: 16px;
                transform: translate(-50%, 0%);
            }
        }
        /**, ::after, ::before {
             box-sizing: content-box; 
        }*/

    </style>

        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3>Facebook ads Api List</h3>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="dashboard_breadcam text-right">
                                    <p><a href="index-2.html">Dashboard</a> <i class="fas fa-caret-right"></i>  ThemeCard</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('facebook_ads_api_detail') }}">
                        @csrf
                        <div class="card_box box_shadow position-relative mb_30">
                            <div class="white_box_tittle">
                                <div class="main-title2 ">
                                    <h4 class="mb-2 nowrap ">Get Ad Account</h4>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Api</span>
                                        </div>
                                        <input name="api_url" value="getAdAccounts" type="text" class="form-control" aria-describedby="basic-addon3" readonly="readonly">
                                    </div>
                                    <button type="submit" class="btn btn-secondary" >Check Api Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('facebook_ads_api_detail') }}">
                        @csrf
                        <div class="card_box box_shadow position-relative mb_30">
                            <div class="white_box_tittle">
                                <div class="main-title2 ">
                                    <h4 class="mb-2 nowrap ">Get Campaigns</h4>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Api</span>
                                        </div>
                                        <input name="api_url" value="get/campaigns" type="text" class="form-control" aria-describedby="basic-addon3" readonly="readonly">
                                    </div>
                                    <button type="submit" class="btn btn-secondary" >Check Api Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                
            </div>
        </div>
@endsection


@section('script')
    
@endsection
