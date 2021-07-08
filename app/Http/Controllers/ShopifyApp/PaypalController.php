<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Model\UserPaypalAccount;

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
        
        return Socialite::driver('paypal_sandbox')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('paypal_sandbox')->user();
        dd($user);
    }

    public function getBusinessUserPaypalInformation()
    {
        $paypal_account = UserPaypalAccount::where('user_id',Auth::User()->id)->first();
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $config = [
            'mode'             => $paypal_account->mode,
            'sandbox'          => [
                'client_id'    => $paypal_account->sandbox_client_id,
                'client_secret'=> $paypal_account->sandbox_client_secret,
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
                    'mode'             => $paypal_account->mode,
                    'sandbox'          => [
                        'client_id'    => $paypal_account->sandbox_client_id,
                        'client_secret'=> $paypal_account->sandbox_client_secret,
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
