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
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ExceptionInterface;

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
                $publishableKey = 'pk_test_51HuWQHJRRrJp7PIAIkuAgvuEWXj9CwiwwVl9YPSBPZIp87M0WTFZD8VuAFIhb3thCG0hF5mF6poVsmlt3IEiOftq00CKI0k6WY';
                $secreatekey    = env('STRIPE_SECRET');
                
                \Stripe\Stripe::setApiKey($secreatekey);
            
                if(isset($_POST['stripeToken'])){
                    $user = Auth::User();
                    \Stripe\Stripe::setVerifySslCerts(false);
            
                    $token  = $_POST['stripeToken'];
                    
                    $stripe = new \Stripe\StripeClient($secreatekey);

                    $user = User::getUserById($user->id);

                    if(empty($user->stripe_customer_id)){

                        $customer=\Stripe\Customer::create(array(
                            "email"     => $user->email,
                            "name"      => $user->name.' '.$user->last_name,
                            "source"    => $token,
                            "metadata"  => ['user_id' => $user->id,'shopify_url'=> $user->shopify_url, 'subscription_id' => $request->subscription_id, 'user_details'=>'User Created While subscribing to plan "'.$request->subscription_name.'"']
                        ));

                        $stripe_customer_id = $customer->id;
                        User::updateById(Auth::User()->id,['stripe_customer_id'=> $stripe_customer_id]);
                    }else{
                        $stripe_customer_id = $user->stripe_customer_id;
                    }
                            

                    // $product = \Stripe\Products::create(array( 
                    //   'name' => 'Demo',
                    // )); 
                    
                      
                    // $plan = \Stripe\Plan::create(array( 
                    //     "product" => [ 
                    //         "name" => $subscription_plan->package_name,
                    //     ], 
                    //     'amount' => $subscription_plan->package_amount,
                    //     'currency' => 'USD',
                    //     'interval' => 'day',
                    //     'product' =>'prod_Jenzbm8rTI8WaF',
                    // )); 
                       
                    // $subscription = \Stripe\Subscription::create(array( 
                    //     "customer" => $stripe_customer_id,
                    //     "items" => array( 
                    //         array( 
                    //             "plan" => $subscription_plan->id,
                    //         ), 
                    //     ), 
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
                
                    //   print_r($data);
            
                    //$list = $stripe->subscriptions->all(['limit' => 3]);
                    // print_r('dfdsf');
                    // print_r($list);
                    // exit;
                    
                    try {
                        $data=\Stripe\Charge::create(array(
                            "amount"        => $subscription_plan->package_amount,
                            "currency"      => "usd",
                            "description"   => 'Subscribe to Plan "'.$subscription_plan->package_name.'"',
                            "customer"      => $stripe_customer_id,
                            "metadata"      => ['user_id' => $user->id, 'package_id' => $subscription_plan->id, 'package_details' => '']
                        ));
                    }
                    catch(ExceptionInterface $e) {
                        $error1 = $e->getMessage();
                        throw new AppException($error1);
                    }

                    pp($data);
                  
                    if($data['status'] == 'succeeded'){
                        
                        
                        $paymentDetailsMaster = [
                            'user_id'           => $data['metadata']['employee_id'],
                            //'employee_id'     => $data['metadata']['employee_id'],
                            'package_id'        => $data['metadata']['package_id'],
                            'package_details'   => $data['metadata']['package_details'],
                            'payment_id'        => $data['balance_transaction'],
                            'total_amount'      => $data['amount'],
                            //'status'          => $data['status']
                        ];
                                
                        $paymentDetailsuser = [
                            'user_id'           => $data['metadata']['user_id'],
                            'employee_id'       => $data['metadata']['employee_id'],
                            'package_id'        => $data['metadata']['package_id'],
                            'package_details'   => $data['metadata']['package_details'],
                            'transaction_id'    => $data['balance_transaction'],
                            'package_amount'    => $data['amount'],
                            'start_date'        => 'jgfdsffg',
                            'status'            => $data['status']
                        ];
                                
                    
                        // $this->subscription_model->addpaymentdatainMaster($paymentDetailsMaster);
                        // $this->subscription_model->add($paymentDetailsuser);
                        $json_array = ['reload' => true];
                    }
                    return response()->data($json_array,'Subscription Payment Successfull.');
                }
            }
        }
        return response()->routeNotFound();
    
    }
}
