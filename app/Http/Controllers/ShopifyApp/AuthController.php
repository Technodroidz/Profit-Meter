<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if($_POST){
            echo 'aya';
            pp($request->method());
        }

        return view('business_app/auth_template/login');
    }
    
    public function forgotPassword(Request $request)
    {
        return view('business_app/auth_template/forgot_password');
    }

    public function register(Request $request)
    {
        return view('business_app/auth_template/register');
    }
}
