<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SubscriptionPlan;
use App\Model\User;
use App\Model\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Config;

class SubscruptionPlanController extends Controller
{



public function subscribepage(){

    if(Auth::guard('webadmin')->check()){
        $getUserData = User::where('id',Auth::guard('webadmin')->user()->id)->first();
        $getSubscriber = SubscriptionPlan::all();
        $result = [
            'getSubscriber' => $getSubscriber,
        ];
        // return view('admin.super-admin.user-profile-form',$result);
        return view('admin.super-admin.subscruption.index',$result);
    }else{
        return redirect('/admin-panel');
    }

    }
    
    public function submitsubscribepage(Request $request){

        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'duration' => 'required|numeric',
            'sort_description' => 'required',
            'long_description' => 'required',
        ]);
      
        $getInsertedData = SubscriptionPlan::updateOrCreate(['id'=>$request['table_id']],[
            "package_name" => $request['name'],
            "package_amount" => $request['amount'],
            "package_duration" => $request['duration'],
            "short_decription" => $request['sort_description'],
            "package_log_description" => $request['long_description']
        ]);

        return redirect('subscription')->with('success', 'Contract added  successfully'); 
    
    
    }
/** edit user detail */

public function editSubscription($id){
   
   
        
    $getBussiness = SubscriptionPlan::where('id',$id)->get();
    $getSubscriber = SubscriptionPlan::all();
    $result = [
        'getSubscribeData' => $getBussiness,
        'getSubscriber' => $getSubscriber,
    ];
   
    return view('admin.super-admin.subscruption.index',$result);

}
/** end user  */

public function deleteSubscription($id){
    $productid=SubscriptionPlan::findOrFail($id);
   // SubscriptionPlan::where('id',$id)->forceDelete();
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
}

}
