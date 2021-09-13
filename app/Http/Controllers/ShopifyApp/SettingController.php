<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Rule;
use App\Model\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\SubscriptionPlan;
use App\Jobs\SyncGoogleAdsData;
use App\Jobs\SyncSnapchatAdsData;
use App\Jobs\SyncPaypalDisputesData;

class SettingController extends Controller
{
    public function rules(Request $request)
    {
        if($request->isMethod('post')){
            
            $validation_array = [
                'financial_status'                      => '',            
                'zero_value_order'                      => '',            
                'cancelled_order'                       => '',            
                'order_tags'                            => 'required',        
                'pos'                                   => '',
                'draft_order'                           => '',        
                'order_channels'                        => 'required',            
                'customer_tags'                         => 'required',            
                'refund_order_cost_to_zero'             => '',                        
                'assign_original_order_date_to_refund'  => ''                          
            ];

            $validation_attributes = [
                'financial_status'                      => 'Financial Status',
                'zero_value_order'                      => 'Zero Value Order',
                'cancelled_order'                       => 'Cancelled Order',
                'order_tags'                            => 'Order Tags',
                'pos'                                   => 'POS',
                'draft_order'                           => 'Draft Order',
                'order_channels'                        => 'Order Channels',
                'customer_tags'                         => 'Customer Tags',
                'refund_order_cost_to_zero'             => 'Refund Order Cost To Zero',
                'assign_original_order_date_to_refund'  => 'Assign Original Order Date To Refund',
            ];
            
            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{
                
                $insert_array = [
                    'user_id'                              => Auth::User()->id,
                    'financial_status'                     => isset($request->financial_status)?$request->financial_status:null,
                    'zero_value_order'                     => isset($request->zero_value_order)?$request->zero_value_order:0,
                    'cancelled_order'                      => isset($request->cancelled_order)?$request->cancelled_order:0,
                    'order_tags'                           => $request->order_tags,
                    'pos'                                  => isset($request->pos)?$request->pos:0,
                    'draft_order'                          => isset($request->draft_order)?$request->draft_order:0,
                    'order_channels'                       => $request->order_channels,
                    'customer_tags'                        => $request->customer_tags,
                    'refund_order_cost_to_zero'            => isset($request->refund_order_cost_to_zero)?$request->refund_order_cost_to_zero:0,
                    'assign_original_order_date_to_refund' => isset($request->assign_original_order_date_to_refund)?$request->assign_original_order_date_to_refund:0
                ];
                
                Rule::updateOrCreate(['user_id' => Auth::User()->id],$insert_array);
                return redirect()->route('business_setting_rules');
            }
        }

        $rules = Rule::getRuleByUserId(Auth::User()->id);

        $data  = ['current_link' => 'rules', 'rules'=> $rules]; 

        return view('business_app/content_template/rules',$data);
    }

    public function syncStatus(Request $request)
    {
        return view('business_app/content_template/sync');
    }

    public function account(Request $request)
    {
        $getUserData = User::where('id',Auth::user()->id)->first();
        $trial_subscription = UserSubscription::getTrialSubscription(Auth::User()->id);
        $paid_subscription = UserSubscription::getPaidSubscription(Auth::User()->id);
        $data       = ['current_link' => 'account','getUserData' => $getUserData,'trial_subscription' => $trial_subscription,'paid_subscription' => $paid_subscription];
        // pp(session()->all());
        return view('business_app/content_template/account',$data);
    }

    /** Update Profile  section */
    public function updateUserProfile(Request $request){

        $request->validate([
           "firstname" =>['required'],
           'email' => 'required|email',
           'lastname' => 'required',
           'phone' => 'required',
           'company' => 'required',
           'profile_pick' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
       $getEmail = User::where('email',$request['email'])->first();

       if ($request->hasFile('profile_pick')) {
           $imageName = uploadSingleImages($request->file('profile_pick'),'profile_pick');
       }else{
           $imageName = Auth::user()->profile_pick;
       }

       $userEmail=Auth::user()->email;
       
       if($userEmail==$request['email']) {
           
           $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
            "name" => $request['firstname'],
            'profile_pick'=>$imageName,
            'number' => $request['phone'],
            'last_name' => $request['lastname'],
            'company' => $request['company']
           ]);
       
            return back()->with('status', 'Update  successfully'); 
        }
        elseif(@$getEmail['email']==$request['email']){
           return back()->with('message', 'Email id Alredy Exit'); 
        }
        elseif(empty(@$getEmail['email'])){
           $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
               "name" => $request['firstname'],
               'profile_pick'=>$imageName,
               'number' => $request['phone'],
               'email' => $request['email'],
               'last_name' => $request['lastname'],
               'company' => $request['company']
           ]);
           return back()->with('status', 'Update  successfully'); 
        }
        else{
           return back()->with('message', 'Email id Alredy Exit'); 
        }
    }

    public function updateUserPassword(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return back()->with('status', 'Update  successfully'); 

    }

    public function upgradePlan(Request $request)
    {
        $plans = SubscriptionPlan::getAllPlans();
        foreach ($plans as $key => &$value) {
            $subscription_exists = UserSubscription::where('subscription_status','active')->where('plan_id',$value->id)->where('user_id',Auth::User()->id)->exists();
            if($subscription_exists){
                session()->now('success', 'You are Currently Subscribed to '.$value->package_name);
                $value->subscription_active = true;
            }else{
                $value->subscription_active = false;
            }
        }
        $data  = ['current_link' => 'account','subscription_plans' => $plans];

        return view('business_app/content_template/upgrade_plan',$data);
    }

    public function syncPaypalDisputesData(Request $request)
    {
        SyncPaypalDisputesData::dispatch(Auth::User()->id);
        return response()->success('Request to sync Shopify Products initiated.Will be synced shortly.');
    }

    public function syncGoogleAdsData(Request $request)
    {
        SyncGoogleAdsData::dispatch(Auth::User()->id);
        return response()->success('Request to sync Shopify Products initiated.Will be synced shortly.');
    }
    
    public function syncSnapchatAdsData(Request $request)
    {
        SyncSnapchatAdsData::dispatch(Auth::User()->id);
        return response()->success('Request to sync Shopify Products initiated.Will be synced shortly.');
    }



}
