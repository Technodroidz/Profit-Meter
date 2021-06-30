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

        $scopes = [
            'https://auth.snapchat.com/oauth2/api/user.display_name',
            'https://auth.snapchat.com/oauth2/api/user.bitmoji.avatar',
            'https://auth.snapchat.com/oauth2/api/user.external_id',
        ];

        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('snapchat')->scopes($scopes)->with($parameters)->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('snapchat')->user();
        dd($user);
    }
}
