<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BussinessModel;
use App\Model\User;
use App\Model\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Config;

class BussinesController extends Controller
{


    public function businneuser(){

        if(Auth::guard('webadmin')->check()){
            $getUserData = User::where('id',Auth::guard('webadmin')->id)->first();
            $getBussiness = BussinessModel::all();
            $result = [
                'getBussiness' => $getBussiness,
            ];
            // return view('admin.super-admin.user-profile-form',$result);
            return view('admin.super-admin.business.index',$result);
        }else{
            return redirect('/admin-panel');
        }
           
    
        }
    
    public function submitBussiness(Request $request){

       
        $request->validate([
            'join_date' => 'required',
            'number' => 'required',
            'email' => 'required',
            'name' => 'required',
        ]);
      
        $getInsertedData = BussinessModel::updateOrCreate(['id'=>$request['table_id']],[
            "name" => $request['name'],
            "bussiness_name" => $request['bussiness_name'],
            "first_name" => $request['first_name'],
            "user_name" => $request['name'],
            "join_data" => $request['join_date'],
            "phone_number" => $request['number'],
            "email" => $request['email'],
        ]);

        return redirect('business')->with('success', ' added  successfully'); 
    
    
    }
/** edit user detail */

public function editBussiness($id){
   
        
        $getBussiness = BussinessModel::where('id',$id)->get();
        $result = [
            'getBussinessData' => $getBussiness,
        ];
       
        return view('admin.super-admin.business.index',$result);
    
}
/** end user  */

public function deleteBussiness($id){
    $productid=BussinessModel::findOrFail($id);
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
  
}

}
