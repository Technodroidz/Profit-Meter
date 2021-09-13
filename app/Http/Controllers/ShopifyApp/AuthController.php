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
use App\Model\MultiTenantModel;
use App\Model\SubscriptionPlan;
use App\Model\UserSubscription;
use App\Model\Tenant;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\TenantsMigrateCommand;

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
                    
                    $trial_subscription = UserSubscription::getTrialSubscription(Auth::User()->id);
                    $paid_subscription  = UserSubscription::getPaidSubscription(Auth::User()->id);
                    $user_subscribed    = true;

                    if(empty($paid_subscription) && empty($trial_subscription)){
                        $user_subscribed    = false;
                    }else{
                        if(empty($paid_subscription) && !empty($trial_subscription)){
                            
                            $expire = strtotime($trial_subscription->expiry_date);
                            $today  = strtotime("today midnight");

                            if($today >= $expire){
                                $user_subscribed  = false;
                            }
                        }
                    }

                    if($user_subscribed == true){
                        session()->put('user_subscribed',true);
                        return redirect()->route('home');
                    }else{
                        session()->put('user_subscribed',false);
                        session()->put('error', '<p>You plan has been expired.<a style="color: blue" href ="'.route('business_setting_upgrade_plan').'" >Subscribe</a> to use our services</p>');
                        return redirect()->route('business_setting_account');
                    }
                }else{
                    return back()->with('error', 'Invalid Login Credentials.');       
                }
            }
        }
        $data['shopify_form_type'] = 'login_with_shopify';
        
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
                    $message->subject('Reset Your Profit-Meter Password');
                });

                return back()->with('success', 'We have e-mailed your password reset link!');
            }
        }
        return view('business_app/auth_template/forgot_password');
    }

    public function resetPassword($token='')
    {
        $validation_content = ['token'=> $token];
        $validation_array = [
            'token' => 'required|exists:password_resets',
        ];
        $validator = Validator::make($validation_content, $validation_array);
        
        if($validator->fails()){
            $token = '';
        }

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

            return redirect()->route('login')->with('success', 'Your password has been changed!');
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

                $user_id        = User::insertGetId($data);
                $credentials    = $request->only('email', 'password');

                $long_token     = generateStringLogToken();
                $short_token    = generateStringSortToken();
              
                $userName = 'business_user_database_'.$user_id;  // Your Database name to be created

                DB::statement("CREATE DATABASE $userName");

                $conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD') , $userName);
                $query = '';

                $sqlScript = public_path('db/dummy.sql');
    
                $sqlScript = file($sqlScript);
               
                foreach ($sqlScript as $line){
                    
                    $startWith = substr(trim($line), 0 ,2);
                    $endWith = substr(trim($line), -1 ,1);
                    
                    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                        continue;
                    }

                    $query = $query . $line;
                    if ($endWith == ';') {
                        mysqli_query($conn,$query);
                        $query= '';
                    }
                }

                User::where('id',$user_id)->update(['database_name' => $userName]);

                $tenant = Tenant::find($user_id);
                if(!empty($tenant->database_name)){
                    $tenant->configure()->use();

                    $options = ['--force' => true,'--path'=>'/database/migrations/tenant_migrations','--database'=> 'tenant'];

                    Artisan::call(
                        'migrate',
                        $options
                    );
                }

                if(Auth::attempt($credentials)){

                    $trial_plan = SubscriptionPlan::getTrialPlan();
                    $insert_array = [
                        'user_id'       => $user_id,
                        'plan_name'     => $trial_plan->package_name,
                        'plan_amount'   => $trial_plan->package_amount,
                        'plan_duration' => $trial_plan->package_duration,
                        'expiry_date'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$trial_plan->package_duration.' days')),
                        'is_trial'      => 1,
                        'created_at'    => date('Y-m-d H:i:s'),
                    ];

                    UserSubscription::insert($insert_array);

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
        $data = [];
        if($request->isMethod('post')){

            if($request->shopify_form_type == 'connect_with_shopify'){
                $validation_array = [
                    'shop_url'      => 'required|regex:(.myshopify.com)|unique:users,shopify_url',
                ];
            }else{
                $validation_array = [
                    'shop_url'      => 'required|regex:(.myshopify.com)',
                ];
            }

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
        $data['shopify_form_type'] = 'connect_with_shopify';
        return view('business_app/auth_template/connect_with_shopify',$data);
    }

    public function authenticate(Request $request)
    {
        $return = false;
        $user_id;
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
                $user_id = Auth::User()->id;
                $return = true;
                
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

                    // $credentials = ['email'=>$shop_exist->email,'shopify_url'=>$shop_exist->shop];
                    $user_id = $shop_exist->id;

                    if(Auth::loginUsingId($shop_exist->id)){
                        $return = true;
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

                    $user_id = User::insertGetId($data);
                    // $credentials = ['shopify_url'=>$shop['domain']];

                    if(Auth::loginUsingId($user_id)){
                        $return = true;
                    }
                }

            }
            if($return == true){
                $trial_plan = SubscriptionPlan::getTrialPlan();
                $insert_array = [
                    'user_id'       => $user_id,
                    'plan_name'     => $trial_plan->package_name,
                    'plan_amount'   => $trial_plan->package_amount,
                    'plan_duration' => $trial_plan->package_duration,
                    'expiry_date'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$trial_plan->package_duration.' days')),
                    'is_trial'      => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                ];

                UserSubscription::insertOrUpdate(['user_id'=>$user_id],$insert_array);
                return redirect()->route('home');
            }
        }
        Auth::logout();
        return redirect()->route('login')->with('error', 'Invalid Request.');
    }

    public function logout(Request $request)
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
