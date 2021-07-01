<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function integration(Request $request)
    {
       
       // return view('business_app/content_template/lifetime');
        return view('business_app/content_template/integration');
    }
}
