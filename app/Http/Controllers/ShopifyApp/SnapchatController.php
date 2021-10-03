<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Model\UserSnapchatAccount;
use App\Model\SnapchatOrganisation;
use App\Model\SnapchatInvoices;
use App\Model\SnapchatAdAccount;
use App\Model\SnapchatCampaign;
use App\Model\SnapchatAds;

class SnapchatController extends Controller
{
    public function redirectToProvider()
    {
        // $config = new \SocialiteProviders\Manager\Config(env('SNAPCHAT_CLIENT_ID'),env('SNAPCHAT_CLIENT_SECRET'),'http://127.0.0.1/Profit-Meter/login/snapchat/callback');
        // return Socialite::with('snapchat')->setConfig($config)->stateless()->redirect();

        // $scopes = [
        //     'https://auth.snapchat.com/oauth2/api/user.display_name',
        //     'https://auth.snapchat.com/oauth2/api/user.bitmoji.avatar',
        //     'https://auth.snapchat.com/oauth2/api/user.external_id',
        // ];

        // $parameters = ['access_type' => 'offline'];
        // return Socialite::driver('snapchat')->scopes($scopes)->with($parameters)->redirect();
        // pp('aya');

        $client_id      = env('SNAPCHAT_CLIENT_ID');
        $redirect_uri   = env('SNAPCHAT_REDIRECT_URL');
        $response_type  = 'code';
        $scope          = 'snapchat-marketing-api';
        $state          = '';

        $oauth_url = 'https://accounts.snapchat.com/login/oauth2/authorize?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type='.$response_type.'&scope='.$scope.'&state='.$state;
        
        return redirect()->away($oauth_url);
    }

    public function handleProviderCallback(Request $request)
    {
        if($request->code){
            $client_id      = env('SNAPCHAT_CLIENT_ID');
            $client_secret  = env('SNAPCHAT_CLIENT_SECRET');
            $redirect_uri   = env('SNAPCHAT_REDIRECT_URL');
            $response_type  = 'code';
            $scope          = 'snapchat-marketing-api';
            $state          = '';

            $user_snapchat_account = UserSnapchatAccount::where('user_id',Auth::User()->id)->first();
            if(!empty($user_snapchat_account) && !empty($user_snapchat_account->access_token) && !empty($user_snapchat_account->refresh_token)){
                $id = $user_snapchat_account->id;
                $access_token  = $user_snapchat_account->access_token;
                $refresh_token = $user_snapchat_account->refresh_token;
            }else{
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://accounts.snapchat.com/login/oauth2/access_token',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'client_id='.$client_id.'&client_secret='.$client_secret.'&code='.$request->code.'&grant_type=authorization_code&redirect_uri='.$redirect_uri,
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $response = json_decode($response,1);

                $snapchat_array = [
                    'user_id'       => Auth::User()->id,
                    'access_token'  => $response['access_token'],
                    'refresh_token' => $response['refresh_token'],
                    'expires_in'    => $response['expires_in'],
                    'scope'         => $response['scope'],
                    'code'          => $request->code,
                    'created_at'    => date('Y-m-d H:i:s'),
                ];

                $id = UserSnapchatAccount::insertGetId($snapchat_array);
                $access_token  = $response['access_token'];
                $refresh_token = $response['refresh_token'];
            }

            if(isset($access_token)){

                if(isset($refresh_token)){
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://adsapi.snapchat.com/v1/me',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer '.$access_token
                      ),
                    ));

                    $response = curl_exec($curl);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                    curl_close($curl);

                    if($httpcode == 401){
                        $refresh_response = refresh_snapchat_access_token($refresh_token);

                        UserSnapchatAccount::where('id',$id)->update(['access_token' => $refresh_response['access_token'],'refresh_token'=>$refresh_response['refresh_token'],'expires_in'=>$refresh_response['expires_in']]);

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://adsapi.snapchat.com/v1/me',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'GET',
                          CURLOPT_HTTPHEADER => array(
                            'Authorization: Bearer '.$refresh_response['access_token']
                          ),
                        ));

                        $response = curl_exec($curl);
                        $response = json_decode($response,1);
                        curl_close($curl);
                    }else{
                        $response = json_decode($response,1);
                    }

                    $snapchat_update_array = [
                        'snapchat_id'     => $response['me']['email'],
                        'organization_id' => $response['me']['organization_id'],
                        'email'           => $response['me']['email'],
                        'display_name'    => $response['me']['display_name']
                    ];
                    UserSnapchatAccount::where('id',$id)->update($snapchat_update_array);
                    return redirect()->route('snapchat_api_list')->with('success','Snapchat Account added Successfully.');
                }
            }
            return redirect()->route('business_integration')->with('error','Invalid login request on Snapchat.');
        }
        return redirect()->route('business_integration')->with('error','Invalid login request on Snapchat.');
    }

    public function snapchatApiList()
    {
        return view('business_app/content_template/snapchat_api_list');
    }

    public function snapchatApiDetail(Request $request)
    {
        $api_url = $request->api_url;
        $snapchat_account = UserSnapchatAccount::where('user_id',Auth::User()->id)->first();
        if(isset($snapchat_account->access_token) && isset($snapchat_account->refresh_token)){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$snapchat_account->access_token
              ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if($httpcode == 401){

                $refresh_response = refresh_snapchat_access_token($snapchat_account->refresh_token);

                UserSnapchatAccount::where('id',$snapchat_account->id)->update(['access_token' => $refresh_response['access_token'],'refresh_token'=>$refresh_response['refresh_token'],'expires_in'=>$refresh_response['expires_in']]);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $api_url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$refresh_response['access_token']
                  ),
                ));

                $response = curl_exec($curl);
                $response = json_decode($response,1);
                curl_close($curl);
            }else{
                $response = json_decode($response,1);
            }
            pp($response);
            return $response;
        }else{
            return redirect()->route('snapchat_api_list')->with('error','Snapchat User not added');
        }
    }

    public function organisationList(Request $request)
    {
        // $api_url    = 'https://adsapi.snapchat.com/v1/me/organizations';
        // $response   = $this->snapchatApiDetail($api_url);
        $response['organizations']   = SnapchatOrganisation::where('deleted_at',null)->get();
        
        return view('business_app/content_template/snapchat_organisation_account_list',$response);
        
    }

    public function adAccountList(Request $request,$organization_id)
    {
        // $api_url    = 'https://adsapi.snapchat.com/v1/organizations/'.$organization_id.'/adaccounts';
        // $response   = $this->snapchatApiDetail($api_url);
        $response['adaccounts']   = SnapchatAdAccount::where('deleted_at',null)->where('organisation_id',$organization_id)->get();

        return view('business_app/content_template/snapchat_ad_account_list',$response);
        
    }

    public function adAccountInvoiceList(Request $request,$ad_account_id)
    {
        $api_url    = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/invoices';
        $response   = $this->snapchatApiDetail($request);
        pp($response);
        return view('business_app/content_template/snapchat_ad_account_invoice_list',$response);
        
    }

    public function campaignList(Request $request,$ad_account_id)
    {
        // $api_url    = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/campaigns';
        // $response   = $this->snapchatApiDetail($api_url);
        $response['campaigns']   = SnapchatCampaign::where('deleted_at',null)->where('ad_account_id',$ad_account_id)->get();

        return view('business_app/content_template/snapchat_campaign_list',$response);
        
    }

    public function adsList(Request $request,$campaign_id)
    {
        // $api_url    = 'https://adsapi.snapchat.com/v1/campaigns/'.$campaign_id.'/ads';
        // $response   = $this->snapchatApiDetail($api_url);
        $response['ads']   = SnapchatAds::where('deleted_at',null)->where('campaign_id',$campaign_id)->get();

        return view('business_app/content_template/snapchat_ads_list',$response);
        
    }
}
