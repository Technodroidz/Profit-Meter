<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\subscruptionModel;
use App\Model\User;
use App\Model\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Config;

class SubscruptionPlanController extends Controller
{



public function subscribepage(){

    if(Auth::check()){
        $getUserData = User::where('id',Auth::user()->id)->first();
        $getSubscriber = subscruptionModel::all();
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
      
        $getInsertedData = subscruptionModel::updateOrCreate(['id'=>$request['table_id']],[
            "package_name" => $request['name'],
            "package_amount" => $request['amount'],
            "pachage_duration" => $request['duration'],
            "short_decription" => $request['sort_description'],
            "pachage_log_description" => $request['long_description'],
            "status" => $request['status'],
        ]);

        return redirect('subscribtion')->with('success', 'Contract added  successfully'); 
    
    
    }
/** edit user detail */

public function editSubscription($id){
   
   
        
    $getBussiness = subscruptionModel::where('id',$id)->get();
    $getSubscriber = subscruptionModel::all();
    $result = [
        'getSubscribeData' => $getBussiness,
        'getSubscriber' => $getSubscriber,
    ];
   
    return view('admin.super-admin.subscruption.index',$result);

}
/** end user  */

public function deleteSubscription($id){
    $productid=subscruptionModel::findOrFail($id);
   // subscruptionModel::where('id',$id)->forceDelete();
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
}

}
