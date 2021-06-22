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
        return Socialite::driver('snapchat')->redirect();
    }

    public function handleProviderCallback()
    {
        
        $user = Socialite::driver('snapchat')->user();
        dd($user);
        
    }
}
