<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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

        $client_id = '32e7c720-ba0d-40b1-b6b1-5ce6f446d3ae';
        $redirect_uri = 'https://citrixcrm.club/login/snapchat/callback';
        $response_type = 'code';
        $scope = 'snapchat-marketing-api';
        $state = '';

        $oauth_url = 'https://accounts.snapchat.com/login/oauth2/authorize?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type='.$response_type.'&scope='.$scope.'&state='.$state;

        return redirect()->away($oauth_url);
    }

    public function handleProviderCallback(Request $request)
    {
        $access_token = 'eyJpc3MiOiJodHRwczpcL1wvYWNjb3VudHMuc25hcGNoYXQuY29tXC9hY2NvdW50c1wvb2F1dGgyXC90b2tlbiIsInR5cCI6IkpXVCIsImVuYyI6IkExMjhDQkMtSFMyNTYiLCJhbGciOiJkaXIiLCJraWQiOiJhY2Nlc3MtdG9rZW4tYTEyOGNiYy1oczI1Ni4wIn0..1NhPSfOxtO4JXT5pS1RqoQ.EszCAZzHXTE0H1SnPOFq2V367BVVGm7GG0DgWkEpK3WymK1vu0WuniGm8JYdf_WP4ZzIiCJLc8cj_dPFIjwbaU_PcUeb66YJtCca3peYCgEBmzxtHN0HhRSlxe9WENoMtUU0N50eX05YVk0ion8OmFjFEuaZp6dOnhNlKshe4S8EZaQnihBp4K8aLPkRZbdAHQdvX0-woHfOjcVxjLG6ffJn-qL0sN533mJVUY2B1g08-bzzvzBOTAd_J2Ncwt_1DQ1N8apdLD2feq7saoo597kTE8F4yuLjitQaKbwj-Vwf-sSbQJSr4RMcV1ftVSoIvtPHnZOB3Q2ekY6zHkx41LY_SQSKVHDdhstiRI62dDE8v1kwH-Nxh06AwEE_XbyUXf9aR4q8QFMnRXsL7WQYmoWYiVJASy9qj7TZzCKlEE1NT3m2A51EGSNDECNX9v8uOTZjI695ZR9aMOEw6ob7F7dUWfGWq8ZJX9skKNFAa8evJdWvX1jCZ1FoNM0A9IOvdD53bJ-R-2KiVRT8frKHcV2Dg7UZ6C70P-eNDvXTKWIYmysAWpZLWopn88Gy56ab8XjfqlclQVtLOy8gOCvULdhZ9J_-_YBCwMFPDmWu8kpt_RonU5z9ax76D7HV6tvi4VXAPl8X_9gu-JwDyvVDx4GmoC_XJfyb1SQ28yMVEJob6On5ATUPLKmNbk2-NNUZf9XQpS8epzRoi4JK5F6G-u52eNxoehU22j8BJFO5j1s.21Bc_vDBo6zQG6Eh10SW0A';
        
        $refresh_token = 'eyJraWQiOiJyZWZyZXNoLXRva2VuLWExMjhnY20uMCIsInR5cCI6IkpXVCIsImVuYyI6IkExMjhHQ00iLCJhbGciOiJkaXIifQ..H4EsnCXaBrui5xap.eFDbka9Oy1fhZcvgnjOwYwU4Lt9dnr6H7j9GpmbAVvNghdlbN0nafp8ZrG_XLy7vuCZHWS0BUGSMVGrnGLQFgqNpGK-REAEqUx8BMAaCH4xCkskArXkjcBeYNC4HeBzC_OmAgEcTU74tA65sEZM4JMzyXiTZ3feSShi_2D8D_UXyBcpoc4bpomvpRtSM_AGmvvNcDHaSc1-0RKRrSCg5EndLYiWnyL0u1EHx0DRtis2zGmh9x-f1CfwAUORmq37LogjUdHp5XIO4lPw.uV2ysGYMLUZ2BxjGD_ALTg';

        if(empty($access_token) && $request->code){

            $client_id      = '32e7c720-ba0d-40b1-b6b1-5ce6f446d3ae';
            $client_secret  = 'b39498a6b5bea40ae9e7';
            $redirect_uri   = 'https://citrixcrm.club/login/snapchat/callback';
            $response_type  = 'code';
            $scope          = 'snapchat-marketing-api';
            $state          = '';

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
            
            $access_token = $response['access_token'];
            $refresh_token = $response['refresh_token'];
        }

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

            curl_close($curl);
            echo $response;
    }
}
