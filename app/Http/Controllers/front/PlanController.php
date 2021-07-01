<?php

namespace App\Http\Controllers\front;
use App\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Products;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
   
        return view('plans.index', compact('plans'));
    }
    public function show(Plan $plan, Request $request)
    {
       
        // print_r($request->user()->subscribedToPlan($plan->stripe_plan, 'main')); exit;
        // if($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
        //     return redirect()->route('home')->with('success', 'You have already subscribed the plan');
        // }
     
        return view('plans.show', compact('plan'));
    }


    public function payment(Request $request){

        //$data = $this->input->post();

        // print_r( $request->all()); exit;
    
        // $this->load->model('subscription_model');
    
        // include('application/libraries/stripe-php/init.php');
    
        $publishableKey = 'pk_test_51HuWQHJRRrJp7PIAIkuAgvuEWXj9CwiwwVl9YPSBPZIp87M0WTFZD8VuAFIhb3thCG0hF5mF6poVsmlt3IEiOftq00CKI0k6WY';
        $secreatekey = 'sk_test_51HuWQHJRRrJp7PIAkEzyhyUaSTq9lqd6b8SHQacS91T7rOO2pWwztoTSpsolvE46p7ROFEjLvUHYE2P6vSjEAf0C00GGPMAQm6';
        
        \Stripe\Stripe::setApiKey($secreatekey);
    
        if(isset($_POST['stripeToken'])){
            \Stripe\Stripe::setVerifySslCerts(false);
    
            $token=$_POST['stripeToken'];
            // print_r( $token); exit;
               $stripe = new \Stripe\StripeClient(
                      'sk_test_51HuWQHJRRrJp7PIAkEzyhyUaSTq9lqd6b8SHQacS91T7rOO2pWwztoTSpsolvE46p7ROFEjLvUHYE2P6vSjEAf0C00GGPMAQm6'
                    );
                    
                $customer=\Stripe\Customer::create(array(
                    "email"=>'verma@gmail.com',
                    "name"=>'verma',
                    "source"=>$token,
                    "metadata" =>['employee_id' => '1', 'package_id' => '1', 'package_details'=>'hdhjd gfegfug ewd uggdue wigdi ue']
                ));
           

                // $product = \Stripe\Products::create(array( 
                //   'name' => 'Demo',
                // )); 
            
              
                $plan = \Stripe\Plan::create(array( 
                    "product" => [ 
                        "name" => 'Demo',
                    ], 
                    'amount' => 10,
                    'currency' => 'INR',
                    'interval' => 'day',
                    'product' =>'prod_Jenzbm8rTI8WaF',
                )); 
               
            $subscription = \Stripe\Subscription::create(array( 
                    "customer" => $customer->id,
                    "items" => array( 
                        array( 
                            "plan" => $plan->id,
                        ), 
                    ), 
                )); 
        
              
    
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
           
           
            $data=\Stripe\Charge::create(array(
                "amount"=>1000,
                "currency"=>"inr",
                "description"=>"Testing Payment Desc",
                "customer" =>$customer->id,
                "metadata" =>['user_id' => '1', 'employee_id' => '1', 'package_id' => '1', 'package_details'=>'hdhjd gfegfug ewd uggdue wigdi ue']
            ));
            
          
            if($data['status'] == 'succeeded'){
                
                
                $paymentDetailsMaster = [
                        'user_id' 			=> $data['metadata']['employee_id'],
                        //'employee_id' 	=> $data['metadata']['employee_id'],
                        'package_id'		=> $data['metadata']['package_id'],
                        'package_details' 	=> $data['metadata']['package_details'],
                        'payment_id' 	    => $data['balance_transaction'],
                        'total_amount' 		=> $data['amount'],
                        //'status' 			=> $data['status']
                        ];
                        
                $paymentDetailsuser = [
                        'user_id' 			=> $data['metadata']['user_id'],
                        'employee_id' 		=> $data['metadata']['employee_id'],
                        'package_id'		=> $data['metadata']['package_id'],
                        'package_details' 	=> $data['metadata']['package_details'],
                        'transaction_id' 	=> $data['balance_transaction'],
                        'package_amount' 	=> $data['amount'],
                        'start_date'        => 'jgfdsffg',
                        'status' 			=> $data['status']
                        ];
                        
            
                // $this->subscription_model->addpaymentdatainMaster($paymentDetailsMaster);
                // $this->subscription_model->add($paymentDetailsuser);
            
            }
            return redirect('plans')->with('message', 'Payment added  successfully'); 
           
            
        }
    }

}
