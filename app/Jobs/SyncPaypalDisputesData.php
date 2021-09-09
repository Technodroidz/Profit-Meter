<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Model\UserPaypalAccount;
use App\Model\User;
use App\Model\PaypalDispute;

class SyncPaypalDisputesData implements ShouldQueue
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
        $paypal_account = UserPaypalAccount::where('user_id',$this->user_id)->first();
        $response = [];
        $response['paypal_account'] = $paypal_account;
        $token_array = [
            'access_token' => $paypal_account->token,
            'token_type'   => 'Bearer',
        ];
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $config = [
            'mode'             => 'sandbox',
            'sandbox'          => [
                'client_id'    => '',
                'client_secret'=> '',
                // 'app_id'       => 'APP-80W284485P519543T',
                'app_id'       => '',
            ],

            'payment_action'   => 'Authorization',
            'currency'         => 'USD',
            'notify_url'       => env('PAYPAL_NOTIFY_URL'),
            'locale'           => 'en_US',
            'validate_ssl'     => false,
        ];

        $provider->setApiCredentials($config);
        $provider->setAccessToken($token_array);
        $disputes = $provider->listDisputes();
        if(isset($disputes['type']) && $disputes['type'] == 'error'){

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_POSTFIELDS => 'grantType=refreshToken&refreshToken='.$paypal_account->token,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$paypal_account->token_id,
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response,1);
            if(isset($response['access_token'])){
                UserPaypalAccount::where('user_id',Auth::User()->id)->update(['token'=>$response['access_token']]);
                $token_array = [
                    'access_token' => $response['access_token'],
                    'token_type'   => 'Bearer',
                ];
                $provider->setAccessToken($token_array);
                $disputes = $provider->listDisputes();
                $response['disputes'] = $disputes;
            }
        }else{
            $response['disputes'] = $disputes;
        }

        if(isset($response['disputes']['items']) && !empty($response['disputes']['items'])){
            foreach ($response['disputes']['items'] as $key => $value) {
                
                $paypal_dispute = PaypalDispute::where('dispute_id',$value['dispute_id'])->where('deleted_at',null)->first();

                if(!empty($paypal_dispute)){
                    $update_array = [
                        'dispute_id'                    => $value['dispute_id'],
                        'create_time'                   => $value['create_time'],
                        'update_time'                   => $value['update_time'],
                        'reason'                        => $value['reason'],
                        'dispute_status'                => $value['status'],
                        'dispute_state'                 => $value['dispute_state'],
                        'dispute_amount_currency_code'  => $value['dispute_amount']['currency_code'],
                        'dispute_amount_value'          => $value['dispute_amount']['value'],
                        'dispute_life_cycle_stage'      => $value['dispute_life_cycle_stage'],
                        'updated_at'                    => date('Y-m-d H:i:s')
                    ];

                    PaypalDispute::where('id',$paypal_dispute->id)->update($update_array);
                    $paypal_dispute_id = $paypal_dispute->id;
                }else{
                    $insert_array = [
                        'dispute_id'                    => $value['dispute_id'],
                        'create_time'                   => $value['create_time'],
                        'update_time'                   => $value['update_time'],
                        'reason'                        => $value['reason'],
                        'dispute_status'                => $value['status'],
                        'dispute_state'                 => $value['dispute_state'],
                        'dispute_amount_currency_code'  => $value['dispute_amount']['currency_code'],
                        'dispute_amount_value'          => $value['dispute_amount']['value'],
                        'dispute_life_cycle_stage'      => $value['dispute_life_cycle_stage'],
                        'created_at'    => date('Y-m-d H:i:s')
                    ];

                    $paypal_dispute_id = PaypalDispute::insertGetId($insert_array);   
                }
            }

        }
    }
}
