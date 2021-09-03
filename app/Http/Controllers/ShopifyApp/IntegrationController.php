<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserGoogleAccount;
use App\Model\UserPaypalAccount;
use App\Model\UserFacebookAccount;
use App\Model\UserSnapchatAccount;
use App\Model\UserStripeAccount;
use App\Exceptions\AppException;
use Auth;
use Illuminate\Support\Facades\Validator;

class IntegrationController extends Controller
{
    public function integration(Request $request)
    {
        $google_account = UserGoogleAccount::getGoogleAccountByUserid(Auth::User()->id);
        $paypal_account_creds = UserPaypalAccount::where('user_id',Auth::User()->id)->first();
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();
        $snapchat_account = UserSnapchatAccount::where('user_id',Auth::User()->id)->first();
        $stripe_account = UserStripeAccount::where('user_id',Auth::User()->id)->first();

        $data = ['current_link' => 'integration','google_account' => $google_account,'paypal_account' => $paypal_account_creds,'facebook_account' => $facebook_account,'snapchat_account' => $snapchat_account,'stripe_account' => $stripe_account];
        
        return view('business_app/content_template/integration',$data);
    }

    public function updateGoogleAdsSettings(Request $request)
    {
        if($request->isMethod('post')){

            $validation_array = [
                'customer_id'      => 'required',            
                'developer_token'  => 'required'         
            ];

            $validation_attributes = [
                'customer_id'                      => 'Customer ID',
                'developer_token'                  => 'Developer Token'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);   
            }else{
                $insert_array = [
                    'google_ads_customer_id'       => $request->customer_id,
                    'google_ads_developer_token'   => $request->developer_token,
                ];
                
                UserGoogleAccount::where('user_id',Auth::User()->id)->update($insert_array);

                $google_account = UserGoogleAccount::getGoogleAccountByUserid(Auth::User()->id);
                $data = ['current_link' => 'integration','google_account' => $google_account];
                
                $html_view = view('business_app/ajax_template/google_app_integration',$data)->render();

                $json_array = ['close_modal' => true,'replace_html' => true,'html_view' => $html_view];
                return response()->data($json_array);
            }
        }

        return response()->routeNotFound();
    }

    public function updatePaypalApiSettings(Request $request)
    {
        if($request->isMethod('post')){

            $validation_array = [
                'mode'                      => 'required',
                'sandbox_client_id'         => 'required',
                'sandbox_client_secret'     => 'required',
                'live_client_id'            => 'required',
                'live_client_secret'        => 'required',
            ];

            $validation_attributes = [
                'mode'                      => 'Mode',
                'sandbox_client_id'         => 'Sandbox Client ID',
                'sandbox_client_secret'     => 'Sandbox Client Secret',
                'live_client_id'            => 'Live Client ID',
                'live_client_secret'        => 'Live Client Secret',
            ];
            
            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $insert_array = [
                    'user_id'               => Auth::User()->id,
                    'mode'                  => $request->mode,
                    'sandbox_client_id'     => $request->sandbox_client_id,
                    'sandbox_client_secret' => $request->sandbox_client_secret,
                    'live_client_id'        => $request->live_client_id,
                    'live_client_secret'    => $request->live_client_secret,
                    'payment_action'        => 'Authorization',
                    'currency'              => 'USD',
                    'invoice_prefix'        => 'paypal_invoice',
                ];
                
                UserPaypalAccount::updateOrInsert(['user_id' => Auth::User()->id],$insert_array);

                $data = ['current_link' => 'integration'];
                
                // $html_view = view('business_app/ajax_template/google_app_integration',$data)->render();

                // $json_array = ['close_modal' => true,'replace_html' => false,'html_view' => $html_view];
                $json_array = ['close_modal' => true,'replace_html' => false,'redirect_url' => route('get_business_user_paypal_information')];
                return response()->data($json_array,'Paypal OAuth Credentials Updated.');
            }
        }

        return response()->routeNotFound();
    }
}
