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
        if($request->code){

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
            echo $response;
        }
        
    }
}
