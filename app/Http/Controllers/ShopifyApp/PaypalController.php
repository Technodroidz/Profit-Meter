<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Model\UserPaypalAccount;
use App\Model\PaypalDispute;

class PaypalController extends Controller
{
    public function redirectToProvider()
    {
        // $scopes = [
        //     'https://auth.snapchat.com/oauth2/api/user.display_name',
        //     'https://auth.snapchat.com/oauth2/api/user.bitmoji.avatar',
        //     'https://auth.snapchat.com/oauth2/api/user.external_id',
        // ];

        // $parameters = ['access_type' => 'offline'];

        $scopes = [
            'https://uri.paypal.com/services/disputes/read-buyer',

        ];
        
        return Socialite::driver('paypal_sandbox')->scopes($scopes)->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        if(!empty($request->error_description)){
            return redirect()->route('business_integration')->with('error',$request->error_description);
        }
        $user = Socialite::driver('paypal_sandbox')->user();
        // pp($user);
        $insert_array = [
            'user_id'          => Auth::User()->id,
            'paypal_id'        => $user->id,
            'token_id'         => $user->accessTokenResponseBody['id_token'],
            'token'            => $user->token,
            'refresh_token'    => $user->refreshToken,
            'expires_in'       => $user->expiresIn,
            'name'             => $user->name,
            'email'            => $user->email,
            'sub'              => $user->user['sub'],
            'paypal_email_verified' => $user->user['email_verified'],
        ];

        UserPaypalAccount::updateOrInsert(['user_id'=>Auth::User()->id],$insert_array);
        return redirect()->route('business_integration')->with('success',$user->name.' - Paypal user added.');
    }

    public function disputeList()
    {
        $paypal_account = UserPaypalAccount::where('user_id',Auth::User()->id)->first();
        $response = [];
        $response['paypal_account'] = $paypal_account;
        // $token_array = [
        //     'access_token' => $paypal_account->token,
        //     'token_type'   => 'Bearer',
        // ];
        // $provider = new PayPalClient;
        // $provider = \PayPal::setProvider();
        // $config = [
        //     'mode'             => 'sandbox',
        //     'sandbox'          => [
        //         'client_id'    => '',
        //         'client_secret'=> '',
        //         // 'app_id'       => 'APP-80W284485P519543T',
        //         'app_id'       => '',
        //     ],

        //     'payment_action'   => 'Authorization',
        //     'currency'         => 'USD',
        //     'notify_url'       => env('PAYPAL_NOTIFY_URL'),
        //     'locale'           => 'en_US',
        //     'validate_ssl'     => false,
        // ];

        // $provider->setApiCredentials($config);
        // $provider->setAccessToken($token_array);
        // $disputes = $provider->listDisputes();
        // if(isset($disputes['type']) && $disputes['type'] == 'error'){

        //     $curl = curl_init();

        //     curl_setopt_array($curl, array(
        //       CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
        //       CURLOPT_RETURNTRANSFER => true,
        //       CURLOPT_ENCODING => '',
        //       CURLOPT_MAXREDIRS => 10,
        //       CURLOPT_TIMEOUT => 0,
        //       CURLOPT_FOLLOWLOCATION => true,
        //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //       CURLOPT_CUSTOMREQUEST => 'GET',
        //       CURLOPT_POSTFIELDS => 'grantType=refreshToken&refreshToken='.$paypal_account->token,
        //       CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer '.$paypal_account->token_id,
        //         'Content-Type: application/x-www-form-urlencoded'
        //       ),
        //     ));

        //     $resp = curl_exec($curl);

        //     curl_close($curl);
        //     $resp = json_decode($resp,1);
        //     if(isset($resp['access_token'])){
        //         UserPaypalAccount::where('user_id',Auth::User()->id)->update(['token'=>$resp['access_token']]);
        //         $token_array = [
        //             'access_token' => $resp['access_token'],
        //             'token_type'   => 'Bearer',
        //         ];
        //         $provider->setAccessToken($token_array);
        //         $disputes = $provider->listDisputes();
        //         $response['disputes'] = $disputes;
        //     }
        // }else{
        //     $response['disputes'] = $disputes;
        // }
        $response['disputes'] = PaypalDispute::where('deleted_at',null)->get();
        return view('business_app/content_template/paypal_disputes_list',$response);
    }

    public function getBusinessUserPaypalInformation()
    {
        $paypal_account = UserPaypalAccount::where('user_id',Auth::User()->id)->first();
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $config = [
            'mode'             => 'sandbox',
            'sandbox'          => [
                'client_id'    => env('PAYPAL_SANDBOX_CLIENT_ID'),
                'client_secret'=> env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                // 'app_id'       => 'APP-80W284485P519543T',
                'app_id'       => '',
            ],

            'payment_action'   => 'Authorization',
            'currency'         => 'USD',
            'notify_url'       => env('PAYPAL_NOTIFY_URL'),
            'locale'           => 'en_US',
            'validate_ssl'     => true,
        ];

        $provider->setApiCredentials($config);
        $provider->getAccessToken();

        $disputes = $provider->listDisputes();
        $plans = $provider->listPlans(1,20,true);
        // $invoices = $provider->listInvoices(1,20,true);
        pp($disputes);
    }

    public function paypalApiList()
    {
        return view('business_app/content_template/paypal_api_list');
    }

    public function paypalApiDetail(Request $request)
    {

        if($request->isMethod('post')){
            $paypal_account = UserPaypalAccount::where('user_id',Auth::User()->id)->first();
            if(!empty($paypal_account)){
                $provider = new PayPalClient;
                $provider = \PayPal::setProvider();
                $config = [
                    'mode'             => 'sandbox',
                    'sandbox'          => [
                        'client_id'    => env('PAYPAL_SANDBOX_CLIENT_ID'),
                        'client_secret'=> env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                        // 'app_id'       => 'APP-80W284485P519543T',
                        'app_id'       => '',
                    ],

                    'payment_action'   => 'Authorization',
                    'currency'         => 'USD',
                    'notify_url'       => env('PAYPAL_NOTIFY_URL'),
                    'locale'           => 'en_US',
                    'validate_ssl'     => true,
                ];

                $provider->setApiCredentials($config);
                $provider->getAccessToken();

                if($request->api_url == 'disputes'){
                    $response = $provider->listDisputes();
                }
                // $plans = $provider->listPlans(1,20,true);
                // $invoices = $provider->listInvoices(1,20,true);
                pp($response);
            }else{
                return redirect()->route('paypal_api_list')->with('error','Paypal User not added');
            }
        }
        return redirect()->route('paypal_api_list');
    }
}
