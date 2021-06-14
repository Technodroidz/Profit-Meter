<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPShopify\ShopifySDK;
use App\Model\User;
use Redirect;
use Mail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [];
        if($request->isMethod('post')){
            $validation_array = [
                'email'         => 'required|email',
                'password'      => 'required'
            ];

            $validation_attributes = [
                'email'                                 => 'Email',
                'password'                              => 'Password',
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{

                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    
                    return redirect()->route('home');
                }else{
                    return back()->with('error', 'Invalid Login Credentials.');       
                }
            }
        }
        
        return view('business_app/auth_template/login',$data);
    }
    
    public function forgotPassword(Request $request)
    {

        if($request->isMethod('post')){

            $validation_array = [
                'email' => 'required|email|exists:users',
            ];

            $validation_attributes = [
                'email'   => 'Email',
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{

                $token = Str::random(64);

                DB::table('password_resets')->insert(
                    ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
                );

                Mail::send('business_app/email_template/forgot_password_email', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Reset Password Notification');
                });

                return back()->with('success', 'We have e-mailed your password reset link!');
            }
        }
        return view('business_app/auth_template/forgot_password');
    }

    public function resetPassword($token='')
    {
        return view('business_app/auth_template/reset_password',['token' => $token]);
    }

    public function updateResetPassword(Request $request)
    {

        $validation_array = [
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required|exists:password_resets'
        ];

        $validation_attributes = [
            'password'              => 'Password',
            'password_confirmation' => 'Confirm Password',
            'token'                 => 'Token',
        ];

        $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
        $validation_message   = get_message_from_validator_object($validator->errors());

        if($validator->fails()){
            return back()->with('error', $validation_message);       
        }else{
            $updatePassword = DB::table('password_resets')
                              ->where(['token' => $request->token])
                              ->first();

            if(!$updatePassword)
                return back()->withInput()->with('error', 'Invalid token!');

            $user = User::where('email', $updatePassword->email)->update(['password' => bcrypt($request->password)]);

            DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

            return redirect()->route('login')->with('message', 'Your password has been changed!');
        }
    }

    public function register(Request $request)
    {
        $data = [];
        if($request->isMethod('post')){
            $validation_array = [
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|min:6',
                'confirm_password' => 'same:password'
            ];

            $validation_attributes = [
                'first_name'    => 'First Name',
                'last_name'     => 'Last Name',
                'email'         => 'Email',
                'password'      => 'Password'
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{
                $data = [
                    'name'      => $request->first_name,
                    'last_name' => $request->last_name,
                    'email'     => $request->email,
                    'password'  => bcrypt($request->password)
                ];

                User::insert($data);
                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    return redirect()->route('connect_shopify_account');
                }else{
                    return back()->with('error', 'Invalid Login Credentials.');       
                }
            }
        }
        return view('business_app/auth_template/register');
    }

    public function loginWithShopify(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'shop_url'      => 'required|unique:users,shopify_url',
            ];

            $validation_attributes = [
                'shop_url'      => 'Shop Url',
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{
                $config = array(
                    'ShopUrl'   => $request->shop_url,
                    'ApiKey'    => env('SHOPIFY_API_KEY'),
                    'SharedSecret'  => env('SHOPIFY_API_SECRET'),
                );
                
                \PHPShopify\ShopifySDK::config($config);

                // Scopes names to access the respective apis.
                $scopes = [
                    'read_content',
                    'read_themes',
                    'read_product_listings',
                    'read_products',
                    'read_customers',
                    'read_orders',
                    'read_draft_orders',
                    'read_inventory',
                    'read_locations',
                    'read_script_tags',
                    'read_fulfillments',
                    'read_assigned_fulfillment_orders',
                    'read_merchant_managed_fulfillment_orders',
                    'read_third_party_fulfillment_orders',
                    'read_shipping',
                    'read_gift_cards',
                    'read_checkouts',
                    'read_reports',
                    'read_price_rules',
                    'read_discounts',
                    'read_marketing_events',
                    'read_resource_feedbacks',
                    'read_shopify_payments_payouts',
                    'read_shopify_payments_disputes',
                    'read_translations',
                    'read_locales',
                    'read_script_tags',
                ]; 

                $redirectUrl = route('authenticate');

                $auth_url = \PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl, null, null, true);

                if(!empty($auth_url)){
                    return redirect()->away($auth_url);
                }else{
                    return back()->with('error', 'Invalid Shop Url.');
                }
            }
        }
        return view('business_app/auth_template/connect_with_shopify');
    }

    public function authenticate(Request $request)
    {
        if(!empty($request->shop)){

            $user = Auth::User();
            if(Auth::User()){
                if(empty(Auth::User()->shopify_access_token)){
                    $config = array(
                        'ShopUrl'   => $request->shop,
                        'ApiKey'    => env('SHOPIFY_API_KEY'),
                        'SharedSecret'  => env('SHOPIFY_API_SECRET'),
                    );

                    \PHPShopify\ShopifySDK::config($config);
                    $accessToken = \PHPShopify\AuthHelper::getAccessToken();

                    $user->shopify_access_token = $accessToken;
                }else{
                    $user->shopify_access_token = $user->shopify_access_token;
                }

                $user->shopify_url = $request->shop;
                $user->save();
                return redirect()->route('home');
            }else{
                $shop_exist = User::getShopByUrl($request->shop);

                if(!empty($shop_exist)){
                    if(empty($shop_exist->shopify_access_token)){
                        $config = array(
                            'ShopUrl'   => $request->shop,
                            'ApiKey'    => env('SHOPIFY_API_KEY'),
                            'SharedSecret'  => env('SHOPIFY_API_SECRET'),
                        );

                        \PHPShopify\ShopifySDK::config($config);
                        $accessToken = \PHPShopify\AuthHelper::getAccessToken();
                        User::updateByShopUrl($request->shop,['shopify_access_token'=>$accessToken]);
                    }

                    $credentials = ['email'=>$shop_exist->email,'shopify_url'=>$shop_exist->shop];

                    if(Auth::attempt($credentials)){
                        return redirect()->route('home');
                    }
                }else{

                    $config = array(
                        'ShopUrl'   => $request->shop,
                        'ApiKey'    => env('SHOPIFY_API_KEY'),
                        'SharedSecret'  => env('SHOPIFY_API_SECRET'),
                    );

                    \PHPShopify\ShopifySDK::config($config);
                    $accessToken = \PHPShopify\AuthHelper::getAccessToken();

                    $config = array(
                        'ShopUrl' => $request->shop,
                        'AccessToken' => $accessToken,
                    );
                    $shopify    = new \PHPShopify\ShopifySDK($config);
                    
                    $shop = $shopify->Shop->get();

                    $data = [
                        'name'      => $shop['name'],
                        // 'email'     => $shop['email'],
                        'password'  => '',
                        'shopify_url'           => $request->shop,
                        'shopify_access_token'  => $accessToken,
                    ];

                    User::insert($data);
                    $credentials = ['shopify_url'=>$shop['domain']];
                    if(Auth::attempt($credentials)){
                        return redirect()->route('home');
                    }
                }

            }
        }
        Auth::logout();
        return redirect()->route('login')->with('error', 'Invalid Request.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
