<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Model\UserGoogleAccount;
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

class SyncGoogleAdsData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $google_account = UserGoogleAccount::where('user_id',$this->user_id)->first();
        $customer_list = [];
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

            $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
            
            // Issues a request for listing all accessible customers.
            $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
            
            
            // Iterates over all accessible customers' resource names and prints them.
            foreach ($accessibleCustomers->getResourceNames() as $resourceName) {
                /** @var string $resourceName */
                
                $customer_id = str_replace("customers/","",$resourceName);
                if($customer_id == '4795273194' ){
                    $customer    = $customerServiceClient->getCustomer(ResourceNames::forCustomer($customer_id));

                    // $query = 'SELECT customer_client.client_customer, customer_client.level,'
                    //     . ' customer_client.manager, customer_client.descriptive_name,'
                    //     . ' customer_client.currency_code, customer_client.time_zone,'
                    //     . ' customer_client.id FROM customer_client WHERE customer_client.level <= 1';

                    // // Adds the root customer ID to the list of IDs to be processed.

                    // // Performs a breadth-first search algorithm to build an associative array mapping
                    // // managers to their child accounts ($customerIdsToChildAccounts).

                    // // Issues a search request by specifying page size.
                    // /** @var GoogleAdsServerStreamDecorator $stream */
                    // $googleAdsClient = (new GoogleAdsClientBuilder())
                    // ->withOAuth2Credential($oAuth2Credential)
                    // ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
                    // ->withLoginCustomerId('4795273194')
                    // // ...
                    // ->build();

                    // $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();

                    // $stream = $googleAdsServiceClient->searchStream(
                    //     $customer_id,
                    //     $query
                    // );
                    // pp($stream);
                    // // Iterates over all elements to get all customer clients under the specified customer's
                    // // hierarchy.

                    // foreach ($stream->iterateAllElements() as $googleAdsRow) {
                    //     /** @var GoogleAdsRow $googleAdsRow */
                    //     $customerClient = $googleAdsRow->getCustomerClient();
                    // }
                }

                $customer_list[] = [
                    'customer_id'       => $customer_id,
                    'descriptive_name'  => isset($customer)?$customer->getDescriptiveName():'',
                    'client_customer_id' => ''
                ];
            }
            $response['customer_list'] = $customer_list;
        }
    
    }
}
