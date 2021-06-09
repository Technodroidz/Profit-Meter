<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LifetimeValueController extends Controller
{
    public function lifetimeValue(Request $request)
    {
        return view('business_app/content_template/lifetime');
    }
}
