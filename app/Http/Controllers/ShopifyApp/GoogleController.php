<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Model\BusinessUserGoogleAccount;
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
        return Socialite::driver('google')->redirect();
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

        BusinessUserGoogleAccount::insert($insert_array);
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
        $google_account = BusinessUserGoogleAccount::where('user_id',Auth::User()->id)->first();
        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->withClientId(env('GOOGLE_CLIENT_ID'))
            ->withClientSecret(env('GOOGLE_CLIENT_SECRET'))
            ->withRefreshToken('1//0gzqnQQ91bCNrCgYIARAAGBASNwF-L9IrJZKYcVJd7yp2UFVXUfSi1g1_u9VV0wptoR5eGzoGnpgGE3OwVEU4CweiRuINvA1g_YU')
            // ...
            ->build();

        $googleAdsClient = (new GoogleAdsClientBuilder())
            ->withOAuth2Credential($oAuth2Credential)
            ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            // ...
            ->build();

        $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
        $customer = $customerServiceClient->getCustomer(ResourceNames::forCustomer('331-339-2666'));
        dd($customer);
    }
}
