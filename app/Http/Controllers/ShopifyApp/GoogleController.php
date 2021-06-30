<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Model\UserGoogleAccount;
use Illuminate\Support\Facades\Auth;

use GetOpt\GetOpt;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentNames;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentParser;
use Google\Ads\GoogleAds\Lib\V8\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V8\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V8\GoogleAdsException;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Util\V8\ResourceNames;
use Google\Ads\GoogleAds\V8\Errors\GoogleAdsError;
use Google\ApiCore\ApiExceptio;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        $scopes = ['https://www.googleapis.com/auth/adwords'];
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes($scopes)->with($parameters)->redirect();
    }

    public function handleProviderCallback()
    {
        
        $user = Socialite::driver('google')->stateless()->user();
        
        $insert_array = [
            'user_id'          => Auth::User()->id,
            'token'            => $user->token,
            'refresh_token'    => $user->refreshToken,
            'expires_in'       => $user->expiresIn,
            'google_id'        => $user->id,
            'name'             => $user->name,
            'email'            => $user->email,
            'avatar'           => $user->avatar,
        ];

        UserGoogleAccount::updateOrInsert(['user_id'=>Auth::User()->id],$insert_array);
        return redirect()->route('show_google_ads');

        // $findUser = User::where('email',$user->getEmail())->first();
        // if ($findUser) {
        //     Auth::login($findUser);
        // }else{
        //     $newUser = new User;
        //     $newUser->email = $user->getEmail();
        //     $newUser->name = $user->getName();
        //     $newUser->password = bcrypt(123456);
        //     $newUser->save();
        //     Auth::login($newUser);
        // }
        // return redirect('home');
    }

    public function fetchGoogleAds()
    {
        $google_account = UserGoogleAccount::where('user_id',Auth::User()->id)->first(); 

        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->withClientId(env('GOOGLE_CLIENT_ID'))
            ->withClientSecret(env('GOOGLE_CLIENT_SECRET'))
            ->withRefreshToken($google_account->refresh_token)
            // ...
            ->build();

        $googleAdsClient = (new GoogleAdsClientBuilder())
            ->withOAuth2Credential($oAuth2Credential)
            ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            // ...
            ->build();

        $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
        $customer = $customerServiceClient->getCustomer(ResourceNames::forCustomer('9953755478'));
        dd($customer);
    }
}
