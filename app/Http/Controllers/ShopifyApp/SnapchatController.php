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
        pp($request->all());
    }
}
