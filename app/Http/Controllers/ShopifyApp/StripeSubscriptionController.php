<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Products;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
use App\Model\SubscriptionPlan;
use App\Model\StripeProduct;
use App\Model\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ExceptionInterface;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class StripeSubscriptionController extends Controller
{
    public function payment(Request $request){
        if($request->isMethod('post')){
            $validation_array = [
                'subscription_id'   => 'required',            
                'stripeToken'       => 'required'      
            ];

            $validation_attributes = [
                'subscription_id'  => 'Subscription Plan',
                'stripeToken'      => 'Stripe Payment Request'
            ];

            $validation_message = [
                'subscription_id.required' => 'Please choose a subscription Plan.',
                'stripeToken.required'     => 'Unauthorised Payment request.Fill Card Details'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $subscription_plan = SubscriptionPlan::getSubscriptionPlanById($request->subscription_id);

                $user_subscription = UserSubscription::where('user_id',Auth::User()->id)->where('plan_id',$subscription_plan->id)->where('subscription_status','active')->first();

                if(!empty($user_subscription)){
                    throw new AppException('User Is Already Subscribed to this Plan.');
                }


                $publishableKey = 'pk_test_51HuWQHJRRrJp7PIAIkuAgvuEWXj9CwiwwVl9YPSBPZIp87M0WTFZD8VuAFIhb3thCG0hF5mF6poVsmlt3IEiOftq00CKI0k6WY';
                $secreatekey    = env('STRIPE_SECRET');
                
                \Stripe\Stripe::setApiKey($secreatekey);

                $user = Auth::User();
                \Stripe\Stripe::setVerifySslCerts(false);
        
                $token  = $_POST['stripeToken'];
                
                $stripe = new \Stripe\StripeClient($secreatekey);

                
                $another_subscription = UserSubscription::where('user_id',Auth::User()->id)->where('plan_id','!=',$subscription_plan->id)->where('subscription_status','active')->first();

                if(!empty($another_subscription)){
                    if($another_subscription->payment_gateway == 'stripe'){
                        $stripe->subscriptions->cancel(
                          $another_subscription->stripe_subscription_id,
                          []
                        );

                        UserSubscription::where('id',$another_subscription->id)->update(['subscription_status'=>'cancelled','stripe_subscription_status'=>'cancelled']);
                    }elseif($another_subscription->payment_gateway == 'paypal'){
                        $provider = new PayPalClient;
                        $provider = \PayPal::setProvider();
                        $config = [
                            'mode'             => 'sandbox',
                            'sandbox'          => [
                                'client_id'    => env('PAYPAL_SANDBOX_CLIENT_ID'),
                                'client_secret'=> env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                                'app_id'       => 'APP-80W284485P519543T',
                            ],

                            'payment_action'   => 'Sale',
                            'currency'         => 'USD',
                            'notify_url'       => env('PAYPAL_NOTIFY_URL'),
                            'locale'           => 'en_US',
                            'validate_ssl'     => true,
                        ];

                        $provider->setApiCredentials($config);
                        $provider->getAccessToken();

                        $provider->cancelSubscription($another_subscription->paypal_subscription_id,'Upgrading Plan');
                        UserSubscription::where('id',$another_subscription->id)->update(['subscription_status'=>'cancelled','paypal_subscription_status'=>'CANCELLED']);
                    }

                }
            
                if(isset($_POST['stripeToken'])){

                    $user = User::getUserById($user->id);

                    if(empty($user->stripe_customer_id)){

                        $customer=\Stripe\Customer::create(array(
                            "email"     => $user->email,
                            "name"      => $user->name.' '.$user->last_name,
                            'address' => [
                                'line1' => '510 Townsend St',
                                'postal_code' => '98140',
                                'city' => 'San Francisco',
                                'state' => 'CA',
                                'country' => 'US',
                            ],
                            "source"    => $token,
                            "metadata"  => ['user_id' => $user->id,'shopify_url'=> $user->shopify_url, 'subscription_id' => $request->subscription_id, 'user_details'=>'User Created While subscribing to plan "'.$request->subscription_name.'"']
                        ));

                        $stripe_customer_id = $customer->id;
                        User::updateById(Auth::User()->id,['stripe_customer_id'=> $stripe_customer_id]);
                    }else{
                        $stripe_customer_id = $user->stripe_customer_id;
                    }
                            
                    $stripe_product = StripeProduct::first();

                    if(empty($stripe_product)){
                        $product = \Stripe\Product::create(array( 
                          'name' => 'Profitrack',
                          'description' => 'Shopify External App(SAAS)'
                        )); 

                        $insert_array = [
                            'product_id'    => $product->id,
                            'name'          => $product->name,
                            'description'   => isset($product->description)?$product->description:'',
                            'active'        => $product->active,
                            'live_mode'     => $product->live_mode,
                            'type'          => $product->type,
                            'created'       => $product->created,
                            'updated'       => $product->updated,
                            'created_at'    => date('Y-m-d H:i:s')
                        ];

                        StripeProduct::insert($insert_array);
                        $stripe_product_id = $product->id;
                    }else{
                        $stripe_product_id = $stripe_product->product_id;
                    }


                    if(empty($subscription_plan->stripe_price_id)){
                    
                        $price = \Stripe\Price::create([
                          'product' => $stripe_product_id,
                          'nickname'=> $subscription_plan->package_name,
                          'unit_amount' => $subscription_plan->package_amount * 100, // in cents or paise
                          'currency' => 'usd',
                          'recurring' => [
                            'interval' => 'day',
                            'interval_count'=> $subscription_plan->package_duration,
                          ]
                        ]);

                        $stripe_price_id = $price->id;

                        SubscriptionPlan::where('id',$subscription_plan->id)->update(['stripe_price_id' => $stripe_price_id]);
                    }else{
                        $stripe_price_id = $subscription_plan->stripe_price_id;
                    }

                    try {
                        $subscription = \Stripe\Subscription::create(array( 
                            "customer" => $stripe_customer_id,
                            "items" => array( 
                                array( 
                                    "price" => $stripe_price_id,
                                ), 
                            ), 
                        ));
                        
                        $user_subscription_array = [
                            'user_id'                   => Auth::User()->id,
                            'plan_id'                   => $subscription_plan->id,
                            'stripe_price_id'           => $stripe_price_id,
                            'stripe_subscription_id'    => $subscription->id,

                            'plan_name'                 => $subscription_plan->package_name,
                            'plan_amount'               => $subscription_plan->package_amount,
                            'plan_duration'             => $subscription_plan->package_duration,
                            'expiry_date'               => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$subscription_plan->package_duration.' days')),
                            'is_trial'                  => 0,
                            'stripe_subscription_status'=> $subscription->status,
                            'subscription_status'       => 'active',
                            'payment_gateway'           => 'stripe',
                            'created_at'                => date('Y-m-d H:i:s'),
                        ];
                        UserSubscription::insert($user_subscription_array); 
                    }
                    catch(ExceptionInterface $e) {
                        $error1 = $e->getMessage();
                        throw new AppException($error1);
                    }



                    // OLD CODE

                        // $plan = \Stripe\Plan::create(array( 
                        //     "product" => [ 
                        //         "name" => $subscription_plan->package_name,
                        //     ], 
                        //     'amount' => $subscription_plan->package_amount,
                        //     'currency' => 'USD',
                        //     'interval' => 'day',
                        //     'product' =>'prod_Jenzbm8rTI8WaF',
                        // ));
                           
                    
                          
                        // $stripe->subscriptions->create([
                        //   'customer' => 'cus_JGOc1ajeXLyFz3',
                        //   'items' => [
                        //     ['price' => 'price_1IdrgVSHFFWWRCsFKQUMxeVr'],
                        //   ],
                        // ]);
                        
                        //     echo '<pre>';
                        //      print_r($stripe->products->all(['limit' => 3]));
                        //      exit;
                        //     $data = $stripe->subscriptions->create([
                        //       'customer' => 'cus_JGOAd2SjRiUNRn',
                        //       'items' => [
                        //         ['price' => 'price_1Idbg3SHFFWWRCsFQ6uuaYYS'],
                        //       ],
                        //     ]);
                
                        //$list = $stripe->subscriptions->all(['limit' => 3]);

                        // try {
                        //     $data=\Stripe\Charge::create(array(
                        //         "amount"        => $subscription_plan->package_amount,
                        //         "currency"      => "usd",
                        //         "description"   => 'Subscribe to Plan "'.$subscription_plan->package_name.'"',
                        //         "customer"      => $stripe_customer_id,
                        //         "metadata"      => ['user_id' => $user->id, 'package_id' => $subscription_plan->id, 'package_details' => '']
                        //     ));
                        // }
                        // catch(ExceptionInterface $e) {
                        //     $error1 = $e->getMessage();
                        //     throw new AppException($error1);
                        // }

                    // OLD CODE/
                    
                    session()->flash('success', 'Subscription Payment Successful for Your Plan '.$subscription_plan->package_name);
                    session()->put('user_subscribed',true);
                    session()->forget('error');
                    $json_array = ['close_modal' => true,'reload'=>true];
                    return response()->data($json_array,'Subscription Payment Successful for Your Plan '.$subscription_plan->package_name);
                }
            }
        }
        return response()->routeNotFound();
    
    }
}
