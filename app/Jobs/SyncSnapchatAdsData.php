<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        
        $api_url    = 'https://adsapi.snapchat.com/v1/me/organizations';
        $organisation_response   = $this->snapchatApiDetail($api_url);
        
        $api_url    = 'https://adsapi.snapchat.com/v1/organizations/'.$organization_id.'/adaccounts';
        $ad_accounts_response   = $this->snapchatApiDetail($api_url);
    
        $api_url    = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/invoices';
        $ad_account_invoices   = $this->snapchatApiDetail($api_url);
        
        $api_url    = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/campaigns';
        $campaign_response   = $this->snapchatApiDetail($api_url);
    
        $api_url    = 'https://adsapi.snapchat.com/v1/campaigns/'.$campaign_id.'/ads';
        $ads_response   = $this->snapchatApiDetail($api_url);
        
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
