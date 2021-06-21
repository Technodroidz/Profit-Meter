<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function products(Request $request)
    {
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );
        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $products = $shopify->Product->get();
        
        $data       = ['current_link' => 'products','products' => $products];
        
        return view('business_app/content_template/products',$data);
    }

    public function orders(Request $request)
    {
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );
        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $orders     = $shopify->Order->get();
        
        $data       = ['current_link' => 'orders','orders' => $orders];

        return view('business_app/content_template/orders',$data);
    }

    public function map(Request $request)
    {
        $data = ['current_link' => 'map'];
        return view('business_app/content_template/order_map',$data);
    }

    public function disputes(Request $request)
    {
        // $config = array(
        //     'ShopUrl' => Auth::User()->shopify_url,
        //     'AccessToken' => Auth::User()->shopify_access_token,
        // );
        // $shopify    = new \PHPShopify\ShopifySDK($config);
        
        // $disputes   = $shopify->ShopifyPayment->Dispute->get();
        // // pp($dispute);
        $data       = ['current_link' => 'disputes'];

        return view('business_app/content_template/disputes',$data);
    }
}
