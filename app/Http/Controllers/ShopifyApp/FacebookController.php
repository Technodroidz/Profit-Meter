<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scottybo\LaravelFacebookSdk\LaravelFacebookSdk;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use FacebookAds\Api;
// use FacebookAds\Object\AdUser;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

use Illuminate\Support\Facades\Auth;
use App\Model\UserFacebookAccount;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

class FacebookController extends Controller
{
    public function facebookLogin(Request $request)
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('facebook')->with($parameters)->redirect();
    }

    public function facebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        
        $user_object = $user->user;
        $insert_array = [
            'user_id'          => Auth::User()->id,
            'token'            => $user->token,
            'refresh_token'    => $user->refreshToken,
            'expires_in'       => $user->expiresIn,
            'facebook_id'      => $user->id,
            'name'             => $user->name,
            'email'            => $user->email,
            'avatar'           => $user->avatar,
            'gender'           => $user_object['gender']
        ];

        UserFacebookAccount::updateOrInsert(['user_id'=>Auth::User()->id],$insert_array);
        return redirect()->route('facebook_ads_api_list');
    }

    public function facebookApiList()
    {
        return view('business_app/content_template/facebook_ads_api_list');
    }

    public function facebookApiDetail(Request $request)
    {
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();
        // Initialize a new Session and instantiate an Api object
        Api::init(env('FACEBOOK_APP_ID'),env('FACEBOOK_APP_SECRET'),$facebook_account->token);

        // The Api object is now available through singleton
        $api = Api::instance();


        // $ad = new Ad('130130937619407');
        // $ad->getSelf(array(
        //     AdAccountFields::ID,
        //     AdAccountFields::NAME,
        // ));
        // pp($ad);

        // die;

        $fields = array(
            AdAccountFields::ID,
            AdAccountFields::NAME,
        );
        
        $account = (new AdAccount($facebook_account->facebook_id))->getSelf($fields);

        pp($account);
        // $me = new AdUser('me');
        // $my_adaccount = $me->getAdAccounts()->current();
        // pp($my_adaccount);
    }
}
