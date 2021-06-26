<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class PaypalController extends Controller
{
    public function redirectToProvider()
    {

        // $scopes = [
        //     'https://auth.snapchat.com/oauth2/api/user.display_name',
        //     'https://auth.snapchat.com/oauth2/api/user.bitmoji.avatar',
        //     'https://auth.snapchat.com/oauth2/api/user.external_id',
        // ];

        // $parameters = ['access_type' => 'offline'];
        
        return Socialite::driver('paypal')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('paypal')->user();
        dd($user);
    }
}
