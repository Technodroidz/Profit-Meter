<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function productCost(Request $request)
    {
        return view('business_app/content_template/product_cost');
    }

    public function shippingCost(Request $request)
    {
        return view('business_app/content_template/shipping_cost');
    }

    public function handlingCost(Request $request)
    {
        return view('business_app/content_template/handling_cost');
    }

    public function transactionCost(Request $request)
    {
        return view('business_app/content_template/transaction_cost');
    }

    public function customCost(Request $request)
    {
        return view('business_app/content_template/custom_cost');
    }
}
