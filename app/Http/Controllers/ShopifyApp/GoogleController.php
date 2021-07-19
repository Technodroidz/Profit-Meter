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
        // pp($user);
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
        return redirect()->route('business_integration')->with('success','Google user added.Please add your google ads creds to check the apis');

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

    public function googleAdsApiList()
    {
        return view('business_app/content_template/google_ads_api_list');
    }

    public function googleAdsApiDetail(Request $request)
    {
        
        if($request->isMethod('post')){
            $google_account = UserGoogleAccount::where('user_id',Auth::User()->id)->first();
            if(!empty($google_account)){
                $oAuth2Credential = (new OAuth2TokenBuilder())
                    ->withClientId(env('GOOGLE_CLIENT_ID'))
                    ->withClientSecret(env('GOOGLE_CLIENT_SECRET'))
                    ->withRefreshToken($google_account->refresh_token)
                    // ...
                    ->build();

                $googleAdsClient = (new GoogleAdsClientBuilder())
                    ->withOAuth2Credential($oAuth2Credential)
                    ->withDeveloperToken($google_account->google_ads_developer_token)
                    // ...
                    ->build();
                $customer_id = $google_account->google_ads_customer_id;

                if($request->api_url == 'get/customer'){
                    $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
                    $customer = $customerServiceClient->getCustomer(ResourceNames::forCustomer($customer_id));
                    printf(
                        "Customer with ID %d, descriptive name '%s', currency code '%s', timezone '%s', "
                        . "tracking URL template '%s' and auto tagging enabled '%s' was retrieved.%s",
                        $customer->getId(),
                        $customer->getDescriptiveName(),
                        $customer->getCurrencyCode(),
                        $customer->getTimeZone(),
                        is_null($customer->getTrackingUrlTemplate())
                            ? 'N/A' : $customer->getTrackingUrlTemplate(),
                        $customer->getAutoTaggingEnabled() ? 'true' : 'false',
                        PHP_EOL
                    );

                }elseif($request->api_url == 'get/campaigns'){

                    $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
                    // Creates a query that retrieves all campaigns.
                    $query = 'SELECT campaign.id, campaign.name FROM campaign ORDER BY campaign.id';
                    // Issues a search stream request.
                    /** @var GoogleAdsServerStreamDecorator $stream */

                    $stream = $googleAdsServiceClient->searchStream($customer_id, $query);

                    // Iterates over all rows in all messages and prints the requested field values for
                    // the campaign in each row.
                    dd($stream);
                    foreach ($stream->iterateAllElements() as $googleAdsRow) {
                        /** @var GoogleAdsRow $googleAdsRow */
                        printf(
                            "Campaign with ID %d and name '%s' was found.%s",
                            $googleAdsRow->getCampaign()->getId(),
                            $googleAdsRow->getCampaign()->getName(),
                            PHP_EOL
                        );
                    }
                }
                die;
            }else{
                return redirect()->route('google_ads_api_list')->with('error','Google ads User not added');
            }
        }
        return redirect()->route('google_ads_api_list');
    }
}
