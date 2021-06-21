<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Admin;
use App\Model\Role;
use App\Model\ServiceModel;
use Illuminate\Support\Facades\Redirect;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Model\CompanyDetail;
use Input;
use Config;

class ProfileController extends Controller
{

    public function profilePage(){

        $getUserData = Admin::where('id',Auth::guard('webadmin')->user()->id)->first();
        $result = [
            'getUserData' => $getUserData,
        ];
      
        return view('admin.super-admin.main-file.index', $result);
    
    }


/** Update Profile  section */
public function updateProfile(Request $request){

     $request->validate([
        "name" =>['required'],
        'email' => 'required|email',
        'last_name' => 'required',
        'mobile_number' => 'required',
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);
     

    $getEmail = Admin::where('email',$request['email'])->first();

    if ($request->hasFile('owner_pic')) {
        $imageName = uploadSingleImages($request->file('owner_pic'),'owner_pic');
    }else{
        $imageName = Auth::guard('webadmin')->user()->profile_picture;
    } 

    $userEmail=Auth::guard('webadmin')->user()->email;
  
    if($userEmail==$request['email']) {
        
    $getInsertedData = Admin::updateOrCreate(['id'=>$request['id']],[
        "name" => $request['name'],
        'profile_picture'=>$imageName,
        'last_name' => $request['last_name'],
        'mobile_number' => $request['mobile_number']
    ]);
    
    return back()->with('status', 'Update  successfully'); 
   
    }
    elseif(@$getEmail['email']==$request['email']){
        return back()->with('message', 'Email id Alredy Exit'); 
    }
    elseif(empty(@$getEmail['email'])){
        $getInsertedData = Admin::updateOrCreate(['id'=>$request['id']],[
            "name" => $request['name'],
            'email'=>$request['email'],
            'last_name' => $request['last_name'],
            'mobile_number' => $request['mobile_number']
        ]);
        return back()->with('status', 'Update  successfully'); 
    }
 else{
    return back()->with('message', 'Email id Alredy Exit'); 
 }
    
}

/** Update Profile  section */
public function updatePassword(Request $request){



    $request->validate([
        'current_password' => ['required', new MatchOldPassword],
        'new_password' => ['required'],
        'new_confirm_password' => ['same:new_password'],
    ]);

    Admin::find(Auth::guard('webadmin')->user()->id)->update(['password'=> Hash::make($request->new_password)]);

    return back()->with('status', 'Update  successfully'); 

}

/** Update Company Profile  */

public function CompanyDetail(){

    if(Auth::guard('webadmin')->check()){
        $getUserData = CompanyDetail::get();
        $result = [
            'getComapanyDetail' => $getUserData,
        ];
       
        return view('admin.super-admin.main-file.company-details', $result);
    }else{
        return redirect('/admin-panel');
    }

    }

     /**Update company details  */

    public function CompanyUpdateData(Request $request){
       
        $request->validate([
           "name" =>['required'],
           'email'=>['required'],
           'number'=>['required'],
           'email' => 'required|email',
           'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
       if ($request->hasFile('logo')) {
           $imageName = uploadSingleImages($request->file('logo'),'logo');
       }else{
           $imageName = $request['logo_old'];
       } 
       $getInsertedData = CompanyDetail::updateOrCreate(['id'=>$request['table_id']],[
           "company_name" => $request['name'],
           'email'=>$request['email'],
           'number'=>$request['number'],
           'address'=>$request['address'],
           'logo'=>$imageName,
       ]);
       
       return back()->with('status', 'Update  successfully'); 
       
   }
   

}
