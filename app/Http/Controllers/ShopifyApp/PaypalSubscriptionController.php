<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Srmklive\PayPal\Services\AdaptivePayments;
// use Srmklive\PayPal\Services\ExpressCheckout;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Model\PaypalProduct;
use App\Model\SubscriptionPlan;
use App\Model\UserSubscription;
use App\Model\User;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Products;
use Stripe\Exception\ExceptionInterface;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalSubscriptionController extends Controller
{

    public function initiateSubscription(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'subscription_id'   => 'required', 
            ];

            $validation_attributes = [
                'subscription_id'  => 'Subscription Plan'
            ];

            $validation_message = [
                'subscription_id.required' => 'Please choose a subscription Plan.'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $subscription_plan = SubscriptionPlan::getSubscriptionPlanById($request->subscription_id);
                $user = User::getUserById(Auth::User()->id);

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

                $paypal_product = PaypalProduct::first();

                if(empty($paypal_product)){
                    $create_product_array = [
                        'name'       => 'Profitrack SAAS',
                        'description'=> 'Shopify External App',
                        'type'       => 'SERVICE',
                        'category'   => 'SOFTWARE',
                        // 'image_url'  => '',
                        // 'home_url'   => 'https://citrixcrm.'
                    ];

                    $product = $provider->createProduct($create_product_array,'PRODUCT-'.date('Ymd-His'));
                    
                    $insert_array = [
                        'product_id' => $product['id'],
                        'name'       => $product['name'],
                        'description'=> isset($product['description'])?$product['description']:'',
                        'type'       => $create_product_array['type'],
                        'category'   => $create_product_array['category'],
                        'image_url'  => isset($product['image_url'])?$product['image_url']:'',
                        'home_url'   => isset($product['home_url'])?$product['home_url']:'',
                        'create_time'=> isset($product['create_time'])?$product['create_time']:'',
                        'update_time'=> isset($product['update_time'])?$product['update_time']:'',
                        'links'      => isset($product['links'])?json_encode($product['links']):'',
                    ];
                    PaypalProduct::insert($insert_array);
                    $product_id = $product['id'];
                }else{
                    $product_id = $paypal_product->product_id;
                }

                if(empty($subscription_plan->paypal_plan_id)){
                    
                    $plan_array = [
                        'product_id'        => $product_id,
                        'name'              => $subscription_plan->package_name,
                        'description'       => $subscription_plan->short_decription,
                        'status'            => 'ACTIVE',
                        'billing_cycles'    => [
                            // [
                            //     'frequency' => [
                            //         'interval_unit' => 'MONTH',
                            //         'interval_count'=> 1
                            //     ],
                            //     'tenure_type'   => 'TRIAL',
                            //     'sequence'      => 1,
                            //     'total_cycles'  => 2,
                            //     'pricing_scheme'=> [
                            //         'fixed_price' => [
                            //             'value'            => 3,
                            //             'currency_code'    => 'USD'
                            //         ]
                            //     ]

                            // ],   
                            // [
                            //     'frequency'  => [
                            //         'interval_unit'        => 'MONTH',
                            //         'interval_count'       => 1
                            //     ],
                            //     'tenure_type'                  => 'TRIAL',
                            //     'sequence'                     => 2,
                            //     'total_cycles'                 => 3,
                            //     'pricing_scheme'               => [
                            //         'fixed_price'  => [
                            //             'value'        => 6,
                            //             'currency_code'=> 'USD'
                            //         ]
                            //     ]

                            // ],
                            [
                                'frequency'                    => [
                                    'interval_unit'        => 'DAY',
                                    'interval_count'       => $subscription_plan->package_duration
                                ],
                                'tenure_type'                  => 'REGULAR',
                                'sequence'                     => 1,
                                'total_cycles'                 => 0,
                                'pricing_scheme'               => [
                                    'fixed_price'          => [
                                        'value'        => $subscription_plan->package_amount,
                                        'currency_code'=> 'USD'
                                    ]
                                ]
                            ]
                        ],
                        'payment_preferences'  => [
                            'auto_bill_outstanding'    => 1,
                            'setup_fee'                => [
                                'value'            => $subscription_plan->package_amount,
                                'currency_code'    => 'USD'
                            ],
                            'setup_fee_failure_action' => 'CONTINUE',
                            'payment_failure_threshold'=> 0
                        ],
                        'taxes'   => [
                            'percentage'  => 0,
                            'inclusive'   => ''
                        ]

                    ];

                    $plan = $provider->createPlan($plan_array);
                    $paypal_plan_id = $plan['id'];

                    SubscriptionPlan::where('id',$subscription_plan->id)->update(['paypal_plan_id' => $paypal_plan_id]);
                }else{
                    $paypal_plan_id = $subscription_plan->paypal_plan_id;
                }

                $user_subscription = UserSubscription::where('user_id',Auth::User()->id)->where('plan_id',$subscription_plan->id)->where('subscription_status','active')->first();

                if(!empty($user_subscription)){
                    throw new AppException('User Is Already Subscribed to this Plan.');
                }

                $subscribe_array = [
                    "plan_id"              => $paypal_plan_id,
                    "start_time"           => date('Y-m-d\\TH:i:s\\Z',time()),
                    "quantity"             => "1",
                    "shipping_amount"      => [
                        "currency_code"      => "USD",
                        "value"              => "0.00"
                    ],
                    "subscriber"           => [
                        "name"               => [
                            "given_name"       => $user->name,
                            "surname"          => $user->last_name
                        ],
                        "email_address"      => $user->email,
                        "shipping_address"   => [
                          "name"             => [
                            "full_name"      => $user->shopify_url
                          ],
                          "address"          => [
                            "address_line_1" => "",
                            "address_line_2" => "",
                            "admin_area_2"   => "",
                            "admin_area_1"   => "",
                            "postal_code"    => "",
                            "country_code"   => "US"
                          ]
                        ]
                    ],
                    "application_context"  => [
                        "brand_name"         => "Profitrack",
                        "locale"             => "en-US",
                        "shipping_preference"=> "SET_PROVIDED_ADDRESS",
                        "user_action"        => "SUBSCRIBE_NOW",
                        "payment_method"     => [
                          "payer_selected"   => "PAYPAL",
                          "payee_preferred"  => "IMMEDIATE_PAYMENT_REQUIRED"
                        ],
                        "return_url"         => route('capture_subscribe_paypal_payment'),
                        "cancel_url"         => route('business_setting_upgrade_plan')
                    ]
                ];

                

                $pending_subscription = UserSubscription::where('paypal_plan_id',$paypal_plan_id)->where('user_id',Auth::User()->id)->where('paypal_subscription_status','APPROVAL_PENDING')->first();
                
                $redirect_url = '';
                if(empty($pending_subscription)){
                    
                    $create_subscription = $provider->createSubscription($subscribe_array);

                    if(isset($create_subscription['type']) && $create_subscription['type'] == 'error'){
                        throw new AppException($create_subscription['message']);
                    }else{
                        $user_subscription_array = [
                            'user_id'                   => Auth::User()->id,
                            'plan_id'                   => $subscription_plan->id,
                            'paypal_plan_id'            => $paypal_plan_id,
                            'paypal_subscription_id'    => $create_subscription['id'],

                            'plan_name'                 => $subscription_plan->package_name,
                            'plan_amount'               => $subscription_plan->package_amount,
                            'plan_duration'             => $subscription_plan->package_duration,
                            'expiry_date'               => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$subscription_plan->package_duration.' days')),
                            'is_trial'                  => 0,
                            'paypal_subscription_status'=> $create_subscription['status'],
                            'payment_gateway'           => 'paypal',
                            'created_at'                => date('Y-m-d H:i:s'),
                        ];
                        UserSubscription::insert($user_subscription_array);

                        foreach ($create_subscription['links'] as $key => $value) {
                            if(isset($value['rel']) && $value['rel'] == 'approve'){
                                $redirect_url = $value['href'];
                            }
                        }
                    }
                }else{
                    $subscription_detail = $provider->showSubscriptionDetails($pending_subscription->paypal_subscription_id);

                    foreach ($subscription_detail['links'] as $key => $value) {
                        if(isset($value['rel']) && $value['rel'] == 'approve'){
                            $redirect_url = $value['href'];
                        }
                    }
                }

                if(empty($redirect_url)){
                    throw new AppException('Something Went Wrong.Invalid Request.');
                }

                $json_array = ['redirect_url' => $redirect_url];
                return response()->data($json_array,'Subscription Payment Initiated.');
            }
        }
        return response()->routeNotFound();
    }

    public function captureSubscription(Request $request)
    {
        if($request->subscription_id){
            $user_subscription = UserSubscription::where('paypal_subscription_id',$request->subscription_id)->first();
            
            if(!empty($user_subscription)){
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
                // $capture_subscription = $provider->captureSubscriptionPayment($request->subscription_id, 'Charge Subscribe Payment',$user_subscription->plan_amount);
                // pp($capture_subscription);
                $subscription_detail = $provider->showSubscriptionDetails($request->subscription_id);

                $another_subscription = UserSubscription::where('user_id',Auth::User()->id)->where('plan_id','!=',$user_subscription->id)->where('subscription_status','active')->first();

                if(!empty($another_subscription)){
                    if($another_subscription->payment_gateway == 'stripe'){
                        $secreatekey    = env('STRIPE_SECRET');
                
                        \Stripe\Stripe::setApiKey($secreatekey);

                        \Stripe\Stripe::setVerifySslCerts(false);
                        
                        $stripe = new \Stripe\StripeClient($secreatekey);

                        $stripe->subscriptions->cancel(
                          $another_subscription->stripe_subscription_id,
                          []
                        );

                        UserSubscription::where('id',$another_subscription->id)->update(['subscription_status'=>'cancelled','stripe_subscription_status'=>'cancelled']);
                    }elseif($another_subscription->payment_gateway == 'paypal'){

                        $provider->cancelSubscription($another_subscription->paypal_subscription_id,'Upgrading Plan');
                        UserSubscription::where('id',$another_subscription->id)->update(['subscription_status'=>'cancelled','paypal_subscription_status'=>'CANCELLED']);
                    }

                }

                $update_array = [
                    'paypal_subscription_status' => $subscription_detail['status'],
                    'subscription_status'        => 'active',
                ];

                UserSubscription::where('paypal_subscription_id',$request->subscription_id)->update($update_array);
                
                return redirect()->route('business_setting_account')->with('message', 'Subscription successful for package name'.$user_subscription->plan_name);
            }
            return redirect()->route('business_setting_upgrade_plan');
        }
        return redirect()->route('business_setting_upgrade_plan');
    }







    // OLD Code Below

    public function getExpressCheckout(Request $request)
    {
       
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($recurring);
        
        try {
            
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');

            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }

    public function getExpressCheckoutSuccess(Request $request)
    {
       
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getCheckoutData($recurring);

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }

            $invoice = $this->createInvoice($cart, $status);

            if ($invoice->paid) {
                session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
            }

            return redirect('/paynow');
        }
    }

    protected function getCheckoutData($recurring = false)
    {
        $data = [];

      
        $order_id = Invoice::all()->count() + 1;
      
        if ($recurring === true) {
            
            $data['items'] = [
                [
                    'name'  => 'Monthly Subscription '.config('paypal.invoice_prefix').' #'.$order_id,
                    'price' => 9.99,
                    'qty'   => 1,
                ],
            ];

            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
            $data['subscription_desc'] = 'Monthly Subscription '.config('paypal.invoice_prefix').' #'.$order_id;
       
        } else {
            $data['items'] = [
                [
                    'name'  => 'Product 1',
                    'price' => 9.99,
                    'qty'   => 1,
                ],
                [
                    'name'  => 'Product 2',
                    'price' => 4.99,
                    'qty'   => 2,
                ],
            ];
           

            $data['return_url'] = url('/paypal/ec-checkout-success');
        }

        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id;
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/paynow');

       
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;
        
        return $data;
    }

    protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();

        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->item_qty = $product['qty'];

            $item->save();
        });

        return $invoice;
    }
}
