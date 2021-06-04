<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Carbon\Carbon;
use Session;

class HomeController extends Controller
{

    public function resisterUser(){
        
        return view('front.add-user');
    }

       /** submit product url */
public function SubmitUserForm(Request $request){
   
    $request->validate([
        'email' => 'required|email|unique:users',
        'bussiness_name' => 'required',
        'last_name' => 'required',
        'name' => 'required',
        'number' => 'required',
     
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
         'password_confirmation' => 'min:6',
        'ur' => 'required',
       
    ]);

    $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
        
        "name" => $request['name'],
        "username" => $request['name'],
        "email" => $request['email'],
        "bussiness_name" => $request['bussiness_name'],
        "number" => $request['number'],
        "role_id" => 2,
        'users'=>'user',
        "last_name" => $request['last_name'],
        "shofiy_store_url" => $request['ur'],
        "password" =>bcrypt($request['password']),
        "status" => 1,

    ]);
  
   
    return back()->with('message', 'Added  successfully'); 

}
    
    
}
