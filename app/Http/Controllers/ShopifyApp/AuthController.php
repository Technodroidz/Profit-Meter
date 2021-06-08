<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [];
        if($request->isMethod('post')){
            $validation_array = [
                'email'         => 'required|email',
                'password'      => 'required'
            ];

            $validation_attributes = [
                'email'                                 => 'Email',
                'password'                              => 'Password',
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);       
            }else{

                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    
                    return redirect()->route('home');
                }else{
                    return back()->with('error', 'Invalid Login Credentials.');       
                }
            }
        }

        return view('business_app/auth_template/login',$data);
    }
    
    public function forgotPassword(Request $request)
    {
        return view('business_app/auth_template/forgot_password');
    }

    public function register(Request $request)
    {
        return view('business_app/auth_template/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
