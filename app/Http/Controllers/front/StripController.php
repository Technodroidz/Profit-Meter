<?php
namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripController extends Controller {
    public function subscription(){
        return view('subscription');
       
    }
    public function postSubscription(Request $request){
        $user = new User;
        $user->name  = $request->name;        
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->newSubscription('main',$request->subscription)->create($request->token);
        if ($user->subscribed('main')) {
               return response()->json(['msg'=>'Successfully subscribed']);
        }
           return response()->json(['msg'=>'Oops there is something error with your input']);
            
    }


    public function Viewcharge(Request $request)
    {
        return view('pay-now-strip');
    }

    public function charge(Request $request)
    {
        try {

            Stripe::setApiKey(env('STRIPE_SECRET'));
        
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
        
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1999,
                'currency' => 'INR'
            ));
        
            return 'Charge successful, you get the course!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ViewSubcharge(Request $request)
    {
        return view('pay-now-strip-sub');
    }

    public function subscribe_process_sub(Request $request)
    {

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $user = User::find(1);
            $user->newSubscription('main', 'bronze')->create($request->stripeToken);
            return 'Subscription successful, you get the course!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
  

    
}