<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Carbon\Carbon;
use Session;

class PayapalController extends Controller
{

    public function index(){
        
        return view('paywithpaypal');
    }

       /** submit product url */
public function SubmitUserForm(Request $request){
    print_r($request->all()); exit;
    $request->validate([
        'email' => 'required|email|unique:users',
        'bussiness_name' => 'required',
        'last_name' => 'required',
        'name' => 'required',
        'number' => 'required',
        'password' => 'required',
        
       
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
        "password" =>bcrypt($request['password']),
        "status" => 1,

    ]);
  
   
    return back()->with('success', 'Added  successfully'); 

}
    
    
}
