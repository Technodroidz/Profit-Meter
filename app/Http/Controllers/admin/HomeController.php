<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\ContractModel;
use Config;

class homeController extends Controller
{
    public function adminPanel(){
        if(Auth::guard('webadmin')->check()){
            $getUser = User::get()->count();
            $result=[
                'getUser'=>$getUser,
            ];
            return view('admin.super-admin.index',$result);
		}else{
            return view('admin.login');
		}
    }   

}
