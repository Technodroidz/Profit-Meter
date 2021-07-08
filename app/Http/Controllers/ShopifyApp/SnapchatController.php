<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Model\UserSnapchatAccount;

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
        if($request->isMethod('post')){
            
            $paypal_account = UserSnapchatAccount::where('user_id',Auth::User()->id)->first();
            if(isset($paypal_account->access_token) && isset($paypal_account->refresh_token)){
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $request->api_url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$paypal_account->access_token
                  ),
                ));

                $response = curl_exec($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                curl_close($curl);

                if($httpcode == 401){

                    $refresh_response = refresh_snapchat_access_token($paypal_account->refresh_token);

                    UserSnapchatAccount::where('id',$paypal_account->id)->update(['access_token' => $refresh_response['access_token'],'refresh_token'=>$refresh_response['refresh_token'],'expires_in'=>$refresh_response['expires_in']]);

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => $request->api_url,
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
                echo 'Api Url === >>>>> '.$request->api_url;
                pp($response);
            }else{
                return redirect()->route('snapchat_api_list')->with('error','Snapchat User not added');
            }
        }
        return redirect()->route('snapchat_api_list')->with('error','Snapchat User not added');
    }
}
