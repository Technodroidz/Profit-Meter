<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function products(Request $request)
    {
        return view('business_app/content_template/products');
    }

    public function orders(Request $request)
    {
        return view('business_app/content_template/orders');
    }

    public function map(Request $request)
    {
        return view('business_app/content_template/order_map');
    }

    public function disputes(Request $request)
    {
        return view('business_app/content_template/disputes');
    }
}
