<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
class CommanCntroller extends Controller
{

    public function profilePage(){

        if(Auth::guard('webadmin')->check()){
            $getUserData = User::where('id',Auth::guard('webadmin')->user()->id)->first();
            $result = [
                'getUserData' => $getUserData,
            ];
          
            return view('admin.super-admin.main-file.index');
        }else{
            return redirect('/admin-panel');
        }
    
        }
}
