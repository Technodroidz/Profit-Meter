<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use App\Model\User;
use App\Model\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Config;

class SettingController extends Controller
{

    public function paymentGateway(){

        if(Auth::guard('webadmin')->check()){
            $getUserData = User::where('id',Auth::guard('webadmin')->user()->id)->first();
            $stripe_setting  = Setting::where('setting_type','STRIPE')->get();
            $paypal_setting  = Setting::where('setting_type','PAYPAL')->get();
            $getPayment      = ['stripe' => $stripe_setting,'paypal' => $paypal_setting];
            $result = [
                'getUserData' => $getUserData,
                'getPayment'  => $getPayment,
            ];
            
            return view('admin.super-admin.setting.index',$result);
        }else{
            return redirect('/admin-panel');
        }
           
    
    }

    
    public function submitPaymentsetting(Request $request){

        foreach ($request->all() as $key => $value) {
            $exists = Setting::where('option_name',$key)->exists();
            if($exists){
                Setting::where('option_name',$key)->update(['option_value' => $value]);
            }
        }

        return back()->with('success', ' added  successfully'); 
    }

    /** edit user detail */
    public function emailPage(){

        if(Auth::guard('webadmin')->check()){
            $getUserData = User::where('id',Auth::guard('webadmin')->user()->id)->first();
            $getemail    = Setting::where('setting_type','MAIL')->get();
            $result = [
                'getUserData' => $getUserData,
                'getemail'    => $getemail
            ];
          
            return view('admin.super-admin.setting.email',$result);
        }else{
            return redirect('/admin-panel');
        }

    }


/** Email configration  */
public function submitEmailsetting(Request $request){
    
    foreach ($request->all() as $key => $value) {
        $exists = Setting::where('option_name',$key)->where('setting_type','MAIL')->exists();
        if($exists){
            Setting::where('option_name',$key)->update(['option_value' => $value]);
        }
    }

    return back()->with('success', ' added  successfully'); 


}
/** end email configartion */


}
