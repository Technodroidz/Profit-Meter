<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Google\ApiCore\ApiException;
use App\Model\UserStripeAccount;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function redirectToProvider()
    {
        $scopes = [];
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('stripe')->scopes($scopes)->with($parameters)->redirect();
    }

    public function handleProviderCallback()
    {
        
        $user = Socialite::driver('stripe')->user();
        // pp($user);
        $access_token_response_body = $user->accessTokenResponseBody;
        $insert_array = [
            'user_id'                   => Auth::User()->id,
            'livemode'                  => $access_token_response_body['livemode'],
            'token_type'                => $access_token_response_body['token_type'],
            'access_token'              => $access_token_response_body['access_token'],
            'refresh_token'             => $access_token_response_body['refresh_token'],
            'expires_in'                => $user->expiresIn,
            'stripe_user_id'            => $access_token_response_body['stripe_user_id'],
            'stripe_publishable_key'    => $access_token_response_body['stripe_publishable_key'],
            'scope'                     => $access_token_response_body['scope'],
            'nickname'                  => $user->nickname,
            'name'                      => $user->name,
            'email'                     => $user->email,
            'avatar'                    => $user->avatar,
            'created_at'                => date('Y-m-d H:i:s')
        ];

        UserStripeAccount::updateOrInsert(['user_id'=>Auth::User()->id],$insert_array);
        return redirect()->route('business_integration')->with('success','Stripe Account Added');
        
    }

    public function disputesList()
    {
        $stripe_account = UserStripeAccount::where('user_id',Auth::User()->id)->first();
        $stripe = new \Stripe\StripeClient(
          $stripe_account->access_token
        );
        // $disputes = $stripe->issuing->disputes->all(['limit' => 3]);
        $disputes = $stripe->disputes->all();
        $response['disputes'] = $disputes->data;
        return view('business_app/content_template/stripe_disputes_list',$response);
    }
}
