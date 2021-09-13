<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserSubscription;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{
    public function index(){

        $getReportData = UserSubscription::all();
       
        $result = [
            'getReportData' => $getReportData,
        ];
        return view('admin.super-admin.main-report.index', $result);
    }
}
