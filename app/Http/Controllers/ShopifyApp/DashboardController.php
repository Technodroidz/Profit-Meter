<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPShopify\ShopifySDK;
use Log;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        
        $data       = ['current_link' => 'home'];
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );
        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $products = $shopify->Product->get();
        // pp($products);
        return view('business_app/content_template/dashboard',$data);
    }

}
