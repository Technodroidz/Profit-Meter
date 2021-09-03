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

    <div class="container-fluid p-0 ">
         <!-- page title  -->
        <div class="row">
            <div class="col-12">
               <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                  <div class="page_title_left">
                     <h3 class="mb-0" >Integrations <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
                  </div>
                  <!-- <button style="float: right; background:#00FF7F; border:none; color:#fff; padding:10px;">Add Integration</button> -->
               </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12">
                <div class="mb_30">
     
                    <div class="white_card_body anlite_table p-0">
                        <div class="row">
       
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart fb">
                                          <img src="{{asset('')}}business_app/img/facebook.png">
                                          <h4 class="card-title">Facebook Ads</h4>
                                          <p class="txt">import your AdSpend from Facebook</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                The Facebook Ads Extension imports all your campaigns and adsets into Profitario to give you clear pictre of your overall adspend.
                                            </p>
                                            <div class="text-right btm">
                                                <!-- <button class="stBtn">Settings</button> -->
                                                @if(empty($facebook_account))
                                                <button class="contBtn"><a href="{{route('facebook_login')}}" style="color:inherit;">Connect</a></button>
                                                @else
                                                <button class="stBtn" ><a href="{{route('facebook_ad_account_list')}}" style="color:inherit;" >Ads Data</a></button>
                                                <button class="contBtn">Connected</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart stripe">
                                          <img src="{{asset('')}}/business_app/img/stripe.svg">
                                          <h4 class="card-title">Stripe</h4>
                                          <p class="txt">import Disputes from Stripe</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Stripe to your Profitario account to integrate disputes into your profit calculations.
                                            </p>
                                            <div class="text-right btm">
                                                @if(empty($stripe_account))
                                                    <button class="contBtn"><a href="{{route('stripe_login')}}" style="color:inherit;" >Connect</a></button>
                                                @else
                                                    <button class="stBtn"><a href="{{route('stripe_disputes_list')}}" style="color:inherit;" >Check Dispute</a></button>
                                                    <button class="contBtn">Connected</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3" id="paypal_app">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart paypal">
                                          <img src="{{asset('')}}business_app/img/paypal.png">
                                          <h4 class="card-title">Paypal</h4>
                                          <p class="txt">import Disputes from Paypal</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Paypal to your Profitario account to integrate disputes into your profit calculations.
                                            </p>
                                            <div class="text-right btm">
                                                <!-- <button class="stBtn">Settings</button> -->
                                                <!-- <button class="contBtn">Connected</button> -->
                                                <!-- <button class="contBtn" data-toggle="modal" data-target="#paypalConnect"><a href="javascript:void(0);" style="color:inherit;">Connect</a></button> -->

                                                @if(empty($paypal_account))
                                                    <button class="contBtn"><a href="{{route('connect_paypal')}}" style="color:inherit;" >Connect</a></button>
                                                
                                                @else
                                                    <button class="stBtn" ><a href="{{route('paypal_dispute_list')}}" style="color:inherit;" >Check Dispute</a></button>
                                                <button class="contBtn">Connected</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart google_ana">
                                          <img src="{{asset('')}}business_app/img/snapchat-logo-png-.png">
                                          <h4 class="card-title">Snapchat</h4>
                                          <p class="txt">import User Data from Snapchat</p>
                                          <span class="redBatch">NOT CONNECTED</span>
                                        </div>
                                        <div class="bottumPart">
                                            <p class="txtConetnt">
                                                Connect Snapchat to your Profitario account to integrate Session information. Conversion Data and Customer Aqusition Cost.
                                            </p>
                                            <div class="text-right btm">
                                                @if(empty($snapchat_account))
                                                <button class="contBtn"><a href="{{route('connect_snapchat')}}" style="color:inherit;" >Connect</a></button>
                                                @else
                                                <button class="stBtn" ><a href="{{route('organisation_list')}}" style="color:inherit;" >Ads data</a></button>
                                                <button class="contBtn">Connected</button>
                                                @endif
                                                <!-- <button id="my-login-button-target">Connect</button>

                                                <div id="display_name"></div>
                                                <img id="bitmoji" />
                                                <div id="external_id"></div>
                                                <hr /> -->
                                                <!-- <button class="contBtn">Connected</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-3" id="google_app">
                                <div class="card">
                                    <div class="card-body pad-0">
                                        <div class="uperPart google_ad">
                                          <img src="{{asset('')}}business_app/img/google-ads.png">
                                          <h4 class="card-title">Google Adwords</h4>
                                          <p class="txt">Import AdSpend from Google Adwords</p>
                                        @if(empty($google_account))
                                            <span class="redBatch">NOT CONNECTED</span>
                                        @elseif (!empty($google_account) && $google_account->google_ads_developer_token == '' &&$google_account->google_ads_customer_id == '' )
                                            <span class="redBatch">Account Added</span>
                                        @elseif (!empty($google_account) && $google_account->google_ads_developer_token != '' &&$google_account->google_ads_customer_id != '' )
                                            <span class="redBatch">Connected</span>
                                        @endif

                                        </div>
                                        <div class="bottumPart" style="box-sizing: content-box;">
                                            <p class="txtConetnt">
                                                Connect Adwords Extension imports all your campaigns and adSpend into Profitario to give you a clear picture of your overall adspend.
                                            </p>
                                            <div class="text-right btm">
                                                <!-- <button class="stBtn" ><a href="{{route('google_ads_response')}}" style="color:inherit;" >Settings</a></button> -->
                                                
                                                <!-- <button class="stBtn">Settings</button> -->
                                                @if(empty($google_account))
                                                    <button class="contBtn"><a href="{{route('connect_google')}}" style="color:inherit;">Connect</a></button>
                                                
                                                    <!-- <button class="contBtn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0);" style="color:inherit;">Configure Ads</a></button> -->
                                                @else
                                                    <button class="stBtn" ><a href="{{route('customer_id_list')}}" style="color:inherit;" >Ads data</a></button>
                                                    <button class="contBtn"><a href="javascript:void(0);" style="color:inherit;">Connected</a></button>
                                                @endif
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
@endsection

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form role="update_google_ads_setting" method="POST" action="{{ route('update_google_ads_setting') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Google Ads Account details linked to {{ @$google_account->email }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong id="show_error">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <label for="basic-url">Customer ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ID</span>
                        </div>
                        <input name="customer_id" type="text" class="form-control" aria-describedby="basic-addon3">
                    </div>

                    <label for="basic-url">Developer Token</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" >Token</span>
                        </div>
                        <input name="developer_token" type="text" class="form-control" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-request="web-ajax-submit" data-target="[role=update_google_ads_setting]" data-replace_element="#google_app" data-show_error="#show_error" >Add & Continue</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="paypalConnect" tabindex="-1" role="dialog" aria-labelledby="paypalConnectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form role="update_paypal_api_settings" method="POST" action="{{ route('update_paypal_api_settings') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Paypal Api Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong id="show_paypal_form_error">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <label for="basic-url">Mode</label>
                    <div class="input-group mb-3">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text">ID</span>
                        </div> -->
                        <!-- <input name="mode" type="text" class="form-control" aria-describedby="basic-addon3"> -->
                        <select name="mode" class="form-control" id="cars" aria-describedby="basic-addon3">
                          <option value="sandbox" {{ @$paypal_account->mode == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                          <option value="live" {{ @$paypal_account->mode == 'live' ? 'selected' : '' }}>Live</option>
                        </select>
                    </div>

                    <label for="basic-url">SandBox</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" >Client ID</span>
                        </div>
                        <input name="sandbox_client_id" type="text" class="form-control" aria-describedby="basic-addon3" value="{{ @$paypal_account->sandbox_client_id  }}">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" >Client Secret</span>
                        </div>
                        <input name="sandbox_client_secret" type="text" class="form-control" aria-describedby="basic-addon3" value="{{ @$paypal_account->sandbox_client_secret  }}">
                    </div>
                    <label for="basic-url">Live</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" >Client ID</span>
                        </div>
                        <input name="live_client_id" type="text" class="form-control" aria-describedby="basic-addon3" value="{{ @$paypal_account->live_client_id  }}">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" >Client Secret</span>
                        </div>
                        <input name="live_client_secret" type="text" class="form-control" aria-describedby="basic-addon3" value="{{ @$paypal_account->live_client_secret }}" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-request="web-ajax-submit" data-target="[role=update_paypal_api_settings]" data-replace_element="#paypal_app" data-show_error="#show_paypal_form_error" >Add & Continue</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('script')
    <script>
        window.snapKitInit = function () {
        var loginButtonIconId = "my-login-button-target";
        // Mount Login Button
        snap.loginkit.mountButton(loginButtonIconId, {
          clientId: "{{ env('SNAPCHAT_CLIENT_ID') }}",
          redirectURI: "{{env('SNAPCHAT_REDIRECT_URL')}}",
          scopeList: ["snapchat-marketing-api",          ],
          handleResponseCallback: function () {
            snap.loginkit.fetchUserInfo().then(
              function (result) {
                console.log("User info:", result.data.me);
                document.getElementById("display_name").innerHTML =
                  result.data.me.displayName;
                document.getElementById("bitmoji").src =
                  result.data.me.bitmoji.avatar;
                document.getElementById("external_id").src =
                  result.data.me.externalId;
              },
              function (err) {
                console.log(err); // Error
              }
            );
          },
        });
      };
      // Load the SDK asynchronously
      (function (d, s, id) {
        var js,
          sjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://sdk.snapkit.com/js/v1/login.js";
        sjs.parentNode.insertBefore(js, sjs);
      })(document, "script", "loginkit-sdk");
    </script>
@endsection
