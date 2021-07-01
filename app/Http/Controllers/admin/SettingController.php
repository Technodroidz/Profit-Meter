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

        $input = $request->all();
        if(!empty($input['paypal_api_username'])){
        $this->changeEnv([
            'PAYPAL_SANDBOX_API_USERNAME' => $input['paypal_api_username'], 
            'PAYPAL_SANDBOX_API_PASSWORD' => $input['paypal_api_password'], 
            'PAYPAL_SANDBOX_API_SECRET' => $input['paypal_api_signature'],
        ]);
        }
        if(!empty($input['stripe_app_key'])){
        $this->changeEnv([
            'STRIPE_KEY' => $input['stripe_app_key'], 
            'STRIPE_SECRET' => $input['stripe_secret_key'], 
        ]);

        }
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



    $input = $request->all();
  
    $this->changeEnv([
        'MAIL_HOST' => $input['smtp_server_host'], 
        'MAIL_PORT' => $input['smtp_port_number'], 
        'MAIL_USERNAME' => $input['smtp_username'],
        'MAIL_PASSWORD' => $input['smtp_password'],
        'MAIL_DRIVER' => $input['email_driver'],
        'MAIL_ENCRYPTION' => $input['email_encryption_type'],
    ]);
    
    
    foreach ($request->all() as $key => $value) {
        $exists = Setting::where('option_name',$key)->where('setting_type','MAIL')->exists();
        if($exists){
            Setting::where('option_name',$key)->update(['option_value' => $value]);
        }
    }

    return back()->with('success', ' added  successfully'); 


}


protected function changeEnv($data = array())
{
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);

            // Loop through given data
            foreach ((array) $data as $key => $value) {
                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {
                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;

        } else {

            return false;
        }
    }
}
/** end email configartion */


}
