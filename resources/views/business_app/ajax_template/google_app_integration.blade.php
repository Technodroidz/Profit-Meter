<div class="card new_card">
    <div class="card-body pad-0">
        <div class="uperPart google_ad">
          <img src="{{asset('')}}/business_app/img/google-ads.png">
          <h4 class="card-title">Google Adwords</h4>
          <p class="txt">import AdSpend from Google Adwords</p>
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
                @if (!empty($google_account) && $google_account->google_ads_developer_token == '' &&$google_account->google_ads_customer_id == '' )
                <br><strong>Please click "Configure Ads Setting" to Update Your Google ads Manager Setting to sync with google ads account.</strong>
                @endif
            </p>
            <div class="text-right btm">
                <!-- <button class="stBtn">Settings</button> -->
                <button class="stBtn" ><a href="{{route('google_ads_api_list')}}" style="color:inherit;" >Check Apis</a></button>
                @if(empty($google_account))
                    <button class="contBtn"><a href="{{route('connect_google')}}" style="color:inherit;">Connect</a></button>
                @elseif (!empty($google_account) && $google_account->google_ads_developer_token == '' &&$google_account->google_ads_customer_id == '' )
                    <button class="contBtn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0);" style="color:inherit;">Configure Ads Setting</a></button>
                @elseif (!empty($google_account) && $google_account->google_ads_developer_token != '' &&$google_account->google_ads_customer_id != '' )
                    <button class="contBtn"><a href="javascript:void(0);" style="color:inherit;">Connected</a></button>
                @endif
            </div>
        </div>
    </div>
</div>