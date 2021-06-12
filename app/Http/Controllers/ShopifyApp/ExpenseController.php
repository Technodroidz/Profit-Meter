<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function productCost(Request $request)
    {
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );

        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $products = $shopify->Product->get();
        
        $data = ['current_link' => 'product_cost','products'=>$products];

        return view('business_app/content_template/product_cost',$data);
    }

    public function shippingCost(Request $request)
    {
        $data = ['current_link' => 'shipping_cost'];

        return view('business_app/content_template/shipping_cost',$data);
    }

    public function handlingCost(Request $request)
    {
        $data = ['current_link' => 'handling_cost'];
        return view('business_app/content_template/handling_cost',$data);
    }

    public function transactionCost(Request $request)
    {
        $data = ['current_link' => 'transaction_cost'];
        return view('business_app/content_template/transaction_cost',$data);
    }

    public function customCost(Request $request)
    {
        $data = ['current_link' => 'custom_cost'];
        return view('business_app/content_template/custom_cost',$data);
    }
}
