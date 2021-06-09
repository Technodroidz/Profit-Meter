<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('business_app/content_template/account');
    }
}
