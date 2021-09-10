<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Model\UserGoogleAccount;
use App\Model\GoogleAdCustomerId;
use App\Model\GoogleAdCampaigns;
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
use Google\ApiCore\ApiException;

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
                    ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
                    // ...
                    ->build();
                // $customer_id = $google_account->google_ads_customer_id;

                // $customerServiceClient = $googleAdsClient->getCustomerServiceClient();

                // // Issues a request for listing all accessible customers.
                // $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
                // print 'Total results: ' . count($accessibleCustomers->getResourceNames()) . PHP_EOL;

                // // Iterates over all accessible customers' resource names and prints them.
                // foreach ($accessibleCustomers->getResourceNames() as $resourceName) {
                //     /** @var string $resourceName */
                //     printf("Customer resource name: '%s'%s", $resourceName, PHP_EOL);
                // }
                // die;

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

                    $stream = $googleAdsServiceClient->searchStream('9957336839', $query);

                    // Iterates over all rows in all messages and prints the requested field values for
                    // the campaign in each row.
                    // dd($stream);
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

    public function getCustomerIdList($value='')
    {
        $google_account = UserGoogleAccount::where('user_id',Auth::User()->id)->first();
        $customer_list = [];
        if(!empty($google_account)){
            // $oAuth2Credential = (new OAuth2TokenBuilder())
            //     ->withClientId(env('GOOGLE_CLIENT_ID'))
            //     ->withClientSecret(env('GOOGLE_CLIENT_SECRET'))
            //     ->withRefreshToken($google_account->refresh_token)
            //     // ...
            //     ->build();

            // $googleAdsClient = (new GoogleAdsClientBuilder())
            //     ->withOAuth2Credential($oAuth2Credential)
            //     ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            //     // ...
            //     ->build();
            // // $customer_id = $google_account->google_ads_customer_id;

            // $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
            
            // // Issues a request for listing all accessible customers.
            // $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
            
            
            // // Iterates over all accessible customers' resource names and prints them.
            // foreach ($accessibleCustomers->getResourceNames() as $resourceName) {
            //     /** @var string $resourceName */
                
            //     $customer_id = str_replace("customers/","",$resourceName);
            //     if($customer_id == '4795273194' ){
            //         $customer    = $customerServiceClient->getCustomer(ResourceNames::forCustomer($customer_id));

            //         // $query = 'SELECT customer_client.client_customer, customer_client.level,'
            //         //     . ' customer_client.manager, customer_client.descriptive_name,'
            //         //     . ' customer_client.currency_code, customer_client.time_zone,'
            //         //     . ' customer_client.id FROM customer_client WHERE customer_client.level <= 1';

            //         // // Adds the root customer ID to the list of IDs to be processed.

            //         // // Performs a breadth-first search algorithm to build an associative array mapping
            //         // // managers to their child accounts ($customerIdsToChildAccounts).

            //         // // Issues a search request by specifying page size.
            //         // /** @var GoogleAdsServerStreamDecorator $stream */
            //         // $googleAdsClient = (new GoogleAdsClientBuilder())
            //         // ->withOAuth2Credential($oAuth2Credential)
            //         // ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            //         // ->withLoginCustomerId('4795273194')
            //         // // ...
            //         // ->build();

            //         // $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();

            //         // $stream = $googleAdsServiceClient->searchStream(
            //         //     $customer_id,
            //         //     $query
            //         // );
            //         // pp($stream);
            //         // // Iterates over all elements to get all customer clients under the specified customer's
            //         // // hierarchy.

            //         // foreach ($stream->iterateAllElements() as $googleAdsRow) {
            //         //     /** @var GoogleAdsRow $googleAdsRow */
            //         //     $customerClient = $googleAdsRow->getCustomerClient();
            //         // }
            //     }

            //     $customer_list[] = [
            //         'customer_id'       => $customer_id,
            //         'descriptive_name'  => isset($customer)?$customer->getDescriptiveName():'',
            //         'client_customer_id' => ''
            //     ];
            // }
            $customer_list = GoogleAdCustomerId::where('deleted_at',null)->get();
            $response['customer_list'] = $customer_list;
            return view('business_app/content_template/google_ads_customer_list',$response);
        }
    }

    public function getCampaignList(Request $request,$customer_id)
    {
        $google_account = UserGoogleAccount::where('user_id',Auth::User()->id)->first();
        if(!empty($google_account)){
            // $oAuth2Credential = (new OAuth2TokenBuilder())
            //     ->withClientId(env('GOOGLE_CLIENT_ID'))
            //     ->withClientSecret(env('GOOGLE_CLIENT_SECRET'))
            //     ->withRefreshToken($google_account->refresh_token)
            //     // ...
            //     ->build();

            // $googleAdsClient = (new GoogleAdsClientBuilder())
            //     ->withOAuth2Credential($oAuth2Credential)
            //     ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
            //     ->withLoginCustomerId($customer_id)
            //     // ...
            //     ->build();

            // $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
            // // Creates a query that retrieves all campaigns.
            // $query = 'SELECT campaign.id, campaign.name FROM campaign ORDER BY campaign.id';
            // // Issues a search stream request.
            // /** @var GoogleAdsServerStreamDecorator $stream */

            // $stream = $googleAdsServiceClient->searchStream('6325332442', $query);

            // // Iterates over all rows in all messages and prints the requested field values for
            // // the campaign in each row.
            // pp($stream);
            // foreach ($stream->iterateAllElements() as $googleAdsRow) {
            //     pp($googleAdsRow);
            //     /** @var GoogleAdsRow $googleAdsRow */
            //     printf(
            //         "Campaign with ID %d and name '%s' was found.%s",
            //         $googleAdsRow->getCampaign()->getId(),
            //         $googleAdsRow->getCampaign()->getName(),
            //         PHP_EOL
            //     );
            // }

            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //   CURLOPT_URL => 'https://www.googleapis.com/oauth2/v3/token',
            //   CURLOPT_RETURNTRANSFER => true,
            //   CURLOPT_ENCODING => '',
            //   CURLOPT_MAXREDIRS => 10,
            //   CURLOPT_TIMEOUT => 0,
            //   CURLOPT_FOLLOWLOCATION => true,
            //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //   CURLOPT_CUSTOMREQUEST => 'POST',
            //   CURLOPT_POSTFIELDS => 'grant_type=refresh_token&client_id='.env('GOOGLE_CLIENT_ID').'&client_secret='.env('GOOGLE_CLIENT_SECRET').'&refresh_token='.$google_account->refresh_token,
            //   CURLOPT_HTTPHEADER => array(
            //     'Content-Type: application/x-www-form-urlencoded'
            //   ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);
            // $response = json_decode($response,1);

            // if(isset($response['access_token'])){
            //     $curl = curl_init();

            //     curl_setopt_array($curl, array(
            //       CURLOPT_URL => 'https://googleads.googleapis.com/v8/customers/6325332442/googleAds:searchStream',
            //       CURLOPT_RETURNTRANSFER => true,
            //       CURLOPT_ENCODING => '',
            //       CURLOPT_MAXREDIRS => 10,
            //       CURLOPT_TIMEOUT => 0,
            //       CURLOPT_FOLLOWLOCATION => true,
            //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //       CURLOPT_CUSTOMREQUEST => 'POST',
            //       CURLOPT_POSTFIELDS =>'{
            //         "query":"SELECT campaign.id, campaign.name,campaign.status,metrics.clicks,metrics.impressions,metrics.cost_micros FROM campaign ORDER BY campaign.id"
            //     }',
            //       CURLOPT_HTTPHEADER => array(
            //         'Authorization: Bearer '.$response['access_token'],
            //         'developer-token: '.env('GOOGLE_ADS_DEVELOPER_TOKEN'),
            //         'Content-Type: application/json',
            //         'Accept: application/json',
            //         'login-customer-id: '.$customer_id
            //       ),
            //     ));

            //     $campaign_response = curl_exec($curl);

            //     curl_close($curl);
            //     $campaign_response = json_decode($campaign_response,1);
                $campaign_list = GoogleAdCampaigns::where('google_ad_customer_id',$customer_id)->get();
                $response['customer_id'] = GoogleAdCustomerId::where('id',$customer_id)->first()->customer_id;
                $response['campaign_list'] = $campaign_list;
                
                return view('business_app/content_template/google_ads_campaign_list',$response);

            // }
        }
    }
}
