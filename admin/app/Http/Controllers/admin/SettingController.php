<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SettingModel;
use App\Model\User;
use App\Model\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Config;

class SettingController extends Controller
{

    public function paymentGatway(){

        if(Auth::check()){
            $getUserData = User::where('id',Auth::user()->id)->first();
            $getPayment = SettingModel::all();
            $result = [
                'getUserData' => $getUserData,
                'getPayment'=>$getPayment,
            ];
            // return view('admin.super-admin.user-profile-form',$result);
            return view('admin.super-admin.setting.index',$result);
        }else{
            return redirect('/admin-panel');
        }
           
    
    }


    
    public function submitPaypalsetting(Request $request){

        $getInsertedData = SettingModel::updateOrCreate(['id'=>$request['id']],[
            "privet_key" => $request['privet_key'],
            "public_key" => $request['public_key'],
            "currency" => $request['currency'],
            
        ]);

        return back()->with('success', ' added  successfully'); 
    
    
    }
/** edit user detail */
public function emailPage(){

    if(Auth::check()){
        $getUserData = User::where('id',Auth::user()->id)->first();
        $getemail = SettingModel::where('id','3')->get();
        $result = [
            'getUserData' => $getUserData,
            'getemail'=>$getemail
        ];
      
        return view('admin.super-admin.setting.email',$result);
    }else{
        return redirect('/admin-panel');
    }

    }


/** Email configration  */
public function submitEmailsetting(Request $request){

    $getInsertedData = SettingModel::updateOrCreate(['id'=>$request['id']],[
        "host_name" => $request['host_name'],
        "email_user" => $request['email_user'],
        "driver_type" => $request['driver_type'],
        "password" => $request['password'],
        "port_number" => $request['port_number'],
        "mail_encription_type" => $request['mail_encription_type'],
        
    ]);

    return back()->with('success', ' added  successfully'); 


}
/** end email configartion */


}
