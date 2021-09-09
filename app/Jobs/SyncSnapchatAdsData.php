<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Model\User;
use App\Model\UserSnapchatAccount;
use App\Model\SnapchatOrganisation;
use App\Model\SnapchatAdAccount;
use App\Model\SnapchatCampaign;
use App\Model\SnapchatInvoices;
use App\Model\SnapchatAds;

class SyncSnapchatAdsData implements ShouldQueue
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
        $api_url    = 'https://adsapi.snapchat.com/v1/me/organizations';
        $organisation_response   = $this->snapchatApiDetail($api_url);
        
        // **************** ORGANISATION *************************

        foreach ($organisation_response['organizations'] as $organisation_key => $organisation_value) {

            $organisation_table_record = SnapchatOrganisation::where('organisation_id',$organisation_value['organization']['id'])->where('deleted_at',null)->first();

            $organisation_array = [
                'organisation_id'                   => $organisation_value['organization']['id'],
                'snapchat_updated_at'               => $organisation_value['organization']['updated_at'],
                'snapchat_created_at'               => $organisation_value['organization']['created_at'],
                'name'                              => $organisation_value['organization']['name'],
                'country'                           => $organisation_value['organization']['country'],
                'postal_code'                       => $organisation_value['organization']['postal_code'],
                'locality'                          => $organisation_value['organization']['locality'],
                'contact_name'                      => $organisation_value['organization']['contact_name'],
                'contact_email'                     => $organisation_value['organization']['contact_email'],
                'tax_id'                            => $organisation_value['organization']['tax_id'],
                'address_line_1'                    => $organisation_value['organization']['address_line_1'],
                'administrative_district_level_1'   => $organisation_value['organization']['administrative_district_level_1'],
                'accepted_term_version'             => $organisation_value['organization']['accepted_term_version'],
                'marketing_optin'                   => $organisation_value['organization']['marketing_optin'],
                'contact_phone_optin'               => $organisation_value['organization']['contact_phone_optin'],
                'notifications_enabled'             => $organisation_value['organization']['configuration_settings']['notifications_enabled'],
                'type'                              => $organisation_value['organization']['type'],
                'state'                             => $organisation_value['organization']['state'],
                'my_display_name'                   => $organisation_value['organization']['my_display_name'],
                'my_invited_email'                  => $organisation_value['organization']['my_invited_email'],
                'my_member_id'                      => $organisation_value['organization']['my_member_id'],
                'createdByCaller'                   => $organisation_value['organization']['createdByCaller'],
            ];

            if(!empty($organisation_table_record)){

                $organisation_array['updated_at'] = date('Y-m-d H:i:s');
                SnapchatOrganisation::where('id',$organisation_table_record->id)->update($organisation_array);
                $organisation_table_id = $organisation_table_record->id;
            }else{
                $organisation_array['created_at'] = date('Y-m-d H:i:s');

                $organisation_table_id = SnapchatOrganisation::insertGetId($organisation_array);   
            }

            // **************** AD ACCOUNTS *************************

            $api_url    = 'https://adsapi.snapchat.com/v1/organizations/'.$organisation_value['organization']['id'].'/adaccounts';
            $ad_accounts_response   = $this->snapchatApiDetail($api_url);

            foreach ($ad_accounts_response['adaccounts'] as $ad_account_key => $ad_account_value) {

                $ad_account_table_record = SnapchatAdAccount::where('ad_account_id',$ad_account_value['adaccount']['id'])->where('deleted_at',null)->first();

                $ad_account_array = [
                    'organisation_id'                   => $organisation_table_id,
                    'ad_account_id'                     => $ad_account_value['adaccount']['id'],
                    'snapchat_updated_at'               => $ad_account_value['adaccount']['updated_at'],
                    'snapchat_created_at'               => $ad_account_value['adaccount']['created_at'],
                    'name'                              => $ad_account_value['adaccount']['name'],
                    'type'                              => $ad_account_value['adaccount']['type'],
                    'ad_account_status'                 => $ad_account_value['adaccount']['status'],
                    'currency'                          => $ad_account_value['adaccount']['currency'],
                    'timezone'                          => $ad_account_value['adaccount']['timezone'],
                    'advertiser_organization_id'        => $ad_account_value['adaccount']['advertiser_organization_id'],
                    'billing_center_id'                 => $ad_account_value['adaccount']['billing_center_id'],
                    'billing_type'                      => $ad_account_value['adaccount']['billing_type'],
                    'agency_representing_client'        => $ad_account_value['adaccount']['agency_representing_client'],
                    'client_paying_invoices'            => $ad_account_value['adaccount']['client_paying_invoices'],
                ];

                if(!empty($ad_account_table_record)){
                    $ad_account_array['updated_at'] = date('Y-m-d H:i:s');

                    SnapchatAdAccount::where('id',$ad_account_table_record->id)->update($ad_account_array);
                    $ad_account_table_id = $ad_account_table_record->id;
                }else{
                    $ad_account_array['created_at'] = date('Y-m-d H:i:s');

                    $ad_account_table_id = SnapchatAdAccount::insertGetId($ad_account_array);   
                }

                // **************** CAMPAIGNS *************************

                $api_url    = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_value['adaccount']['id'].'/campaigns';
                $campaign_response   = $this->snapchatApiDetail($api_url);

                foreach ($campaign_response['campaigns'] as $campaign_key => $campaign_value) {

                    $campaign_table_record = SnapchatCampaign::where('campaign_id',$campaign_value['campaign']['id'])->where('deleted_at',null)->first();

                    $campaign_array = [
                        'ad_account_id'                     => $ad_account_table_id,
                        'campaign_id'                       => $campaign_value['campaign']['id'],
                        'snapchat_updated_at'               => $campaign_value['campaign']['updated_at'],
                        'snapchat_created_at'               => $campaign_value['campaign']['created_at'],
                        'name'                              => $campaign_value['campaign']['name'],
                        'campaign_status'                   => $campaign_value['campaign']['status'],
                        'objective'                         => $campaign_value['campaign']['objective'],
                        'start_time'                        => $campaign_value['campaign']['start_time'],
                        'buy_model'                         => $campaign_value['campaign']['buy_model'],
                    ];

                    if(!empty($campaign_table_record)){
                        $campaign_array['updated_at'] = date('Y-m-d H:i:s');

                        SnapchatCampaign::where('id',$campaign_table_record->id)->update($campaign_array);
                        $campaign_table_id = $campaign_table_record->id;
                    }else{
                        $campaign_array['created_at'] = date('Y-m-d H:i:s');

                        $campaign_table_id = SnapchatCampaign::insertGetId($campaign_array);
                    }

                    // **************** ADS *************************

                    $api_url    = 'https://adsapi.snapchat.com/v1/campaigns/'.$campaign_value['campaign']['id'].'/ads';
                    $ads_response   = $this->snapchatApiDetail($api_url);

                    foreach ($ads_response['ads'] as $ad_key => $ad_value) {

                        $ad_table_record = SnapchatAds::where('ad_id',$ad_value['ad']['id'])->where('deleted_at',null)->first();
                        $ad_array = [
                            'campaign_id'                       => $campaign_table_id,
                            'ad_id'                             => $ad_value['ad']['id'],
                            'snapchat_updated_at'               => $ad_value['ad']['updated_at'],
                            'snapchat_created_at'               => $ad_value['ad']['created_at'],
                            'name'                              => $ad_value['ad']['name'],
                            'ad_squad_id'                       => $ad_value['ad']['ad_squad_id'],
                            'creative_id'                       => $ad_value['ad']['creative_id'],
                            'ad_status'                         => $ad_value['ad']['status'],
                            'type'                              => $ad_value['ad']['type'],
                            'render_type'                       => $ad_value['ad']['render_type'],
                            'review_status'                     => $ad_value['ad']['review_status']
                        ];

                        if(!empty($ad_table_record)){
                            $ad_array['updated_at'] = date('Y-m-d H:i:s');

                            SnapchatAds::where('id',$ad_table_record->id)->update($ad_array);
                            $ad_table_id = $ad_table_record->id;
                        }else{
                            $ad_array['created_at'] = date('Y-m-d H:i:s');

                            $ad_table_id = SnapchatAds::insertGetId($ad_array);
                        }
                        
                    }
                    
                }
            }

        }

    }

    function snapchatApiDetail($api_url)
    {
        $snapchat_account = UserSnapchatAccount::where('user_id',$this->user_id)->first();
        if(isset($snapchat_account->access_token) && isset($snapchat_account->refresh_token)){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$snapchat_account->access_token
              ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if($httpcode == 401){

                $refresh_response = refresh_snapchat_access_token($snapchat_account->refresh_token);

                UserSnapchatAccount::where('id',$snapchat_account->id)->update(['access_token' => $refresh_response['access_token'],'refresh_token'=>$refresh_response['refresh_token'],'expires_in'=>$refresh_response['expires_in']]);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $api_url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$refresh_response['access_token']
                  ),
                ));

                $response = curl_exec($curl);
                $response = json_decode($response,1);
                curl_close($curl);
            }else{
                $response = json_decode($response,1);
            }
            return $response;
        }else{
            return false;
        }
    }

    
}
