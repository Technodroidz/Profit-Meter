<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
class SettingController extends Controller
{
    public function rules(Request $request)
    {
        return view('business_app/content_template/rules');
    }

    public function syncStatus(Request $request)
    {
        return view('business_app/content_template/sync');
    }

    public function account(Request $request)
    {
        $getUserData = User::where('id',Auth::user()->id)->first();
        $data       = ['current_link' => 'account','getUserData'=>$getUserData];
      
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
}
