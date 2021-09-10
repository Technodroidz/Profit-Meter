<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Model\UserGoogleAccount;
use App\Model\GoogleAdCustomerId;
use App\Model\GoogleAdCampaigns;
use App\Model\User;
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
        makeDBConnection(User::find($this->user_id)->database_name);
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
                }

                $customer_list[] = [
                    'customer_id'           => $customer_id,
                    'descriptive_name'      => isset($customer)?$customer->getDescriptiveName():'',
                    'client_customer_id'    => ''
                ];

                $google_ad_customer = GoogleAdCustomerId::where('customer_id',$customer_id)->where('deleted_at',null)->first();
                if(!empty($google_ad_customer)){
                    $update_array = [
                        'customer_id'   => $customer_id,
                        'name'          => isset($customer) ? $customer->getDescriptiveName():'',
                        'updated_at'    => date('Y-m-d H:i:s')
                    ];

                    GoogleAdCustomerId::where('id',$google_ad_customer->id)->update($update_array);
                    $google_customer_id = $google_ad_customer->id;
                }else{
                    $insert_array = [
                        'customer_id'   => $customer_id,
                        'name'          => isset($customer) ? $customer->getDescriptiveName():'',
                        'created_at'    => date('Y-m-d H:i:s')
                    ];

                    $google_customer_id = GoogleAdCustomerId::insertGetId($insert_array);   
                }

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://www.googleapis.com/oauth2/v3/token',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'grant_type=refresh_token&client_id='.env('GOOGLE_CLIENT_ID').'&client_secret='.env('GOOGLE_CLIENT_SECRET').'&refresh_token='.$google_account->refresh_token,
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $response = json_decode($response,1);

                if(isset($response['access_token'])){
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://googleads.googleapis.com/v8/customers/6325332442/googleAds:searchStream',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                        "query":"SELECT campaign.id, campaign.name,campaign.status,metrics.clicks,metrics.impressions,metrics.cost_micros FROM campaign ORDER BY campaign.id"
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer '.$response['access_token'],
                        'developer-token: '.env('GOOGLE_ADS_DEVELOPER_TOKEN'),
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'login-customer-id: '.$customer_id
                      ),
                    ));

                    $campaign_response = curl_exec($curl);

                    curl_close($curl);
                    $campaign_response = json_decode($campaign_response,1);
                    
                    if(isset($campaign_response[0]['results']) && !empty($campaign_response[0]['results'])){

                        $campaign_list = $campaign_response[0]['results'];

                        foreach ($campaign_list as $key => $value) {

                            $google_ad_campaign = GoogleAdCampaigns::where('campaign_id',$value['campaign']['id'])->where('deleted_at',null)->first();

                            if(!empty($google_ad_campaign)){

                                $update_array = [
                                    'google_ad_customer_id'     => $google_customer_id,
                                    'campaign_resource_name'    => $value['campaign']['resourceName'],
                                    'campaign_status'           => $value['campaign']['status'],
                                    'campaign_name'             => $value['campaign']['name'],
                                    'campaign_id'               => $value['campaign']['id'],
                                    'metrics_clicks'            => $value['metrics']['clicks'],
                                    'cost_micros'               => $value['metrics']['costMicros'],
                                    'impressions'               => $value['metrics']['impressions'],
                                    'updated_at'                => date('Y-m-d H:i:s')
                                ];

                                GoogleAdCampaigns::where('id',$google_ad_campaign->id)->update($update_array);
                            }else{

                                $insert_array = [
                                    'google_ad_customer_id'     => $google_customer_id,
                                    'campaign_resource_name'    => $value['campaign']['resourceName'],
                                    'campaign_status'           => $value['campaign']['status'],
                                    'campaign_name'             => $value['campaign']['name'],
                                    'campaign_id'               => $value['campaign']['id'],
                                    'metrics_clicks'            => $value['metrics']['clicks'],
                                    'cost_micros'               => $value['metrics']['costMicros'],
                                    'impressions'               => $value['metrics']['impressions'],
                                    'created_at'                => date('Y-m-d H:i:s')
                                ];

                                GoogleAdCampaigns::insertGetId($insert_array);   
                            }
                        }
                    }
                }   
            }   
        }
    }
}
